<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Admin Paneli - İstanbul Nakliyat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 70px;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            border-radius: 10px;
            margin: 5px 15px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }
        .main-content.expanded {
            margin-left: 70px;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .content-wrapper {
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .badge {
            border-radius: 20px;
            padding: 8px 12px;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .stats-card .stats-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .stats-card .stats-number {
            font-size: 2rem;
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="p-3">
            <div class="text-center mb-4">
                <i class="fas fa-truck fa-2x text-white"></i>
                <h5 class="text-white mt-2" id="sidebar-title">İstanbul Nakliyat</h5>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'dashboard' ? 'active' : ''; ?>" href="?action=dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'districts' ? 'active' : ''; ?>" href="?action=districts">
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="sidebar-text">İlçeler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'neighborhoods' ? 'active' : ''; ?>" href="?action=neighborhoods">
                        <i class="fas fa-map"></i>
                        <span class="sidebar-text">Semtler</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'reviews' ? 'active' : ''; ?>" href="?action=reviews">
                        <i class="fas fa-star"></i>
                        <span class="sidebar-text">Yorumlar</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'blog' ? 'active' : ''; ?>" href="?action=blog">
                        <i class="fas fa-blog"></i>
                        <span class="sidebar-text">Blog</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'pricing' ? 'active' : ''; ?>" href="?action=pricing">
                        <i class="fas fa-dollar-sign"></i>
                        <span class="sidebar-text">Fiyatlandırma</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $action == 'settings' ? 'active' : ''; ?>" href="?action=settings">
                        <i class="fas fa-cog"></i>
                        <span class="sidebar-text">Ayarlar</span>
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="../" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                        <span class="sidebar-text">Siteyi Görüntüle</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?logout=1">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="sidebar-text">Çıkış Yap</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="btn btn-link" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="navbar-nav ms-auto">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>
                            <?php echo $_SESSION['admin_username']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?action=settings"><i class="fas fa-cog me-2"></i>Ayarlar</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="?logout=1"><i class="fas fa-sign-out-alt me-2"></i>Çıkış Yap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?php if (isset($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>