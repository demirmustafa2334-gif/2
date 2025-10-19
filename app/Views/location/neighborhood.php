<?php /** @var array $neighborhood */ /** @var array $district */ /** @var array $meta */ ?>
<script type="application/ld+json">
<?= \Core\SEO::breadcrumbs([
  ['name' => 'Anasayfa', 'url' => '/'],
  ['name' => 'İstanbul', 'url' => '/istanbul'],
  ['name' => $district['name'] ?? ''],
  ['name' => $neighborhood['name']]
]) ?>
</script>

<h1><?= htmlspecialchars($neighborhood['name']) ?> Evden Eve Nakliyat</h1>
<p><?= htmlspecialchars($neighborhood['meta_description'] ?? ($neighborhood['name'] . ' nakliyat')) ?></p>

<p>Bağlı olduğu ilçe: <a href="/istanbul/ilce/<?= htmlspecialchars($district['slug'] ?? '') ?>"><?= htmlspecialchars($district['name'] ?? '') ?></a></p>

<h2>Yakın Semtler</h2>
<ul>
<?php
if (!empty($district['id'])) {
  try {
    $pdo = \Core\Database::getConnection();
    $stmt = $pdo->prepare('SELECT name, slug FROM neighborhoods WHERE district_id=? AND slug<>? ORDER BY name LIMIT 8');
    $stmt->execute([$district['id'], $neighborhood['slug']]);
    foreach ($stmt->fetchAll() as $s) {
      echo '<li><a href="/istanbul/semt/' . htmlspecialchars($s['slug']) . '">' . htmlspecialchars($s['name']) . '</a></li>';
    }
  } catch (\Throwable $e) {}
}
?>
</ul>
