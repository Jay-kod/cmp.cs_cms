@extends('layouts.public')
@section('title', 'NACOS — National Association of Computing Students')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
@endphp

<!-- ═══════════════════════════════════════════════
     HERO
     ═══════════════════════════════════════════════ -->
<section data-aos="fade-up" class="bg-gradient-to-br from-slate-900 via-slate-800 to-green-900 py-16 sm:py-20 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-20 -right-20 w-[350px] h-[350px] bg-[radial-gradient(circle,rgba(22,163,74,0.15)_0%,transparent_70%)] rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-[250px] h-[250px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.5%22_fill=%22rgba(255,255,255,0.03)%22/></svg>')]"></div>
    </div>
    <div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 bg-green-600/20 backdrop-blur-md text-green-400 text-[0.78rem] font-bold uppercase tracking-[1.5px] py-[0.3rem] px-4 rounded-full mb-4 border border-green-600/30">
            <i class="fa-solid fa-users-rectangle"></i> Student Association
        </span>
        <h1 class="text-white text-[2.2rem] lg:text-[3rem] font-heading font-extrabold m-0 mb-3 leading-[1.15]">{{ $gs('nacos_presidents_title', 'NACOS') }}</h1>
        <p class="text-slate-200 text-base md:text-[1.15rem] max-w-[700px] mx-auto mb-8 leading-[1.8] text-balance text-center drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)]">{{ $gs('nacos_presidents_subtitle', 'Honoring the visionary leaders and rich legacy of the National Association of Computing Students (NUK Chapter) — championing academic excellence and technological innovation.') }}</p>
        
        <div class="flex flex-col gap-[0.6rem] w-full max-w-[400px] mx-auto">
            <div class="flex gap-[0.6rem] justify-center flex-nowrap w-full">
                <a href="#about-nacos" class="inline-flex items-center justify-center gap-[0.4rem] bg-gradient-to-br from-green-600 to-emerald-600 text-white py-[0.65rem] px-2 rounded-lg text-[0.85rem] font-bold no-underline shadow-[0_4px_15px_rgba(22,163,74,0.3)] transition-all duration-200 flex-1 whitespace-nowrap hover:-translate-y-[1px]">
                    <i class="fa-solid fa-circle-info"></i> About NACOS
                </a>
                <a href="#past-leaders" class="inline-flex items-center justify-center gap-[0.4rem] bg-white/10 text-white py-[0.65rem] px-2 rounded-lg text-[0.85rem] font-semibold no-underline border-[1.5px] border-white/15 transition-all duration-200 backdrop-blur-sm flex-1 whitespace-nowrap hover:border-white/40 hover:bg-white/15">
                    <i class="fa-solid fa-crown"></i> Past Leaders
                </a>
            </div>
            @if(filled($gs('nacos_official_website_url')))
            <a href="{{ $gs('nacos_official_website_url') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-[0.4rem] bg-gradient-to-br from-yellow-500 to-yellow-600 text-white py-[0.65rem] px-2 rounded-lg text-[0.85rem] font-bold no-underline shadow-[0_4px_15px_rgba(234,179,8,0.3)] transition-all duration-200 border-none w-full whitespace-nowrap hover:-translate-y-[1px] hover:shadow-[0_6px_20px_rgba(234,179,8,0.4)]">
                <i class="fa-solid fa-globe"></i> {{ $gs('nacos_official_website_label', 'Visit Major NACOS Website') }} <i class="fa-solid fa-arrow-up-right-from-square text-[0.75rem] ml-1"></i>
            </a>
            @endif
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     ABOUT NACOS + MISSION / VISION
     ═══════════════════════════════════════════════ -->
<section data-aos="fade-up" id="about-nacos" class="py-16 bg-white">
    <div class="container" data-aos="fade-up">
        {{-- About Row --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-14">
            <div>
                <span class="inline-block text-[color:var(--color-primary)] text-[0.8rem] font-bold uppercase tracking-[1.5px] mb-3 bg-green-600/10 py-1 px-3.5 rounded-full">Who We Are</span>
                <h2 class="text-[2.2rem] font-heading font-extrabold text-slate-900 m-0 mb-4 leading-[1.2]">{{ $gs('nacos_page_about_title', 'About NACOS') }}</h2>
                <p class="text-slate-700 text-[1.05rem] leading-[1.8] m-0 mb-5">{{ $gs('nacos_page_about_text', 'The National Association of Computing Students (NACOS) is the premier umbrella body for all students pursuing computing-related disciplines. The NUK Chapter stands as a vibrant hub dedicated to fostering academic excellence, accelerating professional development, and cultivating strong, lifelong social bonds among its members.') }}</p>
                <p class="text-slate-600 text-base leading-[1.8] m-0 mb-5">{{ $gs('nacos_page_about_text2', 'Through engaging workshops, competitive hackathons, insightful seminars, and impactful community outreach, NACOS actively prepares students to thrive in the ever-evolving tech industry. We are committed to building a robust, supportive network that empowers our members well beyond graduation.') }}</p>
                <p class="text-slate-600 text-base leading-[1.8] m-0">{{ $gs('nacos_page_about_text3', 'As a community driven by innovation, we continuously strive to bridge the gap between classroom theory and real-world application. By collaborating with industry experts, faculty, and accomplished alumni, NACOS provides unique mentorship opportunities, ensuring that every student has the resources, guidance, and confidence required to become future tech leaders and effectively shape the digital landscape of tomorrow.') }}</p>
            </div>
            {{-- Stats Column --}}
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                @php
                    $pageStats = [
                        ['icon' => 'fa-solid fa-crown',           'value' => $presidents->count(), 'label' => 'Past Leaders',   'bg_class' => 'bg-green-600/15', 'text_class' => 'text-green-600'],
                        ['icon' => 'fa-solid fa-calendar-check',  'value' => $gs('nacos_page_stat_events', '50+'),  'label' => $gs('nacos_page_stat_events_label', 'Events Hosted'),  'bg_class' => 'bg-cyan-600/15', 'text_class' => 'text-cyan-600'],
                        ['icon' => 'fa-solid fa-user-graduate',   'value' => $gs('nacos_page_stat_members', '500+'),'label' => $gs('nacos_page_stat_members_label','Active Members'), 'bg_class' => 'bg-violet-600/15', 'text_class' => 'text-violet-600'],
                        ['icon' => 'fa-solid fa-trophy',          'value' => $gs('nacos_page_stat_awards', '20+'),  'label' => $gs('nacos_page_stat_awards_label', 'Awards Won'),     'bg_class' => 'bg-orange-600/15', 'text_class' => 'text-orange-600'],
                    ];
                @endphp
                @foreach($pageStats as $stat)
                <div data-aos="fade-up" class="bg-slate-50 border border-slate-200 rounded-2xl p-4 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(0,0,0,0.06)] flex flex-col items-center justify-center">
                    <div data-aos="fade-up" class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center mb-2 sm:mb-3 {{ $stat['bg_class'] }}">
                        <i class="{{ $stat['icon'] }} text-[1.1rem] {{ $stat['text_class'] }}"></i>
                    </div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-none mb-1 font-heading">{{ $stat['value'] }}</div>
                    <div class="text-[0.7rem] sm:text-xs text-slate-500 uppercase tracking-wider font-semibold">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Mission / Vision / Values Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-8 mt-5">
            @php
                $pillars = [
                    [
                        'icon'  => 'fa-solid fa-rocket',
                        'title' => $gs('nacos_page_pillar1_title', 'Our Mission'),
                        'text'  => $gs('nacos_page_pillar1_text', 'To empower the next generation of tech innovators through cutting-edge knowledge, hands-on learning, and robust industry collaboration.'),
                        'color' => 'from-green-500 to-emerald-600',
                        'bg' => 'bg-green-50',
                        'text_color' => 'text-green-600'
                    ],
                    [
                        'icon'  => 'fa-solid fa-eye',
                        'title' => $gs('nacos_page_pillar2_title', 'Our Vision'),
                        'text'  => $gs('nacos_page_pillar2_text', 'To be the preeminent student organization shaping highly skilled, ethical, and globally competitive computing professionals.'),
                        'color' => 'from-cyan-500 to-blue-600',
                        'bg' => 'bg-cyan-50',
                        'text_color' => 'text-cyan-600'
                    ],
                    [
                        'icon'  => 'fa-solid fa-shield-heart',
                        'title' => $gs('nacos_page_pillar3_title', 'Our Core Values'),
                        'text'  => $gs('nacos_page_pillar3_text', 'Innovation. Integrity. Collaboration. Inclusivity. Excellence. These principles are the absolute foundation of everything we do.'),
                        'color' => 'from-purple-500 to-indigo-600',
                        'bg' => 'bg-purple-50',
                        'text_color' => 'text-purple-600'
                    ],
                ];
            @endphp
            @foreach($pillars as $pillar)
            <div class="group relative bg-slate-50 border border-slate-200/80 rounded-2xl p-6 sm:p-8 overflow-hidden transition-all duration-300 hover:-translate-y-2 shadow-[0_12px_24px_rgba(0,0,0,0.12)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.25)] flex flex-col h-full z-10">
                
                {{-- Decorative top gradient border --}}
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r {{ $pillar['color'] }} opacity-90 group-hover:opacity-100 transition-opacity"></div>
                
                {{-- Decorative background blur element --}}
                <div class="absolute -right-8 -top-8 w-32 h-32 {{ $pillar['bg'] }} rounded-full blur-2xl opacity-60 group-hover:opacity-90 transition-opacity -z-10"></div>
                
                <div data-aos="fade-up" class="w-14 h-14 {{ $pillar['bg'] }} rounded-xl flex items-center justify-center mb-5 rotate-3 group-hover:rotate-0 transition-transform duration-300 shadow-sm border border-white/50">
                    <i class="{{ $pillar['icon'] }} {{ $pillar['text_color'] }} text-xl drop-shadow-sm"></i>
                </div>
                
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-800 mb-3 tracking-tight font-heading group-hover:text-slate-900">{{ $pillar['title'] }}</h3>
                
                <p class="text-slate-600 text-[0.95rem] leading-relaxed m-0 flex-grow font-medium">{{ $pillar['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     WHAT WE DO — Activities
     ═══════════════════════════════════════════════ -->
<section data-aos="fade-up" class="py-14 bg-slate-50 border-t border-slate-100">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-10">
            <span class="inline-block text-[color:var(--color-primary)] text-[0.8rem] font-bold uppercase tracking-[1.5px] mb-2.5 bg-green-600/10 py-1 px-3.5 rounded-full">What We Do</span>
            <h2 class="text-[2rem] font-heading font-extrabold text-slate-900 m-0">{{ $gs('nacos_page_activities_title', 'Our Activities') }}</h2>
        </div>

        @php
            $activities = [
                ['icon' => 'fa-solid fa-laptop-code',       'title' => $gs('nacos_act1_title','Hackathons & Coding Contests'), 'desc' => $gs('nacos_act1_desc','Regular programming competitions that test skills and encourage creative problem-solving among members.')],
                ['icon' => 'fa-solid fa-chalkboard-user',   'title' => $gs('nacos_act2_title','Workshops & Seminars'),         'desc' => $gs('nacos_act2_desc','Industry-led training sessions on trending technologies like AI, cloud computing, and cybersecurity.')],
                ['icon' => 'fa-solid fa-handshake-angle',   'title' => $gs('nacos_act3_title','Mentorship Programme'),          'desc' => $gs('nacos_act3_desc','Pairing junior students with senior peers and alumni for academic guidance and career advice.')],
                ['icon' => 'fa-solid fa-people-carry-box',  'title' => $gs('nacos_act4_title','Community Service'),             'desc' => $gs('nacos_act4_desc','Giving back through IT literacy drives, school outreach, and digital empowerment projects.')],
                ['icon' => 'fa-solid fa-futbol',            'title' => $gs('nacos_act5_title','Social & Sports Events'),        'desc' => $gs('nacos_act5_desc','Building bonds beyond the classroom with get-togethers, game nights, and inter-departmental sports.')],
                ['icon' => 'fa-solid fa-building-columns',  'title' => $gs('nacos_act6_title','Annual NACOS Week'),             'desc' => $gs('nacos_act6_desc','A week-long celebration with talks, exhibitions, awards, and cultural events showcasing computing talent.')],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
            @foreach($activities as $act)
            <div class="group bg-white border border-slate-200/60 rounded-2xl p-6 sm:p-7 transition-all duration-300 hover:-translate-y-1.5 shadow-[0_4px_12px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_28px_rgba(0,0,0,0.08)]">
                <div data-aos="fade-up" class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-600 transition-colors duration-300">
                    <i class="{{ $act['icon'] }} text-green-600 text-[1.15rem] group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h4 class="text-lg font-bold text-slate-800 mb-2.5 font-heading group-hover:text-green-700 transition-colors duration-300">{{ $act['title'] }}</h4>
                <p class="text-slate-500 text-[0.9rem] leading-relaxed m-0">{{ $act['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     PAST LEADERS
     ═══════════════════════════════════════════════ -->
<section data-aos="fade-up" id="past-leaders" class="py-16 bg-white">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-10">
            <span class="inline-block text-[color:var(--color-primary)] text-[0.8rem] font-bold uppercase tracking-[1.5px] mb-2.5 bg-green-600/10 py-1 px-3.5 rounded-full">Leadership</span>
            <h2 class="text-[2rem] font-heading font-extrabold text-slate-900 m-0 mb-2">{{ $gs('nacos_page_leaders_title', 'Past NACOS Presidents') }}</h2>
            <p class="text-slate-500 text-[0.95rem] max-w-[550px] mx-auto m-0 leading-[1.6]">{{ $gs('nacos_page_leaders_subtitle', 'Honoring the visionaries who led our chapter and shaped its legacy.') }}</p>
        </div>

        @php $intro = $gs('nacos_presidents_intro', ''); @endphp
        @if($intro)
        <div class="max-w-[700px] mx-auto mb-8 text-center">
            <p class="text-slate-600 text-base leading-[1.8]">{{ $intro }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($presidents as $p)
            <div data-aos="fade-up" class="group bg-white border border-slate-200 rounded-2xl p-4 transition-all duration-300 hover:border-green-500 hover:-translate-y-1.5 shadow-[0_10px_25px_rgba(0,0,0,0.12)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)] flex flex-col items-center text-center">
                <!-- Square Picture -->
                <div class="w-full aspect-square bg-slate-50 rounded-xl overflow-hidden relative shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] border border-slate-100 mb-4 group">
                    <img src="{{ $p->photo ? asset('storage/'.$p->photo) : asset('images/avatar-placeholder.png') }}" 
                         alt="{{ $p->name }}" 
                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110" 
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p->name) }}&background=16a34a&color=fff&size=150'">

                    @if($p->email || $p->whatsapp || $p->facebook || $p->x)
                    <div data-aos="fade-up" class="absolute inset-0 bg-black/40 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
                        @if($p->email)
                        <a href="mailto:{{ $p->email }}" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
                            <i class="fa-solid fa-envelope"></i>
                            <!-- Custom Tooltip -->
                            <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[0.7rem] font-semibold tracking-wide px-2.5 py-1 rounded opacity-0 group-hover/icon:opacity-100 transition-all duration-300 whitespace-nowrap pointer-events-none shadow-xl before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[5px] before:border-transparent before:border-t-slate-900 z-10 translate-y-2 group-hover/icon:translate-y-0">
                                {{ $p->email }}
                            </span>
                        </a>
                        @endif

                        @if($p->whatsapp)
                        @php
                            $waNumber = preg_replace('/[^0-9]/', '', $p->whatsapp);
                        @endphp
                        <a data-aos="fade-up" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-green-500 hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <!-- Custom Tooltip -->
                            <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[0.7rem] font-semibold tracking-wide px-2.5 py-1 rounded opacity-0 group-hover/icon:opacity-100 transition-all duration-300 whitespace-nowrap pointer-events-none shadow-xl before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[5px] before:border-transparent before:border-t-slate-900 z-10 translate-y-2 group-hover/icon:translate-y-0">
                                {{ $p->whatsapp }}
                            </span>
                        </a>
                        @endif

                        @php
                            $facebookUrl = filled($p->facebook)
                                ? (str_starts_with($p->facebook, 'http') ? $p->facebook : 'https://facebook.com/' . ltrim($p->facebook, '/'))
                                : null;
                        @endphp
                        @if($facebookUrl)
                        <a data-aos="fade-up" href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
                            <i class="fa-brands fa-facebook-f text-lg"></i>
                            <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[0.7rem] font-semibold tracking-wide px-2.5 py-1 rounded opacity-0 group-hover/icon:opacity-100 transition-all duration-300 whitespace-nowrap pointer-events-none shadow-xl before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[5px] before:border-transparent before:border-t-slate-900 z-10 translate-y-2 group-hover/icon:translate-y-0">
                                {{ $p->facebook }}
                            </span>
                        </a>
                        @endif

                        @php
                            $xUrl = filled($p->x)
                                ? (str_starts_with($p->x, 'http') ? $p->x : 'https://x.com/' . ltrim($p->x, '/'))
                                : null;
                        @endphp
                        @if($xUrl)
                        <a data-aos="fade-up" href="{{ $xUrl }}" target="_blank" rel="noopener noreferrer" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-black hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
                            <i class="fa-brands fa-x-twitter text-lg"></i>
                            <span class="absolute -top-10 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[0.7rem] font-semibold tracking-wide px-2.5 py-1 rounded opacity-0 group-hover/icon:opacity-100 transition-all duration-300 whitespace-nowrap pointer-events-none shadow-xl before:content-[''] before:absolute before:top-full before:left-1/2 before:-translate-x-1/2 before:border-[5px] before:border-transparent before:border-t-slate-900 z-10 translate-y-2 group-hover/icon:translate-y-0">
                                {{ $p->x }}
                            </span>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Middle Aligned Content -->
                <div data-aos="fade-up" class="flex flex-col flex-1 w-full items-center justify-start px-2">
                    <h3 class="m-0 mb-1 text-[1.15rem] font-bold text-slate-800 font-heading group-hover:text-green-600 transition-colors duration-300">{{ $p->name }}</h3>
                    
                    <div class="mb-3">
                        <span class="inline-block px-2.5 py-0.5 bg-green-50 text-green-700 text-[0.65rem] font-bold uppercase tracking-widest rounded shadow-sm border border-green-200/60">
                            {{ $p->tenure_start ?? 'Unknown' }} — {{ $p->tenure_end ?? 'Present' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 px-0 bg-slate-50 rounded-[14px] border border-dashed border-slate-200">
                <i class="fa-solid fa-users-slash text-[2.5rem] text-slate-300 mb-3 block"></i>
                <h3 class="m-0 mb-1.5 text-[1.1rem] text-slate-700">No Records Found</h3>
                <p class="text-slate-500 m-0 text-[0.9rem]">Presidents will appear here once added by the administration.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     JOIN / CTA
     ═══════════════════════════════════════════════ -->
<section data-aos="fade-up" class="py-12 bg-gradient-to-br from-green-900 to-green-700 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none bg-[url('data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.6%22_fill=%22rgba(255,255,255,0.04)%22/></svg>')]"></div>
    <div class="container relative z-10 flex items-center justify-between gap-8 flex-wrap" data-aos="fade-up">
        <div class="flex-1 min-w-[280px]">
            <h2 class="text-[1.6rem] font-heading font-extrabold text-white m-0 mb-1.5 leading-[1.2]">{{ $gs('nacos_page_cta_title', 'Want to Know More?') }}</h2>
            <p class="text-[0.9rem] text-white/70 leading-[1.6] m-0">{{ $gs('nacos_page_cta_subtitle', 'Reach out to us for questions, collaborations, or if you want to get involved with NACOS.') }}</p>
        </div>
        <div class="flex gap-[0.6rem] flex-wrap items-center">
            <a href="{{ url('/contact') }}" class="inline-flex items-center gap-[0.5rem] bg-white text-green-900 py-[0.6rem] px-[1.3rem] rounded-lg text-[0.88rem] font-bold no-underline shadow-[0_2px_10px_rgba(0,0,0,0.15)] transition-all duration-200 hover:-translate-y-[1px]">
                <i class="fa-solid fa-envelope"></i> Contact Us
            </a>
            <a href="{{ url('/') }}" class="inline-flex items-center gap-[0.5rem] bg-white/10 text-white py-[0.6rem] px-[1.3rem] rounded-lg text-[0.88rem] font-semibold no-underline border-[1.5px] border-white/20 transition-all duration-200 backdrop-blur-sm hover:border-white/50">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
        </div>
    </div>
</section>

@endsection
