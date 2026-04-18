<?php
$file = __DIR__ . '/../resources/views/pages/about-partials/about-department.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" style="padding: 6rem 0; background: #FFFFFF; position: relative;">/' => '<section data-aos="fade-up" class="py-[6rem] bg-white relative">',
    
    '/<div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1\.5rem;">/' => '<div class="section-heading flex items-center gap-4 mb-6">',
    
    '/<div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient\(135deg, rgba\(22, 163, 74, 0\.15\), rgba\(16, 185, 129, 0\.1\)\); color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">/' => '<div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">',
    
    '/<h2 style="margin: 0; font-size: 2\.2rem; color: #0f172a; font-family: var\(--font-heading\); font-weight: 800;">About the Department<\/h2>/' => '<h2 class="m-0 text-[2.2rem] text-slate-900 font-heading font-extrabold">About the Department</h2>',
    
    '/<div style="width: 60px; height: 4px; background: linear-gradient\(90deg, var\(--color-primary\), var\(--color-accent\)\); margin-bottom: 2\.5rem; border-radius: 2px;"><\/div>/' => '<div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-10 rounded-sm"></div>',
    
    '/<div style="font-size: 1\.05rem; line-height: 1\.8; color: #475569;">/' => '<div class="text-[1.05rem] leading-[1.8] text-slate-600">'
];

foreach ($reps as $p => $r) {
    $text = preg_replace($p, $r, $text);
}

file_put_contents($file, $text);

echo "Done about-department PHP scripts";