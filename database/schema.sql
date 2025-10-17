-- Istanbul Moving Company Database Schema
-- Created for custom PHP admin panel system

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: istanbul_nakliyat
CREATE DATABASE IF NOT EXISTS `istanbul_nakliyat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `istanbul_nakliyat`;

-- Admin users table
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO `admin_users` (`username`, `password`, `email`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@nakliyat.com');

-- Districts table
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Neighborhoods table
CREATE TABLE `neighborhoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `district_id` (`district_id`),
  FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pages table
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pricing table
CREATE TABLE `pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_district_id` int(11) NOT NULL,
  `to_district_id` int(11) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `price_per_km` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `from_district_id` (`from_district_id`),
  KEY `to_district_id` (`to_district_id`),
  FOREIGN KEY (`from_district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`to_district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reviews table
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 5,
  `review_text` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blog posts table
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings table
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('site_title', 'İstanbul Nakliyat - Evden Eve Taşımacılık'),
('site_description', 'İstanbul\'un en güvenilir nakliyat firması. Profesyonel evden eve taşımacılık hizmetleri.'),
('contact_phone', '+90 212 000 00 00'),
('whatsapp_number', '+90 532 000 00 00'),
('contact_email', 'info@istanbulnakliyat.com'),
('company_address', 'İstanbul, Türkiye'),
('google_maps_api_key', ''),
('facebook_url', ''),
('instagram_url', ''),
('twitter_url', '');

-- Contact messages table
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `from_district` varchar(100) DEFAULT NULL,
  `to_district` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample Istanbul districts
INSERT INTO `districts` (`name`, `slug`, `meta_title`, `meta_description`, `content`) VALUES
('Kadıköy', 'kadikoy-evden-eve-nakliyat', 'Kadıköy Evden Eve Nakliyat | Güvenilir Taşımacılık', 'Kadıköy evden eve nakliyat hizmetleri. Profesyonel ekip, uygun fiyat, güvenli taşımacılık. Hemen teklif alın!', 'Kadıköy bölgesinde profesyonel evden eve nakliyat hizmetleri sunuyoruz.'),
('Beşiktaş', 'besiktas-evden-eve-nakliyat', 'Beşiktaş Evden Eve Nakliyat | Hızlı ve Güvenli', 'Beşiktaş evden eve nakliyat firması. Deneyimli ekip, sigortalı taşımacılık, 7/24 hizmet. İletişime geçin!', 'Beşiktaş ilçesinde güvenilir nakliyat hizmetleri.'),
('Şişli', 'sisli-evden-eve-nakliyat', 'Şişli Evden Eve Nakliyat | Ekonomik Fiyatlar', 'Şişli nakliyat firması. Uygun fiyatlı, kaliteli hizmet. Eşyalarınız güvende. Ücretsiz keşif!', 'Şişli bölgesinde ekonomik nakliyat çözümleri.'),
('Üsküdar', 'uskudar-evden-eve-nakliyat', 'Üsküdar Evden Eve Nakliyat | Kaliteli Hizmet', 'Üsküdar evden eve taşımacılık. Profesyonel ambalajlama, güvenli taşıma. Müşteri memnuniyeti garantili!', 'Üsküdar ilçesinde kaliteli nakliyat hizmetleri.'),
('Bakırköy', 'bakirkoy-evden-eve-nakliyat', 'Bakırköy Evden Eve Nakliyat | Güvenilir Firma', 'Bakırköy nakliyat hizmetleri. Deneyimli ekip, modern araçlar, uygun fiyat. Hemen arayın!', 'Bakırköy bölgesinde güvenilir taşımacılık.');

-- Insert sample neighborhoods for Kadıköy
INSERT INTO `neighborhoods` (`district_id`, `name`, `slug`, `meta_title`, `meta_description`, `content`) VALUES
(1, 'Moda', 'moda-evden-eve-nakliyat', 'Moda Evden Eve Nakliyat | Kadıköy Nakliyat', 'Moda mahallesi evden eve nakliyat. Kadıköy\'ün en güvenilir nakliyat firması. Profesyonel hizmet!', 'Moda mahallesinde özel nakliyat hizmetleri.'),
(1, 'Fenerbahçe', 'fenerbahce-evden-eve-nakliyat', 'Fenerbahçe Evden Eve Nakliyat | Kadıköy', 'Fenerbahçe mahallesi nakliyat hizmetleri. Güvenli taşımacılık, uygun fiyat. İletişime geçin!', 'Fenerbahçe mahallesinde kaliteli nakliyat.'),
(1, 'Göztepe', 'goztepe-evden-eve-nakliyat', 'Göztepe Evden Eve Nakliyat | Kadıköy Nakliyat', 'Göztepe nakliyat firması. Deneyimli ekip, sigortalı taşımacılık. Hemen teklif alın!', 'Göztepe mahallesinde profesyonel hizmet.');

-- Insert sample pages
INSERT INTO `pages` (`title`, `slug`, `content`, `meta_title`, `meta_description`) VALUES
('Ana Sayfa', 'anasayfa', 'İstanbul\'un en güvenilir nakliyat firması olarak hizmet veriyoruz.', 'İstanbul Nakliyat - Evden Eve Taşımacılık', 'İstanbul evden eve nakliyat firması. Güvenilir, hızlı ve ekonomik taşımacılık hizmetleri.'),
('Hizmetlerimiz', 'hizmetlerimiz', 'Evden eve nakliyat, ofis taşımacılığı, eşya depolama ve daha fazlası.', 'Nakliyat Hizmetlerimiz | İstanbul Nakliyat', 'Profesyonel nakliyat hizmetleri: evden eve, ofis taşımacılığı, depolama ve sigortalı taşımacılık.'),
('Fiyat Listesi', 'fiyat-listesi', 'Şeffaf ve uygun fiyatlarımızı inceleyin.', 'Nakliyat Fiyatları | İstanbul Nakliyat', 'İstanbul nakliyat fiyatları. Şeffaf ve uygun fiyat politikası. Ücretsiz keşif hizmeti.'),
('Müşteri Yorumları', 'musteri-yorumlari', 'Memnun müşterilerimizin yorumları.', 'Müşteri Yorumları | İstanbul Nakliyat', 'Nakliyat hizmetimizi kullanan müşterilerimizin gerçek yorumları ve deneyimleri.'),
('İletişim', 'iletisim', 'Bizimle iletişime geçin, ücretsiz keşif hizmeti alın.', 'İletişim | İstanbul Nakliyat', 'İstanbul nakliyat firması iletişim bilgileri. 7/24 müşteri hizmetleri ve ücretsiz keşif.');

COMMIT;