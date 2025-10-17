<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin Panel' ?> - <?= SITE_NAME ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/admin.css" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="sidebar-header p-3">
                <h5 class="text-white mb-0">
                    <i class="fas fa-truck me-2"></i>
                    Admin Panel
                </h5>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>" href="/admin/dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'districts' ? 'active' : '' ?>" href="/admin/districts">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        İlçeler
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'neighborhoods' ? 'active' : '' ?>" href="/admin/neighborhoods">
                        <i class="fas fa-home me-2"></i>
                        Semtler
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'pricing' ? 'active' : '' ?>" href="/admin/pricing">
                        <i class="fas fa-dollar-sign me-2"></i>
                        Fiyatlar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'reviews' ? 'active' : '' ?>" href="/admin/reviews">
                        <i class="fas fa-star me-2"></i>
                        Yorumlar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'blog' ? 'active' : '' ?>" href="/admin/blog">
                        <i class="fas fa-blog me-2"></i>
                        Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'settings' ? 'active' : '' ?>" href="/admin/settings">
                        <i class="fas fa-cog me-2"></i>
                        Ayarlar
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-danger" href="/admin/logout">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Çıkış Yap
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Main Content -->
        <main class="admin-content">
            <!-- Top Bar -->
            <div class="admin-topbar bg-white shadow-sm p-3 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><?= $pageTitle ?? 'Admin Panel' ?></h4>
                    <div class="d-flex align-items-center">
                        <a href="/" class="btn btn-outline-primary btn-sm me-2" target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i>
                            Siteyi Görüntüle
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>
                                Admin
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/admin/settings">Ayarlar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="/admin/logout">Çıkış Yap</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="page-content">
                <?php if (isset($success) && $success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= $success ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <?= $content ?>
            </div>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="/assets/js/admin.js"></script>
</body>
</html>