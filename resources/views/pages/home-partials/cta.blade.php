<!-- CALL TO ACTION — Contact & Apply -->
<section data-aos="fade-up" class="relative py-28 bg-emerald-900 border-y-2 border-emerald-700/50 shadow-[0_20px_50px_-10px_rgba(5,150,105,0.4)] overflow-hidden text-center">
    
    <!-- Deep Inner Glows -->
    <div class="absolute top-0 right-0 -mr-48 -mt-48 w-[600px] h-[600px] bg-emerald-500/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 -ml-48 -mb-48 w-[600px] h-[600px] bg-emerald-600/20 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCI+PGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMC44IiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDcpIi8+PC9zdmc+')] opacity-60 pointer-events-none"></div>
    
    <div class="relative z-10 container px-4 sm:px-6 lg:px-8 mx-auto max-w-4xl flex flex-col items-center">
        <!-- Main Headings -->
        <h2 class="text-4xl md:text-[3.6rem] font-heading font-black text-white mb-6 leading-tight drop-shadow-lg tracking-tight">
            {{ $gs('home_cta_title','Ready to Join Us?') }}
        </h2>
        <p class="text-[1.1rem] md:text-[1.2rem] text-emerald-50/90 leading-relaxed mb-12 max-w-3xl font-medium drop-shadow-sm text-center">
            {!! nl2br(e($gs('home_cta_subtitle','Whether you\'re a prospective student, an alumnus, or just curious about the department — we\'d love to hear from you.'))) !!}
        </p>
        
        <!-- Modern Pill Buttons Container -->
        <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4 sm:gap-6 w-full">
            @foreach([1,2,3] as $bi)
            @php
                $defaultBtnLabels = ['Contact Us', 'About the Department', 'View Programmes'];
                $defaultBtnUrls   = ['/contact', '/about', '/academics'];
                $defaultBtnIcons  = ['fa-solid fa-envelope', 'fa-solid fa-circle-info', 'fa-solid fa-graduation-cap'];
                $btnText = $gs('home_cta_btn'.$bi.'_text', $defaultBtnLabels[$bi-1]);
                $btnUrl  = $gs('home_cta_btn'.$bi.'_url',  $defaultBtnUrls[$bi-1]);
                $btnIcon = $gs('home_cta_btn'.$bi.'_icon', $defaultBtnIcons[$bi-1]);
            @endphp
            @if($btnText && $btnUrl)
            @if($bi === 1)
            <!-- Primary Highlight Button -->
            <a href="{{ $btnUrl }}" class="group relative inline-flex items-center justify-center gap-3 bg-white text-emerald-900 border-2 border-solid border-emerald-600 font-bold text-[1.05rem] py-4 px-10 rounded-full shadow-[0_8px_20px_rgba(255,255,255,0.25)] transition-all duration-300 hover:bg-emerald-50 hover:shadow-[0_12px_30px_rgba(255,255,255,0.4)] hover:-translate-y-1 w-full sm:w-auto min-w-[240px] overflow-hidden">
                <i class="{{ $btnIcon }} text-[1.15rem] text-emerald-600 transition-transform duration-300 group-hover:-translate-y-px"></i> 
                {{ $btnText }}
            </a>
            @else
            <!-- Secondary Glass Buttons -->
            <a href="{{ $btnUrl }}" class="group inline-flex items-center justify-center gap-3 bg-emerald-800/40 backdrop-blur-md text-white border-2 border-solid border-white font-bold text-[1.05rem] py-4 px-10 rounded-full transition-all duration-300 hover:bg-emerald-700/60 hover:shadow-[0_8px_25px_rgba(5,150,105,0.4)] hover:-translate-y-1 w-full sm:w-auto min-w-[240px]">
                <i class="{{ $btnIcon }} text-[1.15rem] text-emerald-300 group-hover:text-white transition-colors duration-300"></i> 
                {{ $btnText }}
            </a>
            @endif
            @endif
            @endforeach
        </div>
    </div>
</section>
