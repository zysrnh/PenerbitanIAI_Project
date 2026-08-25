<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $about = [
            // Banner
            'banner_badge' => SiteSetting::get('about_banner_badge', 'Mengenal Lembaga'),
            'banner_title' => SiteSetting::get('about_banner_title', 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah'),
            'banner_desc' => SiteSetting::get('about_banner_desc', 'IAI PERSIS PRESS adalah unit penerbitan dan percetakan resmi di bawah naungan Institut Agama Islam Persatuan Islam Bandung, berdedikasi dalam menyebarluaskan khazanah keilmuan Islam dan literasi akademik berkualitas.'),

            // Profil & Sejarah
            'profile_title' => SiteSetting::get('about_profile_title', 'Komitmen Membangun Peradaban Literasi & Riset Akademik'),
            'profile_story_1' => SiteSetting::get('about_profile_story_1', 'IAI PERSIS PRESS didirikan sebagai wujud nyata komitmen Institut Agama Islam Persatuan Islam (IAI PERSIS) Bandung dalam menjembatani hasil riset, gagasan akademik para dosen, peneliti, dan sivitas akademika agar dapat bertransformasi menjadi karya buku bermutu tinggi yang ber-ISBN dan tersebar luas ke masyarakat umum.'),
            'profile_story_2' => SiteSetting::get('about_profile_story_2', 'Kami melayani penerbitan buku ajar perguruan tinggi, monograf, buku referensi, konversi karya tulis ilmiah (skripsi, tesis, disertasi), hingga jurnal ilmiah. Dilengkapi divisi percetakan mandiri dengan mesin offset dan digital printing modern, kami menjamin kualitas cetak, kerapian tata letak (layout), dan desain sampul yang estetik serta presisi.'),

            // Visi & Misi
            'vision' => SiteSetting::get('about_vision', 'Menjadi lembaga penerbitan dan percetakan perguruan tinggi Islam yang unggul, profesional, dan bereputasi nasional dalam pengembangan literasi Islam serta hilirisasi karya ilmiah terintegrasi pada tahun 2030.'),
            'mission_1' => SiteSetting::get('about_mission_1', 'Menerbitkan buku-buku ilmiah, buku ajar, dan referensi berstandar nasional dengan proses peer-review yang objektif dan ketat.'),
            'mission_2' => SiteSetting::get('about_mission_2', 'Memberikan layanan pendampingan penulisan, penyuntingan bahasa (editing), tata letak (layout), dan desain sampul secara profesional.'),
            'mission_3' => SiteSetting::get('about_mission_3', 'Memfasilitasi pengurusan legalitas resmi penerbitan (ISBN, KDT, e-ISBN) bekerjasama dengan Perpustakaan Nasional RI.'),
            'mission_4' => SiteSetting::get('about_mission_4', 'Menyediakan layanan percetakan berkualitas tinggi dengan teknologi modern yang cepat, presisi, dan harga terjangkau.'),

            // Statistik Pencapaian
            'stat_books' => SiteSetting::get('about_stat_books', '150+'),
            'stat_authors' => SiteSetting::get('about_stat_authors', '80+'),
            'stat_isbn' => SiteSetting::get('about_stat_isbn', '100%'),
            'stat_copies' => SiteSetting::get('about_stat_copies', '25.000+'),

            // Struktur Tim / Dewan Redaksi
            'director_name' => SiteSetting::get('about_director_name', 'Dr. H. Ahmad Fauzi, M.Ag.'),
            'director_title' => SiteSetting::get('about_director_title', 'Kepala Unit Penerbitan & Percetakan'),
            
            'editor_chief' => SiteSetting::get('about_editor_chief', 'Nurul Hidayah, M.Pd.'),
            'editor_chief_title' => SiteSetting::get('about_editor_chief_title', 'Editor Pelaksana & Mutu Naskah'),

            'production_lead' => SiteSetting::get('about_production_lead', 'M. Zaki Farhan, S.Kom.'),
            'production_lead_title' => SiteSetting::get('about_production_lead_title', 'Kepala Produksi & Percetakan'),
        ];

        return view('tentang', compact('about'));
    }
}
