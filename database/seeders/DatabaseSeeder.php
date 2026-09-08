<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed All Specialized Admin Roles
        $this->call(AdminSeeder::class);
        $this->call(ArticleSeeder::class);

        // 3. Default Contact & About Settings
        $settings = [
            // Contact Settings
            'contact_banner_badge' => 'Layanan & Informasi',
            'contact_banner_title' => 'Hubungi Kami & Layanan Redaksi',
            'contact_banner_desc' => 'Konsultasikan naskah buku, kebutuhan cetak, pengurusan ISBN, atau publikasi ilmiah bersama tim Persis Pers. Kami siap membantu Anda.',
            'contact_address' => 'Kantor Redaksi PERSIS PERS, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287',
            'contact_whatsapp' => '082116116133',
            'contact_phone' => '(022) 5441951',
            'contact_email' => 'info@penerbitpersis.com',
            'contact_email_note' => 'Respon cepat 1x24 jam kerja',
            'contact_hours' => 'Senin - Jumat: 08:00 - 16:00 WIB',
            'contact_hours_weekend' => 'Sabtu & Minggu: Tutup',
            'contact_wa_box_title' => 'Konsultasi Cepat (WhatsApp)',
            'contact_wa_box_subtitle' => 'Langsung terhubung dengan Tim Redaksi',
            'contact_wa_box_desc' => 'Ingin konsultasi langsung terkait naskah buku, estimasi biaya cetak, atau panduan ISBN? Klik tombol di bawah untuk memulai chat WhatsApp resmi.',
            'contact_wa_btn_text' => 'CHAT WHATSAPP SEKARANG',
            'contact_wa_default_msg' => 'Assalamualaikum Redaksi Penerbit Persis, saya ingin berkonsultasi mengenai penerbitan naskah buku.',
            'contact_maps_title' => 'Lokasi Kantor Redaksi & Percetakan',
            'contact_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2974465063073!2d107.63660527587638!3d-6.974191668289417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9af8d8c919d%3A0xe96841b53fa976df!2sPERSIS%20PERS%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
            'contact_maps_external_url' => 'https://maps.app.goo.gl/uXpW7mS6V8n5fF9w8',
            'notification_recipient_email' => 'zakiyh782@gmail.com',

            // About Us Settings
            'about_banner_badge' => 'Mengenal Lembaga',
            'about_banner_title' => 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah',
            'about_banner_desc' => 'PERSIS PERS adalah unit penerbitan dan percetakan resmi di bawah naungan Penerbitan & Percetakan PERSIS PERS, berdedikasi dalam menyebarluaskan khazanah keilmuan Islam dan literasi akademik berkualitas.',
            'about_profile_title' => 'Komitmen Membangun Peradaban Literasi & Riset Akademik',
            'about_profile_story_1' => 'PERSIS PERS didirikan sebagai wujud nyata komitmen PERSIS PERS (PERSIS PERS) Bandung dalam menjembatani hasil riset, gagasan akademik para dosen, peneliti, dan civitas akademika agar dapat bertransformasi menjadi karya buku bermutu tinggi yang ber-ISBN dan tersebar luas ke masyarakat umum.',
            'about_profile_story_2' => 'Kami melayani penerbitan buku ajar perguruan tinggi, monograf, buku referensi, konversi karya tulis ilmiah (skripsi, tesis, disertasi), hingga jurnal ilmiah. Dilengkapi divisi percetakan mandiri dengan mesin offset dan digital printing modern, kami menjamin kualitas cetak, kerapian tata letak (layout), dan desain sampul yang estetik serta presisi.',
            'about_feature_1' => 'Proses Peer-Review Berstandar Ilmiah',
            'about_feature_2' => 'Pengurusan ISBN & KDT Resmi Perpusnas',
            'about_feature_3' => 'Mesin Cetak Offset & Digital Mandiri',
            'about_feature_4' => 'Pendampingan Naskah Sampai Terbit',
            'about_vision' => 'Menjadi lembaga penerbitan dan percetakan perguruan tinggi Islam yang unggul, profesional, dan bereputasi nasional dalam pengembangan literasi Islam serta hilirisasi karya ilmiah terintegrasi pada tahun 2030.',
            'about_mission_1' => 'Menerbitkan buku-buku ilmiah, buku ajar, dan referensi berstandar nasional dengan proses peer-review yang objektif dan ketat.',
            'about_mission_2' => 'Memberikan layanan pendampingan penulisan, penyuntingan bahasa (editing), tata letak (layout), dan desain sampul secara profesional.',
            'about_mission_3' => 'Memfasilitasi pengurusan legalitas resmi penerbitan (ISBN, KDT, e-ISBN) bekerjasama dengan Perpustakaan Nasional RI.',
            'about_mission_4' => 'Menyediakan layanan percetakan berkualitas tinggi dengan teknologi modern yang cepat, presisi, dan harga terjangkau.',
            'about_stat_books' => '150+',
            'about_stat_authors' => '80+',
            'about_stat_isbn' => '100%',
            'about_stat_copies' => '25.000+',
            'about_director_name' => 'Dr. H. Ahmad Fauzi, M.Ag.',
            'about_director_title' => 'Kepala Unit Penerbitan & Percetakan',
            'about_editor_chief' => 'Nurul Hidayah, M.Pd.',
            'about_editor_chief_title' => 'Editor Pelaksana & Mutu Naskah',
            'about_production_lead' => 'M. Zaki Farhan, S.Kom.',
            'about_production_lead_title' => 'Kepala Produksi & Percetakan',

            // News & Wakaf Widget Settings
            'news_banner_badge' => 'WARNA LITERASI & WARTA',
            'news_banner_title' => 'Kabar & Artikel Penerbitan',
            'news_banner_desc' => 'Temukan warta kegiatan, tips penulisan buku ber-ISBN, agenda workshop, serta pemikiran literasi Islam dari Penerbit Persis.',
            'news_promo_title' => 'Punya Naskah Buku Sendiri?',
            'news_promo_desc' => 'Konsultasikan naskah ilmiah, modul, atau buku keislaman Anda bersama tim profesional Penerbit Persis.',
            'wakaf_card_title' => "WAKAF AL-QUR'AN & BUKU UNTUK GENERASI QUR'ANI",
            'wakaf_bank_name' => 'Bank Syariah Indonesia (BSI)',
            'wakaf_account_no' => '7148888999',
            'wakaf_account_name' => 'PENERBIT PERSIS WAKAF',
            'wakaf_contact_wa' => '6281234567890',
            'wakaf_active' => '1',
            'wakaf_qris_image' => '',
            'wakaf_program_title' => 'PROGRAM WAKAF AL-QUR’AN DAN BUKU',
            'wakaf_program_subtitle' => 'Menghidupkan Literasi, Menebarkan Ilmu, Mengalirkan Pahala',
            'wakaf_content' => '<p class="lead font-medium text-slate-800 text-sm sm:text-base leading-relaxed"><strong>Penerbit Persis</strong> menghadirkan <strong>Program Wakaf Al-Qur’an dan Buku</strong> sebagai ikhtiar untuk memperluas akses umat Islam terhadap Al-Qur’an dan berbagai sumber ilmu pengetahuan yang bermanfaat.</p>

<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Program ini membuka kesempatan bagi masyarakat untuk turut berwakaf dalam bentuk Al-Qur’an dan buku-buku keislaman serta keilmuan yang akan dicetak dan disalurkan kepada pihak-pihak yang membutuhkan.</p>

<h4 class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2">📖 Wakaf yang Menghidupkan Ilmu</h4>
<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Wakaf yang terkumpul akan digunakan untuk mencetak dan menyediakan Al-Qur’an serta berbagai buku yang memiliki nilai edukatif dan keilmuan.</p>
<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Tidak hanya Al-Qur’an, program ini juga mendukung penyediaan buku-buku yang dapat memperkaya wawasan umat dalam bidang <strong>Al-Qur’an, hadis, fikih, akidah, pendidikan, sejarah Islam, dakwah, sosial, ekonomi Islam</strong>, dan berbagai bidang keilmuan lainnya.</p>
<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Dengan demikian, wakaf yang diberikan diharapkan tidak hanya menghadirkan mushaf Al-Qur’an, tetapi juga membuka jalan bagi umat untuk membaca, belajar, memahami, dan mengembangkan ilmu.</p>

<h4 class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2">🕌 Disalurkan kepada yang Membutuhkan</h4>
<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Al-Qur’an dan buku-buku yang dicetak melalui program wakaf ini akan disalurkan kepada berbagai lembaga dan tempat yang membutuhkan, antara lain:</p>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs sm:text-sm text-slate-700 py-1">
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>📚</span> <span>Perpustakaan masjid</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>🕌</span> <span>Masjid dan musala</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>🏫</span> <span>Pesantren</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>📖</span> <span>Madrasah &amp; lembaga pendidikan Islam</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>🏢</span> <span>Lembaga dakwah dan sosial</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>📚</span> <span>Perpustakaan sekolah &amp; kampus</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>👨‍👩‍👧‍👦</span> <span>Komunitas dan majelis ilmu</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>🌍</span> <span>Masyarakat &amp; daerah yang membutuhkan</span></div>
    <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200"><span>🏛️</span> <span>Lembaga-lembaga Islam lainnya</span></div>
</div>

<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Penyaluran dilakukan sebagai upaya menghadirkan bahan bacaan yang bermanfaat dan mendukung tumbuhnya budaya membaca serta belajar di tengah umat.</p>

<h4 class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2">🌱 Dari Wakaf Menjadi Ilmu yang Terus Mengalir</h4>
<blockquote class="p-4 bg-emerald-50/70 border-l-4 border-[#006830] italic text-slate-800 text-xs sm:text-sm leading-relaxed rounded-r-xs">
    "Bayangkan satu Al-Qur’an yang Anda wakafkan kemudian dibaca oleh puluhan, ratusan, bahkan ribuan orang. Bayangkan pula sebuah buku yang Anda ikut wakafkan menjadi sumber ilmu bagi seorang santri, pelajar, guru, dai, mahasiswa, atau masyarakat yang sedang mencari pengetahuan. Setiap kali Al-Qur’an dibaca dan setiap kali ilmu dari buku dipelajari serta diamalkan, insyaallah menjadi bagian dari kebaikan yang terus mengalir."
</blockquote>

<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Inilah semangat wakaf ilmu: <em>menghadirkan manfaat yang terus hidup melalui bacaan, pembelajaran, dan pengamalan</em>.</p>

<h4 class="text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2">🤲 Mari Bersama Membangun Peradaban Ilmu</h4>
<p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Melalui Program Wakaf Al-Qur’an dan Buku Penerbit Persis, mari kita bersama-sama membangun budaya literasi dan memperkuat tradisi keilmuan umat Islam.</p>

<p class="text-xs sm:text-sm font-semibold text-slate-800">Wakaf Anda hari ini dapat menjadi:</p>
<ul class="list-disc list-inside text-xs sm:text-sm text-slate-700 space-y-1 pl-2">
    <li>Al-Qur’an yang dibaca</li>
    <li>Buku yang dipelajari</li>
    <li>Ilmu yang diamalkan</li>
    <li>Kebaikan yang terus dikenang</li>
</ul>

<div class="my-4 p-5 bg-slate-900 text-white rounded-xs border border-slate-800 text-center space-y-2">
    <span class="text-[11px] uppercase tracking-widest text-emerald-400 font-bold font-mono">WAKAF AL-QUR\'AN DAN BUKU ANDA</span>
    <h5 class="text-sm sm:text-base font-black text-white font-heading">Bukan sekadar mencetak buku. Bukan sekadar menyalurkan mushaf. Tetapi bersama-sama menghadirkan ilmu untuk umat.</h5>
    <p class="text-xs text-slate-300 max-w-lg mx-auto">Mari Berwakaf. Mari Tebarkan Al-Qur’an. Mari Wakafkan Ilmu. Mari Bangun Peradaban.</p>
</div>',
        ];

        foreach ($settings as $k => $v) {
            SiteSetting::set($k, $v);
        }
    }
}
