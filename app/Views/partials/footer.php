<?php use App\Models\City; use App\Models\District; $cities=City::all(); ?>
<footer class="bg-light mt-5 border-top">
  <div class="container py-5">
    <h5 class="mb-3">Türkiye Şehirleri ve İlçeleri</h5>
    <div class="accordion" id="footerAccordion">
      <?php foreach ($cities as $i=>$c): $districts = District::byCityId((int)$c['id']); ?>
      <div class="accordion-item">
        <h2 class="accordion-header" id="h<?= $i ?>">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c<?= $i ?>">
            <?= htmlspecialchars($c['name']) ?>
          </button>
        </h2>
        <div id="c<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#footerAccordion">
          <div class="accordion-body small">
            <?php foreach ($districts as $d): ?>
              <a href="/il/<?= htmlspecialchars($c['slug']) ?>/<?= htmlspecialchars($d['slug']) ?>" class="me-2 mb-2 d-inline-block"><?= htmlspecialchars($d['name']) ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center text-muted small pt-4">© <?= date('Y') ?> yereltanitim.com</div>
  </div>
</footer>
