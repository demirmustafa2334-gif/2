<?php use App\Models\City; $allCities = City::all(); ?>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="/">yereltanitim.com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">İller</a>
          <ul class="dropdown-menu dropdown-menu-end overflow-auto" style="max-height:60vh; min-width: 300px;">
            <?php foreach ($allCities as $c): ?>
              <li><a class="dropdown-item" href="/il/<?= htmlspecialchars($c['slug']) ?>"><?= htmlspecialchars($c['name']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
        <li class="nav-item"><a class="btn btn-primary ms-lg-2" href="/iletisim">İletişim</a></li>
      </ul>
    </div>
  </div>
</nav>
