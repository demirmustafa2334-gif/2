<?php
$page_title = 'Dashboard';
include 'includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <h1 class="h3 mb-4">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number"><?php echo $stats['total_districts']; ?></div>
                    <div class="stats-label">Toplam İlçe</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number"><?php echo $stats['total_neighborhoods']; ?></div>
                    <div class="stats-label">Toplam Semt</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-map"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number"><?php echo $stats['total_reviews']; ?></div>
                    <div class="stats-label">Toplam Yorum</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stats-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="stats-number"><?php echo $stats['published_posts']; ?></div>
                    <div class="stats-label">Yayınlanan Yazı</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-blog"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-circle me-2"></i>Bekleyen İşlemler
                </h5>
            </div>
            <div class="card-body">
                <?php if ($stats['pending_reviews'] > 0): ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-star me-2"></i>
                        <strong><?php echo $stats['pending_reviews']; ?></strong> yorum onay bekliyor.
                        <a href="?action=reviews" class="btn btn-sm btn-warning ms-2">İncele</a>
                    </div>
                <?php else: ?>
                    <div class="text-muted">
                        <i class="fas fa-check-circle me-2"></i>
                        Bekleyen işlem bulunmuyor.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>Hızlı İşlemler
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="?action=districts" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Yeni İlçe Ekle
                    </a>
                    <a href="?action=neighborhoods" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Yeni Semt Ekle
                    </a>
                    <a href="?action=blog" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Yeni Blog Yazısı
                    </a>
                    <a href="?action=pricing" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Fiyat Rotası Ekle
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Sistem Bilgileri
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Site Ayarları</h6>
                        <ul class="list-unstyled">
                            <li><strong>Site Başlığı:</strong> <?php echo get_setting('site_title'); ?></li>
                            <li><strong>İletişim Telefonu:</strong> <?php echo get_setting('contact_phone'); ?></li>
                            <li><strong>E-posta:</strong> <?php echo get_setting('contact_email'); ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Son Güncellemeler</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-clock me-2"></i>Son giriş: <?php echo date('d.m.Y H:i'); ?></li>
                            <li><i class="fas fa-user me-2"></i>Kullanıcı: <?php echo $_SESSION['admin_username']; ?></li>
                            <li><i class="fas fa-server me-2"></i>PHP Sürümü: <?php echo PHP_VERSION; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>