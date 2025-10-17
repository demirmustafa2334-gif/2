<?php include __DIR__ . '/header.php'; ?>

<section class="services-page py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Hizmetlerimiz</h1>
            <p class="text-muted">İstanbul genelinde sunduğumuz profesyonel taşımacılık hizmetleri</p>
        </div>
        
        <div class="row">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm service-card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="<?php echo $service['icon'] ?? 'fas fa-box'; ?> fa-4x text-primary"></i>
                            </div>
                            <h3 class="card-title h5"><?php echo $service['title']; ?></h3>
                            <p class="card-text"><?php echo $service['short_description']; ?></p>
                            <a href="<?php echo SITE_URL; ?>/hizmet/<?php echo $service['slug']; ?>" class="btn btn-primary">
                                Detaylı Bilgi <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-muted">Henüz hizmet eklenmemiş.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
