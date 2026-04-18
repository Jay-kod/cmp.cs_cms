<?php
$file = __DIR__ . '/../resources/views/pages/home-partials/timetable.blade.php';
$text = file_get_contents($file);

$reps = [
    '<a href="{{ url(\'/resources\') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s;" onmouseover="this.style.transform=\'translateY(-2px)\'" onmouseout="this.style.transform=\'translateY(0)\'">' => '<a href="{{ url(\'/resources\') }}" class="btn btn-primary bg-[color:var(--color-primary)] text-white py-[0.6rem] px-[1.2rem] rounded-lg no-underline font-semibold flex items-center gap-1.5 transition-all duration-200 hover:-translate-y-[2px]">'
];

foreach ($reps as $p => $r) {
    $text = str_replace($p, $r, $text);
}

file_put_contents($file, $text);
echo "Done";