<?php
$meta_title = getMetaTitle('Fiyat Listesi');
$meta_description = getMetaDescription('Fiyat Listesi');
$meta_keywords = 'istanbul nakliyat fiyatları, evden eve nakliyat fiyat, taşımacılık maliyeti, nakliye ücreti';

$db = new Database();
$conn = $db->getConnection();

// Get all pricing data
$stmt = $conn->prepare("SELECT * FROM pricing ORDER BY from_location, to_location");
$stmt->execute();
$pricing_data = $stmt->fetchAll();

ob_start();
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <?php echo generateBreadcrumb([['title' => 'Fiyat Listesi']]); ?>
    </div>
</nav>

<!-- Pricing Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-4 fw-bold mb-3">Nakliyat Fiyatlarımız</h1>
                <p class="lead text-muted">Şeffaf fiyatlandırma politikamızla sürpriz maliyetler yaşamazsınız. Tüm fiyatlarımız net ve günceldir.</p>
            </div>
        </div>
        
        <!-- Price Calculator -->
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-calculator me-2"></i>Fiyat Hesaplayıcı</h4>
                    </div>
                    <div class="card-body">
                        <form id="priceCalculator">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="fromLocation" class="form-label">Nereden</label>
                                    <select class="form-select" id="fromLocation" required>
                                        <option value="">İlçe seçiniz</option>
                                        <?php
                                        $stmt = $conn->prepare("SELECT DISTINCT from_location FROM pricing ORDER BY from_location");
                                        $stmt->execute();
                                        $from_locations = $stmt->fetchAll();
                                        foreach ($from_locations as $location):
                                        ?>
                                        <option value="<?php echo sanitize($location['from_location']); ?>"><?php echo sanitize($location['from_location']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="toLocation" class="form-label">Nereye</label>
                                    <select class="form-select" id="toLocation" required>
                                        <option value="">İlçe seçiniz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-calculator me-2"></i>Fiyat Hesapla
                                </button>
                            </div>
                        </form>
                        
                        <div id="priceResult" class="mt-4 text-center" style="display: none;">
                            <div class="alert alert-success">
                                <h4 class="fw-bold">Tahmini Fiyat</h4>
                                <div class="display-4 text-primary" id="calculatedPrice">0 ₺</div>
                                <p class="mb-0">Mesafe: <span id="calculatedDistance">0</span> km</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pricing Table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Güncel Fiyat Listesi</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nereden</th>
                                        <th>Nereye</th>
                                        <th>Mesafe</th>
                                        <th>Temel Ücret</th>
                                        <th>Km Başına</th>
                                        <th>Tahmini Fiyat</th>
                                        <th>İşlem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pricing_data as $price): ?>
                                    <tr>
                                        <td><strong><?php echo sanitize($price['from_location']); ?></strong></td>
                                        <td><strong><?php echo sanitize($price['to_location']); ?></strong></td>
                                        <td><?php echo $price['distance_km']; ?> km</td>
                                        <td><?php echo formatPrice($price['base_price']); ?></td>
                                        <td><?php echo formatPrice($price['price_per_km']); ?></td>
                                        <td><strong class="text-primary"><?php echo formatPrice($price['estimated_price']); ?></strong></td>
                                        <td>
                                            <a href="/iletisim" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-phone me-1"></i>Teklif Al
                                            </a>
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
        
        <!-- Pricing Info -->
        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
                <div class="card bg-light">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">Fiyatlandırma Bilgileri</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary">Fiyata Dahil Olanlar:</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Ambalajlama malzemeleri</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Yükleme ve boşaltma</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Taşımacılık sigortası</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Montaj ve demontaj</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary">Ek Ücretler:</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-plus text-warning me-2"></i>Asansör kullanımı (varsa)</li>
                                    <li><i class="fas fa-plus text-warning me-2"></i>Özel eşya taşıma</li>
                                    <li><i class="fas fa-plus text-warning me-2"></i>Hafta sonu taşıma</li>
                                    <li><i class="fas fa-plus text-warning me-2"></i>Ekstra mesafe</li>
                                </ul>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Not:</strong> Fiyatlar tahmini olup, keşif sonrası kesin fiyat belirlenir. Tüm fiyatlarımız KDV dahildir.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-5 fw-bold mb-3">Ücretsiz Keşif ve Fiyat Teklifi!</h2>
                <p class="lead mb-4">Kesin fiyat almak için ücretsiz keşif randevusu oluşturun. Uzman ekibimiz size en uygun fiyatı sunacak.</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="/iletisim" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-phone me-2"></i>Keşif Talep Et
                </a>
                <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', WHATSAPP_NUMBER); ?>" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Price Calculator JavaScript
document.getElementById('priceCalculator').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const fromLocation = document.getElementById('fromLocation').value;
    const toLocation = document.getElementById('toLocation').value;
    
    if (!fromLocation || !toLocation) {
        alert('Lütfen nereden ve nereye seçimlerini yapın.');
        return;
    }
    
    // Find matching price data
    const priceData = <?php echo json_encode($pricing_data); ?>;
    const match = priceData.find(p => 
        p.from_location === fromLocation && p.to_location === toLocation
    );
    
    if (match) {
        document.getElementById('calculatedPrice').textContent = new Intl.NumberFormat('tr-TR').format(match.estimated_price) + ' ₺';
        document.getElementById('calculatedDistance').textContent = match.distance_km;
        document.getElementById('priceResult').style.display = 'block';
    } else {
        alert('Bu rota için fiyat bilgisi bulunamadı. Lütfen iletişime geçin.');
    }
});

// Update to location options based on from location
document.getElementById('fromLocation').addEventListener('change', function() {
    const fromLocation = this.value;
    const toLocationSelect = document.getElementById('toLocation');
    
    // Clear existing options
    toLocationSelect.innerHTML = '<option value="">İlçe seçiniz</option>';
    
    if (fromLocation) {
        const priceData = <?php echo json_encode($pricing_data); ?>;
        const availableToLocations = [...new Set(
            priceData
                .filter(p => p.from_location === fromLocation)
                .map(p => p.to_location)
        )];
        
        availableToLocations.forEach(location => {
            const option = document.createElement('option');
            option.value = location;
            option.textContent = location;
            toLocationSelect.appendChild(option);
        });
    }
});
</script>

<?php
$content = ob_get_clean();
include 'layout.php';
?>