<?php
$page_title = 'Fiyatlandırma Yönetimi';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-dollar-sign me-2"></i>Fiyatlandırma Yönetimi
            </h1>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRouteModal">
                <i class="fas fa-plus me-2"></i>Yeni Fiyat Rotası Ekle
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
                        <th>Nereden</th>
                        <th>Nereye</th>
                        <th>Base Fiyat</th>
                        <th>Km Başına</th>
                        <th>Mesafe (km)</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
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
                        </td>
                        <td>
                            <strong><?php echo htmlspecialchars($route['to_district_name']); ?></strong>
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
                            <?php if ($route['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-primary" onclick="editRoute(<?php echo htmlspecialchars(json_encode($route)); ?>)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?action=pricing&toggle=<?php echo $route['id']; ?>" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-toggle-<?php echo $route['is_active'] ? 'on' : 'off'; ?>"></i>
                                </a>
                                <a href="?action=pricing&delete=<?php echo $route['id']; ?>" class="btn btn-sm btn-outline-danger btn-delete">
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

<!-- Create Route Modal -->
<div class="modal fade" id="createRouteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Fiyat Rotası Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="from_district_id" class="form-label">Nereden (İlçe) *</label>
                                <select class="form-select" id="from_district_id" name="from_district_id" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                    <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="from_neighborhood_id" class="form-label">Nereden (Semt)</label>
                                <select class="form-select" id="from_neighborhood_id" name="from_neighborhood_id">
                                    <option value="">Semt Seçin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="to_district_id" class="form-label">Nereye (İlçe) *</label>
                                <select class="form-select" id="to_district_id" name="to_district_id" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                    <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="to_neighborhood_id" class="form-label">Nereye (Semt)</label>
                                <select class="form-select" id="to_neighborhood_id" name="to_neighborhood_id">
                                    <option value="">Semt Seçin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="base_price" class="form-label">Base Fiyat (₺) *</label>
                                <input type="number" class="form-control" id="base_price" name="base_price" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price_per_km" class="form-label">Km Başına Fiyat (₺)</label>
                                <input type="number" class="form-control" id="price_per_km" name="price_per_km" step="0.01" value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="estimated_distance_km" class="form-label">Tahmini Mesafe (km)</label>
                                <input type="number" class="form-control" id="estimated_distance_km" name="estimated_distance_km" step="0.1" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" name="create_route" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Route Modal -->
<div class="modal fade" id="editRouteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" class="needs-validation" novalidate>
                <input type="hidden" id="edit_route_id" name="route_id">
                <div class="modal-header">
                    <h5 class="modal-title">Fiyat Rotası Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_from_district_id" class="form-label">Nereden (İlçe) *</label>
                                <select class="form-select" id="edit_from_district_id" name="from_district_id" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                    <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_from_neighborhood_id" class="form-label">Nereden (Semt)</label>
                                <select class="form-select" id="edit_from_neighborhood_id" name="from_neighborhood_id">
                                    <option value="">Semt Seçin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_to_district_id" class="form-label">Nereye (İlçe) *</label>
                                <select class="form-select" id="edit_to_district_id" name="to_district_id" required>
                                    <option value="">İlçe Seçin</option>
                                    <?php foreach ($districts as $district): ?>
                                    <option value="<?php echo $district['id']; ?>"><?php echo $district['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_to_neighborhood_id" class="form-label">Nereye (Semt)</label>
                                <select class="form-select" id="edit_to_neighborhood_id" name="to_neighborhood_id">
                                    <option value="">Semt Seçin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_base_price" class="form-label">Base Fiyat (₺) *</label>
                                <input type="number" class="form-control" id="edit_base_price" name="base_price" step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_price_per_km" class="form-label">Km Başına Fiyat (₺)</label>
                                <input type="number" class="form-control" id="edit_price_per_km" name="price_per_km" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_estimated_distance_km" class="form-label">Tahmini Mesafe (km)</label>
                                <input type="number" class="form-control" id="edit_estimated_distance_km" name="estimated_distance_km" step="0.1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" name="update_route" class="btn btn-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Load neighborhoods when district is selected
document.getElementById('from_district_id').addEventListener('change', function() {
    loadNeighborhoods(this.value, 'from_neighborhood_id');
});

document.getElementById('to_district_id').addEventListener('change', function() {
    loadNeighborhoods(this.value, 'to_neighborhood_id');
});

document.getElementById('edit_from_district_id').addEventListener('change', function() {
    loadNeighborhoods(this.value, 'edit_from_neighborhood_id');
});

document.getElementById('edit_to_district_id').addEventListener('change', function() {
    loadNeighborhoods(this.value, 'edit_to_neighborhood_id');
});

function loadNeighborhoods(districtId, selectId) {
    const select = document.getElementById(selectId);
    select.innerHTML = '<option value="">Semt Seçin</option>';
    
    if (!districtId) return;
    
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

// Edit route function
function editRoute(route) {
    document.getElementById('edit_route_id').value = route.id;
    document.getElementById('edit_from_district_id').value = route.from_district_id;
    document.getElementById('edit_to_district_id').value = route.to_district_id;
    document.getElementById('edit_base_price').value = route.base_price;
    document.getElementById('edit_price_per_km').value = route.price_per_km;
    document.getElementById('edit_estimated_distance_km').value = route.estimated_distance_km;
    
    const editModal = new bootstrap.Modal(document.getElementById('editRouteModal'));
    editModal.show();
}
</script>