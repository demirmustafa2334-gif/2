<?php
namespace Core;

class CSRF
{
    public static function token(): string
    {
        Session::start();
        $config = require dirname(__DIR__) . '/config/app.php';
        $key = $config['security']['csrf_token_key'] ?? 'csrf_token';
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = bin2hex(random_bytes(16));
        }
        return $_SESSION[$key];
    }

    public static function verify(string $token): bool
    {
        Session::start();
        $config = require dirname(__DIR__) . '/config/app.php';
        $key = $config['security']['csrf_token_key'] ?? 'csrf_token';
        return isset($_SESSION[$key]) && hash_equals($_SESSION[$key], $token);
    }
}
