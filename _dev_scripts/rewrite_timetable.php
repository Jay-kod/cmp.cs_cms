<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/timetable.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div class="timetable-section" style="margin: 3rem 0;">/' => '<div class="timetable-section my-12">',
    
    '/<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1\.5rem;">/' => '<div class="flex justify-between items-center mb-6">',
    
    '/<h2 style="font-size: 1\.5rem; color: #0f172a; font-family: var\(--font-heading\); font-weight: 800; margin: 0;">/' => '<h2 class="text-[1.5rem] text-slate-900 font-heading font-extrabold m-0">',
    
    '/<a href="\{\{ url\(\'\/resources\'\) \}\}" class="btn btn-primary" style="background: var\(--color-primary\); color: white; padding: 0\.6rem 1\.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0\.4rem; transition: all 0\.2s;" onmouseover="this\.style\.transform=\'translateY\(-2px\)\'" onmouseout="this\.style\.transform=\'translateY\(0\)\'">' => '<a href="{{ url(\'/resources\') }}" class="btn btn-primary bg-[color:var(--color-primary)] text-white py-[0.6rem] px-[1.2rem] rounded-lg no-underline font-semibold flex items-center gap-1.5 transition-all duration-200 hover:-translate-y-[2px]">',
    
    '/<div style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba\(0,0,0,0\.03\); padding: 0; border: 1px solid #f1f5f9; overflow: hidden;">/' => '<div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-0 border border-slate-100 overflow-hidden">',
    
    '/<div class="tt-responsive-grid" style="padding: 2\.5rem; border-bottom: 1px solid #cbd5e1; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; background: #e2e8f0; align-items: start;">/' => '<div class="tt-responsive-grid p-10 border-b border-slate-300 grid grid-cols-2 gap-12 bg-slate-200 items-start max-md:grid-cols-1 max-md:p-6">',
    
    '/<div style="display: flex; align-items: flex-start; gap: 1\.2rem; margin-bottom: 1\.5rem;">/' => '<div class="flex items-start gap-5 mb-6">',
    
    '/<div class="tt-icon" style="width: 56px; height: 56px; background: linear-gradient\(135deg, rgba\(22, 163, 74, 0\.1\) 0%, rgba\(22, 163, 74, 0\.05\) 100%\); color: var\(--color-primary\); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1\.6rem; flex-shrink: 0; border: 1px solid rgba\(22, 163, 74, 0\.2\);">/' => '<div class="tt-icon w-14 h-14 bg-gradient-to-br from-green-600/10 to-green-600/5 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.6rem] shrink-0 border border-green-600/20">',
    
    '/<span style="display: inline-block; background: #fee2e2; color: #b91c1c; font-size: 0\.65rem; font-weight: 800; padding: 0\.2rem 0\.6rem; border-radius: 4px; margin-bottom: 0\.4rem; letter-spacing: 0\.5px;">/' => '<span class="inline-block bg-red-100 text-red-700 text-[0.65rem] font-extrabold py-1 px-2.5 rounded mb-1.5 tracking-[0.5px]">',
    
    '/<h4 style="margin: 0 0 0\.5rem; font-size: 1\.3rem; color: #1e293b; font-weight: 800; line-height: 1\.3;">/' => '<h4 class="m-0 mb-2 text-[1.3rem] text-slate-800 font-extrabold leading-[1.3]">',
    
    '/<p style="margin: 0; font-size: 0\.85rem; color: #64748b; display: flex; align-items: center; gap: 0\.4rem;">/' => '<p class="m-0 text-[0.85rem] text-slate-500 flex items-center gap-1.5">',
    
    '/<i class="fa-solid fa-circle-check" style="color: #22c55e;"><\/i>/' => '<i class="fa-solid fa-circle-check text-green-500"></i>',
    
    '/<p style="font-size: 1rem; color: #475569; margin: 0 0 2rem; line-height: 1\.6;">/' => '<p class="text-[1rem] text-slate-600 m-0 mb-8 leading-[1.6]">',
    
    '/<div style="display: flex; gap: 1rem; flex-wrap: wrap;">/' => '<div class="flex gap-4 flex-wrap">',
    
    '/<a href="\{\{ Storage::disk\(\'public\'\)->url\(\$uploadedTimetable\) \}\}" target="_blank" class="btn btn-primary" style="display: inline-flex; align-items: center; justify-content: center; gap: 0\.6rem; background: var\(--color-primary\); color: white; text-decoration: none; padding: 0\.8rem 1\.5rem; border-radius: 8px; font-weight: 700; font-size: 0\.95rem; border: none; transition: all 0\.3s; box-shadow: 0 4px 10px rgba\(22, 163, 74, 0\.2\);" onmouseover="this\.style\.boxShadow=\'0 6px 15px rgba\(22, 163, 74, 0\.3\)\'; this\.style\.transform=\'translateY\(-2px\)\';" onmouseout="this\.style\.boxShadow=\'0 4px 10px rgba\(22, 163, 74, 0\.2\)\'; this\.style\.transform=\'translateY\(0\)\';">/' => '<a href="{{ Storage::disk(\'public\')->url($uploadedTimetable) }}" target="_blank" class="btn btn-primary inline-flex items-center justify-center gap-2.5 bg-[color:var(--color-primary)] text-white no-underline py-[0.8rem] px-6 rounded-lg font-bold text-[0.95rem] border-none transition-all duration-300 shadow-[0_4px_10px_rgba(22,163,74,0.2)] hover:shadow-[0_6px_15px_rgba(22,163,74,0.3)] hover:-translate-y-[2px]">',
    
    '/<a href="\{\{ url\(\'\/resources\'\) \}\}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0\.8rem 1\.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0\.95rem; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 0\.5rem; transition: all 0\.2s;" onmouseover="this\.style\.background=\'#f1f5f9\'; this\.style\.color=\'#1e293b\';" onmouseout="this\.style\.background=\'white\'; this\.style\.color=\'#475569\';">/' => '<a href="{{ url(\'/resources\') }}" class="btn btn-secondary bg-white text-slate-600 py-[0.8rem] px-6 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center gap-2 transition-all duration-200 hover:bg-slate-100 hover:text-slate-800">',
    
    '/<div style="background: white; border-radius: 12px; padding: 1rem; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: center; min-height: 250px; background-clip: padding-box; box-shadow: 0 4px 12px rgba\(0,0,0,0\.03\);">/' => '<div class="bg-white rounded-xl p-4 border border-dashed border-slate-300 flex items-center justify-center min-h-[250px] bg-clip-padding shadow-[0_4px_12px_rgba(0,0,0,0.03)]">',
    
    '/<img src="\{\{ Storage::disk\(\'public\'\)->url\(\$uploadedTimetable\) \}\}" alt="Timetable Preview" style="max-width: 100%; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 15px rgba\(0,0,0,0\.05\); object-fit: contain; cursor: pointer; transition: transform 0\.3s;" onmouseover="this\.style\.transform=\'scale\(1\.02\)\'" onmouseout="this\.style\.transform=\'scale\(1\)\'">/' => '<img src="{{ Storage::disk(\'public\')->url($uploadedTimetable) }}" alt="Timetable Preview" class="max-w-full max-h-[400px] rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.05)] object-contain cursor-pointer transition-transform duration-300 hover:scale-[1.02]">',
    
    '/<iframe src="\{\{ Storage::disk\(\'public\'\)->url\(\$uploadedTimetable\) \}\}#toolbar=0" style="width: 100%; height: 400px; border: none; border-radius: 8px; box-shadow: 0 4px 15px rgba\(0,0,0,0\.05\);"><\/iframe>/' => '<iframe src="{{ Storage::disk(\'public\')->url($uploadedTimetable) }}#toolbar=0" class="w-full h-[400px] border-none rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.05)]"></iframe>',
    
    '/<div style="text-align: center; color: #64748b; padding: 2rem;">/' => '<div class="text-center text-slate-500 py-8">',
    
    '/<i class="fa-solid fa-file-csv" style="font-size: 3rem; margin-bottom: 1rem; color: #94a3b8;"><\/i>/' => '<i class="fa-solid fa-file-csv text-[3rem] mb-4 text-slate-400"></i>',
    
    '/<p style="margin: 0; font-weight: 600; font-size: 1\.1rem;">/' => '<p class="m-0 font-semibold text-[1.1rem]">',
    
    '/<div style="display: grid; grid-template-columns: repeat\(auto-fill, minmax\(320px, 1fr\)\); gap: 0;">/' => '<div class="grid grid-cols-[repeat(auto-fill,minmax(320px,1fr))] gap-0">',
    
    '/<div style="padding: 2rem; border-right: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; display: flex; flex-direction: column; transition: all 0\.3s ease; position: relative; background: white;" onmouseover="this\.style\.background=\'#f8fafc\'; this\.querySelector\(\'\.tt-download\'\)\.style\.background=\'var\(--color-primary\)\'; this\.querySelector\(\'\.tt-download\'\)\.style\.color=\'white\'; this\.querySelector\(\'\.tt-icon\'\)\.style\.transform=\'scale\(1\.1\)\';" onmouseout="this\.style\.background=\'white\'; this\.querySelector\(\'\.tt-download\'\)\.style\.background=\'#f1f5f9\'; this\.querySelector\(\'\.tt-download\'\)\.style\.color=\'#334155\'; this\.querySelector\(\'\.tt-icon\'\)\.style\.transform=\'scale\(1\)\';">/' => '<div class="group p-8 border-r border-b border-slate-100 flex flex-col transition-all duration-300 relative bg-white hover:bg-slate-50">',
    
    '/<div style="display: flex; align-items: flex-start; gap: 1\.2rem; margin-bottom: 1\.2rem;">/' => '<div class="flex items-start gap-5 mb-5">',
    
    '/<div class="tt-icon" style="width: 50px; height: 50px; background: linear-gradient\(135deg, rgba\(22, 163, 74, 0\.1\) 0%, rgba\(22, 163, 74, 0\.05\) 100%\); color: var\(--color-primary\); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1\.5rem; flex-shrink: 0; transition: transform 0\.3s ease; border: 1px solid rgba\(22, 163, 74, 0\.2\);">/' => '<div class="tt-icon w-[50px] h-[50px] bg-gradient-to-br from-green-600/10 to-green-600/5 text-[color:var(--color-primary)] rounded-xl flex items-center justify-center text-[1.5rem] shrink-0 transition-transform duration-300 border border-green-600/20 group-hover:scale-110">',
    
    '/<h4 style="margin: 0 0 0\.4rem; font-size: 1\.1rem; color: #1e293b; font-weight: 800; line-height: 1\.3;">/' => '<h4 class="m-0 mb-1.5 text-[1.1rem] text-slate-800 font-extrabold leading-[1.3]">',
    
    '/<p style="margin: 0; font-size: 0\.82rem; color: #64748b; display: flex; align-items: center; gap: 0\.4rem;">/' => '<p class="m-0 text-[0.82rem] text-slate-500 flex items-center gap-1.5">',
    
    '/<p style="font-size: 0\.9rem; color: #475569; margin: 0 0 1\.5rem; line-height: 1\.6; flex-grow: 1;">/' => '<p class="text-[0.9rem] text-slate-600 m-0 mb-6 leading-[1.6] grow">',
    
    '/<div style="flex-grow: 1; margin-bottom: 1\.5rem;"><\/div>/' => '<div class="grow mb-6"></div>',
    
    '/<a href="\{\{ Storage::disk\(\'public\'\)->url\(\$timetable->file_path\) \}\}" target="_blank" class="tt-download" style="display: inline-flex; align-items: center; justify-content: center; gap: 0\.6rem; background: #f1f5f9; color: #334155; text-decoration: none; padding: 0\.8rem 1\.2rem; border-radius: 8px; font-weight: 700; font-size: 0\.9rem; transition: all 0\.3s;">/' => '<a href="{{ Storage::disk(\'public\')->url($timetable->file_path) }}" target="_blank" class="tt-download inline-flex items-center justify-center gap-2.5 bg-slate-100 text-slate-700 no-underline py-[0.8rem] px-[1.2rem] rounded-lg font-bold text-[0.9rem] transition-all duration-300 group-hover:bg-[color:var(--color-primary)] group-hover:text-white">',
    
    '/<div style="padding: 1\.5rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; text-align: right;">/' => '<div class="py-6 px-8 bg-slate-50 border-t border-slate-100 text-right">',
    
    '/<a href="\{\{ url\(\'\/resources\'\) \}\}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0\.6rem 1\.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0\.95rem; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 0\.5rem; transition: all 0\.2s; box-shadow: 0 2px 4px rgba\(0,0,0,0\.02\);" onmouseover="this\.style\.background=\'#f1f5f9\'; this\.style\.color=\'#1e293b\';" onmouseout="this\.style\.background=\'white\'; this\.style\.color=\'#475569\';">/' => '<a href="{{ url(\'/resources\') }}" class="btn btn-secondary bg-white text-slate-600 py-[0.6rem] px-6 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center gap-2 transition-all duration-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)] hover:bg-slate-100 hover:text-slate-800">',
    
    '/<a href="\{\{ url\(\'\/resources\'\) \}\}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0\.6rem 1\.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0\.95rem; border: 1px solid #cbd5e1; display: inline-flex; rgba\(0,0,0,0\.02\);" onmouseover="this\.style\.background=\'#f1f5f9\'; this\.style\.color=\'#1e293b\';" onmouseout="this\.style\.background=\'white\'; this\.style\.color=\'#475569\';">/' => '<a href="{{ url(\'/resources\') }}" class="btn btn-secondary bg-white text-slate-600 py-[0.6rem] px-6 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center gap-2 transition-all duration-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)] hover:bg-slate-100 hover:text-slate-800">',
    
    '/<div style="text-align: center; padding: 4rem 2rem;">/' => '<div class="text-center py-16 px-8">',
    
    '/<div style="width: 80px; height: 80px; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1\.5rem; color: #cbd5e1; font-size: 2\.5rem; box-shadow: 0 4px 10px rgba\(0,0,0,0\.02\);">/' => '<div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300 text-[2.5rem] shadow-[0_4px_10px_rgba(0,0,0,0.02)]">',
    
    '/<h3 style="margin: 0 0 0\.5rem; color: #1e293b; font-size: 1\.3rem; font-weight: 800;">/' => '<h3 class="m-0 mb-2 text-slate-800 text-[1.3rem] font-extrabold">',
    
    '/<p style="margin: 0 auto; color: #64748b; font-size: 1rem; text-align: center; max-width: 600px;">/' => '<p class="mx-auto my-0 text-slate-500 text-[1rem] text-center max-w-[600px]">',
    
    '/<div style="margin-top: 2rem;">/' => '<div class="mt-8">',
    
    '/<a href="\{\{ url\(\'\/resources\'\) \}\}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0\.8rem 1\.8rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0\.95rem; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 0\.5rem; transition: all 0\.2s;" onmouseover="this\.style\.background=\'#f8fafc\'; this\.style\.color=\'#1e293b\';" onmouseout="this\.style\.background=\'white\'; this\.style\.color=\'#475569\';">/' => '<a href="{{ url(\'/resources\') }}" class="btn btn-secondary bg-white text-slate-600 py-3 px-7 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center gap-2 transition-all duration-200 hover:bg-slate-50 hover:text-slate-800">'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done timetable replacements";