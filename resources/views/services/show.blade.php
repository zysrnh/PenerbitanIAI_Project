@extends('layouts.app')

@section('title', $service->title . ' - Penerbit Persis')

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
                <i class="{{ $service->icon }} mr-1.5 text-lime-300"></i> LAYANAN RESMI PENERBIT PERSIS
            </span>
            
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold font-heading tracking-tight leading-tight max-w-4xl text-white">
                {{ $service->title }}
            </h1>

            @if($service->tagline)
                <p class="text-sm sm:text-base text-emerald-200 font-medium italic mt-2.5">
                    {{ $service->tagline }}
                </p>
            @endif

            <p class="text-xs sm:text-sm text-slate-300 mt-3 max-w-3xl leading-relaxed">
                {{ $service->short_desc }}
            </p>

            <!-- Action Buttons -->
            <div class="pt-6 flex flex-wrap items-center gap-3.5">
                <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-sm border border-emerald-600 cursor-pointer">
                    <i class="fa-brands fa-whatsapp text-base text-lime-300"></i>
                    <span>{{ $service->cta_text ?: 'Konsultasi Naskah Sekarang' }}</span>
                </a>

                <a href="{{ route('kontak') }}" class="px-4 py-2.5 bg-brand-900/70 hover:bg-brand-900 text-slate-200 hover:text-white rounded-sm text-xs font-bold transition flex items-center gap-2 border border-slate-700 cursor-pointer">
                    <i class="fa-regular fa-envelope text-xs"></i>
                    <span>Kirim Draf Naskah</span>
                </a>
            </div>

        </div>
    </section>

    <!-- 2. STATS & HIGHLIGHT BAR (OVERLAPPING 4 CARDS) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center reveal-card">
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700 font-heading">100%</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Legalitas ISBN Resmi</span>
            </div>
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center reveal-card">
                <span class="block text-2xl sm:text-3xl font-extrabold text-brand-950 font-heading">Standar</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">KUM &amp; Akademik</span>
            </div>
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center reveal-card">
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700 font-heading">Terarah</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Didampingi Redaksi</span>
            </div>
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-md text-center reveal-card">
                <span class="block text-2xl sm:text-3xl font-extrabold text-brand-950 font-heading">Nasional</span>
                <span class="text-[10px] sm:text-xs text-slate-500 font-semibold uppercase tracking-wider mt-1 block">Cetak &amp; Distribusi</span>
            </div>
        </div>
    </section>

    <!-- 3. RINGKASAN & DESKRIPSI UTAMA LAYANAN -->
    @if($service->overview)
        <section class="py-14 sm:py-16 bg-white">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-4">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block">Mengenal Layanan</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight leading-snug">
                        {{ $service->title }} Penerbit Persis
                    </h2>
                    <div class="text-xs sm:text-sm text-slate-700 leading-relaxed space-y-3 font-normal whitespace-pre-line text-justify pt-1">
                        {!! nl2br(e($service->overview)) !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- 4. CAKUPAN & PILAR FASILITAS LAYANAN (GRID KARTU VISUAL) -->
    @if(!empty($service->features) && count($service->features) > 0)
        <section class="py-14 sm:py-18 bg-slate-50 border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-10">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Cakupan &amp; Fasilitas</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        Apa Saja yang Kami Layani?
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2">
                        Beragam cakupan fasilitas dan dukungan komprehensif yang disediakan oleh Penerbit Persis.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
                    @foreach($service->features as $feat)
                        <div class="bg-white p-5 rounded-sm border border-slate-200 hover:border-emerald-600 shadow-2xs hover:shadow-md transition-all duration-200 flex items-start gap-4 group">
                            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-[#006830] group-hover:bg-[#006830] group-hover:text-white flex items-center justify-center text-sm shrink-0 transition shadow-2xs">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-xs sm:text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition leading-snug">
                                    {{ $feat }}
                                </h3>
                                <p class="text-[11px] text-slate-500 leading-relaxed">
                                    Dikelola dan didampingi secara profesional oleh tim redaksi Penerbit Persis.
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- 5. ALUR & TAHAPAN PELAKSANAAN (BAGAN VISUAL PROSES ROADMAP) -->
    @if(!empty($service->workflow_steps) && count($service->workflow_steps) > 0)
        <section class="py-14 sm:py-20 bg-white border-t border-slate-200/80">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Alur &amp; Prosedur Kerja</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading tracking-tight">
                        Tahapan Pelaksanaan Layanan
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2">
                        Proses terstruktur, transparan, dan mudah dipantau dari penyerahan draf awal hingga terbit.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                    @foreach($service->workflow_steps as $step)
                        <div class="bg-slate-50 p-6 rounded-sm border border-slate-200 hover:border-emerald-600 hover:bg-white hover:shadow-md transition-all duration-200 flex flex-col justify-between group">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <div class="w-9 h-9 rounded-sm bg-[#006830] text-white flex items-center justify-center text-xs font-black font-mono shadow-2xs group-hover:scale-105 transition">
                                        {{ $step['step'] ?? $loop->iteration }}
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider font-mono">
                                        Tahap {{ $step['step'] ?? $loop->iteration }}
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition mb-2">
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

    <!-- 6. KEUNGGULAN & MANFAAT (GRID 4 NILAI UTAMA) -->
    @if($service->benefits)
        <section class="py-14 sm:py-18 bg-gradient-to-br from-[#032c21] via-[#023828] to-[#006830] text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-10">
                    <span class="text-xs font-bold text-lime-300 uppercase tracking-widest block mb-1">Keunggulan Lembaga</span>
                    <h2 class="text-2xl sm:text-3xl font-black font-heading text-white tracking-tight">
                        Keuntungan Menggunakan Layanan Kami
                    </h2>
                </div>

                <div class="max-w-4xl mx-auto bg-white/10 border border-white/15 p-6 sm:p-8 rounded-sm backdrop-blur-xs text-xs sm:text-sm text-emerald-100 leading-relaxed whitespace-pre-line space-y-2">
                    {!! nl2br(e($service->benefits)) !!}
                </div>

                @if($service->notes)
                    <div class="max-w-4xl mx-auto mt-4 bg-amber-400/15 border border-amber-400/30 p-4 rounded-sm text-amber-200 text-xs flex items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-amber-300 text-base shrink-0 mt-0.5"></i>
                        <div>
                            <span class="font-bold uppercase tracking-wider block text-amber-300 text-[10px]">Catatan Penting</span>
                            <div class="mt-0.5">{!! nl2br(e($service->notes)) !!}</div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <!-- 7. FAQ & KONSULTASI LANGSUNG REDAKSI -->
    <section class="py-14 sm:py-18 bg-slate-50 border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: FAQ Accordions (col-span-7) -->
                <div class="lg:col-span-7 space-y-4">
                    <div>
                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest block mb-1">Tanya Jawab</span>
                        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-heading">
                            Pertanyaan yang Sering Diajukan
                        </h2>
                    </div>

                    @if(!empty($service->faqs) && count($service->faqs) > 0)
                        <div class="space-y-3 pt-2">
                            @foreach($service->faqs as $faq)
                                <details class="group bg-white border border-slate-200 rounded-sm p-4 transition shadow-2xs open:border-emerald-600 [&_summary::-webkit-details-marker]:hidden">
                                    <summary class="flex items-center justify-between cursor-pointer font-bold text-xs sm:text-sm text-slate-900 list-none select-none">
                                        <span>{{ $faq['q'] ?? '' }}</span>
                                        <span class="ml-2 w-5 h-5 rounded-xs bg-slate-100 group-open:bg-[#006830] group-open:text-white text-slate-600 flex items-center justify-center text-xs shrink-0 transition">
                                            <i class="fa-solid fa-chevron-down group-open:rotate-180 transition-transform"></i>
                                        </span>
                                    </summary>
                                    <p class="text-xs text-slate-600 mt-2.5 pt-2.5 border-t border-slate-100 leading-relaxed">
                                        {{ $faq['a'] ?? '' }}
                                    </p>
                                </details>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white p-5 rounded-sm border border-slate-200 text-xs text-slate-500">
                            Belum ada FAQ khusus untuk layanan ini. Anda dapat langsung bertanya kepada tim redaksi melalui kontak WhatsApp kami.
                        </div>
                    @endif
                </div>

                <!-- Right: Contact CTA Box (col-span-5) -->
                <div class="lg:col-span-5 bg-white p-6 sm:p-7 rounded-sm border border-slate-200 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-sm bg-emerald-50 text-[#006830] flex items-center justify-center text-xl shadow-2xs">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Layanan Konsultasi</span>
                        <h3 class="text-lg font-bold text-slate-900 font-heading">
                            Konsultasikan Naskah Anda
                        </h3>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Tim redaksi Penerbit Persis siap membantu proses penerbitan, konversi karya ilmiah, maupun pengurusan legalitas ISBN naskah Anda.
                        </p>
                    </div>

                    <div class="space-y-2.5 pt-2">
                        <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Halo Redaksi Penerbit Persis, saya ingin konsultasi mengenai ' . $service->title) }}" target="_blank" class="w-full py-3 bg-[#25D366] hover:bg-[#20bd5a] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Chat WhatsApp Redaksi</span>
                        </a>

                        <a href="{{ route('kontak') }}" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 border border-slate-200 cursor-pointer">
                            <i class="fa-regular fa-envelope text-xs"></i>
                            <span>Kirim Draf Naskah via Form</span>
                        </a>
                    </div>

                    <!-- Directory of Other Services -->
                    @if(isset($otherServices) && count($otherServices) > 0)
                        <div class="pt-4 border-t border-slate-100 space-y-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Layanan Lainnya:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($otherServices as $oth)
                                    <a href="{{ route('layanan.show', $oth->slug) }}" class="px-2.5 py-1 rounded-xs bg-slate-100 hover:bg-emerald-50 hover:text-emerald-800 text-slate-700 text-xs font-semibold border border-slate-200 transition">
                                        {{ $oth->title }} &rarr;
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
