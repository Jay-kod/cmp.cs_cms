<?php
$file = __DIR__ . '/../resources/views/pages/about.blade.php';
$text = file_get_contents($file);

$reps = [
    // Req Card
    '/<div style="padding: 1\.5rem; background: \{\{ \$req\[\'bg\'\] \?\? \'#f0fdf4\' \}\}; border-radius: 12px; text-align: center; border: 1px solid \{\{ \$req\[\'color\'\] \?\? \'#16a34a\' \}\}15; transition: transform 0\.3s;" onmouseover="this\.style\.transform=\'translateY\(-4px\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'">/' => '<div class="p-6 bg-[{{ $req[\'bg\'] ?? \'#f0fdf4\' }}] rounded-xl text-center border border-[{{ $req[\'color\'] ?? \'#16a34a\' }}15] transition-transform duration-300 hover:-translate-y-1">',
    
    '/<div style="width: 44px; height: 44px; background: \{\{ \$req\[\'color\'\] \?\? \'#16a34a\' \}\}; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.2rem; margin: 0 auto 1rem; box-shadow: 0 6px 15px -3px \{\{ \$req\[\'color\'\] \?\? \'#16a34a\' \}\}40;">/' => '<div class="w-11 h-11 bg-[{{ $req[\'color\'] ?? \'#16a34a\' }}] text-white rounded-xl flex items-center justify-center text-[1.2rem] mx-auto mb-4 shadow-[0_6px_15px_-3px_{{ $req[\'color\'] ?? \'#16a34a\' }}40]">',
    
    '/<h4 style="margin: 0 0 0\.4rem; font-size: 1rem; color: #1e293b; font-weight: 700;">/' => '<h4 class="m-0 mb-1.5 text-[1rem] text-slate-800 font-bold">',
    
    '/<p style="margin: 0; font-size: 0\.8rem; color: #64748b; line-height: 1\.5;">/' => '<p class="m-0 text-[0.8rem] text-slate-500 leading-[1.5]">',
    
    '/<div style="text-align: center; margin-top: 1\.5rem;">/' => '<div class="text-center mt-6">',
    
    '/<a href="\{\{ \$gs\(\'about_req_btn_url\', \'\/academics\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.6rem; font-size: 0\.9rem; color: var\(--color-primary\); font-weight: 600; text-decoration: none; padding: 0\.6rem 1\.5rem; border: 2px solid var\(--color-primary\); border-radius: 10px; transition: all 0\.3s;" onmouseover="this\.style\.background=\'var\(--color-primary\)\'; this\.style\.color=\'white\'" onmouseout="this\.style\.background=\'transparent\'; this\.style\.color=\'var\(--color-primary\)\'">' => '<a href="{{ $gs(\'about_req_btn_url\', \'/academics\') }}" class="inline-flex items-center gap-2.5 text-[0.9rem] text-[color:var(--color-primary)] font-semibold no-underline py-[0.6rem] px-6 border-2 border-[color:var(--color-primary)] rounded-[10px] transition-all duration-300 hover:bg-[color:var(--color-primary)] hover:text-white">',
    
    '/<div class="about-facilities-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(300px, 1fr\)\); gap: 1\.2rem;">/' => '<div class="about-facilities-grid grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-5">',
    
    '/<div data-aos="fade-up" class="about-facilities-card" style="display: flex; gap: 1\.2rem; background: #f8fafc; padding: 1\.8rem; border-radius: 14px; border: 1px solid #e2e8f0; transition: all 0\.3s;" onmouseover="this\.style\.background=\'#f1f5f9\'; this\.style\.transform=\'translateY\(-3px\)\'; this\.style\.boxShadow=\'0 10px 25px -8px rgba\(0,0,0,0\.08\)\'" onmouseout="this\.style\.background=\'#f8fafc\'; this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'">/' => '<div data-aos="fade-up" class="about-facilities-card flex gap-5 bg-slate-50 p-7 rounded-[14px] border border-slate-200 transition-all duration-300 hover:bg-slate-100 hover:-translate-y-[3px] hover:shadow-[0_10px_25px_-8px_rgba(0,0,0,0.08)]">',
    
    '/<div style="width: 56px; height: 56px; border-radius: 14px; background: \{\{ \$labColors\[\$i % count\(\$labColors\)\] \}\}; color: white; display: flex; align-items: center; justify-content: center; font-size: 1\.6rem; flex-shrink: 0; box-shadow: 0 8px 20px -4px \{\{ \$labShadows\[\$i % count\(\$labShadows\)\] \}\};">/' => '<div class="w-14 h-14 rounded-[14px] bg-[{{ $labColors[$i % count($labColors)] }}] text-white flex items-center justify-center text-[1.6rem] shrink-0 shadow-[0_8px_20px_-4px_{{ $labShadows[$i % count($labShadows)] }}]">',
    
    '/<strong style="font-size: 1\.1rem; display: block; margin-bottom: 0\.4rem; color: #1e293b; font-family: var\(--font-heading\);">/' => '<strong class="text-[1.1rem] block mb-1.5 text-slate-800 font-heading">',
    
    '/<p style="margin: 0; color: #64748b; line-height: 1\.6; font-size: 0\.92rem;">/' => '<p class="m-0 text-slate-500 leading-[1.6] text-[0.92rem]">',
    
    // CTA Section
    '/<div class="about-faculty-cta" style="background: linear-gradient\(135deg, var\(--color-primary\) 0%, #047857 50%, #0f766e 100%\); border-radius: 16px; padding: 3\.5rem; color: white; text-align: center; position: relative; overflow: hidden; box-shadow: 0 15px 30px -8px rgba\(22, 163, 74, 0\.4\);">/' => '<div class="about-faculty-cta bg-gradient-to-br from-[color:var(--color-primary)] via-emerald-700 to-teal-800 rounded-2xl p-14 text-white text-center relative overflow-hidden shadow-[0_15px_30px_-8px_rgba(22,163,74,0.4)]">',
    
    '/<div style="position: absolute; top: -60px; right: -60px; width: 250px; height: 250px; background: rgba\(255,255,255,0\.06\); border-radius: 50%;"><\/div>/' => '<div class="absolute -top-[60px] -right-[60px] w-[250px] h-[250px] bg-white/[0.06] rounded-full"></div>',
    
    '/<div style="position: absolute; bottom: -80px; left: -40px; width: 200px; height: 200px; background: rgba\(255,255,255,0\.04\); border-radius: 50%;"><\/div>/' => '<div class="absolute -bottom-[80px] -left-10 w-[200px] h-[200px] bg-white/[0.04] rounded-full"></div>',
    
    '/<div style="position: absolute; top: 50%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba\(255,255,255,0\.08\); border-radius: 50%; transform: translateY\(-50%\);"><\/div>/' => '<div class="absolute top-1/2 left-[10%] w-[120px] h-[120px] border border-white/[0.08] rounded-full -translate-y-1/2"></div>',
    
    '/<div style="position: relative; z-index: 10;">/' => '<div class="relative z-10">',
    
    '/<div style="display: inline-flex; align-items: center; gap: 0\.5rem; padding: 0\.35rem 1rem; background: rgba\(255,255,255,0\.1\); color: #a7f3d0; border-radius: 20px; font-size: 0\.75rem; font-weight: 600; letter-spacing: 1\.5px; text-transform: uppercase; margin-bottom: 1\.2rem; border: 1px solid rgba\(255,255,255,0\.15\);">/' => '<div class="inline-flex items-center gap-2 py-[0.35rem] px-4 bg-white/10 text-emerald-200 rounded-full text-[0.75rem] font-semibold tracking-[1.5px] uppercase mb-5 border border-white/[0.15]">',
    
    '/<i class="fa-solid fa-users" style="font-size: 0\.65rem;"><\/i>/' => '<i class="fa-solid fa-users text-[0.65rem]"></i>',
    
    '/<h2 style="margin: 0 0 1rem 0; font-size: 2\.2rem; font-family: var\(--font-heading\); font-weight: 800;">/' => '<h2 class="m-0 mb-4 text-[2.2rem] font-heading font-extrabold">',
    
    '/<p style="font-size: 1\.05rem; max-width: 600px; margin: 0 auto 2rem auto; line-height: 1\.7; color: #d1fae5;">/' => '<p class="text-[1.05rem] max-w-[600px] mx-auto mb-8 leading-[1.7] text-emerald-100">',
    
    '/<div class="cta-buttons" style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">/' => '<div class="cta-buttons flex justify-center gap-4 flex-wrap">',
    
    '/<a href="\{\{ \$gs\(\'about_faculty_btn1_url\', \'\/people\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.8rem; background: white; color: var\(--color-primary\); padding: 0\.9rem 2\.2rem; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0\.3s; box-shadow: 0 10px 20px -5px rgba\(0,0,0,0\.15\); font-size: 0\.95rem;" onmouseover="this\.style\.transform=\'translateY\(-3px\)\'; this\.style\.boxShadow=\'0 15px 30px -5px rgba\(0,0,0,0\.2\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'0 10px 20px -5px rgba\(0,0,0,0\.15\)\'">/' => '<a href="{{ $gs(\'about_faculty_btn1_url\', \'/people\') }}" class="inline-flex items-center gap-3 bg-white text-[color:var(--color-primary)] py-[0.9rem] px-9 rounded-xl font-bold no-underline transition-all duration-300 shadow-[0_10px_20px_-5px_rgba(0,0,0,0.15)] text-[0.95rem] hover:-translate-y-[3px] hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.2)]">',
    
    '/<a href="\{\{ \$gs\(\'about_faculty_btn2_url\', \'\/contact\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.8rem; background: transparent; color: white; padding: 0\.9rem 2\.2rem; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0\.3s; border: 2px solid rgba\(255,255,255,0\.3\); font-size: 0\.95rem;" onmouseover="this\.style\.borderColor=\'rgba\(255,255,255,0\.6\)\'; this\.style\.background=\'rgba\(255,255,255,0\.08\)\'" onmouseout="this\.style\.borderColor=\'rgba\(255,255,255,0\.3\)\'; this\.style\.background=\'transparent\'">/' => '<a href="{{ $gs(\'about_faculty_btn2_url\', \'/contact\') }}" class="inline-flex items-center gap-3 bg-transparent text-white py-[0.9rem] px-[2.2rem] rounded-xl font-bold no-underline transition-all duration-300 border-2 border-white/30 text-[0.95rem] hover:border-white/60 hover:bg-white/[0.08]">',
    
    // For earlier bug where "box-shadow" missed out the margin-bottom: 1.5rem
    '/<div style="width: 52px; height: 52px; background: linear-gradient\(135deg, #16a34a, #15803d\); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.4rem; box-shadow: 0 8px 20px -4px rgba\(22, 163, 74, 0\.4\);">/' => '<div class="w-[52px] h-[52px] bg-gradient-to-br from-green-600 to-green-700 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] shadow-[0_8px_20px_-4px_rgba(22,163,74,0.4)]">'
];

foreach ($reps as $p => $r) {
    if (preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);

echo "Done part 3 scripts PHP";