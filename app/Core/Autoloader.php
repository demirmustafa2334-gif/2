<?php
declare(strict_types=1);

namespace App\Core;

final class Autoloader
{
    /** @var array<string,string> */
    private static array $prefixes = [];

    /**
     * @param array<string,string> $prefixes
     */
    public static function register(array $prefixes): void
    {
        self::$prefixes = $prefixes + self::$prefixes;
        spl_autoload_register([self::class, 'autoload']);
    }

    private static function autoload(string $class): void
    {
        foreach (self::$prefixes as $prefix => $baseDir) {
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                continue;
            }
            $relativeClass = substr($class, $len);
            $file = rtrim($baseDir, '/\\') . '/' . str_replace('\\', '/', $relativeClass) . '.php';
            if (is_file($file)) {
                require $file;
                return;
            }
        }
    }
}
