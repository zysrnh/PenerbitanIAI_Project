<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan &amp; Pengajuan Naskah Masuk | PERSIS PERS</title>
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
                            <div style="background-color: #f8fafc; border-left: 4px solid #006830; padding: 12px 16px;">
                                <div style="font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">NOTIFIKASI REDAKSI</div>
                                <div style="font-size: 16px; font-weight: 800; color: #0f172a; margin-top: 2px;">Pengajuan Naskah &amp; Pesan Baru Masuk</div>
                            </div>
                        </td>
                    </tr>

                    <!-- Main Body Table -->
                    <tr>
                        <td style="padding: 12px 36px 28px;">
                            <p style="font-size: 13.5px; line-height: 1.6; color: #334155; margin-top: 0; margin-bottom: 18px;">
                                Halo Tim Redaksi PERSIS PERS, ada pesan atau pengajuan naskah baru yang masuk melalui formulir kontak website resmi:
                            </p>

                            <!-- Information Table -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="10" style="border: 1px solid #e2e8f0; font-size: 13px; margin-bottom: 24px;">
                                <tr>
                                    <td width="32%" style="background-color: #f8fafc; color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Tanggal &amp; Waktu</td>
                                    <td style="color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->created_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8fafc; color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Nama Pengirim</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->name }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8fafc; color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Alamat Email</td>
                                    <td style="color: #0f172a; border-bottom: 1px solid #e2e8f0;">
                                        <a href="mailto:{{ $contactMessage->email }}" style="color: #006830; text-decoration: none; font-weight: bold;">{{ $contactMessage->email }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8fafc; color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">No. WhatsApp / HP</td>
                                    <td style="color: #006830; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->phone ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8fafc; color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Layanan Dipilih</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->service_category ?? 'Konsultasi Umum' }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8fafc; color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Subjek / Topik</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->subject ?: 'Pengajuan Naskah' }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8fafc; color: #64748b; font-weight: bold; vertical-align: top;">Isi Pesan / Keterangan</td>
                                    <td style="color: #1e293b; line-height: 1.7; white-space: pre-line;">{{ $contactMessage->message }}</td>
                                </tr>
                            </table>

                            <!-- Action Buttons -->
                            <div style="text-align: center; margin-top: 24px;">
                                <a href="{{ route('admin.messages.show', $contactMessage) }}" target="_blank" style="background-color: #006830; color: #ffffff; padding: 12px 22px; text-decoration: none; font-size: 12.5px; font-weight: bold; display: inline-block; margin-right: 8px;">
                                    Buka di Admin Dashboard &amp; Balas Email &rarr;
                                </a>
                                @if($contactMessage->phone)
                                    <a href="{{ $contactMessage->wa_link }}" target="_blank" style="background-color: #25D366; color: #ffffff; padding: 12px 18px; text-decoration: none; font-size: 12.5px; font-weight: bold; display: inline-block;">
                                        Hubungi via WhatsApp
                                    </a>
                                @endif
                            </div>

                        </td>
                    </tr>

                    <!-- Official Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; border-top: 1px solid #e2e8f0; padding: 18px 36px; text-align: center; font-size: 11px; color: #64748b; line-height: 1.5;">
                            <div>Email notifikasi otomatis ini dikirimkan oleh <strong>Sistem Administrasi Website PERSIS PERS</strong>.</div>
                            <div style="margin-top: 4px; color: #94a3b8;">&copy; {{ date('Y') }} PERSIS PERS &bull; Penerbitan &amp; Percetakan PERSIS PERS. Seluruh hak cipta dilindungi undang-undang.</div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
