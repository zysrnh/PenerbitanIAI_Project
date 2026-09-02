<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
 /**
 * Run the database seeds.
 */
 public function run(): void
 {
 // Truncate to ensure pristine clean data
 Service::truncate();

 $officialServices = [
 // LAYANAN 1: PENERBITAN BUKU
 [
 'title' => 'Penerbitan Buku',
 'slug' => 'penerbitan-buku',
 'icon' => 'fa-solid fa-book-open',
 'short_desc' => 'Layanan penerbitan buku secara profesional, mulai dari penelaahan naskah, penyuntingan, tata letak, hingga terbit ber-ISBN resmi.',
 'tagline' => '“Mewujudkan Gagasan Menjadi Karya Monumental yang Menginspirasi Umat.”',
 'banner_image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=1600&auto=format&fit=crop',
 'overview' => "Penerbit Persis melayani penerbitan berbagai jenis buku, baik karya perorangan, karya bersama (bunga rampai), maupun penerbitan institusi/organisasi.

Kami membantu penulis dalam seluruh rangkaian proses penerbitan secara profesional, mulai dari penelaahan naskah, penyuntingan (editing), penataan letak (layout), desain sampul, pengurusan ISBN, hingga pencetakan dan distribusi.",
 'features' => [
 'Penerbitan Buku Ber-ISBN Resmi Perpustakaan Nasional RI',
 'Penerbitan Buku Fisik (Cetak) & Buku Digital (E-Book)',
 'Penyuntingan Naskah (Tata Bahasa, Ejaan, dan Substansi)',
 'Tata Letak Isi (Layout Interior) Standar Buku Nasional & UNESCO',
 'Desain Sampul (Cover) Eksklusif dan Profesional',
 'Pencetakan Buku Berkualitas (Softcover & Hardcover)',
 'Bantuan Distribusi & Promosi Karya',
 ],
 'workflow_steps' => [
 [
 'step' => 1,
 'title' => 'Penyerahan & Telaah Naskah',
 'desc' => 'Penulis mengirimkan draf naskah lengkap. Tim redaksi melakukan telaah awal terkait tema, kelayakan, dan kesesuaian naskah.',
 ],
 [
 'step' => 2,
 'title' => 'Editing & Proofreading',
 'desc' => 'Penyuntingan bahasa, tata kalimat, ejaan, konsistensi istilah, dan keterbacaan naskah oleh editor profesional.',
 ],
 [
 'step' => 3,
 'title' => 'Layout & Desain Sampul',
 'desc' => 'Penataan halaman isi buku sesuai standar penerbitan serta perancangan desain sampul (cover) yang menarik dan representatif.',
 ],
 [
 'step' => 4,
 'title' => 'Pengurusan Legalitas & ISBN',
 'desc' => 'Pengajuan nomor ISBN resmi dan pencatatan Katalog Dalam Terbitan (KDT) melalui sistem Perpustakaan Nasional RI.',
 ],
 [
 'step' => 5,
 'title' => 'Persetujuan Cetak (Proofing)',
 'desc' => 'Pemeriksaan draf akhir (dummy) oleh penulis sebelum naik cetak untuk memastikan tidak ada kesalahan.',
 ],
 [
 'step' => 6,
 'title' => 'Pencetakan & Distribusi',
 'desc' => 'Buku dicetak dengan spesifikasi yang disepakati dan didistribusikan kepada penulis maupun jaringan pembaca.',
 ],
 ],
 'benefits' => "Jenis Buku yang Diterbitkan Penerbit Persis:
• Buku Keislaman & Dakwah
• Buku Akademik & Referensi Dosen
• Buku Hasil Penelitian Ilmiah
• Buku Pendidikan & Modul Ajar
• Buku Ajar Perguruan Tinggi
• Buku Anak & Keluarga Islami
• Buku Sosial, Humaniora & Pemikiran
• Buku Organisasi & Kelembagaan Jamiyyah",
 'notes' => 'Catatan: Setiap naskah yang masuk akan melalui proses telaah etik dan kesesuaian nilai keilmuan oleh Dewan Redaksi Penerbit Persis.',
 'faqs' => [
 [
 'q' => 'Apakah penulis luar (umum) bisa menerbitkan buku di Penerbit Persis?',
 'a' => 'Bisa. Penerbit Persis terbuka untuk dosen, guru, peneliti, akademisi, aktivis, dai, mahasiswa, dan masyarakat umum yang memiliki karya tulis berkualitas.',
 ],
 [
 'q' => 'Berapa minimal jumlah eksemplar untuk cetak buku?',
 'a' => 'Kami melayani sistem Print on Demand (POD) mulai dari jumlah terbatas (puluhan eksemplar) hingga cetak massal (ribuan eksemplar) sesuai kebutuhan penulis.',
 ],
 [
 'q' => 'Berapa lama proses penerbitan dari naskah masuk hingga terbit?',
 'a' => 'Rata-rata proses penerbitan memakan waktu 2 hingga 4 minggu tergantung kesiapan naskah dan antrean verifikasi ISBN Perpusnas.',
 ],
 ],
 'cta_text' => 'Konsultasi Penerbitan Buku',
 'order' => 1,
 'status' => 'published',
 ],

 // LAYANAN 2: KONVERSI KARYA ILMIAH MENJADI BUKU
 [
 'title' => 'Konversi KTI Menjadi Buku',
 'slug' => 'konversi-kti',
 'icon' => 'fa-solid fa-graduation-cap',
 'short_desc' => 'Ubah skripsi, tesis, disertasi, atau laporan penelitian menjadi buku referensi/monograf yang populer dan ber-ISBN.',
 'tagline' => '“Transformasi Riset Akademik Menjadi Buku Bernilai Tambah dan Luas Manfaatnya.”',
 'banner_image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1600&auto=format&fit=crop',
 'overview' => "Banyak karya ilmiah seperti skripsi, tesis, disertasi, dan laporan riset hanya tersimpan di perpustakaan atau repositori digital. Melalui layanan ini, kami membantu mengonversi laporan ilmiah kaku menjadi buku monograf, buku referensi, atau buku populer yang nyaman dibaca publik luas tanpa menghilangkan substansi keilmuannya.",
 'features' => [
 'Restrukturisasi format laporan riset kaku (Bab I-V) menjadi bab tematik buku',
 'Penyuntingan bahasa ilmiah agar lebih komunikatif dan mengalir enak dibaca',
 'Penataan ulang tinjauan pustaka, metodologi, dan data riset',
 'Pengayaan konteks bacaan untuk jangkauan pembaca yang lebih luas',
 'Tata letak interior buku standar penerbitan nasional',
 'Perancangan desain cover profesional dan representatif',
 'Pengurusan ISBN dan penerbitan resmi bernilai KUM bagi akademisi',
 ],
 'workflow_steps' => [
 [
 'step' => 1,
 'title' => 'Analisis Naskah Riset',
 'desc' => 'Menelaah substansi, tema utama, dan kelayakan naskah karya ilmiah asli.',
 ],
 [
 'step' => 2,
 'title' => 'Penyusunan Struktur Buku',
 'desc' => 'Menyusun kembali kerangka naskah dari format laporan kaku menjadi bab buku tematik yang sistematis.',
 ],
 [
 'step' => 3,
 'title' => 'Editing & Penyederhanaan Bahasa',
 'desc' => 'Parafrase kalimat ilmiah agar lebih komunikatif, renyah, dan mengalir enak dibaca.',
 ],
 [
 'step' => 4,
 'title' => 'Penyesuaian Isi & Konteks',
 'desc' => 'Penyelarasan referensi, pengayaan konteks, dan penyesuaian materi dengan target pembaca luas.',
 ],
 [
 'step' => 5,
 'title' => 'Desain & Layout Standar',
 'desc' => 'Tata letak interior buku standar penerbitan nasional dan perancangan desain sampul (cover) menarik.',
 ],
 [
 'step' => 6,
 'title' => 'ISBN & Publikasi Resmi',
 'desc' => 'Pengurusan nomor legalitas ISBN resmi Perpustakaan Nasional RI dan penerbitan buku fisik maupun digital.',
 ],
 ],
 'benefits' => "Keunggulan Konversi KTI di Penerbit Persis:
• Tetap mempertahankan substansi dan nilai ilmiah orisinal karya
• Bahasa dibuat lebih komunikatif, komunikatif, dan mudah dipahami
• Struktur disesuaikan dengan format buku standar penerbitan ilmiah
• Membantu menghasilkan buku yang bernilai angka kredit (KUM) bagi dosen
• Dapat dilanjutkan dengan layanan ISBN, cetak, dan distribusi resmi",
 'notes' => 'Catatan: Hak cipta dan keaslian isi riset sepenuhnya tetap menjadi milik penulis. Penerbit membantu dalam aspek teknis penulisan buku dan legalitas terbitan.',
 'faqs' => [
 [
 'q' => 'Apakah format laporan skripsi/tesis saya harus diubah sendiri sebelum diserahkan?',
 'a' => 'Tidak perlu. Anda cukup menyerahkan file dokumen naskah lengkap, dan tim editor kami yang akan membantu merekonstruksinya menjadi format buku.',
 ],
 [
 'q' => 'Apakah buku hasil konversi KTI bisa digunakan untuk syarat kenaikan pangkat/KUM?',
 'a' => 'Ya, tentu. Buku yang diterbitkan dilengkapi nomor ISBN resmi Perpustakaan Nasional dan surat bukti terbit yang sah untuk keperluan angka kredit dosen/peneliti.',
 ],
 ],
 'cta_text' => 'Konsultasi Konversi KTI',
 'order' => 2,
 'status' => 'published',
 ],

 // LAYANAN 3: PENGURUSAN ISBN
 [
 'title' => 'Pengurusan ISBN',
 'slug' => 'pengurusan-isbn',
 'icon' => 'fa-solid fa-barcode',
 'short_desc' => 'Bantu pengurusan ISBN resmi Perpustakaan Nasional untuk buku dan terbitan Anda.',
 'tagline' => '“Satu Karya, Satu Identitas, Siap Diterbitkan.”',
 'banner_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop',
 'overview' => "Penerbit Persis menyediakan layanan pengurusan ISBN (International Standard Book Number) untuk membantu penulis dan lembaga memperoleh identitas resmi bagi buku yang akan diterbitkan.

ISBN menjadi identitas unik internasional yang memudahkan pendataan, identifikasi, distribusi, dan pengelolaan bibliografis sebuah buku di kancah nasional maupun global.",
 'features' => [
 'Pengajuan ISBN resmi untuk buku yang diterbitkan',
 'Pemeriksaan kelengkapan data dan keabsahan naskah',
 'Penyiapan metadata buku sesuai standar Perpusnas RI',
 'Pendampingan proses pengajuan ISBN hingga tuntas',
 'Penyesuaian informasi penerbitan dan Katalog Dalam Terbitan (KDT)',
 'Penempatan barcode dan nomor ISBN pada sampul & halaman naskah',
 'Pendampingan sampai proses penerbitan selesai',
 ],
 'workflow_steps' => [
 [
 'step' => 1,
 'title' => 'Pengajuan Naskah & Data',
 'desc' => 'Penulis menyerahkan naskah dan data buku kepada Penerbit Persis.',
 ],
 [
 'step' => 2,
 'title' => 'Pemeriksaan Kelengkapan',
 'desc' => 'Tim memeriksa naskah, identitas penulis, judul, dan informasi penerbitan.',
 ],
 [
 'step' => 3,
 'title' => 'Penyusunan Metadata Standar',
 'desc' => 'Data bibliografis buku disiapkan sesuai kebutuhan pengajuan ISBN Perpusnas.',
 ],
 [
 'step' => 4,
 'title' => 'Pengajuan ke Perpusnas RI',
 'desc' => 'Penerbit mengajukan permohonan ISBN melalui sistem resmi Perpustakaan Nasional RI.',
 ],
 [
 'step' => 5,
 'title' => 'Verifikasi & Validasi',
 'desc' => 'Data pengajuan diproses dan diverifikasi sesuai ketentuan yang berlaku.',
 ],
 [
 'step' => 6,
 'title' => 'Penerbitan ISBN & Barcode',
 'desc' => 'Nomor ISBN yang diterbitkan dicantumkan pada bagian buku yang sesuai beserta barcode.',
 ],
 [
 'step' => 7,
 'title' => 'Buku Siap Didistribusikan',
 'desc' => 'Buku dapat dilanjutkan ke tahap cetak, publikasi, dan distribusi.',
 ],
 ],
 'benefits' => "Nilai Tambah Pengurusan ISBN di Penerbit Persis:
• Mudah & Tanpa Ribet Birokrasi
• Terarah dengan Pendampingan Redaksi
• Profesional Sesuai Standar Perpusnas RI
• Terintegrasi dengan Layanan Cetak & Distribusi",
 'notes' => 'Catatan: ISBN bukan sertifikasi mutu atau hak cipta buku. ISBN berfungsi sebagai identitas unik publikasi buku yang terdaftar resmi di Perpustakaan Nasional RI.',
 'faqs' => [
 [
 'q' => 'Berapa lama proses pengurusan ISBN?',
 'a' => 'Proses pengurusan ISBN biasanya membutuhkan waktu 3-7 hari kerja tergantung antrean verifikasi di sistem Perpustakaan Nasional RI.',
 ],
 [
 'q' => 'Apa saja syarat yang diperlukan untuk pengajuan ISBN?',
 'a' => 'Draf naskah lengkap (Judul, Daftar Isi, Kata Pengantar, Sinopsis/Blurb belakang), identitas penulis, dan spesifikasi buku (ukuran & estimasi jumlah halaman).',
 ],
 ],
 'cta_text' => 'Konsultasi Pengurusan ISBN',
 'order' => 3,
 'status' => 'published',
 ],
 ];

 foreach ($officialServices as $srv) {
 Service::create($srv);
 }
 }
}
