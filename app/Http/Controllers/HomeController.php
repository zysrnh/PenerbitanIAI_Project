<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private function getDefaultServices()
    {
        return [
            [
                'icon'  => 'fa-solid fa-book-open',
                'title' => 'Penerbitan Buku',
                'desc'  => 'Menerbitkan buku referensi, buku ajar, monograf, dan berbagai karya ilmiah.',
                'link'  => '/kontak',
            ],
            [
                'icon'  => 'fa-solid fa-copy',
                'title' => 'Percetakan Umum',
                'desc'  => 'Cetak brosur, flyer, poster, katalog, majalah, dan berbagai kebutuhan cetak lainnya.',
                'link'  => '/kontak',
            ],
            [
                'icon'  => 'fa-solid fa-newspaper',
                'title' => 'Jurnal & Majalah',
                'desc'  => 'Pengelolaan dan pencetakan jurnal, prosiding, buletin, dan majalah berkala.',
                'link'  => '/kontak',
            ],
            [
                'icon'  => 'fa-solid fa-graduation-cap',
                'title' => 'Konversi KTI',
                'desc'  => 'Ubah skripsi, tesis, disertasi menjadi buku berkualitas siap terbit.',
                'link'  => '/kontak',
            ],
            [
                'icon'  => 'fa-solid fa-barcode',
                'title' => 'Pengurusan ISBN',
                'desc'  => 'Bantu pengurusan ISBN untuk buku dan terbitan Anda.',
                'link'  => '/kontak',
            ],
            [
                'icon'  => 'fa-solid fa-box-open',
                'title' => 'Cetak Custom',
                'desc'  => 'Cetak sesuai kebutuhan dengan ukuran dan bahan yang beragam.',
                'link'  => '/kontak',
            ],
        ];
    }

    public function index()
    {
        $rawServices = SiteSetting::get('home_services_json', null);
        $services = $rawServices ? json_decode($rawServices, true) : $this->getDefaultServices();
        if (!is_array($services)) {
            $services = $this->getDefaultServices();
        }

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

            // Profil Singkat
            'home_about_title'      => SiteSetting::get('home_about_title', 'PERSIS PERS'),
            'home_about_desc'       => SiteSetting::get('home_about_desc', 'Merupakan unit layanan Penerbitan dan Percetakan yang berkomitmen mendukung penyebaran ilmu pengetahuan dan karya berkualitas bagi akademisi dan masyarakat luas.'),
            'home_about_image'      => SiteSetting::get('home_about_image', 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=600&auto=format&fit=crop'),

            // Proses Produksi
            'home_process_title'    => SiteSetting::get('home_process_title', 'Proses Produksi Profesional'),
            'home_process_desc'     => SiteSetting::get('home_process_desc', 'Didukung peralatan modern & pengawasan mutu di setiap tahap produksi.'),

            // Section Layanan
            'home_services_badge'   => SiteSetting::get('home_services_badge', 'LAYANAN KAMI'),
            'home_services_title'   => SiteSetting::get('home_services_title', 'Solusi Lengkap Untuk Kebutuhan Anda'),
        ];

        // Fetch 4 latest published books for the Showcase Section on the home page
        $featuredBooks = Book::where('status', 'publish')->latest()->take(4)->get();
        if ($featuredBooks->isEmpty()) {
            $featuredBooks = Book::latest()->take(4)->get();
        }

        return view('landingpage', compact('settings', 'services', 'featuredBooks'));
    }
}
