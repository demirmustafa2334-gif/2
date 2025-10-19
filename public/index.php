<?php
declare(strict_types=1);

$router = require __DIR__ . '/../app/bootstrap.php';

use App\Core\Request;

$request = Request::fromGlobals();
$response = $router->dispatch($request);
http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $k => $v) { header($k . ': ' . $v); }
echo $response->getBody();
