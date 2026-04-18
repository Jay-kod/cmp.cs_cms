<?php
$file = __DIR__ . '/../resources/views/pages/about-partials/programmes.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div class="programmes-section" style="margin: 4rem 0;">/' => '<div class="programmes-section my-16">',
    
    '/<h2 style="font-size: 1\.8rem; margin-bottom: 2\.5rem; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 1rem;">/' => '<h2 class="text-[1.8rem] mb-10 font-heading font-extrabold text-slate-900 flex items-center gap-4">',
    
    '/<div style="width: 8px; height: 8px; background: var\(--color-primary\); border-radius: 50%;">/' => '<div class="w-2 h-2 bg-[color:var(--color-primary)] rounded-full">',
    
    '/<div class="programmes-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(300px, 1fr\)\); gap: 2rem;">/' => '<div class="programmes-grid grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-8">',
    
    '/<div class="programme-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba\(0,0,0,0\.04\); border: 1px solid #f1f5f9; transition: all 0\.4s ease;" onmouseover="this\.style\.transform=\'translateY\(-10px\)\'; this\.style\.boxShadow=\'0 20px 40px rgba\(0,0,0,0\.08\)\';" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'0 4px 20px rgba\(0,0,0,0\.04\)\';">/' => '<div class="programme-card bg-white rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-slate-100 transition-all duration-400 ease hover:-translate-y-2.5 hover:shadow-[0_20px_40px_rgba(0,0,0,0.08)]">',
    
    '/<div class="prog-icon" style="height: 160px; background: linear-gradient\(135deg, rgba\(22,163,74,0\.1\) 0%, rgba\(22,163,74,0\.02\) 100%\); display: flex; align-items: center; justify-content: center; position: relative;">/' => '<div class="prog-icon h-40 bg-gradient-to-br from-green-600/10 to-green-600/2 flex items-center justify-center relative">',
    
    '/<div style="width: 80px; height: 80px; background: white; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2\.5rem; color: var\(--color-primary\); box-shadow: 0 10px 25px rgba\(0,0,0,0\.05\); position: relative; z-index: 2;">/' => '<div class="w-20 h-20 bg-white rounded-[20px] flex items-center justify-center text-[2.5rem] text-[color:var(--color-primary)] shadow-[0_10px_25px_rgba(0,0,0,0.05)] relative z-[2]">',
    
    '/<div style="position: absolute; top: 0; right: 0; width: 150px; height: 150px; background: radial-gradient\(circle, rgba\(22,163,74,0\.1\) 0%, transparent 70%\); border-radius: 50%; transform: translate\(30%, -30%\);"><\/div>/' => '<div class="absolute top-0 right-0 w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full translate-x-[30%] -translate-y-[30%]"></div>',
    
    '/<div class="prog-content" style="padding: 2rem;">/' => '<div class="prog-content p-8">',
    
    '/<span style="display: inline-block; padding: 0\.4rem 1rem; background: #f8fafc; color: #64748b; font-size: 0\.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; border-radius: 20px; margin-bottom: 1\.2rem;">/' => '<span class="inline-block py-1.5 px-4 bg-slate-50 text-slate-500 text-[0.75rem] font-bold uppercase tracking-[1px] rounded-full mb-5">',
    
    '/<h3 style="font-size: 1\.4rem; margin-bottom: 1rem; color: #0f172a; font-family: var\(--font-heading\); font-weight: 800; line-height: 1\.3;">/' => '<h3 class="text-[1.4rem] mb-4 text-slate-900 font-heading font-extrabold leading-[1.3]">',
    
    '/<p style="color: #475569; font-size: 0\.95rem; line-height: 1\.6; margin-bottom: 2rem;">/' => '<p class="text-slate-600 text-[0.95rem] leading-[1.6] mb-8">',
    
    '/<ul style="list-style: none; padding: 0; margin: 0 0 2rem; display: flex; flex-direction: column; gap: 0\.8rem;">/' => '<ul class="list-none p-0 m-0 mb-8 flex flex-col gap-3">',
    
    '/<li style="display: flex; align-items: flex-start; gap: 0\.8rem; font-size: 0\.9rem; color: #334155;">/' => '<li class="flex items-start gap-3 text-[0.9rem] text-slate-700">',
    
    '/<i class="fa-solid fa-check" style="color: var\(--color-primary\); margin-top: 0\.25rem; font-size: 0\.8rem;"><\/i>/' => '<i class="fa-solid fa-check text-[color:var(--color-primary)] mt-1 text-[0.8rem]"></i>',
    
    '/<div style="padding-top: 1\.5rem; border-top: 1px solid #f1f5f9;">/' => '<div class="pt-6 border-t border-slate-100">',
    
    '/<a href="#" class="btn-prog" style="display: inline-flex; align-items: center; gap: 0\.5rem; color: var\(--color-primary\); text-decoration: none; font-weight: 700; font-size: 0\.95rem; transition: all 0\.3s;" onmouseover="this\.style\.gap=\'0\.8rem\'" onmouseout="this\.style\.gap=\'0\.5rem\'">/' => '<a href="#" class="btn-prog group inline-flex items-center gap-2 text-[color:var(--color-primary)] no-underline font-bold text-[0.95rem] transition-all duration-300 hover:gap-3">',
    
    '/<div class="programme-card" style="background: linear-gradient\(135deg, #0f172a 0%, #1e293b 100%\); border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba\(0,0,0,0\.1\); position: relative; transition: all 0\.4s ease;" onmouseover="this\.style\.transform=\'translateY\(-10px\)\'; this\.style\.boxShadow=\'0 20px 40px rgba\(0,0,0,0\.2\)\';" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'0 4px 20px rgba\(0,0,0,0\.1\)\';">/' => '<div class="programme-card bg-gradient-to-br from-slate-900 to-slate-800 rounded-2xl overflow-hidden shadow-[0_4px_20px_rgba(0,0,0,0.1)] relative transition-all duration-400 ease hover:-translate-y-2.5 hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)]">',
    
    '/<div style="position: absolute; top: 0; right: 0; width: 200px; height: 200px; background: radial-gradient\(circle, rgba\(255,255,255,0\.05\) 0%, transparent 70%\); border-radius: 50%; transform: translate\(30%, -30%\);"><\/div>/' => '<div class="absolute top-0 right-0 w-[200px] h-[200px] bg-[radial-gradient(circle,rgba(255,255,255,0.05)_0%,transparent_70%)] rounded-full translate-x-[30%] -translate-y-[30%]"></div>',
    
    '/<div style="position: absolute; bottom: 0; left: 0; width: 150px; height: 150px; background: radial-gradient\(circle, rgba\(22,163,74,0\.1\) 0%, transparent 70%\); border-radius: 50%; transform: translate\(-30%, 30%\);"><\/div>/' => '<div class="absolute bottom-0 left-0 w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full -translate-x-[30%] translate-y-[30%]"></div>',
    
    '/<div class="prog-content" style="padding: 3rem 2rem; position: relative; z-index: 1; height: 100%; display: flex; flex-direction: column;">/' => '<div class="prog-content p-12 px-8 relative z-[1] h-full flex flex-col">',
    
    '/<div style="width: 60px; height: 60px; background: rgba\(255,255,255,0\.1\); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 2rem; color: white; margin-bottom: 2rem; backdrop-filter: blur\(10px\);">/' => '<div class="w-[60px] h-[60px] bg-white/10 rounded-xl flex items-center justify-center text-[2rem] text-white mb-8 backdrop-blur-md">',
    
    '/<h3 style="font-size: 1\.8rem; margin-bottom: 1rem; color: white; font-family: var\(--font-heading\); font-weight: 800; line-height: 1\.2;">/' => '<h3 class="text-[1.8rem] mb-4 text-white font-heading font-extrabold leading-[1.2]">',
    
    '/<p style="color: #cbd5e1; font-size: 1rem; line-height: 1\.6; margin-bottom: 2\.5rem;">/' => '<p class="text-slate-300 text-[1rem] leading-[1.6] mb-10">',
    
    '/<ul style="list-style: none; padding: 0; margin: 0 0 auto; display: flex; flex-direction: column; gap: 1rem;">/' => '<ul class="list-none p-0 m-0 mb-auto flex flex-col gap-4">',
    
    '/<li style="display: flex; align-items: center; gap: 1rem; font-size: 0\.95rem; color: #f8fafc;">/' => '<li class="flex items-center gap-4 text-[0.95rem] text-slate-50">',
    
    '/<i class="fa-solid fa-arrow-right" style="color: var\(--color-primary\);"><\/i>/' => '<i class="fa-solid fa-arrow-right text-[color:var(--color-primary)]"></i>',
    
    '/<div style="margin-top: 3rem;">/' => '<div class="mt-12">',
    
    '/<a href="#" class="btn-prog-alt" style="display: inline-flex; align-items: center; justify-content: center; gap: 0\.8rem; background: white; color: #0f172a; text-decoration: none; font-weight: 800; font-size: 0\.95rem; padding: 1rem 2rem; border-radius: 12px; transition: all 0\.3s; width: 100%;" onmouseover="this\.style\.background=\'var\(--color-primary\)\'; this\.style\.color=\'white\';" onmouseout="this\.style\.background=\'white\'; this\.style\.color=\'#0f172a\';">/' => '<a href="#" class="btn-prog-alt group w-full inline-flex items-center justify-center gap-3 bg-white text-slate-900 no-underline font-extrabold text-[0.95rem] py-4 px-8 rounded-xl transition-all duration-300 hover:bg-[color:var(--color-primary)] hover:text-white">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done programmes replacements";