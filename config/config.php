<?php
/**
 * Main Configuration File
 * Istanbul Moving Company - Custom PHP Script
 */

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Site configuration
define('SITE_URL', 'http://localhost');
define('SITE_NAME', 'İstanbul Evden Eve Nakliyat');
define('ADMIN_EMAIL', 'admin@istanbulmoving.com');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'istanbul_moving');
define('DB_USER', 'root');
define('DB_PASS', '');

// Security
define('ADMIN_SESSION_KEY', 'admin_logged_in');
define('CSRF_TOKEN_NAME', 'csrf_token');

// File upload settings
define('UPLOAD_PATH', 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Pagination
define('POSTS_PER_PAGE', 10);
define('ADMIN_POSTS_PER_PAGE', 20);

// Timezone
date_default_timezone_set('Europe/Istanbul');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database class
require_once __DIR__ . '/database.php';

// Helper functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generate_csrf_token() {
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

function verify_csrf_token($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

function is_admin_logged_in() {
    return isset($_SESSION[ADMIN_SESSION_KEY]) && $_SESSION[ADMIN_SESSION_KEY] === true;
}

function redirect($url) {
    header("Location: " . SITE_URL . $url);
    exit();
}

function format_price($price) {
    return number_format($price, 2, ',', '.') . ' ₺';
}

function time_ago($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) return 'Az önce';
    if ($time < 3600) return floor($time/60) . ' dakika önce';
    if ($time < 86400) return floor($time/3600) . ' saat önce';
    if ($time < 2592000) return floor($time/86400) . ' gün önce';
    if ($time < 31536000) return floor($time/2592000) . ' ay önce';
    return floor($time/31536000) . ' yıl önce';
}

function generate_slug($text) {
    $turkish = array('ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'İ', 'Ö', 'Ş', 'Ü');
    $english = array('c', 'g', 'i', 'o', 's', 'u', 'c', 'g', 'i', 'o', 's', 'u');
    $text = str_replace($turkish, $english, $text);
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    $text = trim($text, '-');
    return $text;
}

function get_setting($key, $default = '') {
    global $db;
    if (!isset($db)) {
        $database = new Database();
        $db = $database->getConnection();
    }
    
    $stmt = $db->prepare("SELECT setting_value FROM site_settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    
    return $result ? $result['setting_value'] : $default;
}

function set_setting($key, $value) {
    global $db;
    if (!isset($db)) {
        $database = new Database();
        $db = $database->getConnection();
    }
    
    $stmt = $db->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    return $stmt->execute([$key, $value, $value]);
}
?>