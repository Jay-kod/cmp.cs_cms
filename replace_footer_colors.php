<?php
$path = 'resources/views/layouts/public.blade.php';
$html = file_get_contents($path);

$parts = explode('<!-- Main Footer -->', $html);

if (count($parts) > 1) {
    $footer = $parts[1];
    
    $footer = str_replace('rgba(13,79,38,0.92)', 'rgba(3, 30, 16, 0.95)', $footer);
    $footer = str_replace('#0D4F26', '#031E10', $footer);
    
    $footer = str_replace('#d1d5db', '#f1f5f9', $footer);
    
    $html = $parts[0] . '<!-- Main Footer -->' . $footer;
    file_put_contents($path, $html);
    echo "Footer colors updated!\n";
} else {
    echo "Footer not found.\n";
}
