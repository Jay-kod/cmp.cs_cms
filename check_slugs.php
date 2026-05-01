<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$staff = App\Models\Staff::select('id','name','slug')->get();
foreach ($staff as $s) {
    $slug = $s->slug ?: 'NO SLUG';
    echo $s->id . ' | ' . $s->name . ' | ' . $slug . PHP_EOL;
}
