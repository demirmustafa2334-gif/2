<?php include __DIR__ . '/header.php'; ?>

<section class="service-detail py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/">Ana Sayfa</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/hizmetler">Hizmetler</a></li>
                        <li class="breadcrumb-item active"><?php echo $service['title']; ?></li>
                    </ol>
                </nav>
                
                <div class="text-center mb-4">
                    <i class="<?php echo $service['icon'] ?? 'fas fa-box'; ?> fa-4x text-primary mb-3"></i>
                    <h1><?php echo $service['title']; ?></h1>
                    <p class="lead"><?php echo $service['short_description']; ?></p>
                </div>
                
                <?php if (!empty($service['image'])): ?>
                <img src="<?php echo SITE_URL . '/' . $service['image']; ?>" 
                     alt="<?php echo $service['title']; ?>" 
                     class="img-fluid rounded mb-4">
                <?php endif; ?>
                
                <div class="content">
                    <?php echo nl2br($service['description']); ?>
                </div>
                
                <div class="alert alert-primary mt-4">
                    <h4>Bu hizmetle ilgileniyorum</h4>
                    <p>Detaylı bilgi almak ve fiyat teklifi için hemen iletişime geçin.</p>
                    <a href="<?php echo SITE_URL; ?>/iletisim" class="btn btn-primary">
                        <i class="fas fa-envelope"></i> Teklif Al
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Hızlı İletişim</h5>
                        <div class="d-grid gap-2">
                            <a href="tel:<?php echo $settings['contact_phone'] ?? ''; ?>" class="btn btn-success">
                                <i class="fas fa-phone"></i> <?php echo $settings['contact_phone'] ?? ''; ?>
                            </a>
                            <a href="https://wa.me/<?php echo $settings['whatsapp_number'] ?? ''; ?>" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Diğer Hizmetlerimiz</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php
                        $serviceModel = new Service();
                        $otherServices = $serviceModel->getActive();
                        foreach ($otherServices as $other):
                            if ($other['id'] != $service['id']):
                        ?>
                        <a href="<?php echo SITE_URL; ?>/hizmet/<?php echo $other['slug']; ?>" 
                           class="list-group-item list-group-item-action">
                            <i class="<?php echo $other['icon'] ?? 'fas fa-box'; ?>"></i> <?php echo $other['title']; ?>
                        </a>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
