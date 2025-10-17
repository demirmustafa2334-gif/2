<?php include __DIR__ . '/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Mesaj Detayı</h1>
    <a href="<?php echo SITE_URL; ?>/admin/messages" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Geri Dön
    </a>
</div>

<?php if ($message): ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <?php echo $message['subject'] ?: 'Konu Yok'; ?>
            <?php if (!$message['is_read']): ?>
            <span class="badge bg-warning">Yeni</span>
            <?php endif; ?>
        </h5>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Gönderen:</strong> <?php echo $message['name']; ?></p>
                <p><strong>E-posta:</strong> <a href="mailto:<?php echo $message['email']; ?>"><?php echo $message['email']; ?></a></p>
                <?php if ($message['phone']): ?>
                <p><strong>Telefon:</strong> <a href="tel:<?php echo $message['phone']; ?>"><?php echo $message['phone']; ?></a></p>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <?php if ($message['from_location'] || $message['to_location']): ?>
                <p><strong>Nereden:</strong> <?php echo $message['from_location'] ?: '-'; ?></p>
                <p><strong>Nereye:</strong> <?php echo $message['to_location'] ?: '-'; ?></p>
                <?php endif; ?>
                <p><strong>Tarih:</strong> <?php echo date('d.m.Y H:i:s', strtotime($message['created_at'])); ?></p>
            </div>
        </div>
        
        <hr>
        
        <div class="mb-3">
            <strong>Mesaj:</strong>
            <div class="mt-2 p-3 bg-light rounded">
                <?php echo nl2br(htmlspecialchars($message['message'])); ?>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-warning">
    Mesaj bulunamadı.
</div>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
