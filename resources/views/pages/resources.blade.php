@extends('layouts.public')
@section('title', 'Student Resources & Downloads')

@section('content')

<!-- 1. Premium Hero Banner -->
<section data-aos="fade-up" class="bg-emerald-800 bg-center bg-cover pt-16 sm:pt-24 pb-20 sm:pb-28 text-white relative overflow-hidden border-b-4 border-accent" style="background-image: url('{{ asset('images/pattern-grid.svg') }}');">
    <!-- Abstract Glow -->
    <div class="absolute inset-0 pointer-events-none"></div>

    <div class="container relative z-10 text-center px-4 sm:px-6" data-aos="fade-up">
        <nav aria-label="breadcrumb" class="flex justify-center mb-6 w-full">
            <ol class="breadcrumb list-none m-0 bg-white/10 backdrop-blur-md py-2 px-4 sm:px-6 rounded-2xl sm:rounded-full text-[0.75rem] sm:text-[0.85rem] font-semibold tracking-[0.5px] border border-white/10 inline-flex flex-wrap justify-center items-center gap-x-2 sm:gap-x-[0.8rem] gap-y-1">
                <li class="m-0 whitespace-nowrap"><a href="{{ url('/') }}" class="text-slate-300 no-underline transition-colors duration-300 hover:text-white"><i class="fa-solid fa-house mr-1"></i> Home</a></li>
                <li class="text-white/30 m-0 shrink-0">/</li>
                <li aria-current="page" class="text-[color:var(--color-accent)] m-0 drop-shadow-[0_2px_10px_rgba(244,196,48,0.4)] text-center break-words">Resources</li>
            </ol>
        </nav>
        
        <h1 class="text-[clamp(2.5rem,8vw,4.5rem)] font-black mb-[1rem] sm:mb-[1.2rem] text-white font-heading tracking-tight drop-shadow-[0_4px_20px_rgba(0,0,0,0.3)] leading-[1.15] sm:leading-[1.1]">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[color:var(--color-accent)] to-yellow-200">Academic</span> Resources
        </h1>
        <p class="text-[1.05rem] sm:text-[1.15rem] md:text-[1.25rem] max-w-[700px] mx-auto text-slate-300 leading-[1.6] sm:leading-[1.8] font-normal px-2">
            A centralized digital repository for students and faculty. Access handbooks, lecture schedules, official guidelines, and essential university portals.
        </p>
    </div>

    <!-- Decorative Bottom Wave -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none pointer-events-none">
        <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C63.26,35,142.27,61.96,213.31,64.44,249.25,65.73,286.34,62.91,321.39,56.44Z" fill="#f8fafc"></path>
        </svg>
    </div>
</section>

<!-- 2. Essential Portals -->
<section class="bg-slate-50 pb-16 pt-8 relative z-10" id="portals-section">
    <div class="w-full max-w-[1240px] mx-auto px-2 sm:px-5 lg:px-8" data-aos="fade-up">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8 max-w-[800px] mx-auto -mt-16 sm:-mt-24">
            
            <!-- Timetable Shortcut -->
            <div>
                <a href="#downloads-view" class="group no-underline block h-full">
                    <div class="h-full bg-white p-4 sm:p-8 rounded-2xl border border-slate-100 text-left transition-all duration-300 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] relative overflow-hidden flex flex-row items-center gap-4 sm:gap-6 group-hover:-translate-y-2 group-hover:shadow-[0_20px_50px_-15px_rgba(22,163,74,0.3)] group-hover:border-green-100 cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                        <div class="w-16 h-16 bg-green-50 text-[color:var(--color-primary)] rounded-xl flex items-center justify-center text-[1.8rem] shrink-0 shadow-inner group-hover:scale-110 transition-transform duration-300 relative z-10">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-xl font-extrabold text-slate-800 mb-1.5 font-heading group-hover:text-[color:var(--color-primary)] transition-colors">Lecture Timetables</h3>
                            <p class="text-slate-500 text-sm m-0 leading-relaxed">Check academic schedules, exam rosters, and department calendars.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Library -->
            <div>
                <a href="{{ url('/') }}" class="group no-underline block h-full">
                    <div class="h-full bg-white p-4 sm:p-8 rounded-2xl border border-slate-100 text-left transition-all duration-300 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] relative overflow-hidden flex flex-row items-center gap-4 sm:gap-6 group-hover:-translate-y-2 group-hover:shadow-[0_20px_50px_-15px_rgba(59,130,246,0.3)] group-hover:border-blue-100 cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-2xl"></div>
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-[1.8rem] shrink-0 shadow-inner group-hover:scale-110 transition-transform duration-300 relative z-10">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-xl font-extrabold text-slate-800 mb-1.5 font-heading group-hover:text-blue-600 transition-colors">Digital Library</h3>
                            <p class="text-slate-500 text-sm m-0 leading-relaxed">Browse research papers, journals, textbooks, and online publications.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. Categorized Downloads (Sidebar + Content Layout) -->
<section id="downloads-view" class="bg-slate-50 pb-32" x-data="{ activeTab: '{{ $categories->first()?->slug ?? '' }}' }">
    <div class="container max-w-[1100px]">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block bg-white text-[color:var(--color-primary)] text-xs font-bold py-1.5 px-4 rounded-full mb-4 shadow-sm border border-green-100 uppercase tracking-wider">Document Archives</span>
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 font-heading mb-4 tracking-tight">Download Center</h2>
            <p class="text-slate-500 text-base max-w-lg mx-auto leading-relaxed">Easily locate and download officially published files categorized for your convenience.</p>
        </div>

        @if($categories->count() > 0)
            <div class="flex flex-col md:flex-row gap-8 md:gap-12 items-start" data-aos="fade-up" data-aos-delay="100">
                
                <!-- Category Sidebar -->
                <div class="w-full md:w-[300px] shrink-0 sticky top-[100px] z-20">
                    <div class="bg-white rounded-2xl p-4 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-slate-100 flex flex-col gap-2">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider px-4 pt-2 pb-1">Categories</h4>
                        
                        @foreach($categories as $category)
                            @php 
                                $catItemCount = ($resourcesByCategory[$category->slug] ?? collect())->count();
                            @endphp
                            <button 
                                @click.prevent="activeTab = '{{ $category->slug }}'"
                                :class="{'bg-[color:var(--color-primary)] text-white shadow-md': activeTab === '{{ $category->slug }}', 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 border border-transparent hover:border-slate-100': activeTab !== '{{ $category->slug }}'}"
                                class="w-full text-left px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 flex items-center justify-between group cursor-pointer border border-transparent">
                                <span class="flex items-center gap-3">
                                    <i class="fa-solid fa-folder-open text-lg opacity-70 group-hover:opacity-100"></i>
                                    {{ $category->name }}
                                </span>
                                <span 
                                    :class="{'bg-white/20 text-white': activeTab === '{{ $category->slug }}', 'bg-slate-100 text-slate-500': activeTab !== '{{ $category->slug }}'}"
                                    class="text-[0.65rem] py-0.5 px-2 rounded-full font-bold transition-colors">
                                    {{ $catItemCount }}
                                </span>
                            </button>
                        @endforeach
                    </div>

                    <!-- Timetable Quick Highlight -->
                    @if($timetableItem)
                    <div class="mt-6 bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 text-[6rem] opacity-5 text-white pointer-events-none">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <span class="inline-block bg-white/20 text-white text-[0.65rem] font-bold py-1 px-3 rounded-full mb-3 uppercase tracking-wider backdrop-blur-sm shadow-sm border border-white/10">LATEST FEATURE</span>
                        <h4 class="text-lg font-bold mb-2 font-heading leading-tight">{{ $timetableItem->title }}</h4>
                        <p class="text-slate-400 text-xs mb-5 line-clamp-2">{{ $timetableItem->description ?? 'Updated lecture timetable.' }}</p>
                        <a href="{{ asset('storage/' . $timetableItem->file_path) }}" target="_blank" class="w-full text-center block bg-[color:var(--color-primary)] hover:bg-[color:var(--color-primary-light)] text-white font-bold py-2.5 rounded-lg text-sm transition-colors shadow-[0_4px_10px_rgba(22,163,74,0.3)] no-underline">
                            Download Now <i class="fa-solid fa-download ml-1 text-xs"></i>
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Content Area -->
                <div class="w-full md:flex-1 relative min-h-[400px]">
                    @foreach($categories as $category)
                        @php 
                            $items = $resourcesByCategory[$category->slug] ?? collect(); 
                        @endphp
                        
                        <div 
                            x-show="activeTab === '{{ $category->slug }}'"
                            x-transition:enter="transition ease-out duration-400"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="w-full"
                            style="display: none;"
                            id="cat-{{ $category->slug }}">
                            
                            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-6 pb-4 border-b border-slate-200 gap-4">
                                <div>
                                    <h3 class="text-2xl font-extrabold text-slate-800 m-0 mb-1 font-heading">{{ $category->name }}</h3>
                                    <p class="m-0 text-slate-500 text-sm">Browse and download files within this collection.</p>
                                </div>
                            </div>
                            
                            @if($items->count() > 0)
                                <div class="grid gap-4">
                                    @foreach($items as $item)
                                        <div class="bg-white border border-slate-100 rounded-2xl p-5 hover:border-slate-200 hover:shadow-[0_8px_30px_rgba(0,0,0,0.06)] transition-all duration-300 group flex flex-col sm:flex-row gap-4 sm:gap-6 justify-between items-start sm:items-center relative z-10 w-full overflow-hidden">
                                            
                                            <!-- File Icon + Info -->
                                            <div class="flex gap-5 items-center w-full sm:w-auto overflow-hidden">
                                                <div class="w-14 h-14 bg-slate-50 rounded-xl flex items-center justify-center text-2xl shrink-0 group-hover:scale-110 transition-transform duration-300">
                                                    @if(Str::endsWith($item->file_path, ['.pdf']))
                                                        <i class="fa-solid fa-file-pdf text-red-500"></i>
                                                    @elseif(Str::endsWith($item->file_path, ['.doc', '.docx']))
                                                        <i class="fa-solid fa-file-word text-blue-500"></i>
                                                    @elseif(Str::endsWith($item->file_path, ['.jpg', '.jpeg', '.png', '.webp']))
                                                        <i class="fa-solid fa-file-image text-emerald-500"></i>
                                                    @elseif(Str::endsWith($item->file_path, ['.xls', '.xlsx', '.csv']))
                                                        <i class="fa-solid fa-file-excel text-green-600"></i>
                                                    @else
                                                        <i class="fa-solid fa-file-lines text-slate-400"></i>
                                                    @endif
                                                </div>
                                                <div class="min-w-0 pr-2">
                                                    <h4 class="text-[1.05rem] font-bold text-slate-800 m-0 mb-1.5 truncate group-hover:text-[color:var(--color-primary)] transition-colors">{{ $item->title }}</h4>
                                                    
                                                    <div class="flex flex-wrap gap-3 items-center text-xs">
                                                        <span class="text-slate-500 font-medium inline-flex items-center gap-1.5 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-100">
                                                            <i class="fa-regular fa-calendar-check text-slate-400"></i> 
                                                            {{ $item->uploaded_at ? \Carbon\Carbon::parse($item->uploaded_at)->format('M d, Y') : $item->created_at->format('M d, Y') }}
                                                        </span>
                                                        <span class="text-slate-600 font-bold uppercase bg-slate-100 py-1 px-2.5 rounded-md tracking-wider">
                                                            {{ strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION)) ?: 'FILE' }}
                                                        </span>
                                                    </div>
                                                    
                                                    @if($item->description)
                                                        <p class="text-sm text-slate-500 mt-2.5 m-0 leading-relaxed max-w-xl line-clamp-2 group-hover:text-slate-600 transition-colors" title="{{ $item->description }}">{{ $item->description }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Download Button -->
                                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="w-full sm:w-auto shrink-0 bg-white text-slate-800 border border-slate-200 py-3 px-5 rounded-xl font-bold text-[0.85rem] no-underline transition-all duration-300 flex items-center justify-center sm:justify-start gap-2 hover:bg-[color:var(--color-primary)] hover:text-white hover:border-[color:var(--color-primary)] shadow-sm hover:shadow-[0_10px_20px_rgba(22,163,74,0.2)]">
                                                Download <i class="fa-solid fa-download text-xs ml-1"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-20 px-8 bg-white rounded-2xl border border-dashed border-slate-200">
                                    <div class="mx-auto mb-4 text-5xl text-slate-200">
                                        <i class="fa-solid fa-folder-open"></i>
                                    </div>
                                    <h4 class="text-slate-800 font-bold mb-2 text-lg">Folder is Empty</h4>
                                    <p class="text-slate-500 m-0 text-sm max-w-sm mx-auto">No academic files have been uploaded to the <strong>{{ $category->name }}</strong> category yet.</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Global Empty State -->
            <div data-aos="fade-up" data-aos-delay="100" class="text-center py-20 px-8 bg-white rounded-3xl border border-dashed border-slate-200 max-w-[700px] mx-auto shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl text-slate-300 shadow-inner">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-slate-800 text-2xl font-black mb-3 font-heading">Repository Uninitialized</h3>
                <p class="text-slate-500 m-0 text-[1.05rem] max-w-md mx-auto leading-relaxed">The administration is currently preparing the digital archives. Check back soon for updated handbooks, forms, and timetables.</p>
            </div>
        @endif
    </div>
</section>

<!-- Alpine JS for Tabs -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

@endsection