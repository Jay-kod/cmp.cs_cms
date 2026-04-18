@extends('layouts.public')

@section('title', $subDept->name)

@section('content')

@php
// Helper to get system settings easily
$gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
@endphp

<!-- Section 1 — New Main Hero -->
<section class="relative bg-slate-900 py-24 pb-28 min-h-[45vh] flex items-center overflow-hidden">
    <!-- Background Texture/Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/campus-bg.jpg') }}" onerror="this.style.display='none'" class="w-full h-full object-cover opacity-25" alt="">
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900/95 to-slate-900/70"></div>
    </div>
    
    <div class="container relative z-10" data-aos="fade-right">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <ol class="list-none py-2 px-5 m-0 inline-flex items-center gap-2.5 text-[0.85rem] text-white/90 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
                <li><a href="{{ route('home') }}" class="text-white no-underline font-medium transition-colors duration-200 hover:text-emerald-500"><i class="fa-solid fa-house text-xs"></i> Home</a></li>
                <li class="opacity-60"><i class="fa-solid fa-chevron-right text-[0.6rem]"></i></li>
                <li><a href="{{ route('academics') }}" class="text-white no-underline font-medium transition-colors duration-200 hover:text-emerald-500">Academics</a></li>
                <li class="opacity-60"><i class="fa-solid fa-chevron-right text-[0.6rem]"></i></li>
                <li class="text-emerald-500 font-bold">{{ $subDept->name }}</li>
            </ol>
        </nav>
        
        <h1 class="text-[clamp(2.5rem,5vw,4.2rem)] font-black text-white mb-5 font-heading leading-[1.1] tracking-[-0.02em] text-balance max-w-[900px]">
            {{ $subDept->name }}
        </h1>
        
        <div class="w-20 h-1.5 bg-emerald-500 rounded-[3px] shadow-[0_2px_10px_rgba(16,185,129,0.5)]"></div>
    </div>
</section>

<!-- Section 2 — About the Sub-Department (#FFFFFF) -->
<section id="about" class="bg-white pb-24 relative">
    <!-- Overlapping the hero slightly -->
    <div class="container -mt-14 relative z-20">
        <div class="bg-white rounded-2xl shadow-[0_20px_40px_-10px_rgba(0,0,0,0.1)] border border-black/5 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.4fr] gap-0">
                
                <!-- Main Content -->
                <div data-aos="fade-up" class="p-12 lg:p-16">
                    <div class="inline-flex items-center gap-2 bg-[#EAF3DE] text-[#1E7A3E] text-sm font-bold uppercase tracking-[1.5px] py-1.5 px-4 rounded-full mb-6">
                        <i class="fa-solid fa-circle-info"></i> About Us
                    </div>
                    <h2 class="text-[2.2rem] font-extrabold text-slate-900 mb-6 font-heading leading-[1.2]">Pioneering Excellence</h2>
                    
                    <div class="text-slate-600 leading-[1.8] text-[1.1rem] text-pretty">
                        <p class="mb-6 text-[1.15rem] text-slate-700">
                            {{ $subDept->description ?: 'Discover your future with our specialized academic programmes, hands-on training, and world-class faculty.' }}
                        </p>
                        
                        @if($subDept->about_short)
                            {!! $subDept->about_short !!}
                        @endif
                    </div>
                    
                    <div class="flex gap-4 flex-wrap items-center mt-10">
                        <a href="#apply-now" class="bg-[#1E7A3E] text-white py-4 px-9 rounded-full font-bold no-underline text-[1.05rem] transition-all duration-300 shadow-[0_10px_20px_-5px_rgba(30,122,62,0.4)] inline-flex items-center gap-2 hover:-translate-y-[2px] hover:shadow-[0_15px_25px_-5px_rgba(30,122,62,0.5)]">
                            Apply Now <i class="fa-solid fa-arrow-right text-sm"></i>
                        </a>
                        <a href="#programmes" class="bg-slate-50 text-slate-900 py-4 px-9 rounded-full font-semibold text-[1.05rem] no-underline border border-slate-200 transition-all duration-300 hover:bg-slate-100 hover:border-slate-300">
                            Explore Programmes
                        </a>
                    </div>

                    @if($subDept->vision || $subDept->mission)
                    <div class="grid grid-cols-1 gap-6 mt-10">
                        @if($subDept->vision)
                        <div class="bg-slate-50 p-7 border-l-4 border-emerald-500 rounded-r-xl">
                            <h4 class="text-slate-900 font-extrabold mb-3 text-[1.2rem] flex items-center gap-2"><div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center"><i class="fa-solid fa-eye"></i></div> Vision</h4>
                            <p class="text-slate-600 m-0 text-base leading-[1.7]">{{ $subDept->vision }}</p>
                        </div>
                        @endif
                        
                        @if($subDept->mission)
                        <div class="bg-slate-50 p-7 border-l-4 border-blue-500 rounded-r-xl">
                            <h4 class="text-slate-900 font-extrabold mb-3 text-[1.2rem] flex items-center gap-2"><div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-bullseye"></i></div> Mission</h4>
                            <p class="text-slate-600 m-0 text-base leading-[1.7]">{{ $subDept->mission }}</p>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Quick Facts Sidebar -->
                <div data-aos="fade-left" data-aos-delay="100" class="bg-slate-50 border-l border-slate-200 p-12 lg:p-16">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-[0_4px_6px_rgba(0,0,0,0.05)] flex items-center justify-center text-[1.4rem] text-[#1E7A3E]">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h3 class="text-[1.5rem] font-extrabold text-slate-900 m-0">Quick Facts</h3>
                    </div>
                    
                    <ul class="list-none p-0 m-0 flex flex-col gap-5">
                        <li class="flex justify-between items-center bg-white py-4 px-5 rounded-xl border border-slate-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                            <div class="flex items-center gap-3 text-slate-500 font-semibold text-[0.95rem]">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center"><i class="fa-solid fa-calendar-alt"></i></div> 
                                Founded
                            </div>
                            <span class="font-bold text-slate-900 text-[1.05rem]">{{ $subDept->founded_year ?? 'N/A' }}</span>
                        </li>
                        <li class="flex justify-between items-center bg-white py-4 px-5 rounded-xl border border-slate-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                            <div class="flex items-center gap-3 text-slate-500 font-semibold text-[0.95rem]">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center"><i class="fa-solid fa-building"></i></div> 
                                Faculty
                            </div>
                            <span class="font-bold text-slate-900 text-[0.95rem] text-right">Natural &amp; Applied Sciences</span>
                        </li>
                        <li class="flex justify-between items-center bg-white py-4 px-5 rounded-xl border border-slate-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                            <div class="flex items-center gap-3 text-slate-500 font-semibold text-[0.95rem]">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-500 flex items-center justify-center"><i class="fa-solid fa-user-tie"></i></div> 
                                Head
                            </div>
                            <span class="font-extrabold text-emerald-500 text-[1.05rem]">{{ $subDept->hod_name ?? 'Vacant' }}</span>
                        </li>
                        <li class="flex justify-between items-center bg-white py-4 px-5 rounded-xl border border-slate-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                            <div class="flex items-center gap-3 text-slate-500 font-semibold text-[0.95rem]">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center"><i class="fa-solid fa-graduation-cap"></i></div> 
                                Programmes
                            </div>
                            <span class="font-bold text-slate-900 text-[1.05rem]">BSc · MSc · PhD</span>
                        </li>
                        <li class="flex justify-between items-center bg-white py-4 px-5 rounded-xl border border-slate-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                            <div class="flex items-center gap-3 text-slate-500 font-semibold text-[0.95rem]">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-500 flex items-center justify-center"><i class="fa-solid fa-check-circle"></i></div> 
                                Status
                            </div>
                            <span class="font-bold text-blue-500 text-[1.05rem]">Accredited (NUC)</span>
                        </li>
                        <li class="flex justify-between items-center bg-white py-4 px-5 rounded-xl border border-slate-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)]">
                            <div class="flex items-center gap-3 text-slate-500 font-semibold text-[0.95rem]">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center"><i class="fa-solid fa-map-marker-alt"></i></div> 
                                Location
                            </div>
                            <span class="font-bold text-slate-900 text-right text-[0.9rem]">NSUK Main Campus<br><span class="text-slate-500 font-medium">Keffi</span></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 3 — Programmes Offered (#F8FAFC) -->
<section class="bg-slate-50 py-24 border-t border-black/5">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block bg-emerald-700/10 text-emerald-700 font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px]">ACADEMICS</span>
            <h2 class="text-[2.5rem] font-extrabold text-slate-900 font-heading mb-4">Our Programmes</h2>
            <p class="text-slate-500 max-w-[600px] mx-auto text-[1.1rem] leading-[1.6]">Choose from our tailored academic pathways designed to build expertise and career readiness from undergraduate to doctorate levels.</p>
        </div>

        @if($programmes->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($programmes as $prog)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white rounded-2xl p-10 py-10 px-8 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.08)] border border-black/5 flex flex-col transition-all duration-300 relative overflow-hidden group hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.12)]">
                <!-- Top accent line -->
                <div class="absolute top-0 left-0 right-0 h-1 {{ strtolower($prog->level) == 'bsc' ? 'bg-blue-500' : (strtolower($prog->level) == 'msc' ? 'bg-emerald-500' : 'bg-amber-500') }}"></div>
                
                <div class="flex justify-between items-start mb-6">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center text-[1.5rem] {{ strtolower($prog->level) == 'bsc' ? 'bg-blue-500/10 text-blue-500' : (strtolower($prog->level) == 'msc' ? 'bg-emerald-500/10 text-emerald-500' : 'bg-amber-500/10 text-amber-500') }}">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="inline-block bg-slate-50 text-slate-600 py-1 px-3 rounded-full font-bold text-[0.75rem] tracking-[0.5px] border border-slate-200">
                        {{ strtoupper($prog->level) }}
                    </div>
                </div>
                
                <h3 class="text-[1.4rem] font-extrabold text-slate-900 mb-4 leading-[1.4]">{{ $prog->name }}</h3>
                
                <div class="flex flex-wrap gap-4 mb-6 text-slate-500 text-[0.9rem] font-semibold py-4 border-y border-dashed border-slate-200">
                    <span class="flex items-center gap-1.5"><i class="fa-regular fa-clock text-slate-400"></i> {{ $prog->duration }}</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-layer-group text-slate-400"></i> {{ $prog->mode_of_study }}</span>
                </div>
                
                <p class="text-slate-600 text-[0.95rem] leading-[1.6] mb-8 flex-grow">
                    {{ Str::limit(strip_tags($prog->description), 120, '...') }}
                </p>
                
                <a href="#prog-{{ $prog->slug }}" class="flex items-center justify-center gap-2 w-full p-3.5 bg-white text-slate-900 font-bold rounded-lg no-underline border-2 border-slate-200 transition-all duration-200 hover:bg-slate-50 hover:border-slate-300">
                    View Full Details <i class="fa-solid fa-arrow-down text-sm"></i>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center max-w-[600px] mx-auto py-16 px-8 bg-white rounded-2xl border border-dashed border-slate-300 shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05)]">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400 text-3xl">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h3 class="text-[1.3rem] font-bold text-slate-900 mb-2">No Programmes Added</h3>
            <p class="text-slate-500 text-base leading-[1.6]">Academic programmes for this department will be listed here once they are published.</p>
        </div>
        @endif
    </div>
</section>

<!-- Section 4 — Details Section -->
@foreach($programmes as $prog)
@php 
    $level = strtolower($prog->level);
    $bgStyle = $loop->iteration % 2 == 0 ? 'bg-[#EAF3DE]' : 'bg-white';
@endphp
<section id="prog-{{ $prog->slug }}" class="{{ $bgStyle }} py-20 border-t border-black/5">
    <div class="container" data-aos="fade-up">
        <div class="mb-12">
            <span class="inline-block bg-[#1E7A3E] text-white py-1px px-3 rounded text-[0.85rem] font-bold mb-4">{{ strtoupper($prog->level) }} PROGRAMME</span>
            <h2 class="text-[2.2rem] font-extrabold text-slate-900 font-heading mb-4">{{ $prog->name }} Details</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[1fr_2fr] gap-12">
            <!-- Left: Overview & Key Info -->
            <div class="bg-white rounded-xl p-8 shadow-[0_4px_15px_rgba(0,0,0,0.05)] self-start border border-slate-200">
                <h3 class="text-[1.25rem] font-bold text-slate-900 mb-6 border-b-2 border-slate-100 pb-3">Programme Overview</h3>
                
                <ul class="list-none p-0 m-0 flex flex-col gap-4">
                    <li class="flex flex-col gap-1">
                        <span class="text-slate-500 shadow-sm font-semibold uppercase text-[0.85rem]">Duration</span>
                        <span class="text-slate-900 font-medium">{{ $prog->duration }}</span>
                    </li>
                    <li class="flex flex-col gap-1">
                        <span class="text-slate-500 shadow-sm font-semibold uppercase text-[0.85rem]">Mode of Study</span>
                        <span class="text-slate-900 font-medium">{{ $prog->mode_of_study }}</span>
                    </li>
                </ul>

                @if($prog->handbook_pdf)
                <div class="mt-8">
                    <a href="{{ asset('storage/'.$prog->handbook_pdf) }}" target="_blank" class="flex items-center justify-center gap-2 w-full p-3 bg-emerald-700/10 text-[#1E7A3E] font-semibold rounded-lg no-underline border border-dashed border-[#1E7A3E]/30 transition-colors duration-200 hover:bg-emerald-700/15">
                        <i class="fa-solid fa-file-pdf"></i> Download Handbook
                    </a>
                </div>
                @endif
            </div>

            <!-- Right: Content -->
            <div>
                <div class="bg-white rounded-xl p-8 shadow-[0_4px_15px_rgba(0,0,0,0.05)] border border-slate-200 mb-8">
                    <h3 class="text-[1.4rem] font-bold text-slate-900 mb-6"><i class="fa-solid fa-clipboard-list text-emerald-600 mr-2"></i> Description</h3>
                    <div class="text-slate-600 leading-[1.8] text-[1.05rem]">
                        {!! $prog->description !!}
                    </div>
                </div>
                
                @if($prog->requirements_utme || $prog->requirements_de)
                <div class="bg-white rounded-xl p-8 shadow-[0_4px_15px_rgba(0,0,0,0.05)] border border-slate-200 mb-8">
                    <h3 class="text-[1.4rem] font-bold text-slate-900 mb-6"><i class="fa-solid fa-clipboard-check text-emerald-600 mr-2"></i> Entry Requirements</h3>
                    
                    @if($prog->requirements_utme && $prog->level == 'bsc')
                    <div class="mb-6">
                        <h4 class="font-semibold text-slate-800 mb-2">UTME / O'Level Requirements</h4>
                        <div class="text-slate-600 leading-[1.8]">
                            {!! $prog->requirements_utme !!}
                        </div>
                    </div>
                    @else
                    <div class="mb-6">
                        <div class="text-slate-600 leading-[1.8]">
                            {!! $prog->requirements_utme !!}
                        </div>
                    </div>
                    @endif

                    @if($prog->requirements_de && $prog->level == 'bsc')
                    <div>
                        <h4 class="font-semibold text-slate-800 mb-2 border-t border-dashed border-slate-200 pt-6">Direct Entry (DE) Requirements</h4>
                        <div class="text-slate-600 leading-[1.8]">
                            {!! $prog->requirements_de !!}
                        </div>
                    </div>
                    @endif
                </div>
                @endif
                
                <div class="bg-white rounded-xl p-8 shadow-[0_4px_15px_rgba(0,0,0,0.05)] border border-slate-200 mb-8">
                    <h3 class="text-[1.4rem] font-bold text-slate-900 mb-6"><i class="fa-solid fa-share-square text-emerald-600 mr-2"></i> How to Apply</h3>
                    
                    <div class="text-slate-600 leading-[1.8] text-[1.05rem]">
                       @if($prog->level == 'bsc')
                           <p>Prospective candidates should apply via JAMB and select NSUK as their first choice institution. Detailed steps involve Post-UTME screening as defined by the University guidelines.</p>
                       @else
                           <p>Postgraduate applications are managed via the PG School. Detailed application process will be provided on the <a href="https://spgs.nsuk.edu.ng" target="_blank" class="text-[#1E7A3E]">NSUK SPGS Portal</a>.</p>
                       @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endforeach

<!-- Section 7 — Career Paths (#F8FAFC) -->
<section class="bg-slate-50 py-24 border-t border-black/5">
    <div class="container" data-aos="fade-up">
        <div class="flex flex-col items-center text-center mb-16">
            <span class="inline-block bg-blue-500/10 text-blue-500 font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px]">OPPORTUNITIES</span>
            <h2 class="text-[2.5rem] font-extrabold text-slate-900 font-heading mb-4">Career Pathways</h2>
            <p class="text-slate-500 max-w-[600px] text-[1.1rem] leading-[1.6]">Explore the diverse and promising roles, industries, and pathways available to our high-achieving graduates.</p>
        </div>
        
        <div class="bg-white rounded-2xl p-12 py-14 px-12 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] border border-black/5 relative overflow-hidden max-w-[900px] mx-auto">
            <!-- Decorative background element -->
            <div class="absolute -top-12 -right-12 w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(59,130,246,0.08)_0%,transparent_70%)] rounded-full pointer-events-none"></div>
            
            <div class="flex items-start gap-6">
                <div class="w-[50px] h-[50px] min-w-[50px] bg-blue-500/10 rounded-xl flex items-center justify-center text-[1.4rem] text-blue-500">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; color: #1e293b; margin-bottom: 0.8rem;">Dynamic Career Profiles</h3>
                    <p style="color: #475569; font-size: 1.05rem; line-height: 1.7; margin: 0;">
                        Information on career paths specific to this department is highly dynamic. Check back as we continuously update the profiles and global success stories of our alumni making an impact in their respective fields.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 8 — Staff in This Unit (#FFFFFF) -->
<section class="bg-white py-24 border-t border-black/5">
    <div class="container" data-aos="fade-up">
        <div class="flex flex-col items-center text-center mb-16">
            <span class="inline-block bg-emerald-500/10 text-emerald-500 font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px]">FACULTY</span>
            <h2 class="text-[2.5rem] font-extrabold text-slate-900 font-heading mb-4">Meet Our Team</h2>
            <p class="text-slate-500 max-w-[600px] text-[1.1rem] leading-[1.6]">A dedicated collective of faculty and staff members guiding the next generation of industry professionals.</p>
        </div>

        @if($staff->count() > 0)
        <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-10">
            @foreach($staff as $member)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white rounded-2xl overflow-hidden shadow-[0_10px_30px_-10px_rgba(0,0,0,0.08)] border border-black/5 transition-all duration-300 flex flex-col relative group hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.12)]">
                <div class="h-[260px] bg-slate-50 overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent z-10 pointer-events-none"></div>
                    <img src="{{ $member->photo ? asset('storage/'.$member->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $member->name }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105" onerror="this.src='{{ asset('images/avatar-placeholder.png') }}'">
                </div>
                <div class="p-8 pb-6 flex-grow flex flex-col relative z-20 bg-white">
                    <div class="mb-auto">
                        <h3 class="text-[1.25rem] font-extrabold text-slate-900 mb-1.5 leading-[1.3]">{{ $member->title }} {{ $member->name }}</h3>
                        <div class="inline-block bg-[#EAF3DE] text-[#1E7A3E] text-[0.75rem] font-bold py-1 px-3 rounded-full mb-4">
                            {{ $member->role }}
                        </div>
                        <p class="text-slate-500 text-[0.95rem] mb-6 flex items-start gap-2">
                            <i class="fa-solid fa-book-open text-slate-400 mt-1"></i>
                            <span>{{ $member->specialisation ?: 'Core Faculty Member & Instructor' }}</span>
                        </p>
                    </div>
                    <a href="{{ route('people.show', $member->slug) }}" class="flex items-center justify-center gap-2 w-full p-3 bg-slate-50 text-slate-900 font-semibold rounded-lg no-underline border border-slate-200 transition-all duration-200 hover:bg-[#1E7A3E] hover:border-[#1E7A3E] hover:text-white">
                        View Profile <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center max-w-[600px] mx-auto py-16 px-8 bg-white rounded-2xl border border-dashed border-slate-300 shadow-[0_10px_25px_-5px_rgba(0,0,0,0.05)]">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400 text-3xl">
                <i class="fa-solid fa-users-slash"></i>
            </div>
            <h3 class="text-[1.3rem] font-bold text-slate-900 mb-2">No Staff Listed Yet</h3>
            <p class="text-slate-500 text-base leading-[1.6]">Key faculty and administrative staff members for this department will be listed here soon.</p>
        </div>
        @endif
    </div>
</section>

<!-- Section 9 — Frequently Asked Questions (#F8FAFC) -->
<section class="bg-slate-50 py-24 border-t border-black/5">
    <div class="container" data-aos="fade-up">
        <div class="flex flex-col items-center text-center mb-16">
            <span class="inline-block bg-amber-500/10 text-amber-500 font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px]">SUPPORT</span>
            <h2 class="text-[2.5rem] font-extrabold text-slate-900 font-heading mb-4">Frequently Asked Questions</h2>
            <p class="text-slate-500 max-w-[600px] text-[1.1rem] leading-[1.6]">Find quick answers regarding admissions, campus life, and academic requirements.</p>
        </div>
        
        <div class="max-w-[800px] mx-auto bg-white rounded-2xl p-12 py-14 px-12 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] border border-black/5 relative overflow-hidden">
            <div class="absolute -bottom-12 -left-12 w-[150px] h-[150px] bg-[radial-gradient(circle,rgba(245,158,11,0.08)_0%,transparent_70%)] rounded-full pointer-events-none"></div>
            
            <div class="flex items-start gap-6">
                <div class="w-[50px] h-[50px] min-w-[50px] bg-amber-500/10 rounded-xl flex items-center justify-center text-[1.4rem] text-amber-500">
                    <i class="fa-regular fa-comments"></i>
                </div>
                <div>
                    <h3 class="text-[1.3rem] font-bold text-slate-800 mb-3">Updates in Progress</h3>
                    <p class="text-slate-600 text-[1.05rem] leading-[1.7] m-0">
                         Specific FAQs relating to the {{ $subDept->name }} are continually being compiled and updated by our academic advisors. If you have immediate questions, please utilize the contact options below.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 10 — Apply Now CTA (#1E7A3E) -->
<section id="apply-now" class="bg-gradient-to-br from-[#1E7A3E] to-[#115e3b] text-white py-[6.5rem] text-center relative overflow-hidden">
    <!-- Background graphical elements -->
    <div class="absolute inset-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg_width=\'60\'_height=\'60\'_viewBox=\'0_0_60_60\'_xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg_fill=\'none\'_fill-rule=\'evenodd\'%3E%3Cg_fill=\'%23ffffff\'_fill-opacity=\'0.03\'%3E%3Cpath_d=\'M36_34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6_34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6_4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] pointer-events-none"></div>
    
    <div class="container relative z-10" data-aos="zoom-in">
        <h2 class="text-[2.8rem] font-black mb-6 font-heading [text-wrap:balance]">Ready to Shape Your Future?</h2>
        <p class="text-[1.25rem] text-white/85 mb-14 max-w-[650px] mx-auto leading-[1.6] [text-wrap:pretty]">Take the first decisive step towards a highly rewarding career. Join the {{ $subDept->name }} today.</p>
        
        <div class="flex flex-wrap gap-[1.2rem] justify-center">
            <a href="https://jamb.gov.ng" target="_blank" class="bg-white text-[#1E7A3E] py-[1.1rem] px-[2.2rem] rounded-full font-extrabold text-[1.05rem] no-underline transition-all duration-300 shadow-[0_10px_25px_-5px_rgba(0,0,0,0.3)] inline-flex items-center gap-2 hover:-translate-y-[3px] hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.4)]">
                Apply for BSc (JAMB) <i class="fa-solid fa-external-link-alt text-sm"></i>
            </a>
            
            <a href="https://spgs.nsuk.edu.ng" target="_blank" class="bg-black/20 border-2 border-white/20 text-white py-[1.1rem] px-[2.2rem] rounded-full font-bold text-[1.05rem] no-underline backdrop-blur-[5px] transition-all duration-300 inline-flex items-center gap-2 hover:bg-white/15 hover:border-white/40">
                Apply for MSc/PhD <i class="fa-solid fa-external-link-alt text-sm"></i>
            </a>
        </div>
        
        <div class="mt-12">
             <a href="{{ route('contact') }}" class="text-white/70 font-semibold no-underline border-b border-dotted border-white/40 pb-[2px] transition-all duration-200 hover:text-white hover:border-white">
                Need help? Contact Admissions
             </a>
        </div>
    </div>
</section>

@endsection