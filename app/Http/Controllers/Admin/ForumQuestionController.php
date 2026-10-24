<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumQuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumQuestion::query()->latest();

        $status = $request->query('status', 'all');
        if ($status === 'pending') {
            $query->where('status', 'pending');
        } elseif ($status === 'answered') {
            $query->where('status', 'answered');
        } elseif ($status === 'rejected') {
            $query->where('status', 'rejected');
        }

        if ($request->filled('category') && $request->query('category') !== 'all') {
            $query->where('category', $request->query('category'));
        }

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('name', 'like', "%{$s}%")
                  ->orWhere('question', 'like', "%{$s}%")
                  ->orWhere('answer', 'like', "%{$s}%")
                  ->orWhere('answered_by', 'like', "%{$s}%");
            });
        }

        $questions = $query->paginate(15)->withQueryString();

        $pendingCount = ForumQuestion::where('status', 'pending')->count();
        $answeredCount = ForumQuestion::where('status', 'answered')->count();
        $totalCount = ForumQuestion::count();
        $categories = ForumQuestion::getCategories();

        return view('admin.forum.index', compact('questions', 'status', 'pendingCount', 'answeredCount', 'totalCount', 'categories'));
    }

    public function edit($id)
    {
        $question = ForumQuestion::findOrFail($id);
        $categories = ForumQuestion::getCategories();

        // Default nama penjawab jika belum diisi: nama admin yang login
        $defaultAnswerer = $question->answered_by ?: (Auth::user()->name ?? 'Dewan Hisbah / Redaksi PERSIS PERS');

        return view('admin.forum.answer', compact('question', 'categories', 'defaultAnswerer'));
    }

    public function update(Request $request, $id)
    {
        $question = ForumQuestion::findOrFail($id);

        $validated = $request->validate([
            'category'     => 'required|string|max:100',
            'title'        => 'required|string|max:255',
            'question'     => 'required|string',
            'answer'       => 'nullable|string',
            'answered_by'  => 'nullable|string|max:150',
            'status'       => 'required|in:pending,answered,rejected',
            'is_published' => 'nullable|boolean',
        ], [
            'category.required' => 'Kategori wajib dipilih.',
            'title.required'    => 'Judul pertanyaan wajib diisi.',
            'question.required' => 'Pertanyaan penanya wajib diisi.',
        ]);

        $validated['is_published'] = $request->has('is_published') && $request->input('is_published') == '1';

        // Jika ada jawaban
        if (!empty(trim($validated['answer'] ?? ''))) {
            $validated['status'] = 'answered';
            $validated['answered_by_id'] = Auth::id();
            if (empty($question->answered_at)) {
                $validated['answered_at'] = now();
            }
            if (empty($validated['answered_by'])) {
                $validated['answered_by'] = Auth::user()->name ?? 'Dewan Hisbah PERSIS PERS';
            }
        }

        $question->update($validated);

        return redirect()->route('admin.forum-questions.index')->with('success', 'Pertanyaan & jawaban berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $question = ForumQuestion::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.forum-questions.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (is_array($ids) && count($ids) > 0) {
            ForumQuestion::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => count($ids) . ' pertanyaan berhasil dihapus.']);
        }

        return response()->json(['success' => false, 'message' => 'Tidak ada pertanyaan yang dipilih.'], 400);
    }
}
