<?php
use App\Helpers\Seo;
use App\Core\View;
Seo::set(['title' => 'Fiyat Hesapla | İstanbul Nakliyat']);
?>
<h1>Fiyat Hesapla</h1>
<?php if (!empty($estimate)): ?>
  <p><strong><?= View::e((string)$from) ?></strong> → <strong><?= View::e((string)$to) ?></strong> arası tahmini fiyat: <strong><?= number_format((float)$estimate, 0, ',', '.') ?> ₺</strong></p>
<?php else: ?>
  <p>Lütfen ilçe seçerek tekrar deneyin.</p>
<?php endif; ?>
<a class="btn btn-secondary" href="/fiyat-listesi">Geri Dön</a>
