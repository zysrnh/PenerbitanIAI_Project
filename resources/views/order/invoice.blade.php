@extends('layouts.app')

@section('title', 'Invoice #' . $order->order_number . ' | PENERBIT PERSIS')

@section('content')
<div class="bg-slate-100/70 min-h-[85vh] py-8 sm:py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- Top Navigation / Actions -->
        <div class="mb-4 flex items-center justify-between">
            <a href="{{ route('katalog') }}" class="text-xs font-semibold text-slate-500 hover:text-emerald-800 flex items-center gap-1.5 transition">
                <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Katalog Buku
            </a>
            <div class="flex items-center gap-2">
                <button type="button" onclick="window.print()" class="px-3 py-1.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 rounded-sm text-xs font-medium transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                    <i class="fa-solid fa-print text-slate-400"></i> Cetak Dokumen
                </button>
            </div>
        </div>

        <!-- Official Invoice Document Sheet -->
        <div class="bg-white rounded-sm border border-slate-300 shadow-sm overflow-hidden print:border-none print:shadow-none">
            
            <!-- Document Header -->
            <div class="p-6 sm:p-7 bg-[#032c21] text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-emerald-950">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/logo/logo_penerbit_persis_horizontal_white.png') }}" alt="PENERBIT PERSIS" class="h-10 w-auto object-contain" />
                    <div class="border-l border-emerald-800/80 pl-3.5">
                        <h2 class="text-sm sm:text-base font-bold tracking-tight font-heading">BUKTI TRANSAKSI RESMI</h2>
                        <p class="text-xs text-emerald-200/90 font-mono mt-0.5">{{ $order->order_number }}</p>
                    </div>
                </div>
                <div class="sm:text-right">
                    @if($order->payment_status === 'completed')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-600 text-white rounded-xs text-[11px] font-bold tracking-wider uppercase border border-emerald-500">
                            <i class="fa-solid fa-check text-[10px]"></i> LUNAS / TERBAYAR
                        </span>
                        <p class="text-[10.5px] text-emerald-200/70 mt-1 font-mono">Dibayar: {{ $order->paid_at ? $order->paid_at->format('d/m/Y H:i') : '-' }} WIB</p>
                    @elseif($order->payment_status === 'pending')
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-amber-500 text-slate-950 rounded-xs text-[11px] font-bold tracking-wider uppercase">
                            <i class="fa-solid fa-clock text-[10px]"></i> MENUNGGU PEMBAYARAN
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-red-600 text-white rounded-xs text-[11px] font-bold tracking-wider uppercase">
                            <i class="fa-solid fa-xmark text-[10px]"></i> {{ strtoupper($order->payment_status) }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Meta Data Grid -->
            <div class="p-6 sm:p-7 grid grid-cols-1 sm:grid-cols-2 gap-6 border-b border-slate-200 bg-slate-50/50 text-xs">
                <div>
                    <h5 class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tujuan Pengiriman</h5>
                    <p class="text-sm font-bold text-slate-900">{{ $order->customer_name }}</p>
                    <p class="text-slate-600 mt-0.5"><i class="fa-brands fa-whatsapp text-emerald-700 mr-1"></i> {{ $order->customer_phone }}</p>
                    @if($order->customer_email)
                        <p class="text-slate-500 mt-0.5"><i class="fa-solid fa-envelope text-slate-400 mr-1"></i> {{ $order->customer_email }}</p>
                    @endif
                    <div class="mt-2.5 pt-2.5 border-t border-slate-200">
                        <p class="text-[11px] text-slate-700 leading-relaxed">
                            <strong class="text-slate-900 block text-[10.5px] uppercase text-slate-400 mb-0.5">Alamat:</strong>
                            {{ $order->customer_address }}
                        </p>
                    </div>
                </div>

                <div>
                    <h5 class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider mb-2">Informasi Pembelian</h5>
                    <div class="space-y-1.5">
                        <div class="flex justify-between py-0.5 border-b border-slate-200/70">
                            <span class="text-slate-500">Waktu Order:</span>
                            <span class="font-medium text-slate-800">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                        </div>
                        <div class="flex justify-between py-0.5 border-b border-slate-200/70">
                            <span class="text-slate-500">Metode Bayar:</span>
                            <span class="font-medium text-slate-800 uppercase">{{ $order->payment_method }} (Realtime)</span>
                        </div>
                        <div class="flex justify-between py-0.5 border-b border-slate-200/70">
                            <span class="text-slate-500">Status Pesanan:</span>
                            <span class="font-bold text-emerald-800 capitalize">{{ str_replace('_', ' ', $order->shipping_status) }}</span>
                        </div>
                        @if($order->tracking_number)
                            <div class="flex justify-between py-0.5 border-b border-slate-200/70">
                                <span class="text-slate-500">Nomor Resi:</span>
                                <span class="font-bold text-emerald-800 font-mono">{{ $order->tracking_number }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="p-6 sm:p-7">
                <h5 class="text-[10.5px] font-bold text-slate-400 uppercase tracking-wider mb-2.5">Rincian Buku</h5>
                <div class="overflow-x-auto border border-slate-200 rounded-sm">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-100 text-slate-600 font-bold border-b border-slate-200">
                            <tr>
                                <th class="py-2.5 px-3.5">Judul Buku & Penulis</th>
                                <th class="py-2.5 px-3.5 text-center w-16">Qty</th>
                                <th class="py-2.5 px-3.5 text-right w-28">Harga Satuan</th>
                                <th class="py-2.5 px-3.5 text-right w-28">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if(!empty($order->items_json))
                                @foreach($order->items_json as $item)
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="py-3 px-3.5">
                                            <p class="font-bold text-slate-900">{{ $item['title'] ?? 'Buku' }}</p>
                                            <p class="text-[10px] text-slate-500 mt-0.5">{{ $item['category'] ?? 'Penerbitan' }} • {{ $item['author'] ?? '-' }}</p>
                                        </td>
                                        <td class="py-3 px-3.5 text-center font-medium text-slate-700">{{ $item['quantity'] ?? 1 }}</td>
                                        <td class="py-3 px-3.5 text-right text-slate-600 font-mono">{{ $item['formatted_price'] ?? 'Rp 0' }}</td>
                                        <td class="py-3 px-3.5 text-right font-bold text-slate-900 font-mono">{{ $item['formatted_subtotal'] ?? 'Rp 0' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Financial Calculation -->
                <div class="mt-4 flex flex-col sm:flex-row justify-end">
                    <div class="w-full sm:w-64 space-y-1.5 text-xs">
                        <div class="flex justify-between text-slate-600 py-0.5">
                            <span>Subtotal Buku:</span>
                            <span class="font-mono text-slate-800 font-medium">{{ $order->formatted_total }}</span>
                        </div>
                        @if($order->fee > 0)
                            <div class="flex justify-between text-slate-600 py-0.5">
                                <span>Biaya Layanan QRIS:</span>
                                <span class="font-mono text-slate-800 font-medium">{{ $order->formatted_fee }}</span>
                            </div>
                        @endif
                        <div class="pt-2 border-t border-slate-300 flex justify-between items-center text-slate-900">
                            <span class="font-bold text-xs">Total Pembayaran:</span>
                            <span class="font-bold font-mono text-sm text-emerald-900">{{ $order->formatted_payment }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Footer -->
            <div class="p-5 sm:p-6 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="text-[11px] text-slate-500 text-center sm:text-left">
                    <p class="font-medium text-slate-700">Penerbitan & Percetakan Resmi PENERBIT PERSIS (IAI Persis Bandung)</p>
                    <p>Layanan Pelanggan WhatsApp: <strong class="text-slate-800">0821-1611-6133</strong></p>
                </div>
                @php
                    $waMsg = "Halo Redaksi PENERBIT PERSIS, saya telah melakukan pemesanan buku dengan No. Invoice *{$order->order_number}* atas nama *{$order->customer_name}* (Total {$order->formatted_payment}). Mohon info konfirmasi pengiriman naskah/buku ya kak. Terima kasih!";
                    $waShareUrl = "https://wa.me/6282116116133?text=" . urlencode($waMsg);
                @endphp
                <a href="{{ $waShareUrl }}" target="_blank" class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                    <i class="fa-brands fa-whatsapp text-sm text-lime-300"></i> Hubungi Redaksi via WhatsApp
                </a>
            </div>

        </div>

    </div>
</div>
@endsection
