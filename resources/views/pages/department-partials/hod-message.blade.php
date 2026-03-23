<section style="padding: 6rem 0; background: #F0F9F3; position: relative;">
    <div class="container reveal reveal-up">
        <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2.5rem;">
            <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">HOD's Welcome Message</h2>
        </div>

        <div style="background: #ffffff; border-radius: 16px; padding: 3rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid rgba(22,163,74,0.1); display: grid; grid-template-columns: 280px 1fr; gap: 3rem; align-items: center;">
            <div class="hod-profile" style="text-align: center;">
                <div style="width: 280px; height: 320px; border-radius: 12px; overflow: hidden; margin-bottom: 1.5rem; background: #f1f5f9; position: relative;">
                    @php
                        $hodImage = $gs("{$deptPrefix}_hod_image", 'images/default-avatar.jpg');
                    @endphp
                    <img src="{{ asset($hodImage) }}" alt="Head of Department" style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
                    <div style="position: absolute; inset: 0; border: 4px solid var(--color-primary); border-radius: 12px; opacity: 0.1; pointer-events: none;"></div>
                </div>
                <h3 style="font-size: 1.4rem; color: #0f172a; margin: 0 0 0.2rem; font-weight: 700;">{{ $gs("{$deptPrefix}_hod_name", 'Prof. Unknown') }}</h3>
                <p style="color: var(--color-primary); font-size: 0.9rem; font-weight: 600; margin: 0;">Head of Department</p>
            </div>
            
            <div class="hod-message-content">
                <i class="fa-solid fa-quote-left" style="font-size: 2.5rem; color: rgba(22, 163, 74, 0.1); margin-bottom: 1rem; display: block;"></i>
                <div style="font-size: 1.1rem; line-height: 1.8; color: #475569; position: relative;">
                    {!! nl2br(e($gs("{$deptPrefix}_hod_message", "Welcome to our department! We are thrilled to have you explore our academic programs. Our goal is to equip our students with the best technical knowledge and ethical foundations to succeed in the fast-paced world of technology."))) !!}
                </div>
            </div>
        </div>
    </div>
</section>