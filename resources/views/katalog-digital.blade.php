@extends('layouts.app')

@section('title', 'Katalog Buku Digital & Perpustakaan Interaktif | PERSIS PERS')

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
    <section class="bg-gradient-to-r from-[#032c21] via-[#006830] to-[#032c21] text-white py-8 sm:py-10 border-b border-emerald-900/60 relative overflow-hidden select-none">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-200 text-xs font-bold uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-book-open-reader text-xs"></i>
                        <span>E-Library Digital &bull; 3D Page Flip</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black font-heading tracking-tight leading-tight">
                        Katalog Buku Digital &amp; Perpustakaan
                    </h1>
                    <p class="text-xs sm:text-sm text-emerald-100/90 max-w-2xl mt-1.5 leading-relaxed">
                        Koleksi literatur keislaman, modul riset, dan karya ilmiah digital terbitan PERSIS PERS. Dilengkapi fitur animasi buka lembaran buku (*3D Flipbook*) langsung di browser.
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <div class="px-4 py-2.5 bg-black/25 border border-white/10 rounded-sm backdrop-blur-xs text-center">
                        <span class="text-xs text-emerald-300 font-bold block uppercase tracking-wider">Total Judul</span>
                        <span class="text-xl sm:text-2xl font-black font-mono text-white">{{ $totalDigitalBooks }}</span>
                    </div>
                    <div class="px-4 py-2.5 bg-emerald-900/50 border border-emerald-400/30 rounded-sm backdrop-blur-xs text-center">
                        <span class="text-xs text-emerald-200 font-bold block uppercase tracking-wider">Flipbook Ready</span>
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
                        @endphp
                        <div class="persis-book-card p-4">
                            
                            <!-- Top Details & 3D Cover -->
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 truncate">
                                        {{ $book->category }}
                                    </span>
                                    @if($pdfUrl)
                                        <span class="px-1.5 py-0.5 rounded-xs text-[9px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-300 flex items-center gap-1 shrink-0" title="File PDF Siap Dibaca">
                                            <i class="fa-solid fa-file-pdf text-[8px] text-emerald-700"></i>
                                            <span>PDF Ready</span>
                                        </span>
                                    @endif
                                </div>

                                <!-- 3D Perspective Stage -->
                                <div class="book-cover-stage-3d w-36 aspect-[3/4.2] mx-auto py-2 cursor-pointer" onclick="openFlipbookReader({{ json_encode($book) }})" title="Klik untuk Buka Buku (Flipbook)">
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
                                    <h3 class="text-xs sm:text-[13px] font-extrabold text-slate-900 line-clamp-2 leading-snug hover:text-emerald-800 transition cursor-pointer" onclick="openFlipbookReader({{ json_encode($book) }})">
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

                            <!-- Action Button -->
                            <div class="pt-4 border-t border-slate-100 mt-3">
                                <button type="button" 
                                        onclick="openFlipbookReader({{ json_encode($book) }})" 
                                        class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
                                    <i class="fa-solid fa-book-open-reader text-xs"></i>
                                    <span>Buka &amp; Baca (Flipbook)</span>
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
<div id="flipbookModal" class="fixed inset-0 z-[99999] bg-black/90 hidden items-center justify-center p-2 sm:p-4 select-none animate-fade-in" style="display: none;">
    <div class="w-full max-w-5xl h-[94vh] flex flex-col justify-between bg-slate-950 rounded-sm border border-slate-800 shadow-2xl overflow-hidden relative">
        
        <!-- Top Toolbar -->
        <div class="bg-slate-900 border-b border-slate-800 px-4 py-2.5 flex items-center justify-between text-white shrink-0">
            <div class="flex items-center gap-3 min-w-0 pr-3">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                <div class="min-w-0">
                    <h3 id="modalBookTitle" class="text-xs sm:text-sm font-black text-white truncate font-heading">
                        Judul Buku Digital
                    </h3>
                    <p id="modalBookAuthor" class="text-[10.5px] text-emerald-400 truncate">
                        Penulis Buku
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2 shrink-0">
                <a id="btnDownloadPdf" href="#" target="_blank" class="hidden px-2.5 py-1.5 rounded-xs bg-slate-800 hover:bg-slate-700 text-slate-200 hover:text-white text-xs font-bold transition flex items-center gap-1.5 border border-slate-700" title="Buka / Unduh File PDF Asli">
                    <i class="fa-solid fa-file-arrow-down text-emerald-400 text-xs"></i>
                    <span class="hidden sm:inline">PDF Asli</span>
                </a>
                
                <button type="button" onclick="toggleFlipbookFullscreen()" class="p-1.5 px-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xs text-xs transition" title="Layar Penuh">
                    <i class="fa-solid fa-expand"></i>
                </button>

                <button type="button" onclick="closeFlipbookModal()" class="w-8 h-8 rounded-xs bg-rose-600/80 hover:bg-rose-600 text-white flex items-center justify-center text-xs transition cursor-pointer" title="Tutup Pembaca (Esc)">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Middle: Flipbook Stage Area -->
        <div class="flex-1 flex items-center justify-center p-2 sm:p-4 overflow-hidden relative" id="flipbookStageContainer">
            
            <!-- Loading Indicator -->
            <div id="flipLoading" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-950/85 text-white z-50">
                <i class="fa-solid fa-circle-notch fa-spin text-3xl text-emerald-500 mb-3"></i>
                <p id="flipLoadingTitle" class="text-xs font-bold tracking-wide text-slate-200">Menyiapkan Lembaran Buku Digital...</p>
                <p id="flipLoadingText" class="text-[10px] text-emerald-400 mt-1 font-mono">Memuat halaman PDF &amp; efek flip 3D</p>
            </div>

            <!-- Floating Navigation Buttons -->
            <button type="button" onclick="flipbookPrev()" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 z-40 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-900/80 hover:bg-emerald-600 text-white flex items-center justify-center shadow-xl transition backdrop-blur-xs border border-slate-700/80 cursor-pointer group active:scale-95" title="Halaman Sebelumnya (Panah Kiri)">
                <i class="fa-solid fa-chevron-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
            </button>

            <button type="button" onclick="flipbookNext()" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 z-40 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-slate-900/80 hover:bg-emerald-600 text-white flex items-center justify-center shadow-xl transition backdrop-blur-xs border border-slate-700/80 cursor-pointer group active:scale-95" title="Halaman Berikutnya (Panah Kanan)">
                <i class="fa-solid fa-chevron-right text-sm group-hover:translate-x-0.5 transition-transform"></i>
            </button>

            <!-- Viewport for StPageFlip Native Engine -->
            <div class="flip-viewport" id="flipbookViewport">
                <div id="bookFlipInstance" class="st-flip-container"></div>
            </div>

        </div>

        <!-- Bottom Controls Bar -->
        <div class="bg-slate-900 border-t border-slate-800 px-4 py-2.5 flex items-center justify-between text-white shrink-0 text-xs">
            <div class="hidden sm:flex items-center gap-2 text-slate-400 text-[11px]">
                <i class="fa-solid fa-hand-pointer text-emerald-400"></i>
                <span>Tarik sudut kertas atau klik tombol panah</span>
            </div>

            <div class="flex items-center gap-2 mx-auto sm:mx-0">
                <button type="button" onclick="flipbookPrev()" class="px-3 py-1.5 bg-slate-800 hover:bg-emerald-700 text-white rounded-xs font-bold transition flex items-center gap-1 border border-slate-700 shadow-2xs cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </button>

                <div class="px-3 py-1 bg-slate-950 border border-slate-800 rounded-xs font-mono font-bold text-emerald-400 text-xs flex items-center gap-1.5">
                    <span id="flipCurrentPage">1</span>
                    <span class="text-slate-600">/</span>
                    <span id="flipTotalPages" class="text-slate-400">1</span>
                </div>

                <input type="range" id="flipPageSlider" min="1" max="1" value="1" oninput="jumpToPage(this.value)" class="hidden md:block w-24 sm:w-28 accent-emerald-500 h-1 bg-slate-800 rounded-lg cursor-pointer" title="Geser Lembaran Halaman">

                <button type="button" onclick="flipbookNext()" class="px-3 py-1.5 bg-slate-800 hover:bg-emerald-700 text-white rounded-xs font-bold transition flex items-center gap-1 border border-slate-700 shadow-2xs cursor-pointer">
                    <span class="hidden sm:inline">Berikutnya</span>
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
        const maxH = stage ? Math.max(380, stage.clientHeight - 40) : 560;
        const maxW = stage ? Math.max(300, stage.clientWidth - 50) : 800;

        const isMobile = window.innerWidth < 768;

        let pageHeight, pageWidth;

        if (isMobile) {
            pageHeight = Math.min(maxH, Math.round(maxW * pageRatio));
            pageWidth = Math.round(pageHeight / pageRatio);
            if (pageWidth > maxW) {
                pageWidth = maxW;
                pageHeight = Math.round(pageWidth * pageRatio);
            }
        } else {
            // Dual page spread on desktop
            const availableWidthForOnePage = Math.floor((maxW - 70) / 2);
            pageHeight = Math.min(maxH, Math.round(availableWidthForOnePage * pageRatio));
            pageWidth = Math.round(pageHeight / pageRatio);
            
            if (pageWidth > availableWidthForOnePage) {
                pageWidth = availableWidthForOnePage;
                pageHeight = Math.round(pageWidth * pageRatio);
            }
        }

        return {
            width: Math.max(260, Math.round(pageWidth)),
            height: Math.max(380, Math.round(pageHeight)),
            isMobile
        };
    }

    window.openFlipbookReader = async function(book) {
        const modal = document.getElementById('flipbookModal');
        const titleEl = document.getElementById('modalBookTitle');
        const authorEl = document.getElementById('modalBookAuthor');
        const btnDownload = document.getElementById('btnDownloadPdf');
        const loader = document.getElementById('flipLoading');
        const loadTitle = document.getElementById('flipLoadingTitle');
        const loadText = document.getElementById('flipLoadingText');
        const viewport = document.getElementById('flipbookViewport');

        if (titleEl) titleEl.innerText = book.title;
        if (authorEl) authorEl.innerText = book.author + ' (' + book.category + ')';

        const pdfUrl = book.pdf_url || (book.pdf_file ? (book.pdf_file.startsWith('http') ? book.pdf_file : '/storage/' + book.pdf_file) : null);

        if (pdfUrl) {
            btnDownload.classList.remove('hidden');
            btnDownload.href = pdfUrl;
        } else {
            btnDownload.classList.add('hidden');
        }

        modal.style.display = 'flex';
        modal.classList.remove('hidden');
        loader.classList.remove('hidden');
        if (loadTitle) loadTitle.innerText = 'Menyiapkan Lembaran Buku Digital...';
        if (loadText) loadText.innerText = 'Memuat dokumen PDF & efek 3D...';

        viewport.innerHTML = '<div id="bookFlipInstance" class="st-flip-container"></div>';

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

    window.closeFlipbookModal = function() {
        const modal = document.getElementById('flipbookModal');
        modal.style.display = 'none';
        modal.classList.add('hidden');
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

    @if(isset($activeBook) && $activeBook)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                openFlipbookReader({!! json_encode($activeBook) !!});
            }, 400);
        });
    @endif
</script>
@endsection
