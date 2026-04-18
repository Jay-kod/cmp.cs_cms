<!-- MEET OUR STAFF -->
<section data-aos="fade-up" class="py-24 bg-[#f4fcfa] relative overflow-hidden">
    <div class="absolute -top-20 -left-20 w-[250px] h-[250px] bg-[radial-gradient(circle,rgba(22,163,74,0.06)_0%,transparent_70%)] pointer-events-none"></div>
    <div class="container relative z-10" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block text-primary text-sm font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_staff_badge','Our Team') }}</span>
            <h2 class="text-4xl md:text-[2.8rem] font-heading font-extrabold text-[#0f172a] mb-4">{{ $gs('home_staff_title','Meet Our Faculty') }}</h2>
            <p class="text-[#64748b] text-lg max-w-[600px] mx-auto leading-relaxed text-center">{{ $gs('home_staff_subtitle','Dedicated academics and researchers shaping the future of computer science education.') }}</p>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-8">
            @foreach($featuredStaff as $member)
            <a href="{{ route('people.show', $member->slug) }}" class="group block bg-[#f8fafc] rounded-2xl overflow-hidden border border-[#e2e8f0] transition-all duration-300 hover:-translate-y-2 hover:shadow-xl hover:border-primary/20">
                <div data-aos="fade-up" class="relative pt-[125%] overflow-hidden">
                    @if($member->photo)
                        <img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" class="absolute top-0 left-0 w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=400&background=14532d&color=fff&bold=true&format=svg&font-size=0.35" alt="{{ $member->name }}" class="absolute top-0 left-0 w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110">
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 h-[60px] bg-gradient-to-t from-black/50 to-transparent pointer-events-none opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="px-6 py-5 flex flex-col items-center justify-center text-center bg-white transition-colors duration-300 group-hover:bg-[#f4fcfa]">
                    <h3 class="text-[1.15rem] font-bold text-[#0f172a] mb-1 font-heading text-center w-full group-hover:text-primary transition-colors">{{ $member->name }}</h3>
                    <div class="text-[0.85rem] text-primary font-semibold mx-auto text-center w-full">{{ $member->rank ?? 'Lecturer' }}</div>
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
