<?php
$meta_title = 'Blog | İstanbul Nakliyat İpuçları ve Haberler';
$meta_description = 'Nakliyat hakkında güncel bilgiler, ipuçları ve haberler. Evden eve nakliyat rehberi, taşıma önerileri ve sektör haberleri.';
$meta_keywords = 'nakliyat blog, evden eve nakliyat ipuçları, taşıma rehberi, nakliyat haberleri';

include 'includes/header.php';
?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-5 fw-bold mb-3">
                    Blog
                </h1>
                <p class="lead mb-4">
                    Nakliyat hakkında güncel bilgiler, ipuçları ve haberler. 
                    Evden eve nakliyat rehberi ve taşıma önerileri.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Posts Section -->
<section class="py-5">
    <div class="container">
        <?php if (!empty($posts)): ?>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <?php if ($post['featured_image']): ?>
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" 
                         class="card-img-top" 
                         alt="<?php echo htmlspecialchars($post['title']); ?>"
                         style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="/blog/<?php echo $post['slug']; ?>" class="text-decoration-none">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h5>
                        <p class="card-text flex-grow-1">
                            <?php echo htmlspecialchars(substr(strip_tags($post['excerpt']), 0, 120)); ?>...
                        </p>
                        <div class="mt-auto">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                <?php echo date('d.m.Y', strtotime($post['published_at'])); ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <nav aria-label="Blog sayfa navigasyonu" class="mt-5">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="/blog?p=<?php echo $page - 1; ?>">Önceki</a>
                </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="/blog?p=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="/blog?p=<?php echo $page + 1; ?>">Sonraki</a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
        
        <?php else: ?>
        <div class="row">
            <div class="col-12 text-center">
                <div class="card">
                    <div class="card-body py-5">
                        <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Henüz blog yazısı bulunmuyor</h5>
                        <p class="text-muted">Blog yazıları yakında eklenecek.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-3">Nakliyat İhtiyacınız mı Var?</h3>
                <p class="mb-0">
                    Blog yazılarımızı okuduktan sonra nakliyat ihtiyacınız için hemen teklif alın. 
                    Uzman ekibimiz size yardımcı olacak.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="/teklif-al" class="btn btn-warning btn-lg">
                    <i class="fas fa-calculator me-2"></i>Teklif Al
                </a>
            </div>
        </div>
    </div>
</section>