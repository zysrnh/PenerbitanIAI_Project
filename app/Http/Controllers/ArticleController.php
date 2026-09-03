<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display public news and articles listing.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('q', ''));
        $categorySlug = $request->input('kategori');

        $query = Article::with(['category', 'author'])->published();

        // Search Filter
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        // Category Filter
        $currentCategory = null;
        if (!empty($categorySlug)) {
            $currentCategory = ArticleCategory::where('slug', $categorySlug)->first();
            if ($currentCategory) {
                $query->where('category_id', $currentCategory->id);
            }
        }

        $articles = $query->paginate(6)->withQueryString();

        // Sidebar Data
        $categories = ArticleCategory::withCount(['publishedArticles'])->orderBy('order')->get();
        $recentArticles = Article::published()->latest('published_at')->take(5)->get();
        $popularArticles = Article::published()->orderByDesc('views_count')->take(5)->get();

        return view('articles.index', compact(
            'articles',
            'categories',
            'currentCategory',
            'recentArticles',
            'popularArticles',
            'search'
        ));
    }

    /**
     * Display single news/article detail.
     */
    public function show($slug)
    {
        $article = Article::with(['category', 'author'])->where('slug', $slug)->firstOrFail();

        // If draft and not admin, return 404
        if ($article->status !== 'published') {
            if (!Auth::check() || !in_array(Auth::user()->role, ['super_admin', 'admin'])) {
                abort(404);
            }
        }

        // Increment Views Count (Prevent duplicate hit per session)
        $viewedSessionKey = 'viewed_article_' . $article->id;
        if (!session()->has($viewedSessionKey)) {
            $article->increment('views_count');
            session()->put($viewedSessionKey, true);
        }

        // Related Articles
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->when($article->category_id, function ($q) use ($article) {
                $q->where('category_id', $article->category_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedArticles->isEmpty()) {
            $relatedArticles = Article::published()
                ->where('id', '!=', $article->id)
                ->latest('published_at')
                ->take(3)
                ->get();
        }

        // Sidebar Data
        $categories = ArticleCategory::withCount(['publishedArticles'])->orderBy('order')->get();
        $recentArticles = Article::published()->where('id', '!=', $article->id)->latest('published_at')->take(5)->get();

        return view('articles.show', compact(
            'article',
            'relatedArticles',
            'categories',
            'recentArticles'
        ));
    }
}
