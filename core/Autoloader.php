<?php
namespace Core;

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(function (string $class): void {
            $prefixes = [
                'Core\\' => __DIR__,
                'App\\Controllers\\' => dirname(__DIR__) . '/app/Controllers',
                'App\\Models\\' => dirname(__DIR__) . '/app/Models',
            ];

            foreach ($prefixes as $prefix => $baseDir) {
                $len = strlen($prefix);
                if (strncmp($prefix, $class, $len) !== 0) {
                    continue;
                }

                $relativeClass = substr($class, $len);
                $file = $baseDir . '/' . str_replace(['\\\', '\\'], '/', $relativeClass) . '.php';
                $file = str_replace('\\', '/', $file);
                if (is_file($file)) {
                    require $file;
                    return;
                }
            }
        });
    }
}
