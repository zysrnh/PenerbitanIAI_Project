@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan & Transaksi Buku | Admin PERSIS PERS')
@section('header_title', 'Pesanan & Transaksi Buku')

@section('content')
<div class="space-y-4 sm:space-y-5">

    <!-- Top Card Header -->
    <div class="bg-white rounded-sm border border-slate-200/90 p-4 sm:p-5 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-sm bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div>
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="text-sm sm:text-lg font-extrabold text-slate-900 font-heading leading-tight">
                        Manajemen Pesanan &amp; Transaksi Buku
                    </h1>
                    <span class="px-2 py-0.5 rounded-xs text-[10px] font-bold bg-emerald-50 text-emerald-800 border border-emerald-200 font-mono">
                        {{ $totalOrders }} Total Transaksi
                    </span>
                </div>
                <p class="text-xs text-slate-500 mt-0.5">Kelola konfirmasi pembayaran QRIS, update resi ekspedisi, dan cetak invoice pemesan.</p>
            </div>
        </div>

        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('katalog') }}" target="_blank" class="px-3.5 py-2 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-700"></i>
                <span>Toko Publik</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Stat Cards (Sharp Enterprise Style) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
        
        <!-- Total Pendapatan -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5 truncate">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                <p class="text-[10px] text-emerald-700 font-bold mt-0.5">Dari transaksi lunas</p>
            </div>
        </div>

        <!-- Pesanan Lunas -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Pesanan Lunas</p>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalCompleted }} Order</h4>
                <p class="text-[10px] text-slate-500 font-semibold mt-0.5">Selesai terbayar</p>
            </div>
        </div>

        <!-- Menunggu Bayar -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-sm bg-amber-50 text-amber-700 border border-amber-200 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Menunggu Bayar</p>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalPending }} Order</h4>
                <p class="text-[10px] text-amber-700 font-semibold mt-0.5">Belum diselesaikan</p>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="bg-white rounded-sm border border-slate-200/90 p-4 shadow-2xs flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-sm bg-indigo-50 text-indigo-700 border border-indigo-200 flex items-center justify-center text-base shrink-0">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider">Total Semua Order</p>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalOrders }} Order</h4>
                <p class="text-[10px] text-slate-500 font-semibold mt-0.5">Database transaksi</p>
            </div>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs p-3.5 flex flex-col sm:flex-row items-center justify-between gap-3">
        
        <!-- Status Tabs -->
        <div class="flex items-center gap-1.5 w-full sm:w-auto overflow-x-auto select-none">
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 rounded-sm text-xs font-bold transition whitespace-nowrap {{ !$status ? 'bg-[#006830] text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua ({{ $totalOrders }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-3 py-1.5 rounded-sm text-xs font-bold transition whitespace-nowrap {{ $status === 'completed' ? 'bg-[#006830] text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Lunas ({{ $totalCompleted }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-sm text-xs font-bold transition whitespace-nowrap {{ $status === 'pending' ? 'bg-amber-600 text-white shadow-2xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Menunggu ({{ $totalPending }})
            </a>
        </div>

        <!-- Search Input -->
        <form method="GET" action="{{ route('admin.orders.index') }}" class="w-full sm:w-72 relative">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari invoice / nama / HP..." class="w-full pl-8 pr-3 py-2 bg-slate-50 border border-slate-300 rounded-sm text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 transition" />
        </form>
    </div>

    <!-- Orders Table Card -->
    <div class="bg-white rounded-sm border border-slate-200/90 shadow-2xs overflow-hidden w-full">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200 text-[10px]">
                    <tr>
                        <th class="py-3 px-4">No. Invoice &amp; Waktu</th>
                        <th class="py-3 px-4">Nama Pemesan</th>
                        <th class="py-3 px-4">Buku Dipesan</th>
                        <th class="py-3 px-4 text-right">Total Tagihan</th>
                        <th class="py-3 px-4 text-center">Status Bayar</th>
                        <th class="py-3 px-4 text-center">Pengiriman</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($orders as $ord)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="font-bold text-emerald-800 hover:underline font-mono block">
                                    #{{ $ord->order_number }}
                                </a>
                                <span class="text-[10px] text-slate-400 block mt-0.5">{{ $ord->created_at->format('d/m/Y H:i') }} WIB</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-slate-900">{{ $ord->customer_name }}</p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ord->customer_phone) }}" target="_blank" class="text-[10.5px] text-emerald-700 hover:underline flex items-center gap-1 mt-0.5 font-mono">
                                    <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                    <span>{{ $ord->customer_phone }}</span>
                                </a>
                            </td>
                            <td class="py-3.5 px-4 max-w-xs">
                                @if(!empty($ord->items_json))
                                    @foreach($ord->items_json as $it)
                                        <p class="truncate leading-tight text-xs text-slate-800">• {{ $it['title'] ?? 'Buku' }} <span class="text-slate-500 font-mono">({{ $it['quantity'] ?? 1 }}x)</span></p>
                                    @endforeach
                                @else
                                    <span class="text-slate-400 italic">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <span class="font-bold text-slate-900 font-mono">{{ $ord->formatted_payment }}</span>
                                <span class="text-[9.5px] text-slate-400 block uppercase font-mono">{{ $ord->payment_method }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
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
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($ord->shipping_status === 'selesai')
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-emerald-100 text-emerald-800 uppercase border border-emerald-300">
                                        Diterima
                                    </span>
                                @elseif($ord->shipping_status === 'dikirim')
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-blue-100 text-blue-800 uppercase border border-blue-300">
                                        Dikirim
                                    </span>
                                    @if($ord->tracking_number)
                                        <span class="text-[9.5px] text-slate-500 font-mono block mt-0.5">{{ $ord->tracking_number }}</span>
                                    @endif
                                @elseif($ord->shipping_status === 'diproses' || $ord->shipping_status === 'menunggu_proses')
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-amber-100 text-amber-900 uppercase border border-amber-300">
                                        Perlu Dikemas
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-xs text-[9.5px] font-bold bg-slate-200 text-slate-700 uppercase">
                                        {{ $ord->shipping_status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1">
                                    <a href="{{ route('admin.orders.shipping_label', $ord->id) }}" target="_blank" class="p-1 bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 rounded-xs text-xs transition" title="Cetak Label Resi">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.show', $ord->id) }}" class="px-2.5 py-1 bg-slate-100 hover:bg-[#006830] text-slate-700 hover:text-white rounded-xs text-xs font-bold transition inline-flex items-center gap-1 shadow-2xs">
                                        <span>Kelola</span>
                                        <i class="fa-solid fa-angle-right text-[9px]"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-12 text-center text-slate-400">
                                <div class="w-12 h-12 rounded-sm bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center mx-auto text-xl mb-2">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 font-heading">Tidak Ada Pesanan Ditemukan</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Belum ada transaksi pesanan yang sesuai filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-3 border-t border-slate-200">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
