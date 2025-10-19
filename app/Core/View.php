<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data=[], ?array $meta=null): string
    {
        $viewPath = APP_PATH . '/Views/' . ltrim($view,'/');
        $content = self::renderPhp($viewPath.'.php',$data);
        $layout = APP_PATH . '/Views/layouts/main.php';
        $site = require CONFIG_PATH . '/app.php';
        if (class_exists(Settings::class)) {
            $dyn = Settings::getAll(); if (!empty($dyn['site'])) { $site = array_replace_recursive($site,$dyn['site']); }
        }
        $md = array_merge($site['seo'] ?? [], $meta ?? []);
        $md['title'] = $md['title'] ?? $site['name'];
        return self::renderPhp($layout, ['content'=>$content,'meta'=>$md,'site'=>$site]);
    }
    private static function renderPhp(string $file,array $data=[]): string
    {
        if (!is_file($file)) { return '<p>Görünüm bulunamadı: '.htmlspecialchars($file).'</p>'; }
        extract($data, EXTR_SKIP); ob_start(); include $file; return (string)ob_get_clean();
    }
}
