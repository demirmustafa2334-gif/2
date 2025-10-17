<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Dashboard</h1>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Toplam İlçe</h6>
                        <h2><?php echo $stats['total_districts']; ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-map fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo SITE_URL; ?>/admin/districts" class="text-white text-decoration-none">
                    Görüntüle <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Toplam Semt</h6>
                        <h2><?php echo $stats['total_neighborhoods']; ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-map-marker-alt fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo SITE_URL; ?>/admin/neighborhoods" class="text-white text-decoration-none">
                    Görüntüle <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Bekleyen Yorum</h6>
                        <h2><?php echo $stats['pending_reviews']; ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-star fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo SITE_URL; ?>/admin/reviews" class="text-white text-decoration-none">
                    Görüntüle <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Okunmamış Mesaj</h6>
                        <h2><?php echo $stats['unread_messages']; ?></h2>
                    </div>
                    <div>
                        <i class="fas fa-envelope fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo SITE_URL; ?>/admin/messages" class="text-white text-decoration-none">
                    Görüntüle <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Hızlı İşlemler</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo SITE_URL; ?>/admin/district/add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni İlçe Ekle
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/neighborhood/add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Semt Ekle
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/price/add" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Yeni Fiyat Ekle
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Sistem Bilgileri</h5>
            </div>
            <div class="card-body">
                <p><strong>PHP Versiyonu:</strong> <?php echo phpversion(); ?></p>
                <p><strong>Site URL:</strong> <?php echo SITE_URL; ?></p>
                <p><strong>Veritabanı:</strong> <?php echo DB_NAME; ?></p>
                <p class="mb-0"><strong>Aktif Hizmetler:</strong> <?php echo $stats['total_services']; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
