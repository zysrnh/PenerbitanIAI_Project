@extends('layouts.app')

@section('title', 'PERSIS PERS | Penerbitan & Percetakan')

@section('content')
    <!-- Hero Slider Section (Mobile-First & Touch-Friendly) -->
    <section class="relative bg-brand-950 bg-[#032c21] text-white overflow-hidden select-none">
        
        <!-- Slider Container -->
        <div id="hero-slider" class="relative min-h-[440px] sm:min-h-[490px] lg:min-h-[540px] flex items-center overflow-hidden">
            
            <!-- Slide 1 -->
            <div class="slide absolute inset-0 transition-opacity duration-500 ease-in-out opacity-100 z-10 block" data-index="0">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0 flex justify-end">
                    <div class="w-full lg:w-3/4 h-full relative">
                        <img 
                            src="{{ $settings['home_slide1_image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" 
                            alt="Mesin Percetakan Industri" 
                            class="w-full h-full object-cover object-center lg:object-left opacity-30 sm:opacity-60 lg:opacity-100"
                        />
                        <!-- Gradient overlays for maximum text legibility -->
                        <div class="absolute inset-0 bg-gradient-to-t sm:bg-gradient-to-r from-[#032c21] via-[#032c21]/90 lg:via-[#032c21]/70 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-[#032c21]/80 via-transparent to-[#032c21]"></div>
                    </div>
                </div>

                <!-- Text Content -->
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-10 sm:py-16 lg:py-20">
                    <div class="max-w-xl pr-0 sm:pr-8">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-2.5 sm:mb-4">
                            {!! nl2br(e($settings['home_slide1_title'] ?? "Melayani Penerbitan\ndan Percetakan")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide1_highlight'] ?? 'Berkualitas' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-5 sm:mb-7 max-w-md line-clamp-3 sm:line-clamp-none">
                            {{ $settings['home_slide1_desc'] ?? 'Persis Pers hadir untuk mendukung kebutuhan penerbitan buku, jurnal, modul, dan berbagai produk cetak lainnya dengan kualitas terbaik dan pelayanan profesional.' }}
                        </p>

                        <div class="flex items-center gap-2.5 sm:gap-3 mb-2 sm:mb-6">
                            <a href="{{ $settings['home_slide1_btn1_url'] ?? '#layanan' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-extrabold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-sm text-[11px] sm:text-xs tracking-wider uppercase transition flex items-center gap-1.5 shadow-xs">
                                <span>{{ $settings['home_slide1_btn1_text'] ?? 'LIHAT LAYANAN' }}</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                            <a href="{{ $settings['home_slide1_btn2_url'] ?? '/katalog' }}" class="bg-white/10 hover:bg-white/20 text-white font-bold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-sm border border-white/30 text-[11px] sm:text-xs tracking-wider uppercase transition flex items-center gap-1.5">
                                <span>{{ $settings['home_slide1_btn2_text'] ?? 'KATALOG BUKU' }}</span>
                                <i class="fa-solid fa-book-open text-[10px]"></i>
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
                            class="w-full h-full object-cover object-center lg:object-left opacity-30 sm:opacity-60 lg:opacity-100"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t sm:bg-gradient-to-r from-[#032c21] via-[#032c21]/90 lg:via-[#032c21]/70 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-[#032c21]/80 via-transparent to-[#032c21]"></div>
                    </div>
                </div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-10 sm:py-16 lg:py-20">
                    <div class="max-w-xl pr-0 sm:pr-8">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-2.5 sm:mb-4">
                            {!! nl2br(e($settings['home_slide2_title'] ?? "Penerbitan Buku\nBer-ISBN Resmi")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide2_highlight'] ?? '& Terindeks' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-5 sm:mb-7 max-w-md line-clamp-3 sm:line-clamp-none">
                            {{ $settings['home_slide2_desc'] ?? 'Dukung publikasi karya ilmiah, monograf, dan buku referensi Anda dengan pendaftaran resmi ke Perpustakaan Nasional dan sertifikasi Hak Cipta.' }}
                        </p>

                        <div class="flex items-center gap-2.5 sm:gap-3 mb-2 sm:mb-6">
                            <a href="{{ $settings['home_slide2_btn1_url'] ?? '/kontak' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-extrabold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-sm text-[11px] sm:text-xs tracking-wider uppercase transition flex items-center gap-1.5 shadow-xs">
                                <span>{{ $settings['home_slide2_btn1_text'] ?? 'AJUKAN NASKAH' }}</span>
                                <i class="fa-solid fa-cloud-arrow-up text-[10px]"></i>
                            </a>
                            <a href="{{ $settings['home_slide2_btn2_url'] ?? '#layanan' }}" class="bg-white/10 hover:bg-white/20 text-white font-bold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-sm border border-white/30 text-[11px] sm:text-xs tracking-wider uppercase transition flex items-center gap-1.5">
                                <span>{{ $settings['home_slide2_btn2_text'] ?? 'PANDUAN PENULIS' }}</span>
                                <i class="fa-solid fa-file-lines text-[10px]"></i>
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
                            class="w-full h-full object-cover object-center lg:object-left opacity-30 sm:opacity-60 lg:opacity-100"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t sm:bg-gradient-to-r from-[#032c21] via-[#032c21]/90 lg:via-[#032c21]/70 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-b from-[#032c21]/80 via-transparent to-[#032c21]"></div>
                    </div>
                </div>

                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-10 sm:py-16 lg:py-20">
                    <div class="max-w-xl pr-0 sm:pr-8">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-2.5 sm:mb-4">
                            {!! nl2br(e($settings['home_slide3_title'] ?? "Percetakan Cepat,\nHarga Bersahabat")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide3_highlight'] ?? '& Presisi' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-5 sm:mb-7 max-w-md line-clamp-3 sm:line-clamp-none">
                            {{ $settings['home_slide3_desc'] ?? 'Mencetak majalah, prosiding, buletin, modul ajar, dan kebutuhan cetak custom institusi dengan teknologi modern dan ketepatan waktu.' }}
                        </p>

                        <div class="flex items-center gap-2.5 sm:gap-3 mb-2 sm:mb-6">
                            <a href="{{ $settings['home_slide3_btn1_url'] ?? '/katalog' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-extrabold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-sm text-[11px] sm:text-xs tracking-wider uppercase transition flex items-center gap-1.5 shadow-xs">
                                <span>{{ $settings['home_slide3_btn1_text'] ?? 'ORDER SEKARANG' }}</span>
                                <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            </a>
                            <a href="{{ $settings['home_slide3_btn2_url'] ?? '/kontak' }}" class="bg-white/10 hover:bg-white/20 text-white font-bold px-3.5 sm:px-5 py-2 sm:py-2.5 rounded-sm border border-white/30 text-[11px] sm:text-xs tracking-wider uppercase transition flex items-center gap-1.5">
                                <span>{{ $settings['home_slide3_btn2_text'] ?? 'HUBUNGI KAMI' }}</span>
                                <i class="fa-brands fa-whatsapp text-xs text-lime-400"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left & Right Arrow Navigation (Visible on Desktop / Tablet, clean safe bounds) -->
            <button id="slider-prev" aria-label="Slide Sebelumnya" class="hidden sm:flex absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 z-30 w-9 h-9 rounded-full bg-black/60 hover:bg-black/90 text-white items-center justify-center transition border border-white/20 shadow-md cursor-pointer">
                <i class="fa-solid fa-chevron-left text-xs"></i>
            </button>

            <button id="slider-next" aria-label="Slide Selanjutnya" class="hidden sm:flex absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 z-30 w-9 h-9 rounded-full bg-black/60 hover:bg-black/90 text-white items-center justify-center transition border border-white/20 shadow-md cursor-pointer">
                <i class="fa-solid fa-chevron-right text-xs"></i>
            </button>

            <!-- Slide Dots Indicators (Clean Position at Bottom Left) -->
            <div class="absolute bottom-4 sm:bottom-6 left-4 sm:left-6 lg:left-8 z-30 max-w-7xl mx-auto flex items-center gap-2">
                <button class="dot-indicator w-6 h-2 rounded-full bg-lime-400 transition-all duration-300 cursor-pointer" data-slide="0" aria-label="Slide 1"></button>
                <button class="dot-indicator w-2 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="1" aria-label="Slide 2"></button>
                <button class="dot-indicator w-2 h-2 rounded-full bg-white/40 hover:bg-white/70 transition-all duration-300 cursor-pointer" data-slide="2" aria-label="Slide 3"></button>
            </div>

            <!-- 4 Keunggulan Desktop (Floating Bottom Right Bar) -->
            <div class="hidden lg:block absolute bottom-6 right-8 xl:right-16 z-30 max-w-3xl w-full">
                <div class="bg-white rounded-sm border border-slate-200 shadow-md px-6 py-4 text-slate-800">
                    <div class="grid grid-cols-4 gap-4 divide-x divide-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat1_title'] ?? 'Kualitas Terbaik' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat1_desc'] ?? 'Hasil cetak tajam, warna akurat' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat2_title'] ?? 'Pelayanan Cepat' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat2_desc'] ?? 'Proses produksi tepat waktu' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900 leading-tight">{{ $settings['home_feat3_title'] ?? 'Harga Bersahabat' }}</h4>
                                <p class="text-[10px] text-slate-500 mt-0.5 leading-tight">{{ $settings['home_feat3_desc'] ?? 'Harga kompetitif & transparan' }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pl-4">
                            <div class="w-9 h-9 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
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
    </section>

    <!-- 4 Keunggulan Mobile & Tablet (Dedicated Clean Section, No Overlap) -->
    <section class="lg:hidden bg-slate-50 border-b border-slate-200/90 py-4 sm:py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 gap-2.5 sm:gap-3">
                <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-[11px] text-slate-900 leading-tight truncate">{{ $settings['home_feat1_title'] ?? 'Kualitas Terbaik' }}</h4>
                        <p class="text-[9px] text-slate-500 mt-0.5 truncate">{{ $settings['home_feat1_desc'] ?? 'Hasil cetak tajam' }}</p>
                    </div>
                </div>

                <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-[11px] text-slate-900 leading-tight truncate">{{ $settings['home_feat2_title'] ?? 'Pelayanan Cepat' }}</h4>
                        <p class="text-[9px] text-slate-500 mt-0.5 truncate">{{ $settings['home_feat2_desc'] ?? 'Proses tepat waktu' }}</p>
                    </div>
                </div>

                <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-[11px] text-slate-900 leading-tight truncate">{{ $settings['home_feat3_title'] ?? 'Harga Bersahabat' }}</h4>
                        <p class="text-[9px] text-slate-500 mt-0.5 truncate">{{ $settings['home_feat3_desc'] ?? 'Harga transparan' }}</p>
                    </div>
                </div>

                <div class="bg-white p-3 rounded-sm border border-slate-200 shadow-2xs flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-[11px] text-slate-900 leading-tight truncate">{{ $settings['home_feat4_title'] ?? 'Berpengalaman' }}</h4>
                        <p class="text-[9px] text-slate-500 mt-0.5 truncate">{{ $settings['home_feat4_desc'] ?? 'Tim profesional' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Layanan Kami (Dynamic, Mobile-Optimized Grid) -->
    <section id="layanan" class="py-10 sm:py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-7 sm:mb-10">
                <span class="text-brand-800 font-bold text-[10px] sm:text-[11px] uppercase tracking-widest block mb-1">{{ $settings['home_services_badge'] ?? 'LAYANAN KAMI' }}</span>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-slate-900 leading-tight">{{ $settings['home_services_title'] ?? 'Solusi Lengkap Untuk Kebutuhan Anda' }}</h3>
                <div class="w-10 h-1 bg-emerald-700 mx-auto mt-2 rounded-full"></div>
            </div>

            <!-- Dynamic Services Cards: 2-Cols on Mobile, 3-Cols on Tablet, 6-Cols on Desktop -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-{{ count($services) <= 4 ? count($services) : (count($services) == 5 ? '5' : '6') }} gap-3 sm:gap-4">
                @foreach($services as $srv)
                    <div class="bg-white p-3.5 sm:p-5 rounded-sm border border-slate-200 hover:border-emerald-700 hover:shadow-md transition-all duration-200 flex flex-col justify-between shadow-2xs group">
                        <div>
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-3.5 group-hover:bg-emerald-700 group-hover:text-white transition-colors duration-200">
                                <i class="{{ $srv['icon'] ?? 'fa-solid fa-circle-check' }}"></i>
                            </div>
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900 mb-1 sm:mb-1.5 leading-snug group-hover:text-emerald-800 transition-colors">{{ $srv['title'] ?? 'Layanan' }}</h4>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 leading-relaxed mb-3 sm:mb-4 line-clamp-3 sm:line-clamp-none">
                                {{ $srv['desc'] ?? '' }}
                            </p>
                        </div>
                        <a href="{{ $srv['link'] ?? '/kontak' }}" class="text-[10px] sm:text-[11px] font-bold text-emerald-700 hover:text-emerald-950 inline-flex items-center gap-1 mt-auto pt-2 border-t border-slate-100">
                            <span>Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-[8px] sm:text-[9px] group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section 3 Kolom: Tentang Kami, Proses Kami, Produk Terbaru dari Katalog -->
    <section class="py-10 sm:py-12 bg-slate-50 border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-6 items-stretch">
                
                <!-- Kolom 1: Tentang Kami -->
                <div id="tentang" class="lg:col-span-4 bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[9.5px] sm:text-[10px] uppercase tracking-widest block mb-1">TENTANG KAMI</span>
                        <h4 class="font-extrabold text-sm sm:text-base text-slate-900 mb-2.5 sm:mb-3">{{ $settings['home_about_title'] ?? 'PERSIS PERS' }}</h4>
                        
                        <div class="grid grid-cols-12 gap-3 items-center mb-3 sm:mb-4">
                            <div class="col-span-7 sm:col-span-8 text-[11px] sm:text-xs text-slate-600 leading-relaxed">
                                {{ $settings['home_about_desc'] ?? 'Merupakan unit layanan Penerbitan dan Percetakan yang berkomitmen mendukung penyebaran ilmu pengetahuan dan karya berkualitas bagi akademisi dan masyarakat.' }}
                            </div>
                            <div class="col-span-5 sm:col-span-4 h-24 sm:h-28 rounded-xs overflow-hidden bg-slate-100 border border-slate-200">
                                <img 
                                    src="{{ $settings['home_about_image'] ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=400&auto=format&fit=crop' }}" 
                                    alt="Kantor Redaksi Persis Pers" 
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('tentang') }}" class="inline-flex items-center justify-center gap-1.5 px-3.5 sm:px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition w-fit shadow-2xs">
                        <span>Selengkapnya</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <!-- Kolom 2: Proses Kami -->
                <div class="lg:col-span-4 bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <span class="text-brand-800 font-bold text-[9.5px] sm:text-[10px] uppercase tracking-widest block mb-1">PROSES KAMI</span>
                        <h4 class="font-extrabold text-sm sm:text-base text-slate-900 mb-3 sm:mb-4">{{ $settings['home_process_title'] ?? 'Proses Produksi Profesional' }}</h4>
                        
                        <!-- Responsive Process Stepper -->
                        <div class="grid grid-cols-6 gap-1 py-1 sm:py-2 items-center text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-800 text-white flex items-center justify-center text-[10px] sm:text-xs mb-1 shadow-2xs">
                                    <i class="fa-solid fa-comments"></i>
                                </div>
                                <span class="text-[8px] sm:text-[9px] font-semibold text-slate-700 leading-tight">Konsultasi</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-[10px] sm:text-xs mb-1">
                                    <i class="fa-solid fa-pen-nib"></i>
                                </div>
                                <span class="text-[8px] sm:text-[9px] font-semibold text-slate-700 leading-tight">Desain</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-[10px] sm:text-xs mb-1">
                                    <i class="fa-solid fa-desktop"></i>
                                </div>
                                <span class="text-[8px] sm:text-[9px] font-semibold text-slate-700 leading-tight">Prepress</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-[10px] sm:text-xs mb-1">
                                    <i class="fa-solid fa-gear"></i>
                                </div>
                                <span class="text-[8px] sm:text-[9px] font-semibold text-slate-700 leading-tight">Produksi</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-[10px] sm:text-xs mb-1">
                                    <i class="fa-regular fa-file-lines"></i>
                                </div>
                                <span class="text-[8px] sm:text-[9px] font-semibold text-slate-700 leading-tight">Finishing</span>
                            </div>

                            <div class="flex flex-col items-center">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-[10px] sm:text-xs mb-1">
                                    <i class="fa-solid fa-truck-fast"></i>
                                </div>
                                <span class="text-[8px] sm:text-[9px] font-semibold text-slate-700 leading-tight">Kirim</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 sm:pt-4 border-t border-slate-100 text-[10.5px] sm:text-[11px] text-slate-500">
                        {{ $settings['home_process_desc'] ?? 'Didukung peralatan modern & pengawasan mutu di setiap tahap produksi.' }}
                    </div>
                </div>

                <!-- Kolom 3: Katalog Buku Terbaru -->
                <div id="katalog" class="lg:col-span-4 bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-brand-800 font-bold text-[9.5px] sm:text-[10px] uppercase tracking-widest block">PRODUK TERBARU</span>
                            <span class="text-[9px] text-emerald-700 font-mono font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs border border-emerald-200">Koleksi Terkini</span>
                        </div>
                        <h4 class="font-extrabold text-sm sm:text-base text-slate-900 mb-2.5 sm:mb-3">Katalog Buku Terbaru</h4>
                        
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            @forelse($featuredBooks as $fb)
                                <a href="{{ route('katalog') }}" class="group aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden shadow-2xs border border-slate-300/80 relative block hover:-translate-y-1 hover:shadow-md transition-all duration-300" title="{{ $fb->title }}">
                                    @if($fb->cover_image && (file_exists(public_path('storage/' . $fb->cover_image)) || file_exists(public_path('images/' . $fb->cover_image))))
                                        <img src="{{ file_exists(public_path('storage/' . $fb->cover_image)) ? asset('storage/' . $fb->cover_image) : asset('images/' . $fb->cover_image) }}" alt="{{ $fb->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                    @else
                                        <div class="w-full h-full bg-[#032c21] p-1 sm:p-1.5 flex flex-col justify-between text-white select-none border-l-2 border-emerald-500/40">
                                            <span class="text-[6px] text-emerald-300 font-bold truncate">PERSIS</span>
                                            <span class="font-black line-clamp-3 leading-tight text-[6px] sm:text-[6.5px] text-slate-100">{{ $fb->title }}</span>
                                            <span class="text-[5px] sm:text-[5.5px] text-slate-400 truncate">{{ $fb->author }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex flex-col justify-end p-1 select-none">
                                        <span class="text-[6px] font-mono font-bold text-lime-300 truncate">{{ $fb->price ? 'Rp '.number_format((float)preg_replace('/[^0-9]/', '', $fb->price), 0, ',', '.') : 'Lihat Buku' }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="col-span-4 py-4 text-center text-slate-400 text-xs">
                                    Belum ada buku terbit.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <a href="{{ route('katalog') }}" class="text-[11px] font-bold text-emerald-800 hover:text-emerald-950 inline-flex items-center gap-1 mt-2 group">
                        <span>Buka Katalog Lengkap</span>
                        <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mini Footer Bottom -->
    <footer class="bg-brand-950 border-t border-brand-900/60 py-4 text-center text-slate-400 text-[10px] sm:text-[11px] px-4">
        <div class="max-w-7xl mx-auto">
            &copy; {{ date('Y') }} PERSIS PERS - Penerbitan & Percetakan IAI PERSIS Bandung. All rights reserved.
        </div>
    </footer>
@endsection

@push('scripts')
<script>
    (function() {
        function initHeroSlider() {
            const slides = document.querySelectorAll('#hero-slider .slide');
            const dots = document.querySelectorAll('#hero-slider .dot-indicator');
            const prevBtn = document.getElementById('slider-prev');
            const nextBtn = document.getElementById('slider-next');
            const sliderContainer = document.getElementById('hero-slider');
            
            if (!slides || slides.length === 0) return;

            let currentIndex = 0;
            let slideInterval = null;

            function showSlide(index) {
                if (index >= slides.length) index = 0;
                if (index < 0) index = slides.length - 1;
                currentIndex = index;

                slides.forEach((slide, i) => {
                    if (i === currentIndex) {
                        slide.style.display = 'block';
                        slide.style.opacity = '1';
                        slide.style.zIndex = '10';
                        slide.classList.remove('hidden', 'opacity-0', 'z-0');
                        slide.classList.add('block', 'opacity-100', 'z-10');
                    } else {
                        slide.style.display = 'none';
                        slide.style.opacity = '0';
                        slide.style.zIndex = '0';
                        slide.classList.remove('block', 'opacity-100', 'z-10');
                        slide.classList.add('hidden', 'opacity-0', 'z-0');
                    }
                });

                dots.forEach((dot, i) => {
                    if (i === currentIndex) {
                        dot.classList.remove('bg-white/40');
                        dot.classList.add('bg-lime-400', 'w-6');
                        dot.classList.remove('w-2');
                    } else {
                        dot.classList.remove('bg-lime-400', 'w-6');
                        dot.classList.add('bg-white/40', 'w-2');
                    }
                });
            }

            function nextSlide() {
                showSlide(currentIndex + 1);
            }

            function prevSlide() {
                showSlide(currentIndex - 1);
            }

            function startTimer() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            }

            function resetTimer() {
                clearInterval(slideInterval);
                startTimer();
            }

            if (nextBtn) {
                nextBtn.onclick = function(e) {
                    if (e) e.preventDefault();
                    nextSlide();
                    resetTimer();
                };
            }

            if (prevBtn) {
                prevBtn.onclick = function(e) {
                    if (e) e.preventDefault();
                    prevSlide();
                    resetTimer();
                };
            }

            dots.forEach(dot => {
                dot.onclick = function(e) {
                    if (e) e.preventDefault();
                    const idx = parseInt(this.getAttribute('data-slide'));
                    showSlide(idx);
                    resetTimer();
                };
            });

            // Touch Swipe Support for Mobile Devices
            let touchStartX = 0;
            let touchEndX = 0;

            if (sliderContainer) {
                sliderContainer.addEventListener('touchstart', function(e) {
                    touchStartX = e.changedTouches[0].screenX;
                    clearInterval(slideInterval);
                }, { passive: true });

                sliderContainer.addEventListener('touchend', function(e) {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                    startTimer();
                }, { passive: true });

                sliderContainer.onmouseenter = function() { clearInterval(slideInterval); };
                sliderContainer.onmouseleave = function() { startTimer(); };
            }

            function handleSwipe() {
                const threshold = 40;
                if (touchEndX < touchStartX - threshold) {
                    nextSlide();
                } else if (touchEndX > touchStartX + threshold) {
                    prevSlide();
                }
            }

            showSlide(0);
            startTimer();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initHeroSlider);
        } else {
            initHeroSlider();
        }
    })();
</script>
@endpush
