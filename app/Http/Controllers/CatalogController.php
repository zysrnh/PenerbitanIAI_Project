<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Sample categories matching the academic publishing theme
        $categories = [
            ['slug' => 'all', 'name' => 'Semua Buku', 'count' => 24],
            ['slug' => 'buku-baru', 'name' => 'Buku Baru', 'count' => 8],
            ['slug' => 'best-seller', 'name' => 'Best Seller', 'count' => 6],
            ['slug' => 'studi-islam', 'name' => 'Studi Islam & Syariah', 'count' => 10],
            ['slug' => 'tarbiyah', 'name' => 'Tarbiyah & Pendidikan', 'count' => 8],
            ['slug' => 'buku-ajar', 'name' => 'Buku Ajar & Diktat', 'count' => 12],
            ['slug' => 'monograf', 'name' => 'Monograf & Riset Dosen', 'count' => 7],
            ['slug' => 'konversi-kti', 'name' => 'Konversi KTI (Skripsi/Tesis)', 'count' => 5],
            ['slug' => 'wawasan-islam', 'name' => 'Wawasan & Pemikiran Islam', 'count' => 9],
        ];

        // Sample New Releases
        $newBooks = [
            [
                'id' => 1,
                'title' => 'Metodologi Penelitian Studi Islam & Integrasi Sains',
                'author' => 'Dr. H. Ahmad Fauzi, M.Ag.',
                'isbn' => '978-623-8812-40-1',
                'price' => 'Rp 75.000',
                'category' => 'Buku Ajar',
                'year' => '2026',
                'pages' => '240 hlm',
                'cover_color' => 'from-emerald-800 to-brand-950',
                'synopsis' => 'Buku ajar komprehensif yang mengkaji integrasi metodologi riset ilmu-ilmu keislaman klasik (turats) dengan paradigma metodologi ilmiah modern berbasis sains kuantitatif dan kualitatif.',
            ],
            [
                'id' => 2,
                'title' => 'Fiqh Muamalah Kontemporer & Akad Perbankan Syariah',
                'author' => 'Ust. Wildan Hidayat, M.E.',
                'isbn' => '978-623-8812-41-8',
                'price' => 'Rp 68.000',
                'category' => 'Studi Islam',
                'year' => '2026',
                'pages' => '198 hlm',
                'cover_color' => 'from-teal-800 to-slate-900',
                'synopsis' => 'Kajian mendalam mengenai dinamika transaksi modern, fintech syariah, kripto, paylater, dan implementasi fatwa DSN-MUI dalam produk perbankan syariah di Indonesia.',
            ],
            [
                'id' => 3,
                'title' => 'Psikologi Perkembangan & Pendidikan Karakter Santri',
                'author' => 'Nurul Hidayah, M.Pd.',
                'isbn' => '978-623-8812-42-5',
                'price' => 'Rp 58.000',
                'category' => 'Tarbiyah',
                'year' => '2026',
                'pages' => '180 hlm',
                'cover_color' => 'from-cyan-900 to-brand-950',
                'synopsis' => 'Panduan praktis bagi pendidik dan pimpinan pesantren dalam memahami fase tumbuh kembang emosional santri era digital dengan pendekatan psikologi islami.',
            ],
            [
                'id' => 4,
                'title' => 'Konversi Tesis: Epistemologi Tafsir Ahkam di Nusantara',
                'author' => 'M. Farhan Zaki, M.Ag.',
                'isbn' => '978-623-8812-43-2',
                'price' => 'Rp 85.000',
                'category' => 'Monograf Riset',
                'year' => '2026',
                'pages' => '310 hlm',
                'cover_color' => 'from-emerald-900 to-stone-900',
                'synopsis' => 'Hasil penelitian akademis mengenai ragam corak dan metodologi penafsiran ayat-ayat hukum oleh ulama-ulama terkemuka di tanah Nusantara abad ke-19 hingga ke-20.',
            ],
        ];

        // Sample Best Sellers
        $bestSellers = [
            [
                'id' => 5,
                'title' => 'Ensiklopedi Tokoh & Sejarah Pemikiran Persatuan Islam',
                'author' => 'Tim Riset Redaksi PERSIS PERS',
                'isbn' => '978-602-7491-10-5',
                'price' => 'Rp 120.000',
                'category' => 'Wawasan Islam',
                'year' => '2025',
                'pages' => '420 hlm (Hardcover)',
                'cover_color' => 'from-amber-900 to-brand-950',
                'synopsis' => 'Karya monumental yang merekam jejak perjuangan, ide pembaruan, dan biografi para ulama perintis Persatuan Islam dari masa ke masa dalam menegakkan Al-Qur'an dan Sunnah.',
            ],
            [
                'id' => 6,
                'title' => 'Panduan Praktis Tadabbur Al-Qur'an Tematik',
                'author' => 'Dr. KH. Abdullah Syakir, MA',
                'isbn' => '978-602-7491-11-2',
                'price' => 'Rp 65.000',
                'category' => 'Studi Islam',
                'year' => '2025',
                'pages' => '210 hlm',
                'cover_color' => 'from-emerald-950 to-emerald-800',
                'synopsis' => 'Metode sistematis menyelami pesan moral dan petunjuk hidup dalam Al-Qur'an melalui pembagian tema kehidupan, keluarga, ibadah, dan sosial kemasyarakatan.',
            ],
            [
                'id' => 7,
                'title' => 'Ushul Fiqh: Teori Dalil & Kaidah Istinbath Hukum Islam',
                'author' => 'Drs. H. Mamat Rahmat, M.Ag.',
                'isbn' => '978-602-7491-12-9',
                'price' => 'Rp 70.000',
                'category' => 'Buku Ajar',
                'year' => '2025',
                'pages' => '260 hlm',
                'cover_color' => 'from-slate-900 to-emerald-900',
                'synopsis' => 'Diktat rujukan mahasiswa perguruan tinggi Islam dalam memahami kaidah bahasa (ushuliyah) dan kaidah hukum (fiqhiyyah) untuk menggali hukum syar'i.',
            ],
            [
                'id' => 8,
                'title' => 'Strategi Pembelajaran Abad 21 di Madrasah & Pesantren',
                'author' => 'Dra. Hj. Siti Maryam, M.Pd.',
                'isbn' => '978-602-7491-13-6',
                'price' => 'Rp 60.000',
                'category' => 'Tarbiyah',
                'year' => '2025',
                'pages' => '195 hlm',
                'cover_color' => 'from-teal-950 to-cyan-900',
                'synopsis' => 'Model inovasi kurikulum dan pengajaran berbasis digital, critical thinking, dan kolaborasi bagi guru madrasah dan asatidz pesantren modern.',
            ],
        ];

        return view('katalog', compact('categories', 'newBooks', 'bestSellers'));
    }
}
