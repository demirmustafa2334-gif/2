<?php 
ob_start();
$metaTitle = $district['meta_title'] ?: $district['name'] . ' Evden Eve Nakliyat';
$metaDescription = $district['meta_description'] ?: $district['description'];
$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => '/'],
    ['name' => 'İstanbul', 'url' => '/istanbul'],
    ['name' => $district['name'], 'url' => '/istanbul/' . $district['slug']]
];
?>

<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <nav class="text-sm">
            <a href="/" class="text-blue-600 hover:text-blue-800">Ana Sayfa</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600"><?= escape($district['name']) ?> Nakliyat</span>
        </nav>
    </div>
</div>

<!-- Main Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <h1 class="text-4xl font-bold mb-6"><?= escape($district['name']) ?> Evden Eve Nakliyat</h1>
                
                <?php if ($district['description']): ?>
                    <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-6">
                        <p class="text-gray-700"><?= escape($district['description']) ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="prose max-w-none mb-8">
                    <?php if ($district['content']): ?>
                        <?= $district['content'] ?>
                    <?php else: ?>
                        <p><?= escape($district['name']) ?>'de evden eve nakliyat hizmetleri için profesyonel ekibimizle yanınızdayız. Güvenli ve hızlı taşımacılık garantisi ile eşyalarınızı özenle taşıyoruz.</p>
                        
                        <h2>Neden Bizi Tercih Etmelisiniz?</h2>
                        <ul>
                            <li>Profesyonel ve deneyimli ekip</li>
                            <li>Sigortalı taşımacılık</li>
                            <li>Modern araç filomuz</li>
                            <li>Uygun fiyat garantisi</li>
                            <li>7/24 müşteri desteği</li>
                        </ul>
                        
                        <h2>Hizmetlerimiz</h2>
                        <ul>
                            <li>Evden eve nakliyat</li>
                            <li>Ofis taşıma</li>
                            <li>Paketleme ve ambalajlama</li>
                            <li>Eşya montaj-demontaj</li>
                            <li>Depolama hizmetleri</li>
                        </ul>
                    <?php endif; ?>
                </div>
                
                <!-- Neighborhoods -->
                <?php if (!empty($neighborhoods)): ?>
                    <div class="bg-white p-6 rounded-lg shadow mb-8">
                        <h2 class="text-2xl font-bold mb-4"><?= escape($district['name']) ?> Semtleri</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <?php foreach ($neighborhoods as $neighborhood): ?>
                                <a href="/istanbul/<?= $neighborhood['slug'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 hover:underline">
                                    <i class="fas fa-map-pin mr-2"></i><?= escape($neighborhood['name']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- CTA -->
                <div class="bg-blue-600 text-white p-8 rounded-lg text-center">
                    <h3 class="text-2xl font-bold mb-4">Ücretsiz Fiyat Teklifi Alın</h3>
                    <p class="mb-6"><?= escape($district['name']) ?>'de nakliyat için hemen bizi arayın veya online teklif alın!</p>
                    <div class="flex justify-center space-x-4">
                        <a href="tel:<?= getSetting('contact_phone') ?>" class="bg-white text-blue-600 px-6 py-3 rounded hover:bg-gray-100">
                            <i class="fas fa-phone mr-2"></i>Hemen Ara
                        </a>
                        <a href="/iletisim" class="border-2 border-white text-white px-6 py-3 rounded hover:bg-blue-700">
                            Online Teklif
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div>
                <!-- Contact Box -->
                <div class="bg-blue-600 text-white p-6 rounded-lg mb-6">
                    <h3 class="text-xl font-bold mb-4">İletişim</h3>
                    <div class="space-y-3">
                        <p><i class="fas fa-phone mr-2"></i><?= getSetting('contact_phone') ?></p>
                        <p><i class="fas fa-envelope mr-2"></i><?= getSetting('contact_email') ?></p>
                        <a href="https://wa.me/<?= getSetting('whatsapp_number') ?>" target="_blank" 
                           class="block bg-green-500 text-center py-2 rounded hover:bg-green-600">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                        </a>
                    </div>
                </div>
                
                <!-- Related Districts -->
                <?php if (!empty($relatedDistricts)): ?>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-xl font-bold mb-4">Diğer İlçeler</h3>
                        <ul class="space-y-2">
                            <?php foreach ($relatedDistricts as $relDistrict): ?>
                                <?php if ($relDistrict['id'] != $district['id']): ?>
                                    <li>
                                        <a href="/istanbul/<?= $relDistrict['slug'] ?>" 
                                           class="text-blue-600 hover:text-blue-800 hover:underline">
                                            <?= escape($relDistrict['name']) ?> Nakliyat
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
