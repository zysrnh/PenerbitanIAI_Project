@extends('layouts.app')

@section('title', $question->title . ' | Tanya Jawab Hukum Agama')

@section('content')
    <!-- Breadcrumb & Top Header -->
    <div class="bg-slate-100 border-b border-slate-200 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate-500 flex-wrap">
                <a href="{{ url('/') }}" class="hover:text-emerald-800 transition">Beranda</a>
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <a href="{{ route('forum.index') }}" class="hover:text-emerald-800 transition">Forum Tanya Jawab</a>
                <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i>
                <span class="text-slate-800 font-semibold truncate max-w-xs sm:max-w-md">{{ $question->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content Grid -->
    <section class="py-8 sm:py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Question & Answer (8 cols) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- Article Container -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="px-2.5 py-1 text-xs font-bold uppercase tracking-wider rounded-xs border {{ $question->category_badge_class }}">
                                {{ $question->category }}
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="fa-regular fa-clock text-[11px]"></i> {{ $question->created_at ? $question->created_at->format('d M Y') : '-' }}
                            </span>
                            <span class="text-xs text-slate-400">
                                <i class="fa-regular fa-eye text-[11px]"></i> {{ number_format($question->views_count) }} kali dibaca
                            </span>
                        </div>

                        <h1 class="text-xl sm:text-2xl md:text-3xl font-black font-heading text-slate-900 leading-tight">
                            {{ $question->title }}
                        </h1>

                        <!-- Info Penanya -->
                        <div class="flex items-center gap-2 text-xs text-slate-500 pb-4 border-b border-slate-100">
                            <i class="fa-solid fa-user-circle text-slate-400 text-sm"></i>
                            <span>Diajukan oleh: <strong class="text-slate-800">{{ $question->name }}</strong></span>
                        </div>
                    </div>

                    <!-- 1. Kotak Pertanyaan Umat -->
                    <div class="bg-slate-50 p-5 sm:p-6 rounded-sm border border-slate-200 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-700 uppercase tracking-wider">
                            <i class="fa-solid fa-circle-question text-emerald-700"></i>
                            <span>Pertanyaan Lengkap</span>
                        </div>
                        <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line font-normal">
                            {{ $question->question }}
                        </div>
                    </div>

                    <!-- 2. Kotak Jawaban & Keputusan Hukum -->
                    @if(!empty($question->answer))
                        <div class="bg-white p-5 sm:p-7 rounded-sm border-2 border-emerald-700/80 shadow-sm space-y-4">
                            
                            <!-- Header Jawaban -->
                            <div class="flex items-start sm:items-center justify-between gap-3 pb-3 border-b border-emerald-100 flex-col sm:flex-row">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-xs bg-[#006830] text-white flex items-center justify-center text-sm font-bold shadow-2xs shrink-0">
                                        <i class="fa-solid fa-scale-balanced"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-widest block">Ulasan / Jawaban Hukum Resmi</span>
                                        <span class="text-xs sm:text-sm font-black text-slate-900 font-heading">
                                            {{ $question->answered_by ?: 'Dewan Hisbah / Redaksi PERSIS PERS' }}
                                        </span>
                                    </div>
                                </div>
                                @if($question->answered_at)
                                    <span class="text-[11px] text-slate-500 font-mono bg-emerald-50 px-2 py-0.5 rounded-xs border border-emerald-200">
                                        <i class="fa-regular fa-calendar-check text-emerald-700 mr-1"></i> {{ $question->answered_at->format('d M Y') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Isi Jawaban & Dalil -->
                            <div class="text-xs sm:text-sm text-slate-800 leading-relaxed space-y-3 whitespace-pre-line">
                                {{ $question->answer }}
                            </div>

                            <!-- Footer Disclaimer Istifta -->
                            <div class="pt-4 border-t border-slate-100 text-[11px] text-slate-400 italic">
                                * Fatwa dan telaah hukum ini didasarkan pada dalil nash Al-Qur'an dan As-Sunnah Ash-Shahihah sesuai kaidah pemahaman Dewan Redaksi &amp; Dewan Hisbah PERSIS.
                            </div>
                        </div>
                    @else
                        <!-- State Menunggu Jawaban -->
                        <div class="p-6 rounded-sm bg-amber-50 border border-amber-200 text-amber-900 text-xs sm:text-sm space-y-2">
                            <div class="flex items-center gap-2 font-bold">
                                <i class="fa-solid fa-hourglass-half text-amber-600"></i>
                                <span>Menunggu Telaah Dewan Redaksi</span>
                            </div>
                            <p class="text-xs text-amber-800 leading-relaxed">
                                Pertanyaan ini telah dicatat dan saat ini sedang ditelaah oleh Dewan Asatidz / Redaksi PERSIS PERS. Jawaban resmi akan segera dimuat di halaman ini.
                            </p>
                        </div>
                    @endif

                    <!-- Share Bar -->
                    <div class="pt-4 border-t border-slate-200 flex items-center justify-between flex-wrap gap-3">
                        <span class="text-xs font-bold text-slate-600">Bagikan Penjelasan Ini:</span>
                        <div class="flex items-center gap-2">
                            <a href="https://wa.me/?text={{ urlencode($question->title . ' - Baca selengkapnya di PERSIS PERS: ' . url()->current()) }}" target="_blank" class="px-3 py-1.5 bg-[#25D366] text-white rounded-xs text-xs font-bold flex items-center gap-1.5 hover:opacity-90 transition">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>WhatsApp</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-3 py-1.5 bg-[#1877F2] text-white rounded-xs text-xs font-bold flex items-center gap-1.5 hover:opacity-90 transition">
                                <i class="fa-brands fa-facebook-f text-xs"></i>
                                <span>Facebook</span>
                            </a>
                            <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xs text-xs font-bold flex items-center gap-1.5 transition cursor-pointer">
                                <i class="fa-solid fa-link text-xs"></i>
                                <span>Salin Tautan</span>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Right: Sidebar (4 cols) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Call To Action: Tanya Masalah Agama -->
                    <div class="bg-brand-950 p-5 rounded-sm border border-brand-900 text-white space-y-3">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">KONSULTASI AGAMA</span>
                        <h3 class="text-base font-bold font-heading text-white">Memiliki Pertanyaan Hukum Agama Lainnya?</h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Ajukan problematika ibadah, hukum muamalah, dan fatwa keagamaan Anda kepada tim redaksi &amp; asatidz kami.
                        </p>
                        @auth
                            <a href="{{ route('forum.index') }}?ask=1" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-sm transition flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Ajukan Pertanyaan Baru</span>
                            </a>
                        @else
                            <a href="{{ route('member.login') }}" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-sm transition flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
                                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                                <span>Login untuk Bertanya</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Related Questions List -->
                    <div class="bg-white p-5 rounded-sm border border-slate-200 shadow-2xs space-y-3.5">
                        <h4 class="text-xs font-extrabold uppercase tracking-wider text-slate-900 border-b border-slate-100 pb-2.5 flex items-center gap-2">
                            <i class="fa-solid fa-list-ul text-emerald-600"></i>
                            <span>Tanya Jawab Terkait</span>
                        </h4>

                        <div class="space-y-3 divide-y divide-slate-100">
                            @foreach($relatedQuestions as $rq)
                                <div class="pt-3 first:pt-0">
                                    <span class="text-[9.5px] font-bold uppercase tracking-wider text-emerald-800 block mb-0.5">
                                        {{ $rq->category }}
                                    </span>
                                    <a href="{{ route('forum.show', $rq->slug) }}" class="text-xs font-bold text-slate-800 hover:text-emerald-800 transition line-clamp-2 leading-snug">
                                        {{ $rq->title }}
                                    </a>
                                    <span class="text-[10.5px] text-slate-400 block mt-1">
                                        <i class="fa-regular fa-clock text-[9px]"></i> {{ $rq->created_at ? $rq->created_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-2 border-t border-slate-100">
                            <a href="{{ route('forum.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-950 flex items-center justify-between">
                                <span>Lihat Semua Tanya Jawab</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
