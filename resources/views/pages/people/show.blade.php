@extends('layouts.public')
@section('title', $staff->name)

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 3rem 0; border-bottom: 4px solid var(--color-accent);">
    <div class="container" style="display: flex; gap: 2.5rem; align-items: flex-end; flex-wrap: wrap;">
        <div style="background: white; padding: 5px; border-radius: 50%; width: 160px; height: 160px; margin-bottom: -4rem; position: relative; z-index: 10; box-shadow: 0 5px 15px rgba(0,0,0,0.15);">
            <img src="{{ $staff->photo ? asset('storage/'.$staff->photo) : asset('build/assets/placeholder.jpg') }}" alt="{{ $staff->name }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;" onerror="this.src='https://via.placeholder.com/150?text=Profile'">
        </div>
        <div style="padding-bottom: 1rem;">
            <h1 style="color: white; margin-bottom: 0.5rem; font-size: 2.2rem;">{{ $staff->name }}</h1>
            <p style="font-size: 1.2rem; color: #dae3f2; margin-bottom: 0;">{{ $staff->title }} | {{ $staff->rank }}</p>
            @if($staff->is_hod)
            <span style="display: inline-block; background: var(--color-accent); color: var(--color-primary); padding: 4px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; margin-top: 0.8rem;"><i class="fa-solid fa-star"></i> Head of Department</span>
            @endif
        </div>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: 4rem;">
    <div class="main-content">
        <section id="biography" style="margin-bottom: var(--spacing-xl);">
            <h2>Biography</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <div style="background: var(--color-bg-alt); padding: 2rem; border-radius: 8px; font-size: 1.05rem; line-height: 1.8;">
                {!! nl2br(e($staff->bio ?? 'Biography information is currently unavailable.')) !!}
            </div>
        </section>

        <section id="qualifications" style="margin-bottom: var(--spacing-xl);">
            <h2>Qualifications</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <ul style="list-style: none; padding: 0;">
                @forelse($staff->qualifications as $qual)
                <li style="margin-bottom: 1.2rem; padding-left: 2.5rem; position: relative;">
                    <i class="fa-solid fa-graduation-cap" style="position: absolute; left: 0; top: 4px; color: var(--color-primary); font-size: 1.2rem; background: var(--color-bg-alt); padding: 8px; border-radius: 50%;"></i>
                    <strong style="font-size: 1.1rem; color: var(--color-primary);">{{ $qual->degree }}</strong> {{ $qual->field_of_study ? 'in '.$qual->field_of_study : '' }}<br>
                    <span style="color: var(--color-text-muted); font-size: 0.95rem;">{{ $qual->institution }} ({{ $qual->year }})</span>
                </li>
                @empty
                <p style="color: var(--color-text-muted); font-style: italic;">No qualifications listed.</p>
                @endforelse
            </ul>
        </section>

        @if($staff->publications->count() > 0)
        <section id="publications" style="margin-bottom: var(--spacing-xl);">
            <h2>Selected Publications</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($staff->publications as $pub)
                <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; border-left: 4px solid var(--color-secondary);">
                    <h4 style="margin-top: 0; margin-bottom: 0.5rem; font-size: 1.1rem; line-height: 1.4;">{{ $pub->title }}</h4>
                    <p style="font-size: 0.95rem; color: var(--color-text-muted); margin-bottom: 0.8rem;">
                        <em>{{ $pub->journal }}</em> ({{ $pub->year }}) <span style="display: inline-block; background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem; margin-left: 5px; text-transform: uppercase;">{{ $pub->type }}</span>
                    </p>
                    @if($pub->url)
                    <a href="{{ $pub->url }}" target="_blank" style="font-size: 0.85rem; font-weight: 600; color: var(--color-primary);"><i class="fa-solid fa-external-link"></i> View Publication</a>
                    @endif
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
    
    <div class="sidebar-toc" style="width: 300px;">
        <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; border-top: 4px solid var(--color-primary); margin-bottom: 2rem;">
            <h3 style="margin-top: 0; margin-bottom: 1.2rem; font-size: 1.2rem;"><i class="fa-solid fa-address-card" style="color: var(--color-secondary);"></i> Contact Info</h3>
            @if($staff->office_location)
            <p style="margin-bottom: 1rem; display: flex; gap: 12px;"><i class="fa-solid fa-building" style="color: var(--color-secondary); margin-top: 4px; width: 16px;"></i> <span>{{ $staff->office_location }}</span></p>
            @endif
            @if($staff->email)
            <p style="margin-bottom: 1rem; display: flex; gap: 12px;"><i class="fa-solid fa-envelope" style="color: var(--color-secondary); margin-top: 4px; width: 16px;"></i> <span><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></span></p>
            @endif
            @if($staff->phone)
            <p style="margin-bottom: 1rem; display: flex; gap: 12px;"><i class="fa-solid fa-phone" style="color: var(--color-secondary); margin-top: 4px; width: 16px;"></i> <span>{{ $staff->phone }}</span></p>
            @endif
            
            @if($staff->google_scholar_url || $staff->researchgate_url)
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--color-border);">
                <h4 style="margin-top: 0; margin-bottom: 1rem; font-size: 1rem;">Academic Profiles</h4>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    @if($staff->google_scholar_url)
                    <a href="{{ $staff->google_scholar_url }}" target="_blank" class="btn btn-secondary" style="background: #4285F4; color: white; border: none; padding: 0.5rem 1rem; font-size: 0.85rem; flex: 1; text-align: center;"><i class="fa-brands fa-google"></i> Scholar</a>
                    @endif
                    @if($staff->researchgate_url)
                    <a href="{{ $staff->researchgate_url }}" target="_blank" class="btn btn-secondary" style="background: #00CCBB; color: white; border: none; padding: 0.5rem 1rem; font-size: 0.85rem; flex: 1; text-align: center;">ResearchGate</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
        
        @php
            $sections = ['biography' => 'Biography', 'qualifications' => 'Qualifications'];
            if($staff->publications->count() > 0) $sections['publications'] = 'Selected Publications';
        @endphp
        <x-sticky-toc :sections="$sections" />
    </div>
</div>
@endsection
