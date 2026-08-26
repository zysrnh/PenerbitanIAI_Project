<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $books = $query->paginate(12)->withQueryString();
        $totalBooks = Book::count();
        $newReleasesCount = Book::where('is_new_release', true)->count();
        $bestSellersCount = Book::where('is_best_seller', true)->count();

        $categories = Book::select('category')->distinct()->pluck('category');

        return view('admin.books.index', compact('books', 'totalBooks', 'newReleasesCount', 'bestSellersCount', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:50',
            'year' => 'required|string|max:10',
            'pages' => 'required|string|max:50',
            'format' => 'required|string|max:100',
            'price' => 'required|string|max:50',
            'synopsis' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200', // 50MB
            'sample_pdf' => 'nullable|file|mimes:pdf|max:102400', // 100MB
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Handle Cover Image Upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = $file->store('books/covers', 'public');
            $validated['cover_image'] = $path;
        }

        // Handle Sample PDF Upload
        if ($request->hasFile('sample_pdf')) {
            $file = $request->file('sample_pdf');
            $path = $file->store('books/samples', 'public');
            $validated['sample_pdf'] = $path;
        }

        Book::create($validated);

        return back()->with('success', 'Buku baru "' . $validated['title'] . '" berhasil ditambahkan ke katalog.');
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:50',
            'year' => 'required|string|max:10',
            'pages' => 'required|string|max:50',
            'format' => 'required|string|max:100',
            'price' => 'required|string|max:50',
            'synopsis' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200', // 50MB
            'sample_pdf' => 'nullable|file|mimes:pdf|max:102400', // 100MB
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Handle Cover Image Upload
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $file = $request->file('cover_image');
            $path = $file->store('books/covers', 'public');
            $validated['cover_image'] = $path;
        }

        // Handle Sample PDF Upload
        if ($request->hasFile('sample_pdf')) {
            if ($book->sample_pdf && Storage::disk('public')->exists($book->sample_pdf)) {
                Storage::disk('public')->delete($book->sample_pdf);
            }
            $file = $request->file('sample_pdf');
            $path = $file->store('books/samples', 'public');
            $validated['sample_pdf'] = $path;
        }

        $book->update($validated);

        return back()->with('success', 'Data buku "' . $book->title . '" berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }
        if ($book->sample_pdf && Storage::disk('public')->exists($book->sample_pdf)) {
            Storage::disk('public')->delete($book->sample_pdf);
        }
        $book->delete();

        return back()->with('success', 'Buku "' . $title . '" berhasil dihapus dari katalog.');
    }
}
