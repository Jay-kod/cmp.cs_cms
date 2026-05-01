<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$staff = App\Models\Staff::select('id','name','title','slug')->get();
foreach ($staff as $s) {
    $url = route('people.show', $s->slug);
    
    // Try to find the staff by slug (same logic as controller)
    $found = App\Models\Staff::where('slug', $s->slug)->first();
    $status = $found ? 'OK' : '404';
    
    echo $s->id . ' | name: ' . $s->name . ' | title: ' . ($s->title ?: 'NONE') . ' | slug: ' . $s->slug . ' | status: ' . $status . ' | url: ' . $url . PHP_EOL;
}

// Also check: are there any duplicate slugs?
echo PHP_EOL . "--- Checking for duplicate slugs ---" . PHP_EOL;
$slugCounts = App\Models\Staff::selectRaw('slug, count(*) as cnt')->groupBy('slug')->having('cnt', '>', 1)->get();
if ($slugCounts->isEmpty()) {
    echo "No duplicate slugs found." . PHP_EOL;
} else {
    foreach ($slugCounts as $sc) {
        echo "DUPLICATE: " . $sc->slug . " (" . $sc->cnt . " times)" . PHP_EOL;
    }
}

// Check: which staff have titles in their name field already?
echo PHP_EOL . "--- Staff with title prefix in name ---" . PHP_EOL;
foreach ($staff as $s) {
    if (preg_match('/^(Prof\.|Dr\.|Mr\.|Mrs\.|Ms\.|Engr\.)\s+/i', $s->name)) {
        echo "HAS TITLE IN NAME: id=" . $s->id . " name='" . $s->name . "' title='" . $s->title . "' slug='" . $s->slug . "'" . PHP_EOL;
    }
}
