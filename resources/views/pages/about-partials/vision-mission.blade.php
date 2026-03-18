        <!-- ═══════════ VISION & MISSION ═══════════ -->
        <section id="vision-mission" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-compass"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Vision, Mission & Objectives</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-vm-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                <!-- Vision -->
                <div class="about-vm-card vision-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 16px; padding: 1.8rem; position: relative; overflow: hidden; border: 1px solid rgba(22, 163, 74, 0.15); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1), cursor 0.3s;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px -12px rgba(22,163,74,0.3)'; this.style.cursor='pointer'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(22, 163, 74, 0.08); transform: rotate(-15deg); pointer-events: none; transition: transform 0.4s ease;" class="bg-icon"><i class="fa-solid fa-eye"></i></div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1.2rem; box-shadow: 0 8px 20px -4px rgba(22, 163, 74, 0.4); transition: transform 0.3s;" class="main-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; color: #1e293b; margin: 0 0 0.8rem 0; font-family: var(--font-heading); font-weight: 700;">Our Vision</h3>
                    <p style="color: #334155; font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $settings['vision_statement'] ?? 'To be a leading edge in the area of competition, innovation, and society-responsive computing solutions, strategically aligning with the university\'s mission to promote technological advancement.' }}</p>
                </div>

                <!-- Mission -->
                <div class="about-vm-card mission-card" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border-radius: 16px; padding: 1.8rem; position: relative; overflow: hidden; border: 1px solid rgba(16, 185, 129, 0.15); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1), cursor 0.3s;" onmouseover="this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 25px 50px -12px rgba(16,185,129,0.3)'; this.style.cursor='pointer'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -15px; right: -15px; font-size: 6rem; color: rgba(16, 185, 129, 0.08); transform: rotate(-15deg); pointer-events: none; transition: transform 0.4s ease;" class="bg-icon"><i class="fa-solid fa-bullseye"></i></div>
                    <div style="width: 44px; height: 44px; background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; margin-bottom: 1.2rem; box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.4); transition: transform 0.3s;" class="main-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 style="font-size: 1.25rem; color: #1e293b; margin: 0 0 0.8rem 0; font-family: var(--font-heading); font-weight: 700;">Our Mission</h3>
                    <p style="color: #334155; font-size: 0.95rem; line-height: 1.6; margin: 0;">{{ $settings['mission_statement'] ?? 'To promote technological advancement by providing a conducive environment for research, teaching, and learning that engenders the development of products that are technology-oriented, self-reliant, and relevant to society.' }}</p>
                </div>
            </div>

            <!-- Objectives -->
            <div class="about-objectives-wrap" style="margin-top: 2.5rem;">
                {{-- Section Header --}}
                <div style="text-align: center; margin-bottom: 2.5rem;">
                    <div style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.35rem 1rem; background: #f0fdf4; border: 1px solid #dcfce7; border-radius: 20px; font-size: 0.75rem; font-weight: 700; color: #16a34a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.8rem;">
                        <i class="fa-solid fa-crosshairs" style="font-size: 0.65rem;"></i> Our Goals
                    </div>
                    <h3 style="font-size: 1.8rem; color: #0f172a; margin: 0 0 0.5rem; font-family: var(--font-heading); font-weight: 800;">What We Strive to Achieve</h3>
                    <p style="margin: 0 auto; max-width: 500px; font-size: 0.92rem; color: #64748b; line-height: 1.6;">Our department is guided by four key objectives that shape everything we do.</p>
                </div>

                @php
                    $objectives = [
                        ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.', 'color' => '#059669', 'light' => '#ecfdf5'],
                        ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.', 'color' => '#16a34a', 'light' => '#f0fdf4'],
                        ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.', 'color' => '#10b981', 'light' => '#ecfdf5'],
                        ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.', 'color' => '#047857', 'light' => '#f0fdf4'],
                    ];
                @endphp

                {{-- Timeline Layout --}}
                <div class="obj-timeline">
                    @foreach($objectives as $i => $obj)
                    <div class="obj-row {{ $i % 2 === 0 ? '' : 'obj-row-reverse' }}">
                        {{-- Number Side --}}
                        <div class="obj-number-side">
                            <div class="obj-big-num" style="color: {{ $obj['color'] }};">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        </div>

                        {{-- Connector --}}
                        <div class="obj-connector">
                            <div class="obj-dot" style="background: {{ $obj['color'] }}; box-shadow: 0 0 0 4px {{ $obj['light'] }}, 0 0 0 5px {{ $obj['color'] }}33;"></div>
                            @if($i < count($objectives) - 1)
                            <div class="obj-line"></div>
                            @endif
                        </div>

                        {{-- Content Side --}}
                        <div class="obj-content-side">
                            <div class="obj-content-card" style="border-left: 3px solid {{ $obj['color'] }};">
                                <div class="obj-content-header">
                                    <div class="obj-icon" style="background: {{ $obj['light'] }}; color: {{ $obj['color'] }};">
                                        <i class="fa-solid {{ $obj['icon'] }}"></i>
                                    </div>
                                    <h4 class="obj-title">{{ $obj['title'] }}</h4>
                                </div>
                                <p class="obj-text">{{ $obj['text'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
