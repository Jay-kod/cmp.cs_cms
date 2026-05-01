@extends('layouts.public')
@section('title', 'Announcements')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_blog')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
@endphp

<!-- Hero -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#102b1f] via-[#15803d] to-[#16a34a] pt-20 pb-28 md:pt-28 md:pb-36 flex items-center justify-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat mix-blend-overlay opacity-40 filter grayscale" style="background-image: url('{{ $heroUrl }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#102b1f] to-transparent opacity-80"></div>
    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNykiLz48L3N2Zz4=')] opacity-50 z-0"></div>

    <div class="container relative z-10 px-4 flex flex-col items-center text-center">
        <!-- Badge -->
        <div data-aos="fade-up" class="inline-flex items-center gap-2.5 px-6 py-2 bg-white/10 border border-white/20 backdrop-blur-md text-green-100 rounded-full text-xs sm:text-sm font-bold uppercase tracking-widest mb-6 shadow-xl">
            <i class="fa-solid fa-bullhorn text-green-300"></i> Official Notice Board
        </div>
        
        <!-- Title -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-white text-[clamp(2.5rem,6vw,4.5rem)] font-extrabold mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Announcements
        </h1>
        
        <!-- Subtitle inside a glass card -->
        <div data-aos="fade-up" data-aos-delay="200" class="max-w-3xl bg-black/20 border border-white/10 backdrop-blur-sm rounded-2xl p-5 sm:p-6 shadow-2xl">
            <p class="text-green-50 text-base sm:text-lg md:text-xl leading-relaxed m-0 text-center sm:text-justify font-medium">
                Important updates, deadlines, and official information for staff and students.
            </p>
        </div>
    </div>
</div>

<div class="container relative z-20 py-12 max-w-6xl px-4 sm:px-6 mx-auto">
    <div class="w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($announcements as $announcement)
            <a href="{{ route('announcements.show', $announcement->id) }}" class="bg-white border border-slate-100 rounded-2xl p-4 sm:p-6 md:p-8 transition-all duration-300 flex flex-col shadow-[0_4px_20px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 relative overflow-hidden group no-underline">
                <div class="absolute top-0 left-0 w-1.5 h-full transition-colors duration-300 @if($announcement->priority == 'high') bg-red-500 group-hover:bg-red-600 @else bg-blue-500 group-hover:bg-blue-600 @endif"></div>
                
                <div class="flex justify-between items-start gap-4 mb-4">
                    <h3 class="m-0 text-lg font-bold text-slate-800 leading-tight group-hover:text-green-600 transition-colors">
                        {{ $announcement->title }}
                    </h3>
                    <span class="text-[0.65rem] py-1 px-3 rounded-full font-bold uppercase tracking-widest whitespace-nowrap @if($announcement->priority == 'high') bg-red-50 text-red-600 border border-red-100 @else bg-blue-50 text-blue-600 border border-blue-100 @endif">
                        {{ ucfirst($announcement->audience) }}
                    </span>
                </div>
                
                <div class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow text-justify line-clamp-3">
                    {{ Str::limit(strip_tags($announcement->body), 150) }}
                </div>
                
                <div class="flex justify-between items-center mt-auto border-t border-slate-100 pt-4">
                    <span class="text-xs text-slate-400 flex items-center gap-2 font-bold uppercase tracking-wide">
                        <i class="fa-regular fa-clock text-slate-300"></i> 
                        {{ $announcement->created_at->diffForHumans() }}
                    </span>
                    <span class="text-sm font-bold text-green-600 group-hover:text-green-700 transition-colors flex items-center">
                        Read More <i class="fa-solid fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </div>
            </a>
            @empty
            <div class="col-span-full bg-white rounded-3xl shadow-sm border border-slate-100 p-12 text-center mt-4">
                <div class="w-20 h-20 mx-auto bg-slate-50 text-slate-400 rounded-full flex items-center justify-center text-3xl mb-4">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">No Announcements</h3>
                <p class="text-slate-500">There are no active announcements right now.</p>
            </div>
            @endforelse
        </div>

        @if($announcements->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $announcements->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
