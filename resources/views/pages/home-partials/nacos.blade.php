<!-- NACOS — Student Association Spotlight -->
<section class="nacos-home-section" style="padding: 3.5rem 0; background: linear-gradient(165deg, #0f172a 0%, #1e293b 60%, #0f4c2e 100%); position: relative; overflow: hidden;">
    {{-- Decorative background --}}
    <div style="position: absolute; inset: 0; pointer-events: none;">
        <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(22,163,74,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(22,163,74,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22><circle cx=%2220%22 cy=%2220%22 r=%220.5%22 fill=%22rgba(255,255,255,0.03)%22/></svg>');"></div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        {{-- Section Header --}}
        <div style="display: grid; grid-template-columns: 1fr auto; align-items: end; gap: 1.5rem; margin-bottom: 2rem;">
            <div>
                <span style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(22,163,74,0.2); backdrop-filter: blur(8px); color: #4ade80; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; padding: 0.3rem 0.9rem; border-radius: 20px; margin-bottom: 0.6rem; border: 1px solid rgba(22,163,74,0.3);">
                    <i class="fa-solid fa-users-rectangle"></i> {{ $gs('home_nacos_badge','Student Association') }}
                </span>
                <h2 style="font-size: 2.4rem; font-family: var(--font-heading); font-weight: 800; color: white; margin-bottom: 0.5rem; line-height: 1.15;">{{ $gs('home_nacos_title','NACOS') }}</h2>
                <p style="color: #94a3b8; font-size: 0.95rem; max-width: 550px; line-height: 1.6; margin: 0;">{{ $gs('home_nacos_subtitle','The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.') }}</p>
            </div>
            <a href="{{ route('nacos-presidents') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #4ade80; font-weight: 700; font-size: 0.85rem; text-decoration: none; padding: 0.5rem 1rem; border: 1.5px solid rgba(74,222,128,0.3); border-radius: 10px; transition: all 0.3s; white-space: nowrap;" onmouseover="this.style.background='rgba(74,222,128,0.1)'; this.style.borderColor='rgba(74,222,128,0.6)'" onmouseout="this.style.background='transparent'; this.style.borderColor='rgba(74,222,128,0.3)'">
                View More About NACOS <i class="fa-solid fa-arrow-right" style="font-size: 0.8rem;"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start;">
            {{-- Left Column: About NACOS + Quick Stats --}}
            <div>
                {{-- About card --}}
                <div style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 1.4rem; margin-bottom: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.8rem;">
                        <div style="width: 42px; height: 42px; background: linear-gradient(135deg, #16a34a, #059669); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: white;">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <div>
                            <h3 style="color: white; font-size: 1.05rem; font-weight: 700; margin: 0; font-family: var(--font-heading);">{{ $gs('home_nacos_about_title','About NACOS') }}</h3>
                            <span style="color: #64748b; font-size: 0.75rem;">{{ $gs('home_nacos_about_tag','NUK Chapter') }}</span>
                        </div>
                    </div>
                    <p style="color: #cbd5e1; font-size: 0.9rem; line-height: 1.65; margin: 0;">{{ $gs('home_nacos_about_text','NACOS is the umbrella body for all computing students. We foster academic excellence, professional development, and social bonds among members through events, workshops, competitions, and community service.') }}</p>
                </div>

                {{-- Quick Stats Row --}}
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem;">
                    @php
                        $nacosStats = [
                            ['icon' => 'fa-solid fa-crown', 'value' => $nacosTotalCount, 'label' => $gs('home_nacos_stat1_label','Past Leaders')],
                            ['icon' => 'fa-solid fa-calendar-check', 'value' => $gs('home_nacos_stat2_value','50+'), 'label' => $gs('home_nacos_stat2_label','Events Hosted')],
                            ['icon' => 'fa-solid fa-user-graduate', 'value' => $gs('home_nacos_stat3_value','500+'), 'label' => $gs('home_nacos_stat3_label','Active Members')],
                        ];
                    @endphp
                    @foreach($nacosStats as $stat)
                    <div style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 0.9rem 0.7rem; text-align: center; transition: all 0.3s;" onmouseover="this.style.background='rgba(22,163,74,0.12)'; this.style.borderColor='rgba(22,163,74,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'; this.style.borderColor='rgba(255,255,255,0.06)'">
                        <i class="{{ $stat['icon'] }}" style="color: #4ade80; font-size: 0.95rem; margin-bottom: 0.35rem; display: block;"></i>
                        <div style="font-size: 1.35rem; font-weight: 800; color: white; font-family: var(--font-heading); line-height: 1;">{{ $stat['value'] }}</div>
                        <div style="font-size: 0.7rem; color: #64748b; margin-top: 0.25rem; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600;">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Past Leaders Grid --}}
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.8rem;">
                    <h3 style="color: white; font-size: 1rem; font-weight: 700; margin: 0; font-family: var(--font-heading); display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-award" style="color: #4ade80;"></i> Recent Leaders
                    </h3>
                    <span style="color: #475569; font-size: 0.75rem; font-weight: 600;">{{ $nacosTotalCount }} total</span>
                </div>

                @if($nacosPresidents->count() > 0)
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                    @foreach($nacosPresidents as $idx => $pres)
                    <a href="{{ route('nacos-presidents') }}" style="display: block; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; padding: 1rem; text-decoration: none; transition: all 0.35s; position: relative; overflow: hidden;" onmouseover="this.style.background='rgba(255,255,255,0.09)'; this.style.borderColor='rgba(74,222,128,0.3)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.08)'; this.style.transform='translateY(0)'">
                        <div style="display: flex; align-items: center; gap: 0.8rem;">
                            <div style="width: 44px; height: 44px; border-radius: 50%; border: 2px solid rgba(74,222,128,0.3); overflow: hidden; flex-shrink: 0; background: linear-gradient(135deg, #1e293b, #0f172a);">
                                <img src="{{ $pres->photo ? asset('storage/'.$pres->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $pres->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($pres->name) }}&background=16a34a&color=fff&size=100'">
                            </div>
                            <div style="min-width: 0;">
                                <h4 style="color: white; font-size: 0.88rem; font-weight: 700; margin: 0 0 0.15rem; font-family: var(--font-heading); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $pres->name }}</h4>
                                <span style="display: inline-block; background: rgba(22,163,74,0.2); color: #4ade80; padding: 0.1rem 0.5rem; border-radius: 12px; font-size: 0.68rem; font-weight: 600;">{{ $pres->tenure_start ?? '?' }} – {{ $pres->tenure_end ?? 'Present' }}</span>
                                @if($pres->current_status)
                                <p style="color: #64748b; font-size: 0.78rem; margin: 0.3rem 0 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $pres->current_status }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div style="background: rgba(255,255,255,0.04); border: 1px dashed rgba(255,255,255,0.1); border-radius: 12px; padding: 2rem; text-align: center;">
                    <i class="fa-solid fa-user-tie" style="font-size: 1.6rem; color: #334155; margin-bottom: 0.6rem; display: block;"></i>
                    <p style="color: #64748b; font-size: 0.85rem; margin: 0;">NACOS leader records will appear here once added.</p>
                </div>
                @endif

                {{-- CTA Banner --}}
                <a href="{{ route('nacos-presidents') }}" style="display: flex; align-items: center; justify-content: space-between; margin-top: 0.75rem; padding: 0.8rem 1.2rem; background: linear-gradient(135deg, rgba(22,163,74,0.15), rgba(22,163,74,0.05)); border: 1px solid rgba(22,163,74,0.25); border-radius: 12px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='linear-gradient(135deg, rgba(22,163,74,0.25), rgba(22,163,74,0.1))'; this.style.borderColor='rgba(22,163,74,0.4)'" onmouseout="this.style.background='linear-gradient(135deg, rgba(22,163,74,0.15), rgba(22,163,74,0.05))'; this.style.borderColor='rgba(22,163,74,0.25)'">
                    <div>
                        <div style="color: white; font-weight: 700; font-size: 0.88rem; font-family: var(--font-heading);">{{ $gs('home_nacos_cta_title','Explore NACOS History') }}</div>
                        <div style="color: #64748b; font-size: 0.75rem;">{{ $gs('home_nacos_cta_desc','See all past leaders, their tenure and achievements') }}</div>
                    </div>
                    <div style="width: 32px; height: 32px; background: rgba(22,163,74,0.3); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4ade80; flex-shrink: 0; font-size: 0.85rem;">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    @media (max-width: 991px) {
        .nacos-home-section .container > div:nth-child(2) { grid-template-columns: 1fr !important; }
        .nacos-home-section .container > div:first-child { grid-template-columns: 1fr !important; text-align: center; }
        .nacos-home-section .container > div:first-child > a { justify-self: center; }
        .nacos-home-section .container > div:first-child p { margin: 0 auto !important; }
    }
    @media (max-width: 575px) {
        .nacos-home-section { padding: 2.5rem 0 !important; }
        .nacos-home-section h2 { font-size: 1.8rem !important; }
    }
</style>
