<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function contact()
    {
        $settings = [
            // Email Notification Recipient
            'notification_recipient_email' => SiteSetting::get('notification_recipient_email', 'hbudiman953@gmail.com'),

            // Banner
            'contact_banner_badge' => SiteSetting::get('contact_banner_badge', 'Layanan & Informasi'),
            'contact_banner_title' => SiteSetting::get('contact_banner_title', 'Hubungi Kami & Layanan Redaksi'),
            'contact_banner_desc' => SiteSetting::get('contact_banner_desc', 'Konsultasikan naskah buku, kebutuhan cetak, pengurusan ISBN, atau publikasi ilmiah bersama tim Persis Pers. Kami siap membantu Anda.'),
            
            // 4 Info Cards
            'contact_address' => SiteSetting::get('contact_address', 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287'),
            'contact_whatsapp' => SiteSetting::get('contact_whatsapp', '082116116133'),
            'contact_phone' => SiteSetting::get('contact_phone', '(022) 5441951'),
            'contact_email' => SiteSetting::get('contact_email', 'penerbitan@iaipibandung.ac.id'),
            'contact_email_note' => SiteSetting::get('contact_email_note', 'Respon cepat 1x24 jam kerja'),
            'contact_hours' => SiteSetting::get('contact_hours', 'Senin – Jumat: 08:00 – 16:00 WIB'),
            'contact_hours_weekend' => SiteSetting::get('contact_hours_weekend', 'Sabtu & Minggu: Tutup'),

            // Fast WA Consultation Box
            'contact_wa_box_title' => SiteSetting::get('contact_wa_box_title', 'Konsultasi Cepat (WhatsApp)'),
            'contact_wa_box_subtitle' => SiteSetting::get('contact_wa_box_subtitle', 'Langsung terhubung dengan Tim Redaksi'),
            'contact_wa_box_desc' => SiteSetting::get('contact_wa_box_desc', 'Ingin konsultasi langsung terkait naskah buku, estimasi biaya cetak, atau panduan ISBN? Klik tombol di bawah untuk memulai chat WhatsApp resmi.'),
            'contact_wa_btn_text' => SiteSetting::get('contact_wa_btn_text', 'CHAT WHATSAPP SEKARANG'),
            'contact_wa_default_msg' => SiteSetting::get('contact_wa_default_msg', 'Halo Redaksi PERSIS PERS, saya ingin berkonsultasi mengenai penerbitan naskah buku.'),

            // Google Maps
            'contact_maps_title' => SiteSetting::get('contact_maps_title', 'Lokasi Kampus & Percetakan'),
            'contact_maps' => SiteSetting::get('contact_maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2974465063073!2d107.63660527587638!3d-6.974191668289417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9af8d8c919d%3A0xe96841b53fa976df!2sInstitut%20Agama%20Islam%20Persatuan%20Islam%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid'),
            'contact_maps_external_url' => SiteSetting::get('contact_maps_external_url', 'https://maps.app.goo.gl/uXpW7mS6V8n5fF9w8'),
        ];

        return view('admin.settings.contact', compact('settings'));
    }

    public function updateContact(Request $request)
    {
        $validated = $request->validate([
            // Notification Email
            'notification_recipient_email' => ['required', 'email'],

            // Banner
            'contact_banner_badge' => ['required', 'string', 'max:100'],
            'contact_banner_title' => ['required', 'string', 'max:255'],
            'contact_banner_desc' => ['required', 'string'],

            // 4 Info Cards
            'contact_address' => ['required', 'string'],
            'contact_whatsapp' => ['required', 'string', 'max:50'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'contact_email' => ['required', 'email', 'max:100'],
            'contact_email_note' => ['nullable', 'string', 'max:100'],
            'contact_hours' => ['required', 'string', 'max:100'],
            'contact_hours_weekend' => ['nullable', 'string', 'max:100'],

            // Fast WA Box
            'contact_wa_box_title' => ['required', 'string', 'max:150'],
            'contact_wa_box_subtitle' => ['required', 'string', 'max:150'],
            'contact_wa_box_desc' => ['required', 'string'],
            'contact_wa_btn_text' => ['required', 'string', 'max:100'],
            'contact_wa_default_msg' => ['required', 'string'],

            // Maps
            'contact_maps_title' => ['required', 'string', 'max:150'],
            'contact_maps' => ['required', 'string'],
            'contact_maps_external_url' => ['nullable', 'string'],
        ]);

        $mapsInput = $validated['contact_maps'];
        if (str_contains($mapsInput, 'src=')) {
            $parts = explode('src=', $mapsInput);
            if (isset($parts[1])) {
                $quote = $parts[1][0];
                if ($quote === '"' || $quote === "'") {
                    $urlParts = explode($quote, substr($parts[1], 1));
                    $validated['contact_maps'] = $urlParts[0];
                }
            }
        }

        foreach ($validated as $key => $val) {
            SiteSetting::set($key, $val);
        }

        return back()->with('success', 'Semua pengaturan halaman kontak dan email notifikasi berhasil disimpan!');
    }
}
