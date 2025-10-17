<?php include __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><?php echo isset($district) ? 'İlçe Düzenle' : 'Yeni İlçe Ekle'; ?></h1>
    <a href="<?php echo SITE_URL; ?>/admin/districts" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Geri Dön
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">İlçe Adı *</label>
                    <input type="text" name="name" class="form-control" 
                           value="<?php echo $district['name'] ?? ''; ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Slug (URL) *</label>
                    <input type="text" name="slug" class="form-control" 
                           value="<?php echo $district['slug'] ?? ''; ?>" 
                           placeholder="otomatik-oluşturulacak">
                    <small class="text-muted">Boş bırakırsanız otomatik oluşturulur</small>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Meta Title (SEO)</label>
                <input type="text" name="meta_title" class="form-control" 
                       value="<?php echo $district['meta_title'] ?? ''; ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Meta Description (SEO)</label>
                <textarea name="meta_description" class="form-control" rows="2"><?php echo $district['meta_description'] ?? ''; ?></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">İçerik</label>
                <textarea name="content" class="form-control" rows="6"><?php echo $district['content'] ?? ''; ?></textarea>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" 
                       <?php echo (isset($district) && $district['is_active']) || !isset($district) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="isActive">Aktif</label>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> <?php echo isset($district) ? 'Güncelle' : 'Kaydet'; ?>
            </button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
