<?php
$meta_title = 'İletişim | İstanbul Nakliyat İletişim Bilgileri';
$meta_description = 'İstanbul nakliyat iletişim bilgileri. 7/24 hizmet, ücretsiz keşif, anında teklif. Telefon, e-posta ve WhatsApp iletişim.';
$meta_keywords = 'istanbul nakliyat iletişim, nakliyat telefon, nakliyat e-posta, whatsapp nakliyat';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">İletişim</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">
                    İletişim
                </h1>
                <p class="lead mb-4">
                    7/24 hizmetinizdeyiz. Nakliyat ihtiyaçlarınız için hemen iletişime geçin. 
                    Ücretsiz keşif ve anında teklif alın.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h5 class="card-title">Telefon</h5>
                        <p class="card-text">
                            <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="text-decoration-none">
                                <?php echo get_setting('contact_phone'); ?>
                            </a>
                        </p>
                        <small class="text-muted">7/24 hizmetinizdeyiz</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5 class="card-title">E-posta</h5>
                        <p class="card-text">
                            <a href="mailto:<?php echo get_setting('contact_email'); ?>" class="text-decoration-none">
                                <?php echo get_setting('contact_email'); ?>
                            </a>
                        </p>
                        <small class="text-muted">24 saat içinde yanıt</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="feature-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h5 class="card-title">WhatsApp</h5>
                        <p class="card-text">
                            <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')', '-'], '', get_setting('whatsapp_number')); ?>" 
                               target="_blank" class="text-decoration-none">
                                <?php echo get_setting('whatsapp_number'); ?>
                            </a>
                        </p>
                        <small class="text-muted">Anında mesajlaşma</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>Bize Mesaj Gönderin
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="needs-validation" novalidate>
                            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Ad Soyad *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">E-posta *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Mesajınız *</label>
                                <textarea class="form-control" id="message" name="message" rows="5" 
                                          placeholder="Nakliyat ihtiyaçlarınız hakkında detay verebilirsiniz..." required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="contact_form" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Mesajı Gönder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Konumumuz</h2>
                <p class="lead">İstanbul'un merkezinde hizmet veriyoruz.</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3010.279748889!2d28.9784!3d41.0082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDAwJzI5LjUiTiAyOMKwNTgnNDIuMiJF!5e0!3m2!1str!2str!4v1234567890123!5m2!1str!2str" 
                                    width="100%" 
                                    height="450" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Working Hours Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-clock me-2"></i>Çalışma Saatlerimiz
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Hafta İçi</h6>
                                <p class="mb-0">Pazartesi - Cuma: 08:00 - 18:00</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Hafta Sonu</h6>
                                <p class="mb-0">Cumartesi - Pazar: 09:00 - 17:00</p>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <h6 class="text-primary">7/24 Acil Hizmet</h6>
                            <p class="mb-0">Acil nakliyat ihtiyaçlarınız için 7/24 hizmetinizdeyiz.</p>
                        </div>
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
                <h3 class="mb-3">Hemen Teklif Alın!</h3>
                <p class="mb-0">
                    İletişime geçin ve ücretsiz keşif talep edin. 
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