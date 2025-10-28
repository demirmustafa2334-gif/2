<?php
use App\Helpers\Seo;
use App\Core\View;
Seo::set(['title' => 'İletişim | İstanbul Nakliyat']);
$flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']);
?>
<h1>İletişim</h1>
<?php if ($flash): ?>
  <div class="alert alert-success"><?= View::e($flash) ?></div>
<?php endif; ?>
<form method="post" action="/iletisim" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Ad Soyad</label>
    <input type="text" class="form-control" name="name" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Telefon</label>
    <input type="tel" class="form-control" name="phone" required>
  </div>
  <div class="col-12">
    <label class="form-label">Mesaj</label>
    <textarea class="form-control" name="message" rows="4" required></textarea>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Gönder</button>
  </div>
</form>
