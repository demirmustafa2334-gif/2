<?php
$page_title = 'Semt Yönetimi';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-map me-2"></i>Semt Yönetimi
            </h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNeighborhoodModal">
                <i class="fas fa-plus me-2"></i>Yeni Semt Ekle
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
                        <th>Semt Adı</th>
                        <th>İlçe</th>
                        <th>Slug</th>
                        <th>Durum</th>
                        <th>Oluşturulma</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($neighborhoods as $neighborhood): ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($neighborhood['name']); ?></strong>
                            <?php if ($neighborhood['description']): ?>
                                <br><small class="text-muted"><?php echo htmlspecialchars(substr($neighborhood['description'], 0, 100)); ?>...</small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-primary"><?php echo htmlspecialchars($neighborhood['district_name']); ?></span>
                        </td>
                        <td>
                            <code><?php echo htmlspecialchars($neighborhood['slug']); ?></code>
                        </td>
                        <td>
                            <?php if ($neighborhood['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date('d.m.Y H:i', strtotime($neighborhood['created_at'])); ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="editNeighborhood(<?php echo htmlspecialchars(json_encode($neighborhood)); ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?action=neighborhoods&toggle=<?php echo $neighborhood['id']; ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-toggle-<?php echo $neighborhood['is_active'] ? 'on' : 'off'; ?>"></i>
                                </a>
                                <a href="?action=neighborhoods&delete=<?php echo $neighborhood['id']; ?>" class="btn btn-sm btn-outline-danger btn-delete">
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

<!-- Create Neighborhood Modal -->
<div class="modal fade" id="createNeighborhoodModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Semt Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="district_id" class="form-label">İlçe *</label>
                                <select class="form-select" id="district_id" name="district_id" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                    <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Semt Adı *</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" readonly>
                        <small class="form-text text-muted">Otomatik oluşturulur</small>
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
                    <button type="submit" name="create_neighborhood" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Neighborhood Modal -->
<div class="modal fade" id="editNeighborhoodModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" id="edit_neighborhood_id" name="neighborhood_id">
                <div class="modal-header">
                    <h5 class="modal-title">Semt Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_district_id" class="form-label">İlçe *</label>
                                <select class="form-select" id="edit_district_id" name="district_id" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                    <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_name" class="form-label">Semt Adı *</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="edit_slug" name="slug" readonly>
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
                    <button type="submit" name="update_neighborhood" class="btn btn-primary">Güncelle</button>
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

// Edit neighborhood function
function editNeighborhood(neighborhood) {
    document.getElementById('edit_neighborhood_id').value = neighborhood.id;
    document.getElementById('edit_district_id').value = neighborhood.district_id;
    document.getElementById('edit_name').value = neighborhood.name;
    document.getElementById('edit_slug').value = neighborhood.slug;
    document.getElementById('edit_description').value = neighborhood.description || '';
    document.getElementById('edit_meta_title').value = neighborhood.meta_title || '';
    document.getElementById('edit_meta_description').value = neighborhood.meta_description || '';
    document.getElementById('edit_meta_keywords').value = neighborhood.meta_keywords || '';
    
    const editModal = new bootstrap.Modal(document.getElementById('editNeighborhoodModal'));
    editModal.show();
}
</script>