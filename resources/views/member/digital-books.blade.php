<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Koleksi Buku Digital Saya | Portal Member PENERBIT PERSIS</title>
    
    <!-- Favicons & App Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">
    
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; -webkit-tap-highlight-color: transparent; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .brand-dark { background-color: #032c21; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased bg-slate-100 flex flex-col lg:flex-row">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity duration-300"></div>

    <!-- ==================== SIDEBAR MEMBER ==================== -->
    <aside id="member-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 brand-dark text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-white/10 shadow-2xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        
        <div class="p-5">
            <!-- Brand Header -->
            <div class="pb-4 mb-4 border-b border-white/10 flex items-center justify-between lg:justify-center">
                <a href="{{ route('member.dashboard') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-11 w-auto object-contain" />
                </a>
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-sm hover:bg-white/10 transition" title="Tutup Menu">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- User Profile Box -->
            <a href="{{ route('member.profile') }}" class="p-3 bg-white/5 hover:bg-white/10 border border-white/10 rounded-sm mb-5 flex items-center gap-3 transition group block" title="Buka Pengaturan Profil Saya">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-sm object-cover shrink-0 ring-1 ring-emerald-400/40 group-hover:ring-emerald-400 transition" />
                @else
                    <div class="w-9 h-9 rounded-sm bg-[#006830] text-white flex items-center justify-center font-extrabold text-xs shrink-0 shadow-xs ring-1 ring-emerald-500/30">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate leading-snug group-hover:text-emerald-300 transition">{{ $user->name }}</p>
                    <p class="text-[10px] text-emerald-300/80 uppercase font-mono tracking-wider">Member Aktif</p>
                </div>
                <i class="fa-solid fa-gear text-slate-400 group-hover:text-white text-xs transition"></i>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-5 text-xs">
                
                <!-- Section 1: Menu Utama -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Menu Utama</span>
                    <div class="space-y-1">
                        <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="javascript:void(0)" onclick="openMemberCartDrawer()" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300 cursor-pointer">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-cart-shopping w-4 text-center text-emerald-400"></i>
                                <span>Keranjang Saya</span>
                            </div>
                            <span id="sidebarCartBadge" class="hidden px-2 py-0.5 rounded-full text-[10px] font-bold bg-lime-400 text-[#032c21] font-mono">0</span>
                        </a>

                        <a href="{{ route('member.orders') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-receipt w-4 text-center"></i>
                                <span>Pesanan Saya</span>
                            </div>
                            @php
                                $userOrdCount = \App\Models\Order::where('user_id', Auth::id())->orWhere('customer_email', Auth::user()->email)->count();
                            @endphp
                            @if($userOrdCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500 text-[#032c21] font-mono">{{ $userOrdCount }}</span>
                            @endif
                        </a>

                        <!-- Buku Digital Saya (ACTIVE) -->
                        <a href="{{ route('member.digital_books') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-bold transition bg-emerald-600/20 text-emerald-400 border border-emerald-500/30">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-book-open-reader w-4 text-center"></i>
                                <span>Buku Digital</span>
                            </div>
                            @if(($totalBookmarks ?? 0) > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-400 text-slate-900 font-mono">{{ $totalBookmarks }}</span>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- Section 2: Pengaturan Akun & Kontak -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Akun &amp; Bantuan</span>
                    <div class="space-y-1">
                        <a href="{{ route('member.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <i class="fa-solid fa-user-gear w-4 text-center"></i>
                            <span>Profil Saya</span>
                        </a>

                        <a href="{{ url('/kontak') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <i class="fa-solid fa-headset w-4 text-center"></i>
                            <span>Hubungi Redaksi</span>
                        </a>

                        <a href="{{ url('/') }}" class="flex items-center gap-3 px-3 py-2 rounded-sm font-medium transition hover:bg-white/10 hover:text-white text-slate-400">
                            <i class="fa-solid fa-arrow-up-right-from-square w-4 text-center text-slate-500"></i>
                            <span>Halaman Utama Web</span>
                        </a>
                    </div>
                </div>

            </nav>
        </div>

        <!-- Sidebar Footer / Logout -->
        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('member.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3 py-2.5 rounded-sm text-xs font-bold text-red-300 hover:bg-red-900/40 hover:text-red-100 transition border border-red-500/20 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket text-xs"></i>
                    <span>Keluar Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <div id="main-content-wrapper" class="flex-1 flex flex-col min-w-0 min-h-screen transition-all duration-300 lg:pl-64">

        <!-- Top Header Bar -->
        <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-2.5 sm:py-3 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            
            <!-- Left Header: Toggle & Branding -->
            <div class="flex items-center gap-3">
                <!-- Desktop Sidebar Toggle Button -->
                <button type="button" onclick="toggleSidebar()" class="p-2 text-slate-600 hover:text-emerald-800 hover:bg-slate-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer" title="Buka / Tutup Menu Sidebar">
                    <i class="fa-solid fa-bars-staggered text-sm"></i>
                </button>

                <!-- Mobile Official Logo Brand -->
                <a href="{{ route('member.dashboard') }}" class="flex items-center gap-2 lg:hidden transition hover:opacity-90">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_emblem.png') }}" alt="Logo" class="w-7 h-7 object-contain" />
                    <div>
                        <span class="font-black text-xs text-slate-900 tracking-tight block font-heading leading-none">PENERBIT PERSIS</span>
                        <span class="text-[9.5px] text-emerald-700 font-bold block leading-none mt-0.5">Portal Member</span>
                    </div>
                </a>

                <!-- Desktop Breadcrumb Title -->
                <div class="hidden lg:flex items-center gap-2 text-xs">
                    <a href="{{ route('member.dashboard') }}" class="text-slate-400 hover:text-emerald-700 transition">Portal Member</a>
                    <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                    <span class="font-bold text-slate-800">Buku Digital Saya</span>
                </div>
            </div>

            <!-- Right Header Actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ url('/') }}" 
                    class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-emerald-50/50 transition">
                    <i class="fa-solid fa-house text-[10px] text-emerald-700"></i>
                    <span>Website Utama</span>
                </a>

                <a href="{{ route('katalog.digital') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold transition shadow-2xs">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    <span class="hidden sm:inline">Jelajahi Katalog Digital</span>
                    <span class="sm:hidden">Katalog</span>
                </a>

                <!-- Member Cart Header Button -->
                <button 
                    type="button" 
                    onclick="openMemberCartDrawer()" 
                    id="memberHeaderCartBtn"
                    class="relative p-1.5 sm:p-2 text-slate-600 hover:text-emerald-800 hover:bg-emerald-50 active:bg-emerald-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer select-none"
                    title="Keranjang Belanja"
                >
                    <i class="fa-solid fa-cart-shopping text-sm text-emerald-800"></i>
                    <span id="headerCartBadge" class="hidden absolute -top-1 -right-1 min-w-[17px] h-[17px] px-1 rounded-full bg-[#006830] text-white text-[8.5px] font-black flex items-center justify-center font-mono shadow-xs">
                        0
                    </span>
                </button>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto space-y-6 pb-24 lg:pb-12">
            
            <!-- Page Header Banner (Flat Solid) -->
            <div class="bg-[#032c21] text-white p-5 sm:p-6 rounded-sm border border-[#064e3b] shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.5 rounded-xs bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 text-[10px] font-mono font-bold uppercase tracking-wider">
                            Koleksi Bacaan Member
                        </span>
                        <span class="text-xs text-emerald-300 font-mono font-bold">• {{ $totalBookmarks }} Buku Tersimpan</span>
                    </div>
                    <h1 class="text-lg sm:text-xl font-black text-white font-heading tracking-tight">
                        Buku Digital &amp; Flipbook Tersimpan
                    </h1>
                    <p class="text-xs text-slate-300 max-w-2xl leading-relaxed">
                        Buku-buku digital yang Anda tandai dari katalog. Baca secara interaktif menggunakan e-Flipbook reader atau unduh file PDF untuk dibaca offline.
                    </p>
                </div>

                <a href="{{ route('katalog.digital') }}" class="px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shrink-0 shadow-xs">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Cari Buku Lain</span>
                </a>
            </div>

            <!-- Flash Session Alerts -->
            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-sm text-xs font-bold text-emerald-900 flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3.5 bg-red-50 border border-red-200 rounded-sm text-xs font-bold text-red-900 flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-red-600 text-sm"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 cursor-pointer"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            <!-- Filter & Search Toolbar -->
            <div class="bg-white rounded-sm border border-slate-200 p-4 shadow-2xs flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <!-- Search Form -->
                <form method="GET" action="{{ route('member.digital_books') }}" class="flex-1 flex items-center gap-2">
                    <div class="relative flex-1">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ request('q') }}" 
                            placeholder="Cari buku dalam koleksi saya..." 
                            class="w-full pl-8 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xs focus:bg-white focus:border-emerald-600 outline-none transition"
                        />
                    </div>
                    <button type="submit" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xs text-xs font-bold transition cursor-pointer">
                        Cari
                    </button>
                    @if(request()->hasAny(['q', 'kategori']))
                        <a href="{{ route('member.digital_books') }}" class="px-2.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xs text-xs font-semibold transition" title="Reset Filter">
                            Reset
                        </a>
                    @endif
                </form>

                <!-- Category Filters Pills -->
                <div class="flex items-center gap-1.5 overflow-x-auto select-none no-scrollbar pt-1 sm:pt-0">
                    <a href="{{ route('member.digital_books', ['q' => request('q')]) }}" class="px-2.5 py-1.5 rounded-xs text-[11px] font-bold border transition shrink-0 {{ $activeCategory === 'all' ? 'bg-[#006830] text-white border-[#006830]' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                        Semua ({{ $totalBookmarks }})
                    </a>
                    @foreach($categoryStats as $c)
                        <a href="{{ route('member.digital_books', ['kategori' => $c->category, 'q' => request('q')]) }}" class="px-2.5 py-1.5 rounded-xs text-[11px] font-bold border transition shrink-0 {{ $activeCategory === $c->category ? 'bg-[#006830] text-white border-[#006830]' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                            {{ $c->category }} ({{ $c->count }})
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Digital Books Grid / Empty State -->
            @if($digitalBooks->isEmpty())
                <div class="bg-white rounded-sm border border-slate-200 p-10 sm:p-14 text-center shadow-2xs space-y-4">
                    <div class="w-16 h-16 rounded-sm bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto text-2xl border border-emerald-100">
                        <i class="fa-solid fa-bookmark"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-bold text-base text-slate-800 font-heading">
                            @if(request('q') || request('kategori'))
                                Buku tidak ditemukan dengan kata kunci ini
                            @else
                                Belum Ada Buku Digital yang Ditandai
                            @endif
                        </h3>
                        <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                            Buka halaman <strong>Katalog Digital</strong> dan klik tombol <strong>"Simpan / Bookmark"</strong> pada buku yang ingin Anda baca di portal member ini.
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('katalog.digital') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-xs">
                            <i class="fa-solid fa-book-open"></i>
                            <span>Jelajahi Katalog Buku Digital Sekarang</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach($digitalBooks as $book)
                        @php
                            $coverUrl = $book->cover_url ?: asset('images/default-book.png');
                            $pdfUrl = $book->pdf_url;
                            $encodedBook = base64_encode(json_encode([
                                'id' => $book->id,
                                'title' => $book->title,
                                'author' => $book->author,
                                'pdf_url' => $pdfUrl,
                            ]));
                        @endphp
                        <div class="bg-white rounded-sm border border-slate-200 overflow-hidden shadow-2xs hover:shadow-md transition flex flex-col justify-between group">
                            
                            <!-- Cover & Badges -->
                            <div class="relative bg-slate-100 aspect-[3/4] overflow-hidden border-b border-slate-100">
                                <img 
                                    src="{{ $coverUrl }}" 
                                    alt="{{ $book->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                    loading="lazy"
                                />

                                <!-- Category Badge -->
                                <span class="absolute top-2 left-2 px-2 py-0.5 rounded-xs bg-slate-900/80 backdrop-blur-xs text-white text-[9.5px] font-bold font-mono tracking-wider uppercase">
                                    {{ $book->category }}
                                </span>

                                <!-- Quick Actions Floating Overlay -->
                                <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 p-3">
                                    @if($pdfUrl)
                                        <button 
                                            type="button" 
                                            onclick="openFlipbookFromEncoded('{{ $encodedBook }}')"
                                            class="p-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-sm text-xs font-bold shadow-md transition cursor-pointer"
                                            title="Baca Flipbook Sekarang"
                                        >
                                            <i class="fa-solid fa-book-open-reader"></i>
                                        </button>
                                        <button 
                                            type="button" 
                                            onclick="openDownloadFromEncoded('{{ $encodedBook }}')"
                                            class="p-2.5 bg-white hover:bg-slate-100 text-slate-800 rounded-sm text-xs font-bold shadow-md transition cursor-pointer"
                                            title="Unduh File PDF"
                                        >
                                            <i class="fa-solid fa-download"></i>
                                        </button>
                                    @else
                                        <a 
                                            href="{{ route('katalog.digital.show', $book->slug) }}" 
                                            class="p-2.5 bg-white text-slate-800 rounded-sm text-xs font-bold shadow-md transition"
                                            title="Lihat Detail Buku"
                                        >
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Info -->
                            <div class="p-3.5 flex-1 flex flex-col justify-between space-y-3">
                                <div class="space-y-1">
                                    <h4 class="font-bold text-xs sm:text-sm text-slate-900 line-clamp-2 leading-snug group-hover:text-emerald-800 transition" title="{{ $book->title }}">
                                        {{ $book->title }}
                                    </h4>
                                    <p class="text-[11px] text-slate-500 truncate">
                                        <i class="fa-solid fa-pen-nib text-[9px] text-slate-400 mr-1"></i>{{ $book->author ?: 'Redaksi PERSIS PERS' }}
                                    </p>
                                </div>

                                <div class="pt-2 border-t border-slate-100 space-y-2">
                                    <div class="flex items-center justify-between text-[10.5px] text-slate-500 font-mono">
                                        <span><i class="fa-regular fa-file-pdf mr-1"></i>{{ $book->pages ? $book->pages . ' Hal' : 'PDF' }}</span>
                                        <span>{{ $book->year ?: '-' }}</span>
                                    </div>

                                    <!-- Main Action Buttons -->
                                    <div class="grid grid-cols-2 gap-1.5 pt-1">
                                        @if($pdfUrl)
                                            <button 
                                                type="button" 
                                                onclick="openFlipbookFromEncoded('{{ $encodedBook }}')"
                                                class="w-full py-1.5 px-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1 cursor-pointer"
                                            >
                                                <i class="fa-solid fa-book-open text-[10px]"></i>
                                                <span>Baca</span>
                                            </button>
                                        @else
                                            <a 
                                                href="{{ route('katalog.digital.show', $book->slug) }}" 
                                                class="w-full py-1.5 px-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1"
                                            >
                                                <span>Detail</span>
                                            </a>
                                        @endif

                                        <!-- Remove Bookmark Button -->
                                        <form method="POST" action="{{ route('member.digital_books.remove', $book->id) }}" onsubmit="return confirm('Hapus buku ini dari daftar bacaan tersimpan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="w-full py-1.5 px-2 bg-white hover:bg-red-50 text-red-600 border border-red-200 rounded-xs text-[11px] font-semibold transition flex items-center justify-center gap-1 cursor-pointer"
                                                title="Hapus dari Bookmark"
                                            >
                                                <i class="fa-solid fa-trash-can text-[10px]"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-4 flex justify-center">
                    {{ $digitalBooks->links() }}
                </div>
            @endif

        </main>
    </div>

    <!-- ==================== FLIPBOOK READER MODAL ==================== -->
    <div id="flipbookViewerModal" class="fixed inset-0 z-[99999] bg-slate-950/85 backdrop-blur-sm hidden items-center justify-center p-2 sm:p-4 select-none" style="display: none;">
        <div class="bg-slate-900 border border-slate-700 w-full max-w-5xl h-[92vh] rounded-sm flex flex-col overflow-hidden shadow-2xl">
            <!-- Modal Header -->
            <div class="px-4 py-3 bg-slate-950 border-b border-slate-800 flex items-center justify-between text-white shrink-0">
                <div class="flex items-center gap-2.5 min-w-0">
                    <i class="fa-solid fa-book-open text-emerald-400 text-sm"></i>
                    <h4 id="readerModalTitle" class="font-bold text-xs sm:text-sm truncate text-slate-100">Judul Buku</h4>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" onclick="closeFlipbookModal()" class="px-3 py-1 bg-slate-800 hover:bg-slate-700 text-white rounded-xs text-xs font-bold transition flex items-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-xmark"></i> <span>Tutup</span>
                    </button>
                </div>
            </div>
            <!-- Iframe Viewer -->
            <div class="flex-1 relative bg-slate-950 flex items-center justify-center overflow-hidden">
                <iframe id="flipbookPdfIframe" src="" class="w-full h-full border-0"></iframe>
                <div id="flipbookFallbackMessage" class="hidden text-center p-6 text-slate-300 space-y-3">
                    <i class="fa-solid fa-file-lines text-4xl text-slate-500"></i>
                    <p class="text-xs">Pratinjau e-book hanya tersedia untuk buku yang memiliki file PDF lengkap.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== MEMBER CART SLIDE DRAWER ==================== -->
    <div id="memberCartDrawer" class="fixed inset-0 z-[9999] hidden items-end sm:items-stretch sm:justify-end" style="display: none;">
        <div id="memberCartDrawerBackdrop" onclick="closeMemberCartDrawer()" class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity duration-300 opacity-0 cursor-pointer"></div>
        <div id="memberCartDrawerPanel" class="relative z-10 w-full sm:max-w-md bg-white shadow-2xl rounded-t-2xl sm:rounded-none flex flex-col max-h-[85vh] sm:max-h-full sm:h-full transform translate-y-full sm:translate-y-0 sm:translate-x-full transition-transform duration-300 ease-out border-t sm:border-t-0 sm:border-l border-slate-200">
            <!-- Header -->
            <div class="p-4 sm:p-5 brand-dark text-white flex items-center justify-between border-b border-brand-900 shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-sm bg-white/10 flex items-center justify-center text-lime-400">
                        <i class="fa-solid fa-basket-shopping text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm leading-none font-heading">Keranjang Belanja</h3>
                        <span id="memberCartDrawerCountBadge" class="text-xs font-semibold text-emerald-300 font-mono mt-0.5 block">0 item</span>
                    </div>
                </div>
                <button type="button" onclick="closeMemberCartDrawer()" class="w-7 h-7 rounded-sm text-slate-300 hover:text-white hover:bg-white/10 flex items-center justify-center transition cursor-pointer" title="Tutup Keranjang">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <!-- Items list -->
            <div id="memberCartDrawerItemsList" class="flex-1 overflow-y-auto p-4 sm:p-5 space-y-3"></div>
            <!-- Footer -->
            <div id="memberCartDrawerFooter" class="p-4 sm:p-5 border-t border-slate-200 bg-slate-50 space-y-3 shrink-0">
                <div class="space-y-1 text-xs">
                    <div class="flex items-center justify-between text-slate-500">
                        <span>Total Jumlah:</span>
                        <span id="memberCartDrawerTotalItemsText" class="font-bold text-slate-800">0 Eksemplar</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-700">
                        <span class="font-bold">Total Pembayaran:</span>
                        <span id="memberCartDrawerSubtotal" class="font-mono font-black text-emerald-800 text-base">Rp 0</span>
                    </div>
                </div>
                <div class="space-y-2 select-none">
                    <a href="{{ route('katalog') }}" class="w-full py-2.5 px-4 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs sm:text-sm font-bold shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-book-open text-xs text-lime-300"></i>
                        <span>Buka Katalog &amp; Checkout</span>
                    </a>
                    <button type="button" onclick="checkoutMemberCartViaWhatsApp()" class="w-full py-2 px-4 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer shadow-2xs">
                        <i class="fa-brands fa-whatsapp text-sm text-emerald-600"></i>
                        <span>Pesan via WhatsApp</span>
                    </button>
                    <div class="flex items-center justify-between pt-1">
                        <button type="button" onclick="clearMemberCart()" class="text-[11px] text-red-600 hover:text-red-800 font-medium flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-trash-can text-[9px]"></i>
                            <span>Kosongkan</span>
                        </button>
                        <button type="button" onclick="closeMemberCartDrawer()" class="text-[11px] text-slate-500 hover:text-emerald-800 font-medium cursor-pointer">
                            Tutup &rarr;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('member-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (sidebar && overlay) {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        /* Flipbook Modal Management */
        window.decodeBookData = function(b64) {
            try {
                return JSON.parse(decodeURIComponent(escape(atob(b64))));
            } catch(e) {
                return null;
            }
        };

        window.openFlipbookFromEncoded = function(b64) {
            const book = window.decodeBookData(b64);
            if (book) {
                window.openFlipbookReader(book);
            }
        };

        window.openFlipbookReader = function(book) {
            const modal = document.getElementById('flipbookViewerModal');
            const titleEl = document.getElementById('readerModalTitle');
            const iframe = document.getElementById('flipbookPdfIframe');
            const fallback = document.getElementById('flipbookFallbackMessage');

            if (titleEl) titleEl.textContent = book.title + ' - ' + (book.author || 'PERSIS PERS');

            if (book.pdf_url) {
                iframe.src = book.pdf_url + '#toolbar=1&navpanes=0';
                iframe.classList.remove('hidden');
                if (fallback) fallback.classList.add('hidden');
            } else {
                iframe.src = 'about:blank';
                iframe.classList.add('hidden');
                if (fallback) fallback.classList.remove('hidden');
            }

            if (modal) {
                modal.style.display = 'flex';
                modal.classList.remove('hidden');
            }
        };

        window.closeFlipbookModal = function() {
            const modal = document.getElementById('flipbookViewerModal');
            const iframe = document.getElementById('flipbookPdfIframe');
            if (iframe) iframe.src = 'about:blank';
            if (modal) {
                modal.style.display = 'none';
                modal.classList.add('hidden');
            }
        };

        window.openDownloadFromEncoded = function(b64) {
            const book = window.decodeBookData(b64);
            if (book && book.pdf_url) {
                window.open(book.pdf_url, '_blank');
            } else {
                alert('File PDF belum tersedia untuk buku ini.');
            }
        };

        /* Cart Drawer Management */
        let memberCartData = { items: [], count: 0, subtotal: 0, formatted_subtotal: 'Rp 0' };

        function openMemberCartDrawer() {
            const drawer = document.getElementById('memberCartDrawer');
            const backdrop = document.getElementById('memberCartDrawerBackdrop');
            const panel = document.getElementById('memberCartDrawerPanel');
            if (!drawer || !backdrop || !panel) return;

            drawer.style.display = 'flex';
            drawer.classList.remove('hidden');
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                panel.classList.remove('translate-y-full', 'sm:translate-x-full');
            }, 10);
            fetchMemberCartData();
        }

        function closeMemberCartDrawer() {
            const drawer = document.getElementById('memberCartDrawer');
            const backdrop = document.getElementById('memberCartDrawerBackdrop');
            const panel = document.getElementById('memberCartDrawerPanel');
            if (!drawer || !backdrop || !panel) return;

            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            panel.classList.add('translate-y-full', 'sm:translate-x-full');
            setTimeout(() => {
                drawer.style.display = 'none';
                drawer.classList.add('hidden');
            }, 300);
        }

        function fetchMemberCartData() {
            fetch('/member/cart', {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    memberCartData = data;
                    renderMemberCartUI(data);
                    updateMemberCartBadges(data.count);
                }
            })
            .catch(() => {});
        }

        function updateMemberCartBadges(count) {
            const headerBadge = document.getElementById('headerCartBadge');
            const sidebarBadge = document.getElementById('sidebarCartBadge');
            const drawerCount = document.getElementById('memberCartDrawerCountBadge');

            if (headerBadge) {
                headerBadge.textContent = count;
                headerBadge.classList.toggle('hidden', count <= 0);
            }
            if (sidebarBadge) {
                sidebarBadge.textContent = count;
                sidebarBadge.classList.toggle('hidden', count <= 0);
            }
            if (drawerCount) {
                drawerCount.textContent = count + ' item';
            }
        }

        function renderMemberCartUI(data) {
            const list = document.getElementById('memberCartDrawerItemsList');
            const footer = document.getElementById('memberCartDrawerFooter');
            const subtotalEl = document.getElementById('memberCartDrawerSubtotal');
            const totalItemsEl = document.getElementById('memberCartDrawerTotalItemsText');

            if (!list) return;

            if (!data.items || data.items.length === 0) {
                list.innerHTML = `
                    <div class="py-12 text-center text-slate-400 space-y-3">
                        <i class="fa-solid fa-cart-arrow-down text-4xl text-slate-300"></i>
                        <p class="text-xs">Keranjang belanja Anda masih kosong.</p>
                        <a href="{{ route('katalog') }}" class="inline-block mt-2 px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xs text-xs font-bold transition">
                            Lihat Katalog Buku
                        </a>
                    </div>
                `;
                if (footer) footer.classList.add('hidden');
                return;
            }

            if (footer) footer.classList.remove('hidden');
            if (subtotalEl) subtotalEl.textContent = data.formatted_subtotal;
            if (totalItemsEl) totalItemsEl.textContent = data.count + ' Eksemplar';

            let html = '';
            data.items.forEach(it => {
                const title = it.title || (it.book ? it.book.title : 'Buku');
                const cover = it.cover_url || (it.book && it.book.cover_url ? it.book.cover_url : '{{ asset("images/default-book.png") }}');
                html += `
                    <div class="p-3 bg-slate-50 border border-slate-200 rounded-sm flex gap-3 items-center">
                        <img src="${cover}" alt="${title}" class="w-12 h-16 object-cover rounded-xs border border-slate-200 shrink-0" />
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-bold text-slate-800 truncate">${title}</p>
                            <p class="text-[11px] text-emerald-800 font-mono font-bold mt-0.5">${it.formatted_price || ''}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <button type="button" onclick="updateMemberCartItemQty('${it.id}', -1)" class="w-5 h-5 bg-white border border-slate-300 rounded-xs flex items-center justify-center text-xs text-slate-600 hover:bg-slate-100 cursor-pointer">-</button>
                                <span class="text-xs font-bold font-mono text-slate-700">${it.quantity}</span>
                                <button type="button" onclick="updateMemberCartItemQty('${it.id}', 1)" class="w-5 h-5 bg-white border border-slate-300 rounded-xs flex items-center justify-center text-xs text-slate-600 hover:bg-slate-100 cursor-pointer">+</button>
                            </div>
                        </div>
                        <button type="button" onclick="removeMemberCartItem('${it.id}')" class="text-slate-400 hover:text-red-600 p-1 cursor-pointer" title="Hapus">
                            <i class="fa-solid fa-trash-can text-xs"></i>
                        </button>
                    </div>
                `;
            });
            list.innerHTML = html;
        }

        function updateMemberCartItemQty(cartItemId, change) {
            const item = memberCartData.items.find(i => i.id === cartItemId);
            if (!item) return;
            const newQty = item.quantity + change;
            if (newQty <= 0) {
                removeMemberCartItem(cartItemId);
                return;
            }
            fetch('/member/cart/update/' + cartItemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: newQty })
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    memberCartData = data;
                    renderMemberCartUI(data);
                    updateMemberCartBadges(data.count);
                }
            })
            .catch(() => fetchMemberCartData());
        }

        function removeMemberCartItem(cartItemId) {
            fetch('/member/cart/remove/' + cartItemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-HTTP-Method-Override': 'DELETE'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    memberCartData = data;
                    renderMemberCartUI(data);
                    updateMemberCartBadges(data.count);
                } else {
                    fetchMemberCartData();
                }
            })
            .catch(() => fetchMemberCartData());
        }

        function clearMemberCart() {
            if (!confirm('Apakah Anda yakin ingin mengosongkan keranjang belanja?')) return;
            fetch('{{ route("member.cart.clear") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-HTTP-Method-Override': 'DELETE'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    memberCartData = data;
                    renderMemberCartUI(data);
                    updateMemberCartBadges(0);
                } else {
                    fetchMemberCartData();
                }
            })
            .catch(() => fetchMemberCartData());
        }

        function checkoutMemberCartViaWhatsApp() {
            if (!memberCartData || !memberCartData.items || memberCartData.items.length === 0) {
                alert('Keranjang belanja masih kosong.');
                return;
            }
            let msg = "Assalamualaikum Admin Penerbit Persis, saya member *{{ Auth::user()->name }}* ingin memesan buku di keranjang:\n\n";
            memberCartData.items.forEach((it, idx) => {
                const title = it.title || (it.book ? it.book.title : 'Buku');
                msg += `${idx + 1}. *${title}* (${it.quantity} eks) - ${it.formatted_subtotal}\n`;
            });
            const waNum = '{{ preg_replace("/[^0-9]/", "", $contactWa ?? "6282116116133") }}';
            window.open(`https://wa.me/${waNum}?text=${encodeURIComponent(msg)}`, '_blank');
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchMemberCartData();
        });
    </script>
</body>
</html>
