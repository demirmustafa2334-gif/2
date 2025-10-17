<?php ob_start(); ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">İlçeler</h1>
    <a href="/admin/districts/create" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        <i class="fas fa-plus mr-2"></i>Yeni İlçe Ekle
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İsim</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($districts as $district): ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"><?= escape($district['name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500"><?= escape($district['slug']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <?php if ($district['is_active']): ?>
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
                        <a href="/admin/districts/edit/<?= $district['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-4">
                            <i class="fas fa-edit"></i> Düzenle
                        </a>
                        <a href="/admin/districts/delete/<?= $district['id'] ?>" 
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
$pageTitle = 'İlçeler';
require __DIR__ . '/../../layouts/admin.php';
?>
