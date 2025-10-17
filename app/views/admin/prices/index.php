<?php ob_start(); ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Fiyat Listesi</h1>
    <a href="/admin/prices/create" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        <i class="fas fa-plus mr-2"></i>Yeni Fiyat Ekle
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nereden</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nereye</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fiyat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($prices as $price): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= escape($price['from_district_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?= escape($price['to_district_name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-green-600">
                        <?= formatPrice($price['base_price']) ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if ($price['is_active']): ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        <?php else: ?>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Pasif
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="/admin/prices/edit/<?= $price['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-4">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="/admin/prices/delete/<?= $price['id'] ?>" 
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
$pageTitle = 'Fiyatlar';
require __DIR__ . '/../../layouts/admin.php';
?>
