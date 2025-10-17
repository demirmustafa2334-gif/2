<?php
// Site configuration
define('SITE_NAME', 'İstanbul Evden Eve Nakliyat');
define('SITE_URL', 'http://localhost');
define('ADMIN_EMAIL', 'admin@istanbulnakliyat.com');
define('WHATSAPP_NUMBER', '+905551234567');

// SEO Settings
define('DEFAULT_META_TITLE', 'İstanbul Evden Eve Nakliyat | Profesyonel Taşımacılık Hizmetleri');
define('DEFAULT_META_DESCRIPTION', 'İstanbul\'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti. Güvenli, hızlı ve uygun fiyatlı taşımacılık çözümleri.');
define('DEFAULT_META_KEYWORDS', 'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye');

// Database settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'istanbul_nakliyat');
define('DB_USER', 'root');
define('DB_PASS', '');

// Security
define('ADMIN_SESSION_KEY', 'admin_logged_in');
define('PASSWORD_SALT', 'your_salt_here_change_this');

// File upload settings
define('UPLOAD_PATH', 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Pagination
define('POSTS_PER_PAGE', 10);
define('REVIEWS_PER_PAGE', 6);
?>