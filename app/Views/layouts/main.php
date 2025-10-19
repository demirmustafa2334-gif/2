<?php /** @var array $meta */ /** @var array $site */ /** @var string $content */ ?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars(($meta['title'] ?? $site['name']).' | yereltanitim.com') ?></title>
  <?php if (!empty($meta['description'])): ?><meta name="description" content="<?= htmlspecialchars($meta['description']) ?>"><?php endif; ?>
  <meta name="keywords" content="yereltanitim.com, Türkiye şehirleri, ilçeler, yerel lezzetler, turistik yerler">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
  <?php include APP_PATH . '/Views/partials/header.php'; ?>
  <main>
    <?= $content ?>
  </main>
  <?php include APP_PATH . '/Views/partials/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/app.js"></script>
</body>
</html>
