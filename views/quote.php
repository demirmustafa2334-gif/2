<?php
$meta_title = 'Ücretsiz Teklif Al | İstanbul Nakliyat Fiyat Hesaplama';
$meta_description = 'İstanbul nakliyat için ücretsiz fiyat teklifi alın. Hızlı ve kolay fiyat hesaplama. Tüm ilçe ve semtlerde uygun fiyat garantisi.';
$meta_keywords = 'nakliyat teklifi, fiyat hesaplama, ücretsiz keşif, istanbul nakliyat fiyat';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Teklif Al</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">
                    Ücretsiz Teklif Alın
                </h1>
                <p class="lead mb-4">
                    Nakliyat ihtiyaçlarınız için ücretsiz keşif ve fiyat teklifi alın. 
                    Uzman ekibimiz size en uygun çözümü sunacak.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Quote Form Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-calculator me-2"></i>Teklif Formu
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="from_district" class="form-label">Nereden (İlçe) *</label>
                                    <select class="form-select" id="from_district" name="from_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district['name']; ?>" 
                                                <?php echo (isset($_POST['from_district']) && $_POST['from_district'] == $district['name']) ? 'selected' : ''; ?>>
                                            <?php echo $district['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="from_neighborhood" class="form-label">Nereden (Semt)</label>
                                    <select class="form-select" id="from_neighborhood" name="from_neighborhood">
                                        <option value="">Semt Seçin</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="to_district" class="form-label">Nereye (İlçe) *</label>
                                    <select class="form-select" id="to_district" name="to_district" required>
                                        <option value="">İlçe Seçin</option>
                                        <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district['name']; ?>" 
                                                <?php echo (isset($_POST['to_district']) && $_POST['to_district'] == $district['name']) ? 'selected' : ''; ?>>
                                            <?php echo $district['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="to_neighborhood" class="form-label">Nereye (Semt)</label>
                                    <select class="form-select" id="to_neighborhood" name="to_neighborhood">
                                        <option value="">Semt Seçin</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Ad Soyad *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-posta *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telefon *</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="moving_date" class="form-label">Taşınma Tarihi</label>
                                    <input type="date" class="form-control" id="moving_date" name="moving_date" 
                                           value="<?php echo isset($_POST['moving_date']) ? htmlspecialchars($_POST['moving_date']) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Mesaj</label>
                                <textarea class="form-control" id="message" name="message" rows="4" 
                                          placeholder="Eşyalarınız hakkında detay verebilirsiniz..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="quote_form" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Teklif Gönder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Info Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Fiyatlandırma Bilgileri</h2>
                <p class="lead">Şeffaf ve adil fiyatlandırma politikamız.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
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
            
            <div class="col-md-4">
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
            
            <div class="col-md-4">
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
    
    if (fromDistrict && toDistrict) {
        // In a real implementation, you would make an AJAX call to calculate price
        // For now, we'll show a placeholder
        const estimatedPrice = 1500; // Base price
        alert('Tahmini fiyat: ' + estimatedPrice.toLocaleString('tr-TR') + ' ₺');
    }
}

// Add event listeners for price calculation
document.getElementById('from_district').addEventListener('change', calculatePrice);
document.getElementById('to_district').addEventListener('change', calculatePrice);
</script>