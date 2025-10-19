<?php
/**
 * Global Configuration File
 * Yereltanitim.com - Turkey Tourism Website
 */

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define constants
define('SITE_URL', 'https://yereltanitim.com');
define('ADMIN_URL', SITE_URL . '/yonetim');
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');
define('CHATGPT_API_URL', 'https://api.openai.com/v1/chat/completions');

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
        redirect(ADMIN_URL . '/giris.php');
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

function truncate_text($text, $length = 150) {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . '...';
}

function format_date($date, $format = 'd.m.Y') {
    return date($format, strtotime($date));
}

function get_turkish_cities() {
    return [
        '01' => 'Adana', '02' => 'Adıyaman', '03' => 'Afyonkarahisar', '04' => 'Ağrı', '05' => 'Amasya',
        '06' => 'Ankara', '07' => 'Antalya', '08' => 'Artvin', '09' => 'Aydın', '10' => 'Balıkesir',
        '11' => 'Bilecik', '12' => 'Bingöl', '13' => 'Bitlis', '14' => 'Bolu', '15' => 'Burdur',
        '16' => 'Bursa', '17' => 'Çanakkale', '18' => 'Çankırı', '19' => 'Çorum', '20' => 'Denizli',
        '21' => 'Diyarbakır', '22' => 'Edirne', '23' => 'Elazığ', '24' => 'Erzincan', '25' => 'Erzurum',
        '26' => 'Eskişehir', '27' => 'Gaziantep', '28' => 'Giresun', '29' => 'Gümüşhane', '30' => 'Hakkari',
        '31' => 'Hatay', '32' => 'Isparta', '33' => 'Mersin', '34' => 'İstanbul', '35' => 'İzmir',
        '36' => 'Kars', '37' => 'Kastamonu', '38' => 'Kayseri', '39' => 'Kırklareli', '40' => 'Kırşehir',
        '41' => 'Kocaeli', '42' => 'Konya', '43' => 'Kütahya', '44' => 'Malatya', '45' => 'Manisa',
        '46' => 'Kahramanmaraş', '47' => 'Mardin', '48' => 'Muğla', '49' => 'Muş', '50' => 'Nevşehir',
        '51' => 'Niğde', '52' => 'Ordu', '53' => 'Rize', '54' => 'Sakarya', '55' => 'Samsun',
        '56' => 'Siirt', '57' => 'Sinop', '58' => 'Sivas', '59' => 'Tekirdağ', '60' => 'Tokat',
        '61' => 'Trabzon', '62' => 'Tunceli', '63' => 'Şanlıurfa', '64' => 'Uşak', '65' => 'Van',
        '66' => 'Yozgat', '67' => 'Zonguldak', '68' => 'Aksaray', '69' => 'Bayburt', '70' => 'Karaman',
        '71' => 'Kırıkkale', '72' => 'Batman', '73' => 'Şırnak', '74' => 'Bartın', '75' => 'Ardahan',
        '76' => 'Iğdır', '77' => 'Yalova', '78' => 'Karabük', '79' => 'Kilis', '80' => 'Osmaniye',
        '81' => 'Düzce'
    ];
}

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set timezone
date_default_timezone_set('Europe/Istanbul');
?>