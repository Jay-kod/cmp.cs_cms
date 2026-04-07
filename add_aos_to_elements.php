<?php
function addAosToElements($dir) {
    if (!is_dir($dir)) return;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && strpos($file->getFilename(), '.blade.php') !== false) {
            $content = file_get_contents($file->getPathname());
            $original = $content;

            // Match all class="..." attributes
            $content = preg_replace_callback('/<div([^>]*class="[^"]*(?:card|item|box|block)[^"]*"[^>]*)>/i', function($m) {
                $div = $m[0];
                // if it already has data-aos, ignore
                if (strpos($div, 'data-aos') !== false) return $div;
                // if it is a nav, ignore
                if (strpos($div, 'nav') !== false || strpos($div, 'menu') !== false || strpos($div, 'header') !== false) return $div;
                
                // Add data-aos="fade-up"
                return str_replace('<div', '<div data-aos="fade-up"', $div);
            }, $content);

            // Do the same for <a> wrappers that act as cards
            $content = preg_replace_callback('/<a([^>]*class="[^"]*(?:card|item|box|block)[^"]*"[^>]*)>/i', function($m) {
                $div = $m[0];
                if (strpos($div, 'data-aos') !== false) return $div;
                if (strpos($div, 'nav') !== false || strpos($div, 'menu') !== false || strpos($div, 'btn') !== false || strpos($div, 'button') !== false) return $div;
                return str_replace('<a', '<a data-aos="fade-up"', $div);
            }, $content);
            
            // And article tags
            $content = preg_replace_callback('/<article([^>]*)>/i', function($m) {
                $div = $m[0];
                if (strpos($div, 'data-aos') !== false) return $div;
                return str_replace('<article', '<article data-aos="fade-up"', $div);
            }, $content);

            if ($content !== $original) {
                file_put_contents($file->getPathname(), $content);
                echo "Added element AOS to: " . $file->getPathname() . "\n";
            }
        }
    }
}

addAosToElements(__DIR__ . '/resources/views/');
echo "Done!\n";
