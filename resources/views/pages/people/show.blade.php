@extends('layouts.public')
@section('title', $staff->name . ' - Staff Profile')

@section('content')
<style> .hero-pattern { background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }
html { scroll-behavior: smooth; }
.nav-link.active { background-color: #f0fdf4; color: #16a34a; font-weight: 600; }
.nav-link.active i { color: #16a34a; }
.profile-tailwind-scope *, .profile-tailwind-scope ::before, .profile-tailwind-scope ::after { border-width: 0; border-style: solid; border-color: currentColor; } </style>

<!-- Hero Section --><div class="profile-tailwind-scope">
<div class="relative overflow-hidden bg-gradient-to-br from-[#102b1f] via-[#15803d] to-[#16a34a] text-white pt-16 pb-[8.5rem]">
    <div class="absolute inset-0 hero-pattern z-0"></div><div class="absolute top-0 -right-20 w-96 h-96 bg-green-400 rounded-full filter blur-3xl opacity-20 z-0 pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-green-300 rounded-full filter blur-3xl opacity-10 z-0 pointer-events-none"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Back Link -->
        <a data-aos="fade-up" href="{{ route('people.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 mb-10 text-sm font-semibold text-white/80 rounded-full bg-white/5 border border-solid border-white/10 backdrop-blur-md hover:bg-white/20 hover:text-white hover:-translate-x-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to People</span>
        </a>

        <!-- Hero Content -->
        <div data-aos="fade-up" class="flex flex-col md:flex-row gap-8 lg:gap-12 items-center md:items-start text-center md:text-left">
            <!-- Photo -->
            <div class="flex-shrink-0 relative group">
                <div class="w-64 h-64 sm:w-72 sm:h-72 lg:w-80 lg:h-80 mx-auto md:mx-0 rounded-3xl p-1.5 bg-white/10 border border-solid border-white/20 backdrop-blur-md shadow-2xl group-hover:-translate-y-2 transition-transform duration-500 z-10 relative">
                    <img
                        src="{{ $staff->photo ? asset('storage/'.$staff->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($staff->name) . '&size=400&background=0f172a&color=fff&bold=true&format=svg' }}"
                        alt="{{ $staff->name }}"
                        class="w-full h-full rounded-2xl object-cover bg-slate-900 shadow-inner"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($staff->name) }}&size=400&background=0f172a&color=fff&bold=true&format=svg'"
                <div class="absolute inset-0 bg-gradient-radial from-green-400/50 to-transparent rounded-full blur-2xl group-hover:blur-3xl transition-all duration-500 -z-10 transform scale-110"></div>
            </div>

            <!-- Details -->
            <div class="flex-1 mt-2 md:mt-4">
                <!-- Badges -->
                <div class="flex flex-wrap gap-3 mb-5 justify-center md:justify-start">
                    @if($staff->is_hod)
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-400 text-white shadow-[0_0_15px_rgba(245,158,11,0.5)] border border-solid border-amber-300/50">
                        <i class="fa-solid fa-star text-[0.6rem]"></i> Head of Department
                    </span>
                    @endif
                    @if($staff->status)
                    @php 
                        $statusColor = strtolower($staff->status) === 'active' ? 'green' : (strtolower($staff->status) === 'visiting' ? 'blue' : 'amber');
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 text-{{ $statusColor }}-300 border border-{{ $statusColor }}-300/30 backdrop-blur-sm shadow-sm">
                        <i class="fa-solid fa-circle text-[0.4rem]"></i> {{ $staff->status }}
                    </span>
                    @endif
                    @if($staff->role && strtolower($staff->role) !== 'head of department')
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold bg-white/5 text-white/90 border border-solid border-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-id-badge text-[0.7rem]"></i> {{ $staff->role }}
                    </span>
                    @endif
                </div>

                <!-- Name & Rank -->
                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 tracking-tight drop-shadow-xl">
                    {{ $staff->title }} {{ $staff->name }}
                </h1>
                <div data-aos="fade-up" class="flex items-center justify-center md:justify-start gap-4 mb-8">
                    <div class="h-1 w-8 bg-green-400 rounded-full"></div>
                    <p class="text-xl lg:text-2xl font-semibold text-green-100 drop-shadow-md">{{ $staff->rank }}</p>
                </div>

                <!-- Quick Inline Contact -->
                <div data-aos="fade-up" class="flex flex-col md:flex-row flex-wrap gap-x-6 gap-y-3 bg-black/20 p-4 rounded-2xl backdrop-blur-sm border border-solid border-white/10 items-center justify-center md:justify-start shadow-inner mt-4">
                    @if($staff->email)
                    <a href="mailto:{{ $staff->email }}" class="flex items-center gap-3 text-white/80 hover:text-white hover:scale-105 transition-all text-sm font-medium w-full md:w-auto">
                        <div data-aos="fade-up" class="w-8 h-8 rounded-full bg-green-500/20 flex-shrink-0 flex items-center justify-center text-green-200"><i class="fa-solid fa-envelope"></i></div>
                        <span class="truncate max-w-[200px] sm:max-w-none">{{ $staff->email }}</span>
                    </a>
                    @endif
                    @if($staff->phone)
                    <span class="flex items-center gap-3 text-white/80 text-sm font-medium w-full md:w-auto">
                        <div data-aos="fade-up" class="w-8 h-8 rounded-full bg-green-500/20 flex-shrink-0 flex items-center justify-center text-green-200"><i class="fa-solid fa-phone"></i></div>
                        {{ $staff->phone }}
                    </span>
                    @endif
                    @if($staff->office_location)
                    <span class="flex items-center gap-3 text-white/80 text-sm font-medium w-full md:w-auto text-left">
                        <div data-aos="fade-up" class="w-8 h-8 rounded-full bg-green-500/20 flex-shrink-0 flex items-center justify-center text-green-200"><i class="fa-solid fa-building"></i></div>
                        <span class="whitespace-normal leading-tight">{{ $staff->office_location }}</span>
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Container -->
<div class="container mx-auto px-4 relative z-20 -mt-20 mb-20 max-w-7xl">
    
    <!-- Quick Stats Bar -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        @if($staff->publications->count() > 0)
        <div data-aos="fade-up" class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:-translate-y-1.5 hover:shadow-[0_15px_40px_rgb(0,0,0,0.12)] hover:border-green-200 transition-all duration-300 flex items-center gap-5 group">
            <div data-aos="fade-up" class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div>
                <p class="text-3xl font-black text-slate-800 leading-none mb-1">{{ $staff->publications->count() }}</p>
                <p class="text-[0.7rem] font-bold text-slate-500 uppercase tracking-widest">Publications</p>
            </div>
        </div>
        @endif

        @if($staff->courses->count() > 0)
        <div data-aos="fade-up" class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:-translate-y-1.5 hover:shadow-[0_15px_40px_rgb(0,0,0,0.12)] hover:border-amber-200 transition-all duration-300 flex items-center gap-5 group">
            <div data-aos="fade-up" class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div>
                <p class="text-3xl font-black text-slate-800 leading-none mb-1">{{ $staff->courses->count() }}</p>
                <p class="text-[0.7rem] font-bold text-slate-500 uppercase tracking-widest">Courses Taught</p>
            </div>
        </div>
        @endif

        @if($staff->specialisation)
        <div data-aos="fade-up" class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:-translate-y-1.5 hover:shadow-[0_15px_40px_rgb(0,0,0,0.12)] hover:border-purple-200 transition-all duration-300 flex items-center gap-5 group">
            <div data-aos="fade-up" class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-microchip"></i>
            </div>
            <div>
                <p class="text-3xl font-black text-slate-800 leading-none mb-1"><i class="fa-solid fa-check text-xl text-green-500"></i></p>
                <p class="text-[0.7rem] font-bold text-slate-500 uppercase tracking-widest">Specialist</p>
            </div>
        </div>
        @endif

        @if($staff->accepting_pg)
        <div data-aos="fade-up" class="bg-white rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:-translate-y-1.5 hover:shadow-[0_15px_40px_rgb(0,0,0,0.12)] hover:border-green-200 transition-all duration-300 flex items-center gap-5 group">
            <div data-aos="fade-up" class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <p class="text-3xl font-black text-slate-800 leading-none mb-1">Yes</p>
                <p class="text-[0.7rem] font-bold text-slate-500 uppercase tracking-widest">Accepting PG</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Main Content -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Biography -->
            <section data-aos="fade-up" id="biography" class="profile-section scroll-mt-24">
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300">
                    <div data-aos="fade-up" class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                        <div data-aos="fade-up" class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 m-0">Biography</h2>
                    </div>
                    <div class="prose prose-base sm:prose-lg prose-slate max-w-none text-slate-600 leading-relaxed font-medium text-left tracking-normal">
                        {!! nl2br(e($staff->bio ?? 'Biography information is currently unavailable.')) !!}
                    </div>
                </div>
            </section>

            <!-- Qualifications -->
            @if($staff->qualifications)
            <section data-aos="fade-up" id="qualifications" class="profile-section scroll-mt-24">
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300">
                    <div data-aos="fade-up" class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                        <div data-aos="fade-up" class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 m-0">Qualifications</h2>
                    </div>
                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-medium m-0 text-left tracking-normal">{{ $staff->qualifications }}</p>
                </div>
            </section>
            @endif

            <!-- Specialisation -->
            @if($staff->specialisation)
            <section data-aos="fade-up" id="specialisation" class="profile-section scroll-mt-24">
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300">
                    <div data-aos="fade-up" class="flex items-center gap-4 mb-6 pb-6 border-b border-slate-100">
                        <div data-aos="fade-up" class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shadow-inner">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 m-0">Specialisation & Research Areas</h2>
                    </div>
                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-medium m-0 text-left tracking-normal">{{ $staff->specialisation }}</p>
                </div>
            </section>
            @endif

            <!-- Courses Taught -->
            @if($staff->courses->count() > 0)
            <section data-aos="fade-up" id="courses" class="profile-section scroll-mt-24">
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300">
                    <div data-aos="fade-up" class="flex items-center justify-between gap-4 mb-6 pb-6 border-b border-slate-100">
                        <div data-aos="fade-up" class="flex items-center gap-4">
                            <div data-aos="fade-up" class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center text-xl shadow-inner">
                                <i class="fa-solid fa-book"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800 m-0">Courses Taught</h2>
                        </div>
                        <span class="px-4 py-1.5 bg-slate-100 text-slate-600 font-bold rounded-full text-sm border border-solid border-slate-200 shadow-sm">
                            {{ $staff->courses->count() }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @foreach($staff->courses as $course)
                        <div class="bg-slate-50 rounded-2xl p-6 border border-solid border-slate-200 hover:bg-white hover:border-green-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between">
                            <div>
                                <div data-aos="fade-up" class="flex items-center justify-between mb-3">
                                    <span class="text-xs font-black text-green-600 uppercase tracking-widest">{{ $course->code }}</span>
                                    @if($course->level)
                                    <span class="px-2.5 py-1 bg-green-100 text-green-800 font-bold text-[0.65rem] rounded-md uppercase tracking-wider">Level {{ $course->level }}</span>
                                    @endif
                                </div>
                                <h3 class="font-bold text-slate-800 text-lg leading-snug group-hover:text-green-700 transition-colors m-0">{{ $course->title }}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- Publications -->
            @if($staff->publications->count() > 0)
            <section data-aos="fade-up" id="publications" class="profile-section scroll-mt-24">
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300">
                    <div data-aos="fade-up" class="flex items-center justify-between gap-4 mb-6 pb-6 border-b border-slate-100">
                        <div data-aos="fade-up" class="flex items-center gap-4">
                            <div data-aos="fade-up" class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center text-xl shadow-inner">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800 m-0">Latest Publications</h2>
                        </div>
                        <span class="px-4 py-1.5 bg-slate-100 text-slate-600 font-bold rounded-full text-sm border border-solid border-slate-200 shadow-sm">
                            {{ $staff->publications->count() }}
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($staff->publications as $pub)
                        <div class="bg-white rounded-2xl p-6 border border-solid border-slate-200 hover:border-green-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 transition-all duration-300 group relative pl-10 overflow-hidden">
                            <div class="absolute left-0 top-0 bottom-0 w-2 bg-slate-200 group-hover:bg-green-400 transition-colors"></div>
                            
                            <h4 class="font-bold text-slate-800 text-lg mb-3 leading-snug group-hover:text-green-600 transition-colors pr-8">
                                {{ $pub->title }}
                            </h4>
                            
                            <div data-aos="fade-up" class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm font-medium text-slate-500 mb-3">
                                @if($pub->type)
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-xs rounded-md uppercase tracking-wider font-bold shadow-sm">
                                    {{ $pub->type }}
                                </span>
                                @endif
                                @if($pub->year)
                                <span class="flex items-center gap-1.5"><i class="fa-regular fa-calendar text-slate-400"></i> {{ $pub->year }}</span>
                                @endif
                                @if($pub->journal)
                                <span class="flex items-center gap-1.5"><i class="fa-solid fa-newspaper text-slate-400"></i> {{ $pub->journal }}</span>
                                @endif
                            </div>

                            @if($pub->url)
                            <a href="{{ $pub->url }}" target="_blank" class="inline-flex items-center gap-2 text-green-600 font-bold text-sm hover:text-green-800 transition-colors bg-green-50 px-3 py-1.5 rounded-lg hover:bg-green-100">
                                View Publication <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </a>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

        </div>

        <!-- Right Column: Sidebar -->
        <div class="space-y-8">
            <!-- Sticky Container -->
            <div class="sticky top-8 space-y-6">
                
                <!-- Navigation Widget -->
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300 overflow-hidden">
                    <div data-aos="fade-up" class="bg-slate-50/80 px-6 py-5 border-b border-slate-200 flex items-center justify-between">
                        <h3 class="font-bold text-slate-800 m-0 flex items-center gap-2.5">
                            <i class="fa-solid fa-route text-green-600"></i> On this page
                        </h3>
                    </div>
                    <div class="p-4 space-y-1">
                        <a href="#biography" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-slate-50 hover:text-green-600 transition-colors">
                            <div class="w-6 text-center text-slate-400"><i class="fa-solid fa-user text-sm"></i></div> Biography
                        </a>
                        @if($staff->qualifications)
                        <a href="#qualifications" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-slate-50 hover:text-amber-600 transition-colors shadow-sm">
                            <div class="w-6 text-center text-slate-400"><i class="fa-solid fa-graduation-cap text-sm"></i></div> Qualifications
                        </a>
                        @endif
                        @if($staff->specialisation)
                        <a href="#specialisation" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-slate-50 hover:text-purple-600 transition-colors">
                            <div class="w-6 text-center text-slate-400"><i class="fa-solid fa-microchip text-sm"></i></div> Specialisation
                        </a>
                        @endif
                        @if($staff->courses->count() > 0)
                        <a href="#courses" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-slate-50 hover:text-green-600 transition-colors">
                            <div class="w-6 text-center text-slate-400"><i class="fa-solid fa-book text-sm"></i></div> Courses
                        </a>
                        @endif
                        @if($staff->publications->count() > 0)
                        <a href="#publications" class="nav-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-slate-600 font-medium hover:bg-slate-50 hover:text-red-500 transition-colors">
                            <div class="w-6 text-center text-slate-400"><i class="fa-solid fa-book-open text-sm"></i></div> Publications
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Complete Contact Widget -->
                <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-solid border-slate-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.1)] transition-all duration-300 overflow-hidden">
                    <div class="bg-slate-50/80 px-6 py-5 border-b border-slate-200">
                        <h3 class="font-bold text-slate-800 m-0 flex items-center gap-2.5">
                            <i class="fa-solid fa-address-card text-green-600"></i> Full Contact Info
                        </h3>
                    </div>
                    <div class="p-6 space-y-7">
                        @if($staff->email)
                        <div data-aos="fade-up" class="flex items-start gap-4">
                            <div data-aos="fade-up" class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="flex-1 min-w-0"><p class="text-[0.65rem] text-left font-bold text-slate-400 uppercase tracking-widest mb-1">Email</p>
                                <a href="mailto:{{ $staff->email }}" class="text-slate-800 font-semibold hover:text-green-600 transition-colors break-words text-sm sm:text-base text-left block normal-case tracking-normal">{{ $staff->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($staff->phone)
                        <div data-aos="fade-up" class="flex items-start gap-4">
                            <div data-aos="fade-up" class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="flex-1 min-w-0"><p class="text-[0.65rem] text-left font-bold text-slate-400 uppercase tracking-widest mb-1">Phone</p>
                                <p class="text-slate-800 font-semibold m-0 text-sm sm:text-base text-left break-words normal-case tracking-normal">{{ $staff->phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if($staff->office_location)
                        <div data-aos="fade-up" class="flex items-start gap-4">
                            <div data-aos="fade-up" class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <div class="flex-1 min-w-0"><p class="text-[0.65rem] text-left font-bold text-slate-400 uppercase tracking-widest mb-1">Office Location</p>
                                <p class="text-slate-800 font-semibold m-0 text-sm sm:text-base text-left break-words normal-case tracking-normal">{{ $staff->office_location }}</p>
                            </div>
                        </div>
                        @endif

                        @if($staff->address)
                        <div data-aos="fade-up" class="flex items-start gap-4">
                            <div data-aos="fade-up" class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="flex-1 min-w-0"><p class="text-[0.65rem] text-left font-bold text-slate-400 uppercase tracking-widest mb-1">Mailing Address</p>
                                <p class="text-slate-800 font-semibold m-0 text-sm sm:text-base text-left break-words normal-case tracking-normal">{{ $staff->address }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Academic Profiles -->
                @if($staff->google_scholar_url || $staff->researchgate_url)
                <div class="bg-slate-900 rounded-3xl shadow-sm border border-solid border-slate-800 overflow-hidden text-white relative z-10">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-900/40 to-transparent -z-10"></div>
                    <div class="px-6 py-5 border-b border-slate-700/50">
                        <h3 class="font-bold text-white m-0 flex items-center gap-2.5">
                            <i class="fa-solid fa-chart-line text-green-500"></i> Academic Profiles
                        </h3>
                    </div>
                    <div class="p-6 space-y-3">
                        @if($staff->google_scholar_url)
                        <a href="{{ $staff->google_scholar_url }}" target="_blank" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 border border-solid border-white/10 hover:bg-white/10 hover:border-green-400/50 transition-all group">
                            <div data-aos="fade-up" class="flex items-center gap-3">
                                <div data-aos="fade-up" class="w-9 h-9 rounded-lg bg-[#4285F4] flex items-center justify-center text-white">
                                    <i class="fa-brands fa-google text-sm"></i>
                                </div>
                                <span class="font-semibold text-white/90 group-hover:text-white">Google Scholar</span>
                            </div>
                            <i class="fa-solid fa-arrow-right text-slate-500 group-hover:text-green-500 group-hover:-rotate-45 transition-all"></i>
                        </a>
                        @endif

                        @if($staff->researchgate_url)
                        <a href="{{ $staff->researchgate_url }}" target="_blank" class="flex items-center justify-between p-3.5 rounded-xl bg-white/5 border border-solid border-white/10 hover:bg-white/10 hover:border-[#00CCBB]/50 transition-all group">
                            <div data-aos="fade-up" class="flex items-center gap-3">
                                <div data-aos="fade-up" class="w-9 h-9 rounded-lg bg-[#00CCBB] flex items-center justify-center text-white">
                                    <i class="fa-brands fa-researchgate text-lg"></i>
                                </div>
                                <span class="font-semibold text-white/90 group-hover:text-white">ResearchGate</span>
                            </div>
                            <i class="fa-solid fa-arrow-right text-slate-500 group-hover:text-[#00CCBB] group-hover:-rotate-45 transition-all"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('.profile-section');
    
    // Highlight active section on scroll
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.scrollY >= (sectionTop - 180)) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href === '#' + current) {
                link.classList.add('active');
            }
        });
    });
});
</script>
</div>@endsection












