<?php
use App\Helpers\Seo;
use App\Core\View;

Seo::set([
  'title' => 'İstanbul Evden Eve Nakliyat | Hızlı ve Güvenli',
  'description' => 'İstanbul içi ev ve ofis taşımacılığı. Uygun fiyatlar, sigortalı taşıma, ücretsiz ekspertiz.',
]);
?>
<div class="row align-items-center">
  <div class="col-12 col-lg-6">
    <h1>İstanbul Evden Eve Nakliyat</h1>
    <p>Profesyonel ekip, hızlı ve güvenli taşımacılık. Uygun fiyatlar ile şehir içi taşınma.</p>
    <a class="btn btn-primary" href="/fiyat-hesapla">Fiyat Hesapla</a>
    <a class="btn btn-outline-secondary" href="/hizmetler">Hizmetler</a>
  </div>
  <div class="col-12 col-lg-6 text-center">
    <img src="/assets/img/hero.png" alt="Nakliyat" class="img-fluid" loading="lazy" />
  </div>
</div>

<section class="mt-5">
  <h2>Müşteri Yorumları</h2>
  <div id="reviews" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <blockquote>"Hızlı ve güvenilir. Çok memnun kaldım." – Ayşe T.</blockquote>
      </div>
      <div class="carousel-item">
        <blockquote>"Fiyat performans harika." – Mehmet K.</blockquote>
      </div>
    </div>
  </div>
</section>
