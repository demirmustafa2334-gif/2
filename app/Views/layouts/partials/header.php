<?php $appName = ($this->config['app_name'] ?? 'Istanbul Nakliyat'); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/"><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Anasayfa</a></li>
        <li class="nav-item"><a class="nav-link" href="/hizmetler">Hizmetler</a></li>
        <li class="nav-item"><a class="nav-link" href="/fiyat-listesi">Fiyat Listesi</a></li>
        <li class="nav-item"><a class="nav-link" href="/iletisim">İletişim</a></li>
      </ul>
    </div>
  </div>
</nav>
