-- Istanbul Nakliyat Database Schema
-- Drop existing tables if they exist
DROP TABLE IF EXISTS blog_posts, reviews, prices, neighborhoods, districts, pages, banners, settings, admin_users;

-- Admin Users Table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Settings Table
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pages Table
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Districts Table (İlçeler)
CREATE TABLE districts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    content TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Neighborhoods Table (Semtler)
CREATE TABLE neighborhoods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    district_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    content TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES districts(id) ON DELETE CASCADE,
    INDEX idx_district (district_id),
    INDEX idx_slug (slug),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Prices Table (Route-based pricing)
CREATE TABLE prices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_district_id INT NOT NULL,
    to_district_id INT NOT NULL,
    base_price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (from_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    FOREIGN KEY (to_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    INDEX idx_from_to (from_district_id, to_district_id),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reviews Table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    location VARCHAR(100),
    is_approved TINYINT(1) DEFAULT 0,
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_approved (is_approved),
    INDEX idx_featured (is_featured)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blog Posts Table
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    excerpt TEXT,
    content TEXT,
    featured_image VARCHAR(255),
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords VARCHAR(255),
    is_published TINYINT(1) DEFAULT 0,
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_published (is_published)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Banners Table
CREATE TABLE banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    subtitle VARCHAR(255),
    image VARCHAR(255),
    button_text VARCHAR(100),
    button_link VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (is_active),
    INDEX idx_order (sort_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123)
INSERT INTO admin_users (username, password, email, full_name) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@istanbulnakliyat.com', 'Admin User');

-- Insert default settings
INSERT INTO settings (setting_key, setting_value) VALUES 
('site_name', 'İstanbul Nakliyat'),
('site_description', 'İstanbul''da profesyonel evden eve nakliyat hizmetleri'),
('contact_email', 'info@istanbulnakliyat.com'),
('contact_phone', '+90 555 123 4567'),
('whatsapp_number', '+905551234567'),
('address', 'İstanbul, Türkiye'),
('facebook_url', ''),
('instagram_url', ''),
('twitter_url', '');

-- Insert sample districts
INSERT INTO districts (name, slug, description, meta_title, meta_description, is_active) VALUES
('Kadıköy', 'kadikoy', 'Kadıköy evden eve nakliyat hizmetleri', 'Kadıköy Evden Eve Nakliyat | İstanbul Nakliyat', 'Kadıköy''de profesyonel evden eve nakliyat hizmetleri. Güvenilir ve uygun fiyatlı taşımacılık.', 1),
('Beşiktaş', 'besiktas', 'Beşiktaş evden eve nakliyat hizmetleri', 'Beşiktaş Evden Eve Nakliyat | İstanbul Nakliyat', 'Beşiktaş''ta profesyonel evden eve nakliyat hizmetleri. Güvenilir ve uygun fiyatlı taşımacılık.', 1),
('Şişli', 'sisli', 'Şişli evden eve nakliyat hizmetleri', 'Şişli Evden Eve Nakliyat | İstanbul Nakliyat', 'Şişli''de profesyonel evden eve nakliyat hizmetleri. Güvenilir ve uygun fiyatlı taşımacılık.', 1),
('Üsküdar', 'uskudar', 'Üsküdar evden eve nakliyat hizmetleri', 'Üsküdar Evden Eve Nakliyat | İstanbul Nakliyat', 'Üsküdar''da profesyonel evden eve nakliyat hizmetleri. Güvenilir ve uygun fiyatlı taşımacılık.', 1),
('Bakırköy', 'bakirkoy', 'Bakırköy evden eve nakliyat hizmetleri', 'Bakırköy Evden Eve Nakliyat | İstanbul Nakliyat', 'Bakırköy''de profesyonel evden eve nakliyat hizmetleri. Güvenilir ve uygun fiyatlı taşımacılık.', 1);

-- Insert sample neighborhoods
INSERT INTO neighborhoods (district_id, name, slug, description, meta_title, meta_description, is_active) VALUES
(1, 'Moda', 'moda', 'Moda evden eve nakliyat', 'Moda Evden Eve Nakliyat | Kadıköy', 'Moda''da profesyonel evden eve nakliyat hizmetleri.', 1),
(1, 'Fenerbahçe', 'fenerbahce', 'Fenerbahçe evden eve nakliyat', 'Fenerbahçe Evden Eve Nakliyat | Kadıköy', 'Fenerbahçe''de profesyonel evden eve nakliyat hizmetleri.', 1),
(2, 'Etiler', 'etiler', 'Etiler evden eve nakliyat', 'Etiler Evden Eve Nakliyat | Beşiktaş', 'Etiler''de profesyonel evden eve nakliyat hizmetleri.', 1),
(2, 'Ortaköy', 'ortakoy', 'Ortaköy evden eve nakliyat', 'Ortaköy Evden Eve Nakliyat | Beşiktaş', 'Ortaköy''de profesyonel evden eve nakliyat hizmetleri.', 1);

-- Insert sample prices
INSERT INTO prices (from_district_id, to_district_id, base_price, is_active) VALUES
(1, 2, 800.00, 1),
(1, 3, 750.00, 1),
(2, 1, 800.00, 1),
(2, 4, 900.00, 1),
(3, 5, 850.00, 1);

-- Insert sample reviews
INSERT INTO reviews (customer_name, rating, review_text, location, is_approved, is_featured) VALUES
('Ahmet Yılmaz', 5, 'Çok profesyonel bir ekip. Eşyalarımızı özenle taşıdılar. Teşekkürler!', 'Kadıköy', 1, 1),
('Ayşe Demir', 5, 'Fiyatları çok uygun ve işlerini hakkıyla yapıyorlar. Kesinlikle tavsiye ederim.', 'Beşiktaş', 1, 1),
('Mehmet Kaya', 4, 'Sorunsuz bir taşınma deneyimi yaşadık. Teşekkürler.', 'Şişli', 1, 0);

-- Insert sample banners
INSERT INTO banners (title, subtitle, button_text, button_link, is_active, sort_order) VALUES
('İstanbul\'un En Güvenilir Nakliyat Firması', 'Profesyonel ekip, uygun fiyat, güvenli taşımacılık', 'Teklif Al', '/iletisim', 1, 1),
('Evden Eve Nakliyat', 'Eşyalarınız güvende', 'Hemen Ara', 'tel:+905551234567', 1, 2);

-- Insert default pages
INSERT INTO pages (title, slug, content, meta_title, meta_description, is_active) VALUES
('Hizmetlerimiz', 'hizmetlerimiz', '<h2>Evden Eve Nakliyat</h2><p>Profesyonel evden eve nakliyat hizmetleri...</p>', 'Hizmetlerimiz | İstanbul Nakliyat', 'İstanbul nakliyat hizmetlerimiz hakkında detaylı bilgi.', 1),
('Hakkımızda', 'hakkimizda', '<h2>Biz Kimiz?</h2><p>İstanbul nakliyat sektöründe yıllardır hizmet vermekteyiz...</p>', 'Hakkımızda | İstanbul Nakliyat', 'İstanbul nakliyat hakkında bilgi.', 1);
