<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Hizmetler</h1>

<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> Hizmetler veritabanından yönetilmektedir. Hizmet ekleme/düzenleme özelliği yakında eklenecektir.
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hizmet</th>
                        <th>Slug</th>
                        <th>Sıra</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($services)): ?>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?php echo $service['id']; ?></td>
                            <td>
                                <i class="<?php echo $service['icon'] ?? 'fas fa-box'; ?>"></i>
                                <strong><?php echo $service['title']; ?></strong>
                            </td>
                            <td><code><?php echo $service['slug']; ?></code></td>
                            <td><?php echo $service['display_order']; ?></td>
                            <td>
                                <?php if ($service['is_active']): ?>
                                <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                <span class="badge bg-secondary">Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>/hizmet/<?php echo $service['slug']; ?>" 
                                   class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-eye"></i> Görüntüle
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Henüz hizmet bulunmamaktadır.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
