    </main>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>
                        <i class="fas fa-truck me-2"></i>
                        İstanbul Nakliyat
                    </h5>
                    <p class="mb-3">
                        İstanbul'un tüm ilçe ve semtlerinde güvenilir evden eve nakliyat hizmeti. 
                        Profesyonel ekibimiz ve modern araç filomuzla eşyalarınızı güvenle taşıyoruz.
                    </p>
                    <div class="d-flex">
                        <a href="<?php echo get_setting('social_facebook'); ?>" class="me-3" target="_blank">
                            <i class="fab fa-facebook-f fa-lg"></i>
                        </a>
                        <a href="<?php echo get_setting('social_instagram'); ?>" class="me-3" target="_blank">
                            <i class="fab fa-instagram fa-lg"></i>
                        </a>
                        <a href="<?php echo get_setting('social_twitter'); ?>" class="me-3" target="_blank">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 mb-4">
                    <h5>Hızlı Linkler</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Ana Sayfa</a></li>
                        <li><a href="/hizmetlerimiz">Hizmetlerimiz</a></li>
                        <li><a href="/fiyat-listesi">Fiyat Listesi</a></li>
                        <li><a href="/musteri-yorumlari">Müşteri Yorumları</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/iletisim">İletişim</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h5>İlçeler</h5>
                    <div class="footer-links">
                        <?php foreach ($districts as $district): ?>
                        <a href="/istanbul/<?php echo $district['slug']; ?>-evden-eve-nakliyat">
                            <?php echo $district['name']; ?> Nakliyat
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h5>İletişim Bilgileri</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:<?php echo get_setting('contact_phone'); ?>">
                                <?php echo get_setting('contact_phone'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:<?php echo get_setting('contact_email'); ?>">
                                <?php echo get_setting('contact_email'); ?>
                            </a>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?php echo get_setting('address'); ?>
                        </li>
                        <li class="mb-2">
                            <i class="fab fa-whatsapp me-2"></i>
                            <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')', '-'], '', get_setting('whatsapp_number')); ?>" target="_blank">
                                WhatsApp
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: #4a5568;">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        &copy; <?php echo date('Y'); ?> İstanbul Nakliyat. Tüm hakları saklıdır.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="/gizlilik-politikasi" class="me-3">Gizlilik Politikası</a>
                    <a href="/kullanim-kosullari">Kullanım Koşulları</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/<?php echo str_replace(['+', ' ', '(', ')', '-'], '', get_setting('whatsapp_number')); ?>" 
       class="whatsapp-float" 
       target="_blank"
       title="WhatsApp ile iletişime geç">
        <i class="fab fa-whatsapp me-2"></i>
        WhatsApp
    </a>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(102, 126, 234, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                navbar.style.backdropFilter = 'none';
            }
        });
        
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
        
        // Initialize Swiper for reviews
        if (document.querySelector('.reviews-swiper')) {
            new Swiper('.reviews-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                }
            });
        }
        
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
        
        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?php echo get_setting('site_title'); ?>",
        "description": "<?php echo get_setting('site_description'); ?>",
        "url": "<?php echo SITE_URL; ?>",
        "telephone": "<?php echo get_setting('contact_phone'); ?>",
        "email": "<?php echo get_setting('contact_email'); ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "İstanbul",
            "addressCountry": "TR"
        },
        "serviceArea": {
            "@type": "City",
            "name": "İstanbul"
        },
        "priceRange": "$$",
        "openingHours": "Mo-Su 00:00-23:59",
        "sameAs": [
            "<?php echo get_setting('social_facebook'); ?>",
            "<?php echo get_setting('social_instagram'); ?>",
            "<?php echo get_setting('social_twitter'); ?>"
        ]
    }
    </script>
</body>
</html>