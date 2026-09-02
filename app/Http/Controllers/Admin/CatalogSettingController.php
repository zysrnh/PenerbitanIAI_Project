<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class CatalogSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->canAccessSettings()) {
                abort(403, 'Akses Ditolak: Hanya Super Admin yang berhak mengelola pengaturan website.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $settings = [
            'catalog_banner_badge' => SiteSetting::get('catalog_banner_badge', 'PUBLIKASI RESMI BER-ISBN'),
            'catalog_banner_title' => SiteSetting::get('catalog_banner_title', 'Katalog Buku & Karya Ilmiah'),
            'catalog_banner_desc' => SiteSetting::get('catalog_banner_desc', 'Koleksi buku ajar perguruan tinggi, monograf riset dosen, dan literatur keislaman ber-ISBN resmi terbitan PERSIS PERS.'),
            'catalog_stat_books' => SiteSetting::get('catalog_stat_books', '150+ Judul Buku'),
            'catalog_stat_authors' => SiteSetting::get('catalog_stat_authors', 'Karya Dosen & Peneliti'),
            'catalog_stat_isbn' => SiteSetting::get('catalog_stat_isbn', 'ISBN Perpusnas'),
            'catalog_stat_print' => SiteSetting::get('catalog_stat_print', 'Cetak Berkualitas'),
            'catalog_promo_title' => SiteSetting::get('catalog_promo_title', 'Diskon Biaya Cetak 15% untuk Konversi Skripsi & Tesis'),
            'catalog_promo_desc' => SiteSetting::get('catalog_promo_desc', 'Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.'),
            'catalog_agenda_title' => SiteSetting::get('catalog_agenda_title', 'Bedah Buku & Call for Book Chapters Dosen'),
            'catalog_agenda_desc' => SiteSetting::get('catalog_agenda_desc', 'Terbuka untuk civitas akademika dan peneliti eksternal.'),
            'catalog_publish_box_title' => SiteSetting::get('catalog_publish_box_title', 'Punya Naskah Buku Sendiri?'),
            'catalog_publish_box_desc' => SiteSetting::get('catalog_publish_box_desc', 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.'),
        ];

        return view('admin.settings.catalog', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'catalog_banner_badge' => 'required|string|max:100',
            'catalog_banner_title' => 'required|string|max:200',
            'catalog_banner_desc' => 'required|string',
            'catalog_stat_books' => 'required|string|max:100',
            'catalog_stat_authors' => 'required|string|max:100',
            'catalog_stat_isbn' => 'required|string|max:100',
            'catalog_stat_print' => 'required|string|max:100',
            'catalog_promo_title' => 'required|string|max:200',
            'catalog_promo_desc' => 'required|string',
            'catalog_agenda_title' => 'required|string|max:200',
            'catalog_agenda_desc' => 'required|string',
            'catalog_publish_box_title' => 'required|string|max:200',
            'catalog_publish_box_desc' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan tampilan halaman katalog berhasil diperbarui.');
    }
}
