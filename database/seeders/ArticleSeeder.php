<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kabar Penerbitan',
                'slug' => 'kabar-penerbitan',
                'description' => 'Informasi dan berita terbaru seputar dunia penerbitan dan percetakan Persis Pers.',
                'order' => 1,
            ],
            [
                'name' => 'Tips & Panduan Penulis',
                'slug' => 'tips-panduan-penulis',
                'description' => 'Tips, tutorial, dan panduan praktis untuk penulis pemula hingga akademisi.',
                'order' => 2,
            ],
            [
                'name' => 'Pelatihan & Event',
                'slug' => 'pelatihan-event',
                'description' => 'Agenda workshop, bedah buku, pelatihan penulisan, dan pameran literasi.',
                'order' => 3,
            ],
            [
                'name' => 'Opini & Literasi',
                'slug' => 'opini-literasi',
                'description' => 'Ulasan pemikiran, opini keilmuan Islam, dan perkembangan literasi keumatan.',
                'order' => 4,
            ],
        ];

        $categoryMap = [];
        foreach ($categories as $cat) {
            $created = ArticleCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
            $categoryMap[$cat['slug']] = $created->id;
        }

        $author = User::where('role', 'super_admin')->orWhere('role', 'admin')->first() ?? User::first();
        $authorId = $author ? $author->id : null;

        $articles = [
            [
                'title' => 'Penerbit Persis Siap Fasilitasi Konversi Karya Tulis Ilmiah Menjadi Buku Ber-ISBN',
                'slug' => 'penerbit-persis-siap-fasilitasi-konversi-karya-tulis-ilmiah-menjadi-buku-ber-isbn',
                'category_id' => $categoryMap['kabar-penerbitan'] ?? null,
                'author_id' => $authorId,
                'thumbnail' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=1200&auto=format&fit=crop',
                'excerpt' => 'Bagi dosen, peneliti, dan mahasiswa tingkat akhir, mengubah skripsi, tesis, atau disertasi menjadi buku ber-ISBN kini semakin mudah dengan layanan konversi naskah komprehensif dari Penerbit Persis.',
                'content' => '<p>Karya Tulis Ilmiah (KTI) seperti skripsi, tesis, dan disertasi sering kali hanya tersimpan rapi di perpustakaan kampus tanpa dibaca oleh khalayak luas. Padahal, gagasan dan temuan riset di dalamnya memiliki nilai kemanfaatan yang luar biasa jika dikemas dalam gaya bahasa populer dan diterbitkan menjadi buku ber-ISBN.</p>
                <p>Melihat kebutuhan tersebut, <strong>Penerbit Persis</strong> menghadirkan layanan khusus konversi KTI menjadi buku referensi dan monograf. Tim redaksi kami siap mendampingi proses adaptasi format, penyuntingan bahasa ilmiah populer, tata letak interior naskah, desain sampul profesional, hingga pengurusan legalitas ISBN resmi dari Perpustakaan Nasional Republik Indonesia.</p>
                <h2>Keunggulan Konversi Naskah di Penerbit Persis</h2>
                <ul>
                    <li><strong>Pendampingan Editor Ahli:</strong> Naskah diperiksa struktur bahasa dan sistematikanya agar komunikatif bagi pembaca umum.</li>
                    <li><strong>Legalitas Terjamin:</strong> Pendaftaran resmi ISBN dan sertifikasi Hak Cipta (HAKI).</li>
                    <li><strong>Pilihan Paket Fleksibel:</strong> Tersedia paket cetak skala kecil (Print on Demand) hingga cetak massal dengan harga terjangkau.</li>
                </ul>
                <p>Bagi civitas akademika dan masyarakat luas yang ingin mempublikasikan karyanya, Anda dapat langsung berkonsultasi melalui layanan kontak redaksi kami.</p>',
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 142,
                'tags' => 'Konversi KTI, ISBN, Buku Referensi, Akademisi',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => '5 Tips Penting Menyusun Naskah Buku Islam yang Menarik dan Berbobot',
                'slug' => '5-tips-penting-menyusun-naskah-buku-islam-yang-menarik-dan-berbobot',
                'category_id' => $categoryMap['tips-panduan-penulis'] ?? null,
                'author_id' => $authorId,
                'thumbnail' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3edd4?q=80&w=1200&auto=format&fit=crop',
                'excerpt' => 'Menulis buku bertema keislaman membutuhkan ketelitian sumber dalil, kelugasan bahasa, dan relevansi dengan dinamika problematika umat saat ini. Simak 5 langkah praktisnya di sini.',
                'content' => '<p>Menulis buku keagamaan bukan sekadar menyalin kutipan ayat atau hadis, melainkan bagaimana mentransformasikan nilai-nilai luhur Islam ke dalam solusi praktis kehidupan pembaca kontemporer. Berikut lima panduan esensial bagi Anda yang sedang mempersiapkan naskah buku keislaman:</p>
                <h3>1. Verifikasi Keabsahan Rujukan (Takhrij Hadis)</h3>
                <p>Pastikan setiap kutipan dalil dan hadis merujuk kepada kitab-kitab induk muktabar dengan derajat keshahihan yang dapat dipertanggungjawabkan.</p>
                <h3>2. Gunakan Bahasa yang Ramah dan Santun</h3>
                <p>Sampaikan pesan dakwah dengan gaya tutur yang merangkul (hikmah dan mau\'izhah hasanah), bukan menghakimi, sehingga buku Anda dapat diterima lintas generasi.</p>
                <h3>3. Susun Kerangka (Outline) Bab yang Sistematis</h3>
                <p>Kerangka yang matang membantu pembaca memahami alur pemikiran dari konsep dasar hingga implikasi praktis secara bertahap.</p>
                <h3>4. Tambahkan Studi Kasus & Contoh Nyata</h3>
                <p>Contoh kontekstual memudahkan pembaca mengaplikasikan ajaran agama dalam ranah keluarga, profesional, dan sosial kemasyarakatan.</p>
                <h3>5. Konsultasikan dengan Penerbit Berpengalaman</h3>
                <p>Jangan ragu berdiskusi dengan editor penerbit sejak tahap draf awal untuk mendapatkan masukan pasar dan standar tata letak yang ideal.</p>',
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 98,
                'tags' => 'Tips Menulis, Buku Islam, Penulis, Literasi',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Meningkatkan Mutu Cetak dengan Teknologi Offset dan Digital Printing Modern',
                'slug' => 'meningkatkan-mutu-cetak-dengan-teknologi-offset-dan-digital-printing-modern',
                'category_id' => $categoryMap['kabar-penerbitan'] ?? null,
                'author_id' => $authorId,
                'thumbnail' => 'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?q=80&w=1200&auto=format&fit=crop',
                'excerpt' => 'Komitmen Penerbit Persis dalam menghadirkan hasil cetak buku, majalah, dan modul dengan tingkat presisi warna tinggi, jilid kuat, dan bahan kertas ramah lingkungan.',
                'content' => '<p>Kualitas fisik sebuah buku memegang peranan krusial terhadap kenyamanan membaca dan daya tahan karya sepanjang masa. Percetakan Persis Pers terus memperbarui teknologi mesin cetak offset dan digital printing guna menjamin setiap eksemplar buku diproduksi dengan standar industri terbaik.</p>
                <p>Mulai dari pemilihan kertas Bookpaper impor, HVS premium, hingga teknik binding (jilid lem panas / jahit benang) dan finishing sampul (Laminasi Doff/Glossy, Spot UV, Emboss), seluruh alur produksi melewati tahapan <em>Quality Control</em> yang ketat sebelum dikirimkan ke tangan penulis dan pembaca.</p>',
                'status' => 'published',
                'is_featured' => false,
                'views_count' => 76,
                'tags' => 'Percetakan, Cetak Buku, Kualitas Cetak',
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(
                ['slug' => $art['slug']],
                $art
            );
        }
    }
}
