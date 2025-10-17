<?php
use App\Core\View;
use App\Helpers\Seo;

$config = $this->config ?? (require BASE_PATH . '/app/Config/app.php');
$defaults = [
    'title' => $config['seo']['default_title'] ?? 'Istanbul Nakliyat',
    'description' => $config['seo']['default_description'] ?? '',
    'keywords' => $config['seo']['default_keywords'] ?? '',
    'ogImage' => $config['seo']['og_image'] ?? '/assets/img/og.jpg',
];
$meta = Seo::get($defaults);
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= View::e($meta['title']) ?></title>
  <meta name="description" content="<?= View::e($meta['description']) ?>" />
  <meta name="keywords" content="<?= View::e($meta['keywords']) ?>" />

  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= View::e($meta['title']) ?>" />
  <meta property="og:description" content="<?= View::e($meta['description']) ?>" />
  <meta property="og:image" content="<?= View::e($meta['ogImage']) ?>" />

  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= View::e($meta['title']) ?>" />
  <meta name="twitter:description" content="<?= View::e($meta['description']) ?>" />

  <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/assets/css/style.css" />
</head>
<body>
  <?php include BASE_PATH . '/app/Views/layouts/partials/header.php'; ?>
  <main class="container py-4">
    <?php include $templateFile; ?>
  </main>
  <?php include BASE_PATH . '/app/Views/layouts/partials/footer.php'; ?>

  <a href="https://wa.me/<?= urlencode($config['whatsapp']['phone'] ?? '') ?>?text=<?= urlencode($config['whatsapp']['message'] ?? '') ?>" class="whatsapp-float" aria-label="WhatsApp">
    <img src="/assets/img/whatsapp.svg" alt="WhatsApp" width="48" height="48" />
  </a>

  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/app.js"></script>

  <style>
    .whatsapp-float { position: fixed; right: 16px; bottom: 16px; z-index: 999; }
    .btn-quote { position: fixed; left: 16px; bottom: 16px; z-index: 999; }
  </style>

  <a href="/iletisim" class="btn btn-primary btn-quote">Teklif Al</a>
</body>
</html>
