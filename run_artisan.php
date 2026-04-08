<?php
$output = [];
exec('php artisan optimize:clear 2>&1', $output);
file_put_contents('artisan_out.txt', implode("\n", $output));
