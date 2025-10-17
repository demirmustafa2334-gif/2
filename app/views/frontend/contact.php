<?php 
ob_start();
$metaTitle = 'İletişim - ' . getSetting('site_name');
$metaDescription = 'İstanbul nakliyat hizmetleri için bizimle iletişime geçin.';
?>

<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-12">İletişim</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <div class="bg-white p-8 rounded-lg shadow">
                    <?php if ($success = Session::flash('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?= escape($success) ?>
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="text-2xl font-bold mb-6">Bize Ulaşın</h2>
                    <form method="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Adınız Soyadınız *</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">E-posta *</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Telefon *</label>
                            <input type="tel" name="phone" required 
                                   class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">Mesajınız *</label>
                            <textarea name="message" rows="5" required 
                                      class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                            <i class="fas fa-paper-plane mr-2"></i>Gönder
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div>
                <div class="bg-blue-600 text-white p-8 rounded-lg mb-6">
                    <h2 class="text-2xl font-bold mb-6">İletişim Bilgileri</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-phone text-2xl mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">Telefon</h3>
                                <p><?= getSetting('contact_phone') ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-envelope text-2xl mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">E-posta</h3>
                                <p><?= getSetting('contact_email') ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-2xl mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">Adres</h3>
                                <p><?= getSetting('address', 'İstanbul, Türkiye') ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fab fa-whatsapp text-2xl mr-4 mt-1"></i>
                            <div>
                                <h3 class="font-semibold mb-1">WhatsApp</h3>
                                <a href="https://wa.me/<?= getSetting('whatsapp_number') ?>" target="_blank" class="hover:underline">
                                    <?= getSetting('whatsapp_number') ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-lg shadow">
                    <h3 class="text-xl font-bold mb-4">Çalışma Saatleri</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pazartesi - Cumartesi</span>
                            <span class="font-semibold">08:00 - 20:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pazar</span>
                            <span class="font-semibold">09:00 - 18:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
