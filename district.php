<?php
/**
 * District Page - Dynamic SEO-optimized district pages
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// Get district slug from URL
$slug = isset($_GET['slug']) ? sanitize_input($_GET['slug']) : '';

if (empty($slug)) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Get district data
$district = new District();
$neighborhood = new Neighborhood();
$pricing = new Pricing();

$districtData = $district->findBySlug($slug);

if (!$districtData || !$districtData['is_active']) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Get neighborhoods for this district
$neighborhoods = $neighborhood->getNeighborhoodsByDistrict($districtData['id']);

// Get nearby districts for internal linking
$nearbyDistricts = $district->findAll('is_active = 1 AND id != ' . $districtData['id'], 'name ASC', 6);

// Get sample pricing from this district
$samplePricing = $pricing->findAll("from_district_id = {$districtData['id']} OR to_district_id = {$districtData['id']}", '', 3);

// SEO Meta Data
$pageTitle = $districtData['meta_title'] ?: $districtData['name'] . ' Evden Eve Nakliyat | Güvenilir Taşımacılık';
$pageDescription = $districtData['meta_description'] ?: $districtData['name'] . ' evden eve nakliyat hizmetleri. Profesyonel ekip, uygun fiyat, güvenli taşımacılık. Hemen teklif alın!';
$pageKeywords = $districtData['name'] . ' nakliyat, ' . $districtData['name'] . ' evden eve taşımacılık, ' . $districtData['name'] . ' nakliye firması';

// Breadcrumb
$breadcrumb = [
    ['title' => 'Ana Sayfa', 'url' => SITE_URL],
    ['title' => 'İstanbul İlçeleri', 'url' => 'hizmetlerimiz'],
    ['title' => $districtData['name'] . ' Nakliyat', 'url' => '']
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

<!-- Main Content -->
<section class="district-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- District Header -->
                <div class="district-header mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo htmlspecialchars($districtData['name']); ?> Evden Eve Nakliyat
                    </h1>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <i class="fas fa-truck fa-2x text-primary mb-2"></i>
                                <h6>Profesyonel Ekip</h6>
                                <small class="text-muted">Deneyimli nakliyat uzmanları</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <i class="fas fa-shield-alt fa-2x text-success mb-2"></i>
                                <h6>Sigortalı Taşımacılık</h6>
                                <small class="text-muted">Eşyalarınız güvende</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h6>7/24 Hizmet</h6>
                                <small class="text-muted">Her zaman ulaşılabilir</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- District Content -->
                <div class="district-description mb-5">
                    <?php if ($districtData['content']): ?>
                        <div class="content-text">
                            <?php echo nl2br(htmlspecialchars($districtData['content'])); ?>
                        </div>
                    <?php else: ?>
                        <div class="content-text">
                            <p>
                                <strong><?php echo htmlspecialchars($districtData['name']); ?> nakliyat hizmetlerimiz</strong> 
                                ile eşyalarınızı güvenle taşıyoruz. Profesyonel ekibimiz ve modern araçlarımızla 
                                <?php echo htmlspecialchars($districtData['name']); ?> bölgesinde evden eve nakliyat, 
                                ofis taşımacılığı ve eşya depolama hizmetleri sunuyoruz.
                            </p>
                            
                            <h3>Neden <?php echo htmlspecialchars($districtData['name']); ?> Nakliyat Hizmetimizi Tercih Etmelisiniz?</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Deneyimli ve güvenilir ekip
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Modern ve temiz nakliyat araçları
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Profesyonel ambalajlama malzemeleri
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Sigortalı taşımacılık hizmeti
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Uygun fiyat garantisi
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Ücretsiz keşif ve fiyat teklifi
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Neighborhoods in District -->
                <?php if (!empty($neighborhoods)): ?>
                <div class="neighborhoods-section mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-location-dot me-2"></i>
                        <?php echo htmlspecialchars($districtData['name']); ?> Mahalleleri
                    </h3>
                    <div class="row g-3">
                        <?php foreach ($neighborhoods as $hood): ?>
                            <div class="col-md-6 col-lg-4">
                                <a href="mahalle/<?php echo $hood['slug']; ?>" class="text-decoration-none">
                                    <div class="neighborhood-card p-3 border rounded">
                                        <i class="fas fa-map-pin text-primary me-2"></i>
                                        <?php echo htmlspecialchars($hood['name']); ?> Nakliyat
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Services -->
                <div class="services-section mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-cogs me-2"></i>
                        <?php echo htmlspecialchars($districtData['name']); ?> Nakliyat Hizmetlerimiz
                    </h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-home fa-2x text-primary mb-3"></i>
                                <h5>Evden Eve Nakliyat</h5>
                                <p class="text-muted mb-0">
                                    <?php echo htmlspecialchars($districtData['name']); ?> bölgesinde 
                                    profesyonel evden eve taşımacılık hizmeti.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-building fa-2x text-success mb-3"></i>
                                <h5>Ofis Taşımacılığı</h5>
                                <p class="text-muted mb-0">
                                    İş yerinizi minimum kesinti ile güvenle taşıyoruz.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-box fa-2x text-warning mb-3"></i>
                                <h5>Eşya Paketleme</h5>
                                <p class="text-muted mb-0">
                                    Profesyonel ambalajlama malzemeleri ile güvenli paketleme.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-warehouse fa-2x text-info mb-3"></i>
                                <h5>Eşya Depolama</h5>
                                <p class="text-muted mb-0">
                                    Güvenli depolama alanlarında eşya saklama hizmeti.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Quote Form -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-calculator me-2"></i>
                            Hızlı Fiyat Teklifi
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="iletisim-gonder" method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="from_district" value="<?php echo htmlspecialchars($districtData['name']); ?>">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Ad Soyad</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="to_district" class="form-label">Nereye Taşınacak?</label>
                                <select class="form-select" id="to_district" name="to_district" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($nearbyDistricts as $nearby): ?>
                                        <option value="<?php echo htmlspecialchars($nearby['name']); ?>">
                                            <?php echo htmlspecialchars($nearby['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Detaylar</label>
                                <textarea class="form-control" id="message" name="message" rows="3" 
                                          placeholder="Ev büyüklüğü, eşya miktarı vb."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>
                                Teklif Al
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-phone me-2"></i>
                            Hemen Arayın
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <a href="tel:<?php echo get_setting('contact_phone'); ?>" 
                               class="btn btn-success btn-lg w-100">
                                <i class="fas fa-phone me-2"></i>
                                <?php echo get_setting('contact_phone'); ?>
                            </a>
                        </div>
                        <div class="mb-0">
                            <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')'], '', get_setting('whatsapp_number')); ?>" 
                               target="_blank" class="btn btn-success btn-lg w-100">
                                <i class="fab fa-whatsapp me-2"></i>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Nearby Districts -->
                <?php if (!empty($nearbyDistricts)): ?>
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-map me-2"></i>
                            Diğer İlçeler
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <?php foreach ($nearbyDistricts as $nearby): ?>
                                <li class="mb-2">
                                    <a href="istanbul/<?php echo $nearby['slug']; ?>" class="text-decoration-none">
                                        <i class="fas fa-arrow-right me-2 text-primary"></i>
                                        <?php echo htmlspecialchars($nearby['name']); ?> Nakliyat
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Schema.org Structured Data for District -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Service",
    "name": "<?php echo htmlspecialchars($districtData['name']); ?> Evden Eve Nakliyat",
    "description": "<?php echo htmlspecialchars($pageDescription); ?>",
    "provider": {
        "@type": "MovingCompany",
        "name": "<?php echo get_setting('site_title'); ?>",
        "telephone": "<?php echo get_setting('contact_phone'); ?>",
        "url": "<?php echo SITE_URL; ?>"
    },
    "areaServed": {
        "@type": "Place",
        "name": "<?php echo htmlspecialchars($districtData['name']); ?>, İstanbul"
    },
    "serviceType": "Moving Services",
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceRange": "$$"
    }
}
</script>

<?php include 'includes/footer.php'; ?>