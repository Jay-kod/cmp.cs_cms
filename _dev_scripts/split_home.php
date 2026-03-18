<?php

$homePath = __DIR__ . '/resources/views/pages/home.blade.php';
$partialsDir = __DIR__ . '/resources/views/pages/home-partials';

if (!is_dir($partialsDir)) {
    mkdir($partialsDir, 0777, true);
}

$content = file_get_contents($homePath);

// Define the sections to extract and their approximate markers
$sections = [
    'hero' => 'HERO CAROUSEL',
    'hod-welcome' => 'HOD WELCOME',
    'programmes' => 'PROGRAMMES',
    'staff' => 'MEET OUR STAFF',
    'gallery' => 'GALLERY SHOWCASE',
    'systems' => 'DEPARTMENT SYSTEMS',
    'nacos' => 'NACOS',
    'news-events' => 'NEWS & EVENTS',
    'partners' => 'OUR PARTNERS',
    'cta' => 'CALL TO ACTION',
    'styles' => 'CAROUSEL JS + HOVER CARD CSS'
];

$parts = preg_split('/<!-- ═══════════════════════════════════════════════\s*(.*?)\s*═══════════════════════════════════════════════ -->/s', $content, -1, PREG_SPLIT_DELIM_CAPTURE);

$newHome = $parts[0] . "\n";

for ($i = 1; $i < count($parts); $i += 2) {
    $title = trim($parts[$i]);
    $body = $parts[$i + 1];
    
    $filename = 'unknown';
    foreach ($sections as $file => $keyword) {
        if (strpos($title, $keyword) !== false) {
            $filename = $file;
            break;
        }
    }
    
    $partialPath = $partialsDir . '/' . $filename . '.blade.php';
    
    // Write partial
    file_put_contents($partialPath, "<!-- " . $title . " -->\n" . trim($body) . "\n");
    
    // Add include to new home
    $newHome .= "@include('pages.home-partials." . $filename . "')\n\n";
}

// Ensure @endsection is preserved if it got stripped or needs moving
if (strpos($newHome, '@endsection') === false) {
    $newHome .= "@endsection\n";
}

file_put_contents($homePath, $newHome);
echo "Done extracting " . count($sections) . " sections.\n";
