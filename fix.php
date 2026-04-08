<?php
$c = file_get_contents('resources/views/components/nav/layer-2.blade.php');
$p = '/Contact Us\s*<\/a>\s*<span><\/span><span><\/span><span><\/span>\s*<\/button>/';
$r = 'Contact Us</a></nav><button class="navbar-hamburger" id="mobile-menu-btn" aria-label="Toggle navigation"><span></span><span></span><span></span></button>';
$c = preg_replace($p, $r, $c);
file_put_contents('resources/views/components/nav/layer-2.blade.php', $c);
