@extends('layouts.app')

@section('title', 'Katalog Buku Digital & Perpustakaan Interaktif | PERSIS PERS')

@section('content')
<style>
    /* 1. Perspective & 3D Stage */
    .digital-stage-3d {
        perspective: 1200px;
    }
    .digital-book-card {
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .digital-book-card:hover {
        border-color: #006830;
        transform: translateY(-4px);
        box-shadow: 0 16px 32px -8px rgba(0, 104, 48, 0.16), 0 2px 6px rgba(0,0,0,0.04);
    }
    .digital-cover-3d {
        transform-style: preserve-3d;
        transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
        box-shadow: 6px 8px 18px -3px rgba(0, 0, 0, 0.28), 1px 1px 4px rgba(0,0,0,0.1);
    }
    .digital-book-card:hover .digital-cover-3d {
        transform: rotateY(-16deg) rotateX(5deg) translateY(-3px) scale(1.02);
        box-shadow: 14px 22px 28px -4px rgba(0, 0, 0, 0.38), 3px 3px 8px rgba(0,0,0,0.15);
    }
    .book-spine-line {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 7px;
        background: linear-gradient(90deg, rgba(255,255,255,0.4) 0%, rgba(0,0,0,0.06) 50%, rgba(0,0,0,0.35) 100%);
        border-right: 1px solid rgba(0,0,0,0.15);
        z-index: 10;
    }
    .book-edge-paper {
        position: absolute;
        right: 0;
        top: 3px;
        bottom: 3px;
        width: 4px;
        background: repeating-linear-gradient(180deg, #f8fafc, #f8fafc 1.5px, #cbd5e1 1.5px, #cbd5e1 3px);
        border-left: 1px solid #94a3b8;
        border-radius: 0 2px 2px 0;
        z-index: 5;
    }

    /* 2. Realistic Flipbook Modal Viewer */
    #flipbookModal {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .flip-viewport {
        width: 100%;
        max-width: 980px;
        height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 0 auto;
        user-select: none;
    }
    @media (max-width: 768px) {
        .flip-viewport {
            height: 480px;
            max-width: 100%;
        }
    }

    /* StPageFlip Styling */
    .st-flip-container {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.65), 0 0 40px rgba(0, 104, 48, 0.2);
        border-radius: 4px;
        overflow: hidden;
        background: #fdfbf7;
    }
    .page-sheet {
        background-color: #fdfbf7;
        box-shadow: inset 0 0 30px rgba(0,0,0,0.03);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .page-sheet canvas, .page-sheet img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Fallback CSS 3D Book Page */
    .css-flip-spread {
        perspective: 1800px;
        display: flex;
        width: 100%;
        height: 100%;
        max-width: 860px;
        max-height: 580px;
        background: #1e293b;
        border-radius: 6px;
        padding: 12px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
    }
    .css-flip-page {
        flex: 1;
        background: #fdfbf7;
        box-shadow: inset 0 0 20px rgba(0,0,0,0.06);
        border-radius: 3px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        padding: 16px;
        position: relative;
    }
    .css-flip-page.left {
        border-right: 1px solid #cbd5e1;
        box-shadow: inset -10px 0 20px -5px rgba(0,0,0,0.1);
    }
    .css-flip-page.right {
        border-left: 1px solid #cbd5e1;
        box-shadow: inset 10px 0 20px -5px rgba(0,0,0,0.1);
    }
</style>

<!-- Top Banner Section (Signature Islamic Green) -->
<section class="bg-gradient-to-r from-[#032c21] via-[#006830] to-[#032c21] text-white py-8 sm:py-12 border-b border-emerald-900/60 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#34d399 1px, transparent 1px); background-size: 20px 20px;"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-200 text-xs font-bold uppercase tracking-wider mb-2">
                    <i class="fa-solid fa-book-open-reader text-xs"></i>
                    <span>E-Library &amp; Interactive Flipbook</span>
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black font-heading tracking-tight leading-tight">
                    Katalog Buku &amp; Perpustakaan Digital
                </h1>
                <p class="text-xs sm:text-sm text-emerald-100/90 max-w-2xl mt-1.5 leading-relaxed">
                    Akses koleksi buku ilmiah, modul ajar, dan khazanah literatur keislaman terbitan PERSIS PERS dengan animasi membalik lembaran kertas (*3D Page Flip*) layaknya buku fisik.
                </p>
            </div>

            <!-- Stats Highlight -->
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

        <!-- Search Bar Inside Banner -->
        <div class="mt-6 max-w-2xl">
            <form action="{{ route('katalog.digital') }}" method="GET" class="relative flex items-center">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}" />
                @endif
                <div class="relative w-full">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}" 
                           placeholder="Cari judul buku, topik keislaman, atau nama penulis..." 
                           class="w-full pl-10 pr-24 py-3 bg-white text-slate-800 text-xs sm:text-sm rounded-sm shadow-lg border border-slate-200 focus:outline-hidden focus:ring-2 focus:ring-emerald-400 font-medium placeholder:text-slate-400" />
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    
                    @if(request('q'))
                        <a href="{{ route('katalog.digital', ['kategori' => request('kategori')]) }}" class="absolute right-20 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-xs px-2" title="Hapus">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif

                    <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition shadow-xs">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Main Container with 2-Column Sidebar Layout (Inspirasi perpustakaanislamdigital.com) -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
        
        <!-- SIDEBAR: KATEGORI KITAB & BUKU (Left Column) -->
        <aside class="lg:col-span-1 space-y-6">
            
            <!-- Category Navigation Card -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="bg-[#006830] px-4 py-3 text-white flex items-center justify-between">
                    <h3 class="font-bold text-xs uppercase tracking-wider font-heading flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-emerald-300"></i>
                        <span>Kategori Buku</span>
                    </h3>
                    <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded-full font-mono font-bold">{{ count($categoryStats) }} Bidang</span>
                </div>

                <div class="p-2 divide-y divide-slate-100 text-xs">
                    <!-- Semua Kategori -->
                    <a href="{{ route('katalog.digital', array_merge(request()->except('kategori', 'page'))) }}" 
                       class="flex items-center justify-between px-3 py-2.5 rounded-xs transition {{ ($activeCategory === 'all' || empty($activeCategory)) ? 'bg-emerald-50 text-[#006830] font-bold border-l-4 border-[#006830]' : 'text-slate-700 hover:bg-slate-50 font-medium' }}">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-book-bookmark {{ ($activeCategory === 'all' || empty($activeCategory)) ? 'text-emerald-700' : 'text-slate-400' }} text-xs"></i>
                            <span>Semua Kategori</span>
                        </span>
                        <span class="font-mono text-[11px] {{ ($activeCategory === 'all' || empty($activeCategory)) ? 'text-emerald-800 font-bold' : 'text-slate-400' }}">{{ $totalDigitalBooks }}</span>
                    </a>

                    <!-- Category Items Loop -->
                    @foreach($categoryStats as $cat)
                        <a href="{{ route('katalog.digital', array_merge(request()->except('kategori', 'page'), ['kategori' => $cat->category])) }}" 
                           class="flex items-center justify-between px-3 py-2.5 rounded-xs transition {{ ($activeCategory === $cat->category) ? 'bg-emerald-50 text-[#006830] font-bold border-l-4 border-[#006830]' : 'text-slate-700 hover:bg-slate-50 font-medium' }}">
                            <span class="flex items-center gap-2 truncate pr-2">
                                <i class="fa-regular fa-folder {{ ($activeCategory === $cat->category) ? 'text-emerald-700 font-bold' : 'text-slate-400' }} text-xs"></i>
                                <span class="truncate">{{ $cat->category }}</span>
                            </span>
                            <span class="font-mono text-[11px] {{ ($activeCategory === $cat->category) ? 'text-emerald-800 font-bold' : 'text-slate-400' }} shrink-0">{{ $cat->count }}</span>
                        </a>
                    @endforeach
                </div>

                <!-- PDF Only Filter Toggle -->
                <div class="p-3 bg-slate-50 border-t border-slate-100">
                    <a href="{{ route('katalog.digital', array_merge(request()->except('pdf_only', 'page'), request()->boolean('pdf_only') ? [] : ['pdf_only' => 1])) }}" 
                       class="flex items-center justify-between text-xs font-semibold {{ request()->boolean('pdf_only') ? 'text-emerald-800' : 'text-slate-600 hover:text-emerald-700' }}">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-circle-check {{ request()->boolean('pdf_only') ? 'text-emerald-600' : 'text-slate-300' }}"></i>
                            <span>Hanya dengan File PDF</span>
                        </span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded font-mono {{ request()->boolean('pdf_only') ? 'bg-emerald-200 text-emerald-900 font-bold' : 'bg-slate-200 text-slate-600' }}">
                            {{ request()->boolean('pdf_only') ? 'ON' : 'OFF' }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Quick Guide Card -->
            <div class="bg-gradient-to-br from-emerald-50 to-slate-50 rounded-sm border border-emerald-200 p-4 shadow-2xs text-xs space-y-2.5">
                <div class="flex items-center gap-2 text-emerald-900 font-bold">
                    <i class="fa-solid fa-circle-info text-emerald-700 text-sm"></i>
                    <span>Panduan Membaca Flipbook</span>
                </div>
                <ul class="space-y-2 text-slate-600 text-[11px] leading-relaxed">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-computer-mouse text-emerald-600 text-xs mt-0.5"></i>
                        <span><strong>Klik / Tarik Sudut:</strong> Geser sudut lembaran halaman buku dengan kursor untuk membalik halaman.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-mobile-screen text-emerald-600 text-xs mt-0.5"></i>
                        <span><strong>Geser di Ponsel:</strong> Sentuh dan usap layar ke kanan atau ke kiri untuk membuka lembaran berikutnya.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-expand text-emerald-600 text-xs mt-0.5"></i>
                        <span><strong>Layar Penuh:</strong> Gunakan tombol fullscreen di bar kontrol untuk kenyamanan membaca optimal.</span>
                    </li>
                </ul>
            </div>

            <!-- Callout: Ingin Terbitkan Buku Sendiri? -->
            <div class="bg-[#032c21] rounded-sm p-4 text-white text-xs space-y-2 shadow-2xs border border-emerald-900">
                <span class="text-[9px] uppercase tracking-wider font-bold text-amber-400 block">Layanan Redaksi PERSIS</span>
                <h4 class="font-bold text-sm leading-snug">Punya Naskah Buku Sendiri?</h4>
                <p class="text-[11px] text-emerald-200 leading-relaxed">
                    Terbitkan karya ilmiah, modul, atau monograf Anda bersama Penerbit PERSIS ber-ISBN resmi.
                </p>
                <a href="{{ url('/kontak') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xs text-[11px] font-bold transition shadow-xs mt-1">
                    <span>Konsultasi Naskah</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

        </aside>

        <!-- MAIN CONTENT: RAK KOLEKSI & GRID BUKU DIGITAL (Right Column) -->
        <div class="lg:col-span-3 space-y-8">

            <!-- Featured / Koleksi Populer Section -->
            @if($popularBooks->count() > 0 && !request('q') && ($activeCategory === 'all' || empty($activeCategory)))
                <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs">
                    <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#006830]"></span>
                            <h2 class="text-sm sm:text-base font-extrabold text-slate-900 uppercase tracking-tight font-heading">
                                Koleksi Unggulan &amp; Kitab Digital Pilihan
                            </h2>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium hidden sm:inline">Pratinjau Animasi Tersedia</span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($popularBooks->take(3) as $pop)
                            @php
                                $popCover = null;
                                if ($pop->cover_image) {
                                    $popCover = str_starts_with($pop->cover_image, 'http') ? $pop->cover_image : asset('storage/' . $pop->cover_image);
                                }
                            @endphp
                            <div class="digital-book-card p-3 flex flex-col justify-between group">
                                <div class="digital-stage-3d w-28 sm:w-32 aspect-[3/4.2] mx-auto mb-3 cursor-pointer" onclick="openFlipbookReader({{ json_encode($pop) }})">
                                    <div class="digital-cover-3d relative w-full h-full rounded-xs overflow-hidden bg-slate-900 border border-slate-300">
                                        <div class="book-spine-line"></div>
                                        <div class="book-edge-paper"></div>
                                        @if($popCover)
                                            <img src="{{ $popCover }}" alt="{{ $pop->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                                        @endif
                                        <div class="w-full h-full bg-[#032c21] p-2 flex flex-col justify-between text-white text-[7px]" style="{{ $popCover ? 'display:none;' : '' }}">
                                            <span class="text-emerald-300 font-bold truncate">PERSIS PERS</span>
                                            <span class="font-black text-[8px] leading-tight line-clamp-3">{{ $pop->title }}</span>
                                            <span class="text-slate-300 truncate text-[6.5px]">{{ $pop->author }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-1 text-center">
                                    <span class="text-[9px] font-bold text-emerald-800 bg-emerald-50 px-1.5 py-0.5 rounded-xs border border-emerald-200">
                                        {{ $pop->category }}
                                    </span>
                                    <h4 class="text-xs font-bold text-slate-900 line-clamp-2 leading-tight group-hover:text-emerald-800 transition cursor-pointer" onclick="openFlipbookReader({{ json_encode($pop) }})">
                                        {{ $pop->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 truncate">{{ $pop->author }}</p>
                                </div>

                                <button type="button" 
                                        onclick="openFlipbookReader({{ json_encode($pop) }})" 
                                        class="mt-3 w-full py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                                    <i class="fa-solid fa-book-open-reader text-[10px]"></i>
                                    <span>Buka Flipbook</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Main Catalog Grid Header -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h2 class="text-base sm:text-lg font-black text-slate-900 font-heading">
                        Daftar Koleksi Buku Digital
                        @if($activeCategory !== 'all' && !empty($activeCategory))
                            <span class="text-emerald-700 font-bold">&bull; {{ $activeCategory }}</span>
                        @endif
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Menampilkan <strong>{{ $books->total() }}</strong> judul buku. Klik tombol <strong>Buka Flipbook</strong> untuk membaca dengan animasi kertas realistis.
                    </p>
                </div>

                @if(request('q') || request('kategori') || request('pdf_only'))
                    <a href="{{ route('katalog.digital') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-700 rounded-sm text-xs font-bold transition shrink-0 self-start sm:self-auto">
                        <i class="fa-solid fa-rotate-left text-[10px]"></i>
                        <span>Reset Filter</span>
                    </a>
                @endif
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($books as $book)
                    @php
                        $coverUrl = null;
                        if ($book->cover_image) {
                            $coverUrl = str_starts_with($book->cover_image, 'http') ? $book->cover_image : asset('storage/' . $book->cover_image);
                        }
                    @endphp
                    <div class="digital-book-card p-4 flex flex-col justify-between group">
                        
                        <!-- Top Metadata & 3D Cover Display -->
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 truncate">
                                    {{ $book->category }}
                                </span>
                                @if($book->sample_pdf)
                                    <span class="px-1.5 py-0.5 rounded-xs text-[9px] font-bold bg-emerald-100 text-emerald-900 border border-emerald-300 flex items-center gap-1 shrink-0" title="File PDF Siap Dibaca">
                                        <i class="fa-solid fa-file-pdf text-[8px] text-emerald-700"></i>
                                        <span>PDF Ready</span>
                                    </span>
                                @else
                                    <span class="px-1.5 py-0.5 rounded-xs text-[9px] font-medium bg-slate-100 text-slate-500 border border-slate-200 shrink-0">
                                        Sample
                                    </span>
                                @endif
                            </div>

                            <!-- 3D Perspective Stage -->
                            <div class="digital-stage-3d w-36 aspect-[3/4.2] mx-auto py-2 cursor-pointer" onclick="openFlipbookReader({{ json_encode($book) }})" title="Klik untuk Buka Buku">
                                <div class="digital-cover-3d relative w-full h-full rounded-xs overflow-hidden bg-slate-900 border border-slate-300">
                                    <div class="book-spine-line"></div>
                                    <div class="book-edge-paper"></div>

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
                                <h3 class="text-xs sm:text-[13px] font-extrabold text-slate-900 line-clamp-2 leading-snug group-hover:text-emerald-800 transition cursor-pointer" onclick="openFlipbookReader({{ json_encode($book) }})">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-[11px] text-slate-500 truncate flex items-center gap-1.5">
                                    <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                    <span>{{ $book->author }}</span>
                                </p>
                                <div class="flex items-center justify-between text-[11px] text-slate-400 font-mono pt-1">
                                    <span>{{ $book->pages ?: '240 hlm' }}</span>
                                    <span>ISBN: {{ $book->isbn ? substr($book->isbn, 0, 13) . '...' : '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 border-t border-slate-100 space-y-1.5 mt-3">
                            <button type="button" 
                                    onclick="openFlipbookReader({{ json_encode($book) }})" 
                                    class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
                                <i class="fa-solid fa-book-open-reader text-xs"></i>
                                <span>Buka &amp; Baca (Flipbook)</span>
                            </button>
                            
                            <a href="{{ route('katalog.show', $book->slug) }}" 
                               class="w-full py-1.5 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xs text-[11px] font-semibold transition flex items-center justify-center gap-1 border border-slate-200">
                                <i class="fa-solid fa-circle-info text-[10px] text-slate-400"></i>
                                <span>Lihat Spesifikasi &amp; Cetak</span>
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-sm border border-slate-200 p-12 text-center text-slate-400 space-y-3">
                        <i class="fa-solid fa-book-open text-4xl text-slate-300"></i>
                        <h4 class="text-sm font-bold text-slate-700">Tidak ada buku yang sesuai dengan pencarian</h4>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto">
                            Coba ubah kata kunci pencarian atau pilih kategori lain di sidebar kiri.
                        </p>
                        <a href="{{ route('katalog.digital') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-700 text-white rounded-sm text-xs font-bold transition">
                            Lihat Semua Koleksi
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="p-4 bg-white rounded-sm border border-slate-200 flex items-center justify-end shadow-2xs">
                    {{ $books->links() }}
                </div>
            @endif

        </div>

    </div>
</main>

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
            <div id="flipLoading" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-950/80 text-white z-50">
                <i class="fa-solid fa-circle-notch fa-spin text-3xl text-emerald-500 mb-3"></i>
                <p class="text-xs font-bold tracking-wide text-slate-200">Menyiapkan Lembaran Buku Digital...</p>
                <p class="text-[10px] text-slate-500 mt-1 font-mono">Memuat halaman &amp; efek flip 3D</p>
            </div>

            <!-- Viewport for StPageFlip or Fallback -->
            <div class="flip-viewport" id="flipbookViewport">
                <!-- StPageFlip or Fallback Spread will be injected here dynamically -->
                <div id="bookFlipInstance"></div>
            </div>

        </div>

        <!-- Bottom Controls Bar -->
        <div class="bg-slate-900 border-t border-slate-800 px-4 py-2.5 flex items-center justify-between text-white shrink-0 text-xs">
            
            <!-- Left Info -->
            <div class="hidden sm:flex items-center gap-2 text-slate-400 text-[11px]">
                <i class="fa-solid fa-hand-pointer text-emerald-400"></i>
                <span>Tarik sudut kertas atau klik tombol panah</span>
            </div>

            <!-- Center Navigation Buttons -->
            <div class="flex items-center gap-2 mx-auto sm:mx-0">
                <button type="button" onclick="flipbookPrev()" class="px-3 py-1.5 bg-slate-800 hover:bg-emerald-700 text-white rounded-xs font-bold transition flex items-center gap-1 border border-slate-700 shadow-2xs">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </button>

                <div class="px-3 py-1 bg-slate-950 border border-slate-800 rounded-xs font-mono font-bold text-emerald-400 text-xs flex items-center gap-1.5">
                    <span id="flipCurrentPage">1</span>
                    <span class="text-slate-600">/</span>
                    <span id="flipTotalPages" class="text-slate-400">1</span>
                </div>

                <button type="button" onclick="flipbookNext()" class="px-3 py-1.5 bg-slate-800 hover:bg-emerald-700 text-white rounded-xs font-bold transition flex items-center gap-1 border border-slate-700 shadow-2xs">
                    <span class="hidden sm:inline">Berikutnya</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
            </div>

            <!-- Right Options -->
            <div class="flex items-center gap-2">
                <button type="button" id="btnToggleSound" onclick="toggleFlipSound()" class="p-1.5 px-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xs transition text-xs flex items-center gap-1" title="Suara Kertas">
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
    // Set PDF.js worker
    if (window.pdfjsLib) {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    }

    let pageFlipInstance = null;
    let flipbookCurrentBook = null;
    let flipSoundEnabled = true;
    let fallbackPages = [];
    let fallbackCurrentIndex = 0;

    // Web Audio Paper Flip Sound Synthesizer (Realistic & 0 external audio files needed!)
    function playPaperTurnSound() {
        if (!flipSoundEnabled) return;
        try {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (!AudioCtx) return;
            const ctx = new AudioCtx();
            const bufferSize = ctx.sampleRate * 0.12;
            const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
            const data = buffer.getChannelData(0);
            for (let i = 0; i < bufferSize; i++) {
                data[i] = (Math.random() * 2 - 1) * Math.exp(-i / (ctx.sampleRate * 0.035));
            }
            const noise = ctx.createBufferSource();
            noise.buffer = buffer;
            const filter = ctx.createBiquadFilter();
            filter.type = 'lowpass';
            filter.frequency.value = 800;
            const gain = ctx.createGain();
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
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

    // Open Modal and Load Book
    window.openFlipbookReader = async function(book) {
        flipbookCurrentBook = book;
        const modal = document.getElementById('flipbookModal');
        const titleEl = document.getElementById('modalBookTitle');
        const authorEl = document.getElementById('modalBookAuthor');
        const btnDownload = document.getElementById('btnDownloadPdf');
        const loader = document.getElementById('flipLoading');
        const viewport = document.getElementById('flipbookViewport');

        if (titleEl) titleEl.innerText = book.title;
        if (authorEl) authorEl.innerText = book.author + ' (' + book.category + ')';

        if (book.sample_pdf) {
            btnDownload.classList.remove('hidden');
            btnDownload.href = '/storage/' + book.sample_pdf;
        } else {
            btnDownload.classList.add('hidden');
        }

        modal.style.display = 'flex';
        modal.classList.remove('hidden');
        loader.classList.remove('hidden');
        viewport.innerHTML = '<div id="bookFlipInstance" class="st-flip-container"></div>';

        // Check if book has a valid PDF
        if (book.sample_pdf) {
            await renderPdfToFlipbook('/storage/' + book.sample_pdf, book);
        } else {
            renderImagesToFlipbook(book);
        }
    };

    // Render PDF with PDF.js into Flipbook Canvas Pages
    async function renderPdfToFlipbook(pdfUrl, book) {
        const loader = document.getElementById('flipLoading');
        const container = document.getElementById('bookFlipInstance');

        try {
            const loadingTask = window.pdfjsLib.getDocument(pdfUrl);
            const pdfDoc = await loadingTask.promise;
            const totalPages = pdfDoc.numPages;

            document.getElementById('flipTotalPages').innerText = totalPages;

            container.innerHTML = '';
            const pageCanvases = [];

            // Render each page of PDF to an HTML5 Canvas
            for (let i = 1; i <= totalPages; i++) {
                const page = await pdfDoc.getPage(i);
                const viewportScale = 1.4;
                const pageViewport = page.getViewport({ scale: viewportScale });

                const pageDiv = document.createElement('div');
                pageDiv.className = 'page-sheet';

                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.width = pageViewport.width;
                canvas.height = pageViewport.height;

                await page.render({
                    canvasContext: context,
                    viewport: pageViewport
                }).promise;

                pageDiv.appendChild(canvas);
                container.appendChild(pageDiv);
            }

            initPageFlipLibrary(totalPages);
            loader.classList.add('hidden');

        } catch (err) {
            console.warn('PDF.js render failed, switching to image fallback', err);
            renderImagesToFlipbook(book);
        }
    }

    // Render Image Slides Fallback (Cover, Inside, Back)
    function renderImagesToFlipbook(book) {
        const loader = document.getElementById('flipLoading');
        const container = document.getElementById('bookFlipInstance');
        container.innerHTML = '';

        const images = [];
        if (book.cover_image) images.push('/storage/' + book.cover_image);
        if (book.inside_preview_image) images.push('/storage/' + book.inside_preview_image);
        if (book.additional_image) images.push('/storage/' + book.additional_image);
        if (book.back_cover_image) images.push('/storage/' + book.back_cover_image);

        if (images.length === 0) {
            // Generate dummy rich book spreads
            images.push('cover');
            images.push('page1');
            images.push('page2');
            images.push('back');
        }

        const total = images.length;
        document.getElementById('flipTotalPages').innerText = total;

        images.forEach((imgSrc, idx) => {
            const pageDiv = document.createElement('div');
            pageDiv.className = 'page-sheet p-6 text-center';

            if (imgSrc.startsWith('/')) {
                const img = document.createElement('img');
                img.src = imgSrc;
                img.className = 'w-full h-full object-contain';
                pageDiv.appendChild(img);
            } else {
                pageDiv.innerHTML = `
                    <div class="w-full h-full border border-slate-200 p-6 flex flex-col justify-between bg-white text-slate-800">
                        <div class="border-b border-emerald-700/30 pb-2">
                            <span class="text-xs font-bold text-emerald-800 uppercase tracking-widest font-heading">PERSIS PERS PRESS</span>
                        </div>
                        <div class="my-auto space-y-2">
                            <h3 class="font-black text-base text-slate-900 font-heading">${book.title}</h3>
                            <p class="text-xs text-slate-500 font-medium">${book.author}</p>
                            <div class="w-8 h-0.5 bg-emerald-600 mx-auto my-3"></div>
                            <p class="text-xs text-slate-600 leading-relaxed max-w-sm mx-auto">${book.synopsis || 'Khazanah literatur keislaman dan publikasi ilmiah berstandar akademik.'}</p>
                        </div>
                        <div class="border-t border-slate-100 pt-2 flex justify-between text-[10px] text-slate-400 font-mono">
                            <span>ISBN: ${book.isbn || '-'}</span>
                            <span>Halaman ${idx + 1}</span>
                        </div>
                    </div>
                `;
            }

            container.appendChild(pageDiv);
        });

        initPageFlipLibrary(total);
        loader.classList.add('hidden');
    }

    // Initialize StPageFlip Library Engine
    function initPageFlipLibrary(pageCount) {
        if (pageFlipInstance) {
            try { pageFlipInstance.destroy(); } catch(e) {}
            pageFlipInstance = null;
        }

        const container = document.getElementById('bookFlipInstance');
        if (!container) return;

        // Check if StPageFlip class is loaded
        if (window.St && window.St.PageFlip) {
            const isMobile = window.innerWidth < 768;
            pageFlipInstance = new window.St.PageFlip(container, {
                width: isMobile ? 360 : 440,
                height: isMobile ? 500 : 580,
                size: 'stretch',
                minWidth: 280,
                maxWidth: 550,
                minHeight: 400,
                maxHeight: 700,
                maxShadowOpacity: 0.5,
                showCover: true,
                mobileScrollSupport: false,
                autoSize: true,
                useMouseEvents: true,
                swipeDistance: 30
            });

            const sheets = container.querySelectorAll('.page-sheet');
            pageFlipInstance.loadFromHTML(sheets);

            pageFlipInstance.on('flip', (e) => {
                playPaperTurnSound();
                const cur = e.data + 1;
                document.getElementById('flipCurrentPage').innerText = cur;
            });

            pageFlipInstance.on('changeState', (e) => {
                if (e.data === 'flipping') {
                    playPaperTurnSound();
                }
            });

        } else {
            // Native Lightweight CSS 3D Spread Fallback
            console.log('StPageFlip not available from CDN, running CSS 3D Spread fallback');
            initCssFlipFallback(pageCount);
        }
    }

    // Fallback: Pure CSS Spread Viewer
    function initCssFlipFallback(pageCount) {
        const container = document.getElementById('bookFlipInstance');
        const sheets = Array.from(container.querySelectorAll('.page-sheet'));
        fallbackPages = sheets;
        fallbackCurrentIndex = 0;
        renderCssFallbackSpread();
    }

    function renderCssFallbackSpread() {
        const viewport = document.getElementById('flipbookViewport');
        const curEl = document.getElementById('flipCurrentPage');
        if (curEl) curEl.innerText = (fallbackCurrentIndex + 1);

        const leftSheet = fallbackPages[fallbackCurrentIndex];
        const rightSheet = fallbackPages[fallbackCurrentIndex + 1] || null;

        viewport.innerHTML = `
            <div class="css-flip-spread animate-fade-in">
                <div class="css-flip-page left" id="cssLeftPage"></div>
                <div class="css-flip-page right" id="cssRightPage"></div>
            </div>
        `;

        if (leftSheet) {
            document.getElementById('cssLeftPage').appendChild(leftSheet.cloneNode(true));
        }
        if (rightSheet) {
            document.getElementById('cssRightPage').appendChild(rightSheet.cloneNode(true));
        } else {
            document.getElementById('cssRightPage').innerHTML = `
                <div class="w-full h-full flex flex-col items-center justify-center text-center p-6 text-slate-400">
                    <i class="fa-solid fa-bookmark text-3xl mb-2 text-emerald-700"></i>
                    <p class="font-bold text-xs text-slate-700 font-heading">PERSIS PERS PRESS</p>
                    <p class="text-[11px] text-slate-500 mt-1">Akhir dari pratinjau halaman buku.</p>
                </div>
            `;
        }
    }

    // Flip Controls
    window.flipbookNext = function() {
        if (pageFlipInstance) {
            pageFlipInstance.flipNext();
        } else if (fallbackPages.length > 0) {
            if (fallbackCurrentIndex + 2 < fallbackPages.length) {
                fallbackCurrentIndex += 2;
                playPaperTurnSound();
                renderCssFallbackSpread();
            }
        }
    };

    window.flipbookPrev = function() {
        if (pageFlipInstance) {
            pageFlipInstance.flipPrev();
        } else if (fallbackPages.length > 0) {
            if (fallbackCurrentIndex >= 2) {
                fallbackCurrentIndex -= 2;
                playPaperTurnSound();
                renderCssFallbackSpread();
            }
        }
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

    // Keyboard Shortcuts (Arrow keys & Escape)
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('flipbookModal');
        if (modal && !modal.classList.contains('hidden') && modal.style.display !== 'none') {
            if (e.key === 'ArrowRight' || e.key === 'PageDown') {
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

    // Auto open if activeBook passed via URL (?baca=slug)
    @if(isset($activeBook) && $activeBook)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                openFlipbookReader({!! json_encode($activeBook) !!});
            }, 400);
        });
    @endif
</script>
@endsection
