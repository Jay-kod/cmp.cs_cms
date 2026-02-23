<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('role', 'super_admin')->first();
if (!$user) {
    echo "No super admin found.\n";
    exit(1);
}

echo "Testing route super-admin.dashboard...\n";
try {
    $request = \Illuminate\Http\Request::create('/admin/super-dashboard', 'GET');
    $request->setUserResolver(function () use ($user) {
        return $user;
    });
    
    $response = app()->handle($request);
    echo "Status code: " . $response->getStatusCode() . "\n";
    
    if ($response->getStatusCode() === 200) {
        echo "SUCCESS: Dashboard loaded\n";
    } else {
        echo "FAILED: Expected 200, got " . $response->getStatusCode() . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
