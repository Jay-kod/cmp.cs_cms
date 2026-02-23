@extends('layouts.public')
@section('title', 'People')

@section('content')
@php
    $hs = \App\Models\DepartmentSetting::where('group', 'page_people')->pluck('value', 'key')->toArray();
    $heroImg = \App\Models\DepartmentSetting::where('key', 'hero_people')->value('value');
    $heroUrl = $heroImg && file_exists(storage_path('app/public/' . $heroImg)) 
        ? asset('storage/' . $heroImg) 
        : null;
@endphp

<div class="page-header" style="{{ $heroUrl ? "background: linear-gradient(rgba(15,23,42,0.85), rgba(15,23,42,0.85)), url('{$heroUrl}') center/cover;" : 'background: var(--color-primary);' }} color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 0;">{{ $hs['people_hero_title'] ?? 'Our People' }}</h1>
        @if(!empty($hs['people_hero_subtitle']))
        <p style="margin-top: 1rem; color: rgba(255,255,255,0.8); font-size: 1.1rem; max-width: 600px; margin-left: auto; margin-right: auto;">{{ $hs['people_hero_subtitle'] }}</p>
        @endif
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: var(--spacing-lg);">
    <div class="main-content">
        @if($hod)
        <section id="head-of-department" style="margin-bottom: var(--spacing-xl);">
            <h2>Head of Department</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <div style="display: flex; gap: 2rem; background: var(--color-bg-alt); padding: 2.5rem; border-radius: 8px; flex-wrap: wrap; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid var(--color-border);">
                <div style="flex: 0 0 220px;">
                    <img src="{{ $hod->photo ? asset('storage/'.$hod->photo) : asset('build/assets/placeholder.jpg') }}" alt="{{ $hod->name }}" style="width: 100%; border-radius: 8px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);" onerror="this.src='https://via.placeholder.com/300?text=Profile'">
                </div>
                <div style="flex: 1; min-width: 250px;">
                    <h3 style="margin-top: 0; margin-bottom: 0.5rem; font-size: 1.8rem; color: var(--color-primary);">{{ $hod->name }}</h3>
                    <p style="color: var(--color-secondary); font-weight: 600; font-size: 1.1rem; margin-bottom: 0.5rem;">{{ $hod->title }}, Head of Department</p>
                    @if($hod->role)
                        <p style="margin: 0 0 0.5rem 0;"><span style="display: inline-block; background: #ede9fe; color: #6d28d9; padding: 3px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600;"><i class="fa-solid fa-id-badge" style="margin-right: 4px;"></i>{{ $hod->role }}</span></p>
                    @endif
                    @if($hod->qualifications)
                        <p style="color: var(--color-text-main); font-weight: 500; font-size: 0.95rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-graduation-cap" style="color: var(--color-accent); width: 20px;"></i> {{ $hod->qualifications }}</p>
                    @endif
                    
                    <div style="display: flex; flex-direction: column; gap: 0.8rem; margin-bottom: 1.5rem;">
                        <p style="color: var(--color-text-main); margin: 0;"><i class="fa-solid fa-microchip" style="color: var(--color-accent); width: 20px;"></i> <strong>Specialisation:</strong> {{ $hod->specialisation }}</p>
                        @if($hod->email)
                        <p style="color: var(--color-text-main); margin: 0;"><i class="fa-solid fa-envelope" style="color: var(--color-accent); width: 20px;"></i> <a href="mailto:{{ $hod->email }}">{{ $hod->email }}</a></p>
                        @endif
                    </div>
                    
                    <a href="{{ route('people.show', $hod->slug) }}" class="btn btn-primary" style="background: var(--color-primary); color: white;">View Full Profile</a>
                </div>
            </div>
        </section>
        @endif

        <section id="academic-staff" style="margin-bottom: var(--spacing-xl);">
            <h2>Academic Staff</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-md);">
                @foreach($academicStaff as $staff)
                @if($hod && $staff->id === $hod->id) @continue @endif
                <div style="background: var(--color-bg-main); border: 1px solid var(--color-border); border-radius: 8px; padding: 2rem 1.5rem; text-align: center; transition: all 0.3s; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.02)';">
                    <img src="{{ $staff->photo ? asset('storage/'.$staff->photo) : asset('build/assets/placeholder.jpg') }}" alt="{{ $staff->name }}" style="width: 140px; height: 140px; border-radius: 50%; object-fit: cover; margin-bottom: 1.2rem; border: 4px solid var(--color-bg-alt); box-shadow: 0 4px 10px rgba(0,0,0,0.05);" onerror="this.src='https://via.placeholder.com/150?text=Profile'">
                    <h4 style="margin-bottom: 0.25rem; font-size: 1.2rem;"><a href="{{ route('people.show', $staff->slug) }}" style="color: var(--color-primary); text-decoration: none;">{{ $staff->name }}</a></h4>
                    <p style="color: var(--color-secondary); font-size: 0.95rem; margin-bottom: 0.3rem; font-weight: 500;">{{ $staff->rank }}</p>
                    @if($staff->role)
                        <p style="margin: 0.3rem 0;"><span style="display: inline-block; background: #ede9fe; color: #6d28d9; padding: 2px 8px; border-radius: 4px; font-size: 0.78rem; font-weight: 600;"><i class="fa-solid fa-id-badge" style="margin-right: 3px;"></i>{{ $staff->role }}</span></p>
                    @endif
                    @if($staff->qualifications)
                        <p style="color: var(--color-text-main); font-size: 0.85rem; margin-bottom: 0.8rem; font-weight: 600;"><i class="fa-solid fa-graduation-cap" style="color: var(--color-accent);"></i> {{ $staff->qualifications }}</p>
                    @endif
                    <p style="color: var(--color-text-muted); font-size: 0.85rem; line-height: 1.5;"><i class="fa-solid fa-microchip"></i> {{ $staff->specialisation }}</p>
                </div>
                @endforeach
            </div>
        </section>
    </div>

    <x-sticky-toc :sections="['head-of-department' => 'Head of Department', 'academic-staff' => 'Academic Staff']" />
</div>
@endsection
