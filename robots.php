<?php
/**
 * Robots.txt Generator
 * Istanbul Moving Company - Custom PHP Script
 */

require_once 'config/config.php';

// Set content type to text/plain
header('Content-Type: text/plain; charset=utf-8');

echo "User-agent: *\n";
echo "Allow: /\n";
echo "Disallow: /admin/\n";
echo "Disallow: /config/\n";
echo "Disallow: /models/\n";
echo "Disallow: /views/\n";
echo "Disallow: /uploads/\n";
echo "Disallow: /*.sql\n";
echo "Disallow: /*.log\n";
echo "\n";
echo "Sitemap: " . SITE_URL . "/sitemap.xml\n";
echo "\n";
echo "# Crawl-delay for respectful crawling\n";
echo "Crawl-delay: 1\n";
echo "\n";
echo "# Host directive\n";
echo "Host: " . str_replace(['http://', 'https://'], '', SITE_URL) . "\n";