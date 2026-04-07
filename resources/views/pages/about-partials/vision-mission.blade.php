        <!-- ═══════════ VISION & MISSION ═══════════ -->
        <section data-aos="fade-up" id="vision-mission" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Vision, Mission & Objectives</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-vm-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <!-- Vision -->
                <div data-aos="fade-up" class="about-vm-card vision-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 16px; padding: 1.8rem; position: relative; overflow: hidden; border: 1px solid rgba(22, 163, 74, 0.15); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1), cursor 0.3s;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px -12px rgba(22,163,74,0.3)'; this.style.cursor='pointer'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(22, 163, 74, 0.08); transform: rotate(-15deg); pointer-events: none; transition: transform 0.4s ease;" class="bg-icon"><i class="fa-solid fa-eye"></i></div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1.2rem; box-shadow: 0 8px 20px -4px rgba(22, 163, 74, 0.4); transition: transform 0.3s;" class="main-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; color: #1e293b; margin: 0 0 0.8rem 0; font-family: var(--font-heading); font-weight: 700;">Our Vision</h3>
                    <p style="color: #334155; font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $settings['vision_statement'] ?? 'To be a leading edge in the area of competition, innovation, and society-responsive computing solutions, strategically aligning with the university\'s mission to promote technological advancement.' }}</p>
                </div>

                <!-- Mission -->
                <div data-aos="fade-up" class="about-vm-card mission-card" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border-radius: 16px; padding: 1.8rem; position: relative; overflow: hidden; border: 1px solid rgba(16, 185, 129, 0.15); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1), cursor 0.3s;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px -12px rgba(16,185,129,0.3)'; this.style.cursor='pointer'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(16, 185, 129, 0.08); transform: rotate(-15deg); pointer-events: none; transition: transform 0.4s ease;" class="bg-icon"><i class="fa-solid fa-bullseye"></i></div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1.2rem; box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.4); transition: transform 0.3s;" class="main-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; color: #1e293b; margin: 0 0 0.8rem 0; font-family: var(--font-heading); font-weight: 700;">Our Mission</h3>
                    <p style="color: #334155; font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $settings['mission_statement'] ?? 'To promote technological advancement by providing a conducive environment for research, teaching, and learning that engenders the development of products that are technology-oriented, self-reliant, and relevant to society.' }}</p>
                </div>
            </div>

            <!-- Objectives -->
            <div class="about-objectives-wrap" style="margin-top: 2.5rem;">
                {{-- Section Header --}}
                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 1rem; background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 20px; font-size: 0.75rem; font-weight: 700; color: #16a34a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.8rem;">
                        <i class="fa-solid fa-crosshairs" style="font-size: 0.65rem;"></i> Our Goals
                    </div>
                    <h3 style="font-size: 1.8rem; color: #0f172a; margin: 0 0 0.5rem; font-family: var(--font-heading); font-weight: 800;">What We Strive to Achieve</h3>
                    <p style="margin: 0 auto; max-width: 500px; font-size: 0.92rem; color: #64748b; line-height: 1.6;">Our department is guided by four key objectives that shape everything we do.</p>
                </div>

                @php
                    $objectives = [
                        ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.', 'color' => '#059669', 'light' => '#ecfdf5'],
                        ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.', 'color' => '#16a34a', 'light' => '#f0fdf4'],
                        ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.', 'color' => '#10b981', 'light' => '#ecfdf5'],
                        ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.', 'color' => '#047857', 'light' => '#f0fdf4'],
                    ];
                @endphp

                {{-- Timeline Layout --}}
                <div class="obj-timeline">
                    @foreach($objectives as $i => $obj)question-ai-logo
managemanage
managemanage
useruser
fullfull
closeclose
Chat AI
Hello! Is there any question I can help you with?
Who was the first person to step foot on the moon?
How to use the capture feature to ask questions?
Ask AI
logo
more
Stack
Context
Debug
Flare
Share
Share with Flare
Docs

Stack

Context

Debug
Create Share
Docs

Ignition Settings
Docs
Editor

PhpStorm
Theme
auto
Save settings
Settings will be saved locally in ~/.ignition.json.

syntax error, unexpected token "\"
ParseError
PHP 8.1.25
10.50.2
syntax error, unexpected token "\"

Expand vendor frames
C:\xampp\htdocs\p\dcms\resources\views\pages\home-partials\hod-welcome.blade
.php
 
: 63
require
15 vendor frames
App
 \ 
Http
 \ 
Middleware
 \ 
SecurityHeaders
 
: 13
handle
36 vendor frames
C:\xampp\htdocs\p\dcms\public\index
.php
 
: 52
require_once
1 vendor frame
C:\xampp\htdocs\p\dcms\resources\views\pages\home-partials\hod-welcome.blade
.php
 
: 63































            <div style="display: inline-flex; align-items: center; gap: 1.2rem; background: white; padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0;">

                <div style="width: 4px; height: 35px; background: linear-gradient(to bottom, var(--color-primary), var(--color-secondary)); border-radius: 2px;"></div>

                <div>

                    <h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1.1rem; font-family: var(--font-heading);">{{ $gs('hod_name', $hod->name ?? '') }}</h4>

                    <p style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 500;">{{ $gs('hod_rank', $hod->rank ?? '') }}, Head of Department</p>

                </div>

            </div>

            @endif

        </div>

    </div>



    <!-- Stats Counter Cards — integrated into HOD section -->

    <div class="container" data-aos="fade-up" style="margin-top: 4rem; padding-bottom: 4rem;">

        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.2rem; text-align: center;">

            @foreach([1,2,3,4,5] as $n)

            @php

                $statIcon  = $gs("stat_{$n}_icon",  ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-medal'][$n-1]);

                if ($n == 2 || stripos(\, 'courses') !== false) {

                    $statValue = \\App\\Models\\Course::count();

                } elseif ($n == 3 || stripos($statLabel, 'programmes') !== false) {

                    $statValue = \\App\\Models\\Programme::where('is_active', true)->count();

                } elseif ($n == 4 || stripos($statLabel, 'departments') !== false) {

                    $statValue = \\App\\Models\\ProgrammeCategory::count();

                } else {

                    $statValue = $gs("stat_{$n}_value", [config('university.established'), '', '', '', 'NUC'][$n-1]);

                }

                $statLabel = $gs("stat_{$n}_label", ['Established','Courses','Programmes','Departments','Full Accreditation'][$n-1]);

            @endphp

            <div data-aos="fade-up" class="stat-card">

                <div class="stat-bg-icon"><i class="{{ $statIcon }}"></i></div>
App
Routing
Views
Request
Browser
Headers
Body
Context
User
Versions
App
Routing
Controller
App\Http\Controllers\HomeController@index

Route name
home

Middleware
web

Views
View
C:\xampp\htdocs\p\dcms\resources\views\pages\home-partials\hod-welcome.blade
.php
Data
errors
Illuminate\Support\ViewErrorBag {#1334 ▼
  #bags: []
}
programmes
Illuminate\Database\Eloquent\Collection {#1332 ▼
  #items: array:3 [▶]
  #escapeWhenCastingToString: false
}
news
Illuminate\Database\Eloquent\Collection {#1341 ▼
  #items: array:2 [▶]
  #escapeWhenCastingToString: false
}
events
Illuminate\Database\Eloquent\Collection {#1344 ▼
  #items: array:3 [▶]
  #escapeWhenCastingToString: false
}
announcements
Illuminate\Database\Eloquent\Collection {#1348 ▼
  #items: array:2 [▶]
  #escapeWhenCastingToString: false
}
hod
App\Models\Staff {#1351 ▼
  #connection: "mysql"
  #table: "staff"
  #primaryKey: "id"
  #keyType: "int"
  +incrementing: true
  #with: []
  #withCount: []
  +preventsLazyLoading: false
  #perPage: 15
  +exists: true
  +wasRecentlyCreated: false
  #escapeWhenCastingToString: false
  #attributes: array:22 [▶]
  #original: array:22 [▶]
  #changes: []
  #casts: array:1 [▶]
  #classCastCache: []
  #attributeCastCache: []
  #dateFormat: null
  #appends: []
  #dispatchesEvents: []
  #observables: []
  #relations: []
  #touches: []
  +timestamps: true
  +usesUniqueIds: false
  #hidden: []
  #visible: []
  #fillable: []
  #guarded: []
}
staffCount
10
courseCount
16
carouselSlides
Illuminate\Database\Eloquent\Collection {#1352 ▼
  #items: array:3 [▶]
  #escapeWhenCastingToString: false
}
featuredStaff
Illuminate\Database\Eloquent\Collection {#1356 ▼
  #items: array:4 [▶]
  #escapeWhenCastingToString: false
}
galleryImages
Illuminate\Database\Eloquent\Collection {#1361 ▼
  #items: array:8 [▶]
  #escapeWhenCastingToString: false
}
galleryAlbumCount
3
externalSystems
Illuminate\Database\Eloquent\Collection {#1370 ▼
  #items: array:2 [▶]
  #escapeWhenCastingToString: false
}
cmsPages
Illuminate\Database\Eloquent\Collection {#1373 ▼
  #items: array:6 [▶]
  #escapeWhenCastingToString: false
}
partners
Illuminate\Database\Eloquent\Collection {#1380 ▼
  #items: array:2 [▶]
  #escapeWhenCastingToString: false
}
nacosPresidents
Illuminate\Database\Eloquent\Collection {#1383 ▼
  #items: array:3 [▶]
  #escapeWhenCastingToString: false
}
nacosTotalCount
5
timetables
Illuminate\Database\Eloquent\Collection {#1387 ▼
  #items: []
  #escapeWhenCastingToString: false
}
uploadedTimetable
"timetable/department-timetable.png"
brandColors
array:3 [▼
  "primary" => "#16a34a"
  "secondary" => "#15803d"
  "accent" => "#22c55e"
]
Request
http://localhost:3000/
GET
curl "http://localhost:3000/" \
   -X GET \
   -H 'host: localhost:3000' \
   -H 'connection: keep-alive' \
   -H 'cache-control: max-age=0' \
   -H 'sec-ch-ua: "Chromium";v="146", "Not-A.Brand";v="24", "Google Chrome";v="146"' \
   -H 'sec-ch-ua-mobile: ?0' \
   -H 'sec-ch-ua-platform: "Windows"' \
   -H 'upgrade-insecure-requests: 1' \
   -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36' \
   -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7' \
   -H 'sec-fetch-site: same-origin' \
   -H 'sec-fetch-mode: navigate' \
   -H 'sec-fetch-dest: document' \
   -H 'referer: http://localhost:3000/' \
   -H 'accept-encoding: gzip, deflate, br, zstd' \
   -H 'accept-language: en-US,en;q=0.9' \
   -H 'cookie: <CENSORED>';


Browser
Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36

Headers
host
localhost:3000

connection
keep-alive

cache-control
max-age=0

sec-ch-ua
"Chromium";v="146", "Not-A.Brand";v="24", "Google Chrome";v="146"

sec-ch-ua-mobile
?0

sec-ch-ua-platform
"Windows"

upgrade-insecure-requests
1

user-agent
Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36

accept
text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7

sec-fetch-site
same-origin

sec-fetch-mode
navigate

sec-fetch-dest
document

referer
http://localhost:3000/

accept-encoding
gzip, deflate, br, zstd

accept-language
en-US,en;q=0.9

cookie
<CENSORED>

Body
[]

Context
User
admin@cmpnsuk.edu.ng
Admin User

admin@cmpnsuk.edu.ng

{
    "id": 5,
    "name": "Admin User",
    "email": "admin@cmpnsuk.edu.ng",
    "is_admin": true,
    "role": "admin",
    "email_verified_at": "2026-03-20T13:09:16.000000Z",
    "created_at": "2026-03-20T13:09:16.000000Z",
    "updated_at": "2026-03-20T13:09:16.000000Z"
}


Versions
Php Version
8.1.25

Laravel Version
10.50.2

Laravel Locale
en

Laravel Config Cached
false
App Debug
true
App Env
local


3
Queries
3:37:53 PM
6.27ms
mysql
select table_name as `name`, (data_length + index_length) as `size`, table_comment as `comment`, engine as `engine`, table_collation as `collation` from information_schema.tables where table_schema = 'dcms_db' and table_type in ('BASE TABLE', 'SYSTEM VERSIONED') order by table_name


3:37:53 PM
0.99ms
mysql
select `value`, `key` from `department_settings` where `group` = branding


1 query parameter
3:37:53 PM
0.82ms
mysql
select * from `users` where `id` = 5 limit 1


1 query parameter
·
Source
·
Docs
·
Laravel
Ignition is built byFlare, the Laravel error reporting service.
                    <div class="obj-row {{ $i % 2 === 0 ? '' : 'obj-row-reverse' }}">
                        {{-- Number Side --}}
                        <div class="obj-number-side">
                            <div class="obj-big-num" style="color: {{ $obj['color'] }};">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>

                        {{-- Connector --}}
                        <div class="obj-connector">
                            <div class="obj-dot" style="background: {{ $obj['color'] }}; box-shadow: 0 0 0 4px {{ $obj['light'] }}, 0 0 0 5px {{ $obj['color'] }}33;"></div>
                            @if($i < count($objectives) - 1)
                            <div class="obj-line"></div>
                            @endif
                        </div>

                        {{-- Content Side --}}
                        <div class="obj-content-side">
                            <div data-aos="fade-up" class="obj-content-card" style="border-left: 3px solid {{ $obj['color'] }};">
                                <div class="obj-content-header">
                                    <div class="obj-icon" style="background: {{ $obj['light'] }}; color: {{ $obj['color'] }};">
                                        <i class="fa-solid {{ $obj['icon'] }}"></i>
                                    </div>
                                    <h4 class="obj-title">{{ $obj['title'] }}</h4>
                                </div>
                                <p class="obj-text">{{ $obj['text'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
