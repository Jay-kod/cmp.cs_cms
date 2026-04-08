<?php
$content = file_get_contents("resources/views/pages/home-partials/hod-welcome.blade.php");
$content = str_replace("<div class=\"hod-photo\" style=\"flex: 0 0 300px; max-width: 100%; position: relative;\">", "<div class=\"hod-photo\" style=\"position: relative;\">", $content);
$content = str_replace("<div class=\"hod-text\" style=\"flex: 1; min-width: 320px;\">", "<div class=\"hod-text\">", $content);
file_put_contents("resources/views/pages/home-partials/hod-welcome.blade.php", $content);
?>
