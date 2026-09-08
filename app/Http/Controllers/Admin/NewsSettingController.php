<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class NewsSettingController extends Controller
{
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
            $path = $request->file('wakaf_qris_file')->store('wakaf', 'public');
            $validated['wakaf_qris_image'] = '/storage/' . $path;
        }
        unset($validated['wakaf_qris_file']);

        $validated['wakaf_active'] = $request->has('wakaf_active') ? '1' : '0';

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value ?? '');
        }

        return back()->with('success', 'Pengaturan halaman berita & rekening wakaf berhasil diperbarui.');
    }
}
