-- Istanbul Moving Company Database Schema
-- Custom PHP Script for Local Moving Services

CREATE DATABASE IF NOT EXISTS istanbul_moving CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE istanbul_moving;

-- Admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Istanbul districts (ilçeler)
CREATE TABLE districts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Neighborhoods (semtler) - linked to districts
CREATE TABLE neighborhoods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    district_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES districts(id) ON DELETE CASCADE
);

-- Pages table for dynamic content
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content LONGTEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    page_type ENUM('home', 'services', 'pricing', 'contact', 'blog', 'district', 'neighborhood') DEFAULT 'home',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Route-based pricing
CREATE TABLE pricing_routes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_district_id INT,
    from_neighborhood_id INT,
    to_district_id INT,
    to_neighborhood_id INT,
    base_price DECIMAL(10,2) NOT NULL,
    price_per_km DECIMAL(10,2) DEFAULT 0,
    estimated_distance_km DECIMAL(8,2) DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (from_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    FOREIGN KEY (from_neighborhood_id) REFERENCES neighborhoods(id) ON DELETE CASCADE,
    FOREIGN KEY (to_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    FOREIGN KEY (to_neighborhood_id) REFERENCES neighborhoods(id) ON DELETE CASCADE
);

-- Customer reviews
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    rating INT CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT,
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog posts
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) UNIQUE NOT NULL,
    content LONGTEXT,
    excerpt TEXT,
    featured_image VARCHAR(255),
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    is_published BOOLEAN DEFAULT FALSE,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Site settings
CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact form submissions
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO admin_users (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@istanbulmoving.com');

-- Insert default site settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_title', 'İstanbul Evden Eve Nakliyat | Profesyonel Taşımacılık Hizmetleri'),
('site_description', 'İstanbul\'un tüm ilçe ve semtlerinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip, sigortalı taşımacılık.'),
('contact_phone', '+90 212 555 0123'),
('contact_email', 'info@istanbulmoving.com'),
('whatsapp_number', '+90 212 555 0123'),
('address', 'İstanbul, Türkiye'),
('google_maps_api', ''),
('social_facebook', ''),
('social_instagram', ''),
('social_twitter', '');

-- Insert Istanbul districts
INSERT INTO districts (name, slug, description, meta_title, meta_description) VALUES
('Kadıköy', 'kadikoy', 'Kadıköy ilçesi evden eve nakliyat hizmetleri', 'Kadıköy Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Kadıköy ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Beşiktaş', 'besiktas', 'Beşiktaş ilçesi evden eve nakliyat hizmetleri', 'Beşiktaş Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Beşiktaş ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Şişli', 'sisli', 'Şişli ilçesi evden eve nakliyat hizmetleri', 'Şişli Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Şişli ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Beyoğlu', 'beyoglu', 'Beyoğlu ilçesi evden eve nakliyat hizmetleri', 'Beyoğlu Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Beyoğlu ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Fatih', 'fatih', 'Fatih ilçesi evden eve nakliyat hizmetleri', 'Fatih Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Fatih ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Üsküdar', 'uskudar', 'Üsküdar ilçesi evden eve nakliyat hizmetleri', 'Üsküdar Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Üsküdar ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Bakırköy', 'bakirkoy', 'Bakırköy ilçesi evden eve nakliyat hizmetleri', 'Bakırköy Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Bakırköy ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.'),
('Maltepe', 'maltepe', 'Maltepe ilçesi evden eve nakliyat hizmetleri', 'Maltepe Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Maltepe ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip.');

-- Insert some neighborhoods for each district
INSERT INTO neighborhoods (district_id, name, slug, description, meta_title, meta_description) VALUES
(1, 'Moda', 'moda', 'Kadıköy Moda semti evden eve nakliyat', 'Moda Evden Eve Nakliyat | Kadıköy', 'Kadıköy Moda semtinde güvenilir evden eve nakliyat hizmeti.'),
(1, 'Fenerbahçe', 'fenerbahce', 'Kadıköy Fenerbahçe semti evden eve nakliyat', 'Fenerbahçe Evden Eve Nakliyat | Kadıköy', 'Kadıköy Fenerbahçe semtinde güvenilir evden eve nakliyat hizmeti.'),
(2, 'Etiler', 'etiler', 'Beşiktaş Etiler semti evden eve nakliyat', 'Etiler Evden Eve Nakliyat | Beşiktaş', 'Beşiktaş Etiler semtinde güvenilir evden eve nakliyat hizmeti.'),
(2, 'Levent', 'levent', 'Beşiktaş Levent semti evden eve nakliyat', 'Levent Evden Eve Nakliyat | Beşiktaş', 'Beşiktaş Levent semtinde güvenilir evden eve nakliyat hizmeti.'),
(3, 'Mecidiyeköy', 'mecidiyekoy', 'Şişli Mecidiyeköy semti evden eve nakliyat', 'Mecidiyeköy Evden Eve Nakliyat | Şişli', 'Şişli Mecidiyeköy semtinde güvenilir evden eve nakliyat hizmeti.'),
(3, 'Nişantaşı', 'nisantasi', 'Şişli Nişantaşı semti evden eve nakliyat', 'Nişantaşı Evden Eve Nakliyat | Şişli', 'Şişli Nişantaşı semtinde güvenilir evden eve nakliyat hizmeti.');

-- Insert sample pricing routes
INSERT INTO pricing_routes (from_district_id, to_district_id, base_price, estimated_distance_km) VALUES
(1, 2, 1500.00, 15.5),
(1, 3, 1200.00, 12.0),
(2, 3, 800.00, 8.0),
(1, 4, 1800.00, 18.0),
(2, 4, 1000.00, 10.0);

-- Insert sample reviews
INSERT INTO reviews (customer_name, customer_email, rating, review_text, is_approved) VALUES
('Ahmet Yılmaz', 'ahmet@email.com', 5, 'Çok profesyonel bir ekip. Eşyalarımız hiç zarar görmeden taşındı. Teşekkürler!', TRUE),
('Fatma Demir', 'fatma@email.com', 5, 'Hızlı ve güvenilir hizmet. Fiyatlar da çok uygun. Kesinlikle tavsiye ederim.', TRUE),
('Mehmet Kaya', 'mehmet@email.com', 4, 'İyi hizmet aldık. Sadece biraz geç geldiler ama genel olarak memnunuz.', TRUE);

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, content, excerpt, meta_title, meta_description, is_published, published_at) VALUES
('Evden Eve Nakliyat Öncesi Yapılması Gerekenler', 'evden-eve-nakliyat-oncesi-yapilmasi-gerekenler', 'Evden eve nakliyat işlemi öncesinde dikkat edilmesi gereken önemli noktalar...', 'Evden eve nakliyat öncesi hazırlık sürecinde dikkat edilmesi gerekenler.', 'Evden Eve Nakliyat Öncesi Yapılması Gerekenler | İstanbul Nakliyat', 'Evden eve nakliyat öncesi yapılması gereken hazırlıklar ve dikkat edilmesi gereken noktalar.', TRUE, NOW()),
('İstanbul İçi Nakliyat Fiyatları 2024', 'istanbul-ici-nakliyat-fiyatlari-2024', '2024 yılı İstanbul içi nakliyat fiyatları ve fiyat hesaplama yöntemleri...', '2024 yılı güncel İstanbul içi nakliyat fiyatları ve hesaplama.', 'İstanbul İçi Nakliyat Fiyatları 2024 | Güncel Fiyat Listesi', '2024 yılı İstanbul içi nakliyat fiyatları, hesaplama yöntemleri ve uygun fiyat seçenekleri.', TRUE, NOW());