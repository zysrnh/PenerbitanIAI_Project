<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | PERSIS PERS</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            800: '#143d2c',
                            900: '#0d281d',
                            950: '#091c14',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 14px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen antialiased text-slate-800 bg-[#f8fafc] flex flex-col lg:flex-row">

    @php
        $latestMessages = \App\Models\ContactMessage::latest()->take(6)->get();
        $unreadMessagesCount = \App\Models\ContactMessage::where('status', 'pending')->count();
    @endphp

    <!-- Sidebar (Fixed Width w-64) -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0f172a] text-slate-300 flex flex-col justify-between transition-transform duration-300 transform -translate-x-full lg:translate-x-0 border-r border-slate-800 shrink-0">
        <div>
            <!-- Brand Header with Official Logo -->
            <a href="{{ route('admin.dashboard') }}" class="h-16 flex items-center px-4 border-b border-slate-800/80 gap-3 group select-none">
                <img src="{{ asset('images/logo/logo_persis_pers_icon_transparent.png') }}" alt="PERSIS PERS" class="w-8 h-8 object-contain shrink-0 transition-transform group-hover:scale-105" />
                <div class="flex flex-col justify-center min-w-0">
                    <span class="font-black text-xs text-white uppercase tracking-wider leading-none truncate">PERSIS PERS</span>
                    <span class="text-[10px] text-emerald-400 font-semibold block mt-1 leading-none truncate">Admin Management</span>
                </div>
            </a>

            <!-- Nav Links -->
            <nav class="p-3.5 space-y-1 text-sm">
                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest px-3 block pt-2 pb-1.5">Overview</span>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.messages.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.messages.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-envelope-open-text w-5 text-center text-base"></i>
                        <span>Pesan & Naskah</span>
                    </div>
                    @if($unreadMessagesCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-xs font-extrabold bg-amber-500 text-slate-950">{{ $unreadMessagesCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-users-gear w-5 text-center text-base"></i>
                    <span>Manajemen Admin</span>
                </a>

                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest px-3 block pt-4 pb-1.5">Penerbitan</span>

                <a href="#" onclick="alert('Modul ini akan disiapkan selanjutnya!')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition">
                    <i class="fa-solid fa-book-bookmark w-5 text-center text-base"></i>
                    <span>Katalog Buku & ISBN</span>
                </a>

                <a href="#" onclick="alert('Modul ini akan disiapkan selanjutnya!')" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition">
                    <i class="fa-solid fa-print w-5 text-center text-base"></i>
                    <span>Antrean Cetak</span>
                </a>

                <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest px-3 block pt-4 pb-1.5">Pengaturan</span>

                <a href="{{ route('admin.settings.catalog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.settings.catalog*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
            <i class="fa-solid fa-book-open {{ request()->routeIs('admin.settings.catalog*') ? 'text-emerald-400' : 'text-slate-400' }}"></i>
            <span>Kelola Halaman Katalog</span>
        </a>
        <a href="{{ route('admin.settings.about') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.settings.about') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-circle-info w-5 text-center text-base"></i>
                    <span>Kelola Tentang Kami</span>
                </a>

                <a href="{{ route('admin.settings.contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.settings.contact*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-sliders w-5 text-center text-base"></i>
                    <span>Kelola Kontak & Web</span>
                </a>

                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-semibold transition {{ request()->routeIs('admin.profile.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-user-gear w-5 text-center text-base"></i>
                    <span>Profil Saya</span>
                </a>
            </nav>
        </div>

        <!-- User Profile Card -->
        <div class="p-3.5 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center justify-between gap-2.5 p-1.5 rounded-lg">
                <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-2.5 overflow-hidden group">
                    <div class="w-9 h-9 rounded-full bg-slate-800 border border-slate-700 text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0 group-hover:border-emerald-500 transition">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <h2 class="font-semibold text-sm text-white truncate group-hover:text-emerald-400 transition">{{ Auth::user()->name ?? 'Admin' }}</h2>
                        <span class="text-xs text-slate-400 block truncate">
                            {{ (Auth::user()->role ?? '') === 'super_admin' ? 'Super Admin' : 'Admin' }}
                        </span>
                    </div>
                </a>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" title="Keluar" class="w-8 h-8 rounded-md hover:bg-rose-500/10 text-slate-400 hover:text-rose-400 flex items-center justify-center transition">
                        <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay Mobile -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 z-40 hidden lg:hidden backdrop-blur-xs"></div>

    <!-- Main Content Container with Strict Boundaries -->
    <div class="flex-1 min-w-0 lg:pl-64 flex flex-col min-h-screen">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shrink-0">
            <div class="flex items-center gap-3 min-w-0">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 text-slate-600 focus:outline-none shrink-0">
                    <i class="fa-solid fa-bars-staggered text-lg"></i>
                </button>
                <div class="min-w-0 truncate">
                    <h2 class="text-base sm:text-lg font-bold text-slate-900 leading-tight truncate">@yield('header_title', 'Dashboard')</h2>
                </div>
            </div>

            <!-- Navbar Right: Notification Box & Quick Links -->
            <div class="flex items-center gap-3 shrink-0">
                
                <!-- NOTIFICATION DROPDOWN CONTAINER -->
                <div class="relative" id="notifDropdownContainer">
                    <button 
                        id="notifBellButton" 
                        onclick="toggleNotifDropdown()" 
                        class="relative p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 hover:text-slate-900 transition focus:outline-none"
                        title="Notifikasi Masuk"
                    >
                        <i class="fa-solid fa-bell text-base"></i>
                        @if($unreadMessagesCount > 0)
                            <span class="absolute -top-1 -right-1 min-w-[18px] h-[18px] rounded-full bg-rose-600 text-white text-[10px] font-extrabold flex items-center justify-center px-1 shadow-xs animate-pulse">
                                {{ $unreadMessagesCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Box -->
                    <div 
                        id="notifDropdown" 
                        class="hidden absolute right-0 mt-2.5 w-80 sm:w-96 bg-white rounded-2xl border border-slate-200 shadow-2xl z-50 overflow-hidden transform origin-top-right transition duration-200"
                    >
                        <!-- Header -->
                        <div class="p-4 bg-slate-900 text-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-bell text-emerald-400 text-sm"></i>
                                <h4 class="text-xs sm:text-sm font-bold">Notifikasi Pesan Masuk</h4>
                            </div>
                            @if($unreadMessagesCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-500 text-slate-950">
                                    {{ $unreadMessagesCount }} Baru
                                </span>
                            @endif
                        </div>

                        <!-- Filter Tabs -->
                        <div class="flex border-b border-slate-100 bg-slate-50/80 px-3 pt-2 text-xs font-semibold gap-2">
                            <button onclick="filterNotifs('all')" id="tab-all" class="notif-tab active px-3 py-1.5 border-b-2 border-emerald-600 text-emerald-800 font-bold">
                                Semua
                            </button>
                            <button onclick="filterNotifs('contact')" id="tab-contact" class="notif-tab px-3 py-1.5 border-b-2 border-transparent text-slate-500 hover:text-slate-800">
                                Form Kontak & Naskah
                            </button>
                        </div>

                        <!-- List Items -->
                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100" id="notifList">
                            @forelse($latestMessages as $msg)
                                <a 
                                    href="{{ route('admin.messages.show', $msg) }}" 
                                    class="notif-item block p-3.5 hover:bg-slate-50 transition {{ $msg->status === 'pending' ? 'bg-emerald-50/40' : '' }}"
                                    data-category="contact"
                                >
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full {{ $msg->status === 'pending' ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between gap-1 mb-0.5">
                                                <span class="text-xs font-bold text-slate-900 truncate">{{ $msg->name }}</span>
                                                <span class="text-[10px] text-slate-400 shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5 mb-1">
                                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                    {{ $msg->service_category ?? 'Kontak' }}
                                                </span>
                                                @if($msg->status === 'pending')
                                                    <span class="text-[9px] font-bold text-amber-600 flex items-center gap-1">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Belum dibaca
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-[11px] text-slate-500 truncate leading-snug">
                                                {{ $msg->subject ?: Str::limit($msg->message, 45) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="p-6 text-center text-slate-400 text-xs">
                                    <i class="fa-regular fa-bell-slash text-2xl mb-1 text-slate-300 block"></i>
                                    Belum ada notifikasi pesan masuk.
                                </div>
                            @endforelse
                        </div>

                        <!-- Footer -->
                        <div class="p-2.5 bg-slate-50 border-t border-slate-100 text-center">
                            <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 transition flex items-center justify-center gap-1.5 py-1">
                                <span>Buka Kotak Masuk Pesan Lengkap</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Web Link -->
                <a href="{{ url('/') }}" target="_blank" class="px-3.5 py-2 text-xs sm:text-sm font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-xl border border-slate-200 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-slate-400"></i>
                    <span class="hidden sm:inline">Lihat Web</span>
                </a>
            </div>
        </header>

        <!-- Page Body - Contained within viewport -->
        <main class="flex-1 min-w-0 p-4 sm:p-6 lg:p-8 w-full max-w-full">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50/90 border border-emerald-200 text-emerald-900 text-sm font-medium flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 text-base"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-rose-50/90 border border-rose-200 text-rose-900 text-sm font-medium flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 text-base"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-8 border-t border-slate-200/80 text-center text-xs text-slate-400 bg-white shrink-0">
            &copy; {{ date('Y') }} PERSIS PERS &bull; Sistem Manajemen Penerbitan
        </footer>
    </div>

    <!-- Dropdown & Sidebar JS -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function toggleNotifDropdown() {
            const dropdown = document.getElementById('notifDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const container = document.getElementById('notifDropdownContainer');
            const dropdown = document.getElementById('notifDropdown');
            if (container && !container.contains(e.target) && dropdown && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });

        // Filter Notifications in dropdown
        function filterNotifs(category) {
            const items = document.querySelectorAll('.notif-item');
            const tabAll = document.getElementById('tab-all');
            const tabContact = document.getElementById('tab-contact');

            if (category === 'all') {
                items.forEach(el => el.style.display = 'block');
                tabAll.className = 'notif-tab active px-3 py-1.5 border-b-2 border-emerald-600 text-emerald-800 font-bold';
                tabContact.className = 'notif-tab px-3 py-1.5 border-b-2 border-transparent text-slate-500 hover:text-slate-800';
            } else {
                items.forEach(el => {
                    if (el.getAttribute('data-category') === category) {
                        el.style.display = 'block';
                    } else {
                        el.style.display = 'none';
                    }
                });
                tabContact.className = 'notif-tab active px-3 py-1.5 border-b-2 border-emerald-600 text-emerald-800 font-bold';
                tabAll.className = 'notif-tab px-3 py-1.5 border-b-2 border-transparent text-slate-500 hover:text-slate-800';
            }
        }
    </script>
</body>
</html>
