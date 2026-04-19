<?php
$file = __DIR__ . '/../resources/views/pages/events.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<section data-aos="fade-up" style="background: linear-gradient\(135deg, #0f172a 0%, #1e293b 100%\); padding: 4rem 0; color: white; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">/' 
    => '<section data-aos="fade-up" class="bg-gradient-to-br from-slate-900 to-slate-800 py-10 sm:py-16 text-white text-center flex flex-col items-center justify-center">',

    '/<div class="container" data-aos="fade-up" style="display: flex; flex-direction: column; align-items: center;">/' 
    => '<div class="container flex flex-col items-center" data-aos="fade-up">',

    '/<span style="display: inline-block; background: rgba\(22,163,74,0\.2\); color: var\(--color-primary\); padding: 0\.35rem 1rem; border-radius: 50px; font-size: 0\.85rem; font-weight: 600; margin-bottom: 1rem; border: 1px solid rgba\(22,163,74,0\.3\);">/' 
    => '<span class="inline-block bg-green-600/20 text-[color:var(--color-primary)] py-[0.35rem] px-4 rounded-full text-[0.85rem] font-semibold mb-4 border border-green-600/30">',

    '/<h1 style="font-family: var\(--font-heading\); font-size: 2\.5rem; font-weight: 700; margin: 0;">Events Calendar<\/h1>/' 
    => '<h1 class="font-heading text-[1.35rem] sm:text-[1.6rem] md:text-[2.5rem] font-bold m-0">Events Calendar</h1>',

    '/<p style="color: #94a3b8; font-size: 1\.1rem; margin-top: 0\.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">/' 
    => '<p class="text-slate-400 text-[0.92rem] sm:text-[1.1rem] mt-2 max-w-[600px] mx-auto">',

    '/<section data-aos="fade-up" style="padding: 2rem 0 0;">/' 
    => '<section data-aos="fade-up" class="pt-8">',

    '/<div id="events-search-bar" style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1rem 1\.5rem; display: flex; flex-wrap: wrap; gap: 0\.8rem; align-items: center; box-shadow: 0 4px 16px rgba\(0,0,0,0\.04\);">/' 
    => '<div id="events-search-bar" class="bg-white border border-slate-200 rounded-[14px] p-[0.8rem] px-4 sm:p-4 sm:px-6 flex flex-wrap gap-[0.6rem] sm:gap-[0.8rem] items-center shadow-[0_4px_16px_rgba(0,0,0,0.04)]">',

    '/<div style="flex: 1; min-width: 200px; position: relative;">/' 
    => '<div class="flex-1 min-w-0 sm:min-w-[200px] relative">',

    '/<i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY\(-50%\); color: #94a3b8; font-size: 0\.85rem;"><\/i>/' 
    => '<i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[0.85rem]"></i>',

    '/<input type="text" id="event-search-input" placeholder="Search events by title or location\.\.\." style="width: 100%; padding: 0\.6rem 0\.8rem 0\.6rem 2\.2rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0\.9rem; outline: none; transition: border-color 0\.2s; background: #f8fafc;" onfocus="this\.style\.borderColor=\'var\(--color-primary\)\'" onblur="this\.style\.borderColor=\'#e2e8f0\'">/' 
    => '<input type="text" id="event-search-input" placeholder="Search events by title or location..." class="w-full py-[0.6rem] pr-[0.8rem] pl-[2.2rem] border border-slate-200 rounded-lg text-[0.9rem] outline-none transition-colors duration-200 bg-slate-50 focus:border-[color:var(--color-primary)]">',

    '/<select id="event-time-filter" style="padding: 0\.6rem 1rem; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 0\.9rem; background: #f8fafc; color: #334155; cursor: pointer; outline: none;">/' 
    => '<select id="event-time-filter" class="py-[0.6rem] px-4 border border-slate-200 rounded-lg text-[0.9rem] bg-slate-50 text-slate-700 cursor-pointer outline-none">',

    '/<span id="event-result-count" style="font-size: 0\.8rem; color: #64748b; font-weight: 500; padding: 0\.4rem 0\.8rem; background: #f1f5f9; border-radius: 20px; white-space: nowrap;"><\/span>/' 
    => '<span id="event-result-count" class="text-[0.8rem] text-slate-500 font-medium py-[0.4rem] px-[0.8rem] bg-slate-100 rounded-full whitespace-nowrap"></span>',

    '/<section data-aos="fade-up" id="upcoming-section" style="padding: 3rem 0;">/' 
    => '<section data-aos="fade-up" id="upcoming-section" class="py-8 sm:py-12">',

    '/<h2 style="font-family: var\(--font-heading\); font-size: 1\.5rem; font-weight: 700; margin: 0 0 1\.5rem; display: flex; align-items: center; gap: 0\.6rem;">/' 
    => '<h2 class="font-heading text-[1.5rem] font-bold m-0 mb-6 flex items-center gap-[0.6rem]">',

    '/<i class="fa-solid fa-clock" style="color: var\(--color-primary\); font-size: 1\.2rem;"><\/i>/' 
    => '<i class="fa-solid fa-clock text-[color:var(--color-primary)] text-[1.2rem]"></i>',

    '/<div id="upcoming-grid" style="display: grid; grid-template-columns: repeat\(auto-fill, minmax\(340px, 1fr\)\); gap: 1\.5rem;">/' 
    => '<div id="upcoming-grid" class="grid grid-cols-1 sm:grid-cols-[repeat(auto-fill,minmax(340px,1fr))] gap-6">',

    '/<div data-aos="fade-up" class="event-card" data-type="upcoming" data-title="\{\{ strtolower\(\$event->title\) \}\}" data-location="\{\{ strtolower\(\$event->location \?\? \'\'\) \}\}" style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; transition: all 0\.3s; box-shadow: 0 2px 10px rgba\(0,0,0,0\.03\);" onmouseover="this\.style\.transform=\'translateY\(-4px\)\'; this\.style\.boxShadow=\'0 10px 30px rgba\(0,0,0,0\.08\)\'" onmouseout="this\.style\.transform=\'\'; this\.style\.boxShadow=\'0 2px 10px rgba\(0,0,0,0\.03\)\'">/' 
    => '<div data-aos="fade-up" class="event-card group bg-white border border-slate-200 rounded-2xl overflow-hidden transition-all duration-300 shadow-[0_2px_10px_rgba(0,0,0,0.03)] hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(0,0,0,0.08)]" data-type="upcoming" data-title="{{ strtolower($event->title) }}" data-location="{{ strtolower($event->location ?? \'\') }}">',

    '/<div style="display: flex; gap: 1rem; padding: 1\.5rem;">/' 
    => '<div class="flex gap-4 p-4 md:p-6">',

    '/<div style="min-width: 60px; text-align: center; flex-shrink: 0;">/' 
    => '<div class="min-w-[60px] text-center shrink-0">',

    '/<div style="background: var\(--color-primary\); color: white; font-size: 0\.7rem; font-weight: 700; text-transform: uppercase; padding: 4px 0; border-radius: 8px 8px 0 0;">/' 
    => '<div class="bg-[color:var(--color-primary)] text-white text-[0.7rem] font-bold uppercase py-1 px-0 rounded-t-lg">',

    '/<div style="background: #f1f5f9; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 8px 8px; padding: 6px 0; font-size: 1\.5rem; font-weight: 800; color: #0f172a;">/' 
    => '<div class="bg-slate-100 border border-slate-200 border-t-0 rounded-b-lg py-1.5 px-0 text-[1.5rem] font-extrabold text-slate-900">',

    '/<div style="flex: 1; min-width: 0;">/' 
    => '<div class="flex-1 min-w-0">',

    '/<h3 style="margin: 0 0 0\.4rem; font-size: 1\.05rem; font-weight: 700; color: #0f172a;">/' 
    => '<h3 class="m-0 mb-1.5 text-[1.05rem] font-bold text-slate-900">',

    '/<div style="display: flex; flex-wrap: wrap; gap: 0\.8rem; font-size: 0\.85rem; color: #64748b;">/' 
    => '<div class="flex flex-wrap gap-[0.8rem] text-[0.85rem] text-slate-500">',

    '/<p style="margin: 0\.6rem 0 0; font-size: 0\.9rem; color: #475569; line-height: 1\.6;">/' 
    => '<p class="mt-[0.6rem] m-0 text-[0.9rem] text-slate-600 leading-[1.6]">',

    '/<section data-aos="fade-up" id="past-section" style="padding: 3rem 0; background: #f8fafc;">/' 
    => '<section data-aos="fade-up" id="past-section" class="py-8 sm:py-12 bg-slate-50">',

    '/<i class="fa-solid fa-clock-rotate-left" style="color: #64748b; font-size: 1\.2rem;"><\/i>/' 
    => '<i class="fa-solid fa-clock-rotate-left text-slate-500 text-[1.2rem]"></i>',

    '/<div id="past-grid" style="display: grid; grid-template-columns: repeat\(auto-fill, minmax\(340px, 1fr\)\); gap: 1\.2rem;">/' 
    => '<div id="past-grid" class="grid grid-cols-1 sm:grid-cols-[repeat(auto-fill,minmax(340px,1fr))] gap-[1.2rem]">',

    '/<div data-aos="fade-up" class="event-card" data-type="past" data-title="\{\{ strtolower\(\$event->title\) \}\}" data-location="\{\{ strtolower\(\$event->location \?\? \'\'\) \}\}" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1\.2rem; display: flex; gap: 1rem; align-items: flex-start; opacity: 0\.85;">/' 
    => '<div data-aos="fade-up" class="event-card group bg-white border border-slate-200 rounded-xl p-[1.2rem] flex gap-4 items-start opacity-85 hover:opacity-100 transition-opacity" data-type="past" data-title="{{ strtolower($event->title) }}" data-location="{{ strtolower($event->location ?? \'\') }}">',

    '/<div style="min-width: 50px; text-align: center; flex-shrink: 0;">/' 
    => '<div class="min-w-[50px] text-center shrink-0">',

    '/<div style="background: #64748b; color: white; font-size: 0\.65rem; font-weight: 700; text-transform: uppercase; padding: 3px 0; border-radius: 6px 6px 0 0;">/' 
    => '<div class="bg-slate-500 text-white text-[0.65rem] font-bold uppercase py-[3px] px-0 rounded-t-md">',

    '/<div style="background: #f1f5f9; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 6px 6px; padding: 4px 0; font-size: 1\.2rem; font-weight: 700; color: #475569;">/' 
    => '<div class="bg-slate-100 border border-slate-200 border-t-0 rounded-b-md py-1 px-0 text-[1.2rem] font-bold text-slate-600">',

    '/<h4 style="margin: 0 0 0\.2rem; font-size: 0\.95rem; font-weight: 600; color: #334155;">/' 
    => '<h4 class="m-0 mb-1 text-[0.95rem] font-semibold text-slate-700">',

    '/<span style="font-size: 0\.8rem; color: #94a3b8;">/' 
    => '<span class="text-[0.8rem] text-slate-400">',

    '/<div style="margin-top: 2rem; display: flex; justify-content: center;">/' 
    => '<div class="mt-8 flex justify-center">',

    '/<p style="text-align: center; color: #94a3b8; padding: 2rem;">/' 
    => '<p class="text-center text-slate-400 p-8">',

    '/<div id="no-results-msg" style="display: none; text-align: center; padding: 3rem 2rem;">/' 
    => '<div id="no-results-msg" class="hidden text-center py-12 px-8">',

    '/<i class="fa-solid fa-calendar-xmark" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem; display: block;"><\/i>/' 
    => '<i class="fa-solid fa-calendar-xmark text-[3rem] text-gray-300 mb-4 block"></i>',

    '/<p style="color: #64748b; font-size: 1\.1rem; margin: 0;">/' 
    => '<p class="text-slate-500 text-[1.1rem] m-0">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

// Remove the inline style block
$text = preg_replace('/<style>\s*\/\* Events Page Responsive \*\/(.*?)\s*<\/style>\s*/s', '', $text);

// Clean up inline styles matching from script
$text = preg_replace("/\n\s*card.style.display = show \? '' : 'none';/", "\n            card.style.display = show ? '' : 'none';", $text);


file_put_contents($file, $text);
echo "Done events.blade.php pt1" . PHP_EOL;