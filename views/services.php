<?php
$meta_title = getMetaTitle('Hizmetlerimiz');
$meta_description = getMetaDescription('Hizmetlerimiz');
$meta_keywords = 'istanbul nakliyat hizmetleri, evden eve nakliyat, ofis taşımacılığı, eşya depolama, ambalajlama';

ob_start();
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <?php echo generateBreadcrumb([['title' => 'Hizmetlerimiz']]); ?>
    </div>
</nav>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-4 fw-bold mb-3">Nakliyat Hizmetlerimiz</h1>
                <p class="lead text-muted">İstanbul'un tüm bölgelerinde profesyonel evden eve nakliyat hizmeti sunuyoruz. Modern araçlarımız ve deneyimli ekibimizle güvenli taşımacılık çözümleri.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Evden Eve Nakliyat</h4>
                    <p class="text-muted">Konut taşımacılığında uzman ekibimizle eşyalarınızı güvenle taşıyoruz. Ambalajlama, yükleme ve teslimat süreçlerinde profesyonel hizmet.</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>Güvenli ambalajlama</li>
                        <li><i class="fas fa-check text-success me-2"></i>Sigortalı taşımacılık</li>
                        <li><i class="fas fa-check text-success me-2"></i>Zamanında teslimat</li>
                        <li><i class="fas fa-check text-success me-2"></i>Montaj hizmeti</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Ofis Taşımacılığı</h4>
                    <p class="text-muted">İş yerlerinizin taşınmasında profesyonel çözümler sunuyoruz. Minimal iş kaybı ile hızlı ve güvenli ofis taşımacılığı.</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>Hafta sonu taşıma</li>
                        <li><i class="fas fa-check text-success me-2"></i>Teknoloji ekipmanları</li>
                        <li><i class="fas fa-check text-success me-2"></i>Hızlı kurulum</li>
                        <li><i class="fas fa-check text-success me-2"></i>Gizlilik garantisi</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Eşya Depolama</h4>
                    <p class="text-muted">Güvenli depolama tesislerimizde eşyalarınızı saklayabilirsiniz. 7/24 güvenlik ve iklim kontrollü ortam.</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>İklim kontrollü depo</li>
                        <li><i class="fas fa-check text-success me-2"></i>7/24 güvenlik</li>
                        <li><i class="fas fa-check text-success me-2"></i>Esnek süre seçenekleri</li>
                        <li><i class="fas fa-check text-success me-2"></i>Online takip</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Ambalajlama Hizmeti</h4>
                    <p class="text-muted">Profesyonel ambalajlama malzemeleri ve teknikleri ile eşyalarınızı koruma altına alıyoruz.</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>Kaliteli ambalaj malzemeleri</li>
                        <li><i class="fas fa-check text-success me-2"></i>Kırılabilir eşya paketleme</li>
                        <li><i class="fas fa-check text-success me-2"></i>Etiketleme sistemi</li>
                        <li><i class="fas fa-check text-success me-2"></i>Özel koruma</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Montaj & Demontaj</h4>
                    <p class="text-muted">Mobilya ve eşyalarınızın montaj ve demontaj işlemlerini profesyonel ekibimizle gerçekleştiriyoruz.</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>Mobilya montajı</li>
                        <li><i class="fas fa-check text-success me-2"></i>Elektronik eşya kurulumu</li>
                        <li><i class="fas fa-check text-success me-2"></i>Güvenli demontaj</li>
                        <li><i class="fas fa-check text-success me-2"></i>Test ve kontrol</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card h-100 text-center p-4">
                    <div class="feature-icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Özel Taşımacılık</h4>
                    <p class="text-muted">Antika, sanat eseri ve değerli eşyalarınız için özel taşımacılık hizmeti sunuyoruz.</p>
                    <ul class="list-unstyled text-start">
                        <li><i class="fas fa-check text-success me-2"></i>Antika taşımacılığı</li>
                        <li><i class="fas fa-check text-success me-2"></i>Sanat eseri koruması</li>
                        <li><i class="fas fa-check text-success me-2"></i>Özel ambalajlama</li>
                        <li><i class="fas fa-check text-success me-2"></i>Sigorta kapsamı</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-3">Hizmet Sürecimiz</h2>
                <p class="lead text-muted">Nakliyat sürecimiz 4 aşamadan oluşur ve her aşamada müşteri memnuniyeti önceliğimizdir.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-3">
                        <span class="fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold mb-3">Keşif & Planlama</h5>
                    <p class="text-muted">Ücretsiz keşif ile eşyalarınızı inceler, en uygun planı hazırlarız.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-3">
                        <span class="fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold mb-3">Ambalajlama</h5>
                    <p class="text-muted">Profesyonel malzemelerle eşyalarınızı güvenle paketleriz.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-3">
                        <span class="fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold mb-3">Taşımacılık</h5>
                    <p class="text-muted">Modern araçlarımızla güvenli ve hızlı taşımacılık gerçekleştiririz.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="text-center">
                    <div class="feature-icon mx-auto mb-3">
                        <span class="fw-bold">4</span>
                    </div>
                    <h5 class="fw-bold mb-3">Teslimat & Kurulum</h5>
                    <p class="text-muted">Eşyalarınızı yerleştirir ve montaj işlemlerini tamamlarız.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-5 fw-bold mb-3">Hizmetlerimizden Faydalanın!</h2>
                <p class="lead mb-4">Profesyonel nakliyat hizmetlerimizle taşınma işleminizi kolaylaştırın. Ücretsiz keşif için hemen iletişime geçin.</p>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="/iletisim" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-phone me-2"></i>Hemen Ara
                </a>
                <a href="https://wa.me/<?php echo str_replace(['+', ' '], '', WHATSAPP_NUMBER); ?>" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="fab fa-whatsapp me-2"></i>WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'layout.php';
?>