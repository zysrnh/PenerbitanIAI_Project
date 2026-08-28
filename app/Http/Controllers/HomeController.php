<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = [
            // Slide 1
            'home_slide1_title'     => SiteSetting::get('home_slide1_title', "Melayani Penerbitan\ndan Percetakan"),
            'home_slide1_highlight' => SiteSetting::get('home_slide1_highlight', 'Berkualitas'),
            'home_slide1_desc'      => SiteSetting::get('home_slide1_desc', 'Persis Pers hadir untuk mendukung kebutuhan penerbitan buku, jurnal, modul, dan berbagai produk cetak lainnya dengan kualitas terbaik dan pelayanan profesional.'),
            'home_slide1_image'     => SiteSetting::get('home_slide1_image', 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop'),
            'home_slide1_btn1_text' => SiteSetting::get('home_slide1_btn1_text', 'LIHAT LAYANAN'),
            'home_slide1_btn1_url'  => SiteSetting::get('home_slide1_btn1_url', '#layanan'),
            'home_slide1_btn2_text' => SiteSetting::get('home_slide1_btn2_text', 'KATALOG BUKU'),
            'home_slide1_btn2_url'  => SiteSetting::get('home_slide1_btn2_url', '/katalog'),

            // Slide 2
            'home_slide2_title'     => SiteSetting::get('home_slide2_title', "Penerbitan Buku\nBer-ISBN Resmi"),
            'home_slide2_highlight' => SiteSetting::get('home_slide2_highlight', '& Terindeks'),
            'home_slide2_desc'      => SiteSetting::get('home_slide2_desc', 'Dukung publikasi karya ilmiah, monograf, dan buku referensi Anda dengan pendaftaran resmi ke Perpustakaan Nasional dan sertifikasi Hak Cipta.'),
            'home_slide2_image'     => SiteSetting::get('home_slide2_image', 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop'),
            'home_slide2_btn1_text' => SiteSetting::get('home_slide2_btn1_text', 'AJUKAN NASKAH'),
            'home_slide2_btn1_url'  => SiteSetting::get('home_slide2_btn1_url', '/kontak'),
            'home_slide2_btn2_text' => SiteSetting::get('home_slide2_btn2_text', 'PANDUAN PENULIS'),
            'home_slide2_btn2_url'  => SiteSetting::get('home_slide2_btn2_url', '#layanan'),

            // Slide 3
            'home_slide3_title'     => SiteSetting::get('home_slide3_title', "Percetakan Cepat,\nHarga Bersahabat"),
            'home_slide3_highlight' => SiteSetting::get('home_slide3_highlight', '& Presisi'),
            'home_slide3_desc'      => SiteSetting::get('home_slide3_desc', 'Mencetak majalah, prosiding, buletin, modul ajar, dan kebutuhan cetak custom institusi dengan teknologi modern dan ketepatan waktu.'),
            'home_slide3_image'     => SiteSetting::get('home_slide3_image', 'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?q=80&w=1600&auto=format&fit=crop'),
            'home_slide3_btn1_text' => SiteSetting::get('home_slide3_btn1_text', 'ORDER SEKARANG'),
            'home_slide3_btn1_url'  => SiteSetting::get('home_slide3_btn1_url', '/katalog'),
            'home_slide3_btn2_text' => SiteSetting::get('home_slide3_btn2_text', 'HUBUNGI KAMI'),
            'home_slide3_btn2_url'  => SiteSetting::get('home_slide3_btn2_url', '/kontak'),

            // 4 Keunggulan
            'home_feat1_title'      => SiteSetting::get('home_feat1_title', 'Kualitas Terbaik'),
            'home_feat1_desc'       => SiteSetting::get('home_feat1_desc', 'Hasil cetak tajam, warna akurat'),
            'home_feat2_title'      => SiteSetting::get('home_feat2_title', 'Pelayanan Cepat'),
            'home_feat2_desc'       => SiteSetting::get('home_feat2_desc', 'Proses produksi tepat waktu'),
            'home_feat3_title'      => SiteSetting::get('home_feat3_title', 'Harga Bersahabat'),
            'home_feat3_desc'       => SiteSetting::get('home_feat3_desc', 'Harga kompetitif & transparan'),
            'home_feat4_title'      => SiteSetting::get('home_feat4_title', 'Berpengalaman'),
            'home_feat4_desc'       => SiteSetting::get('home_feat4_desc', 'Didukung tim berpengalaman'),

            // Section Layanan & CTA
            'home_services_badge'   => SiteSetting::get('home_services_badge', 'LAYANAN KAMI'),
            'home_services_title'   => SiteSetting::get('home_services_title', 'Solusi Lengkap Untuk Kebutuhan Anda'),
            'home_cta_title'        => SiteSetting::get('home_cta_title', 'Siap Menerbitkan Buku & Karya Ilmiah Anda?'),
            'home_cta_desc'         => SiteSetting::get('home_cta_desc', 'Konsultasikan naskah Anda hari ini bersama tim redaksi kami. Dapatkan penawaran terbaik dan estimasi waktu produksi.'),
            'home_cta_btn_text'     => SiteSetting::get('home_cta_btn_text', 'KONSULTASI SEKARANG'),
            'home_cta_wa_number'    => SiteSetting::get('home_cta_wa_number', '082116116133'),
        ];

        $featuredBooks = Book::where('status', 'publish')->latest()->take(8)->get();

        return view('landingpage', compact('settings', 'featuredBooks'));
    }
}
