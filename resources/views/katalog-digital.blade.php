@extends('layouts.app')

@section('title', 'Katalog Buku Digital | PERSIS PERS')

@section('content')
<style>
    /* 1. Perspective & 3D Stage (Identik dengan Signature Katalog Buku) */
    .animate-cascade-up {
        animation: cascadeUp 0.45s cubic-bezier(0.16, 1, 0.3, 1) backwards;
    }
    @keyframes cascadeUp {
        0% { opacity: 0; transform: translateY(18px) scale(0.97); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .persis-book-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 3px;
        transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .persis-book-card:hover {
        border-color: #047857;
        transform: translateY(-4px);
        box-shadow: 0 16px 30px -8px rgba(4, 120, 87, 0.15), 0 2px 6px rgba(0,0,0,0.04);
    }
    .book-cover-stage-3d {
        perspective: 800px;
    }
    .book-cover-3d {
        transform-style: preserve-3d;
        transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
        box-shadow: 6px 8px 16px -2px rgba(0, 0, 0, 0.25), 1px 1px 4px rgba(0,0,0,0.1);
    }
    .persis-book-card:hover .book-cover-3d {
        transform: rotateY(-18deg) rotateX(6deg) translateY(-4px) scale(1.03);
        box-shadow: 14px 20px 28px -4px rgba(0, 0, 0, 0.38), 3px 3px 8px rgba(0,0,0,0.15);
    }
    .book-spine-strip {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 7px;
        background: linear-gradient(90deg, rgba(255,255,255,0.35) 0%, rgba(0,0,0,0.05) 50%, rgba(0,0,0,0.3) 100%);
        border-right: 1px solid rgba(0,0,0,0.12);
        z-index: 10;
    }
    .book-paper-edge {
        position: absolute;
        right: 0;
        top: 4px;
        bottom: 4px;
        width: 3.5px;
        background: repeating-linear-gradient(180deg, #f8fafc, #f8fafc 1.5px, #cbd5e1 1.5px, #cbd5e1 3px);
        border-left: 1px solid #94a3b8;
        border-radius: 0 2px 2px 0;
        z-index: 5;
    }

    /* Sidebar Category Links */
    .cat-link {
        transition: background-color 0.18s ease, color 0.18s ease;
    }
    .cat-link:hover {
        background-color: #f0fdf4;
        color: #006830;
    }
    .cat-active {
        background-color: #006830 !important;
        color: #ffffff !important;
        font-weight: 700;
    }
    .cat-active span, .cat-active i {
        color: #ffffff !important;
    }

    /* 2. Realistic Flipbook Modal Viewer */
    #flipbookModal {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .flip-viewport {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 0 auto;
        user-select: none;
        transform-origin: center center;
        transition: transform 0.15s ease-out;
    }
    .flip-viewport.is-zoomed {
        cursor: grab;
    }
    .flip-viewport.is-dragging {
        cursor: grabbing !important;
        transition: none !important;
    }
    .st-flip-container {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        background: transparent !important;
    }
    /* Realistic 3D Book Stage Lighting & Spine Shadow */
    .st-flip-container canvas {
        filter: drop-shadow(0 22px 35px rgba(0, 0, 0, 0.8)) drop-shadow(0 4px 12px rgba(0, 0, 0, 0.4));
        border-radius: 2px;
    }
</style>

<div class="space-y-8 pb-16">
    
    <!-- Top Hero Banner (Signature PERSIS PERS Style) -->
    <section class="bg-brand-950 text-white py-12 sm:py-14 border-b border-brand-900 relative overflow-hidden select-none animate-fade-in">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-cascade-up">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">
                        PUBLIKASI RESMI DIGITAL
                    </span>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold font-heading tracking-tight leading-tight">
                        Katalog Buku Digital
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-2xl mt-1.5 leading-relaxed">
                        Koleksi literatur keislaman, modul riset, dan karya ilmiah digital terbitan PERSIS PERS yang dapat dibaca secara interaktif di browser.
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <div class="px-4 py-2.5 bg-black/25 border border-white/10 rounded-sm backdrop-blur-xs text-center">
                        <span class="text-xs text-emerald-300 font-bold block uppercase tracking-wider">Total Judul</span>
                        <span class="text-xl sm:text-2xl font-black font-mono text-white">{{ $totalDigitalBooks }}</span>
                    </div>
                    <div class="px-4 py-2.5 bg-emerald-900/50 border border-emerald-400/30 rounded-sm backdrop-blur-xs text-center">
                        <span class="text-xs text-emerald-200 font-bold block uppercase tracking-wider">Tersedia Baca</span>
                        <span class="text-xl sm:text-2xl font-black font-mono text-amber-300">{{ $totalWithPdf }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid with Identical Left Sidebar Layout -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- ============================================== -->
            <!-- LEFT SIDEBAR (Identik dengan Katalog Utama)   -->
            <!-- ============================================== -->
            <div class="lg:col-span-3 space-y-6 animate-cascade-up" style="animation-delay: 100ms;">
                
                <!-- 1. Search Widget with Live Instant Autocomplete Dropdown -->
                <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-sm relative z-30">
                    <form id="digitalSearchForm" action="{{ route('katalog.digital') }}#daftar-buku" method="GET" class="relative" autocomplete="off">
                        <input 
                            type="search" 
                            name="q" 
                            id="digitalSearchInput" 
                            autocomplete="off" 
                            autocorrect="off" 
                            autocapitalize="off" 
                            spellcheck="false"
                            value="{{ request('q') }}" 
                            placeholder="Cari judul, penulis, topik..." 
                            class="w-full pl-8 pr-8 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-500 font-medium transition"
                        />
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                        
                        <!-- Clear Input Button -->
                        <button 
                            type="button" 
                            id="clearSearchBtn" 
                            onclick="clearDigitalSearch()" 
                            class="hidden absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 text-xs"
                            title="Hapus pencarian"
                        >
                            <i class="fa-solid fa-xmark"></i>
                        </button>

                        <!-- Autocomplete Dropdown Panel (Persis Screenshot 2) -->
                        <div 
                            id="autocompleteDropdown" 
                            style="position: absolute; top: calc(100% + 6px); left: 0; right: 0; z-index: 99999; background-color: #ffffff;"
                            class="hidden bg-white rounded-sm shadow-2xl border-2 border-emerald-700/40 overflow-hidden divide-y divide-slate-100 max-h-80 overflow-y-auto ring-4 ring-black/10"
                        >
                            <div id="autocompleteResultsList" class="p-1 space-y-1"></div>
                            
                            <div class="p-2 bg-slate-50 text-center border-t border-slate-100">
                                <button 
                                    type="submit" 
                                    class="w-full py-1.5 px-3 bg-emerald-50 hover:bg-emerald-700 text-emerald-800 hover:text-white font-bold rounded-xs text-[11px] transition flex items-center justify-center gap-1.5 cursor-pointer"
                                >
                                    <i class="fa-solid fa-magnifying-glass text-[10px]"></i>
                                    <span id="autocompleteSubmitLabel">Lihat Semua Hasil Pencarian</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- 2. Kategori Widget (Identik dengan Katalog Utama) -->
                <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                    <div class="bg-[#032c21] text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center justify-between border-b border-emerald-900">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-list-ul text-emerald-400"></i> Kategori Digital
                        </span>
                        <span class="text-[10px] bg-white/10 px-1.5 py-0.5 rounded-xs font-mono text-emerald-300">{{ $totalDigitalBooks }}</span>
                    </div>

                    <div class="divide-y divide-slate-100 text-xs font-semibold text-slate-700">
                        <!-- Semua Koleksi -->
                        <a href="{{ route('katalog.digital') }}#daftar-buku" class="cat-link flex items-center justify-between px-4 py-2.5 {{ (!request('kategori') || request('kategori') === 'all') && !request('pdf_only') ? 'cat-active' : '' }}">
                            <span>Semua Koleksi</span>
                            <i class="fa-solid fa-angle-right text-[10px] {{ (!request('kategori') || request('kategori') === 'all') && !request('pdf_only') ? 'text-white' : 'text-slate-400' }}"></i>
                        </a>

                        <!-- Koleksi Unggulan -->
                        <a href="{{ route('katalog.digital', ['kategori' => 'Unggulan']) }}#daftar-buku" class="cat-link flex items-center justify-between px-4 py-2.5 {{ request('kategori') === 'Unggulan' ? 'cat-active' : '' }}">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ request('kategori') === 'Unggulan' ? 'bg-white' : 'bg-amber-500' }}"></span> Koleksi Unggulan
                            </span>
                            <i class="fa-solid fa-angle-right text-[10px] {{ request('kategori') === 'Unggulan' ? 'text-white' : 'text-slate-400' }}"></i>
                        </a>

                        <!-- Buku Baru -->
                        <a href="{{ route('katalog.digital', ['kategori' => 'Buku Baru']) }}#daftar-buku" class="cat-link flex items-center justify-between px-4 py-2.5 {{ request('kategori') === 'Buku Baru' ? 'cat-active' : '' }}">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ request('kategori') === 'Buku Baru' ? 'bg-white' : 'bg-emerald-500' }}"></span> Terbitan Terbaru (2026)
                            </span>
                            <i class="fa-solid fa-angle-right text-[10px] {{ request('kategori') === 'Buku Baru' ? 'text-white' : 'text-slate-400' }}"></i>
                        </a>

                        <!-- Loop Kategori Dinamis -->
                        @foreach($categoryStats as $cStat)
                            <a href="{{ route('katalog.digital', ['kategori' => $cStat->category]) }}#daftar-buku" class="cat-link flex items-center justify-between px-4 py-2.5 {{ request('kategori') === $cStat->category ? 'cat-active' : '' }}">
                                <span class="truncate pr-2">{{ $cStat->category }}</span>
                                <span class="font-mono text-[10.5px] px-1.5 py-0.2 rounded-xs {{ request('kategori') === $cStat->category ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $cStat->count }}
                                </span>
                            </a>
                        @endforeach
                    </div>

                    <!-- Filter PDF Only -->
                    <div class="p-3 bg-slate-50 border-t border-slate-100">
                        <a href="{{ route('katalog.digital', array_merge(request()->except('pdf_only', 'page'), request()->boolean('pdf_only') ? [] : ['pdf_only' => 1])) }}" 
                           class="flex items-center justify-between text-xs font-semibold {{ request()->boolean('pdf_only') ? 'text-emerald-800' : 'text-slate-600 hover:text-emerald-700' }}">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-file-pdf {{ request()->boolean('pdf_only') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                                <span>Hanya Dokumen PDF</span>
                            </span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded font-mono {{ request()->boolean('pdf_only') ? 'bg-emerald-200 text-emerald-900 font-bold' : 'bg-slate-200 text-slate-600' }}">
                                {{ request()->boolean('pdf_only') ? 'ON' : 'OFF' }}
                            </span>
                        </a>
                    </div>
                </div>

                <!-- 3. Panduan Membaca Flipbook Widget -->
                <div class="bg-gradient-to-br from-emerald-50 to-slate-50 rounded-sm border border-emerald-200 p-4 shadow-2xs text-xs space-y-2.5">
                    <div class="flex items-center gap-2 text-[#006830] font-bold">
                        <i class="fa-solid fa-circle-info text-emerald-700"></i>
                        <span>Panduan 3D Flipbook</span>
                    </div>
                    <ul class="space-y-1.5 text-slate-600 text-[11px] leading-relaxed">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-computer-mouse text-emerald-600 text-xs mt-0.5"></i>
                            <span>Klik atau tarik sudut kertas untuk membalik halaman.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-mobile-screen text-emerald-600 text-xs mt-0.5"></i>
                            <span>Usap layar (swipe) jika membaca di ponsel atau tablet.</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- ============================================== -->
            <!-- RIGHT MAIN: RAK BUKU & LISTING                -->
            <!-- ============================================== -->
            <div class="lg:col-span-9 space-y-6" id="daftar-buku">
                
                <!-- Section Header with Count & Reset -->
                <div class="bg-white p-4 rounded-sm border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <h2 class="text-base font-extrabold text-slate-900 font-heading">
                            Daftar Koleksi Buku Digital
                            @if(request('kategori') && request('kategori') !== 'all')
                                <span class="text-emerald-700 font-bold">&bull; {{ request('kategori') }}</span>
                            @endif
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Menampilkan <strong>{{ $digitalBooks->total() }}</strong> judul buku digital.
                        </p>
                    </div>

                    @if(request('q') || request('kategori') || request('pdf_only'))
                        <a href="{{ route('katalog.digital') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-700 rounded-sm text-xs font-bold transition self-start sm:self-auto">
                            <i class="fa-solid fa-rotate-left text-[10px]"></i>
                            <span>Reset Filter</span>
                        </a>
                    @endif
                </div>

                <!-- Book Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse($digitalBooks as $book)
                        @php
                            $coverUrl = $book->cover_url;
                            $pdfUrl = $book->pdf_url;
                            $bookPayload = [
                                'id' => $book->id,
                                'title' => $book->title,
                                'author' => $book->author,
                                'category' => $book->category,
                                'year' => $book->year,
                                'pages' => $book->pages,
                                'synopsis' => $book->synopsis,
                                'cover_url' => $coverUrl,
                                'pdf_url' => $pdfUrl,
                                'pdf_file' => $book->pdf_file,
                            ];
                            $encodedBook = base64_encode(json_encode($bookPayload));
                        @endphp
                        <div class="persis-book-card p-4">
                            
                            <!-- Top Details & 3D Cover -->
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 truncate">
                                        {{ $book->category }}
                                    </span>
                                    
                                    <div class="flex items-center gap-1.5 shrink-0">
                                        @php
                                            $isBookmarked = in_array($book->id, $bookmarkedIds ?? []);
                                        @endphp
                                        <button type="button" 
                                                onclick="toggleBookBookmark({{ $book->id }}, this)" 
                                                class="px-2 py-0.5 rounded-xs border transition flex items-center gap-1 text-[9.5px] font-bold cursor-pointer select-none {{ $isBookmarked ? 'bg-amber-500 text-white border-amber-600 shadow-2xs' : 'bg-white hover:bg-slate-50 text-slate-600 border-slate-200' }}" 
                                                title="{{ $isBookmarked ? 'Tersimpan di Buku Digital Saya (Klik untuk batal)' : 'Simpan / Bookmark ke Buku Digital Saya' }}"
                                                data-bookmarked="{{ $isBookmarked ? '1' : '0' }}">
                                            <i class="{{ $isBookmarked ? 'fa-solid' : 'fa-regular' }} fa-bookmark {{ $isBookmarked ? 'text-white' : 'text-amber-500' }}"></i>
                                            <span class="bookmark-btn-label">{{ $isBookmarked ? 'Tersimpan' : 'Simpan' }}</span>
                                        </button>

                                        @if($pdfUrl)
                                            <span class="px-1.5 py-0.5 rounded-xs text-[9px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-300 flex items-center gap-1" title="File PDF Siap Dibaca">
                                                <i class="fa-solid fa-file-pdf text-[8px] text-emerald-700"></i>
                                                <span>PDF</span>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- 3D Perspective Stage -->
                                <div class="book-cover-stage-3d w-36 aspect-[3/4.2] mx-auto py-2 cursor-pointer" data-book="{{ $encodedBook }}" onclick="openFlipbookFromEncoded(this.getAttribute('data-book'))" title="Klik untuk Buka Buku (Flipbook)">
                                    <div class="book-cover-3d relative w-full h-full rounded-xs overflow-hidden bg-slate-900 border border-slate-300">
                                        <div class="book-spine-strip"></div>
                                        <div class="book-paper-edge"></div>

                                        @if($coverUrl)
                                            <img src="{{ $coverUrl }}" alt="{{ $book->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                                        @endif

                                        <div class="w-full h-full bg-[#032c21] p-3 pl-4 flex flex-col justify-between text-white text-[8px]" style="{{ $coverUrl ? 'display:none;' : '' }}">
                                            <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                                <span class="text-emerald-300 font-bold truncate">PERSIS PERS</span>
                                                <span class="text-slate-300 font-mono text-[7px]">{{ $book->year }}</span>
                                            </div>
                                            <div class="my-auto text-center py-1">
                                                <span class="font-black text-[9px] leading-tight line-clamp-3">{{ $book->title }}</span>
                                            </div>
                                            <div class="border-t border-white/20 pt-1 text-center">
                                                <span class="text-slate-300 truncate text-[7px] block">{{ $book->author }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book Info -->
                                <div class="mt-3 space-y-1">
                                    <h3 class="text-xs sm:text-[13px] font-extrabold text-slate-900 line-clamp-2 leading-snug hover:text-emerald-800 transition cursor-pointer" data-book="{{ $encodedBook }}" onclick="openFlipbookFromEncoded(this.getAttribute('data-book'))">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-[11px] text-slate-500 truncate flex items-center gap-1.5">
                                        <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                        <span>{{ $book->author }}</span>
                                    </p>
                                    <div class="flex items-center justify-between text-[11px] text-slate-400 font-mono pt-1">
                                        <span>{{ $book->pages ?: '240 hlm' }}</span>
                                        <span>{{ $book->year }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons: Buka Baca & Download/Dukung -->
                            <div class="pt-3 border-t border-slate-100 mt-3 grid grid-cols-2 gap-2">
                                <button type="button" 
                                        data-book="{{ $encodedBook }}"
                                        onclick="openFlipbookFromEncoded(this.getAttribute('data-book'))" 
                                        class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer"
                                        title="Buka &amp; Baca Flipbook">
                                    <i class="fa-solid fa-book-open-reader text-xs"></i>
                                    <span>Baca Buku</span>
                                </button>
                                <button type="button" 
                                        data-book="{{ $encodedBook }}"
                                        onclick="openDownloadFromEncoded(this.getAttribute('data-book'))" 
                                        class="w-full py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-900 border border-emerald-300 rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer"
                                        title="Download Buku &amp; Dukung Penerbitan">
                                    <i class="fa-solid fa-download text-xs text-emerald-700"></i>
                                    <span>Download</span>
                                </button>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full bg-white rounded-sm border border-slate-200 p-12 text-center text-slate-400 space-y-3">
                            <i class="fa-solid fa-book-open text-4xl text-slate-300"></i>
                            <h4 class="text-sm font-bold text-slate-700">Belum ada buku digital yang sesuai</h4>
                            <p class="text-xs text-slate-400 max-w-sm mx-auto">
                                Coba kata kunci lain atau tambahkan buku digital baru di Panel Admin.
                            </p>
                            <a href="{{ route('katalog.digital') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-700 text-white rounded-sm text-xs font-bold transition">
                                Lihat Semua Koleksi
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($digitalBooks->hasPages())
                    <div class="p-4 bg-white rounded-sm border border-slate-200 flex items-center justify-end shadow-2xs">
                        {{ $digitalBooks->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</div>

<!-- ========================================================== -->
<!-- 3D FLIPBOOK VIEWER MODAL (IMMERSIVE READING EXPERIENCE)   -->
<!-- ========================================================== -->
<div id="flipbookModal" class="fixed inset-0 z-[99999] bg-black/95 hidden items-center justify-center p-0 sm:p-3 md:p-6 select-none animate-fade-in" style="display: none;">
    <div class="w-full max-w-5xl h-[100dvh] sm:h-[94vh] flex flex-col justify-between bg-slate-950 rounded-none sm:rounded-sm border-0 sm:border border-slate-800 shadow-2xl overflow-hidden relative">
        
        <!-- Top Toolbar -->
        <div class="bg-slate-900 border-b border-slate-800 px-3 sm:px-4 py-2 sm:py-2.5 flex items-center justify-between text-white shrink-0">
            <div class="flex items-center gap-2 sm:gap-3 min-w-0 pr-2">
                <span class="w-2 sm:w-2.5 h-2 sm:h-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                <div class="min-w-0">
                    <h3 id="modalBookTitle" class="text-xs sm:text-sm font-black text-white truncate font-heading">
                        Judul Buku Digital
                    </h3>
                    <p id="modalBookAuthor" class="text-[10px] sm:text-[10.5px] text-emerald-400 truncate">
                        Penulis Buku
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                <!-- Direct PDF Button -->
                <a id="btnDirectPdfOpen" href="#" target="_blank" rel="noopener noreferrer" class="hidden sm:inline-flex px-2.5 py-1.5 rounded-xs bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white text-xs font-bold transition items-center gap-1.5 border border-slate-700 cursor-pointer" title="Buka File PDF Asli di Tab Baru (Cepat)">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10.5px] text-emerald-400"></i>
                    <span class="hidden md:inline">Buka PDF</span>
                </a>

                <!-- Share Link Button -->
                <button type="button" onclick="copyBookShareLink()" class="px-2.5 py-1.5 rounded-xs bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white text-xs font-bold transition flex items-center gap-1.5 border border-slate-700 cursor-pointer" title="Salin Link Tautan Buku ini">
                    <i class="fa-solid fa-share-nodes text-[10.5px] text-emerald-400"></i>
                    <span id="copyBookLinkText" class="hidden md:inline">Bagikan</span>
                </button>

                <!-- Zoom Controls -->
                <div class="flex items-center bg-slate-800 rounded-xs border border-slate-700 p-0.5">
                    <button type="button" onclick="zoomFlipbook(-0.25)" class="w-6 sm:w-7 h-6 sm:h-7 flex items-center justify-center text-slate-300 hover:text-white hover:bg-slate-700 rounded-xs transition text-xs cursor-pointer active:scale-95" title="Perkecil Tampilan (-)">
                        <i class="fa-solid fa-magnifying-glass-minus text-[10px] sm:text-[11px]"></i>
                    </button>
                    <button type="button" onclick="resetFlipbookZoom()" id="btnResetZoom" class="px-1.5 sm:px-2 h-6 sm:h-7 flex items-center justify-center font-mono font-bold text-[10px] sm:text-[11px] text-emerald-400 hover:text-emerald-300 hover:bg-slate-700 rounded-xs transition cursor-pointer" title="Klik untuk Reset ke 100%">
                        <span id="zoomLevelText">100%</span>
                    </button>
                    <button type="button" onclick="zoomFlipbook(0.25)" class="w-6 sm:w-7 h-6 sm:h-7 flex items-center justify-center text-slate-300 hover:text-white hover:bg-slate-700 rounded-xs transition text-xs cursor-pointer active:scale-95" title="Perbesar Tampilan (+)">
                        <i class="fa-solid fa-magnifying-glass-plus text-[10px] sm:text-[11px]"></i>
                    </button>
                </div>

                <button type="button" onclick="openDownloadDonationModal(window.currentReadingBook)" class="px-2.5 sm:px-3 py-1.5 rounded-xs bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-xs cursor-pointer" title="Download Buku &amp; Dukung Penerbitan">
                    <i class="fa-solid fa-download text-xs"></i>
                    <span class="hidden sm:inline">Download</span>
                </button>
                
                <button type="button" onclick="toggleFlipbookFullscreen()" class="p-1.5 px-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xs text-xs transition cursor-pointer" title="Layar Penuh">
                    <i class="fa-solid fa-expand"></i>
                </button>

                <button type="button" onclick="closeFlipbookModal()" class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-rose-600/80 hover:bg-rose-600 text-white flex items-center justify-center text-xs transition cursor-pointer" title="Tutup Pembaca (Esc)">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Middle: Flipbook Stage Area -->
        <div class="flex-1 flex items-center justify-center p-1 sm:p-4 overflow-hidden relative touch-pan-y" id="flipbookStageContainer">
            
            <!-- Loading Indicator -->
            <div id="flipLoading" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-950/90 text-white z-50 p-4 text-center">
                <i class="fa-solid fa-circle-notch fa-spin text-3xl text-emerald-500 mb-3"></i>
                <p id="flipLoadingTitle" class="text-xs sm:text-sm font-bold tracking-wide text-slate-200">Menyiapkan Lembaran Buku Digital...</p>
                <p id="flipLoadingText" class="text-[10.5px] sm:text-xs text-emerald-400 mt-1 font-mono">Memuat halaman PDF &amp; efek flip 3D</p>
                <div class="mt-4 pt-3 border-t border-slate-800 flex items-center justify-center">
                    <a id="btnLoadingOpenDirectPdf" href="#" target="_blank" rel="noopener noreferrer" class="hidden px-3.5 py-2 rounded-xs bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-bold transition items-center gap-2 shadow-md">
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                        <span>Buku Tebal? Buka PDF Langsung di Tab Baru</span>
                    </a>
                </div>
            </div>

            <!-- Floating Navigation Buttons (Desktop only, never block text on mobile!) -->
            <button type="button" onclick="flipbookPrev()" class="hidden md:flex absolute left-3 lg:left-5 top-1/2 -translate-y-1/2 z-40 w-11 h-11 rounded-full bg-slate-900/85 hover:bg-emerald-600 text-white items-center justify-center shadow-xl transition backdrop-blur-xs border border-slate-700/80 cursor-pointer group active:scale-95" title="Halaman Sebelumnya (Panah Kiri)">
                <i class="fa-solid fa-chevron-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
            </button>

            <button type="button" onclick="flipbookNext()" class="hidden md:flex absolute right-3 lg:right-5 top-1/2 -translate-y-1/2 z-40 w-11 h-11 rounded-full bg-slate-900/85 hover:bg-emerald-600 text-white items-center justify-center shadow-xl transition backdrop-blur-xs border border-slate-700/80 cursor-pointer group active:scale-95" title="Halaman Berikutnya (Panah Kanan)">
                <i class="fa-solid fa-chevron-right text-sm group-hover:translate-x-0.5 transition-transform"></i>
            </button>

            <!-- Viewport for StPageFlip Native Engine -->
            <div class="flip-viewport" id="flipbookViewport">
                <div id="bookFlipInstance" class="st-flip-container"></div>
            </div>

        </div>

        <!-- Bottom Controls Bar -->
        <div class="bg-slate-900 border-t border-slate-800 px-3 sm:px-4 py-2 sm:py-2.5 flex items-center justify-between text-white shrink-0 text-xs">
            <div class="hidden lg:flex items-center gap-2 text-slate-400 text-[11px]">
                <i class="fa-solid fa-hand-pointer text-emerald-400"></i>
                <span>Tarik sudut kertas atau klik tombol panah</span>
            </div>

            <div class="flex items-center gap-1.5 sm:gap-2 mx-auto lg:mx-0">
                <button type="button" onclick="flipbookPrev()" class="px-3 py-1.5 bg-slate-800 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xs font-bold transition flex items-center gap-1 border border-slate-700 shadow-2xs cursor-pointer text-xs">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span class="inline">Sebelumnya</span>
                </button>

                <div class="px-2.5 sm:px-3 py-1 bg-slate-950 border border-slate-800 rounded-xs font-mono font-bold text-emerald-400 text-xs flex items-center gap-1">
                    <span id="flipCurrentPage">1</span>
                    <span class="text-slate-600">/</span>
                    <span id="flipTotalPages" class="text-slate-400">1</span>
                </div>

                <input type="range" id="flipPageSlider" min="1" max="1" value="1" oninput="jumpToPage(this.value)" class="hidden md:block w-24 sm:w-28 accent-emerald-500 h-1 bg-slate-800 rounded-lg cursor-pointer" title="Geser Lembaran Halaman">

                <button type="button" onclick="flipbookNext()" class="px-3 py-1.5 bg-slate-800 hover:bg-emerald-700 active:bg-emerald-800 text-white rounded-xs font-bold transition flex items-center gap-1 border border-slate-700 shadow-2xs cursor-pointer text-xs">
                    <span class="inline">Berikutnya</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" id="btnToggleSound" onclick="toggleFlipSound()" class="p-1.5 px-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xs transition text-xs flex items-center gap-1 cursor-pointer" title="Suara Kertas">
                    <i id="soundIcon" class="fa-solid fa-volume-high text-[11px] text-emerald-400"></i>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- ========================================================== -->
<!-- MODAL DOWNLOAD BUKU & DUKUNG PENERBITAN (DONASI DIGITAL)  -->
<!-- ========================================================== -->
<div id="downloadDonationModal" class="fixed inset-0 z-[999999] bg-slate-950/80 backdrop-blur-xs hidden items-center justify-center p-3 sm:p-4 select-none animate-fade-in" style="display: none;">
    <div class="bg-white rounded-sm border border-slate-300 w-full max-w-xl max-h-[92vh] flex flex-col justify-between shadow-2xl overflow-hidden animate-cascade-up">
        
        <!-- Modal Top Bar -->
        <div class="bg-[#032c21] px-4 py-3 sm:px-5 sm:py-3.5 text-white flex items-center justify-between shrink-0 border-b border-white/10">
            <div class="flex items-center gap-3 min-w-0 pr-2">
                <div class="w-8 h-8 rounded-xs bg-emerald-700/80 flex items-center justify-center text-white shrink-0 text-sm">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="min-w-0">
                    <h3 id="donModalBookTitle" class="text-xs sm:text-sm font-black text-white truncate font-heading">
                        Download Buku Digital
                    </h3>
                    <p id="donModalBookAuthor" class="text-[10px] text-emerald-300 truncate">
                        Persis Pers
                    </p>
                </div>
            </div>

            <button type="button" onclick="closeDownloadDonationModal()" class="w-7 h-7 bg-white/10 hover:bg-rose-600 text-white rounded-xs flex items-center justify-center transition cursor-pointer text-xs" title="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Modal Body (Scrollable) -->
        <div class="p-4 sm:p-5 overflow-y-auto space-y-4 text-xs">

            <!-- Ajakan Dukung Penerbitan -->
            <div class="p-3.5 bg-emerald-50/70 border border-emerald-200 rounded-sm space-y-2">
                <div class="flex items-center gap-2 text-[#006830] font-black text-xs">
                    <i class="fa-solid fa-heart text-rose-500"></i>
                    <span>{{ $donationSettings['title'] ?? 'Dukung Penerbitan Buku Islam' }}</span>
                </div>
                <p class="text-slate-600 text-[11px] leading-relaxed">
                    {{ $donationSettings['desc'] ?? 'Buku ini dapat diakses dan diunduh secara digital. Jika buku ini bermanfaat bagi Anda, mari ikut mendukung Persis Pers agar dapat terus menerbitkan dan menyebarluaskan karya-karya keislaman.' }}
                </p>
                
                <div class="pt-2 border-t border-emerald-200/80">
                    <span class="text-[10px] font-bold text-emerald-900 uppercase block mb-1.5">Dukungan Anda disalurkan untuk:</span>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-1 text-[10.5px] text-slate-700">
                        <li class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-700 text-[9px]"></i><span>Penerbitan buku Islam</span></li>
                        <li class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-700 text-[9px]"></i><span>Digitalisasi &amp; sebar buku</span></li>
                        <li class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-700 text-[9px]"></i><span>Karya ulama &amp; cendekiawan</span></li>
                        <li class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-700 text-[9px]"></i><span>Wakaf buku ke perpustakaan</span></li>
                    </ul>
                </div>
            </div>

            <!-- Donation Options Card -->
            <div class="bg-white border border-slate-200 rounded-sm p-3.5 sm:p-4 space-y-3.5">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <span class="font-bold text-slate-800 text-xs">Pilih Metode Donasi:</span>
                    <span class="text-[10px] text-slate-400 font-medium">*Donasi bersifat sukarela</span>
                </div>

                <!-- Method Switcher Tab -->
                <div class="grid grid-cols-2 gap-2">
                    <button type="button" id="tabBtnQris" onclick="switchDonationTab('qris')" class="py-2 px-3 rounded-xs font-bold text-xs flex items-center justify-center gap-2 border transition cursor-pointer bg-[#006830] text-white border-[#006830]">
                        <i class="fa-solid fa-qrcode text-xs"></i>
                        <span>Scan QRIS</span>
                    </button>
                    <button type="button" id="tabBtnTransfer" onclick="switchDonationTab('transfer')" class="py-2 px-3 rounded-xs font-bold text-xs flex items-center justify-center gap-2 border transition cursor-pointer bg-slate-100 text-slate-700 border-slate-300 hover:bg-slate-200">
                        <i class="fa-solid fa-building-columns text-xs"></i>
                        <span>Transfer Bank</span>
                    </button>
                </div>

                <!-- 1. TAB QRIS CONTENT -->
                <div id="contentTabQris" class="space-y-3">
                    <div class="p-3 bg-slate-50 border border-slate-200 rounded-xs flex flex-col sm:flex-row items-center gap-3">
                        <div class="w-32 h-32 bg-white p-1 border border-slate-300 rounded-xs flex items-center justify-center shrink-0 shadow-2xs">
                            @php
                                $qrisUrl = $donationSettings['qris_image'] ?? '';
                                if (!empty($qrisUrl) && !str_starts_with($qrisUrl, 'http') && !str_starts_with($qrisUrl, '//')) {
                                    $qrisUrl = asset(ltrim($qrisUrl, '/'));
                                }
                            @endphp
                            <img src="{{ $qrisUrl ?: 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PERSIS-PERS-DONASI' }}" alt="QRIS PERSIS PERS" class="w-full h-full object-contain" />
                        </div>
                        <div class="text-left space-y-1">
                            <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-wider block">QRIS Persis Pers</span>
                            <h4 class="font-extrabold text-slate-900 text-xs sm:text-sm">Scan untuk Berdonasi</h4>
                            <p class="text-[11px] text-slate-500 leading-snug">
                                Buka GoPay, OVO, Dana, ShopeePay, BCA, Mandiri, BSI, atau m-banking Anda lalu scan barcode di samping.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 2. TAB TRANSFER CONTENT -->
                <div id="contentTabTransfer" class="hidden space-y-3">
                    <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-xs space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10.5px] font-bold text-slate-500 uppercase">{{ $donationSettings['bank_name'] ?? 'Bank Syariah Indonesia (BSI)' }}</span>
                            <span class="text-[10px] text-emerald-700 font-bold bg-emerald-100 px-1.5 py-0.5 rounded-xs">Rekening Resmi</span>
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <span id="bankAccountNum" class="text-base font-black text-slate-900 font-mono tracking-wider">{{ $donationSettings['bank_account'] ?? '7148888999' }}</span>
                            <button type="button" onclick="copyBankAccountNumber()" class="px-2.5 py-1 bg-white border border-slate-300 hover:border-emerald-700 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition flex items-center gap-1 cursor-pointer" id="btnCopyAccount">
                                <i class="fa-regular fa-copy text-[10px]"></i>
                                <span id="copyTextLabel">Salin</span>
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-600 font-semibold">
                            a.n. <span class="text-slate-900 font-bold">{{ $donationSettings['bank_holder'] ?? 'PENERBIT PERSIS DONASI' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Nominal Chips Selector -->
                <div class="space-y-2 pt-1">
                    <label class="block text-[11px] font-bold text-slate-700">Pilih Nominal Donasi:</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-1.5 text-xs">
                        <button type="button" onclick="pickNominal(10000, this)" class="nominal-chip py-1.5 px-2 rounded-xs border border-slate-300 bg-white hover:border-emerald-600 font-bold text-slate-800 transition cursor-pointer text-center">
                            Rp 10.000
                        </button>
                        <button type="button" onclick="pickNominal(25000, this)" class="nominal-chip py-1.5 px-2 rounded-xs border border-slate-300 bg-white hover:border-emerald-600 font-bold text-slate-800 transition cursor-pointer text-center">
                            Rp 25.000
                        </button>
                        <button type="button" onclick="pickNominal(50000, this)" class="nominal-chip py-1.5 px-2 rounded-xs border border-emerald-700 bg-emerald-50 text-emerald-900 font-bold text-center transition cursor-pointer">
                            Rp 50.000
                        </button>
                        <button type="button" onclick="pickNominal(100000, this)" class="nominal-chip py-1.5 px-2 rounded-xs border border-slate-300 bg-white hover:border-emerald-600 font-bold text-slate-800 transition cursor-pointer text-center">
                            Rp 100.000
                        </button>
                    </div>
                    
                    <div class="relative pt-1">
                        <span class="absolute left-2.5 top-3.5 text-xs font-bold text-slate-400 font-mono">Rp</span>
                        <input type="text" inputmode="numeric" id="customNominalInput" value="50.000" oninput="handleCustomNominalChange(this)" placeholder="Atau ketik nominal lainnya..." class="w-full pl-9 pr-3 py-2 text-xs rounded-xs border border-slate-300 bg-white font-mono font-bold text-slate-900 focus:outline-hidden focus:border-emerald-700" />
                    </div>
                </div>

                <!-- Form Konfirmasi Donatur (Collapsible / Terbuka) -->
                <div class="pt-2 border-t border-slate-100">
                    <button type="button" onclick="toggleDonationForm()" class="w-full py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-900 border border-emerald-300 rounded-xs text-xs font-bold transition flex items-center justify-between px-3 cursor-pointer">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-receipt text-emerald-700"></i>
                            <span id="btnToggleFormLabel">Konfirmasi Data Donasi (Opsional)</span>
                        </span>
                        <i id="formChevron" class="fa-solid fa-chevron-down text-[10px] text-emerald-700 transition-transform"></i>
                    </button>

                    <form id="donationConfirmForm" onsubmit="submitDonationData(event)" class="hidden space-y-2.5 pt-3 animate-fade-in">
                        <input type="hidden" id="formBookId" name="digital_book_id" value="" />
                        <input type="hidden" id="formPaymentMethod" name="payment_method" value="qris" />
                        <input type="hidden" id="formAmount" name="amount" value="50000" />

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                            <div>
                                <label class="block font-bold text-slate-700 mb-0.5 text-[11px]">Nama Donatur / Hamba Allah <span class="text-rose-500">*</span></label>
                                <input type="text" name="donor_name" id="donorNameInput" required placeholder="Nama Anda / Hamba Allah" class="w-full px-2.5 py-1.5 text-xs rounded-xs border border-slate-300 bg-white" />
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-0.5 text-[11px]">No. WhatsApp (Opsional)</label>
                                <input type="text" name="donor_phone" placeholder="08xxxxxxxxxx" class="w-full px-2.5 py-1.5 text-xs rounded-xs border border-slate-300 bg-white font-mono" />
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-0.5 text-[11px]">Catatan / Doa Singkat (Opsional)</label>
                            <input type="text" name="notes" placeholder="Tuliskan doa atau pesan untuk kemajuan literasi Islam..." class="w-full px-2.5 py-1.5 text-xs rounded-xs border border-slate-300 bg-white" />
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-0.5 text-[11px]">Upload Bukti Transfer / Scan (Opsional)</label>
                            <input type="file" name="proof_file" accept="image/*" class="w-full text-[11px] text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-xs file:border-0 file:text-[10px] file:font-bold file:bg-slate-200 file:text-slate-800 hover:file:bg-slate-300 cursor-pointer" />
                        </div>

                        <div class="pt-1">
                            <button type="submit" id="btnSubmitDonation" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                                <i class="fa-solid fa-heart text-rose-300"></i>
                                <span>Kirim Konfirmasi Donasi &amp; Unduh Buku</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <!-- Modal Bottom / Direct Free Download Action -->
        <div class="bg-slate-100 p-3 sm:p-4 border-t border-slate-200 shrink-0 flex flex-col sm:flex-row items-center justify-between gap-2.5">
            <span class="text-[11px] text-slate-500 text-center sm:text-left">
                Mau langsung mengunduh tanpa donasi? Silakan klik tombol di samping.
            </span>
            <button type="button" onclick="directDownloadCurrentBook()" class="w-full sm:w-auto px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-2 shrink-0 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-download text-xs text-lime-400"></i>
                <span>Download Buku Sekarang</span>
            </button>
        </div>

    </div>
</div>

<!-- Scripts for PDF.js and StPageFlip Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.js"></script>

<script>
    if (window.pdfjsLib) {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

    let pageFlipInstance = null;
    let flipSoundEnabled = true;

    // ==============================================================
    // 1. LIVE AUTOCOMPLETE SEARCH (PERSIS SCREENSHOT 2 KATALOG UTAMA)
    // ==============================================================
    const digitalSearchInput = document.getElementById('digitalSearchInput');
    const autocompleteDropdown = document.getElementById('autocompleteDropdown');
    const autocompleteList = document.getElementById('autocompleteResultsList');
    const autocompleteSubmitLabel = document.getElementById('autocompleteSubmitLabel');
    const clearSearchBtn = document.getElementById('clearSearchBtn');

    let acDebounceTimer = null;
    let acResults = [];

    function clearDigitalSearch() {
        if (digitalSearchInput) {
            digitalSearchInput.value = '';
            digitalSearchInput.focus();
        }
        hideAutocomplete();
        if (clearSearchBtn) clearSearchBtn.classList.add('hidden');
    }

    function showAutocomplete() {
        if (autocompleteDropdown) autocompleteDropdown.classList.remove('hidden');
    }

    function hideAutocomplete() {
        if (autocompleteDropdown) autocompleteDropdown.classList.add('hidden');
    }

    if (digitalSearchInput) {
        digitalSearchInput.addEventListener('input', function() {
            const q = this.value.trim();
            if (clearSearchBtn) {
                if (q.length > 0) clearSearchBtn.classList.remove('hidden');
                else clearSearchBtn.classList.add('hidden');
            }

            clearTimeout(acDebounceTimer);
            if (q.length < 1) {
                hideAutocomplete();
                return;
            }

            acDebounceTimer = setTimeout(() => {
                fetch('{{ route('api.digital-books.search') }}?q=' + encodeURIComponent(q))
                    .then(res => res.json())
                    .then(data => {
                        if (!data || !data.success || !data.books) {
                            hideAutocomplete();
                            return;
                        }

                        acResults = data.books;
                        autocompleteList.innerHTML = '';

                        if (acResults.length === 0) {
                            autocompleteList.innerHTML = `
                                <div class="p-3 text-center text-xs text-slate-400">
                                    <i class="fa-solid fa-magnifying-glass text-slate-300 text-lg block mb-1"></i>
                                    Tidak ada buku digital untuk "${q}"
                                </div>
                            `;
                        } else {
                            acResults.forEach(book => {
                                const row = document.createElement('div');
                                row.className = 'flex items-center gap-2.5 px-3 py-2.5 cursor-pointer hover:bg-emerald-50 transition border-b border-slate-100 last:border-0';

                                const coverSrc = book.cover_url;
                                const esc = q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                                const titleHL = (book.title || '').replace(new RegExp('(' + esc + ')', 'gi'),
                                    '<mark class="bg-amber-100 text-amber-900 font-bold rounded-xs px-0.5">$1</mark>');

                                row.innerHTML = `
                                    <div class="w-9 h-12 rounded-xs overflow-hidden shrink-0 border border-slate-200 bg-[#032c21]">
                                        ${coverSrc ? `<img src="${coverSrc}" class="w-full h-full object-cover" />` : `<div class="w-full h-full flex items-center justify-center text-emerald-400 text-[7px] font-bold p-1 text-center">PERSIS</div>`}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[9px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-1.5 rounded-xs">${book.category || 'Digital'}</span>
                                        <h5 class="text-xs font-bold text-slate-900 truncate mt-0.5">${titleHL}</h5>
                                        <p class="text-[10px] text-slate-400 truncate">${book.author || ''}</p>
                                    </div>
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold shrink-0">
                                        <i class="fa-solid fa-book-open-reader text-[9px]"></i> Baca
                                    </span>
                                `;

                                row.addEventListener('click', function() {
                                    openFlipbookReader(book);
                                    hideAutocomplete();
                                });

                                autocompleteList.appendChild(row);
                            });
                        }

                        if (autocompleteSubmitLabel) {
                            autocompleteSubmitLabel.innerText = acResults.length > 0
                                ? 'Lihat Semua ' + acResults.length + ' Hasil'
                                : 'Cari "' + q + '" di Semua Buku Digital';
                        }

                        showAutocomplete();
                    })
                    .catch(() => hideAutocomplete());
            }, 250);
        });

        // Close dropdown on outside click
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#digitalSearchForm')) {
                hideAutocomplete();
            }
        });
    }

    // ==============================================================
    // 2. 3D FLIPBOOK VIEWER ENGINE (NATIVE 60FPS CANVAS & REAL SOUND)
    // ==============================================================
    let currentBookPages = [];
    let currentBookRatio = 1.414;
    let resizeTimer = null;

    function playPaperTurnSound() {
        if (!flipSoundEnabled) return;
        try {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (!AudioCtx) return;
            const ctx = new AudioCtx();
            const bufferSize = Math.floor(ctx.sampleRate * 0.12);
            const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
            const data = buffer.getChannelData(0);
            for (let i = 0; i < bufferSize; i++) {
                data[i] = (Math.random() * 2 - 1) * Math.exp(-i / (ctx.sampleRate * 0.035));
            }
            const noise = ctx.createBufferSource();
            noise.buffer = buffer;
            const filter = ctx.createBiquadFilter();
            filter.type = 'lowpass';
            filter.frequency.value = 850;
            const gain = ctx.createGain();
            gain.gain.setValueAtTime(0.18, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.12);
            noise.connect(filter);
            filter.connect(gain);
            gain.connect(ctx.destination);
            noise.start();
        } catch(e) {}
    }

    function toggleFlipSound() {
        flipSoundEnabled = !flipSoundEnabled;
        const icon = document.getElementById('soundIcon');
        if (icon) {
            icon.className = flipSoundEnabled ? 'fa-solid fa-volume-high text-[11px] text-emerald-400' : 'fa-solid fa-volume-xmark text-[11px] text-slate-500';
        }
    }

    function calculateBookDimensions(pageRatio) {
        const stage = document.getElementById('flipbookStageContainer');
        const stageW = stage ? stage.clientWidth : window.innerWidth;
        const stageH = stage ? stage.clientHeight : window.innerHeight;

        const isMobile = stageW < 768;

        let pageHeight, pageWidth;

        if (isMobile) {
            // Mobile: Single portrait page fitting the stage screen nicely with max readability
            const availableW = Math.max(220, stageW - 12);
            const availableH = Math.max(300, stageH - 12);

            pageWidth = availableW;
            pageHeight = Math.round(pageWidth * pageRatio);

            if (pageHeight > availableH) {
                pageHeight = availableH;
                pageWidth = Math.round(pageHeight / pageRatio);
            }
        } else {
            // Desktop: Dual page spread
            const availableW = Math.max(500, stageW - 80);
            const availableH = Math.max(380, stageH - 24);

            const availableWidthForOnePage = Math.floor(availableW / 2);
            pageHeight = Math.min(availableH, Math.round(availableWidthForOnePage * pageRatio));
            pageWidth = Math.round(pageHeight / pageRatio);
            
            if (pageWidth > availableWidthForOnePage) {
                pageWidth = availableWidthForOnePage;
                pageHeight = Math.round(pageWidth * pageRatio);
            }
        }

        return {
            width: Math.max(200, Math.round(pageWidth)),
            height: Math.max(280, Math.round(pageHeight)),
            isMobile
        };
    }

    window.decodeBookData = function(data) {
        if (!data) return null;
        if (typeof data === 'object') return data;
        try {
            const decoded = decodeURIComponent(escape(atob(data)));
            return JSON.parse(decoded);
        } catch (e1) {
            try {
                return JSON.parse(atob(data));
            } catch (e2) {
                try {
                    return JSON.parse(data);
                } catch (e3) {
                    console.error('Gagal decode data buku:', e3);
                    return null;
                }
            }
        }
    };

    window.openFlipbookFromEncoded = function(encoded) {
        const book = window.decodeBookData(encoded);
        if (book) {
            window.openFlipbookReader(book);
        }
    };

    window.openDownloadFromEncoded = function(encoded) {
        const book = window.decodeBookData(encoded);
        if (book) {
            window.openDownloadDonationModal(book);
        }
    };

    window.copyBookShareLink = function() {
        if (!window.currentReadingBook) return;
        try {
            const url = new URL(window.location.origin + window.location.pathname);
            url.searchParams.set('baca', window.currentReadingBook.id);
            navigator.clipboard.writeText(url.toString()).then(() => {
                const lbl = document.getElementById('copyBookLinkText');
                if (lbl) {
                    const prev = lbl.innerText;
                    lbl.innerText = 'Link Tersalin!';
                    setTimeout(() => { lbl.innerText = prev; }, 2500);
                }
            });
        } catch(e) {
            console.error('Gagal salin link:', e);
        }
    };

    window.openFlipbookReader = async function(book) {
        if (typeof book === 'string') {
            book = window.decodeBookData(book);
        }
        if (!book) return;

        window.currentReadingBook = book;

        // Update URL query param ?baca=ID (agar link bisa di-copy langsung dari address bar)
        try {
            const url = new URL(window.location.href);
            url.searchParams.set('baca', book.id);
            window.history.replaceState({}, '', url.toString());
        } catch(e) {}

        const modal = document.getElementById('flipbookModal');
        const titleEl = document.getElementById('modalBookTitle');
        const authorEl = document.getElementById('modalBookAuthor');
        const btnDownload = document.getElementById('btnDownloadPdf');
        const btnDirect = document.getElementById('btnDirectPdfOpen');
        const btnLoadingDirect = document.getElementById('btnLoadingOpenDirectPdf');
        const loader = document.getElementById('flipLoading');
        const loadTitle = document.getElementById('flipLoadingTitle');
        const loadText = document.getElementById('flipLoadingText');
        const viewport = document.getElementById('flipbookViewport');

        if (titleEl) titleEl.innerText = book.title || 'Buku Digital';
        if (authorEl) authorEl.innerText = (book.author || 'PERSIS PERS') + (book.category ? ' (' + book.category + ')' : '');

        if (typeof resetFlipbookZoom === 'function') {
            resetFlipbookZoom();
        }

        const pdfUrl = book.pdf_url || (book.pdf_file ? (book.pdf_file.startsWith('http') ? book.pdf_file : '/storage/' + book.pdf_file) : null);

        if (btnDownload) {
            if (pdfUrl) {
                btnDownload.classList.remove('hidden');
                btnDownload.href = pdfUrl;
            } else {
                btnDownload.classList.add('hidden');
            }
        }

        if (pdfUrl) {
            if (btnDirect) {
                btnDirect.classList.remove('hidden');
                btnDirect.href = pdfUrl;
            }
            if (btnLoadingDirect) {
                btnLoadingDirect.classList.remove('hidden');
                btnLoadingDirect.href = pdfUrl;
            }
        } else {
            if (btnDirect) btnDirect.classList.add('hidden');
            if (btnLoadingDirect) btnLoadingDirect.classList.add('hidden');
        }

        if (modal) {
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
        }
        if (loader) {
            loader.classList.remove('hidden');
        }
        if (loadTitle) loadTitle.innerText = 'Menyiapkan Lembaran Buku Digital...';
        if (loadText) loadText.innerText = 'Memuat dokumen PDF & efek 3D...';

        if (viewport) {
            viewport.innerHTML = '<div id="bookFlipInstance" class="st-flip-container"></div>';
        }

        if (pdfUrl) {
            await renderPdfToFlipbook(pdfUrl, book);
        } else {
            renderImagesToFlipbook(book);
        }
    };

    async function renderPdfToFlipbook(pdfUrl, book) {
        const loader = document.getElementById('flipLoading');
        const loadText = document.getElementById('flipLoadingText');

        try {
            const loadingTask = window.pdfjsLib.getDocument(pdfUrl);
            const pdfDoc = await loadingTask.promise;
            const totalPages = pdfDoc.numPages;

            const slider = document.getElementById('flipPageSlider');
            if (slider) {
                slider.max = totalPages;
                slider.value = 1;
            }

            // Extract natural aspect ratio from first page
            const firstPage = await pdfDoc.getPage(1);
            const unscaledVp = firstPage.getViewport({ scale: 1.0 });
            currentBookRatio = unscaledVp.height / unscaledVp.width;

            // Optimal crisp resolution
            const renderScale = Math.min(2.0, Math.max(1.3, 1100 / unscaledVp.width));
            const images = [];

            for (let i = 1; i <= totalPages; i++) {
                if (loadText) loadText.innerText = `Memproses halaman ${i} dari ${totalPages}...`;
                const page = (i === 1) ? firstPage : await pdfDoc.getPage(i);
                const vp = page.getViewport({ scale: renderScale });

                const canvas = document.createElement('canvas');
                canvas.width = Math.round(vp.width);
                canvas.height = Math.round(vp.height);
                const ctx = canvas.getContext('2d', { alpha: false });

                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                await page.render({
                    canvasContext: ctx,
                    viewport: vp
                }).promise;

                // High quality JPEG data URL for smooth hardware accelerated flip
                images.push(canvas.toDataURL('image/jpeg', 0.90));
            }

            currentBookPages = images;
            initPageFlipWithImages(images, currentBookRatio);
            loader.classList.add('hidden');

        } catch (err) {
            console.warn('PDF.js render warning:', err);
            renderImagesToFlipbook(book);
        }
    }

    function renderImagesToFlipbook(book) {
        const loader = document.getElementById('flipLoading');
        const coverSrc = book.cover_url || (book.cover_image ? ('/storage/' + book.cover_image) : null);
        
        currentBookRatio = 1.414; // A4 standard ratio
        const cw = 700;
        const ch = Math.round(cw * currentBookRatio);
        const images = [];

        function createTextPage(heading, title, author, bodyText, footerText) {
            const canvas = document.createElement('canvas');
            canvas.width = cw;
            canvas.height = ch;
            const ctx = canvas.getContext('2d');

            ctx.fillStyle = '#fcfbf7';
            ctx.fillRect(0, 0, cw, ch);

            ctx.strokeStyle = '#e2e8f0';
            ctx.lineWidth = 4;
            ctx.strokeRect(30, 30, cw - 60, ch - 60);

            ctx.fillStyle = '#006830';
            ctx.font = 'bold 20px sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(heading || 'PERSIS PERS PRESS', cw / 2, 85);

            ctx.strokeStyle = '#006830';
            ctx.lineWidth = 1.5;
            ctx.beginPath();
            ctx.moveTo(80, 105);
            ctx.lineTo(cw - 80, 105);
            ctx.stroke();

            ctx.fillStyle = '#0f172a';
            ctx.font = 'bold 26px sans-serif';
            wrapText(ctx, title || '', cw / 2, 220, cw - 140, 36);

            ctx.fillStyle = '#059669';
            ctx.font = 'italic 18px sans-serif';
            ctx.fillText(author || '', cw / 2, 340);

            ctx.fillStyle = '#cbd5e1';
            ctx.fillRect(cw / 2 - 40, 375, 80, 3);

            ctx.fillStyle = '#475569';
            ctx.font = '16px sans-serif';
            wrapText(ctx, bodyText || '', cw / 2, 430, cw - 160, 26);

            ctx.fillStyle = '#94a3b8';
            ctx.font = '14px sans-serif';
            ctx.fillText(footerText || 'PERSIS PERS - E-Library Digital', cw / 2, ch - 70);

            return canvas.toDataURL('image/jpeg', 0.90);
        }

        function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
            const words = text.split(' ');
            let line = '';
            for (let n = 0; n < words.length; n++) {
                const testLine = line + words[n] + ' ';
                const metrics = ctx.measureText(testLine);
                if (metrics.width > maxWidth && n > 0) {
                    ctx.fillText(line, x, y);
                    line = words[n] + ' ';
                    y += lineHeight;
                } else {
                    line = testLine;
                }
            }
            ctx.fillText(line, x, y);
        }

        if (coverSrc) {
            images.push(coverSrc);
        } else {
            images.push(createTextPage('PERSIS PERS PRESS', book.title, book.author, book.synopsis || 'Koleksi Publikasi Ilmiah & Keislaman Terbitan PERSIS PERS.', 'Halaman Sampul Depan'));
        }

        images.push(createTextPage('KETERANGAN BUKU DIGITAL', book.title, 'Penulis: ' + (book.author || '-'), 'Kategori: ' + (book.category || '-') + '\nTahun: ' + (book.year || '-') + '\n\n' + (book.synopsis || 'Diterbitkan secara resmi oleh PERSIS PERS Bandung.'), 'Halaman Informasi'));
        images.push(createTextPage('PERSIS PERS BANDUNG', 'Khazanah Intelektual Islam', 'Menebar Pencerahan & Integrasi Keilmuan', 'Kunjungi katalog lengkap di: penerbitan.iaibandung.ac.id', 'Sampul Belakang'));

        currentBookPages = images;
        initPageFlipWithImages(images, currentBookRatio);
        loader.classList.add('hidden');
    }

    function initPageFlipWithImages(images, pageRatio) {
        if (pageFlipInstance) {
            try { pageFlipInstance.destroy(); } catch(e) {}
            pageFlipInstance = null;
        }

        const container = document.getElementById('bookFlipInstance');
        if (!container) return;

        const totalPages = images.length;
        document.getElementById('flipTotalPages').innerText = totalPages;
        const slider = document.getElementById('flipPageSlider');
        if (slider) slider.max = totalPages;

        const dims = calculateBookDimensions(pageRatio);

        if (window.St && window.St.PageFlip) {
            pageFlipInstance = new window.St.PageFlip(container, {
                width: dims.width,
                height: dims.height,
                size: 'fixed',
                minWidth: 260,
                maxWidth: 600,
                minHeight: 380,
                maxHeight: 850,
                maxShadowOpacity: 0.6,
                showCover: true,
                mobileScrollSupport: false,
                usePortrait: true,
                flippingTime: 700,
                swipeDistance: 20,
                clickEventForward: true,
                useMouseEvents: true,
                drawShadow: true
            });

            // Native high-performance image loading
            pageFlipInstance.loadFromImages(images);

            pageFlipInstance.on('flip', (e) => {
                playPaperTurnSound();
                const cur = e.data + 1;
                document.getElementById('flipCurrentPage').innerText = cur;
                if (slider) slider.value = cur;
            });

            pageFlipInstance.on('changeState', (e) => {
                if (e.data === 'flipping') playPaperTurnSound();
            });
        }
    }

    window.jumpToPage = function(val) {
        if (pageFlipInstance) {
            const idx = parseInt(val) - 1;
            if (idx >= 0) {
                pageFlipInstance.turnToPage(idx);
            }
        }
    };

    window.flipbookNext = function() {
        if (pageFlipInstance) pageFlipInstance.flipNext();
    };

    window.flipbookPrev = function() {
        if (pageFlipInstance) pageFlipInstance.flipPrev();
    };

    // ==============================================================
    // FLIPBOOK ZOOM & PAN CONTROLS (ENHANCED READABILITY)
    // ==============================================================
    let currentZoomScale = 1.0;
    let panTranslateX = 0;
    let panTranslateY = 0;
    let isPanning = false;
    let panStartX = 0;
    let panStartY = 0;

    function updateZoomTransform() {
        const viewport = document.getElementById('flipbookViewport');
        const zoomText = document.getElementById('zoomLevelText');
        const bookInstanceEl = document.getElementById('bookFlipInstance');
        if (zoomText) zoomText.innerText = Math.round(currentZoomScale * 100) + '%';

        if (viewport) {
            if (currentZoomScale > 1.0) {
                viewport.classList.add('is-zoomed');
                viewport.style.transform = `scale(${currentZoomScale}) translate(${panTranslateX}px, ${panTranslateY}px)`;
                // Matikan deteksi mouse/touch langsung pada lembaran canvas agar StPageFlip TIDAK membalik halaman saat digeser
                if (bookInstanceEl) bookInstanceEl.style.pointerEvents = 'none';
            } else {
                viewport.classList.remove('is-zoomed');
                viewport.classList.remove('is-dragging');
                currentZoomScale = 1.0;
                panTranslateX = 0;
                panTranslateY = 0;
                viewport.style.transform = '';
                // Aktifkan kembali deteksi tarik kertas saat skala normal 100%
                if (bookInstanceEl) bookInstanceEl.style.pointerEvents = '';
            }
        }
    }

    window.zoomFlipbook = function(step) {
        let newScale = Math.round((currentZoomScale + step) * 100) / 100;
        if (newScale < 0.8) newScale = 0.8;
        if (newScale > 2.5) newScale = 2.5;
        currentZoomScale = newScale;
        if (currentZoomScale <= 1.0) {
            panTranslateX = 0;
            panTranslateY = 0;
        }
        updateZoomTransform();
    };

    window.resetFlipbookZoom = function() {
        currentZoomScale = 1.0;
        panTranslateX = 0;
        panTranslateY = 0;
        updateZoomTransform();
    };

    // Pan Dragging Setup (Murni untuk Menjelajah Teks Buku Saat Zoom)
    const stageEl = document.getElementById('flipbookStageContainer');
    const viewportEl = document.getElementById('flipbookViewport');

    if (stageEl && viewportEl) {
        // Gunakan Capture Phase (true) agar event mousedown tidak pernah sampai ke engine PageFlip saat zoom
        stageEl.addEventListener('mousedown', (e) => {
            if (currentZoomScale > 1.0 && (e.button === 0 || e.button === 1) && !e.target.closest('button')) {
                isPanning = true;
                panStartX = e.clientX - (panTranslateX * currentZoomScale);
                panStartY = e.clientY - (panTranslateY * currentZoomScale);
                viewportEl.classList.add('is-dragging');
                e.preventDefault();
                e.stopPropagation();
            }
        }, true);

        window.addEventListener('mousemove', (e) => {
            if (isPanning && currentZoomScale > 1.0) {
                panTranslateX = (e.clientX - panStartX) / currentZoomScale;
                panTranslateY = (e.clientY - panStartY) / currentZoomScale;
                viewportEl.style.transform = `scale(${currentZoomScale}) translate(${panTranslateX}px, ${panTranslateY}px)`;
            }
        });

        window.addEventListener('mouseup', () => {
            if (isPanning) {
                isPanning = false;
                if (viewportEl) viewportEl.classList.remove('is-dragging');
            }
        });

        // Double click to zoom in / reset
        stageEl.addEventListener('dblclick', (e) => {
            if (e.target.closest('button')) return;
            if (currentZoomScale <= 1.0) {
                currentZoomScale = 1.5;
            } else {
                currentZoomScale = 1.0;
                panTranslateX = 0;
                panTranslateY = 0;
            }
            updateZoomTransform();
        });

        // Mouse Wheel Zoom with Ctrl
        stageEl.addEventListener('wheel', (e) => {
            if (e.ctrlKey) {
                e.preventDefault();
                if (e.deltaY < 0) {
                    zoomFlipbook(0.15);
                } else {
                    zoomFlipbook(-0.15);
                }
            }
        }, { passive: false });
    }

    window.closeFlipbookModal = function() {
        const modal = document.getElementById('flipbookModal');
        if (modal) {
            modal.style.display = 'none';
            modal.classList.add('hidden');
        }
        try {
            const url = new URL(window.location.href);
            url.searchParams.delete('baca');
            window.history.replaceState({}, '', url.toString());
        } catch(e) {}
        resetFlipbookZoom();
        if (pageFlipInstance) {
            try { pageFlipInstance.destroy(); } catch(e) {}
            pageFlipInstance = null;
        }
    };

    window.toggleFlipbookFullscreen = function() {
        const el = document.getElementById('flipbookModal');
        if (!document.fullscreenElement) {
            if (el.requestFullscreen) el.requestFullscreen();
            else if (el.webkitRequestFullscreen) el.webkitRequestFullscreen();
        } else {
            if (document.exitFullscreen) document.exitFullscreen();
        }
    };

    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const modal = document.getElementById('flipbookModal');
            if (modal && modal.style.display !== 'none' && currentBookPages.length > 0 && pageFlipInstance) {
                const currentPage = pageFlipInstance.getCurrentPageIndex();
                initPageFlipWithImages(currentBookPages, currentBookRatio);
                if (pageFlipInstance && currentPage > 0) {
                    try { pageFlipInstance.turnToPage(currentPage); } catch(e) {}
                }
            }
        }, 300);
    });

    window.addEventListener('orientationchange', () => {
        setTimeout(() => {
            const modal = document.getElementById('flipbookModal');
            if (modal && modal.style.display !== 'none' && currentBookPages.length > 0 && pageFlipInstance) {
                const currentPage = pageFlipInstance.getCurrentPageIndex();
                initPageFlipWithImages(currentBookPages, currentBookRatio);
                if (pageFlipInstance && currentPage > 0) {
                    try { pageFlipInstance.turnToPage(currentPage); } catch(e) {}
                }
            }
        }, 200);
    });

    // Touch Swipe Gestures for Mobile & Touch Pan saat Zoom
    let touchStartX = 0;
    let touchStartY = 0;
    const stageContainerEl = document.getElementById('flipbookStageContainer');
    if (stageContainerEl) {
        stageContainerEl.addEventListener('touchstart', (e) => {
            if (e.touches && e.touches.length > 0) {
                touchStartX = e.touches[0].clientX;
                touchStartY = e.touches[0].clientY;
                if (currentZoomScale > 1.0) {
                    isPanning = true;
                    panStartX = e.touches[0].clientX - (panTranslateX * currentZoomScale);
                    panStartY = e.touches[0].clientY - (panTranslateY * currentZoomScale);
                }
            }
        }, { passive: true });

        stageContainerEl.addEventListener('touchmove', (e) => {
            if (isPanning && currentZoomScale > 1.0 && e.touches && e.touches.length > 0) {
                panTranslateX = (e.touches[0].clientX - panStartX) / currentZoomScale;
                panTranslateY = (e.touches[0].clientY - panStartY) / currentZoomScale;
                viewportEl.style.transform = `scale(${currentZoomScale}) translate(${panTranslateX}px, ${panTranslateY}px)`;
            }
        }, { passive: true });

        stageContainerEl.addEventListener('touchend', (e) => {
            if (currentZoomScale > 1.0) {
                isPanning = false;
                return; // KUNCI: Jangan pernah membalik halaman saat sedang di-zoom!
            }
            if (e.changedTouches && e.changedTouches.length > 0) {
                const diffX = e.changedTouches[0].clientX - touchStartX;
                const diffY = e.changedTouches[0].clientY - touchStartY;
                if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
                    if (diffX < 0) {
                        flipbookNext();
                    } else {
                        flipbookPrev();
                    }
                }
            }
        }, { passive: true });
    }

    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('flipbookModal');
        if (modal && !modal.classList.contains('hidden') && modal.style.display !== 'none') {
            if (e.key === 'ArrowRight' || e.key === 'PageDown' || e.key === ' ') {
                e.preventDefault();
                flipbookNext();
            } else if (e.key === 'ArrowLeft' || e.key === 'PageUp') {
                e.preventDefault();
                flipbookPrev();
            } else if (e.key === 'Escape') {
                e.preventDefault();
                closeFlipbookModal();
            }
        }
    });

    // ==============================================================
    // 3. MODAL DOWNLOAD & DONASI DIGITAL LOGIC
    // ==============================================================
    let currentDonationBook = null;

    window.openDownloadDonationModal = function(book) {
        if (typeof book === 'string') {
            book = window.decodeBookData(book);
        }
        if (!book) return;
        currentDonationBook = book;
        
        document.getElementById('donModalBookTitle').innerText = book.title || 'Buku Digital Persis Pers';
        document.getElementById('donModalBookAuthor').innerText = (book.author || 'PERSIS PERS') + ' • ' + (book.category || 'Buku Digital');
        document.getElementById('formBookId').value = book.id || '';
        
        const modal = document.getElementById('downloadDonationModal');
        modal.style.display = 'flex';
        modal.classList.remove('hidden');
    };

    window.closeDownloadDonationModal = function() {
        const modal = document.getElementById('downloadDonationModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
    };

    window.switchDonationTab = function(method) {
        const qrisBtn = document.getElementById('tabBtnQris');
        const tfBtn = document.getElementById('tabBtnTransfer');
        const qrisContent = document.getElementById('contentTabQris');
        const tfContent = document.getElementById('contentTabTransfer');
        const methodInput = document.getElementById('formPaymentMethod');

        if (method === 'qris') {
            qrisBtn.className = 'py-2 px-3 rounded-xs font-bold text-xs flex items-center justify-center gap-2 border transition cursor-pointer bg-[#006830] text-white border-[#006830]';
            tfBtn.className = 'py-2 px-3 rounded-xs font-bold text-xs flex items-center justify-center gap-2 border transition cursor-pointer bg-slate-100 text-slate-700 border-slate-300 hover:bg-slate-200';
            qrisContent.classList.remove('hidden');
            tfContent.classList.add('hidden');
            methodInput.value = 'qris';
        } else {
            tfBtn.className = 'py-2 px-3 rounded-xs font-bold text-xs flex items-center justify-center gap-2 border transition cursor-pointer bg-[#006830] text-white border-[#006830]';
            qrisBtn.className = 'py-2 px-3 rounded-xs font-bold text-xs flex items-center justify-center gap-2 border transition cursor-pointer bg-slate-100 text-slate-700 border-slate-300 hover:bg-slate-200';
            tfContent.classList.remove('hidden');
            qrisContent.classList.add('hidden');
            methodInput.value = 'transfer';
        }
    };

    window.formatNumberWithDots = function(num) {
        if (!num && num !== 0) return '';
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    };

    window.pickNominal = function(amount, btn) {
        document.querySelectorAll('.nominal-chip').forEach(el => {
            el.className = 'nominal-chip py-1.5 px-2 rounded-xs border border-slate-300 bg-white hover:border-emerald-600 font-bold text-slate-800 transition cursor-pointer text-center';
        });
        if (btn) {
            btn.className = 'nominal-chip py-1.5 px-2 rounded-xs border border-emerald-700 bg-emerald-50 text-emerald-900 font-bold text-center transition cursor-pointer';
        }
        
        const formatted = window.formatNumberWithDots(amount);
        const input = document.getElementById('customNominalInput');
        if (input) input.value = formatted;
        
        const formAmt = document.getElementById('formAmount');
        if (formAmt) formAmt.value = amount;
    };

    window.handleCustomNominalChange = function(inputEl) {
        document.querySelectorAll('.nominal-chip').forEach(el => {
            el.className = 'nominal-chip py-1.5 px-2 rounded-xs border border-slate-300 bg-white hover:border-emerald-600 font-bold text-slate-800 transition cursor-pointer text-center';
        });

        let rawVal = inputEl.value.replace(/\D/g, '');
        if (rawVal) {
            const num = parseInt(rawVal, 10);
            inputEl.value = window.formatNumberWithDots(num);
            const formAmt = document.getElementById('formAmount');
            if (formAmt) formAmt.value = num;
        } else {
            inputEl.value = '';
            const formAmt = document.getElementById('formAmount');
            if (formAmt) formAmt.value = 0;
        }
    };

    window.toggleDonationForm = function() {
        const form = document.getElementById('donationConfirmForm');
        const chevron = document.getElementById('formChevron');
        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
            chevron.style.transform = 'rotate(180deg)';
            const input = document.getElementById('donorNameInput');
            if (input) input.focus();
        } else {
            form.classList.add('hidden');
            chevron.style.transform = 'rotate(0deg)';
        }
    };

    window.copyBankAccountNumber = function() {
        const num = document.getElementById('bankAccountNum').innerText.trim();
        navigator.clipboard.writeText(num).then(() => {
            const label = document.getElementById('copyTextLabel');
            label.innerText = 'Tersalin!';
            setTimeout(() => { label.innerText = 'Salin'; }, 2500);
        });
    };

    window.directDownloadCurrentBook = function() {
        if (!currentDonationBook) return;
        const pdfUrl = currentDonationBook.pdf_url || (currentDonationBook.pdf_file ? (currentDonationBook.pdf_file.startsWith('http') ? currentDonationBook.pdf_file : '/storage/' + currentDonationBook.pdf_file) : null);
        if (pdfUrl) {
            window.open(pdfUrl, '_blank');
        } else if (currentDonationBook.slug) {
            window.open('/katalog-digital/download/' + currentDonationBook.slug, '_blank');
        } else {
            alert('File PDF buku ini sedang disiapkan oleh admin.');
        }
        closeDownloadDonationModal();
    };

    window.submitDonationData = async function(e) {
        e.preventDefault();
        const form = document.getElementById('donationConfirmForm');
        const submitBtn = document.getElementById('btnSubmitDonation');
        const originalText = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Menyimpan Donasi...';

        const formData = new FormData(form);

        try {
            const response = await fetch("{{ route('donasi.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const res = await response.json();
            if (res.success) {
                alert(res.message || 'Jazakumullah Khairan Katsiran! Donasi Anda telah kami catat.');
                form.reset();
                closeDownloadDonationModal();
                if (res.download_url) {
                    window.open(res.download_url, '_blank');
                } else {
                    directDownloadCurrentBook();
                }
            } else {
                alert(res.message || 'Terjadi kesalahan saat menyimpan donasi.');
            }
        } catch (err) {
            alert('Gagal mengirim konfirmasi donasi. Silakan periksa koneksi internet.');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }
    };

    // =========================================================================
    // MEMBER BOOKMARK TOGGLE HANDLER
    // =========================================================================
    window.toggleBookBookmark = async function(bookId, btnEl) {
        if (!bookId) return;

        const originalHtml = btnEl.innerHTML;
        btnEl.disabled = true;

        try {
            const response = await fetch(`/katalog-digital/bookmark/${bookId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            if (response.status === 401) {
                const res = await response.json();
                if (confirm(res.message || 'Silakan login sebagai member untuk menyimpan buku ini ke Buku Digital Saya. Masuk sekarang?')) {
                    window.location.href = res.login_url || "{{ route('member.login') }}";
                }
                btnEl.disabled = false;
                btnEl.innerHTML = originalHtml;
                return;
            }

            const res = await response.json();
            btnEl.disabled = false;

            if (res.success) {
                const isBookmarked = res.bookmarked;
                btnEl.setAttribute('data-bookmarked', isBookmarked ? '1' : '0');

                if (isBookmarked) {
                    btnEl.className = 'px-2 py-0.5 rounded-xs border transition flex items-center gap-1 text-[9.5px] font-bold cursor-pointer select-none bg-amber-500 text-white border-amber-600 shadow-2xs animate-pulse';
                    btnEl.innerHTML = '<i class="fa-solid fa-bookmark text-white"></i> <span class="bookmark-btn-label">Tersimpan</span>';
                    btnEl.title = 'Tersimpan di Buku Digital Saya (Klik untuk batal)';
                    setTimeout(() => btnEl.classList.remove('animate-pulse'), 1000);
                } else {
                    btnEl.className = 'px-2 py-0.5 rounded-xs border transition flex items-center gap-1 text-[9.5px] font-bold cursor-pointer select-none bg-white hover:bg-slate-50 text-slate-600 border-slate-200';
                    btnEl.innerHTML = '<i class="fa-regular fa-bookmark text-amber-500"></i> <span class="bookmark-btn-label">Simpan</span>';
                    btnEl.title = 'Simpan / Bookmark ke Buku Digital Saya';
                }

                // Show Toast Notification
                showBookmarkToast(res.message, isBookmarked, res.member_url);
            } else {
                alert(res.message || 'Gagal mengubah bookmark.');
                btnEl.innerHTML = originalHtml;
            }
        } catch (err) {
            btnEl.disabled = false;
            btnEl.innerHTML = originalHtml;
            console.error('Bookmark error:', err);
            alert('Terjadi kesalahan jaringan saat memproses bookmark.');
        }
    };

    function showBookmarkToast(message, isAdded, memberUrl) {
        let toast = document.getElementById('bookmarkToastNotification');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'bookmarkToastNotification';
            toast.className = 'fixed bottom-5 right-5 z-[9999] max-w-sm bg-slate-900 text-white p-3.5 rounded-sm shadow-2xl border border-slate-700 flex items-center gap-3 transition-all duration-300 transform translate-y-10 opacity-0';
            document.body.appendChild(toast);
        }

        const iconHtml = isAdded 
            ? '<div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0"><i class="fa-solid fa-bookmark text-xs"></i></div>'
            : '<div class="w-8 h-8 rounded-full bg-slate-800 text-slate-400 border border-slate-700 flex items-center justify-center shrink-0"><i class="fa-regular fa-bookmark text-xs"></i></div>';

        const actionBtnHtml = isAdded && memberUrl 
            ? `<a href="${memberUrl}" class="ml-auto px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xs text-[10px] font-bold shrink-0 transition flex items-center gap-1"><span>Buku Saya</span><i class="fa-solid fa-arrow-right text-[8px]"></i></a>`
            : '';

        toast.innerHTML = `
            ${iconHtml}
            <div class="min-w-0 flex-1">
                <p class="text-xs font-bold text-slate-100 leading-snug">${message}</p>
            </div>
            ${actionBtnHtml}
        `;

        toast.classList.remove('translate-y-10', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        if (window._bookmarkToastTimer) clearTimeout(window._bookmarkToastTimer);
        window._bookmarkToastTimer = setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-10', 'opacity-0');
        }, 4000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        try {
            const params = new URLSearchParams(window.location.search);
            const bacaId = params.get('baca');
            if (bacaId) {
                setTimeout(function() {
                    let found = false;
                    document.querySelectorAll('[data-book]').forEach(el => {
                        if (found) return;
                        const b = window.decodeBookData(el.getAttribute('data-book'));
                        if (b && (b.id == bacaId || b.id === parseInt(bacaId, 10))) {
                            found = true;
                            window.openFlipbookReader(b);
                        }
                    });
                }, 350);
            }
        } catch(e) {}
    });

    @if(isset($activeBook) && $activeBook)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                openFlipbookReader({!! json_encode($activeBook) !!});
            }, 400);
        });
    @endif
</script>
@endsection
