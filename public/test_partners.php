<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$count = \App\Models\Partner::count();
echo "Total Partners: " . $count . "\n";
$partners = \App\Models\Partner::all();
foreach($partners as $p) {
    echo "ID: {$p->id}, Name: {$p->name}, Active: {$p->is_active}, Order: {$p->sort_order}\n";
}
