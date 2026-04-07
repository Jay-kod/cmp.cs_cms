<?php
$output = [];
$files = glob(__DIR__ . '/resources/views/pages/about-partials/*.blade.php');
foreach ($files as $f) {
    preg_match_all('/class="([^"]+)"/', file_get_contents($f), $matches);
    foreach ($matches[1] as $classes) {
        foreach (explode(' ', $classes) as $c) {
            if (str_ends_with($c, '-card') || str_ends_with($c, '-box') || str_ends_with($c, '-block') || str_ends_with($c, '-item') || str_ends_with($c, 'member')) {
                $output[$c] = true;
            }
        }
    }
}
echo implode(', ', array_keys($output));
