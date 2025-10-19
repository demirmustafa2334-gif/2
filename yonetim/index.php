<?php
/**
 * Admin Dashboard
 * Yereltanitim.com - Turkey Tourism Website
 */

require_once '../config/config.php';
require_admin_login();

// Dashboard statistics
$city = new City();
$district = new District();
$blogPost = new BlogPost();
$contactMessage = new ContactMessage();

$stats = [
    'cities' => $city->count('is_active = 1'),
    'districts' => $district->count('is_active = 1'),
    'blog_posts' => $blogPost->count('is_published = 1'),
    'draft_posts' => $blogPost->count('is_published = 0'),
    'unread_messages' => $contactMessage->getUnreadCount(),
    'total_views' => 0 // You can implement view counting
];

$recentMessages = $contactMessage->getAllMessages(5);
$recentPosts = $blogPost->findAll('', 'created_at DESC', 5);
$popularCities = $city->getPopularCities(5);

include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'includes/sidebar.php'; ?>
        
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="fas fa-tachometer-alt me-2"></i>Yönetim Paneli
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <span class="badge bg-primary fs-6">
                            <i class="fas fa-clock me-1"></i>
                            <?php echo date('d.m.Y H:i'); ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Şehirler
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stats['cities']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-city fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="sehirler.php" class="text-primary text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        İlçeler
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stats['districts']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="ilceler.php" class="text-success text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Blog Yazıları
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stats['blog_posts']; ?>
                                    </div>
                                    <?php if ($stats['draft_posts'] > 0): ?>
                                        <small class="text-muted"><?php echo $stats['draft_posts']; ?> taslak</small>
                                    <?php endif; ?>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="blog.php" class="text-info text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Okunmamış Mesajlar
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $stats['unread_messages']; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="mesajlar.php" class="text-warning text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content Row -->
            <div class="row">
                <!-- Recent Messages -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-envelope me-2"></i>Son Mesajlar
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php if (empty($recentMessages)): ?>
                                <p class="text-muted">Henüz mesaj bulunmuyor.</p>
                            <?php else: ?>
                                <?php foreach ($recentMessages as $message): ?>
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <strong><?php echo htmlspecialchars($message['name']); ?></strong>
                                            <?php if ($message['subject']): ?>
                                                <br><small class="text-primary"><?php echo htmlspecialchars($message['subject']); ?></small>
                                            <?php endif; ?>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo truncate_text($message['message'], 60); ?>
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <?php if (!$message['is_read']): ?>
                                                <span class="badge bg-warning">Yeni</span>
                                            <?php endif; ?>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo format_date($message['created_at']); ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-center mt-3">
                                    <a href="mesajlar.php" class="btn btn-outline-primary btn-sm">
                                        Tüm Mesajları Görüntüle
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Posts -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-newspaper me-2"></i>Son Blog Yazıları
                            </h6>
                        </div>
                        <div class="card-body">
                            <?php if (empty($recentPosts)): ?>
                                <p class="text-muted">Henüz blog yazısı bulunmuyor.</p>
                            <?php else: ?>
                                <?php foreach ($recentPosts as $post): ?>
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <strong><?php echo htmlspecialchars($post['title']); ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo truncate_text($post['excerpt'], 60); ?>
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <?php if (!$post['is_published']): ?>
                                                <span class="badge bg-secondary">Taslak</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Yayında</span>
                                            <?php endif; ?>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo format_date($post['created_at']); ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-center mt-3">
                                    <a href="blog.php" class="btn btn-outline-primary btn-sm">
                                        Tüm Yazıları Görüntüle
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Popular Cities -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-star me-2"></i>Popüler Şehirler
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($popularCities as $popularCity): ?>
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-left-primary">
                                            <div class="card-body py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <i class="fas fa-city fa-2x text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1"><?php echo htmlspecialchars($popularCity['name']); ?></h6>
                                                        <small class="text-muted"><?php echo htmlspecialchars($popularCity['region']); ?> Bölgesi</small>
                                                        <?php if (isset($popularCity['blog_count']) && $popularCity['blog_count'] > 0): ?>
                                                            <br><small class="text-info"><?php echo $popularCity['blog_count']; ?> yazı</small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-bolt me-2"></i>Hızlı İşlemler
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="sehir-ekle.php" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus me-2"></i>Yeni Şehir Ekle
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="blog-ekle.php" class="btn btn-success btn-block">
                                        <i class="fas fa-pen me-2"></i>Yeni Yazı Ekle
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="ai-yazi-olustur.php" class="btn btn-info btn-block">
                                        <i class="fas fa-robot me-2"></i>AI ile Yazı Oluştur
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="ayarlar.php" class="btn btn-secondary btn-block">
                                        <i class="fas fa-cog me-2"></i>Site Ayarları
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.text-xs {
    font-size: 0.7rem;
}

.btn-block {
    display: block;
    width: 100%;
}
</style>

<?php include 'includes/footer.php'; ?>