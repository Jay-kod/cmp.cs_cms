@extends('layouts.public')
@section('title', 'Final Year Projects Guideline')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    $heroUrl = asset('images/campus-bg.jpg'); 
@endphp

<!-- Premium Hero Section -->
<section data-aos="fade-up" class="bg-slate-900 bg-center bg-cover pt-16 sm:pt-24 pb-20 sm:pb-28 text-white relative overflow-hidden border-b-4 border-accent" style="background-image: url('{{ asset('images/pattern-grid.svg') }}'), linear-gradient(135deg, #0f172a 0%, #064e3b 100%);">
    <!-- Abstract Glow -->
    <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.2)_0%,transparent_60%)]"></div>

    <div class="container relative z-10 text-center px-4 sm:px-6" data-aos="fade-up">
        <nav aria-label="breadcrumb" class="flex justify-center mb-6 w-full">
            <ol class="breadcrumb list-none m-0 bg-white/10 backdrop-blur-md py-2 px-4 sm:px-6 rounded-2xl sm:rounded-full text-[0.75rem] sm:text-[0.85rem] font-semibold tracking-[0.5px] border border-white/10 inline-flex flex-wrap justify-center items-center gap-x-2 sm:gap-x-[0.8rem] gap-y-1">
                <li class="m-0 whitespace-nowrap"><a href="{{ url('/') }}" class="text-slate-300 no-underline transition-colors duration-300 hover:text-white"><i class="fa-solid fa-house mr-1"></i> Home</a></li>
                <li class="text-white/30 m-0 shrink-0">/</li>
                <li aria-current="page" class="text-[color:var(--color-accent)] m-0 drop-shadow-[0_2px_10px_rgba(244,196,48,0.4)] text-center break-words">Research Projects</li>
            </ol>
        </nav>
        
        <div class="inline-flex items-center gap-2 px-[1.2rem] py-[0.4rem] bg-white/10 backdrop-blur-md text-emerald-200 rounded-full text-[0.75rem] sm:text-[0.8rem] font-semibold tracking-[1.5px] uppercase mb-4 border border-white/10 shadow-sm">
            <i class="fa-solid fa-graduation-cap text-[0.8rem]"></i> {{ $s('project_course_code', 'CMP 499') }}
        </div>
        
        <h1 class="text-[clamp(2.5rem,8vw,4.2rem)] font-black mb-[1rem] sm:mb-[1.2rem] text-white font-heading tracking-tight drop-shadow-[0_4px_20px_rgba(0,0,0,0.3)] leading-[1.15] sm:leading-[1.1]">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[color:var(--color-accent)] to-yellow-200">Project</span> Guidelines
        </h1>
        
        <p class="text-[1.05rem] sm:text-[1.15rem] md:text-[1.25rem] max-w-[700px] mx-auto text-slate-300 leading-[1.6] sm:leading-[1.8] font-normal px-2">
            General information, formatting rules, and key milestones for your final year defense and research documentation.
        </p>
    </div>

    <!-- Decorative Bottom Wave (matching Resources page to fill the space cleanly) -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none">
        <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C63.26,35,142.27,61.96,213.31,64.44,249.25,65.73,286.34,62.91,321.39,56.44Z" fill="#ffffff"></path>
        </svg>
    </div>
</section>

<div class="w-full max-w-[1240px] mx-auto px-2 sm:px-5 lg:px-8 pb-16 -mt-12 relative z-20">
    
    <!-- Top Contact & Resource Cards (Horizontal Grid) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12 max-w-[950px] mx-auto">
        
        <!-- Project Coordinator Profile -->
        <div class="bg-gradient-to-br from-white to-green-50/30 p-6 sm:p-8 rounded-3xl shadow-2xl shadow-green-900/10 border border-green-100 flex flex-col transition-all duration-300 hover:shadow-green-900/20 hover:-translate-y-1" data-aos="fade-up">
            <h3 class="text-xl font-bold text-gray-900 border-b border-green-100 pb-4 mb-6 font-heading flex flex-col">
                <span class="text-xs font-black text-green-700 uppercase tracking-widest mb-1 opacity-80">Department</span>
                Project Coordinator
            </h3>
            <div class="flex items-center gap-6 mt-auto mb-auto">
                @if($s('project_coordinator_image'))
                    <img src="{{ asset('storage/' . $s('project_coordinator_image')) }}" alt="Coordinator" class="w-[4.5rem] h-[4.5rem] rounded-[1.2rem] object-cover shadow-[0_8px_20px_rgba(20,83,45,0.4)] border-2 border-green-500 shrink-0 transform transition-transform group-hover:scale-105">
                @else
                    <div class="w-[4.5rem] h-[4.5rem] bg-gradient-to-br from-green-600 to-green-800 text-white rounded-[1.2rem] flex items-center justify-center text-3xl shadow-[0_8px_20px_rgba(20,83,45,0.4)] border border-green-500 shrink-0 transform transition-transform group-hover:scale-105">
                        <i class="fa-solid fa-chalkboard-user drop-shadow-md"></i>
                    </div>
                @endif
                <div>
                    <h4 class="font-bold text-gray-900 text-[1.2rem]">{{ $s('project_coordinator_name', 'Dr. Coordinator') }}</h4>
                    <p class="text-[0.95rem] text-gray-500 mt-1">Final Year Research Coordinator</p>
                </div>
            </div>
            <!-- Placeholder for future contact details if needed -->
        </div>

        <!-- Templates Downloads Widget -->
        <div class="bg-gradient-to-br from-green-900 to-green-800 p-6 sm:p-8 rounded-3xl shadow-2xl shadow-green-900/20 border border-green-700/50 text-white relative overflow-hidden flex flex-col transition-transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute -right-4 top-0 opacity-10 text-9xl transform translate-x-1/8 translate-y-1/8 pointer-events-none">
                <i class="fa-solid fa-file-word"></i>
            </div>
            
            <h3 class="text-xl font-bold text-green-50 border-b border-green-700/50 pb-4 mb-6 font-heading relative z-10 flex items-center gap-3">
                <i class="fa-solid fa-download"></i> Official Templates
            </h3>
            
            <p class="text-[0.95rem] text-green-100 mb-6 relative z-10 leading-relaxed max-w-[90%]">Ensure you download and use the official templates for structural compliance before submission.</p>
            
            <ul class="space-y-3 relative z-10 flex-1">
                @if($downloads && $downloads->items->count() > 0)
                    @foreach($downloads->items as $doc)
                        <li>
                            <a href="{{ route('resources.index') }}?category={{ $downloads->id }}" class="flex items-center gap-4 p-4 bg-white/10 hover:bg-white/20 rounded-2xl transition group border border-white/5 hover:border-white/20 shadow-sm backdrop-blur-sm">
                                <div class="bg-green-100 text-green-700 w-10 h-10 rounded-xl flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform shrink-0">
                                    <i class="fa-solid fa-file-arrow-down text-lg"></i>
                                </div>
                                <div class="flex-grow">
                                    <span class="block text-[0.95rem] font-bold text-white drop-shadow-sm">{{ $doc->title }}</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-arrow-right text-green-200 group-hover:text-white transition-colors"></i>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>
                        <div class="flex items-start gap-4 p-5 bg-white/5 rounded-2xl border border-green-500/50 text-green-100 text-[0.95rem] leading-relaxed shadow-inner">
                            <i class="fa-solid fa-circle-info mt-1 text-green-300 shrink-0 text-lg"></i>
                            <span>No templates currently uploaded. Check the Resource Catalog directly.</span>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>


    <div class="max-w-[1050px] mx-auto">
        
        <!-- Project Management Portal External Link Notice -->
        <div class="bg-blue-50 border border-blue-200 rounded-3xl p-5 sm:p-6 md:p-8 mb-12 flex flex-col md:flex-row items-center gap-5 sm:gap-6 shadow-sm relative overflow-hidden" data-aos="fade-up">
            <div class="absolute -right-4 -top-4 text-blue-200/50 text-9xl pointer-events-none">
                <i class="fa-solid fa-network-wired"></i>
            </div>
            <div class="w-16 h-16 shrink-0 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl shadow-inner relative z-10 border border-blue-200">
                <i class="fa-solid fa-laptop-code"></i>
            </div>
            <div class="flex-1 text-center md:text-left relative z-10">
                <h3 class="text-xl font-bold text-blue-900 mb-2">Departmental Project Management System</h3>
                <p class="text-blue-800 text-[1.05rem] leading-relaxed mb-5 max-w-[800px]">The department utilizes a dedicated Project Management System for students to track milestones, communicate with supervisors, and securely upload project drafts and final reports.</p>
                <a href="{{ $s('project_portal_url', '#') }}" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-1 transition-all group">
                    Access Project Portal <i class="fa-solid fa-arrow-up-right-from-square text-[0.8rem] ml-1 group-hover:scale-110 transition-transform"></i>
                </a>
            </div>
        </div>

        <!-- Overview -->
        <div class="bg-white p-4 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 mb-10 sm:mb-12" data-aos="fade-up">
            <h2 class="text-[1.3rem] sm:text-2xl md:text-3xl font-bold text-gray-900 border-b border-gray-100 pb-3 sm:pb-5 mb-5 sm:mb-8 font-heading flex items-center gap-3 sm:gap-4">
                <span class="w-12 h-12 bg-green-100 text-green-700 flex items-center justify-center rounded-2xl shadow-inner"><i class="fa-solid fa-project-diagram"></i></span> Course Overview
            </h2>
            <div class="prose max-w-none text-gray-700 text-[1.1rem] leading-loose">
                <p>{{ $s('project_overview', 'The final year project is a mandatory course where students are expected to solve real-world computing problems...') }}</p>
            </div>
        </div>

        <!-- Guidelines / Rules -->
        @php 
            $defaultRules = [
                ['title' => 'Chapter Structure', 'desc' => "Chapter 1: Introduction\nChapter 2: Literature Review\nChapter 3: Methodology\nChapter 4: System Implementation & Results\nChapter 5: Summary, Conclusion and Recommendations."],
                ['title' => 'Plagiarism Policy', 'desc' => 'All projects will be scanned for plagiarism. Any research work with a similarity index above standard thresholds will be automatically rejected. Ensure all citations follow conventional academic formats.'],
                ['title' => 'Page Formatting', 'desc' => 'Use Times New Roman, 12pt font size. Line spacing must be 1.5 margins. Left margin: 1.5 inches for binding; Top, Bottom, and Right margins: 1.0 inch.']
            ];
            $rules = json_decode($s('project_rules', '[]'), true); 
            if (empty($rules)) $rules = $defaultRules;
        @endphp
        @if(count($rules) > 0)
        <div class="bg-white p-4 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100 mb-10 sm:mb-12" data-aos="fade-up">
            <h2 class="text-[1.3rem] sm:text-2xl md:text-3xl font-bold text-gray-900 border-b border-gray-100 pb-3 sm:pb-5 mb-5 sm:mb-8 font-heading flex items-center gap-3 sm:gap-4">
                <span class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 text-blue-700 flex items-center justify-center rounded-2xl shadow-inner text-[1.1rem] sm:text-base shrink-0"><i class="fa-solid fa-book-open-reader"></i></span> Formatting Guidelines
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8">
                @foreach($rules as $index => $rule)
                <div class="p-4 sm:p-8 bg-gradient-to-br from-slate-50/80 to-white border border-slate-200 rounded-2xl sm:rounded-3xl relative group hover:-translate-y-2 hover:shadow-2xl hover:shadow-slate-200/50 hover:border-slate-300 transition-all duration-300 flex flex-col">
                    <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-600/30 font-bold text-2xl mb-6 relative overflow-hidden">
                        <i class="fa-solid fa-bookmark absolute top-0 right-0 translate-x-1/4 -translate-y-1/4 text-5xl opacity-20"></i>
                        <span class="relative z-10">{{ $index + 1 }}</span>
                    </div>
                    <h4 class="font-bold text-slate-900 text-[1.3rem] mb-4 leading-tight">{{ $rule['title'] }}</h4>
                    <div class="text-slate-600 leading-relaxed text-[1.05rem] flex-1">
                        {!! nl2br(e($rule['desc'])) !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Calendar/Milestones -->
        @php 
            $defaultMilestones = [
                ['date' => 'Early Sem 1', 'title' => 'Topic Approval', 'desc' => 'Submit three proposed project topics to your assigned supervisor.'],
                ['date' => 'Mid Sem 1', 'title' => 'Chapter 1 & 2 Submission', 'desc' => 'First draft of Introduction and Literature Review due for supervisor review.'],
                ['date' => 'Early Sem 2', 'title' => 'System Demonstration', 'desc' => 'Live demonstration of the proposed system/software working prototype.'],
                ['date' => 'End of Sem 2', 'title' => 'Final Defense & Binding', 'desc' => 'Defense before an external panel followed by the submission of 3 hardbound copies of the completed project plus CD-ROM.']
            ];
            $milestones = json_decode($s('project_milestones', '[]'), true); 
            if (empty($milestones)) $milestones = $defaultMilestones;
        @endphp
        @if(count($milestones) > 0)
        <div class="bg-white p-4 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-100" data-aos="fade-up">
            <h2 class="text-[1.3rem] sm:text-2xl md:text-3xl font-bold text-gray-900 border-b border-gray-100 pb-3 sm:pb-5 mb-6 sm:mb-10 font-heading flex items-center gap-3 sm:gap-4">
                <span class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-100 text-amber-700 flex items-center justify-center rounded-2xl shadow-inner text-[1.1rem] sm:text-base shrink-0"><i class="fa-regular fa-calendar-check"></i></span> Important Deadlines
            </h2>

            <!-- Timeline style layout -->
            <div class="relative border-l-4 border-amber-200/60 ml-3 sm:ml-6 space-y-6 sm:space-y-10 pb-4">
                @foreach($milestones as $index => $mile)
                <div class="relative pl-6 sm:pl-10 md:pl-12">
                    <div class="absolute w-8 h-8 sm:w-12 sm:h-12 bg-amber-500 rounded-full text-white flex items-center justify-center font-bold shadow-lg shadow-amber-500/30 ring-4 ring-white left-[-18px] sm:left-[-26px]" style="top: 0;">
                        <i class="fa-solid fa-thumbtack -rotate-45 ml-1 mt-1 text-[0.7rem] sm:text-base"></i>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl sm:rounded-3xl p-4 sm:p-7 hover:shadow-xl hover:shadow-amber-900/5 hover:-translate-y-1 hover:border-amber-200 transition-all duration-300">
                        <span class="inline-block py-1 px-3 sm:py-1.5 sm:px-4 bg-amber-100/80 text-amber-800 rounded-full text-[0.7rem] sm:text-[0.75rem] font-black uppercase tracking-widest mb-3 sm:mb-4 border border-amber-200/60 shadow-sm">{{ $mile['date'] }}</span>
                        <h3 class="font-bold text-slate-900 text-[1.1rem] sm:text-xl md:text-2xl mb-2 sm:mb-3">{{ $mile['title'] }}</h3>
                        <p class="text-slate-600 text-[1.05rem] leading-relaxed">{{ $mile['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
