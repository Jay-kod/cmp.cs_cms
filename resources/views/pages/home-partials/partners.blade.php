@if(isset($partners) && $partners->count() > 0)
<!-- OUR PARTNERS - Modern Glass UI -->
<section style="padding: 6rem 0; background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%); position: relative; overflow: hidden;">
    <!-- Abstract Background Blobs -->
    <div style="position: absolute; top: -10%; left: -5%; width: 400px; height: 400px; background: rgba(59, 130, 246, 0.1); filter: blur(80px); border-radius: 50%; z-index: 1;"></div>
    <div style="position: absolute; bottom: -10%; right: -5%; width: 500px; height: 500px; background: rgba(16, 185, 129, 0.1); filter: blur(100px); border-radius: 50%; z-index: 1;"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="margin-bottom: 4rem; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
            <span style="color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(255,255,255,0.6); padding: 0.4rem 1.2rem; border-radius: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); backdrop-filter: blur(4px); border: 1px solid rgba(255,255,255,0.8); text-align: center !important;">Our Network</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem; letter-spacing: -0.5px; text-align: center !important;">Industry Partners</h2>
            <p style="color: #475569; font-size: 1.15rem; max-width: 650px; margin: 0 auto; line-height: 1.7; text-align: center !important;">Collaborating with top-tier technology giants and academic institutions to bring you world-class opportunities.</p>
        </div>

        <style>
            .partners-marquee-wrapper {
                width: 100%;
                overflow: hidden;
                padding: 1.5rem 0;
                position: relative;
                -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
                mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            }
            .partners-marquee-content {
                display: flex;
                width: max-content;
                animation: marquee-scroll 40s linear infinite;
            }
            .marquee-track {
                display: flex;
                align-items: center;
                gap: 6rem;
                padding-right: 6rem;
            }
            .partners-marquee-wrapper:hover .partners-marquee-content {
                animation-play-state: paused;
            }
            @keyframes marquee-scroll {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
        </style>

        <div class="partners-marquee-wrapper">
            <div class="partners-marquee-content">
                {{-- Track 1 (Original) --}}
                <div class="marquee-track">
                    @for($i = 0; $i < 4; $i++)
                        @foreach($partners as $partner)
                            <a href="{{ $partner->url ?? '#' }}" 
                               target="{{ $partner->url ? '_blank' : '_self' }}" 
                               rel="{{ $partner->url ? 'noopener noreferrer' : '' }}" 
                               style="display: block; text-decoration: none; transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); flex-shrink: 0;"
                               onmouseover="this.style.transform='scale(1.15)'"
                               onmouseout="this.style.transform='scale(1)'"
                               title="{{ $partner->name }}">
                               
                                @if($partner->logo)
                                    <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" style="max-width: 180px; max-height: 70px; object-fit: contain; transition: all 0.4s ease;">
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center; height: 70px;">
                                        <h3 style="margin: 0; color: #64748b; font-size: 1.4rem; font-family: var(--font-heading); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; text-align: center; transition: color 0.4s ease;"
                                            onmouseover="this.style.color='var(--color-primary, #3b82f6)'"
                                            onmouseout="this.style.color='#64748b'">
                                            {{ $partner->name }}
                                        </h3>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    @endfor
                </div>
                {{-- Track 2 (Clone for infinite seamless scroll) --}}
                <div class="marquee-track" aria-hidden="true">
                    @for($i = 0; $i < 4; $i++)
                        @foreach($partners as $partner)
                            <a href="{{ $partner->url ?? '#' }}" 
                               target="{{ $partner->url ? '_blank' : '_self' }}" 
                               rel="{{ $partner->url ? 'noopener noreferrer' : '' }}" 
                               style="display: block; text-decoration: none; transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1); flex-shrink: 0;"
                               onmouseover="this.style.transform='scale(1.15)'"
                               onmouseout="this.style.transform='scale(1)'"
                               title="{{ $partner->name }}">
                               
                                @if($partner->logo)
                                    <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" style="max-width: 180px; max-height: 70px; object-fit: contain; transition: all 0.4s ease;">
                                @else
                                    <div style="display: flex; align-items: center; justify-content: center; height: 70px;">
                                        <h3 style="margin: 0; color: #64748b; font-size: 1.4rem; font-family: var(--font-heading); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; text-align: center; transition: color 0.4s ease;"
                                            onmouseover="this.style.color='var(--color-primary, #3b82f6)'"
                                            onmouseout="this.style.color='#64748b'">
                                            {{ $partner->name }}
                                        </h3>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>
@endif
