@extends('layouts.public')
@section('title', 'Student Resources')

@section('content')

<!-- 1. Page Banner + Breadcrumb (#0D4F26) -->
<section style="background: #0D4F26; padding: 4rem 0; color: #FFFFFF; text-align: center; position: relative;">
    <div class="container reveal reveal-up">
        <!-- Breadcrumb -->
        <div style="margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500;">
            <a href="/" style="color: #F0F9F3; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-house"></i> Home</a> 
            <span style="margin: 0 0.5rem; color: #a7f3d0;">/</span> 
            <span style="color: #F4C430;">Student Resources</span>
        </div>
        
        <h1 style="font-size: 2.8rem; font-weight: 800; margin-bottom: 1rem; color: #FFFFFF; font-family: var(--font-heading);">Student Resources</h1>
        <p style="font-size: 1.15rem; max-width: 700px; margin: 0 auto; color: #F0F9F3; line-height: 1.6;">Access essential documents, timetables, and academic portals necessary for your studies.</p>
    </div>
</section>

<!-- 2. Essential Portals (#F0F9F3) -->
<section style="background: #F0F9F3; padding: 4rem 0; border-bottom: 1px solid #e2e8f0;">
    <div class="container reveal reveal-up">
        <div class="row g-4 justify-content-center">
            <!-- Student Portal -->
            <div class="col-md-4">
                <a href="#" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                    <div class="card portal-card h-100" style="background: #0D4F26; padding: 2rem; border-radius: 12px; border: none; text-align: center; color: #FFFFFF; transition: transform 0.3s; box-shadow: 0 10px 20px rgba(13,79,38,0.15);">
                        <div style="width: 70px; height: 70px; background: #F4C430; color: #0D4F26; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 1.5rem;">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">University E-Portal</h3>
                        <p style="color: #F0F9F3; font-size: 0.95rem; margin-bottom: 0;">Course registration, result checking, and academic profile.</p>
                    </div>
                </a>
            </div>
            
            <!-- Timetable Shortcut (Dynamic) -->
            <div class="col-md-4">
                @if(isset($timetableItem) && $timetableItem)
                <a href="{{ asset('storage/' . $timetableItem->file_path) }}" target="_blank" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                @else
                <a href="#downloads-section" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                @endif
                    <div class="card portal-card h-100" style="background: #FFFFFF; padding: 2rem; border-radius: 12px; border: 2px solid #0D4F26; text-align: center; color: #0D4F26; transition: transform 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                        <div style="width: 70px; height: 70px; background: #F0F9F3; color: #0D4F26; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 1.5rem;">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">Lecture Timetable</h3>
                        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">View current semester schedule for all sub-departments.</p>
                    </div>
                </a>
            </div>

            <!-- Library -->
            <div class="col-md-4">
                <a href="#" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                    <div class="card portal-card h-100" style="background: #FFFFFF; padding: 2rem; border-radius: 12px; border: none; text-align: center; color: #0D4F26; transition: transform 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.05);">
                        <div style="width: 70px; height: 70px; background: #F0F9F3; color: #0D4F26; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 1.5rem;">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">E-Library</h3>
                        <p style="color: #475569; font-size: 0.95rem; margin-bottom: 0;">Access tons of research papers, journals, and textbooks.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. Categorized Downloads (#FFFFFF) -->
<section id="downloads-section" style="background: #FFFFFF; padding: 5rem 0;">
    <div class="container reveal reveal-up">
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: #0D4F26; font-family: var(--font-heading);">Document Archives</h2>
            <div style="width: 60px; height: 4px; background: #F4C430; margin: 1rem auto;"></div>
            <p style="color: #475569; font-size: 1.1rem; max-width: 600px; margin: 0 auto;">Download handbooks, project guidelines, past questions, and administrative forms.</p>
        </div>

        @if($categories->count() > 0)
            <div class="row g-5">
                @foreach($categories as $category)
                    @php 
                        $items = $resourcesByCategory[$category->slug] ?? collect(); 
                    @endphp
                    
                    @if($items->count() > 0)
                    <div class="col-lg-6">
                        <div style="background: #FFFFFF; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); height: 100%;">
                            <!-- Category Header -->
                            <div style="background: #F0F9F3; padding: 1.5rem 2rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 45px; height: 45px; background: #0D4F26; color: #FFFFFF; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                    <i class="fa-solid fa-folder-open"></i>
                                </div>
                                <h3 style="font-size: 1.3rem; font-weight: 700; color: #0D4F26; margin: 0;">{{ $category->name }}</h3>
                            </div>
                            
                            <!-- Items List -->
                            <div style="padding: 1.5rem 2rem;">
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    @foreach($items as $item)
                                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; border-bottom: 1px dashed #cbd5e1; {{ $loop->last ? 'border-bottom: none; padding-bottom: 0;' : '' }} {{ $loop->first ? 'padding-top: 0;' : '' }}">
                                        <div>
                                            <h4 style="font-size: 1.05rem; font-weight: 600; color: #1e293b; margin-bottom: 0.3rem;">{{ $item->title }}</h4>
                                            @if($item->description)
                                                <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 0; line-height: 1.4;">{{ Str::limit($item->description, 60) }}</p>
                                            @endif
                                            <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.4rem; font-weight: 500; text-transform: uppercase;">
                                                <i class="fa-regular fa-clock"></i> {{ $item->uploaded_at ? \Carbon\Carbon::parse($item->uploaded_at)->format('M d, Y') : $item->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                        
                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn" style="background: #F0F9F3; color: #0D4F26; border: 1px solid #c6f6d5; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Download" download>
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 4rem 2rem; background: #F0F9F3; border-radius: 16px; border: 1px dashed #cbd5e1;">
                <i class="fa-regular fa-folder-closed" style="font-size: 3.5rem; color: #94a3b8; margin-bottom: 1rem;"></i>
                <h3 style="color: #475569; font-size: 1.25rem;">No resources currently available</h3>
                <p style="color: #64748b; margin: 0;">Check back later for updated documents and forms.</p>
            </div>
        @endif
    </div>
</section>

<style>
    .portal-card:hover {
        transform: translateY(-8px);
    }
</style>

@endsection