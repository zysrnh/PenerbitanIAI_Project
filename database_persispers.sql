-- SQL Schema & Data Dump for persispers.com
-- Database: persispe__penerbit
-- IAI PERSIS PRESS

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Table: users
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Users Seed
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `is_active`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin IAI Persis', 'superadmin@iaipibandung.ac.id', '082116116133', 'super_admin', 1, '$2y$12$D2h6/oRsk9qf2lP1i1Y/yevj52sZzC2lWJgK4RkG8rT1Q5zS4mX/W', NOW(), NOW()),
(2, 'Admin Penerbitan', 'admin@iaipibandung.ac.id', '081234567890', 'admin', 1, '$2y$12$D2h6/oRsk9qf2lP1i1Y/yevj52sZzC2lWJgK4RkG8rT1Q5zS4mX/W', NOW(), NOW());

-- --------------------------------------------------------
-- Table: site_settings
-- --------------------------------------------------------
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Site Settings Seed
INSERT INTO `site_settings` (`key`, `value`, `created_at`, `updated_at`) VALUES
('contact_banner_badge', 'Layanan & Informasi', NOW(), NOW()),
('contact_banner_title', 'Hubungi Kami & Layanan Redaksi', NOW(), NOW()),
('contact_banner_desc', 'Konsultasikan naskah buku, kebutuhan cetak, pengurusan ISBN, atau publikasi ilmiah bersama tim IAI Persis Press. Kami siap membantu Anda.', NOW(), NOW()),
('contact_address', 'Gedung Rektorat Lt. 2, Jl. Ciganitri No.2, Bojongsoang, Bandung 40287', NOW(), NOW()),
('contact_whatsapp', '082116116133', NOW(), NOW()),
('contact_phone', '(022) 5441951', NOW(), NOW()),
('contact_email', 'penerbitan@iaipibandung.ac.id', NOW(), NOW()),
('contact_email_note', 'Respon cepat 1x24 jam kerja', NOW(), NOW()),
('contact_hours', 'Senin – Jumat: 08:00 – 16:00 WIB', NOW(), NOW()),
('contact_hours_weekend', 'Sabtu & Minggu: Tutup', NOW(), NOW()),
('contact_wa_box_title', 'Konsultasi Cepat (WhatsApp)', NOW(), NOW()),
('contact_wa_box_subtitle', 'Langsung terhubung dengan Tim Redaksi', NOW(), NOW()),
('contact_wa_box_desc', 'Ingin konsultasi langsung terkait naskah buku, estimasi biaya cetak, atau panduan ISBN? Klik tombol di bawah untuk memulai chat WhatsApp resmi.', NOW(), NOW()),
('contact_wa_btn_text', 'CHAT WHATSAPP SEKARANG', NOW(), NOW()),
('contact_wa_default_msg', 'Halo Redaksi IAI PERSIS PRESS, saya ingin berkonsultasi mengenai penerbitan naskah buku.', NOW(), NOW()),
('contact_maps_title', 'Lokasi Kampus & Percetakan', NOW(), NOW()),
('contact_maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2974465063073!2d107.63660527587638!3d-6.974191668289417!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9af8d8c919d%3A0xe96841b53fa976df!2sInstitut%20Agama%20Islam%20Persatuan%20Islam%20Bandung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid', NOW(), NOW()),
('contact_maps_external_url', 'https://maps.app.goo.gl/uXpW7mS6V8n5fF9w8', NOW(), NOW()),
('notification_recipient_email', 'hbudiman953@gmail.com', NOW(), NOW()),
('about_banner_badge', 'Mengenal Lembaga', NOW(), NOW()),
('about_banner_title', 'Pusat Penerbitan, Percetakan, & Hilirisasi Karya Ilmiah', NOW(), NOW()),
('about_banner_desc', 'IAI PERSIS PRESS adalah unit penerbitan dan percetakan resmi di bawah naungan Institut Agama Islam Persatuan Islam Bandung, berdedikasi dalam menyebarluaskan khazanah keilmuan Islam dan literasi akademik berkualitas.', NOW(), NOW()),
('about_profile_title', 'Komitmen Membangun Peradaban Literasi & Riset Akademik', NOW(), NOW()),
('about_profile_story_1', 'IAI PERSIS PRESS didirikan sebagai wujud nyata komitmen Institut Agama Islam Persatuan Islam (IAI PERSIS) Bandung dalam menjembatani hasil riset, gagasan akademik para dosen, peneliti, dan sivitas akademika agar dapat bertransformasi menjadi karya buku bermutu tinggi yang ber-ISBN dan tersebar luas ke masyarakat umum.', NOW(), NOW()),
('about_profile_story_2', 'Kami melayani penerbitan buku ajar perguruan tinggi, monograf, buku referensi, konversi karya tulis ilmiah (skripsi, tesis, disertasi), hingga jurnal ilmiah. Dilengkapi divisi percetakan mandiri dengan mesin offset dan digital printing modern, kami menjamin kualitas cetak, kerapian tata letak (layout), dan desain sampul yang estetik serta presisi.', NOW(), NOW()),
('about_vision', 'Menjadi lembaga penerbitan dan percetakan perguruan tinggi Islam yang unggul, profesional, dan bereputasi nasional dalam pengembangan literasi Islam serta hilirisasi karya ilmiah terintegrasi pada tahun 2030.', NOW(), NOW()),
('about_mission_1', 'Menerbitkan buku-buku ilmiah, buku ajar, dan referensi berstandar nasional dengan proses peer-review yang objektif dan ketat.', NOW(), NOW()),
('about_mission_2', 'Memberikan layanan pendampingan penulisan, penyuntingan bahasa (editing), tata letak (layout), dan desain sampul secara profesional.', NOW(), NOW()),
('about_mission_3', 'Memfasilitasi pengurusan legalitas resmi penerbitan (ISBN, KDT, e-ISBN) bekerjasama dengan Perpustakaan Nasional RI.', NOW(), NOW()),
('about_mission_4', 'Menyediakan layanan percetakan berkualitas tinggi dengan teknologi modern yang cepat, presisi, dan harga terjangkau.', NOW(), NOW()),
('about_stat_books', '150+', NOW(), NOW()),
('about_stat_authors', '80+', NOW(), NOW()),
('about_stat_isbn', '100%', NOW(), NOW()),
('about_stat_copies', '25.000+', NOW(), NOW()),
('about_director_name', 'Dr. H. Ahmad Fauzi, M.Ag.', NOW(), NOW()),
('about_director_title', 'Kepala Unit Penerbitan & Percetakan', NOW(), NOW()),
('about_editor_chief', 'Nurul Hidayah, M.Pd.', NOW(), NOW()),
('about_editor_chief_title', 'Editor Pelaksana & Mutu Naskah', NOW(), NOW()),
('about_production_lead', 'M. Zaki Farhan, S.Kom.', NOW(), NOW()),
('about_production_lead_title', 'Kepala Produksi & Percetakan', NOW(), NOW());

-- --------------------------------------------------------
-- Table: contact_messages
-- --------------------------------------------------------
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service_category` varchar(255) DEFAULT 'Umum',
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Sample Messages
INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `service_category`, `subject`, `message`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Dr. H. Ahmad Fauzi, M.Ag.', 'ahmad.fauzi@uinsgd.ac.id', '081223344556', 'Penerbitan Buku Ber-ISBN', 'Konsultasi Draf Buku Ajar Fiqih Kontemporer', 'Assalamu\'alaikum. Saya bermaksud mengajukan naskah buku ajar berjudul Fiqih Muamalah Kontemporer setebal 220 halaman untuk diterbitkan ber-ISBN.', 'pending', NULL, NOW(), NOW()),
(2, 'Nurul Hidayah, M.Pd.', 'nurul.hidayah@iaipibandung.ac.id', '085712345678', 'Konversi KTI ke Buku', 'Konversi Tesis Menjadi Buku Referensi', 'Halo tim redaksi, saya ingin berkonsultasi mengenai konversi tesis S2 saya menjadi buku referensi ber-ISBN.', 'contacted', 'Sudah dihubungi via WA.', NOW(), NOW());

-- --------------------------------------------------------
-- Table: migrations
-- --------------------------------------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2026_08_25_000001_create_contact_messages_table', 1),
('2026_08_25_000002_create_site_settings_table', 1);

-- --------------------------------------------------------
-- Table: cache
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: sessions
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
COMMIT;
