@extends('layouts.public')

@section('title', $programme->name . ' | Academic Programmes')

@section('content')
<!-- Hero Section -->
<section style="background-color: #0f172a; padding: 7.5rem 0 6.5rem; position: relative;" class="overflow-hidden border-b border-white/5">
    <!-- Abstract Background Elements -->
    <div style="position: absolute; top:0; left:0; width:100%; height:100%; z-index:0; opacity: 0.08; background-image: radial-gradient(rgba(255,255,255,0.4) 1px, transparent 1px); background-size: 32px 32px;"></div>
    
    <div style="position: absolute; right: 0; top: 0; width: 65vw; height: 100%; background: linear-gradient(to left, rgba(6,78,59,0.4), transparent); z-index: 0;"></div>
    <div style="position: absolute; right: -10%; top: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(16,185,129,0.08) 0%, rgba(0,0,0,0) 70%); border-radius: 50%; filter: blur(50px);"></div>
    <div style="position: absolute; left: -5%; bottom: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(59,130,246,0.05) 0%, rgba(0,0,0,0) 70%); border-radius: 50%; filter: blur(50px);"></div>

    <div style="position: absolute; right: 8%; top: 25%; opacity: 0.02; transform: rotate(12deg); pointer-events: none;">
        <i class="fas fa-microchip text-[28rem]"></i>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 xl:px-12 relative z-10">
        <div class="flex justify-between items-start mb-12">
            <!-- Breadcrumb -->
            <nav data-aos="fade-down" class="flex text-[0.8rem] text-slate-300 font-medium" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-slate-800/40 px-5 py-2.5 rounded-full backdrop-blur-md border border-slate-700/50 shadow-sm list-none m-0">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors duration-200 flex items-center">
                            <i class="fas fa-home mr-2 text-slate-400"></i> Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right mx-2 text-[0.6rem] text-slate-500"></i>
                            <a href="/page/programmes" class="hover:text-emerald-400 transition-colors duration-200">Programmes</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center" aria-current="page">
                            <i class="fas fa-chevron-right mx-2 text-[0.6rem] text-slate-500"></i>
                            <span class="text-white font-semibold">{{ $programme->level }}</span>
                        </div>
                    </li>
                </ol>
            </nav>


        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            <!-- Left Side: Title & Description -->
            <div data-aos="fade-right" class="lg:col-span-7">
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    @if($programme->level)
                    <span class="bg-emerald-600 text-white font-bold text-[0.8rem] tracking-wider uppercase px-4 py-1.5 rounded-sm shadow-sm inline-flex items-center">
                        <i class="fas fa-graduation-cap mr-2 opacity-80"></i> {{ $programme->level }} Degree
                    </span>
                    @endif
                    <span class="text-emerald-400 font-semibold tracking-wide uppercase text-[0.75rem] border border-emerald-500/30 px-4 py-1.5 rounded-sm bg-emerald-500/10 backdrop-blur-sm shadow-inner inline-flex items-center">
                        <i class="fas fa-shield-check mr-2 opacity-80"></i> Fully Accredited
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-[4rem] font-extrabold mb-6 leading-[1.1] text-white tracking-tight drop-shadow-sm pb-1">
                    {{ $programme->name }}
                </h1>
                
                <p class="text-lg text-slate-400 max-w-2xl mb-12 leading-relaxed font-normal">
                    A comprehensive blueprint mapping your entire academic trajectory—spanning from mandatory admission thresholds to your finalized course curriculum and unbounded career prospects.
                </p>
                
                <div class="flex flex-wrap gap-4">
                    @if($programme->duration)
                    <div class="flex items-center group cursor-default bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 px-6 py-4 rounded-xl transition-all duration-300 hover:bg-slate-800/60 hover:border-slate-600">
                        <div class="bg-emerald-500/10 w-10 h-10 flex items-center justify-center rounded-lg mr-4 border border-emerald-500/20">
                            <i class="fas fa-clock text-emerald-400 text-lg"></i>
                        </div>
                        <div>
                            <div class="text-[0.65rem] text-slate-400 uppercase tracking-widest font-semibold mb-0.5">Duration</div>
                            <div class="text-white font-bold text-lg leading-none">{{ $programme->duration }}</div>
                        </div>
                    </div>
                    @endif

                    @if($programme->mode_of_study)
                    <div class="flex items-center group cursor-default bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 px-6 py-4 rounded-xl transition-all duration-300 hover:bg-slate-800/60 hover:border-slate-600">
                        <div class="bg-blue-500/10 w-10 h-10 flex items-center justify-center rounded-lg mr-4 border border-blue-500/20">
                            <i class="fas fa-university text-blue-400 text-lg"></i>
                        </div>
                        <div>
                            <div class="text-[0.65rem] text-slate-400 uppercase tracking-widest font-semibold mb-0.5">Study Mode</div>
                            <div class="text-white font-bold text-lg leading-none">{{ $programme->mode_of_study }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Action Card -->
            <div data-aos="fade-left" data-aos-delay="200" class="lg:col-span-5 hidden lg:block ml-auto w-full max-w-[380px]">
                <div class="bg-slate-800/50 backdrop-blur-xl border border-slate-700 shadow-2xl rounded-2xl p-8 text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-emerald-400 to-blue-500"></div>
                    
                    <div class="w-20 h-20 bg-slate-900 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-inner border border-slate-700/50 transform rotate-3">
                        <i class="fas fa-rocket text-3xl text-emerald-400 transform -rotate-3 drop-shadow-[0_0_8px_rgba(16,185,129,0.5)]"></i>
                    </div>
                    
                    <h3 class="text-2xl font-extrabold mb-3 text-white">Begin Your Journey</h3>
                    <p class="text-slate-400 text-sm mb-8 leading-relaxed px-4">Bypass the reading and move straight into the institution's official application and admissions portal.</p>
                    
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center w-full bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold py-3.5 px-6 rounded-xl transition-all duration-300 shadow-[0_4px_14px_0_rgba(16,185,129,0.39)] hover:shadow-[0_6px_20px_rgba(16,185,129,0.23)] hover:-translate-y-0.5">
                        Commence Application <i class="fas fa-arrow-right ml-2 opacity-70 mt-0.5 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Sticky Sub-Navigation -->
<div style="background-color: rgba(255,255,255,0.95); backdrop-filter: blur(8px); border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 50; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);">
    <div class="container mx-auto px-4">
        <ul class="flex overflow-x-auto whitespace-nowrap py-5 space-x-8 text-sm font-bold text-slate-500 uppercase tracking-wider" style="scrollbar-width: none;">
            <li><a href="#overview" class="hover:text-emerald-600 transition-colors flex items-center group"><span class="bg-slate-100 text-slate-400 rounded-full w-6 h-6 flex items-center justify-center mr-2 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">1</span> Context</a></li>
            <li><a href="#admission" class="hover:text-emerald-600 transition-colors flex items-center group"><span class="bg-slate-100 text-slate-400 rounded-full w-6 h-6 flex items-center justify-center mr-2 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">2</span> Entry Rules</a></li>
            <li><a href="#curriculum" class="hover:text-emerald-600 transition-colors flex items-center group"><span class="bg-slate-100 text-slate-400 rounded-full w-6 h-6 flex items-center justify-center mr-2 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">3</span> Map & Courses</a></li>
            <li><a href="#career" class="hover:text-emerald-600 transition-colors flex items-center group"><span class="bg-slate-100 text-slate-400 rounded-full w-6 h-6 flex items-center justify-center mr-2 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">4</span> Outcomes</a></li>
            <li><a href="#resources" class="hover:text-emerald-600 transition-colors flex items-center group"><span class="bg-slate-100 text-slate-400 rounded-full w-6 h-6 flex items-center justify-center mr-2 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">5</span> Materials</a></li>
        </ul>
    </div>
</div>

<!-- Main Blueprint Layout -->
<section style="background-color: #f8fafc; padding: 5rem 0;" class="py-20 min-h-screen relative">
    
    <!-- Background Decor -->
    <div style="position: absolute; right: 0; top: 20%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, rgba(248,250,252,0) 70%); border-radius: 50%; z-index: 0; pointer-events: none;"></div>
    
    <div class="container mx-auto px-4 max-w-5xl relative z-10">
        
        <!-- Section 1: Overview & Objectives -->
        <div id="overview" class="mb-24" style="scroll-margin-top: 7rem;" data-aos="fade-up">
            <div class="flex items-center mb-8">
                <div class="bg-emerald-100 text-emerald-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold mr-4 shadow-sm">1</div>
                <h2 class="text-3xl font-extrabold text-slate-800 m-0 tracking-tight">Context & Objectives</h2>
            </div>
            
            <div style="background-color: #ffffff; border: 1px solid rgba(226,232,240,0.8); border-radius: 1rem; padding: 3rem; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02), 0 8px 10px -6px rgba(0, 0, 0, 0.01);" class="relative overflow-hidden group hover:border-emerald-200 transition-colors duration-300">
                <div class="absolute top-0 left-0 w-1 h-full bg-emerald-500"></div>
                
                @if($programme->description)
                <div class="prose max-w-none text-slate-600 prose-emerald prose-lg leading-relaxed">
                    {!! $programme->description !!}
                </div>
                @else
                <p class="text-slate-500 italic text-lg opacity-70">A detailed chronological overview is currently being formulated by the department admins.</p>
                @endif

                @if($programme->objectives)
                <div class="mt-12 pt-10 border-t border-slate-100">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                        <i class="fas fa-bullseye text-emerald-500 mr-4 bg-emerald-50 w-10 h-10 rounded-full flex items-center justify-center text-lg"></i> What are our Targets?
                    </h3>
                    <div class="prose max-w-none text-slate-600 prose-emerald prose-lg leading-relaxed bg-slate-50 rounded-xl p-8 border border-slate-100">
                        {!! $programme->objectives !!}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Section 2: Admission Requirements -->
        <div id="admission" class="mb-24" style="scroll-margin-top: 7rem;" data-aos="fade-up">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div class="flex items-center">
                    <div class="bg-blue-100 text-blue-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold mr-4 shadow-sm">2</div>
                    <h2 class="text-3xl font-extrabold text-slate-800 m-0 tracking-tight">Entry Rules & Logistics</h2>
                </div>
                <p class="text-slate-500 italic text-sm">Review minimum thresholds before deciding to register.</p>
            </div>
            
            @if($programme->level === 'BSc' || strtolower($programme->level) === 'undergraduate' || strtolower($programme->level) === 'ug')
            <!-- Standard Unified Requirements Grid for BSc -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- O' Level Card -->
                <div style="background-color: #f2fcf5; border: 1px solid #e2f5ea; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);" class="transform hover:-translate-y-1 transition-transform duration-300">
                    <div style="background-color: #16a34a; width: 4rem; height: 4rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3);">
                        <i class="fas fa-school text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3 block">O' Level</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $programme->req_olevel ?? 'WAEC/NECO with 5 credits including Maths & English.' }}</p>
                </div>
                
                <!-- A' Level Card -->
                <div style="background-color: #f2fcf5; border: 1px solid #e2f5ea; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);" class="transform hover:-translate-y-1 transition-transform duration-300">
                    <div style="background-color: #16a34a; width: 4rem; height: 4rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3);">
                        <i class="fas fa-book-open text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3 block">A' Level</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $programme->req_alevel ?? 'Advanced Level or JUPEB with required passes.' }}</p>
                </div>

                <!-- UTME Card -->
                <div style="background-color: #f2fcf5; border: 1px solid #e2f5ea; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);" class="transform hover:-translate-y-1 transition-transform duration-300">
                    <div style="background-color: #16a34a; width: 4rem; height: 4rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3);">
                        <i class="fas fa-pen-nib text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3 block">UTME</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">{{ $programme->req_utme_subjects ?? 'Mathematics, English, Physics & one of Chemistry/Biology/Economics.' }} <br><strong class="text-emerald-700 mt-2 block">{{ $programme->req_utme_score ?? 'Minimum of 200 in JAMB' }}</strong></p>
                </div>
            </div>
            @else
            <!-- Postgraduate Requirements Grid (MSc, PhD) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <!-- Degree Card -->
                <div style="background-color: #f2fcf5; border: 1px solid #e2f5ea; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);" class="transform hover:-translate-y-1 transition-transform duration-300">
                    <div style="background-color: #16a34a; width: 4rem; height: 4rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3);">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3 block">Core Qualification</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        @if($programme->req_pg_core)
                            {{ $programme->req_pg_core }}
                        @elseif($programme->level === 'PhD' || strtolower($programme->level) === 'doctorate')
                            A Master's Degree in Computer Science or a closely related field is strictly required to be considered.
                        @else
                            A Bachelor's Degree in Computer Science or a closely related field is strictly required to be considered.
                        @endif
                    </p>
                </div>

                <!-- Academic Transcripts Card -->
                <div style="background-color: #f2fcf5; border: 1px solid #e2f5ea; border-radius: 1rem; padding: 2.5rem 1.5rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);" class="transform hover:-translate-y-1 transition-transform duration-300">
                    <div style="background-color: #16a34a; width: 4rem; height: 4rem; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 15px -3px rgba(22, 163, 74, 0.3);">
                        <i class="fas fa-scroll text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3 block">Academic Standing</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        {{ $programme->req_pg_academic ?? 'Applicants must meet the minimum prescribed CGPA standard set by the postgraduate school.' }}
                    </p>
                </div>
            </div>
            @endif

            <!-- Dynamic Additional Context (If populated by DB) -->
            @if($programme->requirements_utme || $programme->requirements_de)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- UTME Card -->
                @if($programme->requirements_utme)
                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);" class="relative hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute -top-5 right-6 w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg shadow-emerald-500/30 text-white z-10"><i class="fas fa-check"></i></div>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-6 pb-4 border-b border-slate-100 flex items-center">
                        <i class="fas fa-user-graduate text-emerald-500 mr-3 text-2xl"></i> Additional Notes
                    </h3>
                    <div class="prose max-w-none text-slate-600 prose-emerald leading-relaxed text-sm">
                        {!! $programme->requirements_utme !!}
                    </div>
                </div>
                @endif

                <!-- Direct Entry Card -->
                @if($programme->requirements_de)
                <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);" class="relative hover:-translate-y-1 transition-transform duration-300">
                    <div class="absolute -top-5 right-6 w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/30 text-white z-10"><i class="fas fa-bolt"></i></div>
                    <h3 class="text-xl font-extrabold text-slate-800 mb-6 pb-4 border-b border-slate-100 flex items-center">
                        <i class="fas fa-door-open text-blue-500 mr-3 text-2xl"></i> Direct Entry Specifics
                    </h3>
                    <div class="prose max-w-none text-slate-600 prose-blue leading-relaxed text-sm">
                        {!! $programme->requirements_de !!}
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Mandatory Screening Alert Box -->
            <div data-aos="fade-up" style="background: linear-gradient(to right, #f8fafc, #ffffff); border: 1px solid #e2e8f0; border-left: 4px solid #f59e0b; border-radius: 1rem; padding: 2rem; margin-top: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);" class="flex flex-col md:flex-row gap-6 md:items-center">
                <div class="bg-amber-100 text-amber-600 p-4 rounded-[1.25rem] flex-shrink-0 shadow-inner inline-flex self-start md:self-center">
                    <i class="fas fa-shield-alt text-3xl w-10 h-10 flex items-center justify-center"></i>
                </div>
                <div>
                    <h3 class="text-lg font-extrabold text-slate-800 mb-2">Mandatory Internal Screening (Post-UTME)</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Simply fulfilling the minimum baseline scores for UTME or Direct Entry does not grant absolute automatic clearance. All shortlisted candidates must actively participate in and successfully pass the institution's internal physical screening protocols. Original credential verifications, age declarations, and LGA/state of origin clearances are strictly enforced during this final phase.
                    </p>
                </div>
            </div>
            
            <div data-aos="fade-up" class="mt-8 text-center">
                <a href="{{ route('contact') }}" style="background-color: #f1f5f9; color: #475569; padding: 0.75rem 2rem; border-radius: 9999px; font-weight: 600; text-decoration: none; border: 1px solid #e2e8f0; display: inline-flex; items-center; transition: all 0.2s;" class="hover:bg-slate-200 hover:text-slate-800 group">
                    Seek human assistance regarding admissions <i class="fas fa-arrow-right ml-2 mt-1 opacity-50 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all"></i>
                </a>
            </div>
        </div>

        <!-- Section 3: Curriculum & Courses (The Heart) -->
        <div id="curriculum" class="mb-24" style="scroll-margin-top: 7rem;" data-aos="fade-up">
            
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-3xl p-8 md:p-12 text-white mb-10 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 opacity-10 transform translate-x-1/4 -translate-y-1/4"><i class="fas fa-map text-9xl"></i></div>
                <div class="relative z-10">
                    <div class="flex items-center mb-4">
                        <div class="bg-emerald-500 text-white w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold mr-4 shadow-lg shadow-emerald-500/40">3</div>
                        <h2 class="text-3xl md:text-4xl font-extrabold text-white m-0 tracking-tight">Curriculum Map</h2>
                    </div>
                    <p class="text-slate-300 text-lg md:text-xl max-w-2xl font-light leading-relaxed">
                        Trace your exact academic trajectory. Review transparent combinations of core sciences, electives, and advanced modules spread systematically across the levels.
                    </p>
                </div>
            </div>

            @if($curriculum && $curriculum->count() > 0)
                <div class="space-y-12">
                    @foreach($curriculum as $level => $semesters)
                        <div data-aos="fade-up" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);">
                            
                            <!-- Level Header -->
                            <div style="background-color: #0f172a; padding: 1.5rem 2rem; border-bottom: 4px solid #10b981; display: flex; align-items: center; justify-content: space-between;">
                                <h3 class="text-2xl font-extrabold text-white m-0 tracking-wide">Level {{ $level }}</h3>
                                <span class="bg-white/10 text-white px-4 py-1.5 rounded-full text-sm font-semibold backdrop-blur tracking-widest uppercase shadow-inner"><i class="fas fa-layer-group mr-2 opacity-70"></i>Stage {{ substr($level, 0, 1) }}</span>
                            </div>
                            
                            <div class="p-0">
                                @foreach($semesters as $semester => $courses)
                                    <div>
                                        <!-- Semester Divider -->
                                        <div class="bg-slate-50 px-8 py-4 border-b border-slate-200 border-t {{ $loop->first ? 'border-t-0' : 'border-t-slate-200' }} flex items-center">
                                            <div class="w-2 h-6 bg-emerald-400 rounded-full mr-3"></div>
                                            <h4 class="text-lg font-extrabold text-slate-700 m-0 uppercase tracking-widest text-sm">
                                                Semester {{ $semester }}
                                            </h4>
                                        </div>

                                        <!-- Ultra Neat Table -->
                                        <div class="overflow-x-auto p-4 md:p-8">
                                            <table class="w-full text-left text-sm whitespace-nowrap">
                                                <thead>
                                                    <tr class="text-slate-400 border-b-2 border-slate-100">
                                                        <th class="pb-4 pr-6 font-bold uppercase tracking-wider text-[0.7rem]">Course Code</th>
                                                        <th class="pb-4 px-6 font-bold uppercase tracking-wider text-[0.7rem] w-1/2">Descriptive Title</th>
                                                        <th class="pb-4 px-6 font-bold uppercase tracking-wider text-[0.7rem] text-center">Credit Load</th>
                                                        <th class="pb-4 pl-6 font-bold uppercase tracking-wider text-[0.7rem] text-right">Requirement</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-slate-50 align-middle">
                                                    @foreach($courses as $course)
                                                    <tr class="hover:bg-emerald-50/50 transition-colors group">
                                                        <td class="py-4 pr-6">
                                                            <span class="font-extrabold text-slate-800 bg-slate-100 group-hover:bg-white px-3 py-1.5 rounded-md border border-slate-200 shadow-sm">{{ $course->code }}</span>
                                                        </td>
                                                        <td class="py-4 px-6">
                                                            <div class="text-slate-700 font-semibold whitespace-normal min-w-[250px] leading-tight">{{ $course->title }}</div>
                                                        </td>
                                                        <td class="py-4 px-6 text-center">
                                                            <div class="inline-flex items-center justify-center w-8 h-8 rounded-full {{ $course->credit_units > 2 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }} font-bold text-xs ring-2 ring-white shadow-sm">
                                                                {{ $course->credit_units }}
                                                            </div>
                                                        </td>
                                                        <td class="py-4 pl-6 text-right">
                                                            @if($course->is_elective)
                                                                <span class="inline-flex items-center text-amber-700 bg-amber-50 border border-amber-200 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                                                                    <i class="fas fa-random mr-1 opacity-50"></i> Elective
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center text-emerald-700 bg-emerald-50 border border-emerald-200 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                                                                    <i class="fas fa-lock mr-1 opacity-50"></i> Core
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="background-color: #ffffff; border: 2px dashed #cbd5e1; border-radius: 1rem; padding: 5rem 2rem; text-align: center; box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #f1f5f9; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <i class="fas fa-sitemap text-3xl text-slate-400"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800 mb-2">Architecting the Syllabus</h4>
                    <p class="text-slate-500 max-w-lg mx-auto leading-relaxed">The authoritative web mapping of credit hours and strict semesters is currently processing behind the scenes. Please default to your physical handbook in the interim.</p>
                </div>
            @endif
        </div>

        <!-- Section 4: What Next (Career Dynamics) -->
        <div id="career" class="mb-24" style="scroll-margin-top: 7rem;" data-aos="fade-up">
            <div class="flex items-center mb-8">
                <div class="bg-indigo-100 text-indigo-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold mr-4 shadow-sm">4</div>
                <h2 class="text-3xl font-extrabold text-slate-800 m-0 tracking-tight">Vast Post-Graduate Options</h2>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 3rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                        <i class="fas fa-network-wired text-indigo-500 mr-4 bg-indigo-50 w-10 h-10 rounded-full flex items-center justify-center text-sm"></i> Defined Pathways
                    </h3>
                    @if($programme->career_pathways)
                        <div class="prose max-w-none text-slate-600 prose-indigo prose-lg leading-relaxed">
                            {!! $programme->career_pathways !!}
                        </div>
                    @else
                        <p class="text-slate-600 text-lg leading-relaxed">
                            Our alumni traditionally dominate sectors ranging from pure technological infrastructures inside mega-corporations to establishing self-sustaining startup firms. The academic rigor applied here functions as an undeniable fast-track into premium employment positions, research fellowships, or extensive entrepreneurial mastery.
                        </p>
                    @endif
                </div>

                <div class="space-y-6">
                    <div style="background: linear-gradient(145deg, #10b981 0%, #047857 100%); padding: 2rem; border-radius: 1rem; color: white; text-align: center; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);">
                        <i class="fas fa-crown text-5xl mb-4 opacity-90 drop-shadow-md"></i>
                        <h4 class="font-extrabold text-2xl mb-2">Premium Demand</h4>
                        <p class="text-emerald-100 text-sm leading-relaxed">Global scarcity ensures these exact technical proficiencies command extreme competitive advantages.</p>
                    </div>
                    
                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; padding: 2rem; border-radius: 1rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div class="bg-slate-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-globe-americas text-2xl text-slate-700"></i>
                        </div>
                        <h4 class="font-bold text-lg text-slate-800 mb-2">Zero Borders</h4>
                        <p class="text-slate-500 text-sm">This specific syllabus architecture translates globally across all major institutions.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 5: Helpful Resources -->
        <div id="resources" class="mb-10" style="scroll-margin-top: 7rem;" data-aos="fade-up">
            <div class="flex items-center mb-8">
                <div class="bg-amber-100 text-amber-600 w-12 h-12 rounded-xl flex items-center justify-center text-xl font-bold mr-4 shadow-sm">5</div>
                <h2 class="text-3xl font-extrabold text-slate-800 m-0 tracking-tight">Crucial Links & Assets</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Advanced Student Handbook Card -->
                <div class="group" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); transition: border-color 0.3s;">
                    <div class="flex items-start">
                        <div class="bg-rose-50 p-4 rounded-2xl mr-6 group-hover:bg-rose-100 transition-colors duration-300 shadow-sm border border-rose-100">
                            <i class="fas fa-file-pdf text-4xl text-rose-500 block"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-extrabold text-slate-800 mb-2">The Complete Handbook</h3>
                            <p class="text-slate-500 text-sm mb-6 leading-relaxed">The ultimate authority containing precise department directives, strict grading parameters, and offline-compatible curriculum models.</p>
                            @if($programme->handbook_pdf)
                                <a href="{{ Storage::url($programme->handbook_pdf) }}" target="_blank" style="background-color: #f43f5e; color: white; border: 1px solid #e11d48;" class="w-full text-center py-3 rounded-lg font-bold shadow-md hover:bg-rose-600 hover:-translate-y-0.5 transition-all duration-200 block shadow-rose-500/20">
                                    <i class="fas fa-download mr-2"></i> Download Hard/PDF Copy
                                </a>
                            @else
                                <div class="w-full text-center py-3 rounded-lg font-bold bg-slate-100 text-slate-400 cursor-not-allowed border border-slate-200">
                                    <i class="fas fa-lock mr-2"></i> File Vault Empty
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Live Academic Dates Card -->
                <div class="group" style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 1rem; padding: 2.5rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); transition: border-color 0.3s;">
                    <div class="flex items-start">
                        <div class="bg-sky-50 p-4 rounded-2xl mr-6 group-hover:bg-sky-100 transition-colors duration-300 shadow-sm border border-sky-100">
                            <i class="fas fa-calendar-day text-4xl text-sky-500 block"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-extrabold text-slate-800 mb-2">Live Timeline Events</h3>
                            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Verify impending deadlines, mandatory clearance weeks, matrix assessments, and all holidays embedded inside this timeline.</p>
                            <a href="{{ route('home') }}#calendar" style="background-color: #f8fafc; color: #0284c7; border: 1px solid #bae6fd;" class="w-full text-center py-3 rounded-lg font-bold hover:bg-sky-50 hover:border-sky-300 transition-all duration-200 block">
                                Navigate Global Calendar <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Final CTA Block -->
            <div data-aos="zoom-in" data-aos-delay="100" style="background: linear-gradient(to right, #0f172a, #1e293b); border: 1px solid rgba(255,255,255,0.1); border-radius: 1.5rem; padding: 4rem; text-align: center; margin-top: 5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);" class="text-white relative overflow-hidden">
                <div style="position: absolute; right: 0; top: 0; opacity: 0.03; transform: scale(3) translate(-10%, 10%); pointer-events: none;">
                    <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM11 19.93C7.05 19.43 4.06 16.03 4.06 12C4.06 11.42 4.13 10.86 4.25 10.31L8.5 14.56L8.5 15.5C8.5 16.33 9.17 17 10 17L10 19.06C10.32 19.16 10.66 19.26 11 19.33L11 19.93ZM19.56 15.65C19.11 15.25 18.52 15 17.9 15L17.5 15L17.5 11.5C17.5 10.67 16.83 10 16 10L14.5 10L14.5 7.5L10 7.5L10 6L9 6C8.45 6 8 5.55 8 5L8 4.27C11.5 3.31 15.34 4.05 18.23 6.64C18.89 7.23 19.45 7.9 19.91 8.64L15.5 13.04L15.5 14C15.5 14.73 15.86 15.4 16.43 15.82L19.56 18.95C19.82 17.85 19.94 16.7 19.94 15.5C19.94 14.15 19.67 12.87 19.18 11.72C19.26 11.96 19.34 12.21 19.4 12.47L19.56 15.65Z"/></svg>
                </div>
                
                <h3 class="text-3xl lg:text-4xl font-extrabold mb-4 relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-emerald-400">Clear all the doubts, let's talk.</h3>
                <p class="text-slate-300 max-w-2xl mx-auto mb-10 text-lg relative z-10 leading-relaxed font-light">Whether interpreting documents, grasping cutoff boundaries, or speaking directly to faculty advising staff—the administration lines are open.</p>
                <a href="{{ route('contact') }}" style="background-color: #10b981; color: #ffffff; padding: 1.15rem 3.5rem; border-radius: 9999px; font-weight: 800; font-size: 1.15rem; display: inline-block; transition: all 0.3s; letter-spacing: 0.05em;" class="hover:bg-emerald-400 hover:shadow-[0_10px_30px_rgba(16,185,129,0.5)] hover:-translate-y-1 relative z-10 uppercase">
                    Connect With Desk Officers
                </a>
            </div>
        </div>

    </div>
</section>

<!-- Scroll Spy Style Script for sticky nav -->
<style>
    html { scroll-behavior: smooth; }
    /* Hide scrollbar for Chrome, Safari and Opera */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .scrollbar-hide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>

@endsection
