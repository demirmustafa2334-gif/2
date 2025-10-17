<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">İletişim Mesajları</h1>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Gönderen</th>
                        <th>Konu</th>
                        <th>Mesaj</th>
                        <th>Nereden → Nereye</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $message): ?>
                        <tr class="<?php echo !$message['is_read'] ? 'table-primary' : ''; ?>">
                            <td><?php echo $message['id']; ?></td>
                            <td>
                                <strong><?php echo $message['name']; ?></strong><br>
                                <small><?php echo $message['email']; ?></small><br>
                                <small><?php echo $message['phone'] ?: '-'; ?></small>
                            </td>
                            <td><?php echo $message['subject'] ?: '-'; ?></td>
                            <td><?php echo substr($message['message'], 0, 80); ?>...</td>
                            <td>
                                <?php if ($message['from_location'] || $message['to_location']): ?>
                                    <?php echo $message['from_location'] ?: '?'; ?> → <?php echo $message['to_location'] ?: '?'; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($message['is_read']): ?>
                                <span class="badge bg-secondary">Okundu</span>
                                <?php else: ?>
                                <span class="badge bg-warning">Yeni</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d.m.Y H:i', strtotime($message['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo SITE_URL; ?>/admin/message/<?php echo $message['id']; ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Görüntüle
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">Henüz mesaj bulunmamaktadır.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>
