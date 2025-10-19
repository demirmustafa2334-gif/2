<?php
/**
 * XML Site Haritası Oluşturucu
 * Yerel Tanıtım - Özel PHP Scripti
 */

require_once 'config/config.php';

header('Content-Type: application/xml; charset=utf-8');

// Modelleri başlat
$district = new District();
$neighborhood = new Neighborhood();
$page = new Page();
$blogPost = new BlogPost();

// Tüm aktif içerikleri al
$districts = $district->getDistrictsForSitemap();
$neighborhoods = $neighborhood->getNeighborhoodsForSitemap();
$pages = $page->getPagesForSitemap();
$blogPosts = $blogPost->getPostsForSitemap();

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <!-- Ana Sayfa -->
    <url>
        <loc><?php echo SITE_URL; ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Statik Sayfalar -->
    <?php foreach ($pages as $page): ?>
    <url>
        <loc><?php echo SITE_URL . '/' . $page['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($page['updated_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>

    <!-- İlçe Sayfaları -->
    <?php foreach ($districts as $district): ?>
    <url>
        <loc><?php echo SITE_URL . '/istanbul/' . $district['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($district['updated_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>

    <!-- Mahalle Sayfaları -->
    <?php foreach ($neighborhoods as $neighborhood): ?>
    <url>
        <loc><?php echo SITE_URL . '/mahalle/' . $neighborhood['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($neighborhood['updated_at'])); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>

    <!-- Blog Yazıları -->
    <?php foreach ($blogPosts as $post): ?>
    <url>
        <loc><?php echo SITE_URL . '/blog/' . $post['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($post['updated_at'])); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>

    <!-- Keşfet Sayfası -->
    <url>
        <loc><?php echo SITE_URL; ?>/kesfet</loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

</urlset>