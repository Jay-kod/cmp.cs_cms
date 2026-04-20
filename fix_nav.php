<?php
$file = 'resources/views/components/nav/layer-2.blade.php';
$content = file_get_contents($file);

$content = preg_replace_callback('/<a href="\{\{ (url|route)\(([^}]+)\) \}\}" class="nav-dropdown-item([^"]+)"/', function($matches) {
    // 1=url/route, 2=args, 3=rest of classes
    $path = trim(str_replace("'", "", $matches[2]), '/');
    if ($matches[1] === 'url') {
        if ($path === 'about') $cond = "request()->is('about')";
        elseif ($path === 'people') $cond = "request()->is('people')";
        else $cond = "request()->is('$path*')";
    } else {
        if (str_contains($path, "programmes")) $cond = "request()->is('pages/programmes') || request()->is('programmes*')";
        elseif (str_contains($path, "academic-calendar")) $cond = "request()->is('pages/academic-calendar*')";
        elseif (str_contains($path, "sub-department")) $cond = "request()->is('sub-department/'.\$subDept->slug.'*')";
        elseif (str_contains($path, "siwes")) $cond = "request()->routeIs('siwes*')";
        elseif (str_contains($path, "projects")) $cond = "request()->routeIs('projects*')";
        else $cond = "false";
    }
    
    $rest = str_replace(['text-gray-600', 'font-medium'], '', rtrim($matches[3]));
    return '<a href="{{ '.$matches[1].'('.$matches[2].') }}" class="nav-dropdown-item '.$rest.' {{ '.$cond.' ? \'bg-green-50 text-primary font-bold shadow-sm\' : \'text-gray-600 font-medium\' }}"';
}, $content);

$content = preg_replace_callback('/<a href="\{\{ (url|route)\(([^}]+)\) \}\}" class="mobile-link mobile-sub-link"/', function($matches) {
    $path = trim(str_replace("'", "", $matches[2]), '/');
    if ($matches[1] === 'url') {
        if ($path === 'about') $cond = "request()->is('about')";
        elseif ($path === 'people') $cond = "request()->is('people')";
        else $cond = "request()->is('$path*')";
    } else {
        if (str_contains($path, "programmes")) $cond = "request()->is('pages/programmes') || request()->is('programmes*')";
        elseif (str_contains($path, "academic-calendar")) $cond = "request()->is('pages/academic-calendar*')";
        elseif (str_contains($path, "sub-department")) $cond = "request()->is('sub-department/'.\$subDept->slug.'*')";
        elseif (str_contains($path, "siwes")) $cond = "request()->routeIs('siwes*')";
        elseif (str_contains($path, "projects")) $cond = "request()->routeIs('projects*')";
        else $cond = "false";
    }
    
    return '<a href="{{ '.$matches[1].'('.$matches[2].') }}" class="mobile-link mobile-sub-link {{ '.$cond.' ? \'text-primary font-bold bg-green-50 border-l-4 border-primary pl-3\' : \'\' }}"';
}, $content);

file_put_contents($file, $content);
echo "SUCCESS";
