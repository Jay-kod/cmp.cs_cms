<?php
$adminDir = 'c:/xampp/htdocs/p/dcms/resources/views/admin';
$pages = glob("$adminDir/*/index.blade.php");

foreach ($pages as $page) {
    if (strpos($page, 'settings') !== false || strpos($page, 'backup') !== false || strpos($page, 'analytics') !== false || strpos($page, 'users') !== false) {
        continue;
    }
    
    $content = file_get_contents($page);
    
    // Check if it already has empty-state
    if (strpos($content, 'empty-state') !== false) {
        continue;
    }
    
    // Find @empty \n <tr> \n <td colspan="..."> Message </td> \n </tr> \n @endforelse
    $pattern = '/@empty\s*<tr>\s*<td[^>]*colspan="?(\d+)"?[^>]*>(.*?)<\/td>\s*<\/tr>\s*@endforelse/is';
    
    $newContent = preg_replace_callback($pattern, function($matches) use ($page) {
        $colspan = $matches[1];
        $message = trim(strip_tags($matches[2]));
        
        // Determine icon and title based on path
        $icon = 'fa-folder-open';
        $title = 'No Records Found';
        
        if (strpos($page, 'announcements') !== false) { $icon = 'fa-bullhorn'; $title = 'No Announcements Active'; }
        elseif (strpos($page, 'events') !== false) { $icon = 'fa-calendar-xmark'; $title = 'No Events Scheduled'; }
        elseif (strpos($page, 'staff') !== false) { $icon = 'fa-user-slash'; $title = 'No Staff Members Found'; }
        elseif (strpos($page, 'news') !== false) { $icon = 'fa-newspaper'; $title = 'No News Articles Published'; }
        elseif (strpos($page, 'gallery') !== false) { $icon = 'fa-images'; $title = 'No Albums Found'; }
        elseif (strpos($page, 'programmes') !== false) { $icon = 'fa-graduation-cap'; $title = 'No Programmes Found'; }
        elseif (strpos($page, 'courses') !== false) { $icon = 'fa-book'; $title = 'No Courses Found'; }
        elseif (strpos($page, 'publications') !== false) { $icon = 'fa-book-open'; $title = 'No Publications Found'; }
        elseif (strpos($page, 'partners') !== false) { $icon = 'fa-handshake-slash'; $title = 'No Partners Found'; }
        elseif (strpos($page, 'past-hods') !== false) { $icon = 'fa-landmark'; $title = 'No Past HODs Found'; }
        elseif (strpos($page, 'nacos-presidents') !== false) { $icon = 'fa-user-graduate'; $title = 'No NACOS Presidents Found'; }
        elseif (strpos($page, 'pages') !== false) { $icon = 'fa-file-lines'; $title = 'No Pages Found'; }
        elseif (strpos($page, 'carousel') !== false) { $icon = 'fa-images'; $title = 'No Carousel Slides Found'; }
        elseif (strpos($page, 'social-links') !== false) { $icon = 'fa-share-nodes'; $title = 'No Social Links Found'; }
        elseif (strpos($page, 'external-systems') !== false) { $icon = 'fa-up-right-from-square'; $title = 'No External Systems Found'; }
        
        return "@empty
            <tr>
                <td colspan=\"$colspan\" style=\"text-align: center; padding: 3rem 1rem;\">
                    <div class=\"empty-state\" style=\"display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem;\">
                        <i class=\"fa-solid $icon\" style=\"font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;\"></i>
                        <h3 style=\"margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;\">$title</h3>
                        <p style=\"margin: 0; color: #64748b;\">$message</p>
                    </div>
                </td>
            </tr>
            @endforelse";
    }, $content);
    
    if ($newContent !== $content) {
        file_put_contents($page, $newContent);
        echo "Updated $page\n";
    } else {
        echo "Failed to match pattern in $page\n";
    }
}
