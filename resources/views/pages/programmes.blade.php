@extends('layouts.public')

@section('title', 'Academic Programmes | ' . ($settings['hero_title'] ?? 'Department of Computer Science'))

@section('content')
<!-- Hero Section -->
<section style="background-color: #0f172a; padding: 5rem 0;" class="text-white relative overflow-hidden">
    <div style="position: absolute; top:0; left:0; width:100%; height:100%; z-index:0; opacity: 0.1">
        <svg fill="none" viewBox="0 0 100 100" preserveAspectRatio="none" style="width:100%; height:100%;">
            <path stroke="currentColor" stroke-width="0.5" d="M0,50 Q25,0 50,50 T100,50" />
            <path stroke="currentColor" stroke-width="0.5" d="M0,20 Q25,70 50,20 T100,20" />
        </svg>
    </div>
    <div class="container max-w-6xl mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $settings['page_programmes_title'] ?? 'Our Academic Programmes' }}</h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto text-slate-300">
            {{ $settings['page_programmes_subtitle'] ?? 'Discover our undergraduate and postgraduate degree programmes designed to prepare you for a successful career in computing.' }}
        </p>
    </div>
</section>

<!-- Content Section -->
<section style="background-color: #f8fafc; padding: 4rem 0;" class="py-16">
    <div class="container max-w-6xl mx-auto px-4">
        
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-bold text-slate-800 mb-4">{{ $settings['page_programmes_heading'] ?? 'Explore Our Programmes' }}</h2>
            <div style="width: 4rem; height: 0.25rem; background-color: #10b981; margin: 0 auto; border-radius: 999px;"></div>
            <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
                {{ $settings['page_programmes_intro'] ?? 'We offer a range of specialized degree programmes in computer science, software engineering, and information technology.' }}
            </p>
        </div>

        @php
            $fullTime = $programmes->filter(fn($p) => stripos($p->mode_of_study, 'part') === false);
            $partTime = $programmes->filter(fn($p) => stripos($p->mode_of_study, 'part') !== false);
        @endphp

        <!-- Full-Time Programmes -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center border-b pb-2"><i class="fas fa-sun text-amber-500 mr-3"></i> Full-Time Programmes (Including MSc and PhD)</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse($fullTime as $programme)
                    <!-- Copied Card Component -->
                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); overflow: hidden; transition: all 0.3s ease;" class="hover:shadow-lg flex flex-col group">
                        <div style="background-color: #f1f5f9; padding: 1.5rem; border-bottom: 1px solid #e2e8f0;" class="relative">
                            <div style="position: absolute; top: -1px; left: -1px; width: 0; height: 3px; background-color: #10b981; transition: width 0.3s ease;" class="group-hover:w-full"></div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $programme->name }}</h3>
                            <div class="flex flex-wrap gap-2 mt-3">
                                @if($programme->level)
                                <span style="background-color: #eaf7ef; color: #166534; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px;">{{ $programme->level }}</span>
                                @endif
                                @if($programme->duration)
                                <span style="background-color: #f1f5f9; color: #475569; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px; border: 1px solid #cbd5e1;"><i class="fas fa-clock mr-1"></i>{{ $programme->duration }}</span>
                                @endif
                                @if($programme->mode_of_study)
                                <span style="background-color: #f1f5f9; color: #475569; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px; border: 1px solid #cbd5e1;"><i class="fas fa-university mr-1"></i>{{ $programme->mode_of_study }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div style="padding: 1.5rem;" class="flex-grow flex flex-col">
                            @if($programme->description)
                                <p class="text-slate-600 mb-6 line-clamp-3">{{ Str::limit(strip_tags($programme->description), 150) }}</p>
                            @endif

                            <div class="mt-auto space-y-4">
                                @if($programme->objectives)
                                <div>
                                    <h4 style="color: #334155; font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;" class="flex items-center">
                                        <i class="fas fa-bullseye text-emerald-500 mr-2"></i> Focus Areas
                                    </h4>
                                    <div class="text-sm text-slate-600 line-clamp-2">
                                        {!! Str::limit(strip_tags($programme->objectives), 100) !!}
                                    </div>
                                </div>
                                @endif

                                <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                                    <a href="{{ route('programmes.show', $programme->slug) }}" style="color: #10b981; font-weight: 600; display: inline-flex; items: center; transition: color 0.2s;" class="hover:text-emerald-700">
                                        View Programme Details <i class="fas fa-arrow-right ml-2 mt-1"></i>
                                    </a>
                                    @if($programme->handbook_pdf)
                                    <a href="{{ Storage::url($programme->handbook_pdf) }}" target="_blank" style="color: #64748b; font-weight: 600; transition: color 0.2s;" class="hover:text-slate-900" title="Download Handbook">
                                        <i class="fas fa-file-pdf text-xl"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div style="background-color: #ffffff; border: 1px dashed #cbd5e1; border-radius: 0.75rem; padding: 3rem; text-align: center;">
                            <p class="text-slate-500">No Full-Time programmes available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Part-Time Programmes -->
        <div class="mt-16 mb-8">
            <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center border-b pb-2"><i class="fas fa-moon text-indigo-500 mr-3"></i> Part-Time Programmes (Including NSC)</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse($partTime as $programme)
                    <div style="background-color: #ffffff; border: 1px solid #e2e8f0; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); overflow: hidden; transition: all 0.3s ease;" class="hover:shadow-lg flex flex-col group border-t-4 border-t-indigo-500">
                        <div style="background-color: #f8fafc; padding: 1.5rem; border-bottom: 1px solid #e2e8f0;">
                            <h3 class="text-2xl font-bold text-slate-800 mb-2">{{ $programme->name }}</h3>
                            <div class="flex flex-wrap gap-2 mt-3">
                                @if($programme->level)
                                <span style="background-color: #eaf7ef; color: #166534; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px;">{{ $programme->level }}</span>
                                @endif
                                @if($programme->duration)
                                <span style="background-color: #f1f5f9; color: #475569; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px; border: 1px solid #cbd5e1;"><i class="fas fa-clock mr-1"></i>{{ $programme->duration }}</span>
                                @endif
                                <span style="background-color: #eef2ff; color: #3730a3; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px; border: 1px solid #c7d2fe;"><i class="fas fa-briefcase mr-1"></i>Part Time / Executive</span>
                            </div>
                        </div>
                        
                        <div style="padding: 1.5rem;" class="flex-grow flex flex-col">
                            @if($programme->description)
                                <p class="text-slate-600 mb-6 line-clamp-3">{{ Str::limit(strip_tags($programme->description), 150) }}</p>
                            @endif

                            <div class="mt-auto pt-4 border-t border-slate-100 flex justify-between items-center">
                                <a href="{{ route('programmes.show', $programme->slug) }}" style="color: #4f46e5; font-weight: 600; display: inline-flex; items: center; transition: color 0.2s;" class="hover:text-indigo-700">
                                    View Programme Details <i class="fas fa-arrow-right ml-2 mt-1"></i>
                                </a>
                                @if($programme->handbook_pdf)
                                <a href="{{ Storage::url($programme->handbook_pdf) }}" target="_blank" style="color: #64748b; font-weight: 600; transition: color 0.2s;" class="hover:text-slate-900" title="Download Handbook">
                                    <i class="fas fa-file-pdf text-xl"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div style="background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 0.75rem; padding: 3rem; text-align: center;">
                            <div style="background-color: #eef2ff; width: 4rem; height: 4rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                                <i class="fas fa-laptop-house text-2xl text-indigo-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-slate-800 mb-2">Part-Time Programmes</h3>
                            <p class="text-slate-500 max-w-md mx-auto">We are continually expanding our flexible learning options. Check back soon for our executive and part-time offerings (including MSc, PhD, and PGD setups)!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<!-- Call to Action -->
<section style="background-color: #0f172a; padding: 4rem 0;" class="text-white relative">
    <div class="container max-w-6xl mx-auto px-4 relative z-10 text-center">
        <h2 class="text-2xl font-bold mb-4">{{ $settings['page_programmes_cta_title'] ?? 'Ready to Begin Your Journey?' }}</h2>
        <p class="text-slate-300 max-w-2xl mx-auto mb-8">
            {{ $settings['page_programmes_cta_text'] ?? 'Explore the admission requirements and take the first step towards your career in computing.' }}
        </p>
        <a href="/admissions" style="background-color: #10b981; color: #ffffff; padding: 0.75rem 2rem; border-radius: 0.375rem; font-weight: 600; display: inline-block; transition: background-color 0.2s;" class="hover:bg-emerald-600">
            View Admission Requirements
        </a>
    </div>
</section>
@endsection
