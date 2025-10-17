<?php
/**
 * XML Sitemap Generator
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// Set content type to XML
header('Content-Type: application/xml; charset=utf-8');

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Include models
require_once 'models/DistrictModel.php';
require_once 'models/NeighborhoodModel.php';
require_once 'models/BlogModel.php';

// Initialize models
$districtModel = new DistrictModel($db);
$neighborhoodModel = new NeighborhoodModel($db);
$blogModel = new BlogModel($db);

// Get all data
$districts = $districtModel->getActiveDistricts();
$neighborhoods = $neighborhoodModel->getAllActiveNeighborhoods();
$blogPosts = $blogModel->getAllPosts();

// Static pages
$staticPages = [
    ['url' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
    ['url' => '/hizmetlerimiz', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['url' => '/fiyat-listesi', 'priority' => '0.8', 'changefreq' => 'weekly'],
    ['url' => '/musteri-yorumlari', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['url' => '/blog', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['url' => '/iletisim', 'priority' => '0.6', 'changefreq' => 'monthly'],
    ['url' => '/teklif-al', 'priority' => '0.9', 'changefreq' => 'weekly']
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($staticPages as $page): ?>
    <url>
        <loc><?php echo SITE_URL . $page['url']; ?></loc>
        <lastmod><?php echo date('Y-m-d'); ?></lastmod>
        <changefreq><?php echo $page['changefreq']; ?></changefreq>
        <priority><?php echo $page['priority']; ?></priority>
    </url>
    <?php endforeach; ?>
    
    <?php foreach ($districts as $district): ?>
    <url>
        <loc><?php echo SITE_URL; ?>/istanbul/<?php echo $district['slug']; ?>-evden-eve-nakliyat</loc>
        <lastmod><?php echo date('Y-m-d', strtotime($district['updated_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    
    <?php foreach ($neighborhoods as $neighborhood): ?>
    <url>
        <loc><?php echo SITE_URL; ?>/istanbul/<?php echo $neighborhood['district_slug'] ?? 'district'; ?>/<?php echo $neighborhood['slug']; ?>-evden-eve-nakliyat</loc>
        <lastmod><?php echo date('Y-m-d', strtotime($neighborhood['updated_at'])); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>
    
    <?php foreach ($blogPosts as $post): ?>
    <?php if ($post['is_published']): ?>
    <url>
        <loc><?php echo SITE_URL; ?>/blog/<?php echo $post['slug']; ?></loc>
        <lastmod><?php echo date('Y-m-d', strtotime($post['updated_at'])); ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endif; ?>
    <?php endforeach; ?>
</urlset>