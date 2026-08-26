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
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Safe Direct File Move (100% Zero finfo dependency)
        $allowedImgExt = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image'];

        $photoDir = public_path('storage/books/photos');
        if (!file_exists($photoDir)) {
            @mkdir($photoDir, 0755, true);
        }

        foreach ($imageSlots as $slot) {
            if ($request->hasFile($slot)) {
                $file = $request->file($slot);
                $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');

                if (!in_array($ext, $allowedImgExt)) {
                    return back()->withErrors([$slot => 'File foto harus berekstensi JPG, PNG, atau WebP.'])->withInput();
                }

                $filename = Str::random(30) . '.' . $ext;
                $file->move($photoDir, $filename);
                $validated[$slot] = 'books/photos/' . $filename;
            }
        }

        // Safe PDF Upload via move
        if ($request->hasFile('sample_pdf')) {
            $pdfFile = $request->file('sample_pdf');
            $pdfExt = strtolower($pdfFile->getClientOriginalExtension() ?: 'pdf');

            if ($pdfExt !== 'pdf') {
                return back()->withErrors(['sample_pdf' => 'File dokumen sampel harus berformat PDF.'])->withInput();
            }

            $sampleDir = public_path('storage/books/samples');
            if (!file_exists($sampleDir)) {
                @mkdir($sampleDir, 0755, true);
            }

            $pdfName = Str::random(30) . '.pdf';
            $pdfFile->move($sampleDir, $pdfName);
            $validated['sample_pdf'] = 'books/samples/' . $pdfName;
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
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Safe Direct File Move for Updates
        $allowedImgExt = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image'];

        $photoDir = public_path('storage/books/photos');
        if (!file_exists($photoDir)) {
            @mkdir($photoDir, 0755, true);
        }

        foreach ($imageSlots as $slot) {
            if ($request->hasFile($slot)) {
                $file = $request->file($slot);
                $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');

                if (!in_array($ext, $allowedImgExt)) {
                    return back()->withErrors([$slot => 'File foto harus berekstensi JPG, PNG, atau WebP.'])->withInput();
                }

                if ($book->$slot && file_exists(public_path('storage/' . $book->$slot))) {
                    @unlink(public_path('storage/' . $book->$slot));
                }

                $filename = Str::random(30) . '.' . $ext;
                $file->move($photoDir, $filename);
                $validated[$slot] = 'books/photos/' . $filename;
            }
        }

        // Safe PDF Upload Update
        if ($request->hasFile('sample_pdf')) {
            $pdfFile = $request->file('sample_pdf');
            $pdfExt = strtolower($pdfFile->getClientOriginalExtension() ?: 'pdf');

            if ($pdfExt !== 'pdf') {
                return back()->withErrors(['sample_pdf' => 'File dokumen sampel harus berformat PDF.'])->withInput();
            }

            $sampleDir = public_path('storage/books/samples');
            if (!file_exists($sampleDir)) {
                @mkdir($sampleDir, 0755, true);
            }

            if ($book->sample_pdf && file_exists(public_path('storage/' . $book->sample_pdf))) {
                @unlink(public_path('storage/' . $book->sample_pdf));
            }

            $pdfName = Str::random(30) . '.pdf';
            $pdfFile->move($sampleDir, $pdfName);
            $validated['sample_pdf'] = 'books/samples/' . $pdfName;
        }

        $book->update($validated);

        return back()->with('success', 'Data & foto buku "' . $book->title . '" berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image', 'sample_pdf'];
        foreach ($imageSlots as $slot) {
            if ($book->$slot && file_exists(public_path('storage/' . $book->$slot))) {
                @unlink(public_path('storage/' . $book->$slot));
            }
        }
        $book->delete();

        return back()->with('success', 'Buku "' . $title . '" beserta foto-fotonya berhasil dihapus.');
    }
}
