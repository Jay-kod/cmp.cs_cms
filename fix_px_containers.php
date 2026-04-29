<?php
$files = glob("resources/views/pages/home-partials/*.blade.php");

foreach($files as $file) {
    if (strpos($file, "hero.blade.php") !== false || strpos($file, "cta.blade.php") !== false) continue;
    
    $content = file_get_contents($file);
    // Find containers and ensure they have px-4 unless they already have padding
    $content = preg_replace_callback("/class=[\"\']([^\"\']*\bcontainer\b[^\"\']*)[\"\']/i", function($matches) {
        $classStr = $matches[1];
        if (!preg_match("/\bpx-[0-9]+\b/i", $classStr)) {
            $classStr .= " px-4";
        }
        return "class=\"$classStr\"";
    }, $content);
    
    file_put_contents($file, $content);
    echo "Processed $file\n";
}
echo "Done.\n";
