<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$iter = new RecursiveIteratorIterator($dir);

$filesUpdated = 0;

foreach ($iter as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        
        // Regex to find href="/some-path" and turn it into href="{{ url('/some-path') }}"
        // It skips ones that already have {{ or are just /
        $new_content = preg_replace('/href="\/([^{" >]+)"/', 'href="{{ url(\'/$1\') }}"', $content);
        
        // Also handle href="/" exactly
        $new_content = preg_replace('/href="\/"/', 'href="{{ url(\'/\') }}"', $new_content);

        if ($content !== $new_content) {
            file_put_contents($path, $new_content);
            echo "Updated $path\n";
            $filesUpdated++;
        }
    }
}

echo "\nDone! Total files dynamically updated: $filesUpdated\n";
