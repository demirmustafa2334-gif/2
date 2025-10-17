<?php
// Site Configuration
define('SITE_NAME', 'İstanbul Evden Eve Nakliyat');
define('SITE_URL', 'http://localhost');
define('ADMIN_EMAIL', 'admin@example.com');
define('WHATSAPP_NUMBER', '+905551234567');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'istanbul_nakliyat');
define('DB_USER', 'root');
define('DB_PASS', '');

// Security
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', password_hash('admin123', PASSWORD_DEFAULT));

// SEO Settings
define('DEFAULT_META_TITLE', 'İstanbul Evden Eve Nakliyat | Profesyonel Taşımacılık Hizmetleri');
define('DEFAULT_META_DESCRIPTION', 'İstanbul\'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti. Güvenilir, hızlı ve uygun fiyatlı taşımacılık çözümleri.');
define('DEFAULT_META_KEYWORDS', 'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye, taşınma');

// File Upload Settings
define('UPLOAD_PATH', 'uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB

// Pagination
define('POSTS_PER_PAGE', 10);
define('REVIEWS_PER_PAGE', 6);

// Timezone
date_default_timezone_set('Europe/Istanbul');
?>