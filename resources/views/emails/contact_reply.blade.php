<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $replySubject }}</title>
    <style>
        body { font-family: 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 20px; color: #1e293b; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .header { background: #006830; padding: 24px 30px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 20px; font-weight: 800; letter-spacing: 0.5px; }
        .header p { margin: 4px 0 0; font-size: 12px; color: #bbf7d0; }
        .content { padding: 30px; }
        .salutation { font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; }
        .body-text { font-size: 14px; line-height: 1.7; color: #334155; white-space: pre-line; margin-bottom: 24px; }
        .original-box { background: #f1f5f9; border-left: 4px solid #006830; padding: 14px 18px; border-radius: 4px; margin-top: 20px; font-size: 12.5px; color: #475569; }
        .original-title { font-weight: bold; color: #0f172a; margin-bottom: 6px; font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.5px; }
        .footer { background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 20px 30px; text-align: center; font-size: 11.5px; color: #64748b; }
        .btn-wa { display: inline-block; background: #25D366; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; font-size: 13px; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>PERSIS PERS</h1>
            <p>Penerbitan &amp; Percetakan IAI Persis Bandung</p>
        </div>

        <div class="content">
            <div class="salutation">
                Yth. {{ $contactMessage->name }},
            </div>

            <div class="body-text">
{{ $replyBody }}
            </div>

            <div style="margin-top: 25px; padding-top: 15px; border-top: 1px dashed #cbd5e1;">
                <p style="margin: 0; font-size: 13px; font-weight: bold; color: #0f172a;">Tim Redaksi PERSIS PERS</p>
                <p style="margin: 2px 0 0; font-size: 12px; color: #64748b;">Pengirim: {{ $adminName }} (Redaksi)</p>
            </div>

            <!-- Original Message Quote -->
            <div class="original-box">
                <div class="original-title">📌 Kutipan Pesan Pengajuan Anda:</div>
                <div style="font-style: italic; line-height: 1.5;">
                    "{{ $contactMessage->message }}"
                </div>
                <div style="margin-top: 8px; font-size: 11px; color: #94a3b8;">
                    Layanan: <strong>{{ $contactMessage->service_category ?? 'Konsultasi' }}</strong> | Tanggal: {{ $contactMessage->created_at->format('d/m/Y H:i') }} WIB
                </div>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0;">Email ini dikirim resmi oleh Tim Redaksi PERSIS PERS.</p>
            <p style="margin: 4px 0 0;">Institut Agama Islam Persatuan Islam Bandung (IAI Persis Bandung)</p>
            <p style="margin: 4px 0 0;">Website: <a href="{{ url('/') }}" style="color: #006830; text-decoration: none; font-weight: bold;">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>
