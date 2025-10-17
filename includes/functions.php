<?php
// Utility functions

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function generateSlug($text) {
    $text = strtolower($text);
    $text = str_replace(['ç', 'ğ', 'ı', 'ö', 'ş', 'ü'], ['c', 'g', 'i', 'o', 's', 'u'], $text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

function formatPrice($price) {
    return number_format($price, 0, ',', '.') . ' ₺';
}

function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) return 'Az önce';
    if ($time < 3600) return floor($time/60) . ' dakika önce';
    if ($time < 86400) return floor($time/3600) . ' saat önce';
    if ($time < 2592000) return floor($time/86400) . ' gün önce';
    if ($time < 31536000) return floor($time/2592000) . ' ay önce';
    return floor($time/31536000) . ' yıl önce';
}

function isLoggedIn() {
    return isset($_SESSION[ADMIN_SESSION_KEY]) && $_SESSION[ADMIN_SESSION_KEY] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /admin/login');
        exit;
    }
}

function getMetaTitle($page = '', $location = '') {
    if ($location) {
        return ucfirst($location) . ' Evden Eve Nakliyat | ' . SITE_NAME;
    }
    if ($page) {
        return ucfirst($page) . ' | ' . SITE_NAME;
    }
    return DEFAULT_META_TITLE;
}

function getMetaDescription($page = '', $location = '') {
    if ($location) {
        return ucfirst($location) . ' bölgesinde profesyonel evden eve nakliyat hizmeti. Güvenli, hızlı ve uygun fiyatlı taşımacılık çözümleri.';
    }
    if ($page) {
        return DEFAULT_META_DESCRIPTION;
    }
    return DEFAULT_META_DESCRIPTION;
}

function generateBreadcrumb($items) {
    $breadcrumb = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';
    $breadcrumb .= '<li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>';
    
    foreach ($items as $item) {
        if (isset($item['url'])) {
            $breadcrumb .= '<li class="breadcrumb-item"><a href="' . $item['url'] . '">' . $item['title'] . '</a></li>';
        } else {
            $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page">' . $item['title'] . '</li>';
        }
    }
    
    $breadcrumb .= '</ol></nav>';
    return $breadcrumb;
}

function sendEmail($to, $subject, $message) {
    $headers = "From: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Reply-To: " . ADMIN_EMAIL . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    return mail($to, $subject, $message, $headers);
}

function generateSitemap() {
    $db = new Database();
    $conn = $db->getConnection();
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
    // Static pages
    $staticPages = [
        ['url' => SITE_URL, 'priority' => '1.0'],
        ['url' => SITE_URL . '/hizmetler', 'priority' => '0.8'],
        ['url' => SITE_URL . '/fiyat-listesi', 'priority' => '0.8'],
        ['url' => SITE_URL . '/musteri-yorumlari', 'priority' => '0.7'],
        ['url' => SITE_URL . '/blog', 'priority' => '0.7'],
        ['url' => SITE_URL . '/iletisim', 'priority' => '0.6']
    ];
    
    foreach ($staticPages as $page) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . $page['url'] . '</loc>' . "\n";
        $sitemap .= '<priority>' . $page['priority'] . '</priority>' . "\n";
        $sitemap .= '<changefreq>weekly</changefreq>' . "\n";
        $sitemap .= '</url>' . "\n";
    }
    
    // District pages
    $stmt = $conn->prepare("SELECT slug FROM districts WHERE status = 1");
    $stmt->execute();
    $districts = $stmt->fetchAll();
    
    foreach ($districts as $district) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . SITE_URL . '/istanbul/' . $district['slug'] . '</loc>' . "\n";
        $sitemap .= '<priority>0.9</priority>' . "\n";
        $sitemap .= '<changefreq>monthly</changefreq>' . "\n";
        $sitemap .= '</url>' . "\n";
    }
    
    // Neighborhood pages
    $stmt = $conn->prepare("SELECT slug FROM neighborhoods WHERE status = 1");
    $stmt->execute();
    $neighborhoods = $stmt->fetchAll();
    
    foreach ($neighborhoods as $neighborhood) {
        $sitemap .= '<url>' . "\n";
        $sitemap .= '<loc>' . SITE_URL . '/istanbul/' . $neighborhood['slug'] . '</loc>' . "\n";
        $sitemap .= '<priority>0.8</priority>' . "\n";
        $sitemap .= '<changefreq>monthly</changefreq>' . "\n";
        $sitemap .= '</url>' . "\n";
    }
    
    $sitemap .= '</urlset>';
    
    file_put_contents('sitemap.xml', $sitemap);
}
?>