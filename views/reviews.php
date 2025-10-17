<?php
$meta_title = 'Müşteri Yorumları | İstanbul Nakliyat Referansları';
$meta_description = 'İstanbul nakliyat müşteri yorumları ve referansları. Memnun müşterilerimizden gelen gerçek yorumlar. Güvenilir nakliyat hizmeti.';
$meta_keywords = 'istanbul nakliyat yorumları, müşteri yorumları, nakliyat referansları, memnun müşteriler';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Müşteri Yorumları</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">
                    Müşteri Yorumları
                </h1>
                <p class="lead mb-4">
                    Memnun müşterilerimizden gelen gerçek yorumlar. 
                    Hizmet kalitemizi müşteri deneyimlerimizden öğrenin.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-5">
    <div class="container">
        <?php if (!empty($reviews)): ?>
        <div class="row g-4">
            <?php foreach ($reviews as $review): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0"><?php echo htmlspecialchars($review['customer_name']); ?></h6>
                                <div class="d-flex">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo $i <= $review['rating'] ? 'text-warning' : 'text-muted'; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        <p class="card-text fst-italic">
                            "<?php echo htmlspecialchars($review['review_text']); ?>"
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <?php echo date('d.m.Y', strtotime($review['created_at'])); ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body py-5">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Henüz yorum bulunmuyor</h5>
                        <p class="text-muted">Müşteri yorumları yakında eklenecek.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Add Review Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-star me-2"></i>Yorumunuzu Paylaşın
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label">Ad Soyad *</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="customer_email" class="form-label">E-posta *</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="rating" class="form-label">Puan *</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="">Puan Seçin</option>
                                    <option value="5">5 Yıldız - Mükemmel</option>
                                    <option value="4">4 Yıldız - Çok İyi</option>
                                    <option value="3">3 Yıldız - İyi</option>
                                    <option value="2">2 Yıldız - Orta</option>
                                    <option value="1">1 Yıldız - Kötü</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="review_text" class="form-label">Yorumunuz *</label>
                                <textarea class="form-control" id="review_text" name="review_text" rows="4" 
                                          placeholder="Deneyiminizi paylaşın..." required></textarea>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="add_review" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Yorumu Gönder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Müşteri Memnuniyeti</h2>
                <p class="lead">Rakamlarla müşteri memnuniyetimiz.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="display-4 fw-bold text-primary mb-2">4.8</div>
                    <div class="h5">Ortalama Puan</div>
                    <div class="d-flex justify-content-center">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star text-warning"></i>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="text-center">
                    <div class="display-4 fw-bold text-primary mb-2"><?php echo count($reviews); ?></div>
                    <div class="h5">Toplam Yorum</div>
                    <p class="text-muted">Müşteri yorumu</p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="text-center">
                    <div class="display-4 fw-bold text-primary mb-2">98%</div>
                    <div class="h5">Memnuniyet Oranı</div>
                    <p class="text-muted">Müşteri memnuniyeti</p>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="text-center">
                    <div class="display-4 fw-bold text-primary mb-2">1000+</div>
                    <div class="h5">Başarılı Taşıma</div>
                    <p class="text-muted">Tamamlanan işlem</p>
                </div>
            </div>
        </div>
    </div>
</section>