<!-- HOD WELCOME + STATS (Combined Section) -->
<section data-aos="fade-up" class="hod-section" style="padding: 5rem 0 0; background: #f8fafc; position: relative; overflow: hidden;">
    <!-- Abstract Background Decor -->
    <div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(22,163,74,0.08) 0%, transparent 70%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50px; left: 10%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%); pointer-events: none;"></div>
    
    <div class="container hod-grid" style="display: flex; gap: 5rem; align-items: center; flex-wrap: wrap; position: relative; z-index: 2;">
        
        <!-- HoD Text -->
        <div class="hod-text">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_hod_badge','Welcome Message') }}</span>
            <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; line-height: 1.15;">{{ $gs('home_hod_title','From the Head of Department') }}</h2>
            
            <div style="position: relative; padding-left: 2rem; margin-bottom: 2.5rem;">
                <i class="fa-solid fa-quote-left" style="position: absolute; top: -10px; left: -10px; font-size: 3.5rem; color: rgba(22,163,74,0.1); z-index: 0;"></i>
                <blockquote style="position: relative; z-index: 1; font-size: 1.15rem; color: #475569; line-height: 1.8; margin: 0; font-style: italic; text-align: justify;">
                    "{!! nl2br(e($gs('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.'))) !!}"
                </blockquote>
            </div>
            
            @if($hod || $gs('hod_name'))
            <div style="display: inline-flex; align-items: center; gap: 1.2rem; background: white; padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0;">
                <div style="width: 4px; height: 35px; background: linear-gradient(to bottom, var(--color-primary), var(--color-secondary)); border-radius: 2px;"></div>
                <div>
                    <h4 style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1.1rem; font-family: var(--font-heading);">{{ $gs('hod_name', $hod->name ?? '') }}</h4>
                    <p style="margin: 0; color: #64748b; font-size: 0.9rem; font-weight: 500;">{{ $gs('hod_rank', $hod->rank ?? '') }}, Head of Department</p>
                </div>
            </div>
            @endif
        </div>

        <!-- HoD Photo -->
        <div class="hod-photo" style="position: relative; max-width: 380px; margin: 0 auto; width: 100%;">
            <div style="position: absolute; inset: -12px -12px 12px 12px; border: 2px solid var(--color-primary); border-radius: 14px; z-index: 1;"></div>
            <div style="position: absolute; inset: 12px 12px -12px -12px; background: rgba(22,163,74,0.1); border-radius: 14px; z-index: 1;"></div>
            
            <div style="position: relative; z-index: 2; aspect-ratio: 3/4; border-radius: 14px; overflow: hidden; box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); border: 6px solid white;">
                @if($gs('hod_photo'))
                    <img src="{{ asset('storage/'.$gs('hod_photo')) }}" alt="{{ $gs('hod_name', $hod->name ?? 'HOD') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @elseif($hod && $hod->photo)
                    <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color:white; font-size:6rem;"><i class="fa-solid fa-user-tie"></i></div>
                @endif
                
                <!-- Floating Badge -->
                <div style="position: absolute; bottom: 20px; right: -20px; background: white; padding: 1rem 1.5rem; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; background: rgba(22,163,74,0.12); color: var(--color-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div>
                        <p style="margin: 0; font-weight: 800; color: #0f172a; font-size: 1.1rem; font-family: var(--font-heading); line-height: 1;">{{ $gs('home_hod_badge_title','Excellence') }}</p>
                        <p style="margin: 0; font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.2rem;">{{ $gs('home_hod_badge_subtitle','In Leadership') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Counter Cards — integrated into HOD section -->
    <div class="container" data-aos="fade-up" style="margin-top: 4rem; padding-bottom: 4rem;">
        <div class="stats-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1.2rem; text-align: center;">
            @foreach([1,2,3,4,5] as $n)
            @php
                $statIcon  = $gs("stat_{$n}_icon",  ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-medal'][$n-1]);
                $statLabel = $gs("stat_{$n}_label", ['Established','Courses','Programmes','Departments','Full Accreditation'][$n-1]);
                if ($n == 2 || stripos($statLabel, 'courses') !== false) {
                    $statValue = \App\Models\Course::count();
                } elseif ($n == 3 || stripos($statLabel, 'programmes') !== false) {
                    $statValue = \App\Models\Programme::where('is_active', true)->count();
                } elseif ($n == 4 || stripos($statLabel, 'departments') !== false) {
                    $statValue = \App\Models\ProgrammeCategory::count();
                } else {
                    $statValue = $gs("stat_{$n}_value", [config('university.established'), '', '', '', 'NUC'][$n-1]);
                }
            @endphp
            <div data-aos="fade-up" class="stat-card">
                <div class="stat-bg-icon"><i class="{{ $statIcon }}"></i></div>
                <h2 class="stat-number">{{ $statValue }}</h2>
                <p>{{ $statLabel }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


