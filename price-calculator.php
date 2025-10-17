<?php
/**
 * Price Calculator Page
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// Get districts for dropdown
$district = new District();
$districts = $district->getActiveDistricts();

// SEO Meta Data
$pageTitle = 'Nakliyat Fiyat Hesaplama | ' . get_setting('site_title');
$pageDescription = 'İstanbul nakliyat fiyatlarını hesaplayın. Evden eve taşımacılık için ücretsiz fiyat teklifi alın.';
$pageKeywords = 'nakliyat fiyatı, evden eve taşımacılık fiyatı, İstanbul nakliyat hesaplama';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?php echo SITE_URL; ?>">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Fiyat Hesaplama
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Price Calculator -->
<section class="price-calculator py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-calculator me-2"></i>
                        Nakliyat Fiyat Hesaplama
                    </h1>
                    <p class="lead text-muted">
                        Nereden nereye taşınacağınızı seçin, anında tahmini fiyat alın
                    </p>
                </div>
                
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <form id="priceCalculatorForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="from_district" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Nereden
                                    </label>
                                    <select class="form-select form-select-lg" id="from_district" name="from_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $dist): ?>
                                            <option value="<?php echo $dist['id']; ?>">
                                                <?php echo htmlspecialchars($dist['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Lütfen nereden taşınacağınızı seçin.
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="to_district" class="form-label">
                                        <i class="fas fa-location-dot me-2 text-success"></i>
                                        Nereye
                                    </label>
                                    <select class="form-select form-select-lg" id="to_district" name="to_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $dist): ?>
                                            <option value="<?php echo $dist['id']; ?>">
                                                <?php echo htmlspecialchars($dist['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Lütfen nereye taşınacağınızı seçin.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="button" onclick="calculatePrice()" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-calculator me-2"></i>
                                    Fiyat Hesapla
                                </button>
                            </div>
                        </form>
                        
                        <!-- Price Result -->
                        <div id="price_result" class="mt-4"></div>
                    </div>
                </div>
                
                <!-- Additional Info -->
                <div class="row g-4 mt-5">
                    <div class="col-md-4">
                        <div class="info-card text-center p-4">
                            <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                            <h5>Sigortalı Taşımacılık</h5>
                            <p class="text-muted mb-0">
                                Tüm eşyalarınız sigorta kapsamında güvenle taşınır.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card text-center p-4">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5>Profesyonel Ekip</h5>
                            <p class="text-muted mb-0">
                                Deneyimli ve güvenilir nakliyat uzmanları.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card text-center p-4">
                            <i class="fas fa-clock fa-3x text-warning mb-3"></i>
                            <h5>Hızlı Hizmet</h5>
                            <p class="text-muted mb-0">
                                Zamanında ve hızlı nakliyat hizmeti garantisi.
                            </p>
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
                <h3 class="mb-2">Daha Detaylı Fiyat Teklifi İçin</h3>
                <p class="mb-0">
                    Uzmanlarımızla konuşun, ücretsiz keşif hizmeti alın ve 
                    en uygun fiyatı öğrenin.
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

<!-- FAQ Section -->
<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="section-title">Sık Sorulan Sorular</h2>
                </div>
                
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faq1">
                                Nakliyat fiyatları neye göre belirlenir?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Nakliyat fiyatları mesafe, eşya miktarı, kat sayısı, asansör durumu ve 
                                özel eşyalar (piyano, antika vb.) gibi faktörlere göre belirlenir.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faq2">
                                Ücretsiz keşif hizmeti var mı?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Evet, tüm müşterilerimize ücretsiz keşif hizmeti sunuyoruz. 
                                Uzmanlarımız evinize gelir ve detaylı fiyat teklifi hazırlar.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#faq3">
                                Eşyalar sigortalı mı?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Evet, tüm eşyalarınız nakliyat sırasında sigorta kapsamındadır. 
                                Herhangi bir hasar durumunda tazminat ödenir.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom JavaScript for Price Calculator -->
<script>
function calculatePrice() {
    const fromDistrict = document.getElementById('from_district');
    const toDistrict = document.getElementById('to_district');
    const resultDiv = document.getElementById('price_result');
    
    // Validate form
    if (!fromDistrict.value || !toDistrict.value) {
        resultDiv.innerHTML = `
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Lütfen nereden ve nereye taşınacağınızı seçin.
            </div>
        `;
        return;
    }
    
    if (fromDistrict.value === toDistrict.value) {
        resultDiv.innerHTML = `
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Aynı ilçe içi taşımacılık için özel fiyatlarımız var. 
                Lütfen iletişime geçin.
            </div>
        `;
        return;
    }
    
    // Show loading
    resultDiv.innerHTML = `
        <div class="text-center py-4">
            <div class="loading"></div>
            <p class="mt-2 text-muted">Fiyat hesaplanıyor...</p>
        </div>
    `;
    
    // Simulate API call (replace with actual API endpoint)
    setTimeout(() => {
        const fromText = fromDistrict.options[fromDistrict.selectedIndex].text;
        const toText = toDistrict.options[toDistrict.selectedIndex].text;
        
        // Simple price calculation (replace with actual logic)
        const basePrice = 500;
        const distanceMultiplier = Math.random() * 2 + 1;
        const estimatedPrice = Math.round(basePrice * distanceMultiplier);
        
        resultDiv.innerHTML = `
            <div class="alert alert-success alert-permanent">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-2">
                            <i class="fas fa-calculator me-2"></i>
                            Tahmini Nakliyat Fiyatı
                        </h4>
                        <p class="mb-1">
                            <strong>${fromText}</strong> → <strong>${toText}</strong>
                        </p>
                        <h3 class="text-primary mb-0">
                            ${estimatedPrice} ₺ - ${estimatedPrice + 200} ₺
                        </h3>
                        <small class="text-muted">
                            * Kesin fiyat için ücretsiz keşif hizmeti alın
                        </small>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="iletisim" class="btn btn-primary">
                            <i class="fas fa-envelope me-2"></i>
                            Teklif Al
                        </a>
                    </div>
                </div>
            </div>
        `;
    }, 1500);
}

// Auto-calculate when both districts are selected
document.getElementById('from_district').addEventListener('change', function() {
    const toDistrict = document.getElementById('to_district');
    if (this.value && toDistrict.value) {
        calculatePrice();
    }
});

document.getElementById('to_district').addEventListener('change', function() {
    const fromDistrict = document.getElementById('from_district');
    if (this.value && fromDistrict.value) {
        calculatePrice();
    }
});
</script>

<?php include 'includes/footer.php'; ?>