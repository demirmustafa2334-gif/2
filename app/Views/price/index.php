<?php
use App\Helpers\Seo;
use App\Core\View;
Seo::set(['title' => 'Fiyat Listesi | İstanbul Nakliyat']);
?>
<h1>Fiyat Listesi</h1>
<p>Örnek fiyatlar bilgilendirme amaçlıdır. Net fiyat için lütfen hesaplayıcıyı kullanın.</p>
<form method="post" action="/fiyat-hesapla" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nereden (İlçe)</label>
    <input class="form-control" name="from" placeholder="Kadıköy" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Nereye (İlçe)</label>
    <input class="form-control" name="to" placeholder="Beşiktaş" required>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Hesapla</button>
  </div>
</form>
