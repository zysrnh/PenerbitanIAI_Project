@extends('layouts.app')

@section('title', 'Katalog Buku & Karya Ilmiah | PERSIS PERS')

@section('content')
    <!-- Clean Minimalist Header & Search -->
    <section class="bg-slate-900 text-white py-8 sm:py-10 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in-up">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="text-[11px] font-bold text-emerald-400 uppercase tracking-widest block mb-1">PUBLIKASI RESMI KAMPUS</span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold font-heading tracking-tight">
                        Katalog Buku &amp; Karya Ilmiah
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-400 mt-1.5 max-w-2xl">
                        Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur Islam ber-ISBN resmi terbitan PERSIS PERS.
                    </p>
                </div>
                <!-- Clean Search Input -->
                <div class="w-full md:w-80 shrink-0">
                    <div class="relative">
                        <input type="text" id="catalogSearch" placeholder="Cari judul, penulis, ISBN..." class="w-full pl-9 pr-4 py-2 rounded-md bg-slate-800 border border-slate-700 text-white placeholder-slate-400 text-xs focus:outline-hidden focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 transition" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-xs text-slate-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Catalog Content -->
    <section class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
                
                <!-- Left Sidebar (Clean & Minimalist) -->
                <aside class="lg:col-span-3 space-y-5">
                    
                    <!-- Box 1: Kategori Buku -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
                        <div class="bg-slate-900 px-4 py-2.5 text-white flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-emerald-400 text-xs"></i> Kategori Buku
                            </span>
                            <span class="text-[10px] bg-slate-800 text-slate-300 font-bold px-2 py-0.5 rounded border border-slate-700">24 Judul</span>
                        </div>
                        <div class="p-1.5 divide-y divide-slate-100 text-xs">
                            @foreach($categories as $cat)
                                <button type="button" class="w-full flex items-center justify-between px-3 py-2 rounded-md font-medium text-slate-700 hover:bg-slate-100 hover:text-emerald-800 transition text-left group {{ $cat['slug'] === 'all' ? 'bg-emerald-50 text-emerald-800 font-bold' : '' }}">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-angle-right text-[10px] text-slate-400 group-hover:text-emerald-600"></i>
                                        {{ $cat['name'] }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 group-hover:text-emerald-700 bg-slate-100 px-1.5 py-0.5 rounded">
                                        {{ $cat['count'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Box 2: Filter Legalitas & Format -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-xs p-4 space-y-3">
                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wider block border-b border-slate-100 pb-2">
                            <i class="fa-solid fa-sliders text-emerald-700"></i> Spesifikasi &amp; Format
                        </span>
                        <div class="space-y-2 text-xs text-slate-600">
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900 transition">
                                <input type="checkbox" checked class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600" />
                                <span>ISBN Resmi Perpusnas (100%)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900 transition">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600" />
                                <span>Katalog Dalam Terbitan (KDT)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900 transition">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600" />
                                <span>Buku Softcover (Bookpaper)</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer hover:text-slate-900 transition">
                                <input type="checkbox" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600" />
                                <span>Edisi Eksklusif Hardcover</span>
                            </label>
                        </div>
                    </div>

                    <!-- Box 3: Info & Agenda Redaksi (Clean Flat Design) -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
                        <div class="bg-amber-600 px-4 py-2.5 text-white">
                            <span class="text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn text-xs"></i> Info &amp; Agenda Redaksi
                            </span>
                        </div>
                        <div class="p-3.5 space-y-3 text-xs text-slate-700 divide-y divide-slate-100">
                            <div class="pt-2 first:pt-0">
                                <span class="text-[10px] font-bold text-emerald-700 block uppercase">Program Khusus</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-emerald-700 cursor-pointer transition">
                                    Diskon Biaya Cetak 15% untuk Konversi Skripsi &amp; Tesis
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading naskah.</p>
                            </div>
                            <div class="pt-3">
                                <span class="text-[10px] font-bold text-amber-700 block uppercase">Agenda Akademik</span>
                                <h4 class="font-bold text-slate-900 mt-0.5 hover:text-emerald-700 cursor-pointer transition">
                                    Bedah Buku &amp; Call for Book Chapters Dosen
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-1">Terbuka untuk civitas akademika dan peneliti eksternal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Box 4: Banner Pengajuan Naskah -->
                    <div class="bg-slate-900 rounded-lg p-4 text-white border border-slate-800 space-y-2.5">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">LAYANAN PENERBITAN</span>
                        <h4 class="font-bold text-xs">Punya Naskah Buku Sendiri?</h4>
                        <p class="text-[11px] text-slate-300 leading-relaxed">
                            Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak berkualitas.
                        </p>
                        <a href="{{ route('kontak') }}" class="block text-center py-2 px-3 bg-[#006830] hover:bg-[#005226] text-white font-bold text-xs rounded-md transition shadow-xs">
                            Konsultasikan Naskah &rarr;
                        </a>
                    </div>

                </aside>

                <!-- Right Main Content -->
                <main class="lg:col-span-9 space-y-8">
                    
                    <!-- SECTION 1: BUKU TERBITAN BARU -->
                    <div class="space-y-3.5">
                        <!-- Solid Clean Header Bar -->
                        <div class="bg-[#006830] px-4 py-2.5 rounded-lg text-white flex items-center justify-between shadow-xs">
                            <h2 class="font-extrabold text-sm sm:text-base font-heading tracking-wide uppercase flex items-center gap-2">
                                <i class="fa-solid fa-book-bookmark text-xs text-emerald-300"></i> Buku Terbitan Baru
                            </h2>
                            <span class="text-[11px] text-emerald-200 font-semibold cursor-pointer hover:text-white transition flex items-center gap-1">
                                Koleksi 2026 <i class="fa-solid fa-angle-right text-[10px]"></i>
                            </span>
                        </div>

                        <!-- Grid 4 Kolom Buku Baru -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                            @foreach($newBooks as $book)
                                <div class="bg-white rounded-lg border border-slate-200 shadow-xs hover:border-emerald-600 transition duration-200 flex flex-col justify-between p-3">
                                    
                                    <div>
                                        <!-- Solid Clean Academic Book Cover -->
                                        <div class="relative h-52 rounded-md bg-slate-900 text-white p-3.5 flex flex-col justify-between border-l-4 border-emerald-600 shadow-xs">
                                            <!-- Top Category Tag -->
                                            <div class="flex items-center justify-between">
                                                <span class="text-[9px] font-bold uppercase bg-slate-800 text-emerald-300 px-1.5 py-0.5 rounded">
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
                                            <div class="pt-2 border-t border-slate-800 text-center">
                                                <span class="text-[10px] text-slate-300 font-medium line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[8.5px] text-emerald-400 font-mono block mt-0.5">
                                                    {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Info Below Cover -->
                                        <div class="mt-2.5 space-y-0.5">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-2.5 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                                        <div>
                                            <span class="text-[9px] text-slate-400 block">Harga Cetak:</span>
                                            <span class="text-xs font-black text-slate-900">{{ $book['price'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="px-2 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-bold transition" title="Lihat Sinopsis">
                                                Detail
                                            </button>
                                            <a href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' . $book['title']) }}" target="_blank" class="px-2.5 py-1 rounded bg-[#006830] hover:bg-[#005226] text-white font-bold text-[10px] flex items-center gap-1 transition">
                                                <i class="fa-brands fa-whatsapp"></i> Pesan
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- SECTION 2: BUKU BEST SELLER -->
                    <div class="space-y-3.5 pt-2">
                        <!-- Solid Clean Amber Header Bar -->
                        <div class="bg-amber-700 px-4 py-2.5 rounded-lg text-white flex items-center justify-between shadow-xs">
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
                                <div class="bg-white rounded-lg border border-slate-200 shadow-xs hover:border-amber-600 transition duration-200 flex flex-col justify-between p-3">
                                    
                                    <div>
                                        <!-- Solid Clean Academic Book Cover -->
                                        <div class="relative h-52 rounded-md bg-slate-900 text-white p-3.5 flex flex-col justify-between border-l-4 border-amber-500 shadow-xs">
                                            <!-- Top Category Tag -->
                                            <div class="flex items-center justify-between">
                                                <span class="text-[9px] font-bold uppercase bg-slate-800 text-amber-300 px-1.5 py-0.5 rounded">
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
                                            <div class="pt-2 border-t border-slate-800 text-center">
                                                <span class="text-[10px] text-slate-300 font-medium line-clamp-1 block">
                                                    {{ $book['author'] }}
                                                </span>
                                                <span class="text-[8.5px] text-amber-400 font-mono block mt-0.5">
                                                    {{ $book['isbn'] }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Meta Info Below Cover -->
                                        <div class="mt-2.5 space-y-0.5">
                                            <h4 class="font-bold text-xs text-slate-900 line-clamp-2 leading-snug">
                                                {{ $book['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 line-clamp-1">
                                                {{ $book['author'] }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price & Actions -->
                                    <div class="mt-2.5 pt-2.5 border-t border-slate-100 flex items-center justify-between">
                                        <div>
                                            <span class="text-[9px] text-slate-400 block">Harga Cetak:</span>
                                            <span class="text-xs font-black text-slate-900">{{ $book['price'] }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" onclick="openBookModal({{ json_encode($book) }})" class="px-2 py-1 rounded bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-bold transition" title="Lihat Sinopsis">
                                                Detail
                                            </button>
                                            <a href="https://wa.me/6282116116133?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin memesan buku: ' . $book['title']) }}" target="_blank" class="px-2.5 py-1 rounded bg-[#006830] hover:bg-[#005226] text-white font-bold text-[10px] flex items-center gap-1 transition">
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
                        <span>Menampilkan <strong class="text-slate-900">8</strong> dari <strong class="text-slate-900">24</strong> buku terbitan</span>
                        <div class="flex items-center gap-1 font-bold">
                            <button class="px-3 py-1 rounded bg-[#006830] text-white">1</button>
                            <button class="px-3 py-1 rounded bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">2</button>
                            <button class="px-3 py-1 rounded bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">3</button>
                            <button class="px-3 py-1 rounded bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 transition">Berikutnya &rarr;</button>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </section>

    <!-- Modal Quick-View Sinopsis & Detail Buku (Clean Flat Design) -->
    <div id="bookModal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-xl w-full p-6 shadow-xl border border-slate-200 relative animate-fade-in-up">
            
            <!-- Close Button -->
            <button onclick="closeBookModal()" class="absolute right-4 top-4 w-8 h-8 rounded bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold transition">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-start">
                
                <!-- Left Book Cover in Modal -->
                <div class="sm:col-span-5">
                    <div class="h-60 rounded-md bg-slate-900 text-white p-4 flex flex-col justify-between border-l-4 border-emerald-600 shadow-xs">
                        <span id="modalCategoryBadge" class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-slate-800 text-emerald-300 w-max"></span>
                        <div class="text-center my-auto">
                            <h4 id="modalCoverTitle" class="font-bold text-xs text-white leading-snug font-heading"></h4>
                        </div>
                        <div class="text-center pt-2 border-t border-slate-800">
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
                    <div class="grid grid-cols-2 gap-2 text-[11px] bg-slate-50 p-2.5 rounded-md border border-slate-200">
                        <div>
                            <span class="text-slate-400 block">Legalitas ISBN:</span>
                            <span id="modalIsbn" class="font-mono font-bold text-slate-800"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Tahun Terbit:</span>
                            <span id="modalYear" class="font-bold text-slate-800"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Jumlah Halaman:</span>
                            <span id="modalPages" class="font-bold text-slate-800"></span>
                        </div>
                        <div>
                            <span class="text-slate-400 block">Harga Eksemplar:</span>
                            <span id="modalPrice" class="font-bold text-slate-900"></span>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div>
                        <span class="text-[11px] font-bold text-slate-900 block mb-1">Sinopsis Ringkas:</span>
                        <p id="modalSynopsis" class="text-xs text-slate-600 leading-relaxed max-h-28 overflow-y-auto"></p>
                    </div>

                    <!-- Order Action -->
                    <div class="pt-1">
                        <a id="modalWaBtn" href="#" target="_blank" class="w-full py-2 px-3 rounded-md bg-[#006830] hover:bg-[#005226] text-white font-bold text-xs flex items-center justify-center gap-1.5 transition shadow-xs">
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
