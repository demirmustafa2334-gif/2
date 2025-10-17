<?php /** @var array{name:string} $site */ ?>
<nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="/"><?= htmlspecialchars($site['name']) ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/services">Hizmetler</a></li>
        <li class="nav-item"><a class="nav-link" href="/price-list">Fiyatlar</a></li>
        <li class="nav-item"><a class="nav-link" href="/reviews">Yorumlar</a></li>
        <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
        <li class="nav-item"><a class="btn btn-primary ms-lg-3" href="/contact">Teklif Al</a></li>
      </ul>
    </div>
  </div>
</nav>
