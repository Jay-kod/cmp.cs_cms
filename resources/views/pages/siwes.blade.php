@extends('layouts.public')
@section('title', 'SIWES Information')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    $heroUrl = asset('images/campus-bg.jpg'); // Fallback hero image you could link to department settings
@endphp

<!-- Hero Section -->
<div class="about-hero" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.97) 0%, rgba(4, 120, 87, 0.92) 50%, rgba(15, 23, 42, 0.95) 100%), url('{{ $heroUrl }}') center/cover; padding: 5.5rem 0 6.5rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.15), transparent 50%), radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1), transparent 50%); pointer-events: none;"></div>
    
    <div class="container" data-aos="fade-up" style="position: relative; z-index: 10; text-align: center;">
        <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.4rem 1.2rem; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); color: #a7f3d0; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 1.5rem; border: 1px solid rgba(255,255,255,0.1);">
            <i class="fa-solid fa-industry" style="font-size: 0.7rem;"></i> Student Industrial Work Experience Scheme
        </div>
        <h1 style="color: white; font-size: 3.2rem; font-family: var(--font-heading); margin: 0 0 1rem 0; font-weight: 800; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">SIWES & IT Guidelines</h1>
        <p style="color: #cbd5e1; font-size: 1.15rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">Your complete departmental guide to industrial placement, logging, and evaluation.</p>
    </div>
</div>

<div class="container pb-16" style="margin-top: -3rem; position: relative; z-index: 20;">
    
    <!-- Top Contact & Stats Cards (Horizontal Layout) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- General Director Info -->
        <div class="bg-gradient-to-br from-blue-900 to-blue-800 p-7 rounded-2xl shadow-2xl shadow-blue-900/20 border border-blue-700/50 text-white relative overflow-hidden flex flex-col transition-transform hover:-translate-y-1" data-aos="fade-up">
            <div class="absolute right-0 top-0 opacity-10 text-6xl transform translate-x-1/4 -translate-y-1/4">
                <i class="fa-solid fa-sitemap"></i>
            </div>
            <h3 class="text-xl font-bold text-blue-50 border-b border-blue-700/50 pb-3 mb-5 font-heading relative z-10 flex items-center gap-2">
                SIWES Directorate (NSUK)
            </h3>
            <div class="flex items-center gap-5 mb-5 relative z-10">
                @if($s('siwes_director_image'))
                    <img src="{{ asset('storage/' . $s('siwes_director_image')) }}" alt="Director" class="w-16 h-16 rounded-[18px] object-cover shadow-lg border-2 border-blue-400/30">
                @else
                    <div class="w-16 h-16 bg-white/10 text-blue-200 rounded-[18px] flex items-center justify-center text-2xl shadow-inner border border-white/10">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                @endif
                <div>
                    <p class="font-bold text-white text-[1.05rem]">{{ $s('siwes_director_name', 'University SIWES Director') }}</p>
                    <p class="text-[0.85rem] text-blue-200 mt-0.5">Director, SIWES NSUK</p>
                </div>
            </div>
            <div class="space-y-3 text-[0.85rem] text-blue-100 relative z-10 flex-1 mt-auto">
                <div class="flex gap-3">
                    <i class="fa-solid fa-envelope mt-1 text-blue-400"></i>
                    <div>
                        <span class="block font-semibold text-white">Director's Email</span>
                        <a href="mailto:{{ $s('siwes_director_email', 'directorsiwes@nsuk.edu.ng') }}" class="text-blue-200 hover:text-white transition">{{ $s('siwes_director_email', 'directorsiwes@nsuk.edu.ng') }}</a>
                    </div>
                </div>
                <div class="flex gap-3">
                    <i class="fa-solid fa-phone mt-1 text-blue-400"></i>
                    <div>
                        <span class="block font-semibold text-white">Contact / Phone</span>
                        {{ $s('siwes_director_phone', '+2348063400484, +2348052753760') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Coordinator Info -->
        <div class="bg-gradient-to-br from-white to-gray-50/80 p-7 rounded-2xl shadow-2xl shadow-gray-200/50 border border-gray-100 relative overflow-hidden flex flex-col transition-transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-5 font-heading">
                Departmental Coordinator
            </h3>
            <div class="flex items-center gap-5 mb-5">
                @if($s('siwes_coordinator_image'))
                    <img src="{{ asset('storage/' . $s('siwes_coordinator_image')) }}" alt="Coordinator" class="w-16 h-16 rounded-[18px] object-cover shadow-lg border-2 border-green-200/60">
                @else
                    <div class="w-16 h-16 bg-green-50 text-green-600 rounded-[18px] flex items-center justify-center text-2xl shadow-inner border border-green-200/50">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                @endif
                <div>
                    <p class="font-bold text-gray-900 text-[1.05rem]">{{ $s('siwes_coordinator_name', 'Dr. Coordinator') }}</p>
                    <p class="text-[0.85rem] text-gray-500 mt-0.5">Coordinator (SIWES/IT)</p>
                </div>
            </div>
            <div class="space-y-3 text-[0.85rem] text-gray-600 mt-auto flex-1">
                <div class="flex gap-3">
                    <i class="fa-solid fa-envelope mt-1 text-green-500"></i>
                    <div>
                        <span class="block font-semibold text-gray-900">Email</span>
                        <a href="mailto:{{ $s('siwes_coordinator_email') }}" class="text-green-600 hover:underline">{{ $s('siwes_coordinator_email', 'siwes@department.edu.ng') }}</a>
                    </div>
                </div>
                <div class="flex gap-3">
                    <i class="fa-regular fa-clock mt-1 text-green-500"></i>
                    <div>
                        <span class="block font-semibold text-gray-900">Consultation Hours</span>
                        {{ $s('siwes_coordinator_hours', 'Mon - Wed, 10am - 1pm') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Downloads & Resources -->
        <div class="bg-gradient-to-br from-green-900 to-green-800 p-7 rounded-2xl shadow-2xl shadow-green-900/20 border border-green-700/50 text-white relative overflow-hidden flex flex-col transition-transform hover:-translate-y-1" data-aos="fade-up" data-aos-delay="200">
            <div class="absolute right-0 top-0 opacity-10 text-6xl transform translate-x-1/4 -translate-y-1/4">
                <i class="fa-solid fa-folder-arrow-down"></i>
            </div>
            <h3 class="text-xl font-bold text-green-50 border-b border-green-700/50 pb-3 mb-5 font-heading relative z-10 flex items-center gap-2">
                <i class="fa-solid fa-download"></i> Required Documents
            </h3>
            <ul class="space-y-3 relative z-10 flex-1">
                @if($downloads && $downloads->items->count() > 0)
                    @foreach($downloads->items as $doc)
                        <li>
                            <a href="{{ route('resources.index') }}?category={{ $downloads->id }}" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-lg transition group border border-white/5">
                                <div class="bg-green-100 text-green-600 w-8 h-8 rounded-md flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <div class="flex-grow">
                                    <span class="block text-sm font-semibold text-white">{{ $doc->title }}</span>
                                </div>
                                <i class="fa-solid fa-arrow-down text-green-300 group-hover:text-white transition-colors"></i>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg border border-green-700/30 text-green-200 text-[0.85rem] leading-snug">
                            <i class="fa-solid fa-circle-info"></i> No documents uploaded yet. Please check the specific category in the Resource Catalog.
                        </div>
                    </li>
                @endif
            </ul>
            <div class="mt-4 pt-3 border-t border-green-700/50 text-center relative z-10">
                <a href="{{ route('resources.index') }}" class="text-[0.8rem] text-green-200 hover:text-white font-bold inline-flex items-center gap-1 transition uppercase tracking-wide">
                    View All Department Resources <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>
    </div>


    <!-- Main Content Area -->
    <div class="max-w-[1000px] mx-auto">
        <!-- SIWES Directorate External Link Notice -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 md:p-8 mb-10 flex flex-col md:flex-row items-center gap-6 shadow-sm relative overflow-hidden" data-aos="fade-up">
            <div class="absolute -right-4 -top-4 text-blue-200/50 text-9xl pointer-events-none">
                <i class="fa-solid fa-globe"></i>
            </div>
            <div class="w-16 h-16 shrink-0 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-3xl shadow-inner relative z-10 border border-blue-200">
                <i class="fa-solid fa-globe"></i>
            </div>
            <div class="flex-1 text-center md:text-left relative z-10">
                <h3 class="text-xl font-bold text-blue-900 mb-2">Official University SIWES Portal</h3>
                <p class="text-blue-800 text-[1.05rem] leading-relaxed mb-5">Please note that the central SIWES Directorate of the university operates its own dedicated website. We at the department simply provide this page to guide our students through the departmental-level clearance and processes.</p>
                <a href="https://siwes.nsuk.edu.ng/" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:-translate-y-1 transition-all">
                    Visit Official Portal <i class="fa-solid fa-arrow-up-right-from-square text-[0.8rem] ml-1"></i>
                </a>
            </div>
        </div>

        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl border border-gray-100 mb-10" data-aos="fade-up">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 border-b border-gray-100 pb-4 mb-6 font-heading flex items-center gap-3">
                <i class="fa-solid fa-info-circle text-green-600"></i> Scheme Overview
            </h2>
            <div class="prose max-w-none text-gray-700 text-[1.05rem] leading-loose">
                <p>{{ $s('siwes_overview', 'The Student Industrial Work Experience Scheme (SIWES) is a skills training program designed to expose students to the work environment and prepare them for reality after graduation. It bridges the gap between theory and practical work.') }}</p>
            </div>
        </div>

        <!-- Workflow Steps -->
        @php 
            $defaultSteps = [
                ['title' => 'Obtain SIWES Letter', 'desc' => 'Collect your official introduction letter from the departmental coordinator.'],
                ['title' => 'Secure Placement', 'desc' => 'Find a suitable IT firm or organization relevant to computer science.'],
                ['title' => 'Return Acceptance Letter', 'desc' => 'Submit your acceptance letter and assumption of duty form back to the department.'],
                ['title' => 'Maintain Logbook', 'desc' => 'Keep a daily and weekly record of all tasks and activities undertaken at your workplace.'],
                ['title' => 'Supervisor Visitation', 'desc' => 'A departmental supervisor will visit your workplace for on-site assessment.'],
                ['title' => 'Final Defense & Submission', 'desc' => 'Return to the department to submit your signed logbook, technical report, and defend your experience before a panel.']
            ];
            $steps = json_decode($s('siwes_steps', '[]'), true); 
            if (empty($steps)) $steps = $defaultSteps;
        @endphp
        @if(count($steps) > 0)
        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl border border-gray-100 mb-10" data-aos="fade-up">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 border-b border-gray-100 pb-4 mb-8 font-heading flex items-center gap-3">
                <i class="fa-solid fa-route text-green-600"></i> Process Workflow
            </h2>
            
            <div class="relative border-l-4 border-green-100 ml-4 space-y-10 pb-4 mt-8">
                @foreach($steps as $index => $step)
                <div class="relative pl-8">
                    <div class="absolute w-10 h-10 bg-green-600 rounded-full text-white flex items-center justify-center font-bold text-lg border-4 border-white shadow-md shadow-green-200/50" style="left: -22px; top: -5px;">
                        {{ $index + 1 }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 text-[1.05rem] leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- FAQs -->
        @php 
            $defaultFaqs = [
                ['q' => 'How long is the SIWES duration?', 'a' => 'The mandatory SIWES duration is 6 months, typically undertaken during the second semester of your 300 level.'],
                ['q' => 'Can I change my placement location?', 'a' => 'Changes are heavily discouraged once your assumption of duty is submitted unless under extreme circumstances, which must be approved by the Head of Department.'],
                ['q' => 'What happens if I lose my logbook?', 'a' => 'Lost logbooks result in an automatic carry-over of the course. Ensure it is kept safe and appropriately signed at all times.']
            ];
            $faqs = json_decode($s('siwes_faqs', '[]'), true); 
            if (empty($faqs)) $faqs = $defaultFaqs;
        @endphp
        @if(count($faqs) > 0)
        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-xl border border-gray-100" data-aos="fade-up">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 border-b border-gray-100 pb-4 mb-8 font-heading flex items-center gap-3">
                <i class="fa-solid fa-comments text-green-600"></i> Frequently Asked Questions
            </h2>
            
            <div class="space-y-4">
                @foreach($faqs as $index => $faq)
                <div class="border border-gray-200 rounded-xl overflow-hidden transition-all duration-300 shadow-sm">
                    <button class="w-full text-left px-6 py-5 bg-gray-50 hover:bg-gray-100 font-bold text-gray-800 text-lg flex justify-between items-center transition"
                            onclick="const c = this.nextElementSibling; const i = this.querySelector('i'); if(c.style.display === 'none'){c.style.display='block';i.classList.add('rotate-180')}else{c.style.display='none';i.classList.remove('rotate-180')}">
                        {{ $faq['q'] }}
                        <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300 text-sm"></i>
                    </button>
                    <div class="px-6 py-5 bg-white text-gray-600 text-[1.05rem] leading-relaxed border-t border-gray-100" style="display: none;">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
