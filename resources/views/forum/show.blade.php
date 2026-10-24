@extends('layouts.app')

@section('title', $question->title . ' | Tanya Jawab Forum Agama')

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

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-300 text-emerald-900 rounded-sm text-xs sm:text-sm flex items-start gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-700 text-base shrink-0 mt-0.5"></i>
                    <div>
                        <strong class="font-bold">Berhasil!</strong>
                        <p class="mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-300 text-red-900 rounded-sm text-xs flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-600 text-base shrink-0 mt-0.5"></i>
                    <div>
                        <strong class="font-bold">Perhatian:</strong>
                        <ul class="list-disc list-inside mt-1 space-y-0.5">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left: Question & Discussion Thread (8 cols) -->
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
                            <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-xs border border-emerald-200">
                                <i class="fa-regular fa-comments text-[11px]"></i> {{ $question->answers->count() + (!empty($question->answer) ? 1 : 0) }} Tanggapan
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

                    <!-- 1. Kotak Pertanyaan Lengkap -->
                    <div class="bg-slate-50 p-5 sm:p-6 rounded-sm border border-slate-200 space-y-3">
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-700 uppercase tracking-wider">
                            <i class="fa-solid fa-circle-question text-emerald-700"></i>
                            <span>Pertanyaan Lengkap</span>
                        </div>
                        <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line font-normal">
                            {{ $question->question }}
                        </div>
                    </div>

                    <!-- 2. Kotak Jawaban Resmi Narasumber (Jika Ada) -->
                    @if(!empty($question->answer))
                        <div class="bg-white p-5 sm:p-7 rounded-sm border-2 border-emerald-700 shadow-xs space-y-4">
                            
                            <!-- Header Jawaban Narasumber -->
                            <div class="flex items-start sm:items-center justify-between gap-3 pb-3 border-b border-emerald-100 flex-col sm:flex-row">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-xs bg-[#006830] text-white flex items-center justify-center text-sm font-bold shadow-2xs shrink-0">
                                        <i class="fa-solid fa-scale-balanced"></i>
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-bold text-emerald-800 uppercase tracking-widest block">Ulasan / Jawaban Narasumber Resmi</span>
                                        <span class="text-xs sm:text-sm font-black text-slate-900 font-heading">
                                            {{ $question->answered_by ?: 'Ust. Gianjar Nugraha, M.Sy.' }}
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
                    @endif

                    <!-- 3. Thread Tanggapan & Jawaban Forum Komunitas -->
                    <div class="pt-4 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2 uppercase tracking-wide">
                                <i class="fa-solid fa-comments text-emerald-700"></i>
                                <span>Jawaban &amp; Diskusi Forum ({{ $question->answers->count() }})</span>
                            </h3>
                            <a href="#formJawaban" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-1">
                                <i class="fa-solid fa-pen text-[10px]"></i>
                                <span>Tulis Jawaban</span>
                            </a>
                        </div>

                        @if($question->answers->count() > 0)
                            <div class="space-y-4">
                                @foreach($question->answers as $index => $answer)
                                    <div class="p-4 sm:p-5 bg-white border {{ $answer->is_official ? 'border-emerald-300 bg-emerald-50/20' : 'border-slate-200' }} rounded-sm space-y-3">
                                        
                                        <!-- Header Tanggapan -->
                                        <div class="flex items-center justify-between gap-2 flex-wrap">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8 h-8 rounded-sm {{ $answer->is_official ? 'bg-emerald-700 text-white' : 'bg-slate-200 text-slate-700' }} flex items-center justify-center text-xs font-bold shrink-0">
                                                    {{ strtoupper(substr($answer->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-xs font-bold text-slate-900">{{ $answer->name }}</span>
                                                        @if($answer->is_official)
                                                            <span class="px-1.5 py-0.5 rounded-xs text-[9px] font-bold bg-emerald-600 text-white uppercase tracking-wider">
                                                                Narasumber / Asatidz
                                                            </span>
                                                        @else
                                                            <span class="px-1.5 py-0.5 rounded-xs text-[9px] font-semibold bg-slate-100 text-slate-600">
                                                                Anggota Forum
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <span class="text-[10px] text-slate-400 block">
                                                        {{ $answer->created_at ? $answer->created_at->diffForHumans() : '-' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="text-[10px] font-mono text-slate-400">#{{ $index + 1 }}</span>
                                        </div>

                                        <!-- Isi Tanggapan -->
                                        <div class="text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line pl-1 sm:pl-10">
                                            {{ $answer->answer }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-5 bg-slate-50 border border-dashed border-slate-300 rounded-sm text-center text-slate-500 space-y-1">
                                <i class="fa-regular fa-comment-dots text-2xl text-slate-400 mb-1"></i>
                                <p class="text-xs font-semibold text-slate-700">Belum ada jawaban dari anggota forum lainnya.</p>
                                <p class="text-[11px] text-slate-500">Jadilah yang pertama memberikan jawaban, ulasan dalil, atau tanggapan untuk pertanyaan ini.</p>
                            </div>
                        @endif
                    </div>

                    <!-- 4. Form Tulis Tanggapan / Jawaban -->
                    <div id="formJawaban" class="p-5 sm:p-6 bg-slate-50 border border-slate-200 rounded-sm space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900 flex items-center gap-2">
                                    <i class="fa-solid fa-reply text-emerald-700"></i>
                                    <span>Tuliskan Jawaban atau Tanggapan Anda</span>
                                </h4>
                                <p class="text-[11px] text-slate-500 mt-0.5">
                                    Berikan penjelasan, sudut pandang hukum, atau dalil yang bermanfaat untuk menjawab pertanyaan ini.
                                </p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('forum.answer.store', $question->slug) }}" class="space-y-4">
                            @csrf

                            @auth
                                <div class="p-3 bg-white border border-slate-200 rounded-sm flex items-center justify-between text-xs text-slate-700">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-xs bg-[#006830] text-white flex items-center justify-center text-[10px] font-bold">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <span>Menjawab sebagai: <strong class="text-slate-900">{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})</span>
                                    </div>
                                    <span class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider">Member Aktif</span>
                                </div>
                            @else
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-slate-800" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Email (Opsional)</label>
                                        <input type="email" name="email" value="{{ old('email') }}" placeholder="alamat@email.com" class="w-full px-3 py-2 text-xs rounded-sm border border-slate-300 bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-slate-800" />
                                    </div>
                                </div>
                                <div class="text-[11px] text-slate-500">
                                    Sudah punya akun member? <a href="{{ route('member.login') }}" class="text-emerald-700 font-bold hover:underline">Masuk di sini</a> agar riwayat jawaban tersimpan.
                                </div>
                            @endauth

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">
                                    Isi Jawaban / Penjelasan Dalil <span class="text-red-500">*</span>
                                </label>
                                <textarea name="answer" rows="5" required placeholder="Tuliskan ulasan hukum, kutipan dalil (Al-Qur'an / Hadits), referensi kitab, atau penjelasan Anda di sini..." class="w-full px-3.5 py-2.5 text-xs rounded-sm border border-slate-300 bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-slate-800 leading-relaxed font-sans">{{ old('answer') }}</textarea>
                            </div>

                            <div class="flex items-center justify-between flex-wrap gap-2 pt-1">
                                <span class="text-[10.5px] text-slate-400">
                                    * Gunakan adab diskusi yang santun sesuai kaidah ilmiah keislaman.
                                </span>
                                <button type="submit" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm transition flex items-center gap-2 cursor-pointer shadow-2xs">
                                    <i class="fa-solid fa-paper-plane text-xs"></i>
                                    <span>Kirim Jawaban Forum</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Share Bar -->
                    <div class="pt-4 border-t border-slate-200 flex items-center justify-between flex-wrap gap-3">
                        <span class="text-xs font-bold text-slate-600">Bagikan Penjelasan Ini:</span>
                        <div class="flex items-center gap-2">
                            <a href="https://wa.me/?text={{ urlencode($question->title . ' - Forum Tanya Jawab PERSIS PERS: ' . url()->current()) }}" target="_blank" class="px-3 py-1.5 bg-[#25D366] text-white rounded-xs text-xs font-bold flex items-center gap-1.5 hover:opacity-90 transition">
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
                    <div class="bg-[#032c21] p-5 rounded-sm border border-emerald-900 text-white space-y-3">
                        <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block">FORUM TANYA JAWAB</span>
                        <h3 class="text-base font-bold font-heading text-white">Punya Pertanyaan Hukum Agama Lainnya?</h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Ajukan problematika ibadah, hukum muamalah, dan fatwa keagamaan Anda agar dapat dibahas bersama dan ditelaah Dewan Asatidz.
                        </p>
                        @auth
                            <a href="{{ route('forum.index') }}?ask=1" class="w-full py-2.5 bg-[#006830] hover:bg-emerald-700 text-white text-xs font-bold rounded-sm transition flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Ajukan Pertanyaan Baru</span>
                            </a>
                        @else
                            <a href="{{ route('member.login') }}" class="w-full py-2.5 bg-[#006830] hover:bg-emerald-700 text-white text-xs font-bold rounded-sm transition flex items-center justify-center gap-2 cursor-pointer shadow-2xs">
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
