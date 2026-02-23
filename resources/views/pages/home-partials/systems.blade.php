<!-- DEPARTMENT SYSTEMS / EXTERNAL LINKS -->
@if($externalSystems->count())
<section style="padding: 6rem 0; background: linear-gradient(to bottom, #f8fafc, white); position: relative;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_systems_badge','Quick Access') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_systems_title','Department Systems') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gs('home_systems_subtitle','Access our online platforms, portals, and tools for students and staff.') }}</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem;">
            @foreach($externalSystems as $sys)
            <a href="{{ $sys->url }}" {{ $sys->open_in_new_tab ? 'target="_blank" rel="noopener"' : '' }} class="system-card" style="display: flex; flex-direction: column; align-items: center; text-align: center; gap: 1rem; padding: 2rem 1.5rem; background: white; border: 1px solid #e2e8f0; border-radius: 16px; text-decoration: none; transition: all 0.35s ease; box-shadow: 0 4px 12px rgba(0,0,0,0.04); position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-secondary)); transform: scaleX(0); transition: transform 0.3s; transform-origin: left;" class="sys-bar"></div>
                <div style="width: 56px; height: 56px; background: rgba(22,163,74,0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 1.5rem; transition: all 0.3s;">
                    <i class="{{ $sys->icon ?? 'fa-solid fa-globe' }}"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.05rem; font-weight: 700; color: #0f172a; margin: 0 0 0.3rem; font-family: var(--font-heading);">{{ $sys->name }}</h3>
                    @if($sys->description ?? false)
                    <p style="font-size: 0.85rem; color: #64748b; margin: 0; line-height: 1.4;">{{ Str::limit($sys->description, 60) }}</p>
                    @endif
                </div>
                <span style="font-size: 0.8rem; font-weight: 600; color: var(--color-primary); display: flex; align-items: center; gap: 0.3rem;">
                    Visit {{ $sys->open_in_new_tab ? '' : '' }}<i class="fa-solid {{ $sys->open_in_new_tab ? 'fa-up-right-from-square' : 'fa-arrow-right-long' }}" style="font-size: 0.7rem;"></i>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
