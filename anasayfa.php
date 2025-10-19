<?php
/**
 * Ana Sayfa - Yerel Tanıtım
 * Özel PHP Scripti
 */

require_once 'config/config.php';

// Ana sayfa verilerini al
$district = new District();
$review = new Review();
$blogPost = new BlogPost();

$featuredDistricts = $district->findAll('is_active = 1', 'name ASC', 8);
$featuredReviews = $review->getFeaturedReviews(6);
$recentBlogPosts = $blogPost->getRecentPosts(3);
$reviewStats = $review->getAverageRating();

// SEO Meta Verileri
$pageTitle = get_setting('site_title');
$pageDescription = get_setting('site_description');
$pageKeywords = 'yerel tanıtım, İstanbul tanıtım, bölgesel hizmetler, yerel işletmeler';

include 'includes/header.php';
?>

<!-- Ana Banner Bölümü -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    İstanbul'un En Kapsamlı Yerel Tanıtım Platformu
                </h1>
                <p class="lead mb-4">
                    Şehrimizin her köşesini keşfedin, yerel işletmeleri tanıyın ve 
                    bölgenizin tüm imkanlarından haberdar olun.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="fiyat-hesapla" class="btn btn-warning btn-lg">
                        <i class="fas fa-search me-2"></i>
                        Keşfetmeye Başla
                    </a>
                    <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Hemen Ara
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="assets/images/hero-istanbul.png" alt="İstanbul Yerel Tanıtım" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>
    </div>
</section>

<!-- Hizmetler Bölümü -->
<section class="services-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="section-title">Hizmetlerimiz</h2>
                <p class="text-muted">İstanbul'un her bölgesi için kapsamlı tanıtım hizmetleri</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-map-marked-alt fa-3x text-primary"></i>
                    </div>
                    <h4>Bölgesel Tanıtım</h4>
                    <p class="text-muted">
                        İstanbul'un tüm ilçe ve mahallelerini detaylı şekilde tanıtıyoruz. 
                        Her bölgenin özelliklerini keşfedin.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-store fa-3x text-success"></i>
                    </div>
                    <h4>Yerel İşletmeler</h4>
                    <p class="text-muted">
                        Bölgenizdeki en iyi işletmeleri keşfedin. 
                        Kaliteli hizmet veren yerel firmaları tanıyın.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-users fa-3x text-warning"></i>
                    </div>
                    <h4>Topluluk Rehberi</h4>
                    <p class="text-muted">
                        Yerel etkinlikler, topluluk aktiviteleri ve 
                        sosyal imkanlar hakkında güncel bilgiler.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- İlçeler Bölümü -->
<section class="districts-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="section-title">Tanıttığımız İlçeler</h2>
                <p class="text-muted">İstanbul'un tüm ilçeleri hakkında detaylı bilgiler</p>
            </div>
        </div>
        <div class="row g-3">
            <?php foreach ($featuredDistricts as $district): ?>
                <div class="col-md-3 col-sm-6">
                    <a href="istanbul/<?php echo $district['slug']; ?>" class="district-card d-block text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marker-alt text-primary mb-2"></i>
                                <h6 class="card-title mb-0"><?php echo htmlspecialchars($district['name']); ?> Rehberi</h6>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="hizmetlerimiz" class="btn btn-primary">
                Tüm İlçeleri Görüntüle
            </a>
        </div>
    </div>
</section>

<!-- Yorumlar Bölümü -->
<?php if (!empty($featuredReviews)): ?>
<section class="reviews-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="section-title">Kullanıcı Yorumları</h2>
                <div class="review-stats mb-3">
                    <div class="rating-display">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star text-warning"></i>
                        <?php endfor; ?>
                        <span class="ms-2">
                            <strong><?php echo number_format($reviewStats['avg_rating'], 1); ?></strong>
                            (<?php echo $reviewStats['total_reviews']; ?> değerlendirme)
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                        $chunks = array_chunk($featuredReviews, 3);
                        foreach ($chunks as $index => $chunk): 
                        ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <div class="row g-4">
                                    <?php foreach ($chunk as $review): ?>
                                        <div class="col-md-4">
                                            <div class="review-card p-4">
                                                <div class="review-rating mb-2">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <p class="review-text">
                                                    "<?php echo htmlspecialchars($review['review_text']); ?>"
                                                </p>
                                                <div class="review-author">
                                                    <strong><?php echo htmlspecialchars($review['customer_name']); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($chunks) > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#reviewsCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Bölümü -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-2">Bölgenizi Daha İyi Tanıyın!</h3>
                <p class="mb-0">Yaşadığınız veya ziyaret etmek istediğiniz bölge hakkında detaylı bilgi alın.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="iletisim" class="btn btn-warning btn-lg">
                    <i class="fas fa-envelope me-2"></i>
                    İletişime Geç
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Blog Bölümü -->
<?php if (!empty($recentBlogPosts)): ?>
<section class="blog-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="section-title">Blog</h2>
                <p class="text-muted">İstanbul hakkında faydalı bilgiler ve rehberler</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($recentBlogPosts as $post): ?>
                <div class="col-md-4">
                    <article class="blog-card">
                        <div class="card h-100 border-0 shadow-sm">
                            <?php if ($post['featured_image']): ?>
                                <img src="<?php echo UPLOAD_URL . $post['featured_image']; ?>" 
                                     class="card-img-top" alt="<?php echo htmlspecialchars($post['title']); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="blog/<?php echo $post['slug']; ?>" class="text-decoration-none">
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </a>
                                </h5>
                                <p class="card-text text-muted">
                                    <?php echo htmlspecialchars($post['excerpt']); ?>
                                </p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    <?php echo date('d.m.Y', strtotime($post['created_at'])); ?>
                                </small>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- WhatsApp Float Button -->
<div class="whatsapp-float">
    <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')'], '', get_setting('whatsapp_number')); ?>" 
       target="_blank" class="btn btn-success rounded-circle p-3">
        <i class="fab fa-whatsapp fa-2x"></i>
    </a>
</div>

<?php include 'includes/footer.php'; ?>