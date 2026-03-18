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

// Log in the user via the auth manager so the session is aware
Auth::login($user);

echo "Testing route super-admin.dashboard...\n";
try {
    $request = \Illuminate\Http\Request::create('/admin/super-dashboard', 'GET');
    
    // We have to run the request through the kernel to trigger all middleware properly including StartSession
    $response = $app->make(Illuminate\Contracts\Http\Kernel::class)->handle($request);

    echo "Status code: " . $response->getStatusCode() . "\n";
    
    if ($response->getStatusCode() === 200) {
        echo "SUCCESS: Dashboard loaded\n";
    } else {
        echo "FAILED: Expected 200, got " . $response->getStatusCode() . "\n";
        echo "Redirecting to: " . $response->headers->get('Location') . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
