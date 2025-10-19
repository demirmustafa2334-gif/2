<?php
$meta_title = 'Fiyat Listesi | İstanbul Nakliyat Fiyatları 2024';
$meta_description = 'İstanbul nakliyat fiyat listesi. Şeffaf ve uygun fiyatlar. Tüm ilçe ve semtlerde nakliyat fiyatları. Ücretsiz keşif ve teklif.';
$meta_keywords = 'istanbul nakliyat fiyatları, nakliyat fiyat listesi, evden eve nakliyat fiyat, taşımacılık fiyatları';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fiyat Listesi</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">
                    Nakliyat Fiyat Listesi
                </h1>
                <p class="lead mb-4">
                    Şeffaf ve adil fiyatlandırma politikamızla en uygun nakliyat fiyatlarını sunuyoruz. 
                    Tüm fiyatlarımız net ve açık, gizli ücret yok.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Calculator Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-calculator me-2"></i>Fiyat Hesaplayıcı
                        </h4>
                    </div>
                    <div class="card-body">
                        <form id="pricingCalculator">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="from_district" class="form-label">Nereden (İlçe) *</label>
                                    <select class="form-select" id="from_district" name="from_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district['name']; ?>"><?php echo $district['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="to_district" class="form-label">Nereye (İlçe) *</label>
                                    <select class="form-select" id="to_district" name="to_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district['name']; ?>"><?php echo $district['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="from_neighborhood" class="form-label">Nereden (Semt)</label>
                                    <select class="form-select" id="from_neighborhood" name="from_neighborhood">
                                        <option value="">Semt Seçin</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="to_neighborhood" class="form-label">Nereye (Semt)</label>
                                    <select class="form-select" id="to_neighborhood" name="to_neighborhood">
                                        <option value="">Semt Seçin</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary btn-lg" onclick="calculatePrice()">
                                    <i class="fas fa-calculator me-2"></i>Fiyat Hesapla
                                </button>
                            </div>
                        </form>
                        
                        <div id="priceResult" class="mt-4" style="display: none;">
                            <div class="alert alert-success">
                                <h5 class="alert-heading">
                                    <i class="fas fa-money-bill-wave me-2"></i>Tahmini Fiyat
                                </h5>
                                <p class="mb-0">
                                    <strong id="estimatedPrice">0 ₺</strong>
                                </p>
                                <hr>
                                <p class="mb-0">
                                    <small>Bu fiyat tahminidir. Kesin fiyat için ücretsiz keşif talep edin.</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Table Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Fiyat Tablosu</h2>
                <p class="lead">İstanbul içi nakliyat fiyatlarımız.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Rota</th>
                                        <th>Base Fiyat</th>
                                        <th>Km Başına</th>
                                        <th>Mesafe</th>
                                        <th>Tahmini Toplam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pricingRoutes as $route): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($route['from_district_name']); ?></strong>
                                            <?php if ($route['from_neighborhood_name']): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars($route['from_neighborhood_name']); ?></small>
                                            <?php endif; ?>
                                            <br>↓
                                            <br><strong><?php echo htmlspecialchars($route['to_district_name']); ?></strong>
                                            <?php if ($route['to_neighborhood_name']): ?>
                                                <br><small class="text-muted"><?php echo htmlspecialchars($route['to_neighborhood_name']); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <strong><?php echo format_price($route['base_price']); ?></strong>
                                        </td>
                                        <td>
                                            <?php echo format_price($route['price_per_km']); ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($route['estimated_distance_km'], 1); ?> km
                                        </td>
                                        <td>
                                            <strong class="text-primary">
                                                <?php echo format_price($route['base_price'] + ($route['price_per_km'] * $route['estimated_distance_km'])); ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Info Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Fiyatlandırma Bilgileri</h2>
                <p class="lead">Fiyatlarımız hakkında önemli bilgiler.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h5 class="card-title">Ücretsiz Keşif</h5>
                        <p class="card-text">
                            Eşyalarınızı inceleyerek en doğru fiyat teklifini veriyoruz. 
                            Keşif ücreti almıyoruz.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h5 class="card-title">Şeffaf Fiyat</h5>
                        <p class="card-text">
                            Tüm fiyatlarımız net ve şeffaf. Gizli ücret yok, 
                            sürpriz fiyat artışı yok.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h5 class="card-title">Garantili Hizmet</h5>
                        <p class="card-text">
                            Verdiğimiz fiyat garantilidir. Ek ücret talep etmiyoruz, 
                            sözümüzün arkasındayız.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <h5 class="card-title">Uygun Fiyat</h5>
                        <p class="card-text">
                            Kaliteli hizmeti en uygun fiyatlarla sunuyoruz. 
                            Rekabetçi fiyatlarımızla fark yaratıyoruz.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Factors Affecting Price Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Fiyatı Etkileyen Faktörler</h2>
                <p class="lead">Nakliyat fiyatınızı etkileyen temel faktörler.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-route"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Mesafe ve Rota</h5>
                        <p class="mb-0">
                            Taşıma mesafesi ve rotası fiyatı doğrudan etkiler. 
                            Daha uzun mesafeler daha yüksek fiyat anlamına gelir.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Eşya Miktarı ve Ağırlığı</h5>
                        <p class="mb-0">
                            Taşınacak eşya miktarı ve ağırlığı araç seçimini ve 
                            fiyatı etkiler. Daha fazla eşya daha büyük araç gerektirir.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Taşınma Tarihi</h5>
                        <p class="mb-0">
                            Hafta sonu ve tatil günlerinde fiyatlar değişebilir. 
                            Erken rezervasyon avantaj sağlar.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-tools"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Ek Hizmetler</h5>
                        <p class="mb-0">
                            Paketleme, montaj, demontaj gibi ek hizmetler 
                            fiyata eklenir. Bu hizmetler isteğe bağlıdır.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Kesin Fiyat İçin Teklif Alın!</h3>
                <p class="mb-0">
                    Yukarıdaki fiyatlar tahminidir. Kesin fiyat için ücretsiz keşif talep edin. 
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

<script>
// Load neighborhoods when district is selected
document.getElementById('from_district').addEventListener('change', function() {
    loadNeighborhoods(this.value, 'from_neighborhood');
});

document.getElementById('to_district').addEventListener('change', function() {
    loadNeighborhoods(this.value, 'to_neighborhood');
});

function loadNeighborhoods(districtName, selectId) {
    const select = document.getElementById(selectId);
    select.innerHTML = '<option value="">Semt Seçin</option>';
    
    if (!districtName) return;
    
    // In a real implementation, you would make an AJAX call here
    // For now, we'll show a placeholder
    const option = document.createElement('option');
    option.value = '';
    option.textContent = 'Yükleniyor...';
    select.appendChild(option);
    
    // Simulate loading
    setTimeout(() => {
        select.innerHTML = '<option value="">Semt Seçin</option>';
        // Add some sample neighborhoods
        const sampleNeighborhoods = ['Merkez', 'Mahalle 1', 'Mahalle 2', 'Mahalle 3'];
        sampleNeighborhoods.forEach(neighborhood => {
            const option = document.createElement('option');
            option.value = neighborhood;
            option.textContent = neighborhood;
            select.appendChild(option);
        });
    }, 500);
}

// Calculate estimated price
function calculatePrice() {
    const fromDistrict = document.getElementById('from_district').value;
    const toDistrict = document.getElementById('to_district').value;
    
    if (!fromDistrict || !toDistrict) {
        alert('Lütfen nereden ve nereye ilçelerini seçin.');
        return;
    }
    
    // In a real implementation, you would make an AJAX call to calculate price
    // For now, we'll show a sample calculation
    const basePrice = 1500; // Base price
    const pricePerKm = 50; // Price per km
    const estimatedDistance = 15; // Estimated distance in km
    
    const totalPrice = basePrice + (pricePerKm * estimatedDistance);
    
    document.getElementById('estimatedPrice').textContent = totalPrice.toLocaleString('tr-TR') + ' ₺';
    document.getElementById('priceResult').style.display = 'block';
    
    // Scroll to result
    document.getElementById('priceResult').scrollIntoView({ behavior: 'smooth' });
}
</script>