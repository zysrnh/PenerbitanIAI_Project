@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah — PERSIS PERS')

@section('content')
    <style>
        /* Classic Bookstore Shelf Showcase */
        .shelf-stage {
            background: linear-gradient(180deg, #6d1b1b 0%, #4a0e0e 100%);
            box-shadow: inset 0 -10px 20px rgba(0,0,0,0.5);
        }
        .shelf-wood {
            height: 14px;
            background: linear-gradient(180deg, #c58646 0%, #854817 100%);
            box-shadow: 0 6px 12px rgba(0,0,0,0.4);
        }
        .book-shelf-item {
            transform: perspective(600px) rotateY(-18deg) scale(0.96);
            transition: all 0.3s ease;
            box-shadow: 8px 12px 18px rgba(0,0,0,0.45);
        }
        .book-shelf-item:hover {
            transform: perspective(600px) rotateY(0deg) scale(1.06) translateY(-8px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.6);
            z-index: 20;
        }

        /* 3D Realistic Book Card */
        .book-card-3d {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .book-card-3d:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -6px rgba(0,0,0,0.15);
        }
        .spine-crease {
            box-shadow: inset -2px 0 5px rgba(0,0,0,0.18);
        }

        /* Sidebar Category Styling */
        .cat-sidebar-item {
            transition: all 0.2s ease;
        }
        .cat-sidebar-item:hover {
            background-color: #f0fdf4;
            color: #006830;
            padding-left: 14px;
        }
        .cat-sidebar-active {
            background-color: #006830 !important;
            color: #ffffff !important;
            font-weight: 800;
        }
    </style>

    <!-- 1. TOP WOODEN BOOKSHELF 3D SHOWCASE HEADER -->
    <section class="pt-28 pb-4 shelf-stage text-white relative overflow-hidden border-b border-black/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-5">
                <span class="inline-block px-3 py-0.5 rounded-full text-[11px] font-black uppercase tracking-wider bg-black/40 text-amber-300 border border-amber-400/30 mb-1">
                    {{ $settings['catalog_banner_badge'] ?? 'ETALASE UTAMA PERSIS PERS' }}
                </span>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black font-heading tracking-tight text-white drop-shadow-md">
                    {{ $settings['catalog_banner_title'] ?? 'Katalog Buku & Karya Ilmiah' }}
                </h1>
                <p class="text-xs sm:text-sm text-amber-100/90 max-w-xl mx-auto mt-1 line-clamp-1">
                    {{ $settings['catalog_banner_desc'] ?? 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi.' }}
                </p>
            </div>

            <!-- Horizontal 3D Books on Shelf -->
            <div class="relative py-2">
                <div class="flex items-end justify-center gap-3 sm:gap-5 overflow-x-auto pb-3 pt-2 no-scrollbar">
                    @foreach($shelfBooks as $sBook)
                        <div class="book-shelf-item w-20 sm:w-28 md:w-32 aspect-[3/4.2] rounded-xs bg-[#032c21] overflow-hidden shrink-0 cursor-pointer border border-white/20 select-none" onclick="openBookModal({{ json_encode($sBook) }})">
                            @if($sBook->cover_image && file_exists(public_path('storage/' . $sBook->cover_image)))
                                <img src="{{ asset('storage/' . $sBook->cover_image) }}" alt="{{ $sBook->title }}" class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full bg-[#032c21] p-2 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[6px]">
                                    <span class="font-bold text-emerald-300 truncate">{{ $sBook->category }}</span>
                                    <span class="font-black text-[7.5px] leading-tight line-clamp-3">{{ $sBook->title }}</span>
                                    <span class="font-mono text-slate-300">{{ $sBook->author }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- Wooden Shelf Bar Under Books -->
                <div class="shelf-wood w-full rounded-sm"></div>
            </div>

        </div>
    </section>

    <!-- 2. MAIN 2-COLUMN BOOKSTORE CONTENT (SIDEBAR + MAIN GRID) -->
    <section class="py-10 bg-[#f4f6f8] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- ============================================== -->
                <!-- LEFT SIDEBAR: KATEGORI & INFO PROMO -->
                <!-- ============================================== -->
                <div class="lg:col-span-3 space-y-6">
                    
                    <!-- Search Widget -->
                    <div class="bg-white p-3.5 rounded-xl border border-slate-200 shadow-2xs">
                        <form action="{{ route('katalog') }}" method="GET" class="relative">
                            <input 
                                type="text" 
                                name="q" 
                                value="{{ request('q') }}" 
                                placeholder="Cari judul, ISBN..." 
                                class="w-full pl-8 pr-3 py-2 text-xs rounded-lg border border-slate-200 focus:outline-hidden focus:border-[#006830]"
                            />
                            <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        </form>
                    </div>

                    <!-- KATEGORI WIDGET (Matching Reference) -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-2xs">
                        <!-- Red/Pink Bar Header -->
                        <div class="bg-[#006830] text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-list-ul"></i> Kategori
                            </span>
                            <span class="text-[10px] bg-white/20 px-1.5 py-0.5 rounded font-mono">{{ $totalBooksCount }}</span>
                        </div>

                        <!-- Category List with Arrow -->
                        <div class="divide-y divide-slate-100 text-xs font-semibold text-slate-700">
                            
                            <!-- 1. Semua Koleksi -->
                            <a href="{{ route('katalog') }}" class="cat-sidebar-item flex items-center justify-between px-4 py-2.5 {{ !request('kategori') || request('kategori') === 'all' ? 'cat-sidebar-active' : '' }}">
                                <span>Semua Koleksi</span>
                                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                            </a>

                            <!-- 2. Buku Baru -->
                            <a href="{{ route('katalog', ['kategori' => 'Buku Baru']) }}" class="cat-sidebar-item flex items-center justify-between px-4 py-2.5 {{ request('kategori') === 'Buku Baru' ? 'cat-sidebar-active' : '' }}">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-blue-600"></span> Buku Baru (2026)
                                </span>
                                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                            </a>

                            <!-- 3. Best Seller -->
                            <a href="{{ route('katalog', ['kategori' => 'Best Seller']) }}" class="cat-sidebar-item flex items-center justify-between px-4 py-2.5 {{ request('kategori') === 'Best Seller' ? 'cat-sidebar-active' : '' }}">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Best Seller
                                </span>
                                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                            </a>

                            <!-- Dynamic Database Categories -->
                            @foreach($categoriesWithCount as $catItem)
                                <a href="{{ route('katalog', ['kategori' => $catItem['name']]) }}" class="cat-sidebar-item flex items-center justify-between px-4 py-2.5 {{ request('kategori') === $catItem['name'] ? 'cat-sidebar-active' : '' }}">
                                    <span>{{ $catItem['name'] }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono">({{ $catItem['count'] }})</span>
                                </a>
                            @endforeach

                        </div>
                    </div>

                    <!-- INFO & PROMO WIDGET (Matching Reference) -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-2xs">
                        <div class="bg-[#d97706] text-white px-4 py-3 font-extrabold text-xs uppercase tracking-wider flex items-center gap-2">
                            <i class="fa-solid fa-bullhorn"></i> Info &amp; Promo
                        </div>

                        <div class="p-4 space-y-3.5 text-xs">
                            <!-- Promo 1 -->
                            <div class="border-b border-slate-100 pb-3">
                                <span class="text-[10px] font-black text-amber-700 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200">PROMO KHUSUS</span>
                                <h5 class="font-bold text-slate-800 mt-1 leading-snug">{{ $settings['catalog_promo_title'] ?? 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis' }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $settings['catalog_promo_desc'] ?? 'Paket lengkap pengurusan ISBN dan layout UNESCO.' }}</p>
                            </div>

                            <!-- Promo 2 -->
                            <div>
                                <span class="text-[10px] font-black text-blue-700 bg-blue-50 px-1.5 py-0.5 rounded border border-blue-200">AGENDA</span>
                                <h5 class="font-bold text-slate-800 mt-1 leading-snug">{{ $settings['catalog_agenda_title'] ?? 'Bedah Buku & Call for Book Chapters Dosen' }}</h5>
                                <p class="text-[11px] text-slate-500 mt-0.5 leading-relaxed">{{ $settings['catalog_agenda_desc'] ?? 'Terbuka untuk dosen dan peneliti eksternal.' }}</p>
                            </div>

                            <!-- CTA Button -->
                            <a href="{{ route('kontak') }}" class="w-full py-2 bg-[#006830] hover:bg-[#005226] text-white font-bold rounded-lg text-center block text-xs transition">
                                Konsultasi Naskah
                            </a>
                        </div>
                    </div>

                </div>

                <!-- ============================================== -->
                <!-- RIGHT MAIN CONTENT: BUKU BARU + BEST SELLER + ALL BOOKS -->
                <!-- ============================================== -->
                <div class="lg:col-span-9 space-y-8">
                    
                    @if(!request('kategori') || request('kategori') === 'all')
                        
                        <!-- 1. BUKU BARU SECTION (Yellow Header Bar matching reference) -->
                        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-2xs">
                            
                            <!-- Yellow Header Bar -->
                            <div class="bg-[#facc15] text-slate-900 px-4 py-2.5 flex items-center justify-between border-b border-amber-300">
                                <h3 class="text-sm font-black uppercase tracking-wide flex items-center gap-2">
                                    <i class="fa-solid fa-sparkles text-amber-800"></i> Buku <span class="text-amber-900 font-extrabold">Baru</span>
                                </h3>
                                <a href="{{ route('katalog', ['kategori' => 'Buku Baru']) }}" class="text-xs font-black text-slate-900 hover:text-emerald-900 flex items-center gap-1">
                                    <span>Lihat Semua »</span>
                                </a>
                            </div>

                            <!-- 4 Books Grid -->
                            <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                                @foreach($newBooks as $nBook)
                                    <div class="book-card-3d flex flex-col justify-between text-center p-2 rounded-lg hover:bg-slate-50 transition cursor-pointer" onclick="openBookModal({{ json_encode($nBook) }})">
                                        <div class="w-full aspect-[3/4.1] bg-slate-100 rounded-xs overflow-hidden mb-2 relative shadow-sm border border-slate-200">
                                            @if($nBook->cover_image && file_exists(public_path('storage/' . $nBook->cover_image)))
                                                <img src="{{ asset('storage/' . $nBook->cover_image) }}" alt="{{ $nBook->title }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full bg-[#032c21] p-2 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                    <span class="font-bold text-emerald-300 truncate">{{ $nBook->category }}</span>
                                                    <span class="font-black leading-tight line-clamp-3">{{ $nBook->title }}</span>
                                                    <span class="font-mono text-slate-300">{{ $nBook->year }}</span>
                                                </div>
                                            @endif
                                            <div class="absolute inset-0 pointer-events-none spine-crease"></div>
                                        </div>

                                        <div>
                                            <h4 class="font-bold text-slate-900 text-xs leading-snug line-clamp-2 mb-0.5 hover:text-[#006830]">
                                                {{ $nBook->title }}
                                            </h4>
                                            <span class="text-[10px] text-slate-500 block truncate">{{ $nBook->author }}</span>
                                            <span class="text-xs font-black text-[#dc2626] font-mono block mt-1.5">{{ $nBook->price }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <!-- 2. BEST SELLER SECTION (Yellow Header Bar matching reference) -->
                        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-2xs">
                            
                            <!-- Yellow Header Bar -->
                            <div class="bg-[#facc15] text-slate-900 px-4 py-2.5 flex items-center justify-between border-b border-amber-300">
                                <h3 class="text-sm font-black uppercase tracking-wide flex items-center gap-2">
                                    <i class="fa-solid fa-trophy text-amber-800"></i> Best <span class="text-amber-900 font-extrabold">Seller</span>
                                </h3>
                                <a href="{{ route('katalog', ['kategori' => 'Best Seller']) }}" class="text-xs font-black text-slate-900 hover:text-emerald-900 flex items-center gap-1">
                                    <span>Lihat Semua »</span>
                                </a>
                            </div>

                            <!-- 4 Books Grid -->
                            <div class="p-4 grid grid-cols-2 sm:grid-cols-4 gap-4">
                                @foreach($bestSellers as $bBook)
                                    <div class="book-card-3d flex flex-col justify-between text-center p-2 rounded-lg hover:bg-slate-50 transition cursor-pointer" onclick="openBookModal({{ json_encode($bBook) }})">
                                        <div class="w-full aspect-[3/4.1] bg-slate-100 rounded-xs overflow-hidden mb-2 relative shadow-sm border border-slate-200">
                                            @if($bBook->cover_image && file_exists(public_path('storage/' . $bBook->cover_image)))
                                                <img src="{{ asset('storage/' . $bBook->cover_image) }}" alt="{{ $bBook->title }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full bg-[#032c21] p-2 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                    <span class="font-bold text-emerald-300 truncate">{{ $bBook->category }}</span>
                                                    <span class="font-black leading-tight line-clamp-3">{{ $bBook->title }}</span>
                                                    <span class="font-mono text-slate-300">{{ $bBook->year }}</span>
                                                </div>
                                            @endif
                                            <div class="absolute inset-0 pointer-events-none spine-crease"></div>
                                        </div>

                                        <div>
                                            <h4 class="font-bold text-slate-900 text-xs leading-snug line-clamp-2 mb-0.5 hover:text-[#006830]">
                                                {{ $bBook->title }}
                                            </h4>
                                            <span class="text-[10px] text-slate-500 block truncate">{{ $bBook->author }}</span>
                                            <span class="text-xs font-black text-[#dc2626] font-mono block mt-1.5">{{ $bBook->price }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                    @endif

                    <!-- 3. MAIN ALL BOOKS / FILTERED BOOKS GRID -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-2xs">
                        
                        <!-- Header Bar (Green solid) -->
                        <div class="bg-[#006830] text-white px-4 py-2.5 flex items-center justify-between">
                            <h3 class="text-sm font-black uppercase tracking-wide">
                                @if(request('kategori') && request('kategori') !== 'all')
                                    Kategori: <span class="text-amber-300">{{ request('kategori') }}</span>
                                @elseif(request('q'))
                                    Hasil Pencarian: "<span class="text-amber-300">{{ request('q') }}</span>"
                                @else
                                    Semua Koleksi Terdaftar
                                @endif
                            </h3>
                            <span class="text-xs text-emerald-200 font-medium">
                                Menampilkan {{ $books->total() }} judul
                            </span>
                        </div>

                        <!-- Grid -->
                        <div class="p-5 grid grid-cols-2 sm:grid-cols-4 gap-5">
                            @forelse($books as $book)
                                <div class="book-card-3d flex flex-col justify-between text-center p-2.5 rounded-lg border border-slate-100 hover:border-slate-300 hover:bg-slate-50/50 transition cursor-pointer" onclick="openBookModal({{ json_encode($book) }})">
                                    
                                    <div class="w-full aspect-[3/4.1] bg-slate-100 rounded-xs overflow-hidden mb-2 relative shadow-sm border border-slate-200">
                                        @if($book->cover_image && file_exists(public_path('storage/' . $book->cover_image)))
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full bg-[#032c21] p-2 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                <span class="font-bold text-emerald-300 truncate">{{ $book->category }}</span>
                                                <span class="font-black leading-tight line-clamp-3">{{ $book->title }}</span>
                                                <span class="font-mono text-slate-300">{{ $book->year }}</span>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 pointer-events-none spine-crease"></div>
                                    </div>

                                    <div>
                                        <span class="text-[9px] font-bold text-[#006830] bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200 inline-block mb-1">
                                            {{ $book->category }}
                                        </span>
                                        <h4 class="font-bold text-slate-900 text-xs leading-snug line-clamp-2 mb-0.5 hover:text-[#006830]">
                                            {{ $book->title }}
                                        </h4>
                                        <span class="text-[10px] text-slate-500 block truncate">{{ $book->author }}</span>
                                        <span class="text-xs font-black text-[#dc2626] font-mono block mt-1.5">{{ $book->price }}</span>
                                    </div>

                                </div>
                            @empty
                                <div class="col-span-full py-12 text-center text-slate-400">
                                    <i class="fa-solid fa-book-open text-3xl mb-2 text-slate-300"></i>
                                    <p class="text-xs font-bold text-slate-600">Tidak ada buku dalam kategori ini</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Numbered Pagination matching reference [ 1 ] [ 2 ] [ 3 ] -->
                        @if($books->hasPages())
                            <div class="p-4 border-t border-slate-100 flex items-center justify-end">
                                {{ $books->links() }}
                            </div>
                        @endif

                    </div>

                </div>

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

            <!-- Modal Body -->
            <div class="p-5 sm:p-6 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                    
                    <!-- Left: Multi-Photo Showcase -->
                    <div class="md:col-span-5 flex flex-col items-center bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-3.5">
                        
                        <div class="w-44 sm:w-48 aspect-[3/4.1] flex items-center justify-center">
                            <div class="relative w-full h-full rounded-xs overflow-hidden shadow-xl border border-slate-200 bg-[#032c21] select-none">
                                
                                <img id="modalMainImage" src="" alt="Book Cover" class="w-full h-full object-cover hidden" />
                                <div id="modalSpineCrease" class="absolute inset-0 pointer-events-none spine-crease"></div>

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

                                <div id="modalVectorInside" class="w-full h-full bg-[#fdfbf7] text-slate-800 p-3 flex flex-col justify-between hidden border-l-2 border-slate-300">
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
                        <div id="modalPhotoSwitcherContainer" class="w-full flex flex-wrap items-center justify-center gap-1.5 pt-1"></div>

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
                                <span id="modalPrice" class="font-mono font-black text-[#dc2626] text-sm block mt-0.5">Rp 75.000</span>
                            </div>
                        </div>

                        <div>
                            <span class="text-xs font-bold text-slate-800 block mb-1">Sinopsis Buku</span>
                            <div id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed max-h-36 overflow-y-auto pr-1 space-y-1">
                                Sinopsis buku akan dimuat di sini...
                            </div>
                        </div>

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

            document.getElementById('modalTitle').innerText = book.title;
            document.getElementById('modalAuthor').innerText = book.author;
            document.getElementById('modalCategory').innerText = book.category;
            document.getElementById('modalIsbn').innerText = book.isbn || 'Dalam Proses';
            document.getElementById('modalFormat').innerText = book.format || 'UNESCO B5';
            document.getElementById('modalPages').innerText = book.pages || '-';
            document.getElementById('modalYear').innerText = book.year || '2026';
            document.getElementById('modalPrice').innerText = book.price || 'Hubungi Admin';
            document.getElementById('modalSynopsis').innerText = book.synopsis || 'Belum ada sinopsis untuk buku ini.';

            document.getElementById('modalVectorTitle').innerText = book.title;
            document.getElementById('modalVectorAuthor').innerText = book.author;
            document.getElementById('modalVectorCat').innerText = book.category;

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
