<?php
declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

require APP_PATH . '/Core/Autoloader.php';
\App\Core\Autoloader::register(APP_PATH);

// Start session early for CSRF and auth
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$config = require APP_PATH . '/Config/app.php';

// Timezone
if (!empty($config['timezone'])) {
    date_default_timezone_set($config['timezone']);
} else {
    date_default_timezone_set('Europe/Istanbul');
}

$router = new \App\Core\Router($config);

// Register routes
require APP_PATH . '/Config/routes.php';

$request = new \App\Core\Request();

try {
    $router->dispatch($request);
} catch (\Throwable $e) {
    http_response_code(500);
    if (!empty($config['debug'])) {
        echo '<h1>Application Error</h1>';
        echo '<pre>' . htmlspecialchars($e->getMessage() . "\n\n" . $e->getTraceAsString(), ENT_QUOTES, 'UTF-8') . '</pre>';
    } else {
        echo 'An unexpected error occurred.';
    }
}
