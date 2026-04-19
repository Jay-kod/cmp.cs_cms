<?php
$file = __DIR__ . '/../resources/views/pages/about-partials/vision-mission.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" id="vision-mission" style="margin-bottom: 4rem;">/'
    => '<section data-aos="fade-up" id="vision-mission" class="mb-16">',

    '/<div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1\.5rem;">/'
    => '<div class="section-heading flex items-center gap-4 mb-6">',

    '/<div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient\(135deg, rgba\(22, 163, 74, 0\.15\), rgba\(16, 185, 129, 0\.1\)\); color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">/'
    => '<div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-primary rounded-[14px] flex items-center justify-center text-[1.3rem]">',

    '/<h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var\(--font-heading\); font-weight: 700;">/'
    => '<h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">',

    '/<div style="width: 60px; height: 4px; background: linear-gradient\(90deg, var\(--color-primary\), var\(--color-accent\)\); margin-bottom: 2rem; border-radius: 2px;"><\/div>/'
    => '<div class="w-[60px] h-1 bg-gradient-to-r from-primary to-accent mb-8 rounded-sm"></div>',

    '/<div class="about-vm-grid" style="display: grid; grid-template-columns: repeat\(auto-fit, minmax\(300px, 1fr\)\); gap: 1\.5rem;">/'
    => '<div class="about-vm-grid grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-6">',

    '/<div data-aos="fade-up" class="about-vm-card vision-card" style="background: linear-gradient\(135deg, #f0fdf4 0%, #dcfce7 100%\); border-radius: 16px; padding: 1\.8rem; position: relative; overflow: hidden; border: 1px solid rgba\(22, 163, 74, 0\.15\); transition: transform 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\), box-shadow 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\), cursor 0\.3s;" onmouseover="this\.style\.transform=\'translateY\(-8px\) scale\(1\.02\)\'; this\.style\.boxShadow=\'0 25px 50px -12px rgba\(22,163,74,0\.3\)\'; this\.style\.cursor=\'pointer\'" onmouseout="this\.style\.transform=\'translateY\(0\) scale\(1\)\'; this\.style\.boxShadow=\'none\'">/'
    => '<div data-aos="fade-up" class="about-vm-card vision-card group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-[1.8rem] relative overflow-hidden border border-green-600/15 transition-all duration-300 ease-out hover:-translate-y-2 hover:scale-[1.02] hover:shadow-[0_25px_50px_-12px_rgba(22,163,74,0.3)] hover:cursor-pointer">',

    '/<div style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba\(22, 163, 74, 0\.08\); transform: rotate\(-15deg\); pointer-events: none; transition: transform 0\.4s ease;" class="bg-icon">/'
    => '<div class="absolute -top-[15px] -right-[15px] text-[6rem] text-green-600/10 -rotate-15 pointer-events-none transition-transform duration-400 ease-in-out group-hover:scale-110 group-hover:rotate-12 bg-icon">',

    '/<div style="width: 44px; height: 44px; background: linear-gradient\(135deg, #16a34a, #15803d\); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.2rem; margin-bottom: 1\.2rem; box-shadow: 0 8px 20px -4px rgba\(22, 163, 74, 0\.4\); transition: transform 0\.3s;" class="main-icon">/'
    => '<div class="w-[44px] h-[44px] bg-gradient-to-br from-green-600 to-green-700 text-white rounded-xl flex items-center justify-center text-[1.2rem] mb-[1.2rem] shadow-[0_8px_20px_-4px_rgba(22,163,74,0.4)] transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-3 main-icon">',

    '/<h3 style="font-size: 1\.25rem; color: #1e293b; margin: 0 0 0\.8rem 0; font-family: var\(--font-heading\); font-weight: 700;">/'
    => '<h3 class="text-[1.25rem] text-slate-800 m-0 mb-[0.8rem] font-heading font-bold">',

    '/<p style="color: #334155; font-size: 0\.95rem; line-height: 1\.6; margin: 0;">/'
    => '<p class="text-slate-700 text-[0.95rem] leading-[1.6] m-0">',

    '/<div data-aos="fade-up" class="about-vm-card mission-card" style="background: linear-gradient\(135deg, #ecfdf5 0%, #d1fae5 100%\); border-radius: 16px; padding: 1\.8rem; position: relative; overflow: hidden; border: 1px solid rgba\(16, 185, 129, 0\.15\); transition: transform 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\), box-shadow 0\.3s cubic-bezier\(0\.4, 0, 0\.2, 1\), cursor 0\.3s;" onmouseover="this\.style\.transform=\'translateY\(-8px\) scale\(1\.02\)\'; this\.style\.boxShadow=\'0 25px 50px -12px rgba\(16,185,129,0\.3\)\'; this\.style\.cursor=\'pointer\'" onmouseout="this\.style\.transform=\'translateY\(0\) scale\(1\)\'; this\.style\.boxShadow=\'none\'">/'
    => '<div data-aos="fade-up" class="about-vm-card mission-card group bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-[1.8rem] relative overflow-hidden border border-emerald-500/15 transition-all duration-300 ease-out hover:-translate-y-2 hover:scale-[1.02] hover:shadow-[0_25px_50px_-12px_rgba(16,185,129,0.3)] hover:cursor-pointer">',

    '/<div style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba\(16, 185, 129, 0\.08\); transform: rotate\(-15deg\); pointer-events: none; transition: transform 0\.4s ease;" class="bg-icon">/'
    => '<div class="absolute -top-[15px] -right-[15px] text-[6rem] text-emerald-500/10 -rotate-15 pointer-events-none transition-transform duration-400 ease-in-out group-hover:scale-110 group-hover:rotate-12 bg-icon">',

    '/<div style="width: 44px; height: 44px; background: linear-gradient\(135deg, #10b981, #059669\); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.2rem; margin-bottom: 1\.2rem; box-shadow: 0 8px 20px -4px rgba\(16, 185, 129, 0\.4\); transition: transform 0\.3s;" class="main-icon">/'
    => '<div class="w-[44px] h-[44px] bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl flex items-center justify-center text-[1.2rem] mb-[1.2rem] shadow-[0_8px_20px_-4px_rgba(16,185,129,0.4)] transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-3 main-icon">',

    '/<div class="about-objectives-wrap" style="margin-top: 2\.5rem;">/'
    => '<div class="about-objectives-wrap mt-10">',

    '/<div style="text-align: center; margin-bottom: 2\.5rem;">/'
    => '<div class="text-center mb-10">',

    '/<div style="display: inline-flex; align-items: center; gap: 0\.5rem; padding: 0\.35rem 1rem; background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 20px; font-size: 0\.75rem; font-weight: 700; color: #16a34a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0\.8rem;">/'
    => '<div class="inline-flex items-center gap-2 py-[0.35rem] px-4 bg-green-50 border border-green-100 rounded-full text-[0.75rem] font-bold text-green-600 uppercase tracking-[1px] mb-[0.8rem]">',

    '/<i class="fa-solid fa-crosshairs" style="font-size: 0\.65rem;"><\/i>/'
    => '<i class="fa-solid fa-crosshairs text-[0.65rem]"></i>',

    '/<h3 style="font-size: 1\.8rem; color: #0f172a; margin: 0 0 0\.5rem; font-family: var\(--font-heading\); font-weight: 800;">/'
    => '<h3 class="text-[1.8rem] text-slate-900 m-0 mb-2 font-heading font-extrabold">',

    '/<p style="margin: 0 auto; max-width: 500px; font-size: 0\.92rem; color: #64748b; line-height: 1\.6;">/'
    => '<p class="m-0 mx-auto max-w-[500px] text-[0.92rem] text-slate-500 leading-[1.6]">',

];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done vision-mission pt1\n";