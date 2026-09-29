<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Helper to safely save uploaded files to both public/storage and storage/app/public
     */
    private function saveUploadedFile($file, string $folder): string
    {
        $dir1 = public_path('storage/' . $folder);
        $dir2 = storage_path('app/public/' . $folder);

        if (!file_exists($dir1)) {
            @mkdir($dir1, 0777, true);
        }
        if (!file_exists($dir2)) {
            @mkdir($dir2, 0777, true);
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = Str::random(30) . '.' . $ext;
        $dest1 = $dir1 . '/' . $filename;
        $dest2 = $dir2 . '/' . $filename;

        $file->move($dir1, $filename);
        @copy($dest1, $dest2);
        @chmod($dest1, 0644);
        @chmod($dest2, 0644);

        return '/storage/' . $folder . '/' . $filename;
    }

    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));
        $status = $request->input('status');
        $categoryId = $request->input('category_id');

        $query = Article::with(['category', 'author'])->latest();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        $articles = $query->paginate(10)->withQueryString();
        $categories = ArticleCategory::orderBy('name')->get();

        $stats = [
            'total'     => Article::count(),
            'published' => Article::where('status', 'published')->count(),
            'draft'     => Article::where('status', 'draft')->count(),
            'views'     => Article::sum('views_count'),
        ];

        return view('admin.articles.index', compact('articles', 'categories', 'stats', 'search', 'status', 'categoryId'));
    }

    public function create()
    {
        $categories = ArticleCategory::orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'slug'           => ['nullable', 'string', 'max:255'],
            'category_name'  => ['nullable', 'string', 'max:100'],
            'category_id'    => ['nullable'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'thumbnail'      => ['nullable', 'string'],
            'excerpt'        => ['nullable', 'string', 'max:500'],
            'content'        => ['required', 'string'],
            'status'         => ['required', 'in:published,draft'],
            'is_featured'    => ['nullable', 'boolean'],
            'tags'           => ['nullable', 'string', 'max:255'],
            'published_at'   => ['nullable', 'date'],
        ]);

        // Auto-generate and ensure unique slug
        $baseSlug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        if (empty($baseSlug)) {
            $baseSlug = 'berita-' . time();
        }
        $slug = $baseSlug;
        $counter = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $validated['slug'] = $slug;

        // Auto-find or create category from text input
        $categoryName = trim($request->input('category_name', ''));
        if (!empty($categoryName)) {
            $cat = ArticleCategory::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName), 'order' => 0]
            );
            $validated['category_id'] = $cat->id;
        } elseif ($request->filled('category_id')) {
            $validated['category_id'] = $request->input('category_id');
        } else {
            $cat = ArticleCategory::firstOrCreate(
                ['name' => 'Kabar Penerbitan'],
                ['slug' => 'kabar-penerbitan', 'order' => 0]
            );
            $validated['category_id'] = $cat->id;
        }
        unset($validated['category_name']);

        // Handle Thumbnail Upload
        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = $this->saveUploadedFile($request->file('thumbnail_file'), 'articles/thumbnails');
        }

        // Auto-extract excerpt from content if not provided
        if (empty($validated['excerpt']) && !empty($validated['content'])) {
            $cleanText = trim(preg_replace('/\s+/', ' ', strip_tags($validated['content'])));
            $validated['excerpt'] = Str::limit($cleanText, 180, '...');
        }

        $validated['author_id'] = Auth::id();
        $validated['is_featured'] = $request->has('is_featured');
        $validated['published_at'] = $validated['published_at'] ?? now();

        unset($validated['thumbnail_file']);

        $article = Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = ArticleCategory::orderBy('name')->get();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'slug'           => ['nullable', 'string', 'max:255'],
            'category_name'  => ['nullable', 'string', 'max:100'],
            'category_id'    => ['nullable'],
            'thumbnail_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'thumbnail'      => ['nullable', 'string'],
            'excerpt'        => ['nullable', 'string', 'max:500'],
            'content'        => ['required', 'string'],
            'status'         => ['required', 'in:published,draft'],
            'is_featured'    => ['nullable', 'boolean'],
            'tags'           => ['nullable', 'string', 'max:255'],
            'published_at'   => ['nullable', 'date'],
        ]);

        // Auto-generate and ensure unique slug
        $baseSlug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        if (empty($baseSlug)) {
            $baseSlug = 'berita-' . $article->id;
        }
        $slug = $baseSlug;
        $counter = 1;
        while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $validated['slug'] = $slug;

        // Auto-find or create category from text input
        $categoryName = trim($request->input('category_name', ''));
        if (!empty($categoryName)) {
            $cat = ArticleCategory::firstOrCreate(
                ['name' => $categoryName],
                ['slug' => Str::slug($categoryName), 'order' => 0]
            );
            $validated['category_id'] = $cat->id;
        } elseif ($request->filled('category_id')) {
            $validated['category_id'] = $request->input('category_id');
        }

        unset($validated['category_name']);

        // Auto-extract excerpt from content if not provided
        if (empty($validated['excerpt']) && !empty($validated['content'])) {
            $cleanText = trim(preg_replace('/\s+/', ' ', strip_tags($validated['content'])));
            $validated['excerpt'] = Str::limit($cleanText, 180, '...');
        }

        if ($request->hasFile('thumbnail_file')) {
            $validated['thumbnail'] = $this->saveUploadedFile($request->file('thumbnail_file'), 'articles/thumbnails');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['published_at'] = $validated['published_at'] ?? $article->published_at ?? now();

        unset($validated['thumbnail_file']);

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function toggleStatus($id)
    {
        $article = Article::findOrFail($id);
        $article->status = $article->status === 'published' ? 'draft' : 'published';
        $article->save();

        return redirect()->back()->with('success', 'Status berita berhasil diubah.');
    }

    /**
     * Upload inline image for Rich Text Editor (e.g. Summernote / Custom WYSIWYG)
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $url = $this->saveUploadedFile($request->file('image'), 'articles/content');
            return response()->json([
                'success' => true,
                'url'     => $url,
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Upload gagal'], 400);
    }
}
