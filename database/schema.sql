-- Database schema for Istanbul Moving Company
CREATE DATABASE IF NOT EXISTS istanbul_nakliyat CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE istanbul_nakliyat;

-- Admin users table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pages table
CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Districts table
CREATE TABLE districts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Neighborhoods table
CREATE TABLE neighborhoods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    district_id INT NOT NULL,
    description TEXT,
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (district_id) REFERENCES districts(id) ON DELETE CASCADE,
    UNIQUE KEY unique_neighborhood (slug, district_id)
);

-- Pricing routes table
CREATE TABLE pricing_routes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    from_district_id INT NOT NULL,
    to_district_id INT NOT NULL,
    from_neighborhood_id INT,
    to_neighborhood_id INT,
    base_price DECIMAL(10,2) NOT NULL,
    price_per_km DECIMAL(10,2) DEFAULT 0,
    minimum_price DECIMAL(10,2) DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (from_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    FOREIGN KEY (to_district_id) REFERENCES districts(id) ON DELETE CASCADE,
    FOREIGN KEY (from_neighborhood_id) REFERENCES neighborhoods(id) ON DELETE CASCADE,
    FOREIGN KEY (to_neighborhood_id) REFERENCES neighborhoods(id) ON DELETE CASCADE
);

-- Customer reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100),
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    review_text TEXT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Blog posts table
CREATE TABLE blog_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT NOT NULL,
    excerpt TEXT,
    featured_image VARCHAR(255),
    meta_title VARCHAR(255),
    meta_description TEXT,
    meta_keywords TEXT,
    status ENUM('draft', 'published') DEFAULT 'draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact messages table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Quote requests table
CREATE TABLE quote_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    from_district VARCHAR(100),
    to_district VARCHAR(100),
    from_neighborhood VARCHAR(100),
    to_neighborhood VARCHAR(100),
    moving_date DATE,
    property_type ENUM('apartment', 'house', 'office', 'other'),
    estimated_price DECIMAL(10,2),
    status ENUM('new', 'contacted', 'quoted', 'completed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Site settings table
CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user
INSERT INTO admin_users (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@example.com');

-- Insert default site settings
INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_title', 'İstanbul Evden Eve Nakliyat'),
('site_description', 'İstanbul\'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti'),
('contact_phone', '+90 555 123 45 67'),
('contact_email', 'info@example.com'),
('whatsapp_number', '+905551234567'),
('address', 'İstanbul, Türkiye'),
('social_facebook', ''),
('social_instagram', ''),
('social_twitter', ''),
('google_maps_api', ''),
('analytics_code', '');

-- Insert sample districts
INSERT INTO districts (name, slug, description, meta_title, meta_description, meta_keywords) VALUES
('Kadıköy', 'kadikoy', 'Kadıköy ilçesi evden eve nakliyat hizmetleri', 'Kadıköy Evden Eve Nakliyat | Profesyonel Taşımacılık', 'Kadıköy ilçesinde güvenilir evden eve nakliyat hizmeti. Uzman ekibimizle hızlı ve güvenli taşınma.', 'kadıköy nakliyat, kadıköy evden eve nakliyat, taşımacılık'),
('Beşiktaş', 'besiktas', 'Beşiktaş ilçesi evden eve nakliyat hizmetleri', 'Beşiktaş Evden Eve Nakliyat | Güvenilir Taşımacılık', 'Beşiktaş ilçesinde profesyonel evden eve nakliyat hizmeti. Kaliteli hizmet, uygun fiyat.', 'beşiktaş nakliyat, beşiktaş evden eve nakliyat, taşımacılık'),
('Şişli', 'sisli', 'Şişli ilçesi evden eve nakliyat hizmetleri', 'Şişli Evden Eve Nakliyat | Uzman Taşımacılık', 'Şişli ilçesinde güvenilir evden eve nakliyat hizmeti. Deneyimli ekibimizle hızlı taşınma.', 'şişli nakliyat, şişli evden eve nakliyat, taşımacılık'),
('Beyoğlu', 'beyoglu', 'Beyoğlu ilçesi evden eve nakliyat hizmetleri', 'Beyoğlu Evden Eve Nakliyat | Profesyonel Hizmet', 'Beyoğlu ilçesinde kaliteli evden eve nakliyat hizmeti. Güvenilir ve hızlı taşımacılık.', 'beyoğlu nakliyat, beyoğlu evden eve nakliyat, taşımacılık'),
('Fatih', 'fatih', 'Fatih ilçesi evden eve nakliyat hizmetleri', 'Fatih Evden Eve Nakliyat | Uzman Taşımacılık', 'Fatih ilçesinde profesyonel evden eve nakliyat hizmeti. Deneyimli ekibimizle güvenli taşınma.', 'fatih nakliyat, fatih evden eve nakliyat, taşımacılık');

-- Insert sample neighborhoods
INSERT INTO neighborhoods (name, slug, district_id, description, meta_title, meta_description, meta_keywords) VALUES
('Moda', 'moda', 1, 'Kadıköy Moda semti evden eve nakliyat', 'Moda Evden Eve Nakliyat | Kadıköy Taşımacılık', 'Kadıköy Moda semtinde güvenilir evden eve nakliyat hizmeti.', 'moda nakliyat, kadıköy moda nakliyat'),
('Fenerbahçe', 'fenerbahce', 1, 'Kadıköy Fenerbahçe semti evden eve nakliyat', 'Fenerbahçe Evden Eve Nakliyat | Kadıköy Taşımacılık', 'Kadıköy Fenerbahçe semtinde profesyonel evden eve nakliyat hizmeti.', 'fenerbahçe nakliyat, kadıköy fenerbahçe nakliyat'),
('Etiler', 'etiler', 2, 'Beşiktaş Etiler semti evden eve nakliyat', 'Etiler Evden Eve Nakliyat | Beşiktaş Taşımacılık', 'Beşiktaş Etiler semtinde kaliteli evden eve nakliyat hizmeti.', 'etiler nakliyat, beşiktaş etiler nakliyat'),
('Levent', 'levent', 2, 'Beşiktaş Levent semti evden eve nakliyat', 'Levent Evden Eve Nakliyat | Beşiktaş Taşımacılık', 'Beşiktaş Levent semtinde güvenilir evden eve nakliyat hizmeti.', 'levent nakliyat, beşiktaş levent nakliyat'),
('Mecidiyeköy', 'mecidiyekoy', 3, 'Şişli Mecidiyeköy semti evden eve nakliyat', 'Mecidiyeköy Evden Eve Nakliyat | Şişli Taşımacılık', 'Şişli Mecidiyeköy semtinde profesyonel evden eve nakliyat hizmeti.', 'mecidiyeköy nakliyat, şişli mecidiyeköy nakliyat');

-- Insert sample pricing
INSERT INTO pricing_routes (from_district_id, to_district_id, base_price, price_per_km, minimum_price) VALUES
(1, 2, 500.00, 15.00, 300.00),
(1, 3, 600.00, 18.00, 350.00),
(1, 4, 450.00, 12.00, 250.00),
(2, 3, 400.00, 10.00, 200.00),
(2, 4, 350.00, 8.00, 180.00),
(3, 4, 300.00, 6.00, 150.00);

-- Insert sample reviews
INSERT INTO reviews (customer_name, customer_email, rating, review_text, status) VALUES
('Ahmet Yılmaz', 'ahmet@example.com', 5, 'Çok profesyonel hizmet aldık. Eşyalarımız hiç zarar görmedi. Teşekkürler!', 'approved'),
('Fatma Demir', 'fatma@example.com', 5, 'Hızlı ve güvenilir taşımacılık hizmeti. Kesinlikle tavsiye ederim.', 'approved'),
('Mehmet Kaya', 'mehmet@example.com', 4, 'Fiyat uygun, hizmet kaliteli. Memnun kaldık.', 'approved'),
('Ayşe Özkan', 'ayse@example.com', 5, 'Ekip çok dikkatli ve profesyonel. Eşyalarımız güvende.', 'approved');