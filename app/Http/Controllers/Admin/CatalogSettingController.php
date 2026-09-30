<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CatalogSettingController extends Controller
{
    /**
     * Helper to safely save uploaded QRIS file to all storage paths
     */
    private function saveUploadedFile($file, string $folder): string
    {
        $ext = strtolower($file->getClientOriginalExtension() ?: 'png');
        $filename = Str::random(30) . '.' . $ext;

        $primaryDir = storage_path('app/public/' . $folder);
        if (!file_exists($primaryDir)) {
            @mkdir($primaryDir, 0777, true);
        }

        $primaryFile = $primaryDir . '/' . $filename;
        $file->move($primaryDir, $filename);
        @chmod($primaryFile, 0644);

        $targetDirs = [
            public_path('storage/' . $folder),
            base_path('public_html/storage/' . $folder),
            base_path('../public_html/storage/' . $folder),
            '/home/persisp1/public_html/storage/' . $folder,
        ];

        foreach ($targetDirs as $dir) {
            if ($dir !== $primaryDir) {
                if (!file_exists($dir)) {
                    @mkdir($dir, 0777, true);
                }
                if (file_exists($dir)) {
                    $dest = $dir . '/' . $filename;
                    @copy($primaryFile, $dest);
                    @chmod($dest, 0644);
                }
            }
        }

        return 'storage/' . $folder . '/' . $filename;
    }

    public function index()
    {
        $settings = [
            'catalog_banner_badge'        => SiteSetting::get('catalog_banner_badge', 'PUBLIKASI RESMI BER-ISBN'),
            'catalog_banner_title'        => SiteSetting::get('catalog_banner_title', 'Katalog Buku & Karya Ilmiah'),
            'catalog_banner_desc'         => SiteSetting::get('catalog_banner_desc', 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.'),
            'catalog_stat_books'          => SiteSetting::get('catalog_stat_books', '150+ Judul Buku'),
            'catalog_stat_authors'        => SiteSetting::get('catalog_stat_authors', 'Karya Dosen & Peneliti'),
            'catalog_stat_isbn'           => SiteSetting::get('catalog_stat_isbn', 'ISBN Perpusnas'),
            'catalog_stat_print'          => SiteSetting::get('catalog_stat_print', 'Cetak Berkualitas'),
            'catalog_promo_title'         => SiteSetting::get('catalog_promo_title', 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis'),
            'catalog_promo_desc'          => SiteSetting::get('catalog_promo_desc', 'Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.'),
            'catalog_agenda_title'        => SiteSetting::get('catalog_agenda_title', 'Bedah Buku & Call for Book Chapters Dosen'),
            'catalog_agenda_desc'         => SiteSetting::get('catalog_agenda_desc', 'Terbuka untuk civitas akademika dan peneliti eksternal.'),
            'catalog_publish_box_title'   => SiteSetting::get('catalog_publish_box_title', 'Punya Naskah Buku Sendiri?'),
            'catalog_publish_box_desc'    => SiteSetting::get('catalog_publish_box_desc', 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.'),
            
            // Payment Switch & Manual QRIS Settings
            'catalog_payment_mode'        => SiteSetting::get('catalog_payment_mode', 'gateway'), // 'gateway' or 'manual'
            'catalog_manual_qris_image'   => SiteSetting::get('catalog_manual_qris_image', ''),
            'catalog_manual_bank_name'    => SiteSetting::get('catalog_manual_bank_name', 'Bank Syariah Indonesia (BSI)'),
            'catalog_manual_bank_number'  => SiteSetting::get('catalog_manual_bank_number', ''),
            'catalog_manual_bank_holder'  => SiteSetting::get('catalog_manual_bank_holder', 'PENERBIT PERSIS PERS'),
            'catalog_manual_wa_number'    => SiteSetting::get('catalog_manual_wa_number', SiteSetting::get('contact_whatsapp', '6281234567890')),
            'catalog_manual_instructions' => SiteSetting::get('catalog_manual_instructions', 'Scan QRIS atau transfer ke rekening bank di bawah ini, lalu klik tombol Konfirmasi WhatsApp untuk mengirimkan bukti transfer.'),
        ];

        return view('admin.settings.catalog', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'catalog_banner_badge'        => 'required|string|max:100',
            'catalog_banner_title'        => 'required|string|max:200',
            'catalog_banner_desc'         => 'required|string',
            'catalog_stat_books'          => 'required|string|max:100',
            'catalog_stat_authors'        => 'required|string|max:100',
            'catalog_stat_isbn'           => 'required|string|max:100',
            'catalog_stat_print'          => 'required|string|max:100',
            'catalog_promo_title'         => 'required|string|max:200',
            'catalog_promo_desc'          => 'required|string',
            'catalog_agenda_title'        => 'required|string|max:200',
            'catalog_agenda_desc'         => 'required|string',
            'catalog_publish_box_title'   => 'required|string|max:200',
            'catalog_publish_box_desc'    => 'required|string',
            
            // Payment Settings Validation
            'catalog_payment_mode'        => 'required|in:gateway,manual',
            'catalog_manual_qris_image'   => 'nullable|string',
            'catalog_manual_qris_file'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'catalog_manual_bank_name'    => 'nullable|string|max:100',
            'catalog_manual_bank_number'  => 'nullable|string|max:100',
            'catalog_manual_bank_holder'  => 'nullable|string|max:150',
            'catalog_manual_wa_number'    => 'nullable|string|max:50',
            'catalog_manual_instructions' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('catalog_manual_qris_file')) {
            $validated['catalog_manual_qris_image'] = $this->saveUploadedFile($request->file('catalog_manual_qris_file'), 'qris');
        }
        unset($validated['catalog_manual_qris_file']);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value ?? '');
        }

        return back()->with('success', 'Pengaturan tampilan katalog dan metode pembayaran berhasil diperbarui.');
    }
}
