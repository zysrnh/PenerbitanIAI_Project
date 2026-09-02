<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\NewContactMessageMail;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ResellerController extends Controller
{
    /**
     * Display the Reseller & Agen information and registration page.
     */
    public function index()
    {
        $settings = [
            'contact_whatsapp' => SiteSetting::get('contact_whatsapp', '082116116133'),
            'contact_phone' => SiteSetting::get('contact_phone', '(022) 5441951'),
            'contact_email' => SiteSetting::get('contact_email', 'info@penerbitpersis.com'),
            'contact_address' => SiteSetting::get('contact_address', 'Kantor Redaksi PERSIS PERS, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287'),
        ];

        return view('reseller', compact('settings'));
    }

    /**
     * Handle incoming reseller registration form submission.
     * Saves to Admin database (ContactMessage) and sends email notification.
     */
    public function store(Request $request)
    {
        // 1. Anti-Spambot Honeypot
        if ($request->filled('website_hp_check')) {
            return back()->with('success', 'Formulir pendaftaran Anda telah diterima.');
        }

        // 2. Strict Input Validation
        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:150'],
            'phone'         => ['required', 'string', 'max:30'],
            'email'         => ['nullable', 'email', 'max:150'],
            'business_name' => ['nullable', 'string', 'max:200'],
            'category'      => ['required', 'string', 'max:100'],
            'address'       => ['required', 'string', 'max:2000'],
            'notes'         => ['nullable', 'string', 'max:2000'],
        ], [
            'name.required'     => 'Nama lengkap pemohon wajib diisi.',
            'phone.required'    => 'Nomor WhatsApp aktif wajib diisi.',
            'category.required' => 'Kategori calon reseller wajib dipilih.',
            'address.required'  => 'Alamat lengkap pengiriman wajib diisi.',
        ]);

        // 3. Sanitization
        $name     = strip_tags(trim($validated['name']));
        $phone    = preg_replace('/[^0-9+() -]/', '', $validated['phone']);
        $email    = !empty($validated['email']) ? filter_var(trim($validated['email']), FILTER_SANITIZE_EMAIL) : (preg_replace('/[^0-9]/', '', $phone) . '@reseller.penerbitpersis.com');
        $business = !empty($validated['business_name']) ? strip_tags(trim($validated['business_name'])) : '-';
        $category = strip_tags(trim($validated['category']));
        $address  = strip_tags(trim($validated['address']));
        $notes    = !empty($validated['notes']) ? strip_tags(trim($validated['notes'])) : '-';

        $fullMessage = "PENDAFTARAN RESELLER & AGEN BARU:\n\n" .
                       "• Nama Pemohon: {$name}\n" .
                       "• No. WhatsApp: {$phone}\n" .
                       "• Email: " . (!empty($validated['email']) ? $validated['email'] : 'Tidak dicantumkan') . "\n" .
                       "• Usaha / Toko / Lembaga: {$business}\n" .
                       "• Kategori Kemitraan: {$category}\n" .
                       "• Alamat Lengkap & Kota: {$address}\n" .
                       "• Catatan Tambahan: {$notes}";

        // 4. Save to Admin Database (ContactMessage)
        $contactMessage = ContactMessage::create([
            'name'             => $name,
            'email'            => $email,
            'phone'            => $phone,
            'service_category' => 'Pendaftaran Reseller & Agen',
            'subject'          => "Pendaftaran Reseller Baru: {$name} ({$category})",
            'message'          => $fullMessage,
        ]);

        // 5. Send Email Notification to the configured recipient email
        try {
            $recipient = SiteSetting::get('notification_recipient_email', 'zakiyh782@gmail.com');
            if (!empty($recipient)) {
                Mail::to($recipient)->send(new NewContactMessageMail($contactMessage));
            }
        } catch (\Throwable $e) {
            Log::error('Failed sending reseller notification email: ' . $e->getMessage());
        }

        // 6. Build WhatsApp URL
        $waNumber = preg_replace('/[^0-9]/', '', SiteSetting::get('contact_whatsapp', '082116116133'));
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }

        $waText = urlencode("*PENDAFTARAN RESELLER PENERBIT PERSIS*\n\n" .
            "*Nama Pemohon:* {$name}\n" .
            "*Nomor WhatsApp:* {$phone}\n" .
            "*Email:* " . (!empty($validated['email']) ? $validated['email'] : '-') . "\n" .
            "*Nama Usaha/Lembaga:* {$business}\n" .
            "*Kategori:* {$category}\n" .
            "*Alamat Lengkap:* {$address}\n" .
            "*Catatan:* {$notes}\n\n" .
            "_Saya telah membaca 12 Ketentuan Reseller dan ingin mendaftar menjadi reseller resmi Penerbit Persis._");

        $waRedirectUrl = "https://wa.me/{$waNumber}?text={$waText}";

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran Reseller berhasil dikirim! Data telah tersimpan di sistem admin dan notifikasi email telah diteruskan ke Redaksi.',
                'wa_url'  => $waRedirectUrl,
                'data'    => [
                    'name'     => $name,
                    'phone'    => $phone,
                    'category' => $category,
                    'business' => $business,
                ],
            ]);
        }

        return back()->with('success', 'Formulir pendaftaran Reseller berhasil dikirim! Data telah tersimpan di sistem admin dan notifikasi email telah diteruskan ke Redaksi.')
                     ->with('wa_url', $waRedirectUrl);
    }
}
