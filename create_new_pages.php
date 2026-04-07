<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Page;

$pages = [
    ['title' => "HOD's Message", 'slug' => 'hod-message', 'icon' => 'fas fa-user-tie', 'content' => '<h2>Message from the Head of Department</h2><p>Welcome to the Department of Computer Science. We are dedicated to providing world-class education in computing...</p>'],
    ['title' => 'SIWES Information', 'slug' => 'siwes', 'icon' => 'fas fa-industry', 'content' => '<h2>SIWES (Student Industrial Work Experience Scheme)</h2><p>SIWES is an essential part of our academic framework, equipping students with practical industry experience. Find the latest guidelines and placement criteria here.</p>'],
    ['title' => 'Final Year Projects', 'slug' => 'projects', 'icon' => 'fas fa-project-diagram', 'content' => '<h2>Final Year Projects</h2><p>Explore past final year projects, submission guidelines, and required formats for your thesis reporting.</p>'],
    ['title' => 'Academic Calendar', 'slug' => 'academic-calendar', 'icon' => 'fas fa-calendar-alt', 'content' => '<h2>Academic Calendar</h2><p>Stay updated with our academic dates including semester starts, exams, and departmental activities.</p>']
];

foreach ($pages as $data) {
    Page::updateOrCreate(
        ['slug' => $data['slug']],
        [
            'title' => $data['title'],
            'icon' => $data['icon'],
            'content' => $data['content'],
            'is_active' => true,
            'is_system' => true
        ]
    );
}
echo "Pages successfully created and added to database!\n";
