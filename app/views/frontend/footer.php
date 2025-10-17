    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/<?php echo $settings['whatsapp_number'] ?? WHATSAPP_NUMBER; ?>" 
       class="whatsapp-float" 
       target="_blank"
       title="WhatsApp ile iletişime geç">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer class="footer bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-truck-moving"></i> <?php echo SITE_NAME; ?>
                    </h5>
                    <p><?php echo $settings['site_tagline'] ?? 'Güvenilir ve Profesyonel Taşımacılık Hizmetleri'; ?></p>
                    <p>
                        <i class="fas fa-phone"></i> <?php echo $settings['contact_phone'] ?? ''; ?><br>
                        <i class="fas fa-envelope"></i> <?php echo $settings['contact_email'] ?? ''; ?><br>
                        <i class="fas fa-map-marker-alt"></i> <?php echo $settings['contact_address'] ?? 'İstanbul, Türkiye'; ?>
                    </p>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Hizmetlerimiz</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo SITE_URL; ?>/hizmetler" class="text-white-50">Evden Eve Nakliyat</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/hizmetler" class="text-white-50">Ofis Taşımacılığı</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/hizmetler" class="text-white-50">Parça Eşya Taşıma</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/hizmetler" class="text-white-50">Asansörlü Nakliyat</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">İstanbul İlçelerimiz</h5>
                    <div class="row">
                        <?php if (isset($districts) && !empty($districts)): ?>
                            <?php $half = ceil(count($districts) / 2); ?>
                            <div class="col-6">
                                <ul class="list-unstyled small">
                                    <?php foreach (array_slice($districts, 0, $half) as $district): ?>
                                    <li>
                                        <a href="<?php echo SITE_URL; ?>/istanbul/<?php echo $district['slug']; ?>" 
                                           class="text-white-50">
                                            <?php echo $district['name']; ?> Nakliyat
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled small">
                                    <?php foreach (array_slice($districts, $half) as $district): ?>
                                    <li>
                                        <a href="<?php echo SITE_URL; ?>/istanbul/<?php echo $district['slug']; ?>" 
                                           class="text-white-50">
                                            <?php echo $district['name']; ?> Nakliyat
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <hr class="bg-white">
            
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">
                        <?php echo $settings['footer_text'] ?? '© ' . date('Y') . ' İstanbul Nakliyat. Tüm hakları saklıdır.'; ?>
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="<?php echo SITE_URL; ?>/sitemap.xml" class="text-white-50 me-3">Sitemap</a>
                    <a href="<?php echo SITE_URL; ?>/admin" class="text-white-50">Admin Panel</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo SITE_URL; ?>/public/assets/js/main.js"></script>
</body>
</html>
