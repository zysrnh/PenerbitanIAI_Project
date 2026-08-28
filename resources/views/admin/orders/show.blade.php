@extends('admin.layouts.app')

@section('title', 'Detail Pesanan #' . $order->order_number . ' | PERSIS PERS')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">

    <!-- Top Breadcrumb & Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-slate-400 hover:text-white flex items-center gap-2 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pesanan
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" class="px-3.5 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border border-slate-700">
                <i class="fa-solid fa-file-invoice text-emerald-400"></i> Buka Invoice Publik
            </a>
        </div>
    </div>

    <!-- Main Order Details Card -->
    <div class="bg-slate-900/90 border border-slate-800 rounded-2xl overflow-hidden shadow-xs">
        
        <!-- Header -->
        <div class="p-6 bg-slate-800/60 border-b border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-[10px] font-bold tracking-wider uppercase text-emerald-400 font-mono">INVOICE PEMESANAN</span>
                <h2 class="text-xl font-black text-white font-mono mt-0.5">#{{ $order->order_number }}</h2>
                <p class="text-xs text-slate-400 mt-1">Dibuat pada {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
            <div class="sm:text-right">
                @if($order->payment_status === 'completed')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 rounded-full text-xs font-bold uppercase">
                        <i class="fa-solid fa-circle-check"></i> LUNAS / TERBAYAR
                    </span>
                    <p class="text-[10.5px] text-slate-400 mt-1">Dibayar: {{ $order->paid_at ? $order->paid_at->format('d/m/Y H:i') : '-' }} WIB</p>
                @elseif($order->payment_status === 'pending')
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/30 rounded-full text-xs font-bold uppercase">
                        <i class="fa-solid fa-clock"></i> MENUNGGU PEMBAYARAN
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-500/10 text-red-400 border border-red-500/30 rounded-full text-xs font-bold uppercase">
                        {{ strtoupper($order->payment_status) }}
                    </span>
                @endif
            </div>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-slate-800">
            <!-- Customer Info -->
            <div class="space-y-3">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Informasi Pemesan</h4>
                <div class="bg-slate-800/40 p-4 rounded-xl border border-slate-800/80 space-y-2 text-xs">
                    <p class="text-sm font-bold text-white">{{ $order->customer_name }}</p>
                    <p class="text-slate-300"><i class="fa-brands fa-whatsapp text-emerald-400 mr-1.5"></i>{{ $order->customer_phone }}</p>
                    @if($order->customer_email)
                        <p class="text-slate-300"><i class="fa-solid fa-envelope text-slate-400 mr-1.5"></i>{{ $order->customer_email }}</p>
                    @endif
                    <div class="pt-2 border-t border-slate-700/60">
                        <p class="text-[11px] font-bold text-slate-400 uppercase mb-1">Alamat Lengkap:</p>
                        <p class="text-slate-200 leading-relaxed">{{ $order->customer_address }}</p>
                    </div>
                    @if($order->notes)
                        <div class="pt-2 border-t border-slate-700/60">
                            <p class="text-[11px] font-bold text-amber-400 uppercase mb-1">Catatan Tambahan:</p>
                            <p class="text-amber-200/90 italic">"{{ $order->notes }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Shipping Status Update Form -->
            <div class="space-y-3">
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Update Status Pengiriman</h4>
                <form method="POST" action="{{ route('admin.orders.shipping', $order->id) }}" class="bg-slate-800/40 p-4 rounded-xl border border-slate-800/80 space-y-3 text-xs">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Status Pengiriman</label>
                        <select name="shipping_status" class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-xs focus:outline-none focus:border-emerald-500">
                            <option value="menunggu_proses" {{ $order->shipping_status === 'menunggu_proses' ? 'selected' : '' }}>Menunggu Proses Packing</option>
                            <option value="diproses" {{ $order->shipping_status === 'diproses' ? 'selected' : '' }}>Sedang Diproses / Packing</option>
                            <option value="dikirim" {{ $order->shipping_status === 'dikirim' ? 'selected' : '' }}>Sudah Dikirim (Kurir / Ekspedisi)</option>
                            <option value="selesai" {{ $order->shipping_status === 'selesai' ? 'selected' : '' }}>Pesanan Selesai / Diterima</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-300 mb-1">Nomor Resi Pengiriman</label>
                        <input type="text" name="tracking_number" value="{{ $order->tracking_number }}" placeholder="Contoh: JNE / J&T / Sicepat Resi" class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-xs focus:outline-none focus:border-emerald-500 font-mono" />
                    </div>

                    <button type="submit" class="w-full py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg font-bold text-xs transition shadow-xs">
                        Simpan Status Pengiriman
                    </button>
                </form>
            </div>
        </div>

        <!-- Items Table -->
        <div class="p-6">
            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Daftar Buku Dipesan</h4>
            <div class="overflow-x-auto rounded-xl border border-slate-800">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-800 text-slate-400 font-bold border-b border-slate-800">
                        <tr>
                            <th class="py-2.5 px-4">Judul Buku &amp; Kategori</th>
                            <th class="py-2.5 px-4 text-center">Qty</th>
                            <th class="py-2.5 px-4 text-right">Harga Satuan</th>
                            <th class="py-2.5 px-4 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-300">
                        @if(!empty($order->items_json))
                            @foreach($order->items_json as $it)
                                <tr>
                                    <td class="py-3 px-4">
                                        <p class="font-bold text-white">{{ $it['title'] ?? 'Buku' }}</p>
                                        <p class="text-[10px] text-slate-500 mt-0.5">{{ $it['category'] ?? 'Penerbitan' }} • {{ $it['author'] ?? '-' }}</p>
                                    </td>
                                    <td class="py-3 px-4 text-center font-bold font-mono text-white">{{ $it['quantity'] ?? 1 }}</td>
                                    <td class="py-3 px-4 text-right font-mono">{{ $it['formatted_price'] ?? 'Rp 0' }}</td>
                                    <td class="py-3 px-4 text-right font-bold text-white font-mono">{{ $it['formatted_subtotal'] ?? 'Rp 0' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Calculation Summary -->
            <div class="mt-4 flex justify-end">
                <div class="w-full sm:w-64 space-y-1.5 text-xs bg-slate-800/50 p-4 rounded-xl border border-slate-800">
                    <div class="flex justify-between text-slate-400">
                        <span>Subtotal Buku:</span>
                        <span class="font-mono text-white font-bold">{{ $order->formatted_total }}</span>
                    </div>
                    @if($order->fee > 0)
                        <div class="flex justify-between text-slate-400">
                            <span>Fee QRIS:</span>
                            <span class="font-mono text-white">{{ $order->formatted_fee }}</span>
                        </div>
                    @endif
                    <div class="pt-2 border-t border-slate-700 flex justify-between items-center text-white">
                        <span class="font-bold text-xs">Total Pembayaran:</span>
                        <span class="font-black font-mono text-sm text-emerald-400">{{ $order->formatted_payment }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
