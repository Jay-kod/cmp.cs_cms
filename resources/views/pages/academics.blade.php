@extends('layouts.public')
@section('title', 'Academics')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_academics')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp
<!-- Hero Section -->
<div class="relative py-24 pb-28 text-center flex flex-col items-center acad-hero bg-slate-900 overflow-hidden group">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-emerald-800/90 to-slate-900/95 z-0"></div>
    <div class="absolute inset-0 bg-center bg-cover bg-no-repeat mix-blend-overlay z-[-1] transition-transform duration-[10s] group-hover:scale-105" style="background-image: url('{{ $heroUrl }}');"></div>
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,rgba(16,185,129,0.15),transparent_50%),radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.1),transparent_50%)] pointer-events-none z-0"></div>
    
    <!-- Floating Decorative Elements -->
    <div class="absolute top-[15%] right-[10%] w-[150px] h-[150px] border border-white/5 rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[10%] left-[5%] w-[250px] h-[250px] border border-white/5 rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[20%] right-[25%] text-[8rem] text-white/5 rotate-15 pointer-events-none"><i class="fa-solid fa-laptop-code"></i></div>
    
    <div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 py-1.5 px-5 bg-white/10 backdrop-blur-md text-emerald-200 rounded-full text-xs font-semibold tracking-[1.5px] uppercase mb-6 border border-white/10">
            <i class="fa-solid fa-book-open text-[0.7rem]"></i> {{ $gs('academics_hero_badge', 'Explore Our Programs') }}
        </div>
        <h1 class="text-white text-4xl md:text-5xl font-heading font-extrabold mb-4 drop-shadow-xl">{{ $gs('academics_hero_title', 'Discover Academic Excellence') }}</h1>
        <p class="text-slate-300 text-lg max-w-[680px] mx-auto leading-relaxed">{{ $gs('academics_hero_subtitle', 'Rigorous computing programmes designed to equip you with cutting-edge skills for the technology-driven world.') }}</p>
    </div>
</div>

<div class="container relative z-20 pb-16 -mt-12 page-layout">
    <div class="bg-white rounded-2xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.1)] p-8 md:p-12 acad-main">

        {{-- Search / Filter Bar --}}
        <div id="acad-search-bar" class="bg-slate-50 border border-slate-200 rounded-xl p-4 md:px-6 mb-10 flex flex-wrap gap-3 items-center">
            <div class="flex-1 min-w-[200px] relative group">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-primary transition-colors"></i>
                <input type="text" id="acad-search-input" placeholder="Search programmes or courses..." class="w-full py-2.5 pr-3 pl-9 border border-slate-200 rounded-lg text-sm bg-white outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all">
            </div>
            <select id="acad-section-filter" class="py-2.5 px-4 border border-slate-200 rounded-lg text-sm bg-white text-slate-700 cursor-pointer outline-none focus:border-primary focus:ring-1 focus:ring-primary/20 transition-all">
                <option value="all">All Sections</option>
                <option value="programmes">Programmes Only</option>
                <option value="courses">Courses Only</option>
            </select>
            <span id="acad-result-count" class="text-xs text-slate-500 font-medium py-1.5 px-3 bg-white rounded-full border border-slate-200 whitespace-nowrap"></span>
        </div>

        {{-- ═══════════ PROGRAMME CATEGORIES OVERVIEW ═══════════ --}}
        <section data-aos="fade-up" id="overview" class="mb-16">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/15 to-indigo-500/10 text-blue-500 flex items-center justify-center text-xl shadow-sm">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <h2 class="m-0 text-3xl text-slate-900 font-heading font-bold">{{ $gs('academics_overview_title', 'Degree Programmes') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-sm mb-8"></div>
            
            <p class="text-lg leading-relaxed text-slate-600 mb-10 max-w-4xl">
                {{ $gs('academics_overview_desc', 'We offer rigorous academic paths ranging from undergraduate to doctoral studies, customized to meet global technology demands and equip our graduates with both theoretical depth and practical prowess.') }}
            </p>

            {{-- Category Quick Nav Cards --}}
            <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-5">
                @php
                    $catColors = [
                        ['bg' => 'bg-blue-50', 'border' => 'border-blue-200', 'text' => 'text-blue-700', 'icon' => 'text-blue-500', 'hover' => 'hover:border-blue-300 hover:shadow-blue-500/10'],
                        ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200', 'text' => 'text-emerald-700', 'icon' => 'text-emerald-500', 'hover' => 'hover:border-emerald-300 hover:shadow-emerald-500/10'],
                        ['bg' => 'bg-purple-50', 'border' => 'border-purple-200', 'text' => 'text-purple-700', 'icon' => 'text-purple-500', 'hover' => 'hover:border-purple-300 hover:shadow-purple-500/10'],
                        ['bg' => 'bg-amber-50', 'border' => 'border-amber-200', 'text' => 'text-amber-700', 'icon' => 'text-amber-500', 'hover' => 'hover:border-amber-300 hover:shadow-amber-500/10'],
                        ['bg' => 'bg-sky-50', 'border' => 'border-sky-200', 'text' => 'text-sky-700', 'icon' => 'text-sky-500', 'hover' => 'hover:border-sky-300 hover:shadow-sky-500/10']
                    ];
                @endphp
                @foreach($categories as $index => $cat)
                @php $color = $catColors[$index % 5]; @endphp
                <a href="#{{ $cat->slug }}" class="group flex gap-5 items-start bg-white p-6 rounded-2xl no-underline border border-slate-200 transition-all duration-300 relative overflow-hidden hover:-translate-y-1 hover:shadow-[0_12px_25px_-5px_rgba(0,0,0,0.05)] {{ $color['hover'] }}">
                    
                    {{-- Left Side: Icon --}}
                    <div class="w-14 h-14 shrink-0 {{ $color['bg'] }} rounded-xl flex items-center justify-center text-2xl {{ $color['icon'] }} border {{ $color['border'] }} transition-transform duration-300 group-hover:scale-110">
                        <i class="{{ $cat->icon ?? 'fa-solid fa-graduation-cap' }}"></i>
                    </div>

                    {{-- Right Side: Title + Count --}}
                    <div class="flex-1 flex flex-col justify-center gap-1.5 pt-0.5">
                        <strong class="text-[1.15rem] text-slate-800 font-heading leading-tight group-hover:{{ $color['text'] }} transition-colors">{{ $cat->name }}</strong>
                        
                        <div class="inline-flex items-center gap-2 text-[0.85rem] text-slate-500 font-medium">
                            <span class="flex items-center justify-center w-[22px] h-[22px] bg-slate-100 rounded-full {{ $color['icon'] }} text-[0.7rem] transition-colors group-hover:{{ $color['bg'] }}">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            {{ $cat->programmes->count() }} Programme{{ $cat->programmes->count() !== 1 ? 's' : '' }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        {{-- ═══════════ HOW TO APPLY SUMMARY (NEW) ═══════════ --}}
        <section data-aos="fade-up" id="admission-process" class="acad-admission mb-16 p-8 md:p-12 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl text-white relative overflow-hidden shadow-[0_15px_30px_-10px_rgba(15,23,42,0.5)]">
            <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-[radial-gradient(circle,rgba(16,185,129,0.1)_0%,transparent_60%)] pointer-events-none"></div>
            
            <div class="text-center mb-10 relative z-10">
                <span class="inline-block py-1.5 px-4 bg-white/10 text-emerald-200 rounded-full text-xs font-semibold tracking-[1.5px] uppercase mb-4">{{ $gs('academics_apply_badge', 'Admissions') }}</span>
                <h2 class="m-0 mb-4 text-3xl font-heading text-white font-bold">{{ $gs('academics_apply_title', 'How to Apply') }}</h2>
                <p class="text-slate-300 text-[1.05rem] max-w-[500px] mx-auto">{{ $gs('academics_apply_subtitle', 'Join our vibrant academic community in three simple steps.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-8 relative z-10">
                @php
                    $applySteps = json_decode(\App\Models\DepartmentSetting::getCached('academics_apply_steps') ?? '[]', true) ?? [];
                    if (empty($applySteps)) {
                        $applySteps = [
                            ['title' => 'Check Requirements', 'desc' => 'Review the entry requirements for your desired programme under its details below.'],
                            ['title' => 'University Portal', 'desc' => 'Visit the central NSUK admissions portal to purchase forms during the intake window.'],
                            ['title' => 'Screening', 'desc' => 'Attend the departmental screening exercise with your credentials.']
                        ];
                    }
                @endphp
                @foreach($applySteps as $i => $step)
                <div data-aos="fade-up" class="group bg-gradient-to-br from-slate-800/70 to-slate-900/90 p-6 lg:p-8 rounded-2xl border border-white/10 text-center backdrop-blur-md transition-all duration-400 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.3)] hover:-translate-y-2 hover:border-emerald-500/40 hover:shadow-[0_20px_40px_-5px_rgba(0,0,0,0.4),inset_0_0_0_1px_rgba(16,185,129,0.2)]">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary to-emerald-700 text-white rounded-full flex items-center justify-center text-2xl font-extrabold mx-auto mb-6 shadow-[0_8px_20px_rgba(16,185,129,0.3)] border-2 border-white/10">{{ $i + 1 }}</div>
                    <strong class="block text-[1.25rem] font-heading mb-3 text-white">{{ $step['title'] ?? '' }}</strong>
                    <p class="text-[0.95rem] text-slate-400 m-0 leading-relaxed">{{ $step['desc'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ═══════════ DETAILED PROGRAMMES BY CATEGORY ═══════════ --}}
        @foreach($categories as $index => $cat)
        @php 
            // Cycle through some brand colors for section headers
            $headers = ['text-emerald-500 bg-emerald-500 border-emerald-500', 'text-blue-500 bg-blue-500 border-blue-500', 'text-purple-500 bg-purple-500 border-purple-500', 'text-orange-500 bg-orange-500 border-orange-500'];
            $headerBg = ['bg-emerald-500/15', 'bg-blue-500/15', 'bg-purple-500/15', 'bg-orange-500/15'];
            $hc = explode(' ', $headers[$index % 4]);
            $bg = $headerBg[$index % 4];
        @endphp
        <section data-aos="fade-up" id="{{ $cat->slug }}" class="mb-16">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-11 h-11 {{ $bg }} {{ $hc[0] }} rounded-xl flex items-center justify-center text-xl">
                    <i class="{{ $cat->icon ?? 'fa-solid fa-graduation-cap' }}"></i>
                </div>
                <h2 class="m-0 text-3xl text-slate-900 font-heading font-bold">{{ $cat->name }}</h2>
            </div>
            <div class="w-[50px] h-1 {{ $hc[1] }} mb-6 rounded-sm"></div>

            @if($cat->description)
            <p class="text-[1.05rem] leading-relaxed text-slate-600 mb-8 max-w-[800px]">{{ $cat->description }}</p>
            @endif

            @if($cat->programmes->isEmpty())
            <div class="bg-slate-50 p-10 rounded-xl text-center text-slate-500 border border-dashed border-slate-300">
                <div class="w-12 h-12 bg-slate-200 text-slate-400 rounded-full flex items-center justify-center text-xl mx-auto mb-4">
                    <i class="fa-solid fa-info"></i>
                </div>
                <p class="m-0 text-base">Information regarding programmes in this category is currently being updated.</p>
            </div>
            @else
            <div class="grid gap-5">
                @foreach($cat->programmes as $prog)
                <details class="group bg-white rounded-xl border border-slate-200 overflow-hidden shadow-[0_4px_6px_-1px_rgba(0,0,0,0.02)] transition-shadow duration-300 hover:shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05)] acad-programme-item" data-name="{{ strtolower($prog->name) }}" data-level="{{ strtolower($prog->level ?? '') }}">
                    
                    <summary class="cursor-pointer p-6 relative list-none select-none">
                        <div class="absolute right-6 top-6 w-9 h-9 bg-slate-50 border border-slate-200 text-slate-500 rounded-full flex items-center justify-center transition-transform duration-300 z-10 group-open:rotate-180">
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </div>

                        <div class="w-full box-border pr-14">
                            <div class="mb-4">
                                <h3 class="m-0 text-base text-blue-700 bg-blue-50 font-heading leading-[1.4] py-1.5 px-3 rounded-lg inline-block">{{ $prog->name }}</h3>
                            </div>
                            
                            {{-- Meta Badges --}}
                            <div class="flex flex-nowrap items-center gap-1.5 w-full">
                                @if($prog->level)
                                <span class="bg-emerald-500/10 text-emerald-700 py-1 px-2.5 rounded-full text-xs font-bold border border-emerald-500/20 whitespace-nowrap shrink-0 tracking-[0.2px]">
                                    {{ $prog->level }}
                                </span>
                                @endif
                                @if($prog->duration)
                                <span class="bg-slate-50 text-slate-600 py-1 px-2.5 rounded-full text-xs font-semibold border border-slate-200 inline-flex items-center gap-1 whitespace-nowrap shrink-0 tracking-[0.2px]">
                                    <i class="fa-regular fa-clock text-[0.65rem]"></i> {{ $prog->duration }}
                                </span>
                                @endif
                                @if($prog->mode_of_study)
                                <span class="bg-slate-50 text-slate-600 py-1 px-2.5 rounded-full text-xs font-semibold border border-slate-200 inline-flex items-center gap-1 whitespace-nowrap shrink-0 tracking-[0.2px]">
                                    <i class="fa-solid fa-book-open text-[0.65rem]"></i> {{ $prog->mode_of_study }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </summary>

                    <div class="px-6 pb-6 pt-0 border-t border-slate-100">
                        @if($prog->description)
                        <p class="leading-relaxed text-slate-600 text-[0.95rem] my-4">{{ $prog->description }}</p>
                        @endif

                        <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-4">
                            @if($prog->objectives)
                            <div class="bg-purple-50 p-5 rounded-lg border-l-4 border-purple-500">
                                <h4 class="m-0 mb-2 text-[0.95rem] text-purple-700 flex items-center gap-2"><i class="fa-solid fa-bullseye"></i> Objectives</h4>
                                <p class="m-0 text-[0.9rem] text-purple-900 leading-relaxed">{{ $prog->objectives }}</p>
                            </div>
                            @endif

                            @if($prog->career_pathways)
                            <div class="bg-blue-50 p-5 rounded-lg border-l-4 border-blue-500">
                                <h4 class="m-0 mb-2 text-[0.95rem] text-blue-700 flex items-center gap-2"><i class="fa-solid fa-road"></i> Career Pathways</h4>
                                <p class="m-0 text-[0.9rem] text-blue-900 leading-relaxed">{{ $prog->career_pathways }}</p>
                            </div>
                            @endif

                            @if($prog->requirements_utme)
                            <div class="bg-pink-50 p-5 rounded-lg border-l-4 border-pink-500">
                                <h4 class="m-0 mb-2 text-[0.95rem] text-pink-700 flex items-center gap-2"><i class="fa-solid fa-clipboard-check"></i> UTME Requirements</h4>
                                <p class="m-0 text-[0.9rem] text-pink-900 leading-relaxed">{{ $prog->requirements_utme }}</p>
                            </div>
                            @endif

                            @if($prog->requirements_de)
                            <div class="bg-amber-50 p-5 rounded-lg border-l-4 border-amber-500">
                                <h4 class="m-0 mb-2 text-[0.95rem] text-amber-700 flex items-center gap-2"><i class="fa-solid fa-clipboard-list"></i> Direct Entry Requirements</h4>
                                <p class="m-0 text-[0.9rem] text-amber-900 leading-relaxed">{{ $prog->requirements_de }}</p>
                            </div>
                            @endif
                        </div>

                        @if($prog->handbook_pdf)
                        <div class="mt-6 pt-5 border-t border-dashed border-slate-200 text-right">
                            <a href="{{ asset('storage/' . $prog->handbook_pdf) }}" target="_blank" class="inline-flex items-center gap-2 bg-primary text-white py-2.5 px-5 rounded-lg font-semibold text-sm no-underline transition-colors hover:bg-secondary">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Download Handbook
                            </a>
                        </div>
                        @endif
                    </div>
                </details>
                @endforeach
            </div>
            @endif
        </section>
        @endforeach

        {{-- ═══════════ COURSE STRUCTURE ═══════════ --}}
        <section data-aos="fade-up" id="course-structure" class="mb-16">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500/15 to-emerald-500/10 text-emerald-600 flex items-center justify-center text-xl shadow-sm border border-emerald-500/20">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <h2 class="m-0 text-3xl text-slate-900 font-heading font-bold tracking-tight">{{ $gs('academics_courses_title', 'Course Structure') }}</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-blue-500 to-emerald-500 rounded-sm mb-6"></div>
            
            <p class="text-[1.05rem] leading-relaxed text-slate-600 mb-10 max-w-4xl">{{ $gs('academics_courses_desc', 'Browse the unified curriculum outline showing core and elective courses across different academic levels.') }}</p>

            @foreach($courses as $level => $levelCourses)
            <div class="bg-white border border-slate-200/80 rounded-2xl mb-10 overflow-hidden shadow-[0_12px_30px_-10px_rgba(37,99,235,0.08)] group hover:border-emerald-200 transition-all duration-300">
                <div class="bg-slate-50 py-5 px-7 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <span class="bg-gradient-to-br from-emerald-500 to-blue-600 text-white w-12 h-12 rounded-xl flex items-center justify-center font-extrabold text-[1.2rem] shadow-md border border-emerald-400/20">L{{ $level }}</span>
                        <h3 class="m-0 text-[1.4rem] text-slate-800 font-heading font-bold tracking-tight">Level {{ $level }} Courses</h3>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse min-w-[650px] text-left">
                        <thead>
                            <tr class="bg-white text-slate-400 text-[0.75rem] uppercase tracking-wider border-b border-slate-100">
                                <th class="py-4 px-7 font-bold">Course Code</th>
                                <th class="py-4 px-7 font-bold">Course Title</th>
                                <th class="py-4 px-7 font-bold text-center">Units</th>
                                <th class="py-4 px-7 font-bold text-center">Semester</th>
                                <th class="py-4 px-7 font-bold text-center">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($levelCourses as $index => $course)
                            <tr class="acad-course-row border-b border-slate-100 {{ $index % 2 === 0 ? 'bg-white' : 'bg-slate-50/50' }} transition-all duration-200 hover:bg-slate-100 hover:-translate-y-[1px]" data-code="{{ strtolower($course->code) }}" data-coursetitle="{{ strtolower($course->title) }}">
                                <td class="py-5 px-7">
                                    <strong class="text-primary font-mono text-[0.95rem] bg-primary/10 py-1.5 px-3 rounded-lg border border-primary/20 font-bold tracking-[0.5px]">{{ $course->code }}</strong>
                                </td>
                                <td class="py-5 px-7 text-slate-800 text-base font-semibold">{{ $course->title }}</td>
                                <td class="py-5 px-7 text-center text-slate-600 font-bold text-base">{{ $course->credit_units }}</td>
                                <td class="py-5 px-7 text-center text-slate-500 text-[0.95rem] font-medium">
                                    <span class="inline-flex items-center gap-1.5 bg-white py-1 px-3 rounded-full border border-slate-200 shadow-sm"><i class="fa-solid {{ strtolower($course->semester) == 'first' ? 'fa-sun text-amber-500' : 'fa-snowflake text-sky-400' }}"></i> {{ $course->semester }}</span>
                                </td>
                                <td class="py-5 px-7 text-center">
                                    @if($course->is_elective)
                                        <span class="bg-amber-500/10 text-amber-700 py-1.5 px-4 rounded-full text-xs font-extrabold uppercase border border-amber-500/20 tracking-[0.5px]">Elective</span>
                                    @else
                                        <span class="bg-emerald-500/10 text-emerald-700 py-1.5 px-4 rounded-full text-xs font-extrabold uppercase border border-emerald-500/20 tracking-[0.5px]">Core</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </section>
    </div>
</div>

<style>
    /* Details/Summary animation styles */
    details.programme-card summary::-webkit-details-marker { display: none; }
    details.programme-card[open] summary .expand-icon { transform: rotate(180deg); background: var(--color-primary); color: white; }
    details.programme-card[open] { border-color: var(--color-primary); box-shadow: 0 10px 25px -5px rgba(22, 163, 74, 0.1) !important; }

    /* ── Academics Page Responsive ── */

    /* Tablet landscape (≤1024px) */
    @media (max-width: 1024px) {
        .acad-hero h1 { font-size: 2.6rem !important; }
        .acad-main { padding: 2.5rem 2.5rem !important; }
        .acad-cat-grid { grid-template-columns: repeat(2, 1fr) !important; }
        .acad-prog-details-grid { grid-template-columns: 1fr !important; }
    }

    /* Tablet portrait (≤768px) */
    @media (max-width: 768px) {
        .page-layout { flex-direction: column; }
        .acad-hero { padding: 3.5rem 0 5.5rem !important; }
        .acad-hero h1 { font-size: 2rem !important; }
        .acad-hero p { font-size: 1rem !important; }
        .acad-main { padding: 1.5rem 1.2rem !important; border-radius: 12px !important; }
        .acad-main section { margin-bottom: 2.5rem !important; }
        .acad-section-heading h2 { font-size: 1.5rem !important; }
        .acad-section-icon { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; border-radius: 10px !important; }
        .acad-cat-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 1rem !important; }
        .acad-cat-grid a { padding: 1.5rem 1rem !important; }
        .acad-cat-grid a strong { font-size: 1rem !important; }
        .acad-admission { padding: 2rem 1.5rem !important; border-radius: 12px !important; }
        .acad-admission h2 { font-size: 1.6rem !important; }
        .acad-admission p { font-size: 0.95rem !important; }
        .acad-steps-grid { grid-template-columns: 1fr !important; gap: 1rem !important; }
        .acad-prog-details-grid { grid-template-columns: 1fr !important; }
        details.programme-card summary { padding: 1.2rem !important; }
        details.programme-card summary h3 { font-size: 1.1rem !important; }
        details.programme-card summary > div:first-child { flex-direction: column !important; }
        details.programme-card div[style*="padding: 0 1.5rem"] { padding: 0 1.2rem 1.2rem 1.2rem !important; }
    }

    /* Mobile (≤576px) */
    @media (max-width: 576px) {
        .acad-hero { padding: 2.5rem 0 5rem !important; }
        .acad-hero h1 { font-size: 1.6rem !important; }
        .acad-hero p { font-size: 0.88rem !important; }
        .acad-main { padding: 1.2rem 1rem !important; margin-top: -1.5rem !important; }
        .acad-section-heading h2 { font-size: 1.3rem !important; }
        .acad-cat-grid { grid-template-columns: 1fr 1fr !important; gap: 0.8rem !important; }
        .acad-cat-grid a { padding: 1.2rem 0.8rem !important; }
        .acad-cat-grid a div[style*="width: 56px"] { width: 44px !important; height: 44px !important; font-size: 1.3rem !important; }
        .acad-cat-grid a strong { font-size: 0.92rem !important; }
        .acad-cat-grid a span { font-size: 0.75rem !important; padding: 0.15rem 0.6rem !important; }
        .acad-admission { padding: 1.5rem 1.2rem !important; }
        .acad-admission h2 { font-size: 1.4rem !important; }
        .acad-steps-grid > div { padding: 1.2rem !important; }
        details.programme-card summary { padding: 1rem !important; gap: 0.5rem !important; }
        details.programme-card summary h3 { font-size: 1rem !important; }
        details.programme-card div[style*="padding: 0 1.5rem"] { padding: 0 1rem 1rem 1rem !important; }
        .acad-prog-details-grid > div { padding: 1rem !important; }
        /* Course table responsive */
        table th, table td { padding: 0.6rem 0.8rem !important; font-size: 0.82rem !important; }
        table th:nth-child(4), table td:nth-child(4),
        table th:nth-child(5), table td:nth-child(5) { display: none; }
    }

    /* Small mobile (≤400px) */
    @media (max-width: 400px) {
        .acad-hero h1 { font-size: 1.35rem !important; }
        .acad-cat-grid { grid-template-columns: 1fr !important; }
        .acad-cat-grid a { flex-direction: row !important; align-items: center !important; text-align: left !important; padding: 1rem !important; gap: 0.8rem !important; }
        .acad-cat-grid a div[style*="width: 56px"] { width: 40px !important; height: 40px !important; font-size: 1.1rem !important; margin-bottom: 0 !important; }
    }
</style>
@endsection
