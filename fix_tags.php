<?php

$dir = __DIR__ . '/resources/views/admin/page-content/';
$files = ['about', 'home', 'academics', 'people', 'gallery', 'blog', 'nacos', 'contact', 'labs', 'past-hods'];

foreach ($files as $f) {
    $p = $dir . $f . '.blade.php';
    if (!file_exists($p)) continue;
    
    $c = file_get_contents($p);
    
    // There is an extra closing </div> right before </div>{{-- end .apc-main --}}
    // Let's remove it safely.
    // In labs.blade.php, it's:
    // </div>
    //
    // </div>{{-- end .apc-main --}}
    
    // Replace:
    // </div>
    // </div>{{-- end .apc-main --}}
    // with:
    // </div>{{-- end .apc-main --}}
    
    $c = preg_replace('/<\/div>(\s*<\/div>\{\{-- end \.apc-main --\}\})/', '$1', $c);

    file_put_contents($p, $c);
    echo "Fixed $f\n";
}
