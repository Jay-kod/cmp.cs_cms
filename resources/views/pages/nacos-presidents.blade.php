@extends('layouts.public')
@section('title', 'NACOS — National Association of Computing Students')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
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
        <p style="color: #94a3b8; font-size: 1.1rem; max-width: 620px; margin: 0 auto 2rem; line-height: 1.7;">{{ $gs('nacos_presidents_subtitle', 'The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.') }}</p>
        <div style="display: flex; gap: 0.6rem; justify-content: center; flex-wrap: wrap;">
            <a href="#about-nacos" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #16a34a, #059669); color: white; padding: 0.65rem 1.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba(22,163,74,0.3); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-circle-info"></i> About NACOS
            </a>
            <a href="#past-leaders" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.08); color: white; padding: 0.65rem 1.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 600; text-decoration: none; border: 1.5px solid rgba(255,255,255,0.15); transition: all 0.2s; backdrop-filter: blur(4px);" onmouseover="this.style.borderColor='rgba(255,255,255,0.4)'; this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'; this.style.background='rgba(255,255,255,0.08)'">
                <i class="fa-solid fa-crown"></i> Past Leaders
            </a>
            @if(filled($gs('nacos_official_website_url')))
            <a href="{{ $gs('nacos_official_website_url') }}" target="_blank" rel="noopener noreferrer" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #eab308, #ca8a04); color: white; padding: 0.65rem 1.5rem; border-radius: 8px; font-size: 0.9rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 15px rgba(234,179,8,0.3); transition: all 0.2s; border: none;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(234,179,8,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(234,179,8,0.3)'">
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
                <p style="color: #475569; font-size: 1rem; line-height: 1.8; margin: 0 0 1.2rem;">{{ $gs('nacos_page_about_text', 'The National Association of Computing Students (NACOS) is the umbrella body for all students studying computing-related disciplines. Our NUK Chapter is dedicated to fostering academic excellence, professional development, and strong social bonds among members.') }}</p>
                <p style="color: #64748b; font-size: 0.95rem; line-height: 1.8; margin: 0;">{{ $gs('nacos_page_about_text2', 'Through workshops, hackathons, seminars, and community outreach, NACOS prepares students for the ever-evolving tech industry while building a supportive network that extends well beyond graduation.') }}</p>
            </div>
            {{-- Stats Column --}}
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                @php
                    $pageStats = [
                        ['icon' => 'fa-solid fa-crown',           'value' => $presidents->count(), 'label' => 'Past Leaders',   'color' => '#16a34a'],
                        ['icon' => 'fa-solid fa-calendar-check',  'value' => $gs('nacos_page_stat_events', '50+'),  'label' => $gs('nacos_page_stat_events_label', 'Events Hosted'),  'color' => '#0891b2'],
                        ['icon' => 'fa-solid fa-user-graduate',   'value' => $gs('nacos_page_stat_members', '500+'),'label' => $gs('nacos_page_stat_members_label','Active Members'), 'color' => '#7c3aed'],
                        ['icon' => 'fa-solid fa-trophy',          'value' => $gs('nacos_page_stat_awards', '20+'),  'label' => $gs('nacos_page_stat_awards_label', 'Awards Won'),     'color' => '#ea580c'],
                    ];
                @endphp
                @foreach($pageStats as $stat)
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1.5rem; text-align: center; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.06)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="width: 44px; height: 44px; background: {{ $stat['color'] }}15; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.8rem;">
                        <i class="{{ $stat['icon'] }}" style="color: {{ $stat['color'] }}; font-size: 1.1rem;"></i>
                    </div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #0f172a; font-family: var(--font-heading); line-height: 1;">{{ $stat['value'] }}</div>
                    <div style="font-size: 0.78rem; color: #64748b; margin-top: 0.3rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Mission / Vision / Values Cards --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem;">
            @php
                $pillars = [
                    [
                        'icon'  => 'fa-solid fa-bullseye',
                        'title' => $gs('nacos_page_pillar1_title', 'Our Mission'),
                        'text'  => $gs('nacos_page_pillar1_text', 'To promote academic excellence, advance computing knowledge, and nurture future tech leaders through hands-on learning, mentorship, and industry collaboration.'),
                        'color' => '#16a34a',
                    ],
                    [
                        'icon'  => 'fa-solid fa-eye',
                        'title' => $gs('nacos_page_pillar2_title', 'Our Vision'),
                        'text'  => $gs('nacos_page_pillar2_text', 'To be the foremost student body shaping innovative, ethical, and globally competitive computing professionals in Nigeria and beyond.'),
                        'color' => '#0891b2',
                    ],
                    [
                        'icon'  => 'fa-solid fa-heart',
                        'title' => $gs('nacos_page_pillar3_title', 'Our Values'),
                        'text'  => $gs('nacos_page_pillar3_text', 'Innovation, integrity, collaboration, inclusivity, and continuous learning form the bedrock of everything we do as an association.'),
                        'color' => '#7c3aed',
                    ],
                ];
            @endphp
            @foreach($pillars as $pillar)
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 1.5rem; position: relative; overflow: hidden; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px rgba(0,0,0,0.07)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: {{ $pillar['color'] }};"></div>
                <div style="width: 42px; height: 42px; background: {{ $pillar['color'] }}12; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    <i class="{{ $pillar['icon'] }}" style="color: {{ $pillar['color'] }}; font-size: 1.1rem;"></i>
                </div>
                <h3 style="font-size: 1.1rem; font-family: var(--font-heading); font-weight: 700; color: #0f172a; margin: 0 0 0.6rem;">{{ $pillar['title'] }}</h3>
                <p style="color: #64748b; font-size: 0.9rem; line-height: 1.7; margin: 0;">{{ $pillar['text'] }}</p>
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

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem;">
            @foreach($activities as $act)
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.4rem; transition: all 0.3s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 18px rgba(0,0,0,0.06)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <div style="width: 40px; height: 40px; background: rgba(22,163,74,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 0.8rem;">
                    <i class="{{ $act['icon'] }}" style="color: var(--color-primary); font-size: 1rem;"></i>
                </div>
                <h4 style="font-size: 0.95rem; font-weight: 700; color: #0f172a; margin: 0 0 0.4rem; font-family: var(--font-heading);">{{ $act['title'] }}</h4>
                <p style="color: #64748b; font-size: 0.85rem; line-height: 1.6; margin: 0;">{{ $act['desc'] }}</p>
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

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem;">
            @forelse($presidents as $p)
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.04); transition: all 0.3s; padding-bottom: 1.3rem;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.04)'">
                <div style="height: 100px; background: linear-gradient(135deg, #0f172a 0%, #1e3a2f 100%); position: relative; margin-bottom: 50px;">
                    <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2230%22 height=%2230%22><circle cx=%2215%22 cy=%2215%22 r=%220.4%22 fill=%22rgba(74,222,128,0.08)%22/></svg>');"></div>
                    <img src="{{ $p->photo ? asset('storage/'.$p->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $p->name }}" style="width: 90px; height: 90px; border-radius: 50%; border: 3px solid white; position: absolute; bottom: -45px; left: 50%; transform: translateX(-50%); object-fit: cover; background: white; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($p->name) }}&background=16a34a&color=fff&size=150'">
                </div>
                
                <div style="padding: 0 1.3rem; text-align: center;">
                    <h3 style="margin: 0; font-size: 1.15rem; font-weight: 700; color: #0f172a; font-family: var(--font-heading);">{{ $p->name }}</h3>
                    <div style="display: inline-block; background: rgba(22,163,74,0.1); padding: 0.2rem 0.7rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; color: var(--color-primary); margin: 0.5rem 0;">
                        {{ $p->tenure_start ?? 'Unknown' }} – {{ $p->tenure_end ?? 'Present' }}
                    </div>
                    
                    @if($p->current_status)
                        <p style="margin: 0.3rem 0 0; font-size: 0.85rem; color: #475569;">
                            <i class="fa-solid fa-briefcase" style="color: var(--color-primary); margin-right: 4px; font-size: 0.75rem;"></i> {{ $p->current_status }}
                        </p>
                    @endif
                    
                    @if($p->bio)
                        <p style="font-size: 0.85rem; color: #64748b; line-height: 1.6; border-top: 1px solid #f1f5f9; padding-top: 0.8rem; margin: 0.8rem 0 0;">
                            {{ $p->bio }}
                        </p>
                    @endif
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
