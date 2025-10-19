<div class="container py-5">
  <h1 class="h3 mb-3"><?php echo htmlspecialchars($city['name']); ?> Şehri</h1>
  <p class="lead">Turistik yerler, yerel lezzetler ve kültürel noktalar.</p>
  <h2 class="h5 mt-4">İlçeler</h2>
  <ul class="list-inline">
    <?php foreach ($districts as $d): ?>
      <li class="list-inline-item mb-2"><a class="btn btn-sm btn-outline-primary" href="/il/<?= htmlspecialchars($city['slug']) ?>/<?= htmlspecialchars($d['slug']) ?>"><?= htmlspecialchars($d['name']) ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>
