<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $metaTitle ?? DEFAULT_META_TITLE ?></title>
    <meta name="description" content="<?= $metaDescription ?? DEFAULT_META_DESCRIPTION ?>">
    <meta name="keywords" content="<?= $metaKeywords ?? DEFAULT_META_KEYWORDS ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= $metaTitle ?? DEFAULT_META_TITLE ?>">
    <meta property="og:description" content="<?= $metaDescription ?? DEFAULT_META_DESCRIPTION ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $metaTitle ?? DEFAULT_META_TITLE ?>">
    <meta name="twitter:description" content="<?= $metaDescription ?? DEFAULT_META_DESCRIPTION ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <!-- Schema.org markup for LocalBusiness -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= SITE_NAME ?>",
        "description": "<?= DEFAULT_META_DESCRIPTION ?>",
        "url": "<?= SITE_URL ?>",
        "telephone": "<?= WHATSAPP_NUMBER ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "İstanbul",
            "addressCountry": "TR"
        },
        "openingHours": "Mo-Su 08:00-20:00",
        "priceRange": "$$",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "150"
        }
    }
    </script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="/">
                    <i class="fas fa-truck me-2"></i>
                    <?= SITE_NAME ?>
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Ana Sayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/services">Hizmetlerimiz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pricing">Fiyatlar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/reviews">Yorumlar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">İletişim</a>
                        </li>
                    </ul>
                    
                    <div class="d-flex">
                        <a href="/contact" class="btn btn-primary">
                            <i class="fas fa-phone me-1"></i>
                            Teklif Al
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-truck me-2"></i>
                        <?= SITE_NAME ?>
                    </h5>
                    <p class="text-muted">
                        İstanbul'un tüm ilçe ve semtlerinde profesyonel evden eve nakliyat hizmeti. 
                        Güvenilir, hızlı ve uygun fiyatlı taşımacılık çözümleri.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 mb-4">
                    <h6 class="text-primary mb-3">Hızlı Linkler</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-muted text-decoration-none">Ana Sayfa</a></li>
                        <li><a href="/services" class="text-muted text-decoration-none">Hizmetlerimiz</a></li>
                        <li><a href="/pricing" class="text-muted text-decoration-none">Fiyatlar</a></li>
                        <li><a href="/reviews" class="text-muted text-decoration-none">Yorumlar</a></li>
                        <li><a href="/contact" class="text-muted text-decoration-none">İletişim</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h6 class="text-primary mb-3">İlçeler</h6>
                    <div class="row">
                        <?php if (isset($all_districts) && !empty($all_districts)): ?>
                            <?php foreach (array_chunk($all_districts, ceil(count($all_districts) / 2)) as $districtChunk): ?>
                                <div class="col-6">
                                    <?php foreach ($districtChunk as $district): ?>
                                        <div class="mb-1">
                                            <a href="/istanbul/<?= $district['slug'] ?>" class="text-muted text-decoration-none small">
                                                <?= $district['name'] ?> Nakliyat
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h6 class="text-primary mb-3">İletişim</h6>
                    <div class="contact-info">
                        <p class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <?= WHATSAPP_NUMBER ?>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <?= ADMIN_EMAIL ?>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            İstanbul, Türkiye
                        </p>
                    </div>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-muted">
                        &copy; <?= date('Y') ?> <?= SITE_NAME ?>. Tüm hakları saklıdır.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="/privacy" class="text-muted text-decoration-none me-3">Gizlilik Politikası</a>
                    <a href="/terms" class="text-muted text-decoration-none">Kullanım Şartları</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/<?= str_replace(['+', ' '], '', WHATSAPP_NUMBER) ?>" 
       class="whatsapp-btn" 
       target="_blank" 
       rel="noopener">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="/assets/js/script.js"></script>
</body>
</html>