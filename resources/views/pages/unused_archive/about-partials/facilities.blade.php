        <!-- ═══════════ FACILITIES & LABS ═══════════ -->
        <section data-aos="fade-up" id="facilities" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-server"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Facilities & Labs</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 1rem; border-radius: 2px;"></div>
            <p style="font-size: 1.02rem; color: #64748b; line-height: 1.7; margin-bottom: 2rem;">Our department boasts state-of-the-art laboratories to support practical learning and research across various IT domains.</p>

            <div class="about-facilities-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.2rem;">
                @php
                    $labs = [
                        ['name' => 'Software Engineering Lab', 'icon' => 'fa-code', 'gradient' => 'linear-gradient(135deg, #16a34a, #15803d)', 'shadow' => 'rgba(22,163,74,0.3)', 'desc' => 'Modern IDEs and collaboration tools for full-stack software development, testing, and real-world project simulations.'],
                        ['name' => 'Hardware & Networking Lab', 'icon' => 'fa-network-wired', 'gradient' => 'linear-gradient(135deg, #10b981, #059669)', 'shadow' => 'rgba(16,185,129,0.3)', 'desc' => 'Hands-on experience with CISCO routing, switching, and embedded systems micro-controller design.'],
                        ['name' => 'AI & Data Science Hub', 'icon' => 'fa-microchip', 'gradient' => 'linear-gradient(135deg, #059669, #047857)', 'shadow' => 'rgba(5,150,105,0.3)', 'desc' => 'High-performance computing clusters for machine learning, big data analytics, and advanced algorithmic processing.'],
                        ['name' => 'Cybersecurity Lab', 'icon' => 'fa-shield-halved', 'gradient' => 'linear-gradient(135deg, #15803d, #14532d)', 'shadow' => 'rgba(21,128,61,0.3)', 'desc' => 'Dedicated environment for penetration testing, digital forensics, and cybersecurity research.'],
                    ];
                @endphp
                @foreach($labs as $lab)
                <div data-aos="fade-up" class="about-facilities-card hover-lift" style="display: flex; gap: 1.2rem; background: #f8fafc; padding: 1.8rem; border-radius: 14px; border: 1px solid #e2e8f0; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.background='#ffffff'; this.style.transform='translateY(-6px)'; this.style.boxShadow='0 15px 30px -8px rgba(0,0,0,0.08)'; this.style.borderColor='var(--color-primary)'" onmouseout="this.style.background='#f8fafc'; this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='#e2e8f0'">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: {{ $lab['gradient'] }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; box-shadow: 0 8px 20px -4px {{ $lab['shadow'] }}; transition: transform 0.3s;" class="fac-icon">
                        <i class="fa-solid {{ $lab['icon'] }}"></i>
                    </div>
                    <div>
                        <strong style="font-size: 1.1rem; display: block; margin-bottom: 0.4rem; color: #1e293b; font-family: var(--font-heading);">{{ $lab['name'] }}</strong>
                        <p style="margin: 0; color: #64748b; line-height: 1.6; font-size: 0.92rem;">{{ $lab['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
