<?php /** @var array $meta */ ?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($meta['title'] ?? 'Istanbul Nakliyat') ?></title>
  <meta name="description" content="<?= htmlspecialchars($meta['description'] ?? '') ?>">
  <meta property="og:title" content="<?= htmlspecialchars($meta['title'] ?? '') ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($meta['description'] ?? '') ?>" />
  <meta property="og:type" content="<?= htmlspecialchars($meta['type'] ?? 'website') ?>" />
  <meta property="og:url" content="<?= htmlspecialchars($meta['url'] ?? '') ?>" />
  <meta property="og:image" content="<?= htmlspecialchars($meta['image'] ?? '') ?>" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($meta['title'] ?? '') ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($meta['description'] ?? '') ?>" />
  <link rel="canonical" href="<?= htmlspecialchars($meta['url'] ?? '') ?>" />
  <nav aria-label="breadcrumb" style="position:absolute; left:-9999px; top:auto; width:1px; height:1px; overflow:hidden;">
    <!-- Structured breadcrumb JSON-LD inserted below -->
  </nav>
  <script type="application/ld+json">
  <?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Istanbul Nakliyat',
    'image' => $meta['image'] ?? '',
    'url' => $meta['url'] ?? '',
    'telephone' => '+90 555 111 22 33',
    'address' => [
      '@type' => 'PostalAddress',
      'addressLocality' => 'Istanbul',
      'addressCountry' => 'TR'
    ]
  ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?>
  </script>
  <link rel="stylesheet" href="/assets/css/app.css">
  <style>
    :root { --primary: #0d6efd; --text:#1f2937; --bg:#ffffff; --muted:#6b7280; }
    body { margin:0; font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; color:var(--text); background:var(--bg); }
    header, footer { border-top:1px solid #e5e7eb; border-bottom:1px solid #e5e7eb; }
    .container { max-width: 1100px; margin: 0 auto; padding: 0 16px; }
    .nav { display:flex; justify-content:space-between; align-items:center; padding:14px 0; }
    .btn { display:inline-flex; align-items:center; justify-content:center; padding:10px 16px; border-radius:8px; background:var(--primary); color:white; text-decoration:none; font-weight:600; }
    .hero { display:grid; grid-template-columns:1.2fr 1fr; gap:24px; padding:40px 0; }
    .hero h1 { font-size: clamp(28px, 5vw, 44px); margin:0 0 12px; }
    .hero p { color:var(--muted); margin:0 0 18px; }
    .grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; }
    .card { border:1px solid #e5e7eb; border-radius:12px; padding:16px; }
    .footer { padding:24px 0; font-size:14px; color:var(--muted); }
    @media (max-width: 900px){ .hero{ grid-template-columns:1fr; } .grid{ grid-template-columns:1fr; } }
    .whatsapp { position: fixed; right: 16px; bottom: 16px; background:#25D366; color:white; border-radius:999px; padding:12px 16px; text-decoration:none; font-weight:700; box-shadow:0 8px 24px rgba(0,0,0,.15); }
    .footer-columns { display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:16px; }
    @media (max-width:900px){ .footer-columns { grid-template-columns:1fr; } }
  </style>
</head>
<body>
<header>
  <div class="container nav">
    <a href="/" style="font-weight:800; font-size:20px; text-decoration:none; color:inherit;">Istanbul Nakliyat</a>
    <nav style="display:flex; gap:12px;">
      <a href="/services" class="btn" style="background:#e5e7eb; color:#111827;">Hizmetler</a>
      <a href="/prices" class="btn" style="background:#e5e7eb; color:#111827;">Fiyatlar</a>
      <a href="/contact" class="btn">Teklif Al</a>
    </nav>
  </div>
</header>
<main class="container">
  <?= $content ?>
</main>
<footer class="footer">
  <div class="container">
    <div class="footer-columns">
      <section>
        <h4>İlçeler</h4>
        <ul>
          <?php
          try {
            $pdo = Core\Database::getConnection();
            foreach ($pdo->query('SELECT name, slug FROM districts ORDER BY name LIMIT 30') as $row) {
              echo '<li><a href="/istanbul/ilce/' . htmlspecialchars($row['slug']) . '">' . htmlspecialchars($row['name']) . '</a></li>';
            }
          } catch (\Throwable $e) {
            // ignore if DB not ready
          }
          ?>
        </ul>
      </section>
      <section>
        <h4>Semtler</h4>
        <ul>
          <?php
          try {
            $pdo = Core\Database::getConnection();
            foreach ($pdo->query('SELECT name, slug FROM neighborhoods ORDER BY name LIMIT 30') as $row) {
              echo '<li><a href="/istanbul/semt/' . htmlspecialchars($row['slug']) . '">' . htmlspecialchars($row['name']) . '</a></li>';
            }
          } catch (\Throwable $e) { }
          ?>
        </ul>
      </section>
      <section>
        <h4>Sayfalar</h4>
        <ul>
          <li><a href="/">Ana Sayfa</a></li>
          <li><a href="/services">Hizmetler</a></li>
          <li><a href="/prices">Fiyatlar</a></li>
          <li><a href="/contact">İletişim</a></li>
          <li><a href="/sitemap.xml">Sitemap</a></li>
        </ul>
      </section>
      <section>
        <h4>İletişim</h4>
        <ul>
          <li>Telefon: +90 555 111 22 33</li>
          <li>Email: admin@example.com</li>
          <li>WhatsApp: <a href="https://wa.me/905551112233" target="_blank" rel="noopener">Mesaj gönder</a></li>
        </ul>
      </section>
    </div>
    <div style="display:flex; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-top:12px;">
      <span>© <?= date('Y') ?> Istanbul Nakliyat</span>
      <span>SEO uyumlu ilçe & semt sayfaları</span>
    </div>
  </div>
</footer>
<a class="whatsapp" href="https://wa.me/905551112233?text=Merhaba%2C%20ta%C5%9F%C4%B1ma%20i%C3%A7in%20bilgi%20almak%20istiyorum" target="_blank" rel="noopener">WhatsApp</a>
<script src="/assets/js/app.js" defer></script>
</body>
</html>
