<?php
$iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views/pages/'));
foreach ($iter as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $content = file_get_contents($file->getPathname());
        if (str_contains($content, '<section') && str_contains($content, 'reveal reveal-up" style="text-align: center')) {
            echo $file->getPathname() . "\n";
            file_put_contents('corrupt.txt', $file->getPathname() . "\n", FILE_APPEND);
        }
    }
}
