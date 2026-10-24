@extends('layouts.app')

@section('title', 'Forum Tanya Jawab Hukum Agama | PERSIS PERS')

@section('content')
    <!-- 1. Header Banner (Solid Flat & Clean, Full Width max-w-7xl) -->
    <section class="bg-[#032c21] text-white py-10 sm:py-12 border-b border-emerald-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-3">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-white/10 border border-white/15 text-emerald-300 text-[10.5px] font-bold uppercase tracking-widest rounded-xs">
                    <i class="fa-solid fa-scale-balanced text-emerald-400"></i>
                    FORUM TANYA JAWAB &amp; ISTIFTA
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold font-heading tracking-tight text-white leading-tight">
                    Forum Tanya Jawab Bersama Ust. Gianjar Nugraha, M.Sy.
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                    Rubrik edukasi keislaman dari PERSIS PERS seputar Fiqih, Ibadah, Muamalah, serta Problematika Hukum keagamaan kontemporer berlandaskan Al-Qur’an dan As-Sunnah.
                </p>

                <!-- Action Bar: Tombol Ajukan & Quick WA -->
                <div class="pt-2 flex items-center gap-3 flex-wrap">
                    <button type="button" onclick="openAskModal()" class="px-4 py-2 bg-[#006830] hover:bg-emerald-700 text-white text-xs font-bold rounded-sm transition flex items-center gap-2 cursor-pointer shadow-2xs">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Ajukan Pertanyaan</span>
                    </button>
                    @if(!empty($cleanWa))
                    <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Assalamualaikum Redaksi PERSIS PERS, saya ingin konsultasi hukum agama:') }}" target="_blank" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white text-xs font-bold rounded-sm border border-white/20 transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i>
                        <span>Konsultasi via WhatsApp</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Main Content & Listing Section (Normal Full Width max-w-7xl) -->
    <section class="py-8 sm:py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-5 p-4 rounded-sm bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm font-semibold flex items-start gap-3 shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 shrink-0"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-4 rounded-sm bg-rose-50 border border-rose-300 text-rose-900 text-xs sm:text-sm font-semibold flex items-start gap-3 shadow-2xs">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-base mt-0.5 shrink-0"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <!-- Search Bar & Filters (Clean & Full Width) -->
            <div class="mb-6 space-y-3">
                <form action="{{ route('forum.index') }}" method="GET" class="relative">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        name="q" 
                        value="{{ request('q') }}" 
                        placeholder="Cari masalah hukum, kata kunci, misal: shalat jamaah, waris, zakat..." 
                        class="w-full pl-10 pr-20 py-2.5 sm:py-3 text-xs sm:text-sm rounded-sm border border-slate-300 bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-slate-800 placeholder-slate-400 transition shadow-2xs" 
                    />
                    <div class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-1.5">
                        @if(request()->filled('q'))
                            <a href="{{ route('forum.index', array_filter(['category' => request('category')])) }}" class="p-1 text-slate-400 hover:text-slate-600 text-xs" title="Hapus Pencarian">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif
                        <button type="submit" class="px-3.5 py-1.5 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-xs transition shadow-2xs cursor-pointer">
                            Cari
                        </button>
                    </div>
                </form>

                <!-- Category Tabs (Clean Minimalist Horizontal Scroll) -->
                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 text-xs select-none">
                    <a href="{{ route('forum.index', array_filter(['q' => request('q')])) }}" class="px-3 py-1.5 rounded-xs font-semibold whitespace-nowrap transition {{ empty(request('category')) ? 'bg-[#006830] text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $c)
                        <a href="{{ route('forum.index', array_filter(['category' => $c, 'q' => request('q')])) }}" class="px-3 py-1.5 rounded-xs font-semibold whitespace-nowrap transition {{ request('category') === $c ? 'bg-[#006830] text-white' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">
                            {{ $c }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Question Cards Feed (Clean, Full Width with User Profile Avatar) -->
            <div class="space-y-4">
                @forelse($questions as $q)
                    <article class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 hover:border-emerald-500 hover:shadow-xs transition duration-150 group">
                        
                        <!-- Top Row: User Avatar, Name, Timestamp & Category Badge -->
                        <div class="flex items-center justify-between gap-3 mb-3">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($q->user && $q->user->avatar_url)
                                    <img src="{{ $q->user->avatar_url }}" alt="{{ $q->name }}" class="w-9 h-9 rounded-full object-cover border border-slate-200 shrink-0 ring-1 ring-slate-100" />
                                @else
                                    <div class="w-9 h-9 rounded-full bg-[#006830] text-white flex items-center justify-center text-xs font-bold shrink-0 font-mono uppercase shadow-2xs">
                                        {{ $q->user ? $q->user->initials : strtoupper(substr($q->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <span class="text-xs sm:text-sm font-bold text-slate-800 block leading-tight truncate">{{ $q->name }}</span>
                                    <span class="text-[11px] text-slate-400 block mt-0.5">
                                        {{ $q->created_at ? $q->created_at->diffForHumans() : '-' }}
                                    </span>
                                </div>
                            </div>
                            
                            <span class="px-2.5 py-1 font-bold uppercase tracking-wider text-[10px] rounded-xs border shrink-0 {{ $q->category_badge_class }}">
                                {{ $q->category }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h2 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-emerald-800 transition leading-snug mb-2">
                            <a href="{{ route('forum.show', $q->slug) }}" class="hover:underline">
                                {{ $q->title }}
                            </a>
                        </h2>

                        <!-- Snippet Question Content -->
                        <p class="text-xs sm:text-[13px] text-slate-600 leading-relaxed line-clamp-2 mb-4">
                            {{ Str::limit(strip_tags($q->question), 220) }}
                        </p>

                        <!-- Card Footer: Minimalist Status & Stats -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between flex-wrap gap-2 text-xs">
                            <div class="flex items-center gap-2 flex-wrap">
                                @if(!empty($q->answer))
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-xs text-[10.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        <i class="fa-solid fa-circle-check text-emerald-600 text-[10px]"></i>
                                        <span>Terjawab Resmi</span>
                                    </span>
                                @elseif(($q->answers_count ?? 0) > 0)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-xs text-[10.5px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-comments text-blue-600 text-[10px]"></i>
                                        <span>Ada Tanggapan</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-xs text-[10.5px] font-medium bg-slate-100 text-slate-500 border border-slate-200">
                                        <i class="fa-regular fa-clock text-[10px]"></i>
                                        <span>Menunggu Jawaban</span>
                                    </span>
                                @endif

                                <span class="text-slate-300">&bull;</span>
                                <span class="text-[11.5px] text-slate-500 flex items-center gap-1">
                                    <i class="fa-regular fa-comment-dots text-slate-400"></i>
                                    <strong>{{ ($q->answers_count ?? 0) + (!empty($q->answer) ? 1 : 0) }}</strong> diskusi
                                </span>
                                <span class="text-slate-300">&bull;</span>
                                <span class="text-[11.5px] text-slate-400 flex items-center gap-1">
                                    <i class="fa-regular fa-eye text-[10px]"></i>
                                    {{ number_format($q->views_count) }}x dibaca
                                </span>
                            </div>

                            <a href="{{ route('forum.show', $q->slug) }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 inline-flex items-center gap-1.5 group-hover:translate-x-0.5 transition-transform">
                                <span>Buka Diskusi</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="bg-white p-8 sm:p-12 text-center rounded-sm border border-slate-200 shadow-2xs">
                        <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl mx-auto mb-3">
                            <i class="fa-solid fa-book-quran"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 mb-1">Belum Ada Pertanyaan yang Sesuai</h3>
                        <p class="text-xs text-slate-500 max-w-md mx-auto mb-4">
                            Belum ditemukan fatwa atau tanya jawab untuk kriteria pencarian ini. Anda dapat mengajukan pertanyaan baru kepada Dewan Redaksi.
                        </p>
                        <button type="button" onclick="openAskModal()" class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm transition inline-flex items-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-plus"></i>
                            <span>Ajukan Pertanyaan Baru</span>
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($questions instanceof \Illuminate\Pagination\LengthAwarePaginator && $questions->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $questions->links() }}
                </div>
            @endif

        </div>
    </section>

    <!-- 4. MODAL AJUKAN PERTANYAAN (Clean Flat & Top Level z-[9999]) -->
    <div id="askQuestionModal" class="fixed inset-0 z-[9999] bg-black/75 hidden items-center justify-center p-3 sm:p-5 backdrop-blur-xs overflow-y-auto">
        <div class="bg-white rounded-sm border border-slate-200 shadow-2xl w-full max-w-xl my-auto max-h-[92vh] flex flex-col animate-fade-in-up overflow-hidden">
            
            <!-- Modal Header (Always Visible & Stays on Top) -->
            <div class="p-4 sm:p-5 bg-brand-950 text-white flex items-center justify-between border-b border-brand-900 shrink-0 select-none">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-sm bg-emerald-700 text-white flex items-center justify-center text-base font-bold shadow-2xs shrink-0">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold font-heading text-white leading-tight">
                            @auth
                                Ajukan Pertanyaan Hukum Agama
                            @else
                                Masuk ke Akun untuk Bertanya
                            @endauth
                        </h3>
                        <p class="text-[11px] text-emerald-300 font-medium">Bersama Narasumber Ust. Gianjar Nugraha, M.Sy.</p>
                    </div>
                </div>
                <button type="button" onclick="closeAskModal()" class="w-8 h-8 rounded-sm bg-white/10 hover:bg-white/20 text-slate-300 hover:text-white flex items-center justify-center text-sm transition cursor-pointer" title="Tutup">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body Scrollable -->
            <div class="overflow-y-auto flex-1">
            @auth
                <!-- Modal Form (Khusus Pengguna Login) -->
                <form action="{{ route('forum.store') }}" method="POST" class="p-4 sm:p-5 space-y-4">
                    @csrf

                    <!-- Akun Penanya Terverifikasi -->
                    <div class="p-3 bg-slate-50 border border-slate-200 rounded-xs flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2.5">
                            @if(Auth::user()->avatar_url)
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border border-slate-200 shrink-0" />
                            @else
                                <div class="w-8 h-8 rounded-full bg-[#006830] text-white flex items-center justify-center font-bold text-xs shrink-0 font-mono">
                                    {{ Auth::user()->initials ?? 'U' }}
                                </div>
                            @endif
                            <div class="min-w-0">
                                <span class="text-[9.5px] text-slate-400 font-bold uppercase tracking-wider block">Penanya Terverifikasi</span>
                                <strong class="text-slate-900 truncate block">{{ Auth::user()->name }}</strong>
                                <span class="text-[10.5px] text-slate-500 font-mono">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 shrink-0">
                            <i class="fa-solid fa-check text-[9px]"></i> Aktif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kategori Masalah <span class="text-red-500">*</span></label>
                            <select name="category" required class="w-full text-xs p-2.5 rounded-sm border border-slate-300 bg-white focus:border-emerald-600 outline-none">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp <span class="text-slate-400 font-normal">(opsional)</span></label>
                            <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" placeholder="Contoh: 081234567890" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pokok / Judul Pertanyaan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Hukum Shalat Berjamaah di Rumah bersama Keluarga Saat Sakit" class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 outline-none" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Uraian Lengkap Pertanyaan <span class="text-red-500">*</span></label>
                        <textarea name="question" rows="4" required placeholder="Tuliskan latar belakang masalah atau kondisi nyata yang ditanyakan secara runtut dan jelas agar dapat dijawab secara tepat..." class="w-full text-xs p-2.5 rounded-sm border border-slate-300 focus:border-emerald-600 outline-none leading-relaxed">{{ old('question') }}</textarea>
                    </div>

                    <div class="p-3 bg-amber-50 rounded-xs border border-amber-200 text-amber-900 text-[11px] leading-relaxed flex items-start gap-2">
                        <i class="fa-solid fa-circle-info text-amber-700 mt-0.5 shrink-0"></i>
                        <div>
                            Pertanyaan yang diajukan akan langsung terbit di forum untuk dibahas bersama dan ditelaah oleh Dewan Redaksi &amp; Asatidz.
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-100">
                        <button type="button" onclick="closeAskModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-sm transition cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm shadow-2xs transition flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            <span>Kirim Pertanyaan</span>
                        </button>
                    </div>
                </form>
            @else
                <!-- Modal Prompt Login (Bagi Pengunjung Tanpa Akun) -->
                <div class="p-6 sm:p-8 text-center space-y-4">
                    <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl mx-auto shadow-2xs">
                        <i class="fa-solid fa-user-lock"></i>
                    </div>
                    <div>
                        <h4 class="text-base sm:text-lg font-bold text-slate-900 font-heading">
                            Login atau Buat Akun Terlebih Dahulu
                        </h4>
                        <p class="text-xs text-slate-600 max-w-md mx-auto mt-1.5 leading-relaxed">
                            Untuk menjaga ketertiban forum, validitas kajian hukum, serta memastikan Anda dapat menerima tanggapan atas pertanyaan Anda, Anda harus memiliki akun terlebih dahulu.
                        </p>
                    </div>

                    <div class="pt-3 flex items-center justify-center gap-3 flex-wrap">
                        <a href="{{ route('member.login') }}" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm shadow-2xs transition flex items-center gap-2">
                            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                            <span>Login ke Akun Saya</span>
                        </a>
                        <a href="{{ route('member.register') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold rounded-sm border border-slate-300 transition flex items-center gap-2">
                            <i class="fa-solid fa-user-plus text-xs"></i>
                            <span>Daftar Akun Baru</span>
                        </a>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-[11px] text-slate-400">
                            Pendaftaran member gratis dan dapat digunakan untuk membaca buku digital &amp; transaksi buku.
                        </span>
                    </div>
                </div>
            @endauth
            </div>

        </div>
    </div>

    <script>
        function openAskModal() {
            const modal = document.getElementById('askQuestionModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeAskModal() {
            const modal = document.getElementById('askQuestionModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // Auto-open modal jika URL mengandung ?ask=1
        window.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('ask') === '1') {
                openAskModal();
            }
        });

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAskModal();
            }
        });
    </script>
@endsection
