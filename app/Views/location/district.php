<?php /** @var array $district */ /** @var array $neighborhoods */ /** @var array $meta */ ?>
<script type="application/ld+json">
<?= \Core\SEO::breadcrumbs([
  ['name' => 'Anasayfa', 'url' => '/'],
  ['name' => 'İstanbul', 'url' => '/istanbul'],
  ['name' => $district['name']]
]) ?>
</script>

<h1><?= htmlspecialchars($district['name']) ?> Evden Eve Nakliyat</h1>
<p><?= htmlspecialchars($district['meta_description'] ?? ($district['name'] . ' nakliyat')) ?></p>

<h2>Semtler</h2>
<ul>
  <?php foreach ($neighborhoods as $s): ?>
    <li><a href="/istanbul/semt/<?= htmlspecialchars($s['slug']) ?>"><?= htmlspecialchars($s['name']) ?></a></li>
  <?php endforeach; ?>
</ul>

<h2>Yakın İlçeler</h2>
<ul>
<?php
try {
  $pdo = \Core\Database::getConnection();
  // naive: show first 5 districts except current, can be improved by geo distance
  $stmt = $pdo->prepare('SELECT name, slug FROM districts WHERE slug <> ? ORDER BY name LIMIT 5');
  $stmt->execute([$district['slug']]);
  foreach ($stmt->fetchAll() as $d) {
    echo '<li><a href="/istanbul/ilce/' . htmlspecialchars($d['slug']) . '">' . htmlspecialchars($d['name']) . '</a></li>';
  }
} catch (\Throwable $e) {}
?>
</ul>
