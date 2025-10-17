<?php include __DIR__ . '/header.php'; ?>

<section class="prices-page py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Fiyat Listesi</h1>
            <p class="text-muted">İstanbul genelinde ilçeler arası nakliyat fiyatlarımız</p>
        </div>
        
        <!-- Price Calculator -->
        <div class="card shadow mb-5">
            <div class="card-body p-4">
                <h3 class="card-title mb-4">
                    <i class="fas fa-calculator"></i> Fiyat Hesapla
                </h3>
                <form id="priceCalculator" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">Nereden</label>
                        <select name="from" class="form-select" required>
                            <option value="">İlçe Seçin</option>
                            <?php foreach ($districts as $district): ?>
                            <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Nereye</label>
                        <select name="to" class="form-select" required>
                            <option value="">İlçe Seçin</option>
                            <?php foreach ($districts as $district): ?>
                            <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">Hesapla</button>
                    </div>
                </form>
                <div id="priceResult" class="mt-4" style="display:none;">
                    <div class="alert alert-success">
                        <h4>Tahmini Fiyat: <span id="calculatedPrice"></span> ₺</h4>
                        <p id="priceNotes" class="mb-0"></p>
                    </div>
                </div>
                <div id="priceError" class="mt-4" style="display:none;">
                    <div class="alert alert-warning">
                        <p class="mb-0" id="errorMessage"></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Price Table -->
        <?php if (!empty($prices)): ?>
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title mb-4">İlçeler Arası Fiyatlar</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nereden</th>
                                <th>Nereye</th>
                                <th>Taban Fiyat</th>
                                <th>KM Başı</th>
                                <th>Notlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prices as $price): ?>
                            <tr>
                                <td><?php echo $price['from_district_name']; ?></td>
                                <td><?php echo $price['to_district_name']; ?></td>
                                <td><strong><?php echo number_format($price['base_price'], 2); ?> ₺</strong></td>
                                <td><?php echo number_format($price['price_per_km'], 2); ?> ₺</td>
                                <td><?php echo $price['notes'] ?: '-'; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="alert alert-info mt-4">
            <i class="fas fa-info-circle"></i> 
            <strong>Not:</strong> Fiyatlar tahmini olup, eşya miktarına ve özel durumlarınıza göre değişiklik gösterebilir. 
            Kesin fiyat için lütfen bizimle iletişime geçin.
        </div>
    </div>
</section>

<script>
document.getElementById('priceCalculator').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('<?php echo SITE_URL; ?>/fiyat-hesapla', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('priceError').style.display = 'none';
        document.getElementById('priceResult').style.display = 'none';
        
        if (data.success) {
            document.getElementById('calculatedPrice').textContent = parseFloat(data.price).toLocaleString('tr-TR', {minimumFractionDigits: 2});
            document.getElementById('priceNotes').textContent = data.notes || 'Fiyat tahminidir, kesin fiyat için iletişime geçin.';
            document.getElementById('priceResult').style.display = 'block';
        } else {
            document.getElementById('errorMessage').textContent = data.message;
            document.getElementById('priceError').style.display = 'block';
        }
    })
    .catch(error => {
        document.getElementById('errorMessage').textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        document.getElementById('priceError').style.display = 'block';
    });
});
</script>

<?php include __DIR__ . '/footer.php'; ?>
