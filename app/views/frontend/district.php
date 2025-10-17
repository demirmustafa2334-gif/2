<?php
$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => '/'],
    ['name' => 'İstanbul', 'url' => '/'],
    ['name' => $district['name'], 'url' => '/istanbul/' . $district['slug']]
];
include __DIR__ . '/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/">İstanbul</a></li>
            <li class="breadcrumb-item active"><?php echo $district['name']; ?></li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<section class="district-page py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-4"><?php echo $district['name']; ?> Evden Eve Nakliyat</h1>
                
                <div class="content mb-4">
                    <?php if (!empty($district['content'])): ?>
                        <?php echo nl2br($district['content']); ?>
                    <?php else: ?>
                        <p><?php echo $district['name']; ?> ve çevresinde profesyonel evden eve nakliyat hizmetleri sunuyoruz. 
                        Deneyimli ekibimiz ve modern araçlarımızla eşyalarınızı güvenle taşıyoruz.</p>
                        
                        <h3 class="mt-4">Neden Bizi Seçmelisiniz?</h3>
                        <ul>
                            <li>Sigortalı ve güvenli taşıma</li>
                            <li>Profesyonel paketleme hizmeti</li>
                            <li>Uygun ve şeffaf fiyatlandırma</li>
                            <li>7/24 müşteri desteği</li>
                            <li>Deneyimli ve eğitimli personel</li>
                        </ul>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($neighborhoods)): ?>
                <div class="neighborhoods mb-4">
                    <h3><?php echo $district['name']; ?> Semtlerimiz</h3>
                    <p>Aşağıdaki semtlerde de nakliyat hizmetleri sunuyoruz:</p>
                    <div class="row">
                        <?php foreach ($neighborhoods as $neighborhood): ?>
                        <div class="col-md-4 mb-2">
                            <a href="<?php echo SITE_URL; ?>/semt/<?php echo $neighborhood['slug']; ?>" 
                               class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-map-marker-alt"></i> <?php echo $neighborhood['name']; ?>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($services)): ?>
                <div class="services mb-4">
                    <h3>Hizmetlerimiz</h3>
                    <div class="row">
                        <?php foreach ($services as $service): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5><i class="<?php echo $service['icon'] ?? 'fas fa-box'; ?>"></i> <?php echo $service['title']; ?></h5>
                                    <p class="small mb-0"><?php echo $service['short_description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="col-lg-4">
                <!-- Contact Form Sidebar -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Ücretsiz Teklif Alın</h4>
                        <p class="text-muted">Hemen arayın veya form doldurun</p>
                        <div class="d-grid gap-2">
                            <a href="tel:<?php echo $settings['contact_phone'] ?? ''; ?>" class="btn btn-success">
                                <i class="fas fa-phone"></i> <?php echo $settings['contact_phone'] ?? ''; ?>
                            </a>
                            <a href="https://wa.me/<?php echo $settings['whatsapp_number'] ?? ''; ?>" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp"></i> WhatsApp ile İletişim
                            </a>
                            <a href="<?php echo SITE_URL; ?>/iletisim" class="btn btn-primary">
                                <i class="fas fa-envelope"></i> Form Gönder
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php if (!empty($nearby_districts)): ?>
                <!-- Nearby Districts -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Yakın İlçeler</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($nearby_districts as $nearby): ?>
                            <li class="mb-2">
                                <a href="<?php echo SITE_URL; ?>/istanbul/<?php echo $nearby['slug']; ?>">
                                    <i class="fas fa-arrow-right"></i> <?php echo $nearby['name']; ?> Nakliyat
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
