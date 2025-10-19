    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Site Bilgileri -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="mb-3">
                        <i class="fas fa-map-marked-alt me-2"></i>
                        Yereltanitim.com
                    </h5>
                    <p class="mb-3">
                        Türkiye'nin en kapsamlı turizm rehberi. 81 il, binlerce ilçe, 
                        eşsiz lezzetler ve kültürel zenginlikler.
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
                        <?php if (get_setting('youtube_url')): ?>
                            <a href="<?php echo get_setting('youtube_url'); ?>" target="_blank" class="me-3">
                                <i class="fab fa-youtube fa-lg"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Hızlı Linkler -->
                <div class="col-lg-2 col-md-6">
                    <h6 class="mb-3">Hızlı Linkler</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="<?php echo SITE_URL; ?>" class="text-light text-decoration-none">Ana Sayfa</a>
                        </li>
                        <li class="mb-2">
                            <a href="sehirler.php" class="text-light text-decoration-none">Şehirler</a>
                        </li>
                        <li class="mb-2">
                            <a href="blog.php" class="text-light text-decoration-none">Blog</a>
                        </li>
                        <li class="mb-2">
                            <a href="hakkimizda.php" class="text-light text-decoration-none">Hakkımızda</a>
                        </li>
                        <li class="mb-2">
                            <a href="iletisim.php" class="text-light text-decoration-none">İletişim</a>
                        </li>
                        <li class="mb-2">
                            <a href="sitemap.xml" class="text-light text-decoration-none">Site Haritası</a>
                        </li>
                    </ul>
                </div>
                
                <!-- Popüler Şehirler -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="mb-3">Popüler Şehirler</h6>
                    <div class="row">
                        <?php 
                        $footerCities = new City();
                        $popularFooterCities = $footerCities->getPopularCities(12);
                        $halfCount = ceil(count($popularFooterCities) / 2);
                        ?>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <?php for ($i = 0; $i < $halfCount && $i < count($popularFooterCities); $i++): ?>
                                    <li class="mb-1">
                                        <a href="sehir/<?php echo $popularFooterCities[$i]['slug']; ?>" 
                                           class="text-light text-decoration-none small">
                                            <?php echo htmlspecialchars($popularFooterCities[$i]['name']); ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <?php for ($i = $halfCount; $i < count($popularFooterCities); $i++): ?>
                                    <li class="mb-1">
                                        <a href="sehir/<?php echo $popularFooterCities[$i]['slug']; ?>" 
                                           class="text-light text-decoration-none small">
                                            <?php echo htmlspecialchars($popularFooterCities[$i]['name']); ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Tüm Türkiye Şehirleri (SEO için) -->
                <div class="col-lg-4 col-md-6">
                    <h6 class="mb-3">Türkiye Şehirleri</h6>
                    <div class="cities-grid">
                        <?php 
                        $allTurkishCities = get_turkish_cities();
                        $cityChunks = array_chunk($allTurkishCities, ceil(count($allTurkishCities) / 3), true);
                        ?>
                        <div class="row">
                            <?php foreach ($cityChunks as $chunk): ?>
                                <div class="col-4">
                                    <ul class="list-unstyled">
                                        <?php foreach ($chunk as $plateCode => $cityName): ?>
                                            <li class="mb-1">
                                                <a href="sehir/<?php echo generate_slug($cityName); ?>" 
                                                   class="text-light text-decoration-none small opacity-75">
                                                    <?php echo $cityName; ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            
            <!-- SEO Keywords Footer -->
            <div class="row">
                <div class="col-12">
                    <div class="seo-keywords text-center">
                        <small class="text-muted">
                            <strong>Anahtar Kelimeler:</strong>
                            Türkiye turizm rehberi, şehir rehberleri, yerel lezzetler, turistik yerler, 
                            kültürel özellikler, gezi rehberi, tatil rehberi, İstanbul, Ankara, İzmir, 
                            Antalya, Bursa, Adana, Gaziantep, Konya, Mersin, Diyarbakır, Kayseri, 
                            Eskişehir, Samsun, Denizli, Şanlıurfa, Adapazarı, Malatya, Kahramanmaraş, 
                            Erzurum, Van, Batman, Elazığ, İzmit, Manisa, Sivas, Gebze, Balıkesir, 
                            Tarsus, Kütahya, Trabzon, Çorum, Çorlu, Adıyaman, Osmaniye, Kırıkkale, 
                            Antakya, Aydın, İskenderun, Uşak, Aksaray, Afyon, Isparta, İnegöl, 
                            Tekirdağ, Edirne, Darıca, Ordu, Karaman, Gölcük, Siirt, Körfez, Kızıltepe, 
                            Düzce, Tokat, Bolu, Derince, Turhal, Bandırma, Ceyhan, Nazilli, Zonguldak
                        </small>
                    </div>
                </div>
            </div>
            
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            
            <!-- Alt Footer -->
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 small">
                        &copy; <?php echo date('Y'); ?> Yereltanitim.com. 
                        Tüm hakları saklıdır.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="small">
                        <a href="gizlilik-politikasi.php" class="text-light text-decoration-none me-3">Gizlilik Politikası</a>
                        <a href="kullanim-kosullari.php" class="text-light text-decoration-none me-3">Kullanım Koşulları</a>
                        <a href="cerez-politikasi.php" class="text-light text-decoration-none">Çerez Politikası</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Özel JavaScript -->
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
                navbar.style.background = 'rgba(37, 99, 235, 0.95)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%)';
                navbar.style.backdropFilter = 'none';
            }
        });
        
        // Form validation
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
        
        // Search functionality
        function performSearch(query) {
            if (query.length < 2) return;
            
            fetch(`api/search.php?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    // Handle search results
                    console.log('Search results:', data);
                })
                .catch(error => {
                    console.error('Search error:', error);
                });
        }
        
        // Page view tracking
        document.addEventListener('DOMContentLoaded', function() {
            // Track page view if analytics is enabled
            if (typeof gtag !== 'undefined') {
                gtag('event', 'page_view', {
                    page_title: document.title,
                    page_location: window.location.href
                });
            }
        });
        
        // Click tracking for external links
        document.addEventListener('DOMContentLoaded', function() {
            const externalLinks = document.querySelectorAll('a[href^="http"]:not([href*="yereltanitim.com"])');
            externalLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'click', {
                            event_category: 'outbound',
                            event_label: this.href
                        });
                    }
                });
            });
        });
    </script>
    
    <!-- Schema.org için sayfa özel structured data -->
    <?php if (isset($structuredData)): ?>
        <script type="application/ld+json">
            <?php echo json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
        </script>
    <?php endif; ?>
</body>
</html>