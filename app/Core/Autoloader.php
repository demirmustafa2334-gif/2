<?php
declare(strict_types=1);

namespace App\Core;

final class Autoloader
{
    private static array $prefixes = [];
    public static function register(array $prefixes): void
    {
        self::$prefixes = $prefixes + self::$prefixes;
        spl_autoload_register([self::class, 'autoload']);
    }
    private static function autoload(string $class): void
    {
        foreach (self::$prefixes as $prefix => $base) {
            $len = strlen($prefix);
            if (strncmp($class, $prefix, $len) !== 0) continue;
            $relative = substr($class, $len);
            $file = rtrim($base, '/\\') . '/' . str_replace('\\', '/', $relative) . '.php';
            if (is_file($file)) { require $file; return; }
        }
    }
}
