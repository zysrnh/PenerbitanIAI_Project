<?php

namespace App\Http\Controllers;

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
            $query = ForumQuestion::query()->where('is_published', true)->latest();

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
        $question = ForumQuestion::where('slug', $slug)->firstOrFail();

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
        $validated['status'] = 'pending';
        $validated['is_published'] = false;

        try {
            ForumQuestion::create($validated);
            return redirect()->route('forum.index')->with('success', 'Pertanyaan Anda berhasil diajukan! Dewan Asatidz / Redaksi kami akan segera menelaah dan memberikan jawaban.');
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kendala saat menyimpan pertanyaan. Silakan coba kembali.');
        }
    }
}
