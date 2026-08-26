<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Metodologi Penelitian Studi Islam & Integrasi Sains',
                'author' => 'Dr. H. Ahmad Fauzi, M.Ag.',
                'category' => 'Buku Ajar',
                'isbn' => '978-623-8812-40-1',
                'year' => '2026',
                'pages' => '240 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 75.000',
                'synopsis' => 'Buku ajar komprehensif yang mengkaji integrasi metodologi riset ilmu-ilmu keislaman klasik (turats) dengan paradigma metodologi ilmiah modern berbasis sains kuantitatif dan kualitatif.',
                'is_new_release' => true,
                'is_best_seller' => false,
                'status' => 'published',
            ],
            [
                'title' => 'Fiqh Muamalah Kontemporer & Akad Perbankan Syariah',
                'author' => 'Ust. Wildan Hidayat, M.E.',
                'category' => 'Studi Islam',
                'isbn' => '978-623-8812-41-8',
                'year' => '2026',
                'pages' => '198 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 68.000',
                'synopsis' => 'Kajian mendalam mengenai dinamika transaksi modern, fintech syariah, kripto, paylater, dan implementasi fatwa DSN-MUI dalam produk perbankan syariah di Indonesia.',
                'is_new_release' => true,
                'is_best_seller' => false,
                'status' => 'published',
            ],
            [
                'title' => 'Psikologi Perkembangan & Pendidikan Karakter Santri',
                'author' => 'Nurul Hidayah, M.Pd.',
                'category' => 'Tarbiyah',
                'isbn' => '978-623-8812-42-5',
                'year' => '2026',
                'pages' => '176 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 58.000',
                'synopsis' => 'Panduan psikopedagogis bagi pendidik dan pengasuh pesantren dalam membina kematangan emosional, spiritual, serta kemandirian santri era digital.',
                'is_new_release' => true,
                'is_best_seller' => false,
                'status' => 'published',
            ],
            [
                'title' => 'Konversi Tesis: Epistemologi Tafsir Ahkam di Nusantara',
                'author' => 'M. Farhan Zaki, M.Ag.',
                'category' => 'Monograf Riset',
                'isbn' => '978-623-8812-43-2',
                'year' => '2026',
                'pages' => '310 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 85.000',
                'synopsis' => 'Monograf hasil konversi riset magister yang menelaah corak istinbath hukum ulama Nusantara dalam merespons konteks sosio-kultural lokal.',
                'is_new_release' => true,
                'is_best_seller' => false,
                'status' => 'published',
            ],
            [
                'title' => 'Ensiklopedi Tokoh & Sejarah Pemikiran Persatuan Islam',
                'author' => 'Prof. Dr. H. Dadan Wildan, M.Hum.',
                'category' => 'Wawasan Islam',
                'isbn' => '978-623-8812-10-4',
                'year' => '2025',
                'pages' => '450 hlm',
                'format' => 'Hardcover Lux',
                'price' => 'Rp 145.000',
                'synopsis' => 'Karya monumental yang merangkum biografi intelektual, jejak perjuangan dakwah, dan kontribusi para tokoh pendiri dan ulama Persatuan Islam dalam sejarah kebangsaan.',
                'is_new_release' => false,
                'is_best_seller' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Panduan Praktis Tadabbur Al-Qur\'an Tematik',
                'author' => 'Dr. Nashruddin Syarief, M.Pd.I.',
                'category' => 'Studi Islam',
                'isbn' => '978-623-8812-15-9',
                'year' => '2025',
                'pages' => '220 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 65.000',
                'synopsis' => 'Metode sistematis menyelami pesan-pesan Al-Qur\'an secara tematik untuk penguatan aqidah, akhlak, dan panduan hidup sehari-hari ummat.',
                'is_new_release' => false,
                'is_best_seller' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Ushul Fiqh: Teori Dalil & Kaidah Istinbath Hukum',
                'author' => 'Dr. H. Tiar Anwar Bachtiar, M.Hum.',
                'category' => 'Buku Ajar',
                'isbn' => '978-623-8812-20-3',
                'year' => '2025',
                'pages' => '280 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 78.000',
                'synopsis' => 'Diktat rujukan wajib mahasiswa syariah dalam memahami dasar-dasar dalil syar\'i, kaidah kebahasaan, serta metode penggalian hukum Islam yang shahih.',
                'is_new_release' => false,
                'is_best_seller' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Strategi Pembelajaran Abad 21 di Madrasah & Pesantren',
                'author' => 'Dr. Siti Maryam, M.Pd.',
                'category' => 'Tarbiyah',
                'isbn' => '978-623-8812-25-8',
                'year' => '2025',
                'pages' => '190 hlm',
                'format' => 'UNESCO B5 (Bookpaper)',
                'price' => 'Rp 62.000',
                'synopsis' => 'Inovasi model pembelajaran interaktif, integrasi TPACK, dan pemanfaatan media digital dalam pendidikan madrasah dan pondok pesantren.',
                'is_new_release' => false,
                'is_best_seller' => true,
                'status' => 'published',
            ],
        ];

        foreach ($books as $index => $item) {
            Book::updateOrCreate(
                ['title' => $item['title']],
                array_merge($item, [
                    'slug' => Str::slug($item['title']),
                    'order' => $index + 1,
                ])
            );
        }
    }
}
