<?php
/**
 * İstanbul Nakliyat - Main Entry Point
 */

// Error Reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start Session
session_start();

// Load Core Files
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../core/helpers.php';

// Load Models
require_once __DIR__ . '/../app/models/District.php';
require_once __DIR__ . '/../app/models/Neighborhood.php';
require_once __DIR__ . '/../app/models/Price.php';
require_once __DIR__ . '/../app/models/Review.php';
require_once __DIR__ . '/../app/models/BlogPost.php';
require_once __DIR__ . '/../app/models/Page.php';

// Load Controllers
require_once __DIR__ . '/../app/controllers/AdminController.php';
require_once __DIR__ . '/../app/controllers/FrontendController.php';

// Initialize Router
$router = new Router();

// Frontend Routes
$router->get('/', function() {
    $controller = new FrontendController();
    $controller->home();
});

$router->get('/hizmetlerimiz', function() {
    $controller = new FrontendController();
    $controller->services();
});

$router->get('/fiyat-listesi', function() {
    $controller = new FrontendController();
    $controller->prices();
});

$router->post('/api/calculate-price', function() {
    $controller = new FrontendController();
    $controller->calculatePrice();
});

$router->get('/yorumlar', function() {
    $controller = new FrontendController();
    $controller->reviews();
});

$router->get('/blog', function() {
    $controller = new FrontendController();
    $controller->blog();
});

$router->get('/blog/:slug', function($slug) {
    $controller = new FrontendController();
    $controller->blogPost($slug);
});

$router->get('/iletisim', function() {
    $controller = new FrontendController();
    $controller->contact();
});

$router->post('/iletisim', function() {
    $controller = new FrontendController();
    $controller->contact();
});

$router->get('/istanbul/:slug', function($slug) {
    // Check if it's a district or neighborhood
    $districtModel = new District();
    $district = $districtModel->getBySlug($slug);
    
    if ($district) {
        $controller = new FrontendController();
        $controller->district($slug);
    } else {
        $neighborhoodModel = new Neighborhood();
        $neighborhood = $neighborhoodModel->getBySlug($slug);
        
        if ($neighborhood) {
            $controller = new FrontendController();
            $controller->neighborhood($slug);
        } else {
            http_response_code(404);
            echo "404 - Sayfa bulunamadı";
        }
    }
});

$router->get('/sitemap.xml', function() {
    $controller = new FrontendController();
    $controller->sitemap();
});

// Admin Routes
$router->get('/admin', function() {
    header('Location: /admin/dashboard');
});

$router->get('/admin/login', function() {
    $controller = new AdminController();
    $controller->login();
});

$router->post('/admin/login', function() {
    $controller = new AdminController();
    $controller->login();
});

$router->get('/admin/logout', function() {
    $controller = new AdminController();
    $controller->logout();
});

$router->get('/admin/dashboard', function() {
    $controller = new AdminController();
    $controller->dashboard();
});

// Admin Districts
$router->get('/admin/districts', function() {
    $controller = new AdminController();
    $controller->districts();
});

$router->get('/admin/districts/create', function() {
    $controller = new AdminController();
    $controller->districtCreate();
});

$router->post('/admin/districts/create', function() {
    $controller = new AdminController();
    $controller->districtCreate();
});

$router->get('/admin/districts/edit/:id', function($id) {
    $controller = new AdminController();
    $controller->districtEdit($id);
});

$router->post('/admin/districts/edit/:id', function($id) {
    $controller = new AdminController();
    $controller->districtEdit($id);
});

$router->get('/admin/districts/delete/:id', function($id) {
    $controller = new AdminController();
    $controller->districtDelete($id);
});

// Admin Neighborhoods
$router->get('/admin/neighborhoods', function() {
    $controller = new AdminController();
    $controller->neighborhoods();
});

$router->get('/admin/neighborhoods/create', function() {
    $controller = new AdminController();
    $controller->neighborhoodCreate();
});

$router->post('/admin/neighborhoods/create', function() {
    $controller = new AdminController();
    $controller->neighborhoodCreate();
});

$router->get('/admin/neighborhoods/edit/:id', function($id) {
    $controller = new AdminController();
    $controller->neighborhoodEdit($id);
});

$router->post('/admin/neighborhoods/edit/:id', function($id) {
    $controller = new AdminController();
    $controller->neighborhoodEdit($id);
});

$router->get('/admin/neighborhoods/delete/:id', function($id) {
    $controller = new AdminController();
    $controller->neighborhoodDelete($id);
});

// Admin Prices
$router->get('/admin/prices', function() {
    $controller = new AdminController();
    $controller->prices();
});

$router->get('/admin/prices/create', function() {
    $controller = new AdminController();
    $controller->priceCreate();
});

$router->post('/admin/prices/create', function() {
    $controller = new AdminController();
    $controller->priceCreate();
});

$router->get('/admin/prices/edit/:id', function($id) {
    $controller = new AdminController();
    $controller->priceEdit($id);
});

$router->post('/admin/prices/edit/:id', function($id) {
    $controller = new AdminController();
    $controller->priceEdit($id);
});

$router->get('/admin/prices/delete/:id', function($id) {
    $controller = new AdminController();
    $controller->priceDelete($id);
});

// Admin Reviews
$router->get('/admin/reviews', function() {
    $controller = new AdminController();
    $controller->reviews();
});

$router->get('/admin/reviews/approve/:id', function($id) {
    $controller = new AdminController();
    $controller->reviewApprove($id);
});

$router->get('/admin/reviews/delete/:id', function($id) {
    $controller = new AdminController();
    $controller->reviewDelete($id);
});

// Admin Settings
$router->get('/admin/settings', function() {
    $controller = new AdminController();
    $controller->settings();
});

$router->post('/admin/settings', function() {
    $controller = new AdminController();
    $controller->settings();
});

// Custom Page Route (must be last)
$router->get('/:slug', function($slug) {
    $controller = new FrontendController();
    $controller->page($slug);
});

// 404 Handler
$router->setNotFound(function() {
    http_response_code(404);
    echo "404 - Sayfa Bulunamadı";
});

// Dispatch Router
$router->dispatch();
