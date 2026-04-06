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
                @if($nacosPresidents->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                    @foreach($nacosPresidents->take(3) as $idx => $pres)
                    <a href="{{ route('nacos-presidents') }}" style="display: flex; flex-direction: column; background: linear-gradient(160deg, rgba(30,41,59,0.4) 0%, rgba(15,23,42,0.6) 100%); border: 1px solid rgba(255,255,255,0.05); border-radius: 14px; text-decoration: none; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);" onmouseover="this.style.background='linear-gradient(160deg, rgba(30,41,59,0.7) 0%, rgba(15,23,42,0.9) 100%)'; this.style.borderColor='rgba(74,222,128,0.4)'; this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px -5px rgba(22,163,74,0.15), inset 0 1px 0 rgba(255,255,255,0.1)'" onmouseout="this.style.background='linear-gradient(160deg, rgba(30,41,59,0.4) 0%, rgba(15,23,42,0.6) 100%)'; this.style.borderColor='rgba(255,255,255,0.05)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06)'">
                        
                        {{-- Square Image Header --}}
                        <div style="width: 100%; aspect-ratio: 1/1; position: relative; background: #0f172a; overflow: hidden; border-bottom: 2px solid rgba(74,222,128,0.2);">
                            <img src="{{ $pres->photo ? asset('storage/'.$pres->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $pres->name }}" style="width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.6s ease;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($pres->name) }}&background=0f172a&color=4ade80&size=200&font-size=0.4&rounded=false'" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                            
                            {{-- Bottom fade effect so text pops beautifully --}}
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 50%; background: linear-gradient(to top, rgba(15,23,42,1) 0%, transparent 100%); z-index: 1;"></div>
                        </div>

                        {{-- Text content pulled slightly up over the gradient fade --}}
                        <div style="text-align: center; padding: 0 0.8rem 1.2rem; position: relative; z-index: 2; margin-top: -1.5rem;">
                            <h4 style="color: white; font-size: 0.95rem; font-weight: 800; margin: 0 0 0.3rem; font-family: var(--font-heading); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-shadow: 0 2px 4px rgba(0,0,0,0.8);">{{ $pres->name }}</h4>
                            
                            <span style="display: inline-block; background: rgba(15,23,42,0.8); border: 1px solid rgba(74,222,128,0.3); color: #4ade80; padding: 0.15rem 0.6rem; border-radius: 6px; font-size: 0.68rem; font-weight: 700; letter-spacing: 0.03em; margin-bottom: 0.4rem; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">{{ $pres->tenure_start ?? '?' }} &ndash; {{ $pres->tenure_end ?? 'Present' }}</span>
                            
                            @php
                                $statusText = 'PAST';
                                $statusColor = '#94a3b8'; // Default gray
                                $dotColor = '#64748b';
                                
                                  // Check for explicitly set status first
                                  $forcedStatus = trim(strtoupper($pres->current_status ?? ''));
                                  
                                  if ($forcedStatus === 'CURRENT PRESIDENT') {
                                      $statusText = 'CURRENT PRESIDENT';
                                      $statusColor = '#38bdf8';
                                      $dotColor = '#0ea5e9';
                                  } elseif ($forcedStatus === 'JUST GRADUATED') {
                                      $statusText = 'JUST GRADUATED';
                                      $statusColor = '#fcd34d';
                                      $dotColor = '#f59e0b';
                                  } elseif ($forcedStatus === 'PAST') {
                                      $statusText = 'PAST';
                                      $statusColor = '#94a3b8';
                                      $dotColor = '#64748b';
                                  } else {
                                      // Fallback calculating by tenure end if no status set
                                      $tEnd = strtolower(trim($pres->tenure_end ?? 'present'));
                                      if (empty($tEnd) || $tEnd === 'present' || $tEnd === 'current') {
                                          $statusText = 'CURRENT PRESIDENT';
                                          $statusColor = '#38bdf8'; // Blue for active
                                          $dotColor = '#0ea5e9';
                                      } else {
                                          $endYear = (int) $tEnd;
                                          $currentYear = (int) date('Y');
                                          if ($endYear > 0) {
                                              if ($endYear >= $currentYear - 1) {
                                                  $statusText = 'JUST GRADUATED';
                                                  $statusColor = '#fcd34d'; // Gold for just graduated
                                                  $dotColor = '#f59e0b';
                                              }
                                          }
                                      }
                                  }
                              @endphp

                              <div style="display: flex; align-items: center; justify-content: center; gap: 0.4rem; margin-top: 0.2rem;">
                                  <div style="width: 4px; height: 4px; border-radius: 50%; background: {{ $dotColor }}; box-shadow: 0 0 4px {{ $dotColor }};"></div>
                                  <p style="color: {{ $statusColor }}; font-size: 0.72rem; font-weight: 700; margin: 0; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">{{ $statusText }}</p>
                                  <div style="width: 4px; height: 4px; border-radius: 50%; background: {{ $dotColor }}; box-shadow: 0 0 4px {{ $dotColor }};"></div>
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
                <a href="{{ route('nacos-presidents') }}" style="display: flex; align-items: center; justify-content: space-between; margin-top: 1.5rem; padding: 1.2rem 1.5rem; background: linear-gradient(135deg, rgba(22,163,74,0.2), rgba(22,163,74,0.05)); border: 1.5px solid rgba(74,222,128,0.5); border-radius: 12px; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 20px -5px rgba(22,163,74,0.3);" onmouseover="this.style.background='linear-gradient(135deg, rgba(22,163,74,0.3), rgba(22,163,74,0.1))'; this.style.borderColor='rgba(74,222,128,0.8)'; this.style.boxShadow='0 8px 25px -5px rgba(22,163,74,0.5)';" onmouseout="this.style.background='linear-gradient(135deg, rgba(22,163,74,0.2), rgba(22,163,74,0.05))'; this.style.borderColor='rgba(74,222,128,0.5)'; this.style.boxShadow='0 4px 20px -5px rgba(22,163,74,0.3)';">
                    <div>
                        <div style="color: white; font-weight: 800; font-size: 1rem; font-family: var(--font-heading); margin-bottom: 0.2rem;">{{ $gs('home_nacos_cta_title','Explore NACOS History') }}</div>
                        <div style="color: #94a3b8; font-size: 0.8rem;">{{ $gs('home_nacos_cta_desc','See all past leaders, their tenure and achievements') }}</div>
                    </div>
                    <div style="width: 38px; height: 38px; background: rgba(34,197,94,0.3); border: 1px solid rgba(74,222,128,0.4); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #4ade80; flex-shrink: 0; font-size: 1rem; transition: transform 0.3s ease;" onmouseover="this.style.transform='translateX(4px)'" onmouseout="this.style.transform='translateX(0)'">
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
