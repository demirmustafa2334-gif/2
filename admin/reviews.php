<?php
$page_title = 'Yorum Yönetimi';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">
                <i class="fas fa-star me-2"></i>Yorum Yönetimi
            </h1>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Müşteri</th>
                        <th>E-posta</th>
                        <th>Puan</th>
                        <th>Yorum</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td>
                            <strong><?php echo htmlspecialchars($review['customer_name']); ?></strong>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($review['customer_email']); ?>
                        </td>
                        <td>
                            <div class="d-flex">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </td>
                        <td>
                            <div style="max-width: 300px;">
                                <?php echo htmlspecialchars(substr($review['review_text'], 0, 100)); ?>
                                <?php if (strlen($review['review_text']) > 100): ?>...<?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($review['is_approved']): ?>
                                <span class="badge bg-success">Onaylandı</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Bekliyor</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo date('d.m.Y H:i', strtotime($review['created_at'])); ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <?php if (!$review['is_approved']): ?>
                                <a href="?action=reviews&approve=<?php echo $review['id']; ?>" 
                                   class="btn btn-sm btn-outline-success" 
                                   title="Onayla">
                                    <i class="fas fa-check"></i>
                                </a>
                                <?php endif; ?>
                                <a href="?action=reviews&delete=<?php echo $review['id']; ?>" 
                                   class="btn btn-sm btn-outline-danger btn-delete" 
                                   title="Sil">
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