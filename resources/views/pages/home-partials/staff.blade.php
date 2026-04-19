<!-- MEET OUR STAFF -->
<section data-aos="fade-up" class="py-24 bg-[#f4fcfa] relative overflow-hidden">
    <div class="absolute -top-20 -left-20 w-[250px] h-[250px] bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)] pointer-events-none"></div>
    <div class="container relative z-10" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block text-primary text-sm font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_staff_badge','Our Team') }}</span>
            <h2 class="text-4xl md:text-[2.8rem] font-heading font-extrabold text-[#0f172a] mb-4">{{ $gs('home_staff_title','Meet Our Faculty') }}</h2>
            <p class="text-[#64748b] text-lg max-w-[600px] mx-auto leading-relaxed text-center">{{ $gs('home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            @foreach($featuredStaff as $member)
            <a href="{{ route('people.show', $member->slug) }}" class="group block bg-white rounded-[2rem] p-3 sm:p-4 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:border-primary/20">
                
                <!-- Image Wrapper -->
                <div class="relative w-full aspect-[4/5] rounded-[1.5rem] overflow-hidden mb-5 bg-slate-50 relative z-10">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="absolute inset-0 w-full h-full object-cover object-[center_top] transition-transform duration-700 ease-out group-hover:scale-110">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=400&background=14532d&color=fff&bold=true&format=svg&font-size=0.35" alt="{{ $member->name }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
                    @endif
                    
                    <!-- Elegant Subtle Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- View Profile Mini Badge on Hover -->
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-4 group-hover:translate-y-0">
                        <span class="bg-white/95 backdrop-blur-sm text-primary text-[0.7rem] font-bold uppercase tracking-[1px] py-1.5 px-4 rounded-full shadow-lg flex items-center gap-2">View Profile <i class="fa-solid fa-arrow-right"></i></span>
                    </div>
                </div>

                <!-- Text Details -->
                <div class="px-2 pb-3 flex flex-col items-center justify-center text-center">
                    <h3 class="text-[1.1rem] sm:text-[1.15rem] font-extrabold text-slate-900 mb-1.5 font-heading transition-colors group-hover:text-primary leading-[1.2] line-clamp-1" title="{{ $member->name }}">{{ $member->name }}</h3>
                    <div class="text-[0.75rem] text-slate-500 font-bold uppercase tracking-[1.5px] mx-auto text-center">{{ $member->rank ?? 'Lecturer' }}</div>
                </div>

            </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ url('/people') }}" class="inline-flex items-center gap-2.5 bg-primary text-white py-3 px-8 rounded-lg text-base font-bold transition-all duration-300 shadow-[0_4px_15px_rgba(22,163,74,0.3)] hover:-translate-y-1 hover:shadow-[0_8px_25px_rgba(22,163,74,0.4)]">
                {{ $gs('home_staff_btn_text','View All Staff') }} <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</section>
