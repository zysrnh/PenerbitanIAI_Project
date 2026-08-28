<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | PENERBIT PERSIS</title>
        <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=2">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=2">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=2">
    
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
        .input-focus:focus { border-color: #006830; box-shadow: 0 0 0 2px rgba(0,104,48,0.15); outline: none; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) both; }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased flex flex-col lg:flex-row">

    <!-- ==================== SIDEBAR (DESKTOP) ==================== -->
    <aside class="w-64 brand-dark text-white flex-col shrink-0 hidden lg:flex min-h-screen sticky top-0 h-screen z-40 border-r border-white/10">
        
        <!-- Sidebar Brand Logo -->
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-center">
            <a href="{{ url('/') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-13 sm:h-14 w-auto object-contain" />
            </a>
        </div>

        <!-- User Profile Card in Sidebar -->
        <div class="px-5 py-4 border-b border-white/10 bg-black/15">
            <div class="flex items-center gap-3">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-sm object-cover shrink-0 ring-1 ring-emerald-400/40" />
                @else
                    <div class="w-10 h-10 rounded-sm bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-extrabold text-sm shrink-0 shadow-xs ring-1 ring-emerald-500/30">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate leading-snug">{{ $user->name }}</p>
                    <p class="text-[10.5px] text-emerald-300/90 truncate mt-0.5">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
            <a href="{{ route('member.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-gauge-high w-4 text-center text-emerald-400"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('member.orders') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-receipt w-4 text-center text-emerald-400"></i>
                <span>Pesanan Saya</span>
            </a>

            <a href="{{ route('katalog') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-book-open w-4 text-center text-emerald-400"></i>
                <span>Katalog Buku</span>
            </a>

            <a href="{{ route('member.profile') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-bold transition bg-emerald-700 text-white shadow-xs">
                <i class="fa-solid fa-user w-4 text-center text-emerald-200"></i>
                <span>Profil Saya</span>
            </a>

            <a href="{{ url('/kontak') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-headset w-4 text-center text-emerald-400"></i>
                <span>Hubungi Redaksi</span>
            </a>

            <div class="pt-3 pb-1">
                <div class="px-3 text-[10px] font-bold text-emerald-400/60 uppercase tracking-widest">Akses Cepat</div>
            </div>

            <a href="{{ url('/') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-sm text-xs font-medium transition text-slate-300 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center text-slate-400"></i>
                <span>Halaman Utama</span>
            </a>
        </nav>

        <!-- Logout Area -->
        <div class="p-3 border-t border-white/10">
            <form method="POST" action="{{ route('member.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-sm text-xs font-bold text-red-300 hover:bg-red-900/40 hover:text-red-100 transition border border-red-500/20">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">

        <!-- Top Header Bar -->
        <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-3 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            <div class="flex items-center gap-3 lg:hidden">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}" alt="PENERBIT PERSIS" class="h-11 w-auto object-contain" />
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-2 text-xs">
                <a href="{{ route('member.dashboard') }}" class="text-slate-500 hover:text-emerald-700 transition">Dashboard</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                <span class="font-bold text-slate-800">Profil & Pengaturan Akun</span>
            </div>

            <div class="flex items-center gap-2.5">
                <a href="{{ route('member.dashboard') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/50 transition">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-in max-w-4xl w-full mx-auto space-y-5">

            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-sm flex items-center gap-2.5 text-xs sm:text-sm text-emerald-900 font-semibold shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Berhasil!</p>
                        <p class="text-xs text-emerald-800 font-normal mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-black font-heading text-slate-900">Pengaturan Profil & Foto</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola foto avatar, data identitas, dan keamanan kata sandi akun member Anda.</p>
            </div>

            <!-- Profile Info & Avatar Upload Form -->
            <div class="bg-white rounded-sm border border-slate-200 p-5 sm:p-7 shadow-xs">
                <div class="flex items-center gap-2.5 mb-5 pb-3.5 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-sm font-heading">Informasi Akun & Foto Profil</h3>
                        <p class="text-[11px] text-slate-400">Perbarui foto dan identitas Anda untuk layanan pemesanan</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Upload Component -->
                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-sm flex flex-col sm:flex-row items-center gap-5">
                        <div class="relative shrink-0 group">
                            <div id="avatarPreviewContainer" class="w-20 h-20 rounded-sm overflow-hidden bg-slate-200 border-2 border-emerald-700 shadow-2xs flex items-center justify-center">
                                @if($user->avatar_url)
                                    <img id="avatarPreviewImg" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover" />
                                @else
                                    <div id="avatarFallbackText" class="w-full h-full bg-[#032c21] flex items-center justify-center text-white font-extrabold text-2xl">
                                        {{ $user->initials }}
                                    </div>
                                    <img id="avatarPreviewImg" src="" alt="Preview" class="w-full h-full object-cover hidden" />
                                @endif
                            </div>
                            <label for="avatarInput" class="absolute -bottom-1 -right-1 w-7 h-7 bg-emerald-700 hover:bg-[#032c21] text-white rounded-sm flex items-center justify-center cursor-pointer shadow-xs transition">
                                <i class="fa-solid fa-camera text-[11px]"></i>
                            </label>
                        </div>

                        <div class="flex-1 text-center sm:text-left space-y-1.5">
                            <h4 class="text-xs font-bold text-slate-900">Ganti Foto Profil</h4>
                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                Format didukung: JPG, PNG, WEBP, atau SVG. Maksimal ukuran 3MB.
                            </p>
                            <div class="pt-1 flex flex-wrap items-center justify-center sm:justify-start gap-2">
                                <label for="avatarInput" class="px-3 py-1.5 bg-white border border-slate-300 hover:border-emerald-600 text-slate-700 hover:text-emerald-800 rounded-sm text-xs font-semibold cursor-pointer shadow-2xs transition inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-upload text-[10px] text-emerald-700"></i>
                                    <span>Pilih Gambar</span>
                                </label>
                                <input type="file" name="avatar" id="avatarInput" accept="image/*" class="hidden" onchange="previewAvatar(this)" />
                                <span id="avatarFileName" class="text-[11px] text-slate-400 italic">Belum ada file dipilih</span>
                            </div>
                            @error('avatar') <p class="text-xs text-red-600 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="input-focus w-full px-3 py-2 text-xs sm:text-sm border border-slate-200 rounded-sm transition font-medium"
                                required>
                            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                placeholder="08xxxxxxxxxx"
                                class="input-focus w-full px-3 py-2 text-xs sm:text-sm border border-slate-200 rounded-sm transition font-medium">
                            @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Email <span class="text-slate-400 font-normal">(tidak dapat diubah)</span></label>
                        <input type="email" value="{{ $user->email }}" disabled
                            class="w-full px-3 py-2 text-xs sm:text-sm border border-slate-200 bg-slate-50 text-slate-500 rounded-sm cursor-not-allowed">
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 bg-[#006830] hover:bg-[#032c21] text-white font-bold text-xs rounded-sm transition shadow-xs flex items-center gap-1.5">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Form -->
            <div class="bg-white rounded-sm border border-slate-200 p-5 sm:p-7 shadow-xs">
                <div class="flex items-center gap-2.5 mb-5 pb-3.5 border-b border-slate-100">
                    <div class="w-8 h-8 rounded-sm bg-slate-100 text-slate-700 flex items-center justify-center text-sm">
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
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password"
                            placeholder="Masukkan kata sandi saat ini"
                            class="input-focus w-full px-3 py-2 text-xs sm:text-sm border border-slate-200 rounded-sm transition font-medium"
                            required>
                        @error('current_password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi Baru</label>
                            <input type="password" name="password"
                                placeholder="Minimal 8 karakter"
                                class="input-focus w-full px-3 py-2 text-xs sm:text-sm border border-slate-200 rounded-sm transition font-medium"
                                required>
                            @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation"
                                placeholder="Ulangi kata sandi baru"
                                class="input-focus w-full px-3 py-2 text-xs sm:text-sm border border-slate-200 rounded-sm transition font-medium"
                                required>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-slate-100 flex justify-end">
                        <button type="submit"
                            class="px-5 py-2 bg-slate-900 hover:bg-[#032c21] text-white font-bold text-xs rounded-sm transition shadow-xs flex items-center gap-1.5">
                            <i class="fa-solid fa-key"></i>
                            <span>Perbarui Kata Sandi</span>
                        </button>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('avatarPreviewImg');
                    const fallbackText = document.getElementById('avatarFallbackText');
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    if (fallbackText) fallbackText.classList.add('hidden');
                };
                reader.readAsDataURL(file);
                document.getElementById('avatarFileName').textContent = file.name;
            }
        }
    </script>
</body>
</html>
