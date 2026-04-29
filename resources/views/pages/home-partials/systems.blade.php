<!-- DEPARTMENT SYSTEMS / EXTERNAL LINKS -->
@if($externalSystems->count())
<section data-aos="fade-up" class="py-24 bg-gradient-to-b from-[#f8fafc] to-white relative">
    <div class="container" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block text-primary text-sm font-bold uppercase tracking-[1.5px] mb-4 bg-primary/10 py-1.5 px-4 rounded-full">{{ $gs('home_systems_badge','Quick Access') }}</span>
            <h2 class="text-4xl md:text-[2.8rem] font-heading font-extrabold text-[#0f172a] mb-4">{{ $gs('home_systems_title','Department Systems') }}</h2>
            <p class="text-[#64748b] text-lg max-w-[600px] mx-auto leading-relaxed">{{ $gs('home_systems_subtitle','Access our online platforms, portals, and tools for students and staff.') }}</p>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,minmax(280px,1fr))] gap-8">
            @foreach($externalSystems as $sys)
            <a href="{{ $sys->url }}" {{ $sys->open_in_new_tab ? 'target="_blank" rel="noopener"' : '' }} class="group flex flex-col gap-6 p-7 bg-emerald-50/50 border border-emerald-200 rounded-2xl transition-all duration-500 shadow-lg shadow-emerald-500/20 relative overflow-hidden hover:-translate-y-2 hover:shadow-2xl hover:shadow-emerald-500/40 hover:border-emerald-400 hover:bg-emerald-50">
                <!-- Decorative ambient glow (Softened for pale card) -->
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-200/40 rounded-full blur-3xl group-hover:bg-emerald-300/40 transition-colors duration-700 pointer-events-none"></div>
                <div class="absolute -left-10 -bottom-10 w-32 h-32 bg-green-200/40 rounded-full blur-2xl group-hover:bg-green-300/40 transition-colors duration-700 pointer-events-none"></div>
                
                <!-- Animated Top Bar -->
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 via-green-400 to-emerald-500 scale-x-0 origin-left transition-transform duration-500 ease-out group-hover:scale-x-100 z-10"></div>
                
                <!-- Card Header: Icon -->
                <div class="relative z-10 w-16 h-16 bg-white/80 backdrop-blur-md border border-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 text-3xl shadow-sm transition-transform duration-500 group-hover:scale-110 group-hover:-rotate-3 group-hover:bg-emerald-600 group-hover:text-white group-hover:border-emerald-500">
                    <i class="{{ $sys->icon ?? 'fa-solid fa-globe' }}"></i>
                </div>
                
                <!-- Card Body -->
                <div class="relative z-10 flex-1 flex flex-col">
                    <h3 class="text-xl font-bold text-slate-800 mb-2 font-heading tracking-wide group-hover:text-emerald-900 transition-colors">{{ $sys->name }}</h3>
                    @if($sys->description ?? false)
                    <p class="text-[0.95rem] text-slate-600 leading-relaxed mb-4 group-hover:text-slate-700 transition-colors">{{ Str::limit($sys->description, 80) }}</p>
                    @endif
                    
                    <!-- Card Footer (Pushed to bottom) -->
                    <div class="mt-auto pt-5 border-t border-emerald-100 flex items-center justify-between group-hover:border-emerald-200 transition-colors">
                        <span class="text-xs font-bold text-emerald-600 tracking-wider uppercase group-hover:text-emerald-700 transition-colors duration-300">
                            Access Portal
                        </span>
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center border border-emerald-200 group-hover:bg-emerald-600 group-hover:border-emerald-600 transition-all duration-500 shadow-sm">
                            <i class="fa-solid {{ $sys->open_in_new_tab ? 'fa-arrow-up-right-from-square' : 'fa-arrow-right' }} text-emerald-600 group-hover:text-white text-sm transition-transform duration-500 group-hover:translate-x-0.5 group-hover:-translate-y-0.5"></i>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
