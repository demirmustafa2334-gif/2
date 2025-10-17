<?= '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Home -->
    <url>
        <loc><?= $baseUrl ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    
    <!-- Static Pages -->
    <url>
        <loc><?= $baseUrl ?>/hizmetlerimiz</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/fiyat-listesi</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/yorumlar</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/blog</loc>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= $baseUrl ?>/iletisim</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    
    <!-- Districts -->
    <?php foreach ($districts as $district): ?>
    <url>
        <loc><?= $baseUrl ?>/istanbul/<?= $district['slug'] ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Neighborhoods -->
    <?php foreach ($neighborhoods as $neighborhood): ?>
    <url>
        <loc><?= $baseUrl ?>/istanbul/<?= $neighborhood['slug'] ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Blog Posts -->
    <?php foreach ($blogPosts as $post): ?>
    <url>
        <loc><?= $baseUrl ?>/blog/<?= $post['slug'] ?></loc>
        <lastmod><?= date('c', strtotime($post['updated_at'])) ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <?php endforeach; ?>
    
    <!-- Custom Pages -->
    <?php foreach ($pages as $page): ?>
    <url>
        <loc><?= $baseUrl ?>/<?= $page['slug'] ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>
    <?php endforeach; ?>
</urlset>
