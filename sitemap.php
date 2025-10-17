<?php
require_once 'config/database.php';
require_once 'config/config.php';

header('Content-Type: application/xml; charset=utf-8');

$database = new Database();
$db = $database->getConnection();

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Main Pages -->
    <url>
        <loc><?= SITE_URL ?></loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    <url>
        <loc><?= SITE_URL ?>/services</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc><?= SITE_URL ?>/pricing</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    
    <url>
        <loc><?= SITE_URL ?>/reviews</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    
    <url>
        <loc><?= SITE_URL ?>/blog</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>0.7</priority>
    </url>
    
    <url>
        <loc><?= SITE_URL ?>/contact</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    
    <!-- District Pages -->
    <?php
    $stmt = $db->prepare("SELECT slug, updated_at FROM districts WHERE status = 'active' ORDER BY name");
    $stmt->execute();
    $districts = $stmt->fetchAll();
    
    foreach ($districts as $district):
    ?>
    <url>
        <loc><?= SITE_URL ?>/istanbul/<?= $district['slug'] ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($district['updated_at'])) ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Neighborhood Pages -->
    <?php
    $stmt = $db->prepare("
        SELECT n.slug as neighborhood_slug, d.slug as district_slug, n.updated_at 
        FROM neighborhoods n 
        JOIN districts d ON n.district_id = d.id 
        WHERE n.status = 'active' AND d.status = 'active' 
        ORDER BY d.name, n.name
    ");
    $stmt->execute();
    $neighborhoods = $stmt->fetchAll();
    
    foreach ($neighborhoods as $neighborhood):
    ?>
    <url>
        <loc><?= SITE_URL ?>/istanbul/<?= $neighborhood['district_slug'] ?>/<?= $neighborhood['neighborhood_slug'] ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($neighborhood['updated_at'])) ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Blog Posts -->
    <?php
    $stmt = $db->prepare("SELECT slug, updated_at FROM blog_posts WHERE status = 'published' ORDER BY created_at DESC");
    $stmt->execute();
    $blogPosts = $stmt->fetchAll();
    
    foreach ($blogPosts as $post):
    ?>
    <url>
        <loc><?= SITE_URL ?>/blog/<?= $post['slug'] ?></loc>
        <lastmod><?= date('Y-m-d', strtotime($post['updated_at'])) ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>