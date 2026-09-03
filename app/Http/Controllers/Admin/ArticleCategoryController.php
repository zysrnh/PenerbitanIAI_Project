<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::withCount('articles')->orderBy('order')->get();
        return view('admin.articles.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'slug'        => ['nullable', 'string', 'max:100', 'unique:article_categories,slug'],
            'description' => ['nullable', 'string', 'max:255'],
            'order'       => ['nullable', 'integer'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $validated['order'] = $validated['order'] ?? 0;

        ArticleCategory::create($validated);

        return redirect()->back()->with('success', 'Kategori berita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);

        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'slug'        => ['nullable', 'string', 'max:100', 'unique:article_categories,slug,' . $category->id],
            'description' => ['nullable', 'string', 'max:255'],
            'order'       => ['nullable', 'integer'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->back()->with('success', 'Kategori berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $category = ArticleCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berita berhasil dihapus.');
    }
}
