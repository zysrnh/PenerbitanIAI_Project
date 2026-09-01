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
                'short_desc' => 'Mewujudkan karya tulis akademisi, pendidik, mahasiswa, dan masyarakat menjadi buku berkualitas, ber-ISBN, dan siap edar.',
                'tagline' => '“Mewujudkan Karya Tulis Menjadi Buku Berkualitas, Profesional, dan Bernilai Manfaat.”',
                'banner_image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Penerbit Persis hadir untuk membantu penulis, akademisi, pendidik, mahasiswa, lembaga, dan masyarakat dalam mewujudkan karya tulis menjadi buku yang berkualitas, profesional, dan bernilai manfaat.\n\nLayanan penerbitan buku mencakup proses menyeluruh mulai dari pemeriksaan naskah, penyuntingan bahasa, desain sampul, tata letak interior, pengurusan legalitas ISBN, pencetakan hingga distribusi dan publikasi buku ke khalayak luas.',
                'features' => [
                    '1. Penerimaan dan Seleksi Naskah — Naskah diperiksa untuk memastikan kesesuaian tema, kelayakan isi, dan standar penerbitan.',
                    '2. Editing & Penyuntingan — Memperbaiki struktur tulisan, bahasa, ejaan, dan konsistensi isi agar buku mudah dibaca dan dipahami.',
                    '3. Desain Cover & Tata Letak — Desain sampul menarik serta tata letak isi buku yang rapi dan profesional standar industri.',
                    '4. Konversi KTI Menjadi Buku — Mengubah skripsi, tesis, disertasi, dan artikel ilmiah menjadi buku yang komunikatif dan layak terbit.',
                    '5. Pengurusan ISBN — Pengurusan legalitas resmi ISBN dan barcode Perpustakaan Nasional RI.',
                    '6. Pencetakan Buku — Pilihan ukuran buku (UNESCO B5/A5), jenis kertas berkualitas, finishing rapi, dan jumlah oplag fleksibel.',
                    '7. Distribusi & Publikasi — Mendukung penyebarluasan buku agar karya dapat menjangkau pembaca yang lebih luas.',
                ],
                'workflow_steps' => [
                    [
                        'step' => 1,
                        'title' => 'Naskah Masuk',
                        'desc' => 'Penulis mengirimkan draf naskah buku lengkap beserta data kepenulisan kepada redaksi.',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Editing & Penyuntingan',
                        'desc' => 'Editor melakukan telaah isi, perbaikan tata bahasa, ejaan (PUEBI), dan konsistensi istilah.',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Desain Cover & Layout',
                        'desc' => 'Pembuatan konsep sampul depan-belakang eksklusif dan tata letak interior naskah buku.',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Pengurusan ISBN',
                        'desc' => 'Pendaftaran nomor ISBN dan barcode resmi ke sistem Perpustakaan Nasional RI.',
                    ],
                    [
                        'step' => 5,
                        'title' => 'Pencetakan Buku',
                        'desc' => 'Proses cetak dengan mesin modern, pemotongan presisi, dan jilid rapi berkualitas tinggi.',
                    ],
                    [
                        'step' => 6,
                        'title' => 'Terbit & Distribusi',
                        'desc' => 'Buku resmi terbit dan siap didistribusikan ke jaringan pembaca, perpustakaan, dan toko buku.',
                    ],
                ],
                'benefits' => "Jenis Buku yang Diterbitkan Penerbit Persis:\n• 📚 Buku Keislaman\n• 🎓 Buku Akademik & Referensi\n• 📝 Buku Hasil Penelitian\n• 🏫 Buku Pendidikan\n• 📖 Buku Ajar Perguruan Tinggi\n• 👨‍👩‍👧 Buku Anak & Keluarga\n• 🌱 Buku Sosial & Dakwah\n• 📕 Buku Organisasi & Kelembagaan\n• 🔬 Buku Ilmiah Populer",
                'notes' => 'Alur Penerbitan: Naskah → Editing → Desain → ISBN → Cetak → Terbit & Distribusi.\nDidukung tim profesional, proses transparan, dan jaminan kualitas cetak terbaik.',
                'faqs' => [
                    [
                        'q' => 'Apakah naskah yang belum selesai 100% bisa dikonsultasikan?',
                        'a' => 'Tentu bisa. Anda dapat mengirimkan draf kasar atau outline bab naskah untuk ditelaah dan diarahkan oleh tim editor kami.',
                    ],
                    [
                        'q' => 'Berapa minimal jumlah cetak buku?',
                        'a' => 'Kami melayani cetak satuan (Print On Demand mulai dari 10-50 eks) hingga cetak massal (Offset ratusan hingga ribuan eksemplar).',
                    ],
                ],
                'cta_text' => 'Ajukan Naskah Buku Sekarang',
                'order' => 1,
                'status' => 'published',
            ],
            [
                'title' => 'Konversi KTI',
                'slug' => 'konversi-kti',
                'icon' => 'fa-solid fa-graduation-cap',
                'short_desc' => 'Ubah karya ilmiah seperti skripsi, tesis, disertasi, dan laporan riset menjadi buku yang komunikatif dan bernilai tinggi.',
                'tagline' => '“Dari Karya Ilmiah Menjadi Buku yang Bernilai dan Bermanfaat.”',
                'banner_image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1600&auto=format&fit=crop',
                'overview' => 'Konversi KTI (Karya Tulis Ilmiah) adalah layanan untuk mengubah karya ilmiah seperti skripsi, tesis, disertasi, laporan penelitian, dan artikel ilmiah menjadi naskah buku yang lebih komunikatif, sistematis, dan menarik untuk dibaca oleh masyarakat luas.\n\nMelalui proses adaptasi dan restrukturisasi yang profesional, karya riset Anda tidak hanya tersimpan di perpustakaan kampus, namun bertransformasi menjadi buku referensi atau buku populer yang ber-ISBN dan bernilai akademik tinggi.',
                'features' => [
                    '📘 Konversi Skripsi Menjadi Buku — Mengolah skripsi menjadi buku dengan penyajian yang lebih ringkas dan mudah dipahami.',
                    '📗 Konversi Tesis & Disertasi — Mengadaptasi karya akademik menjadi buku referensi atau buku ilmiah yang layak diterbitkan.',
                    '📙 Konversi Hasil Penelitian — Mengembangkan laporan riset menjadi buku ilmiah maupun buku populer.',
                    '📕 Konversi Artikel/Kumpulan KTI — Menghimpun dan mengembangkan beberapa karya ilmiah menjadi satu buku yang utuh.',
                ],
                'workflow_steps' => [
                    [
                        'step' => 1,
                        'title' => 'Analisis Naskah',
                        'desc' => 'Menelaah substansi, tema, dan kelayakan naskah karya ilmiah asli.',
                    ],
                    [
                        'step' => 2,
                        'title' => 'Penyusunan Struktur Buku',
                        'desc' => 'Menyusun kembali kerangka naskah dari format laporan kaku (Bab I-V) menjadi bab buku tematik yang sistematis.',
                    ],
                    [
                        'step' => 3,
                        'title' => 'Editing & Penyederhanaan Bahasa',
                        'desc' => 'Parafrase kalimat ilmiah agar lebih komunikatif, renyah, dan mengalir enak dibaca.',
                    ],
                    [
                        'step' => 4,
                        'title' => 'Penyesuaian Isi',
                        'desc' => 'Penyelarasan referensi, pengayaan konteks, dan penyesuaian materi dengan target pembaca luas.',
                    ],
                    [
                        'step' => 5,
                        'title' => 'Desain & Layout',
                        'desc' => 'Tata letak interior buku standar penerbitan nasional dan perancangan desain sampul (cover) menarik.',
                    ],
                    [
                        'step' => 6,
                        'title' => 'ISBN & Penerbitan',
                        'desc' => 'Pengurusan nomor legalitas ISBN resmi Perpustakaan Nasional RI dan penerbitan buku fisik maupun digital.',
                    ],
                ],
                'benefits' => "• Tetap mempertahankan substansi dan nilai ilmiah karya\n• Bahasa dibuat lebih komunikatif dan mudah dipahami\n• Struktur disesuaikan dengan format buku standar penerbitan\n• Membantu menghasilkan buku yang lebih menarik bagi pembaca dan sivitas akademika\n• Dapat dilanjutkan dengan layanan ISBN, cetak, dan distribusi resmi",
                'notes' => 'Catatan: Hak cipta dan keaslian isi riset sepenuhnya tetap menjadi milik penulis. Penerbit membantu dalam aspek teknis penulisan buku dan legalitas terbitan.',
                'faqs' => [
                    [
                        'q' => 'Apakah format laporan skripsi/tesis saya harus diubah sebelum diserahkan?',
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
