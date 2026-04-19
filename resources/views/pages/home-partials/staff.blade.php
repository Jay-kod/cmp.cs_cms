<!-- MEET OUR STAFF -->
<section data-aos="fade-up" class="py-24 bg-green-50/80 relative overflow-hidden border-y border-green-100">    
    <!-- Background Accents -->
    <div class="absolute -top-20 -left-20 w-[400px] h-[400px] bg-[radial-gradient(circle,rgba(34,197,94,0.15)_0%,transparent_70%)] pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-[radial-gradient(circle,rgba(34,197,94,0.1)_0%,transparent_70%)] pointer-events-none"></div>

    <div class="container relative z-10" data-aos="fade-up">
        
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-block relative mb-6 transform -skew-x-12 bg-white border border-emerald-400/20 shadow-[0_4px_15px_rgba(22,163,74,0.1)] hover:border-emerald-400 transition-colors">
                <span class="block text-primary text-[0.8rem] font-extrabold uppercase tracking-[2px] py-1.5 px-6 transform skew-x-12">{{ $gs('home_staff_badge','Leadership') }}</span>
            </div>
            <h2 class="text-4xl md:text-[3.2rem] font-heading font-black text-slate-800 mb-4 uppercase tracking-tighter">{{ $gs('home_staff_title','Meet Our Faculty') }}</h2>
            <p class="text-slate-600 text-[1.05rem] max-w-[600px] mx-auto leading-relaxed text-center">{{ $gs('home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.') }}</p>
        </div>

        <!-- Diagonal Separated Cards Layout -->
        <div class="flex flex-col lg:flex-row justify-center items-stretch gap-8 lg:gap-6 lg:px-4 w-full">
            @foreach($featuredStaff as $member)
            <a href="{{ route('people.show', $member->slug) }}" class="group relative w-full lg:flex-1 h-[450px] flex-shrink-0 transition-transform duration-500 hover:-translate-y-3">
                
                <!-- The Skewed Wrapper with Rounded Corners and Gap -->
                <div class="absolute inset-0 transform lg:-skew-x-[8deg] overflow-hidden bg-emerald-950 border-[3px] border-emerald-900 rounded-[1.5rem] group-hover:border-emerald-400/50 transition-colors duration-500 z-10 shadow-[0_15px_30px_rgba(0,0,0,0.1)] group-hover:shadow-[0_20px_40px_rgba(22,163,74,0.2)]">
                    
                    <!-- The Un-Skewed Inner Image Area (Reduced Zoom Ratio) -->
                    <div class="absolute inset-0 w-[125%] h-[100%] transform lg:skew-x-[8deg] -ml-[12.5%] bg-emerald-950">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="w-full h-[100%] object-cover object-top opacity-85 group-hover:opacity-100 filter grayscale-[20%] group-hover:grayscale-0 transition-all duration-500 ease-out group-hover:scale-[1.03]">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=400&background=022c22&color=a7f3d0&bold=true&format=svg&font-size=0.35" alt="{{ $member->name }}" class="w-full h-full object-cover object-[center_top] opacity-85 group-hover:opacity-100 filter grayscale-[20%] group-hover:grayscale-0 transition-all duration-500 ease-out group-hover:scale-[1.03]">
                        @endif
                        
                        <!-- Smoother gradient shadow for text contrast -->
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/40 to-transparent"></div>
                    </div>
                </div>

                <!-- Floating/Skewed Name Plate -->
                <div class="absolute bottom-6 left-4 right-4 lg:left-3 lg:right-3 transform lg:-skew-x-[8deg] bg-emerald-950/95 backdrop-blur-sm border-l-[4px] border-emerald-400 p-4 sm:p-5 rounded-xl z-30 shadow-[0_10px_20px_rgba(0,0,0,0.5)] transition-all duration-500 group-hover:bg-emerald-800/95">
                    <div class="transform lg:skew-x-[8deg] flex flex-col justify-center">
                        <h3 class="text-white font-heading font-bold text-[1.1rem] uppercase tracking-wide m-0 mb-1 group-hover:text-primary transition-colors line-clamp-1" title="{{ $member->name }}">{{ $member->name }}</h3>
                        <p class="text-emerald-200/80 font-bold text-[0.7rem] sm:text-[0.75rem] tracking-[1.5px] uppercase m-0 group-hover:text-emerald-100 transition-colors">{{ $member->rank ?? 'Lecturer' }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Button -->
        <div class="text-center mt-16 relative z-20">
            <a href="{{ url('/people') }}" class="inline-flex items-center gap-3 bg-primary text-white py-3.5 px-8 md:px-12 border-r-4 border-b-4 border-emerald-400/50 text-[0.95rem] font-bold transition-all duration-300 hover:translate-x-1 hover:-translate-y-1 hover:shadow-[0_15px_30px_rgba(22,163,74,0.4)] uppercase tracking-wider transform -skew-x-12 rounded-sm">
                <span class="transform skew-x-12 text-white block">{{ $gs('home_staff_btn_text','View All Staff') }}</span> <i class="fa-solid fa-arrow-right transform skew-x-12 text-white"></i>
            </a>
        </div>
        
    </div>
</section>

