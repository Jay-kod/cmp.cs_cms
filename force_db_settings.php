<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$dataToInsertOrUpdate = [
    // Programmes
    'about_programmes' => json_encode([
        ['title' => 'B.Sc. Computer Science', 'icon' => 'fa-graduation-cap', 'desc' => 'A comprehensive 4-year degree program focusing on core computer science foundations, software engineering, and systems design.'],
        ['title' => 'Diploma in Computer Science', 'icon' => 'fa-certificate', 'desc' => 'A 2-year practical-oriented program designed to equip students with essential IT skills and programming knowledge.'],
        ['title' => 'Part-Time Degree Program', 'icon' => 'fa-business-time', 'desc' => 'Flexible learning options for working professionals to earn their B.Sc. degree while maintaining their career.'],
    ]),
    
    // Departmental Board
    'about_board' => json_encode([
        ['title' => 'Chairman', 'icon' => 'fa-crown', 'who' => 'Head of Department (HOD)'],
        ['title' => 'Members', 'icon' => 'fa-users', 'who' => "All Academic Staff\n(Except Graduate Assistants)"],
        ['title' => 'Mandate', 'icon' => 'fa-clipboard-check', 'who' => "Course organisation, teaching oversight\n& examination control"],
    ]),
    
    // Facilities & Labs
    'about_facilities' => json_encode([
        ['name' => 'Software Lab', 'icon' => 'fa-laptop-code', 'description' => 'The Department of Computer Science is equipped with state-of-the-art facilities that empower students to explore, innovate, and succeed in their academic and professional journeys.'],
        ['name' => 'Hardware Lab', 'icon' => 'fa-microchip', 'description' => 'A dedicated space for practical experiments with computer architecture and embedded systems.'],
        ['name' => 'Networking Lab', 'icon' => 'fa-network-wired', 'description' => 'Advanced infrastructural setup for studying cryptography, network administration, and cybersecurity protocols.'],
        ['name' => 'Library', 'icon' => 'fa-book', 'description' => 'A comprehensive collection of academic resources, research journals, and reference materials for computer science studies.'],
    ]),

    // Objectives
    'about_objectives' => json_encode([
        ['title' => 'Excellence in Education', 'icon' => 'fa-star', 'desc' => 'Provide a comprehensive and rigorous academic curriculum that meets international standards and industry requirements.'],
        ['title' => 'Innovative Research', 'icon' => 'fa-lightbulb', 'desc' => 'Foster a culture of innovation and conduct cutting-edge research to address societal and technological challenges.'],
        ['title' => 'Industry Collaboration', 'icon' => 'fa-handshake', 'desc' => 'Build strong partnerships with tech industries to ensure our graduates are highly employable and industry-ready.'],
        ['title' => 'Ethical Practice', 'icon' => 'fa-scale-balanced', 'desc' => 'Instill strong professional ethics and a sense of social responsibility in all our students and faculty members.']
    ])
];

foreach ($dataToInsertOrUpdate as $key => $value) {
    if (DB::table('settings')->where('key', $key)->exists()) {
        DB::table('settings')->where('key', $key)->update(['value' => $value]);
    } else {
        DB::table('settings')->insert(['key' => $key, 'value' => $value]);
    }
}

echo "Successfully injected all the latest frontend configurations directly into the Admin Database!\n";
