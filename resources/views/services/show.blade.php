@extends('layouts.app')

@section('title', $service->title . ' - Layanan Penerbitan & Percetakan')

@section('content')
    <!-- 1. HERO BANNER WITH OVERLAY & BREADCRUMB -->
    <section class="relative bg-[#032c21] text-white pt-28 pb-16 sm:pt-32 sm:pb-20 overflow-hidden">
        <!-- Background Banner Image with Gradient Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $service->banner_url }}" alt="{{ $service->title }}" class="w-full h-full object-cover opacity-20 filter blur-xs scale-105" />
            <div class="absolute inset-0 bg-gradient-to-t from-[#032c21] via-[#032c21]/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb Navigation -->
            <nav class="flex items-center gap-2 text-xs text-emerald-300/80 mb-4 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1">
                    <i class="fa-solid fa-house text-[10px]"></i> Beranda
                </a>
                <span>/</span>
                <span class="text-emerald-400 font-semibold">Layanan</span>
                <span>/</span>
                <span class="text-white font-bold truncate max-w-xs">{{ $service->title }}</span>
            </nav>

            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-[11px] font-bold uppercase tracking-wider mb-3">
                    <i class="{{ $service->icon }}"></i>
                    <span>LAYANAN RESMI PERSIS PERS</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold font-heading text-white tracking-tight leading-tight mb-3">
                    {{ $service->title }}
                </h1>
                @if($service->tagline)
                    <p class="text-base sm:text-lg text-emerald-200 font-medium italic mb-4">
                        {{ $service->tagline }}
                    </p>
                @endif
                <p class="text-sm sm:text-base text-slate-200 leading-relaxed max-w-2xl">
                    {{ $service->short_desc }}
                </p>

                <!-- Quick Action Button -->
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-5 py-2.5 bg-[#006830] hover:bg-emerald-600 text-white rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 shadow-md border border-emerald-400/40">
                        <i class="fa-brands fa-whatsapp text-base text-lime-300"></i>
                        <span>{{ $service->cta_text ?: 'Konsultasi Sekarang' }}</span>
                    </a>
                    <a href="{{ route('kontak') }}" class="px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-sm text-xs sm:text-sm font-bold transition flex items-center gap-2 border border-white/20">
                        <i class="fa-regular fa-envelope text-xs"></i>
                        <span>Kirim Pesan / Form</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. MAIN CONTENT & DETAILS -->
    <section class="py-12 sm:py-16 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: Content, Features, Workflow, FAQ (col-span-8) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Overview Section -->
                    @if($service->overview)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs">
                            <h2 class="text-lg sm:text-xl font-black text-slate-900 font-heading mb-3.5 flex items-center gap-2">
                                <i class="fa-solid fa-circle-info text-emerald-700 text-base"></i>
                                <span>Tentang Layanan Ini</span>
                            </h2>
                            <div class="text-sm text-slate-700 leading-relaxed space-y-3 whitespace-pre-line font-medium">
                                {!! nl2br(e($service->overview)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Features / Scope of Service -->
                    @if(!empty($service->features) && count($service->features) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs">
                            <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                                <h2 class="text-lg sm:text-xl font-black text-slate-900 font-heading flex items-center gap-2">
                                    <i class="fa-solid fa-list-check text-emerald-700 text-base"></i>
                                    <span>Layanan yang Kami Sediakan</span>
                                </h2>
                                <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-xs border border-emerald-200">
                                    {{ count($service->features) }} Cakupan
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($service->features as $feat)
                                    <div class="flex items-start gap-2.5 p-3 rounded-xs bg-slate-50 border border-slate-200/80 hover:border-emerald-500 hover:bg-emerald-50/40 transition">
                                        <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center shrink-0 mt-0.5 text-xs shadow-2xs">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        </div>
                                        <span class="text-xs sm:text-[13px] font-semibold text-slate-800 leading-snug">
                                            {{ $feat }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Workflow Steps -->
                    @if(!empty($service->workflow_steps) && count($service->workflow_steps) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs">
                            <h2 class="text-lg sm:text-xl font-black text-slate-900 font-heading mb-6 flex items-center gap-2">
                                <i class="fa-solid fa-arrows-spin text-emerald-700 text-base"></i>
                                <span>Alur &amp; Tahapan Pelaksanaan</span>
                            </h2>

                            <div class="relative pl-6 sm:pl-8 space-y-6 before:absolute before:left-3 sm:before:left-4 before:top-2 before:bottom-2 before:w-0.5 before:bg-emerald-200">
                                @foreach($service->workflow_steps as $step)
                                    <div class="relative group">
                                        <!-- Step Number Pin -->
                                        <div class="absolute -left-6 sm:-left-8 top-0 w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-[#006830] text-white font-mono font-bold text-xs flex items-center justify-center border-2 border-white shadow-xs group-hover:scale-110 transition">
                                            {{ $step['step'] ?? ($loop->iteration) }}
                                        </div>
                                        <div class="bg-slate-50 p-4 rounded-xs border border-slate-200/80 group-hover:border-emerald-500 group-hover:bg-emerald-50/30 transition">
                                            <h3 class="text-sm font-bold text-slate-900">
                                                {{ $step['title'] ?? '' }}
                                            </h3>
                                            @if(!empty($step['desc']))
                                                <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                                    {{ $step['desc'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Benefits / Advantages -->
                    @if($service->benefits)
                        <div class="bg-gradient-to-r from-emerald-900 to-[#032c21] text-white p-6 sm:p-8 rounded-sm shadow-sm border border-emerald-700">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-award text-amber-400 text-lg"></i>
                                <h2 class="text-lg sm:text-xl font-black font-heading text-white">
                                    Keuntungan Menggunakan Layanan Kami
                                </h2>
                            </div>
                            <div class="text-xs sm:text-sm text-emerald-100 leading-relaxed whitespace-pre-line font-medium">
                                {!! nl2br(e($service->benefits)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Important Notes / Disclaimer -->
                    @if($service->notes)
                        <div class="bg-amber-50 border-l-4 border-amber-500 p-4 sm:p-5 rounded-r-sm text-amber-950 text-xs sm:text-[13px] leading-relaxed flex items-start gap-3">
                            <i class="fa-solid fa-triangle-exclamation text-amber-600 text-base shrink-0 mt-0.5"></i>
                            <div class="font-medium">
                                {!! nl2br(e($service->notes)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- FAQs Accordion -->
                    @if(!empty($service->faqs) && count($service->faqs) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs">
                            <h2 class="text-lg sm:text-xl font-black text-slate-900 font-heading mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-circle-question text-emerald-700 text-base"></i>
                                <span>Pertanyaan yang Sering Diajukan (FAQ)</span>
                            </h2>
                            <div class="space-y-3">
                                @foreach($service->faqs as $faq)
                                    <details class="group bg-slate-50 border border-slate-200 rounded-xs p-3.5 transition [&_summary::-webkit-details-marker]:hidden">
                                        <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-slate-900 list-none select-none">
                                            <span>{{ $faq['q'] ?? '' }}</span>
                                            <span class="ml-2 w-5 h-5 rounded-full bg-slate-200 group-open:bg-emerald-700 group-open:text-white text-slate-600 flex items-center justify-center text-xs transition">
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
                <div class="lg:col-span-4 space-y-6 sticky top-24">
                    
                    <!-- Quick Contact Card -->
                    <div class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-sm text-center">
                        <div class="w-12 h-12 rounded-full bg-emerald-100 text-[#006830] flex items-center justify-center text-xl mx-auto mb-3 shadow-2xs">
                            <i class="{{ $service->icon }}"></i>
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900 font-heading">
                            Konsultasi {{ $service->title }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                            Diskusikan kebutuhan karya dan naskah Anda bersama staf redaksi kami.
                        </p>

                        <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="w-full py-2.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 shadow-xs mb-2">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>Chat WhatsApp Redaksi</span>
                        </a>

                        <a href="{{ route('kontak') }}" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 border border-slate-200">
                            <i class="fa-regular fa-envelope text-xs"></i>
                            <span>Form Pengajuan Online</span>
                        </a>
                    </div>

                    <!-- Other Services Navigation -->
                    @if(isset($otherServices) && count($otherServices) > 0)
                        <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-2xs">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">
                                Layanan Lainnya
                            </h4>
                            <div class="space-y-2">
                                @foreach($otherServices as $oth)
                                    <a href="{{ route('layanan.show', $oth->slug) }}" class="flex items-center gap-3 p-2 rounded-xs hover:bg-emerald-50/60 transition group border border-transparent hover:border-emerald-200">
                                        <div class="w-7 h-7 rounded-xs bg-slate-100 text-slate-600 group-hover:bg-[#006830] group-hover:text-white flex items-center justify-center text-xs shrink-0 transition">
                                            <i class="{{ $oth->icon }}"></i>
                                        </div>
                                        <span class="text-xs font-bold text-slate-800 group-hover:text-emerald-800 transition line-clamp-1">
                                            {{ $oth->title }}
                                        </span>
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
