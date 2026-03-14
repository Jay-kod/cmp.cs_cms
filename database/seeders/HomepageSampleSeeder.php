<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Programme;
use App\Models\Staff;
use App\Models\ExternalSystem;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use App\Models\Page;
use App\Models\User;

class HomepageSampleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        // ──────────────────────────────────────
        // MORE STAFF  (need at least 4 active for homepage grid)
        // ──────────────────────────────────────
        $extraStaff = [
            ['name' => 'Dr. Fatima Bello',   'title' => 'Dr.',  'rank' => 'Senior Lecturer',  'email' => 'f.bello@dcms.test',   'specialisation' => 'Machine Learning & NLP',            'bio' => 'Dr. Bello specializes in machine learning applications for African languages and has published extensively on NLP for low-resource languages.'],
            ['name' => 'Mr. Samuel Adeyemi',  'title' => 'Mr.',  'rank' => 'Lecturer II',      'email' => 's.adeyemi@dcms.test', 'specialisation' => 'Cloud Computing',                   'bio' => 'Mr. Adeyemi focuses on cloud infrastructure and DevOps practices for emerging economies.'],
            ['name' => 'Dr. Grace Okonkwo',   'title' => 'Dr.',  'rank' => 'Lecturer I',       'email' => 'g.okonkwo@dcms.test', 'specialisation' => 'Human-Computer Interaction',        'bio' => 'Dr. Okonkwo researches usability and accessibility in mobile applications across Sub-Saharan Africa.'],
            ['name' => 'Prof. Ibrahim Musa',  'title' => 'Prof.','rank' => 'Professor',         'email' => 'i.musa@dcms.test',    'specialisation' => 'Network Security',                  'bio' => 'Prof. Musa has over 25 years of experience in network security and cryptographic protocols.'],
            ['name' => 'Dr. Ngozi Ibe',       'title' => 'Dr.',  'rank' => 'Senior Lecturer',  'email' => 'n.ibe@dcms.test',     'specialisation' => 'Database Systems & Big Data',       'bio' => 'Dr. Ibe specializes in distributed database systems and real-time analytics platforms.'],
            ['name' => 'Mr. Abdullahi Garba', 'title' => 'Mr.',  'rank' => 'Assistant Lecturer','email' => 'a.garba@dcms.test',   'specialisation' => 'Web Technologies',                  'bio' => 'Mr. Garba teaches web development and has led multiple open-source projects for university management.'],
        ];

        foreach ($extraStaff as $i => $s) {
            $s['slug'] = Str::slug($s['name']);
            $s['sort_order'] = 10 + $i;
            $s['status'] = 'Tenure';
            $s['is_hod'] = false;
            Staff::firstOrCreate(['email' => $s['email']], $s);
        }

        // ──────────────────────────────────────
        // MORE COURSES  (add to BSc programme)
        // ──────────────────────────────────────
        $bsc = Programme::where('slug', 'bsc-computer-science')->first();
        if ($bsc) {
            $courses = [
                ['code' => 'CSC103', 'title' => 'Discrete Mathematics',               'credit_units' => 3, 'level' => 100, 'semester' => 1, 'description' => 'Fundamental mathematical concepts including sets, logic, functions, relations, and graph theory.'],
                ['code' => 'CSC104', 'title' => 'Computer Hardware Fundamentals',      'credit_units' => 2, 'level' => 100, 'semester' => 2, 'description' => 'Introduction to computer architecture, logic gates, memory systems, and I/O organisation.'],
                ['code' => 'CSC202', 'title' => 'Data Structures & Algorithms',        'credit_units' => 3, 'level' => 200, 'semester' => 1, 'description' => 'Study of fundamental data structures including arrays, linked lists, stacks, queues, trees and graphs.'],
                ['code' => 'CSC203', 'title' => 'Computer Programming II (Python)',     'credit_units' => 3, 'level' => 200, 'semester' => 2, 'description' => 'Intermediate programming concepts using Python, including OOP, file handling, and libraries.'],
                ['code' => 'CSC204', 'title' => 'Operating Systems',                   'credit_units' => 3, 'level' => 200, 'semester' => 2, 'description' => 'Process management, memory management, file systems, and concurrency control.'],
                ['code' => 'CSC302', 'title' => 'Database Management Systems',         'credit_units' => 3, 'level' => 300, 'semester' => 1, 'description' => 'Relational databases, SQL, normalisation, transaction management, and database design.'],
                ['code' => 'CSC303', 'title' => 'Computer Networks',                   'credit_units' => 3, 'level' => 300, 'semester' => 1, 'description' => 'Network architectures, protocols (TCP/IP, HTTP), routing, switching, and security fundamentals.'],
                ['code' => 'CSC304', 'title' => 'Artificial Intelligence',             'credit_units' => 3, 'level' => 300, 'semester' => 2, 'description' => 'Search strategies, knowledge representation, expert systems, and introduction to machine learning.'],
                ['code' => 'CSC402', 'title' => 'Compiler Construction',               'credit_units' => 3, 'level' => 400, 'semester' => 1, 'description' => 'Lexical analysis, parsing techniques, semantic analysis, intermediate code generation, and optimisation.'],
                ['code' => 'CSC403', 'title' => 'Information Security',                'credit_units' => 3, 'level' => 400, 'semester' => 2, 'description' => 'Cryptography, network security, ethical hacking, digital forensics, and security policies.'],
                ['code' => 'CSC499', 'title' => 'Final Year Project',                  'credit_units' => 6, 'level' => 400, 'semester' => 1, 'is_elective' => false, 'description' => 'Independent supervised research project demonstrating competence in software development and academic writing.'],
            ];
            foreach ($courses as $c) {
                Course::firstOrCreate(['code' => $c['code']], array_merge($c, ['programme_id' => $bsc->id]));
            }
        }

        // ──────────────────────────────────────
        // MORE NEWS  (homepage shows 3)
        // ──────────────────────────────────────
        $newsItems = [
            [
                'slug'  => 'new-computer-lab-commissioned',
                'title' => 'New 200-Seat Computer Laboratory Commissioned',
                'body'  => '<p>The Vice Chancellor today commissioned the newly built 200-seat computer laboratory equipped with modern workstations, high-speed internet, and smart board technology. The facility, funded by TETFund, will serve undergraduate and postgraduate students across all levels.</p><p>"This is a landmark achievement for the department," said the Head of Department. "Our students now have access to facilities that rival the best in the country."</p><p>The lab features dual-monitor setups, GPU-enabled machines for AI research, and a dedicated server room for cloud computing practicals.</p>',
                'category' => 'Infrastructure',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'slug'  => 'students-win-hackathon-2026',
                'title' => 'NSUK CS Students Win National Hackathon',
                'body'  => '<p>A team of five Computer Science students from Nasarawa State University Keffi emerged winners of the 2026 National University Hackathon held in Abuja. The team, mentored by Dr. Chukwudi Eze, developed an AI-powered crop disease detection app for smallholder farmers.</p><p>The winning solution uses computer vision and a lightweight neural network that runs offline on low-end Android devices, making it accessible to rural farmers without internet connectivity.</p><p>The team will represent Nigeria at the pan-African finals in Nairobi next month.</p>',
                'category' => 'Student Achievement',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
            ],
            [
                'slug'  => 'partnership-with-microsoft-africa',
                'title' => 'Department Partners with Microsoft Africa Development Centre',
                'body'  => '<p>The Department of Computer Science has signed a Memorandum of Understanding (MoU) with the Microsoft Africa Development Centre (ADC) to collaborate on curriculum development, student mentorship, and joint research in cloud computing and artificial intelligence.</p><p>Under the agreement, Microsoft will provide Azure cloud credits to all registered students, sponsor annual guest lectures, and offer internship placements for top-performing students at their Lagos and Nairobi offices.</p><p>This partnership positions our graduates for competitive roles in the global technology industry.</p>',
                'category' => 'Partnership',
                'is_featured' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'slug'  => 'postgraduate-admissions-open',
                'title' => 'Postgraduate Admissions Now Open for 2026/2027 Session',
                'body'  => '<p>Applications are now being accepted for M.Sc. and Ph.D. programmes in Computer Science for the 2026/2027 academic session. Prospective candidates must possess a minimum of Second Class Upper (2.1) for M.Sc. and a strong M.Sc. result for Ph.D. admission.</p><p>Research areas available include Artificial Intelligence, Cybersecurity, Data Science, Software Engineering, and Computer Networks. Full and partial scholarships are available for outstanding candidates.</p><p>Application deadline: June 30, 2026.</p>',
                'category' => 'Admissions',
                'is_featured' => false,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($newsItems as $n) {
            $n['user_id'] = $admin?->id;
            News::firstOrCreate(['slug' => $n['slug']], $n);
        }

        // ──────────────────────────────────────
        // MORE EVENTS  (homepage needs future dates)
        // ──────────────────────────────────────
        $events = [
            [
                'slug'  => 'guest-lecture-ai-ethics',
                'title' => 'Guest Lecture: Ethics in Artificial Intelligence',
                'description' => 'Prof. Adeola Bankole of the University of Lagos will deliver a special lecture on the ethical implications of AI deployment in developing nations, with case studies from healthcare and agriculture.',
                'date' => now()->addDays(10),
                'venue' => 'CSC Lecture Theatre, Block A',
                'is_featured' => true,
            ],
            [
                'slug'  => 'coding-bootcamp-2026',
                'title' => 'Annual Coding Bootcamp 2026',
                'description' => 'A 3-day intensive bootcamp covering full-stack web development with React and Laravel. Open to all students from 200-level and above. Certificates of participation will be awarded.',
                'date' => now()->addDays(21),
                'end_date' => now()->addDays(23),
                'venue' => 'New Computer Laboratory',
                'is_featured' => true,
            ],
            [
                'slug'  => 'nacos-week-opening-ceremony',
                'title' => 'NACOS Week 2026 Opening Ceremony',
                'description' => 'The official opening ceremony of the annual NACOS Week featuring keynote speeches, cultural performances, and an award ceremony for outstanding students.',
                'date' => now()->addWeeks(5),
                'venue' => 'University Main Auditorium',
            ],
            [
                'slug'  => 'cybersecurity-workshop',
                'title' => 'Cybersecurity Awareness Workshop',
                'description' => 'Hands-on workshop covering penetration testing, network security, and digital forensics. Facilitated by industry experts from CyberSafe Foundation.',
                'date' => now()->addWeeks(3),
                'venue' => 'CSC Lab 2, Block B',
            ],
        ];

        foreach ($events as $e) {
            Event::firstOrCreate(['slug' => $e['slug']], $e);
        }

        // ──────────────────────────────────────
        // MORE ANNOUNCEMENTS
        // ──────────────────────────────────────
        $announcements = [
            [
                'title' => 'Mid-Semester Test Timetable Released',
                'body'  => 'The mid-semester continuous assessment timetable for all levels has been released. Students are advised to check the departmental notice board and the website for their schedules. All tests will hold at the designated venues.',
                'priority' => 'normal',
                'audience' => 'students',
                'expires_at' => now()->addDays(21),
            ],
            [
                'title' => 'IT/SIWES Logbook Submission Deadline',
                'body'  => 'All 400-level students who completed their IT/SIWES are reminded to submit their logbooks and presentation reports to the SIWES coordinator before the end of the month. Late submissions will not be accepted.',
                'priority' => 'urgent',
                'audience' => 'students',
                'expires_at' => now()->addDays(30),
            ],
            [
                'title' => 'Staff Senate Meeting — March 2026',
                'body'  => 'All academic staff are invited to the departmental senate meeting scheduled for the first Monday of March at 10:00 AM in the HOD\'s conference room. Agenda includes curriculum review and NUC compliance.',
                'priority' => 'normal',
                'audience' => 'staff',
                'expires_at' => now()->addDays(14),
            ],
        ];

        foreach ($announcements as $a) {
            Announcement::firstOrCreate(['title' => $a['title']], $a);
        }

        // ──────────────────────────────────────
        // MORE EXTERNAL SYSTEMS
        // ──────────────────────────────────────
        $systems = [
            ['name' => 'Student Result Portal',      'url' => '#', 'icon' => 'fa-solid fa-chart-line',            'description' => 'Check your semester results and GPA online',                 'sort_order' => 3],
            ['name' => 'E-Library Portal',            'url' => '#', 'icon' => 'fa-solid fa-book-open-reader',      'description' => 'Access research journals, e-books and academic publications', 'sort_order' => 4],
            ['name' => 'Course Registration Portal',  'url' => '#', 'icon' => 'fa-solid fa-clipboard-list',        'description' => 'Register for courses each semester online',                  'sort_order' => 5],
            ['name' => 'NSUK Learning Management',    'url' => '#', 'icon' => 'fa-solid fa-laptop-code',           'description' => 'Online classes, assignments, and course materials',          'sort_order' => 6],
        ];

        foreach ($systems as $sys) {
            $sys['is_active'] = true;
            $sys['open_in_new_tab'] = true;
            ExternalSystem::firstOrCreate(['name' => $sys['name']], $sys);
        }

        // ──────────────────────────────────────
        // GALLERY ALBUMS + IMAGES
        // ──────────────────────────────────────
        $albums = [
            [
                'title' => 'NUC Accreditation Visit 2025',
                'slug'  => 'nuc-accreditation-visit-2025',
                'description' => 'Photo highlights from the National Universities Commission accreditation team visit to the Department of Computer Science.',
                'date'  => '2025-11-15',
                'images' => [
                    ['caption' => 'The NUC team inspecting the computer laboratory', 'sort_order' => 1],
                    ['caption' => 'HOD presenting departmental achievements', 'sort_order' => 2],
                    ['caption' => 'Lab demonstration for the accreditation panel', 'sort_order' => 3],
                ],
            ],
            [
                'title' => 'NACOS Week 2025',
                'slug'  => 'nacos-week-2025',
                'description' => 'Scenes from the annual NACOS Week featuring tech exhibitions, competitions, and cultural events.',
                'date'  => '2025-10-20',
                'images' => [
                    ['caption' => 'Opening ceremony — NACOS President\'s address', 'sort_order' => 1],
                    ['caption' => 'Students showcasing projects at the tech fair', 'sort_order' => 2],
                    ['caption' => 'Hackathon in progress', 'sort_order' => 3],
                    ['caption' => 'Award presentation to best project team', 'sort_order' => 4],
                ],
            ],
            [
                'title' => 'Graduation Ceremony 2025',
                'slug'  => 'graduation-ceremony-2025',
                'description' => 'Memorable moments from the 2024/2025 convocation ceremony at Nasarawa State University, Keffi.',
                'date'  => '2025-07-08',
                'images' => [
                    ['caption' => 'Computer Science graduands in procession', 'sort_order' => 1],
                    ['caption' => 'Group photo of first-class graduates', 'sort_order' => 2],
                    ['caption' => 'HOD congratulating the best graduating student', 'sort_order' => 3],
                ],
            ],
        ];

        foreach ($albums as $albumData) {
            $images = $albumData['images'];
            unset($albumData['images']);

            $album = GalleryAlbum::firstOrCreate(['slug' => $albumData['slug']], $albumData);

            foreach ($images as $img) {
                GalleryImage::firstOrCreate([
                    'album_id'   => $album->id,
                    'sort_order' => $img['sort_order'],
                ], [
                    'album_id'   => $album->id,
                    'image_path' => 'gallery/' . $albumData['slug'] . '/img-' . $img['sort_order'] . '.jpg',
                    'caption'    => $img['caption'],
                    'sort_order' => $img['sort_order'],
                ]);
            }
        }

        // ──────────────────────────────────────
        // MORE CMS PAGES  (active, non-system)
        // ──────────────────────────────────────
        $pages = [
            [
                'title'   => 'Student Handbook',
                'slug'    => 'student-handbook',
                'icon'    => 'fa-solid fa-book',
                'is_system' => false,
                'is_active' => true,
                'content' => '<h2>Student Handbook</h2><p>This handbook contains essential information for all Computer Science students at NSUK, including academic policies, examination guidelines, course registration procedures, and departmental rules and regulations.</p><h3>Academic Calendar</h3><p>The academic session runs from October to July each year, split into two semesters of roughly 18 weeks each, including examinations.</p><h3>Examination Guidelines</h3><p>Students must maintain a minimum of 75% attendance to qualify for semester examinations. Examination malpractice will result in immediate expulsion.</p>',
            ],
            [
                'title'   => 'Research & Innovation',
                'slug'    => 'research-innovation',
                'icon'    => 'fa-solid fa-flask',
                'is_system' => false,
                'is_active' => true,
                'content' => '<h2>Research & Innovation</h2><p>The Department of Computer Science is actively involved in cutting-edge research across multiple domains including Artificial Intelligence, Cybersecurity, Data Science, and Human-Computer Interaction.</p><h3>Research Groups</h3><ul><li><strong>AI & Machine Learning Lab</strong> — Led by Prof. Adewale Okafor</li><li><strong>Cybersecurity Research Group</strong> — Led by Dr. Amina Yusuf</li><li><strong>Data Science & Analytics Unit</strong> — Led by Dr. Chukwudi Eze</li></ul><p>Students and staff interested in joining any research group should contact the group lead directly.</p>',
            ],
            [
                'title'   => 'Alumni Network',
                'slug'    => 'alumni-network',
                'icon'    => 'fa-solid fa-user-graduate',
                'is_system' => false,
                'is_active' => true,
                'content' => '<h2>Alumni Network</h2><p>Our alumni are thriving across the globe in technology companies, research institutions, government agencies, and entrepreneurial ventures. We maintain an active alumni network to foster mentorship, collaboration, and giving back.</p><h3>Notable Alumni</h3><p>Graduates of the department have gone on to work at Google, Microsoft, Andela, Interswitch, and various government parastatals. Several alumni have founded successful tech startups in Nigeria and abroad.</p><h3>Stay Connected</h3><p>Alumni are encouraged to register on our portal and attend annual homecoming events.</p>',
            ],
        ];

        foreach ($pages as $p) {
            Page::firstOrCreate(['slug' => $p['slug']], $p);
        }

        $this->command->info('✅ Homepage sample data seeded successfully.');
    }
}
