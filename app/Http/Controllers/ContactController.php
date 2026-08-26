<?php

namespace App\Http\Controllers;

use App\Mail\NewContactMessageMail;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $settings = [
            'banner_badge' => SiteSetting::get('contact_banner_badge', 'Layanan & Informasi'),
            'banner_title' => SiteSetting::get('contact_banner_title', 'Hubungi Kami & Layanan Redaksi'),
            'banner_desc' => SiteSetting::get('contact_banner_desc', 'Konsultasikan naskah buku, kebutuhan cetak, pengurusan ISBN, atau publikasi ilmiah bersama tim Persis Pers. Kami siap membantu Anda.'),

            'address' => SiteSetting::get('contact_address', 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287'),
            'whatsapp' => SiteSetting::get('contact_whatsapp', '082116116133'),
            'phone' => SiteSetting::get('contact_phone', '(022) 5441951'),
            'email' => SiteSetting::get('contact_email', 'penerbitan@iaipibandung.ac.id'),
            'email_note' => SiteSetting::get('contact_email_note', 'Respon cepat 1x24 jam kerja'),
            'hours' => SiteSetting::get('contact_hours', 'Senin – Jumat: 08:00 – 16:00 WIB'),
            'hours_weekend' => SiteSetting::get('contact_hours_weekend', 'Sabtu & Minggu: Tutup'),

            'wa_box_title' => SiteSetting::get('contact_wa_box_title', 'Konsultasi Cepat (WhatsApp)'),
            'wa_box_subtitle' => SiteSetting::get('contact_wa_box_subtitle', 'Langsung terhubung dengan Tim Redaksi'),
            'wa_box_desc' => SiteSetting::get('contact_wa_box_desc', 'Ingin konsultasi langsung terkait naskah buku, estimasi biaya cetak, atau panduan ISBN? Klik tombol di bawah untuk memulai chat WhatsApp resmi.'),
            'wa_btn_text' => SiteSetting::get('contact_wa_btn_text', 'CHAT WHATSAPP SEKARANG'),
            'wa_default_msg' => SiteSetting::get('contact_wa_default_msg', 'Halo Redaksi PERSIS PERS, saya ingin berkonsultasi mengenai penerbitan naskah buku.'),

            'maps_title' => SiteSetting::get('contact_maps_title', 'Lokasi Kampus & Percetakan'),
            'maps' => SiteSetting::get('contact_maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2974465063073!2d107.63660527587638!3d-6.974191668289417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9af8d8c919d%3A0xe96841b53fa976df!2sInstitut%20Agama%20Islam%20Persatuan%20Islam%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid'),
            'maps_external_url' => SiteSetting::get('contact_maps_external_url', 'https://maps.app.goo.gl/uXpW7mS6V8n5fF9w8'),
        ];

        return view('kontak', compact('settings'));
    }

        public function store(Request $request)
    {
        // 1. Anti-Spambot Honeypot
        if ($request->filled('website_hp_check')) {
            return back()->with('success', 'Pesan Anda telah diterima.');
        }

        // 2. Strict Input Validation
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone' => ['required', 'string', 'max:25'],
            'service_category' => ['required', 'string', 'max:100'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        // 3. Sanitization: Strip dangerous HTML/Script tags
        $sanitized = [
            'name' => strip_tags(trim($validated['name'])),
            'email' => filter_var(trim($validated['email']), FILTER_SANITIZE_EMAIL),
            'phone' => preg_replace('/[^0-9+() -]/', '', $validated['phone']),
            'service_category' => strip_tags(trim($validated['service_category'])),
            'subject' => !empty($validated['subject']) ? strip_tags(trim($validated['subject'])) : null,
            'message' => strip_tags(trim($validated['message'])),
        ];

        $contactMessage = ContactMessage::create($sanitized);

        // Send Email Notification to Recipient
        try {
            $recipient = SiteSetting::get('notification_recipient_email', 'hbudiman953@gmail.com');
            if (!empty($recipient)) {
                Mail::to($recipient)->send(new NewContactMessageMail($contactMessage));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending contact notification email: ' . $e->getMessage());
        }

        $waNumber = preg_replace('/[^0-9]/', '', SiteSetting::get('contact_whatsapp', '082116116133'));
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }

        $waText = urlencode("Halo Redaksi PERSIS PERS,
Saya *{$sanitized['name']}*
Layanan: *{$sanitized['service_category']}*
Subjek: {$sanitized['subject']}
Pesan: {$sanitized['message']}");
        $waRedirectUrl = "https://wa.me/{$waNumber}?text={$waText}";

        return back()->with('success', 'Pesan dan pengajuan Anda berhasil dikirim ke Redaksi!')
                     ->with('wa_url', $waRedirectUrl);
    }
}
