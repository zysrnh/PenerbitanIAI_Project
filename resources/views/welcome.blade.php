@extends('layouts.app')

@section('title', 'IAI PERSIS PRESS | Penerbitan & Percetakan')

@section('content')
    <!-- Hero Slider Section -->
    <section class="relative bg-brand-950 text-white overflow-hidden">
        <!-- Hero Background Banner -->
        <div class="relative min-h-[480px] lg:min-h-[540px] flex items-center">
            <!-- Machine Image Background Overlay -->
            <div class="absolute inset-0 z-0">
                <img 
                    src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop" 
                    alt="Mesin Percetakan Industri" 
                    class="w-full h-full object-cover object-center opacity-40"
                />
                <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/90 to-transparent"></div>
            </div>

            <!-- Left Navigation Arrow -->
            <button aria-label="Previous Slide" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition border border-white/10">
                <i class="fa-solid fa-chevron-left text-sm"></i>
            </button>

            <!-- Right Navigation Arrow -->
            <button aria-label="Next Slide" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 text-white flex items-center justify-center transition border border-white/10">
                <i class="fa-solid fa-chevron-right text-sm"></i>
            </button>

            <!-- Hero Main Text Content -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16 lg:py-24">
                <div class="max-w-xl">
                    <h2 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">
                        Melayani Penerbitan<br>
                        dan Percetakan<br>
                        <span class="text-lime-400">Berkualitas</span>
                    </h2>
                    
                    <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-8 max-w-lg">
                        IAI Persis Press hadir untuk mendukung kebutuhan penerbitan buku, jurnal, modul, dan berbagai produk cetak lainnya dengan kualitas terbaik dan pelayanan profesional.
                    </p>

                    <div class="flex items-center gap-3">
                        <a href="#layanan" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-6 py-3 rounded-md text-xs tracking-wider uppercase transition flex items-center gap-2">
                            LIHAT LAYANAN <i class="fa-solid fa-arrow-right text-[11px]"></i>
                        </a>
                        <a href="#katalog" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-6 py-3 rounded-md border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                            KATALOG BUKU <i class="fa-solid fa-book-open text-xs"></i>
                        </a>
                    </div>

                    <!-- Slide Dots -->
                    <div class="flex items-center gap-1.5 mt-10">
                        <span class="w-2.5 h-2.5 rounded-full bg-lime-400"></span>
                        <span class="w-2 h-2 rounded-full bg-white/40"></span>
                        <span class="w-2 h-2 rounded-full bg-white/40"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4 Keunggulan (Floating Pillars Bar) -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 mb-12">
            <div class="bg-white rounded-lg border border-slate-200/90 shadow-sm p-4 sm:p-6 text-slate-800">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                    <!-- Item 1 -->
                    <div class="flex items-center gap-3.5 sm:px-3">
                        <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900">Kualitas Terbaik</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-tight">Hasil cetak tajam, warna akurat</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex items-center gap-3.5 pt-4 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900">Pelayanan Cepat</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-tight">Proses produksi tepat waktu</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex items-center gap-3.5 pt-4 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900">Harga Bersahabat</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-tight">Harga kompetitif dan transparan</p>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="flex items-center gap-3.5 pt-4 sm:pt-0 sm:px-3">
                        <div class="w-10 h-10 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                            <i class="fa-solid fa-users-gear"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900">Berpengalaman</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5 leading-tight">Didukung tim profesional dan berpengalaman</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Layanan Kami (6 Grid Cards) -->
    <section id="layanan" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-brand-800 font-bold text-[11px] uppercase tracking-widest block mb-1">LAYANAN KAMI</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Solusi Lengkap Untuk Kebutuhan Anda</h3>
                <div class="w-10 h-1 bg-brand-800 mx-auto mt-2.5 rounded-full"></div>
            </div>

            <!-- 6 Grid Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                <!-- 1. Penerbitan Buku -->
                <div class="bg-white p-5 rounded-md border border-slate-200 hover:border-brand-700 transition duration-200 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="w-10 h-10 rounded-md text-brand-800 flex items-center justify-start text-2xl mb-3">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug">Penerbitan Buku</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                            Menerbitkan buku referensi, buku ajar, monograf, dan berbagai karya ilmiah.
                        </p>
                    </div>
                    <a href="#kontak" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>

                <!-- 2. Percetakan Umum -->
                <div class="bg-white p-5 rounded-md border border-slate-200 hover:border-brand-700 transition duration-200 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="w-10 h-10 rounded-md text-brand-800 flex items-center justify-start text-2xl mb-3">
                            <i class="fa-solid fa-copy"></i>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug">Percetakan Umum</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                            Cetak brosur, flyer, poster, katalog, majalah, dan berbagai kebutuhan cetak lainnya.
                        </p>
                    </div>
                    <a href="#kontak" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>

                <!-- 3. Jurnal & Majalah -->
                <div class="bg-white p-5 rounded-md border border-slate-200 hover:border-brand-700 transition duration-200 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="w-10 h-10 rounded-md text-brand-800 flex items-center justify-start text-2xl mb-3">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug">Jurnal & Majalah</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                            Pengelolaan dan pencetakan jurnal, prosiding, buletin, dan majalah berkala.
                        </p>
                    </div>
                    <a href="#kontak" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>

                <!-- 4. Konversi KTI -->
                <div class="bg-white p-5 rounded-md border border-slate-200 hover:border-brand-700 transition duration-200 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="w-10 h-10 rounded-md text-brand-800 flex items-center justify-start text-2xl mb-3">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug">Konversi KTI</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                            Ubah skripsi, tesis, disertasi menjadi buku berkualitas siap terbit.
                        </p>
                    </div>
                    <a href="#kontak" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>

                <!-- 5. Pengurusan ISBN -->
                <div class="bg-white p-5 rounded-md border border-slate-200 hover:border-brand-700 transition duration-200 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="w-10 h-10 rounded-md text-brand-800 flex items-center justify-start text-2xl mb-3">
                            <i class="fa-solid fa-barcode"></i>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug">Pengurusan ISBN</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                            Bantu pengurusan ISBN untuk buku dan terbitan Anda.
                        </p>
                    </div>
                    <a href="#kontak" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>

                <!-- 6. Cetak Custom -->
                <div class="bg-white p-5 rounded-md border border-slate-200 hover:border-brand-700 transition duration-200 flex flex-col justify-between shadow-sm">
                    <div>
                        <div class="w-10 h-10 rounded-md text-brand-800 flex items-center justify-start text-2xl mb-3">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug">Cetak Custom</h4>
                        <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                            Cetak sesuai kebutuhan dengan ukuran dan bahan yang beragam.
                        </p>
                    </div>
                    <a href="#kontak" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3 Kolom: Tentang Kami, Proses Kami, Produk Terbaru -->
    <section class="py-12 bg-slate-50 border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                
                <!-- Kolom 1: Tentang Kami (4 Cols) -->
                <div id="tentang" class="lg:col-span-4 bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">TENTANG KAMI</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-3">IAI Persis Press</h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center mb-4">
                            <div class="sm:col-span-7 text-xs text-slate-600 leading-relaxed">
                                Merupakan unit layanan Penerbitan dan Percetakan di lingkungan IAI Persis Bandung yang berkomitmen mendukung penyebaran ilmu pengetahuan dan karya berkualitas bagi akademisi dan masyarakat.
                            </div>
                            <div class="sm:col-span-5 h-28 rounded-md overflow-hidden bg-slate-100 border border-slate-200">
                                <img 
                                    src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=400&auto=format&fit=crop" 
                                    alt="Gedung Kampus IAI Persis" 
                                    class="w-full h-full object-cover grayscale contrast-125"
                                />
                            </div>
                        </div>
                    </div>

                    <a href="#kontak" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-brand-900 hover:bg-brand-950 text-white rounded-md text-xs font-bold transition w-fit">
                        Selengkapnya <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Kolom 2: Proses Kami (4 Cols) -->
                <div class="lg:col-span-4 bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">PROSES KAMI</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-4">Proses Produksi Profesional</h4>
                        
                        <!-- 6 Step Icons Horizontal -->
                        <div class="flex items-center justify-between gap-1 py-2">
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-800 text-white flex items-center justify-center text-xs mb-1.5 shadow-sm">
                                    <i class="fa-solid fa-comments text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Konsultasi</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <!-- Step 2 -->
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-pen-nib text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Desain</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <!-- Step 3 -->
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-desktop text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Prepress</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <!-- Step 4 -->
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-gear text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Produksi</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <!-- Step 5 -->
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-regular fa-file-lines text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Finishing</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <!-- Step 6 -->
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-truck-fast text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Pengiriman</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 text-[11px] text-slate-500">
                        Didukung peralatan modern & pengawasan mutu di setiap tahap produksi.
                    </div>
                </div>

                <!-- Kolom 3: Katalog Buku Terbaru (4 Cols) -->
                <div id="katalog" class="lg:col-span-4 bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">PRODUK TERBARU</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-3">Katalog Buku Terbaru</h4>
                        
                        <!-- 4 Covers Side by Side -->
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            <!-- Book 1: Pendidikan Islam -->
                            <div class="aspect-[3/4] bg-emerald-900 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-emerald-800/80">
                                <div class="text-[7px] text-lime-300 uppercase tracking-tighter">Buku Ajar</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">PENDIDIKAN ISLAM</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>

                            <!-- Book 2: Ilmu Hadis -->
                            <div class="aspect-[3/4] bg-emerald-950 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-emerald-900">
                                <div class="text-[7px] text-lime-300 uppercase tracking-tighter">Referensi</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">ILMU HADIS</span>
                                    <span class="text-[6px] text-slate-300 block">Teori dan Metode</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>

                            <!-- Book 3: Komunikasi Islam -->
                            <div class="aspect-[3/4] bg-slate-900 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-slate-800">
                                <div class="text-[7px] text-lime-300 uppercase tracking-tighter">Monograf</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">KOMUNIKASI ISLAM</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>

                            <!-- Book 4: Fiqh Ibadah -->
                            <div class="aspect-[3/4] bg-amber-950 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-amber-900">
                                <div class="text-[7px] text-amber-300 uppercase tracking-tighter">Buku Teks</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">FIQH IBADAH</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>
                        </div>
                    </div>

                    <a href="#katalog" class="text-[11px] font-bold text-brand-800 hover:text-brand-950 inline-flex items-center gap-1 mt-2">
                        Lihat Katalog <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Action Bar (Dual CTA Banner) -->
    <section id="kontak" class="bg-brand-950 text-white py-6 border-t border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center divide-y md:divide-y-0 md:divide-x divide-brand-900/80">
                
                <!-- Left Action: Konsultasi -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 md:pr-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full border border-emerald-700/60 bg-brand-900 flex items-center justify-center text-white text-lg shrink-0">
                            <i class="fa-solid fa-headset text-lime-400"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-white">Butuh bantuan atau ingin konsultasi?</h4>
                            <p class="text-[11px] text-slate-300 mt-0.5">Tim kami siap membantu Anda.</p>
                        </div>
                    </div>
                    <a href="https://wa.me/6282116116133?text=Halo%20Admin%20IAI%20Persis%20Press,%20saya%20ingin%20berkonsultasi%20terkait%20layanan%20penerbitan/percetakan." target="_blank" class="px-4 py-2 border border-white/40 hover:border-white rounded-md text-xs font-bold text-white transition flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-brands fa-whatsapp text-lime-400"></i> HUBUNGI KAMI
                    </a>
                </div>

                <!-- Right Action: Kirim File -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 md:pt-0 md:pl-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full border border-emerald-700/60 bg-brand-900 flex items-center justify-center text-white text-lg shrink-0">
                            <i class="fa-regular fa-file-lines text-lime-400"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs sm:text-sm text-white">Kirim naskah atau file Anda</h4>
                            <p class="text-[11px] text-slate-300 mt-0.5">dan wujudkan karya terbaik Anda bersama kami.</p>
                        </div>
                    </div>
                    <a href="https://wa.me/6282116116133?text=Halo%20Admin%20IAI%20Persis%20Press,%20saya%20ingin%20mengirimkan%20file/naskah%20untuk%20penerbitan/cetak." target="_blank" class="px-4 py-2 bg-amber-400 hover:bg-amber-500 text-brand-950 rounded-md text-xs font-extrabold transition flex items-center gap-1.5 whitespace-nowrap shadow-sm">
                        <i class="fa-solid fa-cloud-arrow-up text-brand-950"></i> KIRIM FILE SEKARANG
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Mini Footer -->
    <footer class="bg-brand-950 border-t border-brand-900/60 py-4 text-center text-slate-400 text-[11px]">
        <div class="max-w-7xl mx-auto px-4">
            &copy; {{ date('Y') }} IAI PERSIS PRESS - Penerbitan & Percetakan IAI PERSIS Bandung. All rights reserved.
        </div>
    </footer>
@endsection
