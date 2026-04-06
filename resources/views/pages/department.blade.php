@extends('layouts.public')

@section('title', $subDept->name)

@section('content')

<!-- Hero Section -->
<section class="bg-[#111827] text-white py-20 lg:py-32 relative">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[#485b93] opacity-90"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl relative z-10 text-center">
        <span class="inline-block px-5 py-2 rounded-full bg-white/10 text-white font-bold text-sm mb-5 tracking-widest uppercase border border-white/20 backdrop-blur-sm">{{ strtoupper($subDept->prefix) }} Department Unit</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-[#45c363] tracking-tight mb-6">{{ $subDept->name }}</h1>
    </div>
</section>

<!-- About the Department -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl text-center">
        <h2 class="text-3xl font-extrabold text-[#485b93] mb-6 relative inline-block">
            About the Department
            <span class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 w-16 h-1.5 bg-[#45c363] rounded-full"></span>
        </h2>
        <div class="text-[17px] text-gray-600 leading-loose mt-8 font-medium">
            {{ $subDept->description ?? 'A center for academic excellence and pioneering research in ' . $subDept->name . '.' }}
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="py-20 bg-gray-50 border-y border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            <!-- Vision -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-[#45c363]/50 transition-colors group">
                <div class="w-16 h-16 bg-[#45c363]/10 rounded-2xl flex items-center justify-center text-[#45c363] text-3xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-eye"></i>
                </div>
                <h3 class="text-2xl font-black text-[#485b93] mb-4">Our Vision</h3>
                <p class="text-gray-600 leading-relaxed text-[15px]">{{ $subDept->vision ?? 'To be a globally recognized center of excellence in '. $subDept->name . ', producing graduates capable of solving global challenges.' }}</p>
            </div>
            
            <!-- Mission -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-[#485b93]/50 transition-colors group">
                <div class="w-16 h-16 bg-[#485b93]/10 rounded-2xl flex items-center justify-center text-[#485b93] text-3xl mb-6 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <h3 class="text-2xl font-black text-[#485b93] mb-4">Our Mission</h3>
                <p class="text-gray-600 leading-relaxed text-[15px]">{{ $subDept->mission ?? 'To provide high-quality education and foster innovative research in '. $subDept->name . ', while nurturing highly skilled and ethical professionals.' }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Programmes & Requirements -->
<section class="py-24 bg-white relative">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-[#485b93]">Academic Programmes & Requirements</h2>
            <div class="w-16 h-1.5 bg-[#45c363] mx-auto mt-5 rounded-full"></div>
        </div>

        <div class="space-y-10">
            @forelse($programmes ?? [] as $programme)
            <div class="bg-white rounded-[2rem] border border-gray-200 shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300">
                <!-- Header -->
                <div class="bg-gray-50/80 px-8 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h3 class="text-2xl font-black text-[#485b93] flex items-center gap-3">
                        <i class="fa-solid fa-graduation-cap text-[#45c363]"></i>
                        {{ $programme->level }} Programme
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-white px-4 py-1.5 rounded-lg text-sm font-bold text-gray-600 border border-gray-200 shadow-sm flex items-center gap-2"><i class="fa-regular fa-clock text-gray-400"></i> {{ $programme->duration ?? 'N/A' }}</span>
                        <span class="bg-[#485b93]/10 text-[#485b93] px-4 py-1.5 rounded-lg text-sm font-bold shadow-sm flex items-center gap-2"><i class="fa-solid fa-layer-group text-[#485b93]/50"></i> {{ $programme->mode_of_study ?? 'Full Time' }}</span>
                    </div>
                </div>
                
                <div class="p-8 sm:p-10">
                    <!-- Overview -->
                    <div class="mb-10">
                        <h4 class="text-[13px] font-black tracking-widest text-gray-400 uppercase mb-4 border-b border-gray-100 pb-2">Programme Overview</h4>
                        <p class="text-gray-700 leading-loose text-[15px]">{{ $programme->description ?? 'Comprehensive core curriculum structure.' }}</p>
                    </div>

                    <!-- Admission Requirements Grid -->
                    <div>
                        <h4 class="text-[13px] font-black tracking-widest text-[#45c363] uppercase mb-5 border-b border-gray-100 pb-2">Admission Requirements</h4>
                        <div class="grid md:grid-cols-2 gap-6 mt-4">
                            <!-- UTME -->
                            <div class="bg-[#485b93]/5 p-6 rounded-2xl border border-[#485b93]/10 relative group hover:bg-[#485b93]/10 transition-colors">
                                <div class="absolute top-6 right-6 text-[#485b93]/20 text-3xl group-hover:text-[#485b93]/30 transition-colors">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                                <h5 class="font-extrabold text-[#485b93] mb-3 flex items-center"><i class="fa-solid fa-circle-check text-[#45c363] mr-2 text-lg"></i> UTME Requirements</h5>
                                <p class="text-gray-600 text-sm leading-loose relative z-10">{{ $programme->requirements_utme ?? 'Specific UTME entry guidelines are outlined in the central admission portal.' }}</p>
                            </div>
                            
                            <!-- Direct Entry -->
                            <div class="bg-[#45c363]/5 p-6 rounded-2xl border border-[#45c363]/20 relative group hover:bg-[#45c363]/10 transition-colors">
                                <div class="absolute top-6 right-6 text-[#45c363]/20 text-3xl group-hover:text-[#45c363]/30 transition-colors">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <h5 class="font-extrabold text-[#485b93] mb-3 flex items-center"><i class="fa-solid fa-circle-check text-[#45c363] mr-2 text-lg"></i> Direct Entry Requirements</h5>
                                <p class="text-gray-600 text-sm leading-loose relative z-10">{{ $programme->requirements_de ?? 'Specific DE guidelines are outlined in the central admission portal.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-[2rem] border border-gray-200 shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300">
                <!-- Header -->
                <div class="bg-gray-50/80 px-8 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h3 class="text-2xl font-black text-[#485b93] flex items-center gap-3">
                        <i class="fa-solid fa-graduation-cap text-[#45c363]"></i>
                        B.Sc. Programme (Sample Template)
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-white px-4 py-1.5 rounded-lg text-sm font-bold text-gray-600 border border-gray-200 shadow-sm flex items-center gap-2"><i class="fa-regular fa-clock text-gray-400"></i> 4 Years</span>
                        <span class="bg-[#485b93]/10 text-[#485b93] px-4 py-1.5 rounded-lg text-sm font-bold shadow-sm flex items-center gap-2"><i class="fa-solid fa-layer-group text-[#485b93]/50"></i> Full Time</span>
                    </div>
                </div>
                
                <div class="p-8 sm:p-10">
                    <div class="mb-10 block p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-700 text-sm font-bold mb-6">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i> Note: No actual programmes are attached to this department in the database yet. This is a layout preview.
                    </div>
                    <!-- Overview -->
                    <div class="mb-10">
                        <h4 class="text-[13px] font-black tracking-widest text-gray-400 uppercase mb-4 border-b border-gray-100 pb-2">Programme Overview</h4>
                        <p class="text-gray-700 leading-loose text-[15px]">Comprehensive core curriculum structure. Details to be updated via admin dashboard.</p>
                    </div>

                    <!-- Admission Requirements Grid -->
                    <div>
                        <h4 class="text-[13px] font-black tracking-widest text-[#45c363] uppercase mb-5 border-b border-gray-100 pb-2">Admission Requirements</h4>
                        <div class="grid md:grid-cols-2 gap-6 mt-4">
                            <!-- UTME -->
                            <div class="bg-[#485b93]/5 p-6 rounded-2xl border border-[#485b93]/10 relative group hover:bg-[#485b93]/10 transition-colors">
                                <div class="absolute top-6 right-6 text-[#485b93]/20 text-3xl group-hover:text-[#485b93]/30 transition-colors">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                                <h5 class="font-extrabold text-[#485b93] mb-3 flex items-center"><i class="fa-solid fa-circle-check text-[#45c363] mr-2 text-lg"></i> UTME Requirements</h5>
                                <p class="text-gray-600 text-sm leading-loose relative z-10">Specific UTME entry guidelines are outlined in the central admission portal.</p>
                            </div>
                            
                            <!-- Direct Entry -->
                            <div class="bg-[#45c363]/5 p-6 rounded-2xl border border-[#45c363]/20 relative group hover:bg-[#45c363]/10 transition-colors">
                                <div class="absolute top-6 right-6 text-[#45c363]/20 text-3xl group-hover:text-[#45c363]/30 transition-colors">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <h5 class="font-extrabold text-[#485b93] mb-3 flex items-center"><i class="fa-solid fa-circle-check text-[#45c363] mr-2 text-lg"></i> Direct Entry Requirements</h5>
                                <p class="text-gray-600 text-sm leading-loose relative z-10">Specific DE guidelines are outlined in the central admission portal.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Research & Publications -->
<section class="py-24 bg-gray-50 border-t border-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-[#485b93]">Research & Publications</h2>
            <div class="w-16 h-1.5 bg-[#45c363] mx-auto mt-5 rounded-full"></div>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Explore the latest research papers, journals, and academic contributions from our department.</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($publications ?? [] as $pub)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-[#45c363]/50 transition-colors group">
                <div class="text-[12px] font-bold text-[#45c363] mb-2 uppercase tracking-wider">{{ $pub->year ?? 'Recent' }}</div>
                <h3 class="text-lg font-bold text-[#485b93] mb-3 group-hover:text-[#45c363] transition-colors">{{ $pub->title }}</h3>
                <p class="text-sm text-gray-600 mb-4 line-clamp-3">{{ $pub->abstract ?? 'Read the full publication to learn more about this research methodology and findings.' }}</p>
                <div class="text-xs font-bold text-gray-500 bg-gray-50 px-3 py-2 rounded-lg inline-block">
                    <i class="fa-solid fa-book-open mr-1 text-gray-400"></i> {{ $pub->journal ?? 'Academic Journal' }}
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-dashed border-gray-200">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400 text-2xl mb-4">
                    <i class="fa-solid fa-flask"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-1">No Publications Yet</h3>
                <p class="text-gray-500">Research publications and academic papers will be updated shortly.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- News & Updates -->
<section class="py-24 bg-white border-t border-gray-100 relative">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-[#485b93]">Department News & Updates</h2>
            <div class="w-16 h-1.5 bg-[#45c363] mx-auto mt-5 rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($news ?? [] as $item)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col">
                <div class="h-56 bg-gray-100 relative overflow-hidden">
                    @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300 group-hover:scale-105 transition-transform duration-500">
                        <i class="fa-regular fa-image text-4xl"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-[12px] font-bold text-[#45c363] mb-3 uppercase tracking-wider"><i class="fa-regular fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->published_at ?? $item->created_at)->format('M d, Y') }}</div>
                    <h3 class="text-xl font-black text-[#485b93] mb-3 line-clamp-2 hover:text-[#45c363] transition-colors"><a href="#">{{ $item->title }}</a></h3>
                    <p class="text-sm text-gray-600 mb-6 line-clamp-3 leading-relaxed">{{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}</p>
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="#" class="text-sm font-bold text-[#45c363] hover:text-[#485b93] transition-colors flex items-center">
                            Read Full Story <i class="fa-solid fa-arrow-right-long ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto text-gray-400 text-2xl mb-4 border border-gray-100 shadow-sm">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-1">No News Available</h3>
                <p class="text-gray-500">Latest announcements and events will appear here.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

