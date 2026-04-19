<?php
$file = __DIR__ . '/../resources/views/pages/resources.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" class="bg-\[url\(\'\{\{ asset\(\'images\/pattern-grid\.svg\'\) \}\}\'\)\] bg-center bg-cover pt-24 pb-28 text-white text-center relative overflow-hidden border-b-4 border-\[color:var\(--color-accent\)\]" style="background-image: url\(\'\{\{ asset\(\'images\/pattern-grid\.svg\'\) \}\}\'\), linear-gradient\(135deg, #0f172a 0%, #064e3b 100%\);">/'
    => '<section data-aos="fade-up" class="bg-[url(\'{{ asset(\'images/pattern-grid.svg\') }}\'),linear-gradient(135deg,#0f172a_0%,#064e3b_100%)] bg-center bg-cover pt-24 pb-28 text-white text-center relative overflow-hidden border-b-4 border-accent">',

    '/<div class="absolute inset-0 pointer-events-none" style="background: radial-gradient\(circle at center, rgba\(16, 185, 129, 0\.15\) 0%, transparent 60%\);"><\/div>/'
    => '<div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.15)_0%,transparent_60%)]"></div>',
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done resources pt2\n";
