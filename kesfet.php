<?php
/**
 * Keşfet Sayfası - Bölge Arama ve Keşif
 * Yerel Tanıtım - Özel PHP Scripti
 */

require_once 'config/config.php';

// Arama için ilçeleri al
$district = new District();
$districts = $district->getActiveDistricts();

// SEO Meta Verileri
$pageTitle = 'Bölge Keşif ve Arama | ' . get_setting('site_title');
$pageDescription = 'İstanbul\'un tüm bölgelerini keşfedin. İlçe ve mahalle rehberleri, yerel işletmeler ve detaylı bilgiler.';
$pageKeywords = 'bölge keşfi, İstanbul rehberi, ilçe arama, mahalle rehberi, yerel keşif';

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
                    Keşfet
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Keşif Bölümü -->
<section class="explore-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold text-primary mb-3">
                        <i class="fas fa-search me-2"></i>
                        Bölge Keşfi
                    </h1>
                    <p class="lead text-muted">
                        İstanbul'un hangi bölgesini keşfetmek istiyorsunuz? Aşağıdan seçim yapın.
                    </p>
                </div>
                
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <form id="exploreForm" class="needs-validation" novalidate>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="explore_district" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        Keşfetmek İstediğiniz İlçe
                                    </label>
                                    <select class="form-select form-select-lg" id="explore_district" name="explore_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $dist): ?>
                                            <option value="<?php echo $dist['slug']; ?>">
                                                <?php echo htmlspecialchars($dist['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Lütfen keşfetmek istediğiniz ilçeyi seçin.
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="interest_type" class="form-label">
                                        <i class="fas fa-heart me-2 text-success"></i>
                                        İlgilendiğiniz Konu
                                    </label>
                                    <select class="form-select form-select-lg" id="interest_type" name="interest_type">
                                        <option value="">Konu Seçin (Opsiyonel)</option>
                                        <option value="yerel-isletmeler">Yerel İşletmeler</option>
                                        <option value="tarihi-yerler">Tarihi Yerler</option>
                                        <option value="yeme-icme">Yeme İçme</option>
                                        <option value="alisveris">Alışveriş</option>
                                        <option value="ulasim">Ulaşım</option>
                                        <option value="egitim">Eğitim</option>
                                        <option value="saglik">Sağlık</option>
                                        <option value="eglence">Eğlence</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="button" onclick="startExploring()" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-compass me-2"></i>
                                    Keşfetmeye Başla
                                </button>
                            </div>
                        </form>
                        
                        <!-- Keşif Sonucu -->
                        <div id="explore_result" class="mt-4"></div>
                    </div>
                </div>
                
                <!-- Popüler Bölgeler -->
                <div class="popular-districts mt-5">
                    <h3 class="text-center mb-4">Popüler Bölgeler</h3>
                    <div class="row g-3">
                        <?php 
                        $popularDistricts = array_slice($districts, 0, 8);
                        foreach ($popularDistricts as $district): 
                        ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="istanbul/<?php echo $district['slug']; ?>" class="text-decoration-none">
                                    <div class="popular-district-card p-3 border rounded text-center">
                                        <i class="fas fa-map-marker-alt text-primary mb-2"></i>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($district['name']); ?></h6>
                                        <small class="text-muted">Keşfet</small>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Keşif Rehberi -->
<section class="explore-guide py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="section-title">Keşif Rehberi</h2>
                    <p class="text-muted">Her bölgede neler bulabileceğinizi öğrenin</p>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="guide-card text-center p-4">
                            <i class="fas fa-store fa-3x text-primary mb-3"></i>
                            <h5>Yerel İşletmeler</h5>
                            <p class="text-muted mb-0">
                                Her bölgedeki kaliteli işletmeleri keşfedin. 
                                Restoranlar, mağazalar, hizmet sağlayıcıları.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="guide-card text-center p-4">
                            <i class="fas fa-landmark fa-3x text-success mb-3"></i>
                            <h5>Tarihi Yerler</h5>
                            <p class="text-muted mb-0">
                                Bölgenin tarihi ve kültürel mirasını keşfedin. 
                                Müzeler, anıtlar, tarihi yapılar.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="guide-card text-center p-4">
                            <i class="fas fa-users fa-3x text-warning mb-3"></i>
                            <h5>Sosyal Yaşam</h5>
                            <p class="text-muted mb-0">
                                Bölgedeki sosyal aktiviteleri öğrenin. 
                                Etkinlikler, topluluklar, buluşma noktaları.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- İletişim CTA -->
<section class="contact-cta bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-2">Aradığınızı Bulamadınız mı?</h3>
                <p class="mb-0">
                    Özel bir bölge veya konu hakkında bilgi almak için 
                    bizimle iletişime geçin.
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

<!-- Keşif için Özel JavaScript -->
<script>
function startExploring() {
    const districtSelect = document.getElementById('explore_district');
    const interestSelect = document.getElementById('interest_type');
    const resultDiv = document.getElementById('explore_result');
    
    // Form doğrulama
    if (!districtSelect.value) {
        resultDiv.innerHTML = `
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Lütfen keşfetmek istediğiniz ilçeyi seçin.
            </div>
        `;
        return;
    }
    
    // Yükleme göster
    resultDiv.innerHTML = `
        <div class="text-center py-4">
            <div class="loading"></div>
            <p class="mt-2 text-muted">Bölge bilgileri hazırlanıyor...</p>
        </div>
    `;
    
    // Seçilen ilçeye yönlendir
    setTimeout(() => {
        const selectedDistrict = districtSelect.value;
        const selectedInterest = interestSelect.value;
        
        let redirectUrl = `istanbul/${selectedDistrict}`;
        if (selectedInterest) {
            redirectUrl += `?konu=${selectedInterest}`;
        }
        
        resultDiv.innerHTML = `
            <div class="alert alert-success alert-permanent">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-2">
                            <i class="fas fa-compass me-2"></i>
                            Keşif Hazır!
                        </h4>
                        <p class="mb-1">
                            <strong>${districtSelect.options[districtSelect.selectedIndex].text}</strong> 
                            bölgesi keşfetmeye hazır.
                        </p>
                        ${selectedInterest ? `<small class="text-muted">Odak: ${interestSelect.options[interestSelect.selectedIndex].text}</small>` : ''}
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="${redirectUrl}" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>
                            Keşfet
                        </a>
                    </div>
                </div>
            </div>
        `;
    }, 1500);
}

// İlçe seçildiğinde otomatik keşfet
document.getElementById('explore_district').addEventListener('change', function() {
    if (this.value) {
        // Kısa bir gecikme ile otomatik keşfet
        setTimeout(() => {
            startExploring();
        }, 500);
    }
});

// Popüler bölge kartlarına hover efekti
document.addEventListener('DOMContentLoaded', function() {
    const popularCards = document.querySelectorAll('.popular-district-card');
    popularCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 25px rgba(0,0,0,0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});
</script>

<style>
.popular-district-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.popular-district-card:hover {
    background-color: #f8f9fa;
}

.guide-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.guide-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .display-5 {
        font-size: 2rem;
    }
    
    .card-body {
        padding: 2rem !important;
    }
}
</style>

<?php include 'includes/footer.php'; ?>