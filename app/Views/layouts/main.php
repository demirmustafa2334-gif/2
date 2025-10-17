<?php
/** @var array{title:string,description?:string,og_image?:string,twitter_handle?:string} $meta */
/** @var array{name:string,contact:array{phone:string,email:string,whatsapp:string,address:string}} $site */
/** @var string $content */
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($meta['title'] ?? $site['name']) ?></title>
  <?php if (!empty($meta['description'])): ?>
    <meta name="description" content="<?= htmlspecialchars($meta['description']) ?>">
  <?php endif; ?>
  <meta property="og:title" content="<?= htmlspecialchars($meta['title'] ?? $site['name']) ?>">
  <?php if (!empty($meta['description'])): ?>
    <meta property="og:description" content="<?= htmlspecialchars($meta['description']) ?>">
  <?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= htmlspecialchars($meta['og_image'] ?? '/assets/images/og-default.jpg') ?>">
  <meta name="twitter:card" content="summary_large_image">
  <?php if (!empty($meta['twitter_handle'])): ?>
    <meta name="twitter:site" content="<?= htmlspecialchars($meta['twitter_handle']) ?>">
  <?php endif; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <?php include APP_PATH . '/Views/partials/header.php'; ?>
  <main>
    <?= $content ?>
  </main>
  <?php include APP_PATH . '/Views/partials/footer.php'; ?>

  <a href="https://wa.me/<?= rawurlencode($site['contact']['whatsapp']) ?>" class="btn btn-success position-fixed" style="right:16px;bottom:16px;z-index:1050;border-radius:999px;padding:12px 16px;">
    WhatsApp
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/app.js"></script>
</body>
</html>
