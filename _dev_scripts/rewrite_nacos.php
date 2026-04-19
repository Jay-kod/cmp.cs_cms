<?php
$file = __DIR__ . '/../resources/views/pages/nacos-presidents.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" style="background: linear-gradient\(165deg, #0f172a 0%, #1e293b 55%, #0f4c2e 100%\); padding: 5rem 0 4rem; position: relative; overflow: hidden;">/' 
    => '<section data-aos="fade-up" class="bg-gradient-to-br from-slate-900 via-slate-800 to-green-900 py-16 sm:py-20 relative overflow-hidden">',

    '/<div style="position: absolute; inset: 0; pointer-events: none;">/' 
    => '<div class="absolute inset-0 pointer-events-none">',

    '/<div style="position: absolute; top: -80px; right: -80px; width: 350px; height: 350px; background: radial-gradient\(circle, rgba\(22,163,74,0\.15\) 0%, transparent 70%\); border-radius: 50%;"><\/div>/' 
    => '<div class="absolute -top-20 -right-20 w-[350px] h-[350px] bg-[radial-gradient(circle,rgba(22,163,74,0.15)_0%,transparent_70%)] rounded-full"></div>',

    '/<div style="position: absolute; bottom: -40px; left: -40px; width: 250px; height: 250px; background: radial-gradient\(circle, rgba\(22,163,74,0\.1\) 0%, transparent 70%\); border-radius: 50%;"><\/div>/' 
    => '<div class="absolute -bottom-10 -left-10 w-[250px] h-[250px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full"></div>',

    '/<div style="position: absolute; inset: 0; background: url\(\'data:image\/svg\+xml,<svg xmlns=%22http:\/\/www\.w3\.org\/2000\/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220\.5%22 fill=%22rgba\(255,255,255,0\.03\)%22\/><\/svg>\'\);"><\/div>/' 
    => '<div class="absolute inset-0" style="background: url(\'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.5%22 fill=%22rgba(255,255,255,0.03)%22/></svg>\');"></div>',

    '/<div class="container" data-aos="fade-up" style="position: relative; z-index: 2; text-align: center; display: flex; flex-direction: column; align-items: center;">/' 
    => '<div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">',

    '/<span style="display: inline-flex; align-items: center; gap: 0\.5rem; background: rgba\(22,163,74,0\.2\); backdrop-filter: blur\(8px\); color: #4ade80; font-size: 0\.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; padding: 0\.3rem 1rem; border-radius: 20px; margin-bottom: 1rem; border: 1px solid rgba\(22,163,74,0\.3\);">/' 
    => '<span class="inline-flex items-center gap-2 bg-green-600/20 backdrop-blur-md text-green-400 text-[0.78rem] font-bold uppercase tracking-[1.5px] py-[0.3rem] px-4 rounded-full mb-4 border border-green-600/30">',

    '/<h1 style="color: white; font-size: 3rem; font-family: var\(--font-heading\); font-weight: 800; margin: 0 0 0\.8rem; line-height: 1\.15;">/' 
    => '<h1 class="text-white text-[2.2rem] lg:text-[3rem] font-heading font-extrabold m-0 mb-3 leading-[1.15]">',

    '/<p style="color: #e2e8f0; font-size: 1\.15rem; max-width: 700px; margin: 0 auto 2rem; line-height: 1\.8; text-wrap: balance; text-align: center; text-shadow: 0 2px 4px rgba\(0,0,0,0\.2\);">/' 
    => '<p class="text-slate-200 text-base md:text-[1.15rem] max-w-[700px] mx-auto mb-8 leading-[1.8] text-balance text-center drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)]">',

    '/<div style="display: flex; flex-direction: column; gap: 0\.6rem; width: 100%; max-width: 400px; margin: 0 auto;">/' 
    => '<div class="flex flex-col gap-[0.6rem] w-full max-w-[400px] mx-auto">',

    '/<div style="display: flex; gap: 0\.6rem; justify-content: center; flex-wrap: nowrap; width: 100%;">/' 
    => '<div class="flex gap-[0.6rem] justify-center flex-nowrap w-full">',

    '/<a href="#about-nacos" style="display: inline-flex; align-items: center; justify-content: center; gap: 0\.4rem; background: linear-gradient\(135deg, #16a34a, #059669\); color: white; padding: 0\.65rem 0\.5rem; border-radius: 8px; font-size: 0\.85rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba\(22,163,74,0\.3\); transition: all 0\.2s; flex: 1; white-space: nowrap;" onmouseover="this\.style\.transform=\'translateY\(-1px\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'">/' 
    => '<a href="#about-nacos" class="inline-flex items-center justify-center gap-[0.4rem] bg-gradient-to-br from-green-600 to-emerald-600 text-white py-[0.65rem] px-2 rounded-lg text-[0.85rem] font-bold no-underline shadow-[0_4px_15px_rgba(22,163,74,0.3)] transition-all duration-200 flex-1 whitespace-nowrap hover:-translate-y-[1px]">',

    '/<a href="#past-leaders" style="display: inline-flex; align-items: center; justify-content: center; gap: 0\.4rem; background: rgba\(255,255,255,0\.08\); color: white; padding: 0\.65rem 0\.5rem; border-radius: 8px; font-size: 0\.85rem; font-weight: 600; text-decoration: none; border: 1\.5px solid rgba\(255,255,255,0\.15\); transition: all 0\.2s; backdrop-filter: blur\(4px\); flex: 1; white-space: nowrap;" onmouseover="this\.style\.borderColor=\'rgba\(255,255,255,0\.4\)\'; this\.style\.background=\'rgba\(255,255,255,0\.14\)\'" onmouseout="this\.style\.borderColor=\'rgba\(255,255,255,0\.15\)\'; this\.style\.background=\'rgba\(255,255,255,0\.08\)\'">/' 
    => '<a href="#past-leaders" class="inline-flex items-center justify-center gap-[0.4rem] bg-white/10 text-white py-[0.65rem] px-2 rounded-lg text-[0.85rem] font-semibold no-underline border-[1.5px] border-white/15 transition-all duration-200 backdrop-blur-sm flex-1 whitespace-nowrap hover:border-white/40 hover:bg-white/15">',

    '/<a href="\{\{ \$gs\(\'nacos_official_website_url\'\) \}\}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; gap: 0\.4rem; background: linear-gradient\(135deg, #eab308, #ca8a04\); color: white; padding: 0\.65rem 0\.5rem; border-radius: 8px; font-size: 0\.85rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba\(234,179,8,0\.3\); transition: all 0\.2s; border: none; width: 100%; white-space: nowrap;" onmouseover="this\.style\.transform=\'translateY\(-1px\)\'; this\.style\.boxShadow=\'0 6px 20px rgba\(234,179,8,0\.4\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'0 4px 15px rgba\(234,179,8,0\.3\)\'">/' 
    => '<a href="{{ $gs(\'nacos_official_website_url\') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-[0.4rem] bg-gradient-to-br from-yellow-500 to-yellow-600 text-white py-[0.65rem] px-2 rounded-lg text-[0.85rem] font-bold no-underline shadow-[0_4px_15px_rgba(234,179,8,0.3)] transition-all duration-200 border-none w-full whitespace-nowrap hover:-translate-y-[1px] hover:shadow-[0_6px_20px_rgba(234,179,8,0.4)]">',

    '/<i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0\.75rem; margin-left: 0\.2rem;"><\/i>/' 
    => '<i class="fa-solid fa-arrow-up-right-from-square text-[0.75rem] ml-1"></i>',

    '/<section data-aos="fade-up" id="about-nacos" style="padding: 4rem 0; background: white;">/' 
    => '<section data-aos="fade-up" id="about-nacos" class="py-16 bg-white">',

    '/<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-bottom: 3\.5rem;">/' 
    => '<div class="grid lg:grid-cols-2 gap-12 items-center mb-14">',

    '/<span style="display: inline-block; color: var\(--color-primary\); font-size: 0\.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; margin-bottom: 0\.8rem; background: rgba\(22,163,74,0\.1\); padding: 0\.25rem 0\.9rem; border-radius: 20px;">/' 
    => '<span class="inline-block text-[color:var(--color-primary)] text-[0.8rem] font-bold uppercase tracking-[1.5px] mb-3 bg-green-600/10 py-1 px-3.5 rounded-full">',

    '/<h2 style="font-size: 2\.2rem; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a; margin: 0 0 1rem; line-height: 1\.2;">/' 
    => '<h2 class="text-[2.2rem] font-heading font-extrabold text-slate-900 m-0 mb-4 leading-[1.2]">',

    '/<p style="color: #334155; font-size: 1\.05rem; line-height: 1\.8; margin: 0 0 1\.2rem;">/' 
    => '<p class="text-slate-700 text-[1.05rem] leading-[1.8] m-0 mb-5">',

    '/<p style="color: #475569; font-size: 1rem; line-height: 1\.8; margin: 0 0 1\.2rem;">/' 
    => '<p class="text-slate-600 text-base leading-[1.8] m-0 mb-5">',

    '/<p style="color: #475569; font-size: 1rem; line-height: 1\.8; margin: 0;">/' 
    => '<p class="text-slate-600 text-base leading-[1.8] m-0">',

    '/<section data-aos="fade-up" style="padding: 3\.5rem 0; background: #f8fafc; border-top: 1px solid #f1f5f9;">/' 
    => '<section data-aos="fade-up" class="py-14 bg-slate-50 border-t border-slate-100">',

    '/<div style="text-align: center; margin-bottom: 2\.5rem;">/' 
    => '<div class="text-center mb-10">',

    '/<span style="display: inline-block; color: var\(--color-primary\); font-size: 0\.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; margin-bottom: 0\.6rem; background: rgba\(22,163,74,0\.1\); padding: 0\.25rem 0\.9rem; border-radius: 20px;">/' 
    => '<span class="inline-block text-[color:var(--color-primary)] text-[0.8rem] font-bold uppercase tracking-[1.5px] mb-2.5 bg-green-600/10 py-1 px-3.5 rounded-full">',

    '/<h2 style="font-size: 2rem; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a; margin: 0;">/' 
    => '<h2 class="text-[2rem] font-heading font-extrabold text-slate-900 m-0">',

    '/<section data-aos="fade-up" id="past-leaders" style="padding: 4rem 0; background: white;">/' 
    => '<section data-aos="fade-up" id="past-leaders" class="py-16 bg-white">',

    '/<h2 style="font-size: 2rem; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a; margin: 0 0 0\.5rem;">/' 
    => '<h2 class="text-[2rem] font-heading font-extrabold text-slate-900 m-0 mb-2">',

    '/<p style="color: #64748b; font-size: 0\.95rem; max-width: 550px; margin: 0 auto; line-height: 1\.6;">/' 
    => '<p class="text-slate-500 text-[0.95rem] max-w-[550px] mx-auto m-0 leading-[1.6]">',

    '/<div style="max-width: 700px; margin: 0 auto 2rem; text-align: center;">/' 
    => '<div class="max-w-[700px] mx-auto mb-8 text-center">',

    '/<p style="color: #475569; font-size: 1rem; line-height: 1\.8;">/' 
    => '<p class="text-slate-600 text-base leading-[1.8]">',

    '/<div style="grid-column: 1 \/ -1; text-align: center; padding: 3rem; background: #f8fafc; border-radius: 14px; border: 1px dashed #e2e8f0;">/' 
    => '<div class="col-span-full text-center py-12 px-0 bg-slate-50 rounded-[14px] border border-dashed border-slate-200">',

    '/<i class="fa-solid fa-users-slash" style="font-size: 2\.5rem; color: #cbd5e1; margin-bottom: 0\.8rem; display: block;"><\/i>/' 
    => '<i class="fa-solid fa-users-slash text-[2.5rem] text-slate-300 mb-3 block"></i>',

    '/<h3 style="margin: 0 0 0\.4rem 0; font-size: 1\.1rem; color: #334155;">/' 
    => '<h3 class="m-0 mb-1.5 text-[1.1rem] text-slate-700">',

    '/<p style="color: #64748b; margin: 0; font-size: 0\.9rem;">/' 
    => '<p class="text-slate-500 m-0 text-[0.9rem]">',

    '/<section data-aos="fade-up" style="padding: 3rem 0; background: linear-gradient\(105deg, #14532d 0%, #15803d 100%\); position: relative; overflow: hidden;">/' 
    => '<section data-aos="fade-up" class="py-12 bg-gradient-to-br from-green-900 to-green-700 relative overflow-hidden">',

    '/<div style="position: absolute; inset: 0; background: url\(\'data:image\/svg\+xml,<svg xmlns=%22http:\/\/www\.w3\.org\/2000\/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220\.6%22 fill=%22rgba\(255,255,255,0\.04\)%22\/><\/svg>\'\); pointer-events: none;"><\/div>/' 
    => '<div class="absolute inset-0 pointer-events-none" style="background: url(\'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.6%22 fill=%22rgba(255,255,255,0.04)%22/></svg>\');"></div>',

    '/<div class="container" data-aos="fade-up" style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap;">/' 
    => '<div class="container relative z-10 flex items-center justify-between gap-8 flex-wrap" data-aos="fade-up">',

    '/<div style="flex: 1; min-width: 280px;">/' 
    => '<div class="flex-1 min-w-[280px]">',

    '/<h2 style="font-size: 1\.6rem; font-family: var\(--font-heading\); font-weight: 800; color: white; margin: 0 0 0\.4rem; line-height: 1\.2;">/' 
    => '<h2 class="text-[1.6rem] font-heading font-extrabold text-white m-0 mb-1.5 leading-[1.2]">',

    '/<p style="font-size: 0\.9rem; color: rgba\(255,255,255,0\.7\); line-height: 1\.6; margin: 0;">/' 
    => '<p class="text-[0.9rem] text-white/70 leading-[1.6] m-0">',

    '/<div style="display: flex; gap: 0\.6rem; flex-wrap: wrap; align-items: center;">/' 
    => '<div class="flex gap-[0.6rem] flex-wrap items-center">',

    '/<a href="\{\{ url\(\'\/contact\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.5rem; background: white; color: #14532d; padding: 0\.6rem 1\.3rem; border-radius: 8px; font-size: 0\.88rem; font-weight: 700; text-decoration: none; box-shadow: 0 2px 10px rgba\(0,0,0,0\.15\); transition: all 0\.2s;" onmouseover="this\.style\.transform=\'translateY\(-1px\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'">/' 
    => '<a href="{{ url(\'/contact\') }}" class="inline-flex items-center gap-[0.5rem] bg-white text-green-900 py-[0.6rem] px-[1.3rem] rounded-lg text-[0.88rem] font-bold no-underline shadow-[0_2px_10px_rgba(0,0,0,0.15)] transition-all duration-200 hover:-translate-y-[1px]">',

    '/<a href="\{\{ url\(\'\/\'\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.5rem; background: rgba\(255,255,255,0\.08\); color: white; padding: 0\.6rem 1\.3rem; border-radius: 8px; font-size: 0\.88rem; font-weight: 600; text-decoration: none; border: 1\.5px solid rgba\(255,255,255,0\.2\); transition: all 0\.2s; backdrop-filter: blur\(4px\);" onmouseover="this\.style\.borderColor=\'rgba\(255,255,255,0\.5\)\'" onmouseout="this\.style\.borderColor=\'rgba\(255,255,255,0\.2\)\'">/' 
    => '<a href="{{ url(\'/\') }}" class="inline-flex items-center gap-[0.5rem] bg-white/10 text-white py-[0.6rem] px-[1.3rem] rounded-lg text-[0.88rem] font-semibold no-underline border-[1.5px] border-white/20 transition-all duration-200 backdrop-blur-sm hover:border-white/50">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

// Remove the <style> block completely like previously mapping grid to sm/lg
$text = preg_replace('/<style>\s*\/\* NACOS Presidents Page Responsive(.*?)\s*<\/style>\s*/s', '', $text);


file_put_contents($file, $text);
echo "Done nacos-presidents" . PHP_EOL;