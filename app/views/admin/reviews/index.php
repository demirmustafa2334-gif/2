<?php ob_start(); ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold">Müşteri Yorumları</h1>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Müşteri</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Puan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Yorum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Konum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarih</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= escape($review['customer_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex text-yellow-500">
                            <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </td>
                    <td class="px-6 py-4"><?= truncate($review['review_text'], 50) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= escape($review['location']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if ($review['is_approved']): ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Onaylı
                            </span>
                        <?php else: ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Beklemede
                            </span>
                        <?php endif; ?>
                        <?php if ($review['is_featured']): ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 ml-1">
                                Öne Çıkan
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <?= formatDate($review['created_at']) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <?php if (!$review['is_approved']): ?>
                            <a href="/admin/reviews/approve/<?= $review['id'] ?>" 
                               class="text-green-600 hover:text-green-900 mr-4">
                                <i class="fas fa-check"></i> Onayla
                            </a>
                        <?php endif; ?>
                        <a href="/admin/reviews/delete/<?= $review['id'] ?>" 
                           onclick="return confirm('Emin misiniz?')" 
                           class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Sil
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
$pageTitle = 'Müşteri Yorumları';
require __DIR__ . '/../../layouts/admin.php';
?>
