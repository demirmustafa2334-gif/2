<?php
/**
 * Şehir Detay Sayfası
 * Yereltanitim.com - Turkey Tourism Website
 */

require_once 'config/config.php';

// URL'den şehir slug'ını al
$slug = isset($_GET['slug']) ? sanitize_input($_GET['slug']) : '';

if (empty($slug)) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Şehir verilerini al
$city = new City();
$district = new District();
$blogPost = new BlogPost();

$cityData = $city->findBySlug($slug);

if (!$cityData || !$cityData['is_active']) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Şehir görüntüleme sayısını artır
$city->incrementViewCount($cityData['id']);

// Bu şehre ait ilçeleri al
$districts = $district->getDistrictsByCity($cityData['id']);

// Bu şehir hakkındaki blog yazılarını al
$cityPosts = $blogPost->getPostsByCity($cityData['id'], 6);

// İlgili şehirleri al
$relatedCities = $city->getRandomCities(4, $cityData['id']);

// SEO Meta Verileri
$pageTitle = $cityData['meta_title'] ?: $cityData['name'] . ' Rehberi | Yereltanitim.com';
$pageDescription = $cityData['meta_description'] ?: $cityData['name'] . ' ili hakkında detaylı bilgiler. Turistik yerler, yerel lezzetler ve kültürel özellikler.';
$pageKeywords = $cityData['meta_keywords'] ?: $cityData['name'] . ', turizm, gezi rehberi, yerel lezzetler, kültür, yereltanitim.com';

// Breadcrumb
$breadcrumb = [
    ['title' => 'Ana Sayfa', 'url' => SITE_URL],
    ['title' => 'Şehirler', 'url' => 'sehirler.php'],
    ['title' => $cityData['name'], 'url' => '']
];

// Structured Data
$structuredData = [
    "@context" => "https://schema.org",
    "@type" => "Place",
    "name" => $cityData['name'],
    "description" => $cityData['description'],
    "url" => SITE_URL . '/sehir/' . $cityData['slug'],
    "address" => [
        "@type" => "PostalAddress",
        "addressRegion" => $cityData['name'],
        "addressCountry" => "TR"
    ],
    "geo" => [
        "@type" => "GeoCoordinates",
        "latitude" => 41.0082,
        "longitude" => 28.9784
    ],
    "touristType" => ["Families", "Business", "Cultural"],
    "hasMap" => "https://www.google.com/maps/search/" . urlencode($cityData['name'] . " Turkey")
];

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <?php foreach ($breadcrumb as $item): ?>
                    <?php if (empty($item['url'])): ?>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo $item['url']; ?>">
                                <?php echo htmlspecialchars($item['title']); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </nav>
    </div>
</section>

<!-- Şehir Hero Section -->
<section class="city-hero py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="city-intro">
                    <div class="city-header mb-4">
                        <h1 class="display-4 fw-bold text-primary mb-3">
                            <?php echo htmlspecialchars($cityData['name']); ?>
                        </h1>
                        <div class="city-meta">
                            <span class="badge bg-primary me-2">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                <?php echo htmlspecialchars($cityData['region']); ?> Bölgesi
                            </span>
                            <span class="badge bg-secondary me-2">
                                <i class="fas fa-hashtag me-1"></i>
                                Plaka: <?php echo $cityData['plate_code']; ?>
                            </span>
                            <?php if ($cityData['population']): ?>
                                <span class="badge bg-info">
                                    <i class="fas fa-users me-1"></i>
                                    <?php echo number_format($cityData['population']); ?> kişi
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if ($cityData['description']): ?>
                        <div class="city-description">
                            <p class="lead">
                                <?php echo nl2br(htmlspecialchars($cityData['description'])); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="city-image-container">
                    <?php if ($cityData['featured_image']): ?>
                        <img src="<?php echo UPLOAD_URL . $cityData['featured_image']; ?>" 
                             alt="<?php echo htmlspecialchars($cityData['name']); ?>" 
                             class="img-fluid rounded shadow">
                    <?php else: ?>
                        <div class="city-placeholder-large">
                            <i class="fas fa-city fa-5x text-primary"></i>
                            <h4 class="mt-3"><?php echo htmlspecialchars($cityData['name']); ?></h4>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Şehir Özellikleri -->
<section class="city-features py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <?php if ($cityData['tourist_attractions']): ?>
                <div class="col-lg-4">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="fas fa-camera text-primary"></i>
                        </div>
                        <h4>Turistik Yerler</h4>
                        <p><?php echo nl2br(htmlspecialchars($cityData['tourist_attractions'])); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($cityData['local_cuisine']): ?>
                <div class="col-lg-4">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="fas fa-utensils text-success"></i>
                        </div>
                        <h4>Yerel Lezzetler</h4>
                        <p><?php echo nl2br(htmlspecialchars($cityData['local_cuisine'])); ?></p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($cityData['cultural_highlights']): ?>
                <div class="col-lg-4">
                    <div class="feature-card h-100">
                        <div class="feature-icon">
                            <i class="fas fa-theater-masks text-warning"></i>
                        </div>
                        <h4>Kültürel Özellikler</h4>
                        <p><?php echo nl2br(htmlspecialchars($cityData['cultural_highlights'])); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- İlçeler -->
<?php if (!empty($districts)): ?>
<section class="city-districts py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo htmlspecialchars($cityData['name']); ?> İlçeleri</h2>
                <p class="section-subtitle">Şehrimizin tüm ilçelerini keşfedin</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($districts as $district): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="district-card">
                        <div class="district-content">
                            <h5><?php echo htmlspecialchars($district['name']); ?></h5>
                            <?php if ($district['description']): ?>
                                <p class="district-description">
                                    <?php echo truncate_text($district['description'], 120); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if ($district['specialties']): ?>
                                <div class="district-specialties mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-star text-warning"></i>
                                        <?php echo truncate_text($district['specialties'], 80); ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                            
                            <a href="ilce/<?php echo $district['slug']; ?>" class="btn btn-primary btn-sm">
                                Detayları Gör
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Blog Yazıları -->
<?php if (!empty($cityPosts)): ?>
<section class="city-posts py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo htmlspecialchars($cityData['name']); ?> Hakkında Yazılar</h2>
                <p class="section-subtitle">Şehrimiz hakkında detaylı rehberler ve öneriler</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($cityPosts as $post): ?>
                <div class="col-lg-4 col-md-6">
                    <article class="blog-card">
                        <div class="blog-image">
                            <?php if ($post['featured_image']): ?>
                                <img src="<?php echo UPLOAD_URL . $post['featured_image']; ?>" 
                                     alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <?php else: ?>
                                <div class="blog-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="blog-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo format_date($post['created_at']); ?>
                                </span>
                                <span class="blog-views">
                                    <i class="fas fa-eye"></i>
                                    <?php echo $post['view_count']; ?>
                                </span>
                            </div>
                            <h5 class="blog-title">
                                <a href="blog/<?php echo $post['slug']; ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h5>
                            <p class="blog-excerpt">
                                <?php echo htmlspecialchars($post['excerpt']); ?>
                            </p>
                            <a href="blog/<?php echo $post['slug']; ?>" class="btn btn-outline-primary btn-sm">
                                Devamını Oku
                            </a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- İlgili Şehirler -->
<?php if (!empty($relatedCities)): ?>
<section class="related-cities py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Diğer Şehirler</h2>
                <p class="section-subtitle">Keşfetmeye değer diğer destinasyonlar</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($relatedCities as $relatedCity): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="city-card">
                        <div class="city-image">
                            <?php if ($relatedCity['featured_image']): ?>
                                <img src="<?php echo UPLOAD_URL . $relatedCity['featured_image']; ?>" 
                                     alt="<?php echo htmlspecialchars($relatedCity['name']); ?>">
                            <?php else: ?>
                                <div class="city-placeholder">
                                    <i class="fas fa-city"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="city-content">
                            <h5><?php echo htmlspecialchars($relatedCity['name']); ?></h5>
                            <p class="city-region"><?php echo htmlspecialchars($relatedCity['region']); ?> Bölgesi</p>
                            <p><?php echo truncate_text($relatedCity['description'], 80); ?></p>
                            <a href="sehir/<?php echo $relatedCity['slug']; ?>" class="btn btn-outline-primary btn-sm">
                                Keşfet
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<style>
.city-hero {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.city-meta .badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.city-image-container {
    position: relative;
}

.city-placeholder-large {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 3rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.feature-card h4 {
    color: var(--dark-color);
    margin-bottom: 1rem;
    font-weight: 600;
}

.feature-card p {
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .city-hero .display-4 {
        font-size: 2.5rem;
    }
    
    .city-meta .badge {
        display: block;
        margin-bottom: 0.5rem;
        margin-right: 0 !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>