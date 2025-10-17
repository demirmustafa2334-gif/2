-- Database schema for Istanbul Moving Company Website

CREATE DATABASE IF NOT EXISTS istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE istanbul_nakliyat;

-- Admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Districts table (İlçeler)
CREATE TABLE districts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Neighborhoods table (Semtler)
CREATE TABLE neighborhoods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    district_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES districts(id) ON DELETE CASCADE
);

-- Pages table
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    content LONGTEXT,
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    status TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog posts table
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    content LONGTEXT,
    excerpt TEXT,
    featured_image VARCHAR(255),
    meta_title VARCHAR(200),
    meta_description TEXT,
    meta_keywords TEXT,
    status TINYINT(1) DEFAULT 1,
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Customer reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT NOT NULL,
    location VARCHAR(100),
    status TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Pricing table
CREATE TABLE pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_location VARCHAR(100) NOT NULL,
    to_location VARCHAR(100) NOT NULL,
    base_price DECIMAL(10,2) NOT NULL,
    price_per_km DECIMAL(10,2) DEFAULT 0,
    distance_km DECIMAL(8,2) DEFAULT 0,
    estimated_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact messages table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Site settings table
CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user
INSERT INTO admin_users (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@istanbulnakliyat.com');

-- Insert default site settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_title', 'İstanbul Evden Eve Nakliyat'),
('site_description', 'İstanbul\'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti'),
('contact_phone', '+90 555 123 45 67'),
('contact_email', 'info@istanbulnakliyat.com'),
('whatsapp_number', '+905551234567'),
('address', 'İstanbul, Türkiye'),
('social_facebook', ''),
('social_instagram', ''),
('social_twitter', '');

-- Insert sample districts
INSERT INTO districts (name, slug, description, meta_title, meta_description) VALUES
('Kadıköy', 'kadikoy', 'Kadıköy bölgesinde profesyonel nakliyat hizmeti', 'Kadıköy Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Kadıköy\'de güvenli ve hızlı evden eve nakliyat hizmeti. Uzman ekibimizle taşınma işlemlerinizi kolaylaştırıyoruz.'),
('Beşiktaş', 'besiktas', 'Beşiktaş bölgesinde profesyonel nakliyat hizmeti', 'Beşiktaş Evden Eve Nakliyat | Güvenilir Taşımacılık', 'Beşiktaş\'ta profesyonel evden eve nakliyat hizmeti. Ofis ve ev taşımacılığında uzman ekibimizle hizmetinizdeyiz.'),
('Şişli', 'sisli', 'Şişli bölgesinde profesyonel nakliyat hizmeti', 'Şişli Evden Eve Nakliyat | Kaliteli Taşımacılık', 'Şişli\'de güvenilir evden eve nakliyat hizmeti. Modern araçlarımız ve deneyimli ekibimizle taşınmanızı kolaylaştırıyoruz.'),
('Beyoğlu', 'beyoglu', 'Beyoğlu bölgesinde profesyonel nakliyat hizmeti', 'Beyoğlu Evden Eve Nakliyat | Uzman Taşımacılık', 'Beyoğlu\'nda profesyonel evden eve nakliyat hizmeti. Ticari ve konut taşımacılığında güvenilir çözümler sunuyoruz.'),
('Fatih', 'fatih', 'Fatih bölgesinde profesyonel nakliyat hizmeti', 'Fatih Evden Eve Nakliyat | Tarihi Bölge Taşımacılığı', 'Fatih\'te özel evden eve nakliyat hizmeti. Tarihi bölgelerde dikkatli ve güvenli taşımacılık çözümleri.');

-- Insert sample neighborhoods
INSERT INTO neighborhoods (district_id, name, slug, description, meta_title, meta_description) VALUES
(1, 'Moda', 'kadikoy-moda', 'Kadıköy Moda semtinde nakliyat hizmeti', 'Moda Evden Eve Nakliyat | Kadıköy', 'Kadıköy Moda\'da profesyonel evden eve nakliyat hizmeti. Deneyimli ekibimizle güvenli taşımacılık.'),
(1, 'Fenerbahçe', 'kadikoy-fenerbahce', 'Kadıköy Fenerbahçe semtinde nakliyat hizmeti', 'Fenerbahçe Evden Eve Nakliyat | Kadıköy', 'Kadıköy Fenerbahçe\'de güvenilir evden eve nakliyat hizmeti. Modern araçlarımızla hızlı taşımacılık.'),
(2, 'Etiler', 'besiktas-etiler', 'Beşiktaş Etiler semtinde nakliyat hizmeti', 'Etiler Evden Eve Nakliyat | Beşiktaş', 'Beşiktaş Etiler\'de profesyonel evden eve nakliyat hizmeti. Lüks konut taşımacılığında uzmanız.'),
(2, 'Levent', 'besiktas-levent', 'Beşiktaş Levent semtinde nakliyat hizmeti', 'Levent Evden Eve Nakliyat | Beşiktaş', 'Beşiktaş Levent\'te güvenilir evden eve nakliyat hizmeti. Ofis ve konut taşımacılığında deneyimliyiz.'),
(3, 'Mecidiyeköy', 'sisli-mecidiyekoy', 'Şişli Mecidiyeköy semtinde nakliyat hizmeti', 'Mecidiyeköy Evden Eve Nakliyat | Şişli', 'Şişli Mecidiyeköy\'de profesyonel evden eve nakliyat hizmeti. Ticari bölge taşımacılığında uzmanız.');

-- Insert sample pages
INSERT INTO pages (title, slug, content, meta_title, meta_description) VALUES
('Hizmetlerimiz', 'hizmetler', '<h2>Nakliyat Hizmetlerimiz</h2><p>İstanbul\'un tüm bölgelerinde profesyonel evden eve nakliyat hizmeti sunuyoruz.</p>', 'Nakliyat Hizmetleri | İstanbul Evden Eve Taşımacılık', 'Profesyonel nakliyat hizmetlerimiz ile İstanbul\'da güvenli ve hızlı taşımacılık çözümleri sunuyoruz.'),
('Fiyat Listesi', 'fiyat-listesi', '<h2>Nakliyat Fiyatlarımız</h2><p>Şeffaf ve uygun fiyatlı nakliyat hizmetlerimiz.</p>', 'Nakliyat Fiyatları | Uygun Fiyatlı Taşımacılık', 'İstanbul nakliyat fiyatlarımızı inceleyin. Şeffaf fiyatlandırma ile uygun maliyetli taşımacılık hizmeti.'),
('Müşteri Yorumları', 'musteri-yorumlari', '<h2>Müşterilerimizin Görüşleri</h2><p>Hizmetlerimizden memnun kalan müşterilerimizin yorumları.</p>', 'Müşteri Yorumları | Nakliyat Referansları', 'Müşterilerimizin nakliyat hizmetlerimiz hakkındaki görüşlerini okuyun. Güvenilir referanslarımız.'),
('İletişim', 'iletisim', '<h2>İletişim Bilgileri</h2><p>Bizimle iletişime geçin ve ücretsiz keşif talebinde bulunun.</p>', 'İletişim | Nakliyat Firma Bilgileri', 'İstanbul nakliyat firmamızla iletişime geçin. Ücretsiz keşif ve fiyat teklifi için bizi arayın.');

-- Insert sample blog posts
INSERT INTO blog_posts (title, slug, content, excerpt, meta_title, meta_description) VALUES
('Evden Eve Nakliyat İçin Hazırlık Rehberi', 'evden-eve-nakliyat-hazirlik-rehberi', '<h2>Taşınma Öncesi Hazırlık</h2><p>Evden eve nakliyat işlemi öncesi yapmanız gerekenler...</p>', 'Evden eve nakliyat öncesi yapmanız gereken hazırlıkları öğrenin. Pratik ipuçları ve öneriler.', 'Evden Eve Nakliyat Hazırlık Rehberi | Taşınma İpuçları', 'Evden eve nakliyat öncesi hazırlık rehberi. Taşınma işlemini kolaylaştıracak pratik öneriler ve ipuçları.'),
('İstanbul Nakliyat Fiyatları 2024', 'istanbul-nakliyat-fiyatlari-2024', '<h2>Güncel Nakliyat Fiyatları</h2><p>2024 yılı İstanbul nakliyat fiyatları hakkında bilgiler...</p>', '2024 yılı İstanbul nakliyat fiyatları ve fiyatlandırma kriterleri hakkında detaylı bilgi.', 'İstanbul Nakliyat Fiyatları 2024 | Güncel Taşımacılık Fiyatları', '2024 yılı İstanbul nakliyat fiyatları. Güncel taşımacılık fiyatlandırması ve maliyet hesaplama rehberi.');

-- Insert sample reviews
INSERT INTO reviews (customer_name, customer_email, rating, review_text, location, status) VALUES
('Ahmet Yılmaz', 'ahmet@email.com', 5, 'Çok profesyonel bir hizmet aldık. Eşyalarımız hiç zarar görmedi.', 'Kadıköy', 1),
('Fatma Demir', 'fatma@email.com', 5, 'Hızlı ve güvenilir nakliyat hizmeti. Teşekkürler.', 'Beşiktaş', 1),
('Mehmet Kaya', 'mehmet@email.com', 4, 'Fiyatlar uygun, hizmet kaliteli. Memnun kaldık.', 'Şişli', 1);

-- Insert sample pricing
INSERT INTO pricing (from_location, to_location, base_price, price_per_km, distance_km, estimated_price) VALUES
('Kadıköy', 'Beşiktaş', 500.00, 10.00, 15.5, 655.00),
('Kadıköy', 'Şişli', 450.00, 10.00, 12.0, 570.00),
('Beşiktaş', 'Şişli', 300.00, 10.00, 8.0, 380.00),
('Şişli', 'Fatih', 400.00, 10.00, 10.0, 500.00),
('Beyoğlu', 'Kadıköy', 600.00, 10.00, 20.0, 800.00);