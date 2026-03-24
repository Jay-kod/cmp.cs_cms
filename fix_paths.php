<?php

$dir = new RecursiveDirectoryIterator('resources/views');
$iter = new RecursiveIteratorIterator($dir);
$count = 0;

foreach ($iter as $file) {
    if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        
        $new_content = preg_replace_callback('/href\s*=\s*(["\'])(\/[^"\']*)\1/', function($matches) {
            $quote = $matches[1];
            $full_path = $matches[2];
            // Don't wrap if it's somehow already wrapped like href="/{{ ... }}"
            if (str_starts_with($full_path, '/{{') && str_ends_with($full_path, '}}')) {
                return $matches[0]; 
            }
            return 'href=' . $quote . '{{ url(\'' . $full_path . '\') }}' . $quote;
        }, $content);

        if ($content !== $new_content) {
            file_put_contents($path, $new_content);
            echo "Updated $path\n";
            $count++;
        }
    }
}

echo "Total updated: $count\n";