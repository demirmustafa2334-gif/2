<div class="container py-5">
  <h1 class="h3 mb-4">Blog</h1>
  <?php if (empty($posts)): ?>
    <p>Henüz içerik bulunmuyor.</p>
  <?php else: ?>
    <div class="list-group">
      <?php foreach ($posts as $p): ?>
        <a class="list-group-item list-group-item-action" href="/blog/<?= htmlspecialchars($p['slug']) ?>">
          <h2 class="h5 mb-1"><?= htmlspecialchars($p['title']) ?></h2>
          <div class="small text-muted"><?= htmlspecialchars(date('d.m.Y', strtotime($p['created_at']))) ?></div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
