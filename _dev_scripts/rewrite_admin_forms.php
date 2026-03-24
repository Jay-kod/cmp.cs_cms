<?php
$file = 'C:/xampp/htdocs/p/dcms/resources/views/admin/page-content/about.blade.php';
$content = file_get_contents($file);

$startStr = '{{-- ── ACADEMIC PROGRAMMES ── --}}';
$endStr = '<div style="display: flex; justify-content: flex-end; gap: 1rem;">';

$startPos = strpos($content, $startStr);
$endPos = strpos($content, $endStr);

if ($startPos !== false && $endPos !== false) {
    echo "Found sections, replacing...\n";
    $pre = substr($content, 0, $startPos);
    $post = substr($content, $endPos);

    $newSections = <<<'HTML'
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
            <textarea name="about_board_desc" rows="3">{{ $s('about_board_desc', 'The Departmental Board is made up of all lecturers...') }}</textarea>
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

HTML;

    file_put_contents($file, $pre . $newSections . "\n" . $post);
}

// Now add JS logic to <script>
$scriptContent = <<<'JS'
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
JS;

$content2 = file_get_contents($file);
if (strpos($content2, 'addProg()') === false) {
    echo "Adding JS functions... ";
    $scriptPos = strpos($content2, '</script>');
    if ($scriptPos !== false) {
        $content2 = substr_replace($content2, $scriptContent . "\n", $scriptPos, 0);
        file_put_contents($file, $content2);
        echo "Done.\n";
    }
}
