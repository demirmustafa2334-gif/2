<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Admin Panel' ?> - <?= getSetting('site_name', 'İstanbul Nakliyat') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>
            <nav class="mt-6">
                <a href="/admin/dashboard" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="/admin/districts" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-map-marked-alt mr-2"></i> İlçeler
                </a>
                <a href="/admin/neighborhoods" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-map-pin mr-2"></i> Semtler
                </a>
                <a href="/admin/prices" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-dollar-sign mr-2"></i> Fiyatlar
                </a>
                <a href="/admin/reviews" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-star mr-2"></i> Yorumlar
                </a>
                <a href="/admin/blog" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-blog mr-2"></i> Blog
                </a>
                <a href="/admin/pages" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-file-alt mr-2"></i> Sayfalar
                </a>
                <a href="/admin/settings" class="block px-4 py-2 hover:bg-gray-700">
                    <i class="fas fa-cog mr-2"></i> Ayarlar
                </a>
                <a href="/admin/logout" class="block px-4 py-2 hover:bg-gray-700 text-red-400">
                    <i class="fas fa-sign-out-alt mr-2"></i> Çıkış
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <?php if ($success = Session::flash('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= escape($success) ?>
                </div>
            <?php endif; ?>

            <?php if ($error = Session::flash('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= escape($error) ?>
                </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </main>
    </div>

    <script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
