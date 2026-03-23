<?php

function animateSection($path) {
    echo "Scanning dir: $path\n";
    foreach (glob($path . '/*.blade.php') as $file) {
        $content = file_get_contents($file);
        
        // Find main wrapper tags and inject reveal reveal-up if not already there
        // Look for common <section class=".*"> or <div class="container">
        
        $count = 0;
        $content = preg_replace('/<div class="container"(?!.*reveal)/i', '<div class="container reveal reveal-up"', $content, -1, $count);
        $content = preg_replace('/<div class="container([^"]*)"/i', '<div class="container"', $content);

        // If something was replaced, save it back
        if ($count > 0) {
            file_put_contents($file, $content);
            echo "Updated $file\n";
        }
    }
}

animateSection(__DIR__ . '/resources/views/pages/about-partials');
animateSection(__DIR__ . '/resources/views/pages/academics-partials');
