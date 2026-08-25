<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | IAI PERSIS PRESS</title>

    <!-- Google Fonts Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Tailwind CDN -->
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="h-full antialiased text-slate-800 bg-[#f8fafc] flex">

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0f172a] text-slate-300 flex flex-col justify-between transition-transform duration-300 transform -translate-x-full lg:translate-x-0 border-r border-slate-800">
        <div>
            <!-- Brand Logo Header -->
            <div class="h-16 flex items-center px-5 border-b border-slate-800/80 gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-600/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shrink-0">
                    <i class="fa-solid fa-book-open-reader text-sm"></i>
                </div>
                <div>
                    <h1 class="font-bold text-sm text-white leading-none tracking-tight">IAI PERSIS PRESS</h1>
                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">Admin Management</span>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="p-3 space-y-1 text-xs">
                <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest px-3 block pt-2 pb-1.5">Overview</span>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-chart-pie w-4 text-center text-sm"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg font-semibold transition {{ request()->routeIs('admin.users.*') ? 'bg-emerald-500/10 text-emerald-400 font-bold' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                    <i class="fa-solid fa-users-gear w-4 text-center text-sm"></i>
                    <span>Manajemen Admin</span>
                </a>

                <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest px-3 block pt-4 pb-1.5">Penerbitan</span>

                <a href="#" onclick="alert('Modul ini akan disiapkan selanjutnya!')" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition">
                    <i class="fa-solid fa-book-bookmark w-4 text-center text-sm"></i>
                    <span>Katalog Buku & ISBN</span>
                </a>

                <a href="#" onclick="alert('Modul ini akan disiapkan selanjutnya!')" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition">
                    <i class="fa-solid fa-file-lines w-4 text-center text-sm"></i>
                    <span>Pengajuan Naskah</span>
                </a>

                <a href="#" onclick="alert('Modul ini akan disiapkan selanjutnya!')" class="flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-slate-400 hover:bg-slate-800/60 hover:text-slate-200 transition">
                    <i class="fa-solid fa-print w-4 text-center text-sm"></i>
                    <span>Antrean Cetak</span>
                </a>
            </nav>
        </div>

        <!-- User Profile Card -->
        <div class="p-3 border-t border-slate-800 bg-slate-900/50">
            <div class="flex items-center justify-between gap-2.5 p-1.5 rounded-lg">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 text-emerald-400 flex items-center justify-center font-bold text-xs shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <h2 class="font-semibold text-xs text-white truncate">{{ Auth::user()->name ?? 'Admin' }}</h2>
                        <span class="text-[10px] text-slate-400 block truncate">
                            {{ (Auth::user()->role ?? '') === 'super_admin' ? 'Super Admin' : 'Admin' }}
                        </span>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" title="Keluar" class="w-7 h-7 rounded-md hover:bg-rose-500/10 text-slate-400 hover:text-rose-400 flex items-center justify-center transition">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Overlay Mobile -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 z-40 hidden lg:hidden backdrop-blur-xs"></div>

    <!-- Main Content -->
    <div class="flex-1 lg:pl-64 flex flex-col min-h-screen">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 text-slate-600 focus:outline-none">
                    <i class="fa-solid fa-bars-staggered text-base"></i>
                </button>
                <div>
                    <h2 class="text-sm sm:text-base font-bold text-slate-900 leading-tight">@yield('header_title', 'Dashboard')</h2>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" target="_blank" class="px-3 py-1.5 text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg border border-slate-200 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-400"></i>
                    <span>Lihat Web</span>
                </a>
            </div>
        </header>

        <!-- Page Body -->
        <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto">
            <!-- Flash Message Success -->
            @if(session('success'))
                <div class="mb-6 p-3.5 rounded-xl bg-emerald-50/80 border border-emerald-200/80 text-emerald-900 text-xs font-medium flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            <!-- Flash Message Error -->
            @if(session('error'))
                <div class="mb-6 p-3.5 rounded-xl bg-rose-50/80 border border-rose-200/80 text-rose-900 text-xs font-medium flex items-center justify-between shadow-xs">
                    <div class="flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 px-8 border-t border-slate-200/80 text-center text-xs text-slate-400 bg-white">
            &copy; {{ date('Y') }} IAI PERSIS PRESS &bull; Sistem Manajemen Penerbitan
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>
