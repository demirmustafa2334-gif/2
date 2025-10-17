<?php 
ob_start();
$metaTitle = $neighborhood['meta_title'] ?: $neighborhood['name'] . ' Evden Eve Nakliyat';
$metaDescription = $neighborhood['meta_description'] ?: $neighborhood['description'];
$breadcrumbs = [
    ['name' => 'Ana Sayfa', 'url' => '/'],
    ['name' => 'İstanbul', 'url' => '/istanbul'],
    ['name' => $neighborhood['district_name'], 'url' => '/istanbul/' . $neighborhood['district_slug']],
    ['name' => $neighborhood['name'], 'url' => '/istanbul/' . $neighborhood['slug']]
];
?>

<!-- Breadcrumb -->
<div class="bg-gray-100 py-4">
    <div class="container mx-auto px-4">
        <nav class="text-sm">
            <a href="/" class="text-blue-600 hover:text-blue-800">Ana Sayfa</a>
            <span class="mx-2">/</span>
            <a href="/istanbul/<?= $neighborhood['district_slug'] ?>" class="text-blue-600 hover:text-blue-800">
                <?= escape($neighborhood['district_name']) ?>
            </a>
            <span class="mx-2">/</span>
            <span class="text-gray-600"><?= escape($neighborhood['name']) ?></span>
        </nav>
    </div>
</div>

<!-- Main Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <h1 class="text-4xl font-bold mb-6"><?= escape($neighborhood['name']) ?> Evden Eve Nakliyat</h1>
                
                <?php if ($neighborhood['description']): ?>
                    <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-6">
                        <p class="text-gray-700"><?= escape($neighborhood['description']) ?></p>
                    </div>
                <?php endif; ?>
                
                <div class="prose max-w-none mb-8">
                    <?php if ($neighborhood['content']): ?>
                        <?= $neighborhood['content'] ?>
                    <?php else: ?>
                        <p><?= escape($neighborhood['district_name']) ?> <?= escape($neighborhood['name']) ?>'de evden eve nakliyat hizmetleri için profesyonel ekibimizle yanınızdayız. Eşyalarınızı güvenli bir şekilde taşıyoruz.</p>
                        
                        <h2>Hizmet Avantajları</h2>
                        <ul>
                            <li><?= escape($neighborhood['name']) ?>'ye özel nakliyat çözümleri</li>
                            <li>Deneyimli ve profesyonel ekip</li>
                            <li>Sigortalı taşımacılık hizmeti</li>
                            <li>Uygun ve şeffaf fiyatlandırma</li>
                            <li>Hızlı ve güvenilir teslimat</li>
                        </ul>
                    <?php endif; ?>
                </div>
                
                <!-- Other Neighborhoods in Same District -->
                <?php if (!empty($otherNeighborhoods) && count($otherNeighborhoods) > 1): ?>
                    <div class="bg-white p-6 rounded-lg shadow mb-8">
                        <h2 class="text-2xl font-bold mb-4"><?= escape($neighborhood['district_name']) ?> Diğer Semtler</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <?php foreach ($otherNeighborhoods as $otherNeighborhood): ?>
                                <?php if ($otherNeighborhood['id'] != $neighborhood['id']): ?>
                                    <a href="/istanbul/<?= $otherNeighborhood['slug'] ?>" 
                                       class="text-blue-600 hover:text-blue-800 hover:underline">
                                        <i class="fas fa-map-pin mr-2"></i><?= escape($otherNeighborhood['name']) ?>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- CTA -->
                <div class="bg-blue-600 text-white p-8 rounded-lg text-center">
                    <h3 class="text-2xl font-bold mb-4">
                        <?= escape($neighborhood['name']) ?>'den Taşınıyorsunuz?
                    </h3>
                    <p class="mb-6">Ücretsiz fiyat teklifi için hemen bizi arayın!</p>
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
                
                <!-- District Info -->
                <?php if ($district): ?>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-xl font-bold mb-4"><?= escape($district['name']) ?> Hakkında</h3>
                        <p class="text-gray-600 mb-4"><?= escape($district['description']) ?></p>
                        <a href="/istanbul/<?= $district['slug'] ?>" class="text-blue-600 hover:text-blue-800">
                            <?= escape($district['name']) ?> Sayfası <i class="fas fa-arrow-right ml-2"></i>
                        </a>
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
