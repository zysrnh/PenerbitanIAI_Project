@extends('layouts.app')

@section('title', ($currentCategory ? $currentCategory->name . ' - ' : '') . 'Berita & Artikel | PERSIS PERS')

@section('content')
    <style>
        .editorial-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .editorial-card:hover {
            border-color: #006830;
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -8px rgba(0, 104, 48, 0.15);
        }
        .rank-badge-1 { background-color: #f59e0b; color: #ffffff; }
        .rank-badge-2 { background-color: #006830; color: #ffffff; }
        .rank-badge-3 { background-color: #0284c7; color: #ffffff; }
        .rank-badge-other { background-color: #f1f5f9; color: #475569; }
    </style>

    <!-- 1. EDITORIAL HEADER BANNER -->
    <section class="bg-brand-950 text-white py-10 sm:py-14 border-b border-brand-900 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-5">
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold text-emerald-400 uppercase tracking-widest">
                    <i class="fa-regular fa-newspaper"></i>
                    <span>{{ $settings['news_banner_badge'] }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black font-heading tracking-tight text-white leading-tight">
                    {{ $currentCategory ? $currentCategory->name : $settings['news_banner_title'] }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
                    {{ $currentCategory ? ($currentCategory->description ?: 'Kumpulan artikel, rilis publikasi, dan berita seputar ' . $currentCategory->name) : $settings['news_banner_desc'] }}
                </p>
            </div>

            <!-- Header Quick Search -->
            <div class="w-full md:w-80 shrink-0">
                <form action="{{ route('berita.index') }}" method="GET" class="relative">
                    @if($currentCategory)
                        <input type="hidden" name="kategori" value="{{ $currentCategory->slug }}" />
                    @endif
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ $search }}" 
                        placeholder="Cari berita atau artikel..." 
                        class="w-full pl-9 pr-4 py-2.5 text-xs rounded-sm border border-brand-800 bg-black/40 text-white placeholder-slate-400 focus:outline-hidden focus:border-emerald-400 focus:bg-black/60 transition"
                    />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400 pointer-events-none"></i>
                </form>
            </div>
        </div>
    </section>

    <!-- 2. HORIZONTAL EDITORIAL TOPIC TABS BAR -->
    <nav class="bg-white border-b border-slate-200 sticky top-16 sm:top-20 z-30 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between overflow-x-auto py-2.5 gap-2 scrollbar-none">
            <div class="flex items-center gap-2 shrink-0 text-xs">
                <span class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider mr-1 hidden sm:inline">Topik:</span>
                
                <a href="{{ route('berita.index') }}" class="px-3.5 py-1.5 rounded-full font-bold transition {{ empty($currentCategory) ? 'bg-[#006830] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua Warta
                </a>

                @foreach($categories as $cat)
                    <a href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" class="px-3.5 py-1.5 rounded-full font-bold transition {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'bg-[#006830] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $cat->name }} <span class="opacity-75 text-[10px]">({{ $cat->published_articles_count }})</span>
                    </a>
                @endforeach
            </div>

            @if(!empty($search) || $currentCategory)
                <a href="{{ route('berita.index') }}" class="text-[11px] font-bold text-rose-600 hover:underline flex items-center gap-1 shrink-0">
                    <i class="fa-solid fa-rotate-left text-[9px]"></i> Reset Filter
                </a>
            @endif
        </div>
    </nav>

    <!-- 3. MAIN PORTAL CONTENT -->
    <main class="bg-slate-50 py-8 sm:py-10 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- A. FEATURED EDITORIAL HEADLINE GRID (Only on main page without active filter) -->
            @if(empty($search) && empty($currentCategory) && isset($headlineArticle) && $headlineArticle)
                <section class="space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                        <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-xs bg-[#006830]"></span>
                            <span>Berita Utama &amp; Sorotan</span>
                        </span>
                        <span class="text-[11px] text-slate-400 font-mono">Pilihan Redaksi PERSIS</span>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                        
                        <!-- Big Lead Headline Card (7 Cols) -->
                        <div class="lg:col-span-7 bg-white rounded-sm border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between group">
                            <a href="{{ route('berita.show', $headlineArticle->slug) }}" class="block aspect-[16/10] overflow-hidden bg-slate-900 relative">
                                <img 
                                    src="{{ $headlineArticle->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=800&auto=format&fit=crop' }}" 
                                    alt="{{ $headlineArticle->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-95" 
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                <span class="absolute top-3.5 left-3.5 px-3 py-1 bg-amber-500 text-slate-950 font-black text-[10px] uppercase tracking-wider rounded-xs shadow-md">
                                    <i class="fa-solid fa-star text-[9px] mr-1"></i> HEADLINE UTAMA
                                </span>
                                <div class="absolute bottom-4 left-4 right-4 text-white space-y-1">
                                    <div class="flex items-center gap-2 text-[11px] text-slate-300 font-mono">
                                        <span>{{ $headlineArticle->published_at ? $headlineArticle->published_at->format('d M Y') : '' }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $headlineArticle->reading_time }} mnt baca</span>
                                    </div>
                                    <h2 class="text-base sm:text-xl font-bold font-heading text-white group-hover:text-lime-300 transition leading-snug">
                                        {{ $headlineArticle->title }}
                                    </h2>
                                </div>
                            </a>
                            <div class="p-5 space-y-3">
                                <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                                    {{ $headlineArticle->excerpt ?: Str::limit(strip_tags($headlineArticle->content), 140) }}
                                </p>
                                <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                                    <span class="text-slate-500 font-medium flex items-center gap-1.5">
                                        <i class="fa-regular fa-user text-emerald-700"></i>
                                        {{ $headlineArticle->author->name ?? 'Redaksi Persis' }}
                                    </span>
                                    <a href="{{ route('berita.show', $headlineArticle->slug) }}" class="font-bold text-[#006830] group-hover:text-emerald-800 transition flex items-center gap-1">
                                        <span>Baca Artikel</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- 2 Secondary Stacked Headlines (5 Cols) -->
                        <div class="lg:col-span-5 flex flex-col justify-between gap-5">
                            @forelse($secondaryHeadlines as $sec)
                                <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition p-4 flex flex-col justify-between flex-1 group">
                                    <div class="flex gap-4 items-start">
                                        <a href="{{ route('berita.show', $sec->slug) }}" class="w-32 sm:w-36 aspect-[4/3] rounded-xs overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                            <img 
                                                src="{{ $sec->thumbnail ?: 'https://images.unsplash.com/photo-1532012164546-f432f2e3edd4?q=80&w=400&auto=format&fit=crop' }}" 
                                                alt="{{ $sec->title }}" 
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300" 
                                            />
                                        </a>
                                        <div class="min-w-0 flex-1 space-y-1.5">
                                            @if($sec->category)
                                                <span class="inline-block text-[9.5px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-xs uppercase tracking-wider">
                                                    {{ $sec->category->name }}
                                                </span>
                                            @endif
                                            <h3 class="font-bold text-xs sm:text-sm text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                                <a href="{{ route('berita.show', $sec->slug) }}">{{ $sec->title }}</a>
                                            </h3>
                                            <div class="flex items-center gap-2 text-[10.5px] text-slate-400 font-mono">
                                                <span>{{ $sec->published_at ? $sec->published_at->format('d M Y') : '' }}</span>
                                                <span>&bull;</span>
                                                <span>{{ $sec->reading_time }} mnt</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                        <span class="text-[11px] text-slate-500 truncate max-w-[150px]">{{ $sec->author->name ?? 'Redaksi' }}</span>
                                        <a href="{{ route('berita.show', $sec->slug) }}" class="font-bold text-[#006830] text-xs flex items-center gap-1 group-hover:underline">
                                            <span>Selengkapnya</span>
                                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-white p-6 rounded-sm border border-slate-200 text-center flex-1 flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-regular fa-newspaper text-2xl text-slate-300"></i>
                                    <span class="text-xs text-slate-500">Artikel pilihan lainnya akan segera hadir.</span>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </section>
            @endif

            <!-- B. MAIN EDITORIAL STREAM & SIDEBAR (8 COLS + 4 COLS) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: ARTICLE FEED (8 COLS) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <div class="flex items-center justify-between border-b border-slate-200 pb-2.5">
                        <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-regular fa-clock text-[#006830]"></i>
                            <span>
                                @if($currentCategory)
                                    Topik: {{ $currentCategory->name }}
                                @elseif(!empty($search))
                                    Hasil Pencarian: "{{ $search }}"
                                @else
                                    Warta &amp; Artikel Terkini
                                @endif
                            </span>
                        </span>
                        <span class="text-[11px] text-slate-500 font-mono">{{ $articles->total() }} Artikel</span>
                    </div>

                    @if($articles->count() > 0)
                        <!-- 2-Column Editorial News Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @foreach($articles as $article)
                                <article class="editorial-card overflow-hidden flex flex-col justify-between group">
                                    <div>
                                        <!-- Cover Thumbnail -->
                                        <a href="{{ route('berita.show', $article->slug) }}" class="block aspect-[16/10] overflow-hidden bg-slate-100 relative">
                                            <img 
                                                src="{{ $article->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=600&auto=format&fit=crop' }}" 
                                                alt="{{ $article->title }}" 
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-400" 
                                                loading="lazy"
                                            />
                                            @if($article->category)
                                                <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 bg-[#006830]/90 backdrop-blur-xs text-white text-[9.5px] font-bold uppercase tracking-wider rounded-xs shadow-xs">
                                                    {{ $article->category->name }}
                                                </span>
                                            @endif
                                        </a>

                                        <!-- Card Body -->
                                        <div class="p-4 sm:p-5 space-y-2">
                                            <!-- Meta row -->
                                            <div class="flex items-center gap-2 text-[10.5px] text-slate-400 font-mono">
                                                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</span>
                                                <span>&bull;</span>
                                                <span class="font-sans">{{ $article->reading_time }} mnt baca</span>
                                            </div>

                                            <!-- Headline Title -->
                                            <h3 class="font-bold text-sm sm:text-base text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                                <a href="{{ route('berita.show', $article->slug) }}">{{ $article->title }}</a>
                                            </h3>

                                            <!-- Excerpt -->
                                            <p class="text-xs text-slate-600 leading-relaxed line-clamp-2">
                                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 100) }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Author byline & Read More -->
                                    <div class="px-4 sm:px-5 pb-4 sm:pb-5 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                                        <div class="flex items-center gap-1.5 text-slate-500 text-[11px] truncate max-w-[130px]">
                                            <i class="fa-regular fa-user text-emerald-700 text-[10px]"></i>
                                            <span class="truncate">{{ $article->author->name ?? 'Redaksi' }}</span>
                                        </div>
                                        <a href="{{ route('berita.show', $article->slug) }}" class="font-bold text-[#006830] group-hover:text-emerald-900 transition flex items-center gap-1 text-xs shrink-0">
                                            <span>Baca</span>
                                            <i class="fa-solid fa-arrow-right text-[9px] transform group-hover:translate-x-1 transition"></i>
                                        </a>
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
                        <div class="bg-white p-12 text-center rounded-sm border border-slate-200 shadow-xs space-y-3">
                            <div class="w-14 h-14 bg-emerald-50 text-emerald-700 rounded-full flex items-center justify-center mx-auto text-xl">
                                <i class="fa-regular fa-newspaper"></i>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 font-heading">Belum Ada Berita</h3>
                            <p class="text-xs text-slate-500 max-w-sm mx-auto">
                                @if(!empty($search))
                                    Tidak ditemukan berita yang cocok dengan kata kunci "{{ $search }}".
                                @else
                                    Belum ada artikel yang dipublikasikan pada kategori ini.
                                @endif
                            </p>
                            <a href="{{ route('berita.index') }}" class="inline-block px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm uppercase tracking-wider transition">
                                Lihat Semua Berita
                            </a>
                        </div>
                    @endif

                </div>

                <!-- RIGHT COLUMN: DISTINCTIVE EDITORIAL SIDEBAR (4 COLS) -->
                <aside class="lg:col-span-4 space-y-6">

                    <!-- 1. Top 5 Berita Populer (Numbered Ranking #1 - #5) -->
                    @if($popularArticles->count() > 0)
                        <div class="bg-white rounded-sm border border-slate-200 shadow-xs overflow-hidden">
                            <div class="p-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                                <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fa-solid fa-fire text-amber-500"></i>
                                    <span>Paling Banyak Dibaca</span>
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">Trending</span>
                            </div>

                            <div class="p-4 divide-y divide-slate-100">
                                @foreach($popularArticles as $index => $pop)
                                    <a href="{{ route('berita.show', $pop->slug) }}" class="py-3 first:pt-0 last:pb-0 flex items-start gap-3 group">
                                        <!-- Rank Number -->
                                        <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-black shrink-0 {{ $index === 0 ? 'rank-badge-1' : ($index === 1 ? 'rank-badge-2' : ($index === 2 ? 'rank-badge-3' : 'rank-badge-other')) }}">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="min-w-0 flex-1 space-y-1">
                                            <h4 class="font-bold text-xs text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                                {{ $pop->title }}
                                            </h4>
                                            <div class="flex items-center gap-2 text-[10px] text-slate-400 font-mono">
                                                <span>{{ $pop->published_at ? $pop->published_at->format('d M Y') : '' }}</span>
                                                <span>&bull;</span>
                                                <span class="text-emerald-700 font-bold">{{ number_format($pop->views_count, 0, ',', '.') }} views</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- 2. Kotak Ajakan Kirim Naskah / Kolom Penulis -->
                    <div class="bg-gradient-to-br from-[#006830] to-[#032c21] text-white p-6 rounded-sm shadow-md text-center space-y-3.5 relative overflow-hidden">
                        <div class="w-12 h-12 rounded-full bg-lime-400 text-slate-950 flex items-center justify-center mx-auto text-lg shadow-sm">
                            <i class="fa-solid fa-pen-nib"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold text-lime-300 uppercase tracking-widest block">KOLOM PENULIS &amp; AKADEMISI</span>
                            <h4 class="font-extrabold text-sm sm:text-base text-white mt-1">
                                {{ $settings['news_promo_title'] ?? 'Punya Naskah Buku Sendiri?' }}
                            </h4>
                            <p class="text-xs text-slate-200 mt-1.5 leading-relaxed">
                                {{ $settings['news_promo_desc'] ?? 'Dukung publikasi karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.' }}
                            </p>
                        </div>
                        <a href="{{ route('kontak') }}" class="block w-full py-2.5 bg-lime-400 hover:bg-lime-500 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xs transition shadow-sm">
                            Konsultasi / Kirim Naskah
                        </a>
                    </div>

                    <!-- 3. Kategori Berita Quick List -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-xs p-4 space-y-3">
                        <span class="font-extrabold text-xs text-slate-900 uppercase tracking-wider block pb-2 border-b border-slate-100 flex items-center gap-1.5">
                            <i class="fa-solid fa-tags text-emerald-700"></i>
                            <span>Kategori Literasi</span>
                        </span>

                        <div class="space-y-1 text-xs">
                            @foreach($categories as $cat)
                                <a href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" class="flex items-center justify-between py-1.5 px-2 rounded-xs hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 transition font-medium">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-[10px] font-bold px-1.5 py-0.5 bg-slate-100 text-slate-600 rounded-xs font-mono">
                                        {{ $cat->published_articles_count }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </aside>

            </div>

        </div>
    </main>
@endsection
