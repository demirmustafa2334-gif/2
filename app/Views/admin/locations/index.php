<h1>İlçe & Semt Yönetimi</h1>
<form method="post" action="/admin/locations/districts">
  <h3>Yeni İlçe</h3>
  <div style="display:grid; gap:8px; max-width:420px;">
    <input name="name" placeholder="İlçe adı" required />
    <input name="slug" placeholder="slug (kadikoy)" required />
    <button class="btn" type="submit">Ekle</button>
  </div>
</form>
<hr>
<h3>İlçeler</h3>
<ul>
  <?php foreach ($districts as $d): ?>
    <li>
      <strong><?= htmlspecialchars($d['name']) ?></strong>
      <a class="btn" style="background:#e5e7eb;color:#111827;" href="/istanbul/ilce/<?= htmlspecialchars($d['slug']) ?>" target="_blank">Görüntüle</a>
    </li>
  <?php endforeach; ?>
</ul>
