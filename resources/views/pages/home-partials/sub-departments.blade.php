<!-- SUB-DEPARTMENTS OVERVIEW -->
<section data-aos="fade-up" class="py-24 bg-[#F0F9F3] relative">
    <div class="container px-4" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block text-primary text-sm font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_subdepts_badge','Overview') }}</span>
            <h2 class="text-4xl md:text-[2.8rem] font-heading font-extrabold text-[#0f172a] mb-4">{{ $gs('home_subdepts_title','Our Departments') }}</h2>
            <p class="text-[#64748b] text-lg max-w-[600px] mx-auto leading-relaxed">{{ $gs('home_subdepts_subtitle','The faculty incorporates three dynamic departments offering specialized programmes.') }}</p>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-8">
            <!-- Dept 1 -->
            <div class="group bg-white rounded-2xl p-10 text-center border border-[#e2e8f0] shadow-[0_10px_30px_rgba(0,0,0,0.05)] transition-all duration-300 cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_15px_35px_rgba(0,0,0,0.1)] hover:border-primary/20" onclick="window.location.href='{{ route('department.show', 'computer-science') }}'">
                <div class="w-[70px] h-[70px] mx-auto mb-6 bg-primary/10 text-primary rounded-[20px] flex items-center justify-center text-3xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="{{ $gs('home_subdept_1_icon','fa-solid fa-laptop-code') }}"></i>
                </div>
                <h3 class="text-[1.4rem] font-extrabold text-[#0f172a] mb-4 transition-colors group-hover:text-primary">{{ $gs('home_subdept_1_title','Computer Science') }}</h3>
                <p class="text-[#64748b] leading-[1.6] mb-0">{{ $gs('home_subdept_1_desc','Focuses on software engineering, artificial intelligence, algorithms, and computing theories.') }}</p>
            </div>
            
            <!-- Dept 2 -->
            <div class="group bg-white rounded-2xl p-10 text-center border border-[#e2e8f0] shadow-[0_10px_30px_rgba(0,0,0,0.05)] transition-all duration-300 cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_15px_35px_rgba(0,0,0,0.1)] hover:border-primary/20" onclick="window.location.href='{{ route('department.show', 'cyber-security') }}'">
                <div class="w-[70px] h-[70px] mx-auto mb-6 bg-primary/10 text-primary rounded-[20px] flex items-center justify-center text-3xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="{{ $gs('home_subdept_2_icon','fa-solid fa-shield-halved') }}"></i>
                </div>
                <h3 class="text-[1.4rem] font-extrabold text-[#0f172a] mb-4 transition-colors group-hover:text-primary">{{ $gs('home_subdept_2_title','Cyber Security') }}</h3>
                <p class="text-[#64748b] leading-[1.6] mb-0">{{ $gs('home_subdept_2_desc','Specialized training in network security, ethical hacking, digital forensics, and data protection.') }}</p>
            </div>
            
            <!-- Dept 3 -->
            <div class="group bg-white rounded-2xl p-10 text-center border border-[#e2e8f0] shadow-[0_10px_30px_rgba(0,0,0,0.05)] transition-all duration-300 cursor-pointer hover:-translate-y-1.5 hover:shadow-[0_15px_35px_rgba(0,0,0,0.1)] hover:border-primary/20" onclick="window.location.href='{{ route('department.show', 'data-science') }}'">
                <div class="w-[70px] h-[70px] mx-auto mb-6 bg-primary/10 text-primary rounded-[20px] flex items-center justify-center text-3xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="{{ $gs('home_subdept_3_icon','fa-solid fa-database') }}"></i>
                </div>
                <h3 class="text-[1.4rem] font-extrabold text-[#0f172a] mb-4 transition-colors group-hover:text-primary">{{ $gs('home_subdept_3_title','Data Science') }}</h3>
                <p class="text-[#64748b] leading-[1.6] mb-0">{{ $gs('home_subdept_3_desc','Advanced studies in big data analytics, machine learning, and statistical modeling for complex problems.') }}</p>
            </div>
        </div>
    </div>
</section>
