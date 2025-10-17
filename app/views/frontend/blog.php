<?php include __DIR__ . '/header.php'; ?>

<section class="blog-page py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Blog</h1>
            <p class="text-muted">Nakliyat ipuçları ve faydalı bilgiler</p>
        </div>
        
        <div class="row">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($post['featured_image'])): ?>
                        <img src="<?php echo SITE_URL . '/' . $post['featured_image']; ?>" class="card-img-top" alt="<?php echo $post['title']; ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $post['title']; ?></h5>
                            <p class="card-text text-muted small">
                                <i class="fas fa-calendar"></i> <?php echo date('d.m.Y', strtotime($post['published_at'])); ?>
                                <?php if (!empty($post['author'])): ?>
                                | <i class="fas fa-user"></i> <?php echo $post['author']; ?>
                                <?php endif; ?>
                            </p>
                            <p class="card-text"><?php echo $post['excerpt']; ?></p>
                            <a href="<?php echo SITE_URL; ?>/blog/<?php echo $post['slug']; ?>" class="btn btn-outline-primary">
                                Devamını Oku <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center text-muted">Henüz blog yazısı bulunmamaktadır.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
