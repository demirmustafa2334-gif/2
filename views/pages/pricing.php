<?php $content = ob_start(); ?>

<!-- Page Header -->
<section class="page-header bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Nakliyat Fiyatları</h1>
                <p class="lead">Şeffaf fiyatlandırma, gizli ücret yok</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Calculator -->
<section class="pricing-calculator-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="pricing-calculator">
                    <h3 class="text-center mb-4">Fiyat Hesaplayıcı</h3>
                    <form id="pricingForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="from_district" class="form-label">Nereden</label>
                                <select class="form-select" id="from_district" name="from_district" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                        <option value="<?= $district['id'] ?>"><?= $district['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="to_district" class="form-label">Nereye</label>
                                <select class="form-select" id="to_district" name="to_district" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                        <option value="<?= $district['id'] ?>"><?= $district['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="from_neighborhood" class="form-label">Başlangıç Semti (Opsiyonel)</label>
                                <select class="form-select" id="from_neighborhood" name="from_neighborhood">
                                    <option value="">Semt Seçin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="to_neighborhood" class="form-label">Varış Semti (Opsiyonel)</label>
                                <select class="form-select" id="to_neighborhood" name="to_neighborhood">
                                    <option value="">Semt Seçin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="distance" class="form-label">Mesafe (km)</label>
                                <input type="number" class="form-control" id="distance" name="distance" placeholder="Mesafe girin" min="0" step="0.1">
                            </div>
                            <div class="col-md-6">
                                <label for="property_type" class="form-label">Emlak Tipi</label>
                                <select class="form-select" id="property_type" name="property_type">
                                    <option value="apartment">Daire</option>
                                    <option value="house">Ev</option>
                                    <option value="office">Ofis</option>
                                    <option value="other">Diğer</option>
                                </select>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-calculator me-2"></i>
                                    Fiyat Hesapla
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <div id="priceResult" class="price-result" style="display: none;">
                        <!-- Price result will be shown here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Table -->
<section class="pricing-table-section py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">Fiyat Tablosu</h2>
                <p class="lead text-muted">İlçeler arası ortalama fiyatlarımız</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nereden</th>
                                <th>Nereye</th>
                                <th>Başlangıç Fiyatı</th>
                                <th>Km Başına</th>
                                <th>Minimum Fiyat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($routes as $route): ?>
                            <tr>
                                <td>
                                    <?= $route['from_district_name'] ?>
                                    <?php if ($route['from_neighborhood_name']): ?>
                                        <br><small class="text-muted"><?= $route['from_neighborhood_name'] ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= $route['to_district_name'] ?>
                                    <?php if ($route['to_neighborhood_name']): ?>
                                        <br><small class="text-muted"><?= $route['to_neighborhood_name'] ?></small>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-bold text-primary"><?= number_format($route['base_price'], 0, ',', '.') ?> ₺</td>
                                <td><?= number_format($route['price_per_km'], 0, ',', '.') ?> ₺</td>
                                <td><?= number_format($route['minimum_price'], 0, ',', '.') ?> ₺</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Services Pricing -->
<section class="additional-services-section py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="display-5 fw-bold mb-3">Ek Hizmet Fiyatları</h2>
                <p class="lead text-muted">Taşıma dışındaki hizmetlerimizin fiyatları</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="service-pricing-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                        <h5 class="card-title fw-bold">Ambalajlama</h5>
                        <div class="pricing">
                            <span class="h3 text-primary">50 ₺</span>
                            <span class="text-muted">/ kutu</span>
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Profesyonel ambalaj</li>
                            <li><i class="fas fa-check text-success me-2"></i>Koruyucu malzeme</li>
                            <li><i class="fas fa-check text-success me-2"></i>Etiketleme</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-pricing-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                            <i class="fas fa-tools fa-2x"></i>
                        </div>
                        <h5 class="card-title fw-bold">Montaj/Demontaj</h5>
                        <div class="pricing">
                            <span class="h3 text-primary">100 ₺</span>
                            <span class="text-muted">/ saat</span>
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Uzman montajcı</li>
                            <li><i class="fas fa-check text-success me-2"></i>Gerekli ekipman</li>
                            <li><i class="fas fa-check text-success me-2"></i>Garanti</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-pricing-card card h-100">
                    <div class="card-body text-center p-4">
                        <div class="service-icon bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                            <i class="fas fa-warehouse fa-2x"></i>
                        </div>
                        <h5 class="card-title fw-bold">Depolama</h5>
                        <div class="pricing">
                            <span class="h3 text-primary">200 ₺</span>
                            <span class="text-muted">/ ay</span>
                        </div>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Güvenli depo</li>
                            <li><i class="fas fa-check text-success me-2"></i>24/7 güvenlik</li>
                            <li><i class="fas fa-check text-success me-2"></i>Esnek süre</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Kesin Fiyat Almak İster misiniz?</h3>
                <p class="lead mb-0">
                    Ücretsiz keşif ile kesin fiyat teklifi alın. Gizli ücret yok, şeffaf fiyatlandırma.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/contact" class="btn btn-light btn-lg">
                    <i class="fas fa-phone me-2"></i>
                    Ücretsiz Keşif
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.pricing-calculator {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 1rem;
    padding: 2rem;
    margin: 2rem 0;
}

.price-result {
    background: var(--primary-color);
    color: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    text-align: center;
    margin-top: 1rem;
}

.service-pricing-card {
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.service-pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.service-icon {
    width: 80px;
    height: 80px;
}

.pricing {
    margin: 1rem 0;
}
</style>

<script>
// Update neighborhoods when district changes
document.getElementById('from_district').addEventListener('change', function() {
    updateNeighborhoods(this, 'from_neighborhood');
});

document.getElementById('to_district').addEventListener('change', function() {
    updateNeighborhoods(this, 'to_neighborhood');
});
</script>

<?php $content = ob_get_clean(); ?>
<?php include 'layouts/main.php'; ?>