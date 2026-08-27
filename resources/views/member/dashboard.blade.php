<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member | PERSIS PERS</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-dark { background-color: #032c21; }
        .brand-green { color: #006830; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }
        .fade-in { animation: fadeIn 0.4s ease both; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <!-- Sidebar + Main Layout -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 brand-dark text-white flex flex-col shrink-0 hidden lg:flex">
            <!-- Logo (Official White/Transparent on Dark) -->
            <div class="px-6 py-5 border-b border-white/10">
                <a href="{{ url('/') }}" class="inline-block transition hover:opacity-90">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official_transparent.png') }}" alt="PERSIS PERS" class="h-10 w-auto brightness-0 invert" />
                </a>
            </div>

            <!-- User Info -->
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

            <!-- Nav -->
            <nav class="flex-1 px-4 py-4 space-y-1.5">
                <a href="{{ route('member.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition bg-emerald-700 text-white shadow-xs">
                    <i class="fa-solid fa-gauge-high w-4 text-emerald-300"></i> Dashboard
                </a>
                <a href="{{ route('katalog') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition text-emerald-100 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-book-open w-4 text-emerald-400"></i> Katalog Buku
                </a>
                <a href="{{ route('member.profile') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition text-emerald-100 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-user w-4 text-emerald-400"></i> Profil Saya
                </a>
                <a href="{{ url('/kontak') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition text-emerald-100 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-headset w-4 text-emerald-400"></i> Hubungi Redaksi
                </a>
            </nav>

            <!-- Logout -->
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
                <div class="flex items-center gap-3">
                    <a href="{{ route('member.profile') }}" class="text-xs font-bold text-slate-700 hover:text-emerald-700">{{ $user->name }}</a>
                    <form method="POST" action="{{ route('member.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 font-bold hover:underline">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8 fade-in max-w-6xl w-full mx-auto">

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-2.5 text-xs sm:text-sm text-emerald-800 font-semibold shadow-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900">Selamat Datang, {{ $user->name }}! ðŸ‘‹</h1>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1">Akses katalog buku, layanan penerbitan, dan profil akun Anda.</p>
                    </div>
                    <a href="{{ route('katalog') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold rounded-xl shadow-xs transition hover:shadow-md">
                        <i class="fa-solid fa-book-bookmark text-xs"></i> Buka Katalog Buku
                    </a>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-700 border border-emerald-100">
                                <i class="fa-solid fa-books text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider">Koleksi Terbitan</p>
                                <p class="text-xl font-black text-slate-900">150+ Judul</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 border border-blue-100">
                                <i class="fa-solid fa-circle-check text-lg"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider">Status Member</p>
                                <p class="text-sm font-extrabold text-emerald-700">Aktif & Terverifikasi âœ“</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center text-amber-700 border border-amber-100">
                                <i class="fa-brands fa-whatsapp text-xl"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider">Konsultasi Naskah</p>
                                <p class="text-sm font-extrabold text-slate-800">Redaksi PERSIS PERS</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <a href="{{ route('katalog') }}"
                        class="group bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs hover:border-emerald-500 hover:shadow-lg transition-all duration-200 flex items-center gap-4">
                        <div class="w-13 h-13 bg-[#032c21] group-hover:bg-[#006830] rounded-2xl flex items-center justify-center transition shrink-0 shadow-xs">
                            <i class="fa-solid fa-magnifying-glass text-white text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition">Jelajahi Katalog Buku</h3>
                            <p class="text-xs text-slate-500 mt-1">Cari karya ilmiah, monograf dosen, dan buku ajar</p>
                        </div>
                        <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 ml-auto transition-transform duration-200 group-hover:translate-x-1"></i>
                    </a>

                    <a href="{{ url('/kontak') }}"
                        class="group bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs hover:border-emerald-500 hover:shadow-lg transition-all duration-200 flex items-center gap-4">
                        <div class="w-13 h-13 bg-slate-900 group-hover:bg-[#032c21] rounded-2xl flex items-center justify-center transition shrink-0 shadow-xs">
                            <i class="fa-solid fa-paper-plane text-white text-base"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900 group-hover:text-emerald-800 transition">Konsultasi & Terbitkan Naskah</h3>
                            <p class="text-xs text-slate-500 mt-1">Layanan pengurusan ISBN, layout, dan cetak</p>
                        </div>
                        <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 ml-auto transition-transform duration-200 group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Profile Info Card -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
                    <div class="flex items-center justify-between mb-5 pb-4 border-b border-slate-100">
                        <h3 class="font-bold text-slate-900 text-sm">Informasi Akun Member</h3>
                        <a href="{{ route('member.profile') }}" class="px-3 py-1.5 rounded-lg border border-slate-200 hover:border-emerald-500 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-pen text-[10px]"></i> Edit Profil
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs sm:text-sm">
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-[11px] text-slate-400 font-semibold mb-1">Nama Lengkap</p>
                            <p class="font-bold text-slate-800">{{ $user->name }}</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-[11px] text-slate-400 font-semibold mb-1">Alamat Email</p>
                            <p class="font-bold text-slate-800">{{ $user->email }}</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-[11px] text-slate-400 font-semibold mb-1">No. WhatsApp</p>
                            <p class="font-bold text-slate-800">{{ $user->phone ?: 'Belum diisi' }}</p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-[11px] text-slate-400 font-semibold mb-1">Terdaftar Sejak</p>
                            <p class="font-bold text-slate-800">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>
