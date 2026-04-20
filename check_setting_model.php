<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$record = \App\Models\DepartmentSetting::first();
print_r($record ? $record->toArray() : 'No records found.');
