<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSettingController extends Controller
{
    private function getDefaultSlides()
    {
        return [
            [
                'type'        => SiteSetting::get('home_slide1_clean_mode', '0') === '1' ? 'clean' : 'standard',
                'title'       => SiteSetting::get('home_slide1_title', "Melayani Penerbitan\ndan Percetakan"),
                'highlight'   => SiteSetting::get('home_slide1_highlight', 'Berkualitas'),
                'desc'        => SiteSetting::get('home_slide1_desc', 'Persis Pers hadir untuk mendukung kebutuhan penerbitan buku, jurnal, modul, dan berbagai produk cetak lainnya dengan kualitas terbaik dan pelayanan profesional.'),
                'image'       => SiteSetting::get('home_slide1_image', 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop'),
                'btn1_text'   => SiteSetting::get('home_slide1_btn1_text', 'LIHAT LAYANAN'),
                'btn1_url'    => SiteSetting::get('home_slide1_btn1_url', '#layanan'),
                'btn2_text'   => SiteSetting::get('home_slide1_btn2_text', 'KATALOG BUKU'),
                'btn2_url'    => SiteSetting::get('home_slide1_btn2_url', '/katalog'),
            ],
            [
                'type'        => SiteSetting::get('home_slide2_clean_mode', '0') === '1' ? 'clean' : 'standard',
                'title'       => SiteSetting::get('home_slide2_title', "Penerbitan Buku\nBer-ISBN Resmi"),
                'highlight'   => SiteSetting::get('home_slide2_highlight', '& Terindeks'),
                'desc'        => SiteSetting::get('home_slide2_desc', 'Dukung publikasi karya ilmiah, monograf, dan buku referensi Anda dengan pendaftaran resmi ke Perpustakaan Nasional dan sertifikasi Hak Cipta.'),
                'image'       => SiteSetting::get('home_slide2_image', 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop'),
                'btn1_text'   => SiteSetting::get('home_slide2_btn1_text', 'AJUKAN NASKAH'),
                'btn1_url'    => SiteSetting::get('home_slide2_btn1_url', '/kontak'),
                'btn2_text'   => SiteSetting::get('home_slide2_btn2_text', 'PANDUAN PENULIS'),
                'btn2_url'    => SiteSetting::get('home_slide2_btn2_url', '#layanan'),
            ],
            [
                'type'        => SiteSetting::get('home_slide3_clean_mode', '0') === '1' ? 'clean' : 'standard',
                'title'       => SiteSetting::get('home_slide3_title', "Percetakan Cepat,\nHarga Bersahabat"),
                'highlight'   => SiteSetting::get('home_slide3_highlight', '& Presisi'),
                'desc'        => SiteSetting::get('home_slide3_desc', 'Mencetak majalah, prosiding, buletin, modul ajar, dan kebutuhan cetak custom institusi dengan teknologi modern dan ketepatan waktu.'),
                'image'       => SiteSetting::get('home_slide3_image', 'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?q=80&w=1600&auto=format&fit=crop'),
                'btn1_text'   => SiteSetting::get('home_slide3_btn1_text', 'ORDER SEKARANG'),
                'btn1_url'    => SiteSetting::get('home_slide3_btn1_url', '/katalog'),
                'btn2_text'   => SiteSetting::get('home_slide3_btn2_text', 'HUBUNGI KAMI'),
                'btn2_url'    => SiteSetting::get('home_slide3_btn2_url', '/kontak'),
            ],
        ];
    }

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
        $rawSlides = SiteSetting::get('home_slides_json', null);
        $slides = $rawSlides ? json_decode($rawSlides, true) : null;
        if (!is_array($slides) || empty($slides)) {
            $slides = $this->getDefaultSlides();
        }

        $rawServices = SiteSetting::get('home_services_json', null);
        $services = $rawServices ? json_decode($rawServices, true) : $this->getDefaultServices();
        if (!is_array($services)) {
            $services = $this->getDefaultServices();
        }

        $settings = [
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

        return view('admin.settings.home', compact('settings', 'services', 'slides'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'slides'                 => ['nullable', 'array'],
            // 4 Keunggulan
            'home_feat1_title'       => ['required', 'string', 'max:150'],
            'home_feat1_desc'        => ['required', 'string', 'max:255'],
            'home_feat2_title'       => ['required', 'string', 'max:150'],
            'home_feat2_desc'        => ['required', 'string', 'max:255'],
            'home_feat3_title'       => ['required', 'string', 'max:150'],
            'home_feat3_desc'        => ['required', 'string', 'max:255'],
            'home_feat4_title'       => ['required', 'string', 'max:150'],
            'home_feat4_desc'        => ['required', 'string', 'max:255'],

            // Profil Singkat
            'home_about_title'       => ['required', 'string', 'max:150'],
            'home_about_desc'        => ['required', 'string'],
            'home_about_image'       => ['nullable', 'string'],
            'home_about_image_file'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],

            // Proses Produksi
            'home_process_title'     => ['required', 'string', 'max:150'],
            'home_process_desc'      => ['required', 'string', 'max:255'],

            // Section Layanan
            'home_services_badge'    => ['required', 'string', 'max:100'],
            'home_services_title'    => ['required', 'string', 'max:255'],
            'services'               => ['nullable', 'array'],
        ]);

        // Handle File Upload for About image
        if ($request->hasFile('home_about_image_file')) {
            $path = $request->file('home_about_image_file')->store('banners', 'public');
            $validated['home_about_image'] = '/storage/' . $path;
        } elseif (!empty($request->input('home_about_image'))) {
            $validated['home_about_image'] = $request->input('home_about_image');
        }
        unset($validated['home_about_image_file']);

        // Handle Dynamic Slides
        if ($request->has('slides')) {
            $slidesInput = $request->input('slides', []);
            $slidesData = [];

            foreach ($slidesInput as $i => $slide) {
                $imagePath = $slide['image'] ?? 'https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=1600&auto=format&fit=crop';

                if ($request->hasFile("slides.{$i}.image_file")) {
                    $path = $request->file("slides.{$i}.image_file")->store('banners', 'public');
                    $imagePath = '/storage/' . $path;
                }

                $slidesData[] = [
                    'type'      => ($slide['type'] ?? 'standard') === 'clean' ? 'clean' : 'standard',
                    'title'     => $slide['title'] ?? '',
                    'highlight' => $slide['highlight'] ?? '',
                    'desc'      => $slide['desc'] ?? '',
                    'image'     => $imagePath,
                    'btn1_text' => $slide['btn1_text'] ?? '',
                    'btn1_url'  => $slide['btn1_url'] ?? '',
                    'btn2_text' => $slide['btn2_text'] ?? '',
                    'btn2_url'  => $slide['btn2_url'] ?? '',
                ];
            }

            SiteSetting::set('home_slides_json', json_encode(array_values($slidesData)));
            unset($validated['slides']);
        }

        // Save Services JSON
        if ($request->has('services')) {
            $servicesData = array_values($request->input('services', []));
            SiteSetting::set('home_services_json', json_encode($servicesData));
            unset($validated['services']);
        }

        foreach ($validated as $key => $val) {
            SiteSetting::set($key, $val ?? '');
        }

        return back()->with('success', 'Semua slide banner, konten, dan daftar layanan beranda berhasil diperbarui!');
    }
}
