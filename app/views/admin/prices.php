<?php include __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Fiyatlar</h1>
    <a href="<?php echo SITE_URL; ?>/admin/price/add" class="btn btn-primary">
        <i class="fas fa-plus"></i> Yeni Fiyat Ekle
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nereden</th>
                        <th>Nereye</th>
                        <th>Taban Fiyat</th>
                        <th>KM Başı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($prices)): ?>
                        <?php foreach ($prices as $price): ?>
                        <tr>
                            <td><?php echo $price['id']; ?></td>
                            <td><strong><?php echo $price['from_district_name']; ?></strong></td>
                            <td><strong><?php echo $price['to_district_name']; ?></strong></td>
                            <td><?php echo number_format($price['base_price'], 2); ?> ₺</td>
                            <td><?php echo number_format($price['price_per_km'], 2); ?> ₺</td>
                            <td>
                                <?php if ($price['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>/admin/price/edit/<?php echo $price['id']; ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo SITE_URL; ?>/admin/price/delete/<?php echo $price['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Bu fiyatı silmek istediğinizden emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Henüz fiyat eklenmemiş.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
