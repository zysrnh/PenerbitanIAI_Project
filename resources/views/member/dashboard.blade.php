<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member | PERSIS PERS</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-dark { background-color: #032c21; }
        .brand-green { color: #006830; }
        .sidebar-link { @apply flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:none; } }
        .fade-in { animation: fadeIn 0.4s ease both; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">

    <!-- Sidebar + Main Layout -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-60 brand-dark text-white flex flex-col shrink-0 hidden lg:flex">
            <!-- Logo -->
            <div class="px-5 py-5 border-b border-white/10">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                    <i class="fa-solid fa-book-open text-emerald-400 text-base"></i>
                    <div>
                        <div class="text-[9px] text-emerald-300 font-bold tracking-widest uppercase leading-none">IAI PERSIS</div>
                        <div class="text-sm font-extrabold text-white leading-tight">PERSIS PERS</div>
                    </div>
                </a>
            </div>

            <!-- User Info -->
            <div class="px-5 py-4 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-emerald-700 flex items-center justify-center text-white font-bold text-sm shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ $user->name }}</p>
                        <p class="text-[10px] text-emerald-300 truncate">{{ $user->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-3 py-4 space-y-1">
                <a href="{{ route('member.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition bg-emerald-700/30 text-white">
                    <i class="fa-solid fa-gauge-high w-4"></i> Dashboard
                </a>
                <a href="{{ route('katalog') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-emerald-200 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-books w-4"></i> Katalog Buku
                </a>
                <a href="{{ route('member.profile') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-emerald-200 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-user w-4"></i> Profil Saya
                </a>
                <a href="{{ url('/kontak') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition text-emerald-200 hover:bg-white/10 hover:text-white">
                    <i class="fa-solid fa-headset w-4"></i> Hubungi Kami
                </a>
            </nav>

            <!-- Logout -->
            <div class="px-3 py-4 border-t border-white/10">
                <form method="POST" action="{{ route('member.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-red-300 hover:bg-red-900/30 hover:text-red-200 transition">
                        <i class="fa-solid fa-right-from-bracket w-4"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">

            <!-- Mobile Topbar -->
            <header class="lg:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-slate-200 shadow-xs sticky top-0 z-30">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-book-open text-emerald-700 text-base"></i>
                    <span class="font-extrabold text-sm text-slate-900">PERSIS PERS</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-slate-700">{{ $user->name }}</span>
                    <form method="POST" action="{{ route('member.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 font-bold hover:underline">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 lg:p-8 fade-in">

                @if(session('success'))
                    <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-2.5 text-sm text-emerald-800 font-medium">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-7">
                    <h1 class="text-xl font-extrabold text-slate-900">Selamat Datang, {{ $user->name }}! 👋</h1>
                    <p class="text-sm text-slate-500 mt-1">Akses katalog buku, layanan penerbitan, dan informasi PERSIS PERS dari sini.</p>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-books text-emerald-700"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-500 font-medium">Koleksi Buku</p>
                                <p class="text-xl font-extrabold text-slate-900">150+</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fa-solid fa-user-check text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-500 font-medium">Status Akun</p>
                                <p class="text-sm font-extrabold text-emerald-700">Aktif ✓</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                                <i class="fa-brands fa-whatsapp text-amber-700"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-500 font-medium">Konsultasi</p>
                                <p class="text-sm font-extrabold text-slate-700">Langsung</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <a href="{{ route('katalog') }}"
                        class="group bg-white rounded-xl border border-slate-100 p-5 shadow-xs hover:border-emerald-300 hover:shadow-md transition flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-700 group-hover:bg-emerald-800 rounded-xl flex items-center justify-center transition shrink-0">
                            <i class="fa-solid fa-magnifying-glass text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Jelajahi Katalog</h3>
                            <p class="text-xs text-slate-500 mt-0.5">150+ buku terbitan PERSIS PERS</p>
                        </div>
                        <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 ml-auto transition"></i>
                    </a>

                    <a href="{{ url('/kontak') }}"
                        class="group bg-white rounded-xl border border-slate-100 p-5 shadow-xs hover:border-emerald-300 hover:shadow-md transition flex items-center gap-4">
                        <div class="w-12 h-12 bg-slate-800 group-hover:bg-slate-900 rounded-xl flex items-center justify-center transition shrink-0">
                            <i class="fa-solid fa-paper-plane text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Konsultasi Naskah</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Terbitkan karya ilmiah Anda</p>
                        </div>
                        <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 ml-auto transition"></i>
                    </a>
                </div>

                <!-- Profile Info -->
                <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-xs">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-slate-900 text-sm">Informasi Akun</h3>
                        <a href="{{ route('member.profile') }}" class="text-xs text-emerald-700 font-bold hover:underline flex items-center gap-1">
                            <i class="fa-solid fa-pen text-[10px]"></i> Edit Profil
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-[11px] text-slate-400 font-medium mb-0.5">Nama Lengkap</p>
                            <p class="font-semibold text-slate-800">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-medium mb-0.5">Email</p>
                            <p class="font-semibold text-slate-800">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-medium mb-0.5">No. WhatsApp</p>
                            <p class="font-semibold text-slate-800">{{ $user->phone ?: 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-medium mb-0.5">Bergabung Sejak</p>
                            <p class="font-semibold text-slate-800">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>
