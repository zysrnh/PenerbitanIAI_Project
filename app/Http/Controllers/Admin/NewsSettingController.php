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
            'news_banner_badge'     => SiteSetting::get('news_banner_badge', 'WARNA LITERASI & WARTA'),
            'news_banner_title'     => SiteSetting::get('news_banner_title', 'Kabar & Artikel Penerbitan'),
            'news_banner_desc'      => SiteSetting::get('news_banner_desc', 'Temukan informasi terbaru, panduan penulisan ilmiah & keislaman, agenda literasi, serta kabar terkini dari Penerbit Persis.'),
            'news_stat_total'       => SiteSetting::get('news_stat_total', 'Warta & Artikel'),
            'news_stat_categories'  => SiteSetting::get('news_stat_categories', 'Kategori Lengkap'),
            'news_stat_views'       => SiteSetting::get('news_stat_views', 'Pembaca Terlayani'),
            'news_stat_authors'     => SiteSetting::get('news_stat_authors', 'Editor & Penulis'),
            'news_promo_title'      => SiteSetting::get('news_promo_title', 'Ingin Menerbitkan Buku Anda?'),
            'news_promo_desc'       => SiteSetting::get('news_promo_desc', 'Konsultasikan naskah ilmiah, modul, atau buku keislaman Anda bersama tim profesional Penerbit Persis.'),
        ];

        return view('admin.settings.news', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'news_banner_badge'    => 'required|string|max:100',
            'news_banner_title'    => 'required|string|max:200',
            'news_banner_desc'     => 'required|string',
            'news_stat_total'      => 'required|string|max:100',
            'news_stat_categories' => 'required|string|max:100',
            'news_stat_views'      => 'required|string|max:100',
            'news_stat_authors'    => 'required|string|max:100',
            'news_promo_title'     => 'required|string|max:200',
            'news_promo_desc'      => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan tampilan halaman berita berhasil diperbarui.');
    }
}
