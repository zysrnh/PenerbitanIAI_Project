@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah | PERSIS PERS')

@section('content')
    <!-- Flat Header Banner -->
    <section class="bg-[#032c21] text-white py-8 sm:py-10 border-b border-[#064e3b]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in-up">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-widest block mb-1">PUBLIKASI RESMI KAMPUS</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold font-heading tracking-tight">Katalog Buku &amp; Karya Ilmiah</h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1.5 max-w-2xl leading-relaxed">
                        Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.
                    </p>
                </div>
                <!-- Flat Search Box -->
                <div class="w-full md:w-80 shrink-0">
                    <div class="relative">
                        <input type="text" id="catalogSearch" placeholder="Cari judul, penulis, ISBN..." class="w-full pl-9 pr-4 py-2 rounded-sm bg-[#064e3b] border border-emerald-700/60 text-white placeholder-emerald-200 text-xs focus:outline-hidden focus:ring-1 focus:ring-emerald-400" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-xs text-emerald-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Flat Quick Highlight Cards -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <!-- Card 1 -->
            <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-xs flex items-center gap-3">
                <div class="w-8 h-8 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0 border border-emerald-100">
                    <i class="fa-solid fa-book-bookmark text-xs"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">150+ Judul Buku</span>
                    <span class="text-[11px] text-slate-500 block">Terbitan Resmi Kampus</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-xs flex items-center gap-3">
                <div class="w-8 h-8 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0 border border-emerald-100">
                    <i class="fa-solid fa-graduation-cap text-xs"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">Karya Dosen &amp; Peneliti</span>
                    <span class="text-[11px] text-slate-500 block">Buku Ajar &amp; Monograf</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-xs flex items-center gap-3">
                <div class="w-8 h-8 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0 border border-emerald-100">
                    <i class="fa-solid fa-barcode text-xs"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">ISBN Perpusnas</span>
                    <span class="text-[11px] text-slate-500 block">Legalitas Nasional Resmi</span>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white p-3.5 rounded-sm border border-slate-200 shadow-xs flex items-center gap-3">
                <div class="w-8 h-8 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0 border border-emerald-100">
                    <i class="fa-solid fa-print text-xs"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">Cetak Berkualitas</span>
                    <span class="text-[11px] text-slate-500 block">Standar UNESCO</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Catalog Body -->
    <section class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- Left Sidebar -->
                <aside class="lg:col-span-3 space-y-4">
                    
                    <!-- Box 1: Kategori Buku -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-xs overflow-hidden">
                        <div class="bg-[#032c21] px-3.5 py-2 text-white flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-emerald-400"></i> Kategori Buku
                            </span>
                            <span class="text-[10px] bg-[#064e3b] text-emerald-300 font-bold px-1.5 py-0.5 rounded-xs border border-emerald-800">24</span>
                        </div>
                        <div class="p-1 divide-y divide-slate-100 text-xs">
                            @foreach($categories as $cat)
                                <button type="button" class="w-full flex items-center justify-between px-3 py-2 rounded-xs font-medium text-slate-700 hover:bg-slate-100 hover:text-[#006830] transition text-left group {{ $cat['slug'] === 'all' ? 'bg-emerald-50 text-[#006830] font-bold' : '' }}">
                                    <span class="flex items-center gap-1.5">
                                        <i class="fa-solid fa-angle-right text-[9px] text-slate-400 group-hover:text-[#006830]"></i>
                                        {{ $cat['name'] }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 group-hover:text-[#006830] bg-slate-100 px-1.5 py-0.5 rounded-xs">
                                        {{ $cat['count'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Box 2: Filter Legalitas -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-xs p-3.5 space-y-2.5">
                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wider block border-b border-slate-100 pb-1.5">
                            <i class="fa-solid fa-sliders text-[#006830]"></i> Spesifikasi &amp; Format
                        </span>
                        <div class="space-y-2 text-xs text-slate-600">
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900">
                                <input type="checkbox" checked class="rounded-xs border-slate-300 text-[#006830] focus:ring-[#006830]" />
                                <span>ISBN Resmi Perpusnas (100%)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900">
                                <input type="checkbox" class="rounded-xs border-slate-300 text-[#006830] focus:ring-[#006830]" />
                                <span>Katalog Dalam Terbitan (KDT)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900">
                                <input type="checkbox" class="rounded-xs border-slate-300 text-[#006830] focus:ring-[#006830]" />
                                <span>Buku Softcover (Bookpaper)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900">
                                <input type="checkbox" class="rounded-xs border-slate-300 text-[#006830] focus:ring-[#006830]" />
                                <span>Edisi Eksklusif Hardcover</span>
                            </label>
                        </div>
                    </div>

                    <!-- Box 3: Info & Agenda Redaksi -->
                    <div class="bg-white rounded-sm border border-slate-200 shadow-xs overflow-hidden">
                        <div class="bg-[#b45309] px-3.5 py-2 text-white">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn"></i> Info &amp; Agenda Redaksi
                            </span>
                        </div>
                        <div class="p-3 space-y-2.5 text-xs text-slate-700 divide-y divide-slate-100">
                            <div class="pt-1.5 first:pt-0">
                                <span class="text-[9px] font-bold text-[#006830] block uppercase">Program Khusus</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-[#006830] cursor-pointer">
                                    Diskon Biaya Cetak 15% untuk Konversi Skripsi &amp; Tesis
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.</p>
                            </div>
                            <div class="pt-2">
                                <span class="text-[9px] font-bold text-amber-700 block uppercase">Agenda Akademik</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-[#006830] cursor-pointer">
                                    Bedah Buku &amp; Call for Book Chapters Dosen
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Terbuka untuk civitas akademika dan peneliti eksternal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Box 4: Banner Pengajuan Naskah -->
                    <div class="bg-[#032c21] rounded-sm p-4 text-white border border-[#064e3b] space-y-2">
                        <span class="text-[9px] font-bold text-emerald-400 uppercase tracking-widest block">LAYANAN PENERBITAN</span>
                        <h4 class="font-bold text-xs">Punya Naskah Buku Sendiri?</h4>
                        <p class="text-[11px] text-slate-300 leading-relaxed">
                            Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.
                        </p>
                        <a href="{{ route('kontak') }}" class="block text-center py-2 px-3 bg-[#006830] hover:bg-[#005226] text-white font-bold text-xs rounded-sm transition">
                            Konsultasikan Naskah &rarr;
                        </a>
                    </div>

                </aside>

                <!-- Right Main Content -->
                <main class="lg:col-span-9 space-y-7">
                    
                    <!-- SECTION 1: BUKU TERBITAN BARU -->
                    <div class="space-y-3">
                        <!-- Solid Header Bar -->
                        <div class="bg-[#006830] px-4 py-2 rounded-sm text-white flex items-center justify-between shadow-xs">
                            <h2 class="font-extrabold text-sm font-heading tracking-wide uppercase flex items-center gap-2">
                                <i class="fa-solid fa-book-bookmark text-xs text-emerald-300"></i> Buku Terbitan Baru
                            </h2>
                            <span class="text-[11px] text-emerald-100 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Koleksi 2026 <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Buku Baru (Real Academic Book Cover Style) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3.5">
                            @foreach($newBooks as $book)
                                <div class="bg-white rounded-sm border border-slate-200 shadow-xs hover:border-[#006830] transition flex flex-col justify-between p-3">
                                    
                                    <div>
                                        <!-- Realistic Academic Book Cover (Standard 3:4 Aspect Ratio, White Page Edges, Embossed Spine) -->
                                        <div class="relative aspect-[3/4.1] rounded-xs bg-[#064e3b] text-white p-3 flex flex-col justify-between border-l-4 border-emerald-400 border-r-2 border-r-slate-200 shadow-sm overflow-hidden select-none">
                                            <!-- Top Header on Cover -->
                                            <div class="flex items-center justify-between border-b border-white/20 pb-1.5">
                                                <span class="text-[8px] font-extrabold uppercase bg-black/40 text-emerald-300 px-1 py-0.5 rounded-xs">
                                                    {{ $book['category'] }}
                                                </span>
                                                <span class="text-[8px] text-slate-300 font-mono">
                                                    {{ $book['year'] }}
                                                </span>
                                            </div>

                                            <!-- Center Title on Cover -->
                                            <div class="my-auto py-2 text-center">
                                                <div class="w-6 h-0.5 bg-amber-400 mx-auto mb-2"></div>
                                                <h3 class="font-black text-xs sm:text-[13px] text-white leading-tight font-heading line-clamp-3">
                                                    {{ $book['title'] }}
                                                </h3>
                                                <div class="w-6 h-0.5 bg-amber-400 mx-auto mt-2"></div>
                                            </div>

                                            <!-- Bottom Author & Publisher on Cover -->
                                            <div class="pt-1.5 border-t border-white/20 text-center">
                                                <span class="text-[9.5px] font-bold text-slate-100 line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[7.5px] font-mono text-emerald-300 block mt-0.5 uppercase tracking-wider">
                                                    PERSIS PERS • ISBN {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Info Below Cover -->
                                        <div class="mt-2.5 space-y-0.5">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug min-h-[2.25rem] flex items-center">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions Bar -->
                                    <div>
                                        <div class="mt-2.5 pt-2.5 border-t border-slate-100 flex items-baseline justify-between">
                                            <span class="text-[10px] text-slate-500 font-medium">Harga Cetak:</span>
                                            <span class="text-xs font-black text-slate-900 font-heading leading-none whitespace-nowrap">{{ $book['price'] }}</span>
                                        </div>

                                        <div class="mt-2 grid grid-cols-2 gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="w-full py-1.5 px-2 rounded-sm bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold text-center transition flex items-center justify-center gap-1">
                                                <i class="fa-solid fa-eye text-[10px] text-slate-500"></i> Detail
                                            </button>
                                            <a href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' . $book['title']) }}" target="_blank" class="w-full py-1.5 px-2 rounded-sm bg-[#006830] hover:bg-[#005226] text-white text-[11px] font-bold text-center transition flex items-center justify-center gap-1 shadow-xs">
                                                <i class="fa-brands fa-whatsapp text-xs"></i> Pesan
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- SECTION 2: BUKU BEST SELLER -->
                    <div class="space-y-3 pt-2">
                        <!-- Solid Header Bar -->
                        <div class="bg-[#b45309] px-4 py-2 rounded-sm text-white flex items-center justify-between shadow-xs">
                            <h2 class="font-extrabold text-sm font-heading tracking-wide uppercase flex items-center gap-2">
                                <i class="fa-solid fa-trophy text-xs text-amber-200"></i> Koleksi Best Seller
                            </h2>
                            <span class="text-[11px] text-amber-100 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Paling Banyak Dirujuk <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Best Seller (Prestigious Heritage Book Cover) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3.5">
                            @foreach($bestSellers as $book)
                                <div class="bg-white rounded-sm border border-slate-200 shadow-xs hover:border-amber-600 transition flex flex-col justify-between p-3">
                                    
                                    <div>
                                        <!-- Realistic Heritage Academic Cover -->
                                        <div class="relative aspect-[3/4.1] rounded-xs bg-[#032c21] text-white p-3 flex flex-col justify-between border-l-4 border-amber-500 border-r-2 border-r-slate-200 shadow-sm overflow-hidden select-none">
                                            <!-- Top Category Tag -->
                                            <div class="flex items-center justify-between border-b border-amber-500/30 pb-1.5">
                                                <span class="text-[8px] font-extrabold uppercase bg-black/40 text-amber-300 px-1 py-0.5 rounded-xs">
                                                    {{ $book['category'] }}
                                                </span>
                                                <span class="text-[8px] text-amber-300 font-bold flex items-center gap-0.5">
                                                    <i class="fa-solid fa-star text-[7px]"></i> Top
                                                </span>
                                            </div>

                                            <!-- Center Title -->
                                            <div class="my-auto py-2 text-center">
                                                <div class="w-6 h-0.5 bg-amber-400 mx-auto mb-2"></div>
                                                <h3 class="font-black text-xs sm:text-[13px] text-white leading-tight font-heading line-clamp-3">
                                                    {{ $book['title'] }}
                                                </h3>
                                                <div class="w-6 h-0.5 bg-amber-400 mx-auto mt-2"></div>
                                            </div>

                                            <!-- Footer Author & Publisher -->
                                            <div class="pt-1.5 border-t border-amber-500/30 text-center">
                                                <span class="text-[9.5px] font-bold text-slate-100 line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[7.5px] font-mono text-amber-300 block mt-0.5 uppercase tracking-wider">
                                                    PERSIS PERS • ISBN {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Info Below Cover -->
                                        <div class="mt-2.5 space-y-0.5">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug min-h-[2.25rem] flex items-center">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions Bar -->
                                    <div>
                                        <div class="mt-2.5 pt-2.5 border-t border-slate-100 flex items-baseline justify-between">
                                            <span class="text-[10px] text-slate-500 font-medium">Harga Cetak:</span>
                                            <span class="text-xs font-black text-amber-900 font-heading leading-none whitespace-nowrap">{{ $book['price'] }}</span>
                                        </div>

                                        <div class="mt-2 grid grid-cols-2 gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="w-full py-1.5 px-2 rounded-sm bg-slate-100 hover:bg-slate-200 text-slate-700 text-[11px] font-bold text-center transition flex items-center justify-center gap-1">
                                                <i class="fa-solid fa-eye text-[10px] text-slate-500"></i> Detail
                                            </button>
                                            <a href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' . $book['title']) }}" target="_blank" class="w-full py-1.5 px-2 rounded-sm bg-[#006830] hover:bg-[#005226] text-white text-[11px] font-bold text-center transition flex items-center justify-center gap-1 shadow-xs">
                                                <i class="fa-brands fa-whatsapp text-xs"></i> Pesan
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Clean Pagination Bar -->
                    <div class="pt-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-600">
                        <span>Menampilkan <strong class="text-slate-900">8</strong> dari <strong class="text-slate-900">24</strong> buku terbitan</span>
                        <div class="flex items-center gap-1 font-bold">
                            <button class="px-2.5 py-1 rounded-sm bg-[#006830] text-white">1</button>
                            <button class="px-2.5 py-1 rounded-sm bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">2</button>
                            <button class="px-2.5 py-1 rounded-sm bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">3</button>
                            <button class="px-2.5 py-1 rounded-sm bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">Berikutnya &rarr;</button>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </section>

    <!-- Modal Quick-View Detail Buku (Sharp Rectangles, Standard Book Showcase) -->
    <div id="bookModal" class="fixed inset-0 z-50 bg-black/60 hidden items-center justify-center p-3 sm:p-4 overflow-y-auto">
        <div class="bg-white rounded-sm max-w-2xl w-full shadow-2xl border border-slate-300 overflow-hidden relative animate-fade-in-up my-6">
            
            <!-- Modal Header -->
            <div class="bg-[#032c21] text-white px-5 py-3 flex items-center justify-between border-b border-[#064e3b]">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-300">Spesifikasi &amp; Detail Terbitan Resmi</span>
                </div>
                <button onclick="closeBookModal()" class="w-7 h-7 rounded-sm bg-[#064e3b] hover:bg-[#08634c] text-slate-200 hover:text-white flex items-center justify-center text-xs font-bold transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-5 sm:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                    
                    <!-- Left: Standard Book Cover -->
                    <div class="sm:col-span-5 flex flex-col items-center">
                        <div class="relative w-full aspect-[3/4.2] rounded-xs bg-[#032c21] text-white p-3.5 flex flex-col justify-between border-l-4 border-[#006830] border-r-2 border-r-slate-300 shadow-md">
                            <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                <span id="modalCategoryBadge" class="text-[8.5px] font-bold uppercase px-1.5 py-0.5 rounded-xs bg-[#064e3b] text-emerald-300"></span>
                                <span class="text-[8.5px] text-slate-300 font-mono">PERSIS PERS</span>
                            </div>

                            <div class="text-center my-auto py-2">
                                <div class="w-5 h-0.5 bg-amber-400 mx-auto mb-1.5"></div>
                                <h4 id="modalCoverTitle" class="font-black text-xs text-white leading-snug font-heading"></h4>
                                <div class="w-5 h-0.5 bg-amber-400 mx-auto mt-1.5"></div>
                            </div>

                            <div class="pt-1.5 border-t border-white/20 text-center">
                                <span id="modalCoverAuthor" class="text-[9.5px] text-slate-200 block font-medium"></span>
                            </div>
                        </div>

                        <!-- Price Box -->
                        <div class="mt-3 w-full bg-slate-50 border border-slate-200 rounded-sm p-2 text-center">
                            <span class="text-[9px] text-slate-500 font-medium block">Harga Cetak Resmi:</span>
                            <span id="modalPrice" class="text-base font-black text-[#006830] font-heading"></span>
                        </div>
                    </div>

                    <!-- Right: Metadata & Specs -->
                    <div class="sm:col-span-7 space-y-3">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[9px] font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-1.5 py-0.5 rounded-xs">
                                    <i class="fa-solid fa-circle-check text-[8px]"></i> ISBN Terverifikasi
                                </span>
                                <span class="text-[9px] text-slate-400">Katalog Dalam Terbitan (KDT)</span>
                            </div>
                            <h3 id="modalTitle" class="text-sm sm:text-base font-extrabold text-slate-900 font-heading leading-tight"></h3>
                            <p id="modalAuthor" class="text-xs font-semibold text-[#006830] mt-0.5 flex items-center gap-1">
                                <i class="fa-solid fa-user-pen text-[10px] text-slate-400"></i> <span id="modalAuthorText"></span>
                            </p>
                        </div>

                        <!-- Technical Specs Grid -->
                        <div class="grid grid-cols-2 gap-2 text-[11px] bg-slate-50 p-2.5 rounded-sm border border-slate-200">
                            <div>
                                <span class="text-slate-400 block text-[10px]">Nomor ISBN:</span>
                                <span id="modalIsbn" class="font-mono font-bold text-slate-900"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Tahun Terbit:</span>
                                <span id="modalYear" class="font-bold text-slate-900"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Jumlah Halaman:</span>
                                <span id="modalPages" class="font-bold text-slate-900"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-[10px]">Format Cetak:</span>
                                <span class="font-bold text-slate-900">UNESCO B5 (Bookpaper)</span>
                            </div>
                        </div>

                        <!-- Tabs -->
                        <div>
                            <div class="flex items-center gap-3 border-b border-slate-200 pb-1.5 text-xs">
                                <button type="button" onclick="switchModalTab('synopsis')" id="tabBtnSynopsis" class="font-bold text-[#006830] border-b-2 border-[#006830] pb-1">
                                    Sinopsis
                                </button>
                                <button type="button" onclick="switchModalTab('specs')" id="tabBtnSpecs" class="font-medium text-slate-500 hover:text-slate-900 pb-1">
                                    Spesifikasi
                                </button>
                                <button type="button" onclick="switchModalTab('citation')" id="tabBtnCitation" class="font-medium text-slate-500 hover:text-slate-900 pb-1">
                                    Sitasi APA
                                </button>
                            </div>

                            <!-- Tab 1: Synopsis -->
                            <div id="tabContentSynopsis" class="pt-2">
                                <p id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed max-h-28 overflow-y-auto pr-1"></p>
                            </div>

                            <!-- Tab 2: Specs -->
                            <div id="tabContentSpecs" class="hidden pt-2 space-y-1 text-xs text-slate-600">
                                <div class="flex justify-between py-0.5 border-b border-slate-100">
                                    <span class="text-slate-400">Penerbit:</span>
                                    <span class="font-semibold text-slate-800">PERSIS PERS (IAI Persis Bandung)</span>
                                </div>
                                <div class="flex justify-between py-0.5 border-b border-slate-100">
                                    <span class="text-slate-400">Kertas Isi:</span>
                                    <span class="font-semibold text-slate-800">Bookpaper Premium 72 GSM</span>
                                </div>
                                <div class="flex justify-between py-0.5">
                                    <span class="text-slate-400">Sampul:</span>
                                    <span class="font-semibold text-slate-800">Art Carton 260gr, Doff</span>
                                </div>
                            </div>

                            <!-- Tab 3: Citation -->
                            <div id="tabContentCitation" class="hidden pt-2">
                                <div class="bg-slate-100 p-2 rounded-xs text-[10.5px] text-slate-700 font-mono border border-slate-200">
                                    <span id="modalCitationText"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-2.5 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <a id="modalWaBtn" href="#" target="_blank" class="w-full py-2 px-3 rounded-sm bg-[#006830] hover:bg-[#005226] text-white font-bold text-xs flex items-center justify-center gap-1.5 transition">
                                <i class="fa-brands fa-whatsapp"></i> Pesan via WhatsApp
                            </a>
                            <button type="button" onclick="alert('Sampel Bab 1 & Daftar Isi PDF siap diunduh!')" class="w-full py-2 px-3 rounded-sm bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs flex items-center justify-center gap-1.5 transition border border-slate-200">
                                <i class="fa-solid fa-file-pdf text-red-600"></i> Unduh Sampel PDF
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Script for Modal Handling & Tab Switching -->
    <script>
        function openBookModal(book) {
            document.getElementById('modalTitle').innerText = book.title;
            document.getElementById('modalCoverTitle').innerText = book.title;
            document.getElementById('modalAuthorText').innerText = book.author;
            document.getElementById('modalCoverAuthor').innerText = book.author;
            document.getElementById('modalCategoryBadge').innerText = book.category;
            document.getElementById('modalIsbn').innerText = book.isbn;
            document.getElementById('modalYear').innerText = book.year;
            document.getElementById('modalPages').innerText = book.pages;
            document.getElementById('modalPrice').innerText = book.price;
            document.getElementById('modalSynopsis').innerText = book.synopsis;

            const citation = book.author + '. (' + book.year + '). ' + book.title + '. Bandung: PERSIS PERS. ISBN: ' + book.isbn + '.';
            document.getElementById('modalCitationText').innerText = citation;

            const waMsg = encodeURIComponent('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' + book.title + ' (ISBN: ' + book.isbn + ')');
            document.getElementById('modalWaBtn').href = 'https://wa.me/6282116116133?text=' + waMsg;

            switchModalTab('synopsis');

            const modal = document.getElementById('bookModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeBookModal() {
            const modal = document.getElementById('bookModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function switchModalTab(tab) {
            const synopsisContent = document.getElementById('tabContentSynopsis');
            const specsContent = document.getElementById('tabContentSpecs');
            const citationContent = document.getElementById('tabContentCitation');

            const synopsisBtn = document.getElementById('tabBtnSynopsis');
            const specsBtn = document.getElementById('tabBtnSpecs');
            const citationBtn = document.getElementById('tabBtnCitation');

            const activeBtnClasses = ['text-[#006830]', 'border-b-2', 'border-[#006830]', 'font-bold'];
            const inactiveBtnClasses = ['text-slate-500', 'font-medium'];

            [synopsisContent, specsContent, citationContent].forEach(c => c.classList.add('hidden'));
            [synopsisBtn, specsBtn, citationBtn].forEach(b => {
                b.classList.remove(...activeBtnClasses);
                b.classList.add(...inactiveBtnClasses);
            });

            if (tab === 'synopsis') {
                synopsisContent.classList.remove('hidden');
                synopsisBtn.classList.add(...activeBtnClasses);
                synopsisBtn.classList.remove(...inactiveBtnClasses);
            } else if (tab === 'specs') {
                specsContent.classList.remove('hidden');
                specsBtn.classList.add(...activeBtnClasses);
                specsBtn.classList.remove(...inactiveBtnClasses);
            } else if (tab === 'citation') {
                citationContent.classList.remove('hidden');
                citationBtn.classList.add(...activeBtnClasses);
                citationBtn.classList.remove(...inactiveBtnClasses);
            }
        }

        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });
    </script>
@endsection
