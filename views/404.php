<?php
$meta_title = 'Sayfa Bulunamadı - ' . SITE_NAME;
$meta_description = 'Aradığınız sayfa bulunamadı. Ana sayfaya dönmek için tıklayın.';

ob_start();
?>

<section class="py-5" style="min-height: 60vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <div class="mb-4">
                    <i class="fas fa-exclamation-triangle fa-8x text-warning"></i>
                </div>
                <h1 class="display-1 fw-bold text-primary mb-3">404</h1>
                <h2 class="display-5 fw-bold mb-3">Sayfa Bulunamadı</h2>
                <p class="lead text-muted mb-4">Aradığınız sayfa mevcut değil veya taşınmış olabilir. Ana sayfaya dönmek için aşağıdaki butona tıklayın.</p>
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="/" class="btn btn-primary btn-lg">
                        <i class="fas fa-home me-2"></i>Ana Sayfaya Dön
                    </a>
                    <a href="/iletisim" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-phone me-2"></i>İletişim
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include 'layout.php';
?>