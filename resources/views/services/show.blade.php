@extends('layouts.app')

@section('title', $service->title . ' - Penerbit Persis')

@section('content')
    <!-- 1. ULTRA-PREMIUM EXECUTIVE HERO BANNER -->
    <section class="relative bg-gradient-to-br from-[#02231a] via-[#032c21] to-[#043d2e] text-white pt-24 pb-12 sm:pt-28 sm:pb-16 overflow-hidden">
        <!-- Ambient Decorative Glows -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 right-0 w-96 h-96 bg-lime-500/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Subtle Pattern & Background Texture -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:20px_20px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-emerald-300/80 mb-4 sm:mb-5 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1.5">
                    <i class="fa-solid fa-house text-[10px]"></i> Beranda
                </a>
                <span class="text-emerald-500/60">/</span>
                <a href="{{ route('home') }}#layanan" class="hover:text-white transition text-emerald-300">
                    Layanan
                </a>
                <span class="text-emerald-500/60">/</span>
                <span class="text-white font-bold truncate max-w-xs">{{ $service->title }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 items-center">
                
                <!-- Left: Headline & Core Pitch -->
                <div class="lg:col-span-7 space-y-3.5 sm:space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-xs bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 text-[10px] sm:text-[11px] font-bold tracking-wider uppercase shadow-2xs">
                        <i class="{{ $service->icon }} text-lime-300"></i>
                        <span>Layanan Resmi Penerbit Persis</span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black font-heading text-white tracking-tight leading-[1.15]">
                        {{ $service->title }}
                    </h1>

                    @if($service->tagline)
                        <div class="p-2.5 sm:p-3 rounded-xs bg-white/5 border-l-3 border-lime-400 backdrop-blur-xs">
                            <p class="text-xs sm:text-sm text-emerald-100 font-medium italic">
                                {{ $service->tagline }}
                            </p>
                        </div>
                    @endif

                    <p class="text-xs sm:text-[13px] text-slate-200 leading-relaxed max-w-2xl font-sans">
                        {{ $service->short_desc }}
                    </p>

                    <!-- Interactive Action CTAs -->
                    <div class="pt-1 flex flex-wrap items-center gap-3">
                        <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-[#006830] hover:from-emerald-500 hover:to-[#024a23] text-white rounded-xs text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-md hover:shadow-emerald-900/50 border border-emerald-400/40 cursor-pointer">
                            <i class="fa-brands fa-whatsapp text-base text-lime-300"></i>
                            <span>{{ $service->cta_text ?: 'Konsultasi Sekarang' }}</span>
                        </a>

                        <a href="{{ route('kontak') }}" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xs text-xs sm:text-sm font-bold transition flex items-center gap-2 border border-white/25 backdrop-blur-xs cursor-pointer">
                            <i class="fa-regular fa-envelope text-xs"></i>
                            <span>Kirim Draf Naskah</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Compact Showcase Card -->
                <div class="lg:col-span-5">
                    <div class="relative bg-white/10 border border-white/20 rounded-sm p-5 sm:p-6 backdrop-blur-md shadow-xl">
                        
                        <!-- Top Service Badge Header -->
                        <div class="flex items-center gap-3.5 pb-4 border-b border-white/10">
                            <div class="w-11 h-11 rounded-xs bg-gradient-to-br from-lime-400 to-emerald-600 text-brand-950 flex items-center justify-center text-xl font-black shrink-0 shadow-md">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                            <div>
                                <span class="text-[9px] font-bold text-emerald-300 uppercase tracking-widest block">Unit Layanan Publikasi</span>
                                <h3 class="text-base font-bold text-white leading-snug">{{ $service->title }}</h3>
                            </div>
                        </div>

                        <!-- 3 Core Institutional Guarantees -->
                        <div class="mt-4 space-y-2.5">
                            <div class="flex items-start gap-2.5 p-2.5 rounded-xs bg-white/5 border border-white/10">
                                <div class="w-5 h-5 rounded-xs bg-emerald-500/30 text-lime-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Standar Mutu Resmi</h4>
                                    <p class="text-[10px] sm:text-[11px] text-slate-300 leading-snug mt-0.5">Dikelola langsung oleh tim editorial dan penerbitan resmi Penerbit Persis.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-2.5 p-2.5 rounded-xs bg-white/5 border border-white/10">
                                <div class="w-5 h-5 rounded-xs bg-emerald-500/30 text-lime-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-barcode text-[10px]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">ISBN &amp; Legalitas Lengkap</h4>
                                    <p class="text-[10px] sm:text-[11px] text-slate-300 leading-snug mt-0.5">Terdaftar resmi di Perpustakaan Nasional RI dan bernilai angka kredit (KUM).</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-2.5 p-2.5 rounded-xs bg-white/5 border border-white/10">
                                <div class="w-5 h-5 rounded-xs bg-emerald-500/30 text-lime-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-headset text-[10px]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Pendampingan Sampai Tuntas</h4>
                                    <p class="text-[10px] sm:text-[11px] text-slate-300 leading-snug mt-0.5">Didampingi dari penyerahan draf hingga buku siap terbit dan cetak.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Footer Indicator -->
                        <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-between text-[10px] text-emerald-200/90 font-medium">
                            <span class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-lime-400 animate-pulse"></span>
                                Redaksi Siap Melayani
                            </span>
                            <span>Konsultasi Gratis</span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 2. MAIN DETAILS & WORKFLOW SECTION -->
    <section class="py-10 sm:py-14 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                <!-- LEFT COLUMN: Content Cards (col-span-8) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- 1. Overview / Pengantar -->
                    @if($service->overview)
                        <div class="bg-white p-5 sm:p-7 rounded-sm border border-slate-200 shadow-2xs">
                            <div class="flex items-center gap-2.5 mb-3.5 pb-2.5 border-b border-slate-100">
                                <div class="w-7 h-7 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Ringkasan Layanan</span>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                                        Tentang {{ $service->title }}
                                    </h2>
                                </div>
                            </div>
                            
                            <div class="text-xs sm:text-[13px] text-slate-700 leading-relaxed space-y-2.5 font-normal whitespace-pre-line">
                                {!! nl2br(e($service->overview)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- 2. Cakupan Layanan / Fitur yang Disediakan -->
                    @if(!empty($service->features) && count($service->features) > 0)
                        <div class="bg-white p-5 sm:p-7 rounded-sm border border-slate-200 shadow-2xs">
                            <div class="flex items-center justify-between mb-4 pb-2.5 border-b border-slate-100">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0">
                                        <i class="fa-solid fa-list-check"></i>
                                    </div>
                                    <div>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Cakupan &amp; Fasilitas</span>
                                        <h2 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                                            Layanan yang Kami Sediakan
                                        </h2>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-xs border border-emerald-200 shrink-0">
                                    {{ count($service->features) }} Poin Layanan
                                </span>
                            </div>

                            <div class="grid grid-cols-1 gap-2.5">
                                @foreach($service->features as $feat)
                                    <div class="flex items-start gap-3 p-3 rounded-xs bg-slate-50/80 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/40 transition">
                                        <div class="w-5 h-5 rounded-xs bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 text-[10px] shadow-2xs">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <div class="text-xs sm:text-[13px] font-semibold text-slate-800 leading-snug">
                                            {{ $feat }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- 3. Alur & Tahapan Kerja (Roadmap) -->
                    @if(!empty($service->workflow_steps) && count($service->workflow_steps) > 0)
                        <div class="bg-white p-5 sm:p-7 rounded-sm border border-slate-200 shadow-2xs">
                            <div class="flex items-center gap-2.5 mb-5 pb-2.5 border-b border-slate-100">
                                <div class="w-7 h-7 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0">
                                    <i class="fa-solid fa-arrows-spin"></i>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Proses &amp; Alur Kerja</span>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                                        Tahapan Pelaksanaan Layanan
                                    </h2>
                                </div>
                            </div>

                            <div class="relative pl-5 sm:pl-7 space-y-4 before:absolute before:left-2.5 sm:before:left-3.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-emerald-200">
                                @foreach($service->workflow_steps as $step)
                                    <div class="relative group">
                                        <!-- Step Pin -->
                                        <div class="absolute -left-5 sm:-left-7 top-0 w-5 h-5 sm:w-7 sm:h-7 rounded-xs bg-[#006830] text-white font-mono font-bold text-[10px] sm:text-xs flex items-center justify-center border border-white shadow-xs group-hover:scale-105 transition">
                                            {{ $step['step'] ?? ($loop->iteration) }}
                                        </div>

                                        <!-- Step Box -->
                                        <div class="bg-slate-50 p-3.5 sm:p-4 rounded-xs border border-slate-200 group-hover:border-emerald-500 group-hover:bg-emerald-50/30 transition">
                                            <div class="flex items-center justify-between gap-2">
                                                <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition">
                                                    {{ $step['title'] ?? '' }}
                                                </h3>
                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider font-mono">
                                                    Tahap {{ $step['step'] ?? ($loop->iteration) }}
                                                </span>
                                            </div>
                                            @if(!empty($step['desc']))
                                                <p class="text-[11px] sm:text-xs text-slate-600 mt-1 leading-relaxed">
                                                    {{ $step['desc'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- 4. Keuntungan Layanan -->
                    @if($service->benefits)
                        <div class="bg-gradient-to-br from-[#032c21] via-[#023828] to-[#006830] text-white p-5 sm:p-7 rounded-sm shadow-sm border border-emerald-700/60">
                            <div class="flex items-center gap-2.5 mb-3">
                                <div class="w-8 h-8 rounded-xs bg-amber-400/20 text-amber-300 flex items-center justify-center text-base shrink-0 border border-amber-400/30">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-lime-300 uppercase tracking-widest block">Keunggulan &amp; Manfaat</span>
                                    <h2 class="text-base sm:text-lg font-black font-heading text-white">
                                        Keuntungan Menggunakan Layanan Penerbit Persis
                                    </h2>
                                </div>
                            </div>

                            <div class="text-xs sm:text-[13px] text-emerald-100 leading-relaxed whitespace-pre-line font-medium space-y-1.5 pt-1">
                                {!! nl2br(e($service->benefits)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- 5. Catatan Penting / Disclaimer -->
                    @if($service->notes)
                        <div class="bg-amber-50 border-l-3 border-amber-500 p-4 rounded-r-xs text-amber-950 text-xs sm:text-[13px] leading-relaxed flex items-start gap-3 shadow-2xs">
                            <i class="fa-solid fa-triangle-exclamation text-amber-600 text-base shrink-0 mt-0.5"></i>
                            <div class="font-medium space-y-0.5">
                                <span class="font-bold uppercase tracking-wider text-[10px] text-amber-800 block">Informasi &amp; Ketentuan Penting</span>
                                <div>{!! nl2br(e($service->notes)) !!}</div>
                            </div>
                        </div>
                    @endif

                    <!-- 6. FAQ Accordion -->
                    @if(!empty($service->faqs) && count($service->faqs) > 0)
                        <div class="bg-white p-5 sm:p-7 rounded-sm border border-slate-200 shadow-2xs">
                            <div class="flex items-center gap-2.5 mb-4 pb-2.5 border-b border-slate-100">
                                <div class="w-7 h-7 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Tanya Jawab</span>
                                    <h2 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                                        Pertanyaan yang Sering Diajukan (FAQ)
                                    </h2>
                                </div>
                            </div>

                            <div class="space-y-2.5">
                                @foreach($service->faqs as $faq)
                                    <details class="group bg-slate-50 border border-slate-200 rounded-xs p-3.5 transition open:bg-emerald-50/40 open:border-emerald-300 [&_summary::-webkit-details-marker]:hidden">
                                        <summary class="flex items-center justify-between cursor-pointer font-bold text-xs text-slate-900 list-none select-none">
                                            <span>{{ $faq['q'] ?? '' }}</span>
                                            <span class="ml-2 w-5 h-5 rounded-xs bg-slate-200 group-open:bg-[#006830] group-open:text-white text-slate-600 flex items-center justify-center text-xs shrink-0 transition">
                                                <i class="fa-solid fa-chevron-down group-open:rotate-180 transition-transform"></i>
                                            </span>
                                        </summary>
                                        <p class="text-xs text-slate-600 mt-2.5 pt-2.5 border-t border-slate-200/60 leading-relaxed">
                                            {{ $faq['a'] ?? '' }}
                                        </p>
                                    </details>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- RIGHT COLUMN: Sticky Sidebar Card (col-span-4) -->
                <div class="lg:col-span-4 space-y-5 sticky top-24">
                    
                    <!-- Quick Contact Card -->
                    <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs text-center">
                        <div class="w-12 h-12 rounded-xs bg-emerald-100 text-[#006830] flex items-center justify-center text-xl mx-auto mb-3 shadow-2xs">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        <h3 class="text-sm sm:text-base font-extrabold text-slate-900 font-heading">
                            Konsultasi {{ $service->title }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                            Diskusikan naskah, kebutuhan legalitas, dan estimasi penerbitan langsung bersama tim redaksi kami.
                        </p>

                        <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="w-full py-2.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-xs text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer mb-2">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>Chat WhatsApp Redaksi</span>
                        </a>

                        <a href="{{ route('kontak') }}" class="w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xs text-xs font-bold transition flex items-center justify-center gap-2 border border-slate-200 cursor-pointer">
                            <i class="fa-regular fa-envelope text-xs"></i>
                            <span>Form Pengajuan Online</span>
                        </a>
                    </div>

                    <!-- Other Services Navigation -->
                    @if(isset($otherServices) && count($otherServices) > 0)
                        <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs">
                            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2.5 pb-2 border-b border-slate-100">
                                Layanan Lainnya
                            </h4>
                            <div class="space-y-1.5">
                                @foreach($otherServices as $oth)
                                    <a href="{{ route('layanan.show', $oth->slug) }}" class="flex items-center gap-2.5 p-2 rounded-xs hover:bg-emerald-50/70 transition group border border-transparent hover:border-emerald-200">
                                        <div class="w-7 h-7 rounded-xs bg-slate-100 text-slate-600 group-hover:bg-[#006830] group-hover:text-white flex items-center justify-center text-xs shrink-0 transition shadow-2xs">
                                            <i class="{{ $oth->icon }}"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <span class="text-xs font-bold text-slate-800 group-hover:text-emerald-800 transition block truncate">
                                                {{ $oth->title }}
                                            </span>
                                            <span class="text-[10px] text-slate-400 block truncate">
                                                {{ $oth->tagline ?: 'Layanan Resmi' }}
                                            </span>
                                        </div>
                                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-300 group-hover:text-emerald-600 ml-auto transition"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </section>
@endsection
