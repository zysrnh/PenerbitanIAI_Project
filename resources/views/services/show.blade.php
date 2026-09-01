@extends('layouts.app')

@section('title', $service->title . ' - Layanan Penerbit Persis')

@section('content')
    <!-- 1. HERO BANNER (IDENTIK DENGAN TENTANG KAMI & BERANDA) -->
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
                <i class="{{ $service->icon }} mr-1.5 text-lime-300"></i> LAYANAN PENERBIT PERSIS
            </span>
            
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl text-white">
                {{ $service->title }}
            </h1>

            @if($service->tagline)
                <p class="text-sm sm:text-base text-emerald-200 font-medium italic mt-2.5 max-w-3xl">
                    {{ $service->tagline }}
                </p>
            @endif

            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-3xl leading-relaxed">
                {{ $service->short_desc }}
            </p>

            <!-- Quick Action Buttons -->
            <div class="pt-6 flex flex-wrap items-center gap-3.5">
                <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-sm border border-emerald-600 cursor-pointer">
                    <i class="fa-brands fa-whatsapp text-base text-lime-300"></i>
                    <span>{{ $service->cta_text ?: 'Konsultasi Layanan via WhatsApp' }}</span>
                </a>

                <a href="{{ route('kontak') }}" class="px-4 py-2.5 bg-brand-900/70 hover:bg-brand-900 text-slate-200 hover:text-white rounded-sm text-xs font-bold transition flex items-center gap-2 border border-slate-700 cursor-pointer">
                    <i class="fa-regular fa-envelope text-xs"></i>
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
                            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Ringkasan Layanan</span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-heading">
                                        Mengenal {{ $service->title }}
                                    </h2>
                                </div>
                            </div>
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3 font-normal whitespace-pre-line text-justify">
                                {!! nl2br(e($service->overview)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- B. Fasilitas & Cakupan Layanan -->
                    @if(!empty($service->features) && count($service->features) > 0)
                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs space-y-5">
                            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-list-check"></i>
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
                                    @endphp
                                    <div class="p-3.5 rounded-sm bg-slate-50/80 border border-slate-200/90 flex items-start gap-3 hover:border-emerald-500 hover:bg-emerald-50/30 transition duration-150">
                                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm shrink-0 mt-0.5"></i>
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
                                    if (!empty($cleaned)) {
                                        $benefitList[] = $cleaned;
                                    }
                                }
                            }
                        @endphp

                        <div class="bg-white p-6 sm:p-8 rounded-sm border border-slate-200 shadow-2xs space-y-5">
                            <div class="flex items-center gap-2.5 pb-3 border-b border-slate-100">
                                <div class="w-8 h-8 rounded-xs bg-emerald-50 text-[#006830] flex items-center justify-center text-sm">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Keunggulan &amp; Spesifikasi</span>
                                    <h2 class="text-base sm:text-lg font-bold text-slate-900 font-heading">
                                        {{ $benefitTitle ?: 'Keunggulan Layanan Penerbit Persis' }}
                                    </h2>
                                </div>
                            </div>

                            @if(count($benefitList) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                    @foreach($benefitList as $b)
                                        <div class="p-3.5 rounded-sm bg-white border border-slate-200/90 shadow-2xs flex items-start gap-3 hover:border-emerald-600 transition">
                                            <div class="w-7 h-7 rounded-xs bg-emerald-100/70 text-emerald-800 flex items-center justify-center text-xs shrink-0 font-bold mt-0.5">
                                                <i class="fa-solid fa-star text-[10px] text-amber-500"></i>
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
                                    {!! nl2br(e($service->benefits)) !!}
                                </div>
                            @endif

                            @if($service->notes)
                                <div class="mt-4 p-3.5 bg-amber-50/90 border border-amber-200/90 rounded-sm text-amber-900 flex items-start gap-2.5">
                                    <i class="fa-solid fa-circle-info text-amber-600 text-sm shrink-0 mt-0.5"></i>
                                    <div class="text-xs leading-relaxed text-amber-950">
                                        <strong class="font-bold text-amber-800 block text-[10.5px] uppercase tracking-wider mb-0.5">Catatan Penting:</strong>
                                        {!! nl2br(e($service->notes)) !!}
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
                                    <i class="fa-solid fa-circle-check text-emerald-600 text-[10px]"></i> ISBN Resmi Perpusnas
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
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                                <span>Hubungi Redaksi via WA</span>
                            </a>

                            <a href="{{ route('kontak') }}" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 border border-slate-200 cursor-pointer">
                                <i class="fa-regular fa-envelope text-xs"></i>
                                <span>Form Pengajuan Naskah</span>
                            </a>
                        </div>

                        <div class="flex items-center justify-center gap-2 text-[10.5px] font-semibold text-emerald-700 pt-1">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
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
                                        <i class="fa-solid fa-arrow-right text-[10px] text-slate-400 group-hover:text-emerald-700 group-hover:translate-x-0.5 transition-transform"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </section>

    <!-- 3. CIRI KHAS HALAMAN LAYANAN: TAHAPAN KERJA & ALUR PROSES (HORIZONTAL/GRID FLOW) -->
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
                                    {{ $step['title'] ?? '' }}
                                </h3>
                                @if(!empty($step['desc']))
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $step['desc'] }}
                                    </p>
                                @endif
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-200/60 flex items-center gap-1.5 text-[10px] font-semibold text-emerald-700">
                                <i class="fa-solid fa-circle-check text-[9px]"></i>
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
                                <span>{{ $faq['q'] ?? '' }}</span>
                                <span class="ml-2 w-5 h-5 rounded-xs bg-slate-100 group-open:bg-[#006830] group-open:text-white text-slate-700 flex items-center justify-center text-xs shrink-0 transition">
                                    <i class="fa-solid fa-chevron-down group-open:rotate-180 transition-transform"></i>
                                </span>
                            </summary>
                            <p class="text-xs text-slate-600 mt-2.5 pt-2.5 border-t border-slate-100 leading-relaxed">
                                {{ $faq['a'] ?? '' }}
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
                    <i class="fa-brands fa-whatsapp text-base"></i>
                    <span>Konsultasi WhatsApp Sekarang</span>
                </a>
            </div>
        </div>
    </section>
@endsection
