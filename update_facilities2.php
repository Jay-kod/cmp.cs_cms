<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

DB::table('site_settings')->where('key', 'about_facilities')->delete();
DB::table('settings')->where('key', 'about_facilities')->delete();
echo "Cleaned up old facilities config in DB, now UI uses defaults!\n";
