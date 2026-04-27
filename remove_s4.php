<?php

$path = 'resources/views/pages/sub-department.blade.php';
$content = file_get_contents($path);

// remove the section 4 entirely since they should load from programmes page
$s = strpos($content, '<!-- Section 4 — Details Section -->');
$e = strpos($content, '<!-- Section 7 — Career');

if ($s !== false && $e !== false) {
    echo "Found Section 4 at $s, and next section at $e.\n";
    $before = substr($content, 0, $s);
    $after = substr($content, $e);
    
    // In the Before section, update the link to go to route
    $before = str_replace(
        'href="#prog-{{ $prog->slug }}"',
        'href="{{ route(\'programmes.show\', $prog->slug) }}"',
        $before
    );
    // Also fix the View All route if necessary
    $before = str_replace(
        '<a href="{{ route(\'page.show\', \'programmes\') }}"',
        '<a href="/programmes"',
        $before
    );
    
    file_put_contents($path, $before . $after);
    echo "Successfully removed Section 4 and updated links to Programmes.show\n";
} else {
    echo "Could not find sections! S: " . ($s !== false ? 'yes' : 'no') . " E: " . ($e !== false ? 'yes' : 'no') . "\n";
}
?><?php

$path = 'resources/views/pages/sub-department.blade.php';
$content = file_get_contents($path);

// remove the section 4 entirely since they should load from programmes page
$s = strpos($content, '<!-- Section 4 — Details Section -->');
$e1 = strpos($content, '<!-- Section 5');
$e2 = strpos($content, '<section class="py-24 bg-white relative overflow-hidden"');

// Try find next section
$e = $e1 ? $e1 : $e2;

if ($s !== false && $e !== false) {
    echo "Found Section 4 at $s, and next section at $e.\n";
    $before = substr($content, 0, $s);
    $after = substr($content, $e);
    
    // In the Before section, update the link to go to route
    $before = str_replace(
        'href="#prog-{{ $prog->slug }}"',
        'href="{{ route(\'programmes.show\', $prog->slug) }}"',
        $before
    );
    
    file_put_contents($path, $before . $after);
    echo "Successfully removed Section 4 and updated links to Programmes.show\n";
} else {
    echo "Could not find sections! S: " . ($s !== false ? 'yes' : 'no') . " E: " . ($e !== false ? 'yes' : 'no') . "\n";
}
