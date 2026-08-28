@extends('admin.layouts.app')

@section('title', 'Dashboard Utama | Admin PERSIS PERS')

@section('content')
<div class="space-y-6">

    <!-- 1. Administrator Header Hero Card -->
    <div class="bg-gradient-to-r from-[#032c21] via-[#064e3b] to-[#043d2f] text-white p-5 sm:p-6 rounded-xl shadow-xs relative overflow-hidden">
        <!-- Geometric Glow Accents -->
        <div class="absolute -right-8 -top-8 w-44 h-44 bg-emerald-400/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute right-20 bottom-0 w-36 h-36 bg-amber-400/5 rounded-full blur-xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div class="flex items-center gap-4">
                @if(Auth::user()->avatar_url)
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl object-cover ring-2 ring-emerald-400/40 shadow-xs shrink-0" />
                @else
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-gradient-to-tr from-emerald-600 to-emerald-400 flex items-center justify-center text-white font-black text-xl sm:text-2xl shrink-0 shadow-xs ring-2 ring-emerald-400/30">
                        {{ Auth::user()->initials }}
                    </div>
                @endif
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-2.5 py-0.5 bg-emerald-400/20 text-emerald-300 border border-emerald-400/30 rounded-full text-[10px] font-extrabold uppercase tracking-wider">
                            <i class="fa-solid fa-shield-halved text-emerald-400"></i> Admin Panel
                        </span>
                        <span class="text-xs text-emerald-100/70 font-mono">IAI PERSIS Bandung</span>
                    </div>
                    <h1 class="text-lg sm:text-2xl font-black font-heading tracking-tight text-white leading-tight">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h1>
                    <p class="text-xs text-emerald-200/80">Pantau transaksi penjualan buku ber-ISBN, resi pengiriman, dan permohonan naskah dosen.</p>
                </div>
            </div>

            <!-- Quick Hero Action Buttons -->
            <div class="flex items-center gap-2.5 flex-wrap pt-3 lg:pt-0 border-t lg:border-t-0 border-white/10">
                <a href="{{ route('admin.books.create') }}" class="px-4 py-2.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 rounded-xl text-xs font-black transition flex items-center gap-2 shadow-xs cursor-pointer">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Tambah Buku</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="px-3.5 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-2 border border-white/15">
                    <i class="fa-solid fa-receipt text-xs text-emerald-300"></i>
                    <span>Pesanan Masuk</span>
                </a>
                <a href="{{ route('katalog') }}" target="_blank" class="px-3.5 py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 border border-white/15">
                    <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                    <span class="hidden sm:inline">Web Publik</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Core 4 Key Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Metric 1: Total Pendapatan Penjualan -->
        <div class="bg-white rounded-xl border border-slate-200/90 p-4.5 shadow-2xs flex items-center gap-4 transition hover:border-slate-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-money-bill-trend-up"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pendapatan Buku</span>
                <h4 class="text-lg sm:text-xl font-black text-slate-900 font-mono mt-0.5 truncate">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h4>
                <p class="text-[10.5px] text-emerald-700 font-semibold mt-0.5 flex items-center gap-1">
                    <i class="fa-solid fa-circle-check text-[9px]"></i>
                    <span>Lunas QRIS Otomatis</span>
                </p>
            </div>
        </div>

        <!-- Metric 2: Total Pesanan Masuk -->
        <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-xl border border-slate-200/90 p-4.5 shadow-2xs hover:border-emerald-600 transition flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-700 border border-indigo-100 group-hover:bg-[#032c21] group-hover:text-white flex items-center justify-center text-xl shrink-0 transition">
                <i class="fa-solid fa-box-archive"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Pesanan</span>
                <h4 class="text-lg sm:text-xl font-black text-slate-900 font-mono mt-0.5 group-hover:text-emerald-800 transition">{{ $totalOrders ?? 0 }} Order</h4>
                <p class="text-[10.5px] text-indigo-700 font-semibold mt-0.5 flex items-center gap-1">
                    <span>Perlu Dipacking: <strong>{{ $countProcessing ?? 0 }}</strong></span>
                    <i class="fa-solid fa-arrow-right text-[9px]"></i>
                </p>
            </div>
        </a>

        <!-- Metric 3: Katalog Terbitan -->
        <a href="{{ route('admin.books.index') }}" class="bg-white rounded-xl border border-slate-200/90 p-4.5 shadow-2xs hover:border-emerald-600 transition flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-100 group-hover:bg-emerald-700 group-hover:text-white flex items-center justify-center text-xl shrink-0 transition">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Katalog Terbitan</span>
                <h4 class="text-lg sm:text-xl font-black text-slate-900 font-mono mt-0.5 group-hover:text-emerald-800 transition">{{ $totalBooks ?? 0 }} Judul</h4>
                <p class="text-[10.5px] text-emerald-700 font-semibold mt-0.5">Monograf, Modul &amp; ISBN</p>
            </div>
        </a>

        <!-- Metric 4: Total Pengguna / Member -->
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl border border-slate-200/90 p-4.5 shadow-2xs hover:border-amber-500 transition flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 border border-amber-100 group-hover:bg-amber-600 group-hover:text-white flex items-center justify-center text-xl shrink-0 transition">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Akun Terdaftar</span>
                <h4 class="text-lg sm:text-xl font-black text-slate-900 font-mono mt-0.5 group-hover:text-amber-800 transition">{{ $totalUsers ?? 0 }} Pengguna</h4>
                <p class="text-[10.5px] text-amber-700 font-semibold mt-0.5">Admin, Dosen &amp; Member</p>
            </div>
        </a>

    </div>

    <!-- 3. Pipeline Pesanan Buku Realtime (Interactive Status Funnel) -->
    <div class="bg-white rounded-xl border border-slate-200/90 p-4 sm:p-5 shadow-2xs space-y-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-truck-ramp-box text-emerald-700 text-sm"></i>
                <h2 class="font-extrabold text-slate-900 text-xs sm:text-sm font-heading">Pipeline Pemrosesan Pesanan</h2>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                <span>Kelola Semua Pesanan</span>
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 text-center select-none pt-1">
            
            <!-- 1. Menunggu Bayar -->
            <a href="{{ route('admin.orders.index') }}" class="p-3 rounded-lg bg-slate-50 hover:bg-amber-50/80 border border-slate-200 hover:border-amber-300 transition group flex flex-col items-center justify-center">
                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <span class="text-xs sm:text-sm font-black font-mono text-slate-900 {{ ($countPending ?? 0) > 0 ? 'text-amber-700' : '' }}">{{ $countPending ?? 0 }}</span>
                <span class="text-[10.5px] sm:text-xs text-slate-500 font-semibold mt-0.5">Menunggu Bayar</span>
            </a>

            <!-- 2. Perlu Dikemas / Resi -->
            <a href="{{ route('admin.orders.index') }}" class="p-3 rounded-lg bg-slate-50 hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-400 transition group flex flex-col items-center justify-center relative overflow-hidden">
                @if(($countProcessing ?? 0) > 0)
                    <span class="absolute top-1 right-1 w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                @endif
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                    <i class="fa-solid fa-box-archive"></i>
                </div>
                <span class="text-xs sm:text-sm font-black font-mono text-slate-900 {{ ($countProcessing ?? 0) > 0 ? 'text-emerald-700' : '' }}">{{ $countProcessing ?? 0 }}</span>
                <span class="text-[10.5px] sm:text-xs text-slate-500 font-semibold mt-0.5">Perlu Dikemas</span>
            </a>

            <!-- 3. Dalam Pengiriman -->
            <a href="{{ route('admin.orders.index') }}" class="p-3 rounded-lg bg-slate-50 hover:bg-blue-50/80 border border-slate-200 hover:border-blue-300 transition group flex flex-col items-center justify-center">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <span class="text-xs sm:text-sm font-black font-mono text-slate-900 {{ ($countShipping ?? 0) > 0 ? 'text-blue-700' : '' }}">{{ $countShipping ?? 0 }}</span>
                <span class="text-[10.5px] sm:text-xs text-slate-500 font-semibold mt-0.5">Sedang Dikirim</span>
            </a>

            <!-- 4. Selesai / Diterima -->
            <a href="{{ route('admin.orders.index') }}" class="p-3 rounded-lg bg-slate-50 hover:bg-emerald-50/80 border border-slate-200 hover:border-emerald-300 transition group flex flex-col items-center justify-center">
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center text-xs mb-1.5 group-hover:scale-110 transition">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <span class="text-xs sm:text-sm font-black font-mono text-slate-900">{{ $countCompleted ?? 0 }}</span>
                <span class="text-[10.5px] sm:text-xs text-slate-500 font-semibold mt-0.5">Selesai / Diterima</span>
            </a>

        </div>
    </div>

    <!-- 4. Main Grid: Recent Orders Table (8 cols) & Quick Actions / Messages (4 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left Column: Recent Orders (8 Cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Recent Orders Card -->
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-sm text-slate-900 font-heading">Transaksi Pesanan Terbaru</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Daftar transaksi buku masuk via QRIS otomatis</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 font-bold uppercase tracking-wider border-b border-slate-200 text-[10px]">
                            <tr>
                                <th class="py-2.5 px-4">Invoice &amp; Waktu</th>
                                <th class="py-2.5 px-4">Pemesan</th>
                                <th class="py-2.5 px-4 text-right">Total Tagihan</th>
                                <th class="py-2.5 px-4 text-center">Status Bayar</th>
                                <th class="py-2.5 px-4 text-center">Pengiriman</th>
                                <th class="py-2.5 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($recentOrders ?? [] as $ord)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="font-bold text-emerald-800 hover:underline font-mono block">
                                            #{{ $ord->order_number }}
                                        </a>
                                        <span class="text-[10px] text-slate-400 block mt-0.5">{{ $ord->created_at->format('d/m/Y H:i') }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <p class="font-bold text-slate-900 truncate max-w-[150px]">{{ $ord->customer_name }}</p>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ord->customer_phone) }}" target="_blank" class="text-[10.5px] text-emerald-700 hover:underline flex items-center gap-1 mt-0.5 font-mono">
                                            <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                            <span>{{ $ord->customer_phone }}</span>
                                        </a>
                                    </td>
                                    <td class="py-3 px-4 text-right whitespace-nowrap">
                                        <span class="font-mono font-bold text-slate-900">{{ $ord->formatted_payment }}</span>
                                    </td>
                                    <td class="py-3 px-4 text-center whitespace-nowrap">
                                        @if($ord->payment_status === 'completed')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase">
                                                <i class="fa-solid fa-check text-[9px]"></i> Lunas
                                            </span>
                                        @elseif($ord->payment_status === 'pending')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase">
                                                <i class="fa-solid fa-clock text-[9px]"></i> Menunggu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-xs text-[10px] font-bold bg-red-50 text-red-700 uppercase">
                                                {{ strtoupper($ord->payment_status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center whitespace-nowrap">
                                        @if($ord->shipping_status === 'selesai')
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-100 text-emerald-800">
                                                Selesai
                                            </span>
                                        @elseif($ord->shipping_status === 'dikirim')
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-blue-100 text-blue-800">
                                                Dikirim
                                            </span>
                                        @elseif($ord->shipping_status === 'diproses' || $ord->shipping_status === 'menunggu_proses')
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-amber-100 text-amber-900">
                                                Perlu Dikemas
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-slate-200 text-slate-700">
                                                {{ $ord->shipping_status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center whitespace-nowrap">
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-[#032c21] text-slate-700 hover:text-white rounded-xs text-xs font-bold transition inline-flex items-center gap-1">
                                            <span>Kelola</span>
                                            <i class="fa-solid fa-angle-right text-[9px]"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400">
                                        <i class="fa-solid fa-receipt text-2xl mb-1.5 text-slate-300 block"></i>
                                        Belum ada transaksi pesanan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Manuscript Submissions & Messages -->
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-sm text-slate-900 font-heading">Permohonan Naskah &amp; Pesan Masuk</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Pengajuan penerbitan buku dari dosen, peneliti, dan civitas</p>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                        <span>Lihat Semua Inbox</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($recentMessages ?? [] as $msg)
                        <div class="p-4 hover:bg-slate-50/70 transition flex items-start justify-between gap-3 text-xs">
                            <div class="min-w-0 space-y-0.5">
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold text-slate-900 truncate">{{ $msg->name }}</h4>
                                    @if($msg->status === 'pending')
                                        <span class="px-1.5 py-0.2 bg-amber-100 text-amber-800 text-[9px] font-bold rounded-xs uppercase">Baru</span>
                                    @endif
                                </div>
                                <p class="text-slate-600 line-clamp-1 font-medium">{{ $msg->subject ?? $msg->message }}</p>
                                <p class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }} • {{ $msg->email }}</p>
                            </div>
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition shrink-0">
                                Detail
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400">
                            <i class="fa-solid fa-inbox text-2xl mb-1.5 text-slate-300 block"></i>
                            Belum ada pesan naskah masuk.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right Column: Quick Shortcuts & Etalase Preview (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Quick Management Card -->
            <div class="bg-white rounded-xl border border-slate-200/90 shadow-2xs p-5 space-y-3">
                <h4 class="font-extrabold text-sm text-slate-900 font-heading">Akses Cepat Pengelolaan</h4>
                
                <div class="grid grid-cols-1 gap-2 pt-1">
                    <a href="{{ route('admin.orders.index') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 group-hover:bg-[#032c21] group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Kelola Pesanan &amp; Resi</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-emerald-700"></i>
                    </a>

                    <a href="{{ route('admin.books.index') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 group-hover:bg-emerald-700 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Katalog Buku &amp; ISBN</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-emerald-700"></i>
                    </a>

                    <a href="{{ route('admin.messages.index') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-700 group-hover:bg-amber-700 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-inbox"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Pengajuan Naskah Terbit</span>
                        </div>
                        @if(($unreadMessagesCount ?? 0) > 0)
                            <span class="px-2 py-0.5 bg-amber-500 text-slate-950 font-black text-[10px] rounded-full font-mono">{{ $unreadMessagesCount }}</span>
                        @else
                            <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-amber-700"></i>
                        @endif
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="p-3 rounded-lg border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 group-hover:bg-slate-800 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Manajemen Pengguna</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-slate-800"></i>
                    </a>
                </div>
            </div>

            <!-- Public Showcase Card -->
            <div class="p-5 bg-gradient-to-br from-[#032c21] to-[#0a1c17] rounded-xl text-white space-y-3 shadow-xs border border-white/10">
                <span class="text-[10px] font-mono text-emerald-300 font-bold uppercase tracking-wider block">Portal Publik Penerbit</span>
                <h4 class="font-extrabold text-sm text-white font-heading">Etalase Publik PERSIS PERS</h4>
                <p class="text-xs text-emerald-100/70 leading-relaxed">
                    Lihat langsung katalog buku dan simulasi transaksi yang tampil kepada pembeli dan civitas umum.
                </p>
                <div class="pt-2">
                    <a href="{{ route('katalog') }}" target="_blank" class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-400 text-slate-950 rounded-lg text-xs font-black transition flex items-center justify-center gap-2 shadow-2xs">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        <span>Kunjungi Katalog Publik</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
