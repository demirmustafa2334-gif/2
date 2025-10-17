<?php include __DIR__ . '/header.php'; ?>

<!-- Hero Section -->
<section class="hero bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">İstanbul'da Güvenilir Nakliyat Hizmetleri</h1>
                <p class="lead mb-4">Profesyonel ekibimiz ve modern araçlarımızla eşyalarınızı güvenle taşıyoruz. Uygun fiyatlar, sigortalı taşıma ve %100 müşteri memnuniyeti garantisi.</p>
                <div class="d-flex gap-3">
                    <a href="<?php echo SITE_URL; ?>/iletisim" class="btn btn-light btn-lg">
                        <i class="fas fa-phone"></i> Hemen Teklif Alın
                    </a>
                    <a href="<?php echo SITE_URL; ?>/fiyatlar" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calculator"></i> Fiyat Hesapla
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="<?php echo SITE_URL; ?>/public/assets/images/hero-truck.svg" alt="Nakliyat" class="img-fluid" onerror="this.style.display='none'">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="feature-box">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h4>Sigortalı Taşıma</h4>
                    <p>Eşyalarınız tam sigortayla korunur</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="feature-box">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h4>Profesyonel Ekip</h4>
                    <p>Deneyimli ve eğitimli personel</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="feature-box">
                    <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                    <h4>7/24 Hizmet</h4>
                    <p>Her zaman hizmetinizdeyiz</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="feature-box">
                    <i class="fas fa-money-bill-wave fa-3x text-primary mb-3"></i>
                    <h4>Uygun Fiyat</h4>
                    <p>Rekabetçi ve şeffaf fiyatlandırma</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Hizmetlerimiz</h2>
            <p class="text-muted">İstanbul genelinde sunduğumuz profesyonel taşımacılık hizmetleri</p>
        </div>
        
        <div class="row">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card service-card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="<?php echo $service['icon'] ?? 'fas fa-box'; ?> fa-3x text-primary mb-3"></i>
                            <h5 class="card-title"><?php echo $service['title']; ?></h5>
                            <p class="card-text"><?php echo $service['short_description']; ?></p>
                            <a href="<?php echo SITE_URL; ?>/hizmet/<?php echo $service['slug']; ?>" class="btn btn-outline-primary">
                                Detaylı Bilgi
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/hizmetler" class="btn btn-primary">Tüm Hizmetleri Gör</a>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<?php if (!empty($reviews)): ?>
<section class="reviews py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Müşterilerimiz Ne Diyor?</h2>
            <p class="text-muted">Binlerce mutlu müşterimizden bazı yorumlar</p>
        </div>
        
        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($reviews as $index => $review): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card border-0 shadow">
                                <div class="card-body p-4 text-center">
                                    <div class="mb-3">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="card-text fst-italic">"<?php echo $review['review_text']; ?>"</p>
                                    <p class="fw-bold mb-0">- <?php echo $review['customer_name']; ?></p>
                                    <p class="text-muted small"><?php echo $review['service_type']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($reviews) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
            </button>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/yorumlar" class="btn btn-primary">Tüm Yorumları Gör</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="cta py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Ücretsiz Fiyat Teklifi Almak İster Misiniz?</h2>
        <p class="lead mb-4">Size en uygun fiyatı sunmak için hemen iletişime geçin!</p>
        <a href="<?php echo SITE_URL; ?>/iletisim" class="btn btn-light btn-lg">
            <i class="fas fa-phone"></i> Hemen Ara
        </a>
    </section>

<?php include __DIR__ . '/footer.php'; ?>
