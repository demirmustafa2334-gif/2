<?php
require_once '../config/database.php';
require_once '../config/config.php';
require_once '../includes/functions.php';

requireLogin();

$db = new Database();
$conn = $db->getConnection();

// Get statistics
$stats = [];

// Count districts
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM districts WHERE status = 1");
$stmt->execute();
$stats['districts'] = $stmt->fetch()['count'];

// Count neighborhoods
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM neighborhoods WHERE status = 1");
$stmt->execute();
$stats['neighborhoods'] = $stmt->fetch()['count'];

// Count reviews
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM reviews WHERE status = 1");
$stmt->execute();
$stats['reviews'] = $stmt->fetch()['count'];

// Count blog posts
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM blog_posts WHERE status = 1");
$stmt->execute();
$stats['blog_posts'] = $stmt->fetch()['count'];

// Count contact messages
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM contact_messages WHERE status = 'new'");
$stmt->execute();
$stats['new_messages'] = $stmt->fetch()['count'];

// Get recent reviews
$stmt = $conn->prepare("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 5");
$stmt->execute();
$recent_reviews = $stmt->fetchAll();

// Get recent contact messages
$stmt = $conn->prepare("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5");
$stmt->execute();
$recent_messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?php echo SITE_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        .sidebar .nav-link.active {
            background: #007bff;
        }
        .main-content {
            background: #f8f9fa;
            min-height: 100vh;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0">
                <div class="sidebar">
                    <div class="p-3">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="/admin">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="/admin/districts">
                            <i class="fas fa-map-marker-alt me-2"></i>İlçeler
                        </a>
                        <a class="nav-link" href="/admin/neighborhoods">
                            <i class="fas fa-location-dot me-2"></i>Semtler
                        </a>
                        <a class="nav-link" href="/admin/pages">
                            <i class="fas fa-file-alt me-2"></i>Sayfalar
                        </a>
                        <a class="nav-link" href="/admin/blog">
                            <i class="fas fa-blog me-2"></i>Blog
                        </a>
                        <a class="nav-link" href="/admin/reviews">
                            <i class="fas fa-star me-2"></i>Yorumlar
                        </a>
                        <a class="nav-link" href="/admin/pricing">
                            <i class="fas fa-dollar-sign me-2"></i>Fiyatlandırma
                        </a>
                        <a class="nav-link" href="/admin/messages">
                            <i class="fas fa-envelope me-2"></i>Mesajlar
                        </a>
                        <a class="nav-link" href="/admin/settings">
                            <i class="fas fa-cog me-2"></i>Ayarlar
                        </a>
                        <a class="nav-link" href="/admin/logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Çıkış
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10">
                <div class="main-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Dashboard</h2>
                        <a href="/" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt me-1"></i>Siteyi Görüntüle
                        </a>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-2">
                            <div class="stat-card text-center">
                                <i class="fas fa-map-marker-alt fa-2x text-primary mb-2"></i>
                                <h4><?php echo $stats['districts']; ?></h4>
                                <p class="text-muted">İlçe</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat-card text-center">
                                <i class="fas fa-location-dot fa-2x text-success mb-2"></i>
                                <h4><?php echo $stats['neighborhoods']; ?></h4>
                                <p class="text-muted">Semt</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat-card text-center">
                                <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                <h4><?php echo $stats['reviews']; ?></h4>
                                <p class="text-muted">Yorum</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat-card text-center">
                                <i class="fas fa-blog fa-2x text-info mb-2"></i>
                                <h4><?php echo $stats['blog_posts']; ?></h4>
                                <p class="text-muted">Blog Yazısı</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat-card text-center">
                                <i class="fas fa-envelope fa-2x text-danger mb-2"></i>
                                <h4><?php echo $stats['new_messages']; ?></h4>
                                <p class="text-muted">Yeni Mesaj</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-star me-2"></i>Son Yorumlar</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($recent_reviews)): ?>
                                        <p class="text-muted">Henüz yorum bulunmuyor.</p>
                                    <?php else: ?>
                                        <?php foreach ($recent_reviews as $review): ?>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <strong><?php echo sanitize($review['customer_name']); ?></strong>
                                                    <div class="text-warning">
                                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                            <i class="fas fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                                <small class="text-muted"><?php echo timeAgo($review['created_at']); ?></small>
                                            </div>
                                            <p class="text-muted small"><?php echo sanitize(substr($review['review_text'], 0, 100)); ?>...</p>
                                            <hr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-envelope me-2"></i>Son Mesajlar</h5>
                                </div>
                                <div class="card-body">
                                    <?php if (empty($recent_messages)): ?>
                                        <p class="text-muted">Henüz mesaj bulunmuyor.</p>
                                    <?php else: ?>
                                        <?php foreach ($recent_messages as $message): ?>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <strong><?php echo sanitize($message['name']); ?></strong>
                                                    <br>
                                                    <small class="text-muted"><?php echo sanitize($message['subject']); ?></small>
                                                </div>
                                                <small class="text-muted"><?php echo timeAgo($message['created_at']); ?></small>
                                            </div>
                                            <p class="text-muted small"><?php echo sanitize(substr($message['message'], 0, 100)); ?>...</p>
                                            <hr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>