<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/timetable.blade.php';
$text = file_get_contents($file);

$reps = [
    '<div style="padding: 2rem; border-right: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; display: flex; flex-direction: column; transition: all 0.3s ease; position: relative; background: white;" onmouseover="this.style.background=\'#f8fafc\'; this.querySelector(\'.tt-download\').style.background=\'var(--color-primary)\'; this.querySelector(\'.tt-download\').style.color=\'white\'; this.querySelector(\'.tt-icon\').style.transform=\'scale(1.1)\';" onmouseout="this.style.background=\'white\'; this.querySelector(\'.tt-download\').style.background=\'#f1f5f9\'; this.querySelector(\'.tt-download\').style.color=\'#334155\'; this.querySelector(\'.tt-icon\').style.transform=\'scale(1)\';">' => '<div class="group p-8 border-r border-b border-slate-100 flex flex-col transition-all duration-300 relative bg-white hover:bg-slate-50">',
];

foreach ($reps as $p => $r) {
    $text = str_replace($p, $r, $text);
}

file_put_contents($file, $text);
echo "Done";