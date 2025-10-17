<?php $token = \Core\CSRF::token(); ?>
<h1>İletişim</h1>
<?php if (!empty($_GET['sent'])): ?>
  <div class="card" style="border-left:4px solid #16a34a;">Talebiniz alınmıştır. Sizi arayacağız.</div>
<?php endif; ?>
<form method="post" action="/contact">
  <input type="hidden" name="_token" value="<?= htmlspecialchars($token) ?>">
  <div style="display:grid; gap:8px; max-width:520px;">
    <input name="name" placeholder="Ad Soyad" required />
    <input name="phone" placeholder="Telefon" required />
    <textarea name="message" placeholder="Mesaj" rows="4"></textarea>
    <button class="btn" type="submit">Gönder</button>
  </div>
</form>
