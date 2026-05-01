        <!-- ═══════════ CORE VALUES ═══════════ -->
        <section data-aos="fade-up" id="core-values" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Core Values</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-values-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.2rem;">
                @php
                    $coreValues = [
                        ['name' => 'Innovation', 'icon' => 'fa-lightbulb', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'Pioneering creative solutions in technology'],
                        ['name' => 'Excellence', 'icon' => 'fa-award', 'color' => '#15803d', 'bg' => '#f0fdf4', 'desc' => 'Pursuing the highest academic standards'],
                        ['name' => 'Integrity', 'icon' => 'fa-shield-halved', 'color' => '#10b981', 'bg' => '#ecfdf5', 'desc' => 'Upholding ethical principles in all endeavors'],
                        ['name' => 'Self-Reliance', 'icon' => 'fa-person-rays', 'color' => '#047857', 'bg' => '#ecfdf5', 'desc' => 'Building independent and capable professionals'],
                        ['name' => 'Inclusivity', 'icon' => 'fa-people-group', 'color' => '#059669', 'bg' => '#f0fdf4', 'desc' => 'Accessible education for all communities'],
                        ['name' => 'Creativity', 'icon' => 'fa-palette', 'color' => '#16a34a', 'bg' => '#f0fdf4', 'desc' => 'Fostering original thinking and resourcefulness'],
                    ];
                @endphp
                @foreach($coreValues as $val)
                <div style="text-align: center; padding: 1.5rem 1rem; background: {{ $val['bg'] }}; border-radius: 14px; border: 1px solid {{ $val['color'] }}20; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 18px 35px -8px {{ $val['color'] }}25'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="val-icon" style="width: 48px; height: 48px; margin: 0 auto 0.8rem; background: linear-gradient(135deg, {{ $val['color'] }}, {{ $val['color'] }}dd); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; box-shadow: 0 8px 20px -4px {{ $val['color'] }}40; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fa-solid {{ $val['icon'] }}"></i>
                    </div>
                    <h4 style="margin: 0 0 0.4rem; font-size: 1.05rem; color: #1e293b; font-weight: 700;">{{ $val['name'] }}</h4>
                    <p style="margin: 0; font-size: 0.85rem; color: #64748b; line-height: 1.5; text-align: center;">{{ $val['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </section>
