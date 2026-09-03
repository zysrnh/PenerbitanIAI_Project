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
        ];

        return view('admin.settings.news', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'news_banner_badge' => 'required|string|max:100',
            'news_banner_title' => 'required|string|max:200',
            'news_banner_desc'  => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan tampilan halaman berita berhasil diperbarui.');
    }
}
