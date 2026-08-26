@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah | PERSIS PERS')

@section('content')
    <!-- Hero Banner & Search -->
    <section class="bg-brand-950 text-white py-12 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">GALERI PUBLIKASI &amp; KHAZANAH KARYA</span>
                    <h1 class="text-2xl sm:text-4xl font-extrabold font-heading tracking-tight leading-tight">
                        Katalog Buku &amp; Karya Ilmiah
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                        Koleksi buku ajar perguruan tinggi, monograf riset dosen, konversi KTI, dan literatur Islam ber-ISBN resmi terbitan PERSIS PERS.
                    </p>
                </div>
                <!-- Search Input Bar -->
                <div class="w-full md:w-80 shrink-0">
                    <div class="relative">
                        <input type="text" id="catalogSearch" placeholder="Cari judul, penulis, ISBN..." class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-hidden focus:ring-2 focus:ring-emerald-400 focus:bg-brand-900/80 transition" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-xs text-slate-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Catalog Body -->
    <section class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Sidebar (Categories & Info) -->
                <aside class="lg:col-span-3 space-y-6">
                    
                    <!-- Box 1: Kategori Buku -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                        <div class="bg-gradient-to-r from-brand-900 to-emerald-950 px-4 py-3 text-white flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-emerald-400"></i> Kategori Buku
                            </span>
                            <span class="text-[10px] bg-emerald-500/20 text-emerald-300 font-bold px-2 py-0.5 rounded-full border border-emerald-400/30">24 Judul</span>
                        </div>
                        <div class="p-2 divide-y divide-slate-100 text-xs">
                            @foreach($categories as $cat)
                                <button type="button" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-800 transition text-left group {{ $cat['slug'] === 'all' ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-chevron-right text-[9px] text-slate-400 group-hover:text-emerald-600 transition-transform group-hover:translate-x-0.5"></i>
                                        {{ $cat['name'] }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 group-hover:text-emerald-700 bg-slate-100 group-hover:bg-emerald-100/80 px-2 py-0.5 rounded-full transition">
                                        {{ $cat['count'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Box 2: Filter Legalitas & Format -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-4 space-y-3">
                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wider block border-b border-slate-100 pb-2">
                            <i class="fa-solid fa-filter text-emerald-600"></i> Filter Spesifikasi
                        </span>
                        <div class="space-y-2 text-xs text-slate-600">
                            <label class="flex items-center gap-2 cursor-pointer hover:text-emerald-800 transition">
                                <input type="checkbox" checked class="rounded-sm border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                                <span>ISBN Resmi Perpusnas (100%)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-emerald-800 transition">
                                <input type="checkbox" class="rounded-sm border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                                <span>Katalog Dalam Terbitan (KDT)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-emerald-800 transition">
                                <input type="checkbox" class="rounded-sm border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                                <span>Buku Softcover (Bookpaper)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-emerald-800 transition">
                                <input type="checkbox" class="rounded-sm border-slate-300 text-emerald-600 focus:ring-emerald-500" />
                                <span>Edisi Eksklusif Hardcover</span>
                            </label>
                        </div>
                    </div>

                    <!-- Box 3: Info & Promo Kampus (Matching Reference) -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-600 to-amber-700 px-4 py-3 text-white">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn"></i> Info &amp; Agenda Redaksi
                            </span>
                        </div>
                        <div class="p-3.5 space-y-3 text-xs text-slate-700 divide-y divide-slate-100">
                            <div class="pt-2 first:pt-0">
                                <span class="text-[10px] font-bold text-emerald-700 block">PROGRAM FEBRUARI - MARET 2026</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-emerald-700 cursor-pointer transition">
                                    Diskon Biaya Cetak 15% untuk Konversi Skripsi &amp; Tesis Dosen
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading naskah.</p>
                            </div>
                            <div class="pt-3">
                                <span class="text-[10px] font-bold text-amber-700 block">AGENDA AKADEMIK</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-emerald-700 cursor-pointer transition">
                                    Bedah Buku &amp; Call for Book Chapters Dosen IAI Persis
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Terbuka untuk seluruh civitas akademika dan peneliti eksternal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Box 4: Banner Pengajuan Naskah -->
                    <div class="bg-gradient-to-br from-brand-950 to-emerald-900 rounded-2xl p-4 text-white shadow-sm space-y-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-file-arrow-up"></i>
                        </div>
                        <h4 class="font-bold text-xs">Punya Naskah Buku Sendiri?</h4>
                        <p class="text-[11px] text-slate-300 leading-relaxed">
                            Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak berkualitas tinggi.
                        </p>
                        <a href="{{ route('kontak') }}" class="block text-center py-2 px-3 bg-emerald-500 hover:bg-emerald-400 text-brand-950 font-bold text-xs rounded-lg transition shadow-xs">
                            Ajukan Naskah Sekarang &rarr;
                        </a>
                    </div>

                </aside>

                <!-- Right Main Content (Book Catalog Showcase) -->
                <main class="lg:col-span-9 space-y-10">
                    
                    <!-- SECTION 1: BUKU TERBARU (NEW RELEASES) -->
                    <div class="space-y-4">
                        <!-- Section Header Bar (Matching Reference Style in Modern Emerald) -->
                        <div class="bg-gradient-to-r from-emerald-800 via-brand-900 to-brand-950 px-4 py-3 rounded-xl text-white flex items-center justify-between shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <h2 class="font-extrabold text-sm sm:text-base font-heading tracking-wide uppercase">
                                    Buku <span class="text-emerald-300">Terbitan Baru</span>
                                </h2>
                            </div>
                            <span class="text-[11px] text-emerald-200 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Koleksi 2026 <i class="fa-solid fa-angles-right text-[9px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Buku Baru -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5">
                            @foreach($newBooks as $book)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-xs hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col justify-between group p-3.5">
                                    
                                    <div>
                                        <!-- Realistic 3D Book Cover Card -->
                                        <div class="relative h-56 rounded-xl bg-gradient-to-br {{ $book['cover_color'] }} text-white p-4 flex flex-col justify-between overflow-hidden shadow-md group-hover:scale-[1.02] transition-transform duration-300 border-l-4 border-emerald-400">
                                            <!-- Spine 3D Lighting Effect -->
                                            <div class="absolute left-0 top-0 bottom-0 w-2.5 bg-white/15 pointer-events-none"></div>
                                            <div class="absolute right-0 top-0 bottom-0 w-full bg-gradient-to-l from-black/25 via-transparent to-transparent pointer-events-none"></div>
                                            
                                            <!-- Top Meta -->
                                            <div class="relative z-10 flex items-center justify-between">
                                                <span class="text-[9px] font-extrabold uppercase tracking-wider bg-black/40 backdrop-blur-xs px-2 py-0.5 rounded text-emerald-300 border border-white/10">
                                                    {{ $book['category'] }}
                                                </span>
                                                <span class="text-[9px] font-bold text-slate-300">
                                                    {{ $book['year'] }}
                                                </span>
                                            </div>

                                            <!-- Cover Center Graphic & Title -->
                                            <div class="relative z-10 my-auto text-center py-2">
                                                <i class="fa-solid fa-book-open text-2xl text-emerald-400/40 block mb-2"></i>
                                                <h3 class="font-extrabold text-xs text-white leading-snug line-clamp-3 font-heading drop-shadow-xs">
                                                    {{ $book['title'] }}
                                                </h3>
                                            </div>

                                            <!-- Cover Footer Author -->
                                            <div class="relative z-10 pt-2 border-t border-white/15 text-center">
                                                <span class="text-[10px] text-slate-200 font-medium line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[8.5px] text-emerald-400 font-mono block mt-0.5">
                                                    ISBN: {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Book Meta Info Below Cover -->
                                        <div class="mt-3.5 space-y-1">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug group-hover:text-emerald-800 transition">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
                                        <div>
                                            <span class="text-[10px] text-slate-400 block font-medium">Harga Cetak:</span>
                                            <span class="text-xs font-black text-emerald-700">{{ $book['price'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <!-- Detail Button (Opens Modal) -->
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs transition" title="Lihat Sinopsis">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <!-- WhatsApp Order Button -->
                                            <a href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' . $book['title']) }}" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-[10px] flex items-center gap-1 transition shadow-xs">
                                                <i class="fa-brands fa-whatsapp"></i> Pesan
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- SECTION 2: BUKU POPULER / BEST SELLER -->
                    <div class="space-y-4 pt-4">
                        <!-- Section Header Bar (Gold / Amber Accent) -->
                        <div class="bg-gradient-to-r from-amber-700 via-amber-800 to-brand-950 px-4 py-3 rounded-xl text-white flex items-center justify-between shadow-xs">
                            <div class="flex items-center gap-2.5">
                                <i class="fa-solid fa-trophy text-amber-300 text-sm"></i>
                                <h2 class="font-extrabold text-sm sm:text-base font-heading tracking-wide uppercase">
                                    Koleksi <span class="text-amber-300">Best Seller &amp; Terpopuler</span>
                                </h2>
                            </div>
                            <span class="text-[11px] text-amber-200 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Paling Banyak Dirujuk <i class="fa-solid fa-angles-right text-[9px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Best Seller -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5">
                            @foreach($bestSellers as $book)
                                <div class="bg-white rounded-2xl border border-slate-200 shadow-xs hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col justify-between group p-3.5">
                                    
                                    <div>
                                        <!-- Realistic 3D Book Cover Card -->
                                        <div class="relative h-56 rounded-xl bg-gradient-to-br {{ $book['cover_color'] }} text-white p-4 flex flex-col justify-between overflow-hidden shadow-md group-hover:scale-[1.02] transition-transform duration-300 border-l-4 border-amber-400">
                                            <!-- Spine 3D Lighting Effect -->
                                            <div class="absolute left-0 top-0 bottom-0 w-2.5 bg-white/15 pointer-events-none"></div>
                                            <div class="absolute right-0 top-0 bottom-0 w-full bg-gradient-to-l from-black/25 via-transparent to-transparent pointer-events-none"></div>
                                            
                                            <!-- Top Meta -->
                                            <div class="relative z-10 flex items-center justify-between">
                                                <span class="text-[9px] font-extrabold uppercase tracking-wider bg-black/40 backdrop-blur-xs px-2 py-0.5 rounded text-amber-300 border border-white/10">
                                                    {{ $book['category'] }}
                                                </span>
                                                <span class="text-[9px] font-bold text-amber-200 flex items-center gap-1">
                                                    <i class="fa-solid fa-star text-[8px] text-amber-400"></i> Best Seller
                                                </span>
                                            </div>

                                            <!-- Cover Center Graphic & Title -->
                                            <div class="relative z-10 my-auto text-center py-2">
                                                <i class="fa-solid fa-award text-2xl text-amber-400/40 block mb-2"></i>
                                                <h3 class="font-extrabold text-xs text-white leading-snug line-clamp-3 font-heading drop-shadow-xs">
                                                    {{ $book['title'] }}
                                                </h3>
                                            </div>

                                            <!-- Cover Footer Author -->
                                            <div class="relative z-10 pt-2 border-t border-white/15 text-center">
                                                <span class="text-[10px] text-slate-200 font-medium line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[8.5px] text-amber-300 font-mono block mt-0.5">
                                                    ISBN: {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Book Meta Info Below Cover -->
                                        <div class="mt-3.5 space-y-1">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug group-hover:text-emerald-800 transition">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
                                        <div>
                                            <span class="text-[10px] text-slate-400 block font-medium">Harga Cetak:</span>
                                            <span class="text-xs font-black text-amber-700">{{ $book['price'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-xs transition" title="Lihat Sinopsis">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <a href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' . $book['title']) }}" target="_blank" class="px-2.5 py-1.5 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-[10px] flex items-center gap-1 transition shadow-xs">
                                                <i class="fa-brands fa-whatsapp"></i> Pesan
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination Bar -->
                    <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-600">
                        <span>Menampilkan <strong class="text-slate-900">8</strong> dari <strong class="text-slate-900">24</strong> buku terbitan resmi</span>
                        <div class="flex items-center gap-1.5 font-bold">
                            <button class="px-3 py-1.5 rounded-lg bg-emerald-800 text-white shadow-xs">1</button>
                            <button class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">2</button>
                            <button class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">3</button>
                            <button class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">Berikutnya &rarr;</button>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </section>

    <!-- Modal Quick-View Sinopsis & Detail Buku -->
    <div id="bookModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-fade-in-up">
            
            <!-- Close Button -->
            <button onclick="closeBookModal()" class="absolute right-4 top-4 w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-sm font-bold transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-6 items-start">
                
                <!-- Left Book Cover in Modal -->
                <div class="sm:col-span-5">
                    <div id="modalCover" class="h-64 rounded-2xl bg-gradient-to-br from-brand-900 to-emerald-950 text-white p-5 flex flex-col justify-between shadow-lg border-l-4 border-emerald-400">
                        <span id="modalCategoryBadge" class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded bg-black/40 text-emerald-300 w-max"></span>
                        <div class="text-center my-auto">
                            <i class="fa-solid fa-book-bookmark text-3xl text-emerald-400/40 block mb-2"></i>
                            <h4 id="modalCoverTitle" class="font-extrabold text-xs text-white leading-snug font-heading"></h4>
                        </div>
                        <div class="text-center pt-2 border-t border-white/20">
                            <span id="modalCoverAuthor" class="text-[10px] text-slate-200 block font-medium"></span>
                        </div>
                    </div>
                </div>

                <!-- Right Detail Info -->
                <div class="sm:col-span-7 space-y-3.5">
                    <div>
                        <span class="text-[10px] font-extrabold text-emerald-700 uppercase tracking-widest block">SPESIFIKASI NASKAH BUKU</span>
                        <h3 id="modalTitle" class="text-base sm:text-lg font-extrabold text-slate-900 font-heading leading-tight mt-0.5"></h3>
                        <p id="modalAuthor" class="text-xs font-semibold text-slate-600 mt-1"></p>
                    </div>

                    <!-- Specs Table -->
                    <div class="grid grid-cols-2 gap-2 text-[11px] bg-slate-50 p-3 rounded-xl border border-slate-200/80">
                        <div>
                            <span class="text-slate-400 block font-medium">Legalitas ISBN:</span>
                            <span id="modalIsbn" class="font-mono font-bold text-slate-800"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Tahun Terbit:</span>
                            <span id="modalYear" class="font-bold text-slate-800"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Jumlah Halaman:</span>
                            <span id="modalPages" class="font-bold text-slate-800"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-medium">Harga Eksemplar:</span>
                            <span id="modalPrice" class="font-black text-emerald-700"></span>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div>
                        <span class="text-[11px] font-bold text-slate-900 block mb-1">Sinopsis Ringkas:</span>
                        <p id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed"></p>
                    </div>

                    <!-- Order Action -->
                    <div class="pt-2">
                        <a id="modalWaBtn" href="#" target="_blank" class="w-full py-2.5 px-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-xs flex items-center justify-center gap-2 shadow-md transition">
                            <i class="fa-brands fa-whatsapp text-sm"></i> Pesan Buku Ini Melalui WhatsApp Redaksi
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Script for Modal Handling -->
    <script>
        function openBookModal(book) {
            document.getElementById('modalTitle').innerText = book.title;
            document.getElementById('modalCoverTitle').innerText = book.title;
            document.getElementById('modalAuthor').innerText = 'Penulis: ' + book.author;
            document.getElementById('modalCoverAuthor').innerText = book.author;
            document.getElementById('modalCategoryBadge').innerText = book.category;
            document.getElementById('modalIsbn').innerText = book.isbn;
            document.getElementById('modalYear').innerText = book.year;
            document.getElementById('modalPages').innerText = book.pages;
            document.getElementById('modalPrice').innerText = book.price;
            document.getElementById('modalSynopsis').innerText = book.synopsis;

            const waMsg = encodeURIComponent('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' + book.title + ' (' + book.isbn + ')');
            document.getElementById('modalWaBtn').href = 'https://wa.me/6282116116133?text=' + waMsg;

            const modal = document.getElementById('bookModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeBookModal() {
            const modal = document.getElementById('bookModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close on click outside
        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });
    </script>
@endsection
