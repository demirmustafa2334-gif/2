<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Etiketleri -->
    <title><?php echo isset($pageTitle) ? $pageTitle : get_setting('site_title'); ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : get_setting('site_description'); ?>">
    <?php if (isset($pageKeywords)): ?>
        <meta name="keywords" content="<?php echo $pageKeywords; ?>, yereltanitim.com">
    <?php endif; ?>
    
    <!-- Open Graph Meta Etiketleri -->
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle : get_setting('site_title'); ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? $pageDescription : get_setting('site_description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="Yereltanitim.com">
    <meta property="og:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">
    
    <!-- Twitter Card Meta Etiketleri -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($pageTitle) ? $pageTitle : get_setting('site_title'); ?>">
    <meta name="twitter:description" content="<?php echo isset($pageDescription) ? $pageDescription : get_setting('site_description'); ?>">
    <meta name="twitter:image" content="<?php echo SITE_URL; ?>/assets/images/og-image.jpg">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL; ?>/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo SITE_URL; ?>/assets/images/apple-touch-icon.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Özel CSS -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --text-color: #374151;
            --border-color: #e5e7eb;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #ffffff;
        }
        
        /* Header Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 20px rgba(37, 99, 235, 0.1);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
            border-radius: 6px;
        }
        
        .navbar-nav .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 1rem 0;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
            pointer-events: none;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-search {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-form .form-control {
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            border-radius: 50px 0 0 50px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .search-form .btn {
            border-radius: 0 50px 50px 0;
            padding: 1rem 2rem;
            font-weight: 600;
            background: var(--accent-color);
            border: none;
        }
        
        /* Section Styles */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }
        
        .section-subtitle {
            font-size: 1.1rem;
            color: #6b7280;
            margin-bottom: 3rem;
        }
        
        /* City Cards */
        .city-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .city-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }
        
        .city-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .city-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .city-card:hover .city-image img {
            transform: scale(1.1);
        }
        
        .city-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        
        .city-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .city-card:hover .city-overlay {
            opacity: 1;
        }
        
        .city-info h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .city-region {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
        }
        
        .city-stats {
            display: flex;
            gap: 1rem;
        }
        
        .stat-item {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }
        
        .city-content {
            padding: 1.5rem;
        }
        
        .city-content h5 {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--dark-color);
        }
        
        .city-content p {
            color: #6b7280;
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        /* Blog Cards */
        .blog-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .blog-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .blog-placeholder {
            width: 100%;
            height: 100%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 2rem;
        }
        
        .blog-category {
            position: absolute;
            top: 1rem;
            left: 1rem;
        }
        
        .blog-content {
            padding: 1.5rem;
        }
        
        .blog-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
        }
        
        .blog-title a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 600;
            line-height: 1.4;
        }
        
        .blog-title a:hover {
            color: var(--primary-color);
        }
        
        .blog-excerpt {
            color: #6b7280;
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        /* District Cards */
        .district-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .district-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .district-header {
            margin-bottom: 1rem;
        }
        
        .district-header h5 {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }
        
        .district-city {
            color: var(--primary-color);
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .district-description {
            color: #6b7280;
            margin-bottom: 1rem;
            line-height: 1.6;
        }
        
        .district-specialties {
            margin-bottom: 1rem;
        }
        
        .district-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .blog-count {
            color: #6b7280;
            font-size: 0.9rem;
        }
        
        /* Recent Post Cards */
        .recent-post-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .recent-post-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .recent-post-image {
            height: 120px;
            overflow: hidden;
        }
        
        .recent-post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .post-placeholder {
            width: 100%;
            height: 100%;
            background: var(--light-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }
        
        .recent-post-content {
            padding: 1rem;
        }
        
        .post-meta {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .post-title a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            line-height: 1.4;
        }
        
        .post-title a:hover {
            color: var(--primary-color);
        }
        
        .post-excerpt {
            color: #6b7280;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 0;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }
        
        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .cta-subtitle {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .cta-buttons .btn {
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
            color: white;
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
            
            .cta-buttons .btn {
                display: block;
                width: 100%;
                margin-bottom: 1rem;
            }
        }
        
        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Utilities */
        .text-primary { color: var(--primary-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .border-primary { border-color: var(--primary-color) !important; }
    </style>
    
    <!-- Schema.org Yapılandırılmış Veri -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TravelAgency",
        "name": "Yereltanitim.com",
        "description": "<?php echo get_setting('site_description'); ?>",
        "url": "<?php echo SITE_URL; ?>",
        "logo": "<?php echo SITE_URL; ?>/assets/images/logo.png",
        "sameAs": [
            "<?php echo get_setting('facebook_url'); ?>",
            "<?php echo get_setting('instagram_url'); ?>",
            "<?php echo get_setting('twitter_url'); ?>",
            "<?php echo get_setting('youtube_url'); ?>"
        ],
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "<?php echo get_setting('contact_phone'); ?>",
            "contactType": "customer service",
            "email": "<?php echo get_setting('contact_email'); ?>"
        },
        "areaServed": {
            "@type": "Country",
            "name": "Turkey"
        }
    }
    </script>
    
    <?php if (get_setting('google_analytics_id')): ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_setting('google_analytics_id'); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo get_setting('google_analytics_id'); ?>');
    </script>
    <?php endif; ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <i class="fas fa-map-marked-alt me-2"></i>
                Yereltanitim.com
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>">Ana Sayfa</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Şehirler
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            $headerCities = new City();
                            $cities = $headerCities->getActiveCities();
                            foreach ($cities as $city):
                            ?>
                                <li>
                                    <a class="dropdown-item" href="sehir/<?php echo $city['slug']; ?>">
                                        <?php echo htmlspecialchars($city['name']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="sehirler.php">Tüm Şehirler</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="hakkimizda.php">Hakkımızda</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="iletisim.php">İletişim</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <form class="d-flex me-3" action="arama.php" method="GET">
                        <input class="form-control" type="search" name="q" placeholder="Ara..." style="width: 200px;">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>