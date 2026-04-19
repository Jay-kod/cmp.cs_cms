<?php
$file = __DIR__ . '/../resources/views/pages/about-partials/programmes.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" id="programmes" style="margin-bottom: 4rem;">/' => '<section data-aos="fade-up" id="programmes" class="mb-16">',
    
    '/<div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1\.5rem;">/' => '<div class="section-heading flex items-center gap-4 mb-6">',
    
    '/<div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient\(135deg, rgba\(22, 163, 74, 0\.15\), rgba\(16, 185, 129, 0\.1\)\); color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">/' => '<div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">',
    
    '/<h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var\(--font-heading\); font-weight: 700;">/' => '<h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">',
    
    '/<div style="width: 60px; height: 4px; background: linear-gradient\(90deg, var\(--color-primary\), var\(--color-accent\)\); margin-bottom: 1rem; border-radius: 2px;"><\/div>/' => '<div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-4 rounded-sm"></div>',
    
    '/<p style="font-size: 1\.02rem; color: #64748b; line-height: 1\.7; margin-bottom: 2rem;">/' => '<p class="text-[1.02rem] text-slate-500 leading-[1.7] mb-8">',
    
    '/<div class="about-programmes-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(300px, 1fr\)\); gap: 1\.2rem;">/' => '<div class="about-programmes-grid grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-[1.2rem]">',
    
    '/<div data-aos="fade-up" class="about-prog-card" style="background: linear-gradient\(135deg, #0f172a 0%, #1e293b 100%\); border-radius: 14px; padding: 1\.8rem; color: white; position: relative; overflow: hidden; transition: transform 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\), box-shadow 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\);" onmouseover="this\.style\.transform=\'translateY\(-6px\)\'; this\.style\.boxShadow=\'0 20px 40px -12px rgba\(15,23,42,0\.3\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'">/' => '<div data-aos="fade-up" class="about-prog-card bg-gradient-to-br from-slate-900 to-slate-800 rounded-[14px] p-[1.8rem] text-white relative overflow-hidden transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-[6px] hover:shadow-[0_20px_40px_-12px_rgba(15,23,42,0.3)]">',
    
    '/<div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; border-radius: 50%; background: rgba\(255,255,255,0\.04\); transition: transform 0\.4s;" class="bg-circle"><\/div>/' => '<div class="bg-circle absolute -top-[30px] -right-[30px] w-[100px] h-[100px] rounded-full bg-white/5 transition-transform duration-400"></div>',
    
    '/<div style="display: flex; align-items: center; gap: 0\.8rem; margin-bottom: 1\.2rem;">/' => '<div class="flex items-center gap-[0.8rem] mb-[1.2rem]">',
    
    '/<div style="width: 44px; height: 44px; background: rgba\(16, 185, 129, 0\.2\); color: #6ee7b7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.1rem; transition: transform 0\.3s;" class="main-icon">/' => '<div class="main-icon w-[44px] h-[44px] bg-emerald-500/20 text-emerald-300 rounded-xl flex items-center justify-center text-[1.1rem] transition-transform duration-300">',
    
    '/<h4 style="margin: 0; font-size: 1\.15rem; font-weight: 700;">/' => '<h4 class="m-0 text-[1.15rem] font-bold">',
    
    '/<ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0\.6rem;">/' => '<ul class="list-none p-0 m-0 flex flex-col gap-[0.6rem]">',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;">/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300">',
    
    '/<i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i>/' => '<i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i>',
    
    '/<span style="flex: 1;">/' => '<span class="flex-1">',
    
    '/<div data-aos="fade-up" class="about-prog-card" style="background: linear-gradient\(135deg, #f0fdf4 0%, #dcfce7 100%\); border-radius: 14px; padding: 1\.8rem; position: relative; overflow: hidden; border: 1px solid #bbf7d0; transition: transform 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\), box-shadow 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\);" onmouseover="this\.style\.transform=\'translateY\(-6px\)\'; this\.style\.boxShadow=\'0 20px 40px -12px rgba\(22,163,74,0\.15\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'none\'">/' => '<div data-aos="fade-up" class="about-prog-card bg-gradient-to-br from-green-50 to-green-100 rounded-[14px] p-[1.8rem] relative overflow-hidden border border-green-200 transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] hover:-translate-y-[6px] hover:shadow-[0_20px_40px_-12px_rgba(22,163,74,0.15)]">',
    
    '/<div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; border-radius: 50%; background: rgba\(22,163,74,0\.06\); transition: transform 0\.4s;" class="bg-circle"><\/div>/' => '<div class="bg-circle absolute -top-[30px] -right-[30px] w-[100px] h-[100px] rounded-full bg-green-600/5 transition-transform duration-400"></div>',
    
    '/<div style="width: 44px; height: 44px; background: rgba\(22, 163, 74, 0\.15\); color: var\(--color-primary\); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.1rem; transition: transform 0\.3s;" class="main-icon">/' => '<div class="main-icon w-[44px] h-[44px] bg-green-600/15 text-[color:var(--color-primary)] rounded-xl flex items-center justify-center text-[1.1rem] transition-transform duration-300">',
    
    '/<h4 style="margin: 0; font-size: 1\.15rem; font-weight: 700; color: #1e293b;">/' => '<h4 class="m-0 text-[1.15rem] font-bold text-slate-800">',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #334155;">/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-700">',
    
    '/<i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: var\(--color-primary\); margin-top: 5px;"><\/i>/' => '<i class="fa-solid fa-chevron-right text-[0.55rem] text-[color:var(--color-primary)] mt-[5px]"></i>',
    
    '/<span style="font-size: 0\.65rem; background: #dcfce7; color: #16a34a; padding: 0\.1rem 0\.4rem; border-radius: 4px; font-weight: 600; white-space: nowrap;">/' => '<span class="text-[0.65rem] bg-green-100 text-green-600 py-[0.1rem] px-[0.4rem] rounded font-semibold whitespace-nowrap">',
    
    '/<a href="\{\{ url\(\'\/academics\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.5rem; margin-top: 1\.5rem; font-size: 0\.9rem; color: var\(--color-primary\); font-weight: 600; text-decoration: none;" onmouseover="this\.style\.gap=\'0\.8rem\'" onmouseout="this\.style\.gap=\'0\.5rem\'">/' => '<a href="{{ url(\'/academics\') }}" class="group inline-flex items-center gap-2 mt-6 text-[0.9rem] text-[color:var(--color-primary)] font-semibold no-underline transition-all hover:gap-[0.8rem]">',
    
    '/<i class="fa-solid fa-arrow-right" style="font-size: 0\.75rem; transition: transform 0\.2s;"><\/i>/' => '<i class="fa-solid fa-arrow-right text-[0.75rem] transition-transform duration-200"></i>'
];

foreach ($reps as $p => $r) {
    $text = preg_replace($p, $r, $text);
}

file_put_contents($file, $text);
echo "Done about-partials programmes replacements" . PHP_EOL;