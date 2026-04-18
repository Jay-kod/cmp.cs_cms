<?php
$files = [];
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../resources/views/pages/'));
foreach ($dir as $f) {
    if($f->isFile() && str_ends_with($f->getFilename(), '.blade.php')) {
        $content = file_get_contents($f->getPathname());
        $count = preg_match_all('/style=[\"\']/', $content, $matches);
        if($count > 0) {
            $files[str_replace(__DIR__ . '/../', '', $f->getPathname())] = $count;
        }
    }
}
arsort($files);
foreach($files as $k => $v) {
    echo "$v - $k\n";
}
echo "Total Files: " . count($files) . "\n";
echo "Total Styles: " . array_sum($files) . "\n";