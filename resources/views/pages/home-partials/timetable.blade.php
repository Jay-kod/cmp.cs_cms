<div class="timetable-section" style="margin: 3rem 0;">
    <div class="container" data-aos="fade-up">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.5rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800; margin: 0;">Departmental Timetables</h2>
            <a href="{{ url('/resources') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-folder-open"></i> View All Resources
            </a>
        </div>
        
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); padding: 0; border: 1px solid #f1f5f9; overflow: hidden;">
            @if((isset($timetables) && $timetables->count() > 0) || !empty($uploadedTimetable))
                
                @if(!empty($uploadedTimetable))
                <div class="tt-responsive-grid" style="padding: 2.5rem; border-bottom: 1px solid #cbd5e1; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; background: #e2e8f0; align-items: start;">
                    <div>
                        <div style="display: flex; align-items: flex-start; gap: 1.2rem; margin-bottom: 1.5rem;">
                            <div class="tt-icon" style="width: 56px; height: 56px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.1) 0%, rgba(22, 163, 74, 0.05) 100%); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0; border: 1px solid rgba(22, 163, 74, 0.2);">
                                @if(Str::endsWith($uploadedTimetable, ['.pdf']))
                                    <i class="fa-solid fa-file-pdf"></i>
                                @elseif(Str::endsWith($uploadedTimetable, ['.jpg', '.jpeg', '.png', '.webp', '.gif']))
                                    <i class="fa-solid fa-file-image"></i>
                                @else
                                    <i class="fa-solid fa-table-list"></i>
                                @endif
                            </div>
                            <div>
                                <span style="display: inline-block; background: #fee2e2; color: #b91c1c; font-size: 0.65rem; font-weight: 800; padding: 0.2rem 0.6rem; border-radius: 4px; margin-bottom: 0.4rem; letter-spacing: 0.5px;">LATEST</span>
                                <h4 style="margin: 0 0 0.5rem; font-size: 1.3rem; color: #1e293b; font-weight: 800; line-height: 1.3;">Official Department Timetable</h4>
                                <p style="margin: 0; font-size: 0.85rem; color: #64748b; display: flex; align-items: center; gap: 0.4rem;">
                                    <i class="fa-solid fa-circle-check" style="color: #22c55e;"></i> Currently Active Schedule
                                </p>
                            </div>
                        </div>

                        <p style="font-size: 1rem; color: #475569; margin: 0 0 2rem; line-height: 1.6;">
                            This is the most recent officially uploaded timetable for the department operations. You can view the live preview beside or download a copy of the file directly to your device.
                        </p>

                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            <a href="{{ Storage::disk('public')->url($uploadedTimetable) }}" target="_blank" class="btn btn-primary" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.6rem; background: var(--color-primary); color: white; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 8px; font-weight: 700; font-size: 0.95rem; border: none; transition: all 0.3s; box-shadow: 0 4px 10px rgba(22, 163, 74, 0.2);" onmouseover="this.style.boxShadow='0 6px 15px rgba(22, 163, 74, 0.3)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.boxShadow='0 4px 10px rgba(22, 163, 74, 0.2)'; this.style.transform='translateY(0)';">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Download File
                            </a>
                            <a href="{{ url('/resources') }}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0.8rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.95rem; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'; this.style.color='#1e293b';" onmouseout="this.style.background='white'; this.style.color='#475569';">
                                View More Resources <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <div style="background: white; border-radius: 12px; padding: 1rem; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: center; min-height: 250px; background-clip: padding-box; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                            @if(Str::endsWith($uploadedTimetable, ['.jpg', '.jpeg', '.png', '.webp', '.gif']))
                                <a href="{{ Storage::disk('public')->url($uploadedTimetable) }}" target="_blank">
                                    <img src="{{ Storage::disk('public')->url($uploadedTimetable) }}" alt="Timetable Preview" style="max-width: 100%; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); object-fit: contain; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                </a>
                            @elseif(Str::endsWith($uploadedTimetable, ['.pdf']))
                                <iframe src="{{ Storage::disk('public')->url($uploadedTimetable) }}#toolbar=0" style="width: 100%; height: 400px; border: none; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);"></iframe>
                            @else
                                <div style="text-align: center; color: #64748b; padding: 2rem;">
                                    <i class="fa-solid fa-file-csv" style="font-size: 3rem; margin-bottom: 1rem; color: #94a3b8;"></i>
                                    <p style="margin: 0; font-weight: 600; font-size: 1.1rem;">Preview not available for this format.</p>
                                    <small>Please download to view the spreadsheet file.</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Responsive CSS for the full preview block --}}
                <style>
                    @media (max-width: 768px) {
                        .tt-responsive-grid {
                            grid-template-columns: 1fr !important;
                            gap: 1.5rem !important;
                            padding: 1.5rem !important;
                        }
                        .tt-responsive-grid > div:first-child {
                            order: 1;
                        }
                        .tt-responsive-grid > div:last-child {
                            order: 2;
                        }
                    }
                </style>
                @endif

                @if(isset($timetables) && $timetables->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 0;">
                    @foreach($timetables as $timetable)
                        <div style="padding: 2rem; border-right: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9; display: flex; flex-direction: column; transition: all 0.3s ease; position: relative; background: white;" onmouseover="this.style.background='#f8fafc'; this.querySelector('.tt-download').style.background='var(--color-primary)'; this.querySelector('.tt-download').style.color='white'; this.querySelector('.tt-icon').style.transform='scale(1.1)';" onmouseout="this.style.background='white'; this.querySelector('.tt-download').style.background='#f1f5f9'; this.querySelector('.tt-download').style.color='#334155'; this.querySelector('.tt-icon').style.transform='scale(1)';">
                            <div style="display: flex; align-items: flex-start; gap: 1.2rem; margin-bottom: 1.2rem;">
                                <div class="tt-icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.1) 0%, rgba(22, 163, 74, 0.05) 100%); color: var(--color-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; transition: transform 0.3s ease; border: 1px solid rgba(22, 163, 74, 0.2);">
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
                                    <h4 style="margin: 0 0 0.4rem; font-size: 1.1rem; color: #1e293b; font-weight: 800; line-height: 1.3;">{{ $timetable->title }}</h4>
                                    <p style="margin: 0; font-size: 0.82rem; color: #64748b; display: flex; align-items: center; gap: 0.4rem;">
                                        <i class="fa-regular fa-clock"></i> Uploaded {{ $timetable->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            @if($timetable->description)
                                <p style="font-size: 0.9rem; color: #475569; margin: 0 0 1.5rem; line-height: 1.6; flex-grow: 1;">
                                    {{ Str::limit($timetable->description, 90) }}
                                </p>
                            @else
                                <div style="flex-grow: 1; margin-bottom: 1.5rem;"></div>
                            @endif
                            
                            <a href="{{ Storage::disk('public')->url($timetable->file_path) }}" target="_blank" class="tt-download" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.6rem; background: #f1f5f9; color: #334155; text-decoration: none; padding: 0.8rem 1.2rem; border-radius: 8px; font-weight: 700; font-size: 0.9rem; transition: all 0.3s;">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Download File
                            </a>
                        </div>
                    @endforeach
                </div>
                <div style="padding: 1.5rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; text-align: right;">
                    <a href="{{ url('/resources') }}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.95rem; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);" onmouseover="this.style.background='#f1f5f9'; this.style.color='#1e293b';" onmouseout="this.style.background='white'; this.style.color='#475569';">
                        See All Resources <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                @endif
            @else
                <div style="text-align: center; padding: 4rem 2rem;">
                    <div style="width: 80px; height: 80px; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: #cbd5e1; font-size: 2.5rem; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    <h3 style="margin: 0 0 0.5rem; color: #1e293b; font-size: 1.3rem; font-weight: 800;">No Timetables Available</h3>
                    <p style="margin: 0 auto; color: #64748b; font-size: 1rem; text-align: center; max-width: 600px;">The latest departmental timetables will be posted here once uploaded by the administration.</p>
                    <div style="margin-top: 2rem;">
                        <a href="{{ url('/resources') }}" class="btn btn-secondary" style="background: white; color: #475569; padding: 0.8rem 1.8rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.95rem; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s;" onmouseover="this.style.background='#f8fafc'; this.style.color='#1e293b';" onmouseout="this.style.background='white'; this.style.color='#475569';">
                            Browse Other Resources <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
