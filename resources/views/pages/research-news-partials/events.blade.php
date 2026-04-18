        {{-- ═══════════ EVENTS CALENDAR ═══════════ --}}
        <section data-aos="fade-up" id="events" class="mb-16">
            <div class="blog-section-heading flex items-center gap-4 mb-6">
                <div class="blog-section-icon w-12 h-12 bg-gradient-to-br from-red-500/15 to-red-600/10 text-red-500 rounded-[14px] flex items-center justify-center text-[1.3rem]">
                    <i class="fa-regular fa-calendar-check"></i>
                </div>
                <h2 class="m-0 text-2xl text-slate-900 font-heading font-bold">Upcoming Events</h2>
            </div>
            <div class="w-[60px] h-1 bg-gradient-to-r from-red-500 to-red-600 mb-8 rounded"></div>
            
            <div class="blog-events-list flex flex-col gap-[1.2rem]">
                @forelse($events as $event)
                <div data-aos="fade-up" class="blog-event-card flex bg-white border border-slate-200 rounded-[16px] overflow-hidden transition-all duration-300 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.03)] items-stretch flex-wrap hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.1)] hover:border-slate-300">
                    
                    <!-- Date Box -->
                    <div class="blog-event-date bg-gradient-to-br from-[color:var(--color-primary)] to-emerald-700 text-white p-[1.5rem_2rem] text-center flex flex-col justify-center items-center min-w-[140px] relative overflow-hidden">
                        <div class="absolute -top-[10px] -right-[15px] opacity-10 text-[5.5rem]">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <span class="text-[1.15rem] uppercase font-bold tracking-[1.5px] text-white/90 z-10">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                        <span class="text-[3.2rem] font-extrabold leading-none my-[0.3rem] font-heading z-10">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                        <span class="text-[1.05rem] text-white/80 font-semibold z-10">{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</span>
                    </div>

                    <!-- Details Box -->
                    <div class="blog-event-details p-[1.8rem_2rem] flex-1 min-w-[250px] flex flex-col justify-center">
                        <h3 class="m-0 mb-[0.6rem] text-[1.35rem] text-slate-900 font-heading font-extrabold leading-[1.35]">{{ $event->title }}</h3>
                        <p class="text-slate-500 text-[0.95rem] leading-[1.6] m-0 mb-[1.2rem]">{{ $event->description }}</p>
                        
                        <div class="flex flex-wrap gap-4 items-center">
                            <div class="inline-flex items-center gap-[0.6rem] bg-slate-50 border border-slate-200 p-[0.4rem_1rem_0.4rem_0.4rem] rounded-full">
                                <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center shadow-[0_2px_4px_rgba(0,0,0,0.04)]">
                                    <i class="fa-solid fa-clock text-emerald-500 text-[0.85rem]"></i>
                                </div>
                                <span class="text-[0.9rem] font-semibold text-slate-700">{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                            </div>
                            @if($event->venue)
                            <div class="inline-flex items-center gap-[0.6rem] bg-slate-50 border border-slate-200 p-[0.4rem_1rem_0.4rem_0.4rem] rounded-full">
                                <div class="w-7 h-7 bg-white rounded-full flex items-center justify-center shadow-[0_2px_4px_rgba(0,0,0,0.04)]">
                                    <i class="fa-solid fa-location-dot text-red-500 text-[0.85rem]"></i>
                                </div>
                                <span class="text-[0.9rem] font-semibold text-slate-700">{{ $event->venue }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-slate-50 p-10 rounded-xl text-center text-slate-500 border border-dashed border-slate-300">
                    <div class="w-12 h-12 bg-slate-200 text-slate-400 rounded-full flex items-center justify-center text-[1.2rem] mx-auto mb-4">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    <p class="m-0">No upcoming events scheduled.</p>
                </div>
                @endforelse
            </div>
        </section>
