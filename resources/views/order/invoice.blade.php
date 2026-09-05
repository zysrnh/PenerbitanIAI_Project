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

            @if($order->payment_status === 'pending' && $order->payment_qr_string)
                <!-- QRIS PAYMENT BOX FOR PENDING ORDERS -->
                <div class="p-6 sm:p-7 bg-emerald-50/40 border-b border-slate-200 text-center space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-100 border border-amber-300 rounded-xs text-xs font-bold text-amber-900">
                        <i class="fa-solid fa-spinner fa-spin text-amber-700"></i>
                        <span id="invoiceQrisStatusText">Menunggu Pembayaran QRIS... (Terdeteksi Otomatis Realtime)</span>
                    </div>

                    <div class="bg-white p-4 rounded-sm border border-slate-300 shadow-md inline-block mx-auto max-w-[260px] w-full">
                        <div class="flex items-center justify-between mb-2 pb-1.5 border-b border-slate-100">
                            <span class="text-[10.5px] font-bold text-slate-800 font-heading">QRIS RESMI</span>
                            <span class="text-[9.5px] font-bold text-emerald-800">PERSIS PERS</span>
                        </div>
                        
                        @php
                            $qrImageUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&margin=10&data=' . urlencode($order->payment_qr_string);
                        @endphp
                        <div class="aspect-square w-full bg-slate-50 rounded-xs overflow-hidden flex items-center justify-center border border-slate-200 p-1">
                            <img src="{{ $qrImageUrl }}" alt="QRIS Code" class="w-full h-full object-contain" />
                        </div>

                        <div class="mt-2 text-center">
                            <p class="text-[10px] text-slate-500 font-medium">BCA, Mandiri, BRI, BNI, BSI, DANA, GoPay, OVO, ShopeePay</p>
                            <p class="text-[13px] font-mono font-black text-emerald-900 mt-1">Total: {{ $order->formatted_payment }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-2 pt-1">
                        <button type="button" onclick="checkInvoicePaymentStatus()" class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 cursor-pointer shadow-2xs">
                            <i class="fa-solid fa-arrows-rotate text-xs text-lime-300"></i>
                            <span>Cek Status Pembayaran</span>
                        </button>
                    </div>
                </div>
            @endif

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
                                    @php
                                        $cover = $item['cover_image'] ?? null;
                                        if (!$cover && !empty($item['book_id'])) {
                                            $b = \App\Models\Book::find($item['book_id']);
                                            $cover = $b ? $b->cover_image : null;
                                        }
                                        $hasCover = $cover && (file_exists(public_path('storage/' . $cover)) || file_exists(public_path('images/' . $cover)));
                                        $coverUrl = $hasCover ? (file_exists(public_path('storage/' . $cover)) ? asset('storage/' . $cover) : asset('images/' . $cover)) : null;
                                    @endphp
                                    <tr class="hover:bg-slate-50/50">
                                        <td class="py-2.5 px-3.5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-12 shrink-0 bg-slate-900 rounded-xs overflow-hidden border border-slate-200 shadow-2xs">
                                                    @if($hasCover)
                                                        <img src="{{ $coverUrl }}" alt="{{ $item['title'] ?? 'Buku' }}" class="w-full h-full object-cover" />
                                                    @else
                                                        <div class="w-full h-full bg-[#032c21] p-1 flex flex-col justify-between text-white border-l border-emerald-400">
                                                            <span class="text-[4.5px] font-mono text-emerald-300">PERSIS</span>
                                                            <span class="text-[5.5px] font-bold line-clamp-2 leading-none">{{ $item['title'] ?? 'Buku' }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <p class="font-bold text-slate-900">{{ $item['title'] ?? 'Buku' }}</p>
                                                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $item['category'] ?? 'Penerbitan' }} • {{ $item['author'] ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-2.5 px-3.5 text-center font-medium text-slate-700">{{ $item['quantity'] ?? 1 }}</td>
                                        <td class="py-2.5 px-3.5 text-right text-slate-600 font-mono">{{ $item['formatted_price'] ?? 'Rp 0' }}</td>
                                        <td class="py-2.5 px-3.5 text-right font-bold text-slate-900 font-mono">{{ $item['formatted_subtotal'] ?? 'Rp 0' }}</td>
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
                    <p class="font-medium text-slate-700">Penerbitan & Percetakan Resmi PENERBIT PERSIS (PERSIS PERS)</p>
                    <p>Layanan Pelanggan WhatsApp: <strong class="text-slate-800">0821-1611-6133</strong></p>
                </div>
                @php
                    $waMsg = "Assalamualaikum Redaksi Penerbit Persis, saya telah melakukan pemesanan buku dengan No. Invoice *{$order->order_number}* atas nama *{$order->customer_name}* (Total {$order->formatted_payment}). Mohon info konfirmasi pengiriman naskah/buku ya kak. Terima kasih!";
                    $waShareUrl = "https://wa.me/6282116116133?text=" . urlencode($waMsg);
                @endphp

                <div class="flex items-center gap-2">
                    @if($order->shipping_status === 'dikirim')
                        <form method="POST" action="{{ route('member.orders.confirm_received', $order->order_number) }}" onsubmit="return confirm('Apakah paket buku pesanan ini telah Anda terima dengan baik?')">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs cursor-pointer">
                                <i class="fa-solid fa-circle-check text-lime-300 text-xs"></i>
                                <span>Konfirmasi Pesanan Diterima</span>
                            </button>
                        </form>
                    @endif

                    <a href="{{ $waShareUrl }}" target="_blank" class="px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white rounded-sm text-xs font-bold transition flex items-center gap-1.5 shadow-2xs">
                        <i class="fa-brands fa-whatsapp text-sm text-lime-300"></i> Hubungi Redaksi via WhatsApp
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@if($order->payment_status === 'pending')
@push('scripts')
<script>
    function checkInvoicePaymentStatus() {
        fetch('/order/status/{{ $order->order_number }}')
            .then(res => res.json())
            .then(data => {
                if (data && (data.status === 'completed' || data.is_paid)) {
                    const statusText = document.getElementById('invoiceQrisStatusText');
                    if (statusText) statusText.textContent = 'Pembayaran Berhasil! Memuat ulang invoice...';
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    alert('Pembayaran belum terdeteksi. Silakan selesaikan scan transfer QRIS Anda.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memeriksa status. Silakan coba kembali.');
            });
    }

    // Auto-poll status every 3 seconds for pending orders
    const pollInterval = setInterval(() => {
        fetch('/order/status/{{ $order->order_number }}')
            .then(res => res.json())
            .then(data => {
                if (data && (data.status === 'completed' || data.is_paid)) {
                    clearInterval(pollInterval);
                    const statusText = document.getElementById('invoiceQrisStatusText');
                    if (statusText) statusText.textContent = 'Pembayaran Berhasil! Memuat ulang invoice...';
                    setTimeout(() => window.location.reload(), 1000);
                }
            })
            .catch(err => console.error('Poll err:', err));
    }, 3000);
</script>
@endpush
@endif
@endsection
