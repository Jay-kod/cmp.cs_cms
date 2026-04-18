        {{-- ----------- ANNOUNCEMENTS ----------- --}}
        <section data-aos="fade-up" id="announcements" class="mb-16 pt-16 border-t border-slate-200">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-gradient-to-br from-red-600/15 to-red-700/10 text-red-600 rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Announcements</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-red-500 to-red-700 mb-8 rounded"></div>
            
            <div class="announcements-grid grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-4">
                @forelse($announcements as $announcement)
                <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 transition-all duration-200 flex flex-col hover:shadow-md hover:-translate-y-1 border-l-4 @if($announcement->priority == 'high') border-l-red-500 @else border-l-blue-500 @endif">
                    <div class="flex justify-between items-start gap-2 mb-2">
                        <h3 class="m-0 text-[1rem] font-heading text-slate-800 leading-[1.3] font-bold">
                            {{ $announcement->title }}
                        </h3>
                        <span class="text-[0.7rem] py-[0.15rem] px-2 rounded-xl font-semibold whitespace-nowrap @if($announcement->priority == 'high') bg-red-100 text-red-700 @else bg-blue-100 text-blue-700 @endif">
                            {{ ucfirst($announcement->audience) }}
                        </span>
                    </div>
                    <div class="text-slate-500 text-[0.85rem] leading-[1.5] mb-3 flex-grow">
                        {!! nl2br(e($announcement->body)) !!}
                    </div>
                    <div class="text-[0.75rem] text-slate-400 flex items-center gap-[0.4rem] mt-auto">
                        <i class="fa-regular fa-clock"></i> 
                        Posted {{ $announcement->created_at->diffForHumans() }}
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-slate-50 p-10 rounded-xl text-center text-slate-500 border border-dashed border-slate-300">
                    <p class="m-0">No active announcements at the moment.</p>
                </div>
                @endforelse
            </div>
        </section>
