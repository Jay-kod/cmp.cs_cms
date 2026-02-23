<?php
$adminDir = 'c:/xampp/htdocs/p/dcms/resources/views/admin';
$pages = glob("$adminDir/*/index.blade.php");

foreach ($pages as $page) {
    if (strpos($page, 'settings') !== false || strpos($page, 'backup') !== false || strpos($page, 'analytics') !== false) {
        continue;
    }
    
    $content = file_get_contents($page);
    $hasEmptyStateClass = strpos($content, 'empty-state') !== false;
    
    if (!$hasEmptyStateClass) {
        echo "No 'empty-state' class: " . str_replace($adminDir . '/', '', $page) . "\n";
    }
}
