<div class="timetable-section my-12">
    <div class="container" data-aos="fade-up">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-[1.5rem] text-slate-900 font-heading font-extrabold m-0">Departmental Timetables</h2>
            <a href="{{ url('/resources') }}" class="btn btn-primary bg-[color:var(--color-primary)] text-white py-[0.6rem] px-[1.2rem] rounded-lg no-underline font-semibold flex items-center justify-center w-full sm:w-auto gap-1.5 transition-all duration-200 hover:-translate-y-[2px]">
                <i class="fa-solid fa-folder-open"></i> View All Resources
            </a>
        </div>
        
        <div class="bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-0 border border-slate-100 overflow-hidden">
            @if((isset($timetables) && $timetables->count() > 0) || !empty($uploadedTimetable))
                
                @if(!empty($uploadedTimetable))
                <div class="tt-responsive-grid p-6 lg:p-10 border-b border-slate-300 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 bg-slate-200 items-start">
                    <div>
                        <div class="flex items-start gap-5 mb-6">
                            <div class="tt-icon w-14 h-14 bg-gradient-to-br from-green-600/10 to-green-600/5 text-[color:var(--color-primary)] rounded-[14px] flex items-center justify-center text-[1.6rem] shrink-0 border border-green-600/20">
                                @if(Str::endsWith($uploadedTimetable, ['.pdf']))
                                    <i class="fa-solid fa-file-pdf"></i>
                                @elseif(Str::endsWith($uploadedTimetable, ['.jpg', '.jpeg', '.png', '.webp', '.gif']))
                                    <i class="fa-solid fa-file-image"></i>
                                @else
                                    <i class="fa-solid fa-table-list"></i>
                                @endif
                            </div>
                            <div>
                                <span class="inline-block bg-red-100 text-red-700 text-[0.65rem] font-extrabold py-1 px-2.5 rounded mb-1.5 tracking-[0.5px]">LATEST</span>
                                <h4 class="m-0 mb-2 text-[1.3rem] text-slate-800 font-extrabold leading-[1.3]">Official Department Timetable</h4>
                                <p class="m-0 text-[0.85rem] text-slate-500 flex items-center gap-1.5">
                                    <i class="fa-solid fa-circle-check text-green-500"></i> Currently Active Schedule
                                </p>
                            </div>
                        </div>

                        <p class="text-[1rem] text-slate-600 m-0 mb-8 leading-[1.6]">
                            This is the most recent officially uploaded timetable for the department operations. You can view the live preview beside or download a copy of the file directly to your device.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 flex-wrap mt-2">
                            <a href="{{ asset('storage/' . $uploadedTimetable) }}" target="_blank" class="btn btn-primary w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-[color:var(--color-primary)] text-white no-underline py-[0.8rem] px-6 rounded-lg font-bold text-[0.95rem] border-none transition-all duration-300 shadow-[0_4px_10px_rgba(22,163,74,0.2)] hover:shadow-[0_6px_15px_rgba(22,163,74,0.3)] hover:-translate-y-[2px]">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Download File
                            </a>
                            <a href="{{ url('/resources') }}" class="btn btn-secondary w-full sm:w-auto bg-white text-slate-600 py-[0.8rem] px-6 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center justify-center gap-2 transition-all duration-200 hover:bg-slate-100 hover:text-slate-800">
                                View More Resources <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bg-white rounded-xl p-4 border border-dashed border-slate-300 flex items-center justify-center min-h-[250px] bg-clip-padding shadow-[0_4px_12px_rgba(0,0,0,0.03)]">
                            @if(Str::endsWith($uploadedTimetable, ['.jpg', '.jpeg', '.png', '.webp', '.gif']))
                                <a href="{{ asset('storage/' . $uploadedTimetable) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $uploadedTimetable) }}" alt="Timetable Preview" class="max-w-full max-h-[400px] rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.05)] object-contain cursor-pointer transition-transform duration-300 hover:scale-[1.02]">
                                </a>
                            @elseif(Str::endsWith($uploadedTimetable, ['.pdf']))
                                <iframe src="{{ asset('storage/' . $uploadedTimetable) }}#toolbar=0" class="w-full h-[400px] border-none rounded-lg shadow-[0_4px_15px_rgba(0,0,0,0.05)]"></iframe>
                            @else
                                <div class="text-center text-slate-500 py-8">
                                    <i class="fa-solid fa-file-csv text-[3rem] mb-4 text-slate-400"></i>
                                    <p class="m-0 font-semibold text-[1.1rem]">Preview not available for this format.</p>
                                    <small>Please download to view the spreadsheet file.</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if(isset($timetables) && $timetables->count() > 0)
                <div class="grid grid-cols-[repeat(auto-fill,minmax(280px,1fr))] gap-0">
                    @foreach($timetables as $timetable)
                        <div class="group p-8 border-r border-b border-slate-100 flex flex-col transition-all duration-300 relative bg-white hover:bg-slate-50">
                            <div class="flex items-start gap-5 mb-5">
                                <div class="tt-icon w-[50px] h-[50px] bg-gradient-to-br from-green-600/10 to-green-600/5 text-[color:var(--color-primary)] rounded-xl flex items-center justify-center text-[1.5rem] shrink-0 transition-transform duration-300 border border-green-600/20 group-hover:scale-110">
                                    @if(Str::endsWith($timetable->file_path, ['.pdf']))
                                        <i class="fa-solid fa-file-pdf"></i>
                                    @elseif(Str::endsWith($timetable->file_path, ['.doc', '.docx']))
                                        <i class="fa-solid fa-file-word"></i>
                                    @elseif(Str::endsWith($timetable->file_path, ['.jpg', '.jpeg', '.png']))
                                        <i class="fa-solid fa-file-image"></i>
                                    @else
                                        <i class="fa-solid fa-file-lines"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="m-0 mb-1.5 text-[1.1rem] text-slate-800 font-extrabold leading-[1.3]">{{ $timetable->title }}</h4>
                                    <p class="m-0 text-[0.82rem] text-slate-500 flex items-center gap-1.5">
                                        <i class="fa-regular fa-clock"></i> Uploaded {{ $timetable->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            @if($timetable->description)
                                <p class="text-[0.9rem] text-slate-600 m-0 mb-6 leading-[1.6] grow">
                                    {{ Str::limit($timetable->description, 90) }}
                                </p>
                            @else
                                <div class="grow mb-6"></div>
                            @endif
                            
                            <a href="{{ asset('storage/' . $timetable->file_path) }}" target="_blank" class="tt-download inline-flex items-center justify-center gap-2.5 bg-slate-100 text-slate-700 no-underline py-[0.8rem] px-[1.2rem] rounded-lg font-bold text-[0.9rem] transition-all duration-300 group-hover:bg-[color:var(--color-primary)] group-hover:text-white">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Download File
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="py-6 px-8 bg-slate-50 border-t border-slate-100 text-right">
                    <a href="{{ url('/resources') }}" class="btn btn-secondary bg-white text-slate-600 py-[0.6rem] px-6 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center gap-2 transition-all duration-200 shadow-[0_2px_4px_rgba(0,0,0,0.02)] hover:bg-slate-100 hover:text-slate-800">
                        See All Resources <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                @endif
            @else
                <div class="text-center py-16 px-8">
                    <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300 text-[2.5rem] shadow-[0_4px_10px_rgba(0,0,0,0.02)]">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    <h3 class="m-0 mb-2 text-slate-800 text-[1.3rem] font-extrabold">No Timetables Available</h3>
                    <p class="mx-auto my-0 text-slate-500 text-[1rem] text-center max-w-[600px]">The latest departmental timetables will be posted here once uploaded by the administration.</p>
                    <div class="mt-8">
                        <a href="{{ url('/resources') }}" class="btn btn-secondary bg-white text-slate-600 py-3 px-7 rounded-lg no-underline font-bold text-[0.95rem] border border-slate-300 inline-flex items-center gap-2 transition-all duration-200 hover:bg-slate-50 hover:text-slate-800">
                            Browse Other Resources <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
