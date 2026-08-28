@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan & Penjualan Buku | PERSIS PERS')

@section('content')
<div class="space-y-6">

    <!-- Page Header & Stats -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-white font-heading tracking-tight flex items-center gap-2.5">
                <i class="fa-solid fa-receipt text-emerald-400 text-lg"></i>
                <span>Kelola Pesanan &amp; Transaksi Buku</span>
            </h1>
            <p class="text-xs text-slate-400 mt-1">Daftar transaksi QRIS otomatis &amp; pesanan buku penerbitan</p>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-4.5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                <h4 class="text-lg font-black text-white font-mono mt-0.5">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                <p class="text-[10px] text-emerald-400 mt-0.5">Dari transaksi lunas</p>
            </div>
        </div>

        <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-4.5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pesanan Lunas</p>
                <h4 class="text-lg font-black text-white font-mono mt-0.5">{{ $totalCompleted }} Pesanan</h4>
                <p class="text-[10px] text-slate-400 mt-0.5">Selesai terbayar</p>
            </div>
        </div>

        <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-4.5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Menunggu Bayar</p>
                <h4 class="text-lg font-black text-white font-mono mt-0.5">{{ $totalPending }} Pesanan</h4>
                <p class="text-[10px] text-amber-400 mt-0.5">Belum diselesaikan</p>
            </div>
        </div>

        <div class="bg-slate-900/90 border border-slate-800 rounded-2xl p-4.5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Semua Order</p>
                <h4 class="text-lg font-black text-white font-mono mt-0.5">{{ $totalOrders }} Pesanan</h4>
                <p class="text-[10px] text-slate-400 mt-0.5">Keseluruhan database</p>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-slate-900/80 border border-slate-800 rounded-2xl p-4 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-2 w-full sm:w-auto overflow-x-auto pb-1 sm:pb-0">
            <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition whitespace-nowrap {{ !$status ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-800 text-slate-400 hover:text-white' }}">
                Semua ({{ $totalOrders }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition whitespace-nowrap {{ $status === 'completed' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-800 text-slate-400 hover:text-white' }}">
                Lunas ({{ $totalCompleted }})
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-3 py-1.5 rounded-lg text-xs font-bold transition whitespace-nowrap {{ $status === 'pending' ? 'bg-amber-600 text-white shadow-xs' : 'bg-slate-800 text-slate-400 hover:text-white' }}">
                Menunggu ({{ $totalPending }})
            </a>
        </div>

        <form method="GET" action="{{ route('admin.orders.index') }}" class="w-full sm:w-72 relative">
            @if($status)
                <input type="hidden" name="status" value="{{ $status }}">
            @endif
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari invoice / nama / HP..." class="w-full pl-9 pr-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500" />
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-slate-500 text-xs"></i>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-800/80 text-slate-400 font-bold border-b border-slate-800 uppercase tracking-wider text-[10.5px]">
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
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse($orders as $ord)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="font-bold text-emerald-400 hover:underline font-mono block">
                                    #{{ $ord->order_number }}
                                </a>
                                <span class="text-[10px] text-slate-500 block mt-0.5">{{ $ord->created_at->format('d/m/Y H:i') }} WIB</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-white">{{ $ord->customer_name }}</p>
                                <p class="text-[10.5px] text-slate-400 mt-0.5"><i class="fa-brands fa-whatsapp text-emerald-400 mr-1"></i>{{ $ord->customer_phone }}</p>
                            </td>
                            <td class="py-3.5 px-4 max-w-xs">
                                @if(!empty($ord->items_json))
                                    @foreach($ord->items_json as $it)
                                        <p class="truncate leading-tight">• {{ $it['title'] ?? 'Buku' }} <span class="text-slate-500 font-mono">({{ $it['quantity'] ?? 1 }}x)</span></p>
                                    @endforeach
                                @else
                                    <span class="text-slate-500 italic">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <span class="font-bold text-white font-mono">{{ $ord->formatted_payment }}</span>
                                <span class="text-[9.5px] text-slate-500 block uppercase">{{ $ord->payment_method }}</span>
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($ord->payment_status === 'completed')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 uppercase">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i> Lunas
                                    </span>
                                @elseif($ord->payment_status === 'pending')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/30 uppercase">
                                        <i class="fa-solid fa-clock text-[9px]"></i> Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/30 uppercase">
                                        {{ strtoupper($ord->payment_status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <span class="text-[11px] font-medium capitalize block text-slate-300">
                                    {{ str_replace('_', ' ', $ord->shipping_status) }}
                                </span>
                                @if($ord->tracking_number)
                                    <span class="text-[9.5px] text-emerald-400 font-mono block mt-0.5">{{ $ord->tracking_number }}</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.orders.show', $ord->id) }}" class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600/40 text-emerald-400 text-xs font-bold transition flex items-center gap-1" title="Detail Pesanan">
                                        <i class="fa-solid fa-eye text-[10px]"></i>
                                        <span>Kelola</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500">
                                <i class="fa-solid fa-inbox text-2xl mb-2 block"></i>
                                Belum ada data pesanan transaksi yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
