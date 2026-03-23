@extends('layouts.public')
@section('title', $departmentName)

@section('content')
@php
    $gs = fn(string $k, string $v = '') => \App\Models\DepartmentSetting::where('key', $k)->value('value') ?? $v;
@endphp

<!-- 1. Page Banner + Breadcrumb (#0D4F26) -->
<section style="background: #0D4F26; padding: 4rem 0; color: #FFFFFF; text-align: center; position: relative;">
    <div class="container reveal reveal-up">
        <!-- Breadcrumb -->
        <div style="margin-bottom: 1.5rem; font-size: 0.9rem; font-weight: 500;">
            <a href="/" style="color: #F0F9F3; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;"><i class="fa-solid fa-house"></i> Home</a> 
            <span style="margin: 0 0.5rem; color: #a7f3d0;">/</span> 
            <span style="color: #F4C430;">Sub-Departments</span>
        </div>
        
        <h1 style="font-size: 2.8rem; font-weight: 800; margin-bottom: 1rem; color: #FFFFFF; font-family: var(--font-heading);">{{ $departmentName }}</h1>
        <p style="font-size: 1.15rem; max-width: 800px; margin: 0 auto; color: #F0F9F3; line-height: 1.6;">
            {{ $gs("{$departmentPrefix}_about_short", "Developing excellence and leading innovation in {$departmentName}.") }}
        </p>
    </div>
</section>

<!-- 2. HOD Message / About Dept (#FFFFFF and #F0F9F3 Split) -->
<section style="padding: 5rem 0; background: #FFFFFF;">
    <div class="container reveal reveal-up">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div style="background: #F0F9F3; padding: 2rem; border-radius: 16px; border-left: 5px solid #0D4F26; text-align: center;">
                    <!-- Fetching custom image or using placeholder -->
                    @php
                        $hodImageKey = "{$departmentPrefix}_hod_image";
                        $hodNameKey = "{$departmentPrefix}_hod_name";
                        $hodRankKey = "{$departmentPrefix}_hod_title";
                        
                        $hodImagePath = \App\Models\DepartmentSetting::where('key', $hodImageKey)->value('value');
                    @endphp
                    
                    <div style="width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.5rem; border: 4px solid #FFFFFF; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        @if($hodImagePath && file_exists(storage_path('app/public/'.$hodImagePath)))
                            <img src="{{ asset('storage/'.$hodImagePath) }}" alt="HOD Thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; background: #0D4F26; color: #FFFFFF; display: flex; align-items: center; justify-content: center; font-size: 4rem;">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        @endif
                    </div>
                    
                    <h3 style="font-size: 1.4rem; font-weight: 800; color: #0D4F26; margin-bottom: 0.3rem;">
                        {{ $gs($hodNameKey, 'HOD Name Not Set') }}
                    </h3>
                    <p style="color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; margin-bottom: 1rem;">
                        Head of {{ $departmentName }}
                    </p>
                </div>
            </div>
            
            <div class="col-lg-7">
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #0D4F26; margin-bottom: 1rem;">Welcome to the Department</h2>
                <div style="width: 60px; height: 4px; background: #F4C430; margin-bottom: 2rem;"></div>
                
                <div style="color: #475569; font-size: 1.05rem; line-height: 1.8;">
                    {!! nl2br(e($gs("{$departmentPrefix}_hod_message", "Welcome to the $departmentName. We are committed to fostering learning, cutting-edge research, and critical problem-solving skills."))) !!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Programmes (#F0F9F3) -->
<section style="background: #F0F9F3; padding: 5rem 0;">
    <div class="container reveal reveal-up">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: #0D4F26; font-family: var(--font-heading);">Programmes Offered</h2>
            <div style="width: 60px; height: 4px; background: #F4C430; margin: 1rem auto;"></div>
        </div>

        @if(isset($programmes) && $programmes->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 g-4 justify-content-center">
            @foreach($programmes as $prog)
            <div class="col">
                <div class="card h-100" style="background: #FFFFFF; border-radius: 12px; border: none; box-shadow: 0 10px 20px rgba(0,0,0,0.05); overflow: hidden; transition: transform 0.3s;">
                    <div style="background: #0D4F26; padding: 1.5rem 1.5rem 2rem; position: relative;">
                        <!-- Connector -->
                        <div style="position: absolute; bottom: -20px; left: 0; right: 0; height: 40px; background: #FFFFFF; border-radius: 20px 20px 0 0;"></div>
                        
                        <div style="width: 50px; height: 50px; background: #F4C430; color: #0D4F26; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 1rem;">
                            <i class="{{ $prog->category->icon ?? 'fa-solid fa-graduation-cap' }}"></i>
                        </div>
                        <h4 style="margin: 0; color: #FFFFFF; font-size: 1.25rem; font-weight: 700; line-height: 1.4;">{{ $prog->name }}</h4>
                    </div>
                    
                    <div class="card-body" style="padding: 1.5rem; z-index: 2; position: relative;">
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem; margin-bottom: 1rem;">
                            @if($prog->level)
                            <span style="background: #F0F9F3; color: #0D4F26; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #c6f6d5;">
                                <i class="fa-solid fa-layer-group"></i> {{ $prog->level }}
                            </span>
                            @endif
                            @if($prog->duration)
                            <span style="background: #f8fafc; color: #475569; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                                <i class="fa-regular fa-clock"></i> {{ $prog->duration }}
                            </span>
                            @endif
                        </div>
                        
                        @if($prog->description)
                        <p style="color: #475569; font-size: 0.95rem; line-height: 1.6; margin-bottom: 0;">
                            {{ Str::limit($prog->description, 100) }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('academics') }}" class="btn" style="background: #0D4F26; color: #FFFFFF; padding: 0.8rem 2.5rem; border-radius: 30px; font-weight: 600; text-decoration: none;">View All Academic Postings <i class="fa-solid fa-arrow-right-long ml-2"></i></a>
        </div>
        @else
        <div style="text-align: center; padding: 3rem; background: #FFFFFF; border-radius: 12px; border: 1px dashed #cbd5e1;">
            <p style="color: #64748b; margin: 0; font-size: 1.1rem;">Academic programmes specifically for {{ $departmentName }} are currently being updated.</p>
        </div>
        @endif
    </div>
</section>

<!-- 4. Department News & Highlights (#FFFFFF) -->
@if(isset($news) && $news->count() > 0)
<section style="background: #FFFFFF; padding: 5rem 0;">
    <div class="container reveal reveal-up">
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <h2 style="font-size: 2.2rem; font-weight: 800; color: #0D4F26; font-family: var(--font-heading);">Insights & Updates</h2>
            <div style="width: 60px; height: 4px; background: #F4C430; margin: 1rem auto;"></div>
        </div>

        <div class="row g-4">
            @foreach($news->take(3) as $article)
            <div class="col-md-4">
                <div class="card h-100" style="border: none; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden;">
                    @if($article->image)
                    <div style="height: 200px; overflow: hidden; background: #0D4F26;">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @else
                    <div style="height: 200px; background: #0D4F26; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.2);">
                        <i class="fa-solid fa-newspaper" style="font-size: 4rem;"></i>
                    </div>
                    @endif
                    <div class="card-body" style="padding: 1.5rem;">
                        <div style="color: #64748b; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.8rem; text-transform: uppercase;">
                            {{ \Carbon\Carbon::parse($article->published_at ?? $article->created_at)->format('M d, Y') }}
                        </div>
                        <h4 style="font-size: 1.2rem; font-weight: 700; color: #0D4F26; margin-bottom: 1rem;">
                            {{ Str::limit($article->title, 60) }}
                        </h4>
                        <a href="{{ route('research-news.show', $article->slug ?? $article->id) }}" style="color: #0D4F26; text-decoration: none; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.3rem;">
                            Read More <i class="fa-solid fa-arrow-right-long" style="color: #F4C430;"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection