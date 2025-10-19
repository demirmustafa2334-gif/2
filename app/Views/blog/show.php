<div class="container py-5">
  <h1 class="h3 mb-3"><?= htmlspecialchars($post['title']) ?></h1>
  <div class="mb-4"><?= $post['content'] ?></div>
  <?php if (!empty($suggestions)): ?>
    <h2 class="h6">Aynı şehirden diğer ilçeler</h2>
    <ul class="list-inline">
      <?php foreach ($suggestions as $s): ?>
        <li class="list-inline-item"><a href="#" class="btn btn-sm btn-outline-secondary"><?= htmlspecialchars($s['name']) ?></a></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>
