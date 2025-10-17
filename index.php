<?php
// Start output buffering
ob_start();

// Load configuration
require_once __DIR__ . '/config/config.php';

// Load core classes
require_once __DIR__ . '/app/Database.php';
require_once __DIR__ . '/app/Router.php';
require_once __DIR__ . '/app/Controller.php';

// Initialize router
$router = new Router();

// Frontend Routes
$router->add('/', 'HomeController', 'index');
$router->add('/hizmetler', 'ServiceController', 'index');
$router->add('/hizmet/{slug}', 'ServiceController', 'detail');
$router->add('/fiyatlar', 'PriceController', 'index');
$router->add('/fiyat-hesapla', 'PriceController', 'calculate', 'POST');
$router->add('/yorumlar', 'ReviewController', 'index');
$router->add('/yorum-gonder', 'ReviewController', 'submit', 'POST');
$router->add('/blog', 'BlogController', 'index');
$router->add('/blog/{slug}', 'BlogController', 'post');
$router->add('/iletisim', 'ContactController', 'index');
$router->add('/iletisim-gonder', 'ContactController', 'submit', 'POST');

// Location Routes
$router->add('/istanbul/{slug}', 'LocationController', 'district');
$router->add('/semt/{slug}', 'LocationController', 'neighborhood');

// Sitemap
$router->add('/sitemap.xml', 'SitemapController', 'index');

// Admin Routes
$router->add('/admin', 'AdminController', 'dashboard');
$router->add('/admin/login', 'AdminController', 'login', 'GET');
$router->add('/admin/login', 'AdminController', 'login', 'POST');
$router->add('/admin/logout', 'AdminController', 'logout');
$router->add('/admin/dashboard', 'AdminController', 'dashboard');

// Admin - Districts
$router->add('/admin/districts', 'AdminController', 'districts');
$router->add('/admin/district/add', 'AdminController', 'districtAdd', 'GET');
$router->add('/admin/district/add', 'AdminController', 'districtAdd', 'POST');
$router->add('/admin/district/edit/{id}', 'AdminController', 'districtEdit', 'GET');
$router->add('/admin/district/edit/{id}', 'AdminController', 'districtEdit', 'POST');
$router->add('/admin/district/delete/{id}', 'AdminController', 'districtDelete');

// Admin - Neighborhoods
$router->add('/admin/neighborhoods', 'AdminController', 'neighborhoods');
$router->add('/admin/neighborhood/add', 'AdminController', 'neighborhoodAdd', 'GET');
$router->add('/admin/neighborhood/add', 'AdminController', 'neighborhoodAdd', 'POST');
$router->add('/admin/neighborhood/edit/{id}', 'AdminController', 'neighborhoodEdit', 'GET');
$router->add('/admin/neighborhood/edit/{id}', 'AdminController', 'neighborhoodEdit', 'POST');
$router->add('/admin/neighborhood/delete/{id}', 'AdminController', 'neighborhoodDelete');

// Admin - Services
$router->add('/admin/services', 'AdminController', 'services');

// Admin - Reviews
$router->add('/admin/reviews', 'AdminController', 'reviews');
$router->add('/admin/review/approve/{id}', 'AdminController', 'reviewApprove');
$router->add('/admin/review/delete/{id}', 'AdminController', 'reviewDelete');

// Admin - Prices
$router->add('/admin/prices', 'AdminController', 'prices');
$router->add('/admin/price/add', 'AdminController', 'priceAdd', 'GET');
$router->add('/admin/price/add', 'AdminController', 'priceAdd', 'POST');
$router->add('/admin/price/edit/{id}', 'AdminController', 'priceEdit', 'GET');
$router->add('/admin/price/edit/{id}', 'AdminController', 'priceEdit', 'POST');
$router->add('/admin/price/delete/{id}', 'AdminController', 'priceDelete');

// Admin - Messages
$router->add('/admin/messages', 'AdminController', 'messages');
$router->add('/admin/message/{id}', 'AdminController', 'messageView');

// Admin - Settings
$router->add('/admin/settings', 'AdminController', 'settings', 'GET');
$router->add('/admin/settings', 'AdminController', 'settings', 'POST');

// Get the URL from query string
$url = $_GET['url'] ?? '/';

// Dispatch the route
$router->dispatch($url);

// Flush output buffer
ob_end_flush();
