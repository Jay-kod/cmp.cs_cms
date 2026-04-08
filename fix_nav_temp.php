<?php

$path = 'resources/views/components/nav/layer-2.blade.php';
$html = file_get_contents($path);

$vars_logic = <<<EOD
        @php
            \$isHomeActive = request()->is('/');
            \$isAboutActive = request()->is('about*') || request()->is('nacos-presidents*');
            \$isAcademicsActive = request()->is('academics*') || request()->is('programmes*') || request()->is('pages/programmes*') || request()->is('siwes*') || request()->is('projects*') || request()->is('pages/sub-departments*') || request()->is('sub-departments*');
            \$isPeopleActive = request()->is('people*');
            \$isNewsActive = request()->is('research-news*') || request()->is('events*') || request()->is('research-innovations*') || request()->is('pages/academic-calendar*');
        @endphp
        <!-- Desktop Nav -->
EOD;

$html = preg_replace('/        <!-- Desktop Nav -->/', $vars_logic, $html, 1);

$html = str_replace("request()->is('/')", "\$isHomeActive", $html);
$html = str_replace("request()->is('about*')", "\$isAboutActive", $html);
$html = str_replace("request()->is('academics*')", "\$isAcademicsActive", $html);
$html = str_replace("request()->is('people*')", "\$isPeopleActive", $html);
$html = str_replace("request()->is('research-news*') || request()->is('events*')", "\$isNewsActive", $html);

file_put_contents($path, $html);
echo "File updated successfully!";
