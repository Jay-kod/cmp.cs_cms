        {{-- ----------- ANNOUNCEMENTS ----------- --}}
        <section data-aos="fade-up" id="announcements" class="mb-16 pt-16 border-t border-slate-200">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center text-[1.3rem] shadow-sm border border-red-100">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Announcements</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-red-500 to-red-600 mb-8 rounded"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($announcements as $announcement)
                <div class="bg-white border border-slate-100 rounded-2xl p-6 md:p-8 transition-all duration-300 flex flex-col shadow-[0_4px_20px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1.5 h-full transition-colors duration-300 @if($announcement->priority == 'high') bg-red-500 group-hover:bg-red-600 @else bg-blue-500 group-hover:bg-blue-600 @endif"></div>
                    
                    <div class="flex justify-between items-start gap-4 mb-4">
                        <h3 class="m-0 text-lg font-bold text-slate-800 leading-tight">
                            {{ $announcement->title }}
                        </h3>
                        <span class="text-[0.65rem] py-1 px-3 rounded-full font-bold uppercase tracking-widest whitespace-nowrap @if($announcement->priority == 'high') bg-red-50 text-red-600 border border-red-100 @else bg-blue-50 text-blue-600 border border-blue-100 @endif">
                            {{ ucfirst($announcement->audience) }}
                        </span>
                    </div>
                    
                    <div class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow text-justify">
                        {!! nl2br(e($announcement->body)) !!}
                    </div>
                    
                    <div class="text-xs text-slate-400 flex items-center gap-2 mt-auto font-bold uppercase tracking-wide">
                        <i class="fa-regular fa-clock text-slate-300"></i> 
                        Posted {{ $announcement->created_at->diffForHumans() }}
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-3xl shadow-sm border border-slate-100 p-12 text-center mt-4">
                    <div class="w-20 h-20 mx-auto bg-slate-50 text-slate-400 rounded-full flex items-center justify-center text-3xl mb-4">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">No Announcements</h3>
                    <p class="text-slate-500">There are no active announcements right now.</p>
                </div>
                @endforelse
            </div>
        </section>
