<!-- HOD WELCOME + STATS (Combined Section) -->
<section data-aos="fade-up" class="hod-section pt-[5rem] pb-[4rem] bg-slate-50 relative overflow-hidden">
    <!-- Abstract Background Decor -->
    <div class="absolute top-[-100px] right-[-50px] w-[300px] h-[300px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.08)_0%,transparent_70%)]"></div>
    <div class="absolute bottom-[-50px] left-[10%] w-[250px] h-[250px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)]"></div>
    
    <div class="container flex flex-col lg:flex-row gap-[3.5rem] lg:gap-[5rem] items-start relative z-[2]">
        
        <!-- HoD Text -->
        <div class="hod-text flex-1 w-full lg:w-auto">
            <span class="inline-block text-primary text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_hod_badge','Welcome Message') }}</span>
            <h2 class="text-[2.8rem] mb-6 font-heading font-extrabold text-slate-900 leading-[1.15]">{{ $gs('home_hod_title','From the Head of Department') }}</h2>
            
            <div class="hod-quote-box relative pl-8 mb-10 max-md:pl-1 mt-6">
                <i class="fa-solid fa-quote-left hod-quote-mark absolute -top-2.5 -left-2.5 text-[3.5rem] text-primary/10 z-0 max-md:-left-1.5 max-md:text-[2.5rem] max-md:-top-1.5"></i>
                <blockquote class="relative z-10 text-[1.15rem] text-slate-600 leading-[1.8] m-0 italic text-justify">
                    "{!! nl2br(e($gs('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.'))) !!}"
                </blockquote>
            </div>
            
        </div>

        <!-- HoD Photo Area -->
        <div class="hod-photo-container shrink-0 w-full max-w-full sm:max-w-[420px] md:max-w-[500px] lg:max-w-[420px] mx-auto flex flex-col gap-10">
            <div class="hod-photo relative w-full mx-auto">
                <div class="absolute -inset-3 border-2 border-primary rounded-xl z-[1] max-md:hidden"></div>
                <div class="absolute inset-3 bg-primary/10 rounded-xl z-[1] max-md:hidden"></div>
                
                <!-- Wrapper for Image and floating badge -->
                <div class="relative z-[2] w-full block group mx-auto">
                    <div class="w-full aspect-square sm:aspect-[3/4] rounded-2xl sm:rounded-[1.5rem] overflow-hidden shadow-[0_15px_40px_-5px_rgba(0,0,0,0.2)] border-4 sm:border-[6px] border-white">
                        @if($gs('hod_photo'))
                            <img src="{{ asset('storage/'.$gs('hod_photo')) }}" alt="{{ $gs('hod_name', $hod->name ?? 'HOD') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @elseif($hod && $hod->photo)
                            <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-[6rem] bg-gradient-to-br from-primary to-secondary"><i class="fa-solid fa-user-tie"></i></div>
                        @endif
                    </div>
                    
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-5 left-[5%] right-[5%] sm:left-[10%] sm:right-[10%] md:-bottom-8 md:-right-8 md:left-auto md:right-auto bg-white py-3 px-5 md:py-4 md:px-6 rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.15)] flex items-center gap-3 sm:gap-4 z-[3]">
                        <div class="w-10 h-10 shrink-0 bg-primary/10 text-primary rounded-full flex items-center justify-center text-[1.2rem]">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div class="flex-1 whitespace-nowrap">
                            <p class="m-0 font-extrabold text-slate-900 text-[1rem] sm:text-[1.1rem] font-heading leading-none">{{ $gs('home_hod_badge_title','Excellence') }}</p>
                            <p class="m-0 text-[0.7rem] sm:text-[0.75rem] text-slate-500 uppercase tracking-[1px] mt-1">{{ $gs('home_hod_badge_subtitle','In Leadership') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HoD Name Card (Moved under image) -->
            @if($hod || $gs('hod_name'))
            <div class="flex items-center gap-[1.2rem] bg-white py-4 px-6 rounded-xl border border-slate-200 relative z-[2] shadow-sm w-full mx-auto">
                <div class="w-1 h-[35px] rounded-sm bg-gradient-to-b from-primary to-secondary"></div>
                <div>
                    <h4 class="m-0 font-extrabold text-slate-900 text-[1.1rem] font-heading">{{ $gs('hod_name', $hod->name ?? '') }}</h4>
                    <p class="m-0 text-slate-500 text-[0.9rem] font-medium">{{ $gs('hod_rank', $hod->rank ?? '') }}, Head of Department</p>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Stats Counter Cards — integrated into HOD section -->
    <div class="container mt-16 pb-16" data-aos="fade-up">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-5 text-center">
            @foreach([1,2,3,4,5,6] as $n)
            @php
                $defaultIcons = ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-user-graduate','fa-solid fa-users-tie'];
                $defaultLabels = ['Established','Courses','Programmes','Departments','Active Students','Expert Staff'];
                
                $statIcon  = $gs("stat_{$n}_icon", $defaultIcons[$n-1]);
                $statLabel = $gs("stat_{$n}_label", $defaultLabels[$n-1]);

                // Force override for Active Students (to prevent old database values from showing NUC)
                if ($n == 5) {
                    $statIcon = 'fa-solid fa-user-graduate';
                    $statLabel = 'Active Students';
                    $statValue = '1,500+';
                } elseif ($n == 6) {
                    $statIcon = 'fa-solid fa-users-tie';
                    $statLabel = 'Expert Staff';
                    $statValue = \App\Models\Staff::count() > 0 ? \App\Models\Staff::count() : '50+';
                } elseif ($n == 2 || stripos($statLabel, 'courses') !== false) {
                    $statValue = \App\Models\Course::count();
                } elseif ($n == 3 || stripos($statLabel, 'programmes') !== false) {
                    $statValue = \App\Models\Programme::where('is_active', true)->count();
                } elseif ($n == 4 || stripos($statLabel, 'departments') !== false) {
                    $statValue = \App\Models\ProgrammeCategory::count();
                } else {
                    $statValue = $gs("stat_{$n}_value", [config('university.established'), '', '', '', '', ''][$n-1]);
                }
            @endphp
            <div data-aos="fade-up" class="relative overflow-hidden bg-gradient-to-br from-[#14532d] via-[#166534] to-[#15803d] hover:from-[#166534] hover:via-[#15803d] hover:to-[#16a34a] text-white p-6 md:p-[1.8rem_1.2rem_1.4rem] rounded-2xl md:rounded-2xl lg:min-h-[130px] shadow-[0_4px_15px_rgba(20,83,45,0.25)] group hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(20,83,45,0.35)] transition-all duration-300 flex flex-col items-center justify-center">
                <div class="absolute right-[12px] bottom-[10px] text-[3rem] text-white/10 opacity-90 group-hover:text-white/20 group-hover:scale-110 pointer-events-none transition-all duration-300 leading-none z-[1]"><i class="{{ $statIcon }}"></i></div>
                <h2 class="text-[2.8rem] text-white font-heading font-black mb-[0.3rem] leading-none tracking-normal z-[2] group-hover:scale-105 transition-transform duration-300">{{ $statValue }}</h2>
                <p class="text-[0.7rem] font-bold text-white/75 group-hover:text-white/90 uppercase tracking-[1.5px] z-[2] transition-colors duration-300 m-0">{{ $statLabel }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


