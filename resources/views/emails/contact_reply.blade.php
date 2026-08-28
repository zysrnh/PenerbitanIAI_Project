<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $replySubject }}</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #e2e8f0; margin: 0; padding: 30px 15px; color: #1e293b; -webkit-font-smoothing: antialiased;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <!-- Formal Letter Container (Sharp edges, no rounded) -->
                <table width="650" border="0" cellspacing="0" cellpadding="0" style="max-width: 650px; width: 100%; background-color: #ffffff; border: 1px solid #cbd5e1; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.08);">
                    
                    <!-- Official Letterhead Header -->
                    <tr>
                        <td style="padding: 28px 36px 20px; background-color: #ffffff;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <!-- Official Logo Emblem -->
                                    <td width="75" valign="middle" style="padding-right: 18px;">
                                        <img src="{{ asset('images/logo/logo_penerbit_persis_emblem.png') }}" alt="PERSIS PERS" width="70" style="display: block; width: 70px; height: auto;" />
                                    </td>
                                    <!-- Institutional Identity Text -->
                                    <td valign="middle" style="text-align: left;">
                                        <div style="font-size: 20px; font-weight: 800; color: #006830; letter-spacing: 0.5px; line-height: 1.2; text-transform: uppercase;">
                                            PERSIS PERS
                                        </div>
                                        <div style="font-size: 13px; font-weight: 700; color: #0f172a; margin-top: 2px;">
                                            Penerbitan &amp; Percetakan IAI Persis Bandung
                                        </div>
                                        <div style="font-size: 11px; color: #64748b; margin-top: 4px; line-height: 1.4;">
                                            {{ \App\Models\SiteSetting::get('contact_address', 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287') }}<br>
                                            Telepon/WhatsApp: {{ \App\Models\SiteSetting::get('contact_whatsapp', '082116116133') }} | Email: {{ \App\Models\SiteSetting::get('contact_email', 'penerbitan@iaipibandung.ac.id') }}
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

                    <!-- Letter Metadata (Tanggal & Perihal) -->
                    <tr>
                        <td style="padding: 24px 36px 12px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size: 12.5px; color: #475569;">
                                <tr>
                                    <td width="70" style="font-weight: bold; color: #0f172a; padding-bottom: 6px;">Tanggal</td>
                                    <td width="15" style="padding-bottom: 6px;">:</td>
                                    <td style="color: #334155; padding-bottom: 6px;">{{ now()->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; color: #0f172a; padding-bottom: 6px;">Kepada</td>
                                    <td style="padding-bottom: 6px;">:</td>
                                    <td style="font-weight: bold; color: #0f172a; padding-bottom: 6px;">{{ $contactMessage->name }} &lt;{{ $contactMessage->email }}&gt;</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; color: #0f172a;">Perihal</td>
                                    <td>:</td>
                                    <td style="font-weight: bold; color: #006830;">{{ $replySubject }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 36px;">
                            <div style="border-top: 1px solid #f1f5f9; margin: 12px 0;"></div>
                        </td>
                    </tr>

                    <!-- Letter Body -->
                    <tr>
                        <td style="padding: 12px 36px 28px;">
                            <div style="font-size: 14px; line-height: 1.8; color: #1e293b; white-space: pre-line; text-align: justify;">
{{ $replyBody }}
                            </div>

                            <!-- Formal Closing Signature -->
                            <div style="margin-top: 32px; text-align: left;">
                                <div style="font-size: 13px; color: #475569;">Hormat kami,</div>
                                <div style="font-size: 14px; font-weight: 800; color: #0f172a; margin-top: 6px;">{{ $adminName }}</div>
                                <div style="font-size: 12.5px; font-weight: 600; color: #006830;">Tim Redaksi &amp; Penerbitan PERSIS PERS</div>
                                <div style="font-size: 11.5px; color: #64748b;">Institut Agama Islam Persatuan Islam Bandung</div>
                            </div>

                            <!-- Reference to Original Message -->
                            <div style="margin-top: 32px; border: 1px solid #e2e8f0; background-color: #f8fafc; padding: 14px 18px;">
                                <div style="font-size: 11px; font-weight: 800; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">
                                    Lampiran / Kutipan Pesan Asli Anda:
                                </div>
                                <div style="font-size: 12.5px; font-style: italic; color: #475569; line-height: 1.6; background-color: #ffffff; padding: 10px 14px; border: 1px solid #e2e8f0;">
                                    "{{ $contactMessage->message }}"
                                </div>
                                <div style="margin-top: 8px; font-size: 11px; color: #94a3b8;">
                                    Layanan: <strong>{{ $contactMessage->service_category ?? 'Konsultasi Naskah' }}</strong> &bull; Diterima pada: {{ $contactMessage->created_at->format('d/m/Y H:i') }} WIB
                                </div>
                            </div>

                            <!-- Fast Follow-up WhatsApp Link -->
                            @php
                                $waNumber = preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('contact_whatsapp', '6282116116133'));
                                if (str_starts_with($waNumber, '0')) { $waNumber = '62' . substr($waNumber, 1); }
                                $waLink = "https://wa.me/{$waNumber}?text=" . urlencode("Halo Tim Redaksi PERSIS PERS, saya ingin menindaklanjuti balasan email terkait: " . ($contactMessage->subject ?: 'Pengajuan Naskah'));
                            @endphp
                            <div style="margin-top: 24px; text-align: left;">
                                <a href="{{ $waLink }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 10px 18px; text-decoration: none; font-size: 12px; font-weight: bold; display: inline-block;">
                                    Hubungi Redaksi via WhatsApp &rarr;
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Official Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 18px 36px; text-align: center; font-size: 11px; color: #64748b; line-height: 1.5;">
                            <div>Surat elektronik resmi ini dikirimkan oleh <strong>Sistem Manajemen Redaksi PERSIS PERS</strong>.</div>
                            <div style="margin-top: 4px; color: #94a3b8;">&copy; {{ date('Y') }} PERSIS PERS &bull; Institut Agama Islam Persatuan Islam Bandung. Seluruh hak cipta dilindungi undang-undang.</div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
