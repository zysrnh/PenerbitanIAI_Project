@extends('layouts.app')

@section('title', 'Invoice ' . $order->order_number . ' | PERSIS PERS')

@section('content')
<div class="bg-slate-50 min-h-[85vh] py-10 sm:py-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Breadcrumb / Back Link -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('katalog') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-800 flex items-center gap-2 transition">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog Buku
            </a>
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="px-3.5 py-1.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 rounded-lg text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                    <i class="fa-solid fa-print text-slate-500"></i> Cetak Invoice
                </button>
            </div>
        </div>

        <!-- Invoice Card -->
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xl overflow-hidden print:border-none print:shadow-none">
            
            <!-- Invoice Header Bar -->
            <div class="p-6 sm:p-8 bg-[#032c21] text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-emerald-900">
                <div class="flex items-center gap-3.5">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PERSIS PERS" class="h-10 sm:h-12 w-auto object-contain" />
                    <div>
                        <h2 class="text-base sm:text-lg font-black tracking-tight font-heading">INVOICE PEMESANAN</h2>
                        <p class="text-xs text-emerald-200/80 font-mono">#{{ $order->order_number }}</p>
                    </div>
                </div>
                <div class="sm:text-right">
                    @if($order->payment_status === 'completed')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500 text-white rounded-full text-xs font-black tracking-wide shadow-xs uppercase">
                            <i class="fa-solid fa-circle-check"></i> LUNAS / DIBAYAR
                        </span>
                        <p class="text-[11px] text-emerald-200/80 mt-1">Dibayar: {{ $order->paid_at ? $order->paid_at->format('d M Y, H:i') : '-' }} WIB</p>
                    @elseif($order->payment_status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-500 text-slate-950 rounded-full text-xs font-black tracking-wide shadow-xs uppercase">
                            <i class="fa-solid fa-clock"></i> MENUNGGU PEMBAYARAN
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-500 text-white rounded-full text-xs font-black tracking-wide shadow-xs uppercase">
                            <i class="fa-solid fa-circle-xmark"></i> {{ strtoupper($order->payment_status) }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Customer & Transaction Details -->
            <div class="p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 gap-6 border-b border-slate-100">
                <div>
                    <h5 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Informasi Pemesan</h5>
                    <p class="text-sm font-extrabold text-slate-900">{{ $order->customer_name }}</p>
                    <p class="text-xs text-slate-600 mt-0.5"><i class="fa-brands fa-whatsapp text-emerald-600 mr-1"></i> {{ $order->customer_phone }}</p>
                    @if($order->customer_email)
                        <p class="text-xs text-slate-500 mt-0.5"><i class="fa-solid fa-envelope text-slate-400 mr-1"></i> {{ $order->customer_email }}</p>
                    @endif
                    <div class="mt-3 pt-3 border-t border-slate-100">
                        <h6 class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider mb-1">Alamat Pengiriman</h6>
                        <p class="text-xs text-slate-700 leading-relaxed bg-slate-50 p-2.5 rounded-lg border border-slate-100">
                            {{ $order->customer_address }}
                        </p>
                    </div>
                </div>

                <div>
                    <h5 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Rincian Transaksi</h5>
                    <div class="space-y-1.5 text-xs">
                        <div class="flex justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-500">Tanggal Order:</span>
                            <span class="font-bold text-slate-800">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-500">Metode Bayar:</span>
                            <span class="font-bold text-slate-800 uppercase">{{ $order->payment_method }} (Otomatis)</span>
                        </div>
                        <div class="flex justify-between py-1 border-b border-slate-100">
                            <span class="text-slate-500">Status Pengiriman:</span>
                            <span class="font-bold text-emerald-800 capitalize">{{ str_replace('_', ' ', $order->shipping_status) }}</span>
                        </div>
                        @if($order->tracking_number)
                            <div class="flex justify-between py-1 border-b border-slate-100">
                                <span class="text-slate-500">No. Resi:</span>
                                <span class="font-bold text-emerald-700 font-mono">{{ $order->tracking_number }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="p-6 sm:p-8">
                <h5 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-3">Daftar Buku Dipesan</h5>
                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50 text-slate-500 font-bold border-b border-slate-200">
                            <tr>
                                <th class="py-3 px-4">Buku & Kategori</th>
                                <th class="py-3 px-4 text-center">Qty</th>
                                <th class="py-3 px-4 text-right">Harga Satuan</th>
                                <th class="py-3 px-4 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if(!empty($order->items_json))
                                @foreach($order->items_json as $item)
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="py-3.5 px-4">
                                            <p class="font-extrabold text-slate-900">{{ $item['title'] ?? 'Buku' }}</p>
                                            <p class="text-[10px] text-emerald-700 font-semibold">{{ $item['category'] ?? 'Penerbitan' }} • {{ $item['author'] ?? '-' }}</p>
                                        </td>
                                        <td class="py-3.5 px-4 text-center font-bold text-slate-800">{{ $item['quantity'] ?? 1 }}</td>
                                        <td class="py-3.5 px-4 text-right text-slate-600 font-mono">{{ $item['formatted_price'] ?? 'Rp 0' }}</td>
                                        <td class="py-3.5 px-4 text-right font-black text-slate-900 font-mono">{{ $item['formatted_subtotal'] ?? 'Rp 0' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Financial Summary -->
                <div class="mt-6 flex flex-col sm:flex-row justify-end">
                    <div class="w-full sm:w-72 space-y-2 bg-slate-50 p-4 rounded-xl border border-slate-100 text-xs">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal Buku:</span>
                            <span class="font-bold font-mono text-slate-800">{{ $order->formatted_total }}</span>
                        </div>
                        @if($order->fee > 0)
                            <div class="flex justify-between text-slate-600">
                                <span>Biaya Layanan QRIS:</span>
                                <span class="font-bold font-mono text-slate-800">{{ $order->formatted_fee }}</span>
                            </div>
                        @endif
                        <div class="pt-2 border-t border-slate-200 flex justify-between items-center">
                            <span class="font-extrabold text-slate-900 text-sm">Total Tagihan:</span>
                            <span class="font-black font-mono text-base text-emerald-800">{{ $order->formatted_payment }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Notes & Actions -->
            <div class="p-6 sm:p-8 bg-slate-50/80 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-[11px] text-slate-500 leading-relaxed text-center sm:text-left">
                    <p class="font-bold text-slate-700">Terima kasih telah berbelanja di PENERBIT PERSIS!</p>
                    <p>Konfirmasi atau pertanyaan pesanan hubungi WhatsApp Redaksi di <strong>0821-1611-6133</strong>.</p>
                </div>
                @php
                    $waMsg = "Halo Redaksi PERSIS PERS, ini invoice pesanan saya *{$order->order_number}* atas nama *{$order->customer_name}* senilai *{$order->formatted_payment}*. Mohon info proses pengirimannya. Terima kasih!";
                    $waShareUrl = "https://wa.me/6282116116133?text=" . urlencode($waMsg);
                @endphp
                <a href="{{ $waShareUrl }}" target="_blank" class="px-5 py-2.5 bg-[#006830] hover:bg-[#032c21] text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-xs">
                    <i class="fa-brands fa-whatsapp text-sm text-lime-300"></i> Hubungi Redaksi di WhatsApp
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
