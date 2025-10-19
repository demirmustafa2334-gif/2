<div class="container py-5">
  <h1 class="h4 mb-3">Şehirler</h1>
  <form class="row g-2 mb-4" method="post">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'] ?? '') ?>">
    <div class="col-md-5"><input name="name" class="form-control" placeholder="Şehir adı" required></div>
    <div class="col-md-5"><input name="slug" class="form-control" placeholder="slug" required></div>
    <div class="col-md-2 d-grid"><button class="btn btn-primary">Ekle</button></div>
  </form>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead><tr><th>ID</th><th>Ad</th><th>Slug</th></tr></thead>
      <tbody>
        <?php foreach ($cities as $c): ?>
          <tr><td><?= (int)$c['id'] ?></td><td><?= htmlspecialchars($c['name']) ?></td><td><?= htmlspecialchars($c['slug']) ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
