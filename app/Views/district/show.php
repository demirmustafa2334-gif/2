<div class="container py-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Anasayfa</a></li>
      <li class="breadcrumb-item"><a href="/il/<?= htmlspecialchars($city['slug']) ?>"><?= htmlspecialchars($city['name']) ?></a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($district['name']) ?></li>
    </ol>
  </nav>
  <h1 class="h3 mb-3"><?= htmlspecialchars($city['name'].' / '.$district['name']) ?></h1>
  <h2 class="h5">Yerel Lezzetler</h2>
  <p>Bu bölümde <?= htmlspecialchars($district['name']) ?> ilçesine özgü yerel lezzetler yer alacaktır.</p>
  <h2 class="h5 mt-3">Turistik Yerler</h2>
  <p>Bu bölümde <?= htmlspecialchars($district['name']) ?> için turistik yerler listelenecektir.</p>
  <h3 class="h6 mt-4">Diğer İlçeler</h3>
  <ul class="list-inline">
    <?php foreach ($siblings as $s): if ((int)$s['id']===(int)$district['id']) continue; ?>
      <li class="list-inline-item mb-2"><a class="btn btn-sm btn-outline-secondary" href="/il/<?= htmlspecialchars($city['slug']) ?>/<?= htmlspecialchars($s['slug']) ?>"><?= htmlspecialchars($s['name']) ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>
