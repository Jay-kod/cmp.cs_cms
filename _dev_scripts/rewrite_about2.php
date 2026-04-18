<?php
$file = __DIR__ . '/../resources/views/pages/about.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div style="width: 52px; height: 52px; background: linear-gradient\(135deg, #16a34a, #15803d\); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.4rem; box-shadow: 0 8px 20px -4px rgba\(22, 163, 74, 0\.4\);">/' => '<div class="w-[52px] h-[52px] bg-gradient-to-br from-green-600 to-green-700 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] shadow-[0_8px_20px_-4px_rgba(22,163,74,0.4)]">',
     
    '/<div class="about-board-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(260px, 1fr\)\); gap: 1\.2rem;">/' => '<div class="about-board-grid grid grid-cols-[repeat(auto-fit,minmax(260px,1fr))] gap-5">',
     
    '/<div style="background: linear-gradient\(135deg, #064e3b 0%, #065f46 100%\); border-radius: 14px; padding: 2rem; color: white; text-align: center; position: relative; overflow: hidden;">/' => '<div class="bg-gradient-to-br from-emerald-900 to-emerald-800 rounded-[14px] p-8 text-white text-center relative overflow-hidden">',
     
    '/<div style="position: absolute; inset: 0; background: radial-gradient\(circle at 50% 0%, rgba\(16,185,129,0\.2\), transparent 70%\); pointer-events: none;"><\/div>/' => '<div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(16,185,129,0.2),transparent_70%)] pointer-events-none"></div>',
     
    '/<div style="position: relative; z-index: 2;">/' => '<div class="relative z-[2]">',
     
    '/<div style="width: 64px; height: 64px; background: rgba\(255,255,255,0\.1\); border: 2px solid rgba\(255,255,255,0\.2\); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1\.2rem; font-size: 1\.8rem; color: #a7f3d0;">/' => '<div class="w-16 h-16 bg-white/10 border-2 border-white/20 rounded-full flex items-center justify-center mx-auto mb-5 text-[1.8rem] text-emerald-200">',
     
    '/<h4 style="margin: 0 0 0\.3rem; font-size: 1\.15rem; font-weight: 700;">/' => '<h4 class="m-0 mb-1 text-[1.15rem] font-bold">',
     
    '/<p style="margin: 0; color: #6ee7b7; font-size: 0\.9rem;">/' => '<p class="m-0 text-emerald-300 text-[0.9rem]">',
     
    '/<div style="background: linear-gradient\(135deg, #f0fdf4, #ecfdf5\); border-radius: 14px; padding: 2rem; text-align: center; border: 1px solid #bbf7d0;">/' => '<div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-[14px] p-8 text-center border border-green-200">',
     
    '/<div style="width: 64px; height: 64px; background: rgba\(22,163,74,0\.1\); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1\.2rem; font-size: 1\.8rem; color: var\(--color-primary\);">/' => '<div class="w-16 h-16 bg-green-600/10 rounded-full flex items-center justify-center mx-auto mb-5 text-[1.8rem] text-[color:var(--color-primary)]">',
     
    '/<h4 style="margin: 0 0 0\.3rem; font-size: 1\.15rem; color: #1e293b; font-weight: 700;">/' => '<h4 class="m-0 mb-1 text-[1.15rem] text-slate-800 font-bold">',
     
    '/<p style="margin: 0; color: #64748b; font-size: 0\.9rem;">/' => '<p class="m-0 text-slate-500 text-[0.9rem]">',
     
    '/<div class="about-req-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(180px, 1fr\)\); gap: 1rem;">/' => '<div class="about-req-grid grid grid-cols-[repeat(auto-fit,minmax(180px,1fr))] gap-4">',
];

foreach ($reps as $p => $r) {
    $text = preg_replace($p, $r, $text);
}

file_put_contents($file, $text);

echo "Done part 2 scripts PHP";

