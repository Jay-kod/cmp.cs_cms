<?php
$files = glob("resources/views/pages/home-partials/*.blade.php");

foreach($files as $file) {
    if (strpos($file, "hero.blade.php") !== false) continue;
    
    $content = file_get_contents($file);
    $content = preg_replace_callback("/class=[\"\']([^\"\']*\bcontainer\b[^\"\']*)[\"\']/i", function($matches) {
        $classes = $matches[1];
        // remove px-4, px-6, mx-auto, etc. Container already defines them in TW config.
        $classes = preg_replace("/\bpx-\d+\b/i", "", $classes);
        $classes = preg_replace("/\bmx-auto\b/i", "", $classes);
        // reduce extra spaces
        $classes = preg_replace("/\s+/", " ", $classes);
        $classes = trim($classes);
        return "class=\"$classes\"";
    }, $content);
    
    file_put_contents($file, $content);
    echo "Processed $file\n";
}
echo "Done.\n";
