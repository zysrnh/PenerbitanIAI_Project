@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah | PERSIS PERS')

@section('content')
    <style>
        /* 1. Signature PERSIS PERS Book Card */
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
            transform: translateY(-3px);
            box-shadow: 0 16px 30px -8px rgba(4, 120, 87, 0.15), 0 2px 6px rgba(0,0,0,0.04);
        }

        /* 2. 3D Perspective Hover Tilt on Grid Cards */
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
        .card-shine-layer {
            background: linear-gradient(135deg, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 60%);
        }

        /* 3D Realistic Card Cover Effects */
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

        /* 3. Modal 3D Perspective Hover Tilt */
        .modal-book-stage {
            perspective: 1000px;
        }
        .modal-book-3d {
            transform-style: preserve-3d;
            transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            box-shadow: 12px 16px 28px -6px rgba(0, 0, 0, 0.35), 2px 2px 6px rgba(0,0,0,0.12);
        }
        .modal-book-stage:hover .modal-book-3d {
            transform: rotateY(-18deg) rotateX(6deg) translateY(-4px) scale(1.03);
            box-shadow: 18px 24px 36px -6px rgba(0, 0, 0, 0.45), 4px 4px 10px rgba(0,0,0,0.2);
        }
        .modal-shine-layer {
            background: linear-gradient(135deg, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0) 60%);
        }

        /* Clean Smooth Transition on Photo Switch */
        .showcase-fade-slide {
            animation: cleanFadeSlide 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes cleanFadeSlide {
            0% {
                opacity: 0;
                transform: scale(0.97) translateY(4px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Zoom Lightbox Pop-In */
        .lightbox-zoom-in {
            animation: lightboxZoom 0.25s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes lightboxZoom {
            0% { opacity: 0; transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        /* Category Nav */
        .cat-link {
            transition: all 0.15s ease;
        }
        .cat-link:hover {
            background-color: #ecfdf5;
            color: #047857;
            padding-left: 18px;
        }
        .cat-active {
            background-color: #047857 !important;
            color: #ffffff !important;
            font-weight: 700;
        }
    </style>

    <!-- 1. HEADER BANNER (Synchronized with Admin) -->
    <section class="bg-brand-950 text-white py-14 sm:py-16 relative overflow-hidden border-b border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">
                {{ $settings['catalog_banner_badge'] ?? 'PUBLIKASI RESMI KAMPUS' }}
            </span>
            <h1 class="text-2xl sm:text-4xl font-extrabold font-heading tracking-tight">
                {{ $settings['catalog_banner_title'] ?? 'Katalog Buku & Karya Ilmiah' }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                {{ $settings['catalog_banner_desc'] ?? 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.' }}
            </p>
        </div>
    </section>

    <!-- 2. 4 QUICK STATS CARDS OVERLAP (-mt-7) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            
            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Total Koleksi</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['catalog_stat_books'] ?? '150+ Judul Buku' }}</p>
                    <span class="text-[11px] text-slate-400 block">Karya civitas akademika</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Penulis / Dosen</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['catalog_stat_authors'] ?? 'Karya Dosen & Peneliti' }}</p>
                    <span class="text-[11px] text-slate-400 block">Riset dan kepakaran</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-barcode"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Legalitas Resmi</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['catalog_stat_isbn'] ?? 'ISBN Perpusnas' }}</p>
                    <span class="text-[11px] text-slate-400 block">Terdaftar resmi nasional</span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-sm flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Standar Mutu</h3>
                    <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $settings['catalog_stat_print'] ?? 'Cetak Berkualitas' }}</p>
                    <span class="text-[11px] text-slate-400 block">Standar UNESCO B5</span>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. MAIN BOOKSTORE CONTENT -->
    <section class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- LEFT SIDEBAR -->
                <div class="lg:col-span-3 space-y-6">
                    
                    <!-- Search Widget -->
                    <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-sm">
                        <form action="{{ route('katalog') }}" method="GET" class="relative">
                            <input 
                                type="text" 
                                name="q" 
                                value="{{ request('q') }}" 
                                placeholder="Cari judul, penulis, ISBN..." 
                                class="w-full pl-8 pr-3 py-2 text-xs rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium"
                            />
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        </form>
                    </div>

                    <!-- KATEGORI WIDGET -->
                    <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                        <div class="bg-brand-950 text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center justify-between border-b border-brand-900">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ul text-emerald-400"></i> Kategori
                            </span>
                            <span class="text-[10px] bg-white/10 px-1.5 py-0.5 rounded-xs font-mono text-emerald-300">{{ $totalBooksCount }}</span>
                        </div>

                        <div class="divide-y divide-slate-100 text-xs font-semibold text-slate-700">
                            <a href="{{ route('katalog') }}" class="cat-link flex items-center justify-between px-4 py-2.5 {{ !request('kategori') || request('kategori') === 'all' ? 'cat-active' : '' }}">
                                <span>Semua Koleksi</span>
                                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                            </a>

                            <a href="{{ route('katalog', ['kategori' => 'Buku Baru']) }}" class="cat-link flex items-center justify-between px-4 py-2.5 {{ request('kategori') === 'Buku Baru' ? 'cat-active' : '' }}">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Buku Baru (2026)
                                </span>
                                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                            </a>

                            <a href="{{ route('katalog', ['kategori' => 'Best Seller']) }}" class="cat-link flex items-center justify-between px-4 py-2.5 {{ request('kategori') === 'Best Seller' ? 'cat-active' : '' }}">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Best Seller
                                </span>
                                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                            </a>

                            @foreach($categoriesWithCount as $catItem)
                                <a href="{{ route('katalog', ['kategori' => $catItem['name']]) }}" class="cat-link flex items-center justify-between px-4 py-2.5 {{ request('kategori') === $catItem['name'] ? 'cat-active' : '' }}">
                                    <span>{{ $catItem['name'] }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono">({{ $catItem['count'] }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- INFO & PROMO WIDGET -->
                    <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                        <div class="bg-brand-950 text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center gap-2 border-b border-brand-900">
                            <i class="fa-solid fa-bullhorn text-emerald-400"></i> Info &amp; Promo
                        </div>

                        <div class="p-4 space-y-3.5 text-xs">
                            <div class="border-b border-slate-100 pb-3">
                                <span class="text-[9.5px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-sm border border-emerald-200">PROMO PENERBITAN</span>
                                <h5 class="font-bold text-slate-900 mt-1 leading-snug">{{ $settings['catalog_promo_title'] ?? 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis' }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $settings['catalog_promo_desc'] ?? 'Paket lengkap pengurusan ISBN dan layout UNESCO.' }}</p>
                            </div>

                            <div>
                                <span class="text-[9.5px] font-bold text-blue-800 bg-blue-50 px-2 py-0.5 rounded-sm border border-blue-200">AGENDA RESMI</span>
                                <h5 class="font-bold text-slate-900 mt-1 leading-snug">{{ $settings['catalog_agenda_title'] ?? 'Bedah Buku & Call for Book Chapters Dosen' }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $settings['catalog_agenda_desc'] ?? 'Terbuka untuk dosen dan peneliti eksternal.' }}</p>
                            </div>

                            <a href="{{ route('kontak') }}" class="w-full py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-sm text-center block text-xs transition shadow-xs">
                                Konsultasi Naskah
                            </a>
                        </div>
                    </div>

                </div>

                <!-- RIGHT MAIN CONTENT (3D HOVER TILT BOOK CARDS) -->
                <div class="lg:col-span-9 space-y-6">
                    
                    @if(!request('kategori') || request('kategori') === 'all')
                        
                        <!-- 1. BUKU BARU SECTION -->
                        <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                            <div class="bg-brand-950 text-white px-4 py-2.5 flex items-center justify-between border-b border-brand-900">
                                <h3 class="text-xs sm:text-sm font-extrabold uppercase tracking-wider flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span> Koleksi <span class="text-emerald-400">Buku Baru (2026)</span>
                                </h3>
                                <a href="{{ route('katalog', ['kategori' => 'Buku Baru']) }}" class="text-[11px] font-bold text-slate-300 hover:text-emerald-400 flex items-center gap-1">
                                    <span>Lihat Semua »</span>
                                </a>
                            </div>

                            <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                                @foreach($newBooks as $nBook)
                                    <div class="persis-book-card p-3 rounded-sm cursor-pointer group" onclick="openBookModal({{ json_encode($nBook) }})">
                                        
                                        <div class="book-cover-stage-3d w-full mb-3 py-1">
                                            <div class="book-cover-3d relative w-full aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden select-none border border-slate-200">
                                                <div class="book-spine-strip"></div>
                                                <div class="book-paper-edge"></div>
                                                <div class="card-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                                @if($nBook->cover_image && (file_exists(public_path('storage/' . $nBook->cover_image)) || file_exists(public_path('images/' . $nBook->cover_image))))
                                                    <img src="{{ file_exists(public_path('storage/' . $nBook->cover_image)) ? asset('storage/' . $nBook->cover_image) : asset('images/' . $nBook->cover_image) }}" alt="{{ $nBook->title }}" class="w-full h-full object-cover" />
                                                @else
                                                    <div class="w-full h-full bg-[#032c21] p-2.5 pl-3.5 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                        <div class="flex justify-between items-center border-b border-white/20 pb-0.5">
                                                            <span class="font-bold text-emerald-300 truncate">{{ $nBook->category }}</span>
                                                            <span class="font-mono text-slate-300 text-[6px]">PERSIS</span>
                                                        </div>
                                                        <div class="text-center my-auto py-1">
                                                            <span class="font-black text-[8.5px] leading-tight line-clamp-3 text-white">{{ $nBook->title }}</span>
                                                        </div>
                                                        <div class="pt-0.5 border-t border-white/20 text-center">
                                                            <span class="font-mono text-slate-300 text-[6.5px] truncate block">{{ $nBook->author }}</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 rounded-xs text-[8px] font-black uppercase tracking-wider bg-blue-600 text-white shadow-xs z-20">
                                                    Baru
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex flex-col flex-1 justify-between text-left">
                                            <div>
                                                <div class="flex items-center justify-between gap-1 mb-1.5">
                                                    <span class="text-[9.5px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-xs border border-emerald-200/80 truncate">
                                                        {{ $nBook->category }}
                                                    </span>
                                                    <span class="text-[10px] text-slate-400 font-mono font-semibold">{{ $nBook->year ?? '2026' }}</span>
                                                </div>

                                                <h4 class="font-extrabold text-slate-900 text-xs sm:text-[13px] leading-snug line-clamp-2 mb-1 group-hover:text-emerald-700 transition">
                                                    {{ $nBook->title }}
                                                </h4>

                                                <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-medium mb-2.5">
                                                    <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600 shrink-0"></i>
                                                    <span class="truncate">{{ $nBook->author }}</span>
                                                </div>
                                            </div>

                                            <div class="pt-2 border-t border-slate-100 flex items-center justify-between mt-auto">
                                                <div>
                                                    <span class="text-[9px] text-slate-400 font-medium block leading-none">Harga Cetak</span>
                                                    <span class="text-xs sm:text-[13px] font-black text-emerald-700 font-mono mt-0.5 block">{{ $nBook->price }}</span>
                                                </div>
                                                <button type="button" class="px-2.5 py-1 rounded-xs bg-slate-100 group-hover:bg-emerald-700 group-hover:text-white text-slate-600 font-bold text-[10px] transition flex items-center gap-1">
                                                    <span>Detail</span>
                                                    <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 2. BEST SELLER SECTION -->
                        <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                            <div class="bg-brand-950 text-white px-4 py-2.5 flex items-center justify-between border-b border-brand-900">
                                <h3 class="text-xs sm:text-sm font-extrabold uppercase tracking-wider flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span> Koleksi <span class="text-amber-300">Best Seller</span>
                                </h3>
                                <a href="{{ route('katalog', ['kategori' => 'Best Seller']) }}" class="text-[11px] font-bold text-slate-300 hover:text-amber-300 flex items-center gap-1">
                                    <span>Lihat Semua »</span>
                                </a>
                            </div>

                            <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                                @foreach($bestSellers as $bBook)
                                    <div class="persis-book-card p-3 rounded-sm cursor-pointer group" onclick="openBookModal({{ json_encode($bBook) }})">
                                        
                                        <div class="book-cover-stage-3d w-full mb-3 py-1">
                                            <div class="book-cover-3d relative w-full aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden select-none border border-slate-200">
                                                <div class="book-spine-strip"></div>
                                                <div class="book-paper-edge"></div>
                                                <div class="card-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                                @if($bBook->cover_image && (file_exists(public_path('storage/' . $bBook->cover_image)) || file_exists(public_path('images/' . $bBook->cover_image))))
                                                    <img src="{{ file_exists(public_path('storage/' . $bBook->cover_image)) ? asset('storage/' . $bBook->cover_image) : asset('images/' . $bBook->cover_image) }}" alt="{{ $bBook->title }}" class="w-full h-full object-cover" />
                                                @else
                                                    <div class="w-full h-full bg-[#032c21] p-2.5 pl-3.5 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                        <div class="flex justify-between items-center border-b border-white/20 pb-0.5">
                                                            <span class="font-bold text-emerald-300 truncate">{{ $bBook->category }}</span>
                                                            <span class="font-mono text-slate-300 text-[6px]">PERSIS</span>
                                                        </div>
                                                        <div class="text-center my-auto py-1">
                                                            <span class="font-black text-[8.5px] leading-tight line-clamp-3 text-white">{{ $bBook->title }}</span>
                                                        </div>
                                                        <div class="pt-0.5 border-t border-white/20 text-center">
                                                            <span class="font-mono text-slate-300 text-[6.5px] truncate block">{{ $bBook->author }}</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 rounded-xs text-[8px] font-black uppercase tracking-wider bg-amber-600 text-white shadow-xs z-20">
                                                    Populer
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex flex-col flex-1 justify-between text-left">
                                            <div>
                                                <div class="flex items-center justify-between gap-1 mb-1.5">
                                                    <span class="text-[9.5px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-xs border border-emerald-200/80 truncate">
                                                        {{ $bBook->category }}
                                                    </span>
                                                    <span class="text-[10px] text-slate-400 font-mono font-semibold">{{ $bBook->year ?? '2026' }}</span>
                                                </div>

                                                <h4 class="font-extrabold text-slate-900 text-xs sm:text-[13px] leading-snug line-clamp-2 mb-1 group-hover:text-emerald-700 transition">
                                                    {{ $bBook->title }}
                                                </h4>

                                                <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-medium mb-2.5">
                                                    <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600 shrink-0"></i>
                                                    <span class="truncate">{{ $bBook->author }}</span>
                                                </div>
                                            </div>

                                            <div class="pt-2 border-t border-slate-100 flex items-center justify-between mt-auto">
                                                <div>
                                                    <span class="text-[9px] text-slate-400 font-medium block leading-none">Harga Cetak</span>
                                                    <span class="text-xs sm:text-[13px] font-black text-emerald-700 font-mono mt-0.5 block">{{ $bBook->price }}</span>
                                                </div>
                                                <button type="button" class="px-2.5 py-1 rounded-xs bg-slate-100 group-hover:bg-emerald-700 group-hover:text-white text-slate-600 font-bold text-[10px] transition flex items-center gap-1">
                                                    <span>Detail</span>
                                                    <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>

                    @endif

                    <!-- 3. MAIN ALL BOOKS / FILTERED BOOKS GRID -->
                    <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-sm">
                        <div class="bg-brand-950 text-white px-4 py-2.5 flex items-center justify-between border-b border-brand-900">
                            <h3 class="text-xs sm:text-sm font-extrabold uppercase tracking-wider">
                                @if(request('kategori') && request('kategori') !== 'all')
                                    Kategori: <span class="text-emerald-400">{{ request('kategori') }}</span>
                                @elseif(request('q'))
                                    Hasil Pencarian: "<span class="text-emerald-400">{{ request('q') }}</span>"
                                @else
                                    Semua Koleksi Terdaftar
                                @endif
                            </h3>
                            <span class="text-xs text-slate-300 font-mono">
                                Total: {{ $books->total() }} Judul
                            </span>
                        </div>

                        <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @forelse($books as $book)
                                <div class="persis-book-card p-3 rounded-sm cursor-pointer group" onclick="openBookModal({{ json_encode($book) }})">
                                    
                                    <div class="book-cover-stage-3d w-full mb-3 py-1">
                                        <div class="book-cover-3d relative w-full aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden select-none border border-slate-200">
                                            <div class="book-spine-strip"></div>
                                            <div class="book-paper-edge"></div>
                                            <div class="card-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                            @if($book->cover_image && (file_exists(public_path('storage/' . $book->cover_image)) || file_exists(public_path('images/' . $book->cover_image))))
                                                <img src="{{ file_exists(public_path('storage/' . $book->cover_image)) ? asset('storage/' . $book->cover_image) : asset('images/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full bg-[#032c21] p-2.5 pl-3.5 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                    <div class="flex justify-between items-center border-b border-white/20 pb-0.5">
                                                        <span class="font-bold text-emerald-300 truncate">{{ $book->category }}</span>
                                                        <span class="font-mono text-slate-300 text-[6px]">PERSIS</span>
                                                    </div>
                                                    <div class="text-center my-auto py-1">
                                                        <span class="font-black text-[8.5px] leading-tight line-clamp-3 text-white">{{ $book->title }}</span>
                                                    </div>
                                                    <div class="pt-0.5 border-t border-white/20 text-center">
                                                        <span class="font-mono text-slate-300 text-[6.5px] truncate block">{{ $book->author }}</span>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($book->is_new_release)
                                                <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 rounded-xs text-[8px] font-black uppercase tracking-wider bg-blue-600 text-white shadow-xs z-20">
                                                    Baru
                                                </span>
                                            @elseif($book->is_best_seller)
                                                <span class="absolute top-1.5 right-1.5 px-1.5 py-0.5 rounded-xs text-[8px] font-black uppercase tracking-wider bg-amber-600 text-white shadow-xs z-20">
                                                    Best Seller
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex flex-col flex-1 justify-between text-left">
                                        <div>
                                            <div class="flex items-center justify-between gap-1 mb-1.5">
                                                <span class="text-[9.5px] font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-xs border border-emerald-200/80 truncate">
                                                    {{ $book->category }}
                                                </span>
                                                <span class="text-[10px] text-slate-400 font-mono font-semibold">{{ $book->year ?? '2026' }}</span>
                                            </div>

                                            <h4 class="font-extrabold text-slate-900 text-xs sm:text-[13px] leading-snug line-clamp-2 mb-1 group-hover:text-emerald-700 transition">
                                                {{ $book->title }}
                                            </h4>

                                            <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-medium mb-2.5">
                                                <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600 shrink-0"></i>
                                                <span class="truncate">{{ $book->author }}</span>
                                            </div>
                                        </div>

                                        <div class="pt-2 border-t border-slate-100 flex items-center justify-between mt-auto">
                                            <div>
                                                <span class="text-[9px] text-slate-400 font-medium block leading-none">Harga Cetak</span>
                                                <span class="text-xs sm:text-[13px] font-black text-emerald-700 font-mono mt-0.5 block">{{ $book->price }}</span>
                                            </div>
                                            <button type="button" class="px-2.5 py-1 rounded-xs bg-slate-100 group-hover:bg-emerald-700 group-hover:text-white text-slate-600 font-bold text-[10px] transition flex items-center gap-1">
                                                <span>Detail</span>
                                                <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            @empty
                                <div class="col-span-full py-12 text-center text-slate-400">
                                    <i class="fa-solid fa-book-open text-3xl mb-2 text-slate-300"></i>
                                    <p class="text-xs font-bold text-slate-600">Tidak ada buku dalam kategori ini</p>
                                </div>
                            @endforelse
                        </div>

                        @if($books->hasPages())
                            <div class="p-3 border-t border-slate-100 flex items-center justify-end text-xs">
                                {{ $books->links() }}
                            </div>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- 4. CTA PUBLISH YOUR BOOK BOX -->
    <section class="py-12 bg-white border-t border-slate-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-950 rounded-sm p-6 sm:p-8 text-white border border-brand-900 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-sm relative overflow-hidden">
                <div class="relative z-10 text-center sm:text-left">
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-400 bg-brand-900 px-3 py-1 rounded-sm border border-emerald-500/20 inline-block mb-2">
                        LAYANAN PENERBITAN KAMPUS
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-white mb-2">
                        {{ $settings['catalog_publish_box_title'] ?? 'Punya Naskah Buku Sendiri?' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                        {{ $settings['catalog_publish_box_desc'] ?? 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.' }}
                    </p>
                </div>

                <a href="{{ route('kontak') }}" class="relative z-10 px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-sm text-xs sm:text-sm transition shadow-sm shrink-0 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Konsultasi Terbit</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================================= -->
    <!-- MODAL DETAIL BUKU PUBLIK (WITH CLEAN 3D PREVIEW & EXPAND BUTTON) -->
    <!-- ========================================================================= -->
    <div id="publicBookModal" class="fixed inset-0 z-50 bg-black/75 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto backdrop-blur-xs">
        <div class="bg-white rounded-sm max-w-4xl w-full shadow-2xl border border-slate-300 overflow-hidden relative my-auto max-h-[92vh] flex flex-col animate-fade-in-up">
            
            <!-- Modal Header -->
            <div class="bg-brand-950 text-white px-5 py-3.5 flex items-center justify-between border-b border-brand-900 shrink-0">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-emerald-300">Detail Koleksi &amp; Pemesanan Naskah</span>
                </div>
                <button type="button" onclick="closeBookModal()" class="w-7 h-7 rounded-sm bg-brand-900 hover:bg-emerald-900 text-slate-200 hover:text-white flex items-center justify-center text-xs font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-5 sm:p-6 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    
                    <!-- Left: 3D Interactive Showcase Visualizer -->
                    <div class="md:col-span-5 flex flex-col items-center bg-slate-50 p-4 rounded-sm border border-slate-200 space-y-4">
                        
                        <!-- 3D Perspective Stage (Clean & Elegant with click to enlarge) -->
                        <div id="modalStage" class="modal-book-stage w-44 sm:w-52 aspect-[3/4.15] flex items-center justify-center py-2 cursor-pointer group relative" onclick="openLightboxFromDetail()" title="Klik untuk Pratinjau Layar Penuh">
                            
                            <div id="modalBookVisualizer" class="modal-book-3d relative w-full h-full rounded-xs overflow-hidden bg-slate-900 select-none border border-slate-300">
                                
                                <div class="book-spine-strip"></div>
                                <div class="book-paper-edge"></div>
                                <div class="modal-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                <!-- Subtle Expand Icon Button Top-Right -->
                                <div class="absolute top-2 right-2 w-7 h-7 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center text-xs backdrop-blur-xs opacity-0 group-hover:opacity-100 transition z-20 pointer-events-none shadow-xs">
                                    <i class="fa-solid fa-expand"></i>
                                </div>

                                <!-- Photo Image Container -->
                                <img id="modalMainImage" src="" alt="Book Cover" class="w-full h-full object-cover hidden showcase-fade-slide" />

                                <!-- Default Vector Front Cover -->
                                <div id="modalVectorFront" class="w-full h-full bg-brand-950 text-white p-3.5 pl-4 flex flex-col justify-between border-l-4 border-emerald-400">
                                    <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                        <span id="modalVectorCat" class="text-[8px] font-bold uppercase px-1.5 py-0.5 rounded-xs bg-brand-900 text-emerald-300">Buku Ajar</span>
                                        <span class="text-[7.5px] text-slate-300 font-mono">PERSIS PERS</span>
                                    </div>
                                    <div class="text-center my-auto py-1.5">
                                        <div class="w-5 h-0.5 bg-amber-400 mx-auto mb-1.5"></div>
                                        <h5 id="modalVectorTitle" class="font-black text-xs text-white leading-tight font-heading line-clamp-3">Judul Buku</h5>
                                        <div class="w-5 h-0.5 bg-amber-400 mx-auto mt-1.5"></div>
                                    </div>
                                    <div class="pt-1 border-t border-white/20 text-center">
                                        <span id="modalVectorAuthor" class="text-[9px] text-slate-200 block font-medium truncate">Nama Penulis</span>
                                    </div>
                                </div>

                                <!-- Default Vector Inside Page -->
                                <div id="modalVectorInside" class="w-full h-full bg-[#fdfbf7] text-slate-800 p-3.5 pl-4 flex flex-col justify-between hidden border-l-2 border-slate-300 showcase-fade-slide">
                                    <div class="border-b border-slate-300 pb-1 flex justify-between items-center text-[7.5px] font-bold text-slate-500">
                                        <span id="modalInsideLabel">BAGIAN ISI NASKAH</span>
                                        <span>hlm. 1</span>
                                    </div>
                                    <div class="text-[7.5px] text-slate-600 leading-relaxed my-auto space-y-1 font-serif">
                                        <p class="font-bold text-slate-800 text-[8.5px]" id="modalInsideTitle">Pratinjau Isi Halaman</p>
                                        <p>Kajian akademik dan riset ilmiah kurikulum perguruan tinggi...</p>
                                        <div class="w-full h-0.5 bg-slate-200 my-1"></div>
                                        <p>Standar UNESCO B5 Bookpaper.</p>
                                    </div>
                                    <div class="pt-1 border-t border-slate-200 text-center text-[7px] text-slate-400 font-mono">
                                        <span>PERSIS PERS</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- 4 Multi-Photo Switcher Tabs -->
                        <div id="modalPhotoSwitcherContainer" class="w-full flex flex-wrap items-center justify-center gap-1.5 pt-1 border-t border-slate-200"></div>

                    </div>

                    <!-- Right: Specs, Synopsis, WhatsApp Order -->
                    <div class="md:col-span-7 space-y-4">
                        
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span id="modalCategory" class="px-2.5 py-0.5 rounded-sm text-[10.5px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Kategori
                                </span>
                                <span id="modalBadgeStatus" class="hidden px-2.5 py-0.5 rounded-sm text-[10.5px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300">
                                    Baru 2026
                                </span>
                            </div>

                            <h2 id="modalTitle" class="text-base sm:text-lg md:text-xl font-extrabold text-slate-900 leading-snug">
                                Judul Lengkap Buku
                            </h2>
                            <p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5">
                                <i class="fa-solid fa-pen-nib text-emerald-600 text-[10px]"></i>
                                Penulis: <strong id="modalAuthor" class="text-slate-800 font-bold">Nama Penulis</strong>
                            </p>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 p-3 bg-slate-50 rounded-sm border border-slate-200 text-xs">
                            <div>
                                <span class="text-[10px] text-slate-400 block font-medium">Nomor ISBN</span>
                                <span id="modalIsbn" class="font-mono font-bold text-slate-800 text-[11px] block mt-0.5">978-623-xxxx</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400 block font-medium">Format &amp; Kertas</span>
                                <span id="modalFormat" class="font-semibold text-slate-800 text-[11px] block mt-0.5">UNESCO B5</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400 block font-medium">Tebal Halaman</span>
                                <span id="modalPages" class="font-semibold text-slate-800 text-[11px] block mt-0.5">240 hlm</span>
                            </div>
                            <div>
                                <span class="text-[10px] text-slate-400 block font-medium">Tahun Terbit</span>
                                <span id="modalYear" class="font-mono font-semibold text-slate-800 text-[11px] block mt-0.5">2026</span>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <span class="text-[10px] text-slate-400 block font-medium">Harga Cetak Resmi</span>
                                <span id="modalPrice" class="font-mono font-black text-emerald-700 text-sm block mt-0.5">Rp 75.000</span>
                            </div>
                        </div>

                        <div>
                            <span class="text-xs font-bold text-slate-800 block mb-1">Sinopsis Buku</span>
                            <div id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed max-h-36 overflow-y-auto pr-1 space-y-1">
                                Sinopsis buku akan dimuat di sini...
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-2.5">
                            <a id="modalWaOrderBtn" href="#" target="_blank" class="w-full sm:flex-1 py-2.5 px-4 rounded-sm bg-emerald-700 hover:bg-emerald-800 text-white text-xs sm:text-sm font-bold transition shadow-xs flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Pesan Buku via WhatsApp</span>
                            </a>
                            <a id="modalSamplePdfBtn" href="#" target="_blank" class="hidden w-full sm:w-auto py-2.5 px-4 rounded-sm bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs sm:text-sm font-bold transition border border-emerald-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-file-pdf"></i>
                                <span>Sampel PDF</span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- 5. FULLSCREEN HIGH DEFINITION LIGHTBOX (LAYERED CLEANLY ON TOP Z-100) -->
    <!-- ========================================================================= -->
    <div id="bookLightboxModal" class="fixed inset-0 z-[100] bg-black/95 hidden items-center justify-center p-4 backdrop-blur-md" onclick="handleLightboxBackdropClick(event)">
        
        <!-- Top Controls Bar -->
        <div class="absolute top-4 inset-x-4 sm:inset-x-8 flex items-center justify-between text-white z-50">
            <div class="flex items-center gap-2 bg-black/50 px-3 py-1.5 rounded-full border border-white/20">
                <span id="lightboxLabel" class="text-xs font-bold text-emerald-400 font-mono">1 / 4 • SAMPUL DEPAN</span>
            </div>
            <button type="button" onclick="closeLightboxModal()" class="w-10 h-10 rounded-full bg-white/15 hover:bg-rose-600 text-white flex items-center justify-center text-lg transition shadow-lg" title="Tutup (Esc)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Previous Arrow -->
        <button type="button" onclick="prevLightboxPhoto()" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/15 hover:bg-emerald-600 text-white flex items-center justify-center text-xl transition z-50 shadow-lg" title="Foto Sebelumnya (Panah Kiri)">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <!-- Next Arrow -->
        <button type="button" onclick="nextLightboxPhoto()" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/15 hover:bg-emerald-600 text-white flex items-center justify-center text-xl transition z-50 shadow-lg" title="Foto Selanjutnya (Panah Kanan)">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <!-- Lightbox Zoom Image Stage -->
        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center justify-center select-none lightbox-zoom-in my-auto">
            <div class="relative rounded-sm overflow-hidden shadow-2xl border border-white/20 bg-slate-950 max-h-[72vh] aspect-[3/4.15]">
                <img id="lightboxImage" src="" alt="Zoomed Book" class="w-full h-full object-contain" />
            </div>
            
            <div class="mt-3 text-center">
                <h4 id="lightboxTitle" class="text-white text-sm font-bold truncate max-w-xl">
                    Judul Buku
                </h4>
            </div>
        </div>

    </div>

    <!-- Public Catalog JS -->
    <script>
        let currentModalBook = null;
        let currentModalPhotos = [];
        let currentPhotoIndex = 0;

        function openBookModal(book) {
            currentModalBook = book;
            currentModalPhotos = [];
            currentPhotoIndex = 0;

            document.getElementById('modalTitle').innerText = book.title;
            document.getElementById('modalAuthor').innerText = book.author;
            document.getElementById('modalCategory').innerText = book.category;
            document.getElementById('modalIsbn').innerText = book.isbn || 'Dalam Proses';
            document.getElementById('modalFormat').innerText = book.format || 'UNESCO B5';
            document.getElementById('modalPages').innerText = book.pages ? (book.pages + ' hlm') : '-';
            document.getElementById('modalYear').innerText = book.year || '2026';
            document.getElementById('modalPrice').innerText = book.price || 'Hubungi Admin';
            document.getElementById('modalSynopsis').innerText = book.synopsis || 'Belum ada sinopsis untuk buku ini.';

            document.getElementById('modalVectorTitle').innerText = book.title;
            document.getElementById('modalVectorAuthor').innerText = book.author;
            document.getElementById('modalVectorCat').innerText = book.category;

            const badge = document.getElementById('modalBadgeStatus');
            if (book.is_new_release) {
                badge.innerText = 'Baru 2026';
                badge.className = 'px-2.5 py-0.5 rounded-sm text-[10.5px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300';
                badge.classList.remove('hidden');
            } else if (book.is_best_seller) {
                badge.innerText = 'Best Seller';
                badge.className = 'px-2.5 py-0.5 rounded-sm text-[10.5px] font-bold bg-amber-50 text-amber-700 border border-amber-200';
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }

            const waNumber = '6281220000000';
            const waText = encodeURIComponent('Halo PERSIS PERS, saya ingin memesan buku "' + book.title + '" (ISBN: ' + (book.isbn || '-') + ') dengan harga ' + book.price + '.');
            document.getElementById('modalWaOrderBtn').href = 'https://wa.me/' + waNumber + '?text=' + waText;

            const pdfBtn = document.getElementById('modalSamplePdfBtn');
            if (book.sample_pdf) {
                pdfBtn.href = '/storage/' + book.sample_pdf;
                pdfBtn.classList.remove('hidden');
            } else {
                pdfBtn.classList.add('hidden');
            }

            if (book.cover_image) currentModalPhotos.push({ label: 'Depan', url: resolveBookImgUrl(book.cover_image), type: 'cover' });
            if (book.back_cover_image) currentModalPhotos.push({ label: 'Belakang', url: resolveBookImgUrl(book.back_cover_image), type: 'back' });
            if (book.inside_preview_image) currentModalPhotos.push({ label: 'Isi 1', url: resolveBookImgUrl(book.inside_preview_image), type: 'inside' });
            if (book.additional_image) currentModalPhotos.push({ label: 'Isi 2', url: resolveBookImgUrl(book.additional_image), type: 'inside2' });

            if (currentModalPhotos.length === 0) {
                currentModalPhotos = [
                    { label: 'Depan', url: null, type: 'cover' },
                    { label: 'Belakang', url: null, type: 'back' },
                    { label: 'Isi 1', url: null, type: 'inside' },
                    { label: 'Isi 2', url: null, type: 'inside2' }
                ];
            }

            const container = document.getElementById('modalPhotoSwitcherContainer');
            container.innerHTML = '';

            currentModalPhotos.forEach((photo, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = idx === 0 
                    ? 'px-3 py-1 rounded-sm text-[10px] font-bold bg-emerald-700 text-white transition shadow-2xs'
                    : 'px-3 py-1 rounded-sm text-[10px] font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition';
                btn.innerText = photo.label;
                btn.onclick = () => switchModalPhoto(idx);
                container.appendChild(btn);
            });

            switchModalPhoto(0);

            const modal = document.getElementById('publicBookModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function resolveBookImgUrl(path) {
            if (!path) return null;
            if (path.startsWith('http') || path.startsWith('/')) return path;
            return '/storage/' + path;
        }

        function switchModalPhoto(index) {
            currentPhotoIndex = index;
            const photo = currentModalPhotos[index];
            if (!photo) return;

            const container = document.getElementById('modalPhotoSwitcherContainer');
            Array.from(container.children).forEach((btn, idx) => {
                btn.className = idx === index
                    ? 'px-3 py-1 rounded-sm text-[10px] font-bold bg-emerald-700 text-white transition shadow-2xs'
                    : 'px-3 py-1 rounded-sm text-[10px] font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition';
            });

            const imgEl = document.getElementById('modalMainImage');
            const frontVec = document.getElementById('modalVectorFront');
            const insideVec = document.getElementById('modalVectorInside');

            imgEl.classList.add('hidden');
            frontVec.classList.add('hidden');
            insideVec.classList.add('hidden');

            if (photo.url) {
                imgEl.src = photo.url;
                imgEl.classList.remove('hidden');
                imgEl.classList.remove('showcase-fade-slide');
                void imgEl.offsetWidth;
                imgEl.classList.add('showcase-fade-slide');
            } else {
                if (photo.type === 'cover' || photo.type === 'back') {
                    frontVec.classList.remove('hidden');
                    frontVec.classList.remove('showcase-fade-slide');
                    void frontVec.offsetWidth;
                    frontVec.classList.add('showcase-fade-slide');
                } else {
                    insideVec.classList.remove('hidden');
                    insideVec.classList.remove('showcase-fade-slide');
                    void insideVec.offsetWidth;
                    insideVec.classList.add('showcase-fade-slide');
                }
            }
        }

        function closeBookModal() {
            const modal = document.getElementById('publicBookModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // =======================================================
        // CLEAN FULLSCREEN LIGHTBOX (CLEAN LAYER HIDING DETAIL)
        // =======================================================
        function openLightboxFromDetail() {
            const photo = currentModalPhotos[currentPhotoIndex];
            if (!photo || !photo.url) return;

            document.getElementById('lightboxImage').src = photo.url;
            document.getElementById('lightboxLabel').innerText = (currentPhotoIndex + 1) + ' / ' + currentModalPhotos.length + ' • ' + photo.label.toUpperCase();
            document.getElementById('lightboxTitle').innerText = currentModalBook ? currentModalBook.title : 'Pratinjau Naskah';

            // Hide detail modal to avoid overlapping
            const detailModal = document.getElementById('publicBookModal');
            detailModal.classList.add('hidden');
            detailModal.classList.remove('flex');

            // Open clean lightbox
            const lightbox = document.getElementById('bookLightboxModal');
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
        }

        function closeLightboxModal() {
            const lightbox = document.getElementById('bookLightboxModal');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');

            // Restore detail modal cleanly
            if (currentModalBook) {
                const detailModal = document.getElementById('publicBookModal');
                detailModal.classList.remove('hidden');
                detailModal.classList.add('flex');
            }
        }

        function prevLightboxPhoto() {
            if (currentModalPhotos.length <= 1) return;
            currentPhotoIndex = (currentPhotoIndex - 1 + currentModalPhotos.length) % currentModalPhotos.length;
            switchModalPhoto(currentPhotoIndex);
            
            const photo = currentModalPhotos[currentPhotoIndex];
            if (photo && photo.url) {
                document.getElementById('lightboxImage').src = photo.url;
                document.getElementById('lightboxLabel').innerText = (currentPhotoIndex + 1) + ' / ' + currentModalPhotos.length + ' • ' + photo.label.toUpperCase();
            }
        }

        function nextLightboxPhoto() {
            if (currentModalPhotos.length <= 1) return;
            currentPhotoIndex = (currentPhotoIndex + 1) % currentModalPhotos.length;
            switchModalPhoto(currentPhotoIndex);

            const photo = currentModalPhotos[currentPhotoIndex];
            if (photo && photo.url) {
                document.getElementById('lightboxImage').src = photo.url;
                document.getElementById('lightboxLabel').innerText = (currentPhotoIndex + 1) + ' / ' + currentModalPhotos.length + ' • ' + photo.label.toUpperCase();
            }
        }

        function handleLightboxBackdropClick(e) {
            if (e.target.id === 'bookLightboxModal') {
                closeLightboxModal();
            }
        }

        document.addEventListener('keydown', function(e) {
            const lightbox = document.getElementById('bookLightboxModal');
            if (lightbox && !lightbox.classList.contains('hidden')) {
                if (e.key === 'Escape') {
                    closeLightboxModal();
                } else if (e.key === 'ArrowLeft') {
                    prevLightboxPhoto();
                } else if (e.key === 'ArrowRight') {
                    nextLightboxPhoto();
                }
            } else if (e.key === 'Escape') {
                closeBookModal();
            }
        });

        document.getElementById('publicBookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });
    </script>
@endsection
