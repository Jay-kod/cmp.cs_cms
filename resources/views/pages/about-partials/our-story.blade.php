        <!-- ═══════════ OUR STORY ═══════════ -->
        <section id="our-story" style="margin-bottom: 4rem;">
            <div class="section-heading" style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h2 style="margin: 0; font-size: 2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 700;">Our Story</h2>
            </div>
            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); margin-bottom: 2rem; border-radius: 2px;"></div>

            <div class="about-story-layout" style="display: flex; gap: 2.5rem; align-items: flex-start; flex-wrap: wrap; margin-bottom: 2rem;">
                {{-- HOD Card --}}
                <div class="about-hod-card" style="flex: 0 0 220px; max-width: 220px;">
                    <div style="aspect-ratio: 1; border-radius: 14px; overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.1); border: 3px solid var(--color-accent);">
                        @if(isset($hod) && $hod && $hod->photo)
                            <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background: #f0fdf4; padding: 1.5rem;">
                                <img src="{{ asset(config('university.logo', 'images/logo.png')) }}" alt="Department Logo" style="width: 80%; height: 80%; object-fit: contain;">
                            </div>
                        @endif
                    </div>
                    <div style="text-align: center; margin-top: 0.8rem; display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%;">
                        @if(isset($hod) && $hod)
                            <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.95rem; text-align: center; width: 100%;">{{ $hod->name }}</p>
                            <p style="margin: 0; color: var(--color-primary); font-size: 0.82rem; text-align: center; width: 100%;">{{ $hod->rank }}, HOD</p>
                        @else
                            <p style="margin: 0; font-weight: 700; color: #0f172a; font-size: 0.95rem; text-align: center; width: 100%;">Head of Department</p>
                            <p style="margin: 0; color: var(--color-primary); font-size: 0.82rem; text-align: center; width: 100%;">Department of Computer Science</p>
                        @endif
                    </div>
                </div>

                {{-- Story Text --}}
                <div class="about-story-text" style="flex: 1; min-width: 280px; font-size: 1.05rem; line-height: 1.85; color: #475569;">
                <p>The Department of Computer Science was established as a <strong>Unit</strong> in the Department of Mathematical Sciences, Faculty of Natural and Applied Sciences, in the <strong>2003/2004</strong> academic session and was upgraded to the status of a full <strong>Department in the 2017/18 session</strong>.</p>

                <div class="about-quote" style="border-left: 4px solid var(--color-primary); padding: 1.2rem 1.5rem; background: linear-gradient(90deg, rgba(22,163,74,0.04), transparent); border-radius: 0 8px 8px 0; margin: 1.5rem 0; font-style: italic; color: #334155; font-size: 1.08rem; line-height: 1.7;">
                    "The goal of the department is to be a leading edge in the area of competition, innovation, and society-responsive computing solutions — strategically aligning with the university's mission."
                </div>

                <p>With effect from the <strong>2021/2022</strong> academic session, two new programmes — <strong>Data Science & Technology</strong> and <strong>Cybersecurity & Forensic</strong> — were introduced alongside the core Computer Science programme.</p>

                <p>The department develops focused, trend-setting multidisciplinary research excellence with national, regional, and international recognition through diverse research projects. Our programmes are designed to produce <strong>market-ready graduates</strong> with the appropriate information technology skills and capacity for independent thinking, self-reliance, creativity, and resourcefulness.</p>

                <p>Our curricula are unique, robust, current, and comparable with international best practice — designed to meet and surpass academic standards prescribed by regulatory authorities. The development and implementation of our programmes are defined by ideals of <strong>inclusivity and accessibility</strong> to the Nasarawa State community we serve and the nation at large.</p>
                </div>
            </div>

            <!-- Timeline Milestones -->
            <div class="about-milestones" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.2rem; margin-top: 2.5rem;">
                <div class="hover-lift" style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">2003</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">Established as a Unit</div>
                </div>
                <div class="hover-lift" style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">2017</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">Upgraded to Department</div>
                </div>
                <div class="hover-lift" style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">2021</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">New Programmes Added</div>
                </div>
                <div class="hover-lift" style="text-align: center; padding: 1.5rem; background: #ffffff; border-radius: 14px; border: 1px solid rgba(22, 163, 74, 0.2); box-shadow: 0 4px 15px -3px rgba(22, 163, 74, 0.05);">
                    <div class="milestone-year" style="font-size: 2rem; font-weight: 800; color: var(--color-primary); font-family: var(--font-heading);">11+</div>
                    <div style="font-size: 0.85rem; color: #475569; margin-top: 0.3rem; font-weight: 500;">Academic Programmes</div>
                </div>
            </div>
        </section>
