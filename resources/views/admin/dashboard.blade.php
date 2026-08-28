@extends('admin.layouts.app')

@section('title', 'Dashboard Utama | Admin PERSIS PERS')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Header Bar -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-3.5">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xs text-[10px] font-black uppercase font-mono tracking-wider">
                    PANEL ADMINISTRATOR
                </span>
                <span class="text-xs text-slate-400 font-medium hidden sm:inline">• PENERBIT PERSIS</span>
            </div>
            <h1 class="text-base sm:text-xl font-extrabold text-slate-900 font-heading tracking-tight mt-1 leading-tight">
                Ringkasan Penerbitan &amp; Penjualan Buku
            </h1>
            <p class="text-[11px] sm:text-xs text-slate-500 mt-0.5">
                Kelola transaksi pesanan masuk, pengiriman resi ekspedisi, dan katalog publikasi ilmiah ber-ISBN.
            </p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="flex-1 sm:flex-none px-3 sm:px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Toko Publik</span>
            </a>
            <a href="{{ route('admin.books.create') }}" class="flex-1 sm:flex-none px-3 sm:px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Buku</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Metrics (2x2 Grid on Mobile, 4 Cols on Desktop) -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2.5 sm:gap-3.5">
        
        <!-- Metric 1: Total Omzet Penjualan -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs flex flex-col sm:flex-row sm:items-center gap-2.5 sm:gap-3.5">
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-sm sm:text-lg shrink-0">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider block truncate">Total Omzet</span>
                <h3 class="text-sm sm:text-lg font-black text-slate-900 font-mono mt-0.5 truncate">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                <p class="text-[9px] sm:text-[10px] text-emerald-700 font-bold mt-0.5 flex items-center gap-1 truncate">
                    <i class="fa-solid fa-circle-check text-[8px]"></i>
                    <span>Lunas QRIS</span>
                </p>
            </div>
        </div>

        <!-- Metric 2: Pesanan Masuk (Actionable) -->
        <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs hover:border-emerald-600 transition flex flex-col sm:flex-row sm:items-center gap-2.5 sm:gap-3.5 group">
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-indigo-50 text-indigo-700 border border-indigo-200 group-hover:bg-[#032c21] group-hover:text-white flex items-center justify-center text-sm sm:text-lg shrink-0 transition">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider block truncate">Transaksi</span>
                <h3 class="text-sm sm:text-lg font-black text-slate-900 font-mono mt-0.5 group-hover:text-emerald-800 transition truncate">{{ $totalOrders ?? 0 }} Order</h3>
                <p class="text-[9px] sm:text-[10px] text-amber-700 font-bold mt-0.5 flex items-center gap-1 truncate">
                    <i class="fa-solid fa-box text-[8px]"></i>
                    <span>Packing: {{ $countProcessing ?? 0 }}</span>
                </p>
            </div>
        </a>

        <!-- Metric 3: Katalog Terbitan -->
        <a href="{{ route('admin.books.index') }}" class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs hover:border-emerald-600 transition flex flex-col sm:flex-row sm:items-center gap-2.5 sm:gap-3.5 group">
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 group-hover:bg-emerald-700 group-hover:text-white flex items-center justify-center text-sm sm:text-lg shrink-0 transition">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider block truncate">Katalog Buku</span>
                <h3 class="text-sm sm:text-lg font-black text-slate-900 font-mono mt-0.5 group-hover:text-emerald-800 transition truncate">{{ $totalBooks ?? 0 }} Judul</h3>
                <p class="text-[9px] sm:text-[10px] text-slate-500 font-semibold mt-0.5 truncate">Monograf &amp; ISBN</p>
            </div>
        </a>

        <!-- Metric 4: Pengguna / Member -->
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-sm border border-slate-200/90 p-3 sm:p-4 shadow-2xs hover:border-amber-500 transition flex flex-col sm:flex-row sm:items-center gap-2.5 sm:gap-3.5 group">
            <div class="w-8 h-8 sm:w-11 sm:h-11 rounded-sm bg-amber-50 text-amber-700 border border-amber-200 group-hover:bg-amber-600 group-hover:text-white flex items-center justify-center text-sm sm:text-lg shrink-0 transition">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="min-w-0 flex-1">
                <span class="text-[9.5px] sm:text-[10.5px] font-bold text-slate-400 uppercase tracking-wider block truncate">Pengguna</span>
                <h3 class="text-sm sm:text-lg font-black text-slate-900 font-mono mt-0.5 group-hover:text-amber-800 transition truncate">{{ $totalUsers ?? 0 }} Akun</h3>
                <p class="text-[9px] sm:text-[10px] text-slate-500 font-semibold mt-0.5 truncate">Admin &amp; Member</p>
            </div>
        </a>

    </div>

    <!-- Main Content: 8 cols (Orders & Submissions) & 4 cols (Quick Actions) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 sm:gap-5">
        
        <!-- Left Column (8 Cols) -->
        <div class="lg:col-span-8 space-y-4 sm:space-y-5">
            
            <!-- Recent Orders Card -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="p-3.5 sm:p-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                    <div>
                        <h2 class="font-extrabold text-xs sm:text-sm text-slate-900 font-heading">Transaksi Pesanan Terbaru</h2>
                        <p class="text-[10.5px] sm:text-[11px] text-slate-400 mt-0.5">Daftar transaksi masuk via gateway QRIS otomatis</p>
                    </div>
                    
                    <!-- Status Filter Tabs -->
                    <div class="flex items-center gap-1 overflow-x-auto text-[11px] font-bold pb-1 sm:pb-0">
                        <a href="{{ route('admin.orders.index') }}" class="px-2.5 py-1 rounded-sm bg-slate-100 hover:bg-slate-200 text-slate-700 transition whitespace-nowrap">
                            Semua ({{ $totalOrders }})
                        </a>
                        @if(($countProcessing ?? 0) > 0)
                            <a href="{{ route('admin.orders.index') }}" class="px-2.5 py-1 rounded-sm bg-amber-100 text-amber-900 border border-amber-300 transition whitespace-nowrap">
                                Packing ({{ $countProcessing }})
                            </a>
                        @endif
                        <a href="{{ route('admin.orders.index') }}" class="px-2.5 py-1 rounded-sm bg-emerald-50 text-emerald-800 border border-emerald-200 transition whitespace-nowrap">
                            Kelola &rarr;
                        </a>
                    </div>
                </div>

                <!-- 1. MOBILE NATIVE CARD STREAM (Visible on mobile screens) -->
                <div class="block sm:hidden divide-y divide-slate-100">
                    @forelse($recentOrders ?? [] as $ord)
                        <div class="p-3 space-y-2 hover:bg-slate-50/70 transition">
                            <div class="flex items-center justify-between gap-2">
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="font-bold text-emerald-800 font-mono text-xs hover:underline">
                                    #{{ $ord->order_number }}
                                </a>
                                @if($ord->payment_status === 'completed')
                                    <span class="px-2 py-0.2 rounded-xs text-[9.5px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase">
                                        ✓ Lunas
                                    </span>
                                @elseif($ord->payment_status === 'pending')
                                    <span class="px-2 py-0.2 rounded-xs text-[9.5px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="px-2 py-0.2 rounded-xs text-[9.5px] font-bold bg-red-50 text-red-700 uppercase">
                                        {{ $ord->payment_status }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between text-xs">
                                <div class="min-w-0 flex-1">
                                    <p class="font-bold text-slate-900 truncate">{{ $ord->customer_name }}</p>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ord->customer_phone) }}" target="_blank" class="text-[10.5px] text-emerald-700 hover:underline flex items-center gap-1 font-mono">
                                        <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                        <span>{{ $ord->customer_phone }}</span>
                                    </a>
                                </div>
                                <div class="text-right pl-2">
                                    <span class="font-mono font-black text-slate-900 text-xs block">{{ $ord->formatted_payment }}</span>
                                    <span class="text-[9.5px] text-slate-400">{{ $ord->created_at->format('d/m H:i') }}</span>
                                </div>
                            </div>

                            <div class="pt-1.5 flex items-center justify-between gap-2 border-t border-slate-100/80">
                                <div>
                                    @if($ord->shipping_status === 'selesai')
                                        <span class="px-2 py-0.5 rounded-xs text-[9px] font-bold bg-emerald-100 text-emerald-800 uppercase">
                                            Diterima
                                        </span>
                                    @elseif($ord->shipping_status === 'dikirim')
                                        <span class="px-2 py-0.5 rounded-xs text-[9px] font-bold bg-blue-100 text-blue-800 uppercase">
                                            Dikirim
                                        </span>
                                    @elseif($ord->shipping_status === 'diproses' || $ord->shipping_status === 'menunggu_proses')
                                        <span class="px-2 py-0.5 rounded-xs text-[9px] font-bold bg-amber-100 text-amber-900 uppercase">
                                            Perlu Dikemas
                                        </span>
                                    @else
                                        <span class="px-2 py-0.5 rounded-xs text-[9px] font-bold bg-slate-100 text-slate-700 uppercase">
                                            {{ $ord->shipping_status }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="px-3 py-1 bg-[#006830] text-white rounded-xs text-[11px] font-bold shadow-2xs flex items-center gap-1">
                                    <span>Kelola Resi</span>
                                    <i class="fa-solid fa-angle-right text-[9px]"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">
                            <i class="fa-solid fa-receipt text-xl mb-1 text-slate-300 block"></i>
                            Belum ada transaksi pesanan masuk.
                        </div>
                    @endforelse
                </div>

                <!-- 2. DESKTOP WIDE TABLE (Visible on tablets & desktop) -->
                <div class="hidden sm:block overflow-x-auto w-full">
                    <table class="w-full text-left text-xs text-slate-700">
                        <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200 text-[10px]">
                            <tr>
                                <th class="py-2.5 px-4">Invoice &amp; Tanggal</th>
                                <th class="py-2.5 px-4">Pembeli</th>
                                <th class="py-2.5 px-4 text-right">Total</th>
                                <th class="py-2.5 px-4 text-center">Pembayaran</th>
                                <th class="py-2.5 px-4 text-center">Pengiriman</th>
                                <th class="py-2.5 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            @forelse($recentOrders ?? [] as $ord)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3 px-4 whitespace-nowrap">
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="font-bold text-emerald-800 hover:underline font-mono block">
                                            #{{ $ord->order_number }}
                                        </a>
                                        <span class="text-[10px] text-slate-400 block mt-0.5">{{ $ord->created_at->format('d M Y, H:i') }}</span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <p class="font-bold text-slate-900 truncate max-w-[140px]">{{ $ord->customer_name }}</p>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ord->customer_phone) }}" target="_blank" class="text-[10.5px] text-emerald-700 hover:underline flex items-center gap-1 font-mono">
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
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-100 text-emerald-800 uppercase border border-emerald-300">
                                                Diterima
                                            </span>
                                        @elseif($ord->shipping_status === 'dikirim')
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-blue-100 text-blue-800 uppercase border border-blue-300">
                                                Dikirim
                                            </span>
                                        @elseif($ord->shipping_status === 'diproses' || $ord->shipping_status === 'menunggu_proses')
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-amber-100 text-amber-900 uppercase border border-amber-300">
                                                Perlu Dikemas
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-slate-200 text-slate-700">
                                                {{ $ord->shipping_status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-center whitespace-nowrap">
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-[#006830] text-slate-700 hover:text-white rounded-xs text-xs font-bold transition inline-flex items-center gap-1 shadow-2xs">
                                            <span>Kelola</span>
                                            <i class="fa-solid fa-angle-right text-[9px]"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400">
                                        <i class="fa-solid fa-receipt text-2xl mb-1 text-slate-300 block"></i>
                                        Belum ada transaksi pesanan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Manuscript Submissions & Messages -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden">
                <div class="p-3.5 sm:p-4 border-b border-slate-200 flex items-center justify-between">
                    <div>
                        <h2 class="font-extrabold text-xs sm:text-sm text-slate-900 font-heading">Permohonan Naskah &amp; Pesan Redaksi</h2>
                        <p class="text-[10.5px] sm:text-[11px] text-slate-400 mt-0.5">Pengajuan penerbitan buku dari dosen, peneliti, dan civitas</p>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 flex items-center gap-1">
                        <span>Buka Inbox</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($recentMessages ?? [] as $msg)
                        <div class="p-3 sm:p-3.5 hover:bg-slate-50/70 transition flex items-start justify-between gap-3 text-xs">
                            <div class="min-w-0 space-y-0.5">
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold text-slate-900 truncate">{{ $msg->name }}</h4>
                                    @if($msg->status === 'pending')
                                        <span class="px-1.5 py-0.2 bg-amber-100 text-amber-800 text-[9px] font-bold rounded-xs uppercase font-mono">Baru</span>
                                    @endif
                                </div>
                                <p class="text-slate-600 line-clamp-1 font-medium">{{ $msg->subject ?? $msg->message }}</p>
                                <p class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }} • {{ $msg->email }}</p>
                            </div>
                            <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition shrink-0">
                                Review
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">
                            <i class="fa-solid fa-inbox text-2xl mb-1 text-slate-300 block"></i>
                            Belum ada pesan naskah masuk.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right Column (4 Cols) -->
        <div class="lg:col-span-4 space-y-4 sm:space-y-5">
            
            <!-- Quick Management Card -->
            <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-4 space-y-3">
                <h3 class="font-extrabold text-xs text-slate-900 font-heading uppercase tracking-wider">Akses Cepat Pengelolaan</h3>
                
                <div class="grid grid-cols-1 gap-1.5 pt-0.5">
                    <a href="{{ route('admin.orders.index') }}" class="p-2.5 rounded-sm border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-sm bg-indigo-50 text-indigo-700 group-hover:bg-[#032c21] group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-receipt"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Kelola Pesanan &amp; Resi</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-emerald-700"></i>
                    </a>

                    <a href="{{ route('admin.books.index') }}" class="p-2.5 rounded-sm border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-sm bg-emerald-50 text-emerald-700 group-hover:bg-emerald-700 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-book-bookmark"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Katalog Buku &amp; ISBN</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-emerald-700"></i>
                    </a>

                    <a href="{{ route('admin.messages.index') }}" class="p-2.5 rounded-sm border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-sm bg-amber-50 text-amber-700 group-hover:bg-amber-700 group-hover:text-white flex items-center justify-center text-xs transition">
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

                    <a href="{{ route('admin.users.index') }}" class="p-2.5 rounded-sm border border-slate-200 hover:border-emerald-600 hover:bg-emerald-50/50 flex items-center justify-between group transition">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-sm bg-slate-100 text-slate-700 group-hover:bg-slate-800 group-hover:text-white flex items-center justify-center text-xs transition">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                            <span class="text-xs font-bold text-slate-800">Manajemen Pengguna</span>
                        </div>
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-slate-800"></i>
                    </a>
                </div>
            </div>

            <!-- Public Portal Card -->
            <div class="p-4 bg-[#032c21] rounded-sm text-white space-y-2.5 shadow-2xs border border-white/10">
                <span class="text-[9.5px] font-mono text-emerald-300 font-bold uppercase tracking-wider block">Portal Publik Penerbit</span>
                <h4 class="font-extrabold text-xs text-white font-heading">Etalase Publik PERSIS PERS</h4>
                <p class="text-[11px] text-emerald-100/70 leading-relaxed">
                    Kunjungi etalase resmi untuk mengecek katalog buku dan tampilan pembelian bagi civitas umum.
                </p>
                <div class="pt-1">
                    <a href="{{ route('katalog') }}" target="_blank" class="w-full py-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 rounded-sm text-xs font-black transition flex items-center justify-center gap-1.5 shadow-2xs">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>Kunjungi Katalog Publik</span>
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
