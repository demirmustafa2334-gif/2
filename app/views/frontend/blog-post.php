<?php include __DIR__ . '/header.php'; ?>

<section class="blog-post py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/">Ana Sayfa</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/blog">Blog</a></li>
                        <li class="breadcrumb-item active"><?php echo $post['title']; ?></li>
                    </ol>
                </nav>
                
                <?php if (!empty($post['featured_image'])): ?>
                <img src="<?php echo SITE_URL . '/' . $post['featured_image']; ?>" 
                     alt="<?php echo $post['title']; ?>" 
                     class="img-fluid rounded mb-4">
                <?php endif; ?>
                
                <h1 class="mb-3"><?php echo $post['title']; ?></h1>
                
                <div class="text-muted mb-4">
                    <i class="fas fa-calendar"></i> <?php echo date('d.m.Y', strtotime($post['published_at'])); ?>
                    <?php if (!empty($post['author'])): ?>
                    | <i class="fas fa-user"></i> <?php echo $post['author']; ?>
                    <?php endif; ?>
                    | <i class="fas fa-eye"></i> <?php echo $post['view_count']; ?> görüntülenme
                </div>
                
                <div class="content">
                    <?php echo nl2br($post['content']); ?>
                </div>
                
                <?php if (!empty($post['tags'])): ?>
                <div class="mt-4">
                    <strong>Etiketler:</strong>
                    <?php
                    $tags = explode(',', $post['tags']);
                    foreach ($tags as $tag):
                    ?>
                    <span class="badge bg-secondary"><?php echo trim($tag); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                
                <hr class="my-4">
                
                <div class="share-buttons">
                    <h5>Paylaş:</h5>
                    <button class="btn btn-primary" onclick="shareOnSocial('facebook')">
                        <i class="fab fa-facebook"></i> Facebook
                    </button>
                    <button class="btn btn-info" onclick="shareOnSocial('twitter')">
                        <i class="fab fa-twitter"></i> Twitter
                    </button>
                    <button class="btn btn-success" onclick="shareOnSocial('whatsapp')">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </button>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <h5 class="card-title">İletişim</h5>
                        <p>Nakliyat hizmetlerimiz hakkında bilgi almak için:</p>
                        <a href="<?php echo SITE_URL; ?>/iletisim" class="btn btn-primary w-100">
                            <i class="fas fa-envelope"></i> İletişime Geç
                        </a>
                    </div>
                </div>
                
                <?php if (!empty($recent_posts)): ?>
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0">Son Yazılar</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recent_posts as $recent): ?>
                            <?php if ($recent['id'] != $post['id']): ?>
                            <a href="<?php echo SITE_URL; ?>/blog/<?php echo $recent['slug']; ?>" 
                               class="list-group-item list-group-item-action">
                                <h6 class="mb-1"><?php echo $recent['title']; ?></h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> <?php echo date('d.m.Y', strtotime($recent['published_at'])); ?>
                                </small>
                            </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
