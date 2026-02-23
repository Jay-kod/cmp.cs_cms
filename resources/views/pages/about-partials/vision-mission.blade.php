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
                <div class="about-vm-card" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 16px; padding: 2.5rem; position: relative; overflow: hidden; border: 1px solid rgba(22, 163, 74, 0.15); transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px -12px rgba(22,163,74,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -20px; right: -20px; font-size: 7rem; color: rgba(22, 163, 74, 0.06); transform: rotate(-15deg); pointer-events: none;"><i class="fa-solid fa-eye"></i></div>
                    <div style="width: 52px; height: 52px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.5rem; box-shadow: 0 8px 20px -4px rgba(22, 163, 74, 0.4);">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 style="font-size: 1.4rem; color: #1e293b; margin: 0 0 1rem 0; font-family: var(--font-heading); font-weight: 700;">Our Vision</h3>
                    <p style="color: #334155; font-size: 1rem; line-height: 1.7; margin: 0;">{{ $settings['vision_statement'] ?? 'To be a leading edge in the area of competition, innovation, and society-responsive computing solutions, strategically aligning with the university\'s mission to promote technological advancement.' }}</p>
                </div>

                <!-- Mission -->
                <div class="about-vm-card" style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border-radius: 16px; padding: 2.5rem; position: relative; overflow: hidden; border: 1px solid rgba(16, 185, 129, 0.15); transition: transform 0.3s, box-shadow 0.3s;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 20px 40px -12px rgba(16,185,129,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="position: absolute; top: -20px; right: -20px; font-size: 7rem; color: rgba(16, 185, 129, 0.06); transform: rotate(-15deg); pointer-events: none;"><i class="fa-solid fa-bullseye"></i></div>
                    <div style="width: 52px; height: 52px; background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1.5rem; box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.4);">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 style="font-size: 1.4rem; color: #1e293b; margin: 0 0 1rem 0; font-family: var(--font-heading); font-weight: 700;">Our Mission</h3>
                    <p style="color: #334155; font-size: 1rem; line-height: 1.7; margin: 0;">{{ $settings['mission_statement'] ?? 'To promote technological advancement by providing a conducive environment for research, teaching, and learning that engenders the development of products that are technology-oriented, self-reliant, and relevant to society.' }}</p>
                </div>
            </div>

            <!-- Objectives -->
            <div class="about-objectives-wrap" style="margin-top: 1.5rem; background: #ffffff; border-radius: 20px; padding: 3rem; border: 1px solid rgba(22, 163, 74, 0.12); box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -40px; right: -40px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(22,163,74,0.05), transparent 70%); pointer-events: none;"></div>
                <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: radial-gradient(circle, rgba(16,185,129,0.04), transparent 70%); pointer-events: none;"></div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem; position: relative;">
                    <div style="width: 52px; height: 52px; background: linear-gradient(135deg, #16a34a, #15803d); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; box-shadow: 0 8px 20px -4px rgba(22, 163, 74, 0.4);">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.4rem; color: #1e293b; margin: 0; font-family: var(--font-heading); font-weight: 700;">Our Objectives</h3>
                        <p style="margin: 0.2rem 0 0; font-size: 0.85rem; color: #64748b;">What we strive to achieve</p>
                    </div>
                </div>
                <div class="about-objectives-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; position: relative;">
                    @php
                        $objectives = [
                            ['icon' => 'fa-user-graduate', 'title' => 'Industry-Ready Graduates', 'text' => 'Produce market-ready graduates with appropriate IT skills and capacity for independent thinking, self-reliance, and resourcefulness.', 'accent' => '#059669'],
                            ['icon' => 'fa-flask', 'title' => 'Research Excellence', 'text' => 'Develop trend-setting multidisciplinary research excellence with national, regional, and international recognition.', 'accent' => '#16a34a'],
                            ['icon' => 'fa-laptop-code', 'title' => 'Future Leaders', 'text' => 'Equip students with cutting-edge knowledge and abilities to lead, innovate, and create across diverse industries.', 'accent' => '#10b981'],
                            ['icon' => 'fa-handshake', 'title' => 'Community & Inclusivity', 'text' => 'Promote inclusivity and accessibility to the Nasarawa State community and the nation at large through quality education.', 'accent' => '#047857'],
                        ];
                    @endphp
                    @foreach($objectives as $i => $obj)
                    <div style="text-align: center; padding: 1.2rem 1rem; background: #fafaf9; border-radius: 12px; border: 1px solid rgba(22,163,74,0.05); transition: all 0.3s cubic-bezier(0.4,0,0.2,1); cursor: default;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 28px -6px rgba(22,163,74,0.12)'; this.style.borderColor='rgba(22,163,74,0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'; this.style.borderColor='rgba(22,163,74,0.05)'">
                        <div style="width: 40px; height: 40px; background: rgba(22,163,74,0.06); color: var(--color-primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; margin: 0 auto 0.8rem; border: 1px solid rgba(22,163,74,0.1);">
                            <i class="fa-solid {{ $obj['icon'] }}"></i>
                        </div>
                        <h4 style="margin: 0 0 0.4rem; font-size: 0.85rem; font-weight: 700; color: #1e293b; font-family: var(--font-heading);">{{ $obj['title'] }}</h4>
                        <p style="margin: 0; color: #475569; font-size: 0.82rem; line-height: 1.6;">{{ $obj['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
