<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/nacos.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" class="nacos-home-section" style="padding: 3\.5rem 0; background: linear-gradient\(165deg, #0f172a 0%, #1e293b 60%, #0f4c2e 100%\); position: relative; overflow: hidden;">/'
    => '<section data-aos="fade-up" class="nacos-home-section py-14 bg-gradient-to-br from-slate-900 via-slate-800 to-green-900 relative overflow-hidden">',

    '/<div style="position: absolute; inset: 0; pointer-events: none;">/'
    => '<div class="absolute inset-0 pointer-events-none">',

    '/<div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient\(circle, rgba\(22,163,74,0\.15\) 0%, transparent 70%\); border-radius: 50%;"><\/div>/'
    => '<div class="absolute -top-[100px] -right-[100px] w-[400px] h-[400px] bg-[radial-gradient(circle,rgba(22,163,74,0.15)_0%,transparent_70%)] rounded-full"></div>',

    '/<div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient\(circle, rgba\(22,163,74,0\.1\) 0%, transparent 70%\); border-radius: 50%;"><\/div>/'
    => '<div class="absolute -bottom-[50px] -left-[50px] w-[300px] h-[300px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full"></div>',

    '/<div style="position: absolute; inset: 0; background: url\(\'data:image\/svg\+xml,<svg xmlns=%22http:\/\/www\.w3\.org\/2000\/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220\.5%22 fill=%22rgba\(255,255,255,0\.03\)%22\/><\/svg>\'\);"><\/div>/'
    => '<div class="absolute inset-0" style="background: url(\'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.5%22 fill=%22rgba(255,255,255,0.03)%22/></svg>\');"></div>',

    '/<div class="container" data-aos="fade-up" style="position: relative; z-index: 2;">/'
    => '<div class="container relative z-10" data-aos="fade-up">',

    '/<div style="display: grid; grid-template-columns: 1fr auto; align-items: end; gap: 1\.5rem; margin-bottom: 2rem;">/'
    => '<div class="grid grid-cols-[1fr_auto] items-end gap-6 mb-8">',

    '/<span style="display: inline-flex; align-items: center; gap: 0\.5rem; background: rgba\(22,163,74,0\.2\); backdrop-filter: blur\(8px\); color: #4ade80; font-size: 0\.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; padding: 0\.3rem 0\.9rem; border-radius: 20px; margin-bottom: 0\.6rem; border: 1px solid rgba\(22,163,74,0\.3\);">/'
    => '<span class="inline-flex items-center gap-2 bg-green-600/20 backdrop-blur-md text-green-400 text-[0.78rem] font-bold uppercase tracking-[1.5px] py-[0.3rem] px-[0.9rem] rounded-full mb-2.5 border border-green-600/30">',

    '/<h2 style="font-size: 2\.4rem; font-family: var\(--font-heading\); font-weight: 800; color: white; margin-bottom: 0\.5rem; line-height: 1\.15;">/'
    => '<h2 class="text-[2.4rem] font-heading font-extrabold text-white mb-2 leading-[1.15]">',

    '/<p style="color: #94a3b8; font-size: 0\.95rem; max-width: 550px; line-height: 1\.6; margin: 0;">/'
    => '<p class="text-slate-400 text-[0.95rem] max-w-[550px] leading-[1.6] m-0">',

    '/<div style="background: rgba\(255,255,255,0\.05\); backdrop-filter: blur\(10px\); border: 1px solid rgba\(255,255,255,0\.08\); border-radius: 14px; padding: 1\.4rem; margin-bottom: 1rem;">/'
    => '<div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-[14px] p-6 mb-4">',

    '/<div style="display: flex; align-items: center; gap: 0\.8rem; margin-bottom: 0\.8rem;">/'
    => '<div class="flex items-center gap-[0.8rem] mb-3">',

    '/<div style="width: 42px; height: 42px; background: linear-gradient\(135deg, #16a34a, #059669\); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.1rem; color: white;">/'
    => '<div class="w-[42px] h-[42px] bg-gradient-to-br from-green-600 to-emerald-600 rounded-xl flex items-center justify-center text-[1.1rem] text-white">',

    '/<h3 style="color: white; font-size: 1\.05rem; font-weight: 700; margin: 0; font-family: var\(--font-heading\);">/'
    => '<h3 class="text-white text-[1.05rem] font-bold m-0 font-heading">',

    '/<span style="color: #64748b; font-size: 0\.75rem;">/'
    => '<span class="text-slate-500 text-[0.75rem]">',

    '/<p style="color: #cbd5e1; font-size: 0\.9rem; line-height: 1\.65; margin: 0;">/'
    => '<p class="text-slate-300 text-[0.9rem] leading-[1.65] m-0">',

    '/<div style="background: rgba\(255,255,255,0\.04\); border: 1px solid rgba\(255,255,255,0\.06\); border-radius: 12px; padding: 0\.9rem 0\.7rem; text-align: center; transition: all 0\.3s;" onmouseover="this\.style\.background=\'rgba\(22,163,74,0\.12\)\'; this\.style\.borderColor=\'rgba\(22,163,74,0\.3\)\'" onmouseout="this\.style\.background=\'rgba\(255,255,255,0\.04\)\'; this\.style\.borderColor=\'rgba\(255,255,255,0\.06\)\'">/'
    => '<div class="group/stat bg-white/5 border border-white/5 rounded-xl py-[0.9rem] px-[0.7rem] text-center transition-all duration-300 hover:bg-green-600/10 hover:border-green-600/30">',

    '/<i class="\{\{ \$stat\[\'icon\'\] \}\}" style="color: #4ade80; font-size: 0\.95rem; margin-bottom: 0\.35rem; display: block;"><\/i>/'
    => '<i class="{{ $stat[\'icon\'] }} text-green-400 text-[0.95rem] mb-1.5 block"></i>',

    '/<div style="font-size: 1\.35rem; font-weight: 800; color: white; font-family: var\(--font-heading\); line-height: 1;">/'
    => '<div class="text-[1.35rem] font-extrabold text-white font-heading leading-none">',

    '/<div style="font-size: 0\.7rem; color: #64748b; margin-top: 0\.25rem; text-transform: uppercase; letter-spacing: 0\.5px; font-weight: 600;">/'
    => '<div class="text-[0.7rem] text-slate-500 mt-1 uppercase tracking-[0.5px] font-semibold">',

    '/<a href="\{\{ route\(\'nacos-presidents\'\) \}\}" style="display: flex; flex-direction: column; background: linear-gradient\(160deg, rgba\(30,41,59,0\.4\) 0%, rgba\(15,23,42,0\.6\) 100%\); border: 1px solid rgba\(255,255,255,0\.05\); border-radius: 14px; text-decoration: none; transition: all 0\.4s cubic-bezier\(0\.4, 0, 0\.2, 1\); position: relative; overflow: hidden; box-shadow: 0 4px 6px -1px rgba\(0,0,0,0\.1\), 0 2px 4px -1px rgba\(0,0,0,0\.06\);" onmouseover="this\.style\.background=\'linear-gradient\(160deg, rgba\(30,41,59,0\.7\) 0%, rgba\(15,23,42,0\.9\) 100%\)\'; this\.style\.borderColor=\'rgba\(74,222,128,0\.4\)\'; this\.style\.transform=\'translateY\(-5px\)\'; this\.style\.boxShadow=\'0 15px 30px -5px rgba\(22,163,74,0\.15\), inset 0 1px 0 rgba\(255,255,255,0\.1\)\'" onmouseout="this\.style\.background=\'linear-gradient\(160deg, rgba\(30,41,59,0\.4\) 0%, rgba\(15,23,42,0\.6\) 100%\)\'; this\.style\.borderColor=\'rgba\(255,255,255,0\.05\)\'; this\.style\.transform=\'translateY\(0\)\'; this\.style\.boxShadow=\'0 4px 6px -1px rgba\(0,0,0,0\.1\), 0 2px 4px -1px rgba\(0,0,0,0\.06\)\'">/'
    => '<a href="{{ route(\'nacos-presidents\') }}" class="group flex flex-col bg-gradient-to-br from-slate-800/40 to-slate-900/60 border border-white/5 rounded-[14px] no-underline transition-all duration-400 ease-out relative overflow-hidden shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-1px_rgba(0,0,0,0.06)] hover:from-slate-800/70 hover:to-slate-900/90 hover:border-green-400/40 hover:-translate-y-1 hover:shadow-[0_15px_30px_-5px_rgba(22,163,74,0.15),inset_0_1px_0_rgba(255,255,255,0.1)]">',

    '/<div style="width: 100%; aspect-ratio: 1\/1; position: relative; background: #0f172a; overflow: hidden;">/'
    => '<div class="w-full aspect-square relative bg-slate-900 overflow-hidden group-hover:scale-105 transition-transform duration-500">',

    '/<img src="\{\{ \$pres->photo \? asset\(\'storage\/\'\.\$pres->photo\) : asset\(\'images\/avatar-placeholder\.png\'\) \}\}" alt="\{\{ \$pres->name \}\}" style="width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0\.6s ease;" onerror="this\.src=\'https:\/\/ui-avatars\.com\/api\/\?name=\{\{ urlencode\(\$pres->name\) \}\}&background=0f172a&color=4ade80&size=200&font-size=0\.4&rounded=false\'" onmouseover="this\.style\.transform=\'scale\(1\.08\)\'" onmouseout="this\.style\.transform=\'scale\(1\)\'">/'
    => '<img src="{{ $pres->photo ? asset(\'storage/\'.$pres->photo) : asset(\'images/avatar-placeholder.png\') }}" alt="{{ $pres->name }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110" onerror="this.src=\'https://ui-avatars.com/api/?name={{ urlencode($pres->name) }}&background=0f172a&color=4ade80&size=200&font-size=0.4&rounded=false\'">',

    '/<div style="position: absolute; bottom: 0; left: 0; right: 0; height: 50%; background: linear-gradient\(to top, rgba\(15,23,42,1\) 0%, transparent 100%\); z-index: 1;"><\/div>/'
    => '<div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-slate-900 to-transparent z-10"></div>',

    '/<div style="text-align: center; padding: 0 0\.8rem 1\.2rem; position: relative; z-index: 2; margin-top: -1\.5rem;">/'
    => '<div class="text-center px-[0.8rem] pt-0 pb-[1.2rem] relative z-20 -mt-6">',

    '/<h4 style="color: white; font-size: 0\.95rem; font-weight: 800; margin: 0 0 0\.3rem; font-family: var\(--font-heading\); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-shadow: 0 2px 4px rgba\(0,0,0,0\.8\);">/'
    => '<h4 class="text-white text-[0.95rem] font-extrabold m-0 mb-1 font-heading whitespace-nowrap overflow-hidden text-ellipsis drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">',

    '/<span style="display: inline-block; background: rgba\(15,23,42,0\.8\); border: 1px solid rgba\(74,222,128,0\.3\); color: #4ade80; padding: 0\.15rem 0\.6rem; border-radius: 6px; font-size: 0\.68rem; font-weight: 700; letter-spacing: 0\.03em; margin-bottom: 0\.4rem; box-shadow: 0 2px 5px rgba\(0,0,0,0\.2\);">/'
    => '<span class="inline-block bg-slate-900/80 border border-green-400/30 text-green-400 py-[0.15rem] px-[0.6rem] rounded-md text-[0.68rem] font-bold tracking-[0.03em] mb-1.5 shadow-[0_2px_5px_rgba(0,0,0,0.2)]">',

    '/<div style="display: flex; align-items: center; justify-content: center; gap: 0\.4rem; margin-top: 0\.2rem;">/'
    => '<div class="flex items-center justify-center gap-[0.4rem] mt-[0.2rem]">',

    '/<div style="width: 4px; height: 4px; border-radius: 50%; background: \{\{ \$dotColor \}\}; box-shadow: 0 0 4px \{\{ \$dotColor \}\};"><\/div>/'
    => '<div class="w-1 h-1 rounded-full" style="background: {{ $dotColor }}; box-shadow: 0 0 4px {{ $dotColor }};"></div>',

    '/<p style="color: \{\{ \$statusColor \}\}; font-size: 0\.72rem; font-weight: 700; margin: 0; text-transform: uppercase; letter-spacing: 0\.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-shadow: 0 1px 2px rgba\(0,0,0,0\.5\);">/'
    => '<p class="text-[0.72rem] font-bold m-0 uppercase tracking-[0.5px] whitespace-nowrap overflow-hidden text-ellipsis drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)]" style="color: {{ $statusColor }};">',

    '/<div style="background: rgba\(255,255,255,0\.04\); border: 1px dashed rgba\(255,255,255,0\.1\); border-radius: 12px; padding: 2rem; text-align: center;">/'
    => '<div class="bg-white/5 border border-dashed border-white/10 rounded-xl p-8 text-center">',

    '/<i class="fa-solid fa-user-tie" style="font-size: 1\.6rem; color: #334155; margin-bottom: 0\.6rem; display: block;"><\/i>/'
    => '<i class="fa-solid fa-user-tie text-[1.6rem] text-slate-700 mb-2.5 block"></i>',

    '/<p style="color: #64748b; font-size: 0\.85rem; margin: 0;">/'
    => '<p class="text-slate-500 text-[0.85rem] m-0">',

    '/<a href="\{\{ route\(\'nacos-presidents\'\) \}\}" style="display: flex; align-items: center; justify-content: space-between; margin-top: 1\.5rem; padding: 1\.2rem 1\.5rem; background: linear-gradient\(135deg, rgba\(22,163,74,0\.2\), rgba\(22,163,74,0\.05\)\); border: 1\.5px solid rgba\(74,222,128,0\.5\); border-radius: 12px; text-decoration: none; transition: all 0\.3s; box-shadow: 0 4px 20px -5px rgba\(22,163,74,0\.3\);" onmouseover="this\.style\.background=\'linear-gradient\(135deg, rgba\(22,163,74,0\.3\), rgba\(22,163,74,0\.1\)\)\'; this\.style\.borderColor=\'rgba\(74,222,128,0\.8\)\'; this\.style\.boxShadow=\'0 8px 25px -5px rgba\(22,163,74,0\.5\)\';" onmouseout="this\.style\.background=\'linear-gradient\(135deg, rgba\(22,163,74,0\.2\), rgba\(22,163,74,0\.05\)\)\'; this\.style\.borderColor=\'rgba\(74,222,128,0\.5\)\'; this\.style\.boxShadow=\'0 4px 20px -5px rgba\(22,163,74,0\.3\)\';">/'
    => '<a href="{{ route(\'nacos-presidents\') }}" class="group flex items-center justify-between mt-6 py-[1.2rem] px-[1.5rem] bg-gradient-to-br from-green-600/20 to-green-600/5 border-[1.5px] border-green-400/50 rounded-xl no-underline transition-all duration-300 shadow-[0_4px_20px_-5px_rgba(22,163,74,0.3)] hover:from-green-600/30 hover:to-green-600/10 hover:border-green-400/80 hover:shadow-[0_8px_25px_-5px_rgba(22,163,74,0.5)]">',

    '/<div style="color: white; font-weight: 800; font-size: 1rem; font-family: var\(--font-heading\); margin-bottom: 0\.2rem;">/'
    => '<div class="text-white font-extrabold text-base font-heading mb-1">',

    '/<div style="color: #94a3b8; font-size: 0\.8rem;">/'
    => '<div class="text-slate-400 text-[0.8rem]">',

    '/<div style="width: 38px; height: 38px; background: rgba\(34,197,94,0\.3\); border: 1px solid rgba\(74,222,128,0\.4\); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4ade80; flex-shrink: 0; font-size: 1rem; transition: transform 0\.3s ease;" onmouseover="this\.style\.transform=\'translateX\(4px\)\'" onmouseout="this\.style\.transform=\'translateX\(0\)\'">/'
    => '<div class="w-[38px] h-[38px] bg-green-500/30 border border-green-400/40 rounded-full flex items-center justify-center text-green-400 shrink-0 text-base transition-transform duration-300 group-hover:translate-x-1">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done nacos pt1" . PHP_EOL;