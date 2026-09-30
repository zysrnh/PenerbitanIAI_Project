@extends('layouts.app')

@section('title', 'Koleksi Buku Digital Saya - Portal Member')

@section('content')
<div class="min-h-screen bg-slate-100/90 text-slate-800 flex flex-col antialiased select-none font-sans">
    
    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-xs z-40 hidden transition-opacity lg:hidden"></div>

    <!-- ==================== SIDEBAR MEMBER (COLLAPSIBLE W-64) ==================== -->
    <aside id="member-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#032c21] text-slate-300 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 border-r border-white/10 shadow-2xl overflow-y-auto select-none transition-transform duration-300 ease-in-out">
        <div class="p-5">
            <!-- Brand Header -->
            <div class="pb-4 mb-4 border-b border-white/10 flex items-center justify-between">
                <a href="{{ route('member.dashboard') }}" class="inline-flex items-center gap-2.5 transition hover:opacity-90" title="PENERBIT PERSIS">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_emblem.png') }}" alt="Logo" class="w-8 h-8 object-contain drop-shadow-sm" />
                    <div>
                        <span class="font-black text-xs text-white tracking-tight block font-heading leading-tight">PENERBIT PERSIS</span>
                        <span class="text-[9.5px] text-emerald-300 font-bold block font-mono leading-none tracking-wider uppercase">PORTAL MEMBER</span>
                    </div>
                </a>
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-white rounded-sm hover:bg-white/10 transition" title="Tutup Menu">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
            </div>

            <!-- User Member Profile Box -->
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
                                <i class="fa-solid fa-cart-shopping w-4 text-center"></i>
                                <span>Keranjang Saya</span>
                            </div>
                            <span id="sidebarCartBadge" class="hidden px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500 text-[#032c21] font-mono">0</span>
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

                        <!-- Buku Digital Saya (Active) -->
                        <a href="{{ route('member.digital_books') }}" class="flex items-center justify-between px-3 py-2.5 rounded-sm font-bold transition bg-emerald-600/20 text-emerald-400 border border-emerald-500/30">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-book-open-reader w-4 text-center"></i>
                                <span>Buku Digital</span>
                            </div>
                            @if($totalBookmarks > 0)
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

                        <a href="javascript:void(0)" onclick="openAdminContactDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-sm font-semibold transition hover:bg-white/10 hover:text-white text-slate-300">
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
                    <span class="font-bold text-slate-800">Buku Digital Saya</span>
                </div>
            </div>

            <!-- Right Header Actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('katalog.digital') }}" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-sm bg-[#006830] hover:bg-[#032c21] text-white text-xs font-bold transition shadow-2xs">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    <span>Jelajahi Katalog Digital</span>
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
            
            <!-- Page Header Banner -->
            <div class="bg-[#032c21] text-white p-5 sm:p-6 rounded-sm border border-[#064e3b] shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
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

            @if(session('success'))
                <div class="p-3.5 bg-emerald-50 border border-emerald-200 rounded-sm text-xs font-bold text-emerald-900 flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            <!-- Filter & Search Toolbar -->
            <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
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
                    <button type="submit" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-xs text-xs font-bold transition">
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

            <!-- Bookmarked Books Grid -->
            @if($digitalBooks->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($digitalBooks as $book)
                        @php
                            $coverUrl = $book->cover_url;
                            $pdfUrl = $book->pdf_url;
                            $bookPayload = [
                                'id' => $book->id,
                                'title' => $book->title,
                                'author' => $book->author,
                                'category' => $book->category,
                                'year' => $book->year,
                                'pages' => $book->pages,
                                'synopsis' => $book->synopsis,
                                'cover_url' => $coverUrl,
                                'pdf_url' => $pdfUrl,
                                'pdf_file' => $book->pdf_file,
                            ];
                            $encodedBook = base64_encode(json_encode($bookPayload));
                        @endphp
                        <div class="persis-book-card bg-white p-4 rounded-sm border border-slate-200 shadow-2xs hover:shadow-md transition flex flex-col justify-between">
                            
                            <!-- Top Details & 3D Cover -->
                            <div>
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 truncate">
                                        {{ $book->category }}
                                    </span>
                                    
                                    <!-- Remove Bookmark Button -->
                                    <form method="POST" action="{{ route('member.digital_books.remove', $book->id) }}" onsubmit="return confirm('Hapus buku {{ $book->title }} dari koleksi Anda?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 px-1.5 rounded-xs bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-[10px] font-bold transition cursor-pointer" title="Hapus dari koleksi">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- 3D Perspective Stage -->
                                <div class="book-cover-stage-3d w-32 aspect-[3/4.2] mx-auto py-2 cursor-pointer" data-book="{{ $encodedBook }}" onclick="openFlipbookFromEncoded(this.getAttribute('data-book'))" title="Klik untuk Buka Buku (Flipbook)">
                                    <div class="book-cover-3d relative w-full h-full rounded-xs overflow-hidden bg-slate-900 border border-slate-300 shadow-sm">
                                        <div class="book-spine-strip"></div>
                                        <div class="book-paper-edge"></div>

                                        @if($coverUrl)
                                            <img src="{{ $coverUrl }}" alt="{{ $book->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                                        @endif

                                        <div class="w-full h-full bg-[#032c21] p-3 pl-4 flex flex-col justify-between text-white text-[8px]" style="{{ $coverUrl ? 'display:none;' : '' }}">
                                            <div class="flex justify-between items-center border-b border-white/20 pb-1">
                                                <span class="text-emerald-300 font-bold truncate">PERSIS PERS</span>
                                                <span class="text-slate-300 font-mono text-[7px]">{{ $book->year }}</span>
                                            </div>
                                            <div class="my-auto text-center py-1">
                                                <span class="font-black text-[9px] leading-tight line-clamp-3">{{ $book->title }}</span>
                                            </div>
                                            <div class="border-t border-white/20 pt-1 text-center">
                                                <span class="text-slate-300 truncate text-[7px] block">{{ $book->author }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book Info -->
                                <div class="mt-3 space-y-1 text-left">
                                    <h3 class="text-xs sm:text-[13px] font-extrabold text-slate-900 line-clamp-2 leading-snug hover:text-emerald-800 transition cursor-pointer" data-book="{{ $encodedBook }}" onclick="openFlipbookFromEncoded(this.getAttribute('data-book'))">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-[11px] text-slate-500 truncate flex items-center gap-1.5">
                                        <i class="fa-solid fa-pen-nib text-[9px] text-emerald-600"></i>
                                        <span>{{ $book->author }}</span>
                                    </p>
                                    <div class="flex items-center justify-between text-[10.5px] text-slate-400 font-mono pt-1 border-t border-slate-100 mt-2">
                                        <span>{{ $book->pages ?: '240 hlm' }}</span>
                                        <span>{{ $book->year }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons: Buka Baca & Download/Dukung -->
                            <div class="pt-3 border-t border-slate-100 mt-3 grid grid-cols-2 gap-2">
                                <button type="button" 
                                        data-book="{{ $encodedBook }}"
                                        onclick="openFlipbookFromEncoded(this.getAttribute('data-book'))" 
                                        class="w-full py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer"
                                        title="Buka &amp; Baca Flipbook">
                                    <i class="fa-solid fa-book-open-reader text-xs"></i>
                                    <span>Baca Buku</span>
                                </button>
                                <button type="button" 
                                        data-book="{{ $encodedBook }}"
                                        onclick="openDownloadFromEncoded(this.getAttribute('data-book'))" 
                                        class="w-full py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-900 border border-emerald-300 rounded-xs text-[11px] font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer"
                                        title="Download Buku &amp; Dukung">
                                    <i class="fa-solid fa-download text-xs text-emerald-700"></i>
                                    <span>Download</span>
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($digitalBooks->hasPages())
                    <div class="p-4 bg-white rounded-sm border border-slate-200 flex items-center justify-end shadow-2xs">
                        {{ $digitalBooks->links() }}
                    </div>
                @endif

            @else
                <!-- Empty State: Belum Ada Buku Tersimpan -->
                <div class="bg-white rounded-sm border border-slate-200 p-12 text-center text-slate-400 space-y-4 shadow-2xs max-w-xl mx-auto my-8">
                    <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-2xl mx-auto shadow-2xs">
                        <i class="fa-solid fa-book-bookmark"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-base font-extrabold text-slate-800 font-heading">
                            Belum Ada Buku Digital yang Ditandai
                        </h3>
                        <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                            Buka halaman <strong>Katalog Digital</strong> dan klik tombol <strong>"Simpan / Bookmark"</strong> pada buku yang ingin Anda baca di portal member ini.
                        </p>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('katalog.digital') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition shadow-xs">
                            <i class="fa-solid fa-compass text-xs"></i>
                            <span>Jelajahi Katalog Buku Digital Sekarang</span>
                        </a>
                    </div>
                </div>
            @endif

        </main>
    </div>

    <!-- ==================== MOBILE APP BOTTOM NAVIGATION BAR ==================== -->
    <nav class="lg:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] px-2 py-1.5 flex items-center justify-around select-none">
        
        <!-- 1. Dashboard -->
        <a href="{{ route('member.dashboard') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-slate-800 font-medium">
            <div class="relative">
                <i class="fa-solid fa-gauge-high text-base"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Dashboard</span>
        </a>

        <!-- 2. Pesanan Saya (with Live Badge) -->
        <a href="{{ route('member.orders') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-slate-800 font-medium">
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
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Pesanan</span>
        </a>

        <!-- 3. Buku Digital (Active) -->
        <a href="{{ route('member.digital_books') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-emerald-700 font-bold">
            <div class="relative">
                <i class="fa-solid fa-book-open-reader text-base"></i>
                <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-emerald-600 rounded-full"></span>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Buku Digital</span>
        </a>

        <!-- 4. WhatsApp Redaksi -->
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactWa ?? '6282116116133') }}?text={{ urlencode('Assalamualaikum Redaksi Penerbit Persis, saya member ' . $user->name . ' ingin berkonsultasi.') }}" target="_blank" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-emerald-700 font-medium">
            <div class="relative">
                <i class="fa-brands fa-whatsapp text-base text-emerald-600"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Redaksi</span>
        </a>

        <!-- 5. Profil Akun -->
        <a href="{{ route('member.profile') }}" class="flex-1 flex flex-col items-center justify-center py-1 text-center transition text-slate-500 hover:text-slate-800 font-medium">
            <div class="relative">
                <i class="fa-solid fa-user text-base"></i>
            </div>
            <span class="text-[10px] mt-0.5 tracking-tight">Profil</span>
        </a>
    </nav>

</div>

<!-- ==================== FLIPBOOK VIEWER MODAL INTEGRATION ==================== -->
<div id="flipbookViewerModal" class="fixed inset-0 z-[1100] hidden items-center justify-center p-2 sm:p-4 bg-slate-950/90 backdrop-blur-md select-none overflow-hidden" style="display: none;">
    <div class="relative w-full max-w-5xl h-[90vh] bg-slate-900 rounded-sm border border-slate-700 flex flex-col overflow-hidden shadow-2xl">
        <!-- Top Toolbar -->
        <div class="p-3 bg-slate-950 border-b border-slate-800 flex items-center justify-between text-white text-xs">
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
                <p class="text-xs">Pratinjau flipbook hanya tersedia untuk buku yang memiliki file PDF lengkap.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('member-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        if (sidebar && overlay) {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }

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
</script>
@endsection
