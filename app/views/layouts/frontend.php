<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $metaTitle ?? getSetting('site_name', 'İstanbul Nakliyat') ?></title>
    <meta name="description" content="<?= $metaDescription ?? getSetting('site_description', config('default_meta_description')) ?>">
    <meta name="keywords" content="<?= $metaKeywords ?? config('default_meta_keywords') ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= $metaTitle ?? getSetting('site_name') ?>">
    <meta property="og:description" content="<?= $metaDescription ?? getSetting('site_description') ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= url($_SERVER['REQUEST_URI']) ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $metaTitle ?? getSetting('site_name') ?>">
    <meta name="twitter:description" content="<?= $metaDescription ?? getSetting('site_description') ?>">
    
    <!-- Schema.org -->
    <script type="application/ld+json">
        <?= generateLocalBusinessSchema() ?>
    </script>
    
    <?php if (isset($breadcrumbs)): ?>
    <script type="application/ld+json">
        <?= generateBreadcrumbs($breadcrumbs) ?>
    </script>
    <?php endif; ?>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <a href="/" class="text-2xl font-bold text-blue-600">
                    <?= getSetting('site_name', 'İstanbul Nakliyat') ?>
                </a>
                
                <nav class="hidden md:flex space-x-6">
                    <a href="/" class="text-gray-700 hover:text-blue-600">Ana Sayfa</a>
                    <a href="/hizmetlerimiz" class="text-gray-700 hover:text-blue-600">Hizmetlerimiz</a>
                    <a href="/fiyat-listesi" class="text-gray-700 hover:text-blue-600">Fiyat Listesi</a>
                    <a href="/yorumlar" class="text-gray-700 hover:text-blue-600">Yorumlar</a>
                    <a href="/blog" class="text-gray-700 hover:text-blue-600">Blog</a>
                    <a href="/iletisim" class="text-gray-700 hover:text-blue-600">İletişim</a>
                </nav>
                
                <div class="flex items-center space-x-4">
                    <a href="tel:<?= getSetting('contact_phone') ?>" class="text-blue-600 font-semibold">
                        <i class="fas fa-phone mr-2"></i><?= getSetting('contact_phone') ?>
                    </a>
                    <a href="/iletisim" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Teklif Al
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6 mt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4"><?= getSetting('site_name') ?></h3>
                    <p class="text-gray-400"><?= getSetting('site_description') ?></p>
                    <div class="mt-4 space-y-2">
                        <p><i class="fas fa-phone mr-2"></i><?= getSetting('contact_phone') ?></p>
                        <p><i class="fas fa-envelope mr-2"></i><?= getSetting('contact_email') ?></p>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Hızlı Linkler</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white">Ana Sayfa</a></li>
                        <li><a href="/hizmetlerimiz" class="text-gray-400 hover:text-white">Hizmetlerimiz</a></li>
                        <li><a href="/fiyat-listesi" class="text-gray-400 hover:text-white">Fiyat Listesi</a></li>
                        <li><a href="/yorumlar" class="text-gray-400 hover:text-white">Müşteri Yorumları</a></li>
                        <li><a href="/blog" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="/iletisim" class="text-gray-400 hover:text-white">İletişim</a></li>
                    </ul>
                </div>
                
                <!-- Districts -->
                <div>
                    <h3 class="text-xl font-bold mb-4">İlçeler</h3>
                    <ul class="space-y-2">
                        <?php foreach (getActiveDistricts() as $district): ?>
                            <li>
                                <a href="/istanbul/<?= $district['slug'] ?>" class="text-gray-400 hover:text-white">
                                    <?= escape($district['name']) ?> Nakliyat
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Bizi Takip Edin</h3>
                    <div class="flex space-x-4">
                        <?php if ($fb = getSetting('facebook_url')): ?>
                            <a href="<?= $fb ?>" target="_blank" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-facebook"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($ig = getSetting('instagram_url')): ?>
                            <a href="<?= $ig ?>" target="_blank" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-instagram"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ($tw = getSetting('twitter_url')): ?>
                            <a href="<?= $tw ?>" target="_blank" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; <?= date('Y') ?> <?= getSetting('site_name') ?>. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/<?= getSetting('whatsapp_number') ?>" 
       target="_blank" 
       class="fixed bottom-6 right-6 bg-green-500 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 z-50">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
