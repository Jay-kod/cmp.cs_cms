@extends('layouts.public')
@section('title', 'Student Resources & Downloads')

@section('content')

<!-- 1. Premium Hero Banner -->
<section data-aos="fade-up" class="bg-[url('{{ asset('images/pattern-grid.svg') }}')] bg-center bg-cover pt-24 pb-28 text-white text-center relative overflow-hidden border-b-4 border-[color:var(--color-accent)]" style="background-image: url('{{ asset('images/pattern-grid.svg') }}'), linear-gradient(135deg, #0f172a 0%, #064e3b 100%);">
    <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at center, rgba(16, 185, 129, 0.15) 0%, transparent 60%);"></div>

    <div class="container relative z-1" data-aos="fade-up">
        <nav aria-label="breadcrumb" class="flex justify-center mb-6">
            <ol class="breadcrumb list-none m-0 bg-white/10 backdrop-blur-md py-2 px-6 rounded-full text-[0.85rem] font-semibold tracking-[0.5px] border border-white/10 inline-flex items-center gap-[0.8rem]">
                <li class="m-0"><a href="{{ url('/') }}" class="text-slate-300 no-underline transition-colors duration-300 hover:text-white"><i class="fa-solid fa-house mr-1"></i> Home</a></li>
                <li class="text-white/30 m-0">/</li>
                <li aria-current="page" class="text-[#F4C430] m-0">Resources</li>
            </ol>
        </nav>
        
        <h1 class="text-[3.5rem] font-black mb-[1.2rem] text-white font-heading tracking-[-1px] drop-shadow-[0_4px_20px_rgba(0,0,0,0.3)]">
            <span class="text-[color:var(--color-accent)]">Academic</span> Resources
        </h1>
        <p class="text-[1.15rem] max-w-[680px] mx-auto text-slate-300 leading-[1.7] font-normal">
            A centralized digital repository for students and faculty. Access handbooks, lecture schedules, official guidelines, and essential university portals.
        </p>
    </div>
</section>

<!-- 2. Essential Portals -->
<section data-aos="fade-up" class="bg-transparent p-0 -mt-14 relative z-10 mb-12">
    <div class="container" data-aos="fade-up">
        <div class="grid grid-cols-2 gap-8 max-w-[800px] mx-auto">
            
            <!-- Timetable Shortcut -->
            <div>
                <a href="#downloads-section" class="no-underline text-inherit block h-full">
                    <div data-aos="fade-up" class="card portal-card h-full bg-white p-8 rounded-2xl border border-black/5 text-left transition-all duration-400 ease-in-out shadow-[0_10px_30px_rgba(0,0,0,0.08)] relative overflow-hidden z-1 flex flex-row items-center gap-[1.2rem]">
                        <div class="portal-hover-bg absolute inset-0 bg-gradient-to-br from-green-50 to-white opacity-0 transition-opacity duration-400 ease-in-out -z-1"></div>
                        <div class="w-16 h-16 bg-green-50 text-[color:var(--color-primary)] rounded-2xl flex items-center justify-center text-[1.8rem] shrink-0 shadow-[0_8px_20px_rgba(22,163,74,0.2)] transition-transform duration-400 ease-in-out">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <div>
                            <h3 class="text-[1.25rem] font-extrabold text-slate-900 mb-1.5 font-heading">Lecture Timetables</h3>
                            <p class="text-slate-500 text-[0.85rem] m-0 leading-[1.5]">Check academic schedules, exam rosters, and department calendars.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Library -->
            <div>
                <a href="#" class="no-underline text-inherit block h-full">
                    <div data-aos="fade-up" class="card portal-card h-full bg-white p-8 rounded-2xl border border-black/5 text-left transition-all duration-400 ease-in-out shadow-[0_10px_30px_rgba(0,0,0,0.08)] relative overflow-hidden z-1 flex flex-row items-center gap-[1.2rem]">
                        <div class="portal-hover-bg absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 transition-opacity duration-400 ease-in-out -z-1"></div>
                        <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center text-[1.8rem] shrink-0 shadow-[0_8px_20px_rgba(59,130,246,0.2)] transition-transform duration-400 ease-in-out">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div>
                            <h3 class="text-[1.25rem] font-extrabold text-slate-900 mb-1.5 font-heading">Digital Library</h3>
                            <p class="text-slate-500 text-[0.85rem] m-0 leading-[1.5]">Browse research papers, journals, textbooks, and online publications.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. Categorized Downloads -->
<section data-aos="fade-up" id="downloads-section" class="bg-white pt-16 pb-32">
    <div class="container max-w-[1000px]" data-aos="fade-up">
        <div class="text-center mb-16">
            <span class="inline-block bg-green-50 text-[color:var(--color-primary)] text-[0.75rem] font-bold py-[0.4rem] px-[1.2rem] rounded-full mb-4 uppercase tracking-[1px]">Document Archives</span>
            <h2 class="text-[2.2rem] font-black text-slate-800 font-heading mb-3 tracking-[-0.5px]">Download Center</h2>
            <p class="text-slate-500 text-base max-w-[500px] mx-auto leading-[1.6]">Easily locate and download officially published files categorized for your convenience.</p>
        </div>

        @if($categories->count() > 0)
            <div class="flex flex-col gap-12">
                @foreach($categories as $category)
                    @php 
                        $items = $resourcesByCategory[$category->slug] ?? collect(); 
                    @endphp
                    
                    <div>
                        <div class="flex items-end justify-between mb-4">
                            <div>
                                <h3 class="text-[1.35rem] font-extrabold text-slate-900 m-0 mb-1 font-heading">{{ $category->name }}</h3>
                                <p class="m-0 text-slate-500 text-[0.85rem]">Browse and download files within this collection.</p>
                            </div>
                            <div class="py-[0.3rem] px-[0.8rem] rounded-full border border-slate-200 text-slate-600 font-semibold text-[0.7rem] bg-white">
                                Total: <span class="text-[color:var(--color-primary)]">{{ $items->count() }}</span> items
                            </div>
                        </div>
                        
                        @if($items->count() > 0)
                            <div class="grid gap-[0.8rem]">
                                @foreach($items as $item)
                                    <div class="advanced-doc-row bg-white border border-slate-200 rounded-xl p-[1.2rem] transition-all duration-300 flex justify-between items-center group hover:shadow-md hover:border-slate-300">
                                        <div class="flex gap-[1.2rem] items-center">
                                            <div class="w-[50px] h-[50px] bg-slate-50 rounded-[10px] flex items-center justify-center text-[1.5rem] shrink-0 border border-slate-100 group-hover:bg-slate-100 transition-colors">
                                                @if(Str::endsWith($item->file_path, ['.pdf']))
                                                    <i class="fa-solid fa-file-pdf text-red-500"></i>
                                                @elseif(Str::endsWith($item->file_path, ['.doc', '.docx']))
                                                    <i class="fa-solid fa-file-word text-blue-500"></i>
                                                @elseif(Str::endsWith($item->file_path, ['.jpg', '.jpeg', '.png', '.webp']))
                                                    <i class="fa-solid fa-file-image text-emerald-500"></i>
                                                @elseif(Str::endsWith($item->file_path, ['.xls', '.xlsx', '.csv']))
                                                    <i class="fa-solid fa-file-excel text-green-600"></i>
                                                @else
                                                    <i class="fa-solid fa-file-lines text-slate-500"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="text-base font-bold text-slate-800 m-0 mb-1 tracking-[-0.2px] transition-colors group-hover:text-[color:var(--color-primary)]">{{ $item->title }}</h4>
                                                
                                                <div class="flex flex-wrap gap-[0.8rem] items-center">
                                                    <span class="text-[0.75rem] text-slate-500 font-medium inline-flex items-center gap-[0.3rem]">
                                                        <i class="fa-regular fa-calendar-check text-slate-400"></i> 
                                                        {{ $item->uploaded_at ? \Carbon\Carbon::parse($item->uploaded_at)->format('M d, Y') : $item->created_at->format('M d, Y') }}
                                                    </span>
                                                    <span class="w-[3px] h-[3px] rounded-full bg-slate-300"></span>
                                                    <span class="text-[0.65rem] text-slate-600 font-bold uppercase bg-slate-100 py-[0.15rem] px-2 rounded">
                                                        {{ strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION)) }}
                                                    </span>
                                                </div>
                                                
                                                @if($item->description)
                                                    <p class="text-[0.85rem] text-slate-500 mt-2 m-0 leading-[1.5] max-w-[500px]">{{ Str::limit($item->description, 100) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn premium-btn shrink-0 bg-white text-slate-800 border border-slate-200 py-[0.6rem] px-[1.2rem] rounded-lg font-bold text-[0.8rem] no-underline transition-all duration-300 inline-flex items-center gap-[0.4rem] ml-4 hover:bg-[color:var(--color-primary)] hover:text-white hover:border-[color:var(--color-primary)] hover:shadow-lg hover:-translate-y-0.5">
                                            Download <i class="fa-solid fa-arrow-down text-[0.75rem]"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 px-8 bg-neutral-50 rounded-xl border border-dashed border-slate-300">
                                <div class="mx-auto mb-[0.8rem] text-[2.2rem] text-slate-300">
                                    <i class="fa-solid fa-folder"></i>
                                </div>
                                <h4 class="text-slate-900 font-extrabold mb-1 text-[1.1rem]">Folder is Empty</h4>
                                <p class="text-slate-500 m-0 text-[0.85rem]">No academic files have been uploaded to this category yet.</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 px-8 bg-slate-50 rounded-3xl border border-dashed border-slate-300 max-w-[800px] mx-auto">
                <div class="w-[100px] h-[100px] bg-white rounded-full flex items-center justify-center mx-auto mb-6 text-[3rem] text-slate-300 shadow-[0_10px_30px_rgba(0,0,0,0.04)]">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-slate-900 text-[1.8rem] font-black mb-3">Repository Uninitialized</h3>
                <p class="text-slate-500 m-0 text-[1.15rem]">The administration is currently preparing the digital archives. Check back soon for updated handbooks, forms, and timetables.</p>
            </div>
        @endif
    </div>
</section>

<style>
    /* Portal Cards */
    .portal-card {
        transform: translateY(0);
    }
    .portal-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
    .portal-card:hover .portal-hover-bg {
        opacity: 1 !important;
    }
    .portal-card:hover > div:not(.portal-hover-bg) {
        transform: scale(1.1);
    }
    
    /* Premium Sidebar */
    .custom-docs-sidebar .nav-link {
        background: transparent !important;
    }
    .custom-docs-sidebar .nav-link:hover {
        background: rgba(255,255,255,0.8) !important;
        transform: translateX(4px);
    }
    .custom-docs-sidebar .nav-link.active {
        background: white !important;
        color: var(--color-primary) !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04) !important;
        border-color: white !important;
    }
    .custom-docs-sidebar .nav-link.active .icon-wrapper {
        background: var(--color-primary) !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(22, 163, 74, 0.3) !important;
    }
    .custom-docs-sidebar .nav-link.active .file-count {
        background: #f0fdf4 !important;
        color: var(--color-primary) !important;
        border-color: #bbf7d0 !important;
    }
    
    /* Document Rows */
    .advanced-doc-row {
        cursor: default;
    }
    .advanced-doc-row:hover {
        border-color: #cbd5e1 !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        transform: translateY(-2px);
    }
    
    /* Download Button */
    .premium-btn:hover {
        background: var(--color-primary) !important;
        color: white !important;
        border-color: var(--color-primary) !important;
        box-shadow: 0 8px 20px rgba(22, 163, 74, 0.25) !important;
    }
</style>

@endsection