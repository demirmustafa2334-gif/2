<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Yorumlar</h1>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Müşteri</th>
                        <th>Puan</th>
                        <th>Yorum</th>
                        <th>Hizmet</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?php echo $review['id']; ?></td>
                            <td>
                                <strong><?php echo $review['customer_name']; ?></strong><br>
                                <small class="text-muted"><?php echo $review['customer_email']; ?></small>
                            </td>
                            <td>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                            </td>
                            <td><?php echo substr($review['review_text'], 0, 100); ?>...</td>
                            <td><?php echo $review['service_type'] ?: '-'; ?></td>
                            <td>
                                <?php if ($review['is_approved']): ?>
                                <span class="badge bg-success">Onaylı</span>
                                <?php else: ?>
                                <span class="badge bg-warning">Beklemede</span>
                                <?php endif; ?>
                                <?php if ($review['is_featured']): ?>
                                <span class="badge bg-info">Öne Çıkan</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d.m.Y', strtotime($review['created_at'])); ?></td>
                            <td>
                                <?php if (!$review['is_approved']): ?>
                                <a href="<?php echo SITE_URL; ?>/admin/review/approve/<?php echo $review['id']; ?>" 
                                   class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Onayla
                                </a>
                                <?php endif; ?>
                                <a href="<?php echo SITE_URL; ?>/admin/review/delete/<?php echo $review['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Bu yorumu silmek istediğinizden emin misiniz?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Henüz yorum bulunmamaktadır.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
