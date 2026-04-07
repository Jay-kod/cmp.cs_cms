<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$pages = \App\Models\Page::all();
foreach ($pages as $p) {
    echo "ID: {$p->id} | Slug: {$p->slug} | Title: {$p->title} | System: {$p->is_system}\n";
}
