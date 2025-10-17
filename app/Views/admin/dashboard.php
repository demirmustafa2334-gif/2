<h1>Yönetim Paneli</h1>
<div class="grid">
  <div class="card"><strong>Sayfalar:</strong> <?= (int)$counts['pages'] ?></div>
  <div class="card"><strong>İlçeler:</strong> <?= (int)$counts['districts'] ?></div>
  <div class="card"><strong>Semtler:</strong> <?= (int)$counts['neighborhoods'] ?></div>
  <div class="card"><strong>Bekleyen Yorumlar:</strong> <?= (int)$counts['reviews'] ?></div>
</div>
<nav style="margin-top:12px; display:flex; gap:8px;">
  <a class="btn" href="/admin/locations">İlçe & Semt</a>
  <a class="btn" href="/admin/pages">Sayfalar</a>
  <a class="btn" href="/admin/reviews">Yorumlar</a>
  <a class="btn" href="/admin/logout" style="background:#ef4444;">Çıkış</a>
</nav>
