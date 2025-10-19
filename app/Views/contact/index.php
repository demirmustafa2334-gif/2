<div class="container py-5" style="max-width:700px;">
  <h1 class="h3 mb-3">İletişim</h1>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '') ?>">
    <div class="mb-3"><label class="form-label">Ad Soyad</label><input name="name" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">E-posta</label><input type="email" name="email" class="form-control"></div>
    <div class="mb-3"><label class="form-label">Mesajınız</label><textarea name="message" class="form-control" rows="5" required></textarea></div>
    <button class="btn btn-primary">Gönder</button>
  </form>
</div>
