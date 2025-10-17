<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'İstanbul Nakliyat'; ?></title>
    <meta name="description" content="<?php echo $meta_description ?? 'İstanbul genelinde profesyonel evden eve nakliyat hizmetleri'; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:title" content="<?php echo $title ?? 'İstanbul Nakliyat'; ?>">
    <meta property="og:description" content="<?php echo $meta_description ?? ''; ?>">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="twitter:title" content="<?php echo $title ?? 'İstanbul Nakliyat'; ?>">
    <meta property="twitter:description" content="<?php echo $meta_description ?? ''; ?>">
    
    <!-- Schema.org markup for Local Business -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MovingCompany",
        "name": "<?php echo SITE_NAME; ?>",
        "url": "<?php echo SITE_URL; ?>",
        "telephone": "<?php echo $settings['contact_phone'] ?? ''; ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "İstanbul",
            "addressCountry": "TR"
        }
    }
    </script>
    
    <!-- Breadcrumb Schema -->
    <?php if (isset($breadcrumbs)): ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            <?php foreach ($breadcrumbs as $index => $breadcrumb): ?>
            {
                "@type": "ListItem",
                "position": <?php echo $index + 1; ?>,
                "name": "<?php echo $breadcrumb['name']; ?>",
                "item": "<?php echo SITE_URL . $breadcrumb['url']; ?>"
            }<?php echo ($index < count($breadcrumbs) - 1) ? ',' : ''; ?>
            <?php endforeach; ?>
        ]
    }
    </script>
    <?php endif; ?>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/public/assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="top-bar bg-primary text-white py-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <i class="fas fa-phone"></i> <?php echo $settings['contact_phone'] ?? ''; ?>
                        <i class="fas fa-envelope ms-3"></i> <?php echo $settings['contact_email'] ?? ''; ?>
                    </div>
                    <div class="col-md-6 text-end">
                        <?php if (!empty($settings['facebook_url'])): ?>
                        <a href="<?php echo $settings['facebook_url']; ?>" class="text-white ms-2"><i class="fab fa-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['instagram_url'])): ?>
                        <a href="<?php echo $settings['instagram_url']; ?>" class="text-white ms-2"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($settings['twitter_url'])): ?>
                        <a href="<?php echo $settings['twitter_url']; ?>" class="text-white ms-2"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4" href="<?php echo SITE_URL; ?>/">
                    <i class="fas fa-truck-moving text-primary"></i> <?php echo SITE_NAME; ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/">Ana Sayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/hizmetler">Hizmetlerimiz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/fiyatlar">Fiyatlar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/yorumlar">Yorumlar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>/iletisim">İletişim</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="<?php echo SITE_URL; ?>/iletisim">Teklif Al</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
