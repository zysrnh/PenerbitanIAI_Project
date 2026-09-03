@extends('layouts.app')

@section('title', ($currentCategory ? $currentCategory->name . ' - ' : '') . 'Berita & Artikel - Penerbit Persis')

@section('content')
<main class="bg-slate-50 min-h-screen py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 sm:space-y-10">

        <!-- Page Header Banner -->
        <div class="bg-gradient-to-r from-[#006830] via-[#032c21] to-[#021f17] text-white p-6 sm:p-10 rounded-sm border border-emerald-900 shadow-md relative overflow-hidden">
            <div class="relative z-10 max-w-2xl space-y-2">
                <div class="flex items-center gap-2 text-xs text-emerald-300 font-bold uppercase tracking-wider">
                    <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
                    <i class="fa-solid fa-chevron-right text-[8px]"></i>
                    <span>Berita &amp; Artikel</span>
                    @if($currentCategory)
                        <i class="fa-solid fa-chevron-right text-[8px]"></i>
                        <span class="text-white">{{ $currentCategory->name }}</span>
                    @endif
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black tracking-tight font-heading leading-tight">
                    {{ $currentCategory ? $currentCategory->name : 'Kabar & Artikel Penerbitan' }}
                </h1>
                <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed max-w-xl">
                    {{ $currentCategory ? ($currentCategory->description ?: 'Kumpulan artikel dan warta seputar ' . $currentCategory->name) : 'Temukan informasi terbaru, panduan penulisan ilmiah & keislaman, agenda literasi, serta kabar terkini dari Penerbit Persis.' }}
                </p>
            </div>
            <div class="absolute -right-10 -bottom-10 opacity-10 text-white pointer-events-none text-9xl">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <!-- Main Layout: Articles (8 Cols) + Sidebar (4 Cols) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: ARTICLES LISTING (8 COLS) -->
            <div class="lg:col-span-8 space-y-6">

                <!-- Filter & Search Bar -->
                <div class="bg-white p-4 rounded-sm border border-slate-200/90 shadow-2xs space-y-3">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <!-- Category Filter Pills -->
                        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 max-w-full text-xs">
                            <a href="{{ route('berita.index') }}" class="px-3 py-1.5 rounded-xs font-bold transition shrink-0 {{ empty($currentCategory) ? 'bg-[#006830] text-white shadow-2xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                                Semua Topik
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" class="px-3 py-1.5 rounded-xs font-bold transition shrink-0 {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'bg-[#006830] text-white shadow-2xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                                    {{ $cat->name }} ({{ $cat->published_articles_count }})
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Search Form Input -->
                    <form method="GET" action="{{ route('berita.index') }}" class="relative">
                        @if($currentCategory)
                            <input type="hidden" name="kategori" value="{{ $currentCategory->slug }}" />
                        @endif
                        <input type="text" name="q" value="{{ $search }}" placeholder="Cari judul berita, panduan naskah, atau topik literasi..." class="w-full pl-9 pr-24 py-2.5 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 bg-white text-slate-800" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-xs text-slate-400"></i>
                        <button type="submit" class="absolute right-1.5 top-1.5 px-3 py-1 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold uppercase transition">
                            Cari
                        </button>
                    </form>
                </div>

                @if(!empty($search))
                    <div class="flex items-center justify-between text-xs text-slate-600 bg-emerald-50/60 p-3 rounded-sm border border-emerald-200">
                        <span>Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong></span>
                        <a href="{{ route('berita.index') }}" class="text-rose-600 font-bold hover:underline">Hapus Filter</a>
                    </div>
                @endif

                <!-- Articles Grid (2 Cols on Tablet & Desktop) -->
                @if($articles->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($articles as $article)
                            <article class="bg-white rounded-sm border border-slate-200/90 shadow-2xs hover:shadow-md transition overflow-hidden flex flex-col justify-between group">
                                <div>
                                    <!-- Thumbnail Frame -->
                                    <a href="{{ route('berita.show', $article->slug) }}" class="block aspect-[16/9] overflow-hidden bg-slate-100 relative">
                                        <img 
                                            src="{{ $article->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=600&auto=format&fit=crop' }}" 
                                            alt="{{ $article->title }}" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                                            loading="lazy"
                                        />
                                        @if($article->category)
                                            <span class="absolute top-2.5 left-2.5 px-2.5 py-1 bg-[#006830]/90 backdrop-blur-xs text-white text-[10px] font-bold uppercase tracking-wider rounded-xs shadow-xs">
                                                {{ $article->category->name }}
                                            </span>
                                        @endif
                                    </a>

                                    <!-- Content Body -->
                                    <div class="p-4 sm:p-5 space-y-2.5">
                                        <!-- Meta date & reading time -->
                                        <div class="flex items-center gap-3 text-[11px] text-slate-400">
                                            <span class="flex items-center gap-1">
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
                                        <h2 class="font-extrabold text-sm sm:text-base text-slate-900 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
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

                                <!-- Footer CTA -->
                                <div class="px-4 sm:px-5 pb-4 sm:pb-5 pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                                    <a href="{{ route('berita.show', $article->slug) }}" class="font-bold text-[#006830] group-hover:text-emerald-800 transition flex items-center gap-1 text-xs">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] transform group-hover:translate-x-1 transition"></i>
                                    </a>
                                    <span class="text-[11px] text-slate-400 flex items-center gap-1">
                                        <i class="fa-regular fa-eye text-[10px]"></i>
                                        {{ number_format($article->views_count, 0, ',', '.') }}
                                    </span>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($articles->hasPages())
                        <div class="pt-4 flex justify-center">
                            {{ $articles->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white p-12 text-center rounded-sm border border-slate-200/90 space-y-3">
                        <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto text-2xl">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-800">Tidak Ada Berita Ditemukan</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            @if(!empty($search))
                                Tidak ada artikel yang cocok dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain.
                            @else
                                Belum ada artikel yang diterbitkan pada topik ini.
                            @endif
                        </p>
                        <a href="{{ route('berita.index') }}" class="inline-block px-4 py-2 bg-[#006830] text-white text-xs font-bold rounded-sm uppercase tracking-wider transition">
                            Lihat Semua Berita
                        </a>
                    </div>
                @endif

            </div>

            <!-- RIGHT COLUMN: SIDEBAR (4 COLS) -->
            <aside class="lg:col-span-4 space-y-6">

                <!-- Widget: Kategori Berita -->
                <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3.5">
                    <div class="flex items-center justify-between pb-2.5 border-b border-slate-100">
                        <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-folder-tree text-emerald-700"></i>
                            <span>Kategori Berita</span>
                        </h3>
                    </div>

                    <ul class="space-y-1 text-xs divide-y divide-slate-50">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('berita.index', ['kategori' => $cat->slug]) }}" class="py-2 flex items-center justify-between text-slate-700 hover:text-emerald-700 font-medium transition {{ ($currentCategory && $currentCategory->id == $cat->id) ? 'text-emerald-700 font-bold' : '' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-xs text-[10px] font-bold">
                                        {{ $cat->published_articles_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Widget: Berita Populer -->
                @if($popularArticles->count() > 0)
                <div class="bg-white p-5 rounded-sm border border-slate-200/90 shadow-2xs space-y-3.5">
                    <div class="flex items-center justify-between pb-2.5 border-b border-slate-100">
                        <h3 class="font-extrabold text-xs text-slate-900 uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-fire text-amber-500"></i>
                            <span>Berita Populer</span>
                        </h3>
                    </div>

                    <div class="space-y-3">
                        @foreach($popularArticles as $pop)
                            <a href="{{ route('berita.show', $pop->slug) }}" class="flex gap-3 group items-start">
                                <div class="w-16 h-12 rounded-xs overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                    <img src="{{ $pop->thumbnail ?: 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=200&auto=format&fit=crop' }}" alt="{{ $pop->title }}" class="w-full h-full object-cover group-hover:scale-105 transition" />
                                </div>
                                <div class="min-w-0 flex-1 space-y-1">
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 transition leading-snug line-clamp-2">
                                        {{ $pop->title }}
                                    </h4>
                                    <span class="text-[10.5px] text-slate-400 block">
                                        {{ $pop->published_at ? $pop->published_at->format('d M Y') : '' }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Widget: Ajakan Publikasi / Konsultasi Naskah -->
                <div class="bg-gradient-to-br from-[#006830] to-[#032c21] text-white p-5 rounded-sm shadow-md space-y-3 text-center">
                    <div class="w-10 h-10 bg-lime-400 text-slate-950 rounded-full flex items-center justify-center mx-auto text-base font-bold shadow-xs">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-sm text-white">Ingin Menerbitkan Buku Anda?</h4>
                        <p class="text-xs text-slate-200/90 mt-1 leading-relaxed">
                            Konsultasikan naskah ilmiah, modul, atau buku fiksi Anda bersama tim profesional Penerbit Persis.
                        </p>
                    </div>
                    <a href="{{ route('kontak') }}" class="block w-full py-2.5 bg-lime-400 hover:bg-lime-500 text-slate-950 rounded-xs text-xs font-bold uppercase tracking-wider transition shadow-sm">
                        Konsultasi Naskah
                    </a>
                </div>

            </aside>

        </div>

    </div>
</main>
@endsection
