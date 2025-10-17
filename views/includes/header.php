<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo isset($meta_title) ? $meta_title : get_setting('site_title'); ?></title>
    <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : get_setting('site_description'); ?>">
    <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : 'istanbul nakliyat, evden eve nakliyat, taşımacılık, nakliye'; ?>">
    <meta name="author" content="İstanbul Nakliyat">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($meta_title) ? $meta_title : get_setting('site_title'); ?>">
    <meta property="og:description" content="<?php echo isset($meta_description) ? $meta_description : get_setting('site_description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="<?php echo get_setting('site_title'); ?>">
    <meta property="og:locale" content="tr_TR">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($meta_title) ? $meta_title : get_setting('site_title'); ?>">
    <meta name="twitter:description" content="<?php echo isset($meta_description) ? $meta_description : get_setting('site_description'); ?>">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo SITE_URL . $_SERVER['REQUEST_URI']; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f7fafc;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            transform: translateY(-2px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            padding: 10px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 1000,0 1000,100 0,80"/></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
            border-radius: 2px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 1.5rem;
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }
        
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            background: #25d366;
            color: white;
            border-radius: 50px;
            padding: 15px 20px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
        }
        
        .whatsapp-float:hover {
            color: white;
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.6);
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .footer {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer h5 {
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }
        
        .footer a {
            color: #cbd5e0;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer a:hover {
            color: var(--accent-color);
            transform: translateX(5px);
        }
        
        .footer-links {
            columns: 3;
            column-gap: 2rem;
        }
        
        .footer-links a {
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .breadcrumb {
            background: var(--bg-light);
            border-radius: 10px;
            padding: 1rem;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: var(--primary-color);
            font-weight: bold;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--text-light);
        }
        
        .swiper-pagination-bullet-active {
            background: var(--primary-color) !important;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--primary-color) !important;
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .footer-links {
                columns: 2;
            }
            
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
                padding: 12px 16px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-truck me-2"></i>
                İstanbul Nakliyat
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hizmetlerimiz">Hizmetlerimiz</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="districtsDropdown" role="button" data-bs-toggle="dropdown">
                            İlçeler
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($districts as $district): ?>
                            <li><a class="dropdown-item" href="/istanbul/<?php echo $district['slug']; ?>-evden-eve-nakliyat"><?php echo $district['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/fiyat-listesi">Fiyat Listesi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/musteri-yorumlari">Müşteri Yorumları</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/iletisim">İletişim</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <a href="/teklif-al" class="btn btn-outline-light me-2">
                        <i class="fas fa-calculator me-2"></i>Teklif Al
                    </a>
                    <a href="tel:<?php echo get_setting('contact_phone'); ?>" class="btn btn-light">
                        <i class="fas fa-phone me-2"></i><?php echo get_setting('contact_phone'); ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main style="margin-top: 80px;">