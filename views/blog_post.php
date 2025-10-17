<?php
$meta_title = $post['meta_title'] ?: $post['title'] . ' | İstanbul Nakliyat Blog';
$meta_description = $post['meta_description'] ?: substr(strip_tags($post['excerpt']), 0, 160);
$meta_keywords = $post['meta_keywords'] ?: 'nakliyat blog, evden eve nakliyat, taşıma ipuçları';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="/blog">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($post['title']); ?></li>
        </ol>
    </div>
</nav>

<!-- Blog Post Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="blog-post">
                    <header class="mb-4">
                        <h1 class="display-6 fw-bold mb-3">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h1>
                        
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-calendar me-2"></i>
                            <span><?php echo date('d.m.Y', strtotime($post['published_at'])); ?></span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-user me-2"></i>
                            <span>İstanbul Nakliyat</span>
                        </div>
                        
                        <?php if ($post['featured_image']): ?>
                        <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                             class="img-fluid rounded mb-4" 
                             alt="<?php echo htmlspecialchars($post['title']); ?>">
                        <?php endif; ?>
                    </header>
                    
                    <div class="blog-content">
                        <?php echo $post['content']; ?>
                    </div>
                    
                    <footer class="mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-2">Bu yazıyı beğendiniz mi?</h6>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-thumbs-up me-1"></i>Beğen
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-share me-1"></i>Paylaş
                                    </a>
                                </div>
                            </div>
                            <div class="text-muted">
                                <small>
                                    <i class="fas fa-tag me-1"></i>
                                    Nakliyat, Evden Eve Nakliyat
                                </small>
                            </div>
                        </div>
                    </footer>
                </article>
            </div>
            
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px;">
                    <!-- Recent Posts -->
                    <?php if (!empty($recentPosts)): ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-clock me-2"></i>Son Yazılar
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($recentPosts as $recentPost): ?>
                            <div class="d-flex mb-3">
                                <?php if ($recentPost['featured_image']): ?>
                                <img src="<?php echo htmlspecialchars($recentPost['featured_image']); ?>" 
                                     class="rounded me-3" 
                                     alt="<?php echo htmlspecialchars($recentPost['title']); ?>"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                                <?php endif; ?>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="/blog/<?php echo $recentPost['slug']; ?>" 
                                           class="text-decoration-none">
                                            <?php echo htmlspecialchars($recentPost['title']); ?>
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        <?php echo date('d.m.Y', strtotime($recentPost['published_at'])); ?>
                                    </small>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- CTA Card -->
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Nakliyat İhtiyacınız mı Var?</h5>
                            <p class="card-text">
                                Uzman ekibimizden ücretsiz teklif alın.
                            </p>
                            <a href="/teklif-al" class="btn btn-primary">
                                <i class="fas fa-calculator me-2"></i>Teklif Al
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">İlgili Yazılar</h2>
                <p class="lead">Bu konuyla ilgili diğer yazılarımızı inceleyin.</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach (array_slice($recentPosts, 0, 3) as $relatedPost): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <?php if ($relatedPost['featured_image']): ?>
                    <img src="<?php echo htmlspecialchars($relatedPost['featured_image']); ?>" 
                         class="card-img-top" 
                         alt="<?php echo htmlspecialchars($relatedPost['title']); ?>"
                         style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="/blog/<?php echo $relatedPost['slug']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($relatedPost['title']); ?>
                            </a>
                        </h5>
                        <p class="card-text">
                            <?php echo htmlspecialchars(substr(strip_tags($relatedPost['excerpt']), 0, 100)); ?>...
                        </p>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <?php echo date('d.m.Y', strtotime($relatedPost['published_at'])); ?>
                        </small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
.blog-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.blog-content h1,
.blog-content h2,
.blog-content h3,
.blog-content h4,
.blog-content h5,
.blog-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--text-dark);
}

.blog-content p {
    margin-bottom: 1.5rem;
}

.blog-content ul,
.blog-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.blog-content blockquote {
    border-left: 4px solid var(--primary-color);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--text-light);
}

.blog-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}

.blog-content code {
    background: var(--bg-light);
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
}

.blog-content pre {
    background: var(--bg-light);
    padding: 1rem;
    border-radius: 8px;
    overflow-x: auto;
    margin: 1.5rem 0;
}
</style>