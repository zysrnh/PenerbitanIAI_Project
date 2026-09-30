-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2026 at 07:24 AM
-- Server version: 10.6.28-MariaDB-cll-lve
-- PHP Version: 8.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `persispe_pers`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `views_count` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `tags` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `category_id`, `author_id`, `thumbnail`, `excerpt`, `content`, `status`, `is_featured`, `views_count`, `tags`, `published_at`, `created_at`, `updated_at`) VALUES
(7, 'Persispers Penerbit Satu-satunya Milik Persis', 'persispers-penerbit-satu-satunya-milik-persis', 1, 9, '/storage/articles/thumbnails/uo11hVLTbt4sGKafLa4TCXPJ7I9yYQeWxANVXpXF.jpg', 'Foto dokumentasiMengunggah gambar...oto dokumentasiPersispers, penerbit terkemuka di Indonesia, resmi menjadi satu-satunya penerbit yang dimiliki langsung oleh Pimpinan Pusat Persa...', '<div><figure class=\"my-4\"><img src=\"/storage/articles/content/GhyBzjr1n86myUSKErAYiIrxlitGLP4q0nfg6pJX.jpg\" alt=\"Foto Berita\" class=\"w-full max-h-96 object-cover rounded-sm border border-slate-200 shadow-xs\" style=\"font-size: 0.875rem;\"></figure><figure class=\"my-4\"><figure class=\"my-4\"><figcaption class=\"text-center text-xs text-slate-400 mt-1.5 italic\">Foto dokumentasi</figcaption></figure><p><br></p><span style=\"color: rgb(148, 163, 184); font-size: 0.75rem; font-style: italic;\">Mengunggah gambar...</span><span style=\"color: rgb(148, 163, 184); font-size: 0.75rem; font-style: italic; text-align: center;\">oto dokumentasi</span></figure><p>Persispers, penerbit terkemuka di Indonesia, resmi menjadi satu-satunya penerbit yang dimiliki langsung oleh Pimpinan Pusat Persatuan Islam (Persis). Keberadaan Persispers sebagai penerbit resmi organisasi ini memperkuat posisi Persis dalam mengembangkan literasi keislaman yang berlandaskan nilai-nilai keadilan, moderasi, dan toleransi.</p><p>Pimpinan Pusat Persatuan Islam, Ustadz KH. Jeje Zaenudin, menyampaikan bahwa kepemilikan langsung terhadap penerbitan ini merupakan langkah strategis untuk memastikan konten yang disampaikan sesuai dengan visi dan misi organisasi.</p><p>“Persispers adalah bagian dari upaya kami untuk memperkuat dakwah dan literasi keislaman di Indonesia. Dengan adanya penerbit yang langsung berada di bawah naungan Pimpinan Pusat, kami bisa lebih leluasa mengontrol kualitas dan arah isi karya-karya yang diterbitkan,” ujarnya.</p><p>Persispers sendiri dikenal luas sebagai penerbit yang menerbitkan buku-buku keislaman, modul pendidikan, serta artikel-artikel ilmiah yang mendukung penguatan pemahaman keislaman moderat dan toleran. Dengan status barunya, organisasi berharap dapat memperluas jangkauan dan meningkatkan kualitas karya yang dipublikasikan.</p><p>Selain itu, kehadiran Persispers sebagai penerbit milik Persis juga diharapkan mampu menjadi media yang mendukung pengembangan literasi keislaman yang inklusif dan progresif, serta menjadi rujukan utama dalam literasi keislaman nasional.</p><p>Direktur Persispers, AA Nurjaman, menambahkan bahwa kepercayaan dari Pimpinan Pusat Persatuan Islam ini menjadi motivasi besar untuk terus meningkatkan kualitas dan kuantitas karya penerbitan. “Kami berkomitmen untuk menghadirkan karya yang bermutu tinggi dan mampu memberikan manfaat besar bagi masyarakat Indonesia,” katanya.</p><p>Dengan keberadaan Persispers sebagai penerbit resmi milik organisasi keislaman terbesar di Indonesia, diharapkan literasi keislaman yang moderat dan berintegritas dapat terus berkembang dan memberikan dampak positif bagi bangsa dan negara.</p></div>', 'published', 1, 24, NULL, '2026-09-07 06:17:00', '2026-09-07 06:18:24', '2026-09-21 19:54:22'),
(8, 'Mendorong Literasi Keislaman Lewat Karya Ulama', 'mendorong-literasi-keislaman-lewat-karya-ulama-1', 1, 9, '/storage/articles/thumbnails/PM6WAU9AUFDijhy98yiaQGphT5ltS2fbwELhkpyj.jpg', 'Penerbit Persispers, sebuah penerbit terkemuka di Indonesia, kembali menunjukkan komitmennya dalam mengembangkan literasi keislaman dengan meluncurkan program Wadahi Ulama Menulis....', '<div>Penerbit Persispers, sebuah penerbit terkemuka di Indonesia, kembali menunjukkan komitmennya dalam mengembangkan literasi keislaman dengan meluncurkan program Wadahi Ulama Menulis. Program ini bertujuan untuk memfasilitasi ulama dan cendekiawan Muslim dalam menyalurkan gagasan dan pengetahuan mereka melalui karya tulis yang berkualitas.</div><div>Dalam acara peluncuran yang berlangsung di kantor Pimpinan Daerah Persatuan Islam Kabupaten bandung, Direktur Persispers, AA Nurjaman menyampaikan bahwa inisiatif ini merupakan bagian dari upaya memperkuat literasi keislaman di Indonesia. \"Kami percaya bahwa ulama memiliki peran penting dalam membangun pemahaman keislaman yang moderat dan progresif. Melalui wadah ini, kami ingin memfasilitasi mereka untuk menulis dan menyebarkan ilmu pengetahuan kepada masyarakat luas,\" ujarnya.</div><div>Program Wadahi Ulama Menulis menyediakan berbagai fasilitas, mulai dari pelatihan menulis, pendampingan editorial, hingga distribusi karya melalui berbagai platform. Selain itu, penerbit juga membuka kesempatan bagi ulama muda dan senior untuk berbagi pengalaman dan pemikiran mereka dalam bentuk buku, artikel, maupun media digital lainnya.</div><div>Hadir dalam acara tersebut, sejumlah ulama dan cendekiawan Muslim yang menyambut positif langkah Persispers. Mereka berharap program ini dapat menjadi momentum untuk memperkuat peran ulama dalam menyebarkan ajaran Islam yang rahmatan lil’alamin dan berkontribusi dalam pembangunan masyarakat yang berilmu dan beretika.</div><div>Dengan adanya inisiatif ini, diharapkan karya-karya ulama akan semakin banyak dan tersebar luas, memberikan manfaat bagi umat dan bangsa Indonesia secara umum. Persispers optimis bahwa kolaborasi ini akan membawa dampak positif dalam meningkatkan kualitas literasi keislaman di tanah air. (AA)</div><div><br></div><div><figure class=\"my-4\"><img src=\"/storage/articles/content/R1Oh1xz0iZjMIqkquAgq7sfvmG9ZIFeiKMmiOaRJ.jpg\" alt=\"Foto Berita\" class=\"w-full max-h-96 object-cover rounded-sm border border-slate-200 shadow-xs\"><figcaption class=\"text-center text-xs text-slate-400 mt-1.5 italic\">Foto dokumentasi</figcaption></figure><p><br></p></div>', 'published', 0, 31, NULL, '2026-09-07 06:23:00', '2026-09-07 06:24:26', '2026-09-25 13:45:12'),
(9, 'Persispers Sosialisasikan Buku-buku Ulama Persis', 'persispers-sosialisasikan-buku-buku-ulama-persis', 1, 9, '/storage/articles/thumbnails/QtQAc4jmYnbeVag1siGWvpxQ74cuTSY2Noc9S5dS.jpg', 'Foto dokumentasiDalam rangka meningkatkan pengetahuan dan memperkuat keilmuan umat, Penerbit Persispers menggelar kegiatan sosialisasi buku-buku karya ulama Persis.Melalui kegiatan...', '<div><figure class=\"my-4\"><img src=\"/storage/articles/content/rTmovtGas4O8j3uYK1LjuFFV6kwEguMOudXbIQDt.jpg\" alt=\"Foto Berita\" class=\"w-full max-h-96 object-cover rounded-sm border border-slate-200 shadow-xs\"><figcaption class=\"text-center text-xs text-slate-400 mt-1.5 italic\">Foto dokumentasi</figcaption></figure><p><br></p></div><div><br></div><div><div>Dalam rangka meningkatkan pengetahuan dan memperkuat keilmuan umat, Penerbit Persispers menggelar kegiatan sosialisasi buku-buku karya ulama Persis.</div><div>Melalui kegiatan ini, Penerbit Persis berharap dapat menyebarluaskan wawasan keislaman yang berlandaskan ajaran ulama Persis dan memperkuat identitas keislaman yang moderat dan beradab.&nbsp;</div><div>Selain itu, sosialisasi ini juga menjadi momentum untuk memperkenalkan karya-karya ulama Persis kepada generasi muda dan masyarakat luas, agar nilai-nilai keislaman yang moderat dan berorientasi pada perdamaian tetap terjaga dan berkembang.</div></div>', 'published', 0, 32, NULL, '2026-09-07 17:04:00', '2026-09-07 17:05:43', '2026-09-25 13:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE `article_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `name`, `slug`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Kabar Penerbitan', 'kabar-penerbitan', 'Informasi dan berita terbaru seputar dunia penerbitan dan percetakan PERSIS PERS.', 1, '2026-09-02 18:53:38', '2026-09-02 18:53:38'),
(2, 'Tips Penulis', 'tips-penulis', 'Tips, tutorial, dan panduan praktis untuk penulis pemula hingga akademisi.', 2, '2026-09-02 18:53:38', '2026-09-02 18:53:38');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Buku Ajar',
  `isbn` varchar(255) DEFAULT NULL,
  `kdt` varchar(255) DEFAULT NULL,
  `year` varchar(10) NOT NULL DEFAULT '2026',
  `pages` varchar(50) NOT NULL DEFAULT '240 hlm',
  `size` varchar(100) DEFAULT '17,6 x 25 cm',
  `format` varchar(255) NOT NULL DEFAULT 'UNESCO B5 (Bookpaper)',
  `price` varchar(255) NOT NULL DEFAULT 'Rp 75.000',
  `synopsis` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `back_cover_image` varchar(255) DEFAULT NULL,
  `inside_preview_image` varchar(255) DEFAULT NULL,
  `additional_image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `sample_pdf` varchar(255) DEFAULT NULL,
  `is_new_release` tinyint(1) NOT NULL DEFAULT 1,
  `is_best_seller` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `slug`, `author`, `category`, `isbn`, `kdt`, `year`, `pages`, `size`, `format`, `price`, `synopsis`, `cover_image`, `back_cover_image`, `inside_preview_image`, `additional_image`, `gallery`, `sample_pdf`, `is_new_release`, `is_best_seller`, `order`, `status`, `created_at`, `updated_at`) VALUES
(12, 'EKONOMI SYARIAH (Ekonomi Tanpa Bunga) Mengena Teori dan Praktik Ekonomi Islam di Indonesia', 'ekonomi-syariah-ekonomi-tanpa-bunga-mengena-teori-dan-praktik-ekonomi-islam-di-indonesia-UeDs', 'Dr. Latief Awaludi', 'Ekonomi & Bisnis Islam', NULL, NULL, '2026', '280', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 80.000', 'Ekonomi Syariah bukan sekedar alternatif  tapi menjadi solusi menuju tatanan ekonomi yang fair dan adil yang lahir dari Rahim kekritisan ekonom muslim dalam merespons ketebelakangan, rasa hegemoni dan hilangnya moral dan aspek transendental ekonomi dalam sistem ekonomi konvensional.\r\nDi Indonesia Keberadaan Gerakan ekonomi Syariah dilakukan dengan dua strategi; yaitu. Peertama; Strategi islamisasi ilmu ekonomi dengan menghadirkan kajian dan perguruan tinggi khusus atau membuka prodi jurusan ekonomi dan keuangan Syariah muali dari S1 sampai S3 bukan hanya di perguruan tinggi Islam seperti UIN, IAIN dan STAI tapi diperguruan tinggi umum seperti UI, IPB, UNPAD, UNDIP, Universitas Trisakti dan UGM membuka kajian ekonomi Islam. Kedua, Strategi Institusi Ekonomi Islam dengan mendirikan LKS (Lembaga Keuangan Syariah) diawali hadirnya bank Syariah yang berbasiskan bagi hasil (nisbah), margin (Ribhun) dan fee (ujrah) yang telah diakui sejak diberlakukannya Undang-undang No. 7 Tahun 1992 tentang Perbankan, dan lebih dikukuhkan dengan diundangkannya Undang-undang No. 10 Tahun 1998 tentang Perubahan Atas Undang-undang No. 7 tahun 1992 beserta beberapa Surat Keputusan Direksi Bank Indonesia (PBI). \r\nKehadiran buku ini sangat dinantikan untuk mengenal dan menguatkan pengetahuan ilmu ekonomi Islam yang bersumber dari Alqur’an dan Sunnah Nabi saw. Baik secara keilmuan atau dalam prakti aktivitas binis, seperti perbankan, pasar saham, pasar formal dan informal. Lebih penting dari itu adalah mewujudkan kehidupan mu’amalah sebagai bagian dari manusia yang bertaqwa.', 'books/photos/zAy4DzOnMLFXzQvPSf8aC0BAqwvUpz.jpg', 'books/photos/WwnirZEZ3GFT9oUUyqfcPPlXj0EXO7.jpg', NULL, NULL, NULL, NULL, 1, 0, 0, 'published', '2026-08-31 17:16:39', '2026-09-05 07:04:03'),
(13, 'MEMBACA JAKARTA,   MEMBANGUN PERADABAN', 'membaca-jakarta-membangun-peradaban-IjpW', 'Ihsan Abdul Haq, M.Pd', 'Sosial & Budaya', NULL, NULL, '2026', '199', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 90.000', 'Membaca Jakarta, Membangun Peradaban disusun sebagai upaya intelektual untuk memahami Jakarta pada fase perubahan strategis. Judul buku ini mengandung dua gagasan utama. Pertama, membaca Jakarta berarti memahami kota ini bukan hanya sebagai ruang administratif, tetapi juga sebagai ruang sejarah, ekonomi, sosial, budaya, dan kemanusiaan yang terus berubah. Kedua, membangun peradaban berarti menempatkan pembangunan kota melampaui ukuran pertumbuhan ekonomi semata, menuju kota yang menghadirkan keadilan, keberlanjutan, dan kualitas hidup bagi warga.\r\nBuku ini berangkat dari gagasan bahwa perubahan posisi Jakarta setelah agenda pemindahan ibu kota bukanlah akhir dari peran strategisnya. Jakarta tetap memiliki kapasitas sebagai pusat ekonomi, inovasi, budaya, dan jejaring global. Namun, status sebagai kota global harus dibaca secara kritis: sebuah kota tidak dinilai hanya dari infrastruktur dan investasi, tetapi juga dari kemampuannya menghadirkan kesempatan yang adil bagi seluruh warga.\r\nSecara arsitektural, buku ini disusun dalam lima bagian yang membentuk satu alur argumentasi. Bagian pertama membahas transisi dan struktur kota untuk memahami posisi Jakarta dalam perubahan nasional dan global. Bagian kedua membahas pembangunan manusia dan kesempatan sebagai ukuran keberhasilan kota. Bagian ketiga menguji ketangguhan Jakarta melalui isu lingkungan, ruang hidup, dan keberlanjutan. Bagian keempat membahas institusi, tata kelola, dan masa depan kota. Bagian kelima menjadi ruang evaluasi dan perumusan manifesto.\r\nPendekatan penyusunan buku menggunakan beberapa kerangka. Pertama, pendekatan kebijakan publik untuk membaca program, regulasi, dan capaian pembangunan. Kedua, pendekatan perkotaan untuk memahami Jakarta sebagai kota metropolitan dan global. Ketiga, pendekatan evaluasi pembangunan melalui dimensi relevansi, efektivitas, pemerataan, keberlanjutan, akuntabilitas, dan kemaslahatan. Keempat, perspektif nilai Islam digunakan sebagai kerangka etis untuk menilai arah pembangunan.', 'books/photos/e25g7kPLTcWD7shi1OUj9HcUg2awW2.jpg', 'books/photos/VVxGPUuHNTAmmROOPZhHlTpejtZdxY.jpg', NULL, NULL, NULL, NULL, 1, 0, 0, 'published', '2026-08-31 17:19:28', '2026-09-05 07:00:29'),
(14, '52 Manusia Laknat', '52-manusia-laknat-y0yZ', 'H. Deni Sholehudin, M.Ag', 'Akhlak & Etika Islam', NULL, NULL, '2026', '200', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 75.000', NULL, 'books/photos/qN70RPOvz0xYrETZO1PsZfhGO54u2X.jpg', 'books/photos/0stOkFM80zEwht5bFVVcy7XJxfXpzI.jpg', 'books/photos/jNmTgiiS4PjGi8rwfpCJeud8iaiCVE.jpg', 'books/photos/xQ0nYiyMQoEttavZTVbDEHB2roeGWu.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 19:33:21', '2026-09-05 06:59:53'),
(15, 'Al Quran Terjemah dan Tafsir', 'al-quran-terjemah-dan-tafsir-6jXL', 'A. Hasa', 'Tafsir & Al-Qur\'an', NULL, NULL, '2026', '232', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 99.000', NULL, 'books/photos/IVUMXS29lnedRHbFIWh6WP5976z1mG.jpg', 'books/photos/H4ULendqBgG04d4MspTE9ZoqpPenvM.jpg', NULL, NULL, NULL, NULL, 0, 1, 0, 'published', '2026-08-31 21:22:09', '2026-09-05 06:59:20'),
(16, 'Al-Muyasar Fii Ahkami At-Tajwid', 'al-muyasar-fii-ahkami-at-tajwid-39R5', 'Moh Syarifuddin  Rasul', 'Al-Qur\'an & Ilmu Al-Qur\'an', NULL, NULL, '2026', 'xviii + 166', '14,2 x 20,5 cm', 'UNESCO B5 (Bookpaper)', 'Rp 50.000', 'Buku ini menjadi rujukan umum, dan khususnya para santri agar dapat memahami hukum-hukum bacaan alquran. Maka buku ini dibuat secara singkas agar dapat dipahami dengan mudah dan cepat', 'books/photos/NNN4DxSQiGexlihFLwcODqu3pOuhPZ.jpg', 'books/photos/QFW0tj2yWJr9HbiuBlbdGbczjuy98V.jpg', 'books/photos/3Lb73xGfr01nUfiyCrxQ4Yh6wiaWJI.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:27:11', '2026-09-16 19:21:03'),
(17, 'AR-RISALAH 1 : Syarah Hadits  Nabi SAW Tentang Iman, Islam, Ihsan, dan Kiamat', 'ar-risalah-TYQW', 'Dr. Nashruddin Syarief', 'Fiqih & Hukum Islam', '978-602-18362-3-1', NULL, '2026', 'xxxvi + 362', '15,5 x 23,7 cm', 'UNESCO B5 (Bookpaper)', 'Rp 80.000', 'Buku ini merupakan jilid pertama dari total dua jilid seluruhnya. Pada jilid pertama ini dibahas mengenai Iman, Islam, dan Akhlaq.\r\nPenamaan AR-RISALAH itu sendiri dilatarbelakangi oleh dua hal; pertama, ar-Risalah adalah nama yang identik dengan ‘kerasulan’ Nabi Muhammad saw. Demikian juga bermakna ‘pesan’ dari Allah swt untuk disampaikan Rasul saw kepada umat manusia. Kitab ini sendiri jelas merupakan kajian akan ‘pesan-pesan’ tersebut sehingga tepat jika kemudian dinamakan ar-Risalah. Penamaan ini dengan sendirinya berbeda dengan karya para ulama salaf yang juga biasa menyebutkan risalah, seperti ar-Risalah karya Imam as-Syafi’i ataupun kumpulan risalah/Jami’ur-Rasa’il karya Ibn Taimiyyah, dimana karya-karya tersebut bermakna tulisan sederhana/pesanan untuk disampaikan kepada pihak tertentu dan kemudian diterbitkan menjadi kitab. Kedua, kitab ini diberi nama ar-Risalah untuk tidak menghilangkan identitas awalnya yang merupakan tulisan-tulisan syarah, hadits di majalah Risalah.\r\n\r\nDalam penyajian tulisan di jilid pertama ini, penulis membaginya kepada dua bab: (1) Memahami Iman dan Islam; di dalamnya akan disajikan hadits-hadits seputar rukun iman dan islam dan segenap pennasalahan yang terkait dengan pokok-pokok ajaran agama Islam. (2) Menuju Akhlaq Karimah; berisi kajian hadits-hadits yang lebih menitikberatkan pada adab dan perilaku yang baik menurut Islam.', 'books/photos/nOHtUFhGhHRrwYUswAbaPPJQAshBAA.jpg', 'books/photos/6sertkVBhxt7lOoTiaNvUCNWu6KiWU.jpg', 'books/photos/T8dBmM9Q6KVDVTZ9d78dh9523Pnmku.jpg', 'books/photos/n1v1wdRw6faeXDrfvzUyH9OjflM5ox.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:32:13', '2026-09-16 19:23:40'),
(18, 'BEKAL HAJI DAN UMRAH', 'bekal-haji-dan-umrah-KtA9', 'M.Rahmat Najieb', 'Fikih & Ibadah', '978-602-74345-9-2', NULL, '2026', 'xii + 92', '11,2 x 15,5 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', 'Buku ini kecil memuat adab-adab dan segala hal yang berkaitan dengan haji dan umrah. Karena agar tercapainya mabrur. Maka harus menguasai kaifiyat (cara), do’a-do’a, dan istilah-istilah yang ada.', 'books/photos/aTtvVHCJrxfRiQvmADTi8udhE0lp4b.jpg', 'books/photos/ItMXahLeelWCrYMv392tyDCxbSDwwB.jpg', 'books/photos/zuTJIWJPI0RiD5YqgSjeGjJRdzZtu6.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:35:47', '2026-09-16 19:26:49'),
(19, 'AKSI BOM SYAHID', 'aksi-bom-syahid-X20z', 'DR.MUHAMMAD THA\'MAH ALQADAH', 'Fiqih & Hukum Islam', '979-3212-03-9', NULL, '2026', 'ii + 72', '13x18,5 cm', 'UNESCO B5 (Bookpaper)', 'Rp 12.000', 'Buku ini mencoba membahas mengorbankan diri sendiri, intihar (bunuh diri), dan istisyhad (aksi bom syahid), dengan menjelaskan perbedaan dari ketiganya dari segi motivasi dan tujuannya.', 'books/photos/ULGp2r80iKmKqseEILGcROePyOy3Wy.jpg', 'books/photos/yp8HJcZBM0vnqkJ8GWWevOyMECO5TZ.jpg', 'books/photos/39CNciWn1BxEjRpAoxWuDfSHD9XUOF.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:41:05', '2026-09-16 19:08:23'),
(20, 'ETIKA BISNIS DALAM ISLAM', 'etika-bisnis-dalam-islam-Iuxg', 'A.Zakaria', 'Ekonomi & Bisnis Islam', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 22.000', NULL, 'books/photos/nekgtrmC34p2Ok1Vm5wvCGqdbdONda.jpg', 'books/photos/e92G70U951VqM08wmjew8YGFwihMXY.jpg', 'books/photos/ObxtKCA9Zz6wrZFNaPz7nyUpFnbgoi.jpg', 'books/photos/uVtn31EM5AjaYjiqWUTIKGtaekIKtf.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:45:09', '2026-09-05 06:55:43'),
(21, 'ETIKA HIDUP SEORANG MUSLIM', 'etika-hidup-seorang-muslim-YJ91', 'A.Zakaria', 'Akhlak & Etika Islam', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 22.000', NULL, 'books/photos/vqmBffmvXbbvtCueOgV88ZF1VrYRSO.jpg', 'books/photos/P1z3szgp4nr7SyIzO0J5ErYQUfczqs.jpg', 'books/photos/F0C5BiV7kYXOCfqsaMH8aYLI8oFTJ8.jpg', 'books/photos/cSTc1fgIlqydOzB6finN0Tn4bM8BVB.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:48:32', '2026-09-05 06:54:46'),
(22, 'FIQIH SHIYAM RAMADLAN', 'fiqih-shiyam-ramadlan-iGsS', 'M.Rahmat Najieb', 'Fikih & Ibadah', '978-602-5628-13-9', NULL, '2026', 'viii + 108', '11,7 x 15,7 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', 'Buku ini berisi tentang bagaimana agar lebih faham apa itu Ramadhan. Menjelaskan fadilah-fadilah, kaifiyah ibadah, dan momentum terbaik yang bisa dilakukan pada saat ramadhan.', 'books/photos/anOyG5qnWCtgfZ9a2oq2aBlUqKAX0K.jpg', 'books/photos/ox97QvgZjszhCXZ0UvEWos8rdZzynj.jpg', 'books/photos/VljbVXFADjKdx9eaCNOM9Jmlt1ASul.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:52:01', '2026-09-16 20:59:09'),
(23, 'IKHLISAR 10 MASALAH & ISBAL', 'ikhlisar-10-masalah-isbal-czNG', 'M.Rahmat najieb', 'Fikih & Ibadah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 25.000', NULL, 'books/photos/2Pl6hSukCdA3ISFlOH5OTYCR8ENILi.jpg', 'books/photos/AHxx1hpPEpWFZ9VUmymGlW6T0jStqI.jpg', 'books/photos/F6cwxP34rtOz9ogyTAHYIzFF3oW3Kh.jpg', 'books/photos/kXXWqSNUluZCRHybGU8h0a9NmEcpKF.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:55:10', '2026-09-05 06:53:24'),
(24, 'IKHTISAR 10 MASALAH SEPUTAR SHALAT & CADAR', 'ikhtisar-10-masalah-seputar-shalat-cadar-sRFD', 'M.Rahmat Najieb', 'Fikih & Ibadah', '978-602-74492-5-1', NULL, '2026', 'xiv + 114', '12 x 17,5 cm', 'UNESCO B5 (Bookpaper)', 'Rp 30.000', 'Buku ini mengurai dalil dan argumentasi yang dijadikan hujjah oleh Dewan Hisbah mengenai 11 masalah populer seputar shalat dan cadar. Tujuannya untuk menjawab keraguan umat. Semua masalah sudah pernah disidangkan oleh Dewan Hisbah.', 'books/photos/pXObyWXJL2yFLGB0SgG4pAHXRoc9G7.jpg', 'books/photos/R0g9BQAgbZiRs2QnSF6FyXeGTuq3GG.jpg', 'books/photos/4CtcFpxeZlUNJJA81wEy2LSPaej2Kd.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 21:57:37', '2026-09-16 21:00:29'),
(25, 'ISTIFTA : Shalat Berjamaah, Shalat Tarawih, Shalat Jumat, & Jenazah', 'istifta-wr2F', 'KH.E.Abdurrahman', 'Fiqih & Hukum Islam', NULL, NULL, '2026', '14,9x21 cm', '14,9x21 cm', 'UNESCO B5 (Bookpaper)', 'Rp 65.000', 'Buku ini menjadi rujukan penting bagi umat Islam karena di dalamnya memuat kumpulan soal jawab hukum Islam yang akan membantu para pembaca memperdalam pengetahuan agama yang sangat komprehensif dan selalu aktual dalam kehidupan manusia di muka bumi ini.\r\nMengingat kumpulan pertanyaan dan jawaban rubrik Istifta di Majalah Risalah, sejak edisi tahun1962-1983 kurang lebih 21 tahun, sudah barang tentu menghabiskan halaman yang amat tebal. Sehingga diperlukan penyajian dengan ketebalan yang dapat terjangkau oleh para pembaca secara lebih praktis dan ekonomis. Oleh karena itu Tim Penyusun membagi buku ini dalam beberapa jilid. Jilid 2 terdiri dari bab Shalat Berjamaah, Shalat Tarawih, Shalat Jumat, & Jenazah.', 'books/photos/WoPhf50GL8Gd34kpHH4ZqVbSRzK3bn.jpg', 'books/photos/LyjKf4oQKB9sXY5Ue4oKCKTgMBg5FH.jpg', 'books/photos/RjUVwU5lHb30t15QATanu1JisOJnUm.jpg', 'books/photos/oNxsgpGOlcEzXHzrr7DEbWGTNebnEC.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:00:44', '2026-09-16 21:08:17'),
(26, 'ISTIFTA TANYA JAWAB : Thaharrah, Adzan, Masjid, Shalat', 'idtifta-tanya-jawab-qPrH', 'KH.E.Abdurrahman', 'Fiqih & Hukum Islam', NULL, NULL, '2026', 'xxi + 318', '14,9x21 cm', 'UNESCO B5 (Bookpaper)', 'Rp 75.000', 'Buku ini menjadi rujukan penting bagi umat Islam karena di dalamnya memuat kumpulan soal jawab hukum Islam yang akan membantu para pembaca memperdalam pengetahuan agama yang sangat komprehensif dan selalu aktual dalam kehidupan manusia di muka bumi ini.\r\n\r\nMengingat kumpulan pertanyaan dan jawaban rubrik Istifta di Majalah Risalah, sejak edisi tahun 1962-1983 kurang lebih 21 tahun, sudah barang tentu menghabiskan halaman yang amat tebal. Sehingga diperlukan penyajian dengan ketebalan yang dapat terjangkau oleh para pembaca secara lebih praktis dan ekonomis. Oleh karena itu Tim Penyusun membagi buku ini dalam beberapa jilid. Jilid I terdiri dari bab Thaharrah, Adzan, Masjid, dan Shalat.', 'books/photos/Y7NIxOBjvto8YmoVbhKt6wn8qceJa0.jpg', 'books/photos/xZylHbyzmYUMDqDP12CyEVeimN7UhP.jpg', 'books/photos/cvyMtZPlEmRAyLdKbBYSpiuKvglfkd.jpg', 'books/photos/btfX6V1heNCwIbhs9oLEWI8D3VilAp.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:03:06', '2026-09-16 21:06:56'),
(27, 'ISTIFTA TANYA JAWAB HUKUM ISLAM KONTEMPORER', 'istifta-tanya-jawab-hukum-islam-91wf', 'KH. M. Romli | KH. A. Zakaria | KH. Akhyar Syuhada | KH. Usman Sholehudin | KH. I. Shadikin | KH. Zae Nandang | KH. Rahmat Najieb | KH. Uus M. Ruhiyat | KH. Jeje Zaenudin | KH. Wawa Suryana | KH. Wawan Shofwan Sholehudin | dkk.', 'Fiqih & Hukum Islam', NULL, NULL, '2026', '508', '15,7x24,5 cm', 'UNESCO B5 (Bookpaper)', 'Rp 98.000', 'Islam sudah sempurna. Allah sendiri yang menyempurnakan agama ini. Segala permasalahan tentang agama sudah tercantum di dalam al-Quran dan al-Hadits. Kita pun harus merujuk kepada keduanya,\r\n                      \"Hai orang-orang yang beriman, taatilah Allah dan taatilah\r\n                        Rasul (Nya), dan ulil amri di antara kamu. kemudian jika kamu\r\n                        berlainan pendapat tentang sesuatu, maka kembalikanlah\r\n                        ia kepada Allah (Al-Quran) dan Rasul (Sunnahnya), jika\r\n                        kamu benar-benar beriman kepada Allah dan kepada hari\r\n                        kemudian. Yang demikian itu lebih utama (bagimu) dan lebih\r\n                        baik akibatnya.\" (QS an-Nisa [4] : 59)\r\nHanya saja, umat adakalanya tidak memahami maksud ayat atau matan al-Hadits, atau memang kita tidak hafal kedua sumber hukum Islam itu. Karena itu, sering timbul permasalahan bagaimana hukum suatu amal, atau derajat hadits tertentu di samping maksud dari ayat-ayat yang kurang jelas. Untuk itu, para pembaca Majalah Risalah banyak mengajukan pertanyaan kepada redaksi yang selanjutnya disidangkan oleh beberapa orang anggota Dewan Hisbah dan kemudian dimuat dalam rubrik Istifta. Sedangkan masalah yang dianggap rumit dan perlu penelitian dalil, diajukan untuk didiskusikan dalam sidang Dewan Hisbah Lengkap.', 'books/photos/0nl677C7R645heZo8cEj7AsabJoZ10.jpg', 'books/photos/5TtuV7oFzaK9R7aLycVlVNWloRTqKl.jpg', 'books/photos/Ql1Ickr8B8MKkzyve1M1JY9XyCQeec.jpg', 'books/photos/A0rRThWHsT3qTIoDxnmBiIv4ivb1Yk.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:05:32', '2026-09-16 21:11:50'),
(28, 'ISTIGHFAR DAN ISTIRHAM', 'istighfar-dan-istirham-feK9', 'M.Rahmat najieb', 'Akhlak & Spiritual', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', NULL, 'books/photos/zOlH11t5k4wTloYAoTW13wZnx2gHkn.jpg', 'books/photos/VP1xPUQfEBoDnEL6iB0PPWRcCDvkI3.jpg', 'books/photos/9KlJzpAKQJS1HHyeLgYqTjBZgov7SO.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:10:03', '2026-09-05 06:51:22'),
(29, 'KEWAJIBAN TASBIH YANG TERABAIKAN', 'kewajiban-tasbih-yang-terabaikan-7mJ6', 'M.Rahmat najieb', 'Fikih & Ibadah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', NULL, 'books/photos/sy7V8oedZWAY9oucZUqySE4G6dZwzg.jpg', 'books/photos/gLDBOsmHzQxEBK8X74pf6oMHpnFShg.jpg', 'books/photos/rec26bKEAY7NQe94051UAmvlKsLvG6.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:12:48', '2026-09-05 06:50:39'),
(30, 'MENGENAL MUHAMMAD', 'mengenal-muhammad-tneU', 'A, HASSAN', 'Sirah & Sejarah Islam', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 60.000', NULL, 'books/photos/bG2NHSwyIaF0lDjR5JhY20cX7mc0wo.jpg', 'books/photos/x02oVquGMp28yyqdctMtA2spJaelBk.jpg', 'books/photos/3pyGmLI021Ng36Vn5qfYFXv6VRj0Xm.jpg', 'books/photos/iPk03CzPXMAXRPSgzG5RsB5l1eGHjY.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:15:23', '2026-09-05 06:49:55'),
(31, 'METODOLOGI  ISTINBAT HUKUM', 'metodologi-istinbat-hukum-R9aZ', 'A, HASSAN', 'Fiqih & Hukum Islam', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 50.000', NULL, 'books/photos/3Gn3ZfsY9fugCsido6FssIdL44XLtG.jpg', 'books/photos/yM7bVdPItr7w4NeyF3OQ5Wmi5nSI2Z.jpg', 'books/photos/J9NPbc2eWsEfj4yUykHUAPqIenZlvi.jpg', 'books/photos/QBNtUfYcahUMEkF8lrwXk1zrukiEhT.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:18:12', '2026-08-31 22:18:12'),
(32, 'MIMBAR JUMAT', 'mimbar-jumat-wclH', 'H.M. SAYUB SAYIDIN', 'Dakwah & Khutbah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 60.000', NULL, 'books/photos/n7ZscRlxznDLHZJX79sbO431qZGza0.jpg', 'books/photos/44SENTPaivt4hkSoqCHgLwDe60wLXY.jpg', 'books/photos/ZID8NvXaSQoIF0lC7IBsIKymupgiwQ.jpg', 'books/photos/qZE9CfBUH7SHk5diNauDAjEo5i7lJK.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:22:33', '2026-09-05 06:48:32'),
(33, 'MUTIARA TAFSIR AL-QUR\'AN', 'mutiara-tafsir-al-quran-sagp', 'NASHARUDDIN SYARIF', 'Tafsir & Al-Qur\'an', NULL, NULL, '2026', 'xvi + 284', '15,5 x 24,5 cm', 'UNESCO B5 (Bookpaper)', 'Rp 90.000', 'Buku “Mutiara Tafsir Al-Qur’an” ini mengetengahkan ayat-ayat pilihan yang layak untuk diingat-ingat sebagai penggugah jiwa pengingat lupa. Banyak ayat-ayat yang tekait dinamika kehidupan masyarakat kontemporer sebagai jawaban atas problematikanya menurut arahan al-Qur’an.', 'books/photos/rUxGlFs4pHE0ZuoSJcEBb1IYNZSO1S.jpg', 'books/photos/th48FULqv8EGElph19bfQchjKCyQxi.jpg', 'books/photos/8PQ852qsDVG5CLxbrrkHIHG25q35NH.jpg', 'books/photos/pLEDyA74teGGDodMC4iAu3t3T0GE1n.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:25:49', '2026-09-16 21:16:13'),
(34, 'Pokok Pokok Ilmu Tauhid', 'binazka-Yh7i', 'NASHARUDDIN SYARIF', 'Aqidah & Tauhid', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', NULL, 'books/photos/d1CqDV3dsMUPjCvGCMI2qidpu1SGQL.jpg', 'books/photos/ko1SFZItNncuJQRDdudu7b9HYQvmFy.jpg', 'books/photos/A0f8GmZTnMXv5f1fLtVzdJyDVJrKB0.jpg', 'books/photos/u7c845LgpcPip4csII802LoIQj32Wb.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:28:06', '2026-09-05 06:45:09'),
(35, 'QURBAN YANG DISYARIATKAN', 'qurban-yang-disyariatkan-DymQ', 'M.Rahmat najieb', 'Fikih & Ibadah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', NULL, 'books/photos/UDuXgSnlt4sjoxdIwtCo35vN4huZmZ.jpg', 'books/photos/O1RZoXei5mCPlb845Y59AgmGGGYpvw.jpg', 'books/photos/7p8ZY8OusbhcBES4EZkgZ4HDFM4JdR.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:31:25', '2026-09-05 06:43:46'),
(36, 'RISALAH HARTA', 'risalah-harta-loZ4', 'KH. JEJE ZAENUDIN', 'Fikih & Muamalah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 20.000', NULL, 'books/photos/cKxOe82TgrSpIfDGopIhy9NegbGkFp.jpg', 'books/photos/BfHvN3XHR0gBrnlrnCABC3Be4wpJLM.jpg', 'books/photos/0FLkNB5MYMDsL8j5IUej4ZctHOtZs9.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:34:12', '2026-09-05 06:42:49'),
(37, 'RISALAH SHALAT', 'risalah-shalat-1UPJ', 'KH. A. ZAKARIA', 'Fikih & Ibadah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 80.000', NULL, 'books/photos/UXQJh8WxY0ofeJQ0sW0ljy6SqaZKsx.jpg', 'books/photos/BfbgFYWljuRT2cfaF8NTnHyrKF02kA.jpg', 'books/photos/S7lcTvewWNdzLYmHpTUKNqrNPcFae1.jpg', 'books/photos/cNW1h49L0D7q2Oe5R1nptWHljmGvPn.jpg', NULL, NULL, 0, 1, 0, 'published', '2026-08-31 22:35:58', '2026-09-05 06:41:36'),
(38, 'THAHARAH DAN SHALAT SEBAGAI PETUNJUK RASULLULAH', 'thaharah-dan-shalat-sebagai-petunjuk-rasullulah-sv9R', 'M. RAHMAT NAJIEB', 'Fikih & Ibadah', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 10.000', NULL, 'books/photos/F8Kx0rhsCnBQmtnWzRbIJKFpHYbonx.jpg', 'books/photos/Lj5mYS3Epe7hojWeTfkXkmByUGiDyX.jpg', NULL, NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:38:23', '2026-09-05 06:40:44'),
(39, 'SUBLIMOTION', 'sublimotion-KfzM', 'TAUFIK GINANJAR', 'Motivasi & Inspirasi Islami', NULL, NULL, '2026', '213', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 35.000', NULL, 'books/photos/d5Hh6SGACGkCR0BZbmI9B0NcWRGKuU.jpg', 'books/photos/z3iF5wEuEyHuu8l86iZlhqbodWEeGz.jpg', 'books/photos/sqq0CkyBgCgGAbHZOO7UPQ58Lw0s5s.jpg', NULL, NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:39:47', '2026-09-05 06:39:45'),
(40, 'TAFSIR ANISA 1', 'tafsir-anisa-1-krTa', 'M. Rahmat Najieb', 'Tafsir & Al-Qur\'an', '978-602-74345-5-4', NULL, '2026', 'xiv + 378', '15,6 x 23,7 cm', 'UNESCO B5 (Bookpaper)', 'Rp 80.000', 'Sebuah buku tafsir yang disusun KH. M. Rahmat Najieb, in syaa a Allah memudahkan kita memahami kandungan Surah Annisa, diantaranya berkaitan petunjuk berumah tangga, bersuci, dll.\r\nJilid 1: pembahasan dari ayat 1 - 85', 'books/photos/lsJrpjVrlNuROZRasX0KzEMIHblXey.jpg', 'books/photos/hx76XzjdNWJStIyKiDlFq1D4FuClAk.jpg', 'books/photos/XT5QJUQi8ATMJ2lfC0iEdsAyoyEjzW.jpg', 'books/photos/zOXw5DmZJhvEczbaG0VpCTymg4uHa4.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:41:02', '2026-09-16 21:18:55'),
(41, 'TAFSIR ANISA 2', 'tafsir-anisa-2-wWm4', 'M. RAHMAT NAJIEB', 'Tafsir & Al-Qur\'an', '978-602-74345-6-1', NULL, '2026', 'xiv + 328', '15,5 x 23,6 cm', 'UNESCO B5 (Bookpaper)', 'Rp 70.000', 'Sebuah buku tafsir yang disusun KH. M. Rahmat Najieb, insyaAllah memudahkan kita memahami kandungan Surah Annisa, diantaranya berkaitan petunjuk berumah tangga, bersuci, dll.\r\nJilid 2: pembahasan dari ayat 86 - 176', 'books/photos/ggBd9mmgUw00huo6GHMd40TleDevHM.jpg', 'books/photos/zN5hMYOchakw47SQGeyUA5abt30QMJ.jpg', 'books/photos/N7fEceT6KugyHFSiRiLOa49vOwnf3J.jpg', 'books/photos/BMFrxjTDdtfm2wx60o75xfhC7xOhYl.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-08-31 22:42:31', '2026-09-16 21:20:02'),
(42, 'PANDUAN HIDUP BERJAMAAH', 'panduan-hidup-berjamaah-JpBy', 'Drs. KH, Shidiq Amin', 'Fiqih & Hukum Islam', NULL, NULL, '2026', '345', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 75.000', NULL, 'books/photos/ez5ykHONC4ZmDdZRpFpSuOL2PfJbus.jpg', NULL, NULL, NULL, NULL, NULL, 0, 1, 0, 'published', '2026-09-02 07:21:53', '2026-09-02 07:21:53'),
(43, 'PENGEMBANGAN BAHAN AJAR', 'pengembangan-bahan-ajar-8isL', 'Hafidz Fuad Halimi', 'Buku Ajar', NULL, NULL, '2026', '170', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 75.000', 'Buku Pengembangan Bahan Ajar Pendidikan Agama Islam\r\nKomprehensif disusun sebagai ikhtiar ilmiah untuk mengembangkan\r\nbahan ajar PAI yang relevan. Buku ini sekaligus menunjukkan\r\npentingnya kemampuan memadukan substansi keislaman dan teori\r\npendidikan ke dalam perangkat pembelajaran yang efektif.\r\nBuku ini diharapkan menjadi salah satu panduan dan referensi\r\nbagi mahasiswa Pendidikan Agama Islam dalam memahami\r\nprinsip, landasan, karakteristik, dan pengembangan bahan ajar\r\nPAI, sekaligus memberi wawasan bagi pendidik dan calon pendidik\r\nuntuk menghadirkan pembelajaran yang sistematis, kontekstual,\r\ndan bermakna. Sebab, kualitas PAI tidak hanya diukur dari\r\nbanyaknya materi yang disampaikan, tetapi dari sejauh mana ilmu\r\ndipahami, dihayati, dan diwujudkan dalam amal.', 'books/photos/gymQFNY4nrdfJc1WahklIbEduvnBkU.jpg', 'books/photos/vUWgNfMw9snpfOKJLcW2vP9I8HOpUZ.jpg', 'books/photos/9TpAUBQDeobWle5vlLlJl9lQXBfd1a.jpg', 'books/photos/P195u4QAFu07gghj2mm45hlGMRX6dg.jpg', NULL, NULL, 1, 0, 0, 'published', '2026-09-02 07:35:10', '2026-09-24 08:19:33'),
(44, 'Membangun Fondasi Keberagamaan Peserta Didik', 'membangun-fondasi-keberagamaan-peserta-didik-nyzB', 'Achmad Muharam Basyari, dkk', 'Buku Ajar', NULL, NULL, '2026', '144', '17,6 x 25 cm', 'UNESCO B5 (Bookpaper)', 'Rp 60.000', 'Substansi buku ini disusun secara sistematis, dimulai dari pembahasan tentang hakikat agama dan keberagamaan dalam Islam sebagai fondasi teologis dan konseptual. Selanjutnya, diuraikan sumber sikap dan perilaku serta dimensi keberagamaan yang membentuk struktur religiusitas peserta didik. Pembahasan tentang kematangan beragama dan manifestasinya dalam perilaku keberagamaan memberikan gambaran bahwa religiusitas bukan sekadar aspek kognitif, melainkan juga menyentuh ranah afektif dan moral.\r\nMenariknya, buku ini juga mengkaji jaringan-jaringan keberagamaan, seperti relasi takut–harap, cinta–benci, imanen–transenden, konkret–abstrak, setia–melawan, dan gairah–malas yang menunjukkan dinamika psikologis dan spiritual dalam perkembangan religiusitas. Pembahasan dilanjutkan dengan analisis perkembangan keberagamaan peserta didik pada jenjang SD, SMP, dan SMA, beserta program, strategi, implementasi, serta evaluasinya di lingkungan pendidikan.\r\nTidak kalah penting, buku ini menyoroti faktor-faktor pendukung dan penghambat perilaku keberagamaan peserta didik, serta menghadirkan zikir dan doa sebagai bentuk psikoterapi religius yang relevan dalam pembentukan kesehatan mental dan penguatan spiritual generasi muda. Dengan demikian, buku ini tidak hanya bersifat konseptual, tetapi juga menawarkan pendekatan praktis yang aplikatif dalam konteks pendidikan.', 'books/photos/9wjZOuUq8jz1RkxDxB5F8vCGOL7rL7.jpg', 'books/photos/txx3ywnK0tOIakXwcXH3MWJj8325bq.jpg', 'books/photos/cIy6gFJxAonsJEgzCYunLqhynXzIYa.jpg', 'books/photos/HcxWomjILN6oEaUbTChIm5xM0XWEtq.jpg', NULL, NULL, 0, 0, 0, 'published', '2026-09-14 23:46:54', '2026-09-14 23:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `book_id`, `quantity`, `created_at`, `updated_at`) VALUES
(16, 3, 43, 1, '2026-09-02 19:20:26', '2026-09-02 19:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service_category` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `service_category`, `subject`, `message`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(8, 'Alex Web', 'alex.roex@gmail.com', '2102102101', 'Pengurusan ISBN & HKI', 'penerbitpersis.com - Can I Send Your Free SEO Fix Report?', 'Hello penerbitpersis.com,\r\n\r\nI took a quick look at your website and noticed a few things that could be improved to help you get better results online.\r\n\r\nOne key issue is that several important pages aren’t fully optimized for Google, which can limit your visibility. If you’d like, I can send you a FREE REPORT showing what’s missing and how it can be improved.\r\n\r\nIf you prefer, we can also set up a short Google Meet call to go through the details together.\r\n\r\nWould you like me to send the report for review?\r\n\r\nKind regards,', 'pending', NULL, '2026-09-14 10:25:22', '2026-09-14 10:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_25_003517_add_role_to_users_table', 1),
(5, '2026_08_25_005018_add_phone_and_status_to_users_table', 1),
(6, '2026_08_25_005305_create_contact_messages_table', 1),
(7, '2026_08_25_005306_create_site_settings_table', 1),
(8, '2026_08_26_000001_create_books_table', 2),
(9, '2026_08_27_000001_add_multi_photos_to_books_table', 3),
(10, '2026_08_27_012710_add_avatar_to_users_table', 4),
(11, '2026_08_27_020000_create_cart_items_table', 5),
(12, '2026_08_28_000001_create_orders_table', 6),
(13, '2026_08_28_000002_create_order_messages_table', 7),
(14, '2026_08_31_000001_add_size_to_books_table', 8),
(15, '2026_09_01_000001_create_services_table', 9),
(16, '2026_09_03_000001_create_article_categories_table', 10),
(17, '2026_09_03_000002_create_articles_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` text DEFAULT NULL,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_payment` decimal(12,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) NOT NULL DEFAULT 'qris',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `gateway_project` varchar(255) DEFAULT NULL,
  `payment_qr_string` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `items_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`items_json`)),
  `notes` text DEFAULT NULL,
  `shipping_status` varchar(255) NOT NULL DEFAULT 'menunggu_proses',
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_messages`
--

CREATE TABLE `order_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_type` varchar(255) NOT NULL DEFAULT 'customer',
  `sender_name` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `shared_shipping_status` varchar(255) DEFAULT NULL,
  `shared_tracking_number` varchar(255) DEFAULT NULL,
  `is_read_by_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_read_by_customer` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'fa-solid fa-book',
  `short_desc` text DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `overview` longtext DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `workflow_steps` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`workflow_steps`)),
  `benefits` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `pricing_packages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pricing_packages`)),
  `faqs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`faqs`)),
  `cta_text` varchar(255) DEFAULT 'Konsultasi Sekarang',
  `cta_url` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` enum('published','draft') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `slug`, `icon`, `short_desc`, `tagline`, `banner_image`, `overview`, `features`, `workflow_steps`, `benefits`, `notes`, `pricing_packages`, `faqs`, `cta_text`, `cta_url`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Penerbitan Buku', 'penerbitan-buku', 'fa-solid fa-book-open', 'Layanan penerbitan buku secara profesional, mulai dari penelaahan naskah, penyuntingan, tata letak, hingga terbit ber-ISBN resmi.', '“Mewujudkan Gagasan Menjadi Karya Monumental yang Menginspirasi Umat.”', 'https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=1600&auto=format&fit=crop', 'Penerbit Persis melayani penerbitan berbagai jenis buku, baik karya perorangan, karya bersama (bunga rampai), maupun penerbitan institusi/organisasi.\r\nKami membantu penulis dalam seluruh rangkaian proses penerbitan secara profesional, mulai dari penelaahan naskah, penyuntingan (editing), penataan letak (layout), desain sampul, pengurusan ISBN, hingga pencetakan dan distribusi.', '[]', '[{\"step\":1,\"title\":\"Penyerahan & Telaah Naskah\",\"desc\":\"Penulis mengirimkan draf naskah lengkap. Tim redaksi melakukan telaah awal terkait tema, kelayakan, dan kesesuaian naskah.\"},{\"step\":2,\"title\":\"Editing & Proofreading\",\"desc\":\"Penyuntingan bahasa, tata kalimat, ejaan, konsistensi istilah, dan keterbacaan naskah oleh editor profesional.\"},{\"step\":3,\"title\":\"Layout & Desain Sampul\",\"desc\":\"Penataan halaman isi buku sesuai standar penerbitan serta perancangan desain sampul (cover) yang menarik dan representatif.\"},{\"step\":4,\"title\":\"Pengurusan Legalitas & ISBN\",\"desc\":\"Pengajuan nomor ISBN resmi dan pencatatan Katalog Dalam Terbitan (KDT) melalui sistem Perpustakaan Nasional RI.\"},{\"step\":5,\"title\":\"Persetujuan Cetak (Proofing)\",\"desc\":\"Pemeriksaan draf akhir (dummy) oleh penulis sebelum naik cetak untuk memastikan tidak ada kesalahan.\"},{\"step\":6,\"title\":\"Pencetakan & Distribusi\",\"desc\":\"Buku dicetak dengan spesifikasi yang disepakati dan didistribusikan kepada penulis maupun jaringan pembaca.\"}]', 'Jenis Buku yang Diterbitkan Penerbit Persis:\r\n• Buku Keislaman & Dakwah\r\n• Buku Akademik & Referensi Dosen\r\n• Buku Hasil Penelitian Ilmiah\r\n• Buku Pendidikan & Modul Ajar\r\n• Buku Ajar Perguruan Tinggi\r\n• Buku Anak & Keluarga Islami\r\n• Buku Sosial, Humaniora & Pemikiran\r\n• Buku Organisasi & Kelembagaan Jamiyyah', 'Catatan: Setiap naskah yang masuk akan melalui proses telaah etik dan kesesuaian nilai keilmuan oleh Dewan Redaksi Penerbit Persis.', NULL, '[{\"q\":\"Apakah penulis luar (umum) bisa menerbitkan buku di Penerbit Persis?\",\"a\":\"Bisa. Penerbit Persis terbuka untuk dosen, guru, peneliti, akademisi, aktivis, dai, mahasiswa, dan masyarakat umum yang memiliki karya tulis berkualitas.\"},{\"q\":\"Berapa minimal jumlah eksemplar untuk cetak buku?\",\"a\":\"Kami melayani sistem Print on Demand (POD) mulai dari jumlah terbatas (puluhan eksemplar) hingga cetak massal (ribuan eksemplar) sesuai kebutuhan penulis.\"},{\"q\":\"Berapa lama proses penerbitan dari naskah masuk hingga terbit?\",\"a\":\"Rata-rata proses penerbitan memakan waktu 2 hingga 4 minggu tergantung kesiapan naskah dan antrean verifikasi ISBN Perpusnas.\"}]', 'Konsultasi Penerbitan Buku', NULL, 1, 'published', '2026-08-31 18:38:59', '2026-08-31 19:48:19'),
(2, 'Konversi KTI Menjadi Buku', 'konversi-kti', 'fa-solid fa-graduation-cap', 'Ubah skripsi, tesis, disertasi, atau laporan penelitian menjadi buku referensi/monograf yang populer dan ber-ISBN.', '“Transformasi Riset Akademik Menjadi Buku Bernilai Tambah dan Luas Manfaatnya.”', 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=1600&auto=format&fit=crop', 'Banyak karya ilmiah seperti skripsi, tesis, disertasi, dan laporan riset hanya tersimpan di perpustakaan kampus atau repositori digital. Melalui layanan ini, kami membantu mengonversi laporan ilmiah kaku menjadi buku monograf, buku referensi, atau buku populer yang nyaman dibaca publik luas tanpa menghilangkan substansi keilmuannya.', '[\"Restrukturisasi format laporan riset kaku (Bab I-V) menjadi bab tematik buku\",\"Penyuntingan bahasa ilmiah agar lebih komunikatif dan mengalir enak dibaca\",\"Penataan ulang tinjauan pustaka, metodologi, dan data riset\",\"Pengayaan konteks bacaan untuk jangkauan pembaca yang lebih luas\",\"Tata letak interior buku standar penerbitan nasional\",\"Perancangan desain cover profesional dan representatif\",\"Pengurusan ISBN dan penerbitan resmi bernilai KUM bagi akademisi\"]', '[{\"step\":1,\"title\":\"Analisis Naskah Riset\",\"desc\":\"Menelaah substansi, tema utama, dan kelayakan naskah karya ilmiah asli.\"},{\"step\":2,\"title\":\"Penyusunan Struktur Buku\",\"desc\":\"Menyusun kembali kerangka naskah dari format laporan kaku menjadi bab buku tematik yang sistematis.\"},{\"step\":3,\"title\":\"Editing & Penyederhanaan Bahasa\",\"desc\":\"Parafrase kalimat ilmiah agar lebih komunikatif, renyah, dan mengalir enak dibaca.\"},{\"step\":4,\"title\":\"Penyesuaian Isi & Konteks\",\"desc\":\"Penyelarasan referensi, pengayaan konteks, dan penyesuaian materi dengan target pembaca luas.\"},{\"step\":5,\"title\":\"Desain & Layout Standar\",\"desc\":\"Tata letak interior buku standar penerbitan nasional dan perancangan desain sampul (cover) menarik.\"},{\"step\":6,\"title\":\"ISBN & Publikasi Resmi\",\"desc\":\"Pengurusan nomor legalitas ISBN resmi Perpustakaan Nasional RI dan penerbitan buku fisik maupun digital.\"}]', 'Keunggulan Konversi KTI di Penerbit Persis:\n• Tetap mempertahankan substansi dan nilai ilmiah orisinal karya\n• Bahasa dibuat lebih komunikatif, komunikatif, dan mudah dipahami\n• Struktur disesuaikan dengan format buku standar penerbitan ilmiah\n• Membantu menghasilkan buku yang bernilai angka kredit (KUM) bagi dosen\n• Dapat dilanjutkan dengan layanan ISBN, cetak, dan distribusi resmi', 'Catatan: Hak cipta dan keaslian isi riset sepenuhnya tetap menjadi milik penulis. Penerbit membantu dalam aspek teknis penulisan buku dan legalitas terbitan.', NULL, '[{\"q\":\"Apakah format laporan skripsi\\/tesis saya harus diubah sendiri sebelum diserahkan?\",\"a\":\"Tidak perlu. Anda cukup menyerahkan file dokumen naskah lengkap, dan tim editor kami yang akan membantu merekonstruksinya menjadi format buku.\"},{\"q\":\"Apakah buku hasil konversi KTI bisa digunakan untuk syarat kenaikan pangkat\\/KUM?\",\"a\":\"Ya, tentu. Buku yang diterbitkan dilengkapi nomor ISBN resmi Perpustakaan Nasional dan surat bukti terbit yang sah untuk keperluan angka kredit dosen\\/peneliti.\"}]', 'Konsultasi Konversi KTI', NULL, 2, 'published', '2026-08-31 18:38:59', '2026-08-31 18:38:59'),
(3, 'Pengurusan ISBN', 'pengurusan-isbn', 'fa-solid fa-barcode', 'Bantu pengurusan ISBN resmi Perpustakaan Nasional untuk buku dan terbitan Anda.', '“Satu Karya, Satu Identitas, Siap Diterbitkan.”', 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=1600&auto=format&fit=crop', 'Penerbit Persis menyediakan layanan pengurusan ISBN (International Standard Book Number) untuk membantu penulis dan lembaga memperoleh identitas resmi bagi buku yang akan diterbitkan.\r\nISBN menjadi identitas unik internasional yang memudahkan pendataan, identifikasi, distribusi, dan pengelolaan bibliografis sebuah buku di kancah nasional maupun global.', '[]', '[{\"step\":1,\"title\":\"Pengajuan Naskah & Data\",\"desc\":\"Penulis menyerahkan naskah dan data buku kepada Penerbit Persis.\"},{\"step\":2,\"title\":\"Pemeriksaan Kelengkapan\",\"desc\":\"Tim memeriksa naskah, identitas penulis, judul, dan informasi penerbitan.\"},{\"step\":3,\"title\":\"Penyusunan Metadata Standar\",\"desc\":\"Data bibliografis buku disiapkan sesuai kebutuhan pengajuan ISBN Perpusnas.\"},{\"step\":4,\"title\":\"Pengajuan ke Perpusnas RI\",\"desc\":\"Penerbit mengajukan permohonan ISBN melalui sistem resmi Perpustakaan Nasional RI.\"},{\"step\":5,\"title\":\"Verifikasi & Validasi\",\"desc\":\"Data pengajuan diproses dan diverifikasi sesuai ketentuan yang berlaku.\"},{\"step\":6,\"title\":\"Penerbitan ISBN & Barcode\",\"desc\":\"Nomor ISBN yang diterbitkan dicantumkan pada bagian buku yang sesuai beserta barcode.\"},{\"step\":7,\"title\":\"Buku Siap Didistribusikan\",\"desc\":\"Buku dapat dilanjutkan ke tahap cetak, publikasi, dan distribusi.\"}]', 'Nilai Tambah Pengurusan ISBN di Penerbit Persis:\r\n• Mudah & Tanpa Ribet Birokrasi\r\n• Terarah dengan Pendampingan Redaksi\r\n• Profesional Sesuai Standar Perpusnas RI\r\n• Terintegrasi dengan Layanan Cetak & Distribusi', 'Catatan: ISBN bukan sertifikasi mutu atau hak cipta buku. ISBN berfungsi sebagai identitas unik publikasi buku yang terdaftar resmi di Perpustakaan Nasional RI.', NULL, '[{\"q\":\"Berapa lama proses pengurusan ISBN?\",\"a\":\"Proses pengurusan ISBN biasanya membutuhkan waktu 3-7 hari kerja tergantung antrean verifikasi di sistem Perpustakaan Nasional RI.\"},{\"q\":\"Apa saja syarat yang diperlukan untuk pengajuan ISBN?\",\"a\":\"Draf naskah lengkap (Judul, Daftar Isi, Kata Pengantar, Sinopsis\\/Blurb belakang), identitas penulis, dan spesifikasi buku (ukuran & estimasi jumlah halaman).\"}]', 'Konsultasi Pengurusan ISBN', NULL, 3, 'published', '2026-08-31 18:38:59', '2026-08-31 19:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'contact_address', 'Kantor Redaksi PERSIS PERS, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287', '2026-08-25 23:00:56', '2026-09-07 23:02:27'),
(2, 'contact_whatsapp', '0859-7800-6263', '2026-08-25 23:00:56', '2026-09-12 16:36:52'),
(3, 'contact_phone', '(022) 5441951', '2026-08-25 23:00:56', '2026-09-07 23:02:27'),
(4, 'contact_email', 'info@penerbitpersis.com', '2026-08-25 23:00:56', '2026-08-28 07:18:08'),
(5, 'contact_hours', 'Senin - Jumat: 08:00 - 16:00 WIB', '2026-08-25 23:00:56', '2026-08-25 23:25:59'),
(6, 'contact_maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2974465063073!2d107.63660527587638!3d-6.974191668289417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9af8d8c919d%3A0xe96841b53fa976df!2sPERSIS%20PERS%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid', '2026-08-25 23:00:56', '2026-09-07 23:02:27'),
(7, 'contact_banner_badge', 'Layanan & Informasi', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(8, 'contact_banner_title', 'Hubungi Kami & Layanan Redaksi', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(9, 'contact_banner_desc', 'Konsultasikan naskah buku, kebutuhan cetak, pengurusan ISBN, atau publikasi ilmiah bersama tim Persis Pers. Kami siap membantu Anda.', '2026-08-25 23:03:55', '2026-08-26 09:43:42'),
(10, 'contact_email_note', 'Respon cepat 1x24 jam kerja', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(11, 'contact_hours_weekend', 'Sabtu & Minggu: Tutup', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(12, 'contact_wa_box_title', 'Konsultasi Cepat (WhatsApp)', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(13, 'contact_wa_box_subtitle', 'Langsung terhubung dengan Tim Redaksi', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(14, 'contact_wa_box_desc', 'Ingin konsultasi langsung terkait naskah buku, estimasi biaya cetak, atau panduan ISBN? Klik tombol di bawah untuk memulai chat WhatsApp resmi.', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(15, 'contact_wa_btn_text', 'CHAT WHATSAPP SEKARANG', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(16, 'contact_wa_default_msg', 'Assalamualaikum Redaksi Penerbit Persis, saya ingin berkonsultasi mengenai penerbitan naskah buku.', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(17, 'contact_maps_title', 'Lokasi Kantor Redaksi & Percetakan', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(18, 'contact_maps_external_url', 'https://maps.app.goo.gl/uXpW7mS6V8n5fF9w8', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(19, 'notification_recipient_email', 'zakiyh782@gmail.com', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(20, 'about_banner_badge', 'Mengenal Lembaga', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(21, 'about_banner_title', 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(22, 'about_banner_desc', 'PERSIS PERS adalah unit penerbitan dan percetakan resmi di bawah naungan Penerbitan & Percetakan PERSIS PERS, berdedikasi dalam menyebarluaskan khazanah keilmuan Islam dan literasi akademik berkualitas.', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(23, 'about_profile_title', 'Komitmen Membangun Peradaban Literasi & Riset Akademik', '2026-08-25 23:03:55', '2026-08-26 09:43:42'),
(24, 'about_profile_story_1', 'PERSIS PERS didirikan sebagai wujud nyata komitmen PERSIS PERS (PERSIS PERS) Bandung dalam menjembatani hasil riset, gagasan akademik para dosen, peneliti, dan civitas akademika agar dapat bertransformasi menjadi karya buku bermutu tinggi yang ber-ISBN dan tersebar luas ke masyarakat umum.', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(25, 'about_profile_story_2', 'Kami melayani penerbitan buku ajar perguruan tinggi, monograf, buku referensi, konversi karya tulis ilmiah (skripsi, tesis, disertasi), hingga jurnal ilmiah. Dilengkapi divisi percetakan mandiri dengan mesin offset dan digital printing modern, kami menjamin kualitas cetak, kerapian tata letak (layout), dan desain sampul yang estetik serta presisi.', '2026-08-25 23:03:55', '2026-09-07 23:02:27'),
(26, 'about_vision', 'Menjadi lembaga penerbitan dan percetakan perguruan tinggi Islam yang unggul, profesional, dan bereputasi nasional dalam pengembangan literasi Islam serta hilirisasi karya ilmiah terintegrasi pada tahun 2030.', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(27, 'about_mission_1', 'Menerbitkan buku-buku ilmiah, buku ajar, dan referensi berstandar nasional dengan proses peer-review yang objektif dan ketat.', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(28, 'about_mission_2', 'Memberikan layanan pendampingan penulisan, penyuntingan bahasa (editing), tata letak (layout), dan desain sampul secara profesional.', '2026-08-25 23:03:55', '2026-08-25 23:03:55'),
(29, 'about_mission_3', 'Memfasilitasi pengurusan legalitas resmi penerbitan (ISBN, KDT, e-ISBN) bekerjasama dengan Perpustakaan Nasional RI.', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(30, 'about_mission_4', 'Menyediakan layanan percetakan berkualitas tinggi dengan teknologi modern yang cepat, presisi, dan harga terjangkau.', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(31, 'about_stat_books', '150+', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(32, 'about_stat_authors', '80+', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(33, 'about_stat_isbn', '100%', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(34, 'about_stat_copies', '25.000+', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(35, 'about_director_name', 'Dr. H. Ahmad Fauzi, M.Ag.', '2026-08-25 23:03:56', '2026-09-07 23:02:27'),
(36, 'about_director_title', 'Kepala Unit Penerbitan & Percetakan', '2026-08-25 23:03:56', '2026-08-25 23:03:56'),
(37, 'about_editor_chief', 'Nurul Hidayah, M.Pd.', '2026-08-25 23:03:56', '2026-09-07 23:02:27'),
(38, 'about_editor_chief_title', 'Editor Pelaksana & Mutu Naskah', '2026-08-25 23:03:56', '2026-09-07 23:02:27'),
(39, 'about_production_lead', 'M. Zaki Farhan, S.Kom.', '2026-08-25 23:03:56', '2026-09-07 23:02:27'),
(40, 'about_production_lead_title', 'Kepala Produksi & Percetakan', '2026-08-25 23:03:56', '2026-09-07 23:02:27'),
(41, 'about_feature_1', 'Proses Peer-Review Berstandar Ilmiah', '2026-08-25 23:25:59', '2026-08-25 23:25:59'),
(42, 'about_feature_2', 'Pengurusan ISBN & KDT Resmi Perpusnas', '2026-08-25 23:25:59', '2026-08-25 23:25:59'),
(43, 'about_feature_3', 'Mesin Cetak Offset & Digital Mandiri', '2026-08-25 23:25:59', '2026-08-25 23:25:59'),
(44, 'about_feature_4', 'Pendampingan Naskah Sampai Terbit', '2026-08-25 23:25:59', '2026-08-25 23:25:59'),
(45, 'catalog_banner_badge', 'Cari Buku yang Anda Inginkan', '2026-08-26 11:55:27', '2026-08-31 20:04:16'),
(46, 'catalog_banner_title', 'Katalog Buku Penerbit Persis', '2026-08-26 11:55:27', '2026-08-31 20:04:16'),
(47, 'catalog_banner_desc', 'Temukan Beragam Karya Pilihan Penerbit Persis\r\n\r\nJelajahi koleksi buku terbitan Penerbit Persis yang menghadirkan beragam karya keislaman, pendidikan, akademik, penelitian, buku anak, hingga karya inspiratif.\r\nSetiap buku diterbitkan dengan komitmen untuk menghadirkan karya yang berkualitas, informatif, dan memberikan manfaat bagi pembaca serta masyarakat luas.\r\nTemukan buku pilihan Anda dan jadikan ilmu sebagai sumber inspirasi dan manfaat.', '2026-08-26 11:55:27', '2026-08-31 20:01:46'),
(48, 'catalog_stat_books', '150+ Judul Buku', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(49, 'catalog_stat_authors', 'Mubaligh dan Akademisi', '2026-08-26 11:55:27', '2026-08-31 20:16:36'),
(50, 'catalog_stat_isbn', 'ISBN Perpusnas', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(51, 'catalog_stat_print', 'Cetak Berkualitas', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(52, 'catalog_promo_title', 'adsdaw', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(53, 'catalog_promo_desc', 'Paket lengkap pengurusan ISBN, layout standar UNESCO, dan proofreading.', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(54, 'catalog_agenda_title', 'Bedah Buku & Call for Book Chapters Dosen', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(55, 'catalog_agenda_desc', 'Terbuka untuk civitas akademika dan peneliti eksternal.', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(56, 'catalog_publish_box_title', 'Punya Naskah Buku Sendiri?', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(57, 'catalog_publish_box_desc', 'Terbitkan karya ilmiah Anda bersama PERSIS PERS dengan jaminan ISBN resmi dan mutu cetak prima.', '2026-08-26 11:55:27', '2026-08-26 11:55:27'),
(58, 'home_services_json', '[{\"icon\":\"fa-solid fa-book-open\",\"title\":\"Penerbitan Buku\",\"desc\":\"Menerbitkan buku referensi, buku ajar, monograf, dan berbagai karya ilmiah.\",\"link\":\"\\/kontak\"},{\"icon\":\"fa-solid fa-graduation-cap\",\"title\":\"Konversi KTI\",\"desc\":\"Ubah skripsi, tesis, disertasi menjadi buku berkualitas siap terbit.\",\"link\":\"\\/kontak\"},{\"icon\":\"fa-solid fa-barcode\",\"title\":\"Pengurusan ISBN\",\"desc\":\"Bantu pengurusan ISBN untuk buku dan terbitan Anda.\",\"link\":\"\\/kontak\"},{\"icon\":\"fa-solid fa-box-open\",\"title\":\"Cetak Custom\",\"desc\":\"Cetak sesuai kebutuhan dengan ukuran dan bahan yang beragam.\",\"link\":\"\\/kontak\"}]', '2026-08-28 02:33:43', '2026-08-28 02:35:36'),
(59, 'home_slide1_title', 'Melayani Penerbitan\r\nPercetakan, Konversi KTI, & ISBN', '2026-08-28 02:33:43', '2026-08-30 10:45:54'),
(60, 'home_slide1_highlight', 'Wujudkan Naskah Anda Menjadi Buku', '2026-08-28 02:33:43', '2026-08-30 10:45:54'),
(61, 'home_slide1_desc', 'Penerbit Persis hadir untuk mendukung kebutuhan penerbitan buku, jurnal, modul, dan berbagai produk cetak lainnya dengan kualitas terbaik dan pelayanan profesional.', '2026-08-28 02:33:43', '2026-08-30 07:34:44'),
(62, 'home_slide1_image', '/storage/banners/gs2YJC39yoOn6gGIl5FpqM2AFYXmnWofUMKCKMPi.jpg', '2026-08-28 02:33:43', '2026-09-02 07:01:08'),
(63, 'home_slide1_btn1_text', 'LIHAT LAYANAN', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(64, 'home_slide1_btn1_url', '#layanan', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(65, 'home_slide1_btn2_text', 'KATALOG BUKU', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(66, 'home_slide1_btn2_url', '/katalog', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(67, 'home_slide2_title', 'Terbitkan Karya Anda Bersama Kami', '2026-08-28 02:33:43', '2026-09-01 06:20:41'),
(68, 'home_slide2_highlight', 'Wujudkan Naskah Anda Menjadi Buku', '2026-08-28 02:33:43', '2026-08-30 07:34:44'),
(69, 'home_slide2_desc', 'Penerbit Persis membantu penulis menerbitkan karya berkualitas, mulai dari penyuntingan naskah, desain sampul, layout, hingga proses penerbitan', '2026-08-28 02:33:43', '2026-08-30 07:34:44'),
(70, 'home_slide2_image', '/storage/banners/3eGlEtQiOVCNhYh8VgyIFiuwjeIGhNDMlhlrMIr4.jpg', '2026-08-28 02:33:43', '2026-09-02 07:01:08'),
(71, 'home_slide2_btn1_text', 'Hubungi Kami', '2026-08-28 02:33:43', '2026-09-01 14:07:18'),
(72, 'home_slide2_btn1_url', '/kontak', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(73, 'home_slide2_btn2_text', 'Layan Kami', '2026-08-28 02:33:43', '2026-09-01 14:07:18'),
(74, 'home_slide2_btn2_url', '#layanan', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(75, 'home_slide3_title', 'Jelajahi Koleksi Buku Terbitan Persis', '2026-08-28 02:33:43', '2026-09-01 06:24:12'),
(76, 'home_slide3_highlight', 'Segera Terbit', '2026-08-28 02:33:43', '2026-09-02 06:55:56'),
(77, 'home_slide3_desc', 'Temukan beragam buku pilihan dari Penerbit Persis yang hadir untuk menambah wawasan, memperkaya pengetahuan, dan menemani perjalanan membaca Anda.', '2026-08-28 02:33:43', '2026-09-01 06:24:12'),
(78, 'home_slide3_image', '/storage/banners/niq9RiR22zZpMPuhA3GOcl1HUVYDdJqmEIYWDTF3.jpg', '2026-08-28 02:33:43', '2026-09-02 07:01:08'),
(79, 'home_slide3_btn1_text', 'ORDER SEKARANG', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(80, 'home_slide3_btn1_url', '/katalog', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(81, 'home_slide3_btn2_text', 'HUBUNGI KAMI', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(82, 'home_slide3_btn2_url', '/kontak', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(83, 'home_feat1_title', 'Kualitas Terbaik', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(84, 'home_feat1_desc', 'Hasil cetak tajam, warna akurat', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(85, 'home_feat2_title', 'Pelayanan Cepat', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(86, 'home_feat2_desc', 'Proses produksi tepat waktu', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(87, 'home_feat3_title', 'Harga Bersahabat', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(88, 'home_feat3_desc', 'Harga kompetitif & transparan', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(89, 'home_feat4_title', 'Berpengalaman', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(90, 'home_feat4_desc', 'Didukung tim berpengalaman', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(91, 'home_about_title', 'PENERBIT PERSIS', '2026-08-28 02:33:43', '2026-08-30 07:26:29'),
(92, 'home_about_desc', 'Mewujudkan Gagasan Menjadi Karya yang Bernilai\r\n\r\nPenerbit Persis hadir sebagai layanan penerbitan yang membantu penulis, akademisi, mahasiswa, dosen, dan masyarakat umum dalam mengembangkan naskah menjadi buku yang layak terbit dan memiliki identitas penerbitan yang resmi.\r\n\r\nKami melayani berbagai kebutuhan penerbitan, mulai dari penerbitan buku, konversi Karya Tulis Ilmiah (KTI) menjadi buku, hingga pengurusan ISBN.', '2026-08-28 02:33:43', '2026-08-30 07:26:29'),
(93, 'home_about_image', '/storage/banners/VaebawMcKaGiGUuZkNqmn7T9xqaPNCqOg1Ifi7on.png', '2026-08-28 02:33:43', '2026-08-31 16:02:58'),
(94, 'home_process_title', 'Proses Produksi Profesional', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(95, 'home_process_desc', 'Didukung peralatan modern & pengawasan mutu di setiap tahap produksi.', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(96, 'home_services_badge', 'LAYANAN KAMI', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(97, 'home_services_title', 'Solusi Lengkap Untuk Kebutuhan Anda', '2026-08-28 02:33:43', '2026-08-28 02:33:43'),
(98, 'topbar_is_active', '1', '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(99, 'topbar_tagline', 'Penerbitan & Percetakan Resmi PENERBIT PERSIS Bandung', '2026-09-01 23:49:02', '2026-09-02 06:47:12'),
(100, 'social_facebook', 'https://facebook.com', '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(101, 'social_twitter', 'https://twitter.com', '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(102, 'social_pinterest', 'https://pinterest.com', '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(103, 'social_whatsapp', 'https://wa.me/6285978006263', '2026-09-01 23:49:02', '2026-09-12 16:36:52'),
(104, 'social_telegram', 'https://t.me', '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(105, 'social_instagram', 'https://www.instagram.com/bukubukupersis/', '2026-09-01 23:49:02', '2026-09-01 23:53:26'),
(106, 'social_tiktok', 'https://www.tiktok.com/@agenbukubook?is_from_webapp=1&sender_device=pc', '2026-09-01 23:49:02', '2026-09-01 23:52:09'),
(107, 'social_youtube', 'https://youtube.com', '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(108, 'social_linkedin', NULL, '2026-09-01 23:49:02', '2026-09-01 23:49:02'),
(109, 'social_facebook_active', '0', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(110, 'social_twitter_active', '0', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(111, 'social_pinterest_active', '0', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(112, 'social_whatsapp_active', '1', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(113, 'social_telegram_active', '0', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(114, 'social_instagram_active', '1', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(115, 'social_tiktok_active', '1', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(116, 'social_youtube_active', '0', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(117, 'social_linkedin_active', '0', '2026-09-01 23:59:32', '2026-09-01 23:59:32'),
(118, 'home_slides_json', '[{\"type\":\"clean\",\"fit\":\"cover\",\"title\":\"\",\"highlight\":\"\",\"desc\":\"\",\"image\":\"\\/images\\/banners\\/banner_persis_widescreen_terbaru_2026.jpg\",\"btn1_text\":\"KATALOG\",\"btn1_url\":\"\\/katalog\",\"btn2_text\":\"HUBUNGI KAMI\",\"btn2_url\":\"\\/kontak\"}]', '2026-09-02 18:09:44', '2026-09-07 02:52:45'),
(119, 'news_banner_badge', 'WARNA LITERASI & WARTA', '2026-09-06 03:05:21', '2026-09-06 03:05:21'),
(120, 'news_banner_title', 'Kabar & Artikel Penerbitan', '2026-09-06 03:05:21', '2026-09-07 23:02:27'),
(121, 'news_banner_desc', 'Temukan warta kegiatan, tips penulisan buku ber-ISBN, agenda workshop, serta pemikiran literasi Islam dari Penerbit Persis.', '2026-09-06 03:05:21', '2026-09-07 23:02:27'),
(122, 'home_promo_active', '1', '2026-09-07 17:53:26', '2026-09-07 17:53:26'),
(123, 'home_promo_slides_json', '[{\"image\":\"\\/storage\\/promo_banners\\/1JQTOglFxdFHqSZTSbxv76GLdCoPFN6GNoWWbVBv.jpg\",\"title\":\"\",\"subtitle\":\"\",\"url\":\"\\/layanan\",\"btn_text\":\"\"},{\"image\":\"\\/storage\\/promo_banners\\/tgMWtzOZ6oA8EREKeERUJN4zCjYaVm5ye3yPCeq2.jpg\",\"title\":\"\",\"subtitle\":\"\",\"url\":\"\\/layanan\",\"btn_text\":\"\"}]', '2026-09-07 17:53:26', '2026-09-07 18:00:04'),
(124, 'news_promo_title', 'Punya Naskah Buku Sendiri?', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(125, 'news_promo_desc', 'Konsultasikan naskah ilmiah, modul, atau buku keislaman Anda bersama tim profesional Penerbit Persis.', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(126, 'wakaf_card_title', 'WAKAF AL-QUR\'AN & BUKU UNTUK GENERASI QUR\'ANI', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(127, 'wakaf_bank_name', 'BCA Syariah', '2026-09-07 23:02:27', '2026-09-12 16:01:32'),
(128, 'wakaf_account_no', '0490062452', '2026-09-07 23:02:27', '2026-09-12 16:01:32'),
(129, 'wakaf_account_name', 'Ajiz Nurjaman', '2026-09-07 23:02:27', '2026-09-12 16:01:32'),
(130, 'wakaf_contact_wa', '0859-7800-6263', '2026-09-07 23:02:27', '2026-09-12 16:36:52'),
(131, 'wakaf_active', '1', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(132, 'wakaf_qris_image', '', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(133, 'wakaf_program_title', 'PROGRAM WAKAF AL-QUR’AN DAN BUKU', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(134, 'wakaf_program_subtitle', 'Menghidupkan Literasi, Menebarkan Ilmu, Mengalirkan Pahala', '2026-09-07 23:02:27', '2026-09-07 23:02:27'),
(135, 'wakaf_content', '<p class=\"lead font-medium text-slate-800 text-sm sm:text-base leading-relaxed\"><strong>Penerbit Persis</strong> menghadirkan <strong>Program Wakaf Al-Qur’an dan Buku</strong> sebagai ikhtiar untuk memperluas akses umat Islam terhadap Al-Qur’an dan berbagai sumber ilmu pengetahuan yang bermanfaat.</p>\r\n\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Program ini membuka kesempatan bagi masyarakat untuk turut berwakaf dalam bentuk Al-Qur’an dan buku-buku keislaman serta keilmuan yang akan dicetak dan disalurkan kepada pihak-pihak yang membutuhkan.</p>\r\n\r\n<h4 class=\"text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2\">📖 Wakaf yang Menghidupkan Ilmu</h4>\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Wakaf yang terkumpul akan digunakan untuk mencetak dan menyediakan Al-Qur’an serta berbagai buku yang memiliki nilai edukatif dan keilmuan.</p>\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Tidak hanya Al-Qur’an, program ini juga mendukung penyediaan buku-buku yang dapat memperkaya wawasan umat dalam bidang <strong>Al-Qur’an, hadis, fikih, akidah, pendidikan, sejarah Islam, dakwah, sosial, ekonomi Islam</strong>, dan berbagai bidang keilmuan lainnya.</p>\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Dengan demikian, wakaf yang diberikan diharapkan tidak hanya menghadirkan mushaf Al-Qur’an, tetapi juga membuka jalan bagi umat untuk membaca, belajar, memahami, dan mengembangkan ilmu.</p>\r\n\r\n<h4 class=\"text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2\">🕌 Disalurkan kepada yang Membutuhkan</h4>\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Al-Qur’an dan buku-buku yang dicetak melalui program wakaf ini akan disalurkan kepada berbagai lembaga dan tempat yang membutuhkan, antara lain:</p>\r\n\r\n<div class=\"grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs sm:text-sm text-slate-700 py-1\">\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>📚</span> <span>Perpustakaan masjid</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>🕌</span> <span>Masjid dan musala</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>🏫</span> <span>Pesantren</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>📖</span> <span>Madrasah &amp; lembaga pendidikan Islam</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>🏢</span> <span>Lembaga dakwah dan sosial</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>📚</span> <span>Perpustakaan sekolah &amp; kampus</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>👨‍👩‍👧‍👦</span> <span>Komunitas dan majelis ilmu</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>🌍</span> <span>Masyarakat &amp; daerah yang membutuhkan</span></div>\r\n    <div class=\"flex items-center gap-2 bg-slate-50 p-2 rounded-xs border border-slate-200\"><span>🏛️</span> <span>Lembaga-lembaga Islam lainnya</span></div>\r\n</div>\r\n\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Penyaluran dilakukan sebagai upaya menghadirkan bahan bacaan yang bermanfaat dan mendukung tumbuhnya budaya membaca serta belajar di tengah umat.</p>\r\n\r\n<h4 class=\"text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2\">🌱 Dari Wakaf Menjadi Ilmu yang Terus Mengalir</h4>\r\n<blockquote class=\"p-4 bg-emerald-50/70 border-l-4 border-[#006830] italic text-slate-800 text-xs sm:text-sm leading-relaxed rounded-r-xs\">\r\n    \"Bayangkan satu Al-Qur’an yang Anda wakafkan kemudian dibaca oleh puluhan, ratusan, bahkan ribuan orang. Bayangkan pula sebuah buku yang Anda ikut wakafkan menjadi sumber ilmu bagi seorang santri, pelajar, guru, dai, mahasiswa, atau masyarakat yang sedang mencari pengetahuan. Setiap kali Al-Qur’an dibaca dan setiap kali ilmu dari buku dipelajari serta diamalkan, insyaallah menjadi bagian dari kebaikan yang terus mengalir.\"\r\n</blockquote>\r\n\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Inilah semangat wakaf ilmu: <em>menghadirkan manfaat yang terus hidup melalui bacaan, pembelajaran, dan pengamalan</em>.</p>\r\n\r\n<h4 class=\"text-sm sm:text-base font-bold text-slate-900 flex items-center gap-2 pt-2\">🤲 Mari Bersama Membangun Peradaban Ilmu</h4>\r\n<p class=\"text-xs sm:text-sm text-slate-600 leading-relaxed\">Melalui Program Wakaf Al-Qur’an dan Buku Penerbit Persis, mari kita bersama-sama membangun budaya literasi dan memperkuat tradisi keilmuan umat Islam.</p>\r\n\r\n<p class=\"text-xs sm:text-sm font-semibold text-slate-800\">Wakaf Anda hari ini dapat menjadi:</p>\r\n<ul class=\"list-disc list-inside text-xs sm:text-sm text-slate-700 space-y-1 pl-2\">\r\n    <li>Al-Qur’an yang dibaca</li>\r\n    <li>Buku yang dipelajari</li>\r\n    <li>Ilmu yang diamalkan</li>\r\n    <li>Kebaikan yang terus dikenang</li>\r\n</ul>\r\n\r\n<div class=\"my-4 p-5 bg-slate-900 text-white rounded-xs border border-slate-800 text-center space-y-2\">\r\n    <span class=\"text-[11px] uppercase tracking-widest text-emerald-400 font-bold font-mono\">WAKAF AL-QUR\'AN DAN BUKU ANDA</span>\r\n    <h5 class=\"text-sm sm:text-base font-black text-white font-heading\">Bukan sekadar mencetak buku. Bukan sekadar menyalurkan mushaf. Tetapi bersama-sama menghadirkan ilmu untuk umat.</h5>\r\n    <p class=\"text-xs text-slate-300 max-w-lg mx-auto\">Mari Berwakaf. Mari Tebarkan Al-Qur’an. Mari Wakafkan Ilmu. Mari Bangun Peradaban.</p>\r\n</div>', '2026-09-07 23:02:27', '2026-09-12 16:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `role`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin Penerbitan', 'admin@iaipibandung.ac.id', '081234567890', NULL, 'admin', 1, NULL, '$2y$12$/p96Ni.bmxZAiiHmW0nw0.q9rBiuCjH2wh0wAPR6rhoOOi9.06A4a', NULL, '2026-08-25 23:00:56', '2026-08-26 09:43:42'),
(3, 'Zaki Yusron Hasyimmi', 'naooolaf@gmail.com', '083861669565', 'avatars/h3LYQXZcAQGDHphpjIGB2TVq8QinPtTRVvWkGvSg.jpg', 'member', 1, NULL, '$2y$12$z7STkNvcfH8Xhu1/jngZienCA2Xaq6evR7DXNuI25P.4bbQjHA/Ym', NULL, '2026-08-26 18:23:10', '2026-08-26 18:30:55'),
(4, 'Super Admin PERSIS PERS', 'superadmin@penerbitpersis.com', '082116116133', NULL, 'super_admin', 1, NULL, '$2y$12$zBN4A0OU9P9X3ufNNR9N7eoKNTPsPK0z26aS/XCylz2d7E/4huhua', NULL, '2026-08-28 09:31:41', '2026-09-07 23:02:27'),
(5, 'M. Farhan Zaki, M.Ag. (Admin Redaksi)', 'redaksi@penerbitpersis.com', '085117797487', NULL, 'admin', 1, NULL, '$2y$12$MVuLGw3cyKZsgemQp6KR0eiyOdvhbuSrCPCprWklO2QwgC686IjY.', NULL, '2026-08-28 09:31:41', '2026-09-07 23:02:27'),
(6, 'Ust. Wildan Hidayat (Operator Pengiriman)', 'pengiriman@penerbitpersis.com', '082116116133', NULL, 'operator', 1, NULL, '$2y$12$w9Zx7VIwz/Sn5QEd7tb7AOesSoULjgJWbYE0s4ag.pqe6J3R0240y', NULL, '2026-08-28 09:31:41', '2026-09-07 23:02:27'),
(7, 'Nurul Hidayah, M.Pd. (Operator Keuangan)', 'keuangan@penerbitpersis.com', '082116116133', NULL, 'operator', 1, NULL, '$2y$12$EBGDX9DVPfnHmF3Ks1Llt.hQP1o/SM4jy2gTAaZ1jjg5VcL62Qxhm', NULL, '2026-08-28 09:31:41', '2026-09-07 23:02:27'),
(8, 'Geksa', 'admin@gx1.org', '089602727642', NULL, 'member', 1, NULL, '$2y$12$bDSnkpdqM/rKRSACnjft7e8GeBMKbLCa5OkkrWI6TsLcfSDz9LJ4q', NULL, '2026-08-28 20:13:58', '2026-08-28 20:13:58'),
(9, 'Super Admin PERSIS PERS', 'admin@persispers.com', '081275741978', NULL, 'super_admin', 1, NULL, '$2y$12$zqGrhwG20xssgGwTieRZyeEaPha7bM6RbGCyKx0SVNUXcF9aZZXX6', 'IA4RGu4TFhiJRwD1S3e6fGxfoNRnThiQYNSLIO3BMWiKv6PCcO1ttQkXZbF8', '2026-09-01 19:51:04', '2026-09-11 20:37:19'),
(10, 'Operator Transaksi & Kasir', 'operator@persispers.com', '082116116133', NULL, 'operator', 1, NULL, '$2y$12$zV7qPL6XNShNrb7t5y5t0uVl2x2kSvtfqTM40sem7plTeg0S0LDA6', NULL, '2026-09-01 20:20:29', '2026-09-07 23:02:27'),
(11, 'haris', 'hbudiman953@gmail.com', '085793476202', NULL, 'member', 1, NULL, '$2y$12$pRROwUoEhnrdxtaQL3CEzujb034Rvk5BvLe3y8wTud0iTW.g8wO1.', NULL, '2026-09-02 02:51:27', '2026-09-02 02:51:27'),
(12, 'Zaki Yusron Hasyimmi', 'zakiyh782@gmail.com', '083861669565', 'avatars/4D8Rgp7nXU39WtwYn4ncsILMkBAvmknZXZ109ZTz.jpg', 'super_admin', 1, NULL, '$2y$12$jyVxYIgV9S7Yy7gl/Zc.teuDafAp7jYsmXgN5dTmuUgOYG4BV9fxO', NULL, '2026-09-06 07:21:26', '2026-09-07 23:05:46'),
(13, 'NATREGTEGH560799NEYRTHYT', 'xhemail1970@belettersmail.com', '82784859823', NULL, 'member', 1, NULL, '$2y$12$9PkuKOWH/g0DwxoA4aE4k.z.1mq30u4LhOLaFwoXFGWhvnEzvRCZG', NULL, '2026-09-24 13:37:32', '2026-09-24 13:37:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`),
  ADD KEY `articles_category_id_foreign` (`category_id`),
  ADD KEY `articles_author_id_foreign` (`author_id`);

--
-- Indexes for table `article_categories`
--
ALTER TABLE `article_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_categories_slug_unique` (`slug`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `books_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `cart_items_book_id_foreign` (`book_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_messages`
--
ALTER TABLE `order_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_messages_order_id_foreign` (`order_id`),
  ADD KEY `order_messages_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `article_categories`
--
ALTER TABLE `article_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_messages`
--
ALTER TABLE `order_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `article_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_messages`
--
ALTER TABLE `order_messages`
  ADD CONSTRAINT `order_messages_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
