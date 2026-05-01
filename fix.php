<?php
$f = 'resources/views/pages/event-show.blade.php';
$c = file_get_contents($f);

$c = str_replace("{{ \$publishDate->format('M d, Y') }}", "{{ \Carbon\Carbon::parse(\$event->date)->format('M d, Y') }}", $c);
$c = str_replace("{{ \$readTime }} min read", "{{ \$event->time ? \Carbon\Carbon::parse(\$event->time)->format('h:i A') : 'Time TBD' }}", $c);
$c = str_replace("@if(\$event->author)", "@if(false)", $c);
$c = str_replace("{{ \$event->author->name }}", "", $c);
$c = str_replace('fa-regular fa-clock', 'fa-regular fa-clock', $c); 
$c = str_replace('Back to News & Events', 'Back to Events', $c);

// Also look at the related news block in the aside
$c = str_replace("route('events.show', \$rel->slug)", "route('events.show', \$rel->slug)", $c);
$c = str_replace("\$rel->published_at ? \Carbon\Carbon::parse(\$rel->published_at)->format('M d, Y') : \$rel->created_at->format('M d, Y')", "\Carbon\Carbon::parse(\$rel->date)->format('M d, Y')", $c);
$c = str_replace("{!! \$event->body !!}", "{!! \$event->description !!}", $c);
file_put_contents($f, $c);
echo "Fixed!";
