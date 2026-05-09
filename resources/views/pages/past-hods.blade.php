@extends('layouts.public')
@section('title', 'Past Heads of Department')

@section('content')
@php
    $hs = \App\Models\DepartmentSetting::where('group', 'page_past-hods')->pluck('value', 'key')->toArray();
    $heroImg = \App\Models\DepartmentSetting::getCached('hero_past-hods');
    $heroUrl = $heroImg && file_exists(storage_path('app/public/' . $heroImg)) 
        ? asset('storage/' . $heroImg) 
        : null;
@endphp

<!-- Premium Hero Section -->
<section data-aos="fade-up" class="bg-gradient-to-br from-slate-900 via-slate-800 to-green-900 py-16 sm:py-24 relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        @if($heroUrl)
            <img src="{{ $heroUrl }}" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-10 filter blur-sm mix-blend-overlay">
        @endif
        <div class="absolute -top-20 -right-20 w-[350px] h-[350px] bg-[radial-gradient(circle,rgba(22,163,74,0.15)_0%,transparent_70%)] rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-[250px] h-[250px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.5%22_fill=%22rgba(255,255,255,0.03)%22/></svg>')]"></div>
    </div>
    
    <div class="container relative z-10 text-center flex flex-col items-center" data-aos="fade-up">
        <span class="inline-flex items-center gap-2 bg-green-600/20 backdrop-blur-md text-green-400 text-[0.78rem] font-bold uppercase tracking-[1.5px] py-[0.3rem] px-4 rounded-full mb-4 border border-green-600/30">
            <i class="fa-solid fa-award"></i> Department Leadership
        </span>
        <h1 class="text-white text-[2.2rem] lg:text-[3.5rem] font-heading font-extrabold m-0 mb-4 leading-[1.15]">
            {{ $hs['past_hods_hero_title'] ?? 'Past Heads of Department' }}
        </h1>
        <p class="text-slate-200 text-base md:text-[1.15rem] max-w-[750px] mx-auto leading-[1.8] text-balance text-center drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)] m-0">
            {{ $hs['past_hods_hero_subtitle'] ?? 'Honoring the visionaries and leaders who have driven our department forward through the years.' }}
        </p>
    </div>
</section>

<div class="bg-gradient-to-b from-slate-100 to-slate-300 py-16 lg:py-24 min-h-screen">
    <div class="container max-w-[1280px] mx-auto px-4">
        
        @php
            $currentHod = $hods->firstWhere('is_current', true);
            $pastHodsCollection = $hods->where('is_current', '!=', true)->values();
        @endphp

        <!-- 6-Column Collage Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4 md:gap-5 items-end">
            
            @if($currentHod)
            <!-- LARGE CARD: Current HOD (Spans up to 3 columns for extra width) -->
            <div class="col-span-2 sm:col-span-2 md:col-span-3 lg:col-span-3 flex shadow-2xl bg-white group w-full relative z-20" data-aos="fade-up">
                <!-- Main Content -->
                <div class="flex-1 flex flex-col">
                    <div class="relative w-full bg-gradient-to-tr from-lime-400 to-green-600 overflow-hidden shrink-0" style="height: 400px;">
                        <img src="{{ $currentHod->photo ? asset('storage/'.$currentHod->photo) : asset('images/avatar-placeholder.png') }}"
                             alt="{{ $currentHod->name }}"
                             class="absolute inset-0 w-full h-full object-cover object-top transition-all duration-500 group-hover:scale-105"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($currentHod->name) }}&size=800&background=e2e8f0&color=1e293b&bold=true'">
                    </div>
                    <!-- White Text Box -->
                    <div class="bg-white p-2.5 sm:p-5 text-center relative z-10 border-t-2 border-slate-100 flex-1 flex flex-col justify-center min-h-[90px]">
                        <h4 class="text-red-600 font-black text-[0.7rem] sm:text-[0.8rem] uppercase tracking-wider mb-1 line-clamp-1">
                            {{ $currentHod->name }}
                        </h4>
                        <h5 class="text-slate-900 font-extrabold text-[0.85rem] sm:text-[1.05rem] uppercase tracking-wide">
                            Current H.O.D
                        </h5>
                    </div>
                </div>
                <!-- Vertical Ribbon -->
                <div class="w-10 sm:w-14 bg-green-600 flex items-center justify-center shrink-0 relative overflow-hidden border-l border-green-700">
                    <!-- Subtle inner gradient for the ribbon -->
                    <div class="absolute inset-0 bg-gradient-to-b from-green-500 to-green-700 opacity-60"></div>
                    <span class="text-white font-black text-[1rem] sm:text-[1.3rem] tracking-[0.25em] uppercase relative z-10 whitespace-nowrap" 
                          style="writing-mode: vertical-rl; text-orientation: mixed; transform: rotate(180deg);">
                        TEAM CHAIR
                    </span>
                </div>
            </div>
            @endif

            <!-- SMALL CARDS: Past HODs -->
            @foreach($pastHodsCollection as $index => $h)
            @php
                // The large card takes up 2 columns. 
                // So the first 3 small cards sit on the top row with it.
                // The top row in the screenshot uses green gradients, bottom rows use blue.
                $isTopRow = $index < 3;
                $gradient = $isTopRow ? 'from-green-500 to-lime-400' : 'from-blue-600 to-cyan-500';
            @endphp
            <div class="col-span-1 flex flex-col bg-white shadow-xl group transition-all duration-300 hover:-translate-y-1.5 w-full relative z-10" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                <div class="relative w-full bg-gradient-to-tr {{ $gradient }} overflow-hidden shrink-0" style="height: 300px;">
                    <img src="{{ $h->photo ? asset('storage/'.$h->photo) : asset('images/avatar-placeholder.png') }}"
                         alt="{{ $h->name }}"
                         class="absolute inset-0 w-full h-full object-cover object-top transition-all duration-500 group-hover:scale-105"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($h->name) }}&size=400&background=e2e8f0&color=1e293b&bold=true'">
                </div>
                <!-- White Text Box -->
                <div class="bg-white p-2 text-center relative z-10 border-t border-slate-100 flex flex-col justify-center h-[55px] sm:h-[70px]">
                    <h4 class="text-red-600 font-bold text-[0.5rem] sm:text-[0.55rem] uppercase tracking-wider mb-0.5 line-clamp-1">
                        {{ $h->name }}
                    </h4>
                    <h5 class="text-slate-900 font-extrabold text-[0.6rem] sm:text-[0.7rem] uppercase tracking-tight line-clamp-1">
                        Past H.O.D
                    </h5>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Empty State if no records -->
        @if($hods->isEmpty())
        <div class="py-24 text-center bg-white rounded-3xl border border-dashed border-slate-300 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6">
                <i class="fa-solid fa-users-slash text-3xl text-slate-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 font-heading mb-2">No Records Found</h3>
            <p class="text-slate-500">Historical leadership profiles are currently being updated.</p>
        </div>
        @endif

    </div>
</div>

<style>
/* Smooth animations */
[data-aos] {
    transition-duration: 800ms !important;
}
</style>
@endsection
