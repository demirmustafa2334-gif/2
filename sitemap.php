<?php
/**
 * XML Sitemap Generator
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

header('Content-Type: application/xml; charset=utf-8');

// Initialize models
$district = new District();
$neighborhood = new Neighborhood();
$page = new Page();
$blogPost = new BlogPost();

// Get all active content
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

    <!-- Homepage -->
    <url>
        <loc><?php echo SITE_URL; ?></loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Static Pages -->
    <?php foreach ($pages as $page): ?>
    <url>
        <loc><?php echo SITE_URL . '/' . $page['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($page['updated_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>

    <!-- District Pages -->
    <?php foreach ($districts as $district): ?>
    <url>
        <loc><?php echo SITE_URL . '/istanbul/' . $district['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($district['updated_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>

    <!-- Neighborhood Pages -->
    <?php foreach ($neighborhoods as $neighborhood): ?>
    <url>
        <loc><?php echo SITE_URL . '/mahalle/' . $neighborhood['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($neighborhood['updated_at'])); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>

    <!-- Blog Posts -->
    <?php foreach ($blogPosts as $post): ?>
    <url>
        <loc><?php echo SITE_URL . '/blog/' . $post['slug']; ?></loc>
        <lastmod><?php echo date('c', strtotime($post['updated_at'])); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>

    <!-- Price Calculator -->
    <url>
        <loc><?php echo SITE_URL; ?>/fiyat-hesapla</loc>
        <lastmod><?php echo date('c'); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

</urlset>