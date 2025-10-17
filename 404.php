<?php
/**
 * 404 Error Page
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// SEO Meta Data
$pageTitle = '404 - Sayfa Bulunamadı | ' . get_setting('site_title');
$pageDescription = 'Aradığınız sayfa bulunamadı. Ana sayfaya dönün veya menüden istediğiniz sayfaya ulaşın.';

http_response_code(404);

include 'includes/header.php';
?>

<!-- 404 Error Section -->
<section class="error-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="error-content">
                    <div class="error-code mb-4">
                        <h1 class="display-1 fw-bold text-primary">404</h1>
                    </div>
                    
                    <div class="error-message mb-5">
                        <h2 class="h3 mb-3">Sayfa Bulunamadı</h2>
                        <p class="lead text-muted mb-4">
                            Üzgünüz, aradığınız sayfa mevcut değil veya taşınmış olabilir.
                        </p>
                    </div>
                    
                    <div class="error-actions mb-5">
                        <a href="<?php echo SITE_URL; ?>" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-home me-2"></i>
                            Ana Sayfaya Dön
                        </a>
                        <a href="iletisim" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-envelope me-2"></i>
                            İletişime Geç
                        </a>
                    </div>
                    
                    <!-- Popular Links -->
                    <div class="popular-links">
                        <h4 class="mb-4">Popüler Sayfalar</h4>
                        <div class="row g-3">
                            <div class="col-md-3 col-sm-6">
                                <a href="hizmetlerimiz" class="d-block p-3 border rounded text-decoration-none">
                                    <i class="fas fa-cogs text-primary mb-2"></i>
                                    <div>Hizmetlerimiz</div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="fiyat-hesapla" class="d-block p-3 border rounded text-decoration-none">
                                    <i class="fas fa-calculator text-success mb-2"></i>
                                    <div>Fiyat Hesapla</div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="musteri-yorumlari" class="d-block p-3 border rounded text-decoration-none">
                                    <i class="fas fa-star text-warning mb-2"></i>
                                    <div>Müşteri Yorumları</div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="blog" class="d-block p-3 border rounded text-decoration-none">
                                    <i class="fas fa-blog text-info mb-2"></i>
                                    <div>Blog</div>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Districts -->
                    <div class="districts-section mt-5">
                        <h4 class="mb-4">İlçelerimiz</h4>
                        <?php
                        $district = new District();
                        $districts = $district->findAll('is_active = 1', 'name ASC', 8);
                        ?>
                        <div class="row g-2">
                            <?php foreach ($districts as $dist): ?>
                                <div class="col-md-3 col-sm-6">
                                    <a href="istanbul/<?php echo $dist['slug']; ?>" 
                                       class="d-block p-2 border rounded text-decoration-none small">
                                        <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                        <?php echo htmlspecialchars($dist['name']); ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="contact-cta bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-2">Yardıma mı İhtiyacınız Var?</h3>
                <p class="mb-0">
                    Aradığınızı bulamadıysanız, bizimle iletişime geçin. 
                    Size yardımcı olmaktan memnuniyet duyarız.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex flex-column gap-2">
                    <a href="tel:<?php echo get_setting('contact_phone'); ?>" 
                       class="btn btn-warning btn-lg">
                        <i class="fas fa-phone me-2"></i>
                        <?php echo get_setting('contact_phone'); ?>
                    </a>
                    <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')'], '', get_setting('whatsapp_number')); ?>" 
                       target="_blank" class="btn btn-success btn-lg">
                        <i class="fab fa-whatsapp me-2"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.error-code {
    position: relative;
}

.error-code::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, rgba(52, 152, 219, 0.1) 0%, rgba(155, 89, 182, 0.1) 100%);
    border-radius: 50%;
    z-index: -1;
}

.popular-links a:hover,
.districts-section a:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .error-code h1 {
        font-size: 6rem;
    }
    
    .error-actions .btn {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>