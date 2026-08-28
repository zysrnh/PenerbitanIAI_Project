@extends('layouts.app')

@section('title', 'PERSIS PERS | Penerbitan & Percetakan')

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
                            src="{{ $settings['home_slide1_image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" 
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
                            {!! nl2br(e($settings['home_slide1_title'] ?? "Melayani Penerbitan
dan Percetakan")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide1_highlight'] ?? 'Berkualitas' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            {{ $settings['home_slide1_desc'] ?? 'Persis Pers hadir untuk mendukung kebutuhan penerbitan buku...' }}
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
                            src="{{ $settings['home_slide2_image'] ?? 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop' }}" 
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
                            {!! nl2br(e($settings['home_slide2_title'] ?? "Penerbitan Buku
Ber-ISBN Resmi")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide2_highlight'] ?? '& Terindeks' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            {{ $settings['home_slide2_desc'] ?? 'Dukung publikasi karya ilmiah...' }}
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
                            src="{{ $settings['home_slide3_image'] ?? 'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?q=80&w=1600&auto=format&fit=crop' }}" 
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
                            {!! nl2br(e($settings['home_slide3_title'] ?? "Percetakan Cepat,
Harga Bersahabat")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide3_highlight'] ?? '& Presisi' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            {{ $settings['home_slide3_desc'] ?? 'Mencetak majalah, prosiding...' }}
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
                <div class="bg-white rounded-sm border border-slate-200 shadow-md px-6 py-4 text-slate-800">
                    <div class="grid grid-cols-4 gap-4 divide-x divide-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat1_title'] ?? 'Kualitas Terbaik' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat1_desc'] ?? 'Hasil cetak tajam, warna akurat' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat2_title'] ?? 'Pelayanan Cepat' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat2_desc'] ?? 'Proses produksi tepat waktu' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat3_title'] ?? 'Harga Bersahabat' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat3_desc'] ?? 'Harga kompetitif & transparan' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat4_title'] ?? 'Berpengalaman' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat4_desc'] ?? 'Didukung tim berpengalaman' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 4 Keunggulan Mobile / Tablet (Below Hero) -->
        <div class="lg:hidden relative z-20 max-w-7xl mx-auto px-4 sm:px-6 -mt-6 mb-8">
            <div class="bg-white rounded-sm border border-slate-200 shadow-sm p-4 text-slate-800">
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

    <!-- Section 3 Kolom: Tentang Kami, Proses Kami, Produk Terbaru dari Katalog -->
    <section class="py-12 bg-slate-50 border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                
                <!-- Kolom 1: Tentang Kami (Dynamic dari Settings) -->
                <div id="tentang" class="lg:col-span-4 bg-white p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">TENTANG KAMI</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-3">{{ $settings['home_about_title'] ?? 'PERSIS PERS' }}</h4>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center mb-4">
                            <div class="sm:col-span-7 text-xs text-slate-600 leading-relaxed">
                                {{ $settings['home_about_desc'] ?? 'Merupakan unit layanan Penerbitan dan Percetakan yang berkomitmen mendukung penyebaran ilmu pengetahuan dan karya berkualitas bagi akademisi dan masyarakat.' }}
                            </div>
                            <div class="sm:col-span-5 h-28 rounded-sm overflow-hidden bg-slate-100 border border-slate-200">
                                <img 
                                    src="{{ $settings['home_about_image'] ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=400&auto=format&fit=crop' }}" 
                                    alt="Kantor Redaksi Persis Pers" 
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('tentang') }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition w-fit shadow-2xs">
                        <span>Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Kolom 2: Proses Kami (Dynamic dari Settings) -->
                <div class="lg:col-span-4 bg-white p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block mb-1">PROSES KAMI</span>
                        <h4 class="font-extrabold text-base text-slate-900 mb-4">{{ $settings['home_process_title'] ?? 'Proses Produksi Profesional' }}</h4>
                        
                        <div class="flex items-center justify-between gap-1 py-2">
                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-sm bg-emerald-800 text-white flex items-center justify-center text-xs mb-1.5 shadow-2xs">
                                    <i class="fa-solid fa-comments text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Konsultasi</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-sm bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-pen-nib text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Desain</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-sm bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-desktop text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Prepress</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-sm bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-gear text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Produksi</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-sm bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-regular fa-file-lines text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Finishing</span>
                            </div>

                            <i class="fa-solid fa-arrow-right text-[8px] text-slate-400 mb-3"></i>

                            <div class="flex flex-col items-center text-center">
                                <div class="w-8 h-8 rounded-sm bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5">
                                    <i class="fa-solid fa-truck-fast text-[11px]"></i>
                                </div>
                                <span class="text-[9px] font-semibold text-slate-700">Pengiriman</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 text-[11px] text-slate-500">
                        {{ $settings['home_process_desc'] ?? 'Didukung peralatan modern & pengawasan mutu di setiap tahap produksi.' }}
                    </div>
                </div>

                <!-- Kolom 3: Katalog Buku Terbaru (REAL DATABASE INTEGRATION) -->
                <div id="katalog" class="lg:col-span-4 bg-white p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block">PRODUK TERBARU</span>
                            <span class="text-[9px] text-emerald-700 font-mono font-bold">Koleksi Terkini</span>
                        </div>
                        <h4 class="font-extrabold text-base text-slate-900 mb-3">Katalog Buku Terbaru</h4>
                        
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            @forelse($featuredBooks as $fb)
                                <a href="{{ route('katalog') }}" class="group aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden shadow-2xs border border-slate-300 relative block hover:scale-105 hover:shadow-md transition-all duration-200" title="{{ $fb->title }}">
                                    @if($fb->cover_image && (file_exists(public_path('storage/' . $fb->cover_image)) || file_exists(public_path('images/' . $fb->cover_image))))
                                        <img src="{{ file_exists(public_path('storage/' . $fb->cover_image)) ? asset('storage/' . $fb->cover_image) : asset('images/' . $fb->cover_image) }}" alt="{{ $fb->title }}" class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full bg-[#032c21] p-1.5 flex flex-col justify-between text-white select-none">
                                            <span class="text-[6px] text-emerald-300 font-bold truncate">PERSIS</span>
                                            <span class="font-black line-clamp-3 leading-none text-[6.5px] text-slate-100">{{ $fb->title }}</span>
                                            <span class="text-[5.5px] text-slate-400 truncate">{{ $fb->author }}</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-white text-xs"></i>
                                    </div>
                                </a>
                            @empty
                                <div class="col-span-4 py-4 text-center text-slate-400 text-xs">
                                    Belum ada buku terbit.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <a href="{{ route('katalog') }}" class="text-[11px] font-bold text-emerald-800 hover:text-emerald-950 inline-flex items-center gap-1 mt-2">
                        <span>Buka Katalog Lengkap</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
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
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['home_cta_wa_number'] ?? '082116116133') }}?text=Halo%20Redaksi%20PERSIS%20PERS,%20saya%20ingin%20berkonsultasi%20terkait%20layanan%20penerbitan/percetakan." target="_blank" class="px-4 py-2 border border-white/40 hover:border-white rounded-md text-xs font-bold text-white transition flex items-center gap-1.5 whitespace-nowrap">
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
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['home_cta_wa_number'] ?? '082116116133') }}?text=Halo%20Redaksi%20PERSIS%20PERS,%20saya%20ingin%20mengirimkan%20file/naskah%20buku%20untuk%20diterbitkan." target="_blank" class="px-4 py-2 bg-amber-400 hover:bg-amber-500 text-brand-950 rounded-md text-xs font-extrabold transition flex items-center gap-1.5 whitespace-nowrap shadow-sm">
                        <i class="fa-solid fa-cloud-arrow-up text-brand-950"></i> KIRIM FILE SEKARANG
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Mini Footer -->
    <footer class="bg-brand-950 border-t border-brand-900/60 py-4 text-center text-slate-400 text-[11px]">
        <div class="max-w-7xl mx-auto px-4">
            &copy; {{ date('Y') }} PERSIS PERS - Penerbitan & Percetakan IAI PERSIS Bandung. All rights reserved.
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
