@extends('layouts.public')

@section('title', 'About Us')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_about')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp
<!-- Hero Section -->
<div class="about-hero relative overflow-hidden py-[5.5rem] pb-[6.5rem] bg-cover bg-center" style="background-image: url('{{ $heroUrl }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/[0.97] via-emerald-800/[0.92] to-slate-900/[0.95]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(16,185,129,0.15),transparent_50%),radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.1),transparent_50%)] pointer-events-none"></div>
    <div class="absolute -top-[100px] -right-[100px] w-[400px] h-[400px] border border-white/[0.04] rounded-full"></div>
    <div class="absolute -bottom-[150px] -left-[80px] w-[500px] h-[500px] border border-white/[0.03] rounded-full"></div>
    <div class="container relative z-10 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-5 py-1.5 bg-white/5 backdrop-blur-md text-emerald-200 rounded-full text-[0.8rem] font-semibold tracking-[1.5px] uppercase mb-6 border border-white/10">
            <i class="fa-solid fa-landmark text-[0.7rem]"></i> {{ $gs('about_hero_badge', 'About Us') }}
        </div>
        <h1 class="text-white text-[3.2rem] font-heading m-0 mb-4 font-extrabold [text-shadow:0_4px_20px_rgba(0,0,0,0.3)]">{{ $gs('about_hero_title', 'About Our Department') }}</h1>
        <p class="text-slate-300 text-[1.15rem] max-w-[680px] mx-auto leading-[1.7]">{{ $gs('about_hero_subtitle', 'Department of Computer Science, Faculty of Natural and Applied Sciences — Nasarawa State University, Keffi') }}</p>
    </div>
</div>

<div class="container page-layout relative z-20 mt-[-3rem] pb-16">
    <div class="main-content about-main bg-white rounded-2xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] p-12 max-md:p-8">

        <!-- ═══════════ OUR STORY ═══════════ -->
        <section data-aos="fade-up" id="our-story" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_story_title', 'Our Story') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[2rem] rounded-full"></div>

            <div class="about-story-layout flex gap-10 items-start flex-wrap mb-8">
                {{-- HOD Card --}}
                <div data-aos="fade-up" class="about-hod-card flex-[0_0_220px] max-w-[220px]">
                    <div class="aspect-square rounded-[14px] overflow-hidden shadow-[0_12px_30px_rgba(0,0,0,0.1)] border-[3px] border-solid border-[color:var(--color-accent)]">
                        @if(isset($hod) && $hod && $hod->photo)
                            <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-green-50 p-6">
                                <img src="{{ asset(config('university.logo', 'images/logo.png')) }}" alt="Department Logo" class="w-4/5 h-4/5 object-contain">
                            </div>
                        @endif
                    </div>
                    <div class="text-center mt-3">
                        @if(isset($hod) && $hod)
                            <p class="m-0 font-bold text-slate-900 text-[0.95rem]">{{ $hod->name }}</p>
                            <p class="m-0 text-[color:var(--color-primary)] text-[0.82rem]">{{ $hod->rank }}, HOD</p>
                        @else
                            <p class="m-0 font-bold text-slate-900 text-[0.95rem]">Head of Department</p>
                            <p class="m-0 text-[color:var(--color-primary)] text-[0.82rem]">Department of Computer Science</p>
                        @endif
                    </div>
                </div>

                {{-- Story Text --}}
                <div class="about-story-text flex-1 min-w-[280px] text-[1.05rem] leading-[1.85] text-slate-600">
                @php
                    $introBody = $settings['about_intro_body'] ?? '';
                    $historyText = $settings['about_history'] ?? '';
                @endphp
                @if($introBody)
                    <div>{!! nl2br(e($introBody)) !!}</div>
                @else
                <p>The Department of Computer Science was established as a <strong>Unit</strong> in the Department of Mathematical Sciences, Faculty of Natural and Applied Sciences, in the <strong>2003/2004</strong> academic session and was upgraded to the status of a full <strong>Department in the 2017/18 session</strong>.</p>

                <div class="about-quote border-l-4 border-l-[color:var(--color-primary)] py-[1.2rem] px-6 bg-gradient-to-r from-green-600/[0.04] to-transparent rounded-r-lg my-6 italic text-slate-700 text-[1.08rem] leading-[1.7]">
                    "The goal of the department is to be a leading edge in the area of competition, innovation, and society-responsive computing solutions — strategically aligning with the university's mission."
                </div>

                <p>With effect from the <strong>2021/2022</strong> academic session, two new programmes — <strong>Data Science & Technology</strong> and <strong>Cybersecurity & Forensic</strong> — were introduced alongside the core Computer Science programme.</p>

                <p>The department develops focused, trend-setting multidisciplinary research excellence with national, regional, and international recognition through diverse research projects. Our programmes are designed to produce <strong>market-ready graduates</strong> with the appropriate information technology skills and capacity for independent thinking, self-reliance, creativity, and resourcefulness.</p>

                <p>Our curricula are unique, robust, current, and comparable with international best practice — designed to meet and surpass academic standards prescribed by regulatory authorities. The development and implementation of our programmes are defined by ideals of <strong>inclusivity and accessibility</strong> to the Nasarawa State community we serve and the nation at large.</p>
                @endif
                @if($historyText)
                    <div class="mt-5 py-4 px-6 bg-slate-50 border-l-[3px] border-l-[color:var(--color-primary)] rounded-r-lg text-slate-600 text-[0.97rem] leading-[1.7]">{!! nl2br(e($historyText)) !!}</div>
                @endif
                </div>
            </div>

            <!-- Timeline Milestones -->
            <style>
                @media (min-width: 992px) {
                    .about-milestones-grid {
                        grid-template-columns: repeat(4, 1fr) !important;
                    }
                }
                @media (max-width: 991px) {
                    .about-milestones-grid {
                        grid-template-columns: repeat(2, 1fr) !important;
                    }
                }
                @media (max-width: 575px) {
                    .about-milestones-grid {
                        grid-template-columns: repeat(2, 1fr) !important;
                    }
                    .about-milestones-grid .milestone-year {
                        font-size: 1.5rem !important;
                    }
                }
            </style>
            <div class="about-milestones flex flex-wrap max-md:grid max-md:grid-cols-2 max-[480px]:grid-cols-1 gap-5 mt-10">
                @php
                    $milestones = json_decode($settings['about_milestones'] ?? '[]', true) ?? [];
                    if (empty($milestones)) {
                        $milestones = [
                            ['year' => '2003', 'title' => 'Established as a Unit'],
                            ['year' => '2017', 'title' => 'Upgraded to Department'],
                            ['year' => '2021', 'title' => 'New Programmes Added'],
                            ['year' => '11+', 'title' => 'Academic Programmes']
                        ];
                    }
                @endphp
                @foreach($milestones as $ms)
                <div class="flex-1 min-w-[200px] text-center p-6 bg-white rounded-[14px] border border-green-600/20 shadow-[0_4px_15px_-3px_rgba(22,163,74,0.05)]">
                    <div class="milestone-year text-[2rem] font-extrabold text-[color:var(--color-primary)] font-heading">{{ $ms['year'] ?? '' }}</div>
                    <div class="text-[0.85rem] text-slate-600 mt-1 font-medium">{{ $ms['title'] ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ═══════════ VISION & MISSION ═══════════ -->
        <section data-aos="fade-up" id="vision-mission" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_vm_title', 'Vision, Mission & Objectives') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[2rem] rounded-full"></div>

            <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-6">
                <!-- Vision -->
                <div data-aos="fade-up" class="group bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-10 relative overflow-hidden border border-green-600/15 transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_20px_40px_-12px_rgba(22,163,74,0.2)]">
                    <div class="absolute -top-5 -right-5 text-[7rem] text-green-600/[0.06] -rotate-15 pointer-events-none"><i class="fa-solid fa-eye"></i></div>
                    <div class="w-[52px] h-[52px] bg-gradient-to-br from-green-600 to-green-700 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] mb-6 shadow-[0_8px_20px_-4px_rgba(22,163,74,0.4)]">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 class="text-[1.4rem] text-slate-800 m-0 mb-4 font-heading font-bold">{{ $gs('about_vision_label', 'Our Vision') }}</h3>
                    <p class="text-slate-700 text-[1rem] leading-[1.7] m-0">{{ $settings['about_vision'] ?? $settings['vision_statement'] ?? 'To be a leading edge in the area of competition, innovation, and society-responsive computing solutions, strategically aligning with the university\'s mission to promote technological advancement.' }}</p>
                </div>

                <!-- Mission -->
                <div data-aos="fade-up" class="group bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-10 relative overflow-hidden border border-emerald-500/15 transition-all duration-300 hover:-translate-y-[5px] hover:shadow-[0_20px_40px_-12px_rgba(16,185,129,0.2)]">
                    <div class="absolute -top-5 -right-5 text-[7rem] text-emerald-500/[0.06] -rotate-15 pointer-events-none"><i class="fa-solid fa-bullseye"></i></div>
                    <div class="w-[52px] h-[52px] bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] mb-6 shadow-[0_8px_20px_-4px_rgba(16,185,129,0.4)]">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 class="text-[1.4rem] text-slate-800 m-0 mb-4 font-heading font-bold">{{ $gs('about_mission_label', 'Our Mission') }}</h3>
                    <p class="text-slate-700 text-[1rem] leading-[1.7] m-0">{{ $settings['about_mission'] ?? $settings['mission_statement'] ?? 'To promote technological advancement by providing a conducive environment for research, teaching, and learning that engenders the development of products that are technology-oriented, self-reliant, and relevant to society.' }}</p>
                </div>
            </div>

            <!-- Objectives -->
            <div class="about-objectives-wrap mt-6 bg-white rounded-[20px] p-12 border border-green-600/12 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] relative overflow-hidden max-md:p-8">
                <div class="absolute -top-10 -right-10 w-[200px] h-[200px] bg-[radial-gradient(circle,rgba(22,163,74,0.05),transparent_70%)] pointer-events-none"></div>
                <div class="absolute -bottom-[30px] -left-[30px] w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(16,185,129,0.04),transparent_70%)] pointer-events-none"></div>
                <div class="flex items-center gap-4 mb-8 relative">
                    <div class="w-[52px] h-[52px] bg-gradient-to-br from-green-600 to-green-700 text-white rounded-[14px] flex items-center justify-center text-[1.4rem] shadow-[0_8px_20px_-4px_rgba(22,163,74,0.4)]">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h3 class="text-[1.4rem] text-slate-800 m-0 font-heading font-bold">{{ $gs('about_objectives_title', 'Our Objectives') }}</h3>
                        <p class="mt-1 mb-0 text-[0.85rem] text-slate-500">{{ $gs('about_objectives_subtitle', 'What we strive to achieve') }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4 relative">
                    @php
                        $objectives = json_decode($settings['about_objectives'] ?? '[]', true) ?? [];
                        if (empty($objectives)) {
                            $objectives = [
                                ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.', 'accent' => '#059669'],
                                ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.', 'accent' => '#16a34a'],
                                ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.', 'accent' => '#10b981'],
                                ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.', 'accent' => '#047857'],
                            ];
                        }
                    @endphp
                    @foreach($objectives as $i => $obj)
                    <div class="text-center py-5 px-4 bg-stone-50 rounded-xl border border-green-600/[0.05] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_12px_28px_-6px_rgba(22,163,74,0.12)] hover:border-green-600/20 cursor-default">
                        <div class="w-10 h-10 bg-green-600/[0.06] text-[color:var(--color-primary)] rounded-lg flex items-center justify-center text-[1rem] mx-auto mb-3 border border-green-600/10">
                            <i class="fa-solid {{ $obj['icon'] ?? 'fa-bullseye' }}"></i>
                        </div>
                        <h4 class="m-0 mb-1.5 text-[0.85rem] font-bold text-slate-800 font-heading">{{ $obj['title'] ?? '' }}</h4>
                        <p class="m-0 text-slate-600 text-[0.82rem] leading-[1.6]">{{ $obj['text'] ?? '' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ═══════════ CORE VALUES ═══════════ -->
        <section data-aos="fade-up" id="core-values" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_values_title', 'Core Values') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[2rem] rounded-full"></div>

            <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-5">
                @php
                    $coreValues = json_decode($settings['about_core_values'] ?? '[]', true) ?? [];
                    if (empty($coreValues)) {
                        $coreValues = [
                            ['title' => 'Innovation', 'icon' => 'fa-lightbulb', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'description' => 'Pioneering creative solutions in technology'],
                            ['title' => 'Excellence', 'icon' => 'fa-award', 'color' => '#15803d', 'bg' => '#f0fdf4', 'description' => 'Pursuing the highest academic standards'],
                            ['title' => 'Integrity', 'icon' => 'fa-shield-halved', 'color' => '#10b981', 'bg' => '#ecfdf5', 'description' => 'Upholding ethical principles in all endeavors'],
                            ['title' => 'Self-Reliance', 'icon' => 'fa-person-rays', 'color' => '#047857', 'bg' => '#ecfdf5', 'description' => 'Building independent and capable professionals'],
                            ['title' => 'Inclusivity', 'icon' => 'fa-people-group', 'color' => '#059669', 'bg' => '#f0fdf4', 'description' => 'Accessible education for all communities'],
                            ['title' => 'Creativity', 'icon' => 'fa-palette', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'description' => 'Fostering original thinking and resourcefulness'],
                        ];
                    }
                    $colors = ['#16a34a', '#15803d', '#10b981', '#047857', '#059669'];
                    $bgs = ['#f0fdf4', '#ecfdf5'];
                @endphp
                @foreach($coreValues as $i => $val)
                @php
                    $c = $val['color'] ?? $colors[$i % count($colors)];
                    $b = $val['bg'] ?? $bgs[$i % count($bgs)];
                @endphp
                <div class="text-center py-8 px-5 bg-[{{ $b }}] rounded-[14px] border border-[{{ $c }}20] transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_18px_35px_-8px_{{ $c }}25] cursor-default">
                    <div class="w-14 h-14 mx-auto mb-4 bg-gradient-to-br from-[{{ $c }}] to-[{{ $c }}dd] text-white rounded-full flex items-center justify-center text-[1.5rem] shadow-[0_8px_20px_-4px_{{ $c }}40]">
                        <i class="fa-solid {{ $val['icon'] ?? 'fa-star' }}"></i>
                    </div>
                    <h4 class="m-0 mb-1 z-[1.1rem] text-slate-800 font-bold mb-1.5">{{ $val['title'] ?? '' }}</h4>
                    <p class="m-0 text-[0.82rem] text-slate-500 leading-[1.5]">{{ $val['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ═══════════ PROGRAMMES OVERVIEW ═══════════ -->
        <section data-aos="fade-up" id="programmes" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_programmes_title', 'Academic Programmes') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[1rem] rounded-full"></div>
            <p class="text-[1.02rem] text-slate-500 leading-[1.7] mb-8">{{ $settings['about_programmes_desc'] ?? 'The department offers Bachelor\'s, Post-graduate Diploma, Master\'s, and PhD degrees in Computer Science, Cybersecurity & Forensic, and Data Science & Technology.' }}</p>

            <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-5">
                @php
                    $programmes = json_decode($settings['about_programmes'] ?? '[]', true) ?? [];
                    if (empty($programmes)) {
                        $programmes = [
                            [
                                'title' => 'Postgraduate',
                                'icon' => 'fa-hat-wizard',
                                'theme_main' => '#0f172a',
                                'theme_accent' => '#1e293b',
                                'items' => "Ph.D. Computer Science\nM.Phil./Ph.D. Computer Science\nM.Sc. Computer Science\nM.Sc. (Database/Info Systems)\nM.Sc. (Information Security)\nM.Sc. (Networking)\nM.Sc. (Software Engineering)\nPGD Computer Science"
                            ],
                            [
                                'title' => 'Undergraduate',
                                'icon' => 'fa-user-graduate',
                                'theme_main' => '#f0fdf4',
                                'theme_accent' => '#dcfce7',
                                'items' => "B.Sc. Computer Science\nB.Sc. Network Technology & Cybersecurity\nB.Sc. Software Engineering"
                            ]
                        ];
                    }
                @endphp
                @foreach($programmes as $prog)
                @php 
                  $isDark = in_array(strtolower($prog['theme_main'] ?? ''), ['#0f172a', '#1e293b', 'black']);
                  $textColor = $isDark ? 'white' : '#1e293b';
                  $iconBg = $isDark ? 'rgba(16, 185, 129, 0.2)' : 'rgba(22, 163, 74, 0.15)';
                  $iconColor = $isDark ? '#6ee7b7' : 'var(--color-primary)';
                  $listColor = $isDark ? '#cbd5e1' : '#334155';
                  $bulletColor = $isDark ? '#10b981' : 'var(--color-primary)';
                  $border = $isDark ? 'none' : '1px solid #bbf7d0';
                @endphp
                <div class="rounded-[14px] p-8 text-[{{ $textColor }}] relative overflow-hidden border-[{{ $border }}]" style="background: linear-gradient(135deg, {{ $prog['theme_main'] ?? '#0f172a' }} 0%, {{ $prog['theme_accent'] ?? '#1e293b' }} 100%);">
                    <div class="absolute -top-8 -right-8 w-[100px] h-[100px] rounded-full bg-[{{ $isDark ? 'rgba(255,255,255,0.04)' : 'rgba(22,163,74,0.06)' }}]"></div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[{{ $iconBg }}] text-[{{ $iconColor }}]">
                            <i class="fa-solid {{ $prog['icon'] ?? 'fa-graduation-cap' }}"></i>
                        </div>
                        <h4 class="m-0 text-[1.1rem] font-bold">{{ $prog['title'] ?? '' }}</h4>
                    </div>
                    <ul class="list-none p-0 m-0 flex flex-col gap-2.5">
                        @foreach(explode("\n", $prog['items'] ?? '') as $item)
                        @if(trim($item))
                        <li class="flex items-center gap-2 text-[0.88rem] text-[{{ $listColor }}]"><i class="fa-solid fa-chevron-right text-[0.55rem] text-[{{ $bulletColor }}]"></i> {!! trim($item) !!}</li>
                        @endif
                        @endforeach
                    </ul>
                    @if(!$isDark)
                    <a href="{{ url('/academics') }}" class="group/link inline-flex items-center gap-2 mt-6 text-[0.88rem] text-[color:var(--color-primary)] font-semibold no-underline hover:gap-3 transition-all duration-200">View full programme details <i class="fa-solid fa-arrow-right text-[0.75rem] transition-transform duration-200"></i></a>
                    @endif
                </div>
                @endforeach
            </div>
        </section>

        <!-- ═══════════ DEPARTMENTAL BOARD ═══════════ -->
        <section data-aos="fade-up" id="departmental-board" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-sitemap"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_board_title', 'Departmental Board') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[2rem] rounded-full"></div>

            <p class="text-[1.02rem] text-slate-600 leading-[1.7] mb-8">{{ $settings['about_board_desc'] ?? 'The Departmental Board is made up of all lecturers in the Department except Graduate Assistants, with the Head of Department as the Chairman. The Board organizes and controls the teaching of all courses and the examinations held in those courses.' }}</p>

            <div class="about-board-grid grid grid-cols-[repeat(auto-fit,minmax(260px,1fr))] gap-5">
                @php
                    $board = json_decode($settings['about_board'] ?? '[]', true) ?? [];
                    if (empty($board)) {
                        $board = [
                            ['title' => 'Chairman', 'icon' => 'fa-crown', 'who' => 'Head of Department (HOD)'],
                            ['title' => 'Members', 'icon' => 'fa-users', 'who' => "All Academic Staff\n(Except Graduate Assistants)"],
                            ['title' => 'Mandate', 'icon' => 'fa-clipboard-check', 'who' => 'Course organisation, teaching oversight & examination control'],
                        ];
                    }
                @endphp
                @foreach($board as $i => $bm)
                @if($i == 0)
                <!-- Chairman (highlighted) -->
                <div class="bg-gradient-to-br from-emerald-900 to-emerald-800 rounded-[14px] p-8 text-white text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(16,185,129,0.2),transparent_70%)] pointer-events-none"></div>
                    <div class="relative z-[2]">
                        <div class="w-16 h-16 bg-white/10 border-2 border-white/20 rounded-full flex items-center justify-center mx-auto mb-5 text-[1.8rem] text-emerald-200">
                            <i class="fa-solid {{ $bm['icon'] ?? 'fa-crown' }}"></i>
                        </div>
                        <h4 class="m-0 mb-1 text-[1.15rem] font-bold">{{ $bm['title'] ?? '' }}</h4>
                        <p class="m-0 text-emerald-300 text-[0.9rem]">{!! nl2br(e($bm['who'] ?? '')) !!}</p>
                    </div>
                </div>
                @else
                <!-- Members / Mandate -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-[14px] p-8 text-center border border-green-200">
                    <div class="w-16 h-16 bg-green-600/10 rounded-full flex items-center justify-center mx-auto mb-5 text-[1.8rem] text-[color:var(--color-primary)]">
                        <i class="fa-solid {{ $bm['icon'] ?? 'fa-users' }}"></i>
                    </div>
                    <h4 class="m-0 mb-1 text-[1.15rem] text-slate-800 font-bold">{{ $bm['title'] ?? '' }}</h4>
                    <p class="m-0 text-slate-500 text-[0.9rem]">{!! nl2br(e($bm['who'] ?? '')) !!}</p>
                </div>
                @endif
                @endforeach
            </div>
        </section>

        <!-- ═══════════ ENTRY REQUIREMENTS ═══════════ -->
        <section data-aos="fade-up" id="entry-requirements" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_requirements_title', 'Entry Requirements') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[2rem] rounded-full"></div>

            <div class="about-req-grid grid grid-cols-[repeat(auto-fit,minmax(180px,1fr))] gap-4">
                @php
                    $requirements = json_decode($settings['about_requirements'] ?? '[]', true) ?? [];
                    if (empty($requirements)) {
                        $requirements = [
                            ['level' => 'O\' Level', 'icon' => 'fa-school', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'WAEC/NECO with 5 credits including Maths & English'],
                            ['level' => 'A\' Level', 'icon' => 'fa-book-open', 'color' => '#15803d', 'bg' => '#f0fdf4', 'desc' => 'Advanced Level or JUPEB with required passes'],
                            ['level' => 'UTME', 'icon' => 'fa-pen-fancy', 'color' => '#059669', 'bg' => '#ecfdf5', 'desc' => 'Mathematics, English, Physics & one of Chemistry/Biology/Economics'],
                            ['level' => 'Postgraduate', 'icon' => 'fa-user-graduate', 'color' => '#10b981', 'bg' => '#f0fdf4', 'desc' => 'B.Sc. in Computer Science or related field with minimum of 2nd Class'],
                            ['level' => 'PhD', 'icon' => 'fa-hat-wizard', 'color' => '#047857', 'bg' => '#ecfdf5', 'desc' => 'M.Sc. in Computer Science or related field'],
                        ];
                    }
                @endphp
                @foreach($requirements as $req)
                <div class="p-6 bg-[{{ $req['bg'] ?? '#f0fdf4' }}] rounded-xl text-center border border-[{{ $req['color'] ?? '#16a34a' }}15] transition-transform duration-300 hover:-translate-y-1">
                    <div class="w-11 h-11 bg-[{{ $req['color'] ?? '#16a34a' }}] text-white rounded-xl flex items-center justify-center text-[1.2rem] mx-auto mb-4 shadow-[0_6px_15px_-3px_{{ $req['color'] ?? '#16a34a' }}40]">
                        <i class="fa-solid {{ $req['icon'] ?? 'fa-check' }}"></i>
                    </div>
                    <h4 class="m-0 mb-1.5 text-[1rem] text-slate-800 font-bold">{{ $req['level'] ?? '' }}</h4>
                    <p class="m-0 text-[0.8rem] text-slate-500 leading-[1.5]">{{ $req['desc'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-6">
                <a href="{{ $gs('about_req_btn_url', '/academics') }}" style="display: inline-flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; color: var(--color-primary); font-weight: 600; text-decoration: none; padding: 0.6rem 1.5rem; border: 2px solid var(--color-primary); border-radius: 10px; transition: all 0.3s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='var(--color-primary)'">{{ $gs('about_req_btn_text', 'See Full Admission Details') }} <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i></a>
            </div>
        </section>

        <!-- ═══════════ FACILITIES & LABS ═══════════ -->
        <section data-aos="fade-up" id="facilities" class="mb-16">
            <div class="section-heading flex items-center gap-4 mb-6">
                <div class="section-heading-icon w-12 h-12 bg-gradient-to-br from-green-600/15 to-emerald-500/10 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-server"></i>
                </div>
                <h2 class="m-0 text-[2rem] text-slate-900 font-heading font-bold">{{ $gs('about_section_facilities_title', 'Facilities & Labs') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-[color:var(--color-primary)] to-[color:var(--color-accent)] mb-[1rem] rounded-full"></div>
            <p class="text-[1.02rem] text-slate-500 leading-[1.7] mb-8">{{ $settings['about_facilities_desc'] ?? 'Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.' }}</p>

            <div class="about-facilities-grid grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-5">
                @php
                    $cmsLabs = json_decode($settings['about_facilities'] ?? '[]', true) ?? [];
                    $defaultLabs = [
                        ['name' => 'Software Engineering Lab', 'icon' => 'fa-code', 'description' => 'Modern IDEs and collaboration tools for full-stack software development, testing, and real-world project simulations.'],
                        ['name' => 'Hardware & Networking Lab', 'icon' => 'fa-network-wired', 'description' => 'Hands-on experience with CISCO routing, switching, and embedded systems micro-controller design.'],
                        ['name' => 'AI & Data Science Hub', 'icon' => 'fa-microchip', 'description' => 'High-performance computing clusters for machine learning, big data analytics, and advanced algorithmic processing.'],
                        ['name' => 'Cybersecurity Lab', 'icon' => 'fa-shield-halved', 'description' => 'Dedicated environment for penetration testing, digital forensics, and cybersecurity research.'],
                    ];
                    $labColors = ['linear-gradient(135deg, #16a34a, #15803d)', 'linear-gradient(135deg, #10b981, #059669)', 'linear-gradient(135deg, #059669, #047857)', 'linear-gradient(135deg, #15803d, #14532d)'];
                    $labShadows = ['rgba(22,163,74,0.3)', 'rgba(16,185,129,0.3)', 'rgba(5,150,105,0.3)', 'rgba(21,128,61,0.3)'];
                    $displayLabs = !empty($cmsLabs) ? $cmsLabs : $defaultLabs;
                @endphp
                @foreach($displayLabs as $i => $lab)
                <div data-aos="fade-up" class="about-facilities-card flex gap-5 bg-slate-50 p-7 rounded-[14px] border border-slate-200 transition-all duration-300 hover:bg-slate-100 hover:-translate-y-[3px] hover:shadow-[0_10px_25px_-8px_rgba(0,0,0,0.08)]">
                    <div class="w-14 h-14 rounded-[14px] bg-[{{ $labColors[$i % count($labColors)] }}] text-white flex items-center justify-center text-[1.6rem] shrink-0 shadow-[0_8px_20px_-4px_{{ $labShadows[$i % count($labShadows)] }}]">
                        <i class="fa-solid {{ $lab['icon'] ?? 'fa-flask' }}"></i>
                    </div>
                    <div>
                        <strong class="text-[1.1rem] block mb-1.5 text-slate-800 font-heading">{{ $lab['name'] ?? '' }}</strong>
                        <p class="m-0 text-slate-500 leading-[1.6] text-[0.92rem]">{{ $lab['description'] ?? '' }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ═══════════ FACULTY CTA ═══════════ -->
        <section data-aos="fade-up" id="our-faculty">
                <div class="about-faculty-cta bg-gradient-to-br from-[color:var(--color-primary)] via-emerald-700 to-teal-800 rounded-2xl p-14 text-white text-center relative overflow-hidden shadow-[0_15px_30px_-8px_rgba(22,163,74,0.4)]">
                <div class="absolute -top-[60px] -right-[60px] w-[250px] h-[250px] bg-white/[0.06] rounded-full"></div>
                <div class="absolute -bottom-[80px] -left-10 w-[200px] h-[200px] bg-white/[0.04] rounded-full"></div>
                <div class="absolute top-1/2 left-[10%] w-[120px] h-[120px] border border-white/[0.08] rounded-full -translate-y-1/2"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 py-[0.35rem] px-4 bg-white/10 text-emerald-200 rounded-full text-[0.75rem] font-semibold tracking-[1.5px] uppercase mb-5 border border-white/[0.15]">
                        <i class="fa-solid fa-users text-[0.65rem]"></i> {{ $gs('about_faculty_badge', '27+ Academic Staff') }}
                    </div>
                    <h2 class="m-0 mb-4 text-[2.2rem] font-heading font-extrabold">{{ $gs('about_faculty_title', 'Meet Our Faculty') }}</h2>
                    <p class="text-[1.05rem] max-w-[600px] mx-auto mb-8 leading-[1.7] text-emerald-100">
                        {!! $settings['about_faculty_desc'] ?? 'Our department is home to <strong>3 Professors</strong>, <strong>3 Associate Professors</strong>, and a team of dedicated academics with expertise spanning AI, cybersecurity, data science, networking, and software engineering.' !!}
                    </p>
                    <div class="cta-buttons flex justify-center gap-4 flex-wrap">
                        <a href="{{ $gs('about_faculty_btn1_url', '/people') }}" class="inline-flex items-center gap-3 bg-white text-[color:var(--color-primary)] py-[0.9rem] px-9 rounded-xl font-bold no-underline transition-all duration-300 shadow-[0_10px_20px_-5px_rgba(0,0,0,0.15)] text-[0.95rem] hover:-translate-y-[3px] hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.2)]">
                            {{ $gs('about_faculty_btn1_text', 'View Staff Directory') }} <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="{{ $gs('about_faculty_btn2_url', '/contact') }}" class="inline-flex items-center gap-3 bg-transparent text-white py-[0.9rem] px-[2.2rem] rounded-xl font-bold no-underline transition-all duration-300 border-2 border-white/30 text-[0.95rem] hover:border-white/60 hover:bg-white/[0.08]">
                            {{ $gs('about_faculty_btn2_text', 'Contact Us') }} <i class="fa-solid fa-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    @php
        $sections = [
            'our-story' => 'Our Story',
            'vision-mission' => 'Vision, Mission & Objectives',
            'core-values' => 'Core Values',
            'programmes' => 'Academic Programmes',
            'departmental-board' => 'Departmental Board',
            'entry-requirements' => 'Entry Requirements',
            'our-faculty' => 'Our Faculty',
        ];
    @endphp
    <x-sticky-toc :sections="$sections" />
</div>

<style>
    /* ── About Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .about-hero h1 { font-size: 2.6rem !important; }
        .about-main { padding: 2.5rem 2.5rem !important; }
        .about-objectives-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .about-facilities-grid { grid-template-columns: 1fr !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .about-hero { padding: 3.5rem 0 4.5rem !important; }
        .about-hero h1 { font-size: 2rem !important; }
        .about-hero p { font-size: 1rem !important; }
        .about-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .about-main section { margin-bottom: 2.5rem !important; }
        .about-main .section-heading h2 { font-size: 1.5rem !important; }
        .about-main .section-heading-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .about-story-layout { flex-direction: column !important; align-items: center !important; gap: 1.5rem !important; }
        .about-hod-card { flex: none !important; max-width: 180px !important; }
        .about-story-text { min-width: 0 !important; font-size: 0.95rem !important; }
        .about-story-text .about-quote { font-size: 0.95rem !important; padding: 1rem 1.2rem !important; }
        .about-milestones { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .about-milestones > div { padding: 1rem !important; }
        .about-milestones .milestone-year { font-size: 1.5rem !important; }
        .about-vm-grid { grid-template-columns: 1fr !important; }
        .about-vm-card { padding: 1.8rem !important; }
        .about-objectives-wrap { padding: 1.5rem !important; }
        .about-objectives-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.8rem !important; }
        .about-values-grid { grid-template-columns: repeat(3, 1fr) !important; gap: 0.8rem !important; }
        .about-values-grid > div { padding: 1.2rem 0.8rem !important; }
        .about-programmes-grid { grid-template-columns: 1fr !important; }
        .about-board-grid { grid-template-columns: 1fr !important; }
        .about-req-grid { grid-template-columns: repeat(3, 1fr) !important; }
        .about-facilities-grid { grid-template-columns: 1fr !important; }
        .about-faculty-cta { padding: 2.5rem 1.5rem !important; }
        .about-faculty-cta h2 { font-size: 1.6rem !important; }
        .about-faculty-cta p { font-size: 0.95rem !important; }
    }

    /* Mobile (≤576px) */
    @media (max-width: 576px) {
        .about-hero { padding: 2.5rem 0 3.5rem !important; }
        .about-hero h1 { font-size: 1.6rem !important; }
        .about-hero p { font-size: 0.88rem !important; }
        .about-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .about-main .section-heading h2 { font-size: 1.3rem !important; }
        .about-hod-card { max-width: 150px !important; }
        .about-milestones { grid-template-columns: repeat(2, 1fr) !important; }
        .about-objectives-grid { grid-template-columns: 1fr 1fr !important; }
        .about-objectives-grid > div { padding: 1rem 0.7rem !important; }
        .about-values-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .about-values-grid > div .val-icon { width: 44px !important; height: 44px !important; font-size: 1.2rem !important; }
        .about-values-grid > div h4 { font-size: 0.95rem !important; }
        .about-req-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 0.6rem !important; }
        .about-req-grid > div { padding: 1rem 0.6rem !important; }
        .about-facilities-card { flex-direction: column !important; gap: 0.8rem !important; padding: 1.2rem !important; }
        .about-faculty-cta { padding: 2rem 1.2rem !important; border-radius: 12px !important; }
        .about-faculty-cta h2 { font-size: 1.4rem !important; }
        .about-faculty-cta .cta-buttons { flex-direction: column !important; gap: 0.6rem !important; }
        .about-faculty-cta .cta-buttons a { width: 100%; justify-content: center; padding: 0.8rem 1.5rem !important; font-size: 0.88rem !important; }
    }

    /* Small mobile (≤400px) */
    @media (max-width: 400px) {
        .about-hero h1 { font-size: 1.35rem !important; }
        .about-milestones { grid-template-columns: 1fr 1fr !important; }
        .about-milestones .milestone-year { font-size: 1.3rem !important; }
        .about-objectives-grid { grid-template-columns: 1fr !important; }
        .about-values-grid { grid-template-columns: 1fr 1fr !important; }
        .about-req-grid { grid-template-columns: 1fr !important; }
    }
</style>
@endsection
