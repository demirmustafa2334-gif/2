<?php
/**
 * Ana Sayfa - Yereltanitim.com
 * Turkey Tourism Website
 */

require_once 'config/config.php';

// Ana sayfa verilerini al
$city = new City();
$blogPost = new BlogPost();
$district = new District();

$popularCities = $city->getPopularCities(8);
$featuredPosts = $blogPost->getFeaturedPosts(6);
$recentPosts = $blogPost->getRecentPosts(4);
$popularDistricts = $district->getPopularDistricts(6);

// SEO Meta Verileri
$pageTitle = get_setting('site_title');
$pageDescription = get_setting('site_description');
$pageKeywords = 'Türkiye turizm, şehir rehberi, yerel lezzetler, turistik yerler, kültür, gezi rehberi';

include 'includes/header.php';
?>

<!-- Ana Banner Bölümü -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="hero-title">Türkiye'nin En Kapsamlı Turizm Rehberi</h1>
                    <p class="hero-subtitle">
                        81 il, binlerce ilçe, eşsiz lezzetler ve kültürel zenginlikler. 
                        Türkiye'yi keşfetmenin en güzel yolu burada başlıyor.
                    </p>
                    <div class="hero-search">
                        <form action="arama.php" method="GET" class="search-form">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Şehir, ilçe veya turistik yer arayın...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> Ara
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popüler Şehirler -->
<section class="popular-cities py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Popüler Şehirler</h2>
                <p class="section-subtitle">En çok ziyaret edilen ve merak edilen şehirlerimiz</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($popularCities as $city): ?>
                <div class="col-lg-3 col-md-6">
                    <div class="city-card">
                        <div class="city-image">
                            <?php if ($city['featured_image']): ?>
                                <img src="<?php echo UPLOAD_URL . $city['featured_image']; ?>" alt="<?php echo htmlspecialchars($city['name']); ?>">
                            <?php else: ?>
                                <div class="city-placeholder">
                                    <i class="fas fa-city"></i>
                                </div>
                            <?php endif; ?>
                            <div class="city-overlay">
                                <div class="city-info">
                                    <h4><?php echo htmlspecialchars($city['name']); ?></h4>
                                    <p class="city-region"><?php echo htmlspecialchars($city['region']); ?> Bölgesi</p>
                                    <div class="city-stats">
                                        <span class="stat-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <?php echo $city['district_count'] ?? 0; ?> İlçe
                                        </span>
                                        <?php if (isset($city['blog_count']) && $city['blog_count'] > 0): ?>
                                            <span class="stat-item">
                                                <i class="fas fa-newspaper"></i>
                                                <?php echo $city['blog_count']; ?> Yazı
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="city-content">
                            <h5><?php echo htmlspecialchars($city['name']); ?></h5>
                            <p><?php echo truncate_text($city['description'], 100); ?></p>
                            <a href="sehir/<?php echo $city['slug']; ?>" class="btn btn-outline-primary btn-sm">
                                Keşfet <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="sehirler.php" class="btn btn-primary btn-lg">
                Tüm Şehirleri Görüntüle
            </a>
        </div>
    </div>
</section>

<!-- Öne Çıkan Yazılar -->
<?php if (!empty($featuredPosts)): ?>
<section class="featured-posts py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Öne Çıkan Yazılar</h2>
                <p class="section-subtitle">En popüler ve güncel turizm rehberlerimiz</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredPosts as $post): ?>
                <div class="col-lg-4 col-md-6">
                    <article class="blog-card">
                        <div class="blog-image">
                            <?php if ($post['featured_image']): ?>
                                <img src="<?php echo UPLOAD_URL . $post['featured_image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <?php else: ?>
                                <div class="blog-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>
                            <div class="blog-category">
                                <span class="badge bg-primary">Öne Çıkan</span>
                            </div>
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

<!-- Popüler İlçeler -->
<?php if (!empty($popularDistricts)): ?>
<section class="popular-districts py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Popüler İlçeler</h2>
                <p class="section-subtitle">En çok merak edilen ilçeler ve bölgeler</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($popularDistricts as $district): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="district-card">
                        <div class="district-content">
                            <div class="district-header">
                                <h5><?php echo htmlspecialchars($district['name']); ?></h5>
                                <span class="district-city"><?php echo htmlspecialchars($district['city_name']); ?></span>
                            </div>
                            <p class="district-description">
                                <?php echo truncate_text($district['description'], 120); ?>
                            </p>
                            <?php if (!empty($district['specialties'])): ?>
                                <div class="district-specialties">
                                    <small class="text-muted">
                                        <i class="fas fa-star"></i>
                                        <?php echo truncate_text($district['specialties'], 80); ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                            <div class="district-footer">
                                <a href="ilce/<?php echo $district['slug']; ?>" class="btn btn-primary btn-sm">
                                    Keşfet
                                </a>
                                <?php if (isset($district['blog_count']) && $district['blog_count'] > 0): ?>
                                    <span class="blog-count">
                                        <i class="fas fa-newspaper"></i>
                                        <?php echo $district['blog_count']; ?> yazı
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Son Yazılar -->
<?php if (!empty($recentPosts)): ?>
<section class="recent-posts py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Son Yazılar</h2>
                <p class="section-subtitle">En güncel turizm rehberleri ve öneriler</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($recentPosts as $post): ?>
                <div class="col-lg-6">
                    <article class="recent-post-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="recent-post-image">
                                    <?php if ($post['featured_image']): ?>
                                        <img src="<?php echo UPLOAD_URL . $post['featured_image']; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
                                    <?php else: ?>
                                        <div class="post-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="recent-post-content">
                                    <div class="post-meta">
                                        <span class="post-date">
                                            <?php echo format_date($post['created_at']); ?>
                                        </span>
                                    </div>
                                    <h6 class="post-title">
                                        <a href="blog/<?php echo $post['slug']; ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h6>
                                    <p class="post-excerpt">
                                        <?php echo truncate_text($post['excerpt'], 100); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="blog.php" class="btn btn-primary">
                Tüm Yazıları Görüntüle
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Bölümü -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="cta-title">Türkiye'yi Keşfetmeye Hazır mısınız?</h2>
                <p class="cta-subtitle">
                    Binlerce şehir ve ilçe, eşsiz lezzetler, tarihi mekanlar ve kültürel zenginlikler sizi bekliyor.
                </p>
                <div class="cta-buttons">
                    <a href="sehirler.php" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Şehirleri Keşfet
                    </a>
                    <a href="blog.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-newspaper me-2"></i>
                        Rehberleri Oku
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>