<?php
function addAosToDirectory($dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && strpos($file->getFilename(), '.blade.php') !== false) {
            $content = file_get_contents($file->getPathname());
            $original = $content;

            // First, remove old 'reveal', 'reveal-up' classes as they are obsolete
            $content = preg_replace('/\s+reveal-up/', '', $content);
            $content = preg_replace('/\breveal\b/', '', $content);
            
            // Fix spaces inside class attributes created by removal
            $content = preg_replace('/class="\s+/', 'class="', $content);
            $content = preg_replace('/class="([^"]*?)\s+"/', 'class="$1"', $content);

            // Add basic data-aos="fade-up" to main structural tags if not already there
            $content = preg_replace('/<section(?![^>]*data-aos)/i', '<section data-aos="fade-up"', $content);
            
            // Add fade-up to typical structural divs 
            $content = preg_replace('/<div class="container"(?![^>]*data-aos)/i', '<div class="container" data-aos="fade-up"', $content);

            if ($content !== $original) {
                file_put_contents($file->getPathname(), $content);
                echo "Added AOS to: " . $file->getPathname() . "\n";
            }
        }
    }
}

addAosToDirectory(__DIR__ . '/resources/views/');
echo "Done!\n";
