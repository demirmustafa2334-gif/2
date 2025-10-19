<?php /** @var array $districts */ /** @var array $neighborhoodsByDistrict */ ?>
<h1>İstanbul İlçeler ve Semtler</h1>
<?php foreach ($districts as $d): ?>
  <section class="card">
    <h2><a href="/istanbul/ilce/<?= htmlspecialchars($d['slug']) ?>"><?= htmlspecialchars($d['name']) ?></a></h2>
    <ul style="display:flex; flex-wrap:wrap; gap:8px; padding-left:16px;">
      <?php foreach (($neighborhoodsByDistrict[$d['slug']] ?? []) as $s): ?>
        <li><a href="/istanbul/semt/<?= htmlspecialchars($s['slug']) ?>"><?= htmlspecialchars($s['name']) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endforeach; ?>
