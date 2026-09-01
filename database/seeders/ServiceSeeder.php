<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $defaultServices = [
            [
                'title' => 'Pengurusan ISBN',
                'slug' => 'pengurusan-isbn',
                'icon' => 'fa-solid fa-barcode',
                'short_desc' => 'Bantu pengurusan ISBN resmi Perpustakaan Nasional untuk buku dan terbitan Anda.',
                'tagline' => '“Satu Karya, Satu Identitas, Siap Diterbitkan.”',
                'banner_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop',
                'overview' => "Penerbit Persis menyediakan layanan pengurusan ISBN (International Standard Book Number) untuk membantu penulis dan lembaga memperoleh identitas resmi bagi buku yang akan diterbitkan.\n\nISBN menjadi identitas unik internasional yang memudahkan pendataan, identifikasi, distribusi, dan pengelolaan bibliografis sebuah buku di kancah nasional maupun global.",
                'features' => [
                    'Pengajuan ISBN untuk buku yang diterbitkan',
                    'Pemeriksaan kelengkapan data dan naskah',
                    'Penyiapan metadata buku sesuai standar Perpusnas',
                    'Pendampingan proses pengajuan ISBN hingga tuntas',
                    'Penyesuaian informasi penerbitan dan KDT',
                    'Penempatan barcode dan nomor ISBN pada sampul & halaman naskah',
                    'Pendampingan sampai proses penerbitan selesai',
                ],
                'workflow_steps' => [
                    [
                        'step' => 1,
                        'title' => 'Pengajuan Naskah',
                        'desc' => 'Penulis menyerahkan naskah dan data buku kepada Penerbit Persis.',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Pemeriksaan Naskah & Kelengkapan Data',
                        'desc' => 'Tim memeriksa naskah, identitas penulis, judul, dan informasi penerbitan.',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Penyusunan Metadata',
                        'desc' => 'Data bibliografis buku disiapkan sesuai kebutuhan pengajuan ISBN Perpusnas.',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Pengajuan ISBN',
                        'desc' => 'Penerbit mengajukan permohonan ISBN melalui sistem yang ditetapkan oleh Perpustakaan Nasional RI.',
                    ],
                    [
                        'step' => 5,
                        'title' => 'Verifikasi & Proses Penerbitan',
                        'desc' => 'Data pengajuan diproses dan diverifikasi sesuai ketentuan yang berlaku.',
                    ],
                    [
                        'step' => 6,
                        'title' => 'ISBN Diterima',
                        'desc' => 'Nomor ISBN yang diterbitkan kemudian dicantumkan pada bagian buku yang sesuai.',
                    ],
                    [
                        'step' => 7,
                        'title' => 'Buku Siap Diterbitkan',
                        'desc' => 'Buku dapat dilanjutkan ke tahap cetak, publikasi, dan distribusi.',
                    ],
                ],
                'benefits' => "Mudah • Terarah • Profesional • Terintegrasi\n\nPenulis tidak perlu mengurus seluruh proses birokrasi sendiri. Penerbit Persis mendampingi dari persiapan data bibliografi hingga nomor ISBN dan barcode siap digunakan dalam penerbitan buku fisik maupun digital.",
                'notes' => 'Catatan: ISBN bukan sertifikasi mutu atau hak cipta buku. ISBN berfungsi sebagai identitas unik publikasi buku yang terdaftar resmi di Perpustakaan Nasional RI.',
                'faqs' => [
                    [
                        'q' => 'Berapa lama proses pengurusan ISBN?',
                        'a' => 'Proses pengurusan ISBN biasanya membutuhkan waktu 3-7 hari kerja tergantung antrean verifikasi di sistem Perpustakaan Nasional RI.',
                    ],
                    [
                        'q' => 'Apa saja syarat yang diperlukan untuk pengajuan ISBN?',
                        'a' => 'Draf naskah lengkap (Judul, Daftar Isi, Kata Pengantar, Sinopsis/Blurb belakang), identitas penulis, dan spesifikasi buku (ukuran & jumlah halaman).',
                    ],
                ],
                'cta_text' => 'Konsultasi Pengurusan ISBN',
                'order' => 1,
                'status' => 'published',
            ],
            [
                'title' => 'Penerbitan Buku',
                'slug' => 'penerbitan-buku',
                'icon' => 'fa-solid fa-book-open',
                'short_desc' => 'Menerbitkan buku referensi, buku ajar, monograf, dan berbagai karya ilmiah berstandar nasional.',
                'tagline' => '“Wujudkan Karya Intelektual Anda Menjadi Buku Berkualitas.”',
                'banner_image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Layanan penerbitan buku terpadu dari naskah mentah hingga menjadi buku jadi yang siap edar. Kami melayani buku ajar, monograf, buku referensi, sastra, dan buku populer.',
                'features' => [
                    'Review substansi dan proofreading bahasa',
                    'Tata letak (layouting) interior buku standar industri',
                    'Desain sampul (cover) eksklusif dan 3D visualizer',
                    'Pengurusan legalitas ISBN dan Barcode resmi',
                    'Pencetakan berstandar UNESCO dengan berbagai pilihan kertas',
                ],
                'workflow_steps' => [
                    ['step' => 1, 'title' => 'Kirim Draf Naskah', 'desc' => 'Kirimkan naskah Anda melalui form online atau WhatsApp redaksi.'],
                    ['step' => 2, 'title' => 'Review & Editing', 'desc' => 'Tim editor melakukan telaah naskah, tata letak, dan desain cover.'],
                    ['step' => 3, 'title' => 'ISBN & Proofing', 'desc' => 'Pendaftaran ISBN dan pengecekan dummy proof sebelum cetak.'],
                    ['step' => 4, 'title' => 'Cetak & Distribusi', 'desc' => 'Proses cetak massal dan pengiriman buku sampai ke alamat Anda.'],
                ],
                'benefits' => 'Pendampingan ramah, proses transparan, hasil cetak presisi, dan royalti yang menguntungkan bagi penulis.',
                'notes' => 'Tersedia pilihan cetak satuan (Print on Demand) maupun cetak massal (Offset Printing).',
                'cta_text' => 'Ajukan Naskah Buku',
                'order' => 2,
                'status' => 'published',
            ],
            [
                'title' => 'Konversi KTI',
                'slug' => 'konversi-kti',
                'icon' => 'fa-solid fa-graduation-cap',
                'short_desc' => 'Ubah skripsi, tesis, dan disertasi menjadi buku referensi berkualitas siap terbit.',
                'tagline' => '“Hilirisasi Karya Riset Menjadi Buku Referensi Nasional.”',
                'banner_image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Banyak karya tulis ilmiah (KTI) seperti skripsi, tesis, dan disertasi yang hanya tersimpan di perpustakaan. Penerbit Persis membantu mengubah KTI Anda menjadi buku referensi atau buku monograf yang enak dibaca dan bernilai KUM akademik tinggi.',
                'features' => [
                    'Parafrase dan penyesuaian gaya bahasa ilmiah ke buku populer/referensi',
                    'Penghilangan format laporan kaku (Bab I-V disesuaikan menjadi bab tematik)',
                    'Pengurusan ISBN dan sertifikat penerbitan untuk pengajuan angka kredit (KUM)',
                    'Pencetakan eksklusif untuk koleksi pribadi, perpustakaan, dan rekan sejawat',
                ],
                'workflow_steps' => [
                    ['step' => 1, 'title' => 'Penyerahan Dokumen KTI', 'desc' => 'Unggah dokumen skripsi/tesis/disertasi lengkap beserta data penulis.'],
                    ['step' => 2, 'title' => 'Rekonstruksi Naskah', 'desc' => 'Editor mengonversi struktur laporan riset menjadi bab buku yang sistematis.'],
                    ['step' => 3, 'title' => 'Pendaftaran ISBN', 'desc' => 'Pengurusan legalitas ISBN dan sertifikat bukti terbit.'],
                    ['step' => 4, 'title' => 'Pencetakan & Pengiriman', 'desc' => 'Buku dicetak rapi dan dikirim langsung ke penulis.'],
                ],
                'benefits' => 'Tingkatkan portofolio akademik dosen, peneliti, dan mahasiswa dengan publikasi ber-ISBN resmi.',
                'notes' => 'Naskah yang dikonversi tetap menjaga keaslian riset dan integritas akademik.',
                'cta_text' => 'Konsultasi Konversi KTI',
                'order' => 3,
                'status' => 'published',
            ],
            [
                'title' => 'Percetakan Umum',
                'slug' => 'percetakan-umum',
                'icon' => 'fa-solid fa-copy',
                'short_desc' => 'Cetak brosur, flyer, poster, katalog, majalah, dan berbagai kebutuhan cetak promosi.',
                'tagline' => '“Cetak Tajam, Warna Presisi, Tepat Waktu.”',
                'banner_image' => 'https://images.unsplash.com/photo-1588345921523-c2dcdb7f1dcd?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Layanan percetakan komersial dan promosi institusi dengan mesin cetak offset dan digital modern untuk berbagai kebutuhan dokumen dan media promosi.',
                'features' => [
                    'Pilihan kertas lengkap (Art Paper, Art Carton, Matte Paper, HVS, Bookpaper)',
                    'Finishing laminasi doff, glossy, spot UV, embos, dan hot print emas',
                    'Kapasitas produksi besar dengan kontrol mutu ketat',
                ],
                'workflow_steps' => [
                    ['step' => 1, 'title' => 'Kirim File Desain', 'desc' => 'Kirimkan file siap cetak dalam format PDF atau TIFF high resolution.'],
                    ['step' => 2, 'title' => 'Proofing Warna', 'desc' => 'Pemeriksaan resolusi dan akurasi warna sebelum cetak massal.'],
                    ['step' => 3, 'title' => 'Cetak & Finishing', 'desc' => 'Pencetakan, pemotongan presisi, dan jilid.'],
                ],
                'benefits' => 'Harga hemat untuk pemesanan jumlah besar dan jaminan kualitas cetak prima.',
                'notes' => 'Melayani pengiriman ke seluruh kota di Indonesia.',
                'cta_text' => 'Minta Penawaran Cetak',
                'order' => 4,
                'status' => 'published',
            ],
            [
                'title' => 'Jurnal & Majalah',
                'slug' => 'jurnal-dan-majalah',
                'icon' => 'fa-solid fa-newspaper',
                'short_desc' => 'Pengelolaan, layouting, dan pencetakan jurnal ilmiah, prosiding, buletin, dan majalah berkala.',
                'tagline' => '“Standar Publikasi Ilmiah & Majalah Berkala Profesional.”',
                'banner_image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Mendukung pengelola jurnal perguruan tinggi, himpunan profesi, dan organisasi dalam menerbitkan edisi cetak jurnal, prosiding seminar, maupun majalah berkala.',
                'features' => [
                    'Layouting sesuai template jurnal (APA, IEEE, Vancouver)',
                    'Pengurusan e-ISSN dan p-ISSN',
                    'Pencetakan edisi cetak prosiding konferensi dan jurnal akreditasi',
                ],
                'workflow_steps' => [
                    ['step' => 1, 'title' => 'Kompilasi Artikel', 'desc' => 'Kirimkan kumpulan naskah artikel yang sudah lolos review.'],
                    ['step' => 2, 'title' => 'Tata Letak Standar', 'desc' => 'Layouting interior artikel sesuai gaya selingkung jurnal.'],
                    ['step' => 3, 'title' => 'Cetak Edisi Resmi', 'desc' => 'Pencetakan berkualitas untuk akreditasi dan distribusi perpustakaan.'],
                ],
                'benefits' => 'Solusi terpercaya bagi kampus dan lembaga dakwah dalam menerbitkan media berkala.',
                'notes' => 'Tersedia paket langganan cetak berkala per semester atau per edisi.',
                'cta_text' => 'Konsultasi Cetak Jurnal',
                'order' => 5,
                'status' => 'published',
            ],
            [
                'title' => 'Cetak Custom',
                'slug' => 'cetak-custom',
                'icon' => 'fa-solid fa-box-open',
                'short_desc' => 'Cetak custom sesuai kebutuhan khusus dengan ukuran, bahan, dan jilid fleksibel.',
                'tagline' => '“Solusi Percetakan Fleksibel Sesuai Kebutuhan Spesifik Anda.”',
                'banner_image' => 'https://images.unsplash.com/photo-1516962215378-7fa2e137ae93?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Punya kebutuhan produk cetak unik seperti binder naskah, sertifikat ber-hologram, agenda custom, kalender, atau packaging buku khusus? Tim kami siap melayani.',
                'features' => [
                    'Konsultasi bahan dan jenis jilid (Hardcover, Softcover, Spiral Kawat, Jahit Benang)',
                    'Bebas menentukan ukuran buku custom di luar standar',
                    'Pilihan box set buku eksklusif (Hardbox / Slipcase)',
                ],
                'workflow_steps' => [
                    ['step' => 1, 'title' => 'Konsultasi Spesifikasi', 'desc' => 'Diskusikan ide ukuran, bahan, dan jumlah oplag yang diinginkan.'],
                    ['step' => 2, 'title' => 'Pembuatan Mockup Dummy', 'desc' => 'Membuat sampel fisik untuk persetujuan sebelum produksi penuh.'],
                    ['step' => 3, 'title' => 'Produksi & Finishing', 'desc' => 'Pengerjaan dengan pengawasan mutu ketat.'],
                ],
                'benefits' => 'Wujudkan merchandise dan produk terbitan eksklusif sesuai impian Anda.',
                'notes' => 'Minimal order fleksibel.',
                'cta_text' => 'Konsultasi Cetak Custom',
                'order' => 6,
                'status' => 'published',
            ],
        ];

        foreach ($defaultServices as $srv) {
            Service::updateOrCreate(
                ['slug' => $srv['slug']],
                $srv
            );
        }
    }
}
