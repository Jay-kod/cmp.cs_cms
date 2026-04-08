<!-- CALL TO ACTION — Contact & Apply -->
<section data-aos="fade-up" style="padding: 2rem 0; position: relative;">
    <div class="container">
        <div style="background: linear-gradient(105deg, #14532d 0%, #15803d 100%); border-radius: 16px; padding: 2.5rem 1.5rem; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(21, 128, 61, 0.15); text-align: center;">
            <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.6%22 fill=%22rgba(255,255,255,0.04)%22/></svg>'); pointer-events: none;"></div>
            
            <div style="position: relative; z-index: 2; max-width: 600px; margin: 0 auto;">
                <h2 style="font-size: 1.8rem; font-family: var(--font-heading); font-weight: 800; color: white; margin: 0 0 0.8rem; line-height: 1.2;">{{ $gs('home_cta_title','Ready to Join Us?') }}</h2>
                <p style="font-size: 0.95rem; color: rgba(255,255,255,0.85); line-height: 1.6; margin: 0 0 1.8rem;">{{ $gs('home_cta_subtitle','Whether you\'re a prospective student, an alumnus, or just curious about the department — we\'d love to hear from you.') }}</p>
                
                <div style="display: flex; flex-direction: column; gap: 0.8rem; max-width: 350px; margin: 0 auto;">
                    @foreach([1,2,3] as $bi)
                    @php
                        $defaultBtnLabels = ['Contact Us', 'About the Department', 'View Programmes'];
                        $defaultBtnUrls   = ['/contact', '/about', '/academics'];
                        $defaultBtnIcons  = ['fa-solid fa-envelope', 'fa-solid fa-circle-info', 'fa-solid fa-graduation-cap'];
                        $btnText = $gs('home_cta_btn'.$bi.'_text', $defaultBtnLabels[$bi-1]);
                        $btnUrl  = $gs('home_cta_btn'.$bi.'_url',  $defaultBtnUrls[$bi-1]);
                        $btnIcon = $gs('home_cta_btn'.$bi.'_icon', $defaultBtnIcons[$bi-1]);
                    @endphp
                    @if($btnText && $btnUrl)
                    @if($bi === 1)
                    <a href="{{ $btnUrl }}" style="display: flex; align-items: center; justify-content: center; gap: 0.6rem; background: white; color: #14532d; padding: 0.85rem 1.5rem; border-radius: 8px; font-size: 0.95rem; font-weight: 700; text-decoration: none; transition: all 0.25s; box-shadow: 0 4px 12px rgba(0,0,0,0.15); width: 100%;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(0,0,0,0.15)'">
                        <i class="{{ $btnIcon }}"></i> {{ $btnText }}
                    </a>
                    @else
                    <a href="{{ $btnUrl }}" style="display: flex; align-items: center; justify-content: center; gap: 0.6rem; background: rgba(255,255,255,0.04); color: white; padding: 0.85rem 1.5rem; border-radius: 8px; font-size: 0.95rem; font-weight: 700; text-decoration: none; border: 1.5px solid rgba(255,255,255,0.2); transition: all 0.25s; width: 100%; backdrop-filter: blur(4px);" onmouseover="this.style.borderColor='rgba(255,255,255,0.4)'; this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'; this.style.background='rgba(255,255,255,0.04)'">
                        <i class="{{ $btnIcon }}"></i> {{ $btnText }}
                    </a>
                    @endif
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
