<?php
$c = file_get_contents("resources/views/components/nav/layer-2.blade.php");
$pattern = "/                    Contact Us\s*<\/a>\s*<span><\/span><span><\/span><span><\/span>\s*<\/button>/";
$replacement = "                    Contact Us\n                </a>\n            </nav>\n            <button class=\"navbar-hamburger\" id=\"mobile-menu-btn\" aria-label=\"Toggle navigation\">\n                <span></span><span></span><span></span>\n            </button>";
$c = preg_replace($pattern, $replacement, $c);
file_put_contents("resources/views/components/nav/layer-2.blade.php", $c);
?>
