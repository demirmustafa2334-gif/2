<?php ob_start(); ?>

<div class="mb-8">
    <h1 class="text-3xl font-bold">Yeni İlçe Ekle</h1>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form method="POST">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2">İlçe Adı *</label>
                <input type="text" name="name" required 
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"
                       value="<?= old('name') ?>">
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">Slug (Boş bırakılırsa otomatik)</label>
                <input type="text" name="slug" 
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"
                       value="<?= old('slug') ?>">
            </div>
        </div>
        
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Kısa Açıklama</label>
            <textarea name="description" rows="3" 
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"><?= old('description') ?></textarea>
        </div>
        
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">İçerik</label>
            <textarea name="content" rows="6" 
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"><?= old('content') ?></textarea>
        </div>
        
        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">SEO Ayarları</h3>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Meta Başlık</label>
                <input type="text" name="meta_title" 
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"
                       value="<?= old('meta_title') ?>">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Meta Açıklama</label>
                <textarea name="meta_description" rows="2" 
                          class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"><?= old('meta_description') ?></textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Meta Anahtar Kelimeler</label>
                <input type="text" name="meta_keywords" 
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"
                       value="<?= old('meta_keywords') ?>">
            </div>
        </div>
        
        <div class="mt-6 flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" checked class="mr-2">
                <span class="text-gray-700">Aktif</span>
            </label>
            
            <div>
                <a href="/admin/districts" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 mr-2">
                    İptal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Kaydet
                </button>
            </div>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$pageTitle = 'Yeni İlçe Ekle';
require __DIR__ . '/../../layouts/admin.php';
?>
