<?php
$file = __DIR__ . '/../resources/views/pages/nacos-presidents.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div class="absolute inset-0" style="background: url\(\'data:image\/svg\+xml,<svg xmlns=%22http:\/\/www\.w3\.org\/2000\/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220\.5%22 fill=%22rgba\(255,255,255,0\.03\)%22\/><\/svg>\'\);"><\/div>/' => '<div class="absolute inset-0 bg-[url(\'data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.5%22_fill=%22rgba(255,255,255,0.03)%22/></svg>\')]"></div>',

    '/<div class="absolute inset-0 pointer-events-none" style="background: url\(\'data:image\/svg\+xml,<svg xmlns=%22http:\/\/www\.w3\.org\/2000\/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220\.6%22 fill=%22rgba\(255,255,255,0\.04\)%22\/><\/svg>\'\);"><\/div>/' => '<div class="absolute inset-0 pointer-events-none bg-[url(\'data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.6%22_fill=%22rgba(255,255,255,0.04)%22/></svg>\')]"></div>',
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done nacos-presidents styles.\n";