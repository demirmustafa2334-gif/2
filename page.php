<?php
/**
 * Dynamic Page Handler
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// Get page slug from URL
$slug = isset($_GET['slug']) ? sanitize_input($_GET['slug']) : '';

if (empty($slug)) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Get page data
$page = new Page();
$pageData = $page->findBySlug($slug);

if (!$pageData || !$pageData['is_active']) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// SEO Meta Data
$pageTitle = $pageData['meta_title'] ?: $pageData['title'] . ' | ' . get_setting('site_title');
$pageDescription = $pageData['meta_description'] ?: get_setting('site_description');
$pageKeywords = $pageData['meta_keywords'] ?: '';

// Breadcrumb
$breadcrumb = [
    ['title' => 'Ana Sayfa', 'url' => SITE_URL],
    ['title' => $pageData['title'], 'url' => '']
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

<!-- Page Content -->
<section class="page-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="page-header text-center mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <?php echo htmlspecialchars($pageData['title']); ?>
                    </h1>
                </div>
                
                <div class="page-body">
                    <div class="content-text">
                        <?php echo nl2br(htmlspecialchars($pageData['content'])); ?>
                    </div>
                </div>
                
                <!-- Special content for specific pages -->
                <?php if ($slug === 'hizmetlerimiz'): ?>
                    <!-- Services Page Special Content -->
                    <div class="services-grid mt-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="service-detail p-4 border rounded">
                                    <i class="fas fa-home fa-3x text-primary mb-3"></i>
                                    <h4>Evden Eve Nakliyat</h4>
                                    <p>Profesyonel ekibimizle eşyalarınızı güvenle paketleyip yeni evinize taşıyoruz.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Profesyonel ambalajlama</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Sigortalı taşımacılık</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Montaj-demontaj hizmeti</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="service-detail p-4 border rounded">
                                    <i class="fas fa-building fa-3x text-success mb-3"></i>
                                    <h4>Ofis Taşımacılığı</h4>
                                    <p>İş yerinizi minimum kesinti ile güvenle yeni adresinize taşıyoruz.</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Hızlı taşıma</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Özel ambalajlama</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Kurulum hizmeti</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Districts List -->
                    <div class="districts-section mt-5">
                        <h3 class="text-center mb-4">Hizmet Verdiğimiz İlçeler</h3>
                        <?php
                        $district = new District();
                        $districts = $district->getActiveDistricts();
                        ?>
                        <div class="row g-3">
                            <?php foreach ($districts as $dist): ?>
                                <div class="col-md-3 col-sm-6">
                                    <a href="istanbul/<?php echo $dist['slug']; ?>" class="text-decoration-none">
                                        <div class="district-link p-3 border rounded text-center">
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            <?php echo htmlspecialchars($dist['name']); ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                <?php elseif ($slug === 'fiyat-listesi'): ?>
                    <!-- Pricing Page Special Content -->
                    <div class="pricing-section mt-5">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="pricing-card text-center p-4 border rounded">
                                    <i class="fas fa-home fa-3x text-primary mb-3"></i>
                                    <h4>Standart Ev</h4>
                                    <div class="price-range mb-3">
                                        <span class="h3 text-primary">500₺ - 800₺</span>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>1+1 - 2+1 daire</li>
                                        <li>Temel ambalajlama</li>
                                        <li>Standart taşıma</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pricing-card text-center p-4 border rounded">
                                    <i class="fas fa-building fa-3x text-success mb-3"></i>
                                    <h4>Büyük Ev</h4>
                                    <div class="price-range mb-3">
                                        <span class="h3 text-success">800₺ - 1200₺</span>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>3+1 - 4+1 daire</li>
                                        <li>Profesyonel ambalajlama</li>
                                        <li>Özel eşya taşıma</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pricing-card text-center p-4 border rounded">
                                    <i class="fas fa-warehouse fa-3x text-warning mb-3"></i>
                                    <h4>Villa/Ofis</h4>
                                    <div class="price-range mb-3">
                                        <span class="h3 text-warning">1200₺+</span>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li>Villa/Büyük ofis</li>
                                        <li>Premium hizmet</li>
                                        <li>Özel çözümler</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="fiyat-hesapla" class="btn btn-primary btn-lg">
                                <i class="fas fa-calculator me-2"></i>
                                Fiyat Hesapla
                            </a>
                        </div>
                    </div>
                    
                <?php elseif ($slug === 'musteri-yorumlari'): ?>
                    <!-- Reviews Page Special Content -->
                    <?php
                    $review = new Review();
                    $reviews = $review->getApprovedReviews();
                    $reviewStats = $review->getAverageRating();
                    ?>
                    
                    <div class="reviews-section mt-5">
                        <div class="text-center mb-5">
                            <div class="rating-display mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star text-warning fa-2x"></i>
                                <?php endfor; ?>
                            </div>
                            <h3 class="text-primary">
                                <?php echo number_format($reviewStats['avg_rating'], 1); ?>/5.0
                            </h3>
                            <p class="text-muted">
                                <?php echo $reviewStats['total_reviews']; ?> müşteri değerlendirmesi
                            </p>
                        </div>
                        
                        <div class="row g-4">
                            <?php foreach ($reviews as $review): ?>
                                <div class="col-md-6">
                                    <div class="review-card p-4 border rounded">
                                        <div class="review-rating mb-2">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <p class="review-text mb-3">
                                            "<?php echo htmlspecialchars($review['review_text']); ?>"
                                        </p>
                                        <div class="review-author">
                                            <strong><?php echo htmlspecialchars($review['customer_name']); ?></strong>
                                            <small class="text-muted ms-2">
                                                <?php echo date('d.m.Y', strtotime($review['created_at'])); ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                <?php elseif ($slug === 'iletisim'): ?>
                    <!-- Contact Page Special Content -->
                    <div class="contact-section mt-5">
                        <div class="row g-5">
                            <div class="col-lg-6">
                                <h3 class="mb-4">İletişim Bilgileri</h3>
                                <div class="contact-info">
                                    <div class="contact-item mb-4">
                                        <i class="fas fa-map-marker-alt fa-2x text-primary me-3"></i>
                                        <div>
                                            <h5>Adres</h5>
                                            <p class="text-muted mb-0">
                                                <?php echo get_setting('company_address'); ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="contact-item mb-4">
                                        <i class="fas fa-phone fa-2x text-success me-3"></i>
                                        <div>
                                            <h5>Telefon</h5>
                                            <p class="mb-0">
                                                <a href="tel:<?php echo get_setting('contact_phone'); ?>" 
                                                   class="text-decoration-none">
                                                    <?php echo get_setting('contact_phone'); ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="contact-item mb-4">
                                        <i class="fab fa-whatsapp fa-2x text-success me-3"></i>
                                        <div>
                                            <h5>WhatsApp</h5>
                                            <p class="mb-0">
                                                <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')'], '', get_setting('whatsapp_number')); ?>" 
                                                   target="_blank" class="text-decoration-none">
                                                    <?php echo get_setting('whatsapp_number'); ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="contact-item mb-4">
                                        <i class="fas fa-envelope fa-2x text-info me-3"></i>
                                        <div>
                                            <h5>E-posta</h5>
                                            <p class="mb-0">
                                                <a href="mailto:<?php echo get_setting('contact_email'); ?>" 
                                                   class="text-decoration-none">
                                                    <?php echo get_setting('contact_email'); ?>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <h3 class="mb-4">Mesaj Gönder</h3>
                                <form id="contactForm" class="needs-validation" novalidate>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Ad Soyad *</label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">E-posta *</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Telefon</label>
                                            <input type="tel" class="form-control" id="phone" name="phone">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="from_district" class="form-label">Nereden</label>
                                            <input type="text" class="form-control" id="from_district" name="from_district" 
                                                   placeholder="İlçe">
                                        </div>
                                        <div class="col-12">
                                            <label for="message" class="form-label">Mesaj *</label>
                                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fas fa-paper-plane me-2"></i>
                                                Mesaj Gönder
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                
                                <div id="contactResult" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                    document.getElementById('contactForm').addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const formData = new FormData(this);
                        const resultDiv = document.getElementById('contactResult');
                        
                        resultDiv.innerHTML = '<div class="alert alert-info">Mesaj gönderiliyor...</div>';
                        
                        fetch('iletisim-gonder', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                resultDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                                this.reset();
                            } else {
                                resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                            }
                        })
                        .catch(error => {
                            resultDiv.innerHTML = '<div class="alert alert-danger">Bir hata oluştu. Lütfen tekrar deneyin.</div>';
                        });
                    });
                    </script>
                <?php endif; ?>
                
                <!-- CTA Section -->
                <div class="cta-section mt-5 p-4 bg-primary text-white rounded">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="mb-2">Hemen Teklif Alın!</h4>
                            <p class="mb-0">
                                Profesyonel nakliyat hizmetlerimiz için ücretsiz keşif ve fiyat teklifi.
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="fiyat-hesapla" class="btn btn-warning btn-lg">
                                <i class="fas fa-calculator me-2"></i>
                                Fiyat Hesapla
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>