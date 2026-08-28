<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Baru #{{ $order->order_number }}</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #e2e8f0; margin: 0; padding: 24px 12px; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="650" border="0" cellspacing="0" cellpadding="0" style="max-width: 650px; width: 100%; background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);">
                    
                    <!-- Official Header -->
                    <tr>
                        <td style="padding: 24px 32px; background-color: #032c21; color: #ffffff;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <div style="font-size: 11px; font-weight: 800; color: #4ade80; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px;">
                                            NOTIFIKASI TRANSAKSI RESMI
                                        </div>
                                        <h1 style="font-size: 20px; font-weight: 800; margin: 0; color: #ffffff;">
                                            PERSIS PERS &bull; Pesanan Buku Masuk
                                        </h1>
                                        <p style="font-size: 12px; color: #cbd5e1; margin: 4px 0 0;">
                                            No. Invoice: <strong>#{{ $order->order_number }}</strong> &bull; {{ $order->created_at->format('d/m/Y H:i') }} WIB
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 28px 32px;">
                            
                            <p style="font-size: 14px; line-height: 1.6; color: #334155; margin-top: 0;">
                                Halo Tim Admin &amp; Redaksi PERSIS PERS, ada transaksi pesanan buku baru yang telah terdaftar di sistem:
                            </p>

                            <!-- Buyer Info Card -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="8" style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 12.5px; margin-bottom: 20px;">
                                <tr style="background-color: #f1f5f9;">
                                    <td colspan="2" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">
                                        👤 DATA PEMBELI &amp; PENGIRIMAN
                                    </td>
                                </tr>
                                <tr>
                                    <td width="35%" style="color: #64748b; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Nama Pembeli</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Email</td>
                                    <td style="color: #0f172a; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_email }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #f1f5f9;">WhatsApp / No. HP</td>
                                    <td style="color: #006830; font-weight: bold; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_phone }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; vertical-align: top; border-bottom: 1px solid #f1f5f9;">Alamat Lengkap</td>
                                    <td style="color: #334155; line-height: 1.5; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_address }}</td>
                                </tr>
                                @if($order->notes)
                                <tr>
                                    <td style="color: #64748b; font-weight: bold;">Catatan Pesanan</td>
                                    <td style="color: #d97706; font-style: italic;">"{{ $order->notes }}"</td>
                                </tr>
                                @endif
                            </table>

                            <!-- Items Table -->
                            @php
                                $items = is_array($order->items_json) ? $order->items_json : json_decode($order->items_json ?? '[]', true);
                            @endphp
                            <table width="100%" border="0" cellspacing="0" cellpadding="8" style="border: 1px solid #e2e8f0; font-size: 12.5px; margin-bottom: 20px;">
                                <tr style="background-color: #f1f5f9;">
                                    <th align="left" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Judul Buku</th>
                                    <th align="center" width="60" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Qty</th>
                                    <th align="right" width="100" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Harga</th>
                                    <th align="right" width="110" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Subtotal</th>
                                </tr>
                                @foreach($items as $item)
                                <tr>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #f1f5f9;">
                                        {{ $item['title'] ?? 'Buku PERSIS PERS' }}
                                    </td>
                                    <td align="center" style="color: #475569; border-bottom: 1px solid #f1f5f9;">{{ $item['quantity'] ?? ($item['qty'] ?? 1) }}</td>
                                    <td align="right" style="color: #475569; border-bottom: 1px solid #f1f5f9;">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</td>
                                    <td align="right" style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #f1f5f9;">
                                        Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? ($item['qty'] ?? 1)), 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr style="background-color: #f8fafc;">
                                    <td colspan="3" align="right" style="font-weight: 800; color: #0f172a; font-size: 13px;">TOTAL PEMBAYARAN:</td>
                                    <td align="right" style="font-weight: 900; color: #006830; font-size: 15px;">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Payment & Action Buttons -->
                            <div style="text-align: center; margin-top: 24px;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block; margin-right: 8px;">
                                    📦 Buka &amp; Proses Pesanan di Admin
                                </a>
                                @php
                                    $buyerWa = preg_replace('/[^0-9]/', '', $order->customer_phone);
                                    if (str_starts_with($buyerWa, '0')) { $buyerWa = '62' . substr($buyerWa, 1); }
                                    $waBuyerLink = "https://wa.me/{$buyerWa}?text=" . urlencode("Halo {$order->customer_name}, kami dari Redaksi PERSIS PERS mengonfirmasi pesanan buku Anda #{$order->order_number}.");
                                @endphp
                                <a href="{{ $waBuyerLink }}" target="_blank" style="background-color: #25D366; color: #ffffff; padding: 12px 20px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block;">
                                    💬 Hubungi Pembeli via WhatsApp
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px 32px; text-align: center; font-size: 11px; color: #64748b;">
                            <div>Email notifikasi sistem otomatis &bull; <strong>PERSIS PERS (Penerbitan &amp; Percetakan)</strong></div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
