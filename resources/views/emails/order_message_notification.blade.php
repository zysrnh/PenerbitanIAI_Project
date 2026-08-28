<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Baru Pesanan #{{ $order->order_number }}</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #e2e8f0; margin: 0; padding: 30px 15px; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <!-- Formal Letter Container -->
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

                    <!-- Notification Banner -->
                    <tr>
                        <td style="padding: 24px 36px 12px;">
                            <div style="background-color: #f0fdf4; border-left: 4px solid #006830; padding: 14px 18px; border: 1px solid #bbf7d0; border-left-width: 4px;">
                                <div style="font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase; letter-spacing: 0.5px;">PESAN DISKUSI PESANAN</div>
                                <div style="font-size: 16px; font-weight: 800; color: #064e3b; margin-top: 2px;">
                                    💬 Pesan Baru untuk Invoice #{{ $order->order_number }}
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 12px 36px 28px;">
                            <p style="font-size: 14px; line-height: 1.6; color: #334155; margin-top: 0;">
                                @if($recipientType === 'admin')
                                    Halo <strong>Tim Redaksi PERSIS PERS</strong>, pembeli <strong>{{ $order->customer_name }}</strong> telah mengirimkan pesan terkait pesanan <strong>#{{ $order->order_number }}</strong>:
                                @else
                                    Yth. <strong>{{ $order->customer_name }}</strong>, Tim Redaksi <strong>PERSIS PERS</strong> telah mengirimkan pesan / informasi terbaru mengenai pesanan buku Anda (Invoice <strong>#{{ $order->order_number }}</strong>):
                                @endif
                            </p>

                            <!-- Message Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-left: 4px solid #006830; padding: 16px 20px; margin: 18px 0; border-radius: 2px;">
                                <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; margin-bottom: 6px;">
                                    Pengirim: <span style="color: #0f172a;">{{ $orderMessage->sender_name ?: ($orderMessage->sender_type === 'admin' ? 'Admin Redaksi PERSIS PERS' : $order->customer_name) }}</span> &bull; <span style="font-weight: normal; color: #94a3b8;">{{ $orderMessage->created_at->format('d M Y, H:i') }} WIB</span>
                                </div>
                                <div style="font-size: 14px; line-height: 1.6; color: #1e293b; white-space: pre-line;">
                                    {{ $orderMessage->message }}
                                </div>

                                @if($orderMessage->shared_shipping_status)
                                    <div style="margin-top: 12px; padding: 10px 14px; background-color: #ffffff; border: 1px solid #cbd5e1; font-size: 12.5px;">
                                        <strong style="color: #006830;">🚚 Update Status Pengiriman:</strong>
                                        <span style="text-transform: capitalize; color: #0f172a; font-weight: bold;">
                                            {{ str_replace('_', ' ', $orderMessage->shared_shipping_status) }}
                                        </span>
                                        @if($orderMessage->shared_tracking_number)
                                            &bull; No. Resi: <code style="font-weight: bold; color: #006830;">{{ $orderMessage->shared_tracking_number }}</code>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <div style="text-align: center; margin-top: 24px;">
                                @if($recipientType === 'admin')
                                    <a href="{{ route('admin.orders.show', $order->id) }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block;">
                                        💬 Balas Pesan di Admin &rarr;
                                    </a>
                                @else
                                    <a href="{{ route('member.orders') }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 12px 24px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block; margin-right: 8px;">
                                        💬 Buka Diskusi &amp; Balas Pesan
                                    </a>
                                    <a href="{{ route('order.invoice', $order->order_number) }}" target="_blank" style="background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; padding: 12px 18px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block;">
                                        📄 Buka Invoice
                                    </a>
                                @endif
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
