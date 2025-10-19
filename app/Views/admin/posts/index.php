<div class="container py-5">
  <h1 class="h4 mb-3">Yazılar</h1>
  <form class="row g-2 mb-4" method="post">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '') ?>">
    <div class="col-md-4"><input name="title" class="form-control" placeholder="Başlık" required></div>
    <div class="col-md-3"><input name="slug" class="form-control" placeholder="slug" required></div>
    <div class="col-md-3">
      <select name="district_id" class="form-select">
        <option value="0">İlçe seçiniz (opsiyonel)</option>
        <?php foreach ($cities as $c): ?>
          <optgroup label="<?= htmlspecialchars($c['name']) ?>">
            <?php foreach (App\Models\District::byCityId((int)$c['id']) as $d): ?>
              <option value="<?= (int)$d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
            <?php endforeach; ?>
          </optgroup>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-12"><textarea name="content" class="form-control" rows="6" placeholder="İçerik" required></textarea></div>
    <div class="col-12 d-flex gap-2"><button class="btn btn-primary">Kaydet</button></div>
  </form>
  <form class="row g-2 mb-4" method="post" action="/admin/yazilar/ai">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '') ?>">
    <div class="col-md-5"><input name="title" class="form-control" placeholder="AI Başlık" required></div>
    <div class="col-md-5">
      <select name="district_id" class="form-select" required>
        <?php foreach ($cities as $c): ?>
          <optgroup label="<?= htmlspecialchars($c['name']) ?>">
            <?php foreach (App\Models\District::byCityId((int)$c['id']) as $d): ?>
              <option value="<?= (int)$d['id'] ?>"><?= htmlspecialchars($d['name']) ?></option>
            <?php endforeach; ?>
          </optgroup>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-2 d-grid"><button class="btn btn-success">AI ile Oluştur</button></div>
  </form>
  <div class="list-group">
    <?php foreach ($posts as $p): ?>
      <a class="list-group-item" href="/blog/<?= htmlspecialchars($p['slug']) ?>"><?= htmlspecialchars($p['title']) ?></a>
    <?php endforeach; ?>
  </div>
</div>
