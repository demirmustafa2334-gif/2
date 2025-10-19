<div class="container py-5" style="max-width:520px;">
  <h1 class="h4 mb-4">Yönetici Girişi</h1>
  <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '') ?>">
    <div class="mb-3"><label class="form-label">Kullanıcı Adı</label><input name="username" class="form-control" required></div>
    <div class="mb-3"><label class="form-label">Şifre</label><input type="password" name="password" class="form-control" required></div>
    <button class="btn btn-primary">Giriş Yap</button>
  </form>
</div>
