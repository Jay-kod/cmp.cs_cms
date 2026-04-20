<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Setting;

$s = Setting::where('key', 'about_facilities')->first();
if ($s) {
    echo "Updating settings to use the desired 4 items...\n";
    $s->value = json_encode([
        ['name' => 'Software Lab', 'icon' => 'fa-laptop-code', 'description' => 'The Department of Computer Science is equipped with state-of-the-art facilities that empower students to explore, innovate, and succeed in their academic and professional journeys.'],
        ['name' => 'Hardware Lab', 'icon' => 'fa-microchip', 'description' => 'A dedicated space for practical experiments with computer architecture and embedded systems.'],
        ['name' => 'Networking Lab', 'icon' => 'fa-network-wired', 'description' => 'Advanced infrastructural setup for studying cryptography, network administration, and cybersecurity protocols.'],
        ['name' => 'Library', 'icon' => 'fa-book', 'description' => 'A comprehensive collection of academic resources, research journals, and reference materials for computer science studies.'],
    ]);
    $s->save();
} else {
    echo "No DB settings overriding defaults. The new defaults will be used.";
}
