<?php $content = ob_start(); ?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    İstanbul'un En Güvenilir Nakliyat Hizmeti
                </h1>
                <p class="lead mb-4">
                    İstanbul'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti. 
                    Güvenilir, hızlı ve uygun fiyatlı taşımacılık çözümleri.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/contact" class="btn btn-light btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        Hemen Teklif Al
                    </a>
                    <a href="/pricing" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calculator me-2"></i>
                        Fiyat Hesapla
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image">
                    <img src="/assets/images/hero-truck.jpg" alt="Nakliyat Kamyonu" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">Neden Bizi Tercih Etmelisiniz?</h2>
                <p class="lead text-muted">Profesyonel hizmet anlayışımız ve müşteri memnuniyeti odaklı yaklaşımımız</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-shield-alt fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Güvenli Taşımacılık</h5>
                    <p class="text-muted">Eşyalarınız sigortalı ve güvenli şekilde taşınır. Hiçbir zarar riski yoktur.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Hızlı Hizmet</h5>
                    <p class="text-muted">Zamanında teslimat garantisi. Acil taşınma ihtiyaçlarınız için 7/24 hizmet.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="feature-card text-center p-4 h-100">
                    <div class="feature-icon bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                        <i class="fas fa-dollar-sign fa-2x"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Uygun Fiyat</h5>
                    <p class="text-muted">Şeffaf fiyatlandırma, gizli ücret yok. En uygun fiyatlarla kaliteli hizmet.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Districts Section -->
<section class="districts-section bg-light py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">Hizmet Verdiğimiz İlçeler</h2>
                <p class="lead text-muted">İstanbul'un tüm ilçe ve semtlerinde hizmet veriyoruz</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($featured_districts as $district): ?>
            <div class="col-lg-4 col-md-6">
                <div class="district-card bg-white rounded shadow-sm p-4 h-100">
                    <h5 class="fw-bold mb-3">
                        <a href="/istanbul/<?= $district['slug'] ?>" class="text-decoration-none text-dark">
                            <?= $district['name'] ?> Nakliyat
                        </a>
                    </h5>
                    <p class="text-muted mb-3"><?= $district['description'] ?></p>
                    <a href="/istanbul/<?= $district['slug'] ?>" class="btn btn-outline-primary btn-sm">
                        Detayları Gör
                        <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="/services" class="btn btn-primary btn-lg">
                Tüm Hizmetlerimizi Görün
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">Müşteri Yorumları</h2>
                <p class="lead text-muted">Müşterilerimizin deneyimleri</p>
                
                <?php if ($average_rating): ?>
                <div class="rating-summary mb-4">
                    <div class="stars text-warning mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?= $i <= $average_rating['average_rating'] ? '' : '-o' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="h4 mb-0">
                        <strong><?= number_format($average_rating['average_rating'], 1) ?></strong>
                        <span class="text-muted">/ 5.0</span>
                        <small class="text-muted">(<?= $average_rating['total_reviews'] ?> değerlendirme)</small>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($reviews as $review): ?>
            <div class="col-lg-4 col-md-6">
                <div class="review-card bg-white rounded shadow-sm p-4 h-100">
                    <div class="review-header d-flex align-items-center mb-3">
                        <div class="review-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                            <?= strtoupper(substr($review['customer_name'], 0, 1)) ?>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold"><?= $review['customer_name'] ?></h6>
                            <div class="stars text-warning">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted"><?= $review['review_text'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="/reviews" class="btn btn-outline-primary btn-lg">
                Tüm Yorumları Görün
                <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Hemen Teklif Alın!</h3>
                <p class="lead mb-0">
                    Ücretsiz keşif ve fiyat teklifi için hemen bizimle iletişime geçin.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/contact" class="btn btn-light btn-lg">
                    <i class="fas fa-phone me-2"></i>
                    Hemen Ara
                </a>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include 'layouts/main.php'; ?>