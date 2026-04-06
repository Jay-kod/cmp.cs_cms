@extends('layouts.public')
@section('title', 'Student Resources & Downloads')

@section('content')

<!-- 1. Premium Hero Banner -->
<section style="background: url('{{ asset('images/pattern-grid.svg') }}') center/cover, linear-gradient(135deg, #0f172a 0%, #064e3b 100%); padding: 6rem 0 7rem; color: white; text-align: center; position: relative; overflow: hidden; border-bottom: 4px solid var(--color-accent);">
    <div style="position: absolute; inset: 0; background: radial-gradient(circle at center, rgba(16, 185, 129, 0.15) 0%, transparent 60%); pointer-events: none;"></div>

    <div class="container reveal reveal-up" style="position: relative; z-index: 1;">
        <nav aria-label="breadcrumb" style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
            <ol class="breadcrumb" style="list-style: none; margin: 0; background: rgba(255,255,255,0.08); backdrop-filter: blur(8px); padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 600; letter-spacing: 0.5px; border: 1px solid rgba(255,255,255,0.1); display: inline-flex; align-items: center; gap: 0.8rem;">
                <li style="margin: 0;"><a href="{{ url('/') }}" style="color: #cbd5e1; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#cbd5e1'"><i class="fa-solid fa-house" style="margin-right: 4px;"></i> Home</a></li>
                <li style="color: rgba(255,255,255,0.3); margin: 0;">/</li>
                <li aria-current="page" style="color: #F4C430; margin: 0;">Resources</li>
            </ol>
        </nav>
        
        <h1 style="font-size: 3.5rem; font-weight: 900; margin-bottom: 1.2rem; color: #FFFFFF; font-family: var(--font-heading); letter-spacing: -1px; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            <span style="color: var(--color-accent);">Academic</span> Resources
        </h1>
        <p style="font-size: 1.15rem; max-width: 680px; margin: 0 auto; color: #cbd5e1; line-height: 1.7; font-weight: 400;">
            A centralized digital repository for students and faculty. Access handbooks, lecture schedules, official guidelines, and essential university portals.
        </p>
    </div>
</section>

<!-- 2. Essential Portals -->
<section style="background: transparent; padding: 0; margin-top: -3.5rem; position: relative; z-index: 10; margin-bottom: 3rem;">
    <div class="container reveal reveal-up">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; max-width: 800px; margin: 0 auto;">
            
            <!-- Timetable Shortcut -->
            <div>
                <a href="#downloads-section" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                    <div class="card portal-card h-100" style="background: white; padding: 2rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05); text-align: left; transition: all 0.4s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.08); position: relative; overflow: hidden; z-index: 1; display: flex; flex-direction: row; align-items: center; gap: 1.2rem;">
                        <div class="portal-hover-bg" style="position: absolute; inset: 0; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); opacity: 0; transition: opacity 0.4s ease; z-index: -1;"></div>
                        <div style="width: 64px; height: 64px; background: #f0fdf4; color: var(--color-primary); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0; box-shadow: 0 8px 20px rgba(22, 163, 74, 0.2); transition: transform 0.4s ease;">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.4rem; font-family: var(--font-heading);">Lecture Timetables</h3>
                            <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 0; line-height: 1.5;">Check academic schedules, exam rosters, and department calendars.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Library -->
            <div>
                <a href="#" style="text-decoration: none; color: inherit; display: block; height: 100%;">
                    <div class="card portal-card h-100" style="background: white; padding: 2rem; border-radius: 16px; border: 1px solid rgba(0,0,0,0.05); text-align: left; transition: all 0.4s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.08); position: relative; overflow: hidden; z-index: 1; display: flex; flex-direction: row; align-items: center; gap: 1.2rem;">
                        <div class="portal-hover-bg" style="position: absolute; inset: 0; background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%); opacity: 0; transition: opacity 0.4s ease; z-index: -1;"></div>
                        <div style="width: 64px; height: 64px; background: #eff6ff; color: #3b82f6; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0; box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2); transition: transform 0.4s ease;">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: 0.4rem; font-family: var(--font-heading);">Digital Library</h3>
                            <p style="color: #64748b; font-size: 0.85rem; margin-bottom: 0; line-height: 1.5;">Browse research papers, journals, textbooks, and online publications.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. Categorized Downloads -->
<section id="downloads-section" style="background: white; padding: 4rem 0 8rem;">
    <div class="container reveal reveal-up" style="max-width: 1000px;">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span style="display: inline-block; background: #f0fdf4; color: var(--color-primary); font-size: 0.75rem; font-weight: 700; padding: 0.4rem 1.2rem; border-radius: 50px; margin-bottom: 1rem; text-transform: uppercase; letter-spacing: 1px;">Document Archives</span>
            <h2 style="font-size: 2.2rem; font-weight: 900; color: #2d3748; font-family: var(--font-heading); margin-bottom: 0.8rem; letter-spacing: -0.5px;">Download Center</h2>
            <p style="color: #718096; font-size: 1rem; max-width: 500px; margin: 0 auto; line-height: 1.6;">Easily locate and download officially published files categorized for your convenience.</p>
        </div>

        @if($categories->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 3rem;">
                @foreach($categories as $category)
                    @php 
                        $items = $resourcesByCategory[$category->slug] ?? collect(); 
                    @endphp
                    
                    <div>
                        <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 1rem;">
                            <div>
                                <h3 style="font-size: 1.35rem; font-weight: 800; color: #1a202c; margin: 0 0 0.2rem; font-family: var(--font-heading);">{{ $category->name }}</h3>
                                <p style="margin: 0; color: #718096; font-size: 0.85rem;">Browse and download files within this collection.</p>
                            </div>
                            <div style="padding: 0.3rem 0.8rem; border-radius: 50px; border: 1px solid #e2e8f0; color: #4a5568; font-weight: 600; font-size: 0.7rem; background: white;">
                                Total: <span style="color: var(--color-primary);">{{ $items->count() }}</span> items
                            </div>
                        </div>
                        
                        @if($items->count() > 0)
                            <div style="display: grid; gap: 0.8rem;">
                                @foreach($items as $item)
                                    <div class="advanced-doc-row" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.2rem; transition: all 0.3s; display: flex; justify-content: space-between; align-items: center;">
                                        <div style="display: flex; gap: 1.2rem; align-items: center;">
                                            <div style="width: 50px; height: 50px; background: #f8fafc; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; border: 1px solid #f1f5f9;">
                                                @if(Str::endsWith($item->file_path, ['.pdf']))
                                                    <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i>
                                                @elseif(Str::endsWith($item->file_path, ['.doc', '.docx']))
                                                    <i class="fa-solid fa-file-word" style="color: #3b82f6;"></i>
                                                @elseif(Str::endsWith($item->file_path, ['.jpg', '.jpeg', '.png', '.webp']))
                                                    <i class="fa-solid fa-file-image" style="color: #10b981;"></i>
                                                @elseif(Str::endsWith($item->file_path, ['.xls', '.xlsx', '.csv']))
                                                    <i class="fa-solid fa-file-excel" style="color: #16a34a;"></i>
                                                @else
                                                    <i class="fa-solid fa-file-lines" style="color: #64748b;"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 style="font-size: 1rem; font-weight: 700; color: #2d3748; margin: 0 0 0.3rem; letter-spacing: -0.2px;">{{ $item->title }}</h4>
                                                
                                                <div style="display: flex; flex-wrap: wrap; gap: 0.8rem; align-items: center;">
                                                    <span style="font-size: 0.75rem; color: #718096; font-weight: 500; display: inline-flex; align-items: center; gap: 0.3rem;">
                                                        <i class="fa-regular fa-calendar-check" style="color: #a0aec0;"></i> 
                                                        {{ $item->uploaded_at ? \Carbon\Carbon::parse($item->uploaded_at)->format('M d, Y') : $item->created_at->format('M d, Y') }}
                                                    </span>
                                                    <span style="width: 3px; height: 3px; border-radius: 50%; background: #cbd5e1;"></span>
                                                    <span style="font-size: 0.65rem; color: #4a5568; font-weight: 700; text-transform: uppercase; background: #edf2f7; padding: 0.15rem 0.5rem; border-radius: 4px;">
                                                        {{ strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION)) }}
                                                    </span>
                                                </div>
                                                
                                                @if($item->description)
                                                    <p style="font-size: 0.85rem; color: #718096; margin: 0.5rem 0 0; line-height: 1.5; max-width: 500px;">{{ Str::limit($item->description, 100) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn premium-btn" style="flex-shrink: 0; background: white; color: #2d3748; border: 1px solid #e2e8f0; padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 700; font-size: 0.8rem; text-decoration: none; transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.4rem; margin-left: 1rem;">
                                            Download <i class="fa-solid fa-arrow-down" style="font-size: 0.75rem;"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align: center; padding: 3rem 2rem; background: #fafafa; border-radius: 12px; border: 1px dashed #cbd5e1;">
                                <div style="margin: 0 auto 0.8rem; font-size: 2.2rem; color: #cbd5e1;">
                                    <i class="fa-solid fa-folder"></i>
                                </div>
                                <h4 style="color: #1a202c; font-weight: 800; margin-bottom: 0.3rem; font-size: 1.1rem;">Folder is Empty</h4>
                                <p style="color: #718096; margin: 0; font-size: 0.85rem;">No academic files have been uploaded to this category yet.</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 6rem 2rem; background: #f8fafc; border-radius: 24px; border: 1px dashed #cbd5e1; max-width: 800px; margin: 0 auto;">
                <div style="width: 100px; height: 100px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 3rem; color: #cbd5e1; box-shadow: 0 10px 30px rgba(0,0,0,0.04);">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 style="color: #0f172a; font-size: 1.8rem; font-weight: 900; margin-bottom: 0.8rem;">Repository Uninitialized</h3>
                <p style="color: #64748b; margin: 0; font-size: 1.15rem;">The administration is currently preparing the digital archives. Check back soon for updated handbooks, forms, and timetables.</p>
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