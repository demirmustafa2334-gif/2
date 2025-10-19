-- Turkey Tourism Database Schema
-- Created for yereltanitim.com

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: turkey_tourism
CREATE DATABASE IF NOT EXISTS `turkey_tourism` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `turkey_tourism`;

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
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@yereltanitim.com');

-- Cities table (81 Turkish cities)
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `plate_code` varchar(3) NOT NULL,
  `region` varchar(50) NOT NULL,
  `population` int(11) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `tourist_attractions` text DEFAULT NULL,
  `local_cuisine` text DEFAULT NULL,
  `cultural_highlights` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `plate_code` (`plate_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Districts table
CREATE TABLE `districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `tourist_attractions` text DEFAULT NULL,
  `local_cuisine` text DEFAULT NULL,
  `specialties` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `city_id` (`city_id`),
  FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blog posts table
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `view_count` int(11) DEFAULT 0,
  `author_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `city_id` (`city_id`),
  KEY `district_id` (`district_id`),
  KEY `author_id` (`author_id`),
  FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  FOREIGN KEY (`author_id`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact messages table
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
('site_title', 'Yerel Tanıtım - Türkiye\'nin En Kapsamlı Turizm Rehberi'),
('site_description', 'Türkiye\'nin 81 ili ve tüm ilçeleri hakkında detaylı bilgiler. Turistik yerler, yerel lezzetler ve kültürel özellikler.'),
('contact_phone', '+90 212 000 00 00'),
('contact_email', 'info@yereltanitim.com'),
('company_address', 'İstanbul, Türkiye'),
('facebook_url', 'https://facebook.com/yereltanitim'),
('instagram_url', 'https://instagram.com/yereltanitim'),
('twitter_url', 'https://twitter.com/yereltanitim'),
('youtube_url', 'https://youtube.com/yereltanitim'),
('chatgpt_api_key', ''),
('google_analytics_id', ''),
('site_logo', 'logo.png');

-- Insert sample Turkish cities
INSERT INTO `cities` (`name`, `slug`, `plate_code`, `region`, `population`, `description`, `tourist_attractions`, `local_cuisine`, `cultural_highlights`, `meta_title`, `meta_description`) VALUES
('İstanbul', 'istanbul', '34', 'Marmara', 15840900, 'Türkiye\'nin en büyük şehri ve tarihi başkenti. Avrupa ve Asya kıtalarını birleştiren eşsiz konumu ile dünyanın en önemli şehirlerinden biri.', 'Ayasofya, Sultanahmet Camii, Topkapı Sarayı, Galata Kulesi, Boğaz Köprüsü, Kapalıçarşı, Dolmabahçe Sarayı', 'İstanbul kebabı, balık ekmek, döner, lahmacun, künefe, Turkish delight, baklava', 'Bizans ve Osmanlı mirasları, çok kültürlü yapı, sanat galerileri, müzeler', 'İstanbul Rehberi | Yereltanitim.com', 'İstanbul\'un turistik yerleri, yerel lezzetleri ve kültürel özellikleri. Detaylı İstanbul rehberi.'),
('Ankara', 'ankara', '06', 'İç Anadolu', 5663322, 'Türkiye\'nin başkenti ve ikinci büyük şehri. Modern Türkiye\'nin kuruluş merkezi.', 'Anıtkabir, Ankara Kalesi, Etnografya Müzesi, Atatürk Orman Çiftliği, Kocatepe Camii', 'Ankara tava, döner, simidi, beypazarı kurusu, toyga çorbası', 'Cumhuriyet tarihi, devlet kurumları, üniversiteler', 'Ankara Rehberi | Yereltanitim.com', 'Ankara\'nın turistik yerleri, yerel lezzetleri ve kültürel özellikleri. Detaylı Ankara rehberi.'),
('İzmir', 'izmir', '35', 'Ege', 4394694, 'Ege Bölgesi\'nin incisi, Türkiye\'nin üçüncü büyük şehri. Antik tarih ve modern yaşamın buluştuğu nokta.', 'Efes Antik Kenti, Bergama, Çeşme, Alaçatı, Kordon, Kemeraltı Çarşısı, Kadifekale', 'İzmir köfte, boyoz, kumru, şambali, lokma, gevrek', 'Antik Yunan ve Roma kalıntıları, rüzgar sörfü, bağcılık', 'İzmir Rehberi | Yereltanitim.com', 'İzmir\'in turistik yerleri, yerel lezzetleri ve kültürel özellikleri. Detaylı İzmir rehberi.'),
('Antalya', 'antalya', '07', 'Akdeniz', 2548308, 'Türk Rivierası\'nın kalbi, dünyaca ünlü tatil destinasyonu. Antik tarih ve muhteşem plajlar.', 'Kaleiçi, Düden Şelalesi, Aspendos, Perge, Kemer, Side, Kaş', 'Antalya piyazı, şiş köfte, tandır kebabı, künefe, cezerye', 'Antik tiyatrolar, Roma kalıntıları, deniz turizmi', 'Antalya Rehberi | Yereltanitim.com', 'Antalya\'nın turistik yerleri, yerel lezzetleri ve kültürel özellikleri. Detaylı Antalya rehberi.'),
('Bursa', 'bursa', '16', 'Marmara', 3101833, 'Osmanlı İmparatorluğu\'nun ilk başkenti. Yeşil Bursa olarak tanınan tarihi şehir.', 'Ulu Cami, Yeşil Türbe, Cumalıkızık, Uludağ, Mudanya', 'İskender kebabı, kemalpaşa tatlısı, candied chestnuts, pideli köfte', 'Osmanlı mimarisi, ipek üretimi, termal kaynaklar', 'Bursa Rehberi | Yereltanitim.com', 'Bursa\'nın turistik yerleri, yerel lezzetleri ve kültürel özellikleri. Detaylı Bursa rehberi.');

-- Insert sample districts for Istanbul
INSERT INTO `districts` (`city_id`, `name`, `slug`, `description`, `tourist_attractions`, `local_cuisine`, `specialties`, `meta_title`, `meta_description`) VALUES
(1, 'Fatih', 'fatih', 'İstanbul\'un tarihi yarımadasında yer alan ilçe. Sultanahmet ve çevresini kapsar.', 'Ayasofya, Sultanahmet Camii, Topkapı Sarayı, Kapalıçarşı, Yerebatan Sarnıcı', 'Osmanlı mutfağı, lokum, baklava, Turkish coffee', 'Tarihi eserler, antika dükkanları, geleneksel el sanatları', 'Fatih İlçesi Rehberi | Yereltanitim.com', 'İstanbul Fatih ilçesinin turistik yerleri, yerel lezzetleri ve özel özellikleri.'),
(1, 'Beyoğlu', 'beyoglu', 'İstanbul\'un kültür ve sanat merkezi. Galata ve Taksim bölgelerini içerir.', 'Galata Kulesi, İstiklal Caddesi, Taksim Meydanı, Pera Müzesi, Galata Köprüsü', 'Balık ekmek, midye dolma, döner, künefe', 'Gece hayatı, sanat galerileri, nostaljik tramvay', 'Beyoğlu İlçesi Rehberi | Yereltanitim.com', 'İstanbul Beyoğlu ilçesinin turistik yerleri, yerel lezzetleri ve özel özellikleri.'),
(1, 'Beşiktaş', 'besiktas', 'Boğaz kıyısında yer alan modern ilçe. Dolmabahçe Sarayı\'na ev sahipliği yapar.', 'Dolmabahçe Sarayı, Yıldız Parkı, Beşiktaş Çarşısı, Barbaros Bulvarı', 'Beşiktaş çorbası, balık lokantaları, street food', 'Futbol kültürü, modern alışveriş merkezleri, Boğaz manzarası', 'Beşiktaş İlçesi Rehberi | Yereltanitim.com', 'İstanbul Beşiktaş ilçesinin turistik yerleri, yerel lezzetleri ve özel özellikleri.');

-- Insert sample blog posts
INSERT INTO `blog_posts` (`title`, `slug`, `excerpt`, `content`, `city_id`, `district_id`, `meta_title`, `meta_description`, `tags`, `is_published`, `is_featured`) VALUES
('İstanbul\'da Gezilecek En İyi 10 Yer', 'istanbulda-gezilecek-en-iyi-10-yer', 'İstanbul\'un mutlaka görülmesi gereken turistik yerlerini keşfedin.', 'İstanbul, tarihi ve kültürel zenginlikleriyle dünyanın en önemli şehirlerinden biri. Bu yazıda İstanbul\'da mutlaka görmeniz gereken 10 yeri sizler için derledik...', 1, NULL, 'İstanbul\'da Gezilecek En İyi 10 Yer | Yereltanitim.com', 'İstanbul\'un en güzel turistik yerlerini keşfedin. Detaylı rehber ve öneriler.', 'İstanbul, turizm, gezilecek yerler, rehber', 1, 1),
('Fatih\'te Tarihi Mekanlar Turu', 'fatihte-tarihi-mekanlar-turu', 'Fatih ilçesindeki tarihi eserleri keşfetmek için rehberiniz.', 'Fatih, İstanbul\'un tarihi kalbinde yer alır. Sultanahmet Camii, Ayasofya, Topkapı Sarayı gibi dünyaca ünlü eserlere ev sahipliği yapar...', 1, 1, 'Fatih Tarihi Mekanlar Turu | Yereltanitim.com', 'Fatih ilçesindeki tarihi mekanları keşfedin. Detaylı tur rehberi.', 'Fatih, tarihi mekanlar, İstanbul, tur', 1, 0);

COMMIT;