<!-- CLEAN & PROFESSIONAL NEWS & EVENTS COMPONENT -->
<section class="py-24 bg-slate-50" id="news-section">
    <div class="container relative z-[2]" data-aos="fade-up">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm mb-2 block">{{ $gs('home_news_badge','STAY INFORMED') }}</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900">{{ $gs('home_news_title','News & Events') }}</h2>
            <div class="w-16 h-1 bg-emerald-600 mx-auto mt-6 rounded-full"></div>
        </div>

        <div class="flex flex-col gap-16 lg:gap-20">
            <!-- News Section -->
            <div class="w-full">
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200">
                    <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                        <i class="fa-regular fa-newspaper text-emerald-600"></i>
                        Latest News
                    </h3>
                    <a href="{{ url('/research-news') }}" class="group text-sm font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-2 transition-all">
                        View All News 
                        <i class="fa-solid fa-arrow-right-long transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if($news && count($news) > 0)
                        @foreach($news as $item)
                        <a href="{{ route('research-news.show', $item->slug) }}" class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                            <!-- Image -->
                            <div class="relative h-56 w-full bg-slate-100 overflow-hidden">
                                @if($item->featured_image)
                                <img src="{{ asset('storage/'.$item->featured_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                    <i class="fa-regular fa-image text-5xl"></i>
                                </div>
                                @endif
                                @if($item->category)
                                <div class="absolute top-4 left-4 bg-emerald-600 text-white text-[0.7rem] font-bold px-3 py-1 rounded shadow-sm uppercase tracking-wider backdrop-blur-md">
                                    {{ $item->category }}
                                </div>
                                @endif
                            </div>
                            <!-- Content -->
                            <div class="p-8 flex flex-col flex-grow">
                                <div class="flex items-center gap-2 text-xs text-slate-500 mb-3 font-medium">
                                    <i class="fa-regular fa-calendar text-emerald-600"></i>
                                    <span>{{ \Carbon\Carbon::parse($item->published_at)->format('F j, Y') }}</span>
                                </div>
                                <h4 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors leading-snug">{{ $item->title }}</h4>
                                <p class="text-slate-600 text-[0.95rem] line-clamp-3 mb-6">{{ Str::limit(strip_tags($item->body), 120) }}</p>
                                <div class="mt-auto pt-5 border-t border-slate-100">
                                    <span class="text-emerald-600 text-sm font-bold group-hover:text-emerald-700 flex items-center gap-2">
                                        Read Article <i class="fa-solid fa-angle-right"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    @else
                        <div class="col-span-full py-16 text-center text-slate-500 bg-white rounded-xl border border-dashed border-slate-300">
                            <i class="fa-regular fa-newspaper text-4xl mb-4 text-slate-300 block"></i>
                            <p class="text-lg">No recent news available.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Events Section -->
            <div class="w-full mt-12 mb-4">
                <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-200">
                    <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                        <i class="fa-regular fa-calendar-days text-emerald-600"></i>
                        Upcoming Events
                    </h3>
                    <a href="{{ url('/events') }}" class="group text-sm font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-2 transition-all">
                        Full Calendar 
                        <i class="fa-solid fa-arrow-right-long transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if($events && count($events) > 0)
                        @foreach($events as $event)
                        <a href="{{ url('/events') }}" class="group bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col h-full relative">
                            
                            <!-- Date Ribbon -->
                            <div class="absolute top-4 left-4 z-10 bg-emerald-600 text-white rounded-lg shadow-lg overflow-hidden flex flex-col w-14 text-center transform group-hover:scale-110 transition-transform">
                                <span class="bg-emerald-700 text-[0.65rem] font-bold uppercase py-1 tracking-wider">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</span>
                                <span class="text-xl font-black py-1.5 leading-none">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</span>
                            </div>

                            <!-- Image Area -->
                            <div class="relative h-48 w-full bg-slate-100 overflow-hidden">
                                @if($event->flyer_image)
                                    <img src="{{ asset('storage/'.$event->flyer_image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-300 bg-slate-50 relative overflow-hidden">
                                        <i class="fa-solid fa-microphone-lines text-6xl opacity-20"></i>
                                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-100/40 to-transparent mix-blend-multiply"></div>
                                    </div>
                                @endif
                                
                                @if($event->end_date)
                                <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur text-emerald-800 text-[0.7rem] font-bold px-2.5 py-1 rounded shadow-sm border border-emerald-100 uppercase tracking-widest flex items-center gap-1.5">
                                    <i class="fa-solid fa-clock text-emerald-600"></i> Multiple Days
                                </div>
                                @endif
                            </div>

                            <!-- Content Area -->
                            <div class="p-7 flex flex-col flex-grow">
                                <h4 class="text-lg font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-emerald-600 transition-colors leading-snug">{{ $event->title }}</h4>
                                
                                @if($event->description)
                                    <p class="text-slate-600 text-[0.9rem] line-clamp-2 mb-5">{{ Str::limit(strip_tags($event->description), 90) }}</p>
                                @endif

                                <div class="mt-auto space-y-3">
                                    <div class="flex items-center gap-3 text-[0.85rem] text-slate-600 bg-slate-50 rounded-lg p-2.5">
                                        <div class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-emerald-600 shadow-sm shrink-0">
                                            <i class="fa-regular fa-clock"></i>
                                        </div>
                                        <span class="font-medium truncate">{{ \Carbon\Carbon::parse($event->date)->format('h:i A') }}</span>
                                    </div>
                                    
                                    @if($event->venue)
                                    <div class="flex items-center gap-3 text-[0.85rem] text-slate-600 bg-slate-50 rounded-lg p-2.5">
                                        <div class="w-7 h-7 rounded-full bg-white flex items-center justify-center text-emerald-600 shadow-sm shrink-0">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <span class="font-medium truncate">{{ $event->venue }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    @else
                        <div class="col-span-full py-16 text-center text-slate-500 bg-white rounded-xl border border-dashed border-slate-300">
                            <i class="fa-regular fa-calendar-xmark text-4xl mb-4 text-slate-300 block"></i>
                            <p class="text-lg">No upcoming events scheduled.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
