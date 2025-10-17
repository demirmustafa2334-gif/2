<?php
declare(strict_types=1);

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\LocationController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;

/** @var Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/services', [HomeController::class, 'services']);
$router->get('/price-list', [HomeController::class, 'prices']);
$router->get('/reviews', [HomeController::class, 'reviews']);
$router->get('/blog', [HomeController::class, 'blog']);
$router->get('/contact', [HomeController::class, 'contact']);

// Admin
$router->get('/admin', [DashboardController::class, 'index']);
$router->get('/admin/login', [AuthController::class, 'login']);
$router->post('/admin/login', [AuthController::class, 'login']);
$router->get('/admin/logout', [AuthController::class, 'logout']);

// Dynamic location route
$router->get('/istanbul/{locationSlug}', [LocationController::class, 'show']);
