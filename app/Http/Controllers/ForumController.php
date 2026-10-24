<?php

namespace App\Http\Controllers;

use App\Models\ForumAnswer;
use App\Models\ForumQuestion;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $categories = ForumQuestion::getCategories();
        $selectedCategory = $request->query('category');
        $search = $request->query('q');

        try {
            // Publikasikan otomatis pertanyaan yang pending agar langsung muncul di forum
            ForumQuestion::where('is_published', false)
                ->where('status', '!=', 'rejected')
                ->update(['is_published' => true]);

            $query = ForumQuestion::query()
                ->withCount('answers')
                ->with('user')
                ->where('is_published', true)
                ->latest();

            if (!empty($selectedCategory) && $selectedCategory !== 'Semua') {
                $query->where('category', $selectedCategory);
            }

            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('question', 'like', "%{$search}%")
                      ->orWhere('answer', 'like', "%{$search}%");
                });
            }

            $questions = $query->paginate(10)->withQueryString();
            $totalAnswered = ForumQuestion::where('is_published', true)->count();
        } catch (\Throwable $e) {
            $questions = collect([]);
            $totalAnswered = 0;
        }

        // WhatsApp Konsultasi
        $contactWaRaw = SiteSetting::get('contact_whatsapp', '082116116133');
        $cleanWa = preg_replace('/[^0-9]/', '', $contactWaRaw);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        } elseif (str_starts_with($cleanWa, '8')) {
            $cleanWa = '62' . $cleanWa;
        }

        return view('forum.index', compact('questions', 'categories', 'selectedCategory', 'search', 'totalAnswered', 'cleanWa'));
    }

    public function show($slug)
    {
        $question = ForumQuestion::where('slug', $slug)
            ->with(['answers' => function ($q) {
                $q->with('user')->oldest();
            }, 'user'])
            ->firstOrFail();

        // Increment views
        try {
            $question->increment('views_count');
        } catch (\Throwable $e) {
            // Ignore increment error if any
        }

        $relatedQuestions = ForumQuestion::where('id', '!=', $question->id)
            ->where('is_published', true)
            ->where('category', $question->category)
            ->latest()
            ->take(4)
            ->get();

        if ($relatedQuestions->isEmpty()) {
            $relatedQuestions = ForumQuestion::where('id', '!=', $question->id)
                ->where('is_published', true)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('forum.show', compact('question', 'relatedQuestions'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('member.login')
                ->with('error', 'Silakan login terlebih dahulu untuk mengajukan pertanyaan hukum agama.');
        }

        $validated = $request->validate([
            'category' => 'required|string|max:100',
            'title'    => 'required|string|max:255',
            'question' => 'required|string|min:15|max:5000',
            'phone'    => 'nullable|string|max:25',
        ], [
            'category.required' => 'Pilih kategori pertanyaan yang sesuai.',
            'title.required'    => 'Judul / pokok pertanyaan wajib diisi.',
            'question.required' => 'Uraian pertanyaan wajib diisi.',
            'question.min'      => 'Uraian pertanyaan minimal 15 karakter agar dapat ditelaah dengan baik.',
        ]);

        $user = Auth::user();
        $validated['user_id'] = $user->id;
        $validated['name'] = $user->name;
        $validated['email'] = $user->email;
        $validated['phone'] = $request->filled('phone') ? $request->input('phone') : ($user->phone ?? null);
        $validated['status'] = 'open';
        $validated['is_published'] = true; // Langsung terbit di forum!

        try {
            $question = ForumQuestion::create($validated);
            return redirect()->route('forum.show', $question->slug)->with('success', 'Pertanyaan Anda berhasil diajukan dan diterbitkan di forum! Anggota forum atau Dewan Asatidz dapat memberikan jawaban dan tanggapan.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kendala saat menyimpan pertanyaan. Silakan coba kembali.');
        }
    }

    public function storeAnswer(Request $request, $slug)
    {
        $question = ForumQuestion::where('slug', $slug)->firstOrFail();

        if (Auth::check()) {
            $request->validate([
                'answer' => 'required|string|min:5|max:5000',
            ], [
                'answer.required' => 'Tanggapan atau jawaban wajib diisi.',
                'answer.min'      => 'Jawaban minimal 5 karakter.',
            ]);

            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
            $userId = $user->id;
            $userRole = strtolower($user->role ?? '');
            $isOfficial = in_array($userRole, ['admin', 'asatidz', 'editor', 'redaksi']);
        } else {
            $request->validate([
                'name'   => 'required|string|max:100',
                'answer' => 'required|string|min:5|max:5000',
                'email'  => 'nullable|email|max:150',
            ], [
                'name.required'   => 'Nama Anda wajib diisi.',
                'answer.required' => 'Tanggapan atau jawaban wajib diisi.',
                'answer.min'      => 'Jawaban minimal 5 karakter.',
            ]);

            $name = $request->input('name');
            $email = $request->input('email');
            $userId = null;
            $isOfficial = false;
        }

        try {
            ForumAnswer::create([
                'forum_question_id' => $question->id,
                'user_id'           => $userId,
                'name'              => $name,
                'email'             => $email,
                'answer'            => $request->input('answer'),
                'is_official'       => $isOfficial,
            ]);

            // Jika status masih open/pending, update ke answered bila yang menjawab Asatidz
            if ($isOfficial && empty($question->answer)) {
                $question->update([
                    'answer'         => $request->input('answer'),
                    'answered_by'    => $name,
                    'answered_by_id' => $userId,
                    'answered_at'    => now(),
                    'status'         => 'answered',
                ]);
            }

            return redirect()->route('forum.show', $slug)->with('success', 'Jawaban / tanggapan Anda berhasil ditambahkan ke forum diskusi!');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kendala saat menyimpan tanggapan. Silakan coba kembali.');
        }
    }
}
