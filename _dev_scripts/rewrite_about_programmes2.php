<?php
$file = __DIR__ . '/../resources/views/pages/about-partials/programmes.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">Ph\.D\. Computer Science<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">Ph.D. Computer Science</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">M\.Phil\.\/Ph\.D\. Computer Science<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">M.Phil./Ph.D. Computer Science</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">M\.Sc\. Computer Science<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">M.Sc. Computer Science</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">M\.Sc\. \(Database\/Info Systems\)<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">M.Sc. (Database/Info Systems)</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">M\.Sc\. \(Information Security\)<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">M.Sc. (Information Security)</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">M\.Sc\. \(Networking\)<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">M.Sc. (Networking)</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">M\.Sc\. \(Software Engineering\)<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">M.Sc. (Software Engineering)</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: #10b981; margin-top: 5px;"><\/i> <span style="flex: 1;">PGD Computer Science<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-300"><i class="fa-solid fa-chevron-right text-[0.55rem] text-emerald-500 mt-[5px]"></i> <span class="flex-1">PGD Computer Science</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #334155;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: var\(--color-primary\); margin-top: 5px;"><\/i> <span style="flex: 1;">B\.Sc\. Computer Science<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-700"><i class="fa-solid fa-chevron-right text-[0.55rem] text-[color:var(--color-primary)] mt-[5px]"></i> <span class="flex-1">B.Sc. Computer Science</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #334155;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: var\(--color-primary\); margin-top: 5px;"><\/i> <span style="flex: 1;">B\.Sc\. Network Technology & Cybersecurity<\/span> <span style="font-size: 0\.65rem; background: #dcfce7; color: #16a34a; padding: 0\.1rem 0\.4rem; border-radius: 4px; font-weight: 600; white-space: nowrap;">Lincoln Uni<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-700"><i class="fa-solid fa-chevron-right text-[0.55rem] text-[color:var(--color-primary)] mt-[5px]"></i> <span class="flex-1">B.Sc. Network Technology & Cybersecurity</span> <span class="text-[0.65rem] bg-green-100 text-green-600 py-[0.1rem] px-[0.4rem] rounded font-semibold whitespace-nowrap">Lincoln Uni</span></li>',
    
    '/<li style="display: flex; align-items: start; gap: 0\.5rem; font-size: 0\.9rem; color: #334155;"><i class="fa-solid fa-chevron-right" style="font-size: 0\.55rem; color: var\(--color-primary\); margin-top: 5px;"><\/i> <span style="flex: 1;">B\.Sc\. Software Engineering<\/span> <span style="font-size: 0\.65rem; background: #dcfce7; color: #16a34a; padding: 0\.1rem 0\.4rem; border-radius: 4px; font-weight: 600; white-space: nowrap;">Lincoln Uni<\/span><\/li>/' => '<li class="flex items-start gap-2 text-[0.9rem] text-slate-700"><i class="fa-solid fa-chevron-right text-[0.55rem] text-[color:var(--color-primary)] mt-[5px]"></i> <span class="flex-1">B.Sc. Software Engineering</span> <span class="text-[0.65rem] bg-green-100 text-green-600 py-[0.1rem] px-[0.4rem] rounded font-semibold whitespace-nowrap">Lincoln Uni</span></li>'
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done about-partials programmes replacements" . PHP_EOL;