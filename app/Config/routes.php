<?php
use App\Controllers\HomeController;
use App\Controllers\SitemapController;
use App\Controllers\LocationController;
use App\Controllers\PriceController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\DistrictController;
use App\Controllers\Admin\NeighborhoodController;
use App\Controllers\Admin\PriceAdminController;

/* @var $router App\Core\Router */

$router->get('/', 'HomeController@index');
$router->get('/hizmetler', 'HomeController@services');
$router->any('/iletisim', 'HomeController@contact');
$router->get('/fiyat-listesi', 'PriceController@index');
$router->any('/fiyat-hesapla', 'PriceController@calculate');

// Dynamic location pages
$router->get('/istanbul/{slug}', 'LocationController@district');
$router->get('/istanbul/{districtSlug}/{neighborhoodSlug}', 'LocationController@neighborhood');

// Sitemap and SEO
$router->get('/sitemap.xml', 'SitemapController@index');
$router->get('/robots.txt', 'SitemapController@robots');

// Admin auth
$router->any('/admin/login', 'Admin\\AuthController@login');
$router->get('/admin/logout', 'Admin\\AuthController@logout');

// Admin area
$router->get('/admin', 'Admin\\DashboardController@index');
$router->get('/admin/districts', 'Admin\\DistrictController@index');
$router->any('/admin/districts/create', 'Admin\\DistrictController@create');
$router->any('/admin/districts/{id}/edit', 'Admin\\DistrictController@edit');
$router->post('/admin/districts/{id}/delete', 'Admin\\DistrictController@delete');

$router->get('/admin/neighborhoods', 'Admin\\NeighborhoodController@index');
$router->any('/admin/neighborhoods/create', 'Admin\\NeighborhoodController@create');
$router->any('/admin/neighborhoods/{id}/edit', 'Admin\\NeighborhoodController@edit');
$router->post('/admin/neighborhoods/{id}/delete', 'Admin\\NeighborhoodController@delete');

$router->get('/admin/prices', 'Admin\\PriceAdminController@index');
$router->any('/admin/prices/create', 'Admin\\PriceAdminController@create');
$router->any('/admin/prices/{id}/edit', 'Admin\\PriceAdminController@edit');
$router->post('/admin/prices/{id}/delete', 'Admin\\PriceAdminController@delete');
