<!-- OUR PARTNERS -->
<section style="padding: 6rem 0; background: white; border-top: 1px solid #f1f5f9; position: relative;">
            <div class="container" style="position: relative; z-index: 2;">
                <div style="text-align: center; margin-bottom: 4rem;">
                    <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">Collaborators</span>
                    <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">Industry Partners</h2>
                    <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7;">Working together with leading organizations to provide the best opportunities.</p>
                </div>
        
                <div class="marquee-wrapper">
                    <div class="marquee-content reverse">
                        @foreach($partners as $partner)
                        @if($partner->url)
                        <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="partner-card" title="{{ $partner->name }}">
                        @else
                        <div class="partner-card" title="{{ $partner->name }}">
                        @endif
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="partner-logo">
                        @if($partner->url)
                        </a>
                        @else
                        </div>
                        @endif
                        @endforeach
                    </div>
                    {{-- Duplicate for seamless loop --}}
                    <div class="marquee-content reverse" aria-hidden="true">
                        @foreach($partners as $partner)
                        @if($partner->url)
                        <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="partner-card" title="{{ $partner->name }}">
                        @else
                        <div class="partner-card" title="{{ $partner->name }}">
                        @endif
                            <img src="{{ Storage::url($partner->logo) }}" alt="{{ $partner->name }}" class="partner-logo">
                        @if($partner->url)
                        </a>
                        @else
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
