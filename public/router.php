<?php
use Core\Autoloader;
use Core\Router;

require dirname(__DIR__) . '/core/Autoloader.php';
Core\Autoloader::register();
Core\Session::start();

$router = new Router();

// Home
$home = new App\Controllers\HomeController();
$router->get('/', [$home, 'index']);

// Static pages
$page = new App\Controllers\PageController();
$router->get('/services', fn() => $page->show('services'));
$router->get('/prices', fn() => (new App\Controllers\PriceController())->form());
$router->get('/reviews', [new App\Controllers\ReviewController(), 'list']);
$router->get('/contact', [new App\Controllers\ContactController(), 'form']);
$router->post('/contact', [new App\Controllers\ContactController(), 'submit']);
$router->get('/istanbul', [new App\Controllers\IstanbulController(), 'index']);

// Location
$location = new App\Controllers\LocationController();
$router->get('/istanbul/ilce/{slug}', [$location, 'district']);
$router->get('/istanbul/semt/{slug}', [$location, 'neighborhood']);

// API
$router->get('/api/estimate', [new App\Controllers\PriceController(), 'estimateApi']);

// Admin
$router->get('/admin/login', [new App\Controllers\Admin\AuthController(), 'loginForm']);
$router->post('/admin/login', [new App\Controllers\Admin\AuthController(), 'login']);
$router->get('/admin/logout', [new App\Controllers\Admin\AuthController(), 'logout']);
$router->get('/admin', [new App\Controllers\Admin\DashboardController(), 'index']);
$router->get('/admin/locations', [new App\Controllers\Admin\LocationController(), 'index']);
$router->post('/admin/locations/districts', [new App\Controllers\Admin\LocationController(), 'createDistrict']);

// SEO: sitemap
$router->get('/sitemap.xml', function() {
    header('Content-Type: application/xml; charset=utf-8');
    $pdo = Core\Database::getConnection();
    $urls = ['/','/services','/prices','/contact','/reviews','/istanbul'];
    foreach ($pdo->query('SELECT slug FROM pages') as $row) {
        if (!in_array('/' . $row['slug'], $urls, true)) {
            $urls[] = '/' . $row['slug'];
        }
    }
    foreach ($pdo->query('SELECT slug FROM districts') as $row) {
        $urls[] = '/istanbul/ilce/' . $row['slug'];
    }
    foreach ($pdo->query('SELECT slug FROM neighborhoods') as $row) {
        $urls[] = '/istanbul/semt/' . $row['slug'];
    }
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    foreach ($urls as $u) {
        $loc = Core\SEO::baseUrl($u);
        echo "  <url><loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc></url>\n";
    }
    echo "</urlset>";
});

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
