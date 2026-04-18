<!-- PROGRAMMES — Premium Glassmorphism Hover Cards -->
<section data-aos="fade-up" class="py-[6rem] bg-gradient-to-b from-white to-slate-50 relative">
    <!-- Abstract wavy shape at the top -->
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-[calc(100%+1.3px)] h-[50px]">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-slate-50"></path>
        </svg>
    </div>
    
    <div class="container relative z-[2]" data-aos="fade-up">
        <div class="text-center mb-[4rem]">
            <span class="inline-block text-primary text-[0.85rem] font-bold uppercase tracking-[1.5px] mb-[1rem] bg-blue-500/10 py-[0.3rem] px-[1rem] rounded-[20px]">{{ $gs('home_programmes_badge','What We Offer') }}</span>
            <h2 class="text-[2.8rem] font-heading font-extrabold text-slate-900 mb-[1rem]">{{ $gs('home_programmes_title','Academic Programmes') }}</h2>
            <p class="text-slate-500 text-[1.1rem] max-w-[600px] mx-auto leading-[1.7]">{{ $gs('home_programmes_subtitle','Comprehensive undergraduate and postgraduate programmes designed to shape the next generation of global tech leaders.') }}</p>
        </div>
        
        <div data-aos="fade-up" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[2rem]">
            @php
                $progColors = [
                    ['from' => 'from-green-600', 'to' => 'to-emerald-600', 'bg' => 'bg-green-600/10', 'text' => 'text-green-600', 'badge' => 'bg-green-100', 'badgeText' => 'text-green-700'],
                    ['from' => 'from-blue-600', 'to' => 'to-violet-600', 'bg' => 'bg-blue-600/10', 'text' => 'text-blue-600', 'badge' => 'bg-blue-100', 'badgeText' => 'text-blue-700'],
                    ['from' => 'from-cyan-600', 'to' => 'to-sky-600', 'bg' => 'bg-cyan-600/10', 'text' => 'text-cyan-600', 'badge' => 'bg-cyan-100', 'badgeText' => 'text-cyan-700'],
                    ['from' => 'from-orange-600', 'to' => 'to-red-600', 'bg' => 'bg-orange-600/10', 'text' => 'text-orange-600', 'badge' => 'bg-orange-100', 'badgeText' => 'text-orange-700'],
                ];
                $progIcons = ['fa-solid fa-code', 'fa-solid fa-server', 'fa-solid fa-shield-halved', 'fa-solid fa-microchip', 'fa-solid fa-database'];
            @endphp
            @foreach($programmes as $pIdx => $prog)
            @php $pc = $progColors[$pIdx % count($progColors)]; @endphp
            <a href="{{ url('/academics#' . $prog->slug) }}" class="group bg-white rounded-[20px] text-inherit relative overflow-hidden transition-all duration-300 flex flex-col shadow-[0_4px_15px_-3px_rgba(0,0,0,0.05)] border border-slate-100 hover:-translate-y-2 hover:shadow-[0_20px_40px_-10px_rgba(0,0,0,0.1)]">
                {{-- Gradient Header Strip --}}
                <div class="h-[6px] bg-gradient-to-r {{ $pc['from'] }} {{ $pc['to'] }}"></div>

                <div class="p-[2rem_2rem_1.5rem] flex-grow">
                    {{-- Icon + Badge Row --}}
                    <div class="flex justify-between items-start mb-[1.2rem]">
                        <div class="w-[56px] h-[56px] rounded-[16px] {{ $pc['bg'] }} {{ $pc['text'] }} flex items-center justify-center text-[1.4rem] transition-all duration-300 group-hover:scale-110 group-hover:rotate-[5deg] group-hover:shadow-[0_8px_20px_-5px_rgba(0,0,0,0.15)]">
                            <i class="{{ $progIcons[$pIdx % count($progIcons)] }}"></i>
                        </div>
                        <span class="{{ $pc['badge'] }} {{ $pc['badgeText'] }} text-[0.75rem] font-bold py-[0.35rem] px-[0.9rem] rounded-[20px] tracking-[0.5px] uppercase">{{ $prog->level }}</span>
                    </div>

                    {{-- Programme Name --}}
                    <h3 class="text-[1.15rem] m-[0_0_0.8rem] text-slate-800 font-heading font-bold leading-[1.3] transition-colors duration-300 group-hover:text-primary">{{ $prog->name }}</h3>

                    {{-- Description --}}
                    <p class="text-[0.88rem] text-slate-500 leading-[1.6] m-0">{{ Str::limit($prog->description, 100) }}</p>
                </div>

                {{-- Footer --}}
                <div class="p-[1rem_2rem] border-t border-slate-50 flex justify-between items-center mt-auto bg-white transition-colors duration-300 group-hover:bg-slate-50">
                    <div class="flex gap-[1.2rem] text-[0.78rem] text-slate-500 font-medium">
                        <span class="flex items-center gap-[0.4rem]"><i class="fa-regular fa-clock {{ $pc['text'] }} opacity-80"></i> {{ $prog->duration }}</span>
                        <span class="flex items-center gap-[0.4rem]"><i class="fa-solid fa-book-open {{ $pc['text'] }} opacity-80"></i> {{ $prog->mode_of_study }}</span>
                    </div>
                    <div class="w-[32px] h-[32px] rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-[0.85rem] transition-all duration-300 group-hover:translate-x-1 group-hover:bg-primary group-hover:text-white group-hover:shadow-[0_4px_12px_rgba(22,163,74,0.3)]"><i class="fa-solid fa-arrow-right"></i></div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
