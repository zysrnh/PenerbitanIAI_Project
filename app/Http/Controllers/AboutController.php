<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $bannerBadge = SiteSetting::get('about_banner_badge', 'Mengenal Lembaga');
        $bannerTitle = SiteSetting::get('about_banner_title', 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah');
        $bannerDesc = SiteSetting::get('about_banner_desc', 'PERSIS PERS adalah unit penerbitan dan percetakan resmi di bawah naungan Penerbitan & Percetakan PERSIS PERS, berdedikasi dalam menyebarluaskan khazanah keilmuan Islam dan literasi akademik berkualitas.');

        $profileTitle = SiteSetting::get('about_profile_title', 'Komitmen Membangun Peradaban Literasi & Riset Akademik');
        $profileStory1 = SiteSetting::get('about_profile_story_1', 'PERSIS PERS didirikan sebagai wujud nyata komitmen PERSIS PERS (PERSIS PERS) Bandung dalam menjembatani hasil riset, gagasan akademik para dosen, peneliti, dan civitas akademika agar dapat bertransformasi menjadi karya buku bermutu tinggi yang ber-ISBN dan tersebar luas ke masyarakat umum.');
        $profileStory2 = SiteSetting::get('about_profile_story_2', 'Kami melayani penerbitan buku ajar perguruan tinggi, monograf, buku referensi, konversi karya tulis ilmiah (skripsi, tesis, disertasi), hingga jurnal ilmiah. Dilengkapi divisi percetakan mandiri dengan mesin offset dan digital printing modern, kami menjamin kualitas cetak, kerapian tata letak (layout), dan desain sampul yang estetik serta presisi.');

        $feature1 = SiteSetting::get('about_feature_1', 'Proses Peer-Review Berstandar Ilmiah');
        $feature2 = SiteSetting::get('about_feature_2', 'Pengurusan ISBN & KDT Resmi Perpusnas');
        $feature3 = SiteSetting::get('about_feature_3', 'Mesin Cetak Offset & Digital Mandiri');
        $feature4 = SiteSetting::get('about_feature_4', 'Pendampingan Naskah Sampai Terbit');

        $vision = SiteSetting::get('about_vision', 'Menjadi lembaga penerbitan dan percetakan perguruan tinggi Islam yang unggul, profesional, dan bereputasi nasional dalam pengembangan literasi Islam serta hilirisasi karya ilmiah terintegrasi pada tahun 2030.');
        $mission1 = SiteSetting::get('about_mission_1', 'Menerbitkan buku-buku ilmiah, buku ajar, dan referensi berstandar nasional dengan proses peer-review yang objektif dan ketat.');
        $mission2 = SiteSetting::get('about_mission_2', 'Memberikan layanan pendampingan penulisan, penyuntingan bahasa (editing), tata letak (layout), dan desain sampul secara profesional.');
        $mission3 = SiteSetting::get('about_mission_3', 'Memfasilitasi pengurusan legalitas resmi penerbitan (ISBN, KDT, e-ISBN) bekerjasama dengan Perpustakaan Nasional RI.');
        $mission4 = SiteSetting::get('about_mission_4', 'Menyediakan layanan percetakan berkualitas tinggi dengan teknologi modern yang cepat, presisi, dan harga terjangkau.');

        $statBooks = SiteSetting::get('about_stat_books', '150+');
        $statAuthors = SiteSetting::get('about_stat_authors', '80+');
        $statIsbn = SiteSetting::get('about_stat_isbn', '100%');
        $statCopies = SiteSetting::get('about_stat_copies', '25.000+');

        $dirName = SiteSetting::get('about_director_name', 'Dr. H. Ahmad Fauzi, M.Ag.');
        $dirTitle = SiteSetting::get('about_director_title', 'Kepala Unit Penerbitan & Percetakan');
        $editChief = SiteSetting::get('about_editor_chief', 'Nurul Hidayah, M.Pd.');
        $editTitle = SiteSetting::get('about_editor_chief_title', 'Editor Pelaksana & Mutu Naskah');
        $prodLead = SiteSetting::get('about_production_lead', 'M. Zaki Farhan, S.Kom.');
        $prodTitle = SiteSetting::get('about_production_lead_title', 'Kepala Produksi & Percetakan');

        $about = [
            // With about_ prefix
            'about_banner_badge' => $bannerBadge,
            'about_banner_title' => $bannerTitle,
            'about_banner_desc' => $bannerDesc,
            'about_profile_title' => $profileTitle,
            'about_profile_story_1' => $profileStory1,
            'about_profile_story_2' => $profileStory2,
            'about_feature_1' => $feature1,
            'about_feature_2' => $feature2,
            'about_feature_3' => $feature3,
            'about_feature_4' => $feature4,
            'about_vision' => $vision,
            'about_mission_1' => $mission1,
            'about_mission_2' => $mission2,
            'about_mission_3' => $mission3,
            'about_mission_4' => $mission4,
            'about_stat_books' => $statBooks,
            'about_stat_authors' => $statAuthors,
            'about_stat_isbn' => $statIsbn,
            'about_stat_copies' => $statCopies,
            'about_director_name' => $dirName,
            'about_director_title' => $dirTitle,
            'about_editor_chief' => $editChief,
            'about_editor_chief_title' => $editTitle,
            'about_production_lead' => $prodLead,
            'about_production_lead_title' => $prodTitle,

            // Without about_ prefix (Aliases)
            'banner_badge' => $bannerBadge,
            'banner_title' => $bannerTitle,
            'banner_desc' => $bannerDesc,
            'profile_title' => $profileTitle,
            'profile_story_1' => $profileStory1,
            'profile_story_2' => $profileStory2,
            'feature_1' => $feature1,
            'feature_2' => $feature2,
            'feature_3' => $feature3,
            'feature_4' => $feature4,
            'vision' => $vision,
            'mission_1' => $mission1,
            'mission_2' => $mission2,
            'mission_3' => $mission3,
            'mission_4' => $mission4,
            'stat_books' => $statBooks,
            'stat_authors' => $statAuthors,
            'stat_isbn' => $statIsbn,
            'stat_copies' => $statCopies,
            'director_name' => $dirName,
            'director_title' => $dirTitle,
            'editor_chief' => $editChief,
            'editor_chief_title' => $editTitle,
            'production_lead' => $prodLead,
            'production_lead_title' => $prodTitle,
        ];

        return view('tentang', compact('about'));
    }
}
