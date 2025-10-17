<?php
$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => '/'],
    ['name' => 'İstanbul', 'url' => '/'],
    ['name' => $neighborhood['district_name'], 'url' => '/istanbul/' . $neighborhood['district_slug']],
    ['name' => $neighborhood['name'], 'url' => '/semt/' . $neighborhood['slug']]
];
include __DIR__ . '/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/">İstanbul</a></li>
            <li class="breadcrumb-item">
                <a href="<?php echo SITE_URL; ?>/istanbul/<?php echo $neighborhood['district_slug']; ?>">
                    <?php echo $neighborhood['district_name']; ?>
                </a>
            </li>
            <li class="breadcrumb-item active"><?php echo $neighborhood['name']; ?></li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<section class="neighborhood-page py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mb-4"><?php echo $neighborhood['name']; ?> Evden Eve Nakliyat</h1>
                
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    Bu sayfa <strong><?php echo $neighborhood['district_name']; ?></strong> ilçesine bağlı <strong><?php echo $neighborhood['name']; ?></strong> semtindeki nakliyat hizmetlerimizi içermektedir.
                </div>
                
                <div class="content mb-4">
                    <?php if (!empty($neighborhood['content'])): ?>
                        <?php echo nl2br($neighborhood['content']); ?>
                    <?php else: ?>
                        <p><?php echo $neighborhood['name']; ?> semtinde profesyonel ve güvenilir evden eve nakliyat hizmetleri sunuyoruz. 
                        Bölgeyi çok iyi tanıyan ekibimiz sayesinde taşıma işlemlerinizi en hızlı ve en güvenli şekilde gerçekleştiriyoruz.</p>
                        
                        <h3 class="mt-4"><?php echo $neighborhood['name']; ?> Nakliyat Hizmetleri</h3>
                        <ul>
                            <li>Evden eve nakliyat</li>
                            <li>Ofis taşımacılığı</li>
                            <li>Parça eşya taşıma</li>
                            <li>Asansörlü nakliyat</li>
                            <li>Sigortalı taşıma</li>
                        </ul>
                        
                        <p><?php echo $neighborhood['name']; ?> ve çevresinde yıllardır verdiğimiz hizmetle binlerce müşterimize 
                        güvenli taşımacılık hizmeti sunduk. Uygun fiyatlarımız ve kaliteli hizmet anlayışımızla sektörde öne çıkıyoruz.</p>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($same_district_neighborhoods)): ?>
                <div class="same-district-neighborhoods mb-4">
                    <h3><?php echo $neighborhood['district_name']; ?> - Diğer Semtler</h3>
                    <p><?php echo $neighborhood['district_name']; ?> ilçesinde hizmet verdiğimiz diğer semtler:</p>
                    <div class="row">
                        <?php foreach ($same_district_neighborhoods as $other): ?>
                        <div class="col-md-4 mb-2">
                            <a href="<?php echo SITE_URL; ?>/semt/<?php echo $other['slug']; ?>" 
                               class="btn btn-outline-secondary btn-sm w-100">
                                <?php echo $other['name']; ?> Nakliyat
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="col-lg-4">
                <!-- Contact Card -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Hemen Teklif Alın</h4>
                        <p class="text-muted">Size özel fiyat teklifi için iletişime geçin</p>
                        <div class="d-grid gap-2">
                            <a href="tel:<?php echo $settings['contact_phone'] ?? ''; ?>" class="btn btn-success">
                                <i class="fas fa-phone"></i> Hemen Ara
                            </a>
                            <a href="https://wa.me/<?php echo $settings['whatsapp_number'] ?? ''; ?>" class="btn btn-success" target="_blank">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                            <a href="<?php echo SITE_URL; ?>/iletisim" class="btn btn-primary">
                                <i class="fas fa-envelope"></i> İletişim Formu
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Back to District -->
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">İlçe Bilgileri</h5>
                        <a href="<?php echo SITE_URL; ?>/istanbul/<?php echo $neighborhood['district_slug']; ?>" class="btn btn-outline-primary w-100">
                            <i class="fas fa-arrow-left"></i> <?php echo $neighborhood['district_name']; ?> Sayfasına Dön
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
