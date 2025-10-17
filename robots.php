<?php
/**
 * Robots.txt Generator
 * Istanbul Moving Company - Custom PHP Script
 */

header('Content-Type: text/plain; charset=utf-8');

echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: /admin/\n";
echo "Disallow: /config/\n";
echo "Disallow: /uploads/\n";
echo "Disallow: /api/\n";
echo "\n";
echo "Sitemap: " . SITE_URL . "/sitemap.xml\n";
?>