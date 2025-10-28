<?php
declare(strict_types=1);

namespace App\Core;

final class Autoloader
{
    public static function register(string $appPath): void
    {
        spl_autoload_register(function (string $class) use ($appPath): void {
            if (strpos($class, 'App\\') !== 0) {
                return; // ignore non-App classes
            }
            $relative = substr($class, 4); // strip 'App\'
            $relativePath = str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';
            $file = $appPath . DIRECTORY_SEPARATOR . $relativePath;
            if (is_file($file)) {
                require $file;
            }
        });
    }
}
