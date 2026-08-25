@extends('layouts.app')

@section('title', 'IAI PERSIS PRESS | Penerbitan & Percetakan')

@section('content')
    <!-- Hero Slider Section -->
    <section class="relative bg-brand-950 text-white overflow-hidden select-none">
        
        <!-- Slider Container -->
        <div id="hero-slider" class="relative min-h-[520px] sm:min-h-[560px] lg:min-h-[580px] flex items-center overflow-hidden">
            
            <!-- Slide 1 -->
            <div class="slide absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100 z-10 block" data-index="0">
                <!-- Background Image (Right Aligned Machine) -->
                <div class="absolute inset-0 z-0 flex justify-end">
                    <div class="w-full lg:w-3/4 h-full relative">
                        <img 
                            src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop" 
                            alt="Mesin Percetakan Industri" 
                            class="w-full h-full object-cover object-left"
                        />
                        <!-- Gradient fade from dark green to right -->
                        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/70 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-brand-950/30"></div>
                    </div>
                </div>

                <!-- Text Content (Left Aligned) -->
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-16 lg:py-20">
                    <div class="max-w-xl">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">
                            Melayani Penerbitan<br>
                            dan Percetakan<br>
                            <span class="text-lime-400">Berkualitas</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            IAI Persis Press hadir untuk mendukung kebutuhan penerbitan buku, jurnal, modul, dan berbagai produk cetak lainnya dengan kualitas terbaik dan pelayanan profesional.
                        </p>

                        <div class="flex items-center gap-3 mb-6">
                            <a href="#layanan" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-5 py-2.5 rounded text-xs tracking-wider uppercase transition flex items-center gap-2">
                                LIHAT LAYANAN <i class="fa-solid fa-arrow-right text-[11px]"></i>
                            </a>
                            <a href="#katalog" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-5 py-2.5 rounded border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                                KATALOG BUKU <i class="fa-solid fa-book-open text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 transition-opacity duration-500 ease-in-out opacity-0 z-0 hidden" data-index="1">
                <div class="absolute inset-0 z-0 flex justify-end">
                    <div class="w-full lg:w-3/4 h-full relative">
                        <img 
                            src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop" 
                            alt="Penerbitan Buku ISBN" 
                            class="w-full h-full object-cover object-left"
                        />
                        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/70 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-brand-950/30"></div>
                    </div>
                </div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-16 lg:py-20">
                    <div class="max-w-xl">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">
                            Penerbitan Buku<br>
                            Ber-ISBN Resmi<br>
                            <span class="text-lime-400">& Terindeks</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            Dukung publikasi karya ilmiah, monograf, dan buku referensi Anda dengan pendaftaran resmi ke Perpustakaan Nasional dan sertifikasi Hak Cipta.
                        </p>

                        <div class="flex items-center gap-3 mb-6">
                            <a href="#kontak" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-5 py-2.5 rounded text-xs tracking-wider uppercase transition flex items-center gap-2">
                                AJUKAN NASKAH <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                            </a>
                            <a href="#layanan" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-5 py-2.5 rounded border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                                PANDUAN PENULIS <i class="fa-solid fa-file-lines text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="slide absolute inset-0 transition-opacity duration-500 ease-in-out opacity-0 z-0 hidden" data-index="2">
                <div class="absolute inset-0 z-0 flex justify-end">
                    <div class="w-full lg:w-3/4 h-full relative">
                        <img 
                            src="https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?q=80&w=1600&auto=format&fit=crop" 
                            alt="Percetakan Cepat dan Presisi" 
                            class="w-full h-full object-cover object-left"
                        />
                        <div class="absolute inset-0 bg-gradient-to-r from-brand-950 via-brand-950/70 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-brand-950/30"></div>
                    </div>
                </div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-16 lg:py-20">
                    <div class="max-w-xl">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-4">
                            Percetakan Cepat,<br>
                            Harga Bersahabat<br>
                            <span class="text-lime-400">& Presisi</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            Mencetak majalah, prosiding, buletin, modul ajar, dan kebutuhan cetak custom institusi dengan teknologi modern dan ketepatan waktu.
                        </p>

                        <div class="flex items-center gap-3 mb-6">
                            <a href="#kontak" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-5 py-2.5 rounded text-xs tracking-wider uppercase transition flex items-center gap-2">
                                ORDER SEKARANG <i class="fa-solid fa-cart-shopping text-xs"></i>
                            </a>
                            <a href="https://wa.me/6282116116133" target="_blank" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-5 py-2.5 rounded border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                                HUBUNGI KAMI <i class="fa-brands fa-whatsapp text-xs text-lime-400"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Navigation Arrow Button -->
            <button id="slider-prev" aria-label="Slide Sebelumnya" class="absolute left-3 top-1/2 -translate-y-1/2 z-30 w-9 h-9 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition border border-white/20 shadow-md cursor-pointer">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>

            <!-- Right Navigation Arrow Button -->
            <button id="slider-next" aria-label="Slide Selanjutnya" class="absolute right-3 top-1/2 -translate-y-1/2 z-30 w-9 h-9 rounded-full bg-black/60 hover:bg-black/90 text-white flex items-center justify-center transition border border-white/20 shadow-md cursor-pointer">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>

            <!-- Slide Dots Indicators (Under Buttons on the Left) -->
            <div class="absolute bottom-6 sm:bottom-8 left-4 sm:left-6 lg:left-8 z-30 max-w-7xl mx-auto w-full flex items-center gap-2 pl-4 sm:pl-6 lg:pl-8">
                <button class="dot-indicator w-2.5 h-2.5 rounded-full bg-lime-400 transition-all duration-300 cursor-pointer" data-slide="0" aria-label="Slide 1"></button>
                <button class="dot-indicator w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="1" aria-label="Slide 2"></button>
                <button class="dot-indicator w-2.5 h-2.5 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="2" aria-label="Slide 3"></button>
            </div>

            <!-- 4 Keunggulan (Floating Bottom Right Bar) -->
            <div class="hidden lg:block absolute bottom-6 right-8 xl:right-16 z-30 max-w-3xl w-full">
                <div class="bg-white rounded-xl border border-slate-200 shadow-md px-6 py-4 text-slate-800">
                    <div class="grid grid-cols-4 gap-4 divide-x divide-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">Kualitas Terbaik</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">Hasil cetak tajam, warna akurat</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">Pelayanan Cepat</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">Proses produksi tepat waktu</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">Harga Bersahabat</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">Harga kompetitif & transparan</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">Berpengalaman</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">Didukung tim berpengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 4 Keunggulan Mobile / Tablet (Below Hero) -->
        <div class="lg:hidden relative z-20 max-w-7xl mx-auto px-4 sm:px-6 -mt-6 mb-8">
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4 text-slate-800">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 divide-y sm:divide-y-0 sm:divide-x divide-slate-100">
                    <div class="flex items-center gap-3 sm:px-2">
                        <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                            <i class="fa-solid fa-book-bookmark"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Kualitas Terbaik</h4>
                            <p class="text-[10px] text-slate-500">Hasil cetak tajam, warna akurat</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-3 sm:pt-0 sm:px-2">
                        <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">Pelayanan Cepat</h4>
                            <p class="text-[10px] text-slate-500">Proses produksi tepat waktu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Layanan Kami (6 Grid Cards) -->
    <section id="layanan" class="py-14 bg-white">
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
                
                <!-- Kolom 1: Tentang Kami -->
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

                <!-- Kolom 2: Proses Kami -->
                <div class="lg:col-span-4 bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">PROSES KAMI</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-4">Proses Produksi Profesional</h4>
                        
                        <div class="flex items-center justify-between gap-1 py-2">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-800 text-white flex items-center justify-center text-xs mb-1.5 shadow-sm">
                                    <i class="fa-solid fa-comments text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Konsultasi</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-pen-nib text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Desain</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-desktop text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Prepress</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-gear text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Produksi</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-regular fa-file-lines text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Finishing</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

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

                <!-- Kolom 3: Katalog Buku Terbaru -->
                <div id="katalog" class="lg:col-span-4 bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">PRODUK TERBARU</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-3">Katalog Buku Terbaru</h4>
                        
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            <div class="aspect-[3/4] bg-emerald-900 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-emerald-800/80 hover:scale-105 transition-transform">
                                <div class="text-[7px] text-lime-300 uppercase tracking-tighter">Buku Ajar</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">PENDIDIKAN ISLAM</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>

                            <div class="aspect-[3/4] bg-emerald-950 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-emerald-900 hover:scale-105 transition-transform">
                                <div class="text-[7px] text-lime-300 uppercase tracking-tighter">Referensi</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">ILMU HADIS</span>
                                    <span class="text-[6px] text-slate-300 block">Teori & Metode</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>

                            <div class="aspect-[3/4] bg-slate-900 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-slate-800 hover:scale-105 transition-transform">
                                <div class="text-[7px] text-lime-300 uppercase tracking-tighter">Monograf</div>
                                <div class="text-center my-auto">
                                    <span class="text-[9px] font-bold leading-none block">KOMUNIKASI ISLAM</span>
                                </div>
                                <div class="text-[6px] text-slate-300 text-center">Persis Press</div>
                            </div>

                            <div class="aspect-[3/4] bg-amber-950 rounded-sm p-1.5 text-white flex flex-col justify-between shadow-sm border border-amber-900 hover:scale-105 transition-transform">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot-indicator');
        const prevBtn = document.getElementById('slider-prev');
        const nextBtn = document.getElementById('slider-next');
        const sliderContainer = document.getElementById('hero-slider');
        
        let currentIndex = 0;
        let slideInterval = null;

        function showSlide(index) {
            if (index >= slides.length) index = 0;
            if (index < 0) index = slides.length - 1;
            currentIndex = index;

            slides.forEach((slide, i) => {
                if (i === currentIndex) {
                    slide.classList.remove('hidden', 'opacity-0', 'z-0');
                    slide.classList.add('block', 'opacity-100', 'z-10');
                } else {
                    slide.classList.remove('block', 'opacity-100', 'z-10');
                    slide.classList.add('hidden', 'opacity-0', 'z-0');
                }
            });

            dots.forEach((dot, i) => {
                if (i === currentIndex) {
                    dot.classList.remove('bg-white/40');
                    dot.classList.add('bg-lime-400');
                } else {
                    dot.classList.remove('bg-lime-400');
                    dot.classList.add('bg-white/40');
                }
            });
        }

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }

        if (nextBtn) nextBtn.addEventListener('click', () => { nextSlide(); resetTimer(); });
        if (prevBtn) prevBtn.addEventListener('click', () => { prevSlide(); resetTimer(); });

        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                const idx = parseInt(this.getAttribute('data-slide'));
                showSlide(idx);
                resetTimer();
            });
        });

        function startTimer() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function resetTimer() {
            clearInterval(slideInterval);
            startTimer();
        }

        if (sliderContainer) {
            sliderContainer.addEventListener('mouseenter', () => clearInterval(slideInterval));
            sliderContainer.addEventListener('mouseleave', () => startTimer());
        }

        startTimer();
    });
</script>
@endpush
