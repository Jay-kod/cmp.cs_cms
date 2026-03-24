<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DepartmentSetting;
use App\Models\Page;
use App\Models\Post;

// Improve Department Settings (Home Page, About Page, Global)
$improvedSettings = [
    'home_hero_title' => 'Empowering the Next Generation of Tech Leaders',
    'home_hero_subtitle' => 'Join us as we redefine the boundaries of innovation. Discover world-class education, groundbreaking research, and a thriving community tailored for the innovators of tomorrow.',
    'home_about_title' => 'A Legacy of Technical Excellence',
    'home_about_text' => 'For decades, our department has been at the forefront of digital transformation, fostering critical thinking and coding proficiency. We shape world-class software engineers and IT professionals ready to design, build, and secure the technological frameworks of the future. Our students learn to transcend theoretical concepts, transforming bright ideas into deployed, scalable applications.',
    
    'home_news_badge' => 'Latest Insights',
    'home_news_title' => 'Breakthroughs & Updates',
    'home_news_subtitle' => 'Stay informed with our latest department news, research innovations, and achievements from our dynamic student body.',
    
    'home_programmes_badge' => 'Academic Catalog',
    'home_programmes_title' => 'Future-Ready Degrees',
    'home_programmes_subtitle' => 'Explore our specialized computing programs designed to equip you with the advanced skills required by today\'s competitive tech landscape.',
    
    'home_staff_badge' => 'Expert Faculty',
    'home_staff_title' => 'Learn From Industry Leaders',
    'home_staff_subtitle' => 'Meet our dedicated team of professors, researchers, and technical staff who are passionate about mentoring the next wave of tech pioneers.',
    
    'home_gallery_badge' => 'Campus Life',
    'home_gallery_title' => 'Our Vibrant Community',
    'home_gallery_subtitle' => 'Experience the energy of our department through glimpses of hackathons, academic lectures, and collaborative student activities.',
    
    'vision_statement' => 'To be a global frontier in computational innovation and society-responsive digital solutions, fundamentally aligning with the university\'s broader mission to propel ethical technological advancement and scientific discovery.',
    'mission_statement' => 'To cultivate a highly collaborative environment for research, teaching, and learning that accelerates the development of transformative technologies. We aim to equip students with practical skills, theoretical mastery, and the self-reliance necessary to solve pressing real-world challenges.',
    
    'about_department_history' => 'Founded with a profound commitment to educational excellence, our department has grown from a humble computer training center into a full-fledged hub of computer science and informatics. Over the years, we have continually refreshed our curriculum to match the rapid evolution of global tech standards, ensuring our alumni are always one step ahead in the corporate and research sectors.',
    
    'contact_address' => 'Innovation Hub, Main Campus Building, Science Faculty Avenue',
    'contact_phone' => '+1 (555) 123-4567',
    'contact_email' => 'admissions@computerscience.edu',
];

foreach ($improvedSettings as $key => $value) {
    if (class_exists(DepartmentSetting::class)) {
        DepartmentSetting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}

// Improve Pages Content
if (class_exists(Page::class)) {
    $pages = Page::all();
    foreach ($pages as $page) {
        if ($page->slug == 'about') {
            $page->update([
                'title' => 'About Our Department',
                'excerpt' => 'Discover our legacy, meet our leadership, and explore the principles that guide our academic excellence.',
            ]);
        }
    }
}

echo "All dummy texts in the system have been successfully improved with professional content!\n";