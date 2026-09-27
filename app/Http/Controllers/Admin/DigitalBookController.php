<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalBook;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DigitalBookController extends Controller
{
    public function index(Request $request)
    {
        $query = DigitalBook::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $search = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $digitalBooks = $query->paginate(12)->withQueryString();
        $totalDigitalBooks = DigitalBook::count();
        $featuredCount = DigitalBook::where('is_featured', true)->count();
        $withPdfCount = DigitalBook::whereNotNull('pdf_file')->count();

        $categories = DigitalBook::select('category')->distinct()->pluck('category');

        return view('admin.digital-books.index', compact(
            'digitalBooks',
            'totalDigitalBooks',
            'featuredCount',
            'withPdfCount',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'year'        => 'required|string|max:10',
            'pages'       => 'required|string|max:50',
            'language'    => 'nullable|string|max:50',
            'synopsis'    => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status'      => 'required|in:published,draft',
            'cover_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:10240',
            'pdf_file'    => 'nullable|file|mimes:pdf|max:102400',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(4);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['language'] = $validated['language'] ?: 'Indonesia';

        // 1. Cover Image Upload
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image');
            $ext = strtolower($cover->getClientOriginalExtension() ?: 'jpg');
            $filename = Str::random(30) . '.' . $ext;
            $relPath = 'digital-books/covers/' . $filename;

            $this->saveFileToAllStorageTargets($cover, $relPath);
            $validated['cover_image'] = $relPath;
        }

        // 2. PDF File Upload
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $pdfName = Str::random(30) . '.pdf';
            $relPdfPath = 'digital-books/pdfs/' . $pdfName;

            $this->saveFileToAllStorageTargets($pdf, $relPdfPath);
            $validated['pdf_file'] = $relPdfPath;
        }

        DigitalBook::create($validated);

        return back()->with('success', 'Buku digital "' . $validated['title'] . '" berhasil ditambahkan.');
    }

    public function update(Request $request, DigitalBook $digitalBook)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'year'        => 'required|string|max:10',
            'pages'       => 'required|string|max:50',
            'language'    => 'nullable|string|max:50',
            'synopsis'    => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'status'      => 'required|in:published,draft',
            'cover_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:10240',
            'pdf_file'    => 'nullable|file|mimes:pdf|max:102400',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['language'] = $validated['language'] ?: 'Indonesia';

        // 1. Cover Image Update
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image');
            $ext = strtolower($cover->getClientOriginalExtension() ?: 'jpg');
            $filename = Str::random(30) . '.' . $ext;
            $relPath = 'digital-books/covers/' . $filename;

            // Delete old cover
            if ($digitalBook->cover_image) {
                $this->deleteFileFromAllStorageTargets($digitalBook->cover_image);
            }

            $this->saveFileToAllStorageTargets($cover, $relPath);
            $validated['cover_image'] = $relPath;
        }

        // 2. PDF File Update
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $pdfName = Str::random(30) . '.pdf';
            $relPdfPath = 'digital-books/pdfs/' . $pdfName;

            // Delete old PDF
            if ($digitalBook->pdf_file) {
                $this->deleteFileFromAllStorageTargets($digitalBook->pdf_file);
            }

            $this->saveFileToAllStorageTargets($pdf, $relPdfPath);
            $validated['pdf_file'] = $relPdfPath;
        } elseif ($request->boolean('remove_pdf')) {
            if ($digitalBook->pdf_file) {
                $this->deleteFileFromAllStorageTargets($digitalBook->pdf_file);
            }
            $validated['pdf_file'] = null;
        }

        $digitalBook->update($validated);

        return back()->with('success', 'Buku digital "' . $digitalBook->title . '" berhasil diperbarui.');
    }

    public function destroy(DigitalBook $digitalBook)
    {
        $title = $digitalBook->title;

        if ($digitalBook->cover_image) {
            if (file_exists(public_path('storage/' . $digitalBook->cover_image))) @unlink(public_path('storage/' . $digitalBook->cover_image));
            if (file_exists(storage_path('app/public/' . $digitalBook->cover_image))) @unlink(storage_path('app/public/' . $digitalBook->cover_image));
        }

        if ($digitalBook->pdf_file) {
            if (file_exists(public_path('storage/' . $digitalBook->pdf_file))) @unlink(public_path('storage/' . $digitalBook->pdf_file));
            if (file_exists(storage_path('app/public/' . $digitalBook->pdf_file))) @unlink(storage_path('app/public/' . $digitalBook->pdf_file));
        }

        $digitalBook->delete();

        return back()->with('success', 'Buku digital "' . $title . '" berhasil dihapus.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids) && $request->filled('ids_json')) {
            $ids = json_decode($request->input('ids_json'), true) ?: [];
        }

        if (empty($ids) || !is_array($ids)) {
            return back()->with('error', 'Tidak ada buku digital yang dipilih.');
        }

        $books = DigitalBook::whereIn('id', $ids)->get();
        $count = $books->count();

        foreach ($books as $b) {
            if ($b->cover_image) {
                if (file_exists(public_path('storage/' . $b->cover_image))) @unlink(public_path('storage/' . $b->cover_image));
                if (file_exists(storage_path('app/public/' . $b->cover_image))) @unlink(storage_path('app/public/' . $b->cover_image));
            }
            if ($b->cover_image) {
                $this->deleteFileFromAllStorageTargets($b->cover_image);
            }
            if ($b->pdf_file) {
                $this->deleteFileFromAllStorageTargets($b->pdf_file);
            }
            $b->delete();
        }

        return back()->with('success', "Berhasil menghapus {$count} buku digital secara massal.");
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
