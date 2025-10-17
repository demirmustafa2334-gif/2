<?php include __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Semtler</h1>
    <a href="<?php echo SITE_URL; ?>/admin/neighborhood/add" class="btn btn-primary">
        <i class="fas fa-plus"></i> Yeni Semt Ekle
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Semt Adı</th>
                        <th>İlçe</th>
                        <th>Slug</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($neighborhoods)): ?>
                        <?php foreach ($neighborhoods as $neighborhood): ?>
                        <tr>
                            <td><?php echo $neighborhood['id']; ?></td>
                            <td><strong><?php echo $neighborhood['name']; ?></strong></td>
                            <td><?php echo $neighborhood['district_name'] ?? 'N/A'; ?></td>
                            <td><code><?php echo $neighborhood['slug']; ?></code></td>
                            <td>
                                <?php if ($neighborhood['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>/semt/<?php echo $neighborhood['slug']; ?>" 
                                   class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo SITE_URL; ?>/admin/neighborhood/edit/<?php echo $neighborhood['id']; ?>" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo SITE_URL; ?>/admin/neighborhood/delete/<?php echo $neighborhood['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Bu semti silmek istediğinizden emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Henüz semt eklenmemiş.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
