<?php ob_start(); ?>

<h1 class="text-3xl font-bold mb-8">Dashboard</h1>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">İlçeler</p>
                <p class="text-3xl font-bold"><?= $totalDistricts ?></p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-map-marked-alt text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Semtler</p>
                <p class="text-3xl font-bold"><?= $totalNeighborhoods ?></p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-map-pin text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Yorumlar</p>
                <p class="text-3xl font-bold"><?= $totalReviews ?></p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-star text-yellow-600 text-2xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Blog Yazıları</p>
                <p class="text-3xl font-bold"><?= $totalBlogPosts ?></p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-blog text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Recent Reviews -->
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Son Yorumlar</h2>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Müşteri</th>
                    <th class="text-left py-2">Puan</th>
                    <th class="text-left py-2">Yorum</th>
                    <th class="text-left py-2">Durum</th>
                    <th class="text-left py-2">Tarih</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_slice($recentReviews, 0, 5) as $review): ?>
                    <tr class="border-b">
                        <td class="py-3"><?= escape($review['customer_name']) ?></td>
                        <td class="py-3">
                            <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                <i class="fas fa-star text-yellow-500"></i>
                            <?php endfor; ?>
                        </td>
                        <td class="py-3"><?= truncate($review['review_text'], 50) ?></td>
                        <td class="py-3">
                            <?php if ($review['is_approved']): ?>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Onaylı</span>
                            <?php else: ?>
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">Beklemede</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3"><?= formatDate($review['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageTitle = 'Dashboard';
require __DIR__ . '/../layouts/admin.php';
?>
