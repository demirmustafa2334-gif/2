<?php
$page_title = 'İlçe Yönetimi';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-map-marker-alt me-2"></i>İlçe Yönetimi
            </h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDistrictModal">
                <i class="fas fa-plus me-2"></i>Yeni İlçe Ekle
            </button>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>İlçe Adı</th>
                        <th>Slug</th>
                        <th>Durum</th>
                        <th>Oluşturulma</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($districts as $district): ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($district['name']); ?></strong>
                            <?php if ($district['description']): ?>
                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($district['description'], 0, 100)); ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <code><?php echo htmlspecialchars($district['slug']); ?></code>
                        </td>
                        <td>
                            <?php if ($district['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date('d.m.Y H:i', strtotime($district['created_at'])); ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="editDistrict(<?php echo htmlspecialchars(json_encode($district)); ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?action=districts&toggle=<?php echo $district['id']; ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-toggle-<?php echo $district['is_active'] ? 'on' : 'off'; ?>"></i>
                                </a>
                                <a href="?action=districts&delete=<?php echo $district['id']; ?>" class="btn btn-sm btn-outline-danger btn-delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create District Modal -->
<div class="modal fade" id="createDistrictModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Yeni İlçe Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">İlçe Adı *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" readonly>
                                <small class="form-text text-muted">Otomatik oluşturulur</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Başlık</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title">
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Açıklama</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Anahtar Kelimeler</label>
                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="nakliyat, evden eve, taşımacılık">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" name="create_district" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit District Modal -->
<div class="modal fade" id="editDistrictModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" id="edit_district_id" name="district_id">
                <div class="modal-header">
                    <h5 class="modal-title">İlçe Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">İlçe Adı *</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="edit_slug" name="slug" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Açıklama</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_meta_title" class="form-label">Meta Başlık</label>
                        <input type="text" class="form-control" id="edit_meta_title" name="meta_title">
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_meta_description" class="form-label">Meta Açıklama</label>
                        <textarea class="form-control" id="edit_meta_description" name="meta_description" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_meta_keywords" class="form-label">Meta Anahtar Kelimeler</label>
                        <input type="text" class="form-control" id="edit_meta_keywords" name="meta_keywords">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" name="update_district" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .replace(/ç/g, 'c')
        .replace(/ğ/g, 'g')
        .replace(/ı/g, 'i')
        .replace(/ö/g, 'o')
        .replace(/ş/g, 's')
        .replace(/ü/g, 'u')
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});

// Edit district function
function editDistrict(district) {
    document.getElementById('edit_district_id').value = district.id;
    document.getElementById('edit_name').value = district.name;
    document.getElementById('edit_slug').value = district.slug;
    document.getElementById('edit_description').value = district.description || '';
    document.getElementById('edit_meta_title').value = district.meta_title || '';
    document.getElementById('edit_meta_description').value = district.meta_description || '';
    document.getElementById('edit_meta_keywords').value = district.meta_keywords || '';
    
    const editModal = new bootstrap.Modal(document.getElementById('editDistrictModal'));
    editModal.show();
}
</script>