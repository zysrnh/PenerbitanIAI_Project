@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah — PERSIS PERS')

@section('content')
    <style>
        /* 3D Perspective Hover Tilt on Public Catalog */
        .book-stage-public {
            perspective: 1000px;
        }
        .book-hover-public {
            transform-style: preserve-3d;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            box-shadow: 8px 12px 20px -4px rgba(0, 0, 0, 0.25);
        }
        .book-card-item:hover .book-hover-public {
            transform: rotateY(-14deg) rotateX(4deg) translateY(-4px) scale(1.02);
            box-shadow: 14px 18px 28px -4px rgba(0, 0, 0, 0.35);
        }
        .book-modal-hover:hover {
            transform: rotateY(-12deg) rotateX(4deg) translateY(-2px);
            box-shadow: 16px 20px 30px -4px rgba(0, 0, 0, 0.4);
        }
        .spine-strip-public {
            box-shadow: inset -3px 0 6px rgba(0, 0, 0, 0.18);
        }
        .bookpaper-public {
            background-color: #fdfbf7;
        }
    </style>

    <!-- 1. HERO BANNER & 4 STATS CARDS -->
    <section class="relative pt-32 pb-16 bg-[#032c21] text-white overflow-hidden border-b-4 border-[#006830]">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#22c55e_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider bg-[#064e3b] text-emerald-300 border border-emerald-500/30 mb-4 shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>{{ $settings['catalog_banner_badge'] ?? 'PUBLIKASI RESMI KAMPUS' }}</span>
            </div>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-black font-heading tracking-tight mb-4 text-white">
                {{ $settings['catalog_banner_title'] ?? 'Katalog Buku & Karya Ilmiah' }}
            </h1>

            <p class="text-slate-300 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8">
                {{ $settings['catalog_banner_desc'] ?? 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.' }}
            </p>

            <!-- Search Bar in Hero -->
            <div class="max-w-3xl mx-auto mb-10">
                <form action="{{ route('katalog') }}" method="GET" class="bg-white p-2 rounded-2xl shadow-xl border border-slate-200/80 flex flex-col sm:flex-row items-center gap-2 text-slate-800">
                    <div class="relative flex-1 w-full">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ request('q') }}" 
                            placeholder="Cari judul buku, penulis, atau nomor ISBN..." 
                            class="w-full pl-11 pr-4 py-2.5 text-xs sm:text-sm bg-transparent border-0 focus:ring-0 focus:outline-hidden font-medium"
                        />
                    </div>

                    <div class="w-full sm:w-48 border-t sm:border-t-0 sm:border-l border-slate-200">
                        <select name="kategori" onchange="this.form.submit()" class="w-full px-4 py-2.5 text-xs sm:text-sm bg-transparent border-0 focus:ring-0 focus:outline-hidden font-medium text-slate-700 cursor-pointer">
                            <option value="Semua">Semua Kategori</option>
                            @foreach($categoryList as $cat)
                                <option value="{{ $cat }}" {{ request('kategori') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-[#006830] hover:bg-[#005226] text-white rounded-xl text-xs sm:text-sm font-bold transition shadow-md flex items-center justify-center gap-2 shrink-0">
                        <span>Cari</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                </form>
            </div>

            <!-- 4 Stats Cards Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4 max-w-5xl mx-auto">
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/15 text-left flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-400/20 text-emerald-300 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-slate-300 block font-medium">Total Koleksi</span>
                        <span class="text-base font-black text-white leading-tight block mt-0.5">{{ $settings['catalog_stat_books'] ?? '150+ Judul Buku' }}</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/15 text-left flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-400/20 text-blue-300 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-slate-300 block font-medium">Penulis / Dosen</span>
                        <span class="text-base font-black text-white leading-tight block mt-0.5">{{ $settings['catalog_stat_authors'] ?? 'Karya Dosen & Peneliti' }}</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/15 text-left flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-barcode"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-slate-300 block font-medium">Legalitas Resmi</span>
                        <span class="text-base font-black text-white leading-tight block mt-0.5">{{ $settings['catalog_stat_isbn'] ?? 'ISBN Perpusnas' }}</span>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/15 text-left flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-400/20 text-purple-300 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-slate-300 block font-medium">Standar Cetak</span>
                        <span class="text-base font-black text-white leading-tight block mt-0.5">{{ $settings['catalog_stat_print'] ?? 'Cetak Berkualitas' }}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. PROMO & AGENDA BANNER SECTION -->
    <section class="py-8 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <!-- Promo Box -->
                <div class="p-5 rounded-2xl bg-amber-50/80 border border-amber-200/80 flex items-start gap-4 shadow-2xs">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg shrink-0 mt-0.5">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-800 bg-amber-200/60 px-2 py-0.5 rounded">PROGRAM PROMO</span>
                        <h4 class="font-bold text-slate-900 text-sm mt-1 leading-snug">{{ $settings['catalog_promo_title'] ?? 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis' }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $settings['catalog_promo_desc'] ?? 'Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.' }}</p>
                    </div>
                </div>

                <!-- Agenda Box -->
                <div class="p-5 rounded-2xl bg-blue-50/80 border border-blue-200/80 flex items-start gap-4 shadow-2xs">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-lg shrink-0 mt-0.5">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-800 bg-blue-200/60 px-2 py-0.5 rounded">AGENDA AKADEMIK</span>
                        <h4 class="font-bold text-slate-900 text-sm mt-1 leading-snug">{{ $settings['catalog_agenda_title'] ?? 'Bedah Buku & Call for Book Chapters Dosen' }}</h4>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">{{ $settings['catalog_agenda_desc'] ?? 'Terbuka untuk civitas akademika dan peneliti eksternal.' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. HIGHLIGHT: TERBITAN BARU (2026) -->
    @if(isset($newBooks) && $newBooks->count() > 0)
    <section class="py-12 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-700">Koleksi Terkini</span>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 mt-0.5">Terbitan Baru Tahun 2026</h3>
                </div>
                <a href="{{ route('katalog', ['kategori' => 'Buku Baru']) }}" class="text-xs font-bold text-[#006830] hover:text-[#005226] flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($newBooks as $book)
                    <div class="book-card-item bg-white rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-xl transition-all duration-300 p-3 sm:p-4 flex flex-col justify-between group">
                        <div>
                            <div class="book-stage-public aspect-[3/4.1] rounded-xl overflow-hidden bg-slate-100 relative mb-3 flex items-center justify-center cursor-pointer" onclick="openBookModal({{ json_encode($book) }})">
                                @if($book->cover_image && file_exists(public_path('storage/' . $book->cover_image)))
                                    <div class="book-hover-public w-full h-full relative rounded-xs overflow-hidden border border-slate-200">
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" loading="lazy" />
                                        <div class="absolute inset-0 pointer-events-none spine-strip-public"></div>
                                    </div>
                                @else
                                    <div class="book-hover-public w-full h-full bg-[#032c21] text-white p-3 flex flex-col justify-between rounded-xs border-l-4 border-emerald-400">
                                        <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                            <span class="text-[7.5px] font-extrabold uppercase px-1.5 py-0.5 rounded bg-[#064e3b] text-emerald-300 truncate">{{ $book->category }}</span>
                                            <span class="text-[7.5px] text-slate-300 font-mono">PERSIS</span>
                                        </div>
                                        <div class="text-center my-auto py-1">
                                            <div class="w-4 h-0.5 bg-amber-400 mx-auto mb-1"></div>
                                            <h5 class="font-black text-[11px] text-white leading-tight font-heading line-clamp-3">{{ $book->title }}</h5>
                                            <div class="w-4 h-0.5 bg-amber-400 mx-auto mt-1"></div>
                                        </div>
                                        <div class="pt-1 border-t border-white/20 text-center">
                                            <span class="text-[8.5px] text-slate-200 block font-medium truncate">{{ $book->author }}</span>
                                        </div>
                                    </div>
                                @endif
                                <span class="absolute top-2 left-2 px-2 py-0.5 rounded text-[9px] font-extrabold bg-blue-600 text-white shadow-xs">
                                    Baru 2026
                                </span>
                            </div>

                            <span class="text-[10px] font-bold text-[#006830] bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200 inline-block mb-1">
                                {{ $book->category }}
                            </span>
                            <h4 class="font-bold text-slate-900 text-xs sm:text-sm leading-snug line-clamp-2 mb-1 group-hover:text-[#006830] transition cursor-pointer" onclick="openBookModal({{ json_encode($book) }})">
                                {{ $book->title }}
                            </h4>
                            <p class="text-[11px] text-slate-500 line-clamp-1 mb-2">
                                Oleh: <span class="text-slate-700 font-medium">{{ $book->author }}</span>
                            </p>
                        </div>

                        <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between gap-2 mt-auto">
                            <div>
                                <span class="text-[9px] text-slate-400 block leading-tight">Harga Cetak</span>
                                <span class="text-xs sm:text-sm font-black text-[#006830] font-mono">{{ $book->price }}</span>
                            </div>
                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="px-3 py-1.5 bg-slate-100 hover:bg-[#006830] text-slate-700 hover:text-white rounded-lg text-xs font-bold transition">
                                Detail
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 4. MAIN ALL BOOKS CATALOG WITH CATEGORY FILTER -->
    <section class="py-12 bg-white min-h-[600px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900">Jelajahi Seluruh Koleksi Buku</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Filter berdasarkan kategori atau gunakan kata kunci pencarian.</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('katalog') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ !request('kategori') || request('kategori') === 'Semua' ? 'bg-[#006830] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Semua Buku
                    </a>
                    @foreach($categoryList as $cat)
                        <a href="{{ route('katalog', ['kategori' => $cat, 'q' => request('q')]) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-bold transition {{ request('kategori') === $cat ? 'bg-[#006830] text-white shadow-xs' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @forelse($books as $book)
                    <div class="book-card-item bg-white rounded-2xl border border-slate-200/90 shadow-xs hover:shadow-xl transition-all duration-300 p-3 sm:p-4 flex flex-col justify-between group">
                        
                        <div>
                            <!-- Cover Container with 3D Hover Tilt -->
                            <div class="book-stage-public aspect-[3/4.1] rounded-xl overflow-hidden bg-slate-100 relative mb-3.5 flex items-center justify-center cursor-pointer" onclick="openBookModal({{ json_encode($book) }})">
                                
                                @if($book->cover_image && file_exists(public_path('storage/' . $book->cover_image)))
                                    <div class="book-hover-public w-full h-full relative rounded-xs overflow-hidden border border-slate-200">
                                        <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" loading="lazy" />
                                        <div class="absolute inset-0 pointer-events-none spine-strip-public"></div>
                                    </div>
                                @else
                                    <div class="book-hover-public w-full h-full bg-[#032c21] text-white p-3 flex flex-col justify-between rounded-xs border-l-4 border-emerald-400">
                                        <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                            <span class="text-[7.5px] font-extrabold uppercase px-1.5 py-0.5 rounded bg-[#064e3b] text-emerald-300 truncate">{{ $book->category }}</span>
                                            <span class="text-[7.5px] text-slate-300 font-mono">PERSIS</span>
                                        </div>
                                        <div class="text-center my-auto py-1">
                                            <div class="w-4 h-0.5 bg-amber-400 mx-auto mb-1"></div>
                                            <h5 class="font-black text-[11px] text-white leading-tight font-heading line-clamp-3">{{ $book->title }}</h5>
                                            <div class="w-4 h-0.5 bg-amber-400 mx-auto mt-1"></div>
                                        </div>
                                        <div class="pt-1 border-t border-white/20 text-center">
                                            <span class="text-[8.5px] text-slate-200 block font-medium truncate">{{ $book->author }}</span>
                                        </div>
                                    </div>
                                @endif

                                <span class="absolute bottom-2 right-2 px-2 py-0.5 rounded-md text-[9px] font-bold bg-black/70 text-white opacity-0 group-hover:opacity-100 transition shadow-xs">
                                    <i class="fa-solid fa-eye mr-1"></i> Detail
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-1 mb-1.5">
                                <span class="text-[10px] font-bold text-[#006830] bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200 truncate">
                                    {{ $book->category }}
                                </span>
                                @if($book->is_new_release)
                                    <span class="text-[9px] font-extrabold text-blue-700 bg-blue-50 px-1.5 py-0.5 rounded border border-blue-200 shrink-0">
                                        Baru
                                    </span>
                                @elseif($book->is_best_seller)
                                    <span class="text-[9px] font-extrabold text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200 shrink-0">
                                        Best Seller
                                    </span>
                                @endif
                            </div>

                            <h3 class="font-bold text-slate-900 text-xs sm:text-sm leading-snug line-clamp-2 mb-1 group-hover:text-[#006830] transition cursor-pointer" onclick="openBookModal({{ json_encode($book) }})">
                                {{ $book->title }}
                            </h3>
                            <p class="text-[11px] text-slate-500 line-clamp-1 mb-2">
                                Oleh: <span class="text-slate-700 font-medium">{{ $book->author }}</span>
                            </p>
                        </div>

                        <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between gap-2 mt-auto">
                            <div>
                                <span class="text-[9px] text-slate-400 block leading-tight">Harga Cetak</span>
                                <span class="text-xs sm:text-sm font-black text-[#006830] font-mono">{{ $book->price }}</span>
                            </div>
                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="px-3 py-1.5 bg-slate-100 hover:bg-[#006830] text-slate-700 hover:text-white rounded-lg text-xs font-bold transition flex items-center gap-1.5">
                                <span>Lihat</span>
                                <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-slate-50 rounded-2xl border border-slate-200">
                        <i class="fa-solid fa-book-open text-4xl text-slate-300 mb-3 block"></i>
                        <h3 class="text-base font-bold text-slate-800 mb-1">Buku Tidak Ditemukan</h3>
                        <p class="text-xs text-slate-500 mb-4">Tidak ada koleksi buku yang cocok dengan pencarian Anda.</p>
                        <a href="{{ route('katalog') }}" class="px-4 py-2 bg-[#006830] text-white rounded-xl text-xs font-bold hover:bg-[#005226] transition">Reset Pencarian</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
                <div class="mt-10 flex items-center justify-center">
                    {{ $books->links() }}
                </div>
            @endif

        </div>
    </section>

    <!-- 5. CTA PUBLISH YOUR BOOK BOX -->
    <section class="py-12 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#032c21] rounded-3xl p-6 sm:p-8 text-white border-2 border-emerald-500/30 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl relative overflow-hidden">
                <div class="relative z-10 text-center sm:text-left">
                    <span class="text-xs font-extrabold uppercase tracking-wider text-emerald-400 bg-[#064e3b] px-3 py-1 rounded-full border border-emerald-500/30 inline-block mb-2">
                        LAYANAN PENERBITAN KAMPUS
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-white mb-2">
                        {{ $settings['catalog_publish_box_title'] ?? 'Punya Naskah Buku Sendiri?' }}
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                        {{ $settings['catalog_publish_box_desc'] ?? 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.' }}
                    </p>
                </div>

                <a href="{{ route('kontak') }}" class="relative z-10 px-6 py-3 bg-emerald-500 hover:bg-emerald-400 text-[#032c21] font-black rounded-xl text-xs sm:text-sm transition shadow-lg shrink-0 flex items-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Konsultasi Terbit</span>
                </a>
            </div>
        </div>
    </section>

    <!-- MODAL DETAIL BUKU PUBLIK (4-PHOTO SWITCHER + 3D PREVIEW + ORDER WHATSAPP) -->
    <div id="publicBookModal" class="fixed inset-0 z-50 bg-black/70 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto backdrop-blur-xs">
        <div class="bg-white rounded-2xl max-w-4xl w-full shadow-2xl border border-slate-200 overflow-hidden relative my-auto max-h-[92vh] flex flex-col animate-fade-in-up">
            
            <!-- Modal Header -->
            <div class="bg-[#032c21] text-white px-5 py-3.5 flex items-center justify-between border-b border-[#064e3b] shrink-0">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-emerald-300">Detail Koleksi &amp; Pemesanan Naskah</span>
                </div>
                <button type="button" onclick="closeBookModal()" class="w-7 h-7 rounded-lg bg-[#064e3b] hover:bg-[#08634c] text-slate-200 hover:text-white flex items-center justify-center text-xs font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body (2-Column Grid: Left Multi-Photo Showcase, Right Specs & Order) -->
            <div class="p-5 sm:p-6 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    
                    <!-- Left: Multi-Photo Showcase (Depan, Belakang, Isi 1, Isi 2) -->
                    <div class="md:col-span-5 flex flex-col items-center bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-3.5">
                        
                        <!-- Main Viewport -->
                        <div class="book-stage-public w-44 sm:w-48 aspect-[3/4.1] flex items-center justify-center">
                            <div id="modalBook3dWrapper" class="book-modal-hover book-hover-public relative w-full h-full rounded-xs overflow-hidden shadow-xl border border-slate-200 bg-[#032c21] select-none cursor-pointer">
                                
                                <!-- Real Image Container -->
                                <img id="modalMainImage" src="" alt="Book Cover" class="w-full h-full object-cover hidden" />

                                <!-- Spine Crease -->
                                <div id="modalSpineCrease" class="absolute inset-0 pointer-events-none spine-strip-public"></div>

                                <!-- Vector Fallback Front -->
                                <div id="modalVectorFront" class="w-full h-full bg-[#032c21] text-white p-3 flex flex-col justify-between border-l-4 border-emerald-400">
                                    <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                        <span id="modalVectorCat" class="text-[7.5px] font-extrabold uppercase px-1.5 py-0.5 rounded bg-[#064e3b] text-emerald-300">Buku Ajar</span>
                                        <span class="text-[7.5px] text-slate-300 font-mono">PERSIS</span>
                                    </div>
                                    <div class="text-center my-auto py-1">
                                        <div class="w-4 h-0.5 bg-amber-400 mx-auto mb-1"></div>
                                        <h5 id="modalVectorTitle" class="font-black text-[11px] text-white leading-tight font-heading line-clamp-3">Judul Buku</h5>
                                        <div class="w-4 h-0.5 bg-amber-400 mx-auto mt-1"></div>
                                    </div>
                                    <div class="pt-1 border-t border-white/20 text-center">
                                        <span id="modalVectorAuthor" class="text-[8.5px] text-slate-200 block font-medium truncate">Nama Penulis</span>
                                    </div>
                                </div>

                                <!-- Vector Fallback Inside -->
                                <div id="modalVectorInside" class="w-full h-full bookpaper-public text-slate-800 p-3 flex flex-col justify-between hidden border-l-2 border-slate-300">
                                    <div class="border-b border-slate-300 pb-1 flex justify-between items-center text-[7px] font-bold text-slate-500">
                                        <span id="modalInsideLabel">BAGIAN ISI NASKAH</span>
                                        <span>hlm. 1</span>
                                    </div>
                                    <div class="text-[7px] text-slate-600 leading-relaxed my-auto space-y-1 font-serif">
                                        <p class="font-bold text-slate-800 text-[8px]" id="modalInsideTitle">Pratinjau Isi Halaman</p>
                                        <p>Kajian akademik dan riset ilmiah kurikulum perguruan tinggi...</p>
                                        <div class="w-full h-0.5 bg-slate-200 my-0.5"></div>
                                        <p>Standar UNESCO B5 Bookpaper.</p>
                                    </div>
                                    <div class="pt-1 border-t border-slate-200 text-center text-[6.5px] text-slate-400 font-mono">
                                        <span>PERSIS PERS</span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- 4 Multi-Photo Switcher Buttons -->
                        <div id="modalPhotoSwitcherContainer" class="w-full flex flex-wrap items-center justify-center gap-1.5 pt-1">
                            <!-- Injected dynamically via JS -->
                        </div>

                    </div>

                    <!-- Right: Specs, Synopsis, Order Button -->
                    <div class="md:col-span-7 space-y-4">
                        
                        <div>
                            <div class="flex items-center gap-2 mb-1.5">
                                <span id="modalCategory" class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-[#006830] border border-emerald-200">
                                    Kategori
                                </span>
                                <span id="modalBadgeStatus" class="hidden px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    Baru 2026
                                </span>
                            </div>

                            <h2 id="modalTitle" class="text-base sm:text-lg md:text-xl font-extrabold text-slate-900 leading-snug">
                                Judul Lengkap Buku
                            </h2>
                            <p class="text-xs text-slate-500 mt-1">
                                Penulis: <strong id="modalAuthor" class="text-slate-800 font-bold">Nama Penulis</strong>
                            </p>
                        </div>

                        <!-- Specs Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs">
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
                                <span id="modalPrice" class="font-mono font-black text-[#006830] text-sm block mt-0.5">Rp 75.000</span>
                            </div>
                        </div>

                        <!-- Synopsis -->
                        <div>
                            <span class="text-xs font-bold text-slate-800 block mb-1">Sinopsis Buku</span>
                            <div id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed max-h-36 overflow-y-auto pr-1 space-y-1">
                                Sinopsis buku akan dimuat di sini...
                            </div>
                        </div>

                        <!-- Order via WhatsApp / Download Sample PDF Actions -->
                        <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-2.5">
                            <a id="modalWaOrderBtn" href="#" target="_blank" class="w-full sm:flex-1 py-2.5 px-4 rounded-xl bg-[#006830] hover:bg-[#005226] text-white text-xs sm:text-sm font-bold transition shadow-md flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Pesan Buku via WhatsApp</span>
                            </a>
                            <a id="modalSamplePdfBtn" href="#" target="_blank" class="hidden w-full sm:w-auto py-2.5 px-4 rounded-xl bg-red-50 hover:bg-red-100 text-red-700 text-xs sm:text-sm font-bold transition border border-red-200 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-file-pdf"></i>
                                <span>Sampel PDF</span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Public Catalog JS -->
    <script>
        let currentModalBook = null;
        let currentModalPhotos = [];

        function openBookModal(book) {
            currentModalBook = book;
            currentModalPhotos = [];

            // Populate Text Fields
            document.getElementById('modalTitle').innerText = book.title;
            document.getElementById('modalAuthor').innerText = book.author;
            document.getElementById('modalCategory').innerText = book.category;
            document.getElementById('modalIsbn').innerText = book.isbn || 'Dalam Proses';
            document.getElementById('modalFormat').innerText = book.format || 'UNESCO B5';
            document.getElementById('modalPages').innerText = book.pages || '-';
            document.getElementById('modalYear').innerText = book.year || '2026';
            document.getElementById('modalPrice').innerText = book.price || 'Hubungi Admin';
            document.getElementById('modalSynopsis').innerText = book.synopsis || 'Belum ada sinopsis untuk buku ini.';

            // Vector Fallbacks
            document.getElementById('modalVectorTitle').innerText = book.title;
            document.getElementById('modalVectorAuthor').innerText = book.author;
            document.getElementById('modalVectorCat').innerText = book.category;

            // Badges
            const badge = document.getElementById('modalBadgeStatus');
            if (book.is_new_release) {
                badge.innerText = 'Baru 2026';
                badge.className = 'px-2 py-0.5 rounded-md text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200';
                badge.classList.remove('hidden');
            } else if (book.is_best_seller) {
                badge.innerText = 'Best Seller';
                badge.className = 'px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200';
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }

            // WhatsApp Order Link
            const waNumber = '6281220000000';
            const waText = encodeURIComponent('Halo PERSIS PERS, saya ingin memesan buku "' + book.title + '" (ISBN: ' + (book.isbn || '-') + ') dengan harga ' + book.price + '.');
            document.getElementById('modalWaOrderBtn').href = 'https://wa.me/' + waNumber + '?text=' + waText;

            // Sample PDF Button
            const pdfBtn = document.getElementById('modalSamplePdfBtn');
            if (book.sample_pdf) {
                pdfBtn.href = '/storage/' + book.sample_pdf;
                pdfBtn.classList.remove('hidden');
            } else {
                pdfBtn.classList.add('hidden');
            }

            // Assemble 4 Photo Slots: Depan, Belakang, Isi 1, Isi 2
            if (book.cover_image) currentModalPhotos.push({ label: 'Depan', url: '/storage/' + book.cover_image, type: 'cover' });
            if (book.back_cover_image) currentModalPhotos.push({ label: 'Belakang', url: '/storage/' + book.back_cover_image, type: 'back' });
            if (book.inside_preview_image) currentModalPhotos.push({ label: 'Isi 1', url: '/storage/' + book.inside_preview_image, type: 'inside' });
            if (book.additional_image) currentModalPhotos.push({ label: 'Isi 2', url: '/storage/' + book.additional_image, type: 'inside2' });

            if (currentModalPhotos.length === 0) {
                currentModalPhotos = [
                    { label: 'Depan', url: null, type: 'cover' },
                    { label: 'Belakang', url: null, type: 'back' },
                    { label: 'Isi 1', url: null, type: 'inside' },
                    { label: 'Isi 2', url: null, type: 'inside2' }
                ];
            }

            // Render Switcher Buttons
            const container = document.getElementById('modalPhotoSwitcherContainer');
            container.innerHTML = '';

            currentModalPhotos.forEach((photo, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = idx === 0 
                    ? 'px-3 py-1 rounded-md text-[10px] font-bold bg-[#006830] text-white transition shadow-2xs'
                    : 'px-3 py-1 rounded-md text-[10px] font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition';
                btn.innerText = photo.label;
                btn.onclick = () => switchModalPhoto(idx);
                container.appendChild(btn);
            });

            switchModalPhoto(0);

            const modal = document.getElementById('publicBookModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function switchModalPhoto(index) {
            const photo = currentModalPhotos[index];
            if (!photo) return;

            const container = document.getElementById('modalPhotoSwitcherContainer');
            Array.from(container.children).forEach((btn, idx) => {
                btn.className = idx === index
                    ? 'px-3 py-1 rounded-md text-[10px] font-bold bg-[#006830] text-white transition shadow-2xs'
                    : 'px-3 py-1 rounded-md text-[10px] font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 transition';
            });

            const imgEl = document.getElementById('modalMainImage');
            const frontVec = document.getElementById('modalVectorFront');
            const insideVec = document.getElementById('modalVectorInside');
            const spine = document.getElementById('modalSpineCrease');

            imgEl.classList.add('hidden');
            frontVec.classList.add('hidden');
            insideVec.classList.add('hidden');
            spine.classList.remove('hidden');

            if (photo.url) {
                imgEl.src = photo.url;
                imgEl.classList.remove('hidden');
            } else {
                if (photo.type === 'cover' || photo.type === 'back') {
                    frontVec.classList.remove('hidden');
                } else {
                    insideVec.classList.remove('hidden');
                }
            }
        }

        function closeBookModal() {
            const modal = document.getElementById('publicBookModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('publicBookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });
    </script>
@endsection
