<?php

\ = 'resources/views/layouts/public.blade.php';
\ = file_get_contents(\);

// Split at footer
\ = explode('<!-- Main Footer -->', \);

if (count(\) > 1) {
    \ = \[1];
    
    // Deepen background
    \ = str_replace('rgba(13,79,38,0.92)', 'rgba(2, 38, 18, 0.93)', \);
    \ = str_replace('#0D4F26', '#022612', \);
    
    // Brighten text
    \ = str_replace('#d1d5db', '#f1f5f9', \);
    
    // Make headings stand out more if possible
    \ = str_replace('font-size: 0.88rem;', 'font-size: 0.92rem;', \);
    
    \ = \[0] . '<!-- Main Footer -->' . \;
    file_put_contents(\, \);
    echo "Footer colors updated!";
} else {
    echo "Footer not found.";
}
