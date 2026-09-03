@extends('layouts.app')

@section('title', 'PERSIS PERS | Penerbitan & Percetakan')

@section('content')
    <!-- Hero Slider Section (Seamless, Premium Full-Width Banner with Elegant Typography) -->
    <section class="relative bg-brand-950 bg-[#032c21] text-white overflow-hidden select-none">
        
        <!-- Slider Container -->
        <div id="hero-slider" class="relative w-full min-h-[380px] sm:min-h-[460px] md:min-h-[500px] lg:min-h-[540px] xl:min-h-[580px] flex items-center overflow-hidden">
            
            @foreach($slides as $index => $slide)
                @php
                    $isClean = ($slide['type'] ?? 'standard') === 'clean' || (empty($slide['title']) && empty($slide['desc']));
                    $fitMode = $slide['fit'] ?? ($isClean ? 'contain' : 'cover');
                @endphp
                <div class="slide absolute inset-0 transition-opacity duration-500 ease-in-out {{ $index === 0 ? 'opacity-100 z-10 block' : 'opacity-0 z-0 hidden' }}" data-index="{{ $index }}">
                    
                    @if($fitMode === 'contain')
                        <!-- Ambient Blurred Backdrop for seamless 100% full look -->
                        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none bg-[#032c21]">
                            <img 
                                src="{{ $slide['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" 
                                alt="" 
                                class="w-full h-full object-cover blur-2xl opacity-40 scale-110"
                                aria-hidden="true"
                            />
                        </div>
                        <!-- 100% Complete Image (No-Crop) -->
                        <div class="absolute inset-0 z-1 w-full h-full flex items-center justify-center">
                            <img 
                                src="{{ $slide['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" 
                                alt="Banner Slide {{ $index + 1 }}" 
                                class="w-full h-full object-contain object-center"
                            />
                        </div>
                    @else
                        <!-- 100% Full Width & Full Height Background Image (Cover Mode) -->
                        <div class="absolute inset-0 z-0 w-full h-full">
                            <img 
                                src="{{ $slide['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop' }}" 
                                alt="Banner Slide {{ $index + 1 }}" 
                                class="w-full h-full object-cover object-center"
                            />
                            @if(!$isClean)
                                <!-- Seamless Ambient Gradient for Text Mode -->
                                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/35 lg:via-black/20 to-transparent pointer-events-none"></div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none"></div>
                            @endif
                        </div>
                    @endif

                    @if($isClean)
                        <!-- Clean Banner Mode: Only sleek bottom CTA buttons if filled -->
                        @if(!empty(trim($slide['btn1_text'] ?? '')) || !empty(trim($slide['btn2_text'] ?? '')))
                        <div class="absolute inset-0 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-end pb-8 sm:pb-12 pointer-events-none">
                            <div class="flex items-center gap-3 pointer-events-auto flex-wrap">
                                @if(!empty(trim($slide['btn1_text'] ?? '')))
                                    <a href="{{ $slide['btn1_url'] ?? '#layanan' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-extrabold px-4 sm:px-5 py-2.5 rounded-sm text-xs tracking-wider uppercase transition flex items-center gap-1.5 shadow-xl transform hover:-translate-y-0.5">
                                        <span>{{ $slide['btn1_text'] }}</span>
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                @endif
                                @if(!empty(trim($slide['btn2_text'] ?? '')))
                                    <a href="{{ $slide['btn2_url'] ?? '/kontak' }}" class="bg-black/70 hover:bg-black/90 text-white font-bold px-4 sm:px-5 py-2.5 rounded-sm border border-white/40 text-xs tracking-wider uppercase transition flex items-center gap-1.5 backdrop-blur-md shadow-xl transform hover:-translate-y-0.5">
                                        <span>{{ $slide['btn2_text'] }}</span>
                                        <i class="fa-brands fa-whatsapp text-xs text-lime-400"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    @else
                        <!-- Text Content Mode -->
                        @if(!empty($slide['title']) && trim($slide['title']) !== '')
                        <div class="absolute inset-0 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-center py-10 sm:py-16">
                            <div class="max-w-lg lg:max-w-xl">
                                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight mb-2.5 sm:mb-3 [text-shadow:_0_2px_12px_rgba(0,0,0,0.7)]">
                                    {!! nl2br(e($slide['title'])) !!}<br>
                                    @if(!empty($slide['highlight']))
                                        <span class="text-lime-400 font-black">{{ $slide['highlight'] }}</span>
                                    @endif
                                </h2>
                                
                                @if(!empty($slide['desc']))
                                    <p class="text-xs sm:text-sm text-slate-100/95 leading-relaxed mb-5 sm:mb-6 max-w-md [text-shadow:_0_1px_8px_rgba(0,0,0,0.7)]">
                                        {{ $slide['desc'] }}
                                    </p>
                                @endif

                                <div class="flex items-center gap-3 flex-wrap">
                                    @if(!empty($slide['btn1_text']))
                                        <a href="{{ $slide['btn1_url'] ?? '#layanan' }}" class="bg-lime-500 hover:bg-lime-600 text-brand-950 font-extrabold px-4 sm:px-5 py-2 sm:py-2.5 rounded-sm text-xs tracking-wider uppercase transition flex items-center gap-1.5 shadow-lg transform hover:-translate-y-0.5">
                                            <span>{{ $slide['btn1_text'] }}</span>
                                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </a>
                                    @endif
                                    @if(!empty($slide['btn2_text']))
                                        <a href="{{ $slide['btn2_url'] ?? '/katalog' }}" class="bg-black/30 hover:bg-black/50 text-white font-bold px-4 sm:px-5 py-2 sm:py-2.5 rounded-sm border border-white/40 text-xs tracking-wider uppercase transition flex items-center gap-1.5 backdrop-blur-xs shadow-lg transform hover:-translate-y-0.5">
                                            <span>{{ $slide['btn2_text'] }}</span>
                                            <i class="fa-solid fa-book-open text-[10px]"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            @endforeach

            @if(count($slides) > 1)
                <!-- Left & Right Arrow Navigation -->
                <button id="slider-prev" aria-label="Slide Sebelumnya" class="hidden sm:flex absolute left-3 sm:left-4 top-1/2 -translate-y-1/2 z-30 w-9 h-9 rounded-full bg-black/60 hover:bg-black/90 text-white items-center justify-center transition border border-white/20 shadow-md cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>

                <button id="slider-next" aria-label="Slide Selanjutnya" class="hidden sm:flex absolute right-3 sm:right-4 top-1/2 -translate-y-1/2 z-30 w-9 h-9 rounded-full bg-black/60 hover:bg-black/90 text-white items-center justify-center transition border border-white/20 shadow-md cursor-pointer">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>

                <!-- Slide Dots Indicators (Clean Position at Bottom Left) -->
                <div class="absolute bottom-4 left-4 sm:left-6 lg:left-8 z-30 flex items-center gap-2">
                    @foreach($slides as $index => $slide)
                        <button class="dot-indicator {{ $index === 0 ? 'w-6 bg-lime-400' : 'w-2 bg-white/40 hover:bg-white/70' }} h-2 rounded-full transition-all duration-300 cursor-pointer" data-slide="{{ $index }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif

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
                    @php
                        $srvTitle = is_object($srv) ? $srv->title : ($srv['title'] ?? 'Layanan');
                        $srvIcon = is_object($srv) ? $srv->icon : ($srv['icon'] ?? 'fa-solid fa-circle-check');
                        $srvDesc = is_object($srv) ? $srv->short_desc : ($srv['desc'] ?? ($srv['short_desc'] ?? ''));
                        $srvSlug = is_object($srv) ? $srv->slug : ($srv['slug'] ?? null);
                        $srvUrl = $srvSlug ? route('layanan.show', $srvSlug) : ($srv['link'] ?? route('kontak'));
                    @endphp
                    <div class="bg-white p-3.5 sm:p-5 rounded-sm border border-slate-200 hover:border-emerald-700 hover:shadow-md transition-all duration-200 flex flex-col justify-between shadow-2xs group">
                        <div>
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xs bg-emerald-50 text-emerald-700 flex items-center justify-center text-base sm:text-xl mb-2.5 sm:mb-3.5 group-hover:bg-emerald-700 group-hover:text-white transition-colors duration-200">
                                <i class="{{ $srvIcon }}"></i>
                            </div>
                            <h4 class="font-bold text-xs sm:text-sm text-slate-900 mb-1 sm:mb-1.5 leading-snug group-hover:text-emerald-800 transition-colors">
                                <a href="{{ $srvUrl }}" class="hover:underline">{{ $srvTitle }}</a>
                            </h4>
                            <p class="text-[10px] sm:text-[11px] text-slate-500 leading-relaxed mb-3 sm:mb-4 line-clamp-3 sm:line-clamp-none">
                                {{ $srvDesc }}
                            </p>
                        </div>
                        <a href="{{ $srvUrl }}" class="text-[10px] sm:text-[11px] font-bold text-emerald-700 hover:text-emerald-950 inline-flex items-center gap-1 mt-auto pt-2 border-t border-slate-100">
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

                <!-- Kolom 2: Cara Pemesanan & Alur Transaksi Buku (Balanced & Clean) -->
                <div class="lg:col-span-4 bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-brand-800 font-bold text-[9.5px] sm:text-[10px] uppercase tracking-widest block">CARA PEMESANAN</span>
                            <span class="text-[9px] text-emerald-800 font-mono font-bold bg-emerald-50 px-1.5 py-0.5 rounded-xs border border-emerald-200">6 Langkah Mudah</span>
                        </div>
                        <h4 class="font-extrabold text-sm sm:text-base text-slate-900 mb-2.5 sm:mb-3">
                            Alur Pemesanan &amp; Transaksi Buku
                        </h4>
                        
                        <!-- 6 Steps (Clean 2 Rows x 3 Cols Grid, Balanced Proportions) -->
                        <div class="grid grid-cols-3 gap-2 sm:gap-2.5 mb-3 sm:mb-4">
                            
                            <!-- 1. Pilih Buku -->
                            <div class="p-2 sm:p-2.5 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group shadow-2xs">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-[#006830] text-white flex items-center justify-center text-xs mb-1 shadow-2xs group-hover:scale-105 transition">
                                    <i class="fa-solid fa-book-open text-lime-300"></i>
                                </div>
                                <span class="text-[10px] sm:text-[11px] font-bold text-slate-900 leading-tight">1. Pilih Buku</span>
                                <span class="text-[8px] sm:text-[9px] text-slate-500 leading-none mt-0.5">Lihat Katalog</span>
                            </div>

                            <!-- 2. Keranjang -->
                            <div class="p-2 sm:p-2.5 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group shadow-2xs">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1 group-hover:bg-emerald-700 group-hover:text-white transition">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                                <span class="text-[10px] sm:text-[11px] font-bold text-slate-900 leading-tight">2. Keranjang</span>
                                <span class="text-[8px] sm:text-[9px] text-slate-500 leading-none mt-0.5">Atur Jumlah</span>
                            </div>

                            <!-- 3. Checkout -->
                            <div class="p-2 sm:p-2.5 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group shadow-2xs">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1 group-hover:bg-emerald-700 group-hover:text-white transition">
                                    <i class="fa-solid fa-file-invoice"></i>
                                </div>
                                <span class="text-[10px] sm:text-[11px] font-bold text-slate-900 leading-tight">3. Checkout</span>
                                <span class="text-[8px] sm:text-[9px] text-slate-500 leading-none mt-0.5">Isi Alamat</span>
                            </div>

                            <!-- 4. Bayar QRIS -->
                            <div class="p-2 sm:p-2.5 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group shadow-2xs">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1 group-hover:bg-emerald-700 group-hover:text-white transition">
                                    <i class="fa-solid fa-qrcode"></i>
                                </div>
                                <span class="text-[10px] sm:text-[11px] font-bold text-slate-900 leading-tight">4. Bayar</span>
                                <span class="text-[8px] sm:text-[9px] text-slate-500 leading-none mt-0.5">QRIS Instan</span>
                            </div>

                            <!-- 5. Packing -->
                            <div class="p-2 sm:p-2.5 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group shadow-2xs">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1 group-hover:bg-emerald-700 group-hover:text-white transition">
                                    <i class="fa-solid fa-box-archive"></i>
                                </div>
                                <span class="text-[10px] sm:text-[11px] font-bold text-slate-900 leading-tight">5. Packing</span>
                                <span class="text-[8px] sm:text-[9px] text-slate-500 leading-none mt-0.5">Kemas Rapi</span>
                            </div>

                            <!-- 6. Kirim -->
                            <div class="p-2 sm:p-2.5 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group shadow-2xs">
                                <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xs bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1 group-hover:bg-emerald-700 group-hover:text-white transition">
                                    <i class="fa-solid fa-truck-fast"></i>
                                </div>
                                <span class="text-[10px] sm:text-[11px] font-bold text-slate-900 leading-tight">6. Kirim</span>
                                <span class="text-[8px] sm:text-[9px] text-slate-500 leading-none mt-0.5">Resi Terlacak</span>
                            </div>

                        </div>
                    </div>

                    <!-- Bottom Action & Info (Symmetrical with Kolom 1 & 3) -->
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                        <span class="text-[10.5px] text-slate-500 leading-tight">
                            Pesan buku praktis &amp; bayar via QRIS.
                        </span>
                        <a href="{{ route('katalog') }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold transition shrink-0 shadow-2xs">
                            <span>Pesan Buku</span>
                            <i class="fa-solid fa-cart-shopping text-[9px] text-lime-300"></i>
                        </a>
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
