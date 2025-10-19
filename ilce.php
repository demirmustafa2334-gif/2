<?php
/**
 * İlçe Sayfası - Dinamik SEO-optimize ilçe sayfaları
 * Yerel Tanıtım - Özel PHP Scripti
 */

require_once 'config/config.php';

// URL'den ilçe slug'ını al
$slug = isset($_GET['slug']) ? sanitize_input($_GET['slug']) : '';

if (empty($slug)) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// İlçe verilerini al
$district = new District();
$neighborhood = new Neighborhood();
$pricing = new Pricing();

$districtData = $district->findBySlug($slug);

if (!$districtData || !$districtData['is_active']) {
    header("HTTP/1.0 404 Not Found");
    include '404.php';
    exit;
}

// Bu ilçeye ait mahalleleri al
$neighborhoods = $neighborhood->getNeighborhoodsByDistrict($districtData['id']);

// İç bağlantı için yakın ilçeleri al
$nearbyDistricts = $district->findAll('is_active = 1 AND id != ' . $districtData['id'], 'name ASC', 6);

// Bu ilçeden örnek fiyatlandırma al
$samplePricing = $pricing->findAll("from_district_id = {$districtData['id']} OR to_district_id = {$districtData['id']}", '', 3);

// SEO Meta Verileri
$pageTitle = $districtData['meta_title'] ?: $districtData['name'] . ' Rehberi | Yerel Tanıtım';
$pageDescription = $districtData['meta_description'] ?: $districtData['name'] . ' bölgesi hakkında detaylı bilgiler. Yerel işletmeler, özellikler ve rehber bilgileri.';
$pageKeywords = $districtData['name'] . ' rehberi, ' . $districtData['name'] . ' tanıtım, ' . $districtData['name'] . ' yerel işletmeler';

// Breadcrumb
$breadcrumb = [
    ['title' => 'Ana Sayfa', 'url' => SITE_URL],
    ['title' => 'İstanbul İlçeleri', 'url' => 'bolgelerimiz'],
    ['title' => $districtData['name'] . ' Rehberi', 'url' => '']
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

<!-- Ana İçerik -->
<section class="district-content py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- İlçe Başlığı -->
                <div class="district-header mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo htmlspecialchars($districtData['name']); ?> Rehberi
                    </h1>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <i class="fas fa-map-marked-alt fa-2x text-primary mb-2"></i>
                                <h6>Bölge Rehberi</h6>
                                <small class="text-muted">Detaylı bölge bilgileri</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <i class="fas fa-store fa-2x text-success mb-2"></i>
                                <h6>Yerel İşletmeler</h6>
                                <small class="text-muted">Kaliteli hizmet veren firmalar</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-card text-center p-3">
                                <i class="fas fa-users fa-2x text-warning mb-2"></i>
                                <h6>Topluluk Rehberi</h6>
                                <small class="text-muted">Sosyal aktiviteler</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- İlçe İçeriği -->
                <div class="district-description mb-5">
                    <?php if ($districtData['content']): ?>
                        <div class="content-text">
                            <?php echo nl2br(htmlspecialchars($districtData['content'])); ?>
                        </div>
                    <?php else: ?>
                        <div class="content-text">
                            <p>
                                <strong><?php echo htmlspecialchars($districtData['name']); ?> bölge rehberimiz</strong> 
                                ile bu güzel ilçeyi yakından tanıyın. <?php echo htmlspecialchars($districtData['name']); ?> 
                                bölgesindeki yerel işletmeler, tarihi yerler, sosyal imkanlar ve daha fazlası hakkında 
                                detaylı bilgilere ulaşabilirsiniz.
                            </p>
                            
                            <h3><?php echo htmlspecialchars($districtData['name']); ?> Hakkında</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Zengin tarihi ve kültürel miras
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Çeşitli yerel işletme seçenekleri
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Ulaşım kolaylığı ve merkezi konum
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Sosyal ve kültürel etkinlikler
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Yeşil alanlar ve rekreasyon imkanları
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Güvenli ve huzurlu yaşam ortamı
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- İlçedeki Mahalleler -->
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
                                        <?php echo htmlspecialchars($hood['name']); ?> Mahallesi
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Hizmetler -->
                <div class="services-section mb-5">
                    <h3 class="mb-4">
                        <i class="fas fa-cogs me-2"></i>
                        <?php echo htmlspecialchars($districtData['name']); ?> Bölge Özellikleri
                    </h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-shopping-cart fa-2x text-primary mb-3"></i>
                                <h5>Alışveriş İmkanları</h5>
                                <p class="text-muted mb-0">
                                    <?php echo htmlspecialchars($districtData['name']); ?> bölgesindeki 
                                    çeşitli alışveriş merkezleri ve yerel mağazalar.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-utensils fa-2x text-success mb-3"></i>
                                <h5>Yeme İçme</h5>
                                <p class="text-muted mb-0">
                                    Lezzetli yerel mutfak ve çeşitli restoran seçenekleri.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-bus fa-2x text-warning mb-3"></i>
                                <h5>Ulaşım</h5>
                                <p class="text-muted mb-0">
                                    Metro, otobüs ve diğer toplu taşıma seçenekleri.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-item p-4 border rounded">
                                <i class="fas fa-tree fa-2x text-info mb-3"></i>
                                <h5>Yeşil Alanlar</h5>
                                <p class="text-muted mb-0">
                                    Parklar, bahçeler ve rekreasyon alanları.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Kenar Çubuğu -->
            <div class="col-lg-4">
                <!-- Hızlı İletişim Formu -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            Bilgi Talebi
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
                                <label for="to_district" class="form-label">İlgilendiğiniz Konu</label>
                                <select class="form-select" id="to_district" name="to_district">
                                    <option value="">Konu Seçin</option>
                                    <option value="Yerel İşletmeler">Yerel İşletmeler</option>
                                    <option value="Bölge Bilgileri">Bölge Bilgileri</option>
                                    <option value="Etkinlikler">Etkinlikler</option>
                                    <option value="Diğer">Diğer</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Mesajınız</label>
                                <textarea class="form-control" id="message" name="message" rows="3" 
                                          placeholder="Detaylarınızı yazın..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>
                                Gönder
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- İletişim Bilgileri -->
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-phone me-2"></i>
                            Hemen İletişime Geçin
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
                
                <!-- Yakın İlçeler -->
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
                                        <?php echo htmlspecialchars($nearby['name']); ?> Rehberi
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

<!-- İlçe için Schema.org Yapılandırılmış Veri -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Place",
    "name": "<?php echo htmlspecialchars($districtData['name']); ?>",
    "description": "<?php echo htmlspecialchars($pageDescription); ?>",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "<?php echo htmlspecialchars($districtData['name']); ?>",
        "addressRegion": "İstanbul",
        "addressCountry": "TR"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": 41.0082,
        "longitude": 28.9784
    },
    "url": "<?php echo SITE_URL . '/istanbul/' . $districtData['slug']; ?>"
}
</script>

<?php include 'includes/footer.php'; ?>