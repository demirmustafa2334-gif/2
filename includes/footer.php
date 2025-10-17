    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3">
                        <i class="fas fa-truck me-2"></i>
                        İstanbul Nakliyat
                    </h5>
                    <p class="mb-3">
                        İstanbul'un en güvenilir nakliyat firması olarak, 
                        profesyonel ekibimizle hizmet veriyoruz.
                    </p>
                    <div class="social-links">
                        <?php if (get_setting('facebook_url')): ?>
                            <a href="<?php echo get_setting('facebook_url'); ?>" target="_blank" class="me-3">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (get_setting('instagram_url')): ?>
                            <a href="<?php echo get_setting('instagram_url'); ?>" target="_blank" class="me-3">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (get_setting('twitter_url')): ?>
                            <a href="<?php echo get_setting('twitter_url'); ?>" target="_blank" class="me-3">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Hızlı Linkler</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?php echo SITE_URL; ?>">Ana Sayfa</a>
                        </li>
                        <li class="mb-2">
                            <a href="hizmetlerimiz">Hizmetlerimiz</a>
                        </li>
                        <li class="mb-2">
                            <a href="fiyat-listesi">Fiyat Listesi</a>
                        </li>
                        <li class="mb-2">
                            <a href="musteri-yorumlari">Müşteri Yorumları</a>
                        </li>
                        <li class="mb-2">
                            <a href="blog">Blog</a>
                        </li>
                        <li class="mb-2">
                            <a href="iletisim">İletişim</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Districts -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="mb-3">Hizmet Verdiğimiz İlçeler</h6>
                    <div class="row">
                        <?php 
                        $footerDistricts = new District();
                        $districts = $footerDistricts->findAll('is_active = 1', 'name ASC', 12);
                        $halfCount = ceil(count($districts) / 2);
                        ?>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <?php for ($i = 0; $i < $halfCount && $i < count($districts); $i++): ?>
                                    <li class="mb-1">
                                        <a href="istanbul/<?php echo $districts[$i]['slug']; ?>" class="small">
                                            <?php echo htmlspecialchars($districts[$i]['name']); ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <?php for ($i = $halfCount; $i < count($districts); $i++): ?>
                                    <li class="mb-1">
                                        <a href="istanbul/<?php echo $districts[$i]['slug']; ?>" class="small">
                                            <?php echo htmlspecialchars($districts[$i]['name']); ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="mb-3">İletişim Bilgileri</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?php echo get_setting('company_address'); ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:<?php echo get_setting('contact_phone'); ?>">
                                <?php echo get_setting('contact_phone'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fab fa-whatsapp me-2"></i>
                            <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')'], '', get_setting('whatsapp_number')); ?>" target="_blank">
                                <?php echo get_setting('whatsapp_number'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:<?php echo get_setting('contact_email'); ?>">
                                <?php echo get_setting('contact_email'); ?>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Working Hours -->
                    <div class="mt-3">
                        <h6 class="mb-2">Çalışma Saatleri</h6>
                        <small class="text-light">
                            <i class="fas fa-clock me-1"></i>
                            7/24 Hizmet Veriyoruz
                        </small>
                    </div>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            
            <!-- Bottom Footer -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 small">
                        &copy; <?php echo date('Y'); ?> <?php echo get_setting('site_title'); ?>. 
                        Tüm hakları saklıdır.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="small">
                        <a href="gizlilik-politikasi" class="me-3">Gizlilik Politikası</a>
                        <a href="kullanim-kosullari" class="me-3">Kullanım Koşulları</a>
                        <a href="sitemap.xml" target="_blank">Site Haritası</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Navbar background change on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(44, 62, 80, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%)';
                navbar.style.backdropFilter = 'none';
            }
        });
        
        // Form validation and submission
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.needs-validation');
            
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
        
        // Lazy loading for images
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
        
        // Price calculator functionality
        function calculatePrice() {
            const fromDistrict = document.getElementById('from_district');
            const toDistrict = document.getElementById('to_district');
            const resultDiv = document.getElementById('price_result');
            
            if (!fromDistrict || !toDistrict || !resultDiv) return;
            
            if (fromDistrict.value && toDistrict.value) {
                resultDiv.innerHTML = '<div class="text-center"><div class="loading"></div> Hesaplanıyor...</div>';
                
                fetch('api/calculate-price.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        from_district_id: fromDistrict.value,
                        to_district_id: toDistrict.value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        resultDiv.innerHTML = `
                            <div class="alert alert-success">
                                <h5><i class="fas fa-calculator me-2"></i>Tahmini Fiyat</h5>
                                <p class="mb-1"><strong>${data.price} ₺</strong> ${data.estimated ? '(Tahmini)' : ''}</p>
                                <small class="text-muted">
                                    ${data.from_district} → ${data.to_district}
                                </small>
                            </div>
                        `;
                    } else {
                        resultDiv.innerHTML = `
                            <div class="alert alert-warning">
                                Fiyat hesaplanamadı. Lütfen iletişime geçin.
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            Bir hata oluştu. Lütfen tekrar deneyin.
                        </div>
                    `;
                });
            }
        }
        
        // Auto-hide alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.style.opacity = '0';
                        setTimeout(() => {
                            alert.remove();
                        }, 300);
                    }
                }, 5000);
            });
        });
        
        // WhatsApp click tracking
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappLinks = document.querySelectorAll('a[href*="wa.me"]');
            whatsappLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Track WhatsApp clicks (you can integrate with Google Analytics here)
                    console.log('WhatsApp link clicked');
                });
            });
        });
    </script>
    
    <!-- Google Analytics (Add your tracking ID) -->
    <!-- 
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_TRACKING_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_TRACKING_ID');
    </script>
    -->
</body>
</html>