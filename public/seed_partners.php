<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

\App\Models\Partner::truncate();
\App\Models\Partner::create(['name' => 'Microsoft Education', 'url' => 'https://microsoft.com', 'is_active' => true, 'sort_order' => 1, 'logo' => '']);
\App\Models\Partner::create(['name' => 'Google Cloud', 'url' => 'https://cloud.google.com', 'is_active' => true, 'sort_order' => 2, 'logo' => '']);

echo "Successfully seeded " . \App\Models\Partner::count() . " partners!\n";
