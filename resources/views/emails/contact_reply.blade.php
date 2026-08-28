<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $replySubject }}</title>
</head>
<body style="font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px 12px; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <!-- Main Card Container -->
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);">
                    
                    <!-- Top Accent Bar -->
                    <tr>
                        <td height="4" style="background: linear-gradient(90deg, #006830 0%, #15803d 50%, #d97706 100%);"></td>
                    </tr>

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #032c21; padding: 28px 32px; color: #ffffff; text-align: left;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>
                                        <div style="display: inline-block; background-color: rgba(74, 222, 128, 0.15); border: 1px solid rgba(74, 222, 128, 0.3); color: #4ade80; font-size: 10.5px; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase; padding: 3px 10px; border-radius: 4px; margin-bottom: 8px;">
                                            TANGGAPAN RESMI REDAKSI
                                        </div>
                                        <h1 style="color: #ffffff; font-size: 22px; font-weight: 800; margin: 0; padding: 0; letter-spacing: 0.5px; font-family: 'Segoe UI', Arial, sans-serif;">
                                            PERSIS PERS
                                        </h1>
                                        <p style="color: #cbd5e1; font-size: 12px; margin: 4px 0 0; font-weight: 500;">
                                            Penerbitan &amp; Percetakan IAI Persis Bandung
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px 32px 24px;">
                            
                            <!-- Subject Header Box -->
                            <div style="background-color: #f8fafc; border-left: 4px solid #006830; padding: 12px 16px; border-radius: 0 6px 6px 0; margin-bottom: 24px;">
                                <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; display: block;">Perihal:</span>
                                <span style="font-size: 14px; font-weight: 700; color: #0f172a;">{{ $replySubject }}</span>
                            </div>

                            <!-- Main Message Body -->
                            <div style="font-size: 14.5px; line-height: 1.8; color: #334155; white-space: pre-line; margin-bottom: 28px;">
{{ $replyBody }}
                            </div>

                            <!-- Official Signature Card -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px dashed #e2e8f0; padding-top: 20px; margin-top: 24px;">
                                <tr>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="42" valign="middle" style="padding-right: 12px;">
                                                    <div style="width: 42px; height: 42px; background-color: #006830; border-radius: 8px; text-align: center; line-height: 42px; color: #ffffff; font-weight: 900; font-size: 15px;">
                                                        PP
                                                    </div>
                                                </td>
                                                <td valign="middle">
                                                    <div style="font-size: 13.5px; font-weight: 800; color: #0f172a;">{{ $adminName }}</div>
                                                    <div style="font-size: 12px; color: #006830; font-weight: 600;">Tim Redaksi &amp; Penerbitan PERSIS PERS</div>
                                                    <div style="font-size: 11px; color: #64748b;">Institut Agama Islam Persatuan Islam Bandung</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Quote of Sender's Original Message -->
                            <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px 20px; margin-top: 28px;">
                                <div style="font-size: 11.5px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: flex; align-items: center;">
                                    📌 Kutipan Pesan Pengajuan Anda:
                                </div>
                                <div style="font-size: 13px; font-style: italic; color: #475569; line-height: 1.6; background-color: #ffffff; padding: 12px 16px; border-radius: 6px; border: 1px solid #f1f5f9;">
                                    "{{ $contactMessage->message }}"
                                </div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; font-size: 11px; color: #94a3b8;">
                                    <tr>
                                        <td>Layanan: <strong style="color: #475569;">{{ $contactMessage->service_category ?? 'Konsultasi' }}</strong></td>
                                        <td align="right">Tanggal: {{ $contactMessage->created_at->format('d/m/Y H:i') }} WIB</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Action Button: Lanjut WA -->
                            <div style="text-align: center; margin-top: 28px;">
                                @php
                                    $waNumber = preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('contact_whatsapp', '6282116116133'));
                                    if (str_starts_with($waNumber, '0')) { $waNumber = '62' . substr($waNumber, 1); }
                                    $waLink = "https://wa.me/{$waNumber}?text=" . urlencode("Halo Tim Redaksi PERSIS PERS, saya ingin menindaklanjuti balasan email terkait: " . ($contactMessage->subject ?: 'Pengajuan Naskah'));
                                @endphp
                                <a href="{{ $waLink }}" target="_blank" style="background-color: #25D366; color: #ffffff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 700; display: inline-block; box-shadow: 0 2px 4px rgba(37, 211, 102, 0.2);">
                                    💬 Lanjut Diskusi via WhatsApp Redaksi
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 24px 32px; text-align: center; font-size: 11.5px; color: #64748b; line-height: 1.6;">
                            <p style="margin: 0; font-weight: 700; color: #334155;">Kantor Redaksi PERSIS PERS</p>
                            <p style="margin: 2px 0 0;">{{ \App\Models\SiteSetting::get('contact_address', 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287') }}</p>
                            <p style="margin: 6px 0 0;">
                                WhatsApp: <strong style="color: #0f172a;">{{ \App\Models\SiteSetting::get('contact_whatsapp', '082116116133') }}</strong> &bull; 
                                Email: <strong style="color: #0f172a;">{{ \App\Models\SiteSetting::get('contact_email', 'penerbitan@iaipibandung.ac.id') }}</strong>
                            </p>
                            <p style="margin: 10px 0 0; font-size: 10.5px; color: #94a3b8;">
                                &copy; {{ date('Y') }} PERSIS PERS &bull; Institut Agama Islam Persatuan Islam Bandung. Hak Cipta Dilindungi.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
