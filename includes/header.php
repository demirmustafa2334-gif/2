<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo isset($pageTitle) ? $pageTitle : get_setting('site_title'); ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : get_setting('site_description'); ?>">
    <?php if (isset($pageKeywords)): ?>
        <meta name="keywords" content="<?php echo $pageKeywords; ?>">
    <?php endif; ?>
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle : get_setting('site_title'); ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? $pageDescription : get_setting('site_description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="<?php echo get_setting('site_title'); ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($pageTitle) ? $pageTitle : get_setting('site_title'); ?>">
    <meta name="twitter:description" content="<?php echo isset($pageDescription) ? $pageDescription : get_setting('site_description'); ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL; ?>/assets/images/favicon.ico">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #f39c12;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--dark-text);
        }
        
        /* Header Styles */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 5px;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 70vh;
            display: flex;
            align-items: center;
        }
        
        /* Section Titles */
        .section-title {
            position: relative;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
        }
        
        /* Service Cards */
        .service-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .service-icon {
            background: rgba(52, 152, 219, 0.1);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        /* District Cards */
        .district-card .card {
            transition: all 0.3s ease;
        }
        
        .district-card:hover .card {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Review Cards */
        .review-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        
        .review-text {
            font-style: italic;
            color: #666;
            line-height: 1.6;
        }
        
        .rating-display {
            font-size: 1.2rem;
        }
        
        /* Blog Cards */
        .blog-card .card {
            transition: all 0.3s ease;
        }
        
        .blog-card:hover .card {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Buttons */
        .btn {
            border-radius: 25px;
            font-weight: 600;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--accent-color) 0%, #e67e22 100%);
            border: none;
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #229954 100%);
            border: none;
        }
        
        /* WhatsApp Float Button */
        .whatsapp-float {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .whatsapp-float .btn {
            width: 60px;
            height: 60px;
            box-shadow: 0 5px 20px rgba(37, 211, 102, 0.3);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a252f 100%);
            color: white;
        }
        
        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: var(--accent-color);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 60vh;
                text-align: center;
            }
            
            .display-4 {
                font-size: 2rem;
            }
            
            .whatsapp-float {
                bottom: 15px;
                right: 15px;
            }
            
            .whatsapp-float .btn {
                width: 50px;
                height: 50px;
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
        
        /* Form Styles */
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
        }
        
        .breadcrumb-item a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--primary-color);
        }
    </style>
    
    <!-- Schema.org Structured Data -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "MovingCompany",
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
            "@type": "GeoCircle",
            "geoMidpoint": {
                "@type": "GeoCoordinates",
                "latitude": 41.0082,
                "longitude": 28.9784
            },
            "geoRadius": "50000"
        },
        "services": [
            "Evden Eve Nakliyat",
            "Ofis Taşımacılığı", 
            "Eşya Depolama"
        ]
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <i class="fas fa-truck me-2"></i>
                İstanbul Nakliyat
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hizmetlerimiz">Hizmetlerimiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fiyat-listesi">Fiyatlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="musteri-yorumlari">Yorumlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="iletisim">İletişim</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="btn btn-outline-light me-2">
                        <i class="fas fa-phone me-1"></i>
                        <?php echo get_setting('contact_phone'); ?>
                    </a>
                    <a href="fiyat-hesapla" class="btn btn-warning">
                        <i class="fas fa-calculator me-1"></i>
                        Fiyat Hesapla
                    </a>
                </div>
            </div>
        </div>
    </nav>