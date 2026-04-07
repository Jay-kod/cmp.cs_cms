<?php
require __DIR__."/vendor/autoload.php";
$app = require_once __DIR__."/bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    collect([
        \App\Models\News::max("updated_at"),\App\Models\Event::max("updated_at"),\App\Models\Announcement::max("updated_at"),
        \App\Models\Staff::max("updated_at"),\App\Models\Programme::max("updated_at"),\App\Models\Course::max("updated_at"),
        \App\Models\CarouselSlide::max("updated_at"),\App\Models\GalleryAlbum::max("updated_at"),\App\Models\Partner::max("updated_at"),
        \App\Models\Publication::max("updated_at"),\App\Models\NacosPresident::max("updated_at"),\App\Models\PastHod::max("updated_at"),
        \App\Models\Page::max("updated_at"),\App\Models\DepartmentSetting::max("updated_at")
    ])->filter()->max();
}
$time1 = microtime(true) - $start;

$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    \App\Models\Programme::where("is_active", true)->limit(5)->get();
    \App\Models\News::whereNotNull("published_at")->limit(5)->get();
}
$time2 = microtime(true) - $start;

echo "\n--- PERFORMANCE TEST RESULTS (Averaged over 100 requests) ---\n";
echo "Content Freshness API Query Avg: " . round(($time1 * 1000) / 100, 2) . " ms/request\n";
echo "Search Filter Query Avg: " . round(($time2 * 1000) / 100, 2) . " ms/request\n";
echo "-------------------------------------------------------------\n";

