<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | PERSIS PERS</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#064e3b',
                            950: '#032c21',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .brand-dark { background-color: #032c21; }
        .input-focus:focus { border-color: #006830; box-shadow: 0 0 0 3px rgba(0,104,48,0.12); outline: none; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) both; }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased flex flex-col lg:flex-row">

    <!-- ==================== SIDEBAR (DESKTOP) ==================== -->
    <aside class="w-64 brand-dark text-white flex-col shrink-0 hidden lg:flex min-h-screen sticky top-0 h-screen z-40">
        
        <div class="px-6 py-6 border-b border-white/10 flex items-center justify-center">
            <a href="{{ url('/') }}" class="inline-block transition hover:opacity-90" title="PERSIS PERS">
                <img src="{{ asset('images/logo/logo_persis_pers_full_official_transparent.png') }}" alt="PERSIS PERS" class="h-10 w-auto brightness-0 invert object-contain" />
            </a>
        </div>

        <div class="px-5 py-4 border-b border-white/10 bg-black/15">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-extrabold text-sm shrink-0 shadow-xs ring-2 ring-emerald-500/30">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate leading-snug">{{ $user->name }}</p>
                    <p class="text-[10.5px] text-emerald-300/90 truncate mt-0.5">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-3.5 py-5 space-y-1.5 overflow-y-auto">
            <a href="{{ route('member.dashboard') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-gauge-high w-4 text-center text-emerald-400"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('katalog') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-book-open w-4 text-center text-emerald-400"></i>
                <span>Katalog Buku</span>
            </a>

            <a href="{{ route('member.profile') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold transition bg-emerald-600/90 text-white shadow-xs">
                <i class="fa-solid fa-user w-4 text-center text-emerald-200"></i>
                <span>Profil Saya</span>
            </a>

            <a href="{{ url('/kontak') }}"
                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-headset w-4 text-center text-emerald-400"></i>
                <span>Hubungi Redaksi</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('member.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-red-300 hover:bg-red-900/40 hover:text-red-100 transition border border-red-500/20">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">

        <header class="bg-white border-b border-slate-200/80 px-4 sm:px-8 py-3.5 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-3 lg:hidden">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}" alt="PERSIS PERS" class="h-8 w-auto object-contain" />
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-2 text-xs">
                <a href="{{ route('member.dashboard') }}" class="text-slate-400 hover:text-slate-600 transition">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                <span class="font-bold text-slate-800">Profil & Pengaturan Akun</span>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('member.dashboard') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/50 transition">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-in max-w-4xl w-full mx-auto space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 text-xs sm:text-sm text-emerald-900 font-semibold shadow-xs">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-check text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-emerald-950">Berhasil!</p>
                        <p class="text-xs text-emerald-800 font-normal mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="mb-6">
                <h1 class="text-xl sm:text-2xl font-black font-heading text-slate-900">Pengaturan Profil & Keamanan</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola data informasi akun dan kata sandi member Anda.</p>
            </div>

            <!-- Profile Info Form -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
                <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm font-heading">Informasi Pribadi Member</h3>
                        <p class="text-[11px] text-slate-400">Data kontak yang digunakan untuk konfirmasi pesanan</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('member.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="input-focus w-full px-4 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                            required>
                        @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Email <span class="text-slate-400 font-normal">(permanen)</span></label>
                        <input type="email" value="{{ $user->email }}" disabled
                            class="w-full px-4 py-2.5 text-xs sm:text-sm border border-slate-200 bg-slate-50 text-slate-500 rounded-xl cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">No. WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                            placeholder="08xxxxxxxxxx"
                            class="input-focus w-full px-4 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium">
                        @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white font-bold text-xs rounded-xl transition shadow-xs">
                            <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Form -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
                <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm font-heading">Perbarui Kata Sandi</h3>
                        <p class="text-[11px] text-slate-400">Pastikan akun Anda terlindungi dengan kata sandi yang aman</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('member.profile.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password"
                            placeholder="Masukkan kata sandi saat ini"
                            class="input-focus w-full px-4 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                            required>
                        @error('current_password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                            <input type="password" name="password"
                                placeholder="Minimal 8 karakter"
                                class="input-focus w-full px-4 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                                required>
                            @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation"
                                placeholder="Ulangi kata sandi baru"
                                class="input-focus w-full px-4 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                                required>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="px-5 py-2.5 bg-slate-900 hover:bg-[#032c21] text-white font-bold text-xs rounded-xl transition shadow-xs">
                            <i class="fa-solid fa-key mr-1.5"></i> Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

</body>
</html>
