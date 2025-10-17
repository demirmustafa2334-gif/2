-- Istanbul Nakliyat Database Schema
-- Run this SQL to create the database structure

CREATE DATABASE IF NOT EXISTS istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE istanbul_nakliyat;

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin (username: admin, password: admin123)
INSERT INTO admin_users (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com');

-- Districts Table (İlçeler)
CREATE TABLE IF NOT EXISTS districts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    meta_title VARCHAR(255),
    meta_description TEXT,
    content TEXT,
    image VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Neighborhoods Table (Semtler)
CREATE TABLE IF NOT EXISTS neighborhoods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    district_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    meta_title VARCHAR(255),
    meta_description TEXT,
    content TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES districts(id) ON DELETE CASCADE,
    INDEX idx_district (district_id),
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Services Table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    short_description TEXT,
    description TEXT,
    icon VARCHAR(100),
    image VARCHAR(255),
    meta_title VARCHAR(255),
    meta_description TEXT,
    display_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active),
    INDEX idx_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Prices Table (Route-based pricing)
CREATE TABLE IF NOT EXISTS prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_district_id INT NOT NULL,
    to_district_id INT NOT NULL,
    base_price DECIMAL(10,2) NOT NULL,
    price_per_km DECIMAL(10,2) DEFAULT 0,
    notes TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (from_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    FOREIGN KEY (to_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    INDEX idx_from (from_district_id),
    INDEX idx_to (to_district_id),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Customer Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT NOT NULL,
    service_type VARCHAR(100),
    is_approved TINYINT(1) DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_approved (is_approved),
    INDEX idx_featured (is_featured)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blog Posts Table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    excerpt TEXT,
    content TEXT NOT NULL,
    featured_image VARCHAR(255),
    author VARCHAR(100),
    meta_title VARCHAR(255),
    meta_description TEXT,
    tags VARCHAR(255),
    view_count INT DEFAULT 0,
    is_published TINYINT(1) DEFAULT 0,
    published_at DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_published (is_published),
    INDEX idx_published_at (published_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pages Table
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content TEXT NOT NULL,
    meta_title VARCHAR(255),
    meta_description TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    from_location VARCHAR(100),
    to_location VARCHAR(100),
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_read (is_read)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings Table
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_type VARCHAR(50) DEFAULT 'text',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT INTO settings (setting_key, setting_value, setting_type) VALUES
('site_title', 'İstanbul Nakliyat', 'text'),
('site_tagline', 'Güvenilir ve Profesyonel Taşımacılık Hizmetleri', 'text'),
('contact_phone', '0850 XXX XX XX', 'text'),
('contact_email', 'info@istanbulnakliyat.com', 'email'),
('contact_address', 'İstanbul, Türkiye', 'text'),
('whatsapp_number', '905XXXXXXXXX', 'text'),
('facebook_url', '', 'url'),
('instagram_url', '', 'url'),
('twitter_url', '', 'url'),
('google_maps_api_key', '', 'text'),
('footer_text', '© 2025 İstanbul Nakliyat. Tüm hakları saklıdır.', 'text');

-- Sample Districts (Istanbul)
INSERT INTO districts (name, slug, meta_title, meta_description, content) VALUES
('Kadıköy', 'kadikoy', 'Kadıköy Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Kadıköy\'de güvenilir evden eve nakliyat hizmetleri. Uygun fiyatlarla profesyonel taşımacılık.', 'Kadıköy ve çevresinde kaliteli nakliyat hizmetleri sunuyoruz.'),
('Beşiktaş', 'besiktas', 'Beşiktaş Nakliyat Şirketi | Evden Eve Taşımacılık', 'Beşiktaş\'ta uzman kadro ile evden eve nakliyat hizmetleri. Hızlı ve güvenli taşıma.', 'Beşiktaş bölgesinde tecrübeli ekibimizle hizmetinizdeyiz.'),
('Şişli', 'sisli', 'Şişli Evden Eve Nakliyat | Güvenilir Taşıma Firması', 'Şişli\'de profesyonel nakliyat hizmetleri. Eşyalarınız emin ellerde.', 'Şişli ve yakın bölgelerde kaliteli taşımacılık hizmetleri.'),
('Üsküdar', 'uskudar', 'Üsküdar Nakliyat | Evden Eve Taşımacılık Hizmetleri', 'Üsküdar\'da uygun fiyatlı nakliyat çözümleri. Tecrübeli ekip, güvenli taşıma.', 'Üsküdar bölgesinde güvenilir nakliyat firması.'),
('Bakırköy', 'bakirkoy', 'Bakırköy Evden Eve Nakliyat | Profesyonel Hizmet', 'Bakırköy\'de kaliteli nakliyat hizmetleri. Sigortalı ve garantili taşıma.', 'Bakırköy ve çevresinde profesyonel taşımacılık.');

-- Sample Services
INSERT INTO services (title, slug, short_description, description, icon, display_order, meta_title, meta_description) VALUES
('Evden Eve Nakliyat', 'evden-eve-nakliyat', 'Güvenli ve hızlı evden eve taşıma hizmetleri', 'Profesyonel ekibimiz ve modern araçlarımızla evden eve nakliyat hizmetleri sunuyoruz. Eşyalarınız özenle paketlenir, sigortalı olarak taşınır.', 'fas fa-home', 1, 'Evden Eve Nakliyat İstanbul | Güvenilir Taşımacılık', 'İstanbul genelinde evden eve nakliyat hizmetleri. Profesyonel ekip, uygun fiyatlar.'),
('Ofis Taşımacılığı', 'ofis-tasimaciligi', 'İş yerinizi hızlı ve profesyonel şekilde taşıyoruz', 'Ofis taşımacılığında uzman kadromuzla, iş yerinizi en kısa sürede ve güvenli şekilde yeni adresinize taşıyoruz.', 'fas fa-building', 2, 'Ofis Taşımacılığı İstanbul | Kurumsal Nakliyat', 'İstanbul\'da profesyonel ofis taşımacılığı hizmetleri. Hızlı ve güvenli çözümler.'),
('Parça Eşya Taşıma', 'parca-esya-tasima', 'Tek eşya ve parça eşya taşıma hizmetleri', 'Sadece birkaç eşyanızı mı taşımak istiyorsunuz? Parça eşya taşıma hizmetimizle ekonomik çözümler sunuyoruz.', 'fas fa-box', 3, 'Parça Eşya Taşıma İstanbul | Uygun Fiyat', 'İstanbul genelinde parça eşya taşıma hizmetleri. Tek eşya nakliyat.'),
('Asansörlü Nakliyat', 'asansorlu-nakliyat', 'Yüksek katlarda güvenli taşıma', 'Asansörlü nakliyat hizmetimizle yüksek katlardaki eşyalarınızı güvenli ve hızlı şekilde taşıyoruz.', 'fas fa-elevator', 4, 'Asansörlü Nakliyat İstanbul | Profesyonel Hizmet', 'İstanbul\'da asansörlü nakliyat hizmetleri. Yüksek katlara güvenli taşıma.');

-- Sample Reviews
INSERT INTO reviews (customer_name, customer_email, rating, review_text, service_type, is_approved, is_featured) VALUES
('Ahmet Yılmaz', 'ahmet@example.com', 5, 'Çok profesyonel bir ekip. Eşyalarımız tek bir çizik almadan taşındı. Teşekkürler!', 'Evden Eve Nakliyat', 1, 1),
('Ayşe Demir', 'ayse@example.com', 5, 'Hızlı ve güvenilir hizmet. Fiyatları da çok uygun. Kesinlikle tavsiye ederim.', 'Ofis Taşımacılığı', 1, 1),
('Mehmet Kaya', 'mehmet@example.com', 4, 'İyi bir hizmet aldık. Ekip çok nazikti ve işini iyi yapıyor.', 'Evden Eve Nakliyat', 1, 0);

-- Sample Prices (Route-based)
INSERT INTO prices (from_district_id, to_district_id, base_price, price_per_km) VALUES
(1, 2, 800.00, 15.00),
(1, 3, 900.00, 15.00),
(2, 1, 800.00, 15.00),
(2, 4, 850.00, 15.00),
(3, 5, 950.00, 15.00);
