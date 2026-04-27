<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\DepartmentSetting;

$data = [
    'nacos_page_about_text3' => 'As a community driven by innovation, we continuously strive to bridge the gap between classroom theory and real-world application. By collaborating with industry experts, faculty, and accomplished alumni, NACOS provides unique mentorship opportunities, ensuring that every student has the resources, guidance, and confidence required to become future tech leaders and effectively shape the digital landscape of tomorrow.',
    'nacos_page_stat_leaders_label' => 'Past Leaders',
    'nacos_page_activities_title' => 'Our Activities',
    'nacos_act1_title' => 'Hackathons & Coding Contests',
    'nacos_act1_desc' => 'Regular programming competitions that test skills and encourage creative problem-solving among members.',
    'nacos_act2_title' => 'Workshops & Seminars',
    'nacos_act2_desc' => 'Industry-led training sessions on trending technologies like AI, cloud computing, and cybersecurity.',
    'nacos_act3_title' => 'Mentorship Programme',
    'nacos_act3_desc' => 'Pairing junior students with senior peers and alumni for academic guidance and career advice.',
    'nacos_act4_title' => 'Community Service',
    'nacos_act4_desc' => 'Giving back through IT literacy drives, school outreach, and digital empowerment projects.',
    'nacos_act5_title' => 'Social & Sports Events',
    'nacos_act5_desc' => 'Building bonds beyond the classroom with get-togethers, game nights, and inter-departmental sports.',
    'nacos_act6_title' => 'Annual NACOS Week',
    'nacos_act6_desc' => 'A week-long celebration with talks, exhibitions, awards, and cultural events showcasing computing talent.',
];

foreach ($data as $key => $value) {
    DepartmentSetting::updateOrCreate(
        ['key' => $key],
        ['value' => $value, 'group' => 'page_nacos']
    );
}

echo "Successfully populated NACOS updates into the DB.\n";
