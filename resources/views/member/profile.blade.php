<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Profil & Pengaturan Akun | Portal Member PENERBIT PERSIS</title>
    <!-- Favicons & App Icons (Forced & Canonical) -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=3">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=3">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=3">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=3">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}?v=3">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=3">
    
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
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in { animation: fadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1) both; }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased bg-slate-100 flex flex-col lg:flex-row">

    <!-- Backdrop Overlay for Mobile Sidebar -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 lg:hidden hidden transition-opacity duration-300"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside id="member-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 brand-dark text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-white/10 shadow-2xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        
        <div class="p-5">
            <!-- Brand Header (Clean Full Logo) -->
            <div class="pb-4 mb-4 border-b border-white/10 flex items-center justify-between lg:justify-center">
                <a href="{{ route('member.dashboard') }}" class="inline-block transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-11 w-auto object-contain" />
                </a>
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-sm hover:bg-white/10 transition" title="Tutup Menu">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
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

        <!-- Top Header Bar -->
        <header class="bg-white border-b border-slate-200 px-4 sm:px-8 py-2.5 sm:py-3 sticky top-0 z-30 flex items-center justify-between shadow-2xs">
            
            <!-- Left Header: Toggle & Branding -->
            <div class="flex items-center gap-3">
                <!-- Desktop Sidebar Toggle Button (Hidden on Mobile) -->
                <button type="button" onclick="toggleSidebar()" class="hidden lg:flex p-2 text-slate-600 hover:text-emerald-800 hover:bg-slate-100 rounded-sm border border-slate-200 transition items-center justify-center cursor-pointer" title="Buka / Tutup Menu Sidebar">
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
                    <span class="font-bold text-slate-800">Profil &amp; Pengaturan Akun</span>
                </div>
            </div>

            <!-- Right Header Actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Member Notification Bell Dropdown -->
                <div class="relative" id="memberNotifContainer">
                    <button 
                        type="button" 
                        onclick="toggleMemberNotifDropdown(event)" 
                        id="memberBellBtn"
                        class="relative p-1.5 sm:p-2 text-slate-600 hover:text-emerald-800 hover:bg-emerald-50 active:bg-emerald-100 rounded-sm border border-slate-200 transition flex items-center justify-center cursor-pointer select-none"
                        title="Notifikasi Pesanan"
                    >
                        <i id="memberBellIcon" class="fa-regular fa-bell text-sm transition-transform duration-300"></i>
                        <span id="memberBellBadge" class="{{ ($memberActiveNotifCount ?? 0) > 0 ? '' : 'hidden' }} absolute -top-1 -right-1 min-w-[17px] h-[17px] px-1 rounded-full bg-emerald-600 text-white text-[8.5px] font-black flex items-center justify-center font-mono shadow-xs animate-pulse">
                            {{ $memberActiveNotifCount ?? 0 }}
                        </span>
                    </button>

                    <!-- Dropdown Content -->
                    <div id="memberNotifDropdown" class="hidden absolute top-full right-0 mt-2 w-80 sm:w-96 bg-white rounded-xl shadow-2xl border border-slate-200/90 overflow-hidden z-[9999] animate-fade-in select-none" style="display: none;">
                        
                        <!-- Header -->
                        <div class="p-3.5 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400">
                                    <i class="fa-solid fa-bell text-[11px]"></i>
                                </div>
                                <span class="text-xs font-bold uppercase tracking-wider font-heading">Notifikasi Pesanan</span>
                            </div>
                            <span class="text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 px-2 py-0.5 rounded-full font-mono font-bold">
                                {{ $memberActiveNotifCount ?? 0 }} Aktif
                            </span>
                        </div>

                        <!-- Notification List -->
                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100 text-xs">
                            @if(isset($memberNotifOrders) && $memberNotifOrders->count() > 0)
                                @foreach($memberNotifOrders as $nord)
                                    <a href="{{ route('order.invoice', $nord->order_number) }}" class="block p-3 hover:bg-slate-50 transition">
                                        <div class="flex items-start gap-2.5">
                                            @if($nord->shipping_status === 'dikirim')
                                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-truck-fast"></i>
                                                </div>
                                            @elseif($nord->payment_status === 'pending')
                                                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-clock"></i>
                                                </div>
                                            @elseif($nord->shipping_status === 'selesai')
                                                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </div>
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                                    <i class="fa-solid fa-box"></i>
                                                </div>
                                            @endif

                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between gap-1">
                                                    <span class="font-bold text-slate-900 truncate">#{{ $nord->order_number }}</span>
                                                    <span class="text-[10px] text-slate-400 font-mono shrink-0">{{ $nord->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-[11px] text-slate-600 truncate mt-0.5">
                                                    @if($nord->shipping_status === 'dikirim')
                                                        <span class="text-blue-700 font-semibold">Sedang Dikirim</span> &bull; Resi: {{ $nord->tracking_number ?: '-' }}
                                                    @elseif($nord->payment_status === 'pending')
                                                        <span class="text-amber-700 font-semibold">Menunggu Pembayaran QRIS</span>
                                                    @elseif($nord->shipping_status === 'selesai')
                                                        <span class="text-emerald-700 font-semibold">Pesanan Selesai / Diterima</span>
                                                    @else
                                                        <span class="text-indigo-700 font-semibold">Sedang Dipacking Redaksi</span>
                                                    @endif
                                                </p>
                                                <p class="text-[10px] text-slate-400 mt-0.5">
                                                    Total: <strong class="text-slate-700 font-mono">{{ $nord->formatted_payment }}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="p-8 text-center text-slate-400 text-xs">
                                    <i class="fa-regular fa-bell-slash text-3xl mb-2 text-slate-300 block"></i>
                                    Belum ada notifikasi pesanan saat ini.
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('member.orders') }}" class="text-xs font-bold text-emerald-800 hover:text-emerald-950 transition flex items-center justify-center gap-1">
                                <span>Lihat Semua Riwayat Pesanan</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <a href="{{ route('member.dashboard') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm border border-slate-200 hover:border-emerald-600 text-xs font-bold text-slate-700 hover:text-emerald-800 hover:bg-emerald-50/50 transition shadow-2xs">
                    <i class="fa-solid fa-arrow-left text-[10px] text-emerald-700"></i>
                    <span class="hidden sm:inline">Kembali ke Dashboard</span>
                    <span class="sm:hidden text-xs">Beranda</span>
                </a>
            </div>
        </header>

        <!-- Main Body (App-like Mobile Settings) -->
        <main class="flex-1 p-3.5 sm:p-6 lg:p-8 pb-24 lg:pb-8 animate-fade-in max-w-4xl w-full mx-auto space-y-4 sm:space-y-5">

            <!-- Alerts -->
            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-sm flex items-center gap-2.5 text-xs sm:text-sm text-emerald-900 font-semibold shadow-2xs">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-base shrink-0"></i>
                    <div>
                        <p class="font-bold text-emerald-950">Berhasil!</p>
                        <p class="text-xs text-emerald-800 font-normal mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="p-3.5 bg-rose-50 border border-rose-200 rounded-sm text-xs text-rose-800 space-y-1 shadow-2xs">
                    <div class="flex items-center gap-2 font-bold text-rose-900">
                        <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                        <span>Mohon periksa kesalahan input berikut:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 pl-4 text-rose-700 text-[11px]">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- App Title Bar -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-3.5 sm:p-5 shadow-2xs flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-base shrink-0">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <div>
                        <h1 class="text-sm sm:text-lg font-extrabold text-slate-900 font-heading leading-tight">
                            Pengaturan Akun &amp; Foto
                        </h1>
                        <p class="text-[11px] text-slate-500 mt-0.5">Kelola data profil, WhatsApp, dan keamanan kata sandi Anda</p>
                    </div>
                </div>
            </div>

            <!-- Profile Info & Avatar Upload Card -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-6 shadow-2xs space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i class="fa-solid fa-id-card text-emerald-700 text-xs"></i>
                    <h2 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading">Data Pribadi &amp; Foto Profil</h2>
                </div>

                <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Box -->
                    <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-sm flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                        <div class="relative shrink-0">
                            <div id="avatarPreviewContainer" class="w-18 h-18 sm:w-20 sm:h-20 rounded-sm overflow-hidden bg-slate-200 border-2 border-emerald-700 shadow-xs flex items-center justify-center">
                                @if($user->avatar_url)
                                    <img id="avatarPreviewImg" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover" />
                                @else
                                    <div id="avatarFallbackText" class="w-full h-full bg-[#032c21] flex items-center justify-center text-white font-extrabold text-xl sm:text-2xl">
                                        {{ $user->initials }}
                                    </div>
                                    <img id="avatarPreviewImg" src="" alt="Preview" class="w-full h-full object-cover hidden" />
                                @endif
                            </div>
                            <label for="avatar_input" class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full flex items-center justify-center text-[10px] shadow-xs cursor-pointer transition" title="Ganti Foto">
                                <i class="fa-solid fa-camera"></i>
                            </label>
                        </div>

                        <div class="flex-1 min-w-0 space-y-1">
                            <p class="text-xs font-bold text-slate-800">Unggah Foto Profil Baru</p>
                            <p class="text-[11px] text-slate-500">Mendukung format JPG, PNG, WEBP, atau SVG (Maks. 3MB)</p>
                            <div class="pt-1.5 flex flex-wrap items-center justify-center sm:justify-start gap-2">
                                <input type="file" name="avatar" id="avatar_input" accept="image/*" class="hidden" onchange="previewAvatar(this)" />
                                <label for="avatar_input" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white hover:bg-slate-100 border border-slate-300 rounded-sm text-xs font-bold text-slate-700 transition cursor-pointer shadow-2xs">
                                    <i class="fa-solid fa-upload text-emerald-700"></i>
                                    <span>Pilih Berkas Foto</span>
                                </label>
                                <span id="fileNameDisplay" class="text-[11px] text-slate-500 italic">Belum ada file dipilih</span>
                            </div>
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="space-y-3.5 pt-1">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                                    class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-300 rounded-sm text-slate-900 focus:ring-1 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition" 
                                    placeholder="Masukkan nama lengkap Anda" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Nomor WhatsApp <span class="text-slate-400 font-normal text-[11px]">(Untuk konfirmasi resi pengiriman)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-emerald-600 text-xs">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                                    class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-300 rounded-sm text-slate-900 focus:ring-1 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition font-mono" 
                                    placeholder="Contoh: 081234567890" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Alamat Email <span class="text-slate-400 font-normal text-[11px]">(Akun Login - Tidak dapat diubah)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <input type="email" value="{{ $user->email }}" disabled 
                                    class="w-full pl-9 pr-3 py-2 text-xs bg-slate-100 border border-slate-200 rounded-sm text-slate-500 cursor-not-allowed outline-none font-mono" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
                            <i class="fa-solid fa-floppy-disk"></i>
                            <span>Simpan Perubahan Profil</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Password Change Card -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-6 shadow-2xs space-y-4">
                <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                    <i class="fa-solid fa-shield-halved text-emerald-700 text-xs"></i>
                    <h2 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading">Keamanan Kata Sandi</h2>
                </div>

                <form method="POST" action="{{ route('member.profile.password') }}" class="space-y-3.5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Kata Sandi Saat Ini
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" name="current_password" required 
                                class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-300 rounded-sm text-slate-900 focus:ring-1 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition" 
                                placeholder="Masukkan password lama" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Kata Sandi Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-key"></i>
                                </div>
                                <input type="password" name="password" required minlength="8" 
                                    class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-300 rounded-sm text-slate-900 focus:ring-1 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition" 
                                    placeholder="Minimal 8 karakter" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">
                                Konfirmasi Kata Sandi Baru
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                                    <i class="fa-solid fa-check-double"></i>
                                </div>
                                <input type="password" name="password_confirmation" required minlength="8" 
                                    class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-300 rounded-sm text-slate-900 focus:ring-1 focus:ring-emerald-600 focus:border-emerald-600 outline-none transition" 
                                    placeholder="Ulangi kata sandi baru" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-2 shadow-2xs cursor-pointer">
                            <i class="fa-solid fa-key"></i>
                            <span>Perbarui Kata Sandi</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Logout Section for Mobile Convenience -->
            <div class="bg-white rounded-sm border border-red-200 p-4 shadow-2xs flex items-center justify-between gap-3">
                <div>
                    <h3 class="text-xs font-bold text-red-900">Keluar dari Akun Member</h3>
                    <p class="text-[11px] text-slate-500">Akhiri sesi aktif Anda pada perangkat ini</p>
                </div>
                <form method="POST" action="{{ route('member.logout') }}">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar dari akun?')" class="px-3.5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>

        </main>
    </div>

    <!-- ==================== MOBILE APP BOTTOM NAVIGATION BAR ==================== -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-2 py-1.5 flex items-center justify-around select-none">
        
        <!-- 1. Dashboard -->
        <a href="{{ route('member.dashboard') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition {{ request()->routeIs('member.dashboard') ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-800 font-medium' }}">
            <div class="relative">
                <i class="fa-solid fa-gauge-high text-base"></i>
                @if(request()->routeIs('member.dashboard'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Dashboard</span>
        </a>

        <!-- 2. Pesanan Saya (with Live Badge) -->
        <a href="{{ route('member.orders') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition {{ request()->routeIs('member.orders*') ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-800 font-medium' }}">
            <div class="relative">
                <i class="fa-solid fa-receipt text-base"></i>
                @php
                    $navOrdCount = \App\Models\Order::where('user_id', Auth::id())->orWhere('customer_email', Auth::user()->email)->count();
                @endphp
                @if($navOrdCount > 0)
                    <span class="absolute -top-1.5 -right-2.5 px-1 min-w-[14px] h-[14px] rounded-full bg-emerald-600 text-white text-[8.5px] font-black flex items-center justify-center font-mono">
                        {{ $navOrdCount }}
                    </span>
                @endif
                @if(request()->routeIs('member.orders*'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Pesanan</span>
        </a>

        <!-- 3. Katalog Buku -->
        <a href="{{ route('katalog') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-slate-800 font-medium">
            <div class="relative">
                <i class="fa-solid fa-book-open text-base"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Katalog</span>
        </a>

        <!-- 4. WhatsApp Redaksi -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Halo Redaksi PENERBIT PERSIS, saya member ' . $user->name . ' ingin berkonsultasi.') }}" target="_blank" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-emerald-700 font-medium">
            <div class="relative">
                <i class="fa-brands fa-whatsapp text-base text-emerald-600"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Redaksi</span>
        </a>

        <!-- 5. Profil Akun -->
        <a href="{{ route('member.profile') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition {{ request()->routeIs('member.profile') ? 'text-emerald-700 font-bold' : 'text-slate-500 hover:text-slate-800 font-medium' }}">
            <div class="relative">
                <i class="fa-solid fa-user text-base"></i>
                @if(request()->routeIs('member.profile'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
                @endif
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Akun</span>
        </a>

    </nav>

    <!-- Dropdown & Sidebar JS with Persistent Collapse Memory -->
    <script>
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
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            } else {
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

        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                document.getElementById('fileNameDisplay').textContent = file.name;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImg = document.getElementById('avatarPreviewImg');
                    const fallbackText = document.getElementById('avatarFallbackText');

                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    if (fallbackText) {
                        fallbackText.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        function toggleMemberNotifDropdown(e) {
            if (e) {
                try { e.preventDefault(); e.stopPropagation(); } catch(err) {}
            }
            const dropdown = document.getElementById('memberNotifDropdown');
            if (!dropdown) return;
            const isClosed = dropdown.classList.contains('hidden') || dropdown.style.display === 'none' || (window.getComputedStyle && window.getComputedStyle(dropdown).display === 'none');
            if (isClosed) {
                dropdown.style.display = 'block';
                dropdown.classList.remove('hidden');
            } else {
                dropdown.style.display = 'none';
                dropdown.classList.add('hidden');
            }
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('memberNotifDropdown');
            const container = document.getElementById('memberNotifContainer');
            if (dropdown && container && !container.contains(e.target)) {
                dropdown.style.display = 'none';
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
