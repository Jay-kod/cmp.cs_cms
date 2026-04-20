<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$url = \Illuminate\Support\Facades\Storage::disk('public')->url("timetable/department-timetable.png");
echo $url;
