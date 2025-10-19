<div class="container py-5">
  <h1 class="h4 mb-3">İlçeler</h1>
  <form class="row g-2 mb-4" method="post">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '') ?>">
    <div class="col-md-3">
      <select name="city_id" class="form-select" required>
        <option value="">Şehir seçiniz</option>
        <?php foreach ($cities as $c): ?><option value="<?= (int)$c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option><?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-4"><input name="name" class="form-control" placeholder="İlçe adı" required></div>
    <div class="col-md-4"><input name="slug" class="form-control" placeholder="slug" required></div>
    <div class="col-md-1 d-grid"><button class="btn btn-primary">Ekle</button></div>
  </form>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead><tr><th>ID</th><th>Şehir</th><th>İlçe</th><th>Slug</th></tr></thead>
      <tbody>
        <?php foreach ($districts as $d): ?>
          <tr><td><?= (int)$d['id'] ?></td><td><?= htmlspecialchars($d['city_name']) ?></td><td><?= htmlspecialchars($d['name']) ?></td><td><?= htmlspecialchars($d['slug']) ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
