<?php
/**
 * Global Configuration File
 * Istanbul Moving Company - Custom PHP Script
 */

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define constants
define('SITE_URL', 'http://localhost/istanbul-nakliyat');
define('ADMIN_URL', SITE_URL . '/admin');
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');

// Include database connection
require_once __DIR__ . '/database.php';

// Autoload classes
spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/../models/',
        __DIR__ . '/../controllers/',
        __DIR__ . '/../helpers/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Helper functions
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function generate_slug($string) {
    $turkish = ['ç', 'ğ', 'ı', 'ö', 'ş', 'ü', 'Ç', 'Ğ', 'I', 'İ', 'Ö', 'Ş', 'Ü'];
    $english = ['c', 'g', 'i', 'o', 's', 'u', 'c', 'g', 'i', 'i', 'o', 's', 'u'];
    
    $string = str_replace($turkish, $english, $string);
    $string = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $string = strtolower(trim($string, '-'));
    
    return $string;
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function is_admin_logged_in() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function require_admin_login() {
    if (!is_admin_logged_in()) {
        redirect(ADMIN_URL . '/login.php');
    }
}

function get_setting($key) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT setting_value FROM settings WHERE setting_key = :key LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':key', $key);
    $stmt->execute();
    
    $result = $stmt->fetch();
    return $result ? $result['setting_value'] : '';
}

function update_setting($key, $value) {
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value) 
              ON DUPLICATE KEY UPDATE setting_value = :value";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':key', $key);
    $stmt->bindParam(':value', $value);
    
    return $stmt->execute();
}

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set timezone
date_default_timezone_set('Europe/Istanbul');
?>