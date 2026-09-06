<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setel Ulang Kata Sandi - Penerbit PERSIS</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #334155;
            -webkit-text-size-adjust: 100%;
        }
        .container {
            max-width: 580px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #0a0f1d;
            padding: 24px;
            text-align: center;
            border-bottom: 3px solid #006830;
        }
        .header img {
            max-height: 48px;
            width: auto;
        }
        .content {
            padding: 32px 28px;
            font-size: 14px;
            line-height: 1.6;
        }
        .greeting {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .btn-container {
            text-align: center;
            margin: 28px 0;
        }
        .btn {
            display: inline-block;
            background-color: #006830;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 13px;
            border-radius: 3px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .notice {
            background-color: #f8fafc;
            border-left: 3px solid #006830;
            padding: 12px 14px;
            font-size: 12px;
            color: #64748b;
            margin-top: 20px;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
        .break-word {
            word-break: break-all;
            color: #006830;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2 style="color: #ffffff; margin: 0; font-size: 18px; letter-spacing: 1px; font-weight: 800;">
                PENERBIT PERSIS
            </h2>
            <p style="color: #94a3b8; margin: 4px 0 0 0; font-size: 11px;">Panel Administrasi &amp; Penerbitan</p>
        </div>

        <!-- Body Content -->
        <div class="content">
            <div class="greeting">Assalamu'alaikum Warahmatullahi Wabarakatuh, {{ $user->name }}</div>
            <p>
                Kami menerima permintaan untuk mengatur ulang kata sandi akun administrator Anda pada portal <strong>Penerbit PERSIS</strong>.
            </p>
            <p>
                Silakan klik tombol di bawah ini untuk melanjutkan pembuatan kata sandi baru:
            </p>

            <div class="btn-container">
                <a href="{{ $resetUrl }}" target="_blank" class="btn">
                    Setel Ulang Kata Sandi
                </a>
            </div>

            <div class="notice">
                <strong>Catatan Keamanan:</strong>
                <ul style="margin: 4px 0 0 0; padding-left: 18px;">
                    <li>Tautan ini hanya berlaku selama <strong>60 menit</strong> sejak email ini dikirim.</li>
                    <li>Jika Anda tidak merasa mengajukan permintaan ini, abaikan email ini. Akun Anda tetap aman.</li>
                </ul>
            </div>

            <p style="margin-top: 24px; font-size: 12px; color: #64748b;">
                Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut pada peramban web Anda:<br>
                <a href="{{ $resetUrl }}" class="break-word">{{ $resetUrl }}</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Penerbit PERSIS. Hak Cipta Dilindungi.<br>
            Sistem Informasi Penerbitan &amp; Layanan Buku
        </div>
    </div>
</body>
</html>
