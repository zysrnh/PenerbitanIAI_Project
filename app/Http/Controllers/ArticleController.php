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

        // Featured Headlines for News Portal Hero Section
        $headlineArticle = null;
        $secondaryHeadlines = collect([]);
        if (empty($search) && empty($categorySlug) && (int) $request->input('page', 1) === 1) {
            $headlineArticle = Article::with(['category', 'author'])
                ->published()
                ->where('is_featured', true)
                ->latest('published_at')
                ->first();

            if (!$headlineArticle) {
                $headlineArticle = Article::with(['category', 'author'])
                    ->published()
                    ->latest('published_at')
                    ->first();
            }

            if ($headlineArticle) {
                $secondaryHeadlines = Article::with(['category', 'author'])
                    ->published()
                    ->where('id', '!=', $headlineArticle->id)
                    ->latest('published_at')
                    ->take(2)
                    ->get();
            }
        }

        // Settings for Banner & Promo
        $settings = [
            'news_banner_badge' => \App\Models\SiteSetting::get('news_banner_badge', 'WARNA LITERASI & WARTA'),
            'news_banner_title' => \App\Models\SiteSetting::get('news_banner_title', 'Kabar & Artikel Penerbitan'),
            'news_banner_desc'  => \App\Models\SiteSetting::get('news_banner_desc', 'Temukan warta kegiatan, tips penulisan buku ber-ISBN, agenda workshop, serta pemikiran literasi Islam dari Penerbit Persis.'),
            'news_promo_title'  => \App\Models\SiteSetting::get('news_promo_title', 'Punya Naskah Buku Sendiri?'),
            'news_promo_desc'   => \App\Models\SiteSetting::get('news_promo_desc', 'Konsultasikan naskah ilmiah, modul, atau buku keislaman Anda bersama tim profesional Penerbit Persis.'),
        ];

        // Sidebar Data
        $categories = ArticleCategory::withCount(['publishedArticles'])->orderBy('order')->get();
        $recentArticles = Article::published()->latest('published_at')->take(5)->get();
        $popularArticles = Article::published()->orderByDesc('views_count')->take(5)->get();

        return view('articles.index', compact(
            'articles',
            'categories',
            'currentCategory',
            'headlineArticle',
            'secondaryHeadlines',
            'recentArticles',
            'popularArticles',
            'search',
            'settings'
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

        $settings = [
            'news_promo_title' => \App\Models\SiteSetting::get('news_promo_title', 'Ingin Menerbitkan Buku Anda?'),
            'news_promo_desc'  => \App\Models\SiteSetting::get('news_promo_desc', 'Konsultasikan naskah ilmiah, modul, atau buku keislaman Anda bersama tim profesional Penerbit Persis.'),
        ];

        return view('articles.show', compact(
            'article',
            'relatedArticles',
            'categories',
            'recentArticles',
            'settings'
        ));
    }
}
