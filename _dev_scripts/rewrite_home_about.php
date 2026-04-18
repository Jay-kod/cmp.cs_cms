<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/about.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" class="hod-section" style="padding: 5rem 0; background: #FFFFFF; position: relative; overflow: hidden;">/' => '<section data-aos="fade-up" class="hod-section py-20 bg-white relative overflow-hidden">',
    
    '/<div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px; background: radial-gradient\(circle, rgba\(22,163,74,0\.08\) 0%, transparent 70%\); pointer-events: none;"><\/div>/' => '<div class="absolute -top-[100px] -right-[50px] w-[300px] h-[300px] bg-[radial-gradient(circle,rgba(22,163,74,0.08)_0%,transparent_70%)] pointer-events-none"></div>',
    
    '/<div style="position: absolute; bottom: -50px; left: 10%; width: 250px; height: 250px; background: radial-gradient\(circle, rgba\(22,163,74,0\.06\) 0%, transparent 70%\); pointer-events: none;"><\/div>/' => '<div class="absolute -bottom-[50px] left-[10%] w-[250px] h-[250px] bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)] pointer-events-none"></div>',
    
    '/<div class="container hod-grid" style="display: flex; gap: 5rem; align-items: center; flex-wrap: wrap; position: relative; z-index: 2;">/' => '<div class="container hod-grid flex gap-20 items-center flex-wrap relative z-[2]">',
    
    '/<div class="hod-photo  -left" style="flex: 0 0 300px; max-width: 100%; position: relative;">/' => '<div class="hod-photo flex-[0_0_300px] max-w-full relative">',
    
    '/<div style="position: absolute; inset: -12px -12px 12px 12px; border: 2px solid var\(--color-primary\); border-radius: 14px; z-index: 1;"><\/div>/' => '<div class="absolute -inset-[12px] top-[-12px] -right-[12px] bottom-[12px] left-[12px] border-2 border-[color:var(--color-primary)] rounded-[14px] z-1"></div>', // adjusted
    
    '/<div style="position: absolute; inset: 12px 12px -12px -12px; background: rgba\(22,163,74,0\.1\); border-radius: 14px; z-index: 1;"><\/div>/' => '<div class="absolute top-[12px] right-[12px] -bottom-[12px] -left-[12px] bg-green-600/10 rounded-[14px] z-1"></div>',
    
    '/<div style="position: relative; z-index: 2; aspect-ratio: 3\/4; border-radius: 14px; overflow: hidden; box-shadow: 0 20px 40px -12px rgba\(0,0,0,0\.15\); border: 6px solid white;">/' => '<div class="relative z-[2] aspect-[3/4] rounded-[14px] overflow-hidden shadow-[0_20px_40px_-12px_rgba(0,0,0,0.15)] border-4 border-white">',
    
    '/<img src="\{\{ app\\\(\\\\App\\\\Services\\\\MediaOptimizationService::class\)->webpOrOriginalUrl\(\$gs\(\'hod_photo\'\), 640\) \}\}" alt="\{\{ \$gs\(\'hod_name\', \$hod->name \?\? \'HOD\'\) \}\}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0\.5s;" onmouseover="this\.style\.transform=\'scale\(1\.05\)\'" onmouseout="this\.style\.transform=\'scale\(1\)\'">/' => '<img src="{{ app(\\App\\Services\\MediaOptimizationService::class)->webpOrOriginalUrl($gs(\'hod_photo\'), 640) }}" alt="{{ $gs(\'hod_name\', $hod->name ?? \'HOD\') }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">',
    
    '/<img src="\{\{ app\\\(\\\\App\\\\Services\\\\MediaOptimizationService::class\)->webpOrOriginalUrl\(\$hod->photo, 640\) \}\}" alt="\{\{ \$hod->name \}\}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0\.5s;" onmouseover="this\.style\.transform=\'scale\(1\.05\)\'" onmouseout="this\.style\.transform=\'scale\(1\)\'">/' => '<img src="{{ app(\\App\\Services\\MediaOptimizationService::class)->webpOrOriginalUrl($hod->photo, 640) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">',
    
    '/<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: linear-gradient\(135deg, var\(--color-primary\), var\(--color-secondary\)\); color:white; font-size:6rem;"><i class="fa-solid fa-user-tie"><\/i><\/div>/' => '<div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[color:var(--color-primary)] to-[color:var(--color-secondary)] text-white text-[6rem]"><i class="fa-solid fa-user-tie"></i></div>',
    
    '/<div style="position: absolute; bottom: 20px; right: -20px; background: white; padding: 1rem 1\.5rem; border-radius: 12px; box-shadow: 0 10px 30px rgba\(0,0,0,0\.1\); display: flex; align-items: center; gap: 1rem;">/' => '<div class="absolute bottom-5 -right-5 bg-white py-4 px-6 rounded-xl shadow-[0_10px_30px_rgba(0,0,0,0.1)] flex items-center gap-4">',
    
    '/<div style="width: 40px; height: 40px; background: rgba\(22,163,74,0\.12\); color: var\(--color-primary\); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1\.2rem;">/' => '<div class="w-10 h-10 bg-green-600/[0.12] text-[color:var(--color-primary)] rounded-full flex items-center justify-center text-[1.2rem]">',
    
    '/<p style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1\.1rem; font-family: var\(--font-heading\); line-height: 1;">/' => '<p class="m-0 font-extrabold text-slate-900 text-[1.1rem] font-heading leading-none">',
    
    '/<p style="margin: 0; font-size: 0\.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 0\.2rem;">/' => '<p class="m-0 mt-1 text-[0.75rem] text-slate-500 uppercase tracking-[1px]">',
    
    '/<div class="hod-text  -right" style="flex: 1; min-width: 320px;">/' => '<div class="hod-text flex-1 min-w-[320px]">',
    
    '/<span style="display: inline-block; color: var\(--color-primary\); font-size: 0\.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; margin-bottom: 1rem; background: rgba\(22,163,74,0\.1\); padding: 0\.3rem 1rem; border-radius: 20px;">/' => '<span class="inline-block text-[color:var(--color-primary)] text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-4 bg-green-600/10 py-1 px-4 rounded-full">',
    
    '/<h2 style="font-size: 2\.8rem; margin-bottom: 1\.5rem; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a; line-height: 1\.15;">/' => '<h2 class="text-[2.8rem] mb-6 font-heading font-extrabold text-slate-900 leading-[1.15]">',
    
    '/<div style="position: relative; padding-left: 2rem; margin-bottom: 2\.5rem;">/' => '<div class="relative pl-8 mb-10">',
    
    '/<i class="fa-solid fa-quote-left" style="position: absolute; top: -10px; left: -10px; font-size: 3\.5rem; color: rgba\(22,163,74,0\.1\); z-index: 0;"><\/i>/' => '<i class="fa-solid fa-quote-left absolute -top-2.5 -left-2.5 text-[3.5rem] text-green-600/10 z-0"></i>',
    
    '/<blockquote style="position: relative; z-index: 1; font-size: 1\.15rem; color: #475569; line-height: 1\.8; margin: 0; font-style: italic; text-align: justify;">/' => '<blockquote class="relative z-1 text-[1.15rem] text-slate-600 leading-[1.8] m-0 italic text-justify">',
    
    '/<div style="display: inline-flex; align-items: center; gap: 1\.2rem; background: white; padding: 1rem 1\.5rem; border-radius: 12px; border: 1px solid #e2e8f0;">/' => '<div class="inline-flex items-center gap-5 bg-white py-4 px-6 rounded-xl border border-slate-200">',
    
    '/<div style="width: 4px; height: 35px; background: linear-gradient\(to bottom, var\(--color-primary\), var\(--color-secondary\)\); border-radius: 2px;"><\/div>/' => '<div class="w-1 h-[35px] bg-gradient-to-b from-[color:var(--color-primary)] to-[color:var(--color-secondary)] rounded-sm"></div>',
    
    '/<h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1\.1rem; font-family: var\(--font-heading\);">/' => '<h4 class="m-0 font-extrabold text-slate-900 text-[1.1rem] font-heading">',
    
    '/<p style="margin: 0; color: #64748b; font-size: 0\.9rem; font-weight: 500;">/' => '<p class="m-0 text-slate-500 text-[0.9rem] font-medium">'
];

foreach ($reps as $p => $r) {
    $text = preg_replace($p, $r, $text);
}

file_put_contents($file, $text);

echo "Done home-partials about.blade.php PHP scripts";