<?php
$str = <<<'BLADE'
@extends($adminLayout ?? 'layouts.admin')
@section('title', 'About Page Content')
@section('header', 'About Page Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    $coreValues = json_decode($s('about_core_values', '[]'), true) ?? [];
    $facilities = json_decode($s('about_facilities', '[]'), true) ?? [];
    $requirements = json_decode($s('about_requirements', '[]'), true) ?? [];
    $programmes = json_decode($s('about_programmes', '[]'), true) ?? [];
    $boardMembers = json_decode($s('about_board', '[]'), true) ?? [];
@endphp

<style>
.pc-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
.pc-card-header { padding: 1rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none; }
.pc-card-header h3 { margin: 0; font-size: 1rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.6rem; }
.pc-card-body { padding: 1.5rem; display: block; }
.pc-card-body.collapsed { display: none; }
.form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 0.8rem; }
.form-group label { font-size: 0.85rem; font-weight: 600; color: #475569; }
.form-group input, .form-group textarea, .form-group select { width: 100%; padding: 0.6rem 0.9rem; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 0.95rem; color: #334155; box-sizing: border-box; transition: border-color 0.2s; }
.form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--color-primary); box-shadow: 0 0 0 3px rgba(22,163,74,0.1); }
.form-group textarea { resize: vertical; min-height: 80px; }
.toggle-icon { font-size: 0.8rem; color: #64748b; transition: transform 0.2s; }
.pc-card-header.open .toggle-icon { transform: rotate(180deg); }
.repeater-row { border: 1px solid #e2e8f0; border-radius: 10px; padding: 1rem; margin-bottom: 0.8rem; background: #fafafa; position: relative; }
.repeater-row .remove-btn { position: absolute; top: 0.6rem; right: 0.6rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 6px; width: 28px; height: 28px; cursor: pointer; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; }
</style>

<div style="background: #1e293b; padding: 0.8rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
    <span style="color: #94a3b8; font-size: 0.9rem;"><i class="fa-solid fa-circle-info" style="margin-right: 6px;"></i>Editing: <strong style="color: white;">About Page</strong></span>
    <a href="{{ route('about') }}" target="_blank" style="background: var(--color-primary); color: white; padding: 0.4rem 1rem; border-radius: 8px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-eye"></i> Preview</a>
</div>

<form method="POST" action="{{ route('admin.page-content.update', 'about') }}" enctype="multipart/form-data">
    @csrf

    {{-- ── HERO SECTION ── --}}
    <div class="pc-card">
        <div class="pc-card-header open" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-image" style="color: var(--color-primary);"></i> Hero Section</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Badge Text</label>
                    <input type="text" name="about_hero_badge" value="{{ $s('about_hero_badge', 'About Us') }}">
                </div>
                <div class="form-group">
                    <label>Hero Title</label>
                    <input type="text" name="about_hero_title" value="{{ $s('about_hero_title', 'About Our Department') }}">
                </div>
            </div>
            <div class="form-group">
                <label>Hero Subtitle / Description</label>
                <textarea name="about_hero_subtitle" rows="3">{{ $s('about_hero_subtitle', 'Department of Computer Science, Faculty of Natural and Applied Sciences...') }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── OUR STORY / OVERVIEW ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-align-left" style="color: var(--color-primary);"></i> Introduction / Overview</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-group">
                <label>Intro Title</label>
                <input type="text" name="about_intro_title" value="{{ $s('about_intro_title', 'Welcome to Computer Science') }}">
            </div>
            <div class="form-group">
                <label>Main Intro Text (HTML allowed)</label>
                <textarea name="about_intro_text" rows="6">{{ $s('about_intro_text') }}</textarea>
            </div>
            <div class="form-group">
                <label>Secondary / Highlighted Text</label>
                <textarea name="about_intro_highlight" rows="3">{{ $s('about_intro_highlight') }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── MISSION & VISION ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-bullseye" style="color: var(--color-primary);"></i> Mission & Vision</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-row">
                <div class="form-group">
                    <label>Mission Statement</label>
                    <textarea name="about_mission" rows="4">{{ $s('about_mission') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Vision Statement</label>
                    <textarea name="about_vision" rows="4">{{ $s('about_vision') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- ── CORE VALUES ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-star" style="color: var(--color-primary);"></i> Core Values</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-group">
                <label>Core Values Description</label>
                <textarea name="about_core_values_desc" rows="2">{{ $s('about_core_values_desc') }}</textarea>
            </div>
            
            <p style="font-size: 0.85rem; color: #64748b; margin-top: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; margin-bottom: 0.8rem;">Value Items</p>
            <div id="coreValuesRepeater">
                @foreach($coreValues as $i => $cv)
                <div class="repeater-row">
                    <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                    <div class="form-row">
                        <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_core_values[{{ $i }}][icon]" value="{{ $cv['icon'] ?? '' }}"></div>
                        <div class="form-group"><label>Title</label><input type="text" name="about_core_values[{{ $i }}][title]" value="{{ $cv['title'] ?? '' }}"></div>
                    </div>
                    <div class="form-group"><label>Description</label><textarea name="about_core_values[{{ $i }}][description]" rows="2">{{ $cv['description'] ?? '' }}</textarea></div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addCoreValue()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%;">
                <i class="fa-solid fa-plus"></i> Add Core Value
            </button>
        </div>
    </div>

    {{-- ── FACILITIES ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-building" style="color: var(--color-primary);"></i> Facilities</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-group">
                <label>Facilities Intro Description</label>
                <textarea name="about_facilities_desc" rows="2">{{ $s('about_facilities_desc') }}</textarea>
            </div>
            
            <p style="font-size: 0.85rem; color: #64748b; margin-top: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; margin-bottom: 0.8rem;">Facility Items</p>
            <div id="facilitiesRepeater">
                @foreach($facilities as $i => $fac)
                <div class="repeater-row">
                    <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                    <div class="form-row">
                        <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_facilities[{{ $i }}][icon]" value="{{ $fac['icon'] ?? '' }}"></div>
                        <div class="form-group"><label>Name</label><input type="text" name="about_facilities[{{ $i }}][name]" value="{{ $fac['name'] ?? '' }}"></div>
                    </div>
                    <div class="form-group"><label>Description</label><textarea name="about_facilities[{{ $i }}][description]" rows="2">{{ $fac['description'] ?? '' }}</textarea></div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addFacility()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%;">
                <i class="fa-solid fa-plus"></i> Add Facility
            </button>
        </div>
    </div>

    {{-- ── ACADEMIC PROGRAMMES ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-graduation-cap" style="color: var(--color-primary);"></i> Academic Programmes</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-group">
                <label>Programmes Intro Description</label>
                <textarea name="about_programmes_desc" rows="2">{{ $s('about_programmes_desc', "The department offers Bachelor's, Post-graduate Diploma, Master's, and PhD degrees.") }}</textarea>
            </div>
            
            <p style="font-size: 0.85rem; color: #64748b; margin-top: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.5rem; margin-bottom: 0.8rem;">Programme Categories (e.g. Postgraduate, Undergraduate)</p>
            <div id="progRepeater">
                @foreach($programmes as $i => $prog)
                <div class="repeater-row">
                    <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                    <div class="form-row">
                        <div class="form-group"><label>Category Name</label><input type="text" name="about_programmes[{{ $i }}][title]" value="{{ $prog['title'] ?? '' }}" placeholder="Postgraduate"></div>
                        <div class="form-group"><label>Icon (FA)</label><input type="text" name="about_programmes[{{ $i }}][icon]" value="{{ $prog['icon'] ?? 'fa-hat-wizard' }}"></div>
                        <div class="form-group"><label>Theme Color Class</label>
                            <select name="about_programmes[{{ $i }}][theme]">
                                <option value="dark" {{ ($prog['theme'] ?? '') == 'dark' ? 'selected' : '' }}>Dark (Navy)</option>
                                <option value="light" {{ ($prog['theme'] ?? '') == 'light' ? 'selected' : '' }}>Light (Green)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>List of Degrees/Programmes (One per line)</label>
                        <textarea name="about_programmes[{{ $i }}][items]" rows="4" placeholder="Ph.D. Computer Science&#10;M.Sc. Computer Science">{{ $prog['items'] ?? '' }}</textarea>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addProg()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%;">
                <i class="fa-solid fa-plus"></i> Add Programme Category
            </button>
        </div>
    </div>

    {{-- ── DEPARTMENTAL BOARD ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-sitemap" style="color: var(--color-primary);"></i> Departmental Board</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-group">
                <label>Board Introduction Text</label>
                <textarea name="about_board_desc" rows="3">{{ $s('about_board_desc', 'The Departmental Board is made up of all lecturers in the Department...') }}</textarea>
            </div>
            <div id="boardRepeater">
                @foreach($boardMembers as $i => $bm)
                <div class="repeater-row">
                    <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                    <div class="form-row">
                        <div class="form-group"><label>Title/Group Name</label><input type="text" name="about_board[{{ $i }}][title]" value="{{ $bm['title'] ?? '' }}" placeholder="Chairman"></div>
                        <div class="form-group"><label>Who</label><input type="text" name="about_board[{{ $i }}][who]" value="{{ $bm['who'] ?? '' }}" placeholder="Head of Department"></div>
                        <div class="form-group"><label>Icon (FA)</label><input type="text" name="about_board[{{ $i }}][icon]" value="{{ $bm['icon'] ?? 'fa-crown' }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addBoard()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%;">
                <i class="fa-solid fa-plus"></i> Add Board Card
            </button>
        </div>
    </div>

    {{-- ── ENTRY REQUIREMENTS ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-clipboard-list" style="color: var(--color-primary);"></i> Entry Requirements</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <p style="font-size: 0.85rem; color: #64748b; margin-bottom: 0.8rem;">Define the different structural entry requirements.</p>
            <div id="reqRepeater">
                @foreach($requirements as $i => $req)
                <div class="repeater-row">
                    <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
                    <div class="form-row">
                        <div class="form-group"><label>Level</label><input type="text" name="about_requirements[{{ $i }}][level]" value="{{ $req['level'] ?? '' }}" placeholder="O' Level"></div>
                        <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_requirements[{{ $i }}][icon]" value="{{ $req['icon'] ?? 'fa-school' }}"></div>
                    </div>
                    <div class="form-group"><label>Requirement Description</label><input type="text" name="about_requirements[{{ $i }}][desc]" value="{{ $req['desc'] ?? '' }}"></div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addReq()" style="background: #f0fdf4; border: 1px dashed var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9rem; width: 100%;">
                <i class="fa-solid fa-plus"></i> Add Entry Requirement
            </button>
        </div>
    </div>

    {{-- ── OUR FACULTY ── --}}
    <div class="pc-card">
        <div class="pc-card-header" onclick="toggleSection(this)">
            <h3><i class="fa-solid fa-chalkboard-user" style="color: var(--color-primary);"></i> Our Faculty</h3>
            <i class="fa-solid fa-chevron-down toggle-icon"></i>
        </div>
        <div class="pc-card-body collapsed">
            <div class="form-group">
                <label>Short Stat (e.g. 27+ Academic Staff)</label>
                <input type="text" name="about_faculty_stat" value="{{ $s('about_faculty_stat', '27+ Academic Staff') }}">
            </div>
            <div class="form-group">
                <label>Faculty Spotlight Description (HTML allowed)</label>
                <textarea name="about_faculty_desc" rows="4">{{ $s('about_faculty_desc', 'Our department is home to <strong>3 Professors</strong>, <strong>3 Associate Professors</strong>...') }}</textarea>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: flex-end; gap: 1rem;">
        <button type="submit" style="background: var(--color-primary); color: white; border: none; padding: 0.8rem 2rem; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(22,163,74,0.3); transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>
    </div>
</form>

<script>
function toggleSection(header) {
    const body = header.nextElementSibling;
    const isOpen = !body.classList.contains('collapsed');
    
    document.querySelectorAll('.pc-card-body').forEach(b => b.classList.add('collapsed'));
    document.querySelectorAll('.pc-card-header').forEach(h => h.classList.remove('open'));
    
    if (!isOpen) {
        body.classList.remove('collapsed');
        header.classList.add('open');
    }
}

let cvIdx = {{ count($coreValues) }};
function addCoreValue() {
    const r = document.getElementById('coreValuesRepeater');
    r.insertAdjacentHTML('beforeend', `
      <div class="repeater-row">
        <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
        <div class="form-row">
          <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_core_values[${cvIdx}][icon]" placeholder="fa-solid fa-star"></div>
          <div class="form-group"><label>Title</label><input type="text" name="about_core_values[${cvIdx}][title]"></div>
        </div>
        <div class="form-group"><label>Description</label><textarea name="about_core_values[${cvIdx}][description]" rows="2"></textarea></div>
      </div>`);
    cvIdx++;
}

let facIdx = {{ count($facilities) }};
function addFacility() {
    const r = document.getElementById('facilitiesRepeater');
    r.insertAdjacentHTML('beforeend', `
      <div class="repeater-row">
        <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
        <div class="form-row">
          <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_facilities[${facIdx}][icon]" placeholder="fa-solid fa-desktop"></div>
          <div class="form-group"><label>Name</label><input type="text" name="about_facilities[${facIdx}][name]"></div>
        </div>
        <div class="form-group"><label>Description</label><textarea name="about_facilities[${facIdx}][description]" rows="2"></textarea></div>
      </div>`);
    facIdx++;
}

let reqIdx = {{ count($requirements) }};
function addReq() {
    const r = document.getElementById('reqRepeater');
    r.insertAdjacentHTML('beforeend', `
        <div class="repeater-row">
            <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
            <div class="form-row">
                <div class="form-group"><label>Level</label><input type="text" name="about_requirements[${reqIdx}][level]"></div>
                <div class="form-group"><label>Icon (FA class)</label><input type="text" name="about_requirements[${reqIdx}][icon]" value="fa-school"></div>
            </div>
            <div class="form-group"><label>Requirement Description</label><input type="text" name="about_requirements[${reqIdx}][desc]"></div>
        </div>
    `);
    reqIdx++;
}

let progIdx = {{ count($programmes) }};
function addProg() {
    const r = document.getElementById('progRepeater');
    r.insertAdjacentHTML('beforeend', `
        <div class="repeater-row">
            <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
            <div class="form-row">
                <div class="form-group"><label>Category Name</label><input type="text" name="about_programmes[${progIdx}][title]"></div>
                <div class="form-group"><label>Icon (FA)</label><input type="text" name="about_programmes[${progIdx}][icon]" value="fa-hat-wizard"></div>
                <div class="form-group"><label>Theme Color Class</label>
                    <select name="about_programmes[${progIdx}][theme]">
                        <option value="dark">Dark (Navy)</option>
                        <option value="light">Light (Green)</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>List of Degrees/Programmes (One per line)</label>
                <textarea name="about_programmes[${progIdx}][items]" rows="4"></textarea>
            </div>
        </div>
    `);
    progIdx++;
}

let boardIdx = {{ count($boardMembers) }};
function addBoard() {
    const r = document.getElementById('boardRepeater');
    r.insertAdjacentHTML('beforeend', `
        <div class="repeater-row">
            <button type="button" class="remove-btn" onclick="this.closest('.repeater-row').remove()"><i class="fa-solid fa-xmark"></i></button>
            <div class="form-row">
                <div class="form-group"><label>Title/Group Name</label><input type="text" name="about_board[${boardIdx}][title]"></div>
                <div class="form-group"><label>Who</label><input type="text" name="about_board[${boardIdx}][who]"></div>
                <div class="form-group"><label>Icon (FA)</label><input type="text" name="about_board[${boardIdx}][icon]" value="fa-users"></div>
            </div>
        </div>
    `);
    boardIdx++;
}
</script>
@endsection
BLADE;

file_put_contents('C:/xampp/htdocs/p/dcms/resources/views/admin/page-content/about.blade.php', $str);
echo "Successfully fully built and cleaned the admin file.";
