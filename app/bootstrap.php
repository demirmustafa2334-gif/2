<?php
declare(strict_types=1);

use App\Core\Autoloader;
use App\Core\DB;
use App\Core\Router;

const ROOT_PATH = __DIR__ . '/..';
const APP_PATH = __DIR__;
const CONFIG_PATH = ROOT_PATH . '/config';
const PUBLIC_PATH = ROOT_PATH . '/public';
const STORAGE_PATH = ROOT_PATH . '/storage';

require APP_PATH . '/Core/Autoloader.php';
Autoloader::register([
    'App\\' => APP_PATH . '/',
]);

$appConfig = require CONFIG_PATH . '/app.php';
$dbConfig = require CONFIG_PATH . '/database.php';

error_reporting(E_ALL);
ini_set('display_errors', $appConfig['debug'] ? '1' : '0');

if (session_status() === PHP_SESSION_NONE) { session_start(); }

DB::init($dbConfig);

$router = new Router($appConfig);
require APP_PATH . '/routes.php';
return $router;
