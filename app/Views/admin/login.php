<?php $token = \Core\CSRF::token(); ?>
<h1>Admin Giriş</h1>
<form method="post" action="/admin/login">
  <input type="hidden" name="_token" value="<?= htmlspecialchars($token) ?>">
  <div style="display:grid; gap:8px; max-width:320px;">
    <input name="username" placeholder="Kullanıcı Adı" required />
    <input name="password" type="password" placeholder="Şifre" required />
    <button class="btn" type="submit">Giriş Yap</button>
  </div>
</form>
