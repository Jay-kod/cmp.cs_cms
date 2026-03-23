<!-- ABOUT THE DEPARTMENT (HOD WELCOME) -->
<section class="hod-section" style="padding: 5rem 0; background: #FFFFFF; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -100px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(22,163,74,0.08) 0%, transparent 70%); pointer-events: none;"></div>
    <div style="position: absolute; bottom: -50px; left: 10%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%); pointer-events: none;"></div>
    
    <div class="container hod-grid" style="display: flex; gap: 5rem; align-items: center; flex-wrap: wrap; position: relative; z-index: 2;">
        <!-- HoD Photo -->
        <div class="hod-photo reveal reveal-left" style="flex: 0 0 300px; max-width: 100%; position: relative;">
            <div style="position: absolute; inset: -12px -12px 12px 12px; border: 2px solid var(--color-primary); border-radius: 14px; z-index: 1;"></div>
            <div style="position: absolute; inset: 12px 12px -12px -12px; background: rgba(22,163,74,0.1); border-radius: 14px; z-index: 1;"></div>
            
            <div style="position: relative; z-index: 2; aspect-ratio: 3/4; border-radius: 14px; overflow: hidden; box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); border: 6px solid white;">
                @if($gs('hod_photo'))
                    <img src="{{ app(\App\Services\MediaOptimizationService::class)->webpOrOriginalUrl($gs('hod_photo'), 640) }}" alt="{{ $gs('hod_name', $hod->name ?? 'HOD') }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @elseif($hod && $hod->photo)
                    <img src="{{ app(\App\Services\MediaOptimizationService::class)->webpOrOriginalUrl($hod->photo, 640) }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                @else
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color:white; font-size:6rem;"><i class="fa-solid fa-user-tie"></i></div>
                @endif

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

        <!-- HoD Text -->
        <div class="hod-text reveal reveal-right" style="flex: 1; min-width: 320px;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_hod_badge','About Us') }}</span>
            <h2 style="font-size: 2.8rem; margin-bottom: 1.5rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; line-height: 1.15;">{{ $gs('home_hod_title','About the Department') }}</h2>
            
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
    </div>
</section>
