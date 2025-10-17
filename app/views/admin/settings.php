<?php ob_start(); ?>

<h1 class="text-3xl font-bold mb-8">Genel Ayarlar</h1>

<div class="bg-white rounded-lg shadow p-6">
    <form method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-2">Site Adı</label>
                <input type="text" name="settings[site_name]" 
                       value="<?= escape(getSetting('site_name')) ?>"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">İletişim E-posta</label>
                <input type="email" name="settings[contact_email]" 
                       value="<?= escape(getSetting('contact_email')) ?>"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">İletişim Telefon</label>
                <input type="text" name="settings[contact_phone]" 
                       value="<?= escape(getSetting('contact_phone')) ?>"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-gray-700 mb-2">WhatsApp Numarası</label>
                <input type="text" name="settings[whatsapp_number]" 
                       value="<?= escape(getSetting('whatsapp_number')) ?>"
                       placeholder="+905551234567"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
            </div>
        </div>
        
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Site Açıklaması</label>
            <textarea name="settings[site_description]" rows="3"
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"><?= escape(getSetting('site_description')) ?></textarea>
        </div>
        
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Adres</label>
            <textarea name="settings[address]" rows="2"
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"><?= escape(getSetting('address')) ?></textarea>
        </div>
        
        <div class="mt-6 border-t pt-6">
            <h3 class="text-lg font-semibold mb-4">Sosyal Medya</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-gray-700 mb-2">Facebook URL</label>
                    <input type="url" name="settings[facebook_url]" 
                           value="<?= escape(getSetting('facebook_url')) ?>"
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" name="settings[instagram_url]" 
                           value="<?= escape(getSetting('instagram_url')) ?>"
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Twitter URL</label>
                    <input type="url" name="settings[twitter_url]" 
                           value="<?= escape(getSetting('twitter_url')) ?>"
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
            </div>
        </div>
        
        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-8 py-2 rounded hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i>Kaydet
            </button>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$pageTitle = 'Ayarlar';
require __DIR__ . '/../layouts/admin.php';
?>
