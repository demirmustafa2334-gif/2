<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - İstanbul Nakliyat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .sidebar a.active {
            background: #007bff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar p-0">
                <div class="p-3 text-white border-bottom">
                    <h5><i class="fas fa-truck-moving"></i> Admin Panel</h5>
                    <small>Hoş geldiniz, <?php echo $_SESSION['admin_username'] ?? 'Admin'; ?></small>
                </div>
                
                <div class="p-2">
                    <a href="<?php echo SITE_URL; ?>/admin/dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/districts">
                        <i class="fas fa-map"></i> İlçeler
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/neighborhoods">
                        <i class="fas fa-map-marker-alt"></i> Semtler
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/services">
                        <i class="fas fa-cogs"></i> Hizmetler
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/prices">
                        <i class="fas fa-money-bill"></i> Fiyatlar
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/reviews">
                        <i class="fas fa-star"></i> Yorumlar
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/messages">
                        <i class="fas fa-envelope"></i> Mesajlar
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/settings">
                        <i class="fas fa-cog"></i> Ayarlar
                    </a>
                    
                    <hr class="bg-light">
                    
                    <a href="<?php echo SITE_URL; ?>/" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Siteyi Görüntüle
                    </a>
                    <a href="<?php echo SITE_URL; ?>/admin/logout">
                        <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                    </a>
                </div>
            </nav>
            
            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-4 py-4">
