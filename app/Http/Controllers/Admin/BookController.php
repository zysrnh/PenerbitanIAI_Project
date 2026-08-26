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
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200', // 50MB (Foto 1: Depan)
            'back_cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200', // 50MB (Foto 2: Belakang)
            'inside_preview_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200', // 50MB (Foto 3: Isi)
            'additional_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200', // 50MB (Foto 4: Fisik)
            'sample_pdf' => 'nullable|file|mimes:pdf|max:102400', // 100MB
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Handle 4 Dedicated Image Uploads
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image'];
        foreach ($imageSlots as $slot) {
            if ($request->hasFile($slot)) {
                $validated[$slot] = $request->file($slot)->store('books/photos', 'public');
            }
        }

        // Handle Sample PDF Upload
        if ($request->hasFile('sample_pdf')) {
            $validated['sample_pdf'] = $request->file('sample_pdf')->store('books/samples', 'public');
        }

        Book::create($validated);

        return back()->with('success', 'Buku baru "' . $validated['title'] . '" berhasil ditambahkan dengan foto lengkap.');
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
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200',
            'back_cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200',
            'inside_preview_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200',
            'additional_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:51200',
            'sample_pdf' => 'nullable|file|mimes:pdf|max:102400',
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Handle 4 Image Upload Updates
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image'];
        foreach ($imageSlots as $slot) {
            if ($request->hasFile($slot)) {
                if ($book->$slot && Storage::disk('public')->exists($book->$slot)) {
                    Storage::disk('public')->delete($book->$slot);
                }
                $validated[$slot] = $request->file($slot)->store('books/photos', 'public');
            }
        }

        // Handle Sample PDF Upload Update
        if ($request->hasFile('sample_pdf')) {
            if ($book->sample_pdf && Storage::disk('public')->exists($book->sample_pdf)) {
                Storage::disk('public')->delete($book->sample_pdf);
            }
            $validated['sample_pdf'] = $request->file('sample_pdf')->store('books/samples', 'public');
        }

        $book->update($validated);

        return back()->with('success', 'Data & foto buku "' . $book->title . '" berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image', 'sample_pdf'];
        foreach ($imageSlots as $slot) {
            if ($book->$slot && Storage::disk('public')->exists($book->$slot)) {
                Storage::disk('public')->delete($book->$slot);
            }
        }
        $book->delete();

        return back()->with('success', 'Buku "' . $title . '" beserta foto-fotonya berhasil dihapus.');
    }
}
