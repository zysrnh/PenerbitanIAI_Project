<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Member | PERSIS PERS</title>
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
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) both; }
        
        /* Signature 3D Book Card styling matching public katalog */
        .persis-book-card {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            background: #ffffff;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .persis-book-card:hover {
            border-color: #047857;
            transform: translateY(-3px);
            box-shadow: 0 12px 24px -6px rgba(4, 120, 87, 0.14), 0 2px 4px rgba(0,0,0,0.04);
        }

        /* 3D Perspective Hover Tilt on Cards */
        .book-cover-stage-3d {
            perspective: 800px;
        }
        .book-cover-3d {
            transform-style: preserve-3d;
            transition: transform 0.45s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease;
            box-shadow: 4px 6px 14px -2px rgba(0, 0, 0, 0.25), 1px 1px 3px rgba(0,0,0,0.1);
        }
        .persis-book-card:hover .book-cover-3d {
            transform: rotateY(-16deg) rotateX(5deg) translateY(-3px) scale(1.02);
            box-shadow: 10px 16px 24px -4px rgba(0, 0, 0, 0.35), 2px 2px 6px rgba(0,0,0,0.12);
        }
        .card-shine-layer {
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
        }

        /* 3D Realistic Card Cover Effects */
        .book-spine-strip {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 6px;
            background: linear-gradient(90deg, rgba(255,255,255,0.35) 0%, rgba(0,0,0,0.05) 50%, rgba(0,0,0,0.3) 100%);
            border-right: 1px solid rgba(0,0,0,0.12);
            z-index: 10;
        }
        .book-paper-edge {
            position: absolute;
            right: 0;
            top: 3px;
            bottom: 3px;
            width: 3px;
            background: repeating-linear-gradient(180deg, #f8fafc, #f8fafc 1.5px, #cbd5e1 1.5px, #cbd5e1 3px);
            border-left: 1px solid #94a3b8;
            border-radius: 0 1px 1px 0;
            z-index: 8;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased flex flex-col lg:flex-row">

    <!-- ==================== SIDEBAR (DESKTOP) ==================== -->
    <aside class="w-64 brand-dark text-white flex-col shrink-0 hidden lg:flex min-h-screen sticky top-0 h-screen z-40 border-r border-white/10">
        
        <!-- Sidebar Brand Logo -->
        <div class="px-6 py-5 border-b border-white/10 flex items-center justify-center">
            <a href="{{ url('/') }}" class="inline-block transition hover:opacity-90" title="PERSIS PERS">
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
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-bold transition bg-emerald-700 text-white shadow-xs">
                <i class="fa-solid fa-gauge-high w-4 text-center text-emerald-200"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('katalog') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-book-open w-4 text-center text-emerald-400"></i>
                <span>Katalog Buku</span>
            </a>

            <a href="{{ route('member.profile') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-sm text-xs font-semibold transition text-emerald-100/80 hover:bg-white/10 hover:text-white">
                <i class="fa-solid fa-user w-4 text-center text-emerald-400"></i>
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
            
            <!-- Mobile Brand Toggle -->
            <div class="flex items-center gap-3 lg:hidden">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/logo/logo_persis_pers_full_official.svg') }}" alt="PERSIS PERS" class="h-11 w-auto object-contain" />
                </a>
            </div>

            <!-- Desktop Breadcrumb Title -->
            <div class="hidden lg:flex items-center gap-2 text-xs">
                <span class="text-slate-400 font-medium">Portal Member</span>
                <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                <span class="font-bold text-slate-800">Dashboard Utama</span>
            </div>

            <!-- Topbar Action Links -->
            <div class="flex items-center gap-2.5 sm:gap-3.5">
                <a href="{{ url('/') }}" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/50 transition">
                    <i class="fa-solid fa-house text-[10px] text-emerald-700"></i>
                    <span>Website Utama</span>
                </a>

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PERSIS PERS, saya member ' . $user->name . ' ingin berkonsultasi.') }}" 
                    target="_blank"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-emerald-50 hover:bg-emerald-100/80 border border-emerald-200 text-xs font-bold text-emerald-800 transition">
                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                    <span class="hidden sm:inline">WhatsApp Redaksi</span>
                </a>

                <a href="{{ route('member.profile') }}" 
                    class="flex items-center gap-2 pl-1.5 pr-2.5 py-1 rounded-sm bg-slate-100 hover:bg-slate-200/80 border border-slate-200 transition">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-6 h-6 rounded-sm object-cover" />
                    @else
                        <div class="w-6 h-6 rounded-sm bg-emerald-700 text-white flex items-center justify-center text-[10px] font-black">
                            {{ $user->initials }}
                        </div>
                    @endif
                    <span class="text-xs font-bold text-slate-700 max-w-[100px] truncate hidden sm:inline">{{ explode(' ', $user->name)[0] }}</span>
                </a>

                <!-- Mobile Logout -->
                <form method="POST" action="{{ route('member.logout') }}" class="lg:hidden">
                    @csrf
                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-sm text-xs" title="Keluar">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Body Wrapper -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-in max-w-7xl w-full mx-auto space-y-5">

            <!-- Success Alert Notification -->
            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-sm flex items-center gap-2.5 text-xs sm:text-sm text-emerald-900 font-semibold shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Berhasil!</p>
                        <p class="text-xs text-emerald-800 font-normal mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- ==================== HERO GREETING BANNER ==================== -->
            <div class="relative overflow-hidden rounded-sm brand-dark text-white p-6 sm:p-7 shadow-sm border border-emerald-900/60">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-5">
                    <div class="max-w-xl space-y-1.5">
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-sm bg-white/10 border border-white/15 text-[10.5px] font-bold text-emerald-300 tracking-wide uppercase">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i> Member Resmi PERSIS PERS
                        </div>
                        <h1 class="text-xl sm:text-2xl font-black font-heading text-white tracking-tight">
                            Selamat Datang, {{ $user->name }}!
                        </h1>
                        <p class="text-xs text-emerald-100/80 leading-relaxed">
                            Akses katalog publikasi ilmiah, layanan penerbitan ber-ISBN resmi, modul perkuliahan, dan percetakan standar UNESCO dari panel akun Anda.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                        <a href="{{ route('katalog') }}" 
                            class="px-4 py-2.5 bg-emerald-500 hover:bg-emerald-400 text-[#032c21] text-xs font-extrabold rounded-sm transition-all duration-150 shadow-sm flex items-center gap-2">
                            <i class="fa-solid fa-book-open text-xs"></i>
                            <span>Buka Katalog Buku</span>
                        </a>

                        <a href="{{ url('/kontak') }}" 
                            class="px-4 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white text-xs font-bold rounded-sm transition-all duration-150 flex items-center gap-2">
                            <i class="fa-solid fa-pen-nib text-xs text-emerald-300"></i>
                            <span>Terbitkan Naskah</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ==================== KEY STATS ==================== -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                
                <!-- Stat 1: Koleksi Terbitan -->
                <div class="bg-white rounded-sm border border-slate-200 p-4 shadow-2xs flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Koleksi Terbitan</p>
                        <h4 class="text-lg font-black text-slate-900 mt-0.5">{{ $totalBooks ?? '150+' }} Judul</h4>
                        <p class="text-[10.5px] text-emerald-700 font-semibold mt-0.5">Buku Ajar, Riset & Monograf</p>
                    </div>
                </div>

                <!-- Stat 2: Status Member -->
                <div class="bg-white rounded-sm border border-slate-200 p-4 shadow-2xs flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-sm bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Status Keanggotaan</p>
                        <h4 class="text-sm font-extrabold text-emerald-700 mt-0.5 flex items-center gap-1.5">
                            <span>Aktif</span>
                            <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </h4>
                        <p class="text-[10.5px] text-slate-500 font-medium mt-0.5">Akses Penuh Layanan</p>
                    </div>
                </div>

                <!-- Stat 3: Layanan Redaksi -->
                <div class="bg-white rounded-sm border border-slate-200 p-4 shadow-2xs flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-sm bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Layanan Redaksi</p>
                        <h4 class="text-sm font-extrabold text-slate-900 mt-0.5">Konsultasi Cepat</h4>
                        <p class="text-[10.5px] text-slate-500 font-medium mt-0.5">Senin - Sabtu (08:00 - 16:00)</p>
                    </div>
                </div>

            </div>

            <!-- ==================== QUICK SERVICES / ACTIONS ==================== -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                
                <!-- Service 1: Jelajahi Katalog -->
                <a href="{{ route('katalog') }}" 
                    class="group bg-white rounded-sm border border-slate-200 p-5 shadow-2xs hover:border-emerald-600 transition flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-sm bg-[#032c21] group-hover:bg-[#006830] text-white flex items-center justify-center text-base shrink-0 transition shadow-2xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-extrabold text-slate-900 group-hover:text-emerald-800 transition">
                                Jelajahi Katalog & Cari Judul Buku
                            </h3>
                            <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 transition-transform duration-150 group-hover:translate-x-1"></i>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                            Cari koleksi monograf riset dosen, modul ajar mata kuliah, dan buku rujukan keislaman ber-ISBN lengkap.
                        </p>
                    </div>
                </a>

                <!-- Service 2: Konsultasi Terbitan -->
                <a href="{{ url('/kontak') }}" 
                    class="group bg-white rounded-sm border border-slate-200 p-5 shadow-2xs hover:border-emerald-600 transition flex items-start gap-3.5">
                    <div class="w-10 h-10 rounded-sm bg-emerald-700 group-hover:bg-[#032c21] text-white flex items-center justify-center text-base shrink-0 transition shadow-2xs">
                        <i class="fa-solid fa-pen-nib"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xs font-extrabold text-slate-900 group-hover:text-emerald-800 transition">
                                Konsultasi & Pengajuan Naskah Buku
                            </h3>
                            <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-emerald-600 transition-transform duration-150 group-hover:translate-x-1"></i>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                            Layanan terpadu penerbitan ber-ISBN resmi Perpusnas, konversi tesis/disertasi, layout standar, dan cetak naskah.
                        </p>
                    </div>
                </a>

            </div>

            <!-- ==================== SIGNATURE 3D BOOK CATALOG (MATCHING PUBLIC KATALOG) ==================== -->
            @if(isset($recentBooks) && $recentBooks->count() > 0)
                <div class="bg-white rounded-sm border border-slate-200 p-5 sm:p-6 shadow-xs">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-5 pb-3 border-b border-slate-100">
                        <div>
                            <h3 class="text-sm font-extrabold text-slate-900 font-heading">Koleksi Terbitan Terbaru (2026)</h3>
                            <p class="text-[11px] text-slate-500 mt-0.5">Buku ajar dan karya ilmiah terbitan resmi PERSIS PERS</p>
                        </div>
                        <a href="{{ route('katalog') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline flex items-center gap-1.5">
                            <span>Lihat Semua Katalog</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                    <!-- Book Grid Matching Public Katalog (persis-book-card & 3D Cover Stage) -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-4">
                        @foreach($recentBooks as $buku)
                            <div class="persis-book-card p-2 sm:p-3 rounded-sm cursor-pointer group" onclick="window.location.href='{{ route('katalog') }}?q={{ urlencode($buku->title) }}'">
                                
                                <!-- 3D Perspective Stage -->
                                <div class="book-cover-stage-3d w-full mb-2.5 py-1">
                                    <div class="book-cover-3d relative w-full aspect-[3/4.15] bg-slate-900 rounded-xs overflow-hidden select-none border border-slate-200">
                                        <div class="book-spine-strip"></div>
                                        <div class="book-paper-edge"></div>
                                        <div class="card-shine-layer absolute inset-0 pointer-events-none z-10"></div>

                                        @if($buku->cover_image && (file_exists(public_path('storage/' . $buku->cover_image)) || file_exists(public_path('images/' . $buku->cover_image))))
                                            <img src="{{ file_exists(public_path('storage/' . $buku->cover_image)) ? asset('storage/' . $buku->cover_image) : asset('images/' . $buku->cover_image) }}" 
                                                 alt="{{ $buku->title }}" 
                                                 class="w-full h-full object-cover" />
                                        @else
                                            <div class="w-full h-full bg-[#032c21] p-2.5 pl-3.5 flex flex-col justify-between text-white border-l-2 border-emerald-400 text-[7px]">
                                                <div class="flex justify-between items-center border-b border-white/20 pb-0.5">
                                                    <span class="font-bold text-emerald-300 truncate">{{ $buku->category ?? 'Buku' }}</span>
                                                    <span class="font-mono text-slate-300 text-[6px]">PERSIS</span>
                                                </div>
                                                <div class="text-center my-auto py-1">
                                                    <span class="font-black text-[8.5px] leading-tight line-clamp-3 text-white">{{ $buku->title }}</span>
                                                </div>
                                                <div class="border-t border-white/10 pt-0.5 text-[6px] text-slate-300 truncate">
                                                    {{ $buku->author }}
                                                </div>
                                            </div>
                                        @endif

                                        <span class="absolute top-1.5 left-2 px-1.5 py-0.5 rounded-xs bg-white/90 backdrop-blur-md text-[8px] font-bold text-emerald-900 border border-emerald-700/20 z-20">
                                            {{ $buku->category ?? 'Buku Ajar' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Metadata -->
                                <div class="flex-1 flex flex-col justify-between pt-1">
                                    <div>
                                        <h4 class="font-bold text-xs text-slate-900 group-hover:text-emerald-800 line-clamp-2 leading-tight transition" title="{{ $buku->title }}">
                                            {{ $buku->title }}
                                        </h4>
                                        <p class="text-[10px] text-slate-500 truncate mt-1 flex items-center gap-1">
                                            <i class="fa-solid fa-pen-nib text-[8px] text-emerald-600"></i>
                                            <span>{{ $buku->author }}</span>
                                        </p>
                                    </div>

                                    <div class="pt-2.5 mt-2 border-t border-slate-100 flex items-center justify-between">
                                        <span class="font-mono font-bold text-xs text-emerald-700">
                                            {{ $buku->price ? $buku->price : 'Rp -' }}
                                        </span>
                                        <a href="{{ route('katalog') }}?q={{ urlencode($buku->title) }}" 
                                            class="px-2 py-0.5 rounded-xs bg-emerald-700 hover:bg-[#032c21] text-white text-[10px] font-bold transition shadow-2xs">
                                            Detail
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- ==================== PROFILE INFO & EDITORIAL SUPPORT ==================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                
                <!-- Account Info -->
                <div class="lg:col-span-2 bg-white rounded-sm border border-slate-200 p-5 sm:p-6 shadow-xs">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm font-heading">Informasi Akun Member</h3>
                            <p class="text-[11px] text-slate-400">Detail data identitas yang terdaftar</p>
                        </div>
                        <a href="{{ route('member.profile') }}" 
                            class="px-3 py-1.5 rounded-sm border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50 transition flex items-center gap-1.5 shadow-2xs">
                            <i class="fa-solid fa-pen-to-square text-[10px] text-emerald-700"></i>
                            <span>Edit Profil & Foto</span>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm flex items-center gap-3">
                            @if($user->avatar_url)
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-sm object-cover shrink-0 border border-emerald-600" />
                            @else
                                <div class="w-10 h-10 rounded-sm bg-[#032c21] text-white flex items-center justify-center font-bold text-sm shrink-0">
                                    {{ $user->initials }}
                                </div>
                            @endif
                            <div class="min-w-0 flex-1">
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Nama Lengkap</p>
                                <p class="font-extrabold text-slate-900 truncate">{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">Alamat Email</p>
                            <p class="font-extrabold text-slate-900 truncate">{{ $user->email }}</p>
                        </div>

                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">No. WhatsApp</p>
                            <p class="font-extrabold text-slate-900">{{ $user->phone ?: 'Belum ditambahkan' }}</p>
                        </div>

                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm">
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-0.5">Terdaftar Sejak</p>
                            <p class="font-extrabold text-slate-900">{{ $user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Editorial Help Card -->
                <div class="bg-gradient-to-br from-emerald-50 to-white rounded-sm border border-emerald-200 p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="w-9 h-9 rounded-sm bg-emerald-700 text-white flex items-center justify-center text-sm mb-2.5 shadow-2xs">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-xs font-heading">Butuh Bantuan Penerbitan?</h3>
                        <p class="text-[11px] text-slate-600 mt-1 leading-relaxed">
                            Tim redaksi PERSIS PERS siap membantu konsultasi penerbitan buku, konversi naskah, hingga distribusi.
                        </p>
                    </div>

                    <div class="mt-4 pt-3 border-t border-emerald-200 space-y-2">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PERSIS PERS, saya ingin konsultasi penerbitan naskah.') }}" 
                            target="_blank"
                            class="w-full py-2 px-3 bg-emerald-700 hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Chat WhatsApp Redaksi</span>
                        </a>

                        <a href="mailto:{{ $contactEmail ?? 'penerbitan@iaipibandung.ac.id' }}" 
                            class="w-full py-1.5 px-3 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 text-center">
                            <i class="fa-solid fa-envelope text-slate-400 text-xs"></i>
                            <span>Kirim Email Naskah</span>
                        </a>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html>
