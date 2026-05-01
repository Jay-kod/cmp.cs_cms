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
              <div class="grid grid-cols-1 gap-0">
                
                <!-- Main Content -->
                <div data-aos="fade-up" class="p-5 md:p-10 lg:p-16">
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
                    <!-- ═══ Vision & Mission Premium Cards ═══ -->
                    <div class="mt-10 mb-2">
                        <div class="flex items-center gap-2.5 mb-5">
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-green-600 text-white flex items-center justify-center text-[0.9rem] shadow-[0_4px_12px_-2px_rgba(16,185,129,0.4)]">
                                <i class="fa-solid fa-compass"></i>
                            </div>
                            <h3 class="text-[1.25rem] font-extrabold text-slate-900 m-0 font-heading tracking-tight">Vision & Mission</h3>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            @if($subDept->vision)
                            <!-- Vision Card — Dark Slate -->
                            <div class="subdept-vm-card group relative bg-slate-900 rounded-2xl p-6 sm:p-7 overflow-hidden shadow-[0_12px_30px_-8px_rgba(15,23,42,0.5)] border border-slate-800 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_-10px_rgba(15,23,42,0.6)]" data-aos="fade-up">
                                <!-- Gradient overlay -->
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/8 via-transparent to-blue-500/5 pointer-events-none"></div>
                                <!-- Animated orb -->
                                <div class="absolute -top-12 -right-12 w-36 h-36 bg-emerald-500/10 rounded-full blur-[50px] transition-all duration-700 group-hover:bg-emerald-400/20 group-hover:scale-125 pointer-events-none"></div>
                                <!-- Watermark icon -->
                                <div class="absolute right-2 bottom-[-8px] text-[5.5rem] text-white/[0.04] pointer-events-none transition-all duration-700 group-hover:text-white/[0.07] group-hover:scale-110 group-hover:-rotate-6">
                                    <i class="fa-solid fa-eye"></i>
                                </div>

                                <div class="relative z-10">
                                    <!-- Heading row: icon + title on same line -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 shrink-0 bg-emerald-500/15 backdrop-blur-sm rounded-xl flex items-center justify-center text-emerald-400 text-[1rem] border border-emerald-500/20 shadow-[0_0_15px_rgba(16,185,129,0.15)] transition-transform duration-500 group-hover:scale-110 group-hover:rotate-[-5deg]">
                                            <i class="fa-solid fa-eye"></i>
                                        </div>
                                        <h4 class="text-[1.25rem] sm:text-[1.35rem] text-white font-heading font-extrabold tracking-tight m-0">Our Vision</h4>
                                    </div>

                                    <!-- Body -->
                                    <p class="text-slate-300 text-[0.95rem] leading-[1.75] m-0 font-normal">{{ $subDept->vision }}</p>
                                </div>
                            </div>
                            @endif

                            @if($subDept->mission)
                            <!-- Mission Card — Green Gradient -->
                            <div class="subdept-vm-card group relative bg-gradient-to-br from-emerald-600 to-green-700 rounded-2xl p-6 sm:p-7 overflow-hidden shadow-[0_12px_30px_-8px_rgba(22,163,74,0.45)] border border-emerald-500/40 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_-10px_rgba(22,163,74,0.55)]" data-aos="fade-up" data-aos-delay="100">
                                <!-- Gradient overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent pointer-events-none"></div>
                                <!-- Animated orb -->
                                <div class="absolute -bottom-12 -left-12 w-36 h-36 bg-white/10 rounded-full blur-[50px] transition-all duration-700 group-hover:bg-white/15 group-hover:scale-125 pointer-events-none"></div>
                                <!-- Watermark icon -->
                                <div class="absolute right-2 bottom-[-6px] text-[5rem] text-white/[0.08] pointer-events-none transition-all duration-700 group-hover:text-white/[0.13] group-hover:scale-110 group-hover:rotate-6">
                                    <i class="fa-solid fa-rocket"></i>
                                </div>

                                <div class="relative z-10">
                                    <!-- Heading row: icon + title on same line -->
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 shrink-0 bg-white/15 backdrop-blur-sm rounded-xl flex items-center justify-center text-white text-[1rem] border border-white/20 shadow-[0_0_15px_rgba(255,255,255,0.1)] transition-transform duration-500 group-hover:scale-110 group-hover:rotate-[-5deg]">
                                            <i class="fa-solid fa-bullseye"></i>
                                        </div>
                                        <h4 class="text-[1.25rem] sm:text-[1.35rem] text-white font-heading font-extrabold tracking-tight m-0">Our Mission</h4>
                                    </div>

                                    <!-- Body -->
                                    <p class="text-green-50 text-[0.95rem] leading-[1.75] m-0 font-medium">{{ $subDept->mission }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 2.5 — Quick Facts (Independent Section) -->
<section class="bg-[#0f172a] py-20 border-t border-black/5 relative overflow-hidden">
    <!-- Decorative transparent pattern -->
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#10b981 1px, transparent 1px); background-size: 30px 30px;"></div>
    <!-- Accent glow -->
    <div class="absolute top-0 right-1/4 w-[300px] h-[300px] bg-emerald-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/4 w-[300px] h-[300px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container relative z-10" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block bg-slate-800 text-emerald-400 font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px] uppercase border border-slate-700 shadow-sm">Fast Facts</span>
            <h2 class="text-[2.5rem] font-extrabold text-white font-heading mb-4">Department at a Glance</h2>
            <p class="text-slate-400 max-w-[600px] mx-auto text-[1.1rem]">Key highlights and essential metrics that define our dynamic academic community and infrastructure.</p>
        </div>
        
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-5">
            <!-- Metric 1: Founded & Accreditation -->
            <div class="bg-slate-800/80 backdrop-blur-sm p-4 sm:p-7 rounded-2xl border border-slate-700/80 text-center hover:-translate-y-2 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.5)] hover:border-emerald-500/30 transition-all duration-300 group flex flex-col justify-center">
                <div class="w-14 h-14 mx-auto bg-slate-800 text-emerald-400 rounded-full flex items-center justify-center text-[1.35rem] shadow-inner mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-emerald-400/10 ring-1 ring-white/5">
                    <i class="fa-solid fa-calendar-alt"></i>
                </div>
                <div class="font-black text-white text-2xl mb-1">{{ $subDept->founded_year ?? 'N/A' }}</div>
                <div class="text-emerald-400/80 font-bold text-[0.7rem] mb-2 uppercase tracking-widest">NUC Accredited</div>
                <h4 class="text-slate-400 font-semibold text-[0.85rem] uppercase tracking-wider mt-auto">Founded</h4>
            </div>

            <!-- Metric 2: Faculty -->
            <div class="bg-slate-800/80 backdrop-blur-sm p-4 sm:p-7 rounded-2xl border border-slate-700/80 text-center hover:-translate-y-2 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.5)] hover:border-blue-500/30 transition-all duration-300 group flex flex-col justify-center">
                <div class="w-14 h-14 mx-auto bg-slate-800 text-blue-400 rounded-full flex items-center justify-center text-[1.35rem] shadow-inner mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-blue-400/10 ring-1 ring-white/5">
                    <i class="fa-regular fa-building"></i>
                </div>
                <div class="font-bold text-white text-[1.05rem] leading-tight mb-2">Natural &amp; Applied<br>Sciences</div>
                <h4 class="text-slate-400 font-semibold text-[0.85rem] uppercase tracking-wider mt-auto">Faculty</h4>
            </div>

            <!-- Metric 3: Number of Programmes -->
            <div class="bg-slate-800/80 backdrop-blur-sm p-4 sm:p-7 rounded-2xl border border-slate-700/80 text-center hover:-translate-y-2 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.5)] hover:border-purple-500/30 transition-all duration-300 group flex flex-col justify-center">
                <div class="w-14 h-14 mx-auto bg-slate-800 text-purple-400 rounded-full flex items-center justify-center text-[1.35rem] shadow-inner mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-purple-400/10 ring-1 ring-white/5">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="font-black text-white text-3xl mb-1.5">{{ $programmeCount }}</div>
                <h4 class="text-slate-400 font-semibold text-[0.85rem] uppercase tracking-wider">Programmes</h4>
            </div>

            <!-- Metric 4: Number of Courses -->
            <div class="bg-slate-800/80 backdrop-blur-sm p-4 sm:p-7 rounded-2xl border border-slate-700/80 text-center hover:-translate-y-2 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.5)] hover:border-amber-500/30 transition-all duration-300 group flex flex-col justify-center">
                <div class="w-14 h-14 mx-auto bg-slate-800 text-amber-400 rounded-full flex items-center justify-center text-[1.35rem] shadow-inner mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-amber-400/10 ring-1 ring-white/5">
                    <i class="fa-solid fa-book-open"></i>
                </div>
                <div class="font-black text-white text-3xl mb-1.5">{{ $courseCount }}</div>
                <h4 class="text-slate-400 font-semibold text-[0.85rem] uppercase tracking-wider">Courses</h4>
            </div>

            <!-- Metric 5: Number of Lecturers -->
            <div class="bg-slate-800/80 backdrop-blur-sm p-4 sm:p-7 rounded-2xl border border-slate-700/80 text-center hover:-translate-y-2 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.5)] hover:border-cyan-500/30 transition-all duration-300 group flex flex-col justify-center">
                <div class="w-14 h-14 mx-auto bg-slate-800 text-cyan-400 rounded-full flex items-center justify-center text-[1.35rem] shadow-inner mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-cyan-400/10 ring-1 ring-white/5">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div class="font-black text-white text-3xl mb-1.5">{{ $lecturerCount }}</div>
                <h4 class="text-slate-400 font-semibold text-[0.85rem] uppercase tracking-wider">Lecturers</h4>
            </div>

            <!-- Metric 6: Number of Students -->
            <div class="bg-slate-800/80 backdrop-blur-sm p-4 sm:p-7 rounded-2xl border border-slate-700/80 text-center hover:-translate-y-2 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.5)] hover:border-rose-500/30 transition-all duration-300 group flex flex-col justify-center">
                <div class="w-14 h-14 mx-auto bg-slate-800 text-rose-400 rounded-full flex items-center justify-center text-[1.35rem] shadow-inner mb-4 group-hover:scale-110 transition-transform duration-300 group-hover:bg-rose-400/10 ring-1 ring-white/5">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="font-black text-white text-3xl mb-1.5">{{ $studentCount }}</div>
                <h4 class="text-slate-400 font-semibold text-[0.85rem] uppercase tracking-wider">Students</h4>
            </div>
        </div>
    </div>
</section>

<!-- Section 3 — Programmes Offered (#F8FAFC) -->
<section class="bg-slate-50 py-24 border-t border-black/5">
    <div class="container mx-auto max-w-[1240px]" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block bg-[#1E7A3E]/10 text-[#1E7A3E] font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px] uppercase">Academics</span>
            <h2 class="text-[2.5rem] font-extrabold text-slate-900 font-heading mb-4">Our Programmes</h2>
            <p class="text-slate-500 max-w-[600px] mx-auto text-[1.1rem] leading-[1.6]">Choose from our tailored academic pathways designed to build expertise and career readiness from undergraduate to doctorate levels.</p>
        </div>

        @if($programmes->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @foreach($programmes as $prog)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white rounded-[1.5rem] p-5 sm:p-8 shadow-[0_5px_20px_-5px_rgba(0,0,0,0.05)] border border-slate-100 flex flex-col transition-all duration-300 relative overflow-hidden group hover:-translate-y-2 hover:shadow-[0_20px_40px_-10px_rgba(0,0,0,0.08)]">
                <!-- Top accent line -->
                <div class="absolute top-0 left-0 right-0 h-2.5 transition-all duration-300 {{ strtolower($prog->level) == 'bsc' ? 'bg-blue-500' : (strtolower($prog->level) == 'msc' ? 'bg-emerald-500' : 'bg-[#f59e0b]') }}"></div>
                
                <div class="flex justify-between items-start mb-7 mt-2 relative z-10 w-full">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-[1.45rem] transition-transform duration-500 group-hover:scale-110 group-hover:shadow-sm {{ strtolower($prog->level) == 'bsc' ? 'bg-blue-50 text-blue-600' : (strtolower($prog->level) == 'msc' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600') }}">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div class="inline-flex items-center bg-slate-50 text-slate-500 py-1.5 px-4 rounded-full font-bold text-[0.75rem] uppercase tracking-wider border border-slate-100/60 shadow-sm transition-colors duration-300 {{ strtolower($prog->level) == 'bsc' ? 'group-hover:bg-blue-50 group-hover:text-blue-700 group-hover:border-blue-100' : (strtolower($prog->level) == 'msc' ? 'group-hover:bg-emerald-50 group-hover:text-emerald-700 group-hover:border-emerald-100' : 'group-hover:bg-amber-50 group-hover:text-amber-700 group-hover:border-amber-100') }}">
                        {{ $prog->level }}
                    </div>
                </div>
                
                <h3 class="text-[1.35rem] font-bold text-slate-900 mb-5 leading-[1.3] transition-colors duration-300 {{ strtolower($prog->level) == 'bsc' ? 'group-hover:text-blue-600' : (strtolower($prog->level) == 'msc' ? 'group-hover:text-emerald-600' : 'group-hover:text-amber-600') }}">{{ $prog->name }}</h3>
                
                <!-- Modern info layout replacing dashed box -->
                <div class="flex flex-col gap-3 mb-6 p-4 rounded-xl bg-slate-50/80 border border-slate-100/80 transition-colors duration-300 {{ strtolower($prog->level) == 'bsc' ? 'group-hover:bg-blue-50/30 group-hover:border-blue-100/50' : (strtolower($prog->level) == 'msc' ? 'group-hover:bg-emerald-50/30 group-hover:border-emerald-100/50' : 'group-hover:bg-amber-50/30 group-hover:border-amber-100/50') }}">
                    <div class="flex items-center gap-3.5">
                        <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                            <i class="fa-regular fa-clock text-slate-400 text-[0.95rem]"></i> 
                        </div>
                        <span class="text-slate-700 text-[0.95rem] font-bold">{{ $prog->duration ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center gap-3.5">
                        <div class="w-8 h-8 rounded-lg bg-white shadow-sm border border-slate-100 flex items-center justify-center">
                            <i class="fa-solid fa-layer-group text-slate-400 text-[0.95rem]"></i> 
                        </div>
                        <span class="text-slate-700 text-[0.95rem] font-bold">{{ $prog->mode_of_study ?? 'N/A' }}</span>
                    </div>
                </div>
                
                <p class="text-slate-500 text-[0.95rem] leading-relaxed mb-8 flex-grow">
                    {{ Str::limit(preg_replace('/\s+/', ' ', strip_tags(html_entity_decode($prog->description))), 100, '...') }}
                </p>
                
                <!-- Premium Color-Matched Button -->
                <a href="{{ route('programmes.show', $prog->slug) }}" class="mt-auto group/btn flex items-center justify-center gap-2 w-full py-[0.85rem] font-bold rounded-xl no-underline transition-all duration-300 {{ strtolower($prog->level) == 'bsc' ? 'bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white hover:shadow-[0_8px_15px_-3px_rgba(37,99,235,0.3)]' : (strtolower($prog->level) == 'msc' ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white hover:shadow-[0_8px_15px_-3px_rgba(16,185,129,0.3)]' : 'bg-amber-50 text-amber-700 hover:bg-[#f59e0b] hover:text-white hover:shadow-[0_8px_15px_-3px_rgba(245,158,11,0.3)]') }}">
                    View Details <i class="fa-solid fa-arrow-right-long text-[0.8rem] ml-1 transition-transform duration-300 group-hover/btn:translate-x-1.5 group-hover/btn:bg-white/20 group-hover/btn:px-1.5 group-hover/btn:py-0.5 group-hover/btn:rounded-md"></i>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="mt-14 text-center">
            <a href="{{ route('page.show', 'programmes') }}" class="inline-flex items-center gap-2 bg-[#1E7A3E] text-white py-[0.95rem] px-8 rounded-full font-bold text-[1.05rem] transition-all duration-300 shadow-[0_4px_15px_rgba(30,122,62,0.2)] hover:bg-[#115e3b] hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(30,122,62,0.3)] no-underline">
                View All Programmes <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
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
<!-- Section 7 — Career Paths (#F8FAFC) -->
<section class="bg-white py-24 border-t border-black/5 relative overflow-hidden">
    <!-- Abstract Background Elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50/60 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-50/60 rounded-full blur-[100px] translate-y-1/2 -translate-x-1/3 pointer-events-none"></div>

    <div class="container relative z-10">
        <div class="flex flex-col items-center text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 font-bold text-[0.85rem] py-1.5 px-5 rounded-full mb-4 tracking-[1px] uppercase border border-blue-100/50 shadow-sm">
                <i class="fa-solid fa-rocket"></i> OPPORTUNITIES
            </span>
            <h2 class="text-[2.5rem] font-extrabold text-slate-900 font-heading mb-4">Career Pathways</h2>
            <p class="text-slate-500 max-w-[600px] text-[1.1rem] leading-[1.6]">Explore the diverse and promising roles, industries, and pathways available to our high-achieving graduates.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 max-w-[1100px] mx-auto">
            <!-- Left: Hero Card -->
            <div data-aos="fade-right" class="lg:col-span-5 bg-slate-900 rounded-[2rem] p-6 md:p-10 relative overflow-hidden text-white flex flex-col justify-between group shadow-xl">
                <!-- Background Image & Gradient -->
                <div class="absolute inset-0 bg-slate-800 opacity-50 bg-[url('https://www.transparenttextures.com/patterns/micro-carbon.png')] pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-900/95 to-slate-800/80"></div>
                <!-- Glowing Orb inside the card -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500/30 rounded-full blur-[50px] transition-all duration-500 group-hover:bg-blue-400/40"></div>
                
                <div class="relative z-10 mb-12">
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-blue-400 text-[1.4rem] border border-white/10 mb-8 shadow-inner group-hover:scale-110 transition-transform duration-500">
                        <i class="fa-solid fa-earth-americas"></i>
                    </div>
                    <h3 class="text-[2rem] font-black leading-[1.1] mb-5 tracking-tight">High Global<br>Demand</h3>
                    <p class="text-slate-300 text-[1.05rem] leading-[1.7]">
                        Our distinctive curriculum aligns perfectly with global industry standards, positioning our alumni at the forefront of innovation across high-value tech sectors.
                    </p>
                </div>
                
                <!-- Mini Stats / "Endorsements" Footer -->
                <div class="relative z-10 flex items-center gap-4 pt-6 border-t border-white/10">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-white flex items-center justify-center text-[0.6rem] font-black text-slate-800 shadow-sm z-30"><i class="fa-brands fa-microsoft"></i></div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-white flex items-center justify-center text-[0.6rem] font-black text-slate-800 shadow-sm z-20"><i class="fa-brands fa-google"></i></div>
                        <div class="w-10 h-10 rounded-full border-2 border-slate-900 bg-white flex items-center justify-center text-[0.6rem] font-black text-slate-800 shadow-sm z-10"><i class="fa-brands fa-aws"></i></div>
                    </div>
                    <div class="text-sm font-semibold text-slate-400">
                        Top destination networks
                    </div>
                </div>
            </div>

            <!-- Right: Roles Bento Grid -->
            <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4 h-full">
                <!-- Pathway 1 -->
                <div data-aos="fade-up" data-aos-delay="100" class="bg-slate-50 hover:bg-white p-5 sm:p-7 lg:p-8 rounded-[1.5rem] border border-slate-100 hover:border-blue-100 transition-all duration-300 hover:shadow-[0_15px_30px_-5px_rgba(37,99,235,0.08)] group flex flex-col justify-start">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center text-blue-600 text-[1.2rem] mb-5 group-hover:scale-110 transition-transform duration-300 group-hover:bg-blue-50">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <h4 class="text-[1.2rem] font-bold text-slate-900 mb-2">Tech & Engineering</h4>
                    <p class="text-slate-500 text-[0.95rem] leading-relaxed">Software Engineers, System Architects, Full-stack Devs, Cloud Engineers.</p>
                </div>
                
                <!-- Pathway 2 -->
                <div data-aos="fade-up" data-aos-delay="200" class="bg-slate-50 hover:bg-white p-5 sm:p-7 lg:p-8 rounded-[1.5rem] border border-slate-100 hover:border-emerald-100 transition-all duration-300 hover:shadow-[0_15px_30px_-5px_rgba(16,185,129,0.08)] group flex flex-col justify-start">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center text-emerald-600 text-[1.2rem] mb-5 group-hover:scale-110 transition-transform duration-300 group-hover:bg-emerald-50">
                        <i class="fa-solid fa-network-wired"></i>
                    </div>
                    <h4 class="text-[1.2rem] font-bold text-slate-900 mb-2">Data & AI</h4>
                    <p class="text-slate-500 text-[0.95rem] leading-relaxed">Data Scientists, Machine Learning Engineers, Quant Analysts, AI Researchers.</p>
                </div>
                
                <!-- Pathway 3 -->
                <div data-aos="fade-up" data-aos-delay="300" class="bg-slate-50 hover:bg-white p-5 sm:p-7 lg:p-8 rounded-[1.5rem] border border-slate-100 hover:border-amber-100 transition-all duration-300 hover:shadow-[0_15px_30px_-5px_rgba(245,158,11,0.08)] group flex flex-col justify-start">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center text-amber-600 text-[1.2rem] mb-5 group-hover:scale-110 transition-transform duration-300 group-hover:bg-amber-50">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="text-[1.2rem] font-bold text-slate-900 mb-2">Cybersecurity</h4>
                    <p class="text-slate-500 text-[0.95rem] leading-relaxed">Security Analysts, Pentesters, IT Compliance Officers, Forensic Experts.</p>
                </div>
                
                <!-- Pathway 4 -->
                <div data-aos="fade-up" data-aos-delay="400" class="bg-slate-50 hover:bg-white p-5 sm:p-7 lg:p-8 rounded-[1.5rem] border border-slate-100 hover:border-purple-100 transition-all duration-300 hover:shadow-[0_15px_30px_-5px_rgba(168,85,247,0.08)] group flex flex-col justify-start">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center text-purple-600 text-[1.2rem] mb-5 group-hover:scale-110 transition-transform duration-300 group-hover:bg-purple-50">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h4 class="text-[1.2rem] font-bold text-slate-900 mb-2">Research & Policy</h4>
                    <p class="text-slate-500 text-[0.95rem] leading-relaxed">Academics, Policy Advisors, Tech Consultancies, Government IT Directors.</p>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2 lg:gap-3">
            @foreach($staff as $member)
            <div data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}" class="bg-white rounded-[2rem] p-2 shadow-[0_15px_35px_-5px_rgba(0,0,0,0.08)] border border-slate-100 transition-all duration-300 relative group flex flex-col hover:-translate-y-2 hover:shadow-[0_25px_50px_-12px_rgba(30,122,62,0.35)] hover:border-[#1E7A3E]/30">
                <div class="h-[440px] rounded-[1.5rem] bg-slate-50 overflow-hidden relative w-full isolate">
                    
                    @php
                        $cleanName = preg_replace('/^(Prof\.|Dr\.|Mr\.|Mrs\.|Ms\.|Engr\.)\s+/i', '', $member->name);
                        $displayName = $member->title && !str_starts_with($member->name, $member->title) ? $member->title . ' ' . $member->name : $member->name;
                        $fallbackImage = 'https://ui-avatars.com/api/?name=' . urlencode($cleanName) . '&background=EAF3DE&color=1E7A3E&size=400';
                    @endphp
                    
                    <a href="{{ route('people.show', $member->slug) }}" class="absolute inset-0 z-0 w-full h-full block">
                        <img src="{{ $member->photo ? asset('storage/'.$member->photo) : $fallbackImage }}" alt="{{ $displayName }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-105 z-0" onerror="this.src='{{ $fallbackImage }}'">
                    </a>
                    
                    <!-- Smooth Dark Gradient Overlay focused on the bottom for perfect text readability -->
                    <div class="absolute inset-x-0 bottom-0 h-[80%] bg-gradient-to-t from-[#062e14] via-[#062e14]/70 to-transparent z-10 pointer-events-none opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Inner Content overlaying the image -->
                    <div class="absolute bottom-0 left-0 w-full p-5 pb-4 z-20 flex flex-col text-left pointer-events-none">
                        
                        <!-- Name and Badge -->
                        <a href="{{ route('people.show', $member->slug) }}"
                           class="text-[1rem] font-semibold text-white mb-1 inline-flex items-center gap-1 leading-tight no-underline hover:text-white pointer-events-auto max-w-full">
                            <span class="min-w-0 whitespace-nowrap overflow-hidden text-ellipsis">{{ $displayName }}</span>
                            <span class="relative flex items-center justify-center shrink-0 w-[14px] h-[14px]">
                                <i class="fa-solid fa-certificate text-emerald-400 text-[0.75rem]"></i>
                                <i class="fa-solid fa-check text-slate-900 text-[0.4rem] absolute"></i>
                            </span>
                        </a>
                        
                        <!-- Role & Description -->
                        <p class="text-white/70 text-[0.78rem] leading-[1.3] mb-3 font-light line-clamp-2">
                            {{ $member->role }} &bull; {{ $member->specialisation ?: 'Focused on creating intuitive learning experiences.' }}
                        </p>
                        
                        <!-- Socials Row -->
                        <div class="flex items-center justify-between pt-2 mt-auto pointer-events-auto">
                            <div class="flex items-center gap-2">
                                @if($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-[#0A66C2] hover:text-white transition-all shadow-sm">
                                    <i class="fa-brands fa-linkedin-in text-[0.8rem]"></i>
                                </a>
                                @endif
                                
                                @if($member->twitter)
                                <a href="{{ $member->twitter }}" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white hover:text-black transition-all shadow-sm">
                                    <i class="fa-brands fa-x-twitter text-[0.8rem]"></i>
                                </a>
                                @else
                                <a href="#" onclick="event.preventDefault();" class="w-8 h-8 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white hover:bg-white hover:text-[#1E7A3E] transition-all shadow-sm">
                                    <i class="fa-solid fa-envelope text-[0.8rem]"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
                        <div class="mt-14 text-center">
                <a href="{{ route('people.index') }}" class="inline-flex items-center gap-2 bg-[#1E7A3E] text-white py-[0.95rem] px-8 rounded-full font-bold text-[1.05rem] transition-all duration-300 shadow-[0_4px_15px_rgba(30,122,62,0.2)] hover:bg-[#115e3b] hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(30,122,62,0.3)] no-underline">
                    Meet All Lecturers <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>

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
@php
    $cyberFaqs = [
        ['q' => 'Is prior coding experience required to study Cyber Security?', 'a' => 'While prior coding experience is helpful, it is not strictly required. Our foundational courses will introduce you to programming basics relevant to security before advancing to more complex topics.'],
        ['q' => 'Will I have access to hands-on practical labs?', 'a' => 'Yes. We provide modern virtual environments and physical labs where students practice ethical hacking, penetration testing, and digital forensics in a controlled setting.'],
        ['q' => 'What kind of certifications can this degree help me achieve?', 'a' => 'Our curriculum is designed to align with industry standards, helping you prepare for certifications like CompTIA Security+, CEH (Certified Ethical Hacker), and CCNA.'],
        ['q' => 'Are there internship opportunities in the industry?', 'a' => 'Absolutely. We partner with various tech companies and government parastatals to ensure our students get placements for their 6-month SIWES program.']
    ];

    $dataScienceFaqs = [
        ['q' => 'What programming languages will I learn?', 'a' => 'The program heavily focuses on Python and R for data analysis, machine learning, and AI. You will also learn SQL for database management.'],
        ['q' => 'Do I need a strong background in mathematics?', 'a' => 'Data Science relies on statistics, calculus, and linear algebra. A fair understanding of these concepts is advantageous, but we cover the essential mathematics tailored for data science in our curriculum.'],
        ['q' => 'What are the hardware requirements for my laptop?', 'a' => 'We recommend a laptop with at least 8GB RAM (16GB preferred), a multi-core processor (Core i5 or equivalent), and at least 500GB of storage. A dedicated GPU is a plus for deep learning models, but cloud resources are also utilized.'],
        ['q' => 'Are there research opportunities in artificial intelligence?', 'a' => 'Yes, final year students often undertake AI or predictive modeling projects, guided by our specialized faculty and industry datasets.']
    ];

    // Determine the FAQ array to use based on the slug
    if ($subDept->slug == 'cyber-security') {
        $faqs = $cyberFaqs;
    } elseif ($subDept->slug == 'data-science') {
        $faqs = $dataScienceFaqs;
    } else {
        $faqs = [
            ['q' => 'How do I apply for this programme?', 'a' => 'To apply, kindly follow the university\'s general admission guidelines via the JAMB portal or the postgraduate school portal, selecting your desired programme.'],
            ['q' => 'Are there practical laboratory sessions?', 'a' => 'Yes, our programmes balance theoretical knowledge with robust practical sessions to ensure you are industry-ready.'],
            ['q' => 'Can I easily reach out to academic advisors?', 'a' => 'Our staff are available during working hours for academic advising and mentorship. You can find their profiles and contact details above.']
        ];
    }
@endphp

<section class="bg-[#fafbfc] py-28 border-t border-black/5 relative overflow-hidden" x-data="{ activeFaq: null }">
    <!-- Background mesh decorations -->
    <div class="absolute top-[-10%] left-[-5%] w-[600px] h-[600px] bg-gradient-to-br from-emerald-100/40 to-transparent rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-[-15%] right-[-8%] w-[500px] h-[500px] bg-gradient-to-tl from-slate-200/50 to-transparent rounded-full blur-[80px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-gradient-to-r from-emerald-50/30 via-transparent to-slate-50/30 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container relative z-10">
        
        <!-- Section Header -->
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 bg-emerald-500/10 text-emerald-600 text-[0.78rem] font-bold uppercase tracking-[2px] py-2 px-5 rounded-full mb-5 border border-emerald-500/15 shadow-sm">
                <i class="fa-solid fa-circle-question text-[0.7rem]"></i> Support & Guidance
            </span>
            <h2 class="text-[2.5rem] md:text-[3rem] font-black text-slate-900 font-heading mb-5 tracking-tight leading-[1.1]">
                Frequently Asked Questions
            </h2>
            <p class="text-slate-500 max-w-[600px] mx-auto text-[1.05rem] leading-[1.7]">
                Everything you need to know about admissions, curriculum, and campus life at <span class="text-emerald-600 font-semibold">{{ $subDept->name }}</span>.
            </p>
        </div>


        <div class="max-w-[850px] mx-auto">

            <div class="space-y-3.5">

                @foreach($faqs as $index => $faq)
                <div class="group/card rounded-2xl transition-all duration-400 border relative overflow-hidden"
                     :class="activeFaq === {{ $index }}
                         ? 'bg-white shadow-[0_12px_40px_-8px_rgba(5,150,105,0.12),0_0_0_1px_rgba(5,150,105,0.08)] border-emerald-300/50'
                         : 'bg-white/70 backdrop-blur-sm border-slate-200/70 hover:bg-white hover:border-slate-300/80 hover:shadow-[0_8px_25px_-8px_rgba(0,0,0,0.06)]'"
                     data-aos="fade-up" data-aos-delay="{{ $index * 70 }}">

                    <!-- Left accent bar -->
                    <div class="absolute left-0 top-0 bottom-0 w-[3px] rounded-l-2xl transition-all duration-400"
                         :class="activeFaq === {{ $index }}
                             ? 'bg-gradient-to-b from-emerald-400 to-emerald-600'
                             : 'bg-transparent group-hover/card:bg-slate-200'"></div>

                    <!-- Question Button -->
                    <button @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                            class="w-full flex items-center gap-4 md:gap-5 p-4 md:p-6 pl-4 md:pl-7 text-left focus:outline-none group cursor-pointer">

                        <!-- Number badge -->
                        <div class="w-11 h-11 min-w-[2.75rem] rounded-xl flex items-center justify-center text-[0.85rem] font-black transition-all duration-400 shrink-0 relative"
                             :class="activeFaq === {{ $index }}
                                 ? 'bg-emerald-500 text-white shadow-[0_6px_16px_-2px_rgba(16,185,129,0.45)] scale-110'
                                 : 'bg-slate-50 text-slate-400 border border-slate-200/80 group-hover:bg-emerald-50 group-hover:text-emerald-600 group-hover:border-emerald-200'">
                            <span :class="activeFaq === {{ $index }} ? 'opacity-0 scale-75' : 'opacity-100 scale-100'" class="transition-all duration-200">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <i class="fa-solid fa-check text-[0.7rem] absolute transition-all duration-200" :class="activeFaq === {{ $index }} ? 'opacity-100 scale-100' : 'opacity-0 scale-75'"></i>
                        </div>

                        <!-- Question text -->
                        <h3 class="flex-1 text-[1rem] md:text-[1.08rem] font-bold leading-snug tracking-tight transition-colors duration-200"
                            :class="activeFaq === {{ $index }} ? 'text-slate-900' : 'text-slate-600 group-hover:text-slate-800'">
                            {{ $faq['q'] }}
                        </h3>

                        <!-- Toggle icon (+ / −) -->
                        <div class="w-9 h-9 min-w-[2.25rem] rounded-xl flex items-center justify-center transition-all duration-400 shrink-0"
                             :class="activeFaq === {{ $index }}
                                 ? 'bg-emerald-500 text-white shadow-sm'
                                 : 'bg-slate-50 text-slate-400 border border-slate-200/80 group-hover:bg-slate-100 group-hover:text-slate-600'">
                            <i class="fa-solid fa-plus text-[0.7rem] transition-transform duration-300" :class="activeFaq === {{ $index }} ? 'rotate-45' : ''"></i>
                        </div>
                    </button>

                    <!-- Answer Panel -->
                    <div x-show="activeFaq === {{ $index }}"
                         x-collapse
                         x-cloak>
                        <div class="px-4 md:px-6 pl-4 md:pl-7 pb-5 md:pb-6">
                            <div class="ml-[3.75rem] bg-emerald-50/50 border border-emerald-100/60 rounded-xl p-5 text-slate-600 text-[0.93rem] leading-[1.85] relative">
                                <!-- Answer icon -->
                                <div class="absolute -top-3 -left-3 w-6 h-6 rounded-lg bg-emerald-500 text-white flex items-center justify-center shadow-sm">
                                    <i class="fa-solid fa-reply text-[0.55rem]"></i>
                                </div>
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Bottom CTA Bar -->
                <div class="mt-8 bg-gradient-to-r from-slate-50 to-emerald-50/40 rounded-2xl p-5 md:p-7 border border-slate-200/60 flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up">
                    <div class="flex items-center gap-3 text-center sm:text-left">
                        <div class="w-11 h-11 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-[1.1rem] shrink-0 shadow-sm">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <div>
                            <div class="text-slate-800 font-bold text-[0.95rem]">Didn't find what you were looking for?</div>
                            <div class="text-slate-500 text-[0.82rem]">Our admissions team is happy to help with any questions.</div>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white py-2.5 px-6 rounded-xl font-bold text-[0.85rem] no-underline transition-all duration-300 shadow-sm hover:shadow-md whitespace-nowrap shrink-0">
                        Ask a Question <i class="fa-solid fa-arrow-right text-[0.7rem]"></i>
                    </a>
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