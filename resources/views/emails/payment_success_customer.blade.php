<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil #{{ $order->order_number }}</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #e2e8f0; margin: 0; padding: 30px 15px; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="650" border="0" cellspacing="0" cellpadding="0" style="max-width: 650px; width: 100%; background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);">
                    
                    <!-- Official Letterhead Header -->
                    <tr>
                        <td style="padding: 28px 36px 20px; background-color: #ffffff;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="75" valign="middle" style="padding-right: 18px;">
                                        @php
                                            $logoPath = public_path('images/logo/logo_penerbit_persis_emblem.png');
                                            $logoSrc = (isset($message) && is_object($message) && method_exists($message, 'embed') && file_exists($logoPath)) 
                                                ? $message->embed($logoPath) 
                                                : url('images/logo/logo_penerbit_persis_emblem.png');
                                        @endphp
                                        <img src="{{ $logoSrc }}" alt="PERSIS PERS" width="70" style="display: block; width: 70px; height: auto; border: 0;" />
                                    </td>
                                    <td valign="middle" style="text-align: left;">
                                        <div style="font-size: 20px; font-weight: 800; color: #006830; letter-spacing: 0.5px; line-height: 1.2; text-transform: uppercase;">
                                            PERSIS PERS
                                        </div>
                                        <div style="font-size: 13px; font-weight: 700; color: #0f172a; margin-top: 2px;">
                                            Penerbitan &amp; Percetakan PERSIS PERS
                                        </div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 4px; line-height: 1.4;">
                                            {{ \App\Models\SiteSetting::get('contact_address', 'Kantor Redaksi PERSIS PERS, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287') }}<br>
                                            Telepon/WhatsApp: {{ \App\Models\SiteSetting::get('contact_whatsapp', '082116116133') }} | Email: {{ \App\Models\SiteSetting::get('contact_email', 'info@penerbitpersis.com') }}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Formal Double Divider Line -->
                    <tr>
                        <td style="padding: 0 36px;">
                            <div style="border-top: 3px solid #006830; border-bottom: 1px solid #006830; height: 3px;"></div>
                        </td>
                    </tr>

                    <!-- Notice Banner -->
                    <tr>
                        <td style="padding: 24px 36px 12px;">
                            <div style="background-color: #f0fdf4; border-left: 4px solid #16a34a; padding: 14px 18px; border: 1px solid #bbf7d0; border-left-width: 4px;">
                                <div style="font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase; letter-spacing: 0.5px;">KONFIRMASI PEMBAYARAN LUNAS</div>
                                <div style="font-size: 16px; font-weight: 800; color: #064e3b; margin-top: 2px;">
                                    Pembayaran Anda Telah Berhasil Diterima
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 12px 36px 28px;">
                            <p style="font-size: 14px; line-height: 1.7; color: #334155; margin-top: 0;">
                                Yth. <strong>{{ $order->customer_name }}</strong>,<br><br>
                                Terima kasih telah berbelanja di <strong>PERSIS PERS</strong>. Pembayaran untuk pesanan buku Anda dengan nomor invoice <strong>#{{ $order->order_number }}</strong> telah berhasil diverifikasi oleh sistem kami.
                            </p>

                            <!-- Items Table -->
                            @php
                                $items = is_array($order->items_json) ? $order->items_json : json_decode($order->items_json ?? '[]', true);
                            @endphp
                            <table width="100%" border="0" cellspacing="0" cellpadding="8" style="border: 1px solid #e2e8f0; font-size: 12.5px; margin: 18px 0;">
                                <tr style="background-color: #f8fafc;">
                                    <th align="left" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Judul Buku</th>
                                    <th align="center" width="60" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Qty</th>
                                    <th align="right" width="110" style="font-weight: 800; color: #0f172a; border-bottom: 1px solid #e2e8f0;">Total</th>
                                </tr>
                                @foreach($items as $item)
                                <tr>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #f1f5f9;">{{ $item['title'] ?? 'Buku' }}</td>
                                    <td align="center" style="color: #475569; border-bottom: 1px solid #f1f5f9;">{{ $item['quantity'] ?? ($item['qty'] ?? 1) }}</td>
                                    <td align="right" style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #f1f5f9;">
                                        Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? ($item['qty'] ?? 1)), 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                                <tr style="background-color: #f0fdf4;">
                                    <td colspan="2" align="right" style="font-weight: 800; color: #166534; font-size: 13px;">TOTAL LUNAS (QRIS):</td>
                                    <td align="right" style="font-weight: 900; color: #15803d; font-size: 14px;">
                                        {{ $order->formatted_payment }}
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 13px; line-height: 1.6; color: #475569;">
                                Pesanan Anda saat ini sedang disiapkan dan dipacking oleh tim ekspedisi kami untuk segera dikirimkan ke alamat Anda.
                            </p>

                            <!-- Actions -->
                            <div style="text-align: center; margin-top: 24px;">
                                <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block; margin-right: 8px;">
                                    📄 Buka &amp; Cetak Invoice Resmi
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 18px 36px; text-align: center; font-size: 11px; color: #64748b; line-height: 1.5;">
                            <div>&copy; {{ date('Y') }} PERSIS PERS &bull; Penerbitan &amp; Percetakan PERSIS PERS. Seluruh hak cipta dilindungi undang-undang.</div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
