<?php 
$pageTitle = 'Dashboard';
$currentPage = 'dashboard';
$content = ob_start(); 
?>

<div class="row g-4 mb-4">
    <!-- Stats Cards -->
    <div class="col-lg-3 col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Toplam İlçe</h6>
                        <h3 class="mb-0"><?= $stats['districts'] ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Toplam Semt</h6>
                        <h3 class="mb-0"><?= $stats['neighborhoods'] ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-home fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Toplam Yorum</h6>
                        <h3 class="mb-0"><?= $stats['reviews'] ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Blog Yazısı</h6>
                        <h3 class="mb-0"><?= $stats['blog_posts'] ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-blog fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Reviews -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Son Yorumlar</h5>
                <a href="/admin/reviews" class="btn btn-sm btn-outline-primary">Tümünü Gör</a>
            </div>
            <div class="card-body">
                <?php if (!empty($recent_reviews)): ?>
                    <?php foreach ($recent_reviews as $review): ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="review-avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                            <?= strtoupper(substr($review['customer_name'], 0, 1)) ?>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1"><?= $review['customer_name'] ?></h6>
                            <div class="stars text-warning mb-1">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star<?= $i <= $review['rating'] ? '' : '-o' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-muted small mb-0"><?= substr($review['review_text'], 0, 100) ?>...</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-<?= $review['status'] === 'approved' ? 'success' : ($review['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                <?= $review['status'] === 'approved' ? 'Onaylandı' : ($review['status'] === 'pending' ? 'Bekliyor' : 'Reddedildi') ?>
                            </span>
                            <div class="text-muted small"><?= date('d.m.Y', strtotime($review['created_at'])) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center">Henüz yorum bulunmuyor.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Recent Blog Posts -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Son Blog Yazıları</h5>
                <a href="/admin/blog" class="btn btn-sm btn-outline-primary">Tümünü Gör</a>
            </div>
            <div class="card-body">
                <?php if (!empty($recent_posts)): ?>
                    <?php foreach ($recent_posts as $post): ?>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            <h6 class="mb-1"><?= $post['title'] ?></h6>
                            <p class="text-muted small mb-1"><?= substr(strip_tags($post['content']), 0, 100) ?>...</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-<?= $post['status'] === 'published' ? 'success' : 'warning' ?> me-2">
                                    <?= $post['status'] === 'published' ? 'Yayında' : 'Taslak' ?>
                                </span>
                                <small class="text-muted"><?= date('d.m.Y', strtotime($post['created_at'])) ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center">Henüz blog yazısı bulunmuyor.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Hızlı İşlemler</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="/admin/districts" class="btn btn-outline-primary w-100">
                            <i class="fas fa-plus me-2"></i>
                            Yeni İlçe Ekle
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/admin/neighborhoods" class="btn btn-outline-success w-100">
                            <i class="fas fa-plus me-2"></i>
                            Yeni Semt Ekle
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/admin/pricing" class="btn btn-outline-warning w-100">
                            <i class="fas fa-plus me-2"></i>
                            Fiyat Ekle
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="/admin/settings" class="btn btn-outline-info w-100">
                            <i class="fas fa-cog me-2"></i>
                            Ayarları Düzenle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.review-avatar {
    width: 40px;
    height: 40px;
    font-size: 0.9rem;
}

.stars {
    font-size: 0.8rem;
}
</style>

<?php $content = ob_get_clean(); ?>
<?php include 'layouts/main.php'; ?>