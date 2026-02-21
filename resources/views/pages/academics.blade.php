@extends('layouts.public')
@section('title', 'Academics')

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 0;">Academic Programmes</h1>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: var(--spacing-lg);">
    <div class="main-content">
        <section id="programmes-overview" style="margin-bottom: var(--spacing-xl);">
            <h2>Programmes Overview</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <p style="font-size: 1.1rem; line-height: 1.8;">We offer rigorous academic paths ranging from undergraduate to doctoral studies, customized to meet global technology demands and equip our graduates with both theoretical and practical prowess.</p>
        </section>

        @foreach($programmes as $prog)
        <section id="{{ $prog->slug }}" style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-lg); border-bottom: 1px solid var(--color-border);">
            <h3 style="font-size: 1.8rem; color: var(--color-primary);">{{ $prog->name }}</h3>
            <div style="display: flex; gap: 1rem; margin-bottom: 1rem; color: var(--color-text-muted); font-size: 0.95rem;">
                <span style="background: var(--color-bg-alt); padding: 0.3rem 0.8rem; border-radius: 20px;"><i class="fa-regular fa-clock"></i> {{ $prog->duration }}</span>
                <span style="background: var(--color-bg-alt); padding: 0.3rem 0.8rem; border-radius: 20px;"><i class="fa-solid fa-book-open"></i> {{ $prog->mode_of_study }}</span>
            </div>
            <p style="line-height: 1.7;">{{ $prog->description }}</p>
            
            @if($prog->objectives)
            <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; margin-top: 1.5rem; border-left: 4px solid var(--color-secondary);">
                <h4 style="margin-top: 0; font-size: 1.1rem;">Objectives</h4>
                <p style="margin-bottom: 0;">{{ $prog->objectives }}</p>
            </div>
            @endif
            
            @if($prog->career_pathways)
            <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; margin-top: 1.5rem; border-left: 4px solid var(--color-accent);">
                <h4 style="margin-top: 0; font-size: 1.1rem;">Career Pathways</h4>
                <p style="margin-bottom: 0;">{{ $prog->career_pathways }}</p>
            </div>
            @endif
        </section>
        @endforeach

        <section id="course-structure" style="margin-bottom: var(--spacing-xl);">
            <h2>Course Structure</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            @foreach($courses as $level => $levelCourses)
            <div style="background: var(--color-bg-alt); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <h3 style="margin-top: 0; color: var(--color-primary);">Level {{ $level }} Courses</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr style="background: var(--color-primary); color: white;">
                                <th style="padding: 10px; text-align: left; border-radius: 4px 0 0 0;">Code</th>
                                <th style="padding: 10px; text-align: left;">Title</th>
                                <th style="padding: 10px; text-align: center;">Units</th>
                                <th style="padding: 10px; text-align: center;">Semester</th>
                                <th style="padding: 10px; text-align: center; border-radius: 0 4px 0 0;">Type</th>
                            </tr>
                        </thead>
                        <tbody style="background: var(--color-bg-main);">
                            @foreach($levelCourses as $course)
                            <tr style="border-bottom: 1px solid var(--color-border);">
                                <td style="padding: 12px 10px;"><strong style="color: var(--color-secondary);">{{ $course->code }}</strong></td>
                                <td style="padding: 12px 10px;">{{ $course->title }}</td>
                                <td style="padding: 12px 10px; text-align: center; color: var(--color-text-muted);">{{ $course->credit_units }}</td>
                                <td style="padding: 12px 10px; text-align: center; color: var(--color-text-muted);">{{ $course->semester }}</td>
                                <td style="padding: 12px 10px; text-align: center;">
                                    <span style="background: {{ $course->is_elective ? 'var(--color-bg-alt)' : 'var(--color-primary)' }}; color: {{ $course->is_elective ? '#666' : 'white' }}; padding: 3px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                                        {{ $course->is_elective ? 'Elective' : 'Core' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </section>
    </div>

    @php
        $sections = ['programmes-overview' => 'Programmes Overview'];
        foreach($programmes as $p) {
            $sections[$p->slug] = $p->name;
        }
        $sections['course-structure'] = 'Course Structure';
    @endphp
    <x-sticky-toc :sections="$sections" />
</div>
@endsection
