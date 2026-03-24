<div class="timetable-section" style="margin: 3rem 0;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.5rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800; margin: 0;">Departmental Timetables</h2>
            <a href="{{ url('/resources') }}" class="btn btn-primary" style="background: var(--color-primary); color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 0.4rem; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fa-solid fa-folder-open"></i> View All Resources
            </a>
        </div>
        
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); padding: 0; border: 1px solid #f1f5f9; overflow: hidden;">
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
