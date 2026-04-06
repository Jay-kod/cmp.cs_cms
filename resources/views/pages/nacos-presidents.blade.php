@extends('layouts.public')
@section('title', 'NACOS — National Association of Computing Students')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
@endphp

<!-- ═══════════════════════════════════════════════
     HERO
     ═══════════════════════════════════════════════ -->
<section style="background: linear-gradient(165deg, #0f172a 0%, #1e293b 55%, #0f4c2e 100%); padding: 5rem 0 4rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; pointer-events: none;">
        <div style="position: absolute; top: -80px; right: -80px; width: 350px; height: 350px; background: radial-gradient(circle, rgba(22,163,74,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -40px; left: -40px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(22,163,74,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.5%22 fill=%22rgba(255,255,255,0.03)%22/></svg>');"></div>
    </div>
    <div class="container" style="position: relative; z-index: 2; text-align: center; display: flex; flex-direction: column; align-items: center;">
        <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22,163,74,0.2); backdrop-filter: blur(8px); color: #4ade80; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; padding: 0.3rem 1rem; border-radius: 20px; margin-bottom: 1rem; border: 1px solid rgba(22,163,74,0.3);">
            <i class="fa-solid fa-users-rectangle"></i> Student Association
        </span>
        <h1 style="color: white; font-size: 3rem; font-family: var(--font-heading); font-weight: 800; margin: 0 0 0.8rem; line-height: 1.15;">{{ $gs('nacos_presidents_title', 'NACOS') }}</h1>
        <p style="color: #e2e8f0; font-size: 1.15rem; max-width: 700px; margin: 0 auto 2rem; line-height: 1.8; text-wrap: balance; text-align: center; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">{{ $gs('nacos_presidents_subtitle', 'Honoring the visionary leaders and rich legacy of the National Association of Computing Students (NUK Chapter) — championing academic excellence and technological innovation.') }}</p>
        
        <div style="display: flex; flex-direction: column; gap: 0.6rem; width: 100%; max-width: 400px; margin: 0 auto;">
            <div style="display: flex; gap: 0.6rem; justify-content: center; flex-wrap: nowrap; width: 100%;">
                <a href="#about-nacos" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; background: linear-gradient(135deg, #16a34a, #059669); color: white; padding: 0.65rem 0.5rem; border-radius: 8px; font-size: 0.85rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba(22,163,74,0.3); transition: all 0.2s; flex: 1; white-space: nowrap;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                    <i class="fa-solid fa-circle-info"></i> About NACOS
                </a>
                <a href="#past-leaders" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; background: rgba(255,255,255,0.08); color: white; padding: 0.65rem 0.5rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; border: 1.5px solid rgba(255,255,255,0.15); transition: all 0.2s; backdrop-filter: blur(4px); flex: 1; white-space: nowrap;" onmouseover="this.style.borderColor='rgba(255,255,255,0.4)'; this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.background='rgba(255,255,255,0.08)'">
                    <i class="fa-solid fa-crown"></i> Past Leaders
                </a>
            </div>
            @if(filled($gs('nacos_official_website_url')))
            <a href="{{ $gs('nacos_official_website_url') }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.4rem; background: linear-gradient(135deg, #eab308, #ca8a04); color: white; padding: 0.65rem 0.5rem; border-radius: 8px; font-size: 0.85rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba(234,179,8,0.3); transition: all 0.2s; border: none; width: 100%; white-space: nowrap;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(234,179,8,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(234,179,8,0.3)'">
                <i class="fa-solid fa-globe"></i> {{ $gs('nacos_official_website_label', 'Visit Major NACOS Website') }} <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem; margin-left: 0.2rem;"></i>
            </a>
            @endif
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     ABOUT NACOS + MISSION / VISION
     ═══════════════════════════════════════════════ -->
<section id="about-nacos" style="padding: 4rem 0; background: white;">
    <div class="container">
        {{-- About Row --}}
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-bottom: 3.5rem;">
            <div>
                <span style="display: inline-block; color: var(--color-primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.8rem; background: rgba(22,163,74,0.1); padding: 0.25rem 0.9rem; border-radius: 20px;">Who We Are</span>
                <h2 style="font-size: 2.2rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin: 0 0 1rem; line-height: 1.2;">{{ $gs('nacos_page_about_title', 'About NACOS') }}</h2>
                <p style="color: #334155; font-size: 1.05rem; line-height: 1.8; margin: 0 0 1.2rem;">{{ $gs('nacos_page_about_text', 'The National Association of Computing Students (NACOS) is the premier umbrella body for all students pursuing computing-related disciplines. The NUK Chapter stands as a vibrant hub dedicated to fostering academic excellence, accelerating professional development, and cultivating strong, lifelong social bonds among its members.') }}</p>
                <p style="color: #475569; font-size: 1rem; line-height: 1.8; margin: 0 0 1.2rem;">{{ $gs('nacos_page_about_text2', 'Through engaging workshops, competitive hackathons, insightful seminars, and impactful community outreach, NACOS actively prepares students to thrive in the ever-evolving tech industry. We are committed to building a robust, supportive network that empowers our members well beyond graduation.') }}</p>
                <p style="color: #475569; font-size: 1rem; line-height: 1.8; margin: 0;">{{ $gs('nacos_page_about_text3', 'As a community driven by innovation, we continuously strive to bridge the gap between classroom theory and real-world application. By collaborating with industry experts, faculty, and accomplished alumni, NACOS provides unique mentorship opportunities, ensuring that every student has the resources, guidance, and confidence required to become future tech leaders and effectively shape the digital landscape of tomorrow.') }}</p>
            </div>
            {{-- Stats Column --}}
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                @php
                    $pageStats = [
                        ['icon' => 'fa-solid fa-crown',           'value' => $presidents->count(), 'label' => 'Past Leaders',   'color' => '#16a34a'],
                        ['icon' => 'fa-solid fa-calendar-check',  'value' => $gs('nacos_page_stat_events', '50+'),  'label' => $gs('nacos_page_stat_events_label', 'Events Hosted'),  'color' => '#0891b2'],
                        ['icon' => 'fa-solid fa-user-graduate',   'value' => $gs('nacos_page_stat_members', '500+'),'label' => $gs('nacos_page_stat_members_label','Active Members'), 'color' => '#7c3aed'],
                        ['icon' => 'fa-solid fa-trophy',          'value' => $gs('nacos_page_stat_awards', '20+'),  'label' => $gs('nacos_page_stat_awards_label', 'Awards Won'),     'color' => '#ea580c'],
                    ];
                @endphp
                @foreach($pageStats as $stat)
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 sm:p-6 text-center transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_8px_20px_rgba(0,0,0,0.06)] flex flex-col items-center justify-center">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center mb-2 sm:mb-3" style="background: {{ $stat['color'] }}15;">
                        <i class="{{ $stat['icon'] }}" style="color: {{ $stat['color'] }}; font-size: 1.1rem;"></i>
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
                
                <div class="w-14 h-14 {{ $pillar['bg'] }} rounded-xl flex items-center justify-center mb-5 rotate-3 group-hover:rotate-0 transition-transform duration-300 shadow-sm border border-white/50">
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
<section style="padding: 3.5rem 0; background: #f8fafc; border-top: 1px solid #f1f5f9;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.6rem; background: rgba(22,163,74,0.1); padding: 0.25rem 0.9rem; border-radius: 20px;">What We Do</span>
            <h2 style="font-size: 2rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin: 0;">{{ $gs('nacos_page_activities_title', 'Our Activities') }}</h2>
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
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-600 transition-colors duration-300">
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
<section id="past-leaders" style="padding: 4rem 0; background: white;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 0.6rem; background: rgba(22,163,74,0.1); padding: 0.25rem 0.9rem; border-radius: 20px;">Leadership</span>
            <h2 style="font-size: 2rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin: 0 0 0.5rem;">{{ $gs('nacos_page_leaders_title', 'Past NACOS Presidents') }}</h2>
            <p style="color: #64748b; font-size: 0.95rem; max-width: 550px; margin: 0 auto; line-height: 1.6;">{{ $gs('nacos_page_leaders_subtitle', 'Honoring the visionaries who led our chapter and shaped its legacy.') }}</p>
        </div>

        @php $intro = $gs('nacos_presidents_intro', ''); @endphp
        @if($intro)
        <div style="max-width: 700px; margin: 0 auto 2rem; text-align: center;">
            <p style="color: #475569; font-size: 1rem; line-height: 1.8;">{{ $intro }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($presidents as $p)
            <div class="group bg-white border border-slate-200 rounded-2xl p-4 transition-all duration-300 hover:border-green-500 hover:-translate-y-1.5 shadow-[0_10px_25px_rgba(0,0,0,0.12)] hover:shadow-[0_20px_40px_rgba(0,0,0,0.2)] flex flex-col items-center text-center">
                <!-- Square Picture -->
                <div class="w-full aspect-square bg-slate-50 rounded-xl overflow-hidden relative shadow-[inset_0_2px_4px_rgba(0,0,0,0.05)] border border-slate-100 mb-4 group">
                    <img src="{{ $p->photo ? asset('storage/'.$p->photo) : asset('images/avatar-placeholder.png') }}" 
                         alt="{{ $p->name }}" 
                         class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110" 
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p->name) }}&background=16a34a&color=fff&size=150'">

                    @if($p->email || $p->whatsapp || $p->facebook || $p->x)
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
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
                        <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener noreferrer" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-green-500 hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
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
                        <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
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
                        <a href="{{ $xUrl }}" target="_blank" rel="noopener noreferrer" class="group/icon relative w-10 h-10 rounded-full bg-white flex items-center justify-center text-slate-700 hover:bg-black hover:text-white transition-all duration-300 shadow-lg transform translate-y-4 group-hover:translate-y-0">
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
                <div class="flex flex-col flex-1 w-full items-center justify-start px-2">
                    <h3 class="m-0 mb-1 text-[1.15rem] font-bold text-slate-800 font-heading group-hover:text-green-600 transition-colors duration-300">{{ $p->name }}</h3>
                    
                    <div class="mb-3">
                        <span class="inline-block px-2.5 py-0.5 bg-green-50 text-green-700 text-[0.65rem] font-bold uppercase tracking-widest rounded shadow-sm border border-green-200/60">
                            {{ $p->tenure_start ?? 'Unknown' }} — {{ $p->tenure_end ?? 'Present' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; background: #f8fafc; border-radius: 14px; border: 1px dashed #e2e8f0;">
                <i class="fa-solid fa-users-slash" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 0.8rem; display: block;"></i>
                <h3 style="margin: 0 0 0.4rem 0; font-size: 1.1rem; color: #334155;">No Records Found</h3>
                <p style="color: #64748b; margin: 0; font-size: 0.9rem;">Presidents will appear here once added by the administration.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     JOIN / CTA
     ═══════════════════════════════════════════════ -->
<section style="padding: 3rem 0; background: linear-gradient(105deg, #14532d 0%, #15803d 100%); position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.6%22 fill=%22rgba(255,255,255,0.04)%22/></svg>'); pointer-events: none;"></div>
    <div class="container" style="position: relative; z-index: 2; display: flex; align-items: center; justify-content: space-between; gap: 2rem; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 280px;">
            <h2 style="font-size: 1.6rem; font-family: var(--font-heading); font-weight: 800; color: white; margin: 0 0 0.4rem; line-height: 1.2;">{{ $gs('nacos_page_cta_title', 'Want to Know More?') }}</h2>
            <p style="font-size: 0.9rem; color: rgba(255,255,255,0.7); line-height: 1.6; margin: 0;">{{ $gs('nacos_page_cta_subtitle', 'Reach out to us for questions, collaborations, or if you want to get involved with NACOS.') }}</p>
        </div>
        <div style="display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: center;">
            <a href="{{ url('/contact') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: white; color: #14532d; padding: 0.6rem 1.3rem; border-radius: 8px; font-size: 0.88rem; font-weight: 700; text-decoration: none; box-shadow: 0 2px 10px rgba(0,0,0,0.15); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-envelope"></i> Contact Us
            </a>
            <a href="{{ url('/') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.08); color: white; padding: 0.6rem 1.3rem; border-radius: 8px; font-size: 0.88rem; font-weight: 600; text-decoration: none; border: 1.5px solid rgba(255,255,255,0.2); transition: all 0.2s; backdrop-filter: blur(4px);" onmouseover="this.style.borderColor='rgba(255,255,255,0.5)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
        </div>
    </div>
</section>

<style>
    /* NACOS Presidents Page Responsive */
    @media (max-width: 991px) {
        /* Hero */
        section[style*="padding: 5rem 0 4rem"] { padding: 3.5rem 0 3rem !important; }
        section[style*="padding: 5rem 0 4rem"] h1[style*="font-size: 3rem"] { font-size: 2.2rem !important; }
        /* About: stack columns */
        #about-nacos .container > div[style*="grid-template-columns: 1fr 1fr"] { grid-template-columns: 1fr !important; }
        /* Mission/Vision/Values: 3 → 2 */
        #about-nacos div[style*="repeat(3, 1fr)"] { grid-template-columns: repeat(2, 1fr) !important; }
        /* Activities: 3 → 2 */
        section[style*="padding: 3.5rem 0"] div[style*="repeat(3, 1fr)"] { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 768px) {
        section[style*="padding: 5rem 0 4rem"] { padding: 2.5rem 0 2rem !important; }
        section[style*="padding: 5rem 0 4rem"] h1[style*="font-size: 3rem"] { font-size: 1.8rem !important; }
        section[style*="padding: 5rem 0 4rem"] p[style*="font-size: 1.1rem"] { font-size: 0.92rem !important; }
        /* About section padding */
        section[style*="padding: 4rem 0"] { padding: 2.5rem 0 !important; }
        #about-nacos h2[style*="font-size: 2.2rem"] { font-size: 1.7rem !important; }
        /* Stats grid: keep 2x2 */
        #about-nacos div[style*="grid-template-columns: 1fr 1fr"][style*="gap: 1rem"] { grid-template-columns: 1fr 1fr !important; }
        /* Activities: 2 → 1 */
        section[style*="padding: 3.5rem 0"] div[style*="repeat(3, 1fr)"] { grid-template-columns: 1fr !important; }
        section[style*="padding: 3.5rem 0"] h2[style*="font-size: 2rem"] { font-size: 1.6rem !important; }
        /* Past Leaders section */
        section#past-leaders { padding: 2.5rem 0 !important; }
        section#past-leaders h2[style*="font-size: 2rem"] { font-size: 1.6rem !important; }
        /* CTA */
        section[style*="padding: 3rem 0"][style*="#14532d"] .container { flex-direction: column !important; text-align: center !important; }
    }
    @media (max-width: 575px) {
        section[style*="padding: 5rem 0 4rem"] h1[style*="font-size: 3rem"] { font-size: 1.5rem !important; }
        /* Mission/Vision/Values: 2 → 1 */
        #about-nacos div[style*="repeat(3, 1fr)"] { grid-template-columns: 1fr !important; }
        /* Stats: 2x2 → 1 */
        #about-nacos div[style*="grid-template-columns: 1fr 1fr"][style*="gap: 1rem"] { grid-template-columns: 1fr !important; }
        /* Leaders grid smaller min */
        div[style*="minmax(280px, 1fr)"] { grid-template-columns: 1fr !important; }
        section[style*="padding: 3.5rem 0"] { padding: 2rem 0 !important; }
        /* CTA buttons full width */
        section[style*="#14532d"] div[style*="gap: 0.6rem"] { flex-direction: column !important; width: 100% !important; }
        section[style*="#14532d"] div[style*="gap: 0.6rem"] a { width: 100% !important; justify-content: center !important; }
    }
    @media (max-width: 480px) {
        section[style*="padding: 5rem 0 4rem"] h1[style*="font-size: 3rem"] { font-size: 1.3rem !important; }
    }
</style>
@endsection
