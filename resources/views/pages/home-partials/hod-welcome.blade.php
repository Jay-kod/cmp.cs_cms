<!-- HOD WELCOME + STATS (Combined Section) -->
<section data-aos="fade-up" class="hod-section pt-[5rem] pb-[4rem] bg-slate-50 relative overflow-hidden">
    <!-- Abstract Background Decor -->
    <div class="absolute top-[-100px] right-[-50px] w-[300px] h-[300px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.08)_0%,transparent_70%)]"></div>
    <div class="absolute bottom-[-50px] left-[10%] w-[250px] h-[250px] pointer-events-none rounded-full bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)]"></div>
    
    <div class="container relative z-[2]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- TEXT COLUMN (Stacks top on mobile, left on desktop) -->
            <div class="lg:col-span-7 order-1 flex flex-col justify-center">
                <span class="inline-block w-max text-primary text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_hod_badge','Welcome Message') }}</span>
                <h2 class="text-[2.2rem] md:text-[2.8rem] mb-6 font-heading font-extrabold text-slate-900 leading-[1.15]">{{ $gs('home_hod_title','From the Head of Department') }}</h2>
                
                <div class="relative pl-6 md:pl-8 mb-8 mt-4 border-l-4 border-primary/20">
                    <i class="fa-solid fa-quote-left absolute -top-3 -left-3 text-[2.5rem] bg-slate-50 text-primary/20 z-0"></i>
                    <blockquote class="relative z-10 text-[1.1rem] md:text-[1.15rem] text-slate-600 leading-[1.8] m-0 italic text-justify">
                        "{!! nl2br(e($gs('hod_welcome_message', 'Welcome to the Department of Computer Science. We are committed to providing world-class computing education.'))) !!}"
                    </blockquote>
                </div>
            </div>

            <!-- IMAGE COLUMN (Stacks bottom on mobile, right on desktop) -->
            <div class="lg:col-span-5 order-2 w-full">
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
                                <div class="w-full h-full flex items-center justify-center text-white text-[7rem] bg-primary hover:bg-[#166534] shadow-[0_8px_20px_-6px_rgba(22,163,74,0.6)] ring-1 ring-white/20 transition-all"><i class="fa-solid fa-user-tie"></i></div>
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
                $defaultIcons = ['fa-regular fa-building','fa-solid fa-book-open','fa-solid fa-graduation-cap','fa-solid fa-building-user','fa-solid fa-user-graduate','fa-solid fa-users'];
                $defaultLabels = ['Established','Courses','Programmes','Departments','Active Students','Expert Staff'];
                $defaultValues = ['2019', \App\Models\Course::count(), \App\Models\Programme::where('is_active', true)->count(), \App\Models\ProgrammeCategory::count(), '1,500+', \App\Models\Staff::count() > 0 ? \App\Models\Staff::count() : '50+'];

                $statIcon  = $gs("stat_{$n}_icon", $defaultIcons[$n-1]);
                $statLabel = $gs("stat_{$n}_label", $defaultLabels[$n-1]);
                $statValue = $gs("stat_{$n}_value", $defaultValues[$n-1]);
            @endphp
            <div data-aos="fade-up" data-aos-delay="{{ $n * 50 }}" class="relative bg-gradient-to-b from-green-50/80 to-[#f3faf5] rounded-2xl p-4 sm:p-5 border border-white hover:border-primary/20 shadow-xl shadow-[0_8px_30px_rgba(0,0,0,0.18)] group hover:-translate-y-2 hover:shadow-[0_20px_50px_-15px_rgba(22,163,74,0.4)] transition-all duration-500 overflow-hidden flex flex-col items-center justify-center text-center z-10 h-full cursor-default">
                <!-- Decorative background elements -->
                <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/60 rounded-full blur-2xl group-hover:bg-primary/5 transition-colors duration-500 pointer-events-none"></div>
                
                <!-- Icon container -->
                <div class="relative w-12 h-12 mx-auto mb-3 rounded-xl bg-white flex items-center justify-center text-[1.2rem] text-primary shadow-[0_4px_20px_-5px_rgba(22,163,74,0.1)] group-hover:bg-primary group-hover:text-white group-hover:scale-110 transition-all duration-500 z-10">
                    <i class="{{ $statIcon }}"></i>
                </div>
                
                <!-- Value -->
                <h2 class="relative text-[1.8rem] lg:text-[2.2rem] text-slate-800 font-heading font-extrabold mb-1 leading-none tracking-tight z-10 group-hover:scale-105 group-hover:text-primary transition-all duration-500">
                    {{ $statValue }}
                </h2>
                
                <!-- Label -->
                <p class="relative text-[0.65rem] lg:text-[0.7rem] font-bold text-slate-500 uppercase tracking-[1.5px] m-0 z-10 group-hover:text-slate-700 transition-colors duration-300">{{ $statLabel }}</p>

                <!-- Bottom accent line -->
                <div class="absolute bottom-0 left-0 h-1 w-0 bg-gradient-to-r from-primary/80 to-primary group-hover:w-full transition-all duration-500 ease-out"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>


