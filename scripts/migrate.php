<?php
require dirname(__DIR__) . '/core/Autoloader.php';
Core\Autoloader::register();

use Core\Database;

$pdo = Database::getConnection();
$dir = dirname(__DIR__) . '/database/migrations';
$files = glob($dir . '/*.sql');
sort($files);
foreach ($files as $file) {
    $sql = file_get_contents($file);
    echo "Running migration: $file\n";
    $pdo->exec($sql);
}
echo "Migrations completed.\n";
