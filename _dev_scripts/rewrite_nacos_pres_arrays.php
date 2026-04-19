<?php
$file = __DIR__ . '/../resources/views/pages/nacos-presidents.blade.php';
$text = file_get_contents($file);

$text = str_replace(
    "['icon' => 'fa-solid fa-crown',           'value' => \$presidents->count(), 'label' => 'Past Leaders',   'color' => '#16a34a'],",
    "['icon' => 'fa-solid fa-crown',           'value' => \$presidents->count(), 'label' => 'Past Leaders',   'bg_class' => 'bg-green-600/15', 'text_class' => 'text-green-600'],",
    $text
);

$text = str_replace(
    "['icon' => 'fa-solid fa-calendar-check',  'value' => \$gs('nacos_page_stat_events', '50+'),  'label' => \$gs('nacos_page_stat_events_label', 'Events Hosted'),  'color' => '#0891b2'],",
    "['icon' => 'fa-solid fa-calendar-check',  'value' => \$gs('nacos_page_stat_events', '50+'),  'label' => \$gs('nacos_page_stat_events_label', 'Events Hosted'),  'bg_class' => 'bg-cyan-600/15', 'text_class' => 'text-cyan-600'],",
    $text
);

$text = str_replace(
    "['icon' => 'fa-solid fa-user-graduate',   'value' => \$gs('nacos_page_stat_members', '500+'),'label' => \$gs('nacos_page_stat_members_label','Active Members'), 'color' => '#7c3aed'],",
    "['icon' => 'fa-solid fa-user-graduate',   'value' => \$gs('nacos_page_stat_members', '500+'),'label' => \$gs('nacos_page_stat_members_label','Active Members'), 'bg_class' => 'bg-violet-600/15', 'text_class' => 'text-violet-600'],",
    $text
);

$text = str_replace(
    "['icon' => 'fa-solid fa-trophy',          'value' => \$gs('nacos_page_stat_awards', '20+'),  'label' => \$gs('nacos_page_stat_awards_label', 'Awards Won'),     'color' => '#ea580c'],",
    "['icon' => 'fa-solid fa-trophy',          'value' => \$gs('nacos_page_stat_awards', '20+'),  'label' => \$gs('nacos_page_stat_awards_label', 'Awards Won'),     'bg_class' => 'bg-orange-600/15', 'text_class' => 'text-orange-600'],",
    $text
);

$reps = [
    '/<div data-aos="fade-up" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center mb-2 sm:mb-3" style="background: \{\{ \$stat\[\'color\'\] \}\}15;">/' => '<div data-aos="fade-up" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center mb-2 sm:mb-3 {{ $stat[\'bg_class\'] }}">',
    '/<i class="\{\{ \$stat\[\'icon\'\] \}\}" style="color: \{\{ \$stat\[\'color\'\] \}\}; font-size: 1\.1rem;"><\/i>/' => '<i class="{{ $stat[\'icon\'] }} text-[1.1rem] {{ $stat[\'text_class\'] }}"></i>',
];

foreach ($reps as $p => $r) {
    if(preg_match($p, $text)) {
        $text = preg_replace($p, $r, $text);
    }
}

file_put_contents($file, $text);
echo "Done nacos-pres arrays.\n";