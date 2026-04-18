@extends('layouts.public')
@section('title', 'Final Year Projects Guideline')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    $heroUrl = asset('images/campus-bg.jpg'); 
@endphp

<!-- Hero Section -->
<div class="about-hero relative overflow-hidden bg-cover bg-center py-[5.5rem_0_6.5rem] pt-24 pb-28" style="background-image: url('{{ $heroUrl }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-900/[0.97] via-emerald-800/[0.92] to-slate-900/[0.95]"></div>
    <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(circle_at_20%_80%,rgba(16,185,129,0.15),transparent_50%),radial-gradient(circle_at_80%_20%,rgba(59,130,246,0.1),transparent_50%)]"></div>
    
    <div class="container relative z-10 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 px-[1.2rem] py-[0.4rem] bg-white/5 backdrop-blur-md text-emerald-200 rounded-[20px] text-[0.8rem] font-semibold tracking-[1.5px] uppercase mb-6 border border-white/10">
            <i class="fa-solid fa-graduation-cap text-[0.7rem]"></i> Research Work
        </div>
        <h1 class="text-white text-[3.2rem] font-heading m-[0_0_1rem_0] font-extrabold [text-shadow:0_4px_20px_rgba(0,0,0,0.3)]">Project Guidelines & Formatting</h1>
        <p class="text-slate-300 text-[1.15rem] max-w-[680px] mx-auto leading-[1.7]">{{ $s('project_course_code', 'CMP 499') }} — General information, rules, and milestones for your final year defense.</p>
    </div>
</div>

<div class="container pb-16 -mt-12 relative z-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Main Content -->
        <div class="lg:col-span-2">
            
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 font-heading flex items-center gap-3">
                    <i class="fa-solid fa-project-diagram text-green-600"></i> Course Overview
                </h2>
                <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
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
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 font-heading flex items-center gap-3">
                    <i class="fa-solid fa-book-open-reader text-green-600"></i> Formatting & Typing Guidelines
                </h2>
                
                <div class="space-y-6">
                    @foreach($rules as $index => $rule)
                    <div class="p-5 bg-green-50/50 border border-green-100 rounded-xl relative group hover:shadow-md hover:border-green-200 transition-all">
                        <div class="absolute -left-3 -top-3 w-8 h-8 rounded-full bg-green-200 text-green-700 flex items-center justify-center shadow-sm font-bold text-xs ring-4 ring-white">
                            <i class="fa-solid fa-bookmark"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">Rule {{ $index + 1 }}: {{ $rule['title'] }}</h4>
                        <div class="text-gray-700 leading-relaxed text-[0.95rem]">
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
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 font-heading flex items-center gap-3">
                    <i class="fa-regular fa-calendar-check text-green-600"></i> Important Deadlines
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($milestones as $index => $mile)
                    <div class="border border-gray-100 bg-white shadow-sm p-4 rounded-lg flex gap-4 items-start group hover:border-green-300 transition-colors">
                        <div class="bg-green-100 text-green-700 p-3 rounded-lg flex flex-col items-center justify-center flex-shrink-0 group-hover:bg-green-600 group-hover:text-white transition-colors min-w-[70px]">
                            <i class="fa-solid fa-clock text-xl mb-1 opacity-80"></i>
                            <span class="text-xs font-bold text-center leading-tight">{{ $mile['date'] }}</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $mile['title'] }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-3 mt-1">{{ $mile['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 relative h-full">
            <div class="space-y-6 lg:sticky lg:top-40 z-40 h-max pb-8">
            
            <!-- Coordinator Profile -->
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100" data-aos="fade-left">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4 font-heading">
                    Project Coordinator
                </h3>
                <div class="flex items-center gap-4 mb-2">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl shadow-inner border border-green-200">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $s('project_coordinator_name', 'Dr. Coordinator') }}</p>
                    </div>
                </div>
                <!-- You can add more contact info directly to the form later. For now, it stays clean. -->
            </div>

            <!-- Templates Downloads Widget -->
            <div class="bg-gradient-to-br from-green-900 to-green-800 p-6 rounded-2xl shadow-xl text-white relative overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                <div class="absolute -right-4 top-0 opacity-10 text-7xl transform translate-x-1/4 translate-y-1/8">
                    <i class="fa-solid fa-file-word"></i>
                </div>
                
                <h3 class="text-lg font-bold text-green-50 border-b border-green-700/50 pb-3 mb-4 font-heading relative z-10 flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Official Templates
                </h3>
                
                <div class="text-sm text-green-200 mb-3 relative z-10 leading-snug">Ensure you download and use the official Microsoft Word templates for structure compliance.</div>
                
                <ul class="space-y-3 relative z-10">
                    @if($downloads && $downloads->items->count() > 0)
                        @foreach($downloads->items as $doc)
                            <li>
                                <a href="{{ route('resources.index') }}?category={{ $downloads->id }}" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-lg transition group border border-transparent hover:border-white/10">
                                    <div class="bg-green-100 text-green-700 w-8 h-8 rounded flex items-center justify-center shadow shadow-black/10 group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-file-lines"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <span class="block text-sm font-semibold text-white drop-shadow-md">{{ $doc->title }}</span>
                                    </div>
                                    <i class="fa-solid fa-arrow-down shadow-black/20 text-green-300 group-hover:text-white transition-colors"></i>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <!-- Stub for when no resource items are uploaded yet -->
                        <li>
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg border border-green-500/50 text-green-200 text-sm">
                                <i class="fa-solid fa-circle-info mt-[-2px] text-green-300"></i>
                                <span>No templates currently uploaded. Please check the Resource section.</span>
                            </div>
                        </li>
                    @endif
                </ul>
                <div class="mt-4 pt-3 border-t border-green-700/50 text-center relative z-10">
                    <a href="{{ route('resources.index') }}" class="text-xs text-green-200 hover:text-white font-bold inline-flex items-center gap-1 transition">
                        View All Department Resources <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>
            
            </div> <!-- End Sticky Wrapper -->
        </div>
    </div>
</div>
@endsection
