@extends('layouts.app')

@section('title', $service->title . ' - Layanan Penerbit Persis')

@section('content')
    <!-- Helper regex to strip any emoji from database texts -->
    @php
        $stripEmojis = function($text) {
            return preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F1E0}-\x{1F1FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}\x{1F900}-\x{1F9FF}\x{1F018}-\x{1F270}\x{2388}\x{200D}]/u', '', $text);
        };
    @endphp

    <!-- 1. HERO BANNER (IDENTIK DENGAN TENTANG KAMI & BERANDA) -->
    <section class="bg-brand-950 text-white py-14 sm:py-20 relative overflow-hidden border-b border-brand-900">
        <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-emerald-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
            
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-emerald-400 mb-3 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Beranda</span>
                </a>
                <span class="text-slate-500">/</span>
                <a href="{{ route('home') }}#layanan" class="hover:text-white transition">
                    Layanan
                </a>
                <span class="text-slate-500">/</span>
                <span class="text-white font-bold truncate max-w-xs">{{ $service->title }}</span>
            </nav>

            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest flex items-center gap-2 mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>LAYANAN PENERBIT PERSIS</span>
            </span>
            
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl text-white">
                {{ $service->title }}
            </h1>

            @if($service->tagline)
                <p class="text-sm sm:text-base text-emerald-200 font-medium italic mt-2.5 max-w-3xl">
                    {{ $stripEmojis($service->tagline) }}
                </p>
            @endif

            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-3xl leading-relaxed">
                {{ $stripEmojis($service->short_desc) }}
            </p>

            <!-- Quick Action Buttons -->
            <div class="pt-6 flex flex-wrap items-center gap-3.5">
                <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-sm border border-emerald-600 cursor-pointer">
                    <svg class="w-4 h-4 fill-current text-lime-300" viewBox="0 0 448 512">
                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                    </svg>
                    <span>{{ $service->cta_text ?: 'Konsultasi Layanan via WhatsApp' }}</span>
                </a>

                <a href="{{ route('kontak') }}" class="px-4 py-2.5 bg-brand-900/70 hover:bg-brand-900 text-slate-200 hover:text-white rounded-sm text-xs font-bold transition flex items-center gap-2 border border-slate-700 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Kirim Draf Naskah</span>
                </a>
            </div>

        </div>
    </section>

    <!-- 2. CIRI KHAS HALAMAN LAYANAN: DUAL-PANE SERVICE BLUEPRINT -->
    <section class="py-12 sm:py-16 bg-slate-50 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT CONTENT AREA (COL-SPAN-8) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- A. Overview & Ringkasan Layanan -->
                    @if($service->overview)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs space-y-4">
                            <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-9 h-9 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center border border-emerald-100 shadow-2xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Ringkasan Layanan</span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-heading">
                                        Mengenal {{ $service->title }}
                                    </h2>
                                </div>
                            </div>
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3 font-normal whitespace-pre-line text-justify">
                                {!! nl2br(e($stripEmojis($service->overview))) !!}
                            </div>
                        </div>
                    @endif

                    <!-- B. Fasilitas & Cakupan Layanan -->
                    @if(!empty($service->features) && count($service->features) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs space-y-5">
                            <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-9 h-9 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center border border-emerald-100 shadow-2xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Cakupan &amp; Fasilitas</span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-heading">
                                        Fasilitas yang Anda Dapatkan
                                    </h2>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                @foreach($service->features as $feat)
                                    @php
                                        $cleanFeat = preg_replace('/^[•\-\*]\s*/u', '', trim($feat));
                                        $cleanFeat = $stripEmojis($cleanFeat);
                                    @endphp
                                    <div class="p-3.5 rounded-sm bg-slate-50/80 border border-slate-200/90 flex items-start gap-3 hover:border-emerald-500 hover:bg-emerald-50/30 transition duration-150">
                                        <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-xs font-semibold text-slate-800 leading-snug">
                                            {{ $cleanFeat }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- C. Keunggulan & Kategori yang Dilayani -->
                    @if($service->benefits)
                        @php
                            $rawBenefits = str_replace(["\r\n", "\r"], "\n", $service->benefits);
                            $rawLines = array_filter(array_map('trim', explode("\n", $rawBenefits)));
                            
                            $benefitTitle = '';
                            $benefitList = [];
                            
                            foreach ($rawLines as $line) {
                                if (str_ends_with($line, ':') && empty($benefitTitle)) {
                                    $benefitTitle = rtrim($line, ':');
                                } else {
                                    $cleaned = preg_replace('/^[•\-\*\–]\s*/u', '', $line);
                                    $cleaned = $stripEmojis($cleaned);
                                    if (!empty($cleaned)) {
                                        $benefitList[] = $cleaned;
                                    }
                                }
                            }
                        @endphp

                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs space-y-5">
                            <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                                <div class="w-9 h-9 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center border border-emerald-100 shadow-2xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Keunggulan &amp; Spesifikasi</span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-heading">
                                        {{ $stripEmojis($benefitTitle) ?: 'Keunggulan Layanan Penerbit Persis' }}
                                    </h2>
                                </div>
                            </div>

                            @if(count($benefitList) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                    @foreach($benefitList as $b)
                                        <div class="p-3.5 rounded-sm bg-white border border-slate-200/90 shadow-2xs flex items-start gap-3 hover:border-emerald-600 transition">
                                            <div class="w-6 h-6 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-xs shrink-0 border border-emerald-100 mt-0.5">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="text-xs font-bold text-slate-800 leading-snug">
                                                    {{ $b }}
                                                </h4>
                                                <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Standar Penerbitan Resmi</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                    {!! nl2br(e($stripEmojis($service->benefits))) !!}
                                </div>
                            @endif

                            @if($service->notes)
                                <div class="mt-4 p-3.5 bg-amber-50/90 border border-amber-200/90 rounded-sm text-amber-900 flex items-start gap-2.5">
                                    <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="text-xs leading-relaxed text-amber-950">
                                        <strong class="font-bold text-amber-800 block text-[10.5px] uppercase tracking-wider mb-0.5">Catatan Penting:</strong>
                                        {!! nl2br(e($stripEmojis($service->notes))) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>

                <!-- RIGHT STICKY SERVICE SNAPSHOT (COL-SPAN-4) -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                    
                    <!-- Quick Info Card -->
                    <div class="bg-white p-6 rounded-sm border border-slate-200 shadow-sm space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-xl shadow-2xs border border-emerald-100">
                                <i class="{{ $service->icon }}"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider block">Spesifikasi Layanan</span>
                                <h3 class="text-sm font-bold text-slate-900 font-heading">
                                    {{ $service->title }}
                                </h3>
                            </div>
                        </div>

                        <!-- Service Attributes -->
                        <div class="space-y-3 pt-2 border-t border-slate-100 text-xs">
                            <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Status Legalitas:</span>
                                <span class="font-bold text-emerald-800 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>ISBN Perpusnas</span>
                                </span>
                            </div>
                            <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Format Output:</span>
                                <span class="font-bold text-slate-800">Cetak &amp; E-Book</span>
                            </div>
                            <div class="flex items-center justify-between py-1.5 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Standar Buku:</span>
                                <span class="font-bold text-slate-800">UNESCO (17,6x25 cm)</span>
                            </div>
                            <div class="flex items-center justify-between py-1.5">
                                <span class="text-slate-500 font-medium">Pendampingan:</span>
                                <span class="font-bold text-emerald-700">Dewan Redaksi Ahli</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-2.5 pt-2 border-t border-slate-100">
                            <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="w-full py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 448 512">
                                    <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                                </svg>
                                <span>Hubungi Redaksi via WA</span>
                            </a>

                            <a href="{{ route('kontak') }}" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 border border-slate-200 cursor-pointer">
                                <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Form Pengajuan Naskah</span>
                            </a>
                        </div>

                        <!-- Pure CSS/SVG Live Pulse Indicator -->
                        <div class="flex items-center justify-center gap-2 text-[10.5px] font-semibold text-emerald-700 pt-1">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span>Redaksi Aktif Melayani Konsultasi</span>
                        </div>
                    </div>

                    <!-- Other Services Navigation -->
                    @if(isset($otherServices) && count($otherServices) > 0)
                        <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-2xs space-y-3">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Layanan Lainnya:</span>
                            <div class="space-y-2">
                                @foreach($otherServices as $oth)
                                    <a href="{{ route('layanan.show', $oth->slug) }}" class="p-2.5 rounded-xs bg-slate-50 hover:bg-emerald-50 hover:text-emerald-800 text-slate-700 text-xs font-bold border border-slate-200/80 transition flex items-center justify-between group">
                                        <span class="flex items-center gap-2">
                                            <i class="{{ $oth->icon }} text-emerald-700 text-xs"></i>
                                            <span>{{ $oth->title }}</span>
                                        </span>
                                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-emerald-700 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </section>

    <!-- 3. CIRI KHAS HALAMAN LAYANAN: TAHAPAN KERJA & ALUR PROSES -->
    @if(!empty($service->workflow_steps) && count($service->workflow_steps) > 0)
        <section class="py-14 sm:py-18 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Tahapan Kerja</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        Alur Pelaksanaan Layanan
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2">
                        Langkah sistematis dari pengajuan draf hingga buku selesai dipublikasikan dan didistribusikan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($service->workflow_steps as $step)
                        <div class="bg-slate-50/70 p-6 rounded-sm border border-slate-200 hover:border-emerald-500 shadow-2xs hover:shadow-sm transition-all duration-200 flex flex-col justify-between group">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="w-8 h-8 rounded-xs bg-[#006830] text-white flex items-center justify-center text-xs font-black font-heading shadow-2xs">
                                        {{ $step['step'] ?? $loop->iteration }}
                                    </div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Langkah {{ $step['step'] ?? $loop->iteration }}
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition">
                                    {{ $stripEmojis($step['title'] ?? '') }}
                                </h3>
                                @if(!empty($step['desc']))
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $stripEmojis($step['desc']) }}
                                    </p>
                                @endif
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center gap-1.5 text-[10px] font-semibold text-emerald-700">
                                <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Standar Operasional Prosedur</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 4. CIRI KHAS HALAMAN LAYANAN: FAQ KHUSUS LAYANAN -->
    @if(!empty($service->faqs) && count($service->faqs) > 0)
        <section class="py-14 sm:py-18 bg-slate-50 border-t border-slate-200/80">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-10">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Tanya Jawab</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading">
                        Pertanyaan Seputar {{ $service->title }}
                    </h2>
                </div>

                <div class="space-y-3">
                    @foreach($service->faqs as $faq)
                        <details class="group bg-white border border-slate-200 rounded-sm p-4 transition shadow-2xs open:border-emerald-600 [&_summary::-webkit-details-marker]:hidden">
                            <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-slate-900 list-none select-none">
                                <span>{{ $stripEmojis($faq['q'] ?? '') }}</span>
                                <span class="ml-2 w-5 h-5 rounded-xs bg-slate-100 group-open:bg-[#006830] group-open:text-white text-slate-700 flex items-center justify-center text-xs shrink-0 transition">
                                    <svg class="w-3 h-3 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </summary>
                            <p class="text-xs text-slate-600 mt-2.5 pt-2.5 border-t border-slate-100 leading-relaxed">
                                {{ $stripEmojis($faq['a'] ?? '') }}
                            </p>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 5. CALL TO ACTION FOOTER BANNER -->
    <section class="bg-gradient-to-r from-brand-950 via-[#032c21] to-[#006830] text-white py-12 border-t border-brand-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <h3 class="text-xl sm:text-2xl font-extrabold font-heading">
                Siap Menerbitkan Naskah Anda Bersama Penerbit Persis?
            </h3>
            <p class="text-xs sm:text-sm text-emerald-200 max-w-2xl mx-auto leading-relaxed">
                Dapatkan pendampingan redaksi profesional dari penelaahan naskah, tata letak, legalitas ISBN, hingga pencetakan dan distribusi nasional.
            </p>
            <div class="pt-2 flex justify-center gap-3">
                <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-6 py-2.5 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-sm cursor-pointer">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 448 512">
                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                    </svg>
                    <span>Konsultasi WhatsApp Sekarang</span>
                </a>
            </div>
        </div>
    </section>
@endsection
