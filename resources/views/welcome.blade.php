@extends('layouts.app')

@section('title', 'Penerbitan & Persis Press | IAI PERSIS Bandung')

@section('content')
    <!-- Hero Banner Section -->
    <section class="relative bg-emerald-950 text-white overflow-hidden py-20 lg:py-28">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left: Text Hero -->
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-900/90 border border-emerald-700 text-emerald-200 text-xs sm:text-sm font-semibold mb-6 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        Pusat Penerbitan Buku & Jurnal Ilmiah
                    </div>
                    
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        Menerbitkan Karya, <br class="hidden sm:block" />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-emerald-300">
                            Menyemai Peradaban
                        </span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-emerald-100/90 leading-relaxed mb-8 max-w-2xl">
                        Persis Press hadir sebagai wadah publikasi karya intelektual, buku ajar, referensi, monograf, dan jurnal ilmiah civitas akademika IAI Persis Bandung berstandar nasional dan internasional.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="#kirim-naskah" class="bg-amber-500 hover:bg-amber-600 text-emerald-950 font-bold px-7 py-3.5 rounded-xl shadow-lg shadow-amber-500/20 transition hover:-translate-y-0.5 flex items-center gap-2 text-sm sm:text-base">
                            <i class="fa-solid fa-cloud-arrow-up"></i> Ajukan Naskah Buku
                        </a>
                        <a href="#katalog" class="bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-3.5 rounded-xl border border-white/20 transition flex items-center gap-2 text-sm sm:text-base">
                            <i class="fa-solid fa-book-bookmark"></i> Lihat Katalog
                        </a>
                    </div>
                </div>

                <!-- Right: Featured Book Showcase -->
                <div class="lg:col-span-5 relative flex justify-center">
                    <div class="relative w-full max-w-sm">
                        <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 to-emerald-500 rounded-2xl blur-lg opacity-30"></div>
                        <div class="relative bg-emerald-900/90 border border-emerald-700/60 rounded-2xl p-6 shadow-2xl backdrop-blur-sm">
                            <div class="flex items-center justify-between mb-4 border-b border-emerald-800 pb-3">
                                <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Buku Terbitan Terbaru</span>
                                <span class="text-xs bg-emerald-800 text-emerald-200 px-2.5 py-0.5 rounded-full font-semibold">ISBN Resmi</span>
                            </div>
                            
                            <div class="aspect-[3/4] bg-emerald-950 rounded-xl overflow-hidden shadow-inner flex flex-col items-center justify-center p-6 text-center border border-emerald-800/80 mb-4">
                                <i class="fa-solid fa-book-open-reader text-5xl text-amber-400 mb-4"></i>
                                <h3 class="font-extrabold text-lg text-white leading-snug">Metodologi Studi Islam Kontemporer</h3>
                                <p class="text-xs text-emerald-300 mt-1 font-medium">Tim Dosen IAI Persis Bandung</p>
                                <span class="text-[10px] text-emerald-400/80 mt-2">ISBN: 978-623-0000-00-0</span>
                            </div>

                            <a href="#katalog" class="w-full block text-center py-2.5 bg-emerald-800 hover:bg-emerald-700 text-white font-bold rounded-lg text-xs transition">
                                Jelajahi Koleksi Lengkap &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Penerbitan -->
    <section class="relative z-20 -mt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-5 rounded-2xl shadow-md border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-book"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-extrabold text-slate-800">120+</h4>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul Buku</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-md border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-feather-pointed"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-extrabold text-slate-800">85+</h4>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Penulis / Dosen</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-md border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-extrabold text-slate-800">6</h4>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jurnal Ilmiah</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-md border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-800 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <div>
                    <h4 class="text-2xl font-extrabold text-slate-800">100%</h4>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">ISBN Resmi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Penerbitan -->
    <section id="layanan" class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-emerald-700 font-bold text-xs sm:text-sm tracking-widest uppercase">LAYANAN KAMI</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950 mt-2 mb-4">Fasilitas & Layanan Penerbitan</h2>
                <p class="text-slate-600 text-sm sm:text-base">Mendukung publikasi karya ilmiah yang berintegritas dan siap didistribusikan secara luas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-800 rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-barcode"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Pengurusan ISBN</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Layanan pendaftaran ISBN dan barcode resmi melalui Perpustakaan Nasional Republik Indonesia (Perpusnas).
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-amber-100 text-amber-800 rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-spell-check"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Editing & Layouting</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Penyuntingan naskah (proofreading), tata letak isi buku, dan desain sampul buku (cover) yang profesional.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 text-blue-800 rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Pendaftaran HKI</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Pendampingan pengajuan Hak Cipta dan Kekayaan Intelektual ke DJKI Kemenkumham RI.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="w-12 h-12 bg-purple-100 text-purple-800 rounded-xl flex items-center justify-center text-xl mb-5">
                        <i class="fa-solid fa-print"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Cetak & Distribusi</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Layanan cetak Print on Demand (POD) serta distribusi cetak dan e-book secara digital.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Katalog Buku Contoh -->
    <section id="katalog" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <span class="text-emerald-700 font-bold text-xs sm:text-sm tracking-widest uppercase">KATALOG TERBITAN</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950 mt-2">Buku & Terbitan Terbaru</h2>
                </div>
                <div class="mt-4 md:mt-0 flex gap-2">
                    <button class="px-4 py-2 rounded-lg bg-emerald-800 text-white font-bold text-xs shadow-sm">Semua</button>
                    <button class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium text-xs">Pendidikan Islam</button>
                    <button class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 font-medium text-xs">Hukum Islam</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Book Card 1 -->
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden group hover:shadow-xl transition duration-300 flex flex-col">
                    <div class="aspect-[3/4] bg-emerald-900/80 relative flex items-center justify-center p-6 text-white text-center">
                        <i class="fa-solid fa-book-quran text-6xl text-amber-400 group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Buku Referensi</span>
                            <h3 class="font-extrabold text-base text-slate-900 mt-1 leading-snug">Sejarah Pemikiran Persatuan Islam</h3>
                            <p class="text-xs text-slate-500 mt-1">Dr. H. Nurmawan, M.Ag.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-400">ISBN: 978-623-10-001-1</span>
                            <span class="text-xs font-bold text-emerald-800">Detail &rarr;</span>
                        </div>
                    </div>
                </div>

                <!-- Book Card 2 -->
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden group hover:shadow-xl transition duration-300 flex flex-col">
                    <div class="aspect-[3/4] bg-slate-800 relative flex items-center justify-center p-6 text-white text-center">
                        <i class="fa-solid fa-scale-unbalanced text-6xl text-amber-400 group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Buku Ajar</span>
                            <h3 class="font-extrabold text-base text-slate-900 mt-1 leading-snug">Fiqh Muamalah Kontemporer</h3>
                            <p class="text-xs text-slate-500 mt-1">Dr. Asep Saepudin, M.H.</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-400">ISBN: 978-623-10-002-8</span>
                            <span class="text-xs font-bold text-emerald-800">Detail &rarr;</span>
                        </div>
                    </div>
                </div>

                <!-- Book Card 3 -->
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden group hover:shadow-xl transition duration-300 flex flex-col">
                    <div class="aspect-[3/4] bg-emerald-950 relative flex items-center justify-center p-6 text-white text-center">
                        <i class="fa-solid fa-graduation-cap text-6xl text-amber-400 group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Monograf</span>
                            <h3 class="font-extrabold text-base text-slate-900 mt-1 leading-snug">Inovasi Pembelajaran PAI Digital</h3>
                            <p class="text-xs text-slate-500 mt-1">Tim Dosen Tarbiyah</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-400">ISBN: 978-623-10-003-5</span>
                            <span class="text-xs font-bold text-emerald-800">Detail &rarr;</span>
                        </div>
                    </div>
                </div>

                <!-- Book Card 4 -->
                <div class="bg-slate-50 border border-slate-200/80 rounded-2xl overflow-hidden group hover:shadow-xl transition duration-300 flex flex-col">
                    <div class="aspect-[3/4] bg-blue-950 relative flex items-center justify-center p-6 text-white text-center">
                        <i class="fa-solid fa-mosque text-6xl text-amber-400 group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Buku Bunga Rampai</span>
                            <h3 class="font-extrabold text-base text-slate-900 mt-1 leading-snug">Islam, Sains, dan Kemodernan</h3>
                            <p class="text-xs text-slate-500 mt-1">LPPM IAI Persis Bandung</p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200 flex items-center justify-between">
                            <span class="text-xs font-semibold text-slate-400">ISBN: 978-623-10-004-2</span>
                            <span class="text-xs font-bold text-emerald-800">Detail &rarr;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pengajuan Naskah & Form -->
    <section id="kirim-naskah" class="py-20 bg-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <!-- Alur Kiri -->
                <div class="lg:col-span-6">
                    <span class="text-emerald-700 font-bold text-xs sm:text-sm tracking-widest uppercase">PANDUAN PENULIS</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-emerald-950 mt-2 mb-6">Alur Pengajuan Naskah Buku</h2>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-800 text-white font-bold flex items-center justify-center shrink-0">1</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Pengiriman Draf Naskah</h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1">Kirimkan draf naskah lengkap format Word (.docx) beserta formulir data penulis.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-800 text-white font-bold flex items-center justify-center shrink-0">2</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Review & Penyuntingan (Editor)</h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1">Tim dewan redaksi akan memeriksa kelayakan, orisinalitas, dan struktur materi buku.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-800 text-white font-bold flex items-center justify-center shrink-0">3</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Layout, Cover & Pengajuan ISBN</h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1">Proses tata letak buku, desain sampul, dan permohonan ISBN ke Perpusnas.</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-emerald-800 text-white font-bold flex items-center justify-center shrink-0">4</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-base">Penerbitan & Cetak</h4>
                                <p class="text-slate-600 text-xs sm:text-sm mt-1">Buku resmi terbit, dicetak, serta didaftarkan ke repository / katalog penerbit.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Kanan -->
                <div class="lg:col-span-6 bg-white p-8 rounded-2xl shadow-xl border border-slate-200">
                    <h3 class="text-xl font-bold text-emerald-950 mb-1">Form Pengajuan Naskah</h3>
                    <p class="text-xs text-slate-500 mb-6">Silakan isi formulir awal pengajuan naskah buku Anda di bawah ini:</p>

                    <form onsubmit="event.preventDefault(); alert('Terima kasih! Tim Redaksi Persis Press akan segera menghubungi Anda.');" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap Penulis</label>
                            <input type="text" placeholder="Nama dan gelar lengkap" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700" required>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">No. WhatsApp / HP</label>
                                <input type="tel" placeholder="08123456789" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email</label>
                                <input type="email" placeholder="email@domain.com" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Naskah Buku</label>
                            <input type="text" placeholder="Judul usulan buku" class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori / Jenis Buku</label>
                            <select class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700 bg-white">
                                <option>Buku Referensi</option>
                                <option>Buku Ajar / Modul</option>
                                <option>Monograf</option>
                                <option>Bunga Rampai (Book Chapter)</option>
                                <option>Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Sinopsis / Ringkasan Naskah</label>
                            <textarea rows="3" placeholder="Tuliskan ringkasan materi atau tujuan naskah..." class="w-full px-4 py-2.5 text-sm rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-700 focus:ring-1 focus:ring-emerald-700"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane text-amber-400"></i> Submit Pengajuan Naskah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
