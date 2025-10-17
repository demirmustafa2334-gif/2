<?php
$db = new Database();
$conn = $db->getConnection();

$slug = $matches[1] ?? '';
$location_data = null;
$location_type = '';

// Check if it's a district
$stmt = $conn->prepare("SELECT * FROM districts WHERE slug = ? AND status = 1");
$stmt->execute([$slug]);
$district = $stmt->fetch();

if ($district) {
    $location_data = $district;
    $location_type = 'district';
} else {
    // Check if it's a neighborhood
    $stmt = $conn->prepare("SELECT n.*, d.name as district_name FROM neighborhoods n 
                           JOIN districts d ON n.district_id = d.id 
                           WHERE n.slug = ? AND n.status = 1");
    $stmt->execute([$slug]);
    $neighborhood = $stmt->fetch();
    
    if ($neighborhood) {
        $location_data = $neighborhood;
        $location_type = 'neighborhood';
    }
}

if (!$location_data) {
    http_response_code(404);
    include '404.php';
    exit;
}

// Get related locations
$related_locations = [];
if ($location_type === 'district') {
    // Get neighborhoods in this district
    $stmt = $conn->prepare("SELECT * FROM neighborhoods WHERE district_id = ? AND status = 1 ORDER BY name LIMIT 6");
    $stmt->execute([$location_data['id']]);
    $related_locations = $stmt->fetchAll();
} else {
    // Get other neighborhoods in the same district
    $stmt = $conn->prepare("SELECT * FROM neighborhoods WHERE district_id = ? AND id != ? AND status = 1 ORDER BY name LIMIT 6");
    $stmt->execute([$location_data['district_id'], $location_data['id']]);
    $related_locations = $stmt->fetchAll();
}

// Get pricing for this location
$stmt = $conn->prepare("SELECT * FROM pricing WHERE from_location = ? OR to_location = ? ORDER BY estimated_price ASC LIMIT 3");
$location_name = $location_type === 'district' ? $location_data['name'] : $location_data['name'];
$stmt->execute([$location_name, $location_name]);
$pricing = $stmt->fetchAll();

// Get reviews for this location
$stmt = $conn->prepare("SELECT * FROM reviews WHERE location = ? AND status = 1 ORDER BY created_at DESC LIMIT 3");
$stmt->execute([$location_name]);
$reviews = $stmt->fetchAll();

$meta_title = $location_data['meta_title'] ?: getMetaTitle('', $location_data['name']);
$meta_description = $location_data['meta_description'] ?: getMetaDescription('', $location_data['name']);
$meta_keywords = $location_data['meta_keywords'] ?: $location_data['name'] . ' nakliyat, ' . $location_data['name'] . ' evden eve nakliyat';

ob_start();
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <?php 
        $breadcrumb_items = [
            ['title' => 'İstanbul', 'url' => '/istanbul']
        ];
        if ($location_type === 'neighborhood') {
            $breadcrumb_items[] = ['title' => $location_data['district_name'], 'url' => '/istanbul/' . generateSlug($location_data['district_name'])];
        }
        $breadcrumb_items[] = ['title' => $location_data['name'] . ' Evden Eve Nakliyat'];
        echo generateBreadcrumb($breadcrumb_items);
        ?>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-3"><?php echo $location_data['name']; ?> Evden Eve Nakliyat</h1>
                <p class="lead mb-4"><?php echo $location_data['name']; ?> bölgesinde profesyonel evden eve nakliyat hizmeti sunuyoruz. Güvenli, hızlı ve uygun fiyatlı taşımacılık çözümleri.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="/iletisim" class="btn btn-light btn-lg">
                        <i class="fas fa-phone me-2"></i>Ücretsiz Keşif
                    </a>
                    <a href="/fiyat-listesi" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calculator me-2"></i>Fiyat Hesapla
                    </a>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-left">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt fa-8x opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Location Info -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="fw-bold mb-4"><?php echo $location_data['name']; ?> Nakliyat Hizmetleri</h2>
                        
                        <?php if ($location_data['description']): ?>
                            <div class="mb-4">
                                <?php echo nl2br($location_data['description']); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Güvenli Taşımacılık</h6>
                                        <p class="text-muted mb-0">Eşyalarınızı sigortalı araçlarımızla güvenle taşıyoruz.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Zamanında Teslimat</h6>
                                        <p class="text-muted mb-0">Belirlenen saatte teslimat garantisi veriyoruz.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Uygun Fiyatlar</h6>
                                        <p class="text-muted mb-0">Şeffaf fiyatlandırma ile sürpriz maliyet yok.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon me-3" style="width: 50px; height: 50px;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1">Uzman Ekip</h6>
                                        <p class="text-muted mb-0">Deneyimli ve profesyonel ekibimizle hizmet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong><?php echo $location_data['name']; ?> bölgesinde nakliyat hizmeti</strong> için bizimle iletişime geçin. 
                            Ücretsiz keşif ve fiyat teklifi alın.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Hızlı İletişim</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <a href="tel:<?php echo str_replace(' ', '', WHATSAPP_NUMBER); ?>" class="btn btn-success btn-lg w-100 mb-3">
                                <i class="fas fa-phone me-2"></i><?php echo WHATSAPP_NUMBER; ?>
                            </a>
                            <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', WHATSAPP_NUMBER); ?>" class="btn btn-outline-success w-100" target="_blank">
                                <i class="fab fa-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                        
                        <div class="text-center">
                            <h6 class="fw-bold mb-3">Hizmet Alanlarımız</h6>
                            <p class="text-muted"><?php echo $location_data['name']; ?> ve çevre bölgelerde profesyonel nakliyat hizmeti sunuyoruz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<?php if (!empty($pricing)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3"><?php echo $location_data['name']; ?> Nakliyat Fiyatları</h2>
                <p class="lead text-muted">Güncel fiyatlarımızı inceleyin ve size en uygun seçeneği belirleyin.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($pricing as $price): ?>
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
    </div>
</section>
<?php endif; ?>

<!-- Reviews Section -->
<?php if (!empty($reviews)): ?>
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3"><?php echo $location_data['name']; ?> Müşteri Yorumları</h2>
                <p class="lead text-muted">Hizmetlerimizden memnun kalan müşterilerimizin deneyimleri.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($reviews as $review): ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $review['id'] * 100; ?>">
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
    </div>
</section>
<?php endif; ?>

<!-- Related Locations -->
<?php if (!empty($related_locations)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Yakın Bölgeler</h2>
                <p class="lead text-muted"><?php echo $location_data['name']; ?> çevresindeki diğer bölgelerde de hizmet veriyoruz.</p>
            </div>
        </div>
        
        <div class="row g-3">
            <?php foreach ($related_locations as $related): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-2"><?php echo sanitize($related['name']); ?></h5>
                        <p class="text-muted mb-3"><?php echo sanitize($related['name']); ?> bölgesinde profesyonel nakliyat hizmeti</p>
                        <a href="/istanbul/<?php echo $related['slug']; ?>" class="btn btn-outline-primary">
                            Detayları Görüntüle
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-5 fw-bold mb-3"><?php echo $location_data['name']; ?> Nakliyat İçin Hemen İletişime Geçin!</h2>
                <p class="lead mb-4"><?php echo $location_data['name']; ?> bölgesinde profesyonel nakliyat hizmeti için ücretsiz keşif ve fiyat teklifi alın.</p>
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