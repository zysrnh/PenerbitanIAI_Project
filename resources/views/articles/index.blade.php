@extends('layouts.app')

@section('title', ($currentCategory ? $currentCategory->name . ' - ' : '') . 'Berita & Artikel | PERSIS PERS')

@section('content')
    <style>
        .animate-cascade-up {
            animation: cascadeUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) backwards;
        }
        @keyframes cascadeUp {
            0% { opacity: 0; transform: translateY(18px) scale(0.97); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-fade-in {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Category Nav Links (Identical to Catalog) */
        .cat-link {
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            border-left: 3px solid transparent;
        }
        .cat-link:hover {
            background-color: #ecfdf5;
            color: #047857;
            padding-left: 18px;
            border-left-color: #10b981;
        }
        .cat-active {
            background-color: #047857 !important;
            color: #ffffff !important;
            font-weight: 700;
            border-left-color: #34d399 !important;
            padding-left: 18px;
        }

        /* Signature PERSIS Article Card */
        .persis-article-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 3px;
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .persis-article-card:hover {
            border-color: #047857;
            transform: translateY(-4px);
            box-shadow: 0 16px 30px -8px rgba(4, 120, 87, 0.15), 0 2px 6px rgba(0,0,0,0.04);
        }
    </style>

    <!-- 1. HEADER BANNER WITH ENTRANCE ANIMATION -->
    <section class="bg-brand-950 text-white py-14 sm:py-16 relative overflow-hidden border-b border-brand-900 animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-cascade-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">
                {{ $settings['news_banner_badge'] }}
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-heading tracking-tight">
                {{ $currentCategory ? $currentCategory->name : $settings['news_banner_title'] }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                {{ $currentCategory ? ($currentCategory->description ?: 'Kumpulan artikel, rilis publikasi, dan berita seputar ' . $currentCategory->name) : $settings['news_banner_desc'] }}
            </p>
        </div>
    </section>

    <!-- 2. 4 QUICK STATS CARDS OVERLAP WITH STAGGERED ENTRANCE -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5 animate-cascade-up" style="animation-delay: 50ms;">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Total Publikasi</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['news_stat_total'] }}</p>
                    <span class="text-[11px] text-slate-400 block">Warta &amp; liputan resmi</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5 animate-cascade-up" style="animation-delay: 100ms;">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-folder-tree"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Topik Kategori</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['news_stat_categories'] }}</p>
                    <span class="text-[11px] text-slate-400 block">Kabar, tips &amp; literasi</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5 animate-cascade-up" style="animation-delay: 150ms;">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-glasses"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Jangkauan Literasi</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['news_stat_views'] }}</p>
                    <span class="text-[11px] text-slate-400 block">Akses pembaca nasional</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5 animate-cascade-up" style="animation-delay: 200ms;">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Redaksi &amp; Penulis</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['news_stat_authors'] }}</p>
                    <span class="text-[11px] text-slate-400 block">Karya ilmiah &amp; pemikiran</span>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. MAIN CONTENT: SIDEBAR LEFT (3 COLS) + ARTICLES RIGHT (9 COLS) -->
    <section class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- LEFT SIDEBAR (3 COLS) -->
                <div class="lg:col-span-3 space-y-6 animate-cascade-up" style="animation-delay: 100ms;">
                    
                    <!-- Search Widget -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-sm">
                        <form action="{{ route('berita.index') }}" method="GET" class="relative">
                            @if($currentCategory)
                                <input type="hidden" name="kategori" value="{{ $currentCategory->slug }}" />
                            @endif
                            <input 
                                type="text" 
                                name="q" 
                                value="{{ $search }}" 
                                placeholder="Cari berita atau artikel..." 
                                class="w-full pl-8 pr-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-500 font-medium transition"
                            />
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        </form>
                    </div>

                    <!-- KATEGORI WIDGET -->
                    <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                        <div class="bg-brand-950 text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center justify-between border-b border-brand-900">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ul text-emerald-400"></i> Kategori Berita
                            </span>
                        </div>

                        <div class="divide-y divide-slate-100 text-xs">
                            <a 
                                href="{{ route('berita.index') }}" 
                                class="cat-link block px-4 py-2.5 text-slate-700 hover:text-emerald-700 font-medium {{ empty($currentCategory) ? 'cat-active' : '' }}"
                            >
                                <div class="flex items-center justify-between">
                                    <span>Semua Topik</span>
                                    <span class="text-[10.5px] opacity-80 font-mono">{{ $categories->sum('published_articles_count') }}</span>
                                </div>
                            </a>

                            @foreach($categories as $cat)
                                <a 
                                    href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" 
                                    class="cat-link block px-4 py-2.5 text-slate-700 hover:text-emerald-700 font-medium {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'cat-active' : '' }}"
                                >
                                    <div class="flex items-center justify-between">
                                        <span class="truncate pr-2">{{ $cat->name }}</span>
                                        <span class="text-[10.5px] opacity-80 font-mono shrink-0">{{ $cat->published_articles_count }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- WIDGET BERITA POPULER -->
                    @if($popularArticles->count() > 0)
                    <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                        <div class="bg-brand-950 text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center justify-between border-b border-brand-900">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-fire text-amber-400"></i> Berita Populer
                            </span>
                        </div>

                        <div class="p-3.5 space-y-3 divide-y divide-slate-100">
                            @foreach($popularArticles as $pop)
                                <a href="{{ route('berita.show', $pop->slug) }}" class="pt-2.5 first:pt-0 flex gap-2.5 group items-start">
                                    <div class="w-14 h-11 rounded-xs overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                        <img src="{{ $pop->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=200&auto=format&fit=crop' }}" alt="{{ $pop->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                                    </div>
                                    <div class="min-w-0 flex-1 space-y-0.5">
                                        <h4 class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                            {{ $pop->title }}
                                        </h4>
                                        <span class="text-[10px] text-slate-400 block font-mono">
                                            {{ $pop->published_at ? $pop->published_at->format('d M Y') : '' }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- PROMO AJAKAN REDAKSI (Matching Catalog Publish Box) -->
                    <div class="bg-brand-950 text-white p-5 rounded-sm border border-brand-900 shadow-md relative overflow-hidden text-center space-y-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-lg mx-auto">
                            <i class="fa-solid fa-book-bookmark"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-extrabold text-white font-heading">
                                {{ $settings['news_promo_title'] }}
                            </h4>
                            <p class="text-xs text-slate-300 mt-1.5 leading-relaxed">
                                {{ $settings['news_promo_desc'] }}
                            </p>
                        </div>
                        <a href="{{ route('kontak') }}" class="block w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold uppercase tracking-wider rounded-xs transition shadow-xs">
                            Hubungi Redaksi
                        </a>
                    </div>

                </div>

                <!-- RIGHT MAIN CONTENT (9 COLS) -->
                <div class="lg:col-span-9 space-y-6">
                    
                    <!-- Top Bar: Filter Status & Result Count -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-sm flex items-center justify-between flex-wrap gap-2 text-xs">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-slate-800">
                                @if($currentCategory)
                                    Topik: <span class="text-emerald-700">{{ $currentCategory->name }}</span>
                                @elseif(!empty($search))
                                    Hasil Pencarian: <span class="text-emerald-700">"{{ $search }}"</span>
                                @else
                                    Semua Berita &amp; Artikel
                                @endif
                            </span>
                            <span class="text-slate-400">&bull;</span>
                            <span class="text-slate-500 font-mono text-[11px]">{{ $articles->total() }} Publikasi</span>
                        </div>

                        @if(!empty($search) || $currentCategory)
                            <a href="{{ route('berita.index') }}" class="text-[11px] font-bold text-rose-600 hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-rotate-left text-[9px]"></i> Reset Filter
                            </a>
                        @endif
                    </div>

                    <!-- Articles Grid (2 Cols on Desktop) -->
                    @if($articles->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($articles as $article)
                                <article class="persis-article-card overflow-hidden group">
                                    <div>
                                        <!-- Thumbnail Frame (16:9 Aspect) -->
                                        <a href="{{ route('berita.show', $article->slug) }}" class="block aspect-[16/9] overflow-hidden bg-slate-100 relative">
                                            <img 
                                                src="{{ $article->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=600&auto=format&fit=crop' }}" 
                                                alt="{{ $article->title }}" 
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                                loading="lazy"
                                            />
                                            @if($article->category)
                                                <span class="absolute top-2.5 left-2.5 px-2.5 py-1 bg-brand-950/90 backdrop-blur-xs text-emerald-400 text-[10px] font-bold uppercase tracking-wider rounded-xs border border-emerald-500/30 shadow-xs">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                        </a>

                                        <!-- Content Body -->
                                        <div class="p-4 sm:p-5 space-y-2.5">
                                            <!-- Meta date & reading time -->
                                            <div class="flex items-center gap-2.5 text-[11px] text-slate-400">
                                                <span class="flex items-center gap-1 font-mono">
                                                    <i class="fa-regular fa-calendar text-[10px] text-emerald-700"></i>
                                                    {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                                                </span>
                                                <span>&bull;</span>
                                                <span class="flex items-center gap-1">
                                                    <i class="fa-regular fa-clock text-[10px]"></i>
                                                    {{ $article->reading_time }} mnt baca
                                                </span>
                                            </div>

                                            <!-- Title -->
                                            <h2 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                                <a href="{{ route('berita.show', $article->slug) }}">
                                                    {{ $article->title }}
                                                </a>
                                            </h2>

                                            <!-- Excerpt -->
                                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-3">
                                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 120) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Footer Card Action -->
                                    <div class="px-4 sm:px-5 pb-4 sm:pb-5 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                                        <a href="{{ route('berita.show', $article->slug) }}" class="font-bold text-emerald-800 group-hover:text-emerald-950 transition flex items-center gap-1">
                                            <span>Baca Selengkapnya</span>
                                            <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition"></i>
                                        </a>
                                        <span class="text-[11px] text-slate-400 flex items-center gap-1 font-mono">
                                            <i class="fa-regular fa-eye text-[10px]"></i>
                                            {{ number_format($article->views_count, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($articles->hasPages())
                            <div class="pt-6 flex justify-center">
                                {{ $articles->links() }}
                            </div>
                        @endif
                    @else
                        <!-- Empty State Box -->
                        <div class="bg-white p-12 text-center rounded-sm border border-slate-200 shadow-sm space-y-3">
                            <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center mx-auto text-2xl">
                                <i class="fa-regular fa-newspaper"></i>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 font-heading">Tidak Ada Berita Ditemukan</h3>
                            <p class="text-xs text-slate-500 max-w-sm mx-auto">
                                @if(!empty($search))
                                    Tidak ada artikel yang cocok dengan kata kunci "{{ $search }}". Silakan gunakan kata kunci lain.
                                @else
                                    Belum ada artikel yang diterbitkan pada topik ini.
                                @endif
                            </p>
                            <a href="{{ route('berita.index') }}" class="inline-block px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-sm uppercase tracking-wider transition">
                                Lihat Semua Berita
                            </a>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </section>
@endsection
