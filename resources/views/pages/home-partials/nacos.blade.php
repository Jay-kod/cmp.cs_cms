<!-- NACOS — Student Association Spotlight -->
<section data-aos="fade-up" class="nacos-home-section py-14 bg-gradient-to-br from-slate-900 via-slate-800 to-green-900 relative overflow-hidden">
    {{-- Decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-[100px] -right-[100px] w-[400px] h-[400px] bg-[radial-gradient(circle,rgba(22,163,74,0.15)_0%,transparent_70%)] rounded-full"></div>
        <div class="absolute -bottom-[50px] -left-[50px] w-[300px] h-[300px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] rounded-full"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,<svg_xmlns=%22http://www.w3.org/2000/svg%22_width=%2240%22_height=%2240%22><circle_cx=%2220%22_cy=%2220%22_r=%220.5%22_fill=%22rgba(255,255,255,0.03)%22/></svg>')]"></div>
    </div>

    <div class="container relative z-10 px-4" data-aos="fade-up">
        {{-- Section Header --}}
        <div class="grid grid-cols-[1fr_auto] items-end gap-6 mb-8">
            <div>
                <span class="inline-flex items-center gap-2 bg-green-600/20 backdrop-blur-md text-green-400 text-[0.78rem] font-bold uppercase tracking-[1.5px] py-[0.3rem] px-[0.9rem] rounded-full mb-2.5 border border-green-600/30">
                    <i class="fa-solid fa-users-rectangle"></i> {{ $gs('home_nacos_badge','Student Association') }}
                </span>
                <h2 class="text-[2.4rem] font-heading font-extrabold text-white mb-2 leading-[1.15]">{{ $gs('home_nacos_title','NACOS') }}</h2>
                <p class="text-slate-400 text-[0.95rem] max-w-[550px] leading-[1.6] m-0">{{ $gs('home_nacos_subtitle','The National Association of Computing Students (NUK Chapter) — empowering students through leadership, innovation and community.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
            {{-- Left Column: About NACOS + Quick Stats --}}
            <div>
                {{-- About card --}}
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-[14px] p-6 mb-4">
                    <div class="flex items-center gap-[0.8rem] mb-3">
                        <div class="w-[42px] h-[42px] bg-gradient-to-br from-green-600 to-emerald-600 rounded-xl flex items-center justify-center text-[1.1rem] text-white">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <div>
                            <h3 class="text-white text-[1.05rem] font-bold m-0 font-heading">{{ $gs('home_nacos_about_title','About NACOS') }}</h3>
                            <span class="text-slate-500 text-[0.75rem]">{{ $gs('home_nacos_about_tag','NUK Chapter') }}</span>
                        </div>
                    </div>
                    <p class="text-slate-300 text-[0.9rem] leading-[1.65] m-0">{{ $gs('home_nacos_about_text','NACOS is the umbrella body for all computing students. We foster academic excellence, professional development, and social bonds among members through events, workshops, competitions, and community service.') }}</p>
                </div>

                {{-- Quick Stats Row --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @php
                        $nacosStats = [
                            ['icon' => 'fa-solid fa-crown', 'value' => $nacosTotalCount, 'label' => $gs('home_nacos_stat1_label','Past Leaders')],
                            ['icon' => 'fa-solid fa-calendar-check', 'value' => $gs('home_nacos_stat2_value','50+'), 'label' => $gs('home_nacos_stat2_label','Events Hosted')],
                            ['icon' => 'fa-solid fa-user-graduate', 'value' => $gs('home_nacos_stat3_value','500+'), 'label' => $gs('home_nacos_stat3_label','Active Members')],
                        ];
                    @endphp
                    @foreach($nacosStats as $stat)
                    <div class="group/stat bg-white/5 border border-white/5 rounded-xl py-[0.9rem] px-[0.7rem] text-center transition-all duration-300 hover:bg-green-600/10 hover:border-green-600/30">
                        <i class="{{ $stat['icon'] }} text-green-400 text-[0.95rem] mb-1.5 block"></i>
                        <div class="text-[1.35rem] font-extrabold text-white font-heading leading-none">{{ $stat['value'] }}</div>
                        <div class="text-[0.7rem] text-slate-500 mt-1 uppercase tracking-[0.5px] font-semibold">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right Column: Past Leaders Grid --}}
            <div>
                @if($nacosPresidents->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    @foreach($nacosPresidents->take(3) as $idx => $pres)
                    <a href="{{ route('nacos-presidents') }}" class="group flex flex-col bg-gradient-to-br from-slate-800/40 to-slate-900/60 border border-white/5 rounded-[14px] no-underline transition-all duration-400 ease-out relative overflow-hidden shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-1px_rgba(0,0,0,0.06)] hover:from-slate-800/70 hover:to-slate-900/90 hover:border-green-400/40 hover:-translate-y-1 hover:shadow-[0_15px_30px_-5px_rgba(22,163,74,0.15),inset_0_1px_0_rgba(255,255,255,0.1)]">
                        
                        {{-- Square Image Header --}}
                        <div class="w-full aspect-square relative bg-slate-900 overflow-hidden group-hover:scale-105 transition-transform duration-500">
                            <img src="{{ $pres->photo ? asset('storage/'.$pres->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $pres->name }}" class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($pres->name) }}&background=0f172a&color=4ade80&size=200&font-size=0.4&rounded=false'">
                            
                            {{-- Bottom fade effect so text pops beautifully --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-slate-900 to-transparent z-10"></div>
                        </div>

                        {{-- Text content pulled slightly up over the gradient fade --}}
                        <div class="text-center px-[0.8rem] pt-0 pb-[1.2rem] relative z-20 -mt-6">
                            <h4 class="text-white text-[0.95rem] font-extrabold m-0 mb-1 font-heading whitespace-nowrap overflow-hidden text-ellipsis drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">{{ $pres->name }}</h4>
                            
                            <span class="inline-block bg-slate-900/80 border border-green-400/30 text-green-400 py-[0.15rem] px-[0.6rem] rounded-md text-[0.68rem] font-bold tracking-[0.03em] mb-1.5 shadow-[0_2px_5px_rgba(0,0,0,0.2)]">{{ $pres->tenure_start ?? '?' }} &ndash; {{ $pres->tenure_end ?? 'Present' }}</span>
                            
                            @php
                                $statusText = 'PAST';
                                $statusColor = 'text-slate-400'; // Default gray
                                $dotColor = 'bg-slate-500 shadow-slate-500';
                                
                                  // Check for explicitly set status first
                                  $forcedStatus = trim(strtoupper($pres->current_status ?? ''));
                                  
                                  if ($forcedStatus === 'CURRENT PRESIDENT') {
                                      $statusText = 'CURRENT PRESIDENT';
                                      $statusColor = 'text-sky-400';
                                      $dotColor = 'bg-sky-500 shadow-sky-500';
                                  } elseif ($forcedStatus === 'JUST GRADUATED') {
                                      $statusText = 'JUST GRADUATED';
                                      $statusColor = 'text-yellow-300';
                                      $dotColor = 'bg-amber-500 shadow-amber-500';
                                  } elseif ($forcedStatus === 'PAST') {
                                      $statusText = 'PAST';
                                      $statusColor = 'text-slate-400';
                                      $dotColor = 'bg-slate-500 shadow-slate-500';
                                  } else {
                                      // Fallback calculating by tenure end if no status set
                                      $tEnd = strtolower(trim($pres->tenure_end ?? 'present'));
                                      if (empty($tEnd) || $tEnd === 'present' || $tEnd === 'current') {
                                          $statusText = 'CURRENT PRESIDENT';
                                          $statusColor = 'text-sky-400'; // Blue for active
                                          $dotColor = 'bg-sky-500 shadow-sky-500';
                                      } else {
                                          $endYear = (int) $tEnd;
                                          $currentYear = (int) date('Y');
                                          if ($endYear > 0) {
                                              if ($endYear >= $currentYear - 1) {
                                                  $statusText = 'JUST GRADUATED';
                                                  $statusColor = 'text-yellow-300'; // Gold for just graduated
                                                  $dotColor = 'bg-amber-500 shadow-amber-500';
                                              }
                                          }
                                      }
                                  }
                              @endphp

                              <div class="flex items-center justify-center gap-[0.4rem] mt-[0.2rem]">
                                  <div class="w-1 h-1 rounded-full shadow-[0_0_4px] {{ $dotColor }}"></div>
                                  <p class="text-[0.72rem] font-bold m-0 uppercase tracking-[0.5px] whitespace-nowrap overflow-hidden text-ellipsis drop-shadow-[0_1px_2px_rgba(0,0,0,0.5)] {{ $statusColor }}">{{ $statusText }}</p>
                                  <div class="w-1 h-1 rounded-full shadow-[0_0_4px] {{ $dotColor }}"></div>
                              </div>
                          </div>
                      </a>
                      @endforeach
                </div>
                @else
                <div class="bg-white/5 border border-dashed border-white/10 rounded-xl p-8 text-center">
                    <i class="fa-solid fa-user-tie text-[1.6rem] text-slate-700 mb-2.5 block"></i>
                    <p class="text-slate-500 text-[0.85rem] m-0">NACOS leader records will appear here once added.</p>
                </div>
                @endif

                {{-- CTA Banner --}}
                <a href="{{ route('nacos-presidents') }}" class="group flex items-center justify-between mt-6 py-[1.2rem] px-[1.5rem] bg-gradient-to-br from-green-600/20 to-green-600/5 border-[1.5px] border-green-400/50 rounded-xl no-underline transition-all duration-300 shadow-[0_4px_20px_-5px_rgba(22,163,74,0.3)] hover:from-green-600/30 hover:to-green-600/10 hover:border-green-400/80 hover:shadow-[0_8px_25px_-5px_rgba(22,163,74,0.5)]">
                    <div>
                        <div class="text-white font-extrabold text-base font-heading mb-1">{{ $gs('home_nacos_cta_title','Explore NACOS History') }}</div>
                        <div class="text-slate-400 text-[0.8rem]">{{ $gs('home_nacos_cta_desc','See all past leaders, their tenure and achievements') }}</div>
                    </div>
                    <div class="w-[38px] h-[38px] bg-green-500/30 border border-green-400/40 rounded-full flex items-center justify-center text-green-400 shrink-0 text-base transition-transform duration-300 group-hover:translate-x-1">
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
