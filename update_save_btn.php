<?php

$dir = __DIR__ . '/resources/views/admin/page-content/';
$files = ['about', 'home', 'academics', 'people', 'gallery', 'blog', 'nacos', 'contact', 'labs', 'past-hods'];

foreach ($files as $f) {
    $p = $dir . $f . '.blade.php';
    if (!file_exists($p)) continue;
    $c = file_get_contents($p);
    
    // Add flexbox to sidenav
    $c = str_replace('.apc-sidenav {', '.apc-sidenav { display: flex; flex-direction: column;', $c);
    
    // The button to inject at the end of the sidebar
    $btn = '<div style="padding: 1rem; margin-top: auto; position: sticky; bottom: 0; background: white; border-top: 1px solid #e2e8f0; z-index: 10;">
            <button type="submit" class="apc-save-btn" style="width: 100%; justify-content: center;">
                <i class="fa-solid fa-save"></i> Save Content
            </button>
        </div>';
        
    // Insert the button before </nav>
    $c = preg_replace('/(<\/a>\s*@endforeach\s*)<\/nav>/s', "$1\n$btn\n    </nav>", $c);
    
    // Remove the old save bar block entirely
    // Find {{-- ── SAVE BAR ── --}} ... </div>
    // Make sure we remove exactly the div with class="apc-save-bar" and its contents
    $c = preg_replace('/\{\{-- ── SAVE BAR ── --\}\}\s*<div class="apc-save-bar">.*?<\/div>\s*/s', '', $c);
    
    file_put_contents($p, $c);
    echo "Updated $f\n";
}
