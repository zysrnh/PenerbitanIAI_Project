<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Notifikasi Pesan Masuk | PERSIS PERS</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #f1f5f9; margin: 0; padding: 24px; color: #1e293b;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #032c21; padding: 24px 32px; color: #ffffff; text-align: left;">
                            <span style="color: #4ade80; font-size: 11px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 4px;">PERSIS PERS</span>
                            <h1 style="color: #ffffff; font-size: 20px; font-weight: bold; margin: 0; padding: 0;">Pengajuan Naskah & Pesan Baru Masuk</h1>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px;">
                            <p style="font-size: 14px; line-height: 1.6; color: #475569; margin-top: 0;">
                                Halo Tim Redaksi, ada pesan / pengajuan naskah baru yang masuk melalui formulir kontak website <strong>PERSIS PERS</strong>:
                            </p>

                            <!-- Information Card -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; margin: 20px 0; font-size: 13px;">
                                <tr>
                                    <td width="35%" style="color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Nama Pengirim</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->name }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Alamat Email</td>
                                    <td style="color: #0f172a; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->email }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">No. WhatsApp / HP</td>
                                    <td style="color: #15803d; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Kategori Layanan</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #e2e8f0;">
                                        <span style="background-color: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 4px; font-size: 11px;">
                                            {{ $contactMessage->service_category ?? 'Umum' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; border-bottom: 1px solid #e2e8f0;">Subjek / Judul</td>
                                    <td style="color: #0f172a; font-weight: bold; border-bottom: 1px solid #e2e8f0;">{{ $contactMessage->subject ?: 'Konsultasi Naskah' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #64748b; font-weight: bold; vertical-align: top;">Isi Pesan</td>
                                    <td style="color: #334155; line-height: 1.5; white-space: pre-line;">{{ $contactMessage->message }}</td>
                                </tr>
                            </table>

                            <!-- Action Buttons -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 24px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $contactMessage->wa_link }}" target="_blank" style="background-color: #25D366; color: #ffffff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block; margin-right: 12px;">
                                            💬 Balas Langsung via WhatsApp
                                        </a>
                                        <a href="{{ route('admin.messages.show', $contactMessage) }}" target="_blank" style="background-color: #0f172a; color: #ffffff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: bold; display: inline-block;">
                                            🔎 Buka di Admin Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 11px; color: #94a3b8; margin-top: 32px; text-align: center; border-top: 1px solid #f1f5f9; padding-top: 16px;">
                                Email ini dikirim secara otomatis oleh Sistem Administrasi Website PERSIS PERS.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
