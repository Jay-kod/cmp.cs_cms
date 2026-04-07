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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 font-heading flex items-center gap-3">
                    <i class="fa-solid fa-info-circle text-blue-600"></i> Scheme Overview
                </h2>
                <div class="prose max-w-none text-gray-700 text-lg leading-relaxed">
                    <p>{{ $s('siwes_overview', 'The Student Industrial Work Experience Scheme (SIWES) is a skills training program designed to expose students to the work environment and prepare them for reality after graduation. It bridges the gap between theory and practical work.') }}</p>
                </div>
            </div>

            <!-- Workflow Steps -->
            @php $steps = json_decode($s('siwes_steps', '[]'), true) ?? []; @endphp
            @if(count($steps) > 0)
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 mb-8" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 font-heading flex items-center gap-3">
                    <i class="fa-solid fa-route text-blue-600"></i> Process Workflow
                </h2>
                
                <div class="relative border-l-4 border-blue-100 ml-4 space-y-8 pb-4">
                    @foreach($steps as $index => $step)
                    <div class="relative pl-8">
                        <div class="absolute w-8 h-8 bg-blue-600 rounded-full text-white flex items-center justify-center font-bold text-sm border-4 border-white shadow shadow-blue-200" style="left: -18px; top: 0;">
                            {{ $index + 1 }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-gray-600">{{ $step['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- FAQs -->
            @php $faqs = json_decode($s('siwes_faqs', '[]'), true) ?? []; @endphp
            @if(count($faqs) > 0)
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100" data-aos="fade-up">
                <h2 class="text-2xl font-bold text-gray-900 border-b border-gray-100 pb-3 mb-6 font-heading flex items-center gap-3">
                    <i class="fa-solid fa-comments text-blue-600"></i> Frequently Asked Questions
                </h2>
                
                <div class="space-y-4">
                    @foreach($faqs as $index => $faq)
                    <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-300">
                        <button class="w-full text-left px-5 py-4 bg-gray-50 hover:bg-gray-100 font-bold text-gray-800 flex justify-between items-center transition"
                                onclick="const c = this.nextElementSibling; const i = this.querySelector('i'); if(c.style.display === 'none'){c.style.display='block';i.classList.add('rotate-180')}else{c.style.display='none';i.classList.remove('rotate-180')}">
                            {{ $faq['q'] }}
                            <i class="fa-solid fa-chevron-down text-gray-400 transition-transform duration-300 text-sm"></i>
                        </button>
                        <div class="px-5 py-4 bg-white text-gray-600 leading-relaxed border-t border-gray-100" style="display: none;">
                            {{ $faq['a'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Coordinator Info -->
            <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100" data-aos="fade-left">
                <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4 font-heading">
                    Departmental Coordinator
                </h3>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl shadow-inner">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">{{ $s('siwes_coordinator_name', 'Dr. Coordinator') }}</p>
                        <p class="text-sm text-gray-500">Coordinator (SIWES/IT)</p>
                    </div>
                </div>
                
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex gap-3">
                        <i class="fa-solid fa-envelope mt-1 text-blue-500"></i>
                        <div>
                            <span class="block font-semibold text-gray-900">Email</span>
                            <a href="mailto:{{ $s('siwes_coordinator_email') }}" class="text-blue-600 hover:underline">{{ $s('siwes_coordinator_email', 'siwes@department.edu.ng') }}</a>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <i class="fa-regular fa-clock mt-1 text-blue-500"></i>
                        <div>
                            <span class="block font-semibold text-gray-900">Consultation Hours</span>
                            {{ $s('siwes_coordinator_hours', 'Mon - Wed, 10am - 1pm') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Downloads & Resources -->
            <div class="bg-gradient-to-br from-blue-900 to-blue-800 p-6 rounded-2xl shadow-xl text-white relative overflow-hidden" data-aos="fade-left" data-aos-delay="100">
                <div class="absolute right-0 top-0 opacity-10 text-6xl transform translate-x-1/4 -translate-y-1/4">
                    <i class="fa-solid fa-folder-arrow-down"></i>
                </div>
                
                <h3 class="text-lg font-bold text-blue-50 border-b border-blue-700/50 pb-3 mb-4 font-heading relative z-10 flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Required Documents
                </h3>
                
                <ul class="space-y-3 relative z-10">
                    @if($downloads && $downloads->items->count() > 0)
                        @foreach($downloads->items as $doc)
                            <li>
                                <a href="{{ route('resources.index') }}?category={{ $downloads->id }}" class="flex items-center gap-3 p-3 bg-white/10 hover:bg-white/20 rounded-lg transition group">
                                    <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded-md flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <span class="block text-sm font-semibold text-white">{{ $doc->title }}</span>
                                    </div>
                                    <i class="fa-solid fa-arrow-down text-blue-300 group-hover:text-white transition-colors"></i>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <!-- Stub for when no resource items are uploaded yet -->
                        <li>
                            <div class="flex items-center gap-3 p-3 bg-white/5 rounded-lg border border-blue-700/30 text-blue-200 text-sm">
                                <i class="fa-solid fa-circle-info"></i> No documents uploaded yet. Please check the specific category in the Resource Catalog.
                            </div>
                        </li>
                    @endif
                </ul>
                <div class="mt-4 pt-3 border-t border-blue-700/50 text-center relative z-10">
                    <a href="{{ route('resources.index') }}" class="text-xs text-blue-200 hover:text-white font-bold inline-flex items-center gap-1 transition">
                        View All Department Resources <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
