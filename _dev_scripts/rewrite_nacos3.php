<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/nacos.blade.php';
$text = file_get_contents($file);

$reps = [
    '/<div class="absolute inset-0" style="background: url\(\'data:image\/svg\+xml,<svg xmlns=%22http:\/\/www\.w3\.org\/2000\/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220\.5%22 fill=%22rgba\(255,255,255,0\.03\)%22\/><\/svg>\'\);"><\/div>/' => '<div class="absolute inset-0 bg-[url(\'data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.5%22_fill=%22rgba(255,255,255,0.03)%22/></svg>\')]"></div>',
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

// Handle the dynamic variables in nacos.blade.php
$text = str_replace(
    "\$statusColor = '#94a3b8'; // Default gray\n                                \$dotColor = '#64748b';",
    "\$statusColor = 'text-slate-400'; // Default gray\n                                \$dotColor = 'bg-slate-500 shadow-slate-500';",
    $text
);
$text = str_replace(
    "\$statusColor = '#38bdf8';\n                                      \$dotColor = '#0ea5e9';",
    "\$statusColor = 'text-sky-400';\n                                      \$dotColor = 'bg-sky-500 shadow-sky-500';",
    $text
);
$text = str_replace(
    "\$statusColor = '#fcd34d';\n                                      \$dotColor = '#f59e0b';",
    "\$statusColor = 'text-yellow-300';\n                                      \$dotColor = 'bg-amber-500 shadow-amber-500';",
    $text
);
$text = str_replace(
    "\$statusColor = '#94a3b8';\n                                      \$dotColor = '#64748b';",
    "\$statusColor = 'text-slate-400';\n                                      \$dotColor = 'bg-slate-500 shadow-slate-500';",
    $text
);
$text = str_replace(
    "\$statusColor = '#38bdf8'; // Blue for active\n                                          \$dotColor = '#0ea5e9';",
    "\$statusColor = 'text-sky-400'; // Blue for active\n                                          \$dotColor = 'bg-sky-500 shadow-sky-500';",
    $text
);
$text = str_replace(
    "\$statusColor = '#fcd34d'; // Gold for just graduated\n                                                  \$dotColor = '#f59e0b';",
    "\$statusColor = 'text-yellow-300'; // Gold for just graduated\n                                                  \$dotColor = 'bg-amber-500 shadow-amber-500';",
    $text
);

$reps2 = [
    '/<div class="w-1 h-1 rounded-full" style="background: \{\{ \$dotColor \}\}; box-shadow: 0 0 4px \{\{ \$dotColor \}\};"><\/div>/' => '<div class="w-1 h-1 rounded-full shadow-[0_0_4px] {{ $dotColor }}"></div>',
    '/<p class="text-\[0\.72rem\] font-bold m-0 uppercase tracking-\[0\.5px\] whitespace-nowrap overflow-hidden text-ellipsis drop-shadow-\[0_1px_2px_rgba\(0,0,0,0\.5\)\]" style="color: \{\{ \$statusColor \}\};">/' => '<p class="text-[0.72rem] font-bold m-0 uppercase tracking-[0.5px] whitespace-nowrap overflow-hidden text-ellipsis drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)] {{ $statusColor }}">',
];
foreach ($reps2 as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "nacos final styles fixed";
