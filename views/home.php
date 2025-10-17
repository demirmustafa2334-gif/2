<?php
$db = new Database();
$conn = $db->getConnection();

// Get featured reviews
$stmt = $conn->prepare("SELECT * FROM reviews WHERE status = 1 ORDER BY created_at DESC LIMIT 6");
$stmt->execute();
$reviews = $stmt->fetchAll();

// Get recent blog posts
$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE status = 1 ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$blog_posts = $stmt->fetchAll();

$meta_title = getMetaTitle();
$meta_description = getMetaDescription();
$meta_keywords = 'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye, güvenli taşıma';

ob_start();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">İstanbul'da Güvenilir Nakliyat Hizmeti</h1>
                <p class="lead mb-4">Profesyonel ekibimiz ve modern araçlarımızla evden eve nakliyat işlemlerinizi güvenle gerçekleştiriyoruz. Tüm İstanbul ilçe ve semtlerinde hizmet veriyoruz.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/iletisim" class="btn btn-light btn-lg">
                        <i class="fas fa-phone me-2"></i>Ücretsiz Keşif
                    </a>
                    <a href="/fiyat-listesi" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calculator me-2"></i>Fiyat Hesapla
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="text-center">
                    <i class="fas fa-truck fa-10x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Neden Bizi Tercih Etmelisiniz?</h2>
                <p class="lead text-muted">Profesyonel hizmet anlayışımız ve müşteri memnuniyeti odaklı yaklaşımımızla fark yaratıyoruz.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Güvenli Taşımacılık</h4>
                    <p class="text-muted">Eşyalarınızı sigortalı araçlarımızla güvenle taşıyoruz. Tüm süreç boyunca koruma altındasınız.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Zamanında Teslimat</h4>
                    <p class="text-muted">Belirlenen saatte teslimat garantisi. Zamanınızı değerli görüyor, planlarınızı aksatmıyoruz.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Uygun Fiyatlar</h4>
                    <p class="text-muted">Şeffaf fiyatlandırma politikamızla sürpriz maliyetler yaşamazsınız. En uygun fiyat garantisi.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Uzman Ekip</h4>
                    <p class="text-muted">Deneyimli ve profesyonel ekibimizle her türlü taşımacılık ihtiyacınızı karşılıyoruz.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Tüm İstanbul</h4>
                    <p class="text-muted">İstanbul'un tüm ilçe ve semtlerinde hizmet veriyoruz. Size en yakın noktadayız.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="fw-bold mb-3">7/24 Destek</h4>
                    <p class="text-muted">Müşteri hizmetlerimiz 7/24 aktif. Her zaman yanınızdayız ve sorularınızı yanıtlıyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Uygun Fiyatlarımız</h2>
                <p class="lead text-muted">Şeffaf fiyatlandırma ile sürpriz maliyetler yaşamazsınız.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php
            $stmt = $conn->prepare("SELECT * FROM pricing ORDER BY estimated_price ASC LIMIT 3");
            $stmt->execute();
            $pricing = $stmt->fetchAll();
            
            foreach ($pricing as $price):
            ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $price['id'] * 100; ?>">
                <div class="price-card">
                    <h4 class="fw-bold mb-3"><?php echo sanitize($price['from_location']); ?> → <?php echo sanitize($price['to_location']); ?></h4>
                    <div class="price-amount"><?php echo formatPrice($price['estimated_price']); ?></div>
                    <p class="text-muted mb-4">Tahmini mesafe: <?php echo $price['distance_km']; ?> km</p>
                    <a href="/iletisim" class="btn btn-primary w-100">Teklif Al</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="/fiyat-listesi" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-list me-2"></i>Tüm Fiyatları Görüntüle
            </a>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<?php if (!empty($reviews)): ?>
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Müşterilerimizin Görüşleri</h2>
                <p class="lead text-muted">Hizmetlerimizden memnun kalan müşterilerimizin deneyimleri.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($reviews as $review): ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo $review['id'] * 100; ?>">
                <div class="review-card">
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="mb-3">"<?php echo sanitize($review['review_text']); ?>"</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fw-bold mb-0"><?php echo sanitize($review['customer_name']); ?></h6>
                            <small class="text-muted"><?php echo sanitize($review['location']); ?></small>
                        </div>
                        <small class="text-muted"><?php echo timeAgo($review['created_at']); ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="/musteri-yorumlari" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-star me-2"></i>Tüm Yorumları Görüntüle
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Blog Section -->
<?php if (!empty($blog_posts)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Blog</h2>
                <p class="lead text-muted">Nakliyat hakkında faydalı bilgiler ve ipuçları.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($blog_posts as $post): ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $post['id'] * 100; ?>">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo sanitize($post['title']); ?></h5>
                        <p class="card-text text-muted"><?php echo sanitize(substr($post['excerpt'], 0, 120)); ?>...</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted"><?php echo timeAgo($post['created_at']); ?></small>
                            <a href="/blog/<?php echo $post['slug']; ?>" class="btn btn-sm btn-outline-primary">Devamını Oku</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="/blog" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-blog me-2"></i>Tüm Yazıları Görüntüle
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-5 fw-bold mb-3">Hemen Teklif Alın!</h2>
                <p class="lead mb-4">Ücretsiz keşif ve fiyat teklifi için hemen iletişime geçin. Uzman ekibimiz size en uygun çözümü sunacak.</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="/iletisim" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-phone me-2"></i>Hemen Ara
                </a>
                <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', WHATSAPP_NUMBER); ?>" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'layout.php';
?>