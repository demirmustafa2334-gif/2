<?php include __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo isset($price) ? 'Fiyat Düzenle' : 'Yeni Fiyat Ekle'; ?></h1>
    <a href="<?php echo SITE_URL; ?>/admin/prices" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Geri Dön
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nereden *</label>
                    <select name="from_district_id" class="form-select" required>
                        <option value="">İlçe Seçin</option>
                        <?php foreach ($districts as $district): ?>
                        <option value="<?php echo $district['id']; ?>" 
                                <?php echo (isset($price) && $price['from_district_id'] == $district['id']) ? 'selected' : ''; ?>>
                            <?php echo $district['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nereye *</label>
                    <select name="to_district_id" class="form-select" required>
                        <option value="">İlçe Seçin</option>
                        <?php foreach ($districts as $district): ?>
                        <option value="<?php echo $district['id']; ?>" 
                                <?php echo (isset($price) && $price['to_district_id'] == $district['id']) ? 'selected' : ''; ?>>
                            <?php echo $district['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Taban Fiyat (₺) *</label>
                    <input type="number" name="base_price" class="form-control" step="0.01" 
                           value="<?php echo $price['base_price'] ?? ''; ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">KM Başı Fiyat (₺)</label>
                    <input type="number" name="price_per_km" class="form-control" step="0.01" 
                           value="<?php echo $price['price_per_km'] ?? '0'; ?>">
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Notlar</label>
                <textarea name="notes" class="form-control" rows="3"><?php echo $price['notes'] ?? ''; ?></textarea>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" 
                       <?php echo (isset($price) && $price['is_active']) || !isset($price) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="isActive">Aktif</label>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo isset($price) ? 'Güncelle' : 'Kaydet'; ?>
            </button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
