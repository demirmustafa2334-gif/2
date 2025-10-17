<?php
require dirname(__DIR__) . '/core/Autoloader.php';
Core\Autoloader::register();

use Core\Database;

$pdo = Database::getConnection();
$dir = dirname(__DIR__) . '/database/seeds';
$files = glob($dir . '/*.sql');
sort($files);
foreach ($files as $file) {
    $sql = file_get_contents($file);
    echo "Running seed: $file\n";
    $pdo->exec($sql);
}
echo "Seeding completed.\n";
