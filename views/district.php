<?php
$meta_title = $district['meta_title'] ?: $district['name'] . ' Evden Eve Nakliyat | Profesyonel Taşımacılık';
$meta_description = $district['meta_description'] ?: $district['name'] . ' ilçesinde güvenilir evden eve nakliyat hizmeti. Uygun fiyat, profesyonel ekip, sigortalı taşımacılık.';
$meta_keywords = $district['meta_keywords'] ?: strtolower($district['name']) . ' nakliyat, ' . strtolower($district['name']) . ' evden eve nakliyat, ' . strtolower($district['name']) . ' taşımacılık';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="/hizmetlerimiz">Hizmetlerimiz</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $district['name']; ?> Nakliyat</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">
                    <?php echo $district['name']; ?> Evden Eve Nakliyat
                </h1>
                <p class="lead mb-4">
                    <?php echo $district['description'] ?: $district['name'] . ' ilçesinde profesyonel evden eve nakliyat hizmeti. Güvenilir, hızlı ve uygun fiyatlı taşımacılık çözümleri.'; ?>
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/teklif-al" class="btn btn-primary btn-lg">
                        <i class="fas fa-calculator me-2"></i>Ücretsiz Teklif Al
                    </a>
                    <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-phone me-2"></i>Hemen Ara
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="<?php echo $district['name']; ?> Nakliyat" 
                         class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo $district['name']; ?> Nakliyat Hizmetlerimiz</h2>
                <p class="lead"><?php echo $district['name']; ?> ilçesinde sunduğumuz kapsamlı nakliyat çözümleri.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h5 class="card-title">Ev Taşıma</h5>
                        <p class="card-text">
                            <?php echo $district['name']; ?> ilçesinde ev eşyalarınızı güvenle taşıyoruz. 
                            Paketleme, yükleme ve yerleştirme hizmetlerimizle tam çözüm.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h5 class="card-title">Ofis Taşıma</h5>
                        <p class="card-text">
                            <?php echo $district['name']; ?> ilçesinde ofis taşımacılığı hizmeti. 
                            İş süreçlerinizi aksatmadan profesyonel taşıma.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <h5 class="card-title">Eşya Depolama</h5>
                        <p class="card-text">
                            <?php echo $district['name']; ?> ilçesinde güvenli depolama hizmeti. 
                            Eşyalarınızı güvenle saklıyoruz.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Neighborhoods Section -->
<?php if (!empty($neighborhoods)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title"><?php echo $district['name']; ?> Semtleri</h2>
                <p class="lead"><?php echo $district['name']; ?> ilçesinin tüm semtlerinde hizmet veriyoruz.</p>
            </div>
        </div>
        
        <div class="row g-3">
            <?php foreach ($neighborhoods as $neighborhood): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title">
                            <a href="/istanbul/<?php echo $district['slug']; ?>/<?php echo $neighborhood['slug']; ?>-evden-eve-nakliyat" 
                               class="text-decoration-none">
                                <?php echo $neighborhood['name']; ?>
                            </a>
                        </h6>
                        <p class="card-text small text-muted">
                            <?php echo $neighborhood['name']; ?> semtinde nakliyat hizmeti
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Why Choose Us Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Neden <?php echo $district['name']; ?> Nakliyat?</h2>
                <p class="lead"><?php echo $district['name']; ?> ilçesinde tercih edilme nedenlerimiz.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Sigortalı Taşımacılık</h5>
                        <p class="mb-0">
                            Tüm eşyalarınız sigorta kapsamında güvence altında. 
                            Herhangi bir hasar durumunda tam tazminat garantisi.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>7/24 Hizmet</h5>
                        <p class="mb-0">
                            <?php echo $district['name']; ?> ilçesinde haftanın 7 günü, 
                            günün 24 saati hizmetinizdeyiz.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Modern Araç Filosu</h5>
                        <p class="mb-0">
                            En son teknoloji ile donatılmış, temiz ve güvenli araçlarımızla 
                            eşyalarınızı özenle taşıyoruz.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Uygun Fiyat</h5>
                        <p class="mb-0">
                            <?php echo $district['name']; ?> ilçesinde kaliteli hizmeti en uygun fiyatlarla sunuyoruz. 
                            Şeffaf fiyatlandırma, gizli ücret yok.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nearby Districts -->
<?php if (!empty($nearbyDistricts)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Yakın İlçeler</h2>
                <p class="lead"><?php echo $district['name']; ?> ilçesine yakın diğer ilçelerde de hizmet veriyoruz.</p>
            </div>
        </div>
        
        <div class="row g-3">
            <?php foreach ($nearbyDistricts as $nearbyDistrict): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="card-title">
                            <a href="/istanbul/<?php echo $nearbyDistrict['slug']; ?>-evden-eve-nakliyat" 
                               class="text-decoration-none">
                                <?php echo $nearbyDistrict['name']; ?>
                            </a>
                        </h6>
                        <p class="card-text small text-muted">
                            <?php echo $nearbyDistrict['name']; ?> ilçesinde nakliyat hizmeti
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3"><?php echo $district['name']; ?> Nakliyat Teklifi Alın!</h3>
                <p class="mb-0">
                    <?php echo $district['name']; ?> ilçesinde ücretsiz keşif ve fiyat teklifi için hemen iletişime geçin. 
                    Uzman ekibimiz size en uygun çözümü sunacak.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/teklif-al" class="btn btn-warning btn-lg">
                    <i class="fas fa-calculator me-2"></i>Teklif Al
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Schema.org Structured Data -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "<?php echo $district['name']; ?> Evden Eve Nakliyat",
    "description": "<?php echo $meta_description; ?>",
    "url": "<?php echo SITE_URL . '/istanbul/' . $district['slug'] . '-evden-eve-nakliyat'; ?>",
    "telephone": "<?php echo get_setting('contact_phone'); ?>",
    "email": "<?php echo get_setting('contact_email'); ?>",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "<?php echo $district['name']; ?>",
        "addressRegion": "İstanbul",
        "addressCountry": "TR"
    },
    "serviceArea": {
        "@type": "City",
        "name": "<?php echo $district['name']; ?>"
    },
    "priceRange": "$$",
    "openingHours": "Mo-Su 00:00-23:59"
}
</script>