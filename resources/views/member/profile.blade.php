<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | PERSIS PERS</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-dark { background-color: #032c21; }
        .brand-green { color: #006830; }
        .input-focus:focus { border-color: #006830; box-shadow: 0 0 0 3px rgba(0,104,48,0.12); outline: none; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }
        .fade-in { animation: fadeIn 0.4s ease both; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 brand-dark text-white flex flex-col shrink-0 hidden lg:flex">
            <div class="px-6 py-5 border-b border-white/10">
                <a href="{{ url('/') }}" class="inline-block transition hover:opacity-90">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official_transparent.png') }}" alt="PERSIS PERS" class="h-10 w-auto brightness-0 invert" />
                </a>
            </div>

            <div class="px-6 py-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-extrabold text-sm shrink-0 shadow-xs">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ $user->name }}</p>
                        <p class="text-[10px] text-emerald-300 truncate">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1.5">
                <a href="{{ route('member.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition text-emerald-100 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-gauge-high w-4 text-emerald-400"></i> Dashboard
                </a>
                <a href="{{ route('katalog') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition text-emerald-100 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-book-open w-4 text-emerald-400"></i> Katalog Buku
                </a>
                <a href="{{ route('member.profile') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition bg-emerald-700 text-white shadow-xs">
                    <i class="fa-solid fa-user w-4 text-emerald-300"></i> Profil Saya
                </a>
                <a href="{{ url('/kontak') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition text-emerald-100 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-headset w-4 text-emerald-400"></i> Hubungi Redaksi
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-white/10">
                <form method="POST" action="{{ route('member.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold text-red-300 hover:bg-red-900/40 hover:text-red-100 transition">
                        <i class="fa-solid fa-right-from-bracket w-4"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Mobile Topbar -->
            <header class="lg:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-slate-200 shadow-2xs sticky top-0 z-30">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}" alt="PERSIS PERS" class="h-8 w-auto" />
                </a>
                <a href="{{ route('member.dashboard') }}" class="text-xs font-bold text-emerald-700 hover:underline">
                    &larr; Dashboard
                </a>
            </header>

            <main class="flex-1 p-6 lg:p-8 fade-in max-w-4xl w-full mx-auto">

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-2.5 text-xs sm:text-sm text-emerald-800 font-semibold shadow-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-8">
                    <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900">Profil & Pengaturan Akun</h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Perbarui informasi kontak dan kata sandi akun member Anda.</p>
                </div>

                <div class="space-y-6">

                    <!-- Update Profile Form -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs">
                        <h3 class="font-bold text-slate-900 text-sm mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                            <i class="fa-solid fa-user-pen text-emerald-700"></i> Informasi Pribadi
                        </h3>

                        <form method="POST" action="{{ route('member.profile.update') }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="input-focus w-full px-3.5 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                                    required>
                                @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Email <span class="text-slate-400 font-normal">(tidak dapat diubah)</span></label>
                                <input type="email" value="{{ $user->email }}" disabled
                                    class="w-full px-3.5 py-2.5 text-xs sm:text-sm border border-slate-200 bg-slate-50 text-slate-500 rounded-xl cursor-not-allowed">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">No. WhatsApp</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                    placeholder="08xxxxxxxxxx"
                                    class="input-focus w-full px-3.5 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium">
                                @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit"
                                class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white font-bold text-xs rounded-xl transition shadow-xs">
                                Simpan Perubahan Profil
                            </button>
                        </form>
                    </div>

                    <!-- Update Password Form -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-7 shadow-xs">
                        <h3 class="font-bold text-slate-900 text-sm mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                            <i class="fa-solid fa-lock text-emerald-700"></i> Ganti Kata Sandi
                        </h3>

                        <form method="POST" action="{{ route('member.profile.password') }}" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                                <input type="password" name="current_password"
                                    placeholder="Masukkan kata sandi saat ini"
                                    class="input-focus w-full px-3.5 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                                    required>
                                @error('current_password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                                <input type="password" name="password"
                                    placeholder="Minimal 8 karakter"
                                    class="input-focus w-full px-3.5 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                                    required>
                                @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation"
                                    placeholder="Ulangi kata sandi baru"
                                    class="input-focus w-full px-3.5 py-2.5 text-xs sm:text-sm border border-slate-200 rounded-xl transition font-medium"
                                    required>
                            </div>

                            <button type="submit"
                                class="px-5 py-2.5 bg-slate-900 hover:bg-[#032c21] text-white font-bold text-xs rounded-xl transition shadow-xs">
                                Perbarui Kata Sandi
                            </button>
                        </form>
                    </div>

                </div>

            </main>
        </div>
    </div>

</body>
</html>
