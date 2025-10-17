<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi - <?= getSetting('site_name', 'İstanbul Nakliyat') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Admin Girişi</h2>
            
            <?php if ($error = Session::flash('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= escape($error) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Kullanıcı Adı</label>
                    <input type="text" name="username" required 
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Şifre</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-2 border rounded focus:outline-none focus:border-blue-500">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Giriş Yap
                </button>
            </form>
            
            <p class="text-sm text-gray-600 mt-4 text-center">
                Varsayılan: admin / admin123
            </p>
        </div>
    </div>
</body>
</html>
