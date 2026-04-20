<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

Illuminate\Support\Facades\DB::table('department_settings')->where('setting_key', 'about_facilities')->delete();
Illuminate\Support\Facades\DB::table('department_settings')->where('key', 'about_facilities')->delete();
echo "Deleted old facilities setting from DB\n";
