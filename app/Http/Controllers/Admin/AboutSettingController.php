<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AboutSettingController extends Controller
{
    public function index()
    {
        $about = [
            'about_banner_badge' => SiteSetting::get('about_banner_badge', 'Mengenal Lembaga'),
            'about_banner_title' => SiteSetting::get('about_banner_title', 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah'),
            'about_banner_desc' => SiteSetting::get('about_banner_desc', 'PERSIS PERS adalah unit penerbitan dan percetakan resmi di bawah naungan Penerbitan & Percetakan PERSIS PERS, berdedikasi dalam menyebarluaskan khazanah keilmuan Islam dan literasi akademik berkualitas.'),

            'about_profile_title' => SiteSetting::get('about_profile_title', 'Komitmen Membangun Peradaban Literasi & Riset Akademik'),
            'about_profile_story_1' => SiteSetting::get('about_profile_story_1', 'PERSIS PERS didirikan sebagai wujud nyata komitmen PERSIS PERS (PERSIS PERS) Bandung dalam menjembatani hasil riset, gagasan akademik para dosen, peneliti, dan sivitas akademika agar dapat bertransformasi menjadi karya buku bermutu tinggi yang ber-ISBN dan tersebar luas ke masyarakat umum.'),
            'about_profile_story_2' => SiteSetting::get('about_profile_story_2', 'Kami melayani penerbitan buku ajar perguruan tinggi, monograf, buku referensi, konversi karya tulis ilmiah (skripsi, tesis, disertasi), hingga jurnal ilmiah. Dilengkapi divisi percetakan mandiri dengan mesin offset dan digital printing modern, kami menjamin kualitas cetak, kerapian tata letak (layout), dan desain sampul yang estetik serta presisi.'),
            'about_feature_1' => SiteSetting::get('about_feature_1', 'Proses Peer-Review Berstandar Ilmiah'),
            'about_feature_2' => SiteSetting::get('about_feature_2', 'Pengurusan ISBN & KDT Resmi Perpusnas'),
            'about_feature_3' => SiteSetting::get('about_feature_3', 'Mesin Cetak Offset & Digital Mandiri'),
            'about_feature_4' => SiteSetting::get('about_feature_4', 'Pendampingan Naskah Sampai Terbit'),

            'about_vision' => SiteSetting::get('about_vision', 'Menjadi lembaga penerbitan dan percetakan perguruan tinggi Islam yang unggul, profesional, dan bereputasi nasional dalam pengembangan literasi Islam serta hilirisasi karya ilmiah terintegrasi pada tahun 2030.'),
            'about_mission_1' => SiteSetting::get('about_mission_1', 'Menerbitkan buku-buku ilmiah, buku ajar, dan referensi berstandar nasional dengan proses peer-review yang objektif dan ketat.'),
            'about_mission_2' => SiteSetting::get('about_mission_2', 'Memberikan layanan pendampingan penulisan, penyuntingan bahasa (editing), tata letak (layout), dan desain sampul secara profesional.'),
            'about_mission_3' => SiteSetting::get('about_mission_3', 'Memfasilitasi pengurusan legalitas resmi penerbitan (ISBN, KDT, e-ISBN) bekerjasama dengan Perpustakaan Nasional RI.'),
            'about_mission_4' => SiteSetting::get('about_mission_4', 'Menyediakan layanan percetakan berkualitas tinggi dengan teknologi modern yang cepat, presisi, dan harga terjangkau.'),

            'about_stat_books' => SiteSetting::get('about_stat_books', '150+'),
            'about_stat_authors' => SiteSetting::get('about_stat_authors', '80+'),
            'about_stat_isbn' => SiteSetting::get('about_stat_isbn', '100%'),
            'about_stat_copies' => SiteSetting::get('about_stat_copies', '25.000+'),

            'about_director_name' => SiteSetting::get('about_director_name', 'Dr. H. Ahmad Fauzi, M.Ag.'),
            'about_director_title' => SiteSetting::get('about_director_title', 'Kepala Unit Penerbitan & Percetakan'),
            'about_editor_chief' => SiteSetting::get('about_editor_chief', 'Nurul Hidayah, M.Pd.'),
            'about_editor_chief_title' => SiteSetting::get('about_editor_chief_title', 'Editor Pelaksana & Mutu Naskah'),
            'about_production_lead' => SiteSetting::get('about_production_lead', 'M. Zaki Farhan, S.Kom.'),
            'about_production_lead_title' => SiteSetting::get('about_production_lead_title', 'Kepala Produksi & Percetakan'),
        ];

        return view('admin.settings.about', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'about_banner_badge' => ['required', 'string', 'max:100'],
            'about_banner_title' => ['required', 'string', 'max:255'],
            'about_banner_desc' => ['required', 'string'],

            'about_profile_title' => ['required', 'string', 'max:255'],
            'about_profile_story_1' => ['required', 'string'],
            'about_profile_story_2' => ['required', 'string'],
            'about_feature_1' => ['nullable', 'string', 'max:255'],
            'about_feature_2' => ['nullable', 'string', 'max:255'],
            'about_feature_3' => ['nullable', 'string', 'max:255'],
            'about_feature_4' => ['nullable', 'string', 'max:255'],

            'about_vision' => ['required', 'string'],
            'about_mission_1' => ['required', 'string'],
            'about_mission_2' => ['required', 'string'],
            'about_mission_3' => ['required', 'string'],
            'about_mission_4' => ['required', 'string'],

            'about_stat_books' => ['required', 'string', 'max:50'],
            'about_stat_authors' => ['required', 'string', 'max:50'],
            'about_stat_isbn' => ['required', 'string', 'max:50'],
            'about_stat_copies' => ['required', 'string', 'max:50'],

            'about_director_name' => ['required', 'string', 'max:150'],
            'about_director_title' => ['required', 'string', 'max:150'],
            'about_editor_chief' => ['required', 'string', 'max:150'],
            'about_editor_chief_title' => ['required', 'string', 'max:150'],
            'about_production_lead' => ['required', 'string', 'max:150'],
            'about_production_lead_title' => ['required', 'string', 'max:150'],
        ], [
            'required' => ':attribute wajib diisi.',
            'max'      => ':attribute maksimal :max karakter.',
            'string'   => ':attribute harus berupa teks valid.',
        ], [
            'about_banner_badge'          => 'Badge Banner',
            'about_banner_title'          => 'Judul Utama Banner',
            'about_banner_desc'           => 'Deskripsi Banner',
            'about_profile_title'         => 'Judul Bagian Profil',
            'about_profile_story_1'       => 'Paragraf 1 Cerita Profil',
            'about_profile_story_2'       => 'Paragraf 2 Cerita Profil',
            'about_feature_1'             => 'Keunggulan 1',
            'about_feature_2'             => 'Keunggulan 2',
            'about_feature_3'             => 'Keunggulan 3',
            'about_feature_4'             => 'Keunggulan 4',
            'about_vision'                => 'Visi Lembaga',
            'about_mission_1'             => 'Misi 1',
            'about_mission_2'             => 'Misi 2',
            'about_mission_3'             => 'Misi 3',
            'about_mission_4'             => 'Misi 4',
            'about_stat_books'            => 'Statistik Judul Buku',
            'about_stat_authors'          => 'Statistik Penulis',
            'about_stat_isbn'             => 'Statistik ISBN',
            'about_stat_copies'           => 'Statistik Eksemplar',
            'about_director_name'         => 'Nama Direktur',
            'about_director_title'        => 'Jabatan Direktur',
            'about_editor_chief'          => 'Nama Pemimpin Redaksi',
            'about_editor_chief_title'    => 'Jabatan Pemimpin Redaksi',
            'about_production_lead'       => 'Nama Manajer Produksi',
            'about_production_lead_title' => 'Jabatan Manajer Produksi',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Konten Halaman Tentang Kami berhasil diperbarui dan langsung aktif di website!');
    }
}
