@extends('layouts.app')

@section('title', $service->title . ' - Penerbit Persis')

@section('content')
    <!-- 1. ULTRA-PREMIUM EXECUTIVE HERO BANNER -->
    <section class="relative bg-gradient-to-br from-[#02231a] via-[#032c21] to-[#043d2e] text-white pt-28 pb-16 sm:pt-36 sm:pb-24 overflow-hidden">
        <!-- Ambient Decorative Glows -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 right-0 w-96 h-96 bg-lime-500/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Subtle Pattern & Background Texture -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#10b981_1px,transparent_1px)] [background-size:20px_20px]"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-emerald-300/80 mb-6 font-medium" aria-label="Breadcrumb">
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

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                
                <!-- Left: Headline & Core Pitch -->
                <div class="lg:col-span-7 space-y-4 sm:space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-200 text-[11px] font-bold tracking-wider uppercase shadow-xs">
                        <i class="{{ $service->icon }} text-lime-300"></i>
                        <span>Layanan Resmi Penerbit Persis</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black font-heading text-white tracking-tight leading-[1.15]">
                        {{ $service->title }}
                    </h1>

                    @if($service->tagline)
                        <div class="p-3 sm:p-3.5 rounded-lg bg-white/5 border-l-4 border-lime-400 backdrop-blur-xs">
                            <p class="text-sm sm:text-base text-emerald-100 font-medium italic">
                                {{ $service->tagline }}
                            </p>
                        </div>
                    @endif

                    <p class="text-xs sm:text-sm text-slate-200 leading-relaxed max-w-2xl font-sans">
                        {{ $service->short_desc }}
                    </p>

                    <!-- Interactive Action CTAs -->
                    <div class="pt-2 flex flex-wrap items-center gap-3.5">
                        <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-[#006830] hover:from-emerald-500 hover:to-[#024a23] text-white rounded-md text-xs sm:text-sm font-bold transition-all duration-200 flex items-center gap-2.5 shadow-lg hover:shadow-emerald-900/50 hover:scale-[1.02] border border-emerald-400/40 cursor-pointer">
                            <i class="fa-brands fa-whatsapp text-lg text-lime-300"></i>
                            <span>{{ $service->cta_text ?: 'Konsultasi Sekarang' }}</span>
                        </a>

                        <a href="{{ route('kontak') }}" class="px-5 py-3 bg-white/10 hover:bg-white/20 text-white rounded-md text-xs sm:text-sm font-bold transition flex items-center gap-2 border border-white/25 backdrop-blur-xs cursor-pointer">
                            <i class="fa-regular fa-envelope text-xs"></i>
                            <span>Kirim Draf Naskah</span>
                        </a>
                    </div>
                </div>

                <!-- Right: Glassmorphic Value Card -->
                <div class="lg:col-span-5">
                    <div class="relative bg-gradient-to-b from-white/12 to-white/5 border border-white/20 rounded-2xl p-6 sm:p-7 backdrop-blur-md shadow-2xl">
                        
                        <!-- Top Service Badge Header -->
                        <div class="flex items-center gap-4 pb-5 border-b border-white/10">
                            <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-lime-400 to-emerald-600 text-brand-950 flex items-center justify-center text-2xl font-black shrink-0 shadow-lg shadow-emerald-900/40">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest block">Unit Layanan Publikasi</span>
                                <h3 class="text-lg font-bold text-white leading-snug">{{ $service->title }}</h3>
                            </div>
                        </div>

                        <!-- 3 Core Institutional Guarantees -->
                        <div class="mt-5 space-y-3.5">
                            <div class="flex items-start gap-3 p-3 rounded-lg bg-white/5 border border-white/10">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/30 text-lime-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-shield-halved text-[11px]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Standar Mutu Resmi</h4>
                                    <p class="text-[11px] text-slate-300 leading-snug mt-0.5">Dikelola langsung oleh tim editorial dan penerbitan resmi Penerbit Persis.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-lg bg-white/5 border border-white/10">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/30 text-lime-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-barcode text-[11px]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">ISBN &amp; Legalitas Lengkap</h4>
                                    <p class="text-[11px] text-slate-300 leading-snug mt-0.5">Terdaftar resmi di Perpustakaan Nasional RI dan bernilai angka kredit (KUM).</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-lg bg-white/5 border border-white/10">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/30 text-lime-300 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-headset text-[11px]"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-white">Pendampingan Sampai Tuntas</h4>
                                    <p class="text-[11px] text-slate-300 leading-snug mt-0.5">Didampingi dari penyerahan draf hingga buku siap terbit dan cetak.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mini Footer Indicator -->
                        <div class="mt-5 pt-4 border-t border-white/10 flex items-center justify-between text-[11px] text-emerald-200/90 font-medium">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-lime-400 animate-pulse"></span>
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
    <section class="py-14 sm:py-20 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- LEFT COLUMN: Content Cards (col-span-8) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- 1. Overview / Pengantar -->
                    @if($service->overview)
                        <div class="bg-white p-6 sm:p-8 rounded-xl border border-slate-200/90 shadow-sm">
                            <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#006830] flex items-center justify-center text-base shrink-0">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Ringkasan Layanan</span>
                                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 font-heading">
                                        Tentang {{ $service->title }}
                                    </h2>
                                </div>
                            </div>
                            
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3 font-normal whitespace-pre-line">
                                {!! nl2br(e($service->overview)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- 2. Cakupan Layanan / Fitur yang Disediakan -->
                    @if(!empty($service->features) && count($service->features) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-xl border border-slate-200/90 shadow-sm">
                            <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#006830] flex items-center justify-center text-base shrink-0">
                                        <i class="fa-solid fa-list-check"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Cakupan &amp; Fasilitas</span>
                                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 font-heading">
                                            Layanan yang Kami Sediakan
                                        </h2>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200 shrink-0">
                                    {{ count($service->features) }} Poin Layanan
                                </span>
                            </div>

                            <div class="grid grid-cols-1 gap-3 sm:gap-3.5">
                                @foreach($service->features as $feat)
                                    <div class="flex items-start gap-3.5 p-4 rounded-lg bg-slate-50/80 border border-slate-200/70 hover:border-emerald-500 hover:bg-emerald-50/40 transition-all duration-200 group">
                                        <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5 text-xs shadow-2xs group-hover:scale-110 transition">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </div>
                                        <div class="text-xs sm:text-sm font-semibold text-slate-800 leading-snug">
                                            {{ $feat }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- 3. Alur & Tahapan Kerja (Interactive Step Roadmap) -->
                    @if(!empty($service->workflow_steps) && count($service->workflow_steps) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-xl border border-slate-200/90 shadow-sm">
                            <div class="flex items-center gap-3 mb-6 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#006830] flex items-center justify-center text-base shrink-0">
                                    <i class="fa-solid fa-arrows-spin"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Proses &amp; Alur Kerja</span>
                                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 font-heading">
                                        Tahapan Pelaksanaan Layanan
                                    </h2>
                                </div>
                            </div>

                            <div class="relative pl-6 sm:pl-8 space-y-6 before:absolute before:left-3 sm:before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-gradient-to-b before:from-emerald-600 before:via-emerald-400 before:to-emerald-200">
                                @foreach($service->workflow_steps as $step)
                                    <div class="relative group">
                                        <!-- Step Pin -->
                                        <div class="absolute -left-6 sm:-left-8 top-0.5 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gradient-to-br from-[#006830] to-[#032c21] text-white font-mono font-black text-xs flex items-center justify-center border-2 border-white shadow-md group-hover:scale-110 group-hover:bg-emerald-600 transition">
                                            {{ $step['step'] ?? ($loop->iteration) }}
                                        </div>

                                        <!-- Step Box -->
                                        <div class="bg-slate-50/90 p-4 sm:p-5 rounded-lg border border-slate-200 group-hover:border-emerald-500 group-hover:bg-emerald-50/30 group-hover:shadow-xs transition-all duration-200">
                                            <div class="flex items-center justify-between gap-2">
                                                <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition">
                                                    {{ $step['title'] ?? '' }}
                                                </h3>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider font-mono">
                                                    Tahap {{ $step['step'] ?? ($loop->iteration) }}
                                                </span>
                                            </div>
                                            @if(!empty($step['desc']))
                                                <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">
                                                    {{ $step['desc'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- 4. Keuntungan Layanan (Institutional Value Matrix) -->
                    @if($service->benefits)
                        <div class="bg-gradient-to-br from-[#032c21] via-[#023828] to-[#006830] text-white p-6 sm:p-8 rounded-xl shadow-lg border border-emerald-700/60 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-lime-400/10 rounded-full blur-2xl pointer-events-none"></div>
                            
                            <div class="relative z-10">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-amber-400/20 text-amber-300 flex items-center justify-center text-xl shrink-0 border border-amber-400/30">
                                        <i class="fa-solid fa-award"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-bold text-lime-300 uppercase tracking-widest block">Keunggulan &amp; Manfaat</span>
                                        <h2 class="text-lg sm:text-xl font-black font-heading text-white">
                                            Keuntungan Menggunakan Layanan Penerbit Persis
                                        </h2>
                                    </div>
                                </div>

                                <div class="text-xs sm:text-sm text-emerald-100 leading-relaxed whitespace-pre-line font-medium space-y-2 pt-2">
                                    {!! nl2br(e($service->benefits)) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 5. Catatan Penting / Disclaimer -->
                    @if($service->notes)
                        <div class="bg-amber-50/90 border-l-4 border-amber-500 p-5 rounded-r-xl text-amber-950 text-xs sm:text-[13px] leading-relaxed flex items-start gap-3.5 shadow-2xs">
                            <i class="fa-solid fa-triangle-exclamation text-amber-600 text-lg shrink-0 mt-0.5"></i>
                            <div class="font-medium space-y-1">
                                <span class="font-bold uppercase tracking-wider text-[11px] text-amber-800 block">Informasi &amp; Ketentuan Penting</span>
                                <div>{!! nl2br(e($service->notes)) !!}</div>
                            </div>
                        </div>
                    @endif

                    <!-- 6. FAQ Accordion -->
                    @if(!empty($service->faqs) && count($service->faqs) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-xl border border-slate-200/90 shadow-sm">
                            <div class="flex items-center gap-3 mb-5 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-[#006830] flex items-center justify-center text-base shrink-0">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Tanya Jawab</span>
                                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 font-heading">
                                        Pertanyaan yang Sering Diajukan (FAQ)
                                    </h2>
                                </div>
                            </div>

                            <div class="space-y-3">
                                @foreach($service->faqs as $faq)
                                    <details class="group bg-slate-50 border border-slate-200 rounded-lg p-4 transition-all duration-200 open:bg-emerald-50/40 open:border-emerald-300 [&_summary::-webkit-details-marker]:hidden">
                                        <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-slate-900 list-none select-none">
                                            <span>{{ $faq['q'] ?? '' }}</span>
                                            <span class="ml-2 w-6 h-6 rounded-full bg-slate-200 group-open:bg-[#006830] group-open:text-white text-slate-600 flex items-center justify-center text-xs shrink-0 transition">
                                                <i class="fa-solid fa-chevron-down group-open:rotate-180 transition-transform"></i>
                                            </span>
                                        </summary>
                                        <p class="text-xs text-slate-600 mt-3 pt-3 border-t border-slate-200/60 leading-relaxed">
                                            {{ $faq['a'] ?? '' }}
                                        </p>
                                    </details>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- RIGHT COLUMN: Sticky Sidebar Card (col-span-4) -->
                <div class="lg:col-span-4 space-y-6 sticky top-24">
                    
                    <!-- Quick Contact Card -->
                    <div class="bg-white p-6 rounded-xl border border-slate-200/90 shadow-sm text-center">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-[#006830] flex items-center justify-center text-2xl mx-auto mb-3.5 shadow-2xs">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900 font-heading">
                            Konsultasi {{ $service->title }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 mb-5 leading-relaxed">
                            Diskusikan naskah, kebutuhan legalitas, dan estimasi penerbitan langsung bersama tim redaksi kami.
                        </p>

                        <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="w-full py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-lg text-xs font-bold transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg cursor-pointer mb-2.5">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Chat WhatsApp Redaksi</span>
                        </a>

                        <a href="{{ route('kontak') }}" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-bold transition flex items-center justify-center gap-2 border border-slate-200 cursor-pointer">
                            <i class="fa-regular fa-envelope text-xs"></i>
                            <span>Form Pengajuan Online</span>
                        </a>
                    </div>

                    <!-- Other Services Navigation -->
                    @if(isset($otherServices) && count($otherServices) > 0)
                        <div class="bg-white p-5 rounded-xl border border-slate-200/90 shadow-sm">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3 pb-2 border-b border-slate-100">
                                Layanan Lainnya
                            </h4>
                            <div class="space-y-2">
                                @foreach($otherServices as $oth)
                                    <a href="{{ route('layanan.show', $oth->slug) }}" class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-emerald-50/70 transition group border border-transparent hover:border-emerald-200">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-[#006830] group-hover:text-white flex items-center justify-center text-xs shrink-0 transition shadow-2xs">
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
