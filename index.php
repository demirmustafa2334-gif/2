<?php
session_start();
require_once 'config/database.php';
require_once 'config/config.php';
require_once 'includes/functions.php';

// Simple routing system
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = rtrim($path, '/');

// Remove base path if exists
$basePath = '/';
if ($path === $basePath) {
    $path = '/';
}

// Route handling
switch ($path) {
    case '/':
        include 'views/home.php';
        break;
    case '/admin':
        include 'admin/index.php';
        break;
    case '/admin/login':
        include 'admin/login.php';
        break;
    case '/admin/logout':
        include 'admin/logout.php';
        break;
    case '/hizmetler':
        include 'views/services.php';
        break;
    case '/fiyat-listesi':
        include 'views/pricing.php';
        break;
    case '/musteri-yorumlari':
        include 'views/reviews.php';
        break;
    case '/blog':
        include 'views/blog.php';
        break;
    case '/iletisim':
        include 'views/contact.php';
        break;
    default:
        // Check if it's a district or neighborhood page
        if (preg_match('/^\/istanbul\/([a-z0-9-]+)$/', $path, $matches)) {
            $slug = $matches[1];
            include 'views/location.php';
        } else {
            http_response_code(404);
            include 'views/404.php';
        }
        break;
}
?>