@extends('layouts.public')
@section('title', 'Admissions')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_admissions')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value)
        : asset('images/campus-bg.jpg');
    $admissionStatus = $gs('admission_status', 'open');
@endphp

<!-- ═══════════════════════════════════════════ -->
<!-- HERO SECTION                               -->
<!-- ═══════════════════════════════════════════ -->
<section class="relative min-h-[50vh] flex items-center bg-slate-900 overflow-hidden">
    <!-- Background layers -->
    <div class="absolute inset-0">
        <img src="{{ $heroUrl }}" alt="" class="w-full h-full object-cover opacity-20" onerror="this.style.display='none'">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 via-emerald-900/80 to-slate-900/95"></div>
    </div>
    <!-- Decorative orbs -->
    <div class="absolute top-[10%] right-[15%] w-[300px] h-[300px] bg-emerald-500/10 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute bottom-[5%] left-[10%] w-[200px] h-[200px] bg-blue-500/10 rounded-full blur-[60px] pointer-events-none"></div>
    <!-- Abstract shapes -->
    <div class="absolute top-[20%] right-[8%] w-[120px] h-[120px] border border-white/5 rounded-full pointer-events-none"></div>
    <div class="absolute bottom-[15%] left-[5%] w-[200px] h-[200px] border border-white/5 rounded-full pointer-events-none"></div>

    <div class="container relative z-10 py-24 pb-28">
        <div class="max-w-[750px]" data-aos="fade-right">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-emerald-300 py-2 px-5 rounded-full text-[0.8rem] font-bold uppercase tracking-[2px] mb-7 border border-white/10">
                <i class="fa-solid fa-door-open text-[0.7rem]"></i> Admissions Portal
            </div>

            <h1 class="text-[clamp(2.2rem,5vw,3.5rem)] font-black text-white leading-[1.08] tracking-tight mb-6 font-heading text-balance">
                Your Journey to <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-emerald-500">Academic Excellence</span> Starts Here
            </h1>

            <p class="text-slate-300 text-[1.1rem] leading-[1.75] mb-9 max-w-[600px]">
                Discover everything you need to know about gaining admission into the {{ config('university.name') }}. We guide you through requirements, deadlines, and the application process.
            </p>

            <!-- Admission Status Badge -->
            <div class="flex flex-wrap gap-4 items-center">
                @if($admissionStatus === 'open')
                <div class="inline-flex items-center gap-2.5 bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 py-2.5 px-5 rounded-xl text-[0.9rem] font-bold backdrop-blur-sm">
                    <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></span> Admissions Open
                </div>
                @else
                <div class="inline-flex items-center gap-2.5 bg-red-500/15 border border-red-400/30 text-red-300 py-2.5 px-5 rounded-xl text-[0.9rem] font-bold backdrop-blur-sm">
                    <span class="w-2.5 h-2.5 bg-red-400 rounded-full"></span> Admissions Closed
                </div>
                @endif

                <a href="#how-to-apply" class="inline-flex items-center gap-2 bg-white text-slate-900 py-3 px-7 rounded-xl font-bold text-[0.95rem] no-underline transition-all duration-300 shadow-[0_10px_25px_-5px_rgba(0,0,0,0.3)] hover:-translate-y-1 hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.4)]">
                    How to Apply <i class="fa-solid fa-arrow-down text-[0.8rem]"></i>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- QUICK STATS BAR                            -->
<!-- ═══════════════════════════════════════════ -->
<section class="bg-white relative z-20 border-b border-slate-100">
    <div class="container">
        <div class="grid grid-cols-2 lg:grid-cols-4 -mt-10" data-aos="fade-up">
            @php
                $stats = [
                    ['icon' => 'fa-solid fa-graduation-cap', 'value' => $programmes->count(), 'label' => 'Programmes', 'color' => 'emerald'],
                    ['icon' => 'fa-solid fa-users-between-lines', 'value' => '500+', 'label' => 'Students', 'color' => 'blue'],
                    ['icon' => 'fa-solid fa-check-double', 'value' => 'NUC', 'label' => 'Accredited', 'color' => 'amber'],
                    ['icon' => 'fa-solid fa-calendar-check', 'value' => $gs('academic_session', '2024/2025'), 'label' => 'Session', 'color' => 'purple'],
                ];
            @endphp
            @foreach($stats as $i => $stat)
            <div class="bg-white p-6 lg:p-8 text-center {{ $i > 0 ? 'border-l border-slate-100' : '' }} group hover:bg-slate-50 transition-colors duration-300">
                <div class="w-12 h-12 mx-auto rounded-xl bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-500 flex items-center justify-center text-[1.2rem] mb-3 group-hover:scale-110 transition-transform duration-300 shadow-sm">
                    <i class="{{ $stat['icon'] }}"></i>
                </div>
                <div class="text-[1.4rem] font-black text-slate-900 mb-0.5">{{ $stat['value'] }}</div>
                <div class="text-slate-500 text-[0.8rem] font-semibold uppercase tracking-wider">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- ENTRY REQUIREMENTS BY PROGRAMME            -->
<!-- ═══════════════════════════════════════════ -->
<section class="bg-white py-24 border-b border-slate-100" id="requirements">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 text-[0.78rem] font-bold uppercase tracking-[2px] py-2 px-5 rounded-full mb-5 border border-blue-100/50 shadow-sm">
                <i class="fa-solid fa-clipboard-check text-[0.7rem]"></i> Entry Requirements
            </span>
            <h2 class="text-[2.5rem] md:text-[2.8rem] font-black text-slate-900 font-heading mb-4 tracking-tight">
                Admission Requirements
            </h2>
            <p class="text-slate-500 max-w-[600px] mx-auto text-[1.05rem] leading-[1.7]">
                Review the specific entry criteria for each of our academic programmes. Requirements vary by programme level.
            </p>
            
            @php $subjectComboPdf = \App\Models\DepartmentSetting::where('key', 'admissions_subject_combination_pdf')->value('value'); @endphp
            @if($subjectComboPdf)
            <div class="mt-14 max-w-[1000px] mx-auto bg-slate-50 border border-slate-200/80 rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.06)] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-blue-500/5 rounded-full blur-[60px] pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row gap-8 items-stretch md:min-h-[450px]">
                    <!-- Left Side: Buttons & Info -->
                    <div class="w-full md:w-[35%] flex flex-col justify-center py-4">
                        <div class="text-center md:text-left">
                            <div class="w-14 h-14 mx-auto md:mx-0 bg-gradient-to-br from-blue-100 to-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-[1.5rem] mb-5 border border-blue-200/50 shadow-inner">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <h4 class="text-[1.3rem] font-bold text-slate-900 mb-3 tracking-tight">Subject Combinations</h4>
                            <p class="text-slate-500 text-[0.95rem] leading-[1.6] mb-8">
                                Consult the official documentation for the required O'Level subjects and UTME/DE combinations corresponding to your desired programme.
                            </p>
                        </div>
                        <div class="flex flex-col gap-3">
                            <a href="{{ asset('storage/' . $subjectComboPdf) }}" target="_blank" class="flex items-center justify-center gap-2.5 w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 px-6 rounded-xl font-bold text-[0.95rem] transition-all duration-300 shadow-[0_8px_20px_-6px_rgba(37,99,235,0.4)] hover:-translate-y-0.5">
                                <i class="fa-solid fa-expand text-[0.9rem]"></i> View Full Screen
                            </a>
                            <a href="{{ asset('storage/' . $subjectComboPdf) }}" download class="flex items-center justify-center gap-2.5 w-full bg-white hover:bg-slate-100 text-slate-700 border border-slate-200 shadow-sm py-3.5 px-6 rounded-xl font-bold text-[0.95rem] transition-all duration-300 hover:border-slate-300">
                                <i class="fa-solid fa-cloud-arrow-down text-[0.9rem]"></i> Download File
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right Side: PDF Preview -->
                    <div class="w-full md:w-[65%] h-[400px] md:h-auto rounded-2xl overflow-hidden border border-slate-200 shadow-[0_4px_15px_-5px_rgba(0,0,0,0.05)] bg-white flex items-center justify-center relative group">
                        <iframe src="{{ asset('storage/' . $subjectComboPdf) }}#toolbar=0&navpanes=0&scrollbar=0&view=FitH" class="absolute inset-0 w-full h-full border-none" title="Subject Combinations Preview"></iframe>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="max-w-[950px] mx-auto space-y-4" x-data="{ openProg: 0 }">
            @foreach($programmes as $index => $prog)
            <div class="rounded-2xl border transition-all duration-300 overflow-hidden"
                 :class="openProg === {{ $index }}
                     ? 'bg-white shadow-[0_12px_40px_-8px_rgba(37,99,235,0.1)] border-blue-200/60'
                     : 'bg-white border-slate-200 hover:border-slate-300 hover:shadow-[0_4px_15px_-5px_rgba(0,0,0,0.05)]'"
                 data-aos="fade-up" data-aos-delay="{{ $index * 60 }}">

                <!-- Programme Header -->
                <button @click="openProg = openProg === {{ $index }} ? null : {{ $index }}"
                        class="w-full flex items-center gap-4 md:gap-5 p-5 md:p-6 text-left focus:outline-none group cursor-pointer">

                    <!-- Level badge -->
                    <div class="w-12 h-12 min-w-[3rem] rounded-xl flex items-center justify-center text-[0.75rem] font-black uppercase transition-all duration-300 shrink-0"
                         :class="openProg === {{ $index }}
                             ? 'bg-blue-600 text-white shadow-[0_6px_16px_-2px_rgba(37,99,235,0.4)] scale-105'
                             : 'bg-slate-50 text-slate-500 border border-slate-200 group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-200'">
                        {{ $prog->level ?? 'BSc' }}
                    </div>

                    <!-- Programme name -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-[1rem] md:text-[1.1rem] font-bold leading-snug tracking-tight transition-colors duration-200 mb-0.5"
                            :class="openProg === {{ $index }} ? 'text-blue-700' : 'text-slate-700 group-hover:text-slate-900'">
                            {{ $prog->name }}
                        </h3>
                        <div class="flex flex-wrap gap-2 mt-1.5">
                            @if($prog->duration)
                            <span class="inline-flex items-center gap-1 text-slate-400 text-[0.75rem] font-medium">
                                <i class="fa-regular fa-clock text-[0.6rem]"></i> {{ $prog->duration }}
                            </span>
                            @endif
                            @if($prog->mode_of_study)
                            <span class="inline-flex items-center gap-1 text-slate-400 text-[0.75rem] font-medium">
                                <i class="fa-solid fa-book-open text-[0.6rem]"></i> {{ $prog->mode_of_study }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Toggle -->
                    <div class="w-9 h-9 min-w-[2.25rem] rounded-xl flex items-center justify-center transition-all duration-300 shrink-0"
                         :class="openProg === {{ $index }}
                             ? 'bg-blue-600 text-white shadow-sm'
                             : 'bg-slate-50 text-slate-400 border border-slate-200 group-hover:bg-slate-100'">
                        <i class="fa-solid fa-plus text-[0.7rem] transition-transform duration-300" :class="openProg === {{ $index }} ? 'rotate-45' : ''"></i>
                    </div>
                </button>

                <!-- Requirements Content -->
                <div x-show="openProg === {{ $index }}" x-collapse x-cloak>
                    <div class="px-5 md:px-6 pb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ml-0 md:ml-[4.25rem]">

                            <!-- UTME Requirements -->
                            <div class="bg-gradient-to-br from-emerald-50 to-emerald-50/50 p-5 rounded-xl border border-emerald-100/80">
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center text-[0.65rem] shadow-sm">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </div>
                                    <h4 class="text-[0.9rem] font-bold text-emerald-800 m-0">UTME Entry</h4>
                                </div>
                                <p class="text-emerald-700/80 text-[0.88rem] leading-[1.7] m-0">
                                    {{ $prog->requirements_utme ?? 'Five (5) O\'Level credits including Mathematics and English Language. Minimum JAMB score as specified per session.' }}
                                </p>
                            </div>

                            <!-- Direct Entry Requirements -->
                            <div class="bg-gradient-to-br from-amber-50 to-amber-50/50 p-5 rounded-xl border border-amber-100/80">
                                <div class="flex items-center gap-2.5 mb-3">
                                    <div class="w-8 h-8 rounded-lg bg-amber-500 text-white flex items-center justify-center text-[0.65rem] shadow-sm">
                                        <i class="fa-solid fa-file-shield"></i>
                                    </div>
                                    <h4 class="text-[0.9rem] font-bold text-amber-800 m-0">Direct Entry</h4>
                                </div>
                                <p class="text-amber-700/80 text-[0.88rem] leading-[1.7] m-0">
                                    {{ $prog->requirements_de ?? 'NCE/OND/HND or equivalent with a minimum of Merit/Lower Credit in relevant disciplines, plus UTME requirements.' }}
                                </p>
                            </div>
                        </div>

                        <!-- View Programme Details link -->
                        <div class="ml-0 md:ml-[4.25rem] mt-4 pt-4 border-t border-slate-100">
                            <a href="{{ route('programmes.show', $prog->slug) }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-bold text-[0.85rem] no-underline transition-colors group/link">
                                View full programme details <i class="fa-solid fa-arrow-right text-[0.7rem] transition-transform duration-200 group-hover/link:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- HOW TO APPLY — STEP BY STEP                -->
<!-- ═══════════════════════════════════════════ -->
<section class="bg-[#fafbfc] py-24 border-b border-slate-100" id="how-to-apply">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-600 text-[0.78rem] font-bold uppercase tracking-[2px] py-2 px-5 rounded-full mb-5 border border-emerald-500/15 shadow-sm">
                <i class="fa-solid fa-route text-[0.7rem]"></i> Application Process
            </span>
            <h2 class="text-[2.5rem] md:text-[2.8rem] font-black text-slate-900 font-heading mb-4 tracking-tight">
                How to Apply
            </h2>
            <p class="text-slate-500 max-w-[600px] mx-auto text-[1.05rem] leading-[1.7]">
                Follow these simple steps to submit your application for any of our academic programmes.
            </p>
        </div>

        <div class="w-full xl:max-w-[1200px] mx-auto">
            @php
                $steps = [
                    [
                        'icon' => 'fa-solid fa-magnifying-glass-chart',
                        'title' => 'Check Eligibility',
                        'desc' => 'Review the admission requirements for your desired programme above. Ensure you meet the UTME or Direct Entry criteria before proceeding.',
                        'color' => 'blue',
                    ],
                    [
                        'icon' => 'fa-solid fa-pen-to-square',
                        'title' => 'Register on JAMB Portal',
                        'desc' => 'Visit the JAMB portal (jamb.gov.ng) to register and select your programme. For postgraduate applicants, visit the NSUK SPGS portal.',
                        'color' => 'emerald',
                    ],
                    [
                        'icon' => 'fa-solid fa-money-check-dollar',
                        'title' => 'Purchase Application Form',
                        'desc' => 'Obtain the university application form via the NSUK admissions portal. Complete all sections accurately and submit with required documents.',
                        'color' => 'purple',
                    ],
                    [
                        'icon' => 'fa-solid fa-clipboard-user',
                        'title' => 'Attend Screening Exercise',
                        'desc' => 'Come for the departmental screening exercise with your original credentials, JAMB result, and O\'Level certificates for verification.',
                        'color' => 'amber',
                    ],
                    [
                        'icon' => 'fa-solid fa-circle-check',
                        'title' => 'Admission & Registration',
                        'desc' => 'Upon successful screening, check the admissions list. Once admitted, proceed to complete your registration and course enrollment.',
                        'color' => 'rose',
                    ],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-4">
                @foreach($steps as $i => $step)
                <div class="bg-white rounded-2xl p-4 md:p-5 border border-slate-200/80 shadow-[0_4px_15px_-5px_rgba(0,0,0,0.04)] hover:shadow-[0_15px_35px_-10px_rgba(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden flex flex-col h-full" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <!-- Subtle accent top border -->
                    <div class="absolute top-0 left-0 right-0 h-[3px] bg-gradient-to-r from-{{ $step['color'] }}-400 to-{{ $step['color'] }}-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="flex items-center justify-between mb-4 mt-1">
                        <div class="w-10 h-10 rounded-[10px] bg-{{ $step['color'] }}-50 text-{{ $step['color'] }}-500 flex items-center justify-center text-[1rem] transition-transform duration-300 group-hover:scale-110 border border-{{ $step['color'] }}-100/50">
                            <i class="{{ $step['icon'] }}"></i>
                        </div>
                        <div class="text-{{ $step['color'] }}-500 text-[0.65rem] font-black bg-{{ $step['color'] }}-50 py-1 px-2 rounded-md border border-{{ $step['color'] }}-100">
                            STEP 0{{ $i + 1 }}
                        </div>
                    </div>

                    <h3 class="text-[0.95rem] font-bold text-slate-900 mb-2 tracking-tight leading-snug">{{ $step['title'] }}</h3>
                    <p class="text-slate-500 text-[0.82rem] leading-[1.6] m-0">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- IMPORTANT DATES / DEADLINES                -->
<!-- ═══════════════════════════════════════════ -->
<section class="bg-white py-24 border-b border-slate-100" id="deadlines">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 bg-amber-50 text-amber-600 text-[0.78rem] font-bold uppercase tracking-[2px] py-2 px-5 rounded-full mb-5 border border-amber-100/50 shadow-sm">
                <i class="fa-solid fa-calendar-days text-[0.7rem]"></i> Key Dates
            </span>
            <h2 class="text-[2.5rem] md:text-[2.8rem] font-black text-slate-900 font-heading mb-4 tracking-tight">
                Important Dates & Deadlines
            </h2>
            <p class="text-slate-500 max-w-[600px] mx-auto text-[1.05rem] leading-[1.7]">
                Stay on top of critical deadlines for the {{ $gs('academic_session', '2024/2025') }} academic session.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-[1000px] mx-auto">
            @php
                $dates = [
                    ['title' => 'JAMB Registration', 'period' => 'Jan – May', 'desc' => 'Online registration on the JAMB portal for UTME candidates.', 'icon' => 'fa-solid fa-pen-fancy', 'color' => 'blue'],
                    ['title' => 'Post-UTME Screening', 'period' => 'Jul – Sep', 'desc' => 'Departmental screening exercise for eligible candidates.', 'icon' => 'fa-solid fa-user-check', 'color' => 'emerald'],
                    ['title' => 'Admission List', 'period' => 'Aug – Oct', 'desc' => 'Publication of merit & supplementary admission lists.', 'icon' => 'fa-solid fa-list-check', 'color' => 'purple'],
                    ['title' => 'Clearance & Registration', 'period' => 'Sep – Nov', 'desc' => 'Bio-data capture, school fees payment & course registration.', 'icon' => 'fa-solid fa-id-card-clip', 'color' => 'amber'],
                    ['title' => 'DE Application', 'period' => 'Feb – Aug', 'desc' => 'Direct Entry applications through JAMB for HND/NCE holders.', 'icon' => 'fa-solid fa-file-import', 'color' => 'rose'],
                    ['title' => 'PG Admission', 'period' => 'Mar – Sep', 'desc' => 'Postgraduate applications via the NSUK SPGS portal.', 'icon' => 'fa-solid fa-graduation-cap', 'color' => 'cyan'],
                ];
            @endphp

            @foreach($dates as $i => $date)
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 hover:border-{{ $date['color'] }}-200 shadow-sm hover:shadow-[0_12px_30px_-8px_rgba(0,0,0,0.06)] transition-all duration-300 hover:-translate-y-1 group" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-{{ $date['color'] }}-50 text-{{ $date['color'] }}-500 flex items-center justify-center text-[1rem] shrink-0 group-hover:scale-110 transition-transform duration-300 border border-{{ $date['color'] }}-100/50">
                        <i class="{{ $date['icon'] }}"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-[1rem] font-bold text-slate-800 mb-1 tracking-tight">{{ $date['title'] }}</h3>
                        <span class="inline-flex items-center gap-1 text-{{ $date['color'] }}-600 text-[0.75rem] font-bold bg-{{ $date['color'] }}-50 py-0.5 px-2.5 rounded-lg mb-2">
                            <i class="fa-regular fa-calendar text-[0.6rem]"></i> {{ $date['period'] }}
                        </span>
                        <p class="text-slate-500 text-[0.85rem] leading-[1.6] m-0">{{ $date['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- DOCUMENT CHECKLIST                         -->
<!-- ═══════════════════════════════════════════ -->
<section class="bg-[#fafbfc] py-24 border-b border-slate-100" id="documents">
    <div class="container" data-aos="fade-up">
        <div class="max-w-[950px] mx-auto">
            <div class="text-center mb-14">
                <span class="inline-flex items-center gap-2 bg-purple-50 text-purple-600 text-[0.78rem] font-bold uppercase tracking-[2px] py-2 px-5 rounded-full mb-5 border border-purple-100/50 shadow-sm">
                    <i class="fa-solid fa-folder-open text-[0.7rem]"></i> Documents
                </span>
                <h2 class="text-[2.5rem] md:text-[2.8rem] font-black text-slate-900 font-heading mb-4 tracking-tight">
                    Required Documents
                </h2>
                <p class="text-slate-500 max-w-[550px] mx-auto text-[1.05rem] leading-[1.7]">
                    Prepare these documents before your screening exercise to ensure a smooth admission process.
                </p>
            </div>

            @php
                $docs = [
                    ['name' => 'O\'Level Result(s)', 'desc' => 'WAEC, NECO, or NABTEB certificates — original + 2 photocopies', 'icon' => 'fa-solid fa-scroll'],
                    ['name' => 'JAMB Result Slip', 'desc' => 'Original JAMB result slip and admission letter from JAMB portal', 'icon' => 'fa-solid fa-file-lines'],
                    ['name' => 'Birth Certificate / Declaration of Age', 'desc' => 'Government-issued birth certificate or sworn affidavit', 'icon' => 'fa-solid fa-certificate'],
                    ['name' => 'Local Government Identification', 'desc' => 'LGA identification letter from your state of origin', 'icon' => 'fa-solid fa-id-badge'],
                    ['name' => 'Passport Photographs', 'desc' => '6 recent passport-sized photographs (white background)', 'icon' => 'fa-solid fa-camera'],
                    ['name' => 'Medical Fitness Certificate', 'desc' => 'Health certificate from a recognized medical facility', 'icon' => 'fa-solid fa-heart-pulse'],
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($docs as $i => $doc)
                <div class="flex items-start gap-4 bg-white rounded-xl p-5 border border-slate-200/80 hover:border-purple-200/80 hover:shadow-[0_8px_20px_-5px_rgba(147,51,234,0.06)] transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ $i * 60 }}">
                    <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-500 flex items-center justify-center text-[0.9rem] shrink-0 group-hover:bg-purple-500 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="{{ $doc['icon'] }}"></i>
                    </div>
                    <div>
                        <h4 class="text-[0.95rem] font-bold text-slate-800 mb-1 m-0">{{ $doc['name'] }}</h4>
                        <p class="text-slate-500 text-[0.84rem] leading-[1.6] m-0">{{ $doc['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Note -->
            <div class="mt-6 bg-amber-50 border border-amber-200/60 rounded-xl p-5 flex items-start gap-3" data-aos="fade-up">
                <div class="w-8 h-8 rounded-lg bg-amber-400 text-white flex items-center justify-center text-[0.7rem] shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h4 class="text-[0.9rem] font-bold text-amber-800 mb-1 m-0">Important Note</h4>
                    <p class="text-amber-700/80 text-[0.85rem] leading-[1.65] m-0">
                        All original credentials must be presented during the screening exercise. Photocopies alone will not be accepted.
                        For Direct Entry candidates, additional transcripts from previous institutions are required.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- FAQ SECTION                                -->
<!-- ═══════════════════════════════════════════ -->
@php
    $admFaqs = [
        ['q' => 'What is the minimum JAMB score required?', 'a' => 'The minimum JAMB cut-off mark varies each academic session. Generally, a score of 180 and above is recommended, but the department may set higher benchmarks depending on the number of applicants.'],
        ['q' => 'Can I apply with awaiting results?', 'a' => 'Yes, candidates with awaiting O\'Level results can apply through JAMB. However, the results must be available before the clearance/registration period to complete admission.'],
        ['q' => 'Are there scholarships available?', 'a' => 'The university offers merit-based scholarships and bursaries. Additionally, some state governments provide scholarships for indigenes. Contact the Student Affairs office for detailed information.'],
        ['q' => 'What is the duration of the programmes?', 'a' => 'Undergraduate programmes typically run for 4 years (UTME entry) or 3 years (Direct Entry). Postgraduate programmes range from 18 months (PGD/MSc) to 3–5 years (PhD).'],
        ['q' => 'How do I check my admission status?', 'a' => 'Admission lists are published on the JAMB portal (CAPS) and the NSUK admissions portal. You may also visit the department notice board or contact the departmental admissions officer.'],
    ];
@endphp

<section class="bg-white py-24 border-b border-slate-100" x-data="{ activeFaq: null }" id="faq">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 bg-slate-100 text-slate-600 text-[0.78rem] font-bold uppercase tracking-[2px] py-2 px-5 rounded-full mb-5 border border-slate-200/50 shadow-sm">
                <i class="fa-solid fa-circle-question text-[0.7rem]"></i> Support
            </span>
            <h2 class="text-[2.5rem] md:text-[2.8rem] font-black text-slate-900 font-heading mb-4 tracking-tight">
                Frequently Asked Questions
            </h2>
            <p class="text-slate-500 max-w-[550px] mx-auto text-[1.05rem] leading-[1.7]">
                Common questions about the admissions process, answered.
            </p>
        </div>

        <div class="max-w-[800px] mx-auto space-y-3">
            @foreach($admFaqs as $index => $faq)
            <div class="group/card rounded-2xl transition-all duration-300 border relative overflow-hidden"
                 :class="activeFaq === {{ $index }}
                     ? 'bg-white shadow-[0_10px_35px_-8px_rgba(0,0,0,0.08)] border-slate-300/60'
                     : 'bg-white/70 border-slate-200/70 hover:bg-white hover:border-slate-300 hover:shadow-sm'"
                 data-aos="fade-up" data-aos-delay="{{ $index * 60 }}">

                <!-- Accent bar -->
                <div class="absolute left-0 top-0 bottom-0 w-[3px] rounded-l-2xl transition-all duration-300"
                     :class="activeFaq === {{ $index }}
                         ? 'bg-gradient-to-b from-emerald-400 to-emerald-600'
                         : 'bg-transparent group-hover/card:bg-slate-200'"></div>

                <button @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                        class="w-full flex items-center gap-4 p-5 md:p-6 pl-6 md:pl-7 text-left focus:outline-none group cursor-pointer">
                    <div class="w-10 h-10 min-w-[2.5rem] rounded-xl flex items-center justify-center text-[0.8rem] font-black transition-all duration-300 shrink-0 relative"
                         :class="activeFaq === {{ $index }}
                             ? 'bg-emerald-500 text-white shadow-[0_4px_12px_rgba(16,185,129,0.35)] scale-105'
                             : 'bg-slate-50 text-slate-400 border border-slate-200 group-hover:bg-emerald-50 group-hover:text-emerald-600'">
                        <span :class="activeFaq === {{ $index }} ? 'opacity-0 scale-75' : 'opacity-100 scale-100'" class="transition-all duration-200">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <i class="fa-solid fa-check text-[0.65rem] absolute transition-all duration-200" :class="activeFaq === {{ $index }} ? 'opacity-100 scale-100' : 'opacity-0 scale-75'"></i>
                    </div>
                    <h3 class="flex-1 text-[0.98rem] md:text-[1.05rem] font-bold leading-snug tracking-tight transition-colors duration-200"
                        :class="activeFaq === {{ $index }} ? 'text-slate-900' : 'text-slate-600 group-hover:text-slate-800'">
                        {{ $faq['q'] }}
                    </h3>
                    <div class="w-8 h-8 min-w-[2rem] rounded-xl flex items-center justify-center transition-all duration-300 shrink-0"
                         :class="activeFaq === {{ $index }}
                             ? 'bg-emerald-500 text-white'
                             : 'bg-slate-50 text-slate-400 border border-slate-200 group-hover:bg-slate-100'">
                        <i class="fa-solid fa-plus text-[0.65rem] transition-transform duration-300" :class="activeFaq === {{ $index }} ? 'rotate-45' : ''"></i>
                    </div>
                </button>

                <div x-show="activeFaq === {{ $index }}" x-collapse x-cloak>
                    <div class="px-5 md:px-6 pl-6 md:pl-7 pb-6">
                        <div class="ml-14 bg-slate-50 border border-slate-100/80 rounded-xl p-5 text-slate-600 text-[0.9rem] leading-[1.8] relative">
                            <div class="absolute -top-3 -left-3 w-6 h-6 rounded-lg bg-emerald-500 text-white flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-reply text-[0.5rem]"></i>
                            </div>
                            {{ $faq['a'] }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════ -->
<!-- CTA — APPLY NOW                            -->
<!-- ═══════════════════════════════════════════ -->
<section class="bg-gradient-to-br from-[#0c1f17] via-[#132a1c] to-[#0a1a12] text-white py-24 relative overflow-hidden">
    <!-- Decorative patterns -->
    <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 25px 25px;"></div>
    <div class="absolute top-0 right-[20%] w-[300px] h-[300px] bg-emerald-500/10 rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-[15%] w-[250px] h-[250px] bg-emerald-500/10 rounded-full blur-[60px] pointer-events-none"></div>

    <div class="container relative z-10 text-center" data-aos="zoom-in">
        <div class="w-16 h-16 rounded-2xl bg-emerald-500/15 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-[1.5rem] mx-auto mb-7 shadow-inner">
            <i class="fa-solid fa-rocket"></i>
        </div>

        <h2 class="text-[2.5rem] md:text-[3rem] font-black mb-5 font-heading tracking-tight leading-[1.1] text-balance">
            Ready to Begin Your Application?
        </h2>
        <p class="text-slate-300 text-[1.1rem] leading-[1.7] max-w-[550px] mx-auto mb-10">
            Take the first step towards a rewarding career in computing. Apply today and join a community of innovators.
        </p>

        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://jamb.gov.ng" target="_blank" class="inline-flex items-center gap-2.5 bg-white text-slate-900 py-3.5 px-8 rounded-xl font-bold text-[1rem] no-underline transition-all duration-300 shadow-[0_10px_25px_-5px_rgba(0,0,0,0.3)] hover:-translate-y-1 hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.4)]">
                Apply via JAMB <i class="fa-solid fa-external-link text-[0.75rem]"></i>
            </a>
            <a href="https://spgs.nsuk.edu.ng" target="_blank" class="inline-flex items-center gap-2.5 bg-white/10 border border-white/20 backdrop-blur-sm text-white py-3.5 px-8 rounded-xl font-bold text-[1rem] no-underline transition-all duration-300 hover:bg-white/15 hover:border-white/30">
                PG Application (SPGS) <i class="fa-solid fa-external-link text-[0.75rem]"></i>
            </a>
        </div>

        <div class="mt-10">
            <a href="{{ route('contact') }}" class="text-slate-400 hover:text-white font-semibold text-[0.9rem] no-underline border-b border-dotted border-slate-500 pb-0.5 transition-colors duration-200">
                Need help? Contact the Admissions Office →
            </a>
        </div>
    </div>
</section>

@endsection
