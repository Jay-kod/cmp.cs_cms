<!-- MEET OUR STAFF -->
<section data-aos="fade-up" style="padding: 6rem 0; background: #f4fcfa; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -80px; left: -80px; width: 250px; height: 250px; background: radial-gradient(circle, rgba(22,163,74,0.06) 0%, transparent 70%); pointer-events: none;"></div>
    <div class="container" data-aos="fade-up" style="position: relative; z-index: 2;">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; color: var(--color-primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; background: rgba(22,163,74,0.1); padding: 0.3rem 1rem; border-radius: 20px;">{{ $gs('home_staff_badge','Our Team') }}</span>
            <h2 style="font-size: 2.8rem; font-family: var(--font-heading); font-weight: 800; color: #0f172a; margin-bottom: 1rem;">{{ $gs('home_staff_title','Meet Our Faculty') }}</h2>
            <p style="color: #64748b; font-size: 1.1rem; max-width: 600px; margin: 0 auto; line-height: 1.7; text-align: center !important;">{{ $gs('home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.') }}</p>
        </div>

        <div class="staff-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            @foreach($featuredStaff as $member)
            <a href="{{ route('people.show', $member->slug) }}" class="staff-home-card" style="text-decoration: none; color: inherit; background: #f8fafc; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; transition: all 0.35s ease;">
                <div data-aos="fade-up" class="staff-card-img" style="position: relative; padding-top: 125%; overflow: hidden;">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: top center; transition: transform 0.5s;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=400&background=14532d&color=fff&bold=true&format=svg&font-size=0.35" alt="{{ $member->name }}" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: top center; transition: transform 0.5s;">
                    @endif
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px; background: linear-gradient(to top, rgba(0,0,0,0.4), transparent); pointer-events: none;"></div>
                </div>
                <div style="padding: 1.2rem 1.5rem; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <h3 style="font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 0 0 0.3rem; font-family: var(--font-heading); text-align: center; width: 100%;">{{ $member->name }}</h3>
                    <div style="font-size: 0.85rem; color: var(--color-primary); font-weight: 600; margin: 0 auto; text-align: center; width: 100%;">{{ $member->rank ?? 'Lecturer' }}</div>
                </div>
            </a>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ url('/people') }}" style="display: inline-flex; align-items: center; gap: 0.6rem; background: var(--color-primary); color: white; padding: 0.8rem 2rem; border-radius: 10px; font-size: 1rem; font-weight: 700; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 15px rgba(22,163,74,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(22,163,74,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22,163,74,0.3)'">
                {{ $gs('home_staff_btn_text','View All Staff') }} <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>
    </div>
</section>
