<!-- MEET OUR STAFF -->
<section data-aos="fade-up" class="py-24 bg-[#080d19] relative overflow-hidden border-t border-slate-900">    
    <!-- Background Accents -->
    <div class="absolute -top-20 -left-20 w-[400px] h-[400px] bg-[radial-gradient(circle,rgba(22,163,74,0.15)_0%,transparent_70%)] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[radial-gradient(circle,rgba(22,163,74,0.1)_0%,transparent_70%)] pointer-events-none"></div>

    <div class="container relative z-10" data-aos="fade-up">
        
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-block relative mb-6 transform -skew-x-12 bg-slate-900 border-l-[3px] border-r-[3px] border-primary/60 shadow-[0_0_20px_rgba(22,163,74,0.2)] hover:border-primary transition-colors">
                <span class="block text-primary text-[0.8rem] font-extrabold uppercase tracking-[3px] py-1.5 px-6 transform skew-x-12">{{ $gs('home_staff_badge','Leadership') }}</span>
            </div>
            <h2 class="text-4xl md:text-[3.2rem] font-heading font-black text-white mb-4 uppercase tracking-tighter">{{ $gs('home_staff_title','Meet Our Faculty') }}</h2>
            <p class="text-slate-400 text-[1.05rem] max-w-[600px] mx-auto leading-relaxed text-center">{{ $gs('home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.') }}</p>
        </div>

        <!-- Diagonal Masked Cards Layout -->
        <div class="flex flex-col lg:flex-row justify-center items-stretch gap-[10px] lg:gap-0 lg:px-4 w-full xl:w-[110%] xl:-ml-[5%]">
            @foreach($featuredStaff as $member)
            <a href="{{ route('people.show', $member->slug) }}" class="group relative w-full lg:flex-1 h-[400px] sm:h-[450px] flex-shrink-0 transition-all duration-500 lg:hover:flex-[1.3]">
                
                <!-- The Skewed Wrapper with Accent -->
                <div class="absolute inset-0 transform lg:-skew-x-[12deg] overflow-hidden bg-slate-900 border-l-[5px] border-[#080d19] group-hover:border-primary transition-colors duration-500 z-10 shadow-2xl">
                    
                    <!-- The Un-Skewed Inner Image Area -->
                    <div class="absolute inset-0 w-[140%] h-[110%] transform lg:skew-x-[12deg] -ml-[20%] -mt-[5%] bg-[#0f172a]">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-full h-[100%] object-cover object-top opacity-70 group-hover:opacity-100 filter grayscale-[50%] group-hover:grayscale-0 transition-all duration-700 ease-in-out group-hover:scale-105">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=400&background=1e293b&color=fff&bold=true&format=svg&font-size=0.35" alt="{{ $member->name }}" class="w-full h-full object-cover object-[center_top] opacity-70 group-hover:opacity-100 filter grayscale-[50%] group-hover:grayscale-0 transition-all duration-700 ease-in-out group-hover:scale-105">
                        @endif
                        
                        <!-- Bottom shadow for text contrast -->
                        <div class="absolute inset-0 bg-gradient-to-t from-[#080d19] via-slate-900/60 to-transparent"></div>
                    </div>
                </div>

                <!-- Floating accent slice between cards -->
                <div class="hidden lg:block absolute top-[10%] -left-[3px] w-[5px] h-[35%] bg-gradient-to-b from-primary to-transparent transform -skew-x-[12deg] z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-[0_0_15px_rgba(22,163,74,0.5)]"></div>

                <!-- Floating/Skewed Name Plate -->
                <div class="absolute bottom-8 left-4 right-4 lg:left-0 lg:right-[1.5rem] transform lg:-skew-x-[12deg] bg-slate-900 border-l-4 border-b-2 border-primary p-4 sm:p-5 z-30 shadow-[5px_15px_30px_rgba(0,0,0,0.9)] lg:group-hover:-translate-y-3 transition-transform duration-500">
                    <div class="transform lg:skew-x-[12deg] flex flex-col justify-center">
                        <h3 class="text-white font-heading font-black text-[1.1rem] sm:text-[1.2rem] uppercase tracking-wider m-0 mb-1 group-hover:text-primary transition-colors line-clamp-1" title="{{ $member->name }}">{{ $member->name }}</h3>
                        <p class="text-slate-400 font-extrabold text-[0.7rem] sm:text-[0.75rem] italic tracking-[2px] uppercase m-0 group-hover:text-slate-300 transition-colors">{{ $member->rank ?? 'Lecturer' }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Button -->
        <div class="text-center mt-20 relative z-20">
            <a href="{{ url('/people') }}" class="inline-flex items-center gap-3 bg-primary text-white py-3.5 px-8 md:px-12 border-r-4 border-b-4 border-primary/50 text-[0.95rem] font-bold transition-all duration-300 hover:translate-x-1 hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(22,163,74,0.4)] uppercase tracking-wider transform -skew-x-12">
                <span class="transform skew-x-12 text-white block">{{ $gs('home_staff_btn_text','View All Staff') }}</span> <i class="fa-solid fa-arrow-right transform skew-x-12 text-white"></i>
            </a>
        </div>
        
    </div>
</section>
