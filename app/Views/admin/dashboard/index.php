<div class="container py-5">
  <h1 class="h4 mb-4">Yönetim Paneli</h1>
  <div class="row g-3 mb-4">
    <div class="col-md-3"><div class="card h-100"><div class="card-body"><div class="small text-muted">Şehir</div><div class="display-6"><?= (int)$stats['cities'] ?></div></div></div></div>
    <div class="col-md-3"><div class="card h-100"><div class="card-body"><div class="small text-muted">İlçe</div><div class="display-6"><?= (int)$stats['districts'] ?></div></div></div></div>
    <div class="col-md-3"><div class="card h-100"><div class="card-body"><div class="small text-muted">Yazı</div><div class="display-6"><?= (int)$stats['posts'] ?></div></div></div></div>
    <div class="col-md-3"><div class="card h-100"><div class="card-body"><div class="small text-muted">Okunmamış Mesaj</div><div class="display-6"><?= (int)$stats['messages'] ?></div></div></div></div>
  </div>
  <div class="d-flex gap-2">
    <a class="btn btn-outline-primary" href="/admin/sehirler">Şehirler</a>
    <a class="btn btn-outline-primary" href="/admin/ilceler">İlçeler</a>
    <a class="btn btn-outline-primary" href="/admin/yazilar">Yazılar</a>
    <a class="btn btn-outline-primary" href="/admin/mesajlar">Mesajlar</a>
    <a class="btn btn-danger ms-auto" href="/admin/logout">Çıkış</a>
  </div>
</div>
