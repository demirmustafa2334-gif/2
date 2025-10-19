<?php
declare(strict_types=1);

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\CityController;
use App\Controllers\DistrictController;
use App\Controllers\BlogController;
use App\Controllers\ContactController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\CityAdminController;
use App\Controllers\Admin\DistrictAdminController;
use App\Controllers\Admin\PostAdminController;
use App\Controllers\Admin\MessageAdminController;

/** @var Router $router */

$router->get('/', [HomeController::class, 'index']);
$router->get('/blog', [BlogController::class, 'index']);
$router->get('/blog/{slug}', [BlogController::class, 'show']);
$router->get('/iletisim', [ContactController::class, 'index']);
$router->post('/iletisim', [ContactController::class, 'submit']);

$router->get('/il/{citySlug}', [CityController::class, 'show']);
$router->get('/il/{citySlug}/{districtSlug}', [DistrictController::class, 'show']);

// Admin
$router->get('/admin', [DashboardController::class, 'index']);
$router->get('/admin/login', [AuthController::class, 'login']);
$router->post('/admin/login', [AuthController::class, 'login']);
$router->get('/admin/logout', [AuthController::class, 'logout']);

$router->get('/admin/sehirler', [CityAdminController::class, 'index']);
$router->post('/admin/sehirler', [CityAdminController::class, 'store']);
$router->get('/admin/ilceler', [DistrictAdminController::class, 'index']);
$router->post('/admin/ilceler', [DistrictAdminController::class, 'store']);
$router->get('/admin/yazilar', [PostAdminController::class, 'index']);
$router->post('/admin/yazilar', [PostAdminController::class, 'store']);
$router->post('/admin/yazilar/ai', [PostAdminController::class, 'generateWithAI']);
$router->get('/admin/mesajlar', [MessageAdminController::class, 'index']);
