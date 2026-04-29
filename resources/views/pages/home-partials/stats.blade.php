<!-- QUICK STATS BAR -->
<section data-aos="fade-up" style="background-color: #0D4F26; color: #FFFFFF; padding: 2.5rem 0; position: relative;">
    <div class="container px-4" data-aos="fade-up">
        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.2rem; text-align: center;">
            @php
                $statValues = [
                    '3', 
                    $staffCount ?? '50+', 
                    $gs('stat_students_count', '2,500+'), 
                    $programmes->count() ?? '15', 
                    now()->year - (int)config('university.established', 2002)
                ];
                $statLabels = [
                    'Number of Sub-Departments',
                    'Academic Staff',
                    'Registered Students',
                    'Programmes Offered',
                    'Years of Excellence'
                ];
                $statIcons = [
                    'fa-solid fa-building-user',
                    'fa-solid fa-chalkboard-user',
                    'fa-solid fa-users',
                    'fa-solid fa-graduation-cap',
                    'fa-solid fa-award'
                ];
            @endphp
            @foreach([0,1,2,3,4] as $i)
            <div data-aos="fade-up" class="stat-card" style="padding: 1rem; transition-delay: {{ $i * 100 }}ms;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem; color: #a7f3d0;"><i class="{{ $statIcons[$i] }}"></i></div>
                <h2 style="font-size: 2.2rem; font-weight: 800; margin: 0 0 0.2rem; color: #ffffff;">{{ $statValues[$i] }}</h2>
                <p style="margin: 0; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #86efac;">{{ $statLabels[$i] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
