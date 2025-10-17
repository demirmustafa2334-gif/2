<?php include __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>İlçeler</h1>
    <a href="<?php echo SITE_URL; ?>/admin/district/add" class="btn btn-primary">
        <i class="fas fa-plus"></i> Yeni İlçe Ekle
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>İlçe Adı</th>
                        <th>Slug</th>
                        <th>Durum</th>
                        <th>Eklenme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($districts)): ?>
                        <?php foreach ($districts as $district): ?>
                        <tr>
                            <td><?php echo $district['id']; ?></td>
                            <td><strong><?php echo $district['name']; ?></strong></td>
                            <td><code><?php echo $district['slug']; ?></code></td>
                            <td>
                                <?php if ($district['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d.m.Y', strtotime($district['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>/istanbul/<?php echo $district['slug']; ?>" 
                                   class="btn btn-sm btn-info" target="_blank" title="Görüntüle">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo SITE_URL; ?>/admin/district/edit/<?php echo $district['id']; ?>" 
                                   class="btn btn-sm btn-warning" title="Düzenle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo SITE_URL; ?>/admin/district/delete/<?php echo $district['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Bu ilçeyi silmek istediğinizden emin misiniz?')"
                                   title="Sil">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Henüz ilçe eklenmemiş.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
