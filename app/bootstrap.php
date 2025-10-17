<?php
declare(strict_types=1);

use App\Core\Autoloader;
use App\Core\DB;
use App\Core\Router;

// Define base paths
const ROOT_PATH = __DIR__ . '/..';
const APP_PATH = __DIR__;
const CONFIG_PATH = ROOT_PATH . '/config';
const PUBLIC_PATH = ROOT_PATH . '/public';
const STORAGE_PATH = ROOT_PATH . '/storage';

// Composer-less PSR-4 autoload
require APP_PATH . '/Core/Autoloader.php';
Autoloader::register([
    'App\\' => APP_PATH . '/',
]);

// Load app config
$appConfig = require CONFIG_PATH . '/app.php';
$dbConfig = require CONFIG_PATH . '/database.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', $appConfig['debug'] ? '1' : '0');

// Start session early for CSRF/auth later
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize DB (safe even if credentials are placeholders)
DB::init($dbConfig);

// Initialize router and load routes
$router = new Router($appConfig);
require APP_PATH . '/routes.php';

return $router;
