<?php /** @var array $reviews */ ?>
<h1>Müşteri Yorumları</h1>
<div class="grid">
  <?php foreach ($reviews as $r): ?>
    <div class="card">
      <strong><?= htmlspecialchars($r['name']) ?></strong>
      <div>⭐ <?= (int)$r['rating'] ?>/5</div>
      <p><?= nl2br(htmlspecialchars($r['content'])) ?></p>
    </div>
  <?php endforeach; ?>
</div>
