<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Diterima #{{ $order->order_number }}</title>
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

                    <!-- Notice Title -->
                    <tr>
                        <td style="padding: 24px 36px 12px;">
                            <div style="background-color: #f0fdf4; border-left: 4px solid #16a34a; padding: 14px 18px; border: 1px solid #bbf7d0; border-left-width: 4px;">
                                <div style="font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase; letter-spacing: 0.5px;">NOTIFIKASI PEMBAYARAN DITERIMA</div>
                                <div style="font-size: 16px; font-weight: 800; color: #064e3b; margin-top: 2px;">
                                    💰 QRIS LUNAS: #{{ $order->order_number }} - {{ $order->customer_name }}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Main Body -->
                    <tr>
                        <td style="padding: 12px 36px 28px;">
                            <p style="font-size: 13.5px; line-height: 1.6; color: #334155; margin-top: 0; margin-bottom: 16px;">
                                Halo Tim Admin &amp; Ekspedisi PERSIS PERS, pembayaran QRIS untuk pesanan berikut telah <strong>LUNAS</strong> dan siap dipacking:
                            </p>

                            <!-- Buyer Info Card -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="8" style="background-color: #f8fafc; border: 1px solid #e2e8f0; font-size: 12.5px; margin-bottom: 18px;">
                                <tr>
                                    <td width="35%" style="color: #64748b; font-weight: bold; border-bottom: 1px solid #f1f5f9;">Nama Pembeli</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #f1f5f9;">WhatsApp</td>
                                    <td style="color: #006830; font-weight: bold; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_phone }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; vertical-align: top; border-bottom: 1px solid #f1f5f9;">Alamat Pengiriman</td>
                                    <td style="color: #334155; line-height: 1.5; border-bottom: 1px solid #f1f5f9;">{{ $order->customer_address }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold;">Total Pembayaran</td>
                                    <td style="color: #15803d; font-weight: 900; font-size: 14px;">{{ $order->formatted_payment }} (LUNAS)</td>
                                </tr>
                            </table>

                            <!-- Action Buttons -->
                            <div style="text-align: center; margin-top: 24px;">
                                <a href="{{ route('admin.orders.show', $order->id) }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block; margin-right: 8px;">
                                    📦 Proses Pengiriman di Admin &rarr;
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
