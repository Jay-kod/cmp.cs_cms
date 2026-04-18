<!-- DEPARTMENT SYSTEMS / EXTERNAL LINKS -->
@if($externalSystems->count())
<section data-aos="fade-up" class="py-24 bg-gradient-to-b from-[#f8fafc] to-white relative">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block text-primary text-sm font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_systems_badge','Quick Access') }}</span>
            <h2 class="text-4xl md:text-[2.8rem] font-heading font-extrabold text-[#0f172a] mb-4">{{ $gs('home_systems_title','Department Systems') }}</h2>
            <p class="text-[#64748b] text-lg max-w-[600px] mx-auto leading-relaxed">{{ $gs('home_systems_subtitle','Access our online platforms, portals, and tools for students and staff.') }}</p>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(220px,1fr))] gap-6">
            @foreach($externalSystems as $sys)
            <a href="{{ $sys->url }}" {{ $sys->open_in_new_tab ? 'target="_blank" rel="noopener"' : '' }} class="group flex flex-col items-center text-center gap-4 py-8 px-6 bg-white border border-[#e2e8f0] rounded-2xl transition-all duration-300 shadow-[0_4px_12px_rgba(0,0,0,0.04)] relative overflow-hidden hover:-translate-y-1 hover:shadow-xl hover:border-primary/20">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-primary scale-x-0 origin-left transition-transform duration-300 group-hover:scale-x-100"></div>
                <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-2xl transition-colors duration-300 group-hover:bg-primary group-hover:text-white">
                    <i class="{{ $sys->icon ?? 'fa-solid fa-globe' }}"></i>
                </div>
                <div>
                    <h3 class="text-[1.05rem] font-bold text-[#0f172a] mb-1 font-heading group-hover:text-primary transition-colors">{{ $sys->name }}</h3>
                    @if($sys->description ?? false)
                    <p class="text-[0.85rem] text-[#64748b] leading-[1.4]">{{ Str::limit($sys->description, 60) }}</p>
                    @endif
                </div>
                <span class="text-xs font-semibold text-primary flex items-center gap-1.5 opacity-80 group-hover:opacity-100 transition-opacity">
                    Visit {{ $sys->open_in_new_tab ? '' : '' }}<i class="fa-solid {{ $sys->open_in_new_tab ? 'fa-up-right-from-square transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5' : 'fa-arrow-right-long transition-transform group-hover:translate-x-1' }} text-[0.7rem]"></i>
                </span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
