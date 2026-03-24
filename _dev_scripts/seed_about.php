<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\DepartmentSetting;

DepartmentSetting::updateOrCreate(['key'=>'about_intro_title', 'group'=>'page_about'], ['value'=>'Welcome to the Department of Computer Science']);
DepartmentSetting::updateOrCreate(['key'=>'about_intro_body', 'group'=>'page_about'], ['value'=>'Welcome to the Department of Computer Science. We are committed to excellence in teaching, learning, and research, and to developing leaders in many disciplines who make a difference globally. Our department is guided by four key objectives that shape everything we do.']);
DepartmentSetting::updateOrCreate(['key'=>'about_mission', 'group'=>'page_about'], ['value'=>'To promote technological advancement by providing a conducive environment for research, teaching, and learning that engenders the development of products that are technology-oriented, self-reliant, and relevant to society.']);
DepartmentSetting::updateOrCreate(['key'=>'about_vision', 'group'=>'page_about'], ['value'=>'To be a world-class institution for academic excellence geared towards meeting societal needs.']);
DepartmentSetting::updateOrCreate(['key'=>'about_history', 'group'=>'page_about'], ['value'=>'The Department of Computer Science was established to provide students with a strong foundation in computer science and to prepare them for careers in industry, government, and academia.']);

$coreValues = json_encode([
    ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'description' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.'],
    ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'description' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.'],
    ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'description' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.'],
    ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'description' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.']
]);
DepartmentSetting::updateOrCreate(['key'=>'about_core_values', 'group'=>'page_about'], ['value'=>$coreValues]);

$facilities = json_encode([
    ['icon' => 'fa-server', 'name' => 'Standard Laboratories', 'description' => 'The Department of Computer Science is equipped with state-of-the-art facilities that empower students to explore, innovate, and succeed in their academic and professional journeys.'],
    ['icon' => 'fa-microchip', 'name' => 'Hardware Lab', 'description' => 'A dedicated space for practical experiments with computer architecture and embedded systems.'],
    ['icon' => 'fa-network-wired', 'name' => 'Network & Security Lab', 'description' => 'Advanced infrastructural setup for studying cryptography, network administration, and cybersecurity protocols.']
]);
DepartmentSetting::updateOrCreate(['key'=>'about_facilities', 'group'=>'page_about'], ['value'=>$facilities]);

echo "Done seeding About page settings.\n";
