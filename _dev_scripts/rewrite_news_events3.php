<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/news-events.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" style="padding: 6rem 0; background: white; position: relative;">/' => '<section data-aos="fade-up" class="py-24 bg-white relative">',
    
    '/<div class="news-events-split" style="display: grid; grid-template-columns: 1fr 400px; gap: 4rem; align-items: start;">/' => '<div class="news-events-split grid grid-cols-[1fr_400px] gap-16 items-start">',
    
    '/<div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2\.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">/' => '<div class="flex justify-between items-end mb-10 border-b-2 border-slate-100 pb-4">',
    
    '/<span style="display: inline-block; color: var\(--color-primary\); font-size: 0\.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; margin-bottom: 0\.5rem; background: rgba\(59,130,246,0\.1\); padding: 0\.3rem 1rem; border-radius: 20px;">/' => '<span class="inline-block text-[color:var(--color-primary)] text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-2 bg-blue-500/10 py-[0.3rem] px-4 rounded-full">',
    
    '/<h2 style="margin: 0; font-size: 2\.4rem; font-family: var\(--font-heading\); font-weight: 800; color: #0f172a;">/' => '<h2 class="m-0 text-[2.4rem] font-heading font-extrabold text-slate-900">',
    
    '/<a href="\{\{ url\(\'\/research-news\'\) \}\}" style="background: white; color: var\(--color-primary\); padding: 0\.6rem 1\.2rem; border-radius: 8px; font-size: 0\.9rem; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0\.2s; display: inline-flex; align-items: center; gap: 0\.5rem;" onmouseover="this\.style\.background=\'var\(--color-primary\)\'; this\.style\.color=\'white\'; this\.style\.borderColor=\'var\(--color-primary\)\'" onmouseout="this\.style\.background=\'white\'; this\.style\.color=\'var\(--color-primary\)\'; this\.style\.borderColor=\'#e2e8f0\'">/' => '<a href="{{ url(\'/research-news\') }}" class="btn-outline bg-white text-[color:var(--color-primary)] py-[0.6rem] px-[1.2rem] rounded-lg text-[0.9rem] font-semibold no-underline border border-slate-200 transition-all duration-200 inline-flex items-center gap-2 hover:bg-[color:var(--color-primary)] hover:text-white hover:border-[color:var(--color-primary)]">',
    
    '/<div style="display: flex; flex-direction: column; gap: 1\.5rem;">/' => '<div class="flex flex-col gap-6">',
    
    '/<a href="\{\{ route\(\'research-news\.show\', \$item->slug\) \}\}" class="news-card" style="display: flex; gap: 1\.5rem; padding: 1\.2rem; text-decoration: none; border-radius: 16px; transition: background 0\.2s;" onmouseover="this\.style\.background=\'#f8fafc\'" onmouseout="this\.style\.background=\'transparent\'">/' => '<a href="{{ route(\'research-news.show\', $item->slug) }}" class="news-card flex gap-6 p-[1.2rem] no-underline rounded-2xl transition-colors duration-200 hover:bg-slate-50">',
    
    '/<div style="width: 140px; height: 120px; flex-shrink: 0; border-radius: 12px; overflow: hidden; background: #e2e8f0; position: relative;">/' => '<div class="w-[140px] h-[120px] shrink-0 rounded-xl overflow-hidden bg-slate-200 relative">',
    
    '/<img src="\{\{ asset\(\'storage\/\'\.\$item->featured_image\) \}\}" alt="" style="width:100%; height:100%; object-fit:cover; transition: transform 0\.5s;" class="news-img">/' => '<img src="{{ asset(\'storage/\'.$item->featured_image) }}" alt="" class="news-img w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">',
    
    '/<div style="width: 140px; height: 120px; flex-shrink: 0; border-radius: 12px; background: linear-gradient\(135deg, rgba\(59,130,246,0\.1\), rgba\(99,102,241,0\.1\)\); display: flex; align-items: center; justify-content: center; color: var\(--color-primary\); font-size: 2\.5rem;">/' => '<div class="w-[140px] h-[120px] shrink-0 rounded-xl bg-gradient-to-br from-blue-500/10 to-indigo-500/10 flex items-center justify-center text-[color:var(--color-primary)] text-[2.5rem]">',
    
    '/<div style="flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: center;">/' => '<div class="flex-1 min-w-0 flex flex-col justify-center">',
    
    '/<div style="display: flex; align-items: center; gap: 0\.8rem; margin-bottom: 0\.5rem;">/' => '<div class="flex items-center gap-[0.8rem] mb-2">',
    
    '/<span style="font-size: 0\.75rem; color: #0284c7; background: #e0f2fe; padding: 0\.2rem 0\.6rem; border-radius: 4px; text-transform: uppercase; font-weight: 700; letter-spacing: 0\.5px;">/' => '<span class="text-[0.75rem] text-sky-600 bg-sky-100 py-[0.2rem] px-[0.6rem] rounded uppercase font-bold tracking-[0.5px]">',
    
    '/<span style="font-size: 0\.85rem; color: #94a3b8;"><i class="fa-regular fa-calendar" style="margin-right: 4px;"><\/i> \{\{ \\\\Carbon\\\\Carbon::parse\(\$item->published_at\)->format\(\'M d, Y\'\) \}\}<\/span>/' => '<span class="text-[0.85rem] text-slate-400"><i class="fa-regular fa-calendar mr-1"></i> {{ \\Carbon\\Carbon::parse($item->published_at)->format(\'M d, Y\') }}</span>',
    
    '/<h3 style="font-size: 1\.2rem; margin: 0 0 0\.5rem 0; line-height: 1\.4; color: #0f172a; font-family: var\(--font-heading\); font-weight: 700; transition: color 0\.2s;" class="news-title">/' => '<h3 class="text-[1.2rem] m-0 mb-2 leading-[1.4] text-slate-900 font-heading font-bold transition-colors duration-200 news-title">',
    
    '/<p style="font-size: 0\.95rem; color: #64748b; margin: 0; line-height: 1\.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">/' => '<p class="text-[0.95rem] text-slate-500 m-0 leading-[1.6] line-clamp-2">',
    
    '/<div style="text-align: center; padding: 4rem 2rem; background: #f8fafc; border-radius: 16px; color: #94a3b8; border: 1px dashed #cbd5e1;">/' => '<div class="text-center py-16 px-8 bg-slate-50 rounded-2xl text-slate-400 border border-dashed border-slate-300">',
    
    '/<i class="fa-solid fa-newspaper" style="font-size: 2\.5rem; margin-bottom: 1rem; display: block; color: #cbd5e1;"><\/i>/' => '<i class="fa-solid fa-newspaper text-[2.5rem] mb-4 block text-slate-300"></i>',
    
    '/<p style="margin: 0; font-size: 1\.1rem; color: #64748b;">/' => '<p class="m-0 text-[1.1rem] text-slate-500">',
    
    '/<div style="margin-bottom: 2\.5rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 1rem;">/' => '<div class="mb-10 border-b-2 border-slate-100 pb-4">',
    
    '/<span style="display: inline-block; color: var\(--color-primary\); font-size: 0\.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1\.5px; margin-bottom: 0\.5rem;">/' => '<span class="inline-block text-[color:var(--color-primary)] text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-2">',
    
    '/<div style="background: #f8fafc; border-radius: 16px; padding: 2rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden;">/' => '<div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 relative overflow-hidden">',
    
    '/<div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient\(90deg, var\(--color-primary\), var\(--color-secondary\)\);"><\/div>/' => '<div class="absolute top-0 left-0 right-0 h-[5px] bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-secondary)]"></div>',
    
    '/<div data-aos="fade-up" style="display: flex; gap: 1\.2rem; margin-bottom: 1\.5rem; padding-bottom: 1\.5rem; border-bottom: 1px solid #e2e8f0;" class="event-item">/' => '<div data-aos="fade-up" class="event-item flex gap-[1.2rem] mb-6 pb-6 border-b border-slate-200">',
    
    '/<div style="text-align: center; min-width: 65px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; padding: 0\.4rem 0; box-shadow: 0 4px 6px -1px rgba\(0,0,0,0\.05\); overflow: hidden; display: flex; flex-direction: column;">/' => '<div class="text-center min-w-[65px] bg-white border border-slate-200 rounded-[10px] py-[0.4rem] px-0 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col">',
    
    '/<span style="display: block; font-size: 0\.75rem; text-transform: uppercase; font-weight: 700; color: white; background: var\(--color-primary\); padding: 0\.2rem 0;">/' => '<span class="block text-[0.75rem] uppercase font-bold text-white bg-[color:var(--color-primary)] py-[0.2rem] px-0">',
    
    '/<span style="display: block; font-size: 1\.8rem; font-weight: 800; line-height: 1; margin-top: 0\.4rem; color: #0f172a; font-family: var\(--font-heading\);">/' => '<span class="block text-[1.8rem] font-extrabold leading-none mt-1.5 text-slate-900 font-heading">',
    
    '/<div style="flex: 1;">/' => '<div class="flex-1">',
    
    '/<h4 style="font-size: 1\.1rem; margin: 0 0 0\.4rem 0; color: #0f172a; font-weight: 700; font-family: var\(--font-heading\); line-height: 1\.3;">/' => '<h4 class="text-[1.1rem] m-0 mb-1.5 text-slate-900 font-bold font-heading leading-[1.3]">',
    
    '/<div style="display: flex; flex-direction: column; gap: 0\.3rem;">/' => '<div class="flex flex-col gap-1">',
    
    '/<p style="font-size: 0\.85rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 0\.5rem;"><i class="fa-regular fa-clock" style="color: var\(--color-primary\);"><\/i> \{\{ \\\\Carbon\\\\Carbon::parse\(\$event->date\)->format\(\'h:i A\'\) \}\}<\/p>/' => '<p class="text-[0.85rem] text-slate-500 m-0 flex items-center gap-2"><i class="fa-regular fa-clock text-[color:var(--color-primary)]"></i> {{ \\Carbon\\Carbon::parse($event->date)->format(\'h:i A\') }}</p>',
    
    '/<p style="font-size: 0\.85rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 0\.5rem;"><i class="fa-solid fa-location-dot" style="color: var\(--color-primary\);"><\/i> \{\{ \$event->venue \}\}<\/p>/' => '<p class="text-[0.85rem] text-slate-500 m-0 flex items-center gap-2"><i class="fa-solid fa-location-dot text-[color:var(--color-primary)]"></i> {{ $event->venue }}</p>',
    
    '/<div style="text-align: center; padding: 2rem 0; color: #94a3b8;">/' => '<div class="text-center py-8 px-0 text-slate-400">',
    
    '/<i class="fa-regular fa-calendar-xmark" style="font-size: 2\.5rem; margin-bottom: 1rem; display: block; color: #cbd5e1;"><\/i>/' => '<i class="fa-regular fa-calendar-xmark text-[2.5rem] mb-4 block text-slate-300"></i>',
    
    '/<p style="margin: 0; font-size: 1\.05rem; color: #64748b;">/' => '<p class="m-0 text-[1.05rem] text-slate-500">',
    
    '/<a href="\{\{ url\(\'\/research-news#events\'\) \}\}" style="display: flex; align-items: center; justify-content: center; gap: 0\.5rem; text-align: center; font-size: 0\.95rem; font-weight: 700; color: var\(--color-primary\); padding-top: 0\.5rem; text-decoration: none; transition: gap 0\.2s;" onmouseover="this\.style\.gap=\'0\.8rem\'" onmouseout="this\.style\.gap=\'0\.5rem\'">/' => '<a href="{{ url(\'/research-news#events\') }}" class="group flex items-center justify-center gap-2 text-center text-[0.95rem] font-bold text-[color:var(--color-primary)] pt-2 no-underline transition-all duration-200 hover:gap-[0.8rem]">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done home-partials news-events pt3" . PHP_EOL;