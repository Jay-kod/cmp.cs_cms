@extends('layouts.public')

@section('title', 'About Us')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
    $heroSetting = \App\Models\DepartmentSetting::where('key', 'hero_about')->first();
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp
<!-- Hero Section -->
<div class="about-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.97) 0%, rgba(4, 120, 87, 0.92) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; border: 1px solid rgba(255,255,255,0.04); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -150px; left: -80px; width: 500px; height: 500px; border: 1px solid rgba(255,255,255,0.03); border-radius: 50%;"></div>
    <div class="container" style="position: relative; z-index: 10; text-align: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-landmark" style="font-size: 0.7rem;"></i> {{ $gs('about_hero_badge', 'About Us') }}
        </div>
        <h1 style="color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">{{ $gs('about_hero_title', 'About Our Department') }}</h1>
        <p style="color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">{{ $gs('about_hero_subtitle', 'Department of Computer Science, Faculty of Natural and Applied Sciences — Nasarawa State University, Keffi') }}</p>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: -3rem; position: relative; z-index: 20; padding-bottom: 4rem;">
    <div class="main-content about-main" style="background: white; border-radius: 16px; box-shadow: 0 20px 50px -12px rgba(0,0,0,0.1); padding: 3rem 4rem;">

        <!-- ═══════════ OUR STORY ═══════════ -->
        <section id="our-story" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Our Story</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-story-layout" style="display: flex; gap: 2.5rem; align-items: flex-start; flex-wrap: wrap; margin-bottom: 2rem;">
                {{-- HOD Card --}}
                <div class="about-hod-card" style="flex: 0 0 220px; max-width: 220px;">
                    <div style="aspect-ratio: 1; border-radius: 14px; overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.1); border: 3px solid var(--color-accent);">
                        @if(isset($hod) && $hod && $hod->photo)
                            <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: #f0fdf4; padding: 1.5rem;">
                                <img src="{{ asset(config('university.logo', 'images/logo.png')) }}" alt="Department Logo" style="width: 80%; height: 80%; object-fit: contain;">
                            </div>
                        @endif
                    </div>
                    <div style="text-align: center; margin-top: 0.8rem;">
                        @if(isset($hod) && $hod)
                            <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.95rem;">{{ $hod->name }}</p>
                            <p style="margin: 0; color: var(--color-primary); font-size: 0.82rem;">{{ $hod->rank }}, HOD</p>
                        @else
                            <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.95rem;">Head of Department</p>
                            <p style="margin: 0; color: var(--color-primary); font-size: 0.82rem;">Department of Computer Science</p>
                        @endif
                    </div>
                </div>

                {{-- Story Text --}}
                <div class="about-story-text" style="flex: 1; min-width: 280px; font-size: 1.05rem; line-height: 1.85; color: #475569;">
                <p>The Department of Computer Science was established as a <strong>Unit</strong> in the Department of Mathematical Sciences, Faculty of Natural and Applied Sciences, in the <strong>2003/2004</strong> academic session and was upgraded to the status of a full <strong>Department in the 2017/18 session</strong>.</p>

                <div class="about-quote" style="border-left: 4px solid var(--color-primary); padding: 1.2rem 1.5rem; background: linear-gradient(90deg, rgba(22,163,74,0.04), transparent); border-radius: 0 8px 8px 0; margin: 1.5rem 0; font-style: italic; color: #334155; font-size: 1.08rem; line-height: 1.7;">
                    "The goal of the department is to be a leading edge in the area of competition, innovation, and society-responsive computing solutions — strategically aligning with the university's mission."
                </div>

                <p>With effect from the <strong>2021/2022</strong> academic session, two new programmes — <strong>Data Science & Technology</strong> and <strong>Cybersecurity & Forensic</strong> — were introduced alongside the core Computer Science programme.</p>

                <p>The department develops focused, trend-setting multidisciplinary research excellence with national, regional, and international recognition through diverse research projects. Our programmes are designed to produce <strong>market-ready graduates</strong> with the appropriate information technology skills and capacity for independent thinking, self-reliance, creativity, and resourcefulness.</p>

                <p>Our curricula are unique, robust, current, and comparable with international best practice — designed to meet and surpass academic standards prescribed by regulatory authorities. The development and implementation of our programmes are defined by ideals of <strong>inclusivity and accessibility</strong> to the Nasarawa State community we serve and the nation at large.</p>
                </div>
            </div>

            <!-- Timeline Milestones -->
            <div class="about-milestones" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.2rem; margin-top: 2.5rem;">
                <div style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">2003</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">Established as a Unit</div>
                </div>
                <div style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">2017</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">Upgraded to Department</div>
                </div>
                <div style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">2021</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">New Programmes Added</div>
                </div>
                <div style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">11+</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">Academic Programmes</div>
                </div>
            </div>
        </section>

        <!-- ═══════════ VISION & MISSION ═══════════ -->
        <section id="vision-mission" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Vision, Mission & Objectives</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-vm-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <!-- Vision -->
                <div class="about-vm-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 16px; padding: 2.5rem; position: relative; overflow: hidden; border: 1px solid rgba(22, 163, 74, 0.15); transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px -12px rgba(22,163,74,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -20px; right: -20px; font-size: 7rem; color: rgba(22, 163, 74, 0.06); transform: rotate(-15deg); pointer-events: none;"><i class="fa-solid fa-eye"></i></div>
                    <div style="width: 52px; height: 52px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.5rem; box-shadow: 0 8px 20px -4px rgba(22, 163, 74, 0.4);">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 style="font-size: 1.4rem; color: #1e293b; margin: 0 0 1rem 0; font-family: var(--font-heading); font-weight: 700;">Our Vision</h3>
                    <p style="color: #334155; font-size: 1rem; line-height: 1.7; margin: 0;">{{ $settings['vision_statement'] ?? 'To be a leading edge in the area of competition, innovation, and society-responsive computing solutions, strategically aligning with the university\'s mission to promote technological advancement.' }}</p>
                </div>

                <!-- Mission -->
                <div class="about-vm-card" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border-radius: 16px; padding: 2.5rem; position: relative; overflow: hidden; border: 1px solid rgba(16, 185, 129, 0.15); transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px -12px rgba(16,185,129,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -20px; right: -20px; font-size: 7rem; color: rgba(16, 185, 129, 0.06); transform: rotate(-15deg); pointer-events: none;"><i class="fa-solid fa-bullseye"></i></div>
                    <div style="width: 52px; height: 52px; background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.5rem; box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.4);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 style="font-size: 1.4rem; color: #1e293b; margin: 0 0 1rem 0; font-family: var(--font-heading); font-weight: 700;">Our Mission</h3>
                    <p style="color: #334155; font-size: 1rem; line-height: 1.7; margin: 0;">{{ $settings['mission_statement'] ?? 'To promote technological advancement by providing a conducive environment for research, teaching, and learning that engenders the development of products that are technology-oriented, self-reliant, and relevant to society.' }}</p>
                </div>
            </div>

            <!-- Objectives -->
            <div class="about-objectives-wrap" style="margin-top: 1.5rem; background: #ffffff; border-radius: 20px; padding: 3rem; border: 1px solid rgba(22, 163, 74, 0.12); box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(22,163,74,0.05), transparent 70%); pointer-events: none;"></div>
                <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: radial-gradient(circle, rgba(16,185,129,0.04), transparent 70%); pointer-events: none;"></div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; position: relative;">
                    <div style="width: 52px; height: 52px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; box-shadow: 0 8px 20px -4px rgba(22, 163, 74, 0.4);">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.4rem; color: #1e293b; margin: 0; font-family: var(--font-heading); font-weight: 700;">Our Objectives</h3>
                        <p style="margin: 0.2rem 0 0; font-size: 0.85rem; color: #64748b;">What we strive to achieve</p>
                    </div>
                </div>
                <div class="about-objectives-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; position: relative;">
                    @php
                        $objectives = [
                            ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.', 'accent' => '#059669'],
                            ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.', 'accent' => '#16a34a'],
                            ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.', 'accent' => '#10b981'],
                            ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.', 'accent' => '#047857'],
                        ];
                    @endphp
                    @foreach($objectives as $i => $obj)
                    <div style="text-align: center; padding: 1.2rem 1rem; background: #fafaf9; border-radius: 12px; border: 1px solid rgba(22,163,74,0.05); transition: all 0.3s cubic-bezier(0.4,0,0.2,1); cursor: default;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 28px -6px rgba(22,163,74,0.12)'; this.style.borderColor='rgba(22,163,74,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='rgba(22,163,74,0.05)'">
                        <div style="width: 40px; height: 40px; background: rgba(22,163,74,0.06); color: var(--color-primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; margin: 0 auto 0.8rem; border: 1px solid rgba(22,163,74,0.1);">
                            <i class="fa-solid {{ $obj['icon'] }}"></i>
                        </div>
                        <h4 style="margin: 0 0 0.4rem; font-size: 0.85rem; font-weight: 700; color: #1e293b; font-family: var(--font-heading);">{{ $obj['title'] }}</h4>
                        <p style="margin: 0; color: #475569; font-size: 0.82rem; line-height: 1.6;">{{ $obj['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ═══════════ CORE VALUES ═══════════ -->
        <section id="core-values" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Core Values</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-values-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.2rem;">
                @php
                    $coreValues = [
                        ['name' => 'Innovation', 'icon' => 'fa-lightbulb', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'Pioneering creative solutions in technology'],
                        ['name' => 'Excellence', 'icon' => 'fa-award', 'color' => '#15803d', 'bg' => '#f0fdf4', 'desc' => 'Pursuing the highest academic standards'],
                        ['name' => 'Integrity', 'icon' => 'fa-shield-halved', 'color' => '#10b981', 'bg' => '#ecfdf5', 'desc' => 'Upholding ethical principles in all endeavors'],
                        ['name' => 'Self-Reliance', 'icon' => 'fa-person-rays', 'color' => '#047857', 'bg' => '#ecfdf5', 'desc' => 'Building independent and capable professionals'],
                        ['name' => 'Inclusivity', 'icon' => 'fa-people-group', 'color' => '#059669', 'bg' => '#f0fdf4', 'desc' => 'Accessible education for all communities'],
                        ['name' => 'Creativity', 'icon' => 'fa-palette', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'Fostering original thinking and resourcefulness'],
                    ];
                @endphp
                @foreach($coreValues as $val)
                <div style="text-align: center; padding: 2rem 1.2rem; background: {{ $val['bg'] }}; border-radius: 14px; border: 1px solid {{ $val['color'] }}20; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: default;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 18px 35px -8px {{ $val['color'] }}25'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="val-icon" style="width: 56px; height: 56px; margin: 0 auto 1rem; background: linear-gradient(135deg, {{ $val['color'] }}, {{ $val['color'] }}dd); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: 0 8px 20px -4px {{ $val['color'] }}40;">
                        <i class="fa-solid {{ $val['icon'] }}"></i>
                    </div>
                    <h4 style="margin: 0 0 0.4rem; font-size: 1.1rem; color: #1e293b; font-weight: 700;">{{ $val['name'] }}</h4>
                    <p style="margin: 0; font-size: 0.82rem; color: #64748b; line-height: 1.5;">{{ $val['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ═══════════ PROGRAMMES OVERVIEW ═══════════ -->
        <section id="programmes" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Academic Programmes</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 1rem; border-radius: 2px;"></div>
            <p style="font-size: 1.02rem; color: #64748b; line-height: 1.7; margin-bottom: 2rem;">The department offers Bachelor's, Post-graduate Diploma, Master's, and PhD degrees in Computer Science, Cybersecurity & Forensic, and Data Science & Technology.</p>

            <div class="about-programmes-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.2rem;">
                <!-- Postgraduate -->
                <div style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 14px; padding: 2rem; color: white; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; border-radius: 50%; background: rgba(255,255,255,0.04);"></div>
                    <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-hat-wizard"></i>
                        </div>
                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 700;">Postgraduate</h4>
                    </div>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.6rem;">
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> Ph.D. Computer Science</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> M.Phil./Ph.D. Computer Science</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> M.Sc. Computer Science</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> M.Sc. (Database/Info Systems)</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> M.Sc. (Information Security)</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> M.Sc. (Networking)</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> M.Sc. (Software Engineering)</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #cbd5e1;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: #10b981;"></i> PGD Computer Science</li>
                    </ul>
                </div>

                <!-- Undergraduate -->
                <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 14px; padding: 2rem; position: relative; overflow: hidden; border: 1px solid #bbf7d0;">
                    <div style="position: absolute; top: -30px; right: -30px; width: 100px; height: 100px; border-radius: 50%; background: rgba(22,163,74,0.06);"></div>
                    <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                        <div style="width: 40px; height: 40px; background: rgba(22, 163, 74, 0.15); color: var(--color-primary); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <h4 style="margin: 0; font-size: 1.1rem; font-weight: 700; color: #1e293b;">Undergraduate</h4>
                    </div>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.6rem;">
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #334155;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: var(--color-primary);"></i> B.Sc. Computer Science</li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #334155;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: var(--color-primary);"></i> B.Sc. Network Technology & Cybersecurity <span style="font-size: 0.7rem; background: #dcfce7; color: #16a34a; padding: 0.1rem 0.4rem; border-radius: 4px; font-weight: 600;">Lincoln Uni</span></li>
                        <li style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.88rem; color: #334155;"><i class="fa-solid fa-chevron-right" style="font-size: 0.55rem; color: var(--color-primary);"></i> B.Sc. Software Engineering <span style="font-size: 0.7rem; background: #dcfce7; color: #16a34a; padding: 0.1rem 0.4rem; border-radius: 4px; font-weight: 600;">Lincoln Uni</span></li>
                    </ul>
                    <a href="/academics" style="display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 1.5rem; font-size: 0.88rem; color: var(--color-primary); font-weight: 600; text-decoration: none;" onmouseover="this.style.gap='0.8rem'" onmouseout="this.style.gap='0.5rem'">View full programme details <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; transition: transform 0.2s;"></i></a>
                </div>
            </div>
        </section>

        <!-- ═══════════ DEPARTMENTAL BOARD ═══════════ -->
        <section id="departmental-board" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-sitemap"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Departmental Board</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <p style="font-size: 1.02rem; color: #475569; line-height: 1.7; margin-bottom: 2rem;">The Departmental Board is made up of all lecturers in the Department except Graduate Assistants, with the Head of Department as the Chairman. The Board organizes and controls the teaching of all courses and the examinations held in those courses.</p>

            <div class="about-board-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.2rem;">
                <!-- Chairman -->
                <div style="background: linear-gradient(135deg, #064e3b 0%, #065f46 100%); border-radius: 14px; padding: 2rem; color: white; text-align: center; position: relative; overflow: hidden;">
                    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 50% 0%, rgba(16,185,129,0.2), transparent 70%); pointer-events: none;"></div>
                    <div style="position: relative; z-index: 2;">
                        <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.1); border: 2px solid rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; font-size: 1.8rem; color: #a7f3d0;">
                            <i class="fa-solid fa-crown"></i>
                        </div>
                        <h4 style="margin: 0 0 0.3rem; font-size: 1.15rem; font-weight: 700;">Chairman</h4>
                        <p style="margin: 0; color: #6ee7b7; font-size: 0.9rem;">Head of Department (HOD)</p>
                    </div>
                </div>

                <!-- Members -->
                <div style="background: linear-gradient(135deg, #f0fdf4, #ecfdf5); border-radius: 14px; padding: 2rem; text-align: center; border: 1px solid #bbf7d0;">
                    <div style="width: 64px; height: 64px; background: rgba(22,163,74,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; font-size: 1.8rem; color: var(--color-primary);">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h4 style="margin: 0 0 0.3rem; font-size: 1.15rem; color: #1e293b; font-weight: 700;">Members</h4>
                    <p style="margin: 0; color: #64748b; font-size: 0.9rem;">All Academic Staff<br><span style="font-size: 0.8rem; color: #94a3b8;">(Except Graduate Assistants)</span></p>
                </div>

                <!-- Mandate -->
                <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); border-radius: 14px; padding: 2rem; text-align: center; border: 1px solid #a7f3d0;">
                    <div style="width: 64px; height: 64px; background: rgba(16,185,129,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem; font-size: 1.8rem; color: #059669;">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <h4 style="margin: 0 0 0.3rem; font-size: 1.15rem; color: #1e293b; font-weight: 700;">Mandate</h4>
                    <p style="margin: 0; color: #64748b; font-size: 0.9rem;">Course organisation, teaching oversight & examination control</p>
                </div>
            </div>
        </section>

        <!-- ═══════════ ENTRY REQUIREMENTS ═══════════ -->
        <section id="entry-requirements" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Entry Requirements</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-req-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                @php
                    $requirements = [
                        ['level' => 'O\' Level', 'icon' => 'fa-school', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'WAEC/NECO with 5 credits including Maths & English'],
                        ['level' => 'A\' Level', 'icon' => 'fa-book-open', 'color' => '#15803d', 'bg' => '#f0fdf4', 'desc' => 'Advanced Level or JUPEB with required passes'],
                        ['level' => 'UTME', 'icon' => 'fa-pen-fancy', 'color' => '#059669', 'bg' => '#ecfdf5', 'desc' => 'Mathematics, English, Physics & one of Chemistry/Biology/Economics'],
                        ['level' => 'Postgraduate', 'icon' => 'fa-user-graduate', 'color' => '#10b981', 'bg' => '#f0fdf4', 'desc' => 'B.Sc. in Computer Science or related field with minimum of 2nd Class'],
                        ['level' => 'PhD', 'icon' => 'fa-hat-wizard', 'color' => '#047857', 'bg' => '#ecfdf5', 'desc' => 'M.Sc. in Computer Science or related field'],
                    ];
                @endphp
                @foreach($requirements as $req)
                <div style="padding: 1.5rem; background: {{ $req['bg'] }}; border-radius: 12px; text-align: center; border: 1px solid {{ $req['color'] }}15; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 44px; height: 44px; background: {{ $req['color'] }}; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 1rem; box-shadow: 0 6px 15px -3px {{ $req['color'] }}40;">
                        <i class="fa-solid {{ $req['icon'] }}"></i>
                    </div>
                    <h4 style="margin: 0 0 0.4rem; font-size: 1rem; color: #1e293b; font-weight: 700;">{{ $req['level'] }}</h4>
                    <p style="margin: 0; font-size: 0.8rem; color: #64748b; line-height: 1.5;">{{ $req['desc'] }}</p>
                </div>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="/academics" style="display: inline-flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; color: var(--color-primary); font-weight: 600; text-decoration: none; padding: 0.6rem 1.5rem; border: 2px solid var(--color-primary); border-radius: 10px; transition: all 0.3s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='var(--color-primary)'">See Full Admission Details <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i></a>
            </div>
        </section>

        <!-- ═══════════ FACILITIES & LABS ═══════════ -->
        <section id="facilities" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-server"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Facilities & Labs</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 1rem; border-radius: 2px;"></div>
            <p style="font-size: 1.02rem; color: #64748b; line-height: 1.7; margin-bottom: 2rem;">Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.</p>

            <div class="about-facilities-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.2rem;">
                @php
                    $labs = [
                        ['name' => 'Software Engineering Lab', 'icon' => 'fa-code', 'gradient' => 'linear-gradient(135deg, #16a34a, #15803d)', 'shadow' => 'rgba(22,163,74,0.3)', 'desc' => 'Modern IDEs and collaboration tools for full-stack software development, testing, and real-world project simulations.'],
                        ['name' => 'Hardware & Networking Lab', 'icon' => 'fa-network-wired', 'gradient' => 'linear-gradient(135deg, #10b981, #059669)', 'shadow' => 'rgba(16,185,129,0.3)', 'desc' => 'Hands-on experience with CISCO routing, switching, and embedded systems micro-controller design.'],
                        ['name' => 'AI & Data Science Hub', 'icon' => 'fa-microchip', 'gradient' => 'linear-gradient(135deg, #059669, #047857)', 'shadow' => 'rgba(5,150,105,0.3)', 'desc' => 'High-performance computing clusters for machine learning, big data analytics, and advanced algorithmic processing.'],
                        ['name' => 'Cybersecurity Lab', 'icon' => 'fa-shield-halved', 'gradient' => 'linear-gradient(135deg, #15803d, #14532d)', 'shadow' => 'rgba(21,128,61,0.3)', 'desc' => 'Dedicated environment for penetration testing, digital forensics, and cybersecurity research.'],
                    ];
                @endphp
                @foreach($labs as $lab)
                <div class="about-facilities-card" style="display: flex; gap: 1.2rem; background: #f8fafc; padding: 1.8rem; border-radius: 14px; border: 1px solid #e2e8f0; transition: all 0.3s;" onmouseover="this.style.background='#f1f5f9'; this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px -8px rgba(0,0,0,0.08)'" onmouseout="this.style.background='#f8fafc'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: {{ $lab['gradient'] }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; box-shadow: 0 8px 20px -4px {{ $lab['shadow'] }};">
                        <i class="fa-solid {{ $lab['icon'] }}"></i>
                    </div>
                    <div>
                        <strong style="font-size: 1.1rem; display: block; margin-bottom: 0.4rem; color: #1e293b; font-family: var(--font-heading);">{{ $lab['name'] }}</strong>
                        <p style="margin: 0; color: #64748b; line-height: 1.6; font-size: 0.92rem;">{{ $lab['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- ═══════════ FACULTY CTA ═══════════ -->
        <section id="our-faculty">
                <div class="about-faculty-cta" style="background: linear-gradient(135deg, var(--color-primary) 0%, #047857 50%, #0f766e 100%); border-radius: 16px; padding: 3.5rem; color: white; text-align: center; position: relative; overflow: hidden; box-shadow: 0 15px 30px -8px rgba(22, 163, 74, 0.4);">
                <div style="position: absolute; top: -60px; right: -60px; width: 250px; height: 250px; background: rgba(255,255,255,0.06); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -80px; left: -40px; width: 200px; height: 200px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
                <div style="position: absolute; top: 50%; left: 10%; width: 120px; height: 120px; border: 1px solid rgba(255,255,255,0.08); border-radius: 50%; transform: translateY(-50%);"></div>

                <div style="position: relative; z-index: 10;">
                    <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 1rem; background: rgba(255,255,255,0.1); color: #a7f3d0; border-radius: 20px; font-size: 0.75rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.2rem; border: 1px solid rgba(255,255,255,0.15);">
                        <i class="fa-solid fa-users" style="font-size: 0.65rem;"></i> 27+ Academic Staff
                    </div>
                    <h2 style="margin: 0 0 1rem 0; font-size: 2.2rem; font-family: var(--font-heading); font-weight: 800;">Meet Our Faculty</h2>
                    <p style="font-size: 1.05rem; max-width: 600px; margin: 0 auto 2rem auto; line-height: 1.7; color: #d1fae5;">
                        Our department is home to <strong>3 Professors</strong>, <strong>3 Associate Professors</strong>, and a team of dedicated academics with expertise spanning AI, cybersecurity, data science, networking, and software engineering.
                    </p>
                    <div class="cta-buttons" style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <a href="/people" style="display: inline-flex; align-items: center; gap: 0.8rem; background: white; color: var(--color-primary); padding: 0.9rem 2.2rem; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0.3s; box-shadow: 0 10px 20px -5px rgba(0,0,0,0.15); font-size: 0.95rem;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 30px -5px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px -5px rgba(0,0,0,0.15)'">
                            View Staff Directory <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="/contact" style="display: inline-flex; align-items: center; gap: 0.8rem; background: transparent; color: white; padding: 0.9rem 2.2rem; border-radius: 12px; font-weight: 700; text-decoration: none; transition: all 0.3s; border: 2px solid rgba(255,255,255,0.3); font-size: 0.95rem;" onmouseover="this.style.borderColor='rgba(255,255,255,0.6)'; this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.background='transparent'">
                            Contact Us <i class="fa-solid fa-envelope"></i>
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
            'facilities' => 'Facilities & Labs',
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
