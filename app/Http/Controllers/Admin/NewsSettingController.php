<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsSettingController extends Controller
{
    /**
     * Helper to safely save uploaded files to both public/storage and storage/app/public
     */
    private function saveUploadedFile($file, string $folder): string
    {
        $dir1 = public_path('storage/' . $folder);
        $dir2 = storage_path('app/public/' . $folder);

        if (!file_exists($dir1)) {
            @mkdir($dir1, 0777, true);
        }
        if (!file_exists($dir2)) {
            @mkdir($dir2, 0777, true);
        }

        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = Str::random(30) . '.' . $ext;
        $dest1 = $dir1 . '/' . $filename;
        $dest2 = $dir2 . '/' . $filename;

        $file->move($dir1, $filename);
        @copy($dest1, $dest2);
        @chmod($dest1, 0644);
        @chmod($dest2, 0644);

        return '/storage/' . $folder . '/' . $filename;
    }

    public function index()
    {
        $settings = [
            'news_banner_badge' => SiteSetting::get('news_banner_badge', 'WARNA LITERASI & WARTA'),
            'news_banner_title' => SiteSetting::get('news_banner_title', 'Kabar & Artikel Penerbitan'),
            'news_banner_desc'  => SiteSetting::get('news_banner_desc', 'Temukan warta kegiatan, tips penulisan buku ber-ISBN, agenda workshop, serta pemikiran literasi Islam dari Penerbit Persis.'),
            
            // Wakaf Widget & Modal Settings
            'wakaf_card_title'       => SiteSetting::get('wakaf_card_title', "WAKAF AL-QUR'AN & BUKU UNTUK GENERASI QUR'ANI"),
            'wakaf_bank_name'        => SiteSetting::get('wakaf_bank_name', 'Bank Syariah Indonesia (BSI)'),
            'wakaf_account_no'       => SiteSetting::get('wakaf_account_no', '7148888999'),
            'wakaf_account_name'     => SiteSetting::get('wakaf_account_name', 'PENERBIT PERSIS WAKAF'),
            'wakaf_qris_image'       => SiteSetting::get('wakaf_qris_image', ''),
            'wakaf_contact_wa'       => SiteSetting::get('wakaf_contact_wa', '6281234567890'),
            'wakaf_active'           => SiteSetting::get('wakaf_active', '1'),
            'wakaf_program_title'    => SiteSetting::get('wakaf_program_title', 'PROGRAM WAKAF AL-QUR’AN DAN BUKU'),
            'wakaf_program_subtitle' => SiteSetting::get('wakaf_program_subtitle', 'Menghidupkan Literasi, Menebarkan Ilmu, Mengalirkan Pahala'),
            'wakaf_content'          => SiteSetting::get('wakaf_content', ''),
        ];

        return view('admin.settings.news', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'news_banner_badge'      => 'required|string|max:100',
            'news_banner_title'      => 'required|string|max:200',
            'news_banner_desc'       => 'required|string',
            
            'wakaf_card_title'       => 'required|string|max:255',
            'wakaf_bank_name'        => 'required|string|max:150',
            'wakaf_account_no'       => 'required|string|max:100',
            'wakaf_account_name'     => 'required|string|max:150',
            'wakaf_qris_image'       => 'nullable|string',
            'wakaf_qris_file'        => 'nullable|image|max:3072',
            'wakaf_contact_wa'       => 'nullable|string|max:50',
            'wakaf_active'           => 'nullable|string',
            'wakaf_program_title'    => 'nullable|string|max:255',
            'wakaf_program_subtitle' => 'nullable|string|max:255',
            'wakaf_content'          => 'nullable|string',
        ]);

        if ($request->hasFile('wakaf_qris_file')) {
            $validated['wakaf_qris_image'] = $this->saveUploadedFile($request->file('wakaf_qris_file'), 'wakaf');
        }
        unset($validated['wakaf_qris_file']);

        $validated['wakaf_active'] = $request->has('wakaf_active') ? '1' : '0';

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value ?? '');
        }

        return back()->with('success', 'Pengaturan halaman berita & rekening wakaf berhasil diperbarui.');
    }
}
