@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah | PERSIS PERS')

@section('content')
    <!-- Header Banner (Consistent with Kontak & Tentang Kami) -->
    <section class="bg-brand-950 text-white py-12 sm:py-16 relative overflow-hidden border-b border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">GALERI PUBLIKASI &amp; KHAZANAH KARYA</span>
                    <h1 class="text-2xl sm:text-4xl font-extrabold font-heading tracking-tight">Katalog Buku &amp; Karya Ilmiah</h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                        Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.
                    </p>
                </div>
                <!-- Clean Search Box in Header -->
                <div class="w-full md:w-80 shrink-0">
                    <div class="relative">
                        <input type="text" id="catalogSearch" placeholder="Cari judul, penulis, ISBN..." class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-slate-400 text-xs focus:outline-hidden focus:ring-2 focus:ring-emerald-400 focus:bg-brand-900/80 transition" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-xs text-slate-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Quick Highlight Cards Overlapping Banner (Consistent with Kontak Layout) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-7 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1 -->
            <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-brand-800 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">150+ Judul Buku</span>
                    <span class="text-[11px] text-slate-500 block">Terbitan Resmi Kampus</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-brand-800 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">Karya Dosen &amp; Peneliti</span>
                    <span class="text-[11px] text-slate-500 block">Buku Ajar &amp; Monograf</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-brand-800 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-barcode"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">ISBN Perpusnas</span>
                    <span class="text-[11px] text-slate-500 block">Legalitas Nasional Resmi</span>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white p-4.5 rounded-xl border border-slate-200 shadow-sm reveal-card flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-brand-800 flex items-center justify-center text-base shrink-0">
                    <i class="fa-solid fa-print"></i>
                </div>
                <div>
                    <span class="text-[11px] font-bold text-slate-900 uppercase tracking-wider block">Cetak Berkualitas</span>
                    <span class="text-[11px] text-slate-500 block">Standar UNESCO &amp; Bookpaper</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Catalog Body -->
    <section class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Sidebar -->
                <aside class="lg:col-span-3 space-y-6">
                    
                    <!-- Box 1: Kategori Buku -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                        <div class="bg-brand-950 px-4 py-3 text-white flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-emerald-400"></i> Kategori Buku
                            </span>
                            <span class="text-[10px] bg-brand-900 text-emerald-300 font-bold px-2 py-0.5 rounded-md border border-brand-800">24 Judul</span>
                        </div>
                        <div class="p-2 divide-y divide-slate-100 text-xs">
                            @foreach($categories as $cat)
                                <button type="button" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg font-medium text-slate-700 hover:bg-emerald-50 hover:text-brand-900 transition text-left group {{ $cat['slug'] === 'all' ? 'bg-emerald-50 text-brand-900 font-bold' : '' }}">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-angle-right text-[10px] text-slate-400 group-hover:text-emerald-700"></i>
                                        {{ $cat['name'] }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 group-hover:text-brand-900 bg-slate-100 group-hover:bg-emerald-100 px-2 py-0.5 rounded-md transition">
                                        {{ $cat['count'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Box 2: Filter Legalitas -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-4.5 space-y-3">
                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wider block border-b border-slate-100 pb-2">
                            <i class="fa-solid fa-sliders text-emerald-700"></i> Spesifikasi &amp; Format
                        </span>
                        <div class="space-y-2.5 text-xs text-slate-600">
                            <label class="flex items-center gap-2 cursor-pointer hover:text-brand-900 transition">
                                <input type="checkbox" checked class="rounded-sm border-slate-300 text-brand-800 focus:ring-brand-800" />
                                <span>ISBN Resmi Perpusnas (100%)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-brand-900 transition">
                                <input type="checkbox" class="rounded-sm border-slate-300 text-brand-800 focus:ring-brand-800" />
                                <span>Katalog Dalam Terbitan (KDT)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-brand-900 transition">
                                <input type="checkbox" class="rounded-sm border-slate-300 text-brand-800 focus:ring-brand-800" />
                                <span>Buku Softcover (Bookpaper)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-brand-900 transition">
                                <input type="checkbox" class="rounded-sm border-slate-300 text-brand-800 focus:ring-brand-800" />
                                <span>Edisi Eksklusif Hardcover</span>
                            </label>
                        </div>
                    </div>

                    <!-- Box 3: Info & Agenda Redaksi -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                        <div class="bg-amber-600 px-4 py-2.5 text-white">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn"></i> Info &amp; Agenda Redaksi
                            </span>
                        </div>
                        <div class="p-3.5 space-y-3 text-xs text-slate-700 divide-y divide-slate-100">
                            <div class="pt-2 first:pt-0">
                                <span class="text-[10px] font-bold text-brand-800 block uppercase">Program Khusus</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-brand-800 cursor-pointer transition">
                                    Diskon Biaya Cetak 15% untuk Konversi Skripsi &amp; Tesis
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading naskah.</p>
                            </div>
                            <div class="pt-3">
                                <span class="text-[10px] font-bold text-amber-700 block uppercase">Agenda Akademik</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-brand-800 cursor-pointer transition">
                                    Bedah Buku &amp; Call for Book Chapters Dosen
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Terbuka untuk civitas akademika dan peneliti eksternal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Box 4: Banner Pengajuan Naskah -->
                    <div class="bg-brand-950 rounded-xl p-4.5 text-white border border-brand-900 space-y-2.5">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">LAYANAN PENERBITAN</span>
                        <h4 class="font-bold text-xs">Punya Naskah Buku Sendiri?</h4>
                        <p class="text-[11px] text-slate-300 leading-relaxed">
                            Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.
                        </p>
                        <a href="{{ route('kontak') }}" class="block text-center py-2 px-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-lg transition shadow-xs">
                            Konsultasikan Naskah &rarr;
                        </a>
                    </div>

                </aside>

                <!-- Right Main Content -->
                <main class="lg:col-span-9 space-y-8">
                    
                    <!-- SECTION 1: BUKU TERBITAN BARU -->
                    <div class="space-y-4">
                        <!-- Section Header Bar (Consistent Brand Theme) -->
                        <div class="bg-brand-900 px-4 py-2.5 rounded-xl text-white flex items-center justify-between shadow-xs">
                            <h2 class="font-extrabold text-sm sm:text-base font-heading tracking-wide uppercase flex items-center gap-2">
                                <i class="fa-solid fa-book-bookmark text-xs text-emerald-400"></i> Buku Terbitan Baru
                            </h2>
                            <span class="text-[11px] text-emerald-300 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Koleksi 2026 <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Buku Baru -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                            @foreach($newBooks as $book)
                                <div class="bg-white rounded-xl border border-slate-200 shadow-xs hover:shadow-md hover:border-brand-800 transition duration-200 flex flex-col justify-between p-3.5">
                                    
                                    <div>
                                        <!-- Solid Clean Academic Book Cover -->
                                        <div class="relative h-52 rounded-lg bg-brand-950 text-white p-3.5 flex flex-col justify-between border-l-4 border-emerald-500 shadow-xs">
                                            <!-- Top Category Tag -->
                                            <div class="flex items-center justify-between">
                                                <span class="text-[9px] font-bold uppercase bg-brand-900 text-emerald-300 px-1.5 py-0.5 rounded">
                                                    {{ $book['category'] }}
                                                </span>
                                                <span class="text-[9px] text-slate-400 font-mono">
                                                    {{ $book['year'] }}
                                                </span>
                                            </div>

                                            <!-- Center Title -->
                                            <div class="my-auto text-center py-1">
                                                <h3 class="font-bold text-xs text-white leading-snug line-clamp-3 font-heading">
                                                    {{ $book['title'] }}
                                                </h3>
                                            </div>

                                            <!-- Footer Author & ISBN -->
                                            <div class="pt-2 border-t border-brand-900 text-center">
                                                <span class="text-[10px] text-slate-300 font-medium line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[8.5px] text-emerald-400 font-mono block mt-0.5">
                                                    ISBN: {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Info Below Cover -->
                                        <div class="mt-3 space-y-0.5">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                                        <div>
                                            <span class="text-[9px] text-slate-400 block font-medium">Harga Cetak:</span>
                                            <span class="text-xs font-black text-brand-900">{{ $book['price'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-bold transition" title="Lihat Sinopsis">
                                                Detail
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

                    <!-- SECTION 2: BUKU BEST SELLER -->
                    <div class="space-y-4 pt-2">
                        <!-- Section Header Bar (Gold / Amber Accent) -->
                        <div class="bg-amber-700 px-4 py-2.5 rounded-xl text-white flex items-center justify-between shadow-xs">
                            <h2 class="font-extrabold text-sm sm:text-base font-heading tracking-wide uppercase flex items-center gap-2">
                                <i class="fa-solid fa-trophy text-xs text-amber-300"></i> Koleksi Best Seller
                            </h2>
                            <span class="text-[11px] text-amber-200 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Paling Banyak Dirujuk <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Best Seller -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                            @foreach($bestSellers as $book)
                                <div class="bg-white rounded-xl border border-slate-200 shadow-xs hover:shadow-md hover:border-amber-600 transition duration-200 flex flex-col justify-between p-3.5">
                                    
                                    <div>
                                        <!-- Solid Clean Academic Book Cover -->
                                        <div class="relative h-52 rounded-lg bg-brand-950 text-white p-3.5 flex flex-col justify-between border-l-4 border-amber-500 shadow-xs">
                                            <!-- Top Category Tag -->
                                            <div class="flex items-center justify-between">
                                                <span class="text-[9px] font-bold uppercase bg-brand-900 text-amber-300 px-1.5 py-0.5 rounded">
                                                    {{ $book['category'] }}
                                                </span>
                                                <span class="text-[9px] text-amber-300 font-bold flex items-center gap-0.5">
                                                    <i class="fa-solid fa-star text-[8px]"></i> Top
                                                </span>
                                            </div>

                                            <!-- Center Title -->
                                            <div class="my-auto text-center py-1">
                                                <h3 class="font-bold text-xs text-white leading-snug line-clamp-3 font-heading">
                                                    {{ $book['title'] }}
                                                </h3>
                                            </div>

                                            <!-- Footer Author & ISBN -->
                                            <div class="pt-2 border-t border-brand-900 text-center">
                                                <span class="text-[10px] text-slate-300 font-medium line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[8.5px] text-amber-400 font-mono block mt-0.5">
                                                    ISBN: {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Info Below Cover -->
                                        <div class="mt-3 space-y-0.5">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                                        <div>
                                            <span class="text-[9px] text-slate-400 block font-medium">Harga Cetak:</span>
                                            <span class="text-xs font-black text-amber-800">{{ $book['price'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-bold transition" title="Lihat Sinopsis">
                                                Detail
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

                    <!-- Clean Pagination Bar -->
                    <div class="pt-5 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-600">
                        <span>Menampilkan <strong class="text-slate-900">8</strong> dari <strong class="text-slate-900">24</strong> buku terbitan resmi</span>
                        <div class="flex items-center gap-1.5 font-bold">
                            <button class="px-3 py-1.5 rounded-lg bg-brand-900 text-white shadow-xs">1</button>
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
        <div class="bg-white rounded-2xl max-w-xl w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative animate-fade-in-up">
            
            <!-- Close Button -->
            <button onclick="closeBookModal()" class="absolute right-4 top-4 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                
                <!-- Left Book Cover in Modal -->
                <div class="sm:col-span-5">
                    <div class="h-60 rounded-xl bg-brand-950 text-white p-4 flex flex-col justify-between border-l-4 border-emerald-500 shadow-md">
                        <span id="modalCategoryBadge" class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-brand-900 text-emerald-300 w-max"></span>
                        <div class="text-center my-auto">
                            <h4 id="modalCoverTitle" class="font-bold text-xs text-white leading-snug font-heading"></h4>
                        </div>
                        <div class="text-center pt-2 border-t border-brand-900">
                            <span id="modalCoverAuthor" class="text-[10px] text-slate-300 block font-medium"></span>
                        </div>
                    </div>
                </div>

                <!-- Right Detail Info -->
                <div class="sm:col-span-7 space-y-3">
                    <div>
                        <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-widest block">SPESIFIKASI NASKAH BUKU</span>
                        <h3 id="modalTitle" class="text-sm sm:text-base font-extrabold text-slate-900 font-heading leading-tight mt-0.5"></h3>
                        <p id="modalAuthor" class="text-xs font-medium text-slate-500 mt-0.5"></p>
                    </div>

                    <!-- Specs Table -->
                    <div class="grid grid-cols-2 gap-2 text-[11px] bg-slate-50 p-2.5 rounded-lg border border-slate-200">
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
                            <span id="modalPrice" class="font-black text-brand-900"></span>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div>
                        <span class="text-[11px] font-bold text-slate-900 block mb-1">Sinopsis Ringkas:</span>
                        <p id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed max-h-28 overflow-y-auto"></p>
                    </div>

                    <!-- Order Action -->
                    <div class="pt-1">
                        <a id="modalWaBtn" href="#" target="_blank" class="w-full py-2.5 px-3 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-xs flex items-center justify-center gap-1.5 transition shadow-xs">
                            <i class="fa-brands fa-whatsapp"></i> Pesan Buku via WhatsApp
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

        document.getElementById('bookModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookModal();
            }
        });
    </script>
@endsection
