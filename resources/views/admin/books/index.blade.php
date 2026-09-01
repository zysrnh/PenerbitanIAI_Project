@extends('admin.layouts.app')

@section('title', 'Katalog Buku & ISBN')
@section('header_title', 'Manajemen Koleksi Buku & Terbitan')

@section('content')
    <!-- Include Cropper.js for Interactive Image Cropping -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>


    <style>
        /* 1. Realistic 3D Perspective Hover Tilt */
        .book-stage-3d {
            perspective: 800px;
        }
        .book-hover-3d {
            transform-style: preserve-3d;
            transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
            box-shadow: 6px 8px 16px -2px rgba(0, 0, 0, 0.25), 1px 1px 4px rgba(0,0,0,0.1);
        }
        .book-stage-3d:hover .book-hover-3d {
            transform: rotateY(-18deg) rotateX(6deg) translateY(-4px) scale(1.03);
            box-shadow: 14px 20px 28px -4px rgba(0, 0, 0, 0.38), 3px 3px 8px rgba(0,0,0,0.15);
        }
        .book-shine-layer {
            background: linear-gradient(135deg, rgba(255,255,255,0.22) 0%, rgba(255,255,255,0) 60%);
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

        /* Lightbox Directional Slide Animations */
        .lightbox-slide-next {
            animation: slideNext 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .lightbox-slide-prev {
            animation: slidePrev 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes slideNext {
            0% { opacity: 0; transform: translateX(45px) scale(0.96); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes slidePrev {
            0% { opacity: 0; transform: translateX(-45px) scale(0.96); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }

        /* Smooth Tab Transition */
        .showcase-transition {
            animation: cleanFadeSlide 0.28s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes cleanFadeSlide {
            0% { opacity: 0; transform: scale(0.97) translateY(4px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }
        .photo-card-hover {
            transition: all 0.2s ease;
        }
        .photo-card-hover:hover {
            transform: translateY(-2px);
            border-color: #006830;
        }
    </style>

    <!-- Top Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 mb-4 sm:mb-5">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    KATALOG MASTER BUKU
                </span>
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• {{ $books->total() }} Judul Terdaftar</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Katalog Buku &amp; Publikasi Ilmiah
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Kelola master buku, nomor ISBN, galeri foto naskah (Depan, Belakang, Isi 1 &amp; 2), dan harga cetak.
            </p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="flex-1 sm:flex-none px-3 sm:px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Toko Publik</span>
            </a>
            <button type="button" onclick="openCreateModal()" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Buku</span>
            </button>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3.5 mb-4 sm:mb-5">
        
        <!-- Card 1: Total Koleksi -->
        <div class="bg-white p-3 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between hover:border-emerald-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Koleksi</span>
                <h4 class="text-base sm:text-2xl font-black text-slate-900 font-mono mt-0.5">{{ $books->total() }} <span class="text-xs font-semibold text-slate-500 font-sans">Judul</span></h4>
                <span class="text-[11px] text-emerald-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i> Koleksi Ber-ISBN
                </span>
            </div>
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-book"></i>
            </div>
        </div>

        <!-- Card 2: Terbitan Baru -->
        <div class="bg-white p-3 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between hover:border-blue-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Terbitan Baru (2026)</span>
                <h4 class="text-base sm:text-2xl font-black text-blue-700 font-mono mt-0.5">{{ $books->where('is_new_release', true)->count() }} <span class="text-xs font-semibold text-slate-500 font-sans">Judul</span></h4>
                <span class="text-[11px] text-blue-600 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-star text-[9px]"></i> Rilis Terbaru
                </span>
            </div>
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-blue-50 text-blue-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-star"></i>
            </div>
        </div>

        <!-- Card 3: Best Seller -->
        <div class="bg-white p-3 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between hover:border-amber-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Koleksi Best Seller</span>
                <h4 class="text-base sm:text-2xl font-black text-amber-700 font-mono mt-0.5">{{ $books->where('is_best_seller', true)->count() }} <span class="text-xs font-semibold text-slate-500 font-sans">Judul</span></h4>
                <span class="text-[11px] text-amber-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-trophy text-[9px]"></i> Terpopuler
                </span>
            </div>
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-amber-50 text-amber-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-trophy"></i>
            </div>
        </div>

        <!-- Card 4: Kategori Aktif -->
        <div class="bg-white p-3 sm:p-4 rounded-sm border border-slate-200/90 shadow-2xs flex items-center justify-between hover:border-purple-500 transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Kategori Aktif</span>
                <h4 class="text-base sm:text-2xl font-black text-purple-700 font-mono mt-0.5">{{ count($categories ?? []) }} <span class="text-xs font-semibold text-slate-500 font-sans">Kategori</span></h4>
                <span class="text-[11px] text-purple-700 font-semibold flex items-center gap-1 mt-1">
                    <i class="fa-solid fa-layer-group text-[9px]"></i> Klasifikasi Keilmuan
                </span>
            </div>
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-purple-50 text-purple-600 flex items-center justify-center text-lg shrink-0 group-hover:scale-105 transition">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

    </div>

    <!-- Main Table Card with Search & Filters -->
    <div class="bg-white rounded-sm border border-slate-200/80 shadow-xs">
        
        <!-- Filter Header -->
        <div class="p-3.5 sm:p-4 border-b border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
            <form id="adminSearchForm" action="{{ route('admin.books.index') }}" method="GET" class="w-full sm:w-auto flex flex-col sm:flex-row items-center gap-3 relative z-30" autocomplete="off">
                <div class="relative w-full sm:w-80">
                    <input 
                        type="search" 
                        name="search_query_custom" 
                        id="adminSearchInput" autocomplete="off" 
                        autocomplete="off" 
                        autocorrect="off" 
                        autocapitalize="off" 
                        spellcheck="false"
                        value="{{ request('q') }}" 
                        placeholder="Cari judul, nama penulis, nomor ISBN..." 
                        class="w-full pl-9 pr-8 py-2 text-xs rounded-sm border border-slate-300 focus:outline-hidden focus:border-emerald-600 focus:ring-1 focus:ring-emerald-500 font-medium transition"
                        oninput="handleAdminLiveSearch(this.value)"
                        onfocus="handleAdminLiveSearch(this.value)"
                    />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                    
                    <!-- Clear Input Button -->
                    <button 
                        type="button" 
                        id="adminClearSearchBtn" 
                        onclick="clearAdminSearch()" 
                        class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 text-xs"
                        title="Hapus pencarian"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                    <!-- Instant Suggestion Dropdown -->
                    <div 
                        id="adminAutocompleteDropdown" 
                        class="hidden absolute left-0 right-0 top-full mt-2 bg-white rounded-sm shadow-2xl border border-emerald-600/30 overflow-hidden z-[9999] divide-y divide-slate-100 max-h-72 overflow-y-auto ring-4 ring-black/5"
                    >
                        <div id="adminAutocompleteList" class="p-1.5 space-y-1"></div>
                    </div>
                </div>

                <!-- Custom Enterprise Category Filter Dropdown -->
                <div class="relative w-full sm:w-48" id="adminCustomCatContainer">
                    <input type="hidden" name="kategori" id="adminCustomCatInput" value="{{ request('kategori') }}" />
                    <button 
                        type="button" 
                        id="adminCustomCatBtn"
                        onclick="toggleAdminCatDropdown(event)"
                        class="w-full px-3 py-2 bg-white border border-slate-300 rounded-sm text-xs font-semibold text-slate-800 flex items-center justify-between hover:border-emerald-600 transition cursor-pointer shadow-2xs"
                    >
                        <span id="adminCustomCatLabel" class="truncate">{{ request('kategori') ?: 'Semua Kategori' }}</span>
                        <i id="adminCustomCatChevron" class="fa-solid fa-chevron-down text-[9px] text-slate-400 transition-transform duration-200"></i>
                    </button>

                    <div id="adminCustomCatMenu" class="hidden absolute left-0 right-0 top-full mt-1 bg-white border border-slate-200 rounded-sm shadow-2xl overflow-hidden py-1 divide-y divide-slate-100 z-[9999] max-h-64 overflow-y-auto ring-4 ring-black/5 animate-fade-in">
                        <button type="button" onclick="selectAdminCatOption('', 'Semua Kategori', event)" class="w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                            <span>Semua Kategori</span>
                            <i class="fa-solid fa-check text-xs text-emerald-600 {{ !request('kategori') ? '' : 'hidden' }} cat-check-icon" data-cat=""></i>
                        </button>
                        @foreach($categories as $cat)
                            <button type="button" onclick="selectAdminCatOption('{{ $cat }}', '{{ $cat }}', event)" class="w-full px-3 py-2 text-left text-xs hover:bg-slate-50 flex items-center justify-between font-medium cursor-pointer">
                                <span>{{ $cat }}</span>
                                <i class="fa-solid fa-check text-xs text-emerald-600 {{ request('kategori') === $cat ? '' : 'hidden' }} cat-check-icon" data-cat="{{ $cat }}"></i>
                            </button>
                        @endforeach
                    </div>
                </div>
            </form>

            <div id="filterResultCount" class="text-xs text-slate-400 font-mono hidden sm:block">
                Menampilkan: <strong class="text-emerald-700 font-bold" id="visibleRowCount">{{ $books->count() }}</strong> dari {{ $books->total() }} buku
            </div>
        </div>

        <!-- 1. MOBILE NATIVE BOOK CARDS (Visible on mobile screens < 640px) -->
        <div class="block sm:hidden divide-y divide-slate-100" id="adminMobileBookList">
            @forelse($books as $book)
                <div class="p-3.5 hover:bg-slate-50/80 transition space-y-2.5 book-mobile-card" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}" data-category="{{ $book->category }}" data-isbn="{{ strtolower($book->isbn) }}" data-json="{{ htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') }}">
                    <div class="flex items-start gap-3">
                        <!-- Book Cover 3D Stage Thumbnail -->
                        <div class="w-16 h-22 shrink-0 cursor-pointer" onclick="openEditModal({{ json_encode($book) }})">
                            <div class="relative w-full h-full rounded-xs overflow-hidden shadow-xs border border-slate-300 bg-slate-900">
                                @php
                                    $mobCoverUrl = null;
                                    if (!empty($book->cover_image)) {
                                        $cImg = ltrim($book->cover_image, '/');
                                        if (str_starts_with($cImg, 'http')) {
                                            $mobCoverUrl = $cImg;
                                        } elseif (file_exists(public_path('storage/' . $cImg))) {
                                            $mobCoverUrl = asset('storage/' . $cImg);
                                        } elseif (file_exists(public_path($cImg))) {
                                            $mobCoverUrl = asset($cImg);
                                        } elseif (file_exists(public_path('images/' . $cImg))) {
                                            $mobCoverUrl = asset('images/' . $cImg);
                                        } else {
                                            $mobCoverUrl = asset('storage/' . $cImg);
                                        }
                                    }
                                @endphp
                                @if($mobCoverUrl)
                                    <img src="{{ $mobCoverUrl }}" alt="" class="w-full h-full object-cover relative z-0" onerror="this.style.display='none'; if(this.nextElementSibling){this.nextElementSibling.style.display='flex';}" />
                                @endif
                                <div class="w-full h-full bg-[#032c21] p-1.5 flex flex-col justify-between text-[7px] text-white" style="{{ $mobCoverUrl ? 'display: none;' : '' }}">
                                    <span class="text-emerald-300 font-bold truncate">PERSIS PERS</span>
                                    <span class="font-black line-clamp-3 leading-tight text-[7.5px]">{{ $book->title }}</span>
                                    <span class="text-slate-300 truncate text-[6px]">{{ $book->author }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Book Info -->
                        <div class="flex-1 min-w-0 space-y-1">
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <span class="px-1.5 py-0.2 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    {{ $book->category }}
                                </span>
                                @if($book->is_best_seller)
                                    <span class="px-1.5 py-0.2 rounded-xs text-[9px] font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                        <i class="fa-solid fa-trophy text-[8px]"></i> Best Seller
                                    </span>
                                @endif
                            </div>

                            <h4 class="font-bold text-slate-900 text-xs leading-snug line-clamp-2 cursor-pointer hover:text-emerald-800" onclick="openEditModal({{ json_encode($book) }})">
                                {{ $book->title }}
                            </h4>

                            <p class="text-[11px] text-slate-500 truncate flex items-center gap-1">
                                <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                <span>{{ $book->author }}</span>
                            </p>

                            <div class="flex items-center justify-between pt-0.5">
                                <span class="font-mono font-black text-emerald-800 text-xs">
                                    {{ $book->formatted_price }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">
                                    {{ $book->page_count ? $book->page_count . ' hlm' : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="text-[10px] text-slate-400 font-mono truncate">ISBN: {{ $book->isbn ?: '-' }}</span>
                        <div class="flex items-center gap-1.5 shrink-0">
                            <button type="button" onclick="openEditModal({{ json_encode($book) }})" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                                <span>Edit</span>
                            </button>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari katalog?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 px-2 bg-slate-100 hover:bg-rose-50 text-slate-500 hover:text-rose-600 rounded-xs text-xs transition" title="Hapus">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-slate-400 text-xs">
                    <i class="fa-solid fa-book-open text-xl mb-1 text-slate-300 block"></i>
                    Belum ada buku yang terdaftar.
                </div>
            @endforelse
        </div>

        <!-- 2. DESKTOP WIDE TABLE (Visible on tablets & desktop >= 640px) -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3 px-3 w-10 text-center">
                            <input type="checkbox" id="selectAllBooks" onchange="toggleSelectAllBooks(this)" class="w-4 h-4 rounded-xs text-emerald-700 focus:ring-emerald-500 cursor-pointer" title="Pilih Semua Buku di Halaman Ini" />
                        </th>
                        <th class="py-3 px-4 w-28">Sampul Buku</th>
                        <th class="py-3 px-4">Judul &amp; Penulis</th>
                        <th class="py-3 px-4">Kategori &amp; ISBN</th>
                        <th class="py-3 px-4">Format &amp; Hlm</th>
                        <th class="py-3 px-4">Harga Cetak</th>
                        <th class="py-3 px-4">Etalase / Foto</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-50/70 transition book-table-row" data-book-id="{{ $book->id }}" data-title="{{ strtolower($book->title) }}" data-author="{{ strtolower($book->author) }}" data-category="{{ $book->category }}" data-isbn="{{ strtolower($book->isbn) }}" data-json="{{ htmlspecialchars(json_encode($book), ENT_QUOTES, 'UTF-8') }}">
                            
                            <td class="py-3.5 px-3 text-center">
                                <input type="checkbox" value="{{ $book->id }}" onchange="updateBulkBarState()" class="book-row-chk w-4 h-4 rounded-xs text-emerald-700 focus:ring-emerald-500 cursor-pointer" />
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="book-stage-3d w-20 h-28 cursor-pointer" onclick="openEditModal({{ json_encode($book) }})" title="Klik untuk Pratinjau 3D & Edit">
                                    <div class="book-hover-3d relative w-full h-full rounded-xs overflow-hidden shadow-xs border border-slate-300 bg-slate-900 select-none">
                                        <div class="book-spine-strip"></div>
                                        <div class="book-paper-edge"></div>
                                        <div class="book-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                        @php
                                            $deskCoverUrl = null;
                                            if (!empty($book->cover_image)) {
                                                $cImg = ltrim($book->cover_image, '/');
                                                if (str_starts_with($cImg, 'http')) {
                                                    $deskCoverUrl = $cImg;
                                                } elseif (file_exists(public_path('storage/' . $cImg))) {
                                                    $deskCoverUrl = asset('storage/' . $cImg);
                                                } elseif (file_exists(public_path($cImg))) {
                                                    $deskCoverUrl = asset($cImg);
                                                } elseif (file_exists(public_path('images/' . $cImg))) {
                                                    $deskCoverUrl = asset('images/' . $cImg);
                                                } else {
                                                    $deskCoverUrl = asset('storage/' . $cImg);
                                                }
                                            }
                                        @endphp
                                        @if($deskCoverUrl)
                                            <img src="{{ $deskCoverUrl }}" alt="" class="w-full h-full object-cover relative z-0" onerror="this.style.display='none'; if(this.nextElementSibling){this.nextElementSibling.style.display='flex';}" />
                                        @endif
                                        <div class="w-full h-full bg-[#032c21] p-2 pl-3 flex flex-col justify-between text-[7px] text-white" style="{{ $deskCoverUrl ? 'display: none;' : '' }}">
                                            <span class="text-emerald-300 font-bold truncate">PERSIS PERS</span>
                                            <span class="font-black line-clamp-3 leading-tight text-[8px]">{{ $book->title }}</span>
                                            <span class="text-slate-300 truncate text-[6.5px]">{{ $book->author }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="py-3.5 px-4 max-w-xs">
                                <h4 class="font-bold text-slate-900 text-xs sm:text-[13px] leading-snug line-clamp-2 hover:text-emerald-700 transition cursor-pointer" onclick="openEditModal({{ json_encode($book) }})">
                                    {{ $book->title }}
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                    <span>{{ $book->author }}</span>
                                </p>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    {{ $book->category }}
                                </span>
                                <span class="text-[11px] font-mono text-slate-500 block mt-1">
                                    ISBN: {{ $book->isbn ?: '-' }}
                                </span>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="font-bold text-slate-800 block text-xs">{{ $book->pages ? $book->pages . ' hlm' : '-' }}</span>
                                <span class="text-[11px] text-emerald-700 font-mono block font-semibold">{{ $book->size ?: '17,6 x 25 cm' }}</span>
                                <span class="text-[10px] text-slate-400 block">{{ $book->format ?: 'UNESCO B5' }}</span>
                            </td>

                            <td class="py-3.5 px-4">
                                <span class="font-mono font-black text-emerald-700 text-xs sm:text-sm">{{ $book->price }}</span>
                            </td>

                            <td class="py-3.5 px-4 space-y-1">
                                @if($book->is_new_release)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Baru 2026
                                    </span>
                                @endif
                                @if($book->is_best_seller)
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <i class="fa-solid fa-trophy mr-1 text-[8px]"></i> Best Seller
                                    </span>
                                @endif
                                <div class="text-[10px] text-slate-400 font-semibold flex items-center gap-1">
                                    <i class="fa-solid fa-images text-emerald-600"></i>
                                    <span>4 Foto Terunggah</span>
                                </div>
                            </td>

                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button type="button" onclick="openEditModal({{ json_encode($book) }})" class="w-8 h-8 rounded-sm bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 flex items-center justify-center transition" title="Edit Data &amp; Foto">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-sm bg-slate-100 hover:bg-rose-50 text-slate-600 hover:text-rose-600 flex items-center justify-center transition" title="Hapus">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <i class="fa-solid fa-book-open text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada buku yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($books->hasPages())
            <div class="p-4 border-t border-slate-100 flex items-center justify-end">
                {{ $books->links() }}
            </div>
        @endif

    </div>

    <!-- MODAL FORM TAMBAH / EDIT BUKU -->
    <div id="bookModal" class="fixed inset-0 z-50 bg-black/75 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto backdrop-blur-xs">
        <div class="bg-white rounded-sm max-w-5xl w-full shadow-2xl border border-slate-200 overflow-hidden relative my-auto max-h-[92vh] flex flex-col animate-fade-in-up">
            
            <!-- Modal Header -->
            <div class="bg-[#032c21] text-white px-6 py-4 flex items-center justify-between border-b border-[#064e3b] shrink-0">
                <div class="flex items-center gap-2.5">
                    <span class="w-2.5 h-2.5 rounded-xs bg-emerald-400 animate-pulse"></span>
                    <h3 id="modalHeaderTitle" class="text-sm sm:text-base font-extrabold uppercase tracking-wide text-white">Tambah Data &amp; Foto Naskah Buku</h3>
                </div>
                <button type="button" onclick="closeBookModal()" class="w-8 h-8 rounded-sm bg-[#064e3b] hover:bg-[#08634c] text-slate-200 hover:text-white flex items-center justify-center text-sm font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form id="bookForm" method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="p-6 overflow-y-auto space-y-6">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: 3D Animated Showcase Visualizer & 4 Dropzone Cards -->
                    <div class="lg:col-span-5 space-y-5">
                        
                        <!-- 3D Interactive Visualizer Container -->
                        <div class="bg-slate-50 p-4 rounded-sm border border-slate-200 text-center space-y-3">
                            <div class="flex items-center justify-center gap-1.5" id="photoSwitcherTabs">
                                <button type="button" onclick="switchVisualizerTab('cover')" id="tab_cover" class="px-3 py-1 rounded-sm text-xs font-bold bg-[#006830] text-white transition shadow-2xs">Depan</button>
                                <button type="button" onclick="switchVisualizerTab('back')" id="tab_back" class="px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition">Belakang</button>
                                <button type="button" onclick="switchVisualizerTab('inside1')" id="tab_inside1" class="px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition">Isi 1</button>
                                <button type="button" onclick="switchVisualizerTab('inside2')" id="tab_inside2" class="px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition">Isi 2</button>
                            </div>

                            <!-- 3D Perspective Stage -->
                            <div class="book-stage-3d w-44 sm:w-48 aspect-[3/4.15] mx-auto py-2 cursor-pointer group relative" onclick="openAdminLightbox()" title="Klik untuk Pratinjau Layar Penuh">
                                <div id="modalBookMockup" class="book-hover-3d relative w-full h-full rounded-xs overflow-hidden shadow-md border border-slate-300 bg-slate-900 select-none">
                                    <div class="book-spine-strip"></div>
                                    <div class="book-paper-edge"></div>
                                    <div class="book-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                    <div class="absolute top-2 right-2 w-7 h-7 rounded-sm bg-black/40 hover:bg-black/70 text-white flex items-center justify-center text-xs backdrop-blur-xs opacity-0 group-hover:opacity-100 transition z-20 pointer-events-none shadow-xs">
                                        <i class="fa-solid fa-expand"></i>
                                    </div>

                                    <img id="visImg" src="" alt="" class="w-full h-full object-cover hidden showcase-transition" onerror="this.classList.add('hidden'); if(activeTab==='cover'||activeTab==='back'){document.getElementById('visFrontVec').classList.remove('hidden');}else{document.getElementById('visInsideVec').classList.remove('hidden');}" />

                                    <div id="visFrontVec" class="w-full h-full bg-[#032c21] p-3.5 pl-4 flex flex-col justify-between text-white border-l-4 border-emerald-400">
                                        <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                            <span id="visFrontCat" class="text-[8px] font-bold uppercase px-1.5 py-0.5 rounded-xs bg-[#064e3b] text-emerald-300">Buku Ajar</span>
                                            <span class="text-[7.5px] text-slate-300 font-mono">PERSIS PERS</span>
                                        </div>
                                        <div class="text-center my-auto py-1.5">
                                            <div class="w-5 h-0.5 bg-amber-400 mx-auto mb-1.5"></div>
                                            <h5 id="visFrontTitle" class="font-black text-xs text-white leading-tight font-heading line-clamp-3">Judul Buku</h5>
                                            <div class="w-5 h-0.5 bg-amber-400 mx-auto mt-1.5"></div>
                                        </div>
                                        <div class="pt-1 border-t border-white/20 text-center">
                                            <span id="visFrontAuthor" class="text-[9px] text-slate-200 block font-medium truncate">Nama Penulis</span>
                                        </div>
                                    </div>

                                    <div id="visInsideVec" class="w-full h-full bg-[#fdfbf7] text-slate-800 p-3.5 pl-4 flex flex-col justify-between hidden border-l-2 border-slate-300 showcase-transition">
                                        <div class="border-b border-slate-300 pb-1 flex justify-between items-center text-[7.5px] font-bold text-slate-500">
                                            <span id="visInsideLabel">BAGIAN ISI NASKAH</span>
                                            <span>hlm. 1</span>
                                        </div>
                                        <div class="text-[7.5px] text-slate-600 leading-relaxed my-auto space-y-1 font-serif">
                                            <p class="font-bold text-slate-800 text-[8.5px]">Pratinjau Isi Halaman</p>
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

                            <div class="flex items-center justify-between text-xs px-2 pt-1 border-t border-slate-200">
                                <span class="text-[11px] text-slate-400 flex items-center gap-1 font-semibold">
                                    <i class="fa-solid fa-wand-magic-sparkles text-emerald-600"></i> Efek 3D Aktif
                                </span>
                                <span id="visPrice" class="font-mono font-black text-[#006830] text-sm">Rp 75.000</span>
                            </div>
                        </div>

                        <!-- 4 Direct Upload Cards -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-extrabold text-slate-900 uppercase tracking-wider flex items-center gap-1.5">
                                    <i class="fa-solid fa-camera text-emerald-600"></i> Upload Foto Naskah (Klik Kotak)
                                </span>
                                <span class="text-[10px] text-slate-400 font-mono">Maks. 50MB/foto</span>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                
                                <label for="in_cover_image" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-sm border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">1. Sampul Depan <span class="text-rose-500">*</span></span>
                                        <span id="badge_cover" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_cover" class="aspect-[3/2] bg-white rounded-sm border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="cover_image" id="in_cover_image" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'cover')" />
                                </label>

                                <label for="in_back_cover" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-sm border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">2. Sampul Belakang</span>
                                        <span id="badge_back" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_back" class="aspect-[3/2] bg-white rounded-sm border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="back_cover_image" id="in_back_cover" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'back')" />
                                </label>

                                <label for="in_inside1" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-sm border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">3. Halaman Isi 1</span>
                                        <span id="badge_inside1" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_inside1" class="aspect-[3/2] bg-white rounded-sm border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="inside_preview_image" id="in_inside1" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'inside1')" />
                                </label>

                                <label for="in_inside2" class="photo-card-hover relative bg-slate-50 hover:bg-emerald-50/50 p-3 rounded-sm border border-slate-200 hover:border-emerald-500 cursor-pointer block group transition">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="text-xs font-bold text-slate-800">4. Halaman Isi 2</span>
                                        <span id="badge_inside2" class="text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600">Pilih</span>
                                    </div>
                                    <div id="thumb_box_inside2" class="aspect-[3/2] bg-white rounded-sm border border-slate-200 overflow-hidden flex items-center justify-center text-slate-400 group-hover:text-emerald-600 transition">
                                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                    </div>
                                    <input type="file" name="additional_image" id="in_inside2" accept="image/*" class="hidden" onchange="handleImageSelection(this, 'inside2')" />
                                </label>

                            </div>
                        </div>

                    </div>

                    <!-- Right: Book Metadata Fields -->
                    <div class="lg:col-span-7 space-y-4">
                        
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Lengkap Buku <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" id="in_title" required oninput="updateVisualizerLive()" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Contoh: Metodologi Penelitian Studi Islam & Integrasi Sains" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Penulis <span class="text-rose-500">*</span></label>
                                <input type="text" name="author" id="in_author" required oninput="updateVisualizerLive()" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Ag." />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kategori Buku <span class="text-rose-500">*</span></label>
                                <input type="text" name="category" id="in_category" required oninput="updateVisualizerLive()" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" placeholder="Contoh: Buku Ajar / Studi Islam" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor ISBN Resmi (Perpusnas)</label>
                                <input type="text" name="isbn" id="in_isbn" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono" placeholder="978-623-8812-xx-x" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Harga Cetak Resmi <span class="text-rose-500">*</span></label>
                                <input type="text" name="price" id="in_price" required oninput="formatRupiahInput(this)" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono font-bold text-emerald-800" placeholder="Rp 75.000" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Tahun Terbit <span class="text-rose-500">*</span></label>
                                <input type="text" name="year" id="in_year" value="2026" required class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-mono text-center font-bold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Halaman <span class="text-rose-500">*</span></label>
                                <input type="text" name="pages" id="in_pages" placeholder="280" required class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-bold" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Ukuran Buku</label>
                                <input type="text" name="size" id="in_size" value="17,6 x 25 cm" class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 text-center font-bold font-mono" placeholder="17,6 x 25 cm" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Status</label>
                                <select name="status" id="in_status" class="w-full px-3 py-2 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 bg-white font-medium">
                                    <option value="published">Tayang</option>
                                    <option value="draft">Draf</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Format &amp; Standar Cetak</label>
                            <input type="text" name="format" id="in_format" value="UNESCO B5 (Bookpaper)" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 font-medium" />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Sinopsis Ringkas</label>
                            <textarea name="synopsis" id="in_synopsis" rows="3" class="w-full px-3.5 py-2.5 text-sm rounded-sm border border-slate-200 focus:outline-hidden focus:border-emerald-600 leading-relaxed" placeholder="Deskripsi ringkas mengenai isi dan cakupan buku..."></textarea>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-sm border border-slate-200 flex flex-wrap items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="is_new_release" id="in_new_release" value="1" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500" />
                                <span class="text-xs font-bold text-slate-800">🌟 Koleksi Terbitan Baru (2026)</span>
                            </label>

                            <label class="flex items-center gap-2 cursor-pointer select-none">
                                <input type="checkbox" name="is_best_seller" id="in_best_seller" value="1" class="w-4 h-4 rounded text-amber-600 focus:ring-amber-500" />
                                <span class="text-xs font-bold text-slate-800">🏆 Koleksi Best Seller</span>
                            </label>
                        </div>

                    </div>

                </div>

                <!-- Footer Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeBookModal()" class="px-5 py-2.5 rounded-sm bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs sm:text-sm font-bold transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-sm bg-emerald-700 hover:bg-emerald-800 text-white text-xs sm:text-sm font-bold transition shadow-xs hover:shadow-md flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Data Buku</span>
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- CROPPER.JS MODAL (HIGH Z-INDEX & BULLETPROOF OVERLAY) -->
    <div id="cropperModal" class="fixed inset-0 z-[999999] bg-black/85 hidden items-center justify-center p-4 backdrop-blur-xs select-none" style="display: none;">
        <div class="bg-white rounded-sm max-w-2xl w-full shadow-2xl overflow-hidden flex flex-col max-h-[90vh] border border-slate-700">
            <div class="bg-[#032c21] text-white px-5 py-3.5 flex items-center justify-between border-b border-emerald-950">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-crop text-emerald-400 text-xs"></i>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Sesuaikan Pemotongan Foto Buku (Opsional)</span>
                </div>
                <button type="button" onclick="closeCropperModal()" class="w-7 h-7 rounded-xs text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <div class="p-4 flex-1 overflow-hidden flex items-center justify-center bg-slate-950 min-h-[300px]">
                <img id="cropperImage" src="" alt="Crop Preview" class="max-h-[55vh] max-w-full block" />
            </div>
            <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-wrap items-center justify-between gap-3">
                <div class="flex flex-wrap items-center gap-1.5 text-xs">
                    <span class="text-slate-500 font-bold text-[10.5px] uppercase mr-1">Potong Bentang Cover:</span>
                    <button type="button" onclick="cropPresetSpread('right')" class="px-2.5 py-1.5 rounded-xs text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-300 hover:bg-emerald-100 shadow-2xs flex items-center gap-1" title="Potong sisi kanan untuk Sampul Depan">
                        <i class="fa-solid fa-book-open"></i> 📖 Sisi Kanan (Depan)
                    </button>
                    <button type="button" onclick="cropPresetSpread('left')" class="px-2.5 py-1.5 rounded-xs text-xs font-bold bg-indigo-50 text-indigo-800 border border-indigo-300 hover:bg-indigo-100 shadow-2xs flex items-center gap-1" title="Potong sisi kiri untuk Sampul Belakang">
                        <i class="fa-solid fa-book"></i> 📘 Sisi Kiri (Belakang)
                    </button>
                    <button type="button" onclick="setCropRatio(3/4.15)" class="px-2.5 py-1.5 rounded-xs text-xs font-bold bg-white border border-slate-300 hover:bg-slate-100 shadow-2xs">Rasio UNESCO</button>
                    <button type="button" onclick="setCropRatio(NaN)" class="px-2.5 py-1.5 rounded-xs text-xs font-bold bg-white border border-slate-300 hover:bg-slate-100 shadow-2xs">Bebas</button>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="closeCropperModal()" class="px-4 py-2 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xs border border-slate-300 transition shadow-2xs cursor-pointer">
                        Gunakan Foto Asli (Tanpa Crop)
                    </button>
                    <button type="button" onclick="applyCrop()" class="px-5 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs rounded-xs shadow-2xs flex items-center gap-1.5 transition cursor-pointer">
                        <i class="fa-solid fa-check text-xs"></i>
                        <span>Terapkan Hasil Crop</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ULTRA-HIGH DEFINITION FULLSCREEN LIGHTBOX FOR ADMIN -->
    <div id="adminLightboxModal" class="fixed inset-0 z-[100] bg-black/95 hidden items-center justify-center p-4 backdrop-blur-md" onclick="if(event.target.id==='adminLightboxModal') closeAdminLightbox()">
        <div class="absolute top-4 inset-x-4 sm:inset-x-8 flex items-center justify-between text-white z-50 pointer-events-none">
            <div class="flex items-center gap-2 bg-black/70 px-3.5 py-1.5 rounded-sm border border-white/20 pointer-events-auto shadow-md">
                <span id="adminLightboxLabel" class="text-xs font-bold text-emerald-400 font-mono tracking-wider">SAMPUL DEPAN</span>
            </div>
            <button type="button" onclick="closeAdminLightbox()" class="w-9 h-9 rounded-sm bg-white/10 hover:bg-rose-600 text-white flex items-center justify-center text-sm transition pointer-events-auto shadow-md border border-white/20" title="Tutup (Esc)">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <button type="button" onclick="prevAdminLightbox()" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-white/10 hover:bg-emerald-600 text-white flex items-center justify-center text-lg transition z-50 shadow-lg border border-white/20" title="Foto Sebelumnya">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button type="button" onclick="nextAdminLightbox()" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-white/10 hover:bg-emerald-600 text-white flex items-center justify-center text-lg transition z-50 shadow-lg border border-white/20" title="Foto Selanjutnya">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="max-w-4xl max-h-[85vh] flex flex-col items-center justify-center select-none my-auto">
            <div class="relative rounded-sm overflow-hidden shadow-2xl border border-white/20 bg-slate-950 max-h-[72vh] aspect-[3/4.15]">
                <img id="adminLightboxImage" src="" alt="Zoomed Cover" class="w-full h-full object-contain" />
            </div>
            <div class="mt-3 text-center">
                <h4 id="adminLightboxTitle" class="text-white text-sm font-bold truncate max-w-xl font-heading">
                    Pratinjau Foto Naskah
                </h4>
            </div>
        </div>
    </div>

    <!-- JS Logic -->
    <script>
        let currentPhotoObj = { cover: null, back: null, inside1: null, inside2: null };
        let activeTab = 'cover';
        let cropper = null;
        let activeCropKey = null;

        const tabKeys = ['cover', 'back', 'inside1', 'inside2'];
        const tabLabels = { cover: 'Sampul Depan', back: 'Sampul Belakang', inside1: 'Halaman Isi 1', inside2: 'Halaman Isi 2' };

        
        // =======================================================
        // ADMIN INSTANT LIVE SEARCH & AUTOCOMPLETE LOGIC
        // =======================================================
        function handleAdminLiveSearch(query) {
            const trimmed = (query || '').trim().toLowerCase();
            const clearBtn = document.getElementById('adminClearSearchBtn');
            const dropdown = document.getElementById('adminAutocompleteDropdown');
            const list = document.getElementById('adminAutocompleteList');
            const rows = document.querySelectorAll('.book-table-row, .book-mobile-card');
            const countEl = document.getElementById('visibleRowCount');

            if (clearBtn) {
                if (trimmed.length > 0) clearBtn.classList.remove('hidden');
                else clearBtn.classList.add('hidden');
            }

            let visibleCount = 0;
            let matchingBooks = [];

            // 1. Instant Table Row Filter
            rows.forEach(row => {
                const title = row.getAttribute('data-title') || '';
                const author = row.getAttribute('data-author') || '';
                const isbn = row.getAttribute('data-isbn') || '';
                const category = row.getAttribute('data-category') || '';
                
                const matches = trimmed === '' || title.includes(trimmed) || author.includes(trimmed) || isbn.includes(trimmed) || category.toLowerCase().includes(trimmed);

                if (matches) {
                    row.style.display = '';
                    visibleCount++;
                    const bookJson = row.getAttribute('data-json');
                    if (bookJson && matchingBooks.length < 5) {
                        try {
                            matchingBooks.push(JSON.parse(bookJson));
                        } catch(e) {}
                    }
                } else {
                    row.style.display = 'none';
                }
            });

            if (countEl) countEl.innerText = visibleCount;

            // 2. Autocomplete Dropdown Preview
            if (trimmed.length > 0 && matchingBooks.length > 0) {
                list.innerHTML = '';
                matchingBooks.forEach(book => {
                    const item = document.createElement('div');
                    item.className = 'flex items-center gap-3 p-2 rounded-sm hover:bg-emerald-50 cursor-pointer transition text-left group';
                    
                    const coverUrl = book.cover_image ? ('/storage/' + book.cover_image) : null;
                    const highlightedTitle = highlightAdminKeyword(book.title, trimmed);

                    item.innerHTML = `
                        <div class="w-8 h-11 bg-slate-900 rounded-xs overflow-hidden shrink-0 border border-slate-200">
                            ${coverUrl ? '<img src="' + coverUrl + '" class="w-full h-full object-cover" />' : '<div class="w-full h-full bg-[#032c21] p-0.5 text-[6px] text-white font-bold">PERSIS</div>'}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-1 mb-0.5">
                                <span class="text-[9px] font-bold text-emerald-800 bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200 truncate">
                                    ${book.category}
                                </span>
                                <span class="text-[10.5px] font-mono font-bold text-emerald-700">
                                    ${book.price || ''}
                                </span>
                            </div>
                            <h5 class="text-xs font-bold text-slate-900 truncate group-hover:text-emerald-700 transition">
                                ${highlightedTitle}
                            </h5>
                            <span class="text-[10px] text-slate-400 truncate block mt-0.5">
                                ${book.author}
                            </span>
                        </div>
                    `;

                    item.onclick = function() {
                        openEditModal(book);
                        dropdown.classList.add('hidden');
                    };

                    list.appendChild(item);
                });
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }

        function highlightAdminKeyword(text, keyword) {
            if (!text || !keyword) return text || '';
            const regex = new RegExp('(' + keyword.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + ')', 'gi');
            return text.replace(regex, '<mark class="bg-amber-100 text-amber-900 font-bold px-0.5 rounded-xs">$1</mark>');
        }

        function clearAdminSearch() {
            const input = document.getElementById('adminSearchInput');
            input.value = '';
            handleAdminLiveSearch('');
            input.focus();
        }

        function handleAdminCategoryFilter(selectedCat) {
            const input = document.getElementById('adminSearchInput');
            const trimmed = (input.value || '').trim().toLowerCase();
            const rows = document.querySelectorAll('.book-table-row, .book-mobile-card');
            let visibleCount = 0;

            rows.forEach(row => {
                const title = row.getAttribute('data-title') || '';
                const author = row.getAttribute('data-author') || '';
                const category = row.getAttribute('data-category') || '';
                
                const matchesSearch = trimmed === '' || title.includes(trimmed) || author.includes(trimmed);
                const matchesCategory = !selectedCat || category === selectedCat;

                if (matchesSearch && matchesCategory) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const countEl = document.getElementById('visibleRowCount');
            if (countEl) countEl.innerText = visibleCount;
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const form = document.getElementById('adminSearchForm');
            const dropdown = document.getElementById('adminAutocompleteDropdown');
            if (form && !form.contains(e.target) && dropdown) {
                dropdown.classList.add('hidden');
            }
        });

        function openAdminLightbox() {
            const url = currentPhotoObj[activeTab];
            if (!url) return;
            const bookModal = document.getElementById('bookModal');
            if (bookModal) {
                bookModal.classList.add('hidden');
                bookModal.classList.remove('flex');
            }
            document.getElementById('adminLightboxImage').src = url;
            document.getElementById('adminLightboxLabel').innerText = tabLabels[activeTab].toUpperCase();
            document.getElementById('adminLightboxTitle').innerText = document.getElementById('in_title').value || 'Pratinjau Naskah';
            const modal = document.getElementById('adminLightboxModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAdminLightbox() {
            const modal = document.getElementById('adminLightboxModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            const bookModal = document.getElementById('bookModal');
            if (bookModal) {
                bookModal.classList.remove('hidden');
                bookModal.classList.add('flex');
            }
        }

        function prevAdminLightbox() {
            let idx = tabKeys.indexOf(activeTab);
            idx = (idx - 1 + tabKeys.length) % tabKeys.length;
            switchVisualizerTab(tabKeys[idx]);
            const url = currentPhotoObj[activeTab];
            if (!url) return;
            const img = document.getElementById('adminLightboxImage');
            img.classList.remove('lightbox-slide-next', 'lightbox-slide-prev');
            void img.offsetWidth;
            img.classList.add('lightbox-slide-prev');
            img.src = url;
            document.getElementById('adminLightboxLabel').innerText = tabLabels[activeTab].toUpperCase();
        }

        function nextAdminLightbox() {
            let idx = tabKeys.indexOf(activeTab);
            idx = (idx + 1) % tabKeys.length;
            switchVisualizerTab(tabKeys[idx]);
            const url = currentPhotoObj[activeTab];
            if (!url) return;
            const img = document.getElementById('adminLightboxImage');
            img.classList.remove('lightbox-slide-next', 'lightbox-slide-prev');
            void img.offsetWidth;
            img.classList.add('lightbox-slide-next');
            img.src = url;
            document.getElementById('adminLightboxLabel').innerText = tabLabels[activeTab].toUpperCase();
        }

        function openCreateModal() {
            const form = document.getElementById('bookForm');
            if (form) {
                form.action = "{{ route('admin.books.store') }}";
                form.reset();
            }
            const method = document.getElementById('formMethod');
            if (method) method.value = 'POST';
            
            const title = document.getElementById('modalHeaderTitle');
            if (title) title.innerText = 'Tambah Master Buku & Foto Naskah';

            const sizeIn = document.getElementById('in_size');
            if (sizeIn) sizeIn.value = '17,6 x 25 cm';

            currentPhotoObj = { cover: null, back: null, inside1: null, inside2: null };
            resetThumbnails();
            switchVisualizerTab('cover');
            updateVisualizerLive();

            const modal = document.getElementById('bookModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function resolvePhotoUrl(path) {
            if (!path) return null;
            if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('data:image/')) {
                return path;
            }
            let clean = path.replace(/^\/+/, '');
            if (clean.startsWith('storage/')) {
                return '/' + clean;
            }
            if (clean.startsWith('images/')) {
                return '/' + clean;
            }
            return '/storage/' + clean;
        }

        function openEditModal(book) {
            const form = document.getElementById('bookForm');
            if (form) form.action = "/admin/books/" + book.id;
            
            const method = document.getElementById('formMethod');
            if (method) method.value = 'PUT';

            const headerTitle = document.getElementById('modalHeaderTitle');
            if (headerTitle) headerTitle.innerText = 'Edit Data & Foto Buku: ' + (book.title || '');

            const setVal = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.value = val;
            };

            setVal('in_title', book.title || '');
            setVal('in_author', book.author || '');
            setVal('in_category', book.category || '');
            setVal('in_isbn', book.isbn || '');
            setVal('in_price', book.price || '');
            setVal('in_year', book.year || '2026');
            setVal('in_pages', book.pages || '');
            setVal('in_size', book.size || '17,6 x 25 cm');
            setVal('in_status', book.status || 'published');
            setVal('in_format', book.format || 'UNESCO B5 (Bookpaper)');
            setVal('in_synopsis', book.synopsis || '');

            const nr = document.getElementById('in_new_release');
            if (nr) nr.checked = Boolean(book.is_new_release);
            const bs = document.getElementById('in_best_seller');
            if (bs) bs.checked = Boolean(book.is_best_seller);

            currentPhotoObj = {
                cover: resolvePhotoUrl(book.cover_image),
                back: resolvePhotoUrl(book.back_cover_image),
                inside1: resolvePhotoUrl(book.inside_preview_image),
                inside2: resolvePhotoUrl(book.additional_image),
            };

            setThumbPreview('cover', currentPhotoObj.cover);
            setThumbPreview('back', currentPhotoObj.back);
            setThumbPreview('inside1', currentPhotoObj.inside1);
            setThumbPreview('inside2', currentPhotoObj.inside2);

            switchVisualizerTab('cover');
            updateVisualizerLive();

            const modal = document.getElementById('bookModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeBookModal() {
            const modal = document.getElementById('bookModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function switchVisualizerTab(tab) {
            activeTab = tab;
            ['cover', 'back', 'inside1', 'inside2'].forEach(t => {
                const btn = document.getElementById('tab_' + t);
                if (btn) {
                    btn.className = t === tab 
                        ? 'px-3 py-1 rounded-sm text-xs font-bold bg-[#006830] text-white transition shadow-2xs'
                        : 'px-3 py-1 rounded-sm text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition';
                }
            });

            const imgEl = document.getElementById('visImg');
            const frontVec = document.getElementById('visFrontVec');
            const insideVec = document.getElementById('visInsideVec');

            imgEl.classList.add('hidden');
            frontVec.classList.add('hidden');
            insideVec.classList.add('hidden');

            const url = currentPhotoObj[tab];
            if (url) {
                imgEl.src = url;
                imgEl.classList.remove('hidden');
            } else {
                if (tab === 'cover' || tab === 'back') {
                    frontVec.classList.remove('hidden');
                } else {
                    insideVec.classList.remove('hidden');
                }
            }
        }

        function updateVisualizerLive() {
            const title = document.getElementById('in_title').value || 'Judul Buku';
            const author = document.getElementById('in_author').value || 'Nama Penulis';
            const category = document.getElementById('in_category').value || 'Buku Ajar';
            const price = document.getElementById('in_price').value || 'Rp 75.000';

            document.getElementById('visFrontTitle').innerText = title;
            document.getElementById('visFrontAuthor').innerText = author;
            document.getElementById('visFrontCat').innerText = category;
            document.getElementById('visPrice').innerText = price;
        }

        function formatRupiahInput(input) {
            let val = input.value.replace(/[^0-9]/g, '');
            if (val) {
                input.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
            }
            updateVisualizerLive();
        }

        function setThumbPreview(key, url) {
            const box = document.getElementById('thumb_box_' + key);
            const badge = document.getElementById('badge_' + key);
            if (url) {
                box.innerHTML = '<img src="' + url + '" class="w-full h-full object-cover" />';
                badge.innerText = 'Terunggah';
                badge.className = 'text-[9px] px-1.5 py-0.5 rounded font-bold bg-emerald-100 text-emerald-800';
            } else {
                box.innerHTML = '<i class="fa-solid fa-cloud-arrow-up text-xl"></i>';
                badge.innerText = 'Pilih';
                badge.className = 'text-[9px] px-1.5 py-0.5 rounded font-bold bg-slate-200 text-slate-600';
            }
        }

        function resetThumbnails() {
            ['cover', 'back', 'inside1', 'inside2'].forEach(k => setThumbPreview(k, null));
        }

        // Handle Image Selection with INSTANT PREVIEW (100% Reliable)
        function handleImageSelection(input, key) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const dataUrl = e.target.result;
                    
                    // 1. Instantly set preview on thumbnail box and 3D visualizer
                    currentPhotoObj[key] = dataUrl;
                    setThumbPreview(key, dataUrl);
                    switchVisualizerTab(key);
                    updateVisualizerLive();

                    // 2. Open cropper safely
                    activeCropKey = key;
                    try {
                        openCropper(dataUrl);
                    } catch (err) {
                        console.warn('Cropper skipped:', err);
                    }
                }
                reader.readAsDataURL(file);
            }
        }

        function openCropper(imageSrc) {
            const modal = document.getElementById('cropperModal');
            const img = document.getElementById('cropperImage');
            if (!modal || !img) return;

            img.src = imageSrc;
            modal.style.display = 'flex';
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (cropper) {
                try { cropper.destroy(); } catch(e) {}
                cropper = null;
            }

            if (typeof Cropper !== 'undefined') {
                setTimeout(() => {
                    cropper = new Cropper(img, {
                        aspectRatio: (activeCropKey === 'cover' || activeCropKey === 'back') ? (3 / 4.15) : (1 / 1.4),
                        viewMode: 1,
                        autoCropArea: 1,
                        responsive: true,
                        restore: false,
                    });
                }, 50);
            }
        }

        function setCropRatio(ratio) {
            if (cropper) cropper.setAspectRatio(ratio);
        }

        // Quick Preset for Landscape Full Spread Covers (Back + Spine + Front in One Image)
        function cropPresetSpread(side) {
            if (!cropper) return;
            cropper.setAspectRatio(3 / 4.15);
            try {
                const canvasData = cropper.getCanvasData();
                const cropBoxWidth = canvasData.width * 0.46;
                const cropBoxHeight = cropBoxWidth * (4.15 / 3);

                if (side === 'right') {
                    // Crop Right Side for Front Cover
                    cropper.setCropBoxData({
                        left: canvasData.left + (canvasData.width - cropBoxWidth),
                        top: canvasData.top,
                        width: cropBoxWidth,
                        height: Math.min(cropBoxHeight, canvasData.height)
                    });
                } else if (side === 'left') {
                    // Crop Left Side for Back Cover
                    cropper.setCropBoxData({
                        left: canvasData.left,
                        top: canvasData.top,
                        width: cropBoxWidth,
                        height: Math.min(cropBoxHeight, canvasData.height)
                    });
                }
            } catch(e) {
                console.warn('Preset spread crop error:', e);
            }
        }

        function closeCropperModal() {
            const modal = document.getElementById('cropperModal');
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
            if (cropper) {
                try { cropper.destroy(); } catch(e) {}
                cropper = null;
            }
        }

        function applyCrop() {
            if (!cropper || !activeCropKey) {
                closeCropperModal();
                return;
            }
            try {
                const canvas = cropper.getCroppedCanvas({ width: 800, height: 1100 });
                if (!canvas) {
                    closeCropperModal();
                    return;
                }

                canvas.toBlob(blob => {
                    if (blob) {
                        const file = new File([blob], 'cropped_' + activeCropKey + '.jpg', { type: 'image/jpeg' });
                        try {
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);

                            const inputId = activeCropKey === 'cover' ? 'in_cover_image'
                                          : activeCropKey === 'back' ? 'in_back_cover'
                                          : activeCropKey === 'inside1' ? 'in_inside1'
                                          : 'in_inside2';
                            const inputEl = document.getElementById(inputId);
                            if (inputEl) {
                                inputEl.files = dataTransfer.files;
                            }
                        } catch(err) {
                            console.warn('DataTransfer error:', err);
                        }

                        const url = URL.createObjectURL(blob);
                        currentPhotoObj[activeCropKey] = url;
                        setThumbPreview(activeCropKey, url);
                        switchVisualizerTab(activeCropKey);
                        updateVisualizerLive();
                    }
                    closeCropperModal();
                }, 'image/jpeg', 0.92);
            } catch(e) {
                console.error('Apply crop error:', e);
                closeCropperModal();
            }
        }
    
        // =======================================================
        // CATEGORY DROPDOWN LOGIC (BULLETPROOF)
        // =======================================================
        function toggleAdminCatDropdown(e) {
            if (e) e.stopPropagation();
            const menu = document.getElementById('adminCustomCatMenu');
            const chev = document.getElementById('adminCustomCatChevron');
            if (menu) menu.classList.toggle('hidden');
            if (chev) chev.classList.toggle('rotate-180');
        }

        function selectAdminCatOption(val, label, e) {
            if (e) e.stopPropagation();
            const input = document.getElementById('adminCustomCatInput');
            const labelEl = document.getElementById('adminCustomCatLabel');
            if (input) input.value = val;
            if (labelEl) labelEl.innerText = label;

            document.querySelectorAll('.cat-check-icon').forEach(icon => {
                if (icon.getAttribute('data-cat') === val) {
                    icon.classList.remove('hidden');
                } else {
                    icon.classList.add('hidden');
                }
            });

            toggleAdminCatDropdown();
            handleAdminCategoryFilter(val);
        }

        document.addEventListener('click', function(e) {
            const container = document.getElementById('adminCustomCatContainer');
            const menu = document.getElementById('adminCustomCatMenu');
            const chev = document.getElementById('adminCustomCatChevron');
            if (container && !container.contains(e.target) && menu && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
                if (chev) chev.classList.remove('rotate-180');
            }
        });

    
        // Auto Open Modal if Navigated with open_create or open_edit Query Parameters
        document.addEventListener('DOMContentLoaded', function() {
            @if(request('open_create'))
                setTimeout(function() {
                    openCreateModal();
                }, 100);
            @endif

            @if(request('open_edit'))
                @php
                    $directEditBook = \App\Models\Book::find(request('open_edit'));
                @endphp
                @if($directEditBook)
                    setTimeout(function() {
                        openEditModal(@json($directEditBook));
                    }, 100);
                @endif
            @endif
        });
    </script>


    <!-- FLOATING BULK DELETE ACTION BAR -->
    <div id="bulkActionBar" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 bg-[#032c21] text-white px-5 py-3 rounded-full shadow-2xl border border-emerald-700/60 flex items-center justify-between gap-4 sm:gap-6 transition-all duration-300 transform translate-y-28 opacity-0 pointer-events-none select-none max-w-[92vw]">
        <div class="flex items-center gap-2.5 text-xs font-bold font-heading">
            <span id="selectedCountBadge" class="min-w-[24px] h-6 px-1.5 rounded-full bg-lime-400 text-brand-950 flex items-center justify-center font-mono font-black text-xs shadow-xs">
                0
            </span>
            <span class="text-emerald-100 hidden sm:inline">Buku Dipilih</span>
        </div>
        <div class="flex items-center gap-2">
            <button type="button" onclick="cancelBulkSelection()" class="px-3 py-1.5 rounded-full bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white text-xs font-semibold transition cursor-pointer border border-white/20">
                Batal
            </button>
            <form id="bulkDeleteForm" method="POST" action="{{ route('admin.books.bulk_destroy') }}" onsubmit="return confirmBulkDelete(event)">
                @csrf
                <input type="hidden" name="ids_json" id="bulkDeleteIdsInput" value="[]">
                <button type="submit" class="px-4 py-1.5 rounded-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-md cursor-pointer hover:scale-105">
                    <i class="fa-solid fa-trash-can text-xs"></i>
                    <span>Hapus Terpilih</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleSelectAllBooks(masterChk) {
            const rowCheckboxes = document.querySelectorAll('.book-row-chk');
            rowCheckboxes.forEach(chk => {
                chk.checked = masterChk.checked;
            });
            updateBulkBarState();
        }

        function updateBulkBarState() {
            const checkedBoxes = document.querySelectorAll('.book-row-chk:checked');
            const totalBoxes = document.querySelectorAll('.book-row-chk');
            const count = checkedBoxes.length;
            
            const bulkBar = document.getElementById('bulkActionBar');
            const countBadge = document.getElementById('selectedCountBadge');
            const idsInput = document.getElementById('bulkDeleteIdsInput');
            const masterChk = document.getElementById('selectAllBooks');

            if (masterChk) {
                masterChk.checked = totalBoxes.length > 0 && count === totalBoxes.length;
                masterChk.indeterminate = count > 0 && count < totalBoxes.length;
            }

            if (count > 0) {
                const selectedIds = Array.from(checkedBoxes).map(c => c.value);
                if (idsInput) idsInput.value = JSON.stringify(selectedIds);
                if (countBadge) countBadge.innerText = count;

                if (bulkBar) {
                    bulkBar.classList.remove('translate-y-28', 'opacity-0', 'pointer-events-none');
                    bulkBar.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
                }
            } else {
                if (idsInput) idsInput.value = '[]';
                if (bulkBar) {
                    bulkBar.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
                    bulkBar.classList.add('translate-y-28', 'opacity-0', 'pointer-events-none');
                }
            }
        }

        function cancelBulkSelection() {
            const rowCheckboxes = document.querySelectorAll('.book-row-chk');
            rowCheckboxes.forEach(chk => chk.checked = false);
            const masterChk = document.getElementById('selectAllBooks');
            if (masterChk) {
                masterChk.checked = false;
                masterChk.indeterminate = false;
            }
            updateBulkBarState();
        }

        function confirmBulkDelete(e) {
            const checkedBoxes = document.querySelectorAll('.book-row-chk:checked');
            const count = checkedBoxes.length;
            if (count === 0) {
                alert('Silakan pilih setidaknya satu buku untuk dihapus.');
                e.preventDefault();
                return false;
            }

            const isConfirmed = confirm('Apakah Anda yakin ingin menghapus ' + count + ' buku yang dipilih sekaligus?\n\nSemua data beserta foto buku yang dipilih akan dihapus secara permanen.');
            if (!isConfirmed) {
                e.preventDefault();
                return false;
            }
            return true;
        }
    </script>

@endsection
