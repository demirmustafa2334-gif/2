<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    /**
     * @param array<string,mixed> $data
     * @param array<string,string>|null $meta
     */
    public static function render(string $view, array $data = [], ?array $meta = null): string
    {
        $viewPath = APP_PATH . '/Views/' . ltrim($view, '/');
        $content = self::renderPhp($viewPath . '.php', $data);

        $layout = APP_PATH . '/Views/layouts/main.php';
        $siteConfig = require CONFIG_PATH . '/app.php';
        // Merge dynamic settings from DB (if present)
        if (class_exists(Settings::class)) {
            $dynamic = Settings::getAll();
            if (!empty($dynamic['site'])) {
                // Expecting keys: name, contact, seo, etc.
                $siteConfig = array_replace_recursive($siteConfig, $dynamic['site']);
            }
        }

        $metaDefaults = $siteConfig['seo'] ?? [];
        $metaData = array_merge($metaDefaults, $meta ?? []);
        $metaData['title'] = $metaData['title'] ?? $siteConfig['name'];

        return self::renderPhp($layout, [
            'content' => $content,
            'meta' => $metaData,
            'site' => $siteConfig,
        ]);
    }

    /** @param array<string,mixed> $data */
    private static function renderPhp(string $file, array $data = []): string
    {
        if (!is_file($file)) {
            return '<p>View not found: ' . htmlspecialchars($file) . '</p>';
        }
        extract($data, EXTR_SKIP);
        ob_start();
        include $file;
        return (string)ob_get_clean();
    }
}
