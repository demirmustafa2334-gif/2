<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

final class SitemapController extends Controller
{
    public function index(Request $request): string
    {
        header('Content-Type: application/xml; charset=utf-8');
        $base = $this->config['base_url'] ?: (($_SERVER['HTTPS'] ?? '') === 'on' ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost');
        $urls = [
            '/', '/hizmetler', '/fiyat-listesi', '/iletisim'
        ];
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls as $u) {
            $xml .= '<url><loc>' . htmlspecialchars($base . $u, ENT_QUOTES, 'UTF-8') . '</loc></url>';
        }
        $xml .= '</urlset>';
        return $xml;
    }

    public function robots(Request $request): string
    {
        header('Content-Type: text/plain; charset=utf-8');
        return "User-agent: *\nAllow: /\nSitemap: /sitemap.xml\n";
    }
}
