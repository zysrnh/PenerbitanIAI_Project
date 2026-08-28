<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan & Transaksi Saya | Portal Member PENERBIT PERSIS</title>
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
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) both; }

        /* Signature 3D Realistic Book Cover */
        .book-stage-3d {
            perspective: 600px;
        }
        .book-cover-3d {
            transform-style: preserve-3d;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            box-shadow: 4px 6px 14px -2px rgba(0, 0, 0, 0.22), 1px 1px 3px rgba(0,0,0,0.1);
        }
        .group:hover .book-cover-3d {
            transform: rotateY(-10deg) rotateX(3deg) translateY(-2px) scale(1.03);
            box-shadow: 8px 12px 20px -3px rgba(0, 0, 0, 0.3), 2px 2px 5px rgba(0,0,0,0.12);
        }
        .book-spine-strip {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 6px;
            background: linear-gradient(90deg, rgba(255,255,255,0.3) 0%, rgba(0,0,0,0.05) 50%, rgba(0,0,0,0.35) 100%);
            border-right: 1px solid rgba(0,0,0,0.15);
            z-index: 10;
        }
        .book-paper-edge {
            position: absolute;
            top: 1px;
            bottom: 1px;
            right: 0;
            width: 3px;
            background: repeating-linear-gradient(180deg, #fdfbf7, #fdfbf7 1px, #e2dcd0 1px, #e2dcd0 2px);
            border-left: 1px solid rgba(0,0,0,0.15);
            z-index: 5;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased bg-slate-100/70 flex">

    <!-- Backdrop Overlay for Mobile Sidebar -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity duration-300"></div>

            <!-- ==================== SIDEBAR ==================== -->
    <aside id="member-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 brand-dark text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-white/10 shadow-xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        
        <div class="p-5">
            <!-- Brand Header (Clean Full Logo) -->
            <div class="pb-4 mb-4 border-b border-white/10 flex items-center justify-center">
                <a href="{{ route('member.dashboard') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-12 w-auto object-contain" />
                </a>
            </div>

            <!-- User Profile Box -->
            <div class="p-3 bg-white/5 border border-white/10 rounded-sm mb-5 flex items-center gap-3">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-sm object-cover shrink-0 ring-1 ring-emerald-400/40" />
                @else
                    <div class="w-9 h-9 rounded-sm bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-extrabold text-xs shrink-0 shadow-xs ring-1 ring-emerald-500/30">
                        {{ $user->initials }}
                    </div>
                @endif
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-bold text-white truncate leading-snug">{{ $user->name }}</p>
                    <p class="text-[10.5px] text-emerald-300/80 truncate mt-0.5">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-5 text-xs">
                
                <!-- Section 1: Layanan Utama -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Menu Utama</span>
                    <div class="space-y-1">
                        <a href="{{ route('member.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('member.dashboard') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
                            <i class="fa-solid fa-gauge-high w-4 text-center"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('member.orders') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('member.orders*') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
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

                        <a href="{{ route('katalog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
                            <i class="fa-solid fa-book-open w-4 text-center"></i>
                            <span>Katalog Buku</span>
                        </a>
                    </div>
                </div>

                <!-- Section 2: Pengaturan Akun & Kontak -->
                <div>
                    <span class="px-3 text-[10px] font-bold tracking-wider text-emerald-400/60 uppercase block mb-2">Akun &amp; Bantuan</span>
                    <div class="space-y-1">
                        <a href="{{ route('member.profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition {{ request()->routeIs('member.profile') ? 'bg-emerald-600/20 text-emerald-400 font-bold border border-emerald-500/30' : 'hover:bg-white/10 hover:text-white text-slate-300' }}">
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

        <!-- Top Header Bar with Hamburger Toggle -->
        <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-3 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            
            <div class="flex items-center gap-3">
                <!-- Hamburger Toggle Button (Desktop & Mobile) -->
                <button type="button" onclick="toggleSidebar()" class="p-2 text-slate-600 hover:text-emerald-800 hover:bg-slate-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer" title="Buka / Tutup Menu Sidebar">
                    <i class="fa-solid fa-bars-staggered text-sm"></i>
                </button>

                <!-- Mobile Logo -->
                <div class="flex items-center gap-2 lg:hidden">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-9 w-auto object-contain bg-[#032c21] p-1 rounded-sm" />
                    </a>
                </div>

                <!-- Breadcrumb -->
                <div class="hidden sm:flex items-center gap-2 text-xs">
                    <a href="{{ route('member.dashboard') }}" class="text-slate-500 hover:text-emerald-700 transition">Portal Member</a>
                    <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>
                    <span class="font-bold text-slate-800">Pesanan & Transaksi Buku</span>
                </div>
            </div>

            <!-- Top Header Right Actions -->
            <div class="flex items-center gap-2.5 sm:gap-3.5">
                <a href="{{ route('katalog') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold transition shadow-2xs">
                    <i class="fa-solid fa-book-open text-[10px]"></i>
                    <span class="hidden sm:inline">Katalog Buku</span>
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
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-in max-w-6xl w-full mx-auto space-y-5">

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

            <!-- Title & Filter Section -->
            <div class="bg-white rounded-sm border border-slate-200 p-5 shadow-xs space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-3.5">
                    <div>
                        <h1 class="text-lg sm:text-xl font-black text-slate-900 font-heading tracking-tight flex items-center gap-2">
                            <span class="w-7 h-7 rounded-xs bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-receipt"></i>
                            </span>
                            <span>Riwayat Pesanan & Transaksi Buku</span>
                        </h1>
                        <p class="text-xs text-slate-500 mt-1">Pantau status pembayaran QRIS, progres pengemasan redaksi, nomor resi pengiriman, dan konfirmasi penerimaan.</p>
                    </div>
                </div>

                <!-- Status Filter Tabs -->
                <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs select-none">
                    <a href="{{ route('member.orders') }}" 
                        class="px-3.5 py-1.5 rounded-sm transition whitespace-nowrap {{ !$statusFilter ? 'bg-[#006830] text-white shadow-xs font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200 font-semibold' }}">
                        Semua ({{ $countAll }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'diproses']) }}" 
                        class="px-3.5 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'diproses' ? 'bg-[#006830] text-white shadow-xs font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200 font-semibold' }}">
                        <i class="fa-solid fa-box-archive mr-1"></i> Sedang Dipacking ({{ $countProcessing }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'dikirim']) }}" 
                        class="px-3.5 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'dikirim' ? 'bg-[#006830] text-white shadow-xs font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200 font-semibold' }}">
                        <i class="fa-solid fa-truck-fast mr-1"></i> Dalam Pengiriman ({{ $countShipping }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'selesai']) }}" 
                        class="px-3.5 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'selesai' ? 'bg-[#006830] text-white shadow-xs font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200 font-semibold' }}">
                        <i class="fa-solid fa-circle-check mr-1"></i> Selesai / Diterima ({{ $countCompleted }})
                    </a>
                    <a href="{{ route('member.orders', ['status' => 'pending']) }}" 
                        class="px-3.5 py-1.5 rounded-sm transition whitespace-nowrap {{ $statusFilter === 'pending' ? 'bg-amber-600 text-white shadow-xs font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100 border border-slate-200 font-semibold' }}">
                        <i class="fa-solid fa-clock mr-1"></i> Menunggu Bayar ({{ $countPending }})
                    </a>
                </div>
            </div>

            <!-- Orders Cards Grid -->
            @if($orders->count() > 0)
                <div class="space-y-5">
                    @foreach($orders as $ord)
                        <div class="bg-white rounded-sm border border-slate-200 shadow-xs overflow-hidden transition-all duration-200 hover:border-emerald-700/60 hover:shadow-md group">
                            
                            <!-- Card Header -->
                            <div class="p-4 bg-slate-50 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                                <div class="flex flex-wrap items-center gap-2.5 sm:gap-3">
                                    <span class="font-mono font-bold text-emerald-900 bg-emerald-50 border border-emerald-200 px-2.5 py-1 rounded-xs">
                                        #{{ $ord->order_number }}
                                    </span>
                                    <span class="text-slate-500 font-medium flex items-center gap-1.5">
                                        <i class="fa-regular fa-calendar-days text-[11px] text-slate-400"></i>
                                        {{ $ord->created_at->format('d M Y, H:i') }} WIB
                                    </span>
                                    <span class="text-slate-300 hidden sm:inline">•</span>
                                    <span class="font-mono uppercase text-slate-600 font-bold bg-slate-100 px-2 py-0.5 rounded-xs border border-slate-200">
                                        {{ $ord->payment_method }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-2 shrink-0">
                                    @if($ord->payment_status === 'completed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-xs text-xs font-bold uppercase border border-emerald-300 shadow-2xs">
                                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Lunas (QRIS)
                                        </span>
                                    @elseif($ord->payment_status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 text-amber-900 rounded-xs text-xs font-bold uppercase border border-amber-300">
                                            <i class="fa-solid fa-clock text-amber-600"></i> Menunggu Pembayaran
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-100 text-red-800 rounded-xs text-xs font-bold uppercase">
                                            {{ strtoupper($ord->payment_status) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Middle: Interactive Step Tracker -->
                            <div class="px-5 py-3 bg-slate-50/50 border-b border-slate-100 hidden sm:block">
                                <div class="grid grid-cols-4 gap-2 text-center text-[11px]">
                                    
                                    <!-- Step 1: Pembayaran -->
                                    <div class="flex flex-col items-center">
                                        <div class="w-6 h-6 rounded-full {{ $ord->payment_status === 'completed' ? 'bg-emerald-600 text-white' : 'bg-amber-500 text-white' }} flex items-center justify-center text-[10px] font-bold shadow-2xs">
                                            <i class="fa-solid {{ $ord->payment_status === 'completed' ? 'fa-check' : 'fa-clock' }}"></i>
                                        </div>
                                        <span class="font-bold text-slate-800 mt-1">1. Pembayaran</span>
                                        <span class="text-[10px] {{ $ord->payment_status === 'completed' ? 'text-emerald-700 font-semibold' : 'text-amber-600' }}">
                                            {{ $ord->payment_status === 'completed' ? 'Terverifikasi' : 'Menunggu' }}
                                        </span>
                                    </div>

                                    <!-- Step 2: Dikemas -->
                                    <div class="flex flex-col items-center">
                                        @php
                                            $isPack = in_array($ord->shipping_status, ['diproses', 'dikirim', 'selesai']);
                                        @endphp
                                        <div class="w-6 h-6 rounded-full {{ $isPack ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center text-[10px] font-bold">
                                            <i class="fa-solid fa-box-archive"></i>
                                        </div>
                                        <span class="font-bold text-slate-800 mt-1">2. Pengemasan</span>
                                        <span class="text-[10px] {{ $isPack ? 'text-emerald-700 font-semibold' : 'text-slate-400' }}">
                                            {{ $isPack ? 'Siap / Selesai' : 'Antrean' }}
                                        </span>
                                    </div>

                                    <!-- Step 3: Dikirim -->
                                    <div class="flex flex-col items-center">
                                        @php
                                            $isShip = in_array($ord->shipping_status, ['dikirim', 'selesai']);
                                        @endphp
                                        <div class="w-6 h-6 rounded-full {{ $isShip ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center text-[10px] font-bold">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </div>
                                        <span class="font-bold text-slate-800 mt-1">3. Pengiriman</span>
                                        <span class="text-[10px] {{ $isShip ? 'text-emerald-700 font-semibold' : 'text-slate-400' }}">
                                            {{ $isShip ? ($ord->tracking_number ? 'Resi Aktif' : 'Dalam Perjalanan') : 'Belum Dikirim' }}
                                        </span>
                                    </div>

                                    <!-- Step 4: Selesai -->
                                    <div class="flex flex-col items-center">
                                        @php
                                            $isDone = ($ord->shipping_status === 'selesai');
                                        @endphp
                                        <div class="w-6 h-6 rounded-full {{ $isDone ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center text-[10px] font-bold">
                                            <i class="fa-solid fa-hand-holding-heart"></i>
                                        </div>
                                        <span class="font-bold text-slate-800 mt-1">4. Diterima</span>
                                        <span class="text-[10px] {{ $isDone ? 'text-emerald-700 font-semibold' : 'text-slate-400' }}">
                                            {{ $isDone ? 'Paket Sampai' : 'Konfirmasi' }}
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <!-- Card Body: Large Clear Book Covers & Details -->
                            <div class="p-5 sm:p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                                
                                <!-- Left: Books List with High-Res 3D Cover (7 cols) -->
                                <div class="lg:col-span-7 space-y-4">
                                    @if(!empty($ord->items_json))
                                        @foreach($ord->items_json as $it)
                                            @php
                                                // Resolve Book Cover image
                                                $coverPath = $it['cover_image'] ?? null;
                                                if (!$coverPath && !empty($it['book_id'])) {
                                                    $b = \App\Models\Book::find($it['book_id']);
                                                    $coverPath = $b ? $b->cover_image : null;
                                                }
                                                $hasImage = $coverPath && (file_exists(public_path('storage/' . $coverPath)) || file_exists(public_path('images/' . $coverPath)));
                                                $imageSrc = $hasImage ? (file_exists(public_path('storage/' . $coverPath)) ? asset('storage/' . $coverPath) : asset('images/' . $coverPath)) : null;
                                            @endphp

                                            <div class="flex items-start gap-4 p-3 bg-slate-50/70 border border-slate-200/80 rounded-sm">
                                                
                                                <!-- High-Definition 3D Book Cover Stage -->
                                                <div class="book-stage-3d shrink-0">
                                                    <div class="book-cover-3d relative w-20 sm:w-24 aspect-[3/4.2] bg-slate-900 rounded-xs overflow-hidden border border-slate-300 shadow-sm select-none">
                                                        <div class="book-spine-strip"></div>
                                                        <div class="book-paper-edge"></div>
                                                        
                                                        @if($hasImage)
                                                            <img src="{{ $imageSrc }}" alt="{{ $it['title'] ?? 'Buku' }}" class="w-full h-full object-cover" />
                                                        @else
                                                            <div class="w-full h-full bg-[#032c21] p-2 pl-3 flex flex-col justify-between text-white border-l-2 border-emerald-400">
                                                                <div class="flex justify-between items-center border-b border-white/20 pb-0.5">
                                                                    <span class="text-[7px] font-mono text-emerald-300 font-bold uppercase">PERSIS</span>
                                                                </div>
                                                                <div class="my-auto py-1 text-center">
                                                                    <h5 class="text-[8.5px] font-black text-white leading-tight line-clamp-3">{{ $it['title'] ?? 'Buku' }}</h5>
                                                                </div>
                                                                <div class="text-[6.5px] text-slate-300 truncate border-t border-white/10 pt-0.5">
                                                                    {{ $it['author'] ?? 'Penulis' }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Book Text Information -->
                                                <div class="flex-1 min-w-0 space-y-1 text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded-xs uppercase tracking-wide border border-emerald-200">
                                                            {{ $it['category'] ?? 'Penerbitan' }}
                                                        </span>
                                                    </div>
                                                    <h3 class="font-black text-slate-900 text-sm leading-snug hover:text-emerald-800 transition">
                                                        {{ $it['title'] ?? 'Judul Buku' }}
                                                    </h3>
                                                    <p class="text-[11px] text-slate-600 flex items-center gap-1.5 font-medium">
                                                        <i class="fa-solid fa-user-pen text-slate-400 text-[10px]"></i>
                                                        <span>{{ $it['author'] ?? 'Tim Penulis IAI Persis' }}</span>
                                                    </p>

                                                    <div class="pt-2 flex items-center justify-between border-t border-slate-200/60 mt-2">
                                                        <span class="text-xs text-slate-500 font-mono">
                                                            {{ $it['quantity'] ?? 1 }} eks @ {{ $it['formatted_price'] ?? 'Rp 0' }}
                                                        </span>
                                                        <span class="font-black font-mono text-sm text-slate-900">
                                                            {{ $it['formatted_subtotal'] ?? 'Rp 0' }}
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <!-- Right: Shipping Info & Status Breakdown (5 cols) -->
                                <div class="lg:col-span-5 bg-slate-50 border border-slate-200 p-4 sm:p-5 rounded-sm space-y-3.5 text-xs">
                                    
                                    <div class="flex items-center justify-between border-b border-slate-200 pb-2.5">
                                        <span class="font-bold text-slate-500 uppercase tracking-wider text-[10.5px]">Status Pengiriman:</span>
                                        @if($ord->shipping_status === 'selesai')
                                            <span class="px-2.5 py-1 rounded-xs text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-300 uppercase shadow-2xs">
                                                <i class="fa-solid fa-circle-check text-emerald-600 mr-1"></i> Diterima / Selesai
                                            </span>
                                        @elseif($ord->shipping_status === 'dikirim')
                                            <span class="px-2.5 py-1 rounded-xs text-[11px] font-bold bg-blue-100 text-blue-800 border border-blue-300 uppercase shadow-2xs animate-pulse">
                                                <i class="fa-solid fa-truck-fast text-blue-600 mr-1"></i> Sedang Dikirim
                                            </span>
                                        @elseif($ord->shipping_status === 'diproses')
                                            <span class="px-2.5 py-1 rounded-xs text-[11px] font-bold bg-amber-100 text-amber-900 border border-amber-300 uppercase">
                                                <i class="fa-solid fa-box-archive text-amber-600 mr-1"></i> Sedang Dikemas
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-xs text-[11px] font-bold bg-slate-200 text-slate-700 uppercase">
                                                <i class="fa-solid fa-hourglass-half text-slate-500 mr-1"></i> Menunggu Antrean
                                            </span>
                                        @endif
                                    </div>

                                    @if($ord->tracking_number)
                                        <div class="p-3 bg-white rounded-xs border border-slate-200 space-y-1">
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Nomor Resi Ekspedisi:</span>
                                            <div class="flex items-center justify-between">
                                                <span class="font-black text-emerald-900 font-mono text-sm tracking-wide select-all">{{ $ord->tracking_number }}</span>
                                                <span class="text-[10px] bg-emerald-50 text-emerald-800 border border-emerald-200 px-1.5 py-0.5 rounded-xs font-semibold">Aktif</span>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="space-y-1.5 pt-1">
                                        <div class="flex justify-between text-slate-500">
                                            <span>Subtotal Buku:</span>
                                            <span class="font-mono text-slate-800 font-medium">{{ $ord->formatted_total }}</span>
                                        </div>
                                        @if($ord->fee > 0)
                                            <div class="flex justify-between text-slate-500">
                                                <span>Biaya Layanan QRIS:</span>
                                                <span class="font-mono text-slate-800 font-medium">{{ $ord->formatted_fee }}</span>
                                            </div>
                                        @endif
                                        <div class="pt-2 border-t border-slate-300 flex justify-between items-center text-slate-900">
                                            <span class="font-bold text-xs">Total Pembayaran:</span>
                                            <span class="font-black font-mono text-base text-emerald-900">{{ $ord->formatted_payment }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- Card Footer: Delivery Address & Action Buttons -->
                            <div class="p-4 bg-slate-50/90 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3.5 text-xs">
                                <div class="text-[11px] text-slate-600 text-center sm:text-left leading-relaxed">
                                    <span class="text-slate-400 font-medium">Alamat Penerima:</span> <strong class="text-slate-800 font-bold">{{ $ord->customer_name }}</strong> ({{ $ord->customer_phone }}) — <span class="text-slate-500">{{ Str::limit($ord->customer_address, 65) }}</span>
                                </div>

                                <div class="flex items-center gap-2.5 shrink-0">
                                    <!-- Tombol Konfirmasi Diterima (Jika status dikirim) -->
                                    @if($ord->shipping_status === 'dikirim')
                                        <form method="POST" action="{{ route('member.orders.confirm_received', $ord->order_number) }}" onsubmit="return confirm('Apakah Anda yakin paket buku telah sampai dan diterima dengan baik?')">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-2 shadow-xs cursor-pointer">
                                                <i class="fa-solid fa-circle-check text-lime-300 text-sm"></i>
                                                <span>Konfirmasi Paket Diterima</span>
                                            </button>
                                        </form>
                                    @elseif($ord->shipping_status === 'selesai')
                                        <span class="px-3 py-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-sm text-xs font-bold flex items-center gap-1.5">
                                            <i class="fa-solid fa-circle-check text-emerald-600"></i> Paket Selesai Diterima
                                        </span>
                                    @endif

                                    <!-- Tombol Lihat Invoice -->
                                    <a href="{{ route('order.invoice', $ord->order_number) }}" target="_blank" class="px-3.5 py-2 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                                        <i class="fa-solid fa-file-invoice text-emerald-700"></i>
                                        <span>Lihat Invoice</span>
                                    </a>

                                    <!-- Tombol WhatsApp Redaksi -->
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PENERBIT PERSIS, saya ingin menanyakan pesanan #' . $ord->order_number . ' atas nama ' . $ord->customer_name . '.') }}" target="_blank" class="px-3.5 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 border border-emerald-200 rounded-sm text-xs font-bold transition flex items-center gap-1.5">
                                        <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                        <span class="hidden sm:inline">Hubungi Redaksi</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    <!-- Pagination -->
                    @if($orders->hasPages())
                        <div class="pt-3">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="p-12 text-center bg-white rounded-sm border border-slate-200 space-y-3.5 shadow-xs">
                    <div class="w-16 h-16 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center mx-auto text-2xl">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900 font-heading">Tidak Ada Pesanan Ditemukan</h3>
                        <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto leading-relaxed">
                            @if($statusFilter)
                                Tidak ada transaksi buku dengan filter status yang Anda pilih.
                            @else
                                Anda belum memiliki riwayat pembelian buku di PENERBIT PERSIS. Mulai pesan sekarang!
                            @endif
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-xs">
                            <i class="fa-solid fa-book-open text-xs"></i>
                            <span>Jelajahi Katalog Buku</span>
                        </a>
                    </div>
                </div>
            @endif

        </main>
    </div>

    <!-- Dropdown & Sidebar JS with Persistent Collapse Memory -->
    <script>
        // Check stored desktop preference
        if (window.innerWidth >= 1024) {
            const savedState = localStorage.getItem('persis_member_sidebar_collapsed');
            if (savedState === 'true') {
                collapseSidebarDesktop();
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('member-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth < 1024) {
                // Mobile behavior (Off-canvas drawer)
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            } else {
                // Desktop behavior (Collapsible Full / Hidden toggle)
                if (sidebar.classList.contains('lg:translate-x-0')) {
                    collapseSidebarDesktop();
                } else {
                    expandSidebarDesktop();
                }
            }
        }

        function collapseSidebarDesktop() {
            const sidebar = document.getElementById('member-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            sidebar.classList.remove('lg:translate-x-0');
            sidebar.classList.add('lg:-translate-x-full');
            wrapper.classList.remove('lg:pl-64');
            wrapper.classList.add('lg:pl-0');
            localStorage.setItem('persis_member_sidebar_collapsed', 'true');
        }

        function expandSidebarDesktop() {
            const sidebar = document.getElementById('member-sidebar');
            const wrapper = document.getElementById('main-content-wrapper');
            sidebar.classList.add('lg:translate-x-0');
            sidebar.classList.remove('lg:-translate-x-full');
            wrapper.classList.add('lg:pl-64');
            wrapper.classList.remove('lg:pl-0');
            localStorage.setItem('persis_member_sidebar_collapsed', 'false');
        }
    </script>

</body>
</html>
