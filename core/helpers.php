<?php
/**
 * Helper Functions
 */

function asset($path) {
    return '/' . ltrim($path, '/');
}

function url($path = '') {
    $config = require __DIR__ . '/../config/app.php';
    return rtrim($config['url'], '/') . '/' . ltrim($path, '/');
}

function config($key, $default = null) {
    static $config = null;
    
    if ($config === null) {
        $config = require __DIR__ . '/../config/app.php';
    }
    
    return $config[$key] ?? $default;
}

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function old($key, $default = '') {
    return $_POST[$key] ?? $default;
}

function dd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function formatDate($date, $format = 'd.m.Y') {
    return date($format, strtotime($date));
}

function formatPrice($price) {
    return number_format($price, 2, ',', '.') . ' ₺';
}

function truncate($text, $length = 100, $suffix = '...') {
    if (strlen($text) > $length) {
        return substr($text, 0, $length) . $suffix;
    }
    return $text;
}

function getSetting($key, $default = '') {
    $db = Database::getInstance();
    $setting = $db->fetchOne("SELECT setting_value FROM settings WHERE setting_key = ?", [$key]);
    return $setting ? $setting['setting_value'] : $default;
}

function setSetting($key, $value) {
    $db = Database::getInstance();
    $existing = $db->fetchOne("SELECT id FROM settings WHERE setting_key = ?", [$key]);
    
    if ($existing) {
        $db->update('settings', ['setting_value' => $value], 'setting_key = ?', [$key]);
    } else {
        $db->insert('settings', ['setting_key' => $key, 'setting_value' => $value]);
    }
}

function getActiveDistricts() {
    $db = Database::getInstance();
    return $db->fetchAll("SELECT * FROM districts WHERE is_active = 1 ORDER BY sort_order, name");
}

function getActiveNeighborhoods($districtId = null) {
    $db = Database::getInstance();
    
    if ($districtId) {
        return $db->fetchAll("SELECT * FROM neighborhoods WHERE district_id = ? AND is_active = 1 ORDER BY sort_order, name", [$districtId]);
    }
    
    return $db->fetchAll("SELECT * FROM neighborhoods WHERE is_active = 1 ORDER BY sort_order, name");
}

function generateBreadcrumbs($items) {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => []
    ];
    
    foreach ($items as $index => $item) {
        $schema['itemListElement'][] = [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $item['name'],
            'item' => url($item['url'])
        ];
    }
    
    return json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

function generateLocalBusinessSchema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'MovingCompany',
        'name' => getSetting('site_name', 'İstanbul Nakliyat'),
        'description' => getSetting('site_description'),
        'url' => config('url'),
        'telephone' => getSetting('contact_phone'),
        'email' => getSetting('contact_email'),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'İstanbul',
            'addressCountry' => 'TR'
        ],
        'areaServed' => [
            '@type' => 'City',
            'name' => 'İstanbul'
        ]
    ];
    
    return json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
