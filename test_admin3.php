<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Http\Kernel');
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$user = App\Models\User::first();
if (!$user) { echo "NO USER FOUND"; exit; }
auth()->login($user);

// Test carousel index
$request = Illuminate\Http\Request::create('/admin/carousel', 'GET');
try {
    $response = $kernel->handle($request);
    $content = $response->getContent();
    echo "STATUS: " . $response->getStatusCode() . PHP_EOL;
    echo "SIZE: " . strlen($content) . " bytes" . PHP_EOL;

    // Check for errors
    if (strpos($content, 'ErrorException') !== false) echo "HAS ErrorException" . PHP_EOL;
    if (strpos($content, 'Whoops') !== false) echo "HAS Whoops" . PHP_EOL;
    if (strpos($content, 'Undefined') !== false) echo "HAS Undefined error" . PHP_EOL;
    if (strpos($content, 'not found') !== false) echo "HAS 'not found'" . PHP_EOL;

    // Extract vite/asset URLs
    preg_match_all('/(src|href)="([^"]*(?:build|assets|css|js)[^"]*)"/', $content, $matches);
    if (!empty($matches[2])) {
        echo PHP_EOL . "Asset URLs:" . PHP_EOL;
        foreach (array_unique($matches[2]) as $url) echo "  " . $url . PHP_EOL;
    }
    
    // Check for error output
    if ($response->getStatusCode() !== 200) {
        echo PHP_EOL . "RESPONSE BODY:" . PHP_EOL;
        echo substr($content, 0, 2000);
    }
} catch(\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
    echo $e->getFile() . ":" . $e->getLine() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
