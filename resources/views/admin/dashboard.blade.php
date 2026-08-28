@extends('admin.layouts.app')

@section('title', 'Dashboard Utama | Admin PERSIS PERS')

@section('content')
<div class="space-y-6">

    <!-- Top Greeting & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 font-heading tracking-tight flex items-center gap-2.5">
                <span>Ringkasan Penerbitan &amp; Penjualan</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Pantau transaksi buku dan permohonan naskah kampus.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('katalog') }}" target="_blank" class="px-3 py-2 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-emerald-600"></i>
                <span>Lihat Katalog Publik</span>
            </a>
            <a href="{{ route('admin.books.create') }}" class="px-3.5 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-xs">
                <i class="fa-solid fa-plus text-xs text-lime-300"></i>
                <span>Tambah Buku</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Metric 1: Total Pendapatan Penjualan -->
        <div class="bg-white rounded-xl border border-slate-200 p-4.5 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pendapatan Buku</span>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h4>
                <p class="text-[10px] text-emerald-700 font-semibold mt-0.5">Transaksi Lunas QRIS</p>
            </div>
        </div>

        <!-- Metric 2: Total Pesanan Masuk -->
        <a href="{{ route('admin.orders.index') }}" class="bg-white rounded-xl border border-slate-200 p-4.5 shadow-xs hover:border-emerald-600 transition flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-700 border border-indigo-100 group-hover:bg-[#032c21] group-hover:text-white flex items-center justify-center text-xl shrink-0 transition">
                <i class="fa-solid fa-receipt"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pesanan Masuk</span>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalOrders ?? 0 }} Order</h4>
                <p class="text-[10px] text-indigo-700 font-semibold mt-0.5">Kelola &amp; Input Resi &rarr;</p>
            </div>
        </a>

        <!-- Metric 3: Katalog Terbitan -->
        <a href="{{ route('admin.books.index') }}" class="bg-white rounded-xl border border-slate-200 p-4.5 shadow-xs hover:border-emerald-600 transition flex items-center gap-4 group">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-100 group-hover:bg-[#032c21] group-hover:text-white flex items-center justify-center text-xl shrink-0 transition">
                <i class="fa-solid fa-book-bookmark"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Katalog Terbitan</span>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalBooks ?? 0 }} Judul</h4>
                <p class="text-[10px] text-emerald-700 font-semibold mt-0.5">Monograf &amp; Buku Ajar</p>
            </div>
        </a>

        <!-- Metric 4: Total Pengguna / Member -->
        <div class="bg-white rounded-xl border border-slate-200 p-4.5 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 border border-amber-100 flex items-center justify-center text-xl shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Anggota &amp; Pembaca</span>
                <h4 class="text-lg font-black text-slate-900 font-mono mt-0.5">{{ $totalUsers ?? 0 }} Akun</h4>
                <p class="text-[10px] text-amber-700 font-semibold mt-0.5">Civitas &amp; Pengunjung</p>
            </div>
        </div>

    </div>

    <!-- Main Grid: Recent Orders (8 cols) & Quick Actions (4 cols) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Recent Orders Table (8 Cols) -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Recent Orders Card -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-extrabold text-sm text-slate-900 font-heading">Transaksi Pesanan Terbaru</h3>
                        <p class="text-[11px] text-slate-400 mt-0.5">Daftar transaksi buku masuk via QRIS otomatis</p>
                    </div>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-800 hover:underline flex items-center gap-1">
                        <span>Lihat Semua Pesanan</span>
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
                                        <p class="font-bold text-slate-900">{{ $ord->customer_name }}</p>
                                        <p class="text-[10px] text-slate-400 truncate max-w-xs">{{ $ord->customer_phone }}</p>
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
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="px-2 py-1 bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 rounded-xs text-xs font-bold transition inline-flex items-center gap-1">
                                            <span>Kelola</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-slate-400">
                                        <i class="fa-solid fa-receipt text-2xl mb-1.5 text-slate-300 block"></i>
                                        Belum ada transaksi pesanan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right: Quick Shortcuts (4 Cols) -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Quick Management Card -->
            <div class="bg-white rounded-xl border border-slate-200 shadow-xs p-5 space-y-3">
                <h4 class="font-extrabold text-sm text-slate-900">Akses Cepat Pengelolaan</h4>
                
                <div class="grid grid-cols-1 gap-2.5 pt-1">
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
                        <i class="fa-solid fa-angle-right text-xs text-slate-400 group-hover:text-amber-700"></i>
                    </a>
                </div>
            </div>

            <!-- Public Portal Link -->
            <div class="p-5 rounded-xl bg-[#032c21] text-white border border-[#064e3b] shadow-xs space-y-2">
                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-widest block font-mono">PORTAL RESMI PENERBIT</span>
                <h5 class="font-bold text-sm text-white">Etalase Publik PERSIS PERS</h5>
                <p class="text-xs text-slate-300 leading-relaxed">Lihat langsung katalog buku dan simulasi transaksi yang tampil kepada pembeli umum.</p>
                <a href="{{ route('katalog') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition shadow-2xs mt-2">
                    <span>Kunjungi Katalog Publik</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
