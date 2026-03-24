<!-- PROGRAMMES — Premium Glassmorphism Hover Cards -->
<section style="padding: 6rem 0; background: linear-gradient(to bottom, white 0%, #f8fafc 100%); position: relative;">
    <!-- Abstract wavy shape at the top -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; overflow: hidden; line-height: 0;">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative; display: block; width: calc(100% + 1.3px); height: 50px;">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" style="fill: #f8fafc;"></path>
        </svg>
    </div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(59,130,246,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_programmes_badge','What We Offer') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_programmes_title','Academic Programmes') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">{{ $gs('home_programmes_subtitle','Comprehensive undergraduate and postgraduate programmes designed to shape the next generation of global tech leaders.') }}</p>
        </div>
        
        <div class="hover-card-grid">
            @php
                $progColors = [
                    ['from' => '#16a34a', 'to' => '#059669', 'bg' => 'rgba(22,163,74,0.08)', 'badge' => '#dcfce7', 'badgeText' => '#15803d'],
                    ['from' => '#2563eb', 'to' => '#7c3aed', 'bg' => 'rgba(37,99,235,0.08)', 'badge' => '#dbeafe', 'badgeText' => '#1d4ed8'],
                    ['from' => '#0891b2', 'to' => '#0284c7', 'bg' => 'rgba(8,145,178,0.08)', 'badge' => '#cffafe', 'badgeText' => '#0e7490'],
                    ['from' => '#ea580c', 'to' => '#dc2626', 'bg' => 'rgba(234,88,12,0.08)', 'badge' => '#ffedd5', 'badgeText' => '#c2410c'],
                ];
                $progIcons = ['fa-solid fa-code', 'fa-solid fa-server', 'fa-solid fa-shield-halved', 'fa-solid fa-microchip', 'fa-solid fa-database'];
            @endphp
            @foreach($programmes as $pIdx => $prog)
            @php $pc = $progColors[$pIdx % count($progColors)]; @endphp
            <a href="{{ url('/academics#{{ $prog->slug }}') }}" class="hover-card" style="background: white; border-radius: 20px; text-decoration: none; color: inherit; position: relative; overflow: hidden; transition: all 0.3s ease; display: flex; flex-direction: column; box-shadow: 0 4px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                {{-- Gradient Header Strip --}}
                <div style="height: 6px; background: linear-gradient(90deg, {{ $pc['from'] }}, {{ $pc['to'] }});"></div>

                <div style="padding: 2rem 2rem 1.5rem;">
                    {{-- Icon + Badge Row --}}
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div class="hover-icon-wrapper" style="width: 56px; height: 56px; border-radius: 16px; background: {{ $pc['bg'] }}; color: {{ $pc['from'] }}; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; transition: all 0.3s ease;">
                            <i class="{{ $progIcons[$pIdx % count($progIcons)] }}"></i>
                        </div>
                        <span style="background: {{ $pc['badge'] }}; color: {{ $pc['badgeText'] }}; font-size: 0.75rem; font-weight: 700; padding: 0.35rem 0.9rem; border-radius: 20px; letter-spacing: 0.5px; text-transform: uppercase;">{{ $prog->level }}</span>
                    </div>

                    {{-- Programme Name --}}
                    <h3 style="font-size: 1.15rem; margin: 0 0 0.8rem; color: #1e293b; font-family: var(--font-heading); font-weight: 700; line-height: 1.3; transition: color 0.3s ease;" class="hover-title">{{ $prog->name }}</h3>

                    {{-- Description --}}
                    <p style="font-size: 0.88rem; color: #64748b; line-height: 1.6; flex: 1; margin: 0;">{{ Str::limit($prog->description, 100) }}</p>
                </div>

                {{-- Footer --}}
                <div style="padding: 1rem 2rem; border-top: 1px solid #f8fafc; display: flex; justify-content: space-between; align-items: center; margin-top: auto; background: white; transition: background 0.3s ease;" class="hover-footer">
                    <div style="display: flex; gap: 1.2rem; font-size: 0.78rem; color: #64748b; font-weight: 500;">
                        <span style="display: flex; align-items: center; gap: 0.4rem;"><i class="fa-regular fa-clock" style="color: {{ $pc['from'] }}; opacity: 0.8;"></i> {{ $prog->duration }}</span>
                        <span style="display: flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-book-open" style="color: {{ $pc['from'] }}; opacity: 0.8;"></i> {{ $prog->mode_of_study }}</span>
                    </div>
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #f1f5f9; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; transition: all 0.3s ease;" class="card-arrow" data-color="{{ $pc['from'] }}" data-bg="{{ $pc['bg'] }}"><i class="fa-solid fa-arrow-right"></i></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
