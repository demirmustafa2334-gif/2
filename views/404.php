<?php
$meta_title = '404 - Sayfa Bulunamadı | İstanbul Nakliyat';
$meta_description = 'Aradığınız sayfa bulunamadı. İstanbul nakliyat ana sayfasına dönün veya arama yapın.';
$meta_keywords = '404, sayfa bulunamadı, istanbul nakliyat';

include 'includes/header.php';
?>

<!-- 404 Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <div class="py-5">
                    <div class="display-1 fw-bold text-primary mb-4">404</div>
                    <h1 class="h2 mb-3">Sayfa Bulunamadı</h1>
                    <p class="lead mb-4">
                        Aradığınız sayfa mevcut değil veya taşınmış olabilir. 
                        Ana sayfaya dönün veya arama yapın.
                    </p>
                    
                    <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
                        <a href="/" class="btn btn-primary btn-lg">
                            <i class="fas fa-home me-2"></i>Ana Sayfa
                        </a>
                        <a href="/hizmetlerimiz" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-truck me-2"></i>Hizmetlerimiz
                        </a>
                        <a href="/teklif-al" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-calculator me-2"></i>Teklif Al
                        </a>
                    </div>
                    
                    <!-- Search Form -->
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <form action="/" method="GET" class="d-flex">
                                <input type="text" class="form-control me-2" name="search" placeholder="Arama yapın...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Pages Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Popüler Sayfalar</h2>
                <p class="lead">En çok ziyaret edilen sayfalarımızı inceleyin.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h5 class="card-title">Evden Eve Nakliyat</h5>
                        <p class="card-text">
                            Ev eşyalarınızı güvenle taşıyoruz. Paketleme, yükleme ve yerleştirme hizmetlerimizle tam çözüm.
                        </p>
                        <a href="/hizmetlerimiz" class="btn btn-primary">Detaylar</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h5 class="card-title">Fiyat Listesi</h5>
                        <p class="card-text">
                            Şeffaf ve adil fiyatlandırma politikamızla en uygun nakliyat fiyatlarını sunuyoruz.
                        </p>
                        <a href="/fiyat-listesi" class="btn btn-primary">Detaylar</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5 class="card-title">Müşteri Yorumları</h5>
                        <p class="card-text">
                            Memnun müşterilerimizden gelen gerçek yorumlar. Hizmet kalitemizi müşteri deneyimlerimizden öğrenin.
                        </p>
                        <a href="/musteri-yorumlari" class="btn btn-primary">Detaylar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Nakliyat İhtiyacınız mı Var?</h3>
                <p class="mb-0">
                    Aradığınızı bulamadıysanız, nakliyat ihtiyaçlarınız için hemen iletişime geçin. 
                    Uzman ekibimiz size yardımcı olacak.
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