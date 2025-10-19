<?php
namespace Core;

class SEO
{
    public static function meta(array $options = []): array
    {
        $defaults = [
            'title' => 'Istanbul Nakliyat',
            'description' => 'İstanbul içi profesyonel evden eve nakliyat ve ofis taşıma hizmetleri.',
            'url' => self::baseUrl($_SERVER['REQUEST_URI'] ?? '/'),
            'image' => self::baseUrl('/assets/images/og-default.jpg'),
            'type' => 'website',
        ];
        return array_merge($defaults, $options);
    }

    public static function baseUrl(string $path = ''): string
    {
        $config = require dirname(__DIR__) . '/config/app.php';
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $base = rtrim($config['base_url'] ?: ($scheme . '://' . $host), '/');
        $path = '/' . ltrim($path, '/');
        return $base . $path;
    }

    public static function breadcrumbs(array $items): string
    {
        // $items: [ ['name' => 'Anasayfa', 'url' => '/'], ... ]
        $json = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => []
        ];
        foreach ($items as $index => $item) {
            $json['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => self::baseUrl($item['url'] ?? '/')
            ];
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
