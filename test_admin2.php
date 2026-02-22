<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$request = Illuminate\Http\Request::create('/admin', 'GET');

// Simulate login
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$user = App\Models\User::first();
if (!$user) { echo "NO USER FOUND"; exit; }
auth()->login($user);

try {
    $response = $kernel->handle($request);
    if ($response->getStatusCode() !== 200) {
        echo "STATUS: " . $response->getStatusCode() . PHP_EOL;
        echo $response->headers . PHP_EOL;
    }
    $content = $response->getContent();
    if (strlen($content) < 100) {
        echo "SHORT RESPONSE (" . strlen($content) . " bytes):" . PHP_EOL;
        echo $content;
    } else {
        echo "RESPONSE OK: " . strlen($content) . " bytes" . PHP_EOL;
        // Check for common error patterns
        if (strpos($content, 'Vite manifest not found') !== false) echo "ERROR: Vite manifest missing" . PHP_EOL;
        if (strpos($content, 'ErrorException') !== false) echo "ERROR: ErrorException in response" . PHP_EOL;
        if (strpos($content, 'Whoops') !== false) echo "ERROR: Whoops handler triggered" . PHP_EOL;
        if (strpos($content, 'admin-sidebar') !== false) echo "OK: sidebar found" . PHP_EOL;
        if (strpos($content, 'Dashboard') !== false) echo "OK: Dashboard found" . PHP_EOL;
        // Print first 500 chars
        echo substr($content, 0, 500);
    }
} catch(\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo $e->getFile() . ":" . $e->getLine() . PHP_EOL;
}
