<!-- HOD WELCOME + STATS (Combined Section) -->
<section data-aos="fade-up" class="hod-section pt-[5rem] pb-[4rem] bg-slate-50 relative overflow-hidden">
    <!-- Abstract Background Decor -->
    <div class="absolute top-[-100px] right-[-50px] w-[300px] h-[300px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.08)_0%,transparent_70%)]"></div>
    <div class="absolute bottom-[-50px] left-[10%] w-[250px] h-[250px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)]"></div>
    
    <div class="container grid grid-cols-1 lg:grid-cols-3 gap-[2rem] relative z-[2]">
        
        <!-- CARD 1: HOD Photo (Moved strictly to the very first visual spot as requested) -->
        <div class="bg-white p-5 sm:p-6 rounded-[2rem] shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-slate-100 flex flex-col justify-center">
            <div class="hod-photo relative w-full h-full flex flex-col justify-center items-center">
                <!-- Wrapper for Image and floating badge -->
                <div class="relative z-[2] w-full block group mx-auto">
                    <div class="w-full aspect-square sm:aspect-[4/5] lg:aspect-[3/4] rounded-2xl sm:rounded-[1.5rem] overflow-hidden shadow-[0_15px_40px_-5px_rgba(0,0,0,0.2)] border-4 border-white xl:border-[6px] xl:border-primary/10 bg-slate-100">
                        @if($gs('hod_photo'))
                            <img src="{{ asset('storage/'.$gs('hod_photo')) }}" alt="{{ $gs('hod_name', $hod->name ?? 'HOD') }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @elseif($hod && $hod->photo)
                            <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-[5rem] bg-gradient-to-br from-primary to-secondary"><i class="fa-solid fa-user-tie"></i></div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- HoD Name & Rank -->
            @if($hod || $gs('hod_name'))
            <div class="flex items-center gap-[1.2rem] mt-6 w-full mx-auto">
                <div class="w-1.5 h-[40px] rounded-full bg-gradient-to-b from-primary to-secondary shrink-0"></div>
                <div>
                    <h4 class="m-0 font-extrabold text-slate-900 text-[1.15rem] font-heading">{{ $gs('hod_name', $hod->name ?? '') }}</h4>
                    <p class="m-0 text-slate-500 text-[0.85rem] font-medium uppercase tracking-wide mt-0.5">{{ $gs('hod_rank', $hod->rank ?? '') }}, Head of Department</p>
                </div>
            </div>
            @endif
        </div>

        <!-- CARD 2: Introduction Text & Title -->
        <div class="bg-white p-8 lg:p-10 rounded-[2rem] shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-slate-100 flex flex-col justify-center">
            <span class="inline-block w-max text-primary text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-5 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_hod_badge','Welcome Message') }}</span>
            <h2 class="text-[2.2rem] xl:text-[2.6rem] mb-6 font-heading font-extrabold text-slate-900 leading-[1.15]">{{ $gs('home_hod_title','From the Head of Department') }}</h2>
            
            <div class="flex items-center gap-4 mt-auto pt-6 border-t border-slate-100">
                <div class="w-12 h-12 shrink-0 bg-primary/10 text-primary rounded-full flex items-center justify-center text-[1.2rem]">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="flex-1">
                    <p class="m-0 font-extrabold text-slate-900 text-[1.1rem] font-heading leading-tight">{{ $gs('home_hod_badge_title','Excellence') }}</p>
                    <p class="m-0 text-[0.75rem] text-slate-500 uppercase tracking-[1px] mt-0.5">{{ $gs('home_hod_badge_subtitle','In Leadership') }}</p>
                </div>
            </div>
        </div>

        <!-- CARD 3: The Message Quote -->
        <div class="bg-gradient-to-br from-primary via-[#166534] to-secondary p-8 lg:p-10 rounded-[2rem] shadow-lg flex flex-col justify-center text-white relative overflow-hidden group">
            <!-- Decorative background elements -->
            <div class="absolute top-[-50px] right-[-50px] text-[12rem] text-white/5 group-hover:scale-110 transition-transform duration-700 pointer-events-none transform -rotate-12"><i class="fa-solid fa-quote-right"></i></div>
            
            <i class="fa-solid fa-quote-left text-[2.5rem] xl:text-[3rem] text-white/30 mb-6 relative z-10"></i>
            
            <blockquote class="relative z-10 text-[1.15rem] xl:text-[1.25rem] text-white/95 leading-[1.8] m-0 italic text-justify font-medium">
                "{!! nl2br(e($gs('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.'))) !!}"
            </blockquote>
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


