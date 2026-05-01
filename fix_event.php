<?php

$f1 = 'resources/views/pages/events.blade.php';
$c1 = file_get_contents($f1);
$c1 = str_replace(['$event->location', '$event->time'], ['$event->venue', 'null'], $c1);
file_put_contents($f1, $c1);

$f2 = 'resources/views/pages/event-show.blade.php';
$c2 = file_get_contents($f2);
$c2 = str_replace(
    ['$event->featured_image', '$event->location', '$event->time', 'time TBD', 'Time TBD'],
    ['$event->flyer_image', '$event->venue', 'null', '', ''],
    $c2
);
file_put_contents($f2, $c2);

echo "Fixed vars!";
