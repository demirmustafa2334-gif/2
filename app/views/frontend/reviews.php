<?php 
ob_start();
$metaTitle = 'Müşteri Yorumları - ' . getSetting('site_name');
$metaDescription = 'Müşterilerimizin İstanbul nakliyat hizmetlerimiz hakkındaki yorumlarını okuyun.';
?>

<section class="py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-4">Müşteri Yorumları</h1>
        <p class="text-center text-gray-600 mb-12">Bize güvenen müşterilerimizin deneyimlerini okuyun</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($reviews as $review): ?>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            <?= strtoupper(substr($review['customer_name'], 0, 1)) ?>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg"><?= escape($review['customer_name']) ?></h3>
                            <div class="flex text-yellow-500">
                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for ($i = $review['rating']; $i < 5; $i++): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-4"><?= escape($review['review_text']) ?></p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <?php if ($review['location']): ?>
                            <span><i class="fas fa-map-marker-alt mr-1"></i><?= escape($review['location']) ?></span>
                        <?php endif; ?>
                        <span><?= formatDate($review['created_at']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Review Form -->
        <div class="mt-16 max-w-2xl mx-auto bg-gray-50 p-8 rounded-lg">
            <h2 class="text-2xl font-bold mb-6 text-center">Deneyiminizi Paylaşın</h2>
            <form method="POST" action="/api/submit-review">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Adınız Soyadınız *</label>
                    <input type="text" name="customer_name" required 
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Puan *</label>
                    <div class="flex space-x-2">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <label class="cursor-pointer">
                                <input type="radio" name="rating" value="<?= $i ?>" class="hidden peer" required>
                                <span class="text-3xl text-gray-300 peer-checked:text-yellow-500 hover:text-yellow-400">
                                    <i class="fas fa-star"></i>
                                </span>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Yorumunuz *</label>
                    <textarea name="review_text" rows="4" required 
                              class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500"></textarea>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Konum (İsteğe bağlı)</label>
                    <input type="text" name="location" 
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                    Yorumu Gönder
                </button>
                
                <p class="text-sm text-gray-500 mt-4 text-center">
                    Yorumunuz onaylandıktan sonra yayınlanacaktır.
                </p>
            </form>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
