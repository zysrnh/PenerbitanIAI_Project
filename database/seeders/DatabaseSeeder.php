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
            'contact_wa_default_msg' => 'Halo Redaksi PERSIS PERS, saya ingin berkonsultasi mengenai penerbitan naskah buku.',
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
        ];

        foreach ($settings as $k => $v) {
            SiteSetting::set($k, $v);
        }
    }
}
