<section class="py-5 bg-primary text-white">
  <div class="container">
    <h1 class="display-5 fw-bold">Türkiye Şehir ve İlçe Tanıtımları</h1>
    <p class="lead">Turistik yerler, yerel lezzetler ve kültürel deneyimler — tamamı Türkçe ve SEO uyumlu içerikler ile yereltanitim.com'da.</p>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <h2 class="h4 mb-4">Tüm Şehirler</h2>
    <div class="row g-3">
      <?php foreach ($cities as $c): ?>
        <div class="col-6 col-md-3 col-lg-2"><a class="btn btn-outline-secondary w-100" href="/il/<?= htmlspecialchars($c['slug']) ?>"><?= htmlspecialchars($c['name']) ?></a></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
