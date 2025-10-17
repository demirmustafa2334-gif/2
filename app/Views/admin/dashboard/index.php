<div class="container py-5">
  <h1 class="h3 mb-4">Yönetim Paneli</h1>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100"><div class="card-body">
        <div class="text-muted small">İlçe</div>
        <div class="display-6"><?php echo (int)$stats['districts']; ?></div>
      </div></div>
    </div>
    <div class="col-md-4">
      <div class="card h-100"><div class="card-body">
        <div class="text-muted small">Semt</div>
        <div class="display-6"><?php echo (int)$stats['neighborhoods']; ?></div>
      </div></div>
    </div>
    <div class="col-md-4">
      <div class="card h-100"><div class="card-body">
        <div class="text-muted small">Yorum</div>
        <div class="display-6"><?php echo (int)$stats['reviews']; ?></div>
      </div></div>
    </div>
  </div>
</div>
