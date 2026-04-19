<?php
$file = __DIR__ . '/../resources/views/pages/resources.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div style="text-align: center; padding: 6rem 2rem; background: #f8fafc; border-radius: 24px; border: 1px dashed #cbd5e1; max-width: 800px; margin: 0 auto;">/' 
    => '<div class="text-center py-24 px-8 bg-slate-50 rounded-3xl border border-dashed border-slate-300 max-w-[800px] mx-auto">',

    '/<div style="width: 100px; height: 100px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1\.5rem; font-size: 3rem; color: #cbd5e1; box-shadow: 0 10px 30px rgba\(0,0,0,0\.04\);">/' 
    => '<div class="w-[100px] h-[100px] bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-[3rem] text-slate-300 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">',

    '/<h3 style="color: #0f172a; font-size: 1\.8rem; font-weight: 900; margin-bottom: 0\.8rem;">/' 
    => '<h3 class="text-slate-900 text-[1.8rem] font-black mb-3">',

    '/<p style="color: #64748b; margin: 0; font-size: 1\.15rem;">/' 
    => '<p class="text-slate-500 m-0 text-[1.15rem]">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done resources.blade.php pt2" . PHP_EOL;