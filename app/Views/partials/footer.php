<?php /** @var array{contact:array{phone:string,email:string,address:string}} $site */ ?>
<footer class="bg-light mt-5 border-top">
  <div class="container py-5">
    <div class="row g-4">
      <div class="col-md-4">
        <h5>Hakkımızda</h5>
        <p>İstanbul içi ev ve ofis taşımacılığında profesyonel ve güvenilir hizmet.</p>
      </div>
      <div class="col-md-4">
        <h5>İletişim</h5>
        <ul class="list-unstyled small">
          <li>Telefon: <?= htmlspecialchars($site['contact']['phone']) ?></li>
          <li>E-posta: <?= htmlspecialchars($site['contact']['email']) ?></li>
          <li>Adres: <?= htmlspecialchars($site['contact']['address']) ?></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Lokasyonlar</h5>
        <div class="small" id="footerLocations">
          <!-- Will be populated dynamically from DB later -->
          <a href="/istanbul/kadikoy-evden-eve-nakliyat" class="d-inline-block me-2 mb-2">Kadıköy</a>
          <a href="/istanbul/besiktas-evden-eve-nakliyat" class="d-inline-block me-2 mb-2">Beşiktaş</a>
          <a href="/istanbul/uskudar-evden-eve-nakliyat" class="d-inline-block me-2 mb-2">Üsküdar</a>
        </div>
      </div>
    </div>
    <div class="text-center pt-4 small text-muted">© <?= date('Y') ?> Tüm hakları saklıdır.</div>
  </div>
</footer>
