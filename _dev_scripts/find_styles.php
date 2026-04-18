<?php
$files = [];
$dir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../resources/views/'));
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
$out = '';
foreach($files as $k => $v) {
    $out .= "$v - $k\n";
}
$out .= "Total Files: " . count($files) . "\n";
$out .= "Total Styles: " . array_sum($files) . "\n";
file_put_contents(__DIR__ . '/styles_report.txt', $out);