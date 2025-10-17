<?php include __DIR__ . '/header.php'; ?>

<section class="contact-page py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">İletişim</h1>
            <p class="text-muted">Bizimle iletişime geçin, size en kısa sürede dönüş yapalım</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">İletişim Bilgileri</h3>
                        
                        <div class="contact-info mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-phone fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">Telefon</h5>
                                    <a href="tel:<?php echo $settings['contact_phone'] ?? ''; ?>">
                                        <?php echo $settings['contact_phone'] ?? ''; ?>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">E-posta</h5>
                                    <a href="mailto:<?php echo $settings['contact_email'] ?? ''; ?>">
                                        <?php echo $settings['contact_email'] ?? ''; ?>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">Adres</h5>
                                    <p class="mb-0"><?php echo $settings['contact_address'] ?? 'İstanbul, Türkiye'; ?></p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <i class="fab fa-whatsapp fa-2x text-primary me-3"></i>
                                <div>
                                    <h5 class="mb-0">WhatsApp</h5>
                                    <a href="https://wa.me/<?php echo $settings['whatsapp_number'] ?? ''; ?>" target="_blank">
                                        WhatsApp ile mesaj gönder
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="social-links">
                            <h5 class="mb-3">Sosyal Medya</h5>
                            <?php if (!empty($settings['facebook_url'])): ?>
                            <a href="<?php echo $settings['facebook_url']; ?>" class="btn btn-outline-primary me-2" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($settings['instagram_url'])): ?>
                            <a href="<?php echo $settings['instagram_url']; ?>" class="btn btn-outline-primary me-2" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <?php endif; ?>
                            <?php if (!empty($settings['twitter_url'])): ?>
                            <a href="<?php echo $settings['twitter_url']; ?>" class="btn btn-outline-primary me-2" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body p-4">
                        <h3 class="card-title mb-4">Mesaj Gönderin</h3>
                        
                        <form id="contactForm">
                            <div class="mb-3">
                                <label class="form-label">Adınız Soyadınız *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">E-posta *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Telefon</label>
                                <input type="tel" name="phone" class="form-control">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Konu</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nereden</label>
                                    <select name="from_location" class="form-select">
                                        <option value="">Seçiniz</option>
                                        <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district['name']; ?>"><?php echo $district['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nereye</label>
                                    <select name="to_location" class="form-select">
                                        <option value="">Seçiniz</option>
                                        <?php foreach ($districts as $district): ?>
                                        <option value="<?php echo $district['name']; ?>"><?php echo $district['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Mesajınız *</label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-paper-plane"></i> Mesajı Gönder
                            </button>
                        </form>
                        
                        <div id="contactSuccess" class="alert alert-success mt-3" style="display:none;"></div>
                        <div id="contactError" class="alert alert-danger mt-3" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const button = this.querySelector('button[type="submit"]');
    const originalText = button.innerHTML;
    
    button.disabled = true;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
    
    fetch('<?php echo SITE_URL; ?>/iletisim-gonder', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('contactError').style.display = 'none';
        document.getElementById('contactSuccess').style.display = 'none';
        
        if (data.success) {
            document.getElementById('contactSuccess').textContent = data.message;
            document.getElementById('contactSuccess').style.display = 'block';
            document.getElementById('contactForm').reset();
        } else {
            document.getElementById('contactError').textContent = data.message;
            document.getElementById('contactError').style.display = 'block';
        }
        
        button.disabled = false;
        button.innerHTML = originalText;
    })
    .catch(error => {
        document.getElementById('contactError').textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
        document.getElementById('contactError').style.display = 'block';
        button.disabled = false;
        button.innerHTML = originalText;
    });
});
</script>

<?php include __DIR__ . '/footer.php'; ?>
