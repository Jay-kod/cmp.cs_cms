<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/about.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<img src="\{\{ app\(\\\\App\\\\Services\\\\MediaOptimizationService::class\)->webpOrOriginalUrl\(\$gs\(\'hod_photo\'\), 640\) \}\}" alt="\{\{ \$gs\(\'hod_name\', \$hod->name \?\? \'HOD\'\) \}\}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0\.5s;" onmouseover="this\.style\.transform=\'scale\(1\.05\)\'" onmouseout="this\.style\.transform=\'scale\(1\)\'">/' => '<img src="{{ app(\\App\\Services\\MediaOptimizationService::class)->webpOrOriginalUrl($gs(\'hod_photo\'), 640) }}" alt="{{ $gs(\'hod_name\', $hod->name ?? \'HOD\') }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">',
    
    '/<img src="\{\{ app\(\\\\App\\\\Services\\\\MediaOptimizationService::class\)->webpOrOriginalUrl\(\$hod->photo, 640\) \}\}" alt="\{\{ \$hod->name \}\}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0\.5s;" onmouseover="this\.style\.transform=\'scale\(1\.05\)\'" onmouseout="this\.style\.transform=\'scale\(1\)\'">/' => '<img src="{{ app(\\App\\Services\\MediaOptimizationService::class)->webpOrOriginalUrl($hod->photo, 640) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);

echo "Done home-partials about.blade.php images";