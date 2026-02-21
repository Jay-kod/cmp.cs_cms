<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Staff;
use App\Models\Programme;
use App\Models\Course;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\DepartmentSetting;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@dcms.test'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Department Settings
        $settings = [
            ['key' => 'hod_welcome_message', 'value' => 'Welcome to the Department of Computer Science. We are committed to fostering an environment of innovation and rigorous academic inquiry.', 'group' => 'general'],
            ['key' => 'vision_statement', 'value' => 'To be a world-class centre of excellence in computing research and education.', 'group' => 'about'],
            ['key' => 'mission_statement', 'value' => 'To produce highly skilled IT professionals capable of competing globally and solving local challenges.', 'group' => 'about'],
            ['key' => 'core_values', 'value' => 'Excellence, Integrity, Innovation, Collaboration', 'group' => 'about'],
        ];

        foreach ($settings as $setting) {
            DepartmentSetting::firstOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Programmes
        $programmes = [
            [
                'name' => 'B.Sc. Computer Science',
                'slug' => 'bsc-computer-science',
                'level' => 'BSc',
                'duration' => '4 Years',
                'mode_of_study' => 'Full Time',
                'description' => 'A comprehensive undergraduate programme designed to equip students with solid foundations in software engineering, algorithms, and systems design.',
            ],
            [
                'name' => 'M.Sc. Computer Science',
                'slug' => 'msc-computer-science',
                'level' => 'MSc',
                'duration' => '18 Months',
                'mode_of_study' => 'Full Time / Part Time',
                'description' => 'Advanced postgraduate study focusing on research, AI, data science, and advanced computing paradigms.',
            ],
            [
                'name' => 'Ph.D. Computer Science',
                'slug' => 'phd-computer-science',
                'level' => 'PhD',
                'duration' => '3-5 Years',
                'mode_of_study' => 'Full Time / Part Time',
                'description' => 'A terminal research degree for students looking to contribute novel findings to the field of computer science.',
            ],
        ];

        foreach ($programmes as $prog) {
            Programme::firstOrCreate(['slug' => $prog['slug']], $prog);
        }

        // 4. Staff
        $staffMembers = [
            ['name' => 'Prof. Adewale Okafor', 'title' => 'Professor', 'rank' => 'Professor', 'email' => 'a.okafor@dcms.test', 'is_hod' => true, 'specialisation' => 'Artificial Intelligence'],
            ['name' => 'Dr. Amina Yusuf', 'title' => 'Dr.', 'rank' => 'Senior Lecturer', 'email' => 'a.yusuf@dcms.test', 'is_hod' => false, 'specialisation' => 'Cybersecurity'],
            ['name' => 'Dr. Chukwudi Eze', 'title' => 'Dr.', 'rank' => 'Lecturer I', 'email' => 'c.eze@dcms.test', 'is_hod' => false, 'specialisation' => 'Data Science'],
            ['name' => 'Mr. Tunde Bakare', 'title' => 'Mr.', 'rank' => 'Lecturer II', 'email' => 't.bakare@dcms.test', 'is_hod' => false, 'specialisation' => 'Software Engineering'],
        ];

        foreach ($staffMembers as $index => $staff) {
            $staff['slug'] = Str::slug($staff['name']);
            $staff['sort_order'] = $index;
            Staff::firstOrCreate(['slug' => $staff['slug']], $staff);
        }

        // 5. Courses (Just a few for B.Sc)
        $bsc = Programme::where('slug', 'bsc-computer-science')->first();
        if ($bsc) {
            $courses = [
                ['code' => 'CSC101', 'title' => 'Introduction to Computer Science', 'credit_units' => 3, 'level' => 100, 'semester' => 1],
                ['code' => 'CSC102', 'title' => 'Introduction to Problem Solving', 'credit_units' => 3, 'level' => 100, 'semester' => 2],
                ['code' => 'CSC201', 'title' => 'Computer Programming I (Java)', 'credit_units' => 3, 'level' => 200, 'semester' => 1],
                ['code' => 'CSC301', 'title' => 'Structured Systems Analysis & Design', 'credit_units' => 3, 'level' => 300, 'semester' => 1],
                ['code' => 'CSC401', 'title' => 'Software Engineering', 'credit_units' => 3, 'level' => 400, 'semester' => 1],
            ];
            foreach ($courses as $course) {
                Course::firstOrCreate(['code' => $course['code']], array_merge($course, ['programme_id' => $bsc->id]));
            }
        }

        // 6. News
        News::firstOrCreate(
            ['slug' => 'nuc-accreditation-success'],
            [
                'title' => 'Full NUC Accreditation Achieved',
                'body' => 'The Department is proud to announce that all our programmes have received full accreditation from the National Universities Commission (NUC).',
                'category' => 'Department News',
                'is_featured' => true,
                'published_at' => now(),
                'user_id' => $admin->id,
            ]
        );

        // 7. Announcements
        Announcement::firstOrCreate(
            ['title' => 'Course Registration Deadline for 1st Semester'],
            [
                'body' => 'All students are expected to complete their course registration for the current semester by the end of the week. Late registration will attract a penalty fee.',
                'priority' => 'urgent',
                'audience' => 'students',
                'expires_at' => now()->addDays(14),
            ]
        );

        // 8. Events
        Event::firstOrCreate(
            ['slug' => 'annual-tech-symposium'],
            [
                'title' => 'Annual Tech Symposium 2026',
                'description' => 'Join industry leaders and academic researchers for a 2-day symposium on the future of AI and emerging technologies in Africa.',
                'date' => now()->addMonths(1),
                'venue' => 'University Main Auditorium',
            ]
        );
    }
}
