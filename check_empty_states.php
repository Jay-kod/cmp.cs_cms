<?php

$adminDir = 'c:/xampp/htdocs/p/dcms/resources/views/admin';
$pages = glob("$adminDir/*/index.blade.php");

foreach ($pages as $page) {
    if (strpos($page, 'settings') !== false || strpos($page, 'backup') !== false || strpos($page, 'analytics') !== false) {
        continue;
    }
    
    $content = file_get_contents($page);
    
    // Check if it has a table but no empty state
    $hasTable = strpos($content, '<table') !== false;
    $hasEmpty = (strpos($content, '@empty') !== false) || (strpos($content, '@else') !== false && strpos($content, '@if($') !== false);
    
    if ($hasTable && !$hasEmpty) {
        echo "Missing empty state: " . str_replace($adminDir . '/', '', $page) . "\n";
    }
}
