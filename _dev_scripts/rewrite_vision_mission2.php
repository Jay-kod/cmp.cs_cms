<?php
$file = __DIR__ . '/../resources/views/pages/about-partials/vision-mission.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div style="display: inline-flex; align-items: center; gap: 1\.2rem; background: white; padding: 1rem 1\.5rem; border-radius: 12px; border: 1px solid #e2e8f0;">/'
    => '<div class="inline-flex items-center gap-5 bg-white py-4 px-6 rounded-xl border border-slate-200">',

    '/<div style="width: 4px; height: 35px; background: linear-gradient\(to bottom, var\(--color-primary\), var\(--color-secondary\)\); border-radius: 2px;"><\/div>/'
    => '<div class="w-1 h-[35px] bg-gradient-to-b from-primary to-secondary rounded-sm"></div>',

    '/<h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1\.1rem; font-family: var\(--font-heading\);">/'
    => '<h4 class="m-0 font-extrabold text-slate-900 text-[1.1rem] font-heading">',

    '/<p style="margin: 0; color: #64748b; font-size: 0\.9rem; font-weight: 500;">/'
    => '<p class="m-0 text-slate-500 text-[0.9rem] font-medium">',

    '/<div class="container" data-aos="fade-up" style="margin-top: 4rem; padding-bottom: 4rem;">/'
    => '<div class="container mt-16 pb-16" data-aos="fade-up">',

    '/<div class="stats-grid" style="display: grid; grid-template-columns: repeat\(5, 1fr\); gap: 1\.2rem; text-align: center;">/'
    => '<div class="stats-grid grid grid-cols-[repeat(5,1fr)] gap-5 text-center">',
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done vision-mission pt2\n";
