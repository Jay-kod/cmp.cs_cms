<?php
$file = __DIR__ . '/../resources/views/pages/resources.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" style="background: url\(\'\{\{ asset\(\'images\/pattern-grid\.svg\'\) \}\}\'\) center\/cover, linear-gradient\(135deg, #0f172a 0%, #064e3b 100%\); padding: 6rem 0 7rem; color: white; text-align: center; position: relative; overflow: hidden; border-bottom: 4px solid var\(--color-accent\);">/' 
    => '<section data-aos="fade-up" class="bg-[url(\'{{ asset(\'images/pattern-grid.svg\') }}\')] bg-center bg-cover pt-24 pb-28 text-white text-center relative overflow-hidden border-b-4 border-[color:var(--color-accent)]" style="background-image: url(\'{{ asset(\'images/pattern-grid.svg\') }}\'), linear-gradient(135deg, #0f172a 0%, #064e3b 100%);">',

    '/<div style="position: absolute; inset: 0; background: radial-gradient\(circle at center, rgba\(16, 185, 129, 0\.15\) 0%, transparent 60%\); pointer-events: none;"><\/div>/' 
    => '<div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at center, rgba(16, 185, 129, 0.15) 0%, transparent 60%);"></div>',

    '/<div class="container" data-aos="fade-up" style="position: relative; z-index: 1;">/' 
    => '<div class="container relative z-1" data-aos="fade-up">',

    '/<nav aria-label="breadcrumb" style="display: flex; justify-content: center; margin-bottom: 1\.5rem;">/' 
    => '<nav aria-label="breadcrumb" class="flex justify-center mb-6">',

    '/<ol class="breadcrumb" style="list-style: none; margin: 0; background: rgba\(255,255,255,0\.08\); backdrop-filter: blur\(8px\); padding: 0\.5rem 1\.5rem; border-radius: 50px; font-size: 0\.85rem; font-weight: 600; letter-spacing: 0\.5px; border: 1px solid rgba\(255,255,255,0\.1\); display: inline-flex; align-items: center; gap: 0\.8rem;">/' 
    => '<ol class="breadcrumb list-none m-0 bg-white/10 backdrop-blur-md py-2 px-6 rounded-full text-[0.85rem] font-semibold tracking-[0.5px] border border-white/10 inline-flex items-center gap-[0.8rem]">',

    '/<li style="margin: 0;"><a href="\{\{ url\(\'\/\'\) \}\}" style="color: #cbd5e1; text-decoration: none; transition: color 0\.3s;" onmouseover="this\.style\.color=\'white\'" onmouseout="this\.style\.color=\'#cbd5e1\'"><i class="fa-solid fa-house" style="margin-right: 4px;"><\/i> Home<\/a><\/li>/' 
    => '<li class="m-0"><a href="{{ url(\'/\') }}" class="text-slate-300 no-underline transition-colors duration-300 hover:text-white"><i class="fa-solid fa-house mr-1"></i> Home</a></li>',

    '/<li style="color: rgba\(255,255,255,0\.3\); margin: 0;">\/<\/li>/' 
    => '<li class="text-white/30 m-0">/</li>',

    '/<li aria-current="page" style="color: #F4C430; margin: 0;">Resources<\/li>/' 
    => '<li aria-current="page" class="text-[#F4C430] m-0">Resources</li>',

    '/<h1 style="font-size: 3\.5rem; font-weight: 900; margin-bottom: 1\.2rem; color: #FFFFFF; font-family: var\(--font-heading\); letter-spacing: -1px; text-shadow: 0 4px 20px rgba\(0,0,0,0\.3\);">/' 
    => '<h1 class="text-[3.5rem] font-black mb-[1.2rem] text-white font-heading tracking-[-1px] drop-shadow-[0_4px_20px_rgba(0,0,0,0.3)]">',

    '/<span style="color: var\(--color-accent\);">Academic<\/span> Resources/' 
    => '<span class="text-[color:var(--color-accent)]">Academic</span> Resources',

    '/<p style="font-size: 1\.15rem; max-width: 680px; margin: 0 auto; color: #cbd5e1; line-height: 1\.7; font-weight: 400;">/' 
    => '<p class="text-[1.15rem] max-w-[680px] mx-auto text-slate-300 leading-[1.7] font-normal">',

    '/<section data-aos="fade-up" style="background: transparent; padding: 0; margin-top: -3\.5rem; position: relative; z-index: 10; margin-bottom: 3rem;">/' 
    => '<section data-aos="fade-up" class="bg-transparent p-0 -mt-14 relative z-10 mb-12">',

    '/<div style="display: grid; grid-template-columns: repeat\(2, 1fr\); gap: 2rem; max-width: 800px; margin: 0 auto;">/' 
    => '<div class="grid grid-cols-2 gap-8 max-w-[800px] mx-auto">',

    '/<a href="#downloads-section" style="text-decoration: none; color: inherit; display: block; height: 100%;">/' 
    => '<a href="#downloads-section" class="no-underline text-inherit block h-full">',

    '/<div data-aos="fade-up" class="card portal-card h-100" style="background: white; padding: 2rem; border-radius: 16px; border: 1px solid rgba\(0,0,0,0\.05\); text-align: left; transition: all 0\.4s ease; box-shadow: 0 10px 30px rgba\(0,0,0,0\.08\); position: relative; overflow: hidden; z-index: 1; display: flex; flex-direction: row; align-items: center; gap: 1\.2rem;">/' 
    => '<div data-aos="fade-up" class="card portal-card h-full bg-white p-8 rounded-2xl border border-black/5 text-left transition-all duration-400 ease-in-out shadow-[0_10px_30px_rgba(0,0,0,0.08)] relative overflow-hidden z-1 flex flex-row items-center gap-[1.2rem]">',

    '/<div class="portal-hover-bg" style="position: absolute; inset: 0; background: linear-gradient\(135deg, #f0fdf4 0%, #ffffff 100%\); opacity: 0; transition: opacity 0\.4s ease; z-index: -1;"><\/div>/' 
    => '<div class="portal-hover-bg absolute inset-0 bg-gradient-to-br from-green-50 to-white opacity-0 transition-opacity duration-400 ease-in-out -z-1"></div>',

    '/<div style="width: 64px; height: 64px; background: #f0fdf4; color: var\(--color-primary\); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1\.8rem; flex-shrink: 0; box-shadow: 0 8px 20px rgba\(22, 163, 74, 0\.2\); transition: transform 0\.4s ease;">/' 
    => '<div class="w-16 h-16 bg-green-50 text-[color:var(--color-primary)] rounded-2xl flex items-center justify-center text-[1.8rem] shrink-0 shadow-[0_8px_20px_rgba(22,163,74,0.2)] transition-transform duration-400 ease-in-out">',

    '/<h3 style="font-size: 1\.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0\.4rem; font-family: var\(--font-heading\);">/' 
    => '<h3 class="text-[1.25rem] font-extrabold text-slate-900 mb-1.5 font-heading">',

    '/<p style="color: #64748b; font-size: 0\.85rem; margin-bottom: 0; line-height: 1\.5;">/' 
    => '<p class="text-slate-500 text-[0.85rem] m-0 leading-[1.5]">',

    '/<a href="#" style="text-decoration: none; color: inherit; display: block; height: 100%;">/' 
    => '<a href="#" class="no-underline text-inherit block h-full">',

    '/<div class="portal-hover-bg" style="position: absolute; inset: 0; background: linear-gradient\(135deg, #eff6ff 0%, #ffffff 100%\); opacity: 0; transition: opacity 0\.4s ease; z-index: -1;"><\/div>/' 
    => '<div class="portal-hover-bg absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 transition-opacity duration-400 ease-in-out -z-1"></div>',

    '/<div style="width: 64px; height: 64px; background: #eff6ff; color: #3b82f6; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1\.8rem; flex-shrink: 0; box-shadow: 0 8px 20px rgba\(59, 130, 246, 0\.2\); transition: transform 0\.4s ease;">/' 
    => '<div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-[1.8rem] shrink-0 shadow-[0_8px_20px_rgba(59,130,246,0.2)] transition-transform duration-400 ease-in-out">',

    '/<section data-aos="fade-up" id="downloads-section" style="background: white; padding: 4rem 0 8rem;">/' 
    => '<section data-aos="fade-up" id="downloads-section" class="bg-white pt-16 pb-32">',

    '/<div class="container" data-aos="fade-up" style="max-width: 1000px;">/' 
    => '<div class="container max-w-[1000px]" data-aos="fade-up">',

    '/<div style="text-align: center; margin-bottom: 4rem;">/' 
    => '<div class="text-center mb-16">',

    '/<span style="display: inline-block; background: #f0fdf4; color: var\(--color-primary\); font-size: 0\.75rem; font-weight: 700; padding: 0\.4rem 1\.2rem; border-radius: 50px; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 1px;">/' 
    => '<span class="inline-block bg-green-50 text-[color:var(--color-primary)] text-[0.75rem] font-bold py-[0.4rem] px-[1.2rem] rounded-full mb-4 uppercase tracking-[1px]">',

    '/<h2 style="font-size: 2\.2rem; font-weight: 900; color: #2d3748; font-family: var\(--font-heading\); margin-bottom: 0\.8rem; letter-spacing: -0\.5px;">/' 
    => '<h2 class="text-[2.2rem] font-black text-slate-800 font-heading mb-3 tracking-[-0.5px]">',

    '/<p style="color: #718096; font-size: 1rem; max-width: 500px; margin: 0 auto; line-height: 1\.6;">/' 
    => '<p class="text-slate-500 text-base max-w-[500px] mx-auto leading-[1.6]">',

    '/<div style="display: flex; flex-direction: column; gap: 3rem;">/' 
    => '<div class="flex flex-col gap-12">',

    '/<div style="display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 1rem;">/' 
    => '<div class="flex items-end justify-between mb-4">',

    '/<h3 style="font-size: 1\.35rem; font-weight: 800; color: #1a202c; margin: 0 0 0\.2rem; font-family: var\(--font-heading\);">/' 
    => '<h3 class="text-[1.35rem] font-extrabold text-slate-900 m-0 mb-1 font-heading">',

    '/<p style="margin: 0; color: #718096; font-size: 0\.85rem;">/' 
    => '<p class="m-0 text-slate-500 text-[0.85rem]">',

    '/<div style="padding: 0\.3rem 0\.8rem; border-radius: 50px; border: 1px solid #e2e8f0; color: #4a5568; font-weight: 600; font-size: 0\.7rem; background: white;">/' 
    => '<div class="py-[0.3rem] px-[0.8rem] rounded-full border border-slate-200 text-slate-600 font-semibold text-[0.7rem] bg-white">',

    '/<span style="color: var\(--color-primary\);">\{\{ \$items->count\(\) \}\}<\/span>/' 
    => '<span class="text-[color:var(--color-primary)]">{{ $items->count() }}</span>',

    '/<div style="display: grid; gap: 0\.8rem;">/' 
    => '<div class="grid gap-[0.8rem]">',

    '/<div class="advanced-doc-row" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1\.2rem; transition: all 0\.3s; display: flex; justify-content: space-between; align-items: center;">/' 
    => '<div class="advanced-doc-row bg-white border border-slate-200 rounded-xl p-[1.2rem] transition-all duration-300 flex justify-between items-center group hover:shadow-md hover:border-slate-300">',

    '/<div style="display: flex; gap: 1\.2rem; align-items: center;">/' 
    => '<div class="flex gap-[1.2rem] items-center">',

    '/<div style="width: 50px; height: 50px; background: #f8fafc; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1\.5rem; flex-shrink: 0; border: 1px solid #f1f5f9;">/' 
    => '<div class="w-[50px] h-[50px] bg-slate-50 rounded-[10px] flex items-center justify-center text-[1.5rem] shrink-0 border border-slate-100 group-hover:bg-slate-100 transition-colors">',

    '/<i class="fa-solid fa-file-pdf" style="color: #ef4444;"><\/i>/' 
    => '<i class="fa-solid fa-file-pdf text-red-500"></i>',

    '/<i class="fa-solid fa-file-word" style="color: #3b82f6;"><\/i>/' 
    => '<i class="fa-solid fa-file-word text-blue-500"></i>',

    '/<i class="fa-solid fa-file-image" style="color: #10b981;"><\/i>/' 
    => '<i class="fa-solid fa-file-image text-emerald-500"></i>',

    '/<i class="fa-solid fa-file-excel" style="color: #16a34a;"><\/i>/' 
    => '<i class="fa-solid fa-file-excel text-green-600"></i>',

    '/<i class="fa-solid fa-file-lines" style="color: #64748b;"><\/i>/' 
    => '<i class="fa-solid fa-file-lines text-slate-500"></i>',

    '/<h4 style="font-size: 1rem; font-weight: 700; color: #2d3748; margin: 0 0 0\.3rem; letter-spacing: -0\.2px;">/' 
    => '<h4 class="text-base font-bold text-slate-800 m-0 mb-1 tracking-[-0.2px] transition-colors group-hover:text-[color:var(--color-primary)]">',

    '/<div style="display: flex; flex-wrap: wrap; gap: 0\.8rem; align-items: center;">/' 
    => '<div class="flex flex-wrap gap-[0.8rem] items-center">',

    '/<span style="font-size: 0\.75rem; color: #718096; font-weight: 500; display: inline-flex; align-items: center; gap: 0\.3rem;">/' 
    => '<span class="text-[0.75rem] text-slate-500 font-medium inline-flex items-center gap-[0.3rem]">',

    '/<i class="fa-regular fa-calendar-check" style="color: #a0aec0;"><\/i>/' 
    => '<i class="fa-regular fa-calendar-check text-slate-400"></i>',

    '/<span style="width: 3px; height: 3px; border-radius: 50%; background: #cbd5e1;"><\/span>/' 
    => '<span class="w-[3px] h-[3px] rounded-full bg-slate-300"></span>',

    '/<span style="font-size: 0\.65rem; color: #4a5568; font-weight: 700; text-transform: uppercase; background: #edf2f7; padding: 0\.15rem 0\.5rem; border-radius: 4px;">/' 
    => '<span class="text-[0.65rem] text-slate-600 font-bold uppercase bg-slate-100 py-[0.15rem] px-2 rounded">',

    '/<p style="font-size: 0\.85rem; color: #718096; margin: 0\.5rem 0 0; line-height: 1\.5; max-width: 500px;">/' 
    => '<p class="text-[0.85rem] text-slate-500 mt-2 m-0 leading-[1.5] max-w-[500px]">',

    '/<a href="\{\{ asset\(\'storage\/\' \. \$item->file_path\) \}\}" target="_blank" class="btn premium-btn" style="flex-shrink: 0; background: white; color: #2d3748; border: 1px solid #e2e8f0; padding: 0\.6rem 1\.2rem; border-radius: 8px; font-weight: 700; font-size: 0\.8rem; text-decoration: none; transition: all 0\.3s; display: inline-flex; align-items: center; gap: 0\.4rem; margin-left: 1rem;">/' 
    => '<a href="{{ asset(\'storage/\' . $item->file_path) }}" target="_blank" class="btn premium-btn shrink-0 bg-white text-slate-800 border border-slate-200 py-[0.6rem] px-[1.2rem] rounded-lg font-bold text-[0.8rem] no-underline transition-all duration-300 inline-flex items-center gap-[0.4rem] ml-4 hover:bg-[color:var(--color-primary)] hover:text-white hover:border-[color:var(--color-primary)] hover:shadow-lg hover:-translate-y-0.5">',

    '/<i class="fa-solid fa-arrow-down" style="font-size: 0\.75rem;"><\/i>/' 
    => '<i class="fa-solid fa-arrow-down text-[0.75rem]"></i>',

    '/<div style="text-align: center; padding: 3rem 2rem; background: #fafafa; border-radius: 12px; border: 1px dashed #cbd5e1;">/' 
    => '<div class="text-center py-12 px-8 bg-neutral-50 rounded-xl border border-dashed border-slate-300">',

    '/<div style="margin: 0 auto 0\.8rem; font-size: 2\.2rem; color: #cbd5e1;">/' 
    => '<div class="mx-auto mb-[0.8rem] text-[2.2rem] text-slate-300">',

    '/<h4 style="color: #1a202c; font-weight: 800; margin-bottom: 0\.3rem; font-size: 1\.1rem;">/' 
    => '<h4 class="text-slate-900 font-extrabold mb-1 text-[1.1rem]">',

    '/<p style="color: #718096; margin: 0; font-size: 0\.85rem;">/' 
    => '<p class="text-slate-500 m-0 text-[0.85rem]">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done resources.blade.php" . PHP_EOL;