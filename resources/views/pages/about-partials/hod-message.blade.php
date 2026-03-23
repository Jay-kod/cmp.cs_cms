<div style="margin: 4rem 0;">
    <div class="reveal reveal-up" style="text-align: center; margin-bottom: 2.5rem;">
        <h3 style="font-size: 1.8rem; color: #0f172a; margin: 0 0 0.5rem; font-family: var(--font-heading); font-weight: 800;">From the HOD's Desk</h3>
    </div>
    
    <div style="background: #ffffff; border-radius: 16px; padding: 2.5rem; border: 1px solid rgba(22,163,74,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        @if(isset($hod) && $hod)
        <div style="display: flex; flex-wrap: wrap; gap: 3rem; align-items: center;">
            <div style="flex: 0 0 250px; text-align: center; margin: 0 auto;">
                <div style="width: 250px; height: 300px; border-radius: 12px; overflow: hidden; margin-bottom: 1rem; border: 3px solid #f8fafc;">
                    <img src="{{ isset($hod->photo) ? app(\App\Services\MediaOptimizationService::class)->webpOrOriginalUrl($hod->photo, 400) : asset('images/default-avatar.jpg') }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h4 style="margin: 0 0 0.2rem; font-size: 1.2rem; font-weight: 700; color: #0f172a;">{{ $hod->name }}</h4>
                <p style="margin: 0; color: var(--color-primary); font-size: 0.95rem; font-weight: 600;">{{ $hod->rank ?? '' }}, HOD</p>
            </div>
            <div style="flex: 1; min-width: 300px;">
                <i class="fa-solid fa-quote-left" style="font-size: 3rem; color: rgba(22, 163, 74, 0.1); margin-bottom: -1rem; display: block;"></i>
                <div style="font-size: 1.05rem; line-height: 1.8; color: #475569; position: relative; z-index: 2;">
                    {!! nl2br(e(function_exists('$gs') ? $gs('hod_welcome_message', 'Welcome to the Department of Computer Science.') : 'Welcome to the Department of Computer Science.')) !!}
                </div>
            </div>
        </div>
        @else
        <div>
            <i class="fa-solid fa-quote-left" style="font-size: 3rem; color: rgba(22, 163, 74, 0.1); margin-bottom: -1rem; display: block;"></i>
            <p style="font-size: 1.05rem; line-height: 1.8; color: #475569; position: relative; z-index: 2;">
                {!! nl2br(e(function_exists('$gs') ? $gs('hod_welcome_message', 'Welcome to the Department of Computer Science.') : 'Welcome to the Department of Computer Science.')) !!}
            </p>
        </div>
        @endif
    </div>
</div>
