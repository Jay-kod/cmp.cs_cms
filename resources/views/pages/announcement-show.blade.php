@extends('layouts.public')
@section('title', $announcement->title . ' – Announcement')

@section('content')
@php
    $gs = fn(string $key, string $default = '') => \App\Models\DepartmentSetting::getCached($key) ?? $default;
    $heroSetting = (object)['value' => \App\Models\DepartmentSetting::getCached('hero_blog')];
    $heroUrl = $heroSetting && $heroSetting->value && file_exists(storage_path('app/public/' . $heroSetting->value))
        ? asset('storage/' . $heroSetting->value) 
        : asset('images/campus-bg.jpg');
    $isUrgent = $announcement->priority === 'high';
@endphp

<!-- Hero -->
<div class="relative overflow-hidden bg-gradient-to-br from-[#102b1f] via-[#15803d] to-[#16a34a] pt-20 pb-28 md:pt-28 md:pb-36 flex items-center justify-center">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat mix-blend-overlay opacity-40 filter grayscale" style="background-image: url('{{ $heroUrl }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#102b1f] to-transparent opacity-80"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNykiLz48L3N2Zz4=')] opacity-50 z-0"></div>

    <div class="container relative z-10 px-4 flex flex-col items-center text-center">
        <!-- Back Button -->
        <a href="{{ route('research-news') }}" data-aos="fade-up" class="inline-flex items-center gap-2 text-green-200 hover:text-white text-sm font-semibold mb-6 transition-colors">
            <i class="fa-solid fa-arrow-left text-xs"></i> Back to News & Announcements
        </a>
        
        <!-- Badge -->
        <div data-aos="fade-up" class="inline-flex items-center gap-2.5 px-6 py-2 {{ $isUrgent ? 'bg-red-500/20 border-red-400/30 text-red-100' : 'bg-white/10 border-white/20 text-green-100' }} border backdrop-blur-md rounded-full text-xs sm:text-sm font-bold uppercase tracking-widest mb-6 shadow-xl">
            <i class="fa-solid fa-bullhorn {{ $isUrgent ? 'text-red-300' : 'text-green-300' }}"></i> 
            {{ $isUrgent ? 'Urgent Announcement' : 'Announcement' }}
        </div>
        
        <!-- Title -->
        <h1 data-aos="fade-up" data-aos-delay="100" class="text-white text-[clamp(1.8rem,5vw,3.5rem)] font-extrabold mb-6 tracking-tight leading-tight drop-shadow-2xl max-w-4xl">
            {{ $announcement->title }}
        </h1>
        
        <!-- Meta Pills -->
        <div data-aos="fade-up" data-aos-delay="200" class="flex flex-wrap justify-center gap-3">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-black/20 border border-white/10 backdrop-blur-sm rounded-full text-green-100 text-sm font-medium">
                <i class="fa-regular fa-clock text-green-300"></i> {{ $announcement->created_at->format('M d, Y') }}
            </span>
            <span class="inline-flex items-center gap-2 px-4 py-2 {{ $isUrgent ? 'bg-red-500/20 border-red-400/20 text-red-100' : 'bg-blue-500/20 border-blue-400/20 text-blue-100' }} border backdrop-blur-sm rounded-full text-sm font-bold uppercase tracking-wide">
                <i class="fa-solid fa-users text-xs"></i> {{ ucfirst($announcement->audience) }}
            </span>
            @if($isUrgent)
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-500/25 border border-red-400/30 backdrop-blur-sm rounded-full text-red-100 text-sm font-bold uppercase tracking-wide">
                <i class="fa-solid fa-triangle-exclamation text-xs"></i> High Priority
            </span>
            @endif
        </div>
    </div>
</div>

<!-- Content -->
<div class="container max-w-5xl px-4 sm:px-6 py-12 relative z-20">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Main Content -->
        <div class="lg:col-span-2" data-aos="fade-up">
            <div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-100 overflow-hidden">
                
                <!-- Priority Banner -->
                @if($isUrgent)
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-3 flex items-center gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-white text-lg"></i>
                    <span class="text-white font-bold text-sm uppercase tracking-wide">Urgent Notice — Please Read Carefully</span>
                </div>
                @endif
                
                <div class="p-6 sm:p-10 lg:p-12">
                    <!-- Body -->
                    <div class="prose prose-slate max-w-none text-slate-600 text-base sm:text-lg leading-relaxed text-justify">
                        {!! nl2br(e($announcement->body)) !!}
                    </div>
                    
                    <!-- Footer Meta -->
                    <div class="mt-10 pt-8 border-t border-slate-100">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-3 text-sm text-slate-400">
                                <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                                    <i class="fa-solid fa-bullhorn text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-slate-600">Department Administration</div>
                                    <div>Posted {{ $announcement->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @if($announcement->expires_at)
                            <div class="text-sm text-slate-400 flex items-center gap-2">
                                <i class="fa-regular fa-clock"></i>
                                Expires {{ \Carbon\Carbon::parse($announcement->expires_at)->format('M d, Y') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1" data-aos="fade-up" data-aos-delay="100">
            <!-- Details Card -->
            <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.04)] border border-slate-100 p-6 mb-6">
                <h4 class="flex items-center gap-2 text-sm font-bold text-slate-800 mb-4 uppercase tracking-wide">
                    <i class="fa-solid fa-circle-info text-green-500"></i> Details
                </h4>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-3 text-slate-500 py-2 border-b border-slate-50">
                        <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0"><i class="fa-regular fa-calendar text-xs"></i></div>
                        <span>{{ $announcement->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-500 py-2 border-b border-slate-50">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-users text-xs"></i></div>
                        <span>{{ ucfirst($announcement->audience) }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-slate-500 py-2 border-b border-slate-50">
                        <div class="w-8 h-8 rounded-lg {{ $isUrgent ? 'bg-red-50 text-red-600' : 'bg-slate-50 text-slate-500' }} flex items-center justify-center flex-shrink-0"><i class="fa-solid fa-flag text-xs"></i></div>
                        <span>{{ ucfirst($announcement->priority) }} Priority</span>
                    </div>
                    @if($announcement->expires_at)
                    <div class="flex items-center gap-3 text-slate-500 py-2">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0"><i class="fa-regular fa-clock text-xs"></i></div>
                        <span>Expires {{ \Carbon\Carbon::parse($announcement->expires_at)->format('M j, Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Related Announcements -->
            @if($related->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgb(0,0,0,0.04)] border border-slate-100 p-6">
                <h4 class="flex items-center gap-2 text-sm font-bold text-slate-800 mb-4 uppercase tracking-wide">
                    <i class="fa-solid fa-bullhorn text-red-500"></i> Other Announcements
                </h4>
                <div class="space-y-3">
                    @foreach($related as $rel)
                    <a href="{{ route('announcements.show', $rel->id) }}" class="block p-3 rounded-xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100 group">
                        <div class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0 {{ $rel->priority === 'high' ? 'bg-red-500' : 'bg-blue-500' }}"></div>
                            <div>
                                <p class="text-sm font-bold text-slate-700 leading-tight group-hover:text-green-600 transition-colors m-0 mb-1">{{ Str::limit($rel->title, 50) }}</p>
                                <span class="text-xs text-slate-400">{{ $rel->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
