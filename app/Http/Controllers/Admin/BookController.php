<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $search = $search ? str_replace(['%', '_'], ['\%', '\_'], $search) : null;
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

    public function create()
    {
        return redirect()->route('admin.books.index', ['open_create' => 1]);
    }

    public function show(Book $book)
    {
        return redirect()->route('admin.books.index', ['search' => $book->title]);
    }

    public function edit(Book $book)
    {
        return redirect()->route('admin.books.index', ['open_edit' => $book->id]);
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
            'size' => 'nullable|string|max:100',
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

        // Safe Direct File Move across all storage targets
        $allowedImgExt = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image'];

        foreach ($imageSlots as $slot) {
            if ($request->hasFile($slot)) {
                $file = $request->file($slot);
                $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');

                if (!in_array($ext, $allowedImgExt)) {
                    return back()->withErrors([$slot => 'File foto harus berekstensi JPG, PNG, atau WebP.'])->withInput();
                }

                $filename = Str::random(30) . '.' . $ext;
                $relPath = 'books/photos/' . $filename;

                $this->saveFileToAllStorageTargets($file, $relPath);
                $validated[$slot] = $relPath;
            }
        }

        // Safe PDF Upload via multi-target storage
        if ($request->hasFile('sample_pdf')) {
            $pdfFile = $request->file('sample_pdf');
            $pdfExt = strtolower($pdfFile->getClientOriginalExtension() ?: 'pdf');

            if ($pdfExt !== 'pdf') {
                return back()->withErrors(['sample_pdf' => 'File dokumen buku/sampel harus berformat PDF.'])->withInput();
            }

            $pdfName = Str::random(30) . '.pdf';
            $relPdfPath = 'books/samples/' . $pdfName;

            $this->saveFileToAllStorageTargets($pdfFile, $relPdfPath);
            $validated['sample_pdf'] = $relPdfPath;
        }

        Book::create($validated);

        return back()->with('success', 'Buku baru "' . $validated['title'] . '" berhasil ditambahkan.');
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
            'size' => 'nullable|string|max:100',
            'format' => 'required|string|max:100',
            'price' => 'required|string|max:50',
            'synopsis' => 'nullable|string',
            'is_new_release' => 'nullable|boolean',
            'is_best_seller' => 'nullable|boolean',
            'status' => 'required|in:published,draft',
        ]);

        $validated['is_new_release'] = $request->has('is_new_release');
        $validated['is_best_seller'] = $request->has('is_best_seller');

        // Safe Direct File Move for Updates with multi-target storage
        $allowedImgExt = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image'];

        foreach ($imageSlots as $slot) {
            if ($request->hasFile($slot)) {
                $file = $request->file($slot);
                $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');

                if (!in_array($ext, $allowedImgExt)) {
                    return back()->withErrors([$slot => 'File foto harus berekstensi JPG, PNG, atau WebP.'])->withInput();
                }

                if ($book->$slot) {
                    $this->deleteFileFromAllStorageTargets($book->$slot);
                }

                $filename = Str::random(30) . '.' . $ext;
                $relPath = 'books/photos/' . $filename;

                $this->saveFileToAllStorageTargets($file, $relPath);
                $validated[$slot] = $relPath;
            }
        }

        // Safe PDF Upload Update (multi-target storage path)
        if ($request->hasFile('sample_pdf')) {
            $pdfFile = $request->file('sample_pdf');
            $pdfExt = strtolower($pdfFile->getClientOriginalExtension() ?: 'pdf');

            if ($pdfExt !== 'pdf') {
                return back()->withErrors(['sample_pdf' => 'File dokumen buku/sampel harus berformat PDF.'])->withInput();
            }

            if ($book->sample_pdf) {
                $this->deleteFileFromAllStorageTargets($book->sample_pdf);
            }

            $pdfName = Str::random(30) . '.pdf';
            $relPdfPath = 'books/samples/' . $pdfName;

            $this->saveFileToAllStorageTargets($pdfFile, $relPdfPath);
            $validated['sample_pdf'] = $relPdfPath;
        } elseif ($request->boolean('remove_sample_pdf')) {
            if ($book->sample_pdf) {
                $this->deleteFileFromAllStorageTargets($book->sample_pdf);
            }
            $validated['sample_pdf'] = null;
        }

        $book->update($validated);

        return back()->with('success', 'Data buku "' . $book->title . '" berhasil diperbarui.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids) && $request->filled('ids_json')) {
            $ids = json_decode($request->input('ids_json'), true) ?: [];
        }

        if (empty($ids) || !is_array($ids)) {
            return back()->with('error', 'Tidak ada buku yang dipilih untuk dihapus.');
        }

        $books = Book::whereIn('id', $ids)->get();
        $count = $books->count();
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image', 'sample_pdf'];

        foreach ($books as $book) {
            foreach ($imageSlots as $slot) {
                if ($book->$slot) {
                    $this->deleteFileFromAllStorageTargets($book->$slot);
                }
            }
            $book->delete();
        }

        return back()->with('success', "Berhasil menghapus {$count} buku terpilih secara massal beserta seluruh file fotonya.");
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $imageSlots = ['cover_image', 'back_cover_image', 'inside_preview_image', 'additional_image', 'sample_pdf'];
        foreach ($imageSlots as $slot) {
            if ($book->$slot) {
                $this->deleteFileFromAllStorageTargets($book->$slot);
            }
        }
        $book->delete();

        return back()->with('success', 'Buku "' . $title . '" beserta file-filenya berhasil dihapus.');
    }

    /**
     * Helper to get all candidate storage directories across local & cPanel hosting environments.
     */
    protected function getStorageBaseDirs(): array
    {
        return array_unique([
            public_path('storage'),
            storage_path('app/public'),
            base_path('public_html/storage'),
            base_path('../public_html/storage'),
            '/home/persisp1/public_html/storage',
        ]);
    }

    /**
     * Save an uploaded file across all existing storage directories.
     */
    protected function saveFileToAllStorageTargets($file, string $relativePath): void
    {
        $firstSaved = null;

        foreach ($this->getStorageBaseDirs() as $baseDir) {
            try {
                $fullTarget = $baseDir . '/' . $relativePath;
                $targetDir = dirname($fullTarget);

                if (!file_exists($targetDir)) {
                    @mkdir($targetDir, 0777, true);
                }

                if (!$firstSaved) {
                    $file->move($targetDir, basename($fullTarget));
                    $firstSaved = $fullTarget;
                } else {
                    @copy($firstSaved, $fullTarget);
                }

                @chmod($fullTarget, 0644);
            } catch (\Throwable $e) {
                // Ignore inaccessible paths
            }
        }
    }

    /**
     * Delete a relative file path across all candidate storage directories.
     */
    protected function deleteFileFromAllStorageTargets(string $relativePath): void
    {
        foreach ($this->getStorageBaseDirs() as $baseDir) {
            $path = $baseDir . '/' . $relativePath;
            if (file_exists($path) && !is_dir($path)) {
                @unlink($path);
            }
        }
    }
}
