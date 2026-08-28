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
                            {!! nl2br(e($settings['home_slide1_title'] ?? "Melayani Penerbitan\ndan Percetakan")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide1_highlight'] ?? 'Berkualitas' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            {{ $settings['home_slide1_desc'] ?? 'Persis Pers hadir untuk mendukung kebutuhan penerbitan buku...' }}
                        </p>

                        <div class="flex items-center gap-3 mb-6">
                            <a href="{{ $settings['home_slide1_btn1_url'] ?? '#layanan' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-5 py-2.5 rounded-sm text-xs tracking-wider uppercase transition flex items-center gap-2 shadow-xs">
                                {{ $settings['home_slide1_btn1_text'] ?? 'LIHAT LAYANAN' }} <i class="fa-solid fa-arrow-right text-[11px]"></i>
                            </a>
                            <a href="{{ $settings['home_slide1_btn2_url'] ?? '/katalog' }}" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-5 py-2.5 rounded-sm border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                                {{ $settings['home_slide1_btn2_text'] ?? 'KATALOG BUKU' }} <i class="fa-solid fa-book-open text-xs"></i>
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
                            {!! nl2br(e($settings['home_slide2_title'] ?? "Penerbitan Buku\nBer-ISBN Resmi")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide2_highlight'] ?? '& Terindeks' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            {{ $settings['home_slide2_desc'] ?? 'Dukung publikasi karya ilmiah...' }}
                        </p>

                        <div class="flex items-center gap-3 mb-6">
                            <a href="{{ $settings['home_slide2_btn1_url'] ?? '/kontak' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-5 py-2.5 rounded-sm text-xs tracking-wider uppercase transition flex items-center gap-2 shadow-xs">
                                {{ $settings['home_slide2_btn1_text'] ?? 'AJUKAN NASKAH' }} <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                            </a>
                            <a href="{{ $settings['home_slide2_btn2_url'] ?? '#layanan' }}" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-5 py-2.5 rounded-sm border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                                {{ $settings['home_slide2_btn2_text'] ?? 'PANDUAN PENULIS' }} <i class="fa-solid fa-file-lines text-xs"></i>
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
                            {!! nl2br(e($settings['home_slide3_title'] ?? "Percetakan Cepat,\nHarga Bersahabat")) !!}<br>
                            <span class="text-lime-400">{{ $settings['home_slide3_highlight'] ?? '& Presisi' }}</span>
                        </h2>
                        
                        <p class="text-xs sm:text-sm text-slate-200/90 leading-relaxed mb-7 max-w-md">
                            {{ $settings['home_slide3_desc'] ?? 'Mencetak majalah, prosiding...' }}
                        </p>

                        <div class="flex items-center gap-3 mb-6">
                            <a href="{{ $settings['home_slide3_btn1_url'] ?? '/katalog' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-bold px-5 py-2.5 rounded-sm text-xs tracking-wider uppercase transition flex items-center gap-2 shadow-xs">
                                {{ $settings['home_slide3_btn1_text'] ?? 'ORDER SEKARANG' }} <i class="fa-solid fa-cart-shopping text-xs"></i>
                            </a>
                            <a href="{{ $settings['home_slide3_btn2_url'] ?? '/kontak' }}" class="bg-brand-950/80 hover:bg-brand-900 text-white font-semibold px-5 py-2.5 rounded-sm border border-white/30 text-xs tracking-wider uppercase transition flex items-center gap-2">
                                {{ $settings['home_slide3_btn2_text'] ?? 'HUBUNGI KAMI' }} <i class="fa-brands fa-whatsapp text-xs text-lime-400"></i>
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

            <!-- Slide Dots Indicators -->
            <div class="absolute bottom-6 sm:bottom-8 left-4 sm:left-6 lg:left-8 z-30 max-w-7xl mx-auto w-full flex items-center gap-2 pl-4 sm:pl-6 lg:pl-8">
                <button class="dot-indicator w-6 h-2.5 rounded-full bg-lime-400 transition-all duration-300 cursor-pointer" data-slide="0" aria-label="Slide 1"></button>
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
                            <h4 class="font-bold text-xs text-slate-900">{{ $settings['home_feat1_title'] ?? 'Kualitas Terbaik' }}</h4>
                            <p class="text-[10px] text-slate-500">{{ $settings['home_feat1_desc'] ?? 'Hasil cetak tajam, warna akurat' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-3 sm:pt-0 sm:px-2">
                        <div class="w-9 h-9 rounded-md bg-emerald-50 text-emerald-700 flex items-center justify-center text-base shrink-0">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-xs text-slate-900">{{ $settings['home_feat2_title'] ?? 'Pelayanan Cepat' }}</h4>
                            <p class="text-[10px] text-slate-500">{{ $settings['home_feat2_desc'] ?? 'Proses produksi tepat waktu' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Layanan Kami (Dinamis dari Settings) -->
    <section id="layanan" class="py-14 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-brand-800 font-bold text-[11px] uppercase tracking-widest block mb-1">{{ $settings['home_services_badge'] ?? 'LAYANAN KAMI' }}</span>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $settings['home_services_title'] ?? 'Solusi Lengkap Untuk Kebutuhan Anda' }}</h3>
                <div class="w-10 h-1 bg-brand-800 mx-auto mt-2.5 rounded-full"></div>
            </div>

            <!-- Dynamic Services Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-{{ count($services) <= 4 ? count($services) : (count($services) == 5 ? '5' : '6') }} gap-4">
                @foreach($services as $srv)
                    <div class="bg-white p-5 rounded-sm border border-slate-200 hover:border-emerald-700 hover:shadow-md transition-all duration-200 flex flex-col justify-between shadow-2xs group">
                        <div>
                            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mb-3.5 group-hover:bg-emerald-700 group-hover:text-white transition-colors duration-200">
                                <i class="{{ $srv['icon'] ?? 'fa-solid fa-circle-check' }}"></i>
                            </div>
                            <h4 class="font-bold text-sm text-slate-900 mb-1.5 leading-snug group-hover:text-emerald-800 transition-colors">{{ $srv['title'] ?? 'Layanan' }}</h4>
                            <p class="text-[11px] text-slate-500 leading-relaxed mb-4">
                                {{ $srv['desc'] ?? '' }}
                            </p>
                        </div>
                        <a href="{{ $srv['link'] ?? '/kontak' }}" class="text-[11px] font-bold text-emerald-700 hover:text-emerald-950 inline-flex items-center gap-1 mt-auto pt-2 border-t border-slate-100">
                            <span>Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-[9px] group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                @endforeach
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

                <!-- Kolom 3: Katalog Buku Terbaru (ELEGANT BOOK SHOWCASE & POLISHED HOVER ANIMATION) -->
                <div id="katalog" class="lg:col-span-4 bg-white p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-brand-800 font-bold text-[10px] uppercase tracking-widest block">PRODUK TERBARU</span>
                            <span class="text-[9px] text-emerald-700 font-mono font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs border border-emerald-200">Koleksi Terkini</span>
                        </div>
                        <h4 class="font-extrabold text-base text-slate-900 mb-3">Katalog Buku Terbaru</h4>
                        
                        <div class="grid grid-cols-4 gap-2 mb-3">
                            @forelse($featuredBooks as $fb)
                                <a href="{{ route('katalog') }}" class="group aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden shadow-2xs border border-slate-300/80 relative block hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300" title="{{ $fb->title }}">
                                    @if($fb->cover_image && (file_exists(public_path('storage/' . $fb->cover_image)) || file_exists(public_path('images/' . $fb->cover_image))))
                                        <img src="{{ file_exists(public_path('storage/' . $fb->cover_image)) ? asset('storage/' . $fb->cover_image) : asset('images/' . $fb->cover_image) }}" alt="{{ $fb->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                    @else
                                        <div class="w-full h-full bg-[#032c21] p-1.5 flex flex-col justify-between text-white select-none border-l-2 border-emerald-500/40">
                                            <span class="text-[6px] text-emerald-300 font-bold truncate">PERSIS</span>
                                            <span class="font-black line-clamp-3 leading-tight text-[6.5px] text-slate-100">{{ $fb->title }}</span>
                                            <span class="text-[5.5px] text-slate-400 truncate">{{ $fb->author }}</span>
                                        </div>
                                    @endif
                                    
                                    <!-- Sleek Overlay with Bookpaper/Action Badge on Hover -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex flex-col justify-end p-1 select-none">
                                        <span class="text-[6px] font-mono font-bold text-lime-300 truncate">{{ $fb->price ? 'Rp '.number_format((float)preg_replace('/[^0-9]/', '', $fb->price), 0, ',', '.') : 'Lihat Buku' }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="col-span-4 py-6 text-center text-slate-400 text-xs">
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
    <footer class="bg-brand-950 border-t border-brand-900/60 py-4 text-center text-slate-400 text-[11px]">
        <div class="max-w-7xl mx-auto px-4">
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
                        dot.classList.remove('w-2.5');
                    } else {
                        dot.classList.remove('bg-lime-400', 'w-6');
                        dot.classList.add('bg-white/40', 'w-2.5');
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

            if (sliderContainer) {
                sliderContainer.onmouseenter = function() { clearInterval(slideInterval); };
                sliderContainer.onmouseleave = function() { startTimer(); };
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
