<div class="container py-5">
  <h1 class="h4 mb-3">İletişim Mesajları</h1>
  <div class="list-group">
    <?php foreach ($messages as $m): ?>
      <div class="list-group-item">
        <div class="small text-muted"><?= htmlspecialchars($m['email'] ?? '') ?> — <?= htmlspecialchars($m['created_at']) ?></div>
        <div><strong><?= htmlspecialchars($m['name']) ?>:</strong> <?= nl2br(htmlspecialchars($m['message'])) ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
