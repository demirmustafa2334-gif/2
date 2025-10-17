<?php /** @var array $districts */ ?>
<h1>Fiyat Hesaplama</h1>
<form method="get" action="/api/estimate" onsubmit="event.preventDefault(); fetch(this.action + '?' + new URLSearchParams(new FormData(this))).then(r=>r.json()).then(d=>{document.getElementById('r').textContent = d.estimated ? ('Tahmin: ₺' + d.estimated) : 'Fiyat bulunamadı';});">
  <label>Çıkış İlçe</label>
  <select name="from" required>
    <?php foreach ($districts as $d): ?>
      <option value="<?= (int)$d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
    <?php endforeach; ?>
  </select>
  <label>Varış İlçe</label>
  <select name="to" required>
    <?php foreach ($districts as $d): ?>
      <option value="<?= (int)$d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
    <?php endforeach; ?>
  </select>
  <button class="btn" type="submit">Hesapla</button>
</form>
<div id="r" style="margin-top:8px; font-weight:700"></div>
