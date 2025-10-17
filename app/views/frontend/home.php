<?php 
ob_start();
$metaTitle = getSetting('site_name') . ' - ' . getSetting('site_description');
$metaDescription = getSetting('site_description');
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl">
            <h1 class="text-5xl font-bold mb-6">İstanbul'un En Güvenilir Nakliyat Firması</h1>
            <p class="text-xl mb-8">Profesyonel ekibimiz ve modern araçlarımızla evden eve nakliyat hizmetiniz güvende!</p>
            <div class="flex space-x-4">
                <a href="/iletisim" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Hemen Teklif Al
                </a>
                <a href="tel:<?= getSetting('contact_phone') ?>" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600">
                    <i class="fas fa-phone mr-2"></i>Bizi Arayın
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Hizmetlerimiz</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="text-blue-600 text-5xl mb-4">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Evden Eve Nakliyat</h3>
                <p class="text-gray-600">Eşyalarınızı özenle paketliyor ve güvenli bir şekilde yeni adresinize taşıyoruz.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="text-blue-600 text-5xl mb-4">
                    <i class="fas fa-building"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Ofis Taşıma</h3>
                <p class="text-gray-600">İş yerinizi minimal kesinti ile profesyonel ekibimizle taşıyoruz.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition">
                <div class="text-blue-600 text-5xl mb-4">
                    <i class="fas fa-box"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Paketleme Hizmeti</h3>
                <p class="text-gray-600">Eşyalarınızı koruyucu malzemelerle profesyonelce paketliyoruz.</p>
            </div>
        </div>
    </div>
</section>

<!-- Price Calculator -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Fiyat Hesaplama</h2>
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <form id="priceCalculatorForm">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Nereden</label>
                        <select name="from_district" id="fromDistrict" required 
                                class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                            <option value="">İlçe Seçin</option>
                            <?php foreach (getActiveDistricts() as $district): ?>
                                <option value="<?= $district['id'] ?>"><?= escape($district['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 mb-2">Nereye</label>
                        <select name="to_district" id="toDistrict" required 
                                class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                            <option value="">İlçe Seçin</option>
                            <?php foreach (getActiveDistricts() as $district): ?>
                                <option value="<?= $district['id'] ?>"><?= escape($district['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                    Fiyat Hesapla
                </button>
            </form>
            
            <div id="priceResult" class="hidden mt-6 p-6 bg-green-50 border border-green-200 rounded">
                <p class="text-center text-gray-700">Tahmini Fiyat:</p>
                <p class="text-center text-4xl font-bold text-green-600" id="calculatedPrice">0 ₺</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Neden Bizi Seçmelisiniz?</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Güvenilir</h3>
                <p class="text-gray-600">Sigortalı taşımacılık</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Profesyonel Ekip</h3>
                <p class="text-gray-600">Deneyimli personel</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-truck text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Modern Araçlar</h3>
                <p class="text-gray-600">Yeni model filomuz</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dollar-sign text-blue-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Uygun Fiyat</h3>
                <p class="text-gray-600">Rakipsiz fiyatlar</p>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews -->
<?php if (!empty($featuredReviews)): ?>
<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Müşteri Yorumları</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($featuredReviews as $review): ?>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            <?= strtoupper(substr($review['customer_name'], 0, 1)) ?>
                        </div>
                        <div>
                            <h4 class="font-bold"><?= escape($review['customer_name']) ?></h4>
                            <div class="text-yellow-500">
                                <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600"><?= escape($review['review_text']) ?></p>
                    <?php if ($review['location']): ?>
                        <p class="text-sm text-gray-500 mt-2"><i class="fas fa-map-marker-alt mr-1"></i><?= escape($review['location']) ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-8">
            <a href="/yorumlar" class="text-blue-600 hover:text-blue-800 font-semibold">
                Tüm Yorumları Görüntüle <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Districts Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-12">Hizmet Verdiğimiz İlçeler</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
            <?php foreach (getActiveDistricts() as $district): ?>
                <a href="/istanbul/<?= $district['slug'] ?>" 
                   class="bg-white p-4 rounded-lg shadow hover:shadow-lg text-center transition">
                    <i class="fas fa-map-marker-alt text-blue-600 text-2xl mb-2"></i>
                    <p class="font-semibold"><?= escape($district['name']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
document.getElementById('priceCalculatorForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const fromDistrict = document.getElementById('fromDistrict').value;
    const toDistrict = document.getElementById('toDistrict').value;
    
    if (!fromDistrict || !toDistrict) {
        alert('Lütfen her iki ilçeyi de seçin!');
        return;
    }
    
    fetch('/api/calculate-price', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `from_district=${fromDistrict}&to_district=${toDistrict}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('calculatedPrice').textContent = data.formatted_price;
            document.getElementById('priceResult').classList.remove('hidden');
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
