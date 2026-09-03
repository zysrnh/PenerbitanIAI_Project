<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Setup Sample Categories
        $catKabar = ArticleCategory::firstOrCreate(
            ['slug' => 'kabar-penerbitan'],
            [
                'name' => 'Kabar Penerbitan',
                'description' => 'Informasi dan berita terbaru seputar dunia penerbitan dan percetakan PERSIS PERS.',
                'order' => 1,
            ]
        );

        $catTips = ArticleCategory::firstOrCreate(
            ['slug' => 'tips-penulis'],
            [
                'name' => 'Tips Penulis',
                'description' => 'Tips, tutorial, dan panduan praktis untuk penulis pemula hingga akademisi.',
                'order' => 2,
            ]
        );

        $author = User::where('role', 'super_admin')->orWhere('role', 'admin')->first() ?? User::first();
        $authorId = $author ? $author->id : null;

        // 2. Setup 2 Sample Articles
        $articles = [
            [
                'title' => 'Penerbit Persis Buka Layanan Konversi Skripsi & Tesis Menjadi Buku Ber-ISBN Resmi',
                'slug' => 'penerbit-persis-buka-layanan-konversi-skripsi-tesis-menjadi-buku-ber-isbn-resmi',
                'category_id' => $catKabar->id,
                'author_id' => $authorId,
                'thumbnail' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=1200&auto=format&fit=crop',
                'excerpt' => 'PERSIS PERS resmi membuka program pendampingan konversi tugas akhir, skripsi, dan tesis menjadi buku referensi dan monograf ber-ISBN resmi standar Perpusnas RI.',
                'content' => '<p><strong>BANDUNG</strong> — Dalam rangka mendorong produktivitas publikasi ilmiah dan hilirisasi riset di lingkungan perguruan tinggi serta pondok pesantren, <strong>Penerbit Persis (PERSIS PERS)</strong> secara resmi meluncurkan layanan khusus <em>Konversi Tugas Akhir Menjadi Buku Referensi Ber-ISBN</em>.</p>

                <h3>Mendorong Riset Menjadi Bacaan Masyarakat Luas</h3>
                <p>Banyak karya skripsi, tesis, maupun disertasi yang memiliki kedalaman analisis luar biasa namun hanya tersimpan di perpustakaan kampus. Melalui program ini, tim editor profesional Penerbit Persis mendampingi proses adaptasi format laporan akademik menjadi naskah buku yang enak dibaca dan memiliki nilai jual.</p>

                <p><em>"Kami ingin menjembatani para dosen, akademisi, dan mahasiswa tingkat akhir agar hasil riset mereka tidak berhenti sebagai syarat kelulusan semata, melainkan menjadi kontribusi nyata bagi literasi umat yang diakui secara nasional,"</em> ujar Direktur Penerbit Persis.</p>

                <h3>Fasilitas Lengkap untuk Penulis</h3>
                <p>Setiap penulis yang menerbitkan naskah konversinya di Penerbit Persis akan mendapatkan paket layanan lengkap, antara lain:</p>
                <ul>
                    <li><strong>Pengurusan ISBN & KDT Resmi:</strong> Terdaftar resmi di Perpustakaan Nasional Republik Indonesia.</li>
                    <li><strong>Layout & Tata Letak Standar UNESCO:</strong> Menggunakan format B5/A5 dengan tipografi elegan yang nyaman dibaca.</li>
                    <li><strong>Desain Cover Profesional:</strong> Visualisasi cover eksklusif yang mencerminkan identitas keilmuan dan keislaman.</li>
                    <li><strong>Distribusi & Penjualan:</strong> Didistribusikan melalui katalog daring resmi dan jaringan reseller agen pesantren.</li>
                </ul>

                <p>Bagi civitas akademika yang ingin mengonsultasikan draft naskahnya, layanan konsultasi redaksi dibuka setiap hari kerja melalui portal resmi Penerbit Persis.</p>',
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 142,
                'tags' => 'konversi buku, isbn, karya ilmiah, penerbit persis',
                'published_at' => now()->subDay(),
            ],
            [
                'title' => '5 Kunci Menulis Naskah Buku Islam Populer yang Diminati Generasi Muda',
                'slug' => '5-kunci-menulis-naskah-buku-islam-populer-yang-diminati-generasi-muda',
                'category_id' => $catTips->id,
                'author_id' => $authorId,
                'thumbnail' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3edd4?q=80&w=1200&auto=format&fit=crop',
                'excerpt' => 'Menulis buku bertema keislaman di era digital menuntut gaya bahasa yang lugas, kontekstual, dan solutif terhadap problematika generasi muda.',
                'content' => '<p>Menulis literatur Islam di era sekarang memiliki tantangan tersendiri. Pembaca masa kini, khususnya kalangan milenial dan Gen Z, menyukai bacaan yang tidak hanya sarat dalil, tetapi juga solutif terhadap problem keseharian mereka.</p>

                <h3>1. Gunakan Bahasa yang Mengalir dan Dialogis</h3>
                <p>Hindari gaya bahasa yang terlalu kaku dan menghakimi. Gunakan sudut pandang yang mengajak pembaca berdialog santai dan merenung, seolah-olah sedang berbincang di majelis ilmu.</p>

                <h3>2. Kuatkan Referensi Otentik</h3>
                <p>Meskipun dikemas santai, keaslian sanad dalil Al-Qur\'an dan Sunnah shahihah tetap menjadi pilar utama. Cantumkan takhrij hadits secara ringkas agar kredibilitas karya tetap terjaga.</p>

                <h3>3. Kontekstualkan dengan Isu Kontemporer</h3>
                <p>Hubungkan nilai-nilai fiqih dan akhlak dengan dinamika zaman modern, seperti etika bermedia sosial, kesehatan mental, hingga ekonomi syariah praktis.</p>

                <h3>4. Buat Judul Sub-Bab yang Menarik</h3>
                <p>Gunakan sub-judul yang memancing rasa ingin tahu pembaca, bukan sekadar penomoran standar akademik.</p>

                <p>Semoga panduan singkat ini dapat memotivasi para asatidz dan penulis muda untuk terus produktif melahirkan karya-karya bermutu bersama Penerbit Persis.</p>',
                'status' => 'published',
                'is_featured' => false,
                'views_count' => 98,
                'tags' => 'tips menulis, literasi islam, buku ajar, kepenulisan',
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($articles as $item) {
            Article::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
