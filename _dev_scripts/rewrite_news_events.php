<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/news-events.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div class="news-events-section" style="margin: 4rem 0;">/' => '<div class="news-events-section my-16">',
    
    '/<div style="display: flex; gap: 4rem; padding: 2rem; background: white; border-radius: 20px; box-shadow: 0 10px 40px rgba\(0,0,0,0\.03\); border: 1px solid #f1f5f9; position: relative;">/' => '<div class="flex gap-16 p-8 bg-white rounded-[20px] shadow-[0_10px_40px_rgba(0,0,0,0.03)] border border-slate-100 relative max-lg:flex-col max-lg:gap-10 max-md:p-5">',
    
    '/<div style="position: absolute; top: -1px; left: 0; right: 0; height: 4px; background: linear-gradient\(90deg, var\(--color-primary\), var\(--color-accent\), transparent\); border-radius: 20px 20px 0 0;"><\/div>/' => '<div class="absolute -top-[1px] left-0 right-0 h-1 bg-gradient-to-r from-[color:var(--color-primary)] via-[color:var(--color-accent)] to-transparent rounded-t-[20px]"></div>',
    
    '/<div class="news-column" style="flex: 1\.5; min-width: 0;">/' => '<div class="news-column flex-[1.5] min-w-0">',
    
    '/<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem;">/' => '<div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4 max-sm:flex-col max-sm:items-start max-sm:gap-4">',
    
    '/<div style="display: flex; align-items: center; gap: 1rem;">/' => '<div class="flex items-center gap-4">',
    
    '/<div style="width: 48px; height: 48px; background: linear-gradient\(135deg, rgba\(22,163,74,0\.1\) 0%, rgba\(22,163,74,0\.02\) 100%\); color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.3rem;">/' => '<div class="w-12 h-12 bg-gradient-to-br from-green-600/10 to-green-600/2 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">',
    
    '/<h2 style="font-size: 1\.8rem; margin: 0; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a;">/' => '<h2 class="text-[1.8rem] m-0 font-heading font-extrabold text-slate-900">',
    
    '/<a href="\{\{ route\(\'news\.index\'\) \}\}" class="btn-outline" style="display: inline-flex; align-items: center; gap: 0\.5rem; color: #475569; text-decoration: none; font-weight: 600; font-size: 0\.95rem; transition: all 0\.3s;" onmouseover="this\.style\.color=\'var\(--color-primary\)\'; this\.querySelector\(\'i\'\)\.style\.transform=\'translateX\(4px\)\';" onmouseout="this\.style\.color=\'#475569\'; this\.querySelector\(\'i\'\)\.style\.transform=\'translateX\(0\)\';">/' => '<a href="{{ route(\'news.index\') }}" class="btn-outline group inline-flex items-center gap-2 text-slate-600 no-underline font-semibold text-[0.95rem] transition-all duration-300 hover:text-[color:var(--color-primary)]">',
    
    '/<i class="fa-solid fa-arrow-right" style="transition: transform 0\.3s;"><\/i>/' => '<i class="fa-solid fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>',
    
    '/<article class="news-card" style="display: flex; gap: 1\.5rem; margin-bottom: 2rem; background: #fff; padding: 1rem; border-radius: 16px; border: 1px solid transparent; transition: all 0\.3s ease;" onmouseover="this\.style\.background=\'#f8fafc\'; this\.style\.borderColor=\'#e2e8f0\'; this\.querySelector\(\'\.news-img img\'\)\.style\.transform=\'scale\(1\.05\)\';" onmouseout="this\.style\.background=\'#fff\'; this\.style\.borderColor=\'transparent\'; this\.querySelector\(\'\.news-img img\'\)\.style\.transform=\'scale\(1\)\';">/' => '<article class="group/news flex gap-6 mb-8 bg-white p-4 rounded-2xl border border-transparent transition-all duration-300 ease hover:bg-slate-50 hover:border-slate-200 max-sm:flex-col max-sm:gap-4 max-sm:p-0">',
    
    '/<div class="news-img" style="width: 180px; height: 130px; border-radius: 12px; overflow: hidden; flex-shrink: 0; position: relative;">/' => '<div class="news-img w-[180px] h-[130px] rounded-xl overflow-hidden shrink-0 relative max-sm:w-full max-sm:h-[200px]">',
    
    '/<img src="\{\{ app\(\\\\App\\\\Services\\\\MediaOptimizationService::class\)->webpOrOriginalUrl\(\$item->image, 400\) \}\}" alt="\{\{ \$item->title \}\}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0\.5s ease;">/' => '<img src="{{ app(\\App\\Services\\MediaOptimizationService::class)->webpOrOriginalUrl($item->image, 400) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 ease group-hover/news:scale-105">',
    
    '/<div style="position: absolute; top: 8px; left: 8px; background: rgba\(15,23,42,0\.85\); backdrop-filter: blur\(4px\); color: white; font-size: 0\.7rem; font-weight: 700; padding: 0\.3rem 0\.8rem; border-radius: 20px; letter-spacing: 0\.5px; text-transform: uppercase;">/' => '<div class="absolute top-2 left-2 bg-slate-900/85 backdrop-blur-[4px] text-white text-[0.7rem] font-bold py-[0.3rem] px-3 rounded-full tracking-[0.5px] uppercase">',
    
    '/<div class="news-content" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">/' => '<div class="news-content flex-1 flex flex-col justify-center max-sm:p-4">',
    
    '/<div style="display: flex; gap: 1rem; margin-bottom: 0\.6rem; font-size: 0\.85rem; color: #64748b;">/' => '<div class="flex gap-4 mb-2.5 text-[0.85rem] text-slate-500">',
    
    '/<span style="display: flex; align-items: center; gap: 0\.4rem;"><i class="fa-regular fa-calendar" style="color: var\(--color-primary\);"><\/i> \{\{ \$item->published_at->format\(\'M d, Y\'\) \}\}<\/span>/' => '<span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-[color:var(--color-primary)]"></i> {{ $item->published_at->format(\'M d, Y\') }}</span>',
    
    '/<span style="display: flex; align-items: center; gap: 0\.4rem;"><i class="fa-regular fa-eye" style="color: var\(--color-primary\);"><\/i> \{\{ \$item->views \}\} views<\/span>/' => '<span class="flex items-center gap-1.5"><i class="fa-regular fa-eye text-[color:var(--color-primary)]"></i> {{ $item->views }} views</span>',
    
    '/<h3 style="font-size: 1\.25rem; font-weight: 800; font-family: var\(--font-heading\); margin: 0 0 0\.8rem; line-height: 1\.4;">/' => '<h3 class="text-[1.25rem] font-extrabold font-heading m-0 mb-3 leading-[1.4]">',
    
    '/<a href="\{\{ route\(\'news\.show\', \$item->slug\) \}\}" style="color: #0f172a; text-decoration: none; transition: color 0\.3s;" onmouseover="this\.style\.color=\'var\(--color-primary\)\'" onmouseout="this\.style\.color=\'#0f172a\'">/' => '<a href="{{ route(\'news.show\', $item->slug) }}" class="text-slate-900 no-underline transition-colors duration-300 hover:text-[color:var(--color-primary)]">',
    
    '/<a href="\{\{ route\(\'news\.show\', \$item->slug\) \}\}" style="display: inline-flex; align-items: center; gap: 0\.4rem; color: var\(--color-primary\); font-weight: 700; font-size: 0\.9rem; text-decoration: none; transition: all 0\.3s;" onmouseover="this\.style\.gap=\'0\.6rem\'" onmouseout="this\.style\.gap=\'0\.4rem\'">/' => '<a href="{{ route(\'news.show\', $item->slug) }}" class="inline-flex items-center gap-1.5 text-[color:var(--color-primary)] font-bold text-[0.9rem] no-underline transition-all duration-300 group-hover/news:gap-[0.6rem]">',
    
    '/<div style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1;">/' => '<div class="text-center py-12 px-12 bg-slate-50 rounded-2xl border border-dashed border-slate-300">',
    
    '/<div style="width: 64px; height: 64px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1\.8rem; color: #94a3b8; margin: 0 auto 1rem; box-shadow: 0 4px 10px rgba\(0,0,0,0\.02\);">/' => '<div class="w-16 h-16 bg-white rounded-full flex items-center justify-center text-[1.8rem] text-slate-400 mx-auto mb-4 shadow-[0_4px_10px_rgba(0,0,0,0.02)]">',
    
    '/<h3 style="font-size: 1\.2rem; color: #334155; margin-bottom: 0\.5rem; font-weight: 700;">/' => '<h3 class="text-[1.2rem] text-slate-700 mb-2 font-bold">',
    
    '/<p style="color: #64748b; font-size: 0\.95rem; margin: 0;">/' => '<p class="text-slate-500 text-[0.95rem] m-0">',
    
    '/<div class="events-column" style="flex: 1; min-width: 0; background: #f8fafc; border-radius: 20px; padding: 2rem; position: relative; overflow: hidden;">/' => '<div class="events-column flex-1 min-w-0 bg-slate-50 rounded-[20px] p-8 relative overflow-hidden max-md:p-5">',
    
    '/<div style="position: absolute; top: 0; right: 0; width: 150px; height: 150px; background: radial-gradient\(circle, rgba\(22,163,74,0\.05\) 0%, transparent 70%\); border-radius: 50%; transform: translate\(30%, -30%\);"><\/div>/' => '<div class="absolute top-0 right-0 w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(22,163,74,0.05)_0%,transparent_70%)] rounded-full translate-x-[30%] -translate-y-[30%]"></div>',
    
    '/<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; position: relative; z-index: 1;">/' => '<div class="flex justify-between items-center mb-8 relative z-[1]">',
    
    '/<div style="display: flex; align-items: center; gap: 1rem;">/' => '<div class="flex items-center gap-4">',
    
    '/<div style="width: 48px; height: 48px; background: white; color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.3rem; box-shadow: 0 4px 15px rgba\(0,0,0,0\.05\);">/' => '<div class="w-12 h-12 bg-white text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem] shadow-[0_4px_15px_rgba(0,0,0,0.05)]">',
    
    '/<h2 style="font-size: 1\.5rem; margin: 0; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a;">/' => '<h2 class="text-[1.5rem] m-0 font-heading font-extrabold text-slate-900">',
    
    '/<a href="\{\{ route\(\'events\.index\'\) \}\}" class="btn-primary" style="background: var\(--color-primary\); color: white; padding: 0\.5rem 1rem; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0\.85rem; display: inline-flex; align-items: center; gap: 0\.4rem; transition: all 0\.3s; box-shadow: 0 4px 10px rgba\(22,163,74,0\.2\);" onmouseover="this\.style\.boxShadow=\'0 6px 15px rgba\(22,163,74,0\.3\)\'; this\.style\.transform=\'translateY\(-2px\)\';" onmouseout="this\.style\.boxShadow=\'0 4px 10px rgba\(22,163,74,0\.2\)\'; this\.style\.transform=\'translateY\(0\)\';">/' => '<a href="{{ route(\'events.index\') }}" class="btn-primary bg-[color:var(--color-primary)] text-white py-2 px-4 rounded-lg no-underline font-semibold text-[0.85rem] inline-flex items-center gap-1.5 transition-all duration-300 shadow-[0_4px_10px_rgba(22,163,74,0.2)] hover:shadow-[0_6px_15px_rgba(22,163,74,0.3)] hover:-translate-y-[2px]">',
    
    '/<div style="display: flex; flex-direction: column; gap: 1rem; position: relative; z-index: 1;">/' => '<div class="flex flex-col gap-4 relative z-[1]">',
    
    '/<div class="event-card" style="background: white; border-radius: 16px; padding: 1\.2rem; display: flex; gap: 1\.2rem; box-shadow: 0 4px 15px rgba\(0,0,0,0\.02\); border: 1px solid #f1f5f9; transition: all 0\.3s ease;" onmouseover="this\.style\.transform=\'translateX\(6px\)\'; this\.style\.boxShadow=\'0 10px 25px rgba\(0,0,0,0\.05\)\'; this\.style\.borderColor=\'#e2e8f0\';" onmouseout="this\.style\.transform=\'translateX\(0\)\'; this\.style\.boxShadow=\'0 4px 15px rgba\(0,0,0,0\.02\)\'; this\.style\.borderColor=\'#f1f5f9\';">/' => '<div class="event-card group/evt bg-white rounded-2xl p-5 flex gap-5 shadow-[0_4px_15px_rgba(0,0,0,0.02)] border border-slate-100 transition-all duration-300 ease hover:translate-x-[6px] hover:shadow-[0_10px_25px_rgba(0,0,0,0.05)] hover:border-slate-200 max-sm:flex-col">',
    
    '/<div class="event-date" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 70px; height: 80px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0; flex-shrink: 0; transition: all 0\.3s ease;">/' => '<div class="event-date flex flex-col items-center justify-center w-[70px] h-[80px] bg-slate-50 rounded-xl border border-slate-200 shrink-0 transition-all duration-300 ease group-hover/evt:bg-[color:var(--color-primary)] group-hover/evt:border-transparent group-hover/evt:-translate-y-1 max-sm:h-[70px] max-sm:flex-row max-sm:gap-2 max-sm:w-full">',
    
    '/<span style="font-size: 0\.8rem; font-weight: 700; color: #64748b; text-transform: uppercase;">\{\{ \$item->event_date->format\(\'M\'\) \}\}<\/span>/' => '<span class="text-[0.8rem] font-bold text-slate-500 uppercase group-hover/evt:text-green-50">{{ $item->event_date->format(\'M\') }}</span>',
    
    '/<span style="font-size: 1\.8rem; font-weight: 800; color: #0f172a; font-family: var\(--font-heading\); line-height: 1;">\{\{ \$item->event_date->format\(\'d\'\) \}\}<\/span>/' => '<span class="text-[1.8rem] font-extrabold text-slate-900 font-heading leading-none group-hover/evt:text-white">{{ $item->event_date->format(\'d\') }}</span>',
    
    '/<div class="event-info" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">/' => '<div class="event-info flex-1 flex flex-col justify-center">',
    
    '/<h4 style="font-size: 1\.1rem; font-weight: 700; margin: 0 0 0\.5rem; color: #0f172a; line-height: 1\.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">/' => '<h4 class="text-[1.1rem] font-bold m-0 mb-2 text-slate-900 leading-[1.3] line-clamp-2">',
    
    '/<div style="display: flex; flex-direction: column; gap: 0\.3rem; font-size: 0\.85rem; color: #64748b;">/' => '<div class="flex flex-col gap-1 text-[0.85rem] text-slate-500">',
    
    '/<span style="display: flex; align-items: center; gap: 0\.4rem;"><i class="fa-regular fa-clock" style="color: #94a3b8;"><\/i> \{\{ date\(\'h:i A\', strtotime\(\$item->event_time\)\) \}\}<\/span>/' => '<span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-slate-400"></i> {{ date(\'h:i A\', strtotime($item->event_time)) }}</span>',
    
    '/<span style="display: flex; align-items: center; gap: 0\.4rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fa-solid fa-location-dot" style="color: #94a3b8;"><\/i> \{\{ \$item->location \}\}<\/span>/' => '<span class="flex items-center gap-1.5 whitespace-nowrap overflow-hidden text-ellipsis"><i class="fa-solid fa-location-dot text-slate-400"></i> {{ $item->location }}</span>',
    
    '/<div style="text-align: center; padding: 2\.5rem 1rem; background: white; border-radius: 16px; border: 1px dashed #cbd5e1; box-shadow: 0 4px 15px rgba\(0,0,0,0\.02\);">/' => '<div class="text-center py-10 px-4 bg-white rounded-2xl border border-dashed border-slate-300 shadow-[0_4px_15px_rgba(0,0,0,0.02)]">',
    
    '/<div style="width: 56px; height: 56px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1\.5rem; color: #94a3b8; margin: 0 auto 1rem;">/' => '<div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-[1.5rem] text-slate-400 mx-auto mb-4">',
    
    '/<h3 style="font-size: 1\.1rem; color: #334155; margin-bottom: 0\.4rem; font-weight: 700;">/' => '<h3 class="text-[1.1rem] text-slate-700 mb-1.5 font-bold">',
    
    '/<p style="color: #64748b; font-size: 0\.9rem; margin: 0;">/' => '<p class="text-slate-500 text-[0.9rem] m-0">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done home-partials news-events" . PHP_EOL;