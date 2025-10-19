<?php
/**
 * Yönetici Paneli Ana Sayfa
 * Yerel Tanıtım - Özel PHP Scripti
 */

require_once '../config/config.php';
require_admin_login();

// Dashboard istatistiklerini al
$district = new District();
$neighborhood = new Neighborhood();
$review = new Review();
$contactMessage = new ContactMessage();
$blogPost = new BlogPost();

$stats = [
    'districts' => $district->count('is_active = 1'),
    'neighborhoods' => $neighborhood->count('is_active = 1'),
    'reviews' => $review->count('is_approved = 1'),
    'pending_reviews' => $review->count('is_approved = 0'),
    'unread_messages' => $contactMessage->getUnreadCount(),
    'blog_posts' => $blogPost->count('is_published = 1')
];

$recentMessages = $contactMessage->getAllMessages(5);
$recentReviews = $review->findAll('', 'created_at DESC', 5);
?>

<?php include 'includes/header.php'; ?>

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
                        <span class="badge bg-primary">
                            <i class="fas fa-clock me-1"></i>
                            <?php echo date('d.m.Y H:i'); ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- İstatistik Kartları -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">İlçeler</h5>
                                    <h2 class="mb-0"><?php echo $stats['districts']; ?></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-map-marker-alt fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="ilceler.php" class="text-white text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Mahalleler</h5>
                                    <h2 class="mb-0"><?php echo $stats['neighborhoods']; ?></h2>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-location-dot fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="mahalleler.php" class="text-white text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Yorumlar</h5>
                                    <h2 class="mb-0"><?php echo $stats['reviews']; ?></h2>
                                    <?php if ($stats['pending_reviews'] > 0): ?>
                                        <small class="badge bg-warning"><?php echo $stats['pending_reviews']; ?> beklemede</small>
                                    <?php endif; ?>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-star fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="yorumlar.php" class="text-white text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="card-title">Mesajlar</h5>
                                    <h2 class="mb-0"><?php echo $stats['unread_messages']; ?></h2>
                                    <small>okunmamış</small>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-envelope fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="mesajlar.php" class="text-dark text-decoration-none">
                                <small>Detayları Görüntüle <i class="fas fa-arrow-right"></i></small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Son Aktiviteler -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-envelope me-2"></i>Son Mesajlar
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($recentMessages)): ?>
                                <p class="text-muted">Henüz mesaj bulunmuyor.</p>
                            <?php else: ?>
                                <?php foreach ($recentMessages as $message): ?>
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <strong><?php echo htmlspecialchars($message['name']); ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo substr(htmlspecialchars($message['message']), 0, 50) . '...'; ?>
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <?php if (!$message['is_read']): ?>
                                                <span class="badge bg-warning">Yeni</span>
                                            <?php endif; ?>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo date('d.m.Y', strtotime($message['created_at'])); ?>
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
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-star me-2"></i>Son Yorumlar
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php if (empty($recentReviews)): ?>
                                <p class="text-muted">Henüz yorum bulunmuyor.</p>
                            <?php else: ?>
                                <?php foreach ($recentReviews as $review): ?>
                                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                                        <div>
                                            <strong><?php echo htmlspecialchars($review['customer_name']); ?></strong>
                                            <div class="text-warning">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <i class="fas fa-star<?php echo $i <= $review['rating'] ? '' : '-o'; ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <small class="text-muted">
                                                <?php echo substr(htmlspecialchars($review['review_text']), 0, 50) . '...'; ?>
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <?php if (!$review['is_approved']): ?>
                                                <span class="badge bg-warning">Beklemede</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Onaylı</span>
                                            <?php endif; ?>
                                            <br>
                                            <small class="text-muted">
                                                <?php echo date('d.m.Y', strtotime($review['created_at'])); ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-center mt-3">
                                    <a href="yorumlar.php" class="btn btn-outline-primary btn-sm">
                                        Tüm Yorumları Görüntüle
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include 'includes/footer.php'; ?>