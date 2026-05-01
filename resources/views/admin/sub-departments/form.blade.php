@extends($adminLayout ?? 'layouts.admin')
@section('title', $department->exists ? 'Edit Department' : 'Create Department')
@section('content')

@if ($errors->any())
    <div style="margin-bottom: 2.5rem; background: #fef2f2; border-left: 4px solid #ef4444; padding: 1.25rem 1.5rem; border-radius: 8px;">
        <div style="color: #b91c1c; font-weight: 700; margin-bottom: 0.5rem; font-size: 1.05rem;"><i class="fa-solid fa-circle-exclamation mr-2"></i>Please fix the following errors:</div>
        <ul style="margin: 0; padding-left: 1.5rem; color: #b91c1c; font-size: 0.95rem; line-height: 1.5;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $department->exists ? route('admin.sub-departments.update', $department) : route('admin.sub-departments.store') }}" method="POST" enctype="multipart/form-data" id="department-form">
    @csrf
    @if($department->exists)
        @method('PUT')
    @endif

    <div style="display: flex; flex-direction: row; gap: 2rem; align-items: flex-start; max-width: 1200px; margin: 0 auto; position: relative;">
        
        <!-- Left Sidebar (Tabs) -->
        <div style="min-width: max-content; width: auto; flex-shrink: 0; background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow-y: auto; position: sticky; top: 70px; align-self: flex-start; max-height: calc(100vh - 110px); z-index: 50;">
            <div style="background: #0f172a; padding: 0.75rem; color: white;">
                <h3 style="margin: 0; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.05em; color: #94a3b8;">SECTIONS</h3>
            </div>
            
            <div style="padding: 0.5rem 0;" id="section-tabs">
                <button type="button" class="tab-btn active" data-target="tab-system" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: #f0f9ff; color: #0ea5e9; font-weight: 600; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid #0ea5e9; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #e0f2fe; color: #0ea5e9; border-radius: 8px; font-size: 0.7rem;"><i class="fa-solid fa-server"></i></span>
                    System Identifiers
                </button>

                <button type="button" class="tab-btn" data-target="tab-hero" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #e0f2fe; color: #0ea5e9; border-radius: 8px; font-size: 0.7rem;"><i class="fa-solid fa-image"></i></span>
                    Hero Header
                </button>

                <button type="button" class="tab-btn" data-target="tab-about" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #dcfce7; color: #22c55e; border-radius: 8px; font-size: 0.7rem;"><i class="fa-regular fa-file-lines"></i></span>
                    About Section
                </button>

                <button type="button" class="tab-btn" data-target="tab-vision" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #fae8ff; color: #d946ef; border-radius: 8px; font-size: 0.7rem;"><i class="fa-solid fa-bullseye"></i></span>
                    Vision & Mission
                </button>

                <button type="button" class="tab-btn" data-target="tab-glance" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #e0e7ff; color: #6366f1; border-radius: 8px; font-size: 0.7rem;"><i class="fa-solid fa-chart-pie"></i></span>
                    Glance / Facts
                </button>

                <button type="button" class="tab-btn" data-target="tab-programmes" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #fef9c3; color: #eab308; border-radius: 8px; font-size: 0.7rem;"><i class="fa-solid fa-graduation-cap"></i></span>
                    Programmes
                </button>

                <button type="button" class="tab-btn" data-target="tab-research" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #f1f5f9; color: #64748b; border-radius: 8px; font-size: 0.7rem;"><i class="fa-solid fa-flask"></i></span>
                    Research & Pubs
                </button>
                
                <button type="button" class="tab-btn" data-target="tab-news" style="width: 100%; text-align: left; padding: 0.5rem 0.75rem; border: none; background: white; color: #475569; font-weight: 500; font-size: 0.7rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; white-space: nowrap; border-left: 4px solid transparent; transition: all 0.2s;">
                    <span style="display: flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #fce7f3; color: #ec4899; border-radius: 8px; font-size: 0.7rem;"><i class="fa-regular fa-newspaper"></i></span>
                    News & Updates
                </button>
            </div>

            <!-- Global Save Button matching the image -->
            <div style="padding: 1.5rem; border-top: 1px solid #f1f5f9;">
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label class="form-label font-weight-bold" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #334155;">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $department->exists ? $department->is_active : true) ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #10b981;">
                        Publish to Website
                    </label>
                </div>
                <button type="submit" style="width: 100%; background: #10b981; color: white; border: none; border-radius: 8px; padding: 1rem; font-weight: 700; font-size: 1.1rem; display: flex; justify-content: center; align-items: center; gap: 0.5rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.4); transition: transform 0.1s;">
                    <i class="fa-solid fa-floppy-disk"></i> Save Content
                </button>
            </div>
        </div>

        <!-- Right Content Area (Tab Panels) -->
        <div style="flex-grow: 1; background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); padding: 2.5rem; min-height: 500px;">
            
            <div style="margin-bottom: 2.5rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1.5rem;">
                <h2 style="margin: 0; font-size: 1.6rem; color: #0f172a; font-weight: 800;">
                    {{ $department->exists ? 'Editing: '.$department->name : 'Create New Department Unit' }}
                </h2>
                <p style="color: #64748b; margin-top: 0.75rem;">Select a section from the left sidebar to edit its content.</p>
            </div>

            <!-- Panel: System -->
            <div class="tab-pane active" id="tab-system">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-server text-sky-500"></i> System Identifiers & Links</h3>
                <div style="background: #fafafa; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div class="form-group">
                            <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.5rem; display: block;">Unit Code (Prefix) <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="prefix" class="form-control" style="background: white; border: 1px solid #cbd5e1; padding: 0.75rem; border-radius: 8px; width: 100%;" value="{{ old('prefix', $department->prefix) }}" required placeholder="e.g. cs, cyb, ds">
                            <small style="color: #64748b; display: block; margin-top: 0.5rem;"><i class="fa-solid fa-circle-info mr-1"></i> Secures programmes to this department.</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.5rem; display: block;">URL Web Link (Slug) <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="slug" class="form-control" style="background: white; border: 1px solid #cbd5e1; padding: 0.75rem; border-radius: 8px; width: 100%;" value="{{ old('slug', $department->slug) }}" required placeholder="e.g. data-science">
                            <small style="color: #64748b; display: block; margin-top: 0.5rem;"><i class="fa-solid fa-link mr-1"></i> Generates: /department/slug</small>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 1.5rem;">
                        <div class="form-group">
                            <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.5rem; display: block;"><i class="fa-solid fa-calendar-alt text-sky-500 mr-1"></i> Year Founded</label>
                            <input type="text" name="founded_year" class="form-control" style="background: white; border: 1px solid #cbd5e1; padding: 0.75rem; border-radius: 8px; width: 100%;" value="{{ old('founded_year', $department->founded_year) }}" placeholder="e.g. 2003">
                            <small style="color: #64748b; display: block; margin-top: 0.5rem;"><i class="fa-solid fa-circle-info mr-1"></i> Shown in the "Department at a Glance" statistics.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel: Hero -->
            <div class="tab-pane" id="tab-hero" style="display: none;">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-image text-sky-500"></i> Website Block 1: Hero Header</h3>
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.5rem; display: block;">Main Display Title (Department Name) <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="name" class="form-control" style="border: 1px solid #cbd5e1; font-size: 1.1rem; padding: 0.85rem 1rem; border-radius: 8px; width: 100%;" value="{{ old('name', $department->name) }}" required placeholder="e.g. Department of Computer Science">
                        <small style="color: #64748b; display: block; margin-top: 0.5rem;">This appears in massive letters on the blue hero background.</small>
                    </div>
                </div>
            </div>

            <!-- Panel: About -->
            <div class="tab-pane" id="tab-about" style="display: none;">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-regular fa-file-lines text-green-500"></i> Website Block 2: About Description</h3>
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem;">
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.5rem; display: block;">Detailed Department Overview</label>
                        <textarea name="description" class="form-control" style="border: 1px solid #cbd5e1; border-radius: 8px; width: 100%; padding: 1rem; resize: vertical;" rows="8" placeholder="A center for academic excellence and pioneering research in...">{{ old('description', $department->description) }}</textarea>
                        <small style="color: #64748b; display: block; margin-top: 0.5rem;">The main introductory paragraph shown under the "Pioneering Excellence" heading.</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.5rem; display: block;"><i class="fa-solid fa-paragraph text-green-500 mr-1"></i> Additional About Content (Optional)</label>
                        <textarea name="about_short" class="form-control" style="border: 1px solid #cbd5e1; border-radius: 8px; width: 100%; padding: 1rem; resize: vertical;" rows="5" placeholder="Any additional content to show below the main overview...">{{ old('about_short', $department->about_short) }}</textarea>
                        <small style="color: #64748b; display: block; margin-top: 0.5rem;">Appears below the main description. Supports plain text.</small>
                    </div>
                </div>
            </div>

            <!-- Panel: Vision & Mission -->
            <div class="tab-pane" id="tab-vision" style="display: none;">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-bullseye text-fuchsia-500"></i> Website Block 3: Vision & Mission Cards</h3>
                <!-- Preview Hint -->
                <div style="background: linear-gradient(135deg, #faf5ff 0%, #f0fdfa 100%); border: 1px solid #e9d5ff; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; background: #d946ef20; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-palette" style="color: #d946ef; font-size: 0.85rem;"></i>
                    </div>
                    <div>
                        <div style="font-weight: 700; color: #334155; font-size: 0.85rem;">Website Preview</div>
                        <div style="color: #64748b; font-size: 0.78rem; line-height: 1.4;">These fields render as two premium side-by-side cards — a dark <strong>Vision</strong> card and a green <strong>Mission</strong> card — in the About section of the department page.</div>
                    </div>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <!-- Vision Field -->
                        <div class="form-group">
                            <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                <span style="width: 28px; height: 28px; background: #0f172a; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-eye" style="color: #34d399; font-size: 0.7rem;"></i></span>
                                Our Vision
                            </label>
                            <textarea name="vision" class="form-control" style="border: 1px solid #cbd5e1; border-radius: 8px; width: 100%; padding: 1rem; resize: vertical;" rows="6" placeholder="To be a globally recognized center of excellence...">{{ old('vision', $department->vision) }}</textarea>
                            <small style="color: #64748b; display: block; margin-top: 0.5rem;"><i class="fa-solid fa-circle-info mr-1"></i> Renders as a dark slate card with an eye icon.</small>
                        </div>

                        <!-- Mission Field -->
                        <div class="form-group">
                            <label class="form-label" style="font-weight: 700; color: #334155; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                                <span style="width: 28px; height: 28px; background: #059669; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;"><i class="fa-solid fa-bullseye" style="color: white; font-size: 0.7rem;"></i></span>
                                Our Mission
                            </label>
                            <textarea name="mission" class="form-control" style="border: 1px solid #cbd5e1; border-radius: 8px; width: 100%; padding: 1rem; resize: vertical;" rows="6" placeholder="To provide high-quality education and foster innovative research...">{{ old('mission', $department->mission) }}</textarea>
                            <small style="color: #64748b; display: block; margin-top: 0.5rem;"><i class="fa-solid fa-circle-info mr-1"></i> Renders as a green gradient card with a rocket icon.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel: Programmes -->
            <div class="tab-pane" id="tab-programmes" style="display: none;">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-graduation-cap text-yellow-500"></i> Website Block 4: Programmes</h3>
                <div style="padding: 3rem 2rem; background: #fdfcee; border: 2px dashed #fef08a; border-radius: 12px; text-align: center;">
                    <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <i class="fa-solid fa-graduation-cap" style="font-size: 2.5rem; color: #eab308;"></i>
                    </div>
                    <h4 style="color: #334155; font-size: 1.3rem; font-weight: 800; margin-bottom: 0.5rem;">Programmes Module</h4>
                    <p style="color: #475569; font-size: 1.05rem; margin-bottom: 1.5rem; max-width: 400px; margin-left: auto; margin-right: auto;">Programmes mapped to this unit's code and will automatically list on the front-end page under this block.</p>
                    <a href="#" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #eab308; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; box-shadow: 0 2px 4px rgba(234, 179, 8, 0.2);">
                        Manage Programmes
                    </a>
                </div>
            </div>

            <!-- Panel: Research -->
            <div class="tab-pane" id="tab-research" style="display: none;">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-solid fa-flask text-slate-500"></i> Website Block 5: Research & Publications</h3>
                <div style="padding: 3rem 2rem; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; text-align: center;">
                    <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <i class="fa-solid fa-flask" style="font-size: 2.5rem; color: #64748b;"></i>
                    </div>
                    <h4 style="color: #334155; font-size: 1.3rem; font-weight: 800; margin-bottom: 0.5rem;">Research Module</h4>
                    <p style="color: #475569; font-size: 1.05rem; margin-bottom: 1.5rem; max-width: 400px; margin-left: auto; margin-right: auto;">Articles, journals, and thesis papers tag automatically dynamically when tagged to this department.</p>
                    <a href="#" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #64748b; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; box-shadow: 0 2px 4px rgba(100, 116, 139, 0.2);">
                        Manage Research
                    </a>
                </div>
            </div>

            <!-- Panel: News -->
            <div class="tab-pane" id="tab-news" style="display: none;">
                <h3 style="font-size: 1.25rem; color: #334155; margin-bottom: 1.5rem; font-weight: 700; display: flex; align-items: center; gap: 0.6rem;"><i class="fa-regular fa-newspaper text-pink-500"></i> Website Block 6: News & Updates</h3>
                <div style="padding: 3rem 2rem; background: #fdf2f8; border: 2px dashed #f9a8d4; border-radius: 12px; text-align: center;">
                    <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                        <i class="fa-regular fa-newspaper" style="font-size: 2.5rem; color: #ec4899;"></i>
                    </div>
                    <h4 style="color: #334155; font-size: 1.3rem; font-weight: 800; margin-bottom: 0.5rem;">News Module</h4>
                    <p style="color: #475569; font-size: 1.05rem; margin-bottom: 1.5rem; max-width: 400px; margin-left: auto; margin-right: auto;">News related to this unit populate dynamically from the global articles pool.</p>
                    <a href="#" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: #ec4899; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; box-shadow: 0 2px 4px rgba(236, 72, 153, 0.2);">
                        Manage News
                    </a>
                </div>
            </div>

        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-btn');
        const panes = document.querySelectorAll('.tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Determine base color class from default inline styles logic:
                const isSystem = this.getAttribute('data-target') === 'tab-system';
                
                // Reset all tabs
                tabs.forEach(t => {
                    t.classList.remove('active');
                    t.style.background = 'white';
                    t.style.fontWeight = '500';
                    t.style.color = '#475569';
                    t.style.borderLeftColor = 'transparent';
                });

                panes.forEach(p => p.style.display = 'none');

                // Activate selected tab
                this.classList.add('active');
                
                // Get preset active background class color logic from the style directly inside the first tab:
                this.style.background = '#f0f9ff'; // Light blue backgound for active
                this.style.borderLeftColor = '#0ea5e9'; 
                
                // Show target content
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).style.display = 'block';
            });
        });
    });
</script>
@endsection




