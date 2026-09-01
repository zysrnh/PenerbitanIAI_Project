@extends('layouts.app')

@section('title', $service->title . ' - Penerbit Persis')

@section('content')
    <!-- 1. HERO BANNER (IDENTICAL STYLE TO TENTANG KAMI) -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-emerald-400 mb-3 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[10px]"></i> Beranda
                </a>
                <span class="text-slate-500">/</span>
                <a href="{{ route('home') }}#layanan" class="hover:text-white transition">
                    Layanan
                </a>
                <span class="text-slate-500">/</span>
                <span class="text-white font-bold truncate max-w-xs">{{ $service->title }}</span>
            </nav>

            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest block mb-2">
                <i class="{{ $service->icon }} mr-1.5 text-lime-300"></i> LAYANAN RESMI PENERBIT PERSIS
            </span>
            
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl text-white">
                {{ $service->title }}
            </h1>

            @if($service->tagline)
                <p class="text-sm sm:text-base text-emerald-200 font-medium italic mt-2">
                    {{ $service->tagline }}
                </p>
            @endif

            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-3xl leading-relaxed">
                {{ $service->short_desc }}
            </p>

            <!-- Action Buttons -->
            <div class="pt-5 flex flex-wrap items-center gap-3">
                <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-2xs border border-emerald-600 cursor-pointer">
                    <i class="fa-brands fa-whatsapp text-sm text-lime-300"></i>
                    <span>{{ $service->cta_text ?: 'Konsultasi Sekarang' }}</span>
                </a>

                <a href="{{ route('kontak') }}" class="px-4 py-2.5 bg-brand-900/60 hover:bg-brand-900 text-slate-200 hover:text-white rounded-sm text-xs font-bold transition flex items-center gap-2 border border-slate-700 cursor-pointer">
                    <i class="fa-regular fa-envelope text-xs"></i>
                    <span>Kirim Naskah / Form</span>
                </a>
            </div>

        </div>
    </section>

    <!-- 2. STATS & HIGHLIGHT BAR (OVERLAPPING CARDS) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center">
                <span class="block text-xl sm:text-2xl font-extrabold text-emerald-700 font-heading">100%</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Legalitas ISBN Resmi</span>
            </div>
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center">
                <span class="block text-xl sm:text-2xl font-extrabold text-brand-950 font-heading">Standar</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">KUM &amp; Akademik</span>
            </div>
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center">
                <span class="block text-xl sm:text-2xl font-extrabold text-emerald-700 font-heading">Terarah</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Didampingi Redaksi</span>
            </div>
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center">
                <span class="block text-xl sm:text-2xl font-extrabold text-brand-950 font-heading">Nasional</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Cetak &amp; Distribusi</span>
            </div>
        </div>
    </section>

    <!-- 3. VISUAL WORKFLOW INFOGRAPHIC BAR (ALUR VISUAL PROSES HORIZONTAL) -->
    @if(!empty($service->workflow_steps) && count($service->workflow_steps) > 0)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                        <h3 class="text-xs sm:text-sm font-extrabold text-slate-900 uppercase tracking-wider font-heading">
                            Alur Visual Proses Layanan (Step-by-Step)
                        </h3>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest hidden sm:inline-block">
                        {{ count($service->workflow_steps) }} Tahapan Kerja
                    </span>
                </div>

                <!-- Horizontal Step Flow -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-{{ min(count($service->workflow_steps), 6) }} gap-3 relative">
                    @foreach($service->workflow_steps as $step)
                        <div class="bg-slate-50 p-3.5 rounded-sm border border-slate-200/90 hover:border-emerald-600 hover:bg-emerald-50/40 transition group flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="w-6 h-6 rounded-xs bg-[#006830] text-white text-[11px] font-black font-mono flex items-center justify-center shadow-2xs group-hover:scale-105 transition">
                                        {{ $step['step'] ?? $loop->iteration }}
                                    </span>
                                    @if(!$loop->last)
                                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-300 group-hover:text-emerald-600 transition hidden md:block"></i>
                                    @else
                                        <i class="fa-solid fa-circle-check text-xs text-emerald-600"></i>
                                    @endif
                                </div>
                                <h4 class="text-xs font-bold text-slate-900 group-hover:text-emerald-800 transition line-clamp-2">
                                    {{ $step['title'] ?? '' }}
                                </h4>
                            </div>
                            @if(!empty($step['desc']))
                                <p class="text-[10px] text-slate-500 mt-2 line-clamp-3 leading-snug">
                                    {{ $step['desc'] }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 4. MAIN DETAILS & CONTENT SECTION -->
    <section class="py-8 sm:py-12 bg-slate-50">
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

                    <!-- 2. Cakupan Layanan / Visual Grid Cards -->
                    @if(!empty($service->features) && count($service->features) > 0)
                        <div class="bg-white p-5 sm:p-7 rounded-sm border border-slate-200 shadow-2xs">
                            <div class="flex items-center justify-between mb-4 pb-2.5 border-b border-slate-100">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm shrink-0">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </div>
                                    <div>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Cakupan &amp; Fasilitas</span>
                                        <h2 class="text-base sm:text-lg font-extrabold text-slate-900 font-heading">
                                            Apa yang Kami Layani?
                                        </h2>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-xs border border-emerald-200 shrink-0">
                                    {{ count($service->features) }} Fasilitas
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($service->features as $feat)
                                    <div class="p-3.5 rounded-xs bg-slate-50/90 border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/30 transition duration-200 flex items-start gap-3 group shadow-2xs">
                                        <div class="w-6 h-6 rounded-xs bg-emerald-100 text-[#006830] flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold group-hover:bg-[#006830] group-hover:text-white transition">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </div>
                                        <div class="text-xs sm:text-[13px] font-medium text-slate-800 leading-snug">
                                            {{ $feat }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- 3. Keuntungan Layanan / Visual Matrix -->
                    @if($service->benefits)
                        <div class="bg-gradient-to-br from-[#032c21] via-[#023828] to-[#006830] text-white p-5 sm:p-7 rounded-sm shadow-sm border border-emerald-700/60">
                            <div class="flex items-center gap-2.5 mb-3.5 pb-2.5 border-b border-white/10">
                                <div class="w-8 h-8 rounded-xs bg-amber-400/20 text-amber-300 flex items-center justify-center text-base shrink-0 border border-amber-400/30">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <div>
                                    <span class="text-[9px] font-bold text-lime-300 uppercase tracking-widest block">Keunggulan &amp; Manfaat</span>
                                    <h2 class="text-base sm:text-lg font-black font-heading text-white">
                                        Keuntungan &amp; Keunggulan Layanan
                                    </h2>
                                </div>
                            </div>

                            <div class="text-xs sm:text-[13px] text-emerald-100 leading-relaxed whitespace-pre-line font-medium space-y-1.5">
                                {!! nl2br(e($service->benefits)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- 4. Catatan Penting / Disclaimer -->
                    @if($service->notes)
                        <div class="bg-amber-50 border-l-3 border-amber-500 p-4 rounded-r-xs text-amber-950 text-xs sm:text-[13px] leading-relaxed flex items-start gap-3 shadow-2xs">
                            <i class="fa-solid fa-triangle-exclamation text-amber-600 text-base shrink-0 mt-0.5"></i>
                            <div class="font-medium space-y-0.5">
                                <span class="font-bold uppercase tracking-wider text-[10px] text-amber-800 block">Informasi &amp; Ketentuan Penting</span>
                                <div>{!! nl2br(e($service->notes)) !!}</div>
                            </div>
                        </div>
                    @endif

                    <!-- 5. FAQ Accordion -->
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
