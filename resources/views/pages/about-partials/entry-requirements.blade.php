        <!-- ═══════════ ENTRY REQUIREMENTS ═══════════ -->
        <section id="entry-requirements" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Entry Requirements</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-req-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                @php
                    $requirements = [
                        ['level' => 'O\' Level', 'icon' => 'fa-school', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'WAEC/NECO with 5 credits including Maths & English'],
                        ['level' => 'A\' Level', 'icon' => 'fa-book-open', 'color' => '#15803d', 'bg' => '#f0fdf4', 'desc' => 'Advanced Level or JUPEB with required passes'],
                        ['level' => 'UTME', 'icon' => 'fa-pen-fancy', 'color' => '#059669', 'bg' => '#ecfdf5', 'desc' => 'Mathematics, English, Physics & one of Chemistry/Biology/Economics'],
                        ['level' => 'Postgraduate', 'icon' => 'fa-user-graduate', 'color' => '#10b981', 'bg' => '#f0fdf4', 'desc' => 'B.Sc. in Computer Science or related field with minimum of 2nd Class'],
                        ['level' => 'PhD', 'icon' => 'fa-hat-wizard', 'color' => '#047857', 'bg' => '#ecfdf5', 'desc' => 'M.Sc. in Computer Science or related field'],
                    ];
                @endphp
                @foreach($requirements as $req)
                <div class="about-req-card hover-lift" style="padding: 1.5rem 1rem; background: {{ $req['bg'] }}; border-radius: 12px; text-align: center; border: 1px solid {{ $req['color'] }}15; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 30px -8px {{ $req['color'] }}25'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="width: 44px; height: 44px; background: {{ $req['color'] }}; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin: 0 auto 0.8rem; box-shadow: 0 6px 15px -3px {{ $req['color'] }}40; transition: transform 0.3s;" class="req-icon">
                        <i class="fa-solid {{ $req['icon'] }}"></i>
                    </div>
                    <h4 style="margin: 0 0 0.4rem; font-size: 1rem; color: #1e293b; font-weight: 700;">{{ $req['level'] }}</h4>
                    <p style="margin: 0; font-size: 0.82rem; color: #64748b; line-height: 1.5; text-align: center;">{{ $req['desc'] }}</p>
                </div>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="{{ url('/academics') }}" style="display: inline-flex; align-items: center; gap: 0.6rem; font-size: 0.9rem; color: var(--color-primary); font-weight: 600; text-decoration: none; padding: 0.6rem 1.5rem; border: 2px solid var(--color-primary); border-radius: 10px; transition: all 0.3s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white'" onmouseout="this.style.background='transparent'; this.style.color='var(--color-primary)'">See Full Admission Details <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem;"></i></a>
            </div>
        </section>
