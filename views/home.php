<?php
$meta_title = get_setting('site_title');
$meta_description = get_setting('site_description');
$meta_keywords = 'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye, güvenilir nakliyat';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-4">
                        İstanbul'un En Güvenilir <span class="text-warning">Nakliyat</span> Hizmeti
                    </h1>
                    <p class="lead mb-4">
                        Profesyonel ekibimiz ve modern araç filomuzla eşyalarınızı güvenle taşıyoruz. 
                        Tüm ilçe ve semtlerde 7/24 hizmet veriyoruz.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="/teklif-al" class="btn btn-warning btn-lg">
                            <i class="fas fa-calculator me-2"></i>Ücretsiz Teklif Al
                        </a>
                        <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-phone me-2"></i>Hemen Ara
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="İstanbul Nakliyat" 
                         class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Neden Bizi Tercih Etmelisiniz?</h2>
                <p class="lead">Profesyonel hizmet anlayışımız ve müşteri memnuniyeti odaklı yaklaşımımızla fark yaratıyoruz.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="card-title">Sigortalı Taşımacılık</h5>
                        <p class="card-text">
                            Tüm eşyalarınız sigorta kapsamında güvence altında. 
                            Herhangi bir hasar durumunda tam tazminat garantisi.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="card-title">7/24 Hizmet</h5>
                        <p class="card-text">
                            Haftanın 7 günü, günün 24 saati hizmetinizdeyiz. 
                            Acil taşıma ihtiyaçlarınız için anında çözüm.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="card-title">Tüm İstanbul</h5>
                        <p class="card-text">
                            İstanbul'un tüm ilçe ve semtlerinde hizmet veriyoruz. 
                            Nerede olursanız olun yanınızdayız.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h5 class="card-title">Modern Araç Filosu</h5>
                        <p class="card-text">
                            En son teknoloji ile donatılmış, temiz ve güvenli araçlarımızla 
                            eşyalarınızı özenle taşıyoruz.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="card-title">Uzman Ekip</h5>
                        <p class="card-text">
                            Deneyimli ve profesyonel ekibimiz, eşyalarınızı en iyi şekilde 
                            paketleyip güvenle taşıyor.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h5 class="card-title">Uygun Fiyat</h5>
                        <p class="card-text">
                            Kaliteli hizmeti en uygun fiyatlarla sunuyoruz. 
                            Şeffaf fiyatlandırma, gizli ücret yok.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Hizmetlerimiz</h2>
                <p class="lead">Evden eve nakliyattan ofis taşımaya kadar geniş hizmet yelpazemiz.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-home me-2"></i>Evden Eve Nakliyat
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Ev eşyalarınızı güvenle taşıyoruz. Paketleme, yükleme, 
                            taşıma ve yerleştirme hizmetlerimizle tam çözüm.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Eşya paketleme</li>
                            <li><i class="fas fa-check text-success me-2"></i>Güvenli taşıma</li>
                            <li><i class="fas fa-check text-success me-2"></i>Yerleştirme</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-building me-2"></i>Ofis Taşımacılığı
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Ofis eşyalarınızı iş süreçlerinizi aksatmadan taşıyoruz. 
                            Hafta sonu ve gece hizmeti mevcut.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Ofis mobilyaları</li>
                            <li><i class="fas fa-check text-success me-2"></i>Bilgisayar ve ekipman</li>
                            <li><i class="fas fa-check text-success me-2"></i>Dosya ve belgeler</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-box me-2"></i>Eşya Depolama
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Güvenli depolama alanlarımızda eşyalarınızı saklayabilirsiniz. 
                            İhtiyacınız olduğunda teslim ediyoruz.
                        </p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Güvenli depo</li>
                            <li><i class="fas fa-check text-success me-2"></i>24/7 güvenlik</li>
                            <li><i class="fas fa-check text-success me-2"></i>Esnek süre</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<?php if (!empty($reviews)): ?>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Müşteri Yorumları</h2>
                <p class="lead">Memnun müşterilerimizden gelen gerçek yorumlar.</p>
            </div>
        </div>
        
        <div class="reviews-swiper swiper">
            <div class="swiper-wrapper">
                <?php foreach ($reviews as $review): ?>
                <div class="swiper-slide">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="card-text fst-italic">"<?php echo htmlspecialchars($review['review_text']); ?>"</p>
                            <h6 class="card-title text-primary"><?php echo htmlspecialchars($review['customer_name']); ?></h6>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Hemen Teklif Alın!</h3>
                <p class="mb-0">
                    Ücretsiz keşif ve fiyat teklifi için hemen iletişime geçin. 
                    Uzman ekibimiz size en uygun çözümü sunacak.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/teklif-al" class="btn btn-warning btn-lg">
                    <i class="fas fa-calculator me-2"></i>Teklif Al
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Recent Blog Posts -->
<?php if (!empty($recentPosts)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Son Blog Yazıları</h2>
                <p class="lead">Nakliyat hakkında güncel bilgiler ve ipuçları.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach ($recentPosts as $post): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <?php if ($post['featured_image']): ?>
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                         class="card-img-top" 
                         alt="<?php echo htmlspecialchars($post['title']); ?>"
                         style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/blog/<?php echo $post['slug']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars(substr(strip_tags($post['excerpt']), 0, 120)); ?>...
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <?php echo date('d.m.Y', strtotime($post['published_at'])); ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="/blog" class="btn btn-outline-primary">
                Tüm Yazıları Görüntüle
            </a>
        </div>
    </div>
</section>
<?php endif; ?>