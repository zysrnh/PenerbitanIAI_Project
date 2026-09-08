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
        // 1. Setup Categories
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

        $catWakaf = ArticleCategory::firstOrCreate(
            ['slug' => 'wakaf-literasi'],
            [
                'name' => 'Wakaf & Literasi',
                'description' => 'Program wakaf Al-Qur\'an, buku keislaman, dan penyaluran literasi ilmu untuk umat.',
                'order' => 3,
            ]
        );

        $author = User::where('role', 'super_admin')->orWhere('role', 'admin')->first() ?? User::first();
        $authorId = $author ? $author->id : null;

        // 2. Setup Default Site Settings for Wakaf
        if (!SiteSetting::get('wakaf_card_title')) {
            SiteSetting::set('wakaf_card_title', "WAKAF AL-QUR'AN & BUKU UNTUK GENERASI QUR'ANI");
        }
        if (!SiteSetting::get('wakaf_bank_name')) {
            SiteSetting::set('wakaf_bank_name', 'Bank Syariah Indonesia (BSI)');
        }
        if (!SiteSetting::get('wakaf_account_no')) {
            SiteSetting::set('wakaf_account_no', '7148888999');
        }
        if (!SiteSetting::get('wakaf_account_name')) {
            SiteSetting::set('wakaf_account_name', 'PENERBIT PERSIS WAKAF');
        }
        if (!SiteSetting::get('wakaf_article_url')) {
            SiteSetting::set('wakaf_article_url', '/berita/program-wakaf-al-quran-dan-buku');
        }
        if (!SiteSetting::get('wakaf_contact_wa')) {
            SiteSetting::set('wakaf_contact_wa', '6281234567890');
        }
        if (!SiteSetting::get('wakaf_active')) {
            SiteSetting::set('wakaf_active', '1');
        }

        // 3. Setup Articles (Including Full Official Wakaf Program)
        $articles = [
            [
                'title' => 'Program Wakaf Al-Qur’an dan Buku: Menghidupkan Literasi, Menebarkan Ilmu, Mengalirkan Pahala',
                'slug' => 'program-wakaf-al-quran-dan-buku',
                'category_id' => $catWakaf->id,
                'author_id' => $authorId,
                'thumbnail' => 'https://images.unsplash.com/photo-1609599006353-e629aaabfeae?q=80&w=1200&auto=format&fit=crop',
                'excerpt' => 'Penerbit Persis menghadirkan Program Wakaf Al-Qur’an dan Buku sebagai ikhtiar untuk memperluas akses umat Islam terhadap Al-Qur’an dan berbagai sumber ilmu pengetahuan yang bermanfaat.',
                'content' => '<p class="lead font-medium text-slate-800 text-base leading-relaxed"><strong>Penerbit Persis</strong> menghadirkan <strong>Program Wakaf Al-Qur’an dan Buku</strong> sebagai ikhtiar untuk memperluas akses umat Islam terhadap Al-Qur’an dan berbagai sumber ilmu pengetahuan yang bermanfaat.</p>

<p>Program ini membuka kesempatan bagi masyarakat untuk turut berwakaf dalam bentuk Al-Qur’an dan buku-buku keislaman serta keilmuan yang akan dicetak dan disalurkan kepada pihak-pihak yang membutuhkan.</p>

<!-- Rekening Wakaf Box Callout -->
<div class="my-8 p-6 bg-emerald-50/90 border border-emerald-300 rounded-sm shadow-sm space-y-4">
    <div class="flex items-center gap-3 pb-3 border-b border-emerald-200">
        <div class="w-10 h-10 rounded-full bg-[#006830] text-white flex items-center justify-center text-lg shadow-xs">
            <i class="fa-solid fa-hand-holding-heart"></i>
        </div>
        <div>
            <span class="text-[10px] font-black uppercase tracking-widest text-emerald-800">REKENING RESMI WAKAF</span>
            <h4 class="text-base font-extrabold text-slate-900 leading-tight">Saluran Wakaf Al-Qur\'an &amp; Buku</h4>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
        <div class="space-y-1 bg-white p-3.5 rounded-sm border border-emerald-200">
            <span class="text-slate-500 font-medium block">Transfer Bank Syariah:</span>
            <div class="font-bold text-slate-900 text-sm">Bank Syariah Indonesia (BSI)</div>
            <div class="text-xs text-slate-600">No. Rekening: <strong class="text-slate-950 font-mono text-sm select-all">7148888999</strong></div>
            <div class="text-[11px] text-slate-500">Atas Nama: <strong class="text-emerald-900">PENERBIT PERSIS WAKAF</strong></div>
        </div>
        <div class="space-y-2 bg-white p-3.5 rounded-sm border border-emerald-200 flex flex-col justify-between">
            <span class="text-slate-500 font-medium block">Konfirmasi / Layanan Wakaf:</span>
            <a href="https://wa.me/6281234567890?text=Assalamu%27alaikum%20Admin%20Penerbit%20Persis%2C%20saya%20ingin%20konfirmasi%20Wakaf%20Al-Qur%27an%20dan%20Buku" target="_blank" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-[#006830] hover:bg-[#032c21] text-white font-bold rounded-xs transition text-xs shadow-xs">
                <i class="fa-brands fa-whatsapp text-sm text-lime-300"></i>
                <span>Konfirmasi Wakaf via WhatsApp</span>
            </a>
        </div>
    </div>
</div>

<h3>📖 Wakaf yang Menghidupkan Ilmu</h3>
<p>Wakaf yang terkumpul akan digunakan untuk mencetak dan menyediakan Al-Qur’an serta berbagai buku yang memiliki nilai edukatif dan keilmuan.</p>
<p>Tidak hanya Al-Qur’an, program ini juga mendukung penyediaan buku-buku yang dapat memperkaya wawasan umat dalam bidang <strong>Al-Qur’an, hadis, fikih, akidah, pendidikan, sejarah Islam, dakwah, sosial, ekonomi Islam</strong>, dan berbagai bidang keilmuan lainnya.</p>
<p>Dengan demikian, wakaf yang diberikan diharapkan tidak hanya menghadirkan mushaf Al-Qur’an, tetapi juga membuka jalan bagi umat untuk membaca, belajar, memahami, dan mengembangkan ilmu.</p>

<h3>🕌 Disalurkan kepada yang Membutuhkan</h3>
<p>Al-Qur’an dan buku-buku yang dicetak melalui program wakaf ini akan disalurkan kepada berbagai lembaga dan tempat yang membutuhkan, antara lain:</p>

<ul class="space-y-1.5 my-4">
    <li>📚 <strong>Perpustakaan masjid</strong></li>
    <li>🕌 <strong>Masjid dan musala</strong></li>
    <li>🏫 <strong>Pesantren</strong></li>
    <li>📖 <strong>Madrasah dan lembaga pendidikan Islam</strong></li>
    <li>🏢 <strong>Lembaga dakwah dan sosial</strong></li>
    <li>📚 <strong>Perpustakaan sekolah dan perguruan tinggi</strong></li>
    <li>👨‍👩‍👧‍👦 <strong>Komunitas dan majelis ilmu</strong></li>
    <li>🌍 <strong>Masyarakat dan daerah yang membutuhkan</strong></li>
    <li>🏛️ <strong>Lembaga-lembaga Islam lainnya</strong></li>
</ul>

<p>Penyaluran dilakukan sebagai upaya menghadirkan bahan bacaan yang bermanfaat dan mendukung tumbuhnya budaya membaca serta belajar di tengah umat.</p>

<h3>🌱 Dari Wakaf Menjadi Ilmu yang Terus Mengalir</h3>
<blockquote class="my-6 p-4 bg-slate-50 border-l-4 border-[#006830] italic text-slate-700 text-sm leading-relaxed rounded-r-sm">
    "Bayangkan satu Al-Qur’an yang Anda wakafkan kemudian dibaca oleh puluhan, ratusan, bahkan ribuan orang. Bayangkan pula sebuah buku yang Anda ikut wakafkan menjadi sumber ilmu bagi seorang santri, pelajar, guru, dai, mahasiswa, atau masyarakat yang sedang mencari pengetahuan. Setiap kali Al-Qur’an dibaca dan setiap kali ilmu dari buku dipelajari serta diamalkan, insyaallah menjadi bagian dari kebaikan yang terus mengalir."
</blockquote>

<p>Inilah semangat wakaf ilmu: <em>menghadirkan manfaat yang terus hidup melalui bacaan, pembelajaran, dan pengamalan</em>.</p>

<h3>🤲 Mari Bersama Membangun Peradaban Ilmu</h3>
<p>Melalui Program Wakaf Al-Qur’an dan Buku Penerbit Persis, mari kita bersama-sama membangun budaya literasi dan memperkuat tradisi keilmuan umat Islam.</p>

<p>Wakaf Anda hari ini dapat menjadi:</p>
<ul>
    <li>Al-Qur’an yang dibaca</li>
    <li>Buku yang dipelajari</li>
    <li>Ilmu yang diamalkan</li>
    <li>Kebaikan yang terus dikenang</li>
</ul>

<div class="my-8 p-6 bg-slate-900 text-white rounded-sm border border-slate-800 text-center space-y-3">
    <span class="text-xs uppercase tracking-widest text-emerald-400 font-bold font-mono">WAKAF AL-QUR\'AN DAN BUKU ANDA</span>
    <h4 class="text-lg sm:text-xl font-extrabold text-white font-heading">Bukan sekadar mencetak buku. Bukan sekadar menyalurkan mushaf. Tetapi bersama-sama menghadirkan ilmu untuk umat.</h4>
    <p class="text-xs text-slate-300 max-w-xl mx-auto">Mari Berwakaf. Mari Tebarkan Al-Qur’an. Mari Wakafkan Ilmu. Mari Bangun Peradaban.</p>
    <div class="pt-2">
        <a href="https://wa.me/6281234567890?text=Assalamu%27alaikum%20Admin%20Penerbit%20Persis%2C%20saya%20ingin%20berwakaf%20Al-Qur%27an%20dan%20Buku" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 bg-lime-400 hover:bg-lime-500 text-slate-950 font-black text-xs uppercase tracking-wider rounded-xs transition shadow-md">
            <i class="fa-brands fa-whatsapp text-sm"></i>
            <span>Salurkan Wakaf Sekarang</span>
        </a>
    </div>
</div>

<p class="text-center font-bold text-slate-900 text-sm mt-6">
<strong>Penerbit Persis</strong><br>
<span class="text-xs text-slate-500 font-normal">Menghadirkan karya, menyebarkan ilmu, dan menebarkan manfaat untuk umat.</span>
</p>',
                'status' => 'published',
                'is_featured' => true,
                'views_count' => 320,
                'tags' => 'wakaf alquran, wakaf buku, literasi islam, penerbit persis, amal jariyah',
                'published_at' => now(),
            ],
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
