@extends('layouts.app')

@section('title', 'Forum Tanya Jawab Hukum Agama | PERSIS PERS')

@section('content')
    <!-- 1. Header Banner (Solid Flat & Clean) -->
    <section class="bg-brand-950 text-white py-10 sm:py-14 border-b border-brand-900 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-900/60 border border-emerald-700/60 text-emerald-300 text-[10px] sm:text-xs font-bold uppercase tracking-widest rounded-xs mb-3">
                    <i class="fa-solid fa-scale-balanced text-emerald-400"></i>
                    FORUM TANYA JAWAB &amp; ISTIFTA
                </span>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black font-heading tracking-tight text-white mb-2.5 sm:mb-3">
                    Forum Tanya Jawab Bersama Ust. Gianjar Nugraha, M.Sy.
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-6">
                    Rubrik edukasi keislaman dari PERSIS PERS seputar permasalahan Fiqih, Ibadah, Muamalah, serta Problematika Hukum keagamaan kontemporer berlandaskan Al-Qur’an dan As-Sunnah bersama narasumber <strong class="text-emerald-300 font-bold">Ust. Gianjar Nugraha, M.Sy.</strong>
                </p>

                <!-- Action Bar: Tombol Ajukan & Quick WA -->
                <div class="flex items-center gap-3 flex-wrap">
                    <button type="button" onclick="openAskModal()" class="px-4 sm:px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-sm transition flex items-center gap-2 cursor-pointer shadow-2xs">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Ajukan Pertanyaan Sekarang</span>
                    </button>
                    @if(!empty($cleanWa))
                    <a href="https://wa.me/{{ $cleanWa }}?text={{ urlencode('Assalamualaikum Redaksi PERSIS PERS, saya ingin konsultasi hukum agama:') }}" target="_blank" class="px-4 py-2.5 bg-white/10 hover:bg-white/20 text-white text-xs font-bold rounded-sm border border-white/20 transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i>
                        <span>Konsultasi via WhatsApp</span>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Main Content & Listing Section -->
    <section class="py-8 sm:py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-sm bg-emerald-50 border border-emerald-300 text-emerald-900 text-xs sm:text-sm font-semibold flex items-start gap-3 shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base mt-0.5 shrink-0"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-sm bg-rose-50 border border-rose-300 text-rose-900 text-xs sm:text-sm font-semibold flex items-start gap-3 shadow-2xs">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-base mt-0.5 shrink-0"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            <!-- Search Bar & Filters Grid -->
            <div class="bg-white p-4 sm:p-5 rounded-sm border border-slate-200 shadow-2xs mb-6 sm:mb-8">
                <form action="{{ route('forum.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-3 sm:gap-4 items-center">
                    
                    <!-- Search Input -->
                    <div class="md:col-span-8 relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari masalah hukum, kata kunci, misal: shalat jamaah, waris, zakat..." class="w-full pl-9 pr-4 py-2.5 text-xs rounded-sm border border-slate-300 focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-slate-800" />
                    </div>

                    <!-- Category Filter Dropdown -->
                    <div class="md:col-span-3">
                        <select name="category" onchange="this.form.submit()" class="w-full py-2.5 px-3 text-xs rounded-sm border border-slate-300 bg-white focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 outline-none text-slate-700">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit / Reset -->
                    <div class="md:col-span-1 flex gap-1">
                        <button type="submit" class="w-full py-2.5 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-sm transition flex items-center justify-center cursor-pointer shadow-2xs" title="Cari">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                        @if(request()->filled('q') || request()->filled('category'))
                            <a href="{{ route('forum.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs rounded-sm transition flex items-center justify-center" title="Reset Filter">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Quick Category Badges (Pills) -->
                <div class="mt-3.5 pt-3 border-t border-slate-100 flex items-center gap-1.5 flex-wrap">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mr-1">Kategori:</span>
                    <a href="{{ route('forum.index') }}" class="px-2.5 py-1 text-[11px] rounded-xs font-semibold transition {{ empty(request('category')) ? 'bg-[#006830] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Semua
                    </a>
                    @foreach(array_slice($categories, 0, 5) as $c)
                        <a href="{{ route('forum.index', ['category' => $c]) }}" class="px-2.5 py-1 text-[11px] rounded-xs font-semibold transition {{ request('category') === $c ? 'bg-[#006830] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                            {{ $c }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- 3. Question Cards Feed -->
            <div class="space-y-4">
                @forelse($questions as $q)
                    <article class="bg-white p-5 sm:p-6 rounded-sm border border-slate-200 shadow-2xs hover:border-emerald-600 transition flex flex-col justify-between group">
                        <div>
                            <!-- Header Info Card -->
                            <div class="flex items-center justify-between gap-2 flex-wrap mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-xs border {{ $q->category_badge_class }}">
                                        {{ $q->category }}
                                    </span>
                                    <span class="text-[11px] text-slate-400">
                                        <i class="fa-regular fa-clock text-[10px]"></i> {{ $q->created_at ? $q->created_at->format('d M Y') : '-' }}
                                    </span>
                                </div>
                                <span class="text-[11px] font-medium text-slate-500">
                                    <i class="fa-solid fa-user-pen text-slate-400 text-[10px]"></i> Penanya: <strong class="text-slate-700">{{ $q->name }}</strong>
                                </span>
                            </div>

                            <!-- Title / Pertanyaan Pokok -->
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-emerald-800 transition mb-2">
                                <a href="{{ route('forum.show', $q->slug) }}" class="hover:underline">
                                    {{ $q->title }}
                                </a>
                            </h2>

                            <!-- Uraian Pertanyaan -->
                            <p class="text-xs text-slate-600 leading-relaxed mb-4 line-clamp-2">
                                {{ Str::limit(strip_tags($q->question), 220) }}
                            </p>

                            <!-- Snippet Jawaban / Ulasan Resmi -->
                            @if(!empty($q->answer))
                                <div class="p-3.5 bg-emerald-50/70 border-l-4 border-emerald-700 rounded-r-xs mb-3">
                                    <div class="flex items-center justify-between gap-2 mb-1.5">
                                        <span class="text-[10.5px] font-bold uppercase tracking-wider text-emerald-900 flex items-center gap-1.5">
                                            <i class="fa-solid fa-circle-check text-emerald-700"></i>
                                            <span>Dijawab Oleh: <strong class="text-slate-900">{{ $q->answered_by ?: 'Dewan Hisbah / Redaksi PERSIS PERS' }}</strong></span>
                                        </span>
                                        @if($q->answered_at)
                                            <span class="text-[10px] text-emerald-800 font-mono">
                                                {{ $q->answered_at->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-700 leading-relaxed line-clamp-3">
                                        {{ Str::limit(strip_tags($q->answer), 260) }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer Links -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between mt-2">
                            <span class="text-[11px] text-slate-400 flex items-center gap-1">
                                <i class="fa-regular fa-eye text-[10px]"></i> Dibaca {{ number_format($q->views_count) }} kali
                            </span>
                            <a href="{{ route('forum.show', $q->slug) }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-950 inline-flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">
                                <span>Baca Jawaban &amp; Dalil Lengkap</span>
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
                            <div class="w-8 h-8 rounded-full bg-[#006830] text-white flex items-center justify-center font-bold text-xs shrink-0">
                                {{ Auth::user()->initials ?? 'U' }}
                            </div>
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
                            Pertanyaan yang masuk akan ditelaah dan diverifikasi oleh Dewan Redaksi &amp; Asatidz. Jawaban resmi akan dipublikasikan di halaman Forum Tanya Jawab ini setelah diputuskan.
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
