<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../resources/views'));

foreach ($files as $f) {
    if ($f->isFile() && $f->getExtension() == 'php') {
        $c = file_get_contents($f);
        
        $nc = preg_replace(
            '/\\\\App\\\\Models\\\\DepartmentSetting::where\(\'(key|group)\',\s*([$a-zA-Z0-9_\'\-]+)\)->value\(\'value\'\)/s',
            '\App\Models\DepartmentSetting::getCached($2)',
            $c
        );
        $nc = preg_replace(
            '/\\\\App\\\\Models\\\\DepartmentSetting::where\(\'(key|group)\',\s*([$a-zA-Z0-9_\'\-]+)\)->first\(\)/s',
            '(object)[\'value\' => \App\Models\DepartmentSetting::getCached($2)]',
            $nc
        );
        
        if ($c !== $nc) {
            file_put_contents($f, $nc);
            echo "Updated " . $f->getPathname() . "\n";
        }
    }
}
