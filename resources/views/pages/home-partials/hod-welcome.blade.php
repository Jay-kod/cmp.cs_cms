<!-- HOD WELCOME + STATS (Combined Section) -->
<section data-aos="fade-up" class="hod-section pt-[5rem] pb-[4rem] bg-slate-50 relative overflow-hidden">
    <!-- Abstract Background Decor -->
    <div class="absolute top-[-100px] right-[-50px] w-[300px] h-[300px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.08)_0%,transparent_70%)]"></div>
    <div class="absolute bottom-[-50px] left-[10%] w-[250px] h-[250px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)]"></div>
    
    <div class="container relative z-[2]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- TEXT COLUMN (Stacks bottom on mobile, left on desktop) -->
            <div class="lg:col-span-7 order-2 lg:order-1 flex flex-col justify-center">
                <span class="inline-block w-max text-primary text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_hod_badge','Welcome Message') }}</span>
                <h2 class="text-[2.2rem] md:text-[2.8rem] mb-6 font-heading font-extrabold text-slate-900 leading-[1.15]">{{ $gs('home_hod_title','From the Head of Department') }}</h2>
                
                <div class="relative pl-6 md:pl-8 mb-8 mt-4 border-l-4 border-primary/20">
                    <i class="fa-solid fa-quote-left absolute -top-3 -left-3 text-[2.5rem] bg-slate-50 text-primary/20 z-0"></i>
                    <blockquote class="relative z-10 text-[1.1rem] md:text-[1.15rem] text-slate-600 leading-[1.8] m-0 italic text-justify">
                        "{!! nl2br(e($gs('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.'))) !!}"
                    </blockquote>
                </div>

                <div class="flex items-center gap-4 bg-white p-4 md:p-5 rounded-2xl shadow-sm border border-slate-100 max-w-max">
                    <div class="w-12 h-12 shrink-0 bg-primary/10 text-primary rounded-full flex items-center justify-center text-[1.2rem]">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div class="flex-1 pr-4">
                        <p class="m-0 font-extrabold text-slate-900 text-[1.05rem] font-heading leading-tight">{{ $gs('home_hod_badge_title','Excellence') }}</p>
                        <p class="m-0 text-[0.75rem] text-slate-500 uppercase tracking-[1px] mt-0.5">{{ $gs('home_hod_badge_subtitle','In Leadership') }}</p>
                    </div>
                </div>
            </div>

            <!-- IMAGE COLUMN (Stacks top on mobile, right on desktop) -->
            <div class="lg:col-span-5 order-1 lg:order-2 w-full">
                <!-- Wrapper explicitly uses 100% width to ensure it fills the grid column on all devices -->
                <div class="relative w-full rounded-[2rem] mx-auto block group lg:max-w-none max-w-md sm:max-w-lg lg:ml-auto">
                    <!-- Decorative back blob -->
                    <div class="absolute -inset-2 sm:-inset-4 bg-gradient-to-tr from-primary/30 to-secondary/20 rounded-[2.5rem] transform rotate-3 scale-[0.98] sm:scale-95 opacity-80 group-hover:scale-100 group-hover:rotate-6 transition-all duration-500 z-0"></div>
                    
                    <!-- Main Image wrapper -->
                    <div class="relative w-full bg-white rounded-[2rem] sm:rounded-3xl p-2 sm:p-3 shadow-xl z-10 border border-slate-100/50">
                        <div class="w-full aspect-square sm:aspect-[4/5] rounded-[1.5rem] sm:rounded-2xl overflow-hidden bg-slate-100 relative shadow-inner">
                            @if($gs('hod_photo'))
                                <img src="{{ asset('storage/'.$gs('hod_photo')) }}" alt="{{ $gs('hod_name', $hod->name ?? 'HOD') }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            @elseif($hod && $hod->photo)
                                <img src="{{ asset('storage/'.$hod->photo) }}" alt="{{ $hod->name }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-white text-[7rem] bg-gradient-to-br from-primary to-secondary"><i class="fa-solid fa-user-tie"></i></div>
                            @endif
                            
                            <!-- Internal Gradient Overlay for Text Readability -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/20 to-transparent pointer-events-none"></div>

                            <!-- Name Info Inside Image (Ensures name stays with the card elegantly) -->
                            <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8 text-white z-10 pointer-events-none">
                                <div class="w-12 h-1 bg-primary mb-3 rounded-full"></div>
                                <h4 class="m-0 font-black text-[1.4rem] sm:text-[1.8rem] font-heading drop-shadow-md leading-tight">{{ $gs('hod_name', $hod->name ?? '') }}</h4>
                                <p class="m-0 text-slate-200 text-[0.8rem] sm:text-[0.95rem] font-medium uppercase tracking-[2px] mt-1 drop-shadow">{{ $gs('hod_rank', $hod->rank ?? '') }}, H.O.D</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
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


