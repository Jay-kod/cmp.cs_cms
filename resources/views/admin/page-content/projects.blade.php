@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Projects Page Content')
@section('header', 'Final Year Projects Setup')

@section('content')
<div class="card bg-white p-6 shadow-sm rounded-lg border border-gray-200 mx-auto" style="max-width: 900px;">
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    $milestones = json_decode($s('project_milestones', '[]'), true) ?? [];
    if (empty($milestones)) {
        $milestones = [
            ['title' => 'Topic Submission', 'date' => 'Oct 15', 'desc' => 'Submit 3 proposed project topics.'],
            ['title' => 'Proposal Defense', 'date' => 'Nov 12', 'desc' => 'Defend Chapter 1 and get approval.']
        ];
    }
    
    $rules = json_decode($s('project_rules', '[]'), true) ?? [];
    if(empty($rules)) {
        $rules = [
            ['title' => 'Topic Selection Rules', 'desc' => "Topics must be original. Do not copy existing departmental projects. It must map to a current societal or educational problem."],
            ['title' => 'Formatting & Typing', 'desc' => "Times New Roman, Size 12. 1.5 line spacing. Margins: 1.5 inches left, 1 inch top, bottom, and right."]
        ];
    }
@endphp

    <form action="{{ route('admin.page-content.update', 'projects') }}" method="POST" enctype="multipart/form-data" onsubmit="prepSubmit()">
        @csrf

        <h3 class="font-bold text-xl mb-4 border-b pb-2">Course Overview & Coordinator</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-bold mb-1">Project Coordinator Name</label>
                <input type="text" name="project_coordinator_name" value="{{ $s('project_coordinator_name', '') }}" class="form-input w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Course Code (e.g. CMP 499)</label>
                <input type="text" name="project_course_code" value="{{ $s('project_course_code', 'CMP 499') }}" class="form-input w-full rounded border-gray-300">
            </div>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-bold mb-1">General Project Overview</label>
            <textarea name="project_overview" rows="4" class="form-input w-full rounded border-gray-300">{{ $s('project_overview', 'The final year project is a mandatory 6-unit course where students are expected to solve real-world computing problems...') }}</textarea>
        </div>


        <h3 class="font-bold text-xl mb-3 mt-8 border-b pb-2">Guidelines & Rulebook</h3>
        <p class="text-sm text-gray-500 mb-4 pt-1">Rules regarding formatting, binding, referencing, topic selection, etc.</p>
        
        <div id="rules-container" class="space-y-4 pt-2">
            @foreach($rules as $i => $rule)
            <div class="flex flex-col md:flex-row gap-3 rule-item bg-gray-50 p-4 rounded border border-gray-200 items-start">
                <div class="w-full md:w-1/4">
                    <label class="text-xs font-bold mb-1 block">Rule Subheading</label>
                    <input type="text" class="rule-title form-input w-full rounded border-gray-300 font-semibold" value="{{ $rule['title'] ?? '' }}" placeholder="E.g., Formatting">
                </div>
                <div class="w-full md:w-3/4 flex gap-3">
                    <div class="flex-grow">
                        <label class="text-xs font-bold mb-1 block">Details (Can use basic HTML)</label>
                        <textarea class="rule-desc form-input w-full rounded border-gray-300" rows="3" placeholder="Description">{{ $rule['desc'] ?? '' }}</textarea>
                    </div>
                    <div class="pt-6">
                        <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition" onclick="this.closest('.rule-item').remove()">X</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 px-4 py-2 text-sm rounded font-bold transition" onclick="addRule()">+ Add Guideline Section</button>
        </div>
        <input type="hidden" name="project_rules" id="project_rules_input">
        

        <h3 class="font-bold text-xl mb-3 mt-10 border-b pb-2">Key Deadlines & Milestones</h3>
        <div id="milestones-container" class="space-y-4 pt-2">
            @foreach($milestones as $i => $m)
            <div class="flex flex-col md:flex-row gap-3 milestone-item bg-gray-50 p-4 rounded border border-gray-200 items-start">
                <div class="w-full md:w-1/4 border-b md:border-b-0 md:border-r border-gray-200 md:pr-3 mb-2 md:mb-0">
                    <label class="text-xs font-bold mb-1 block">Title / Phase</label>
                    <input type="text" class="m-title form-input w-full rounded border-gray-300 font-semibold" value="{{ $m['title'] ?? '' }}" placeholder="Chapter 1 Defense">
                    
                    <label class="text-xs font-bold mb-1 block mt-2">Deadline Date</label>
                    <input type="text" class="m-date form-input w-full rounded border-gray-300 text-sm" value="{{ $m['date'] ?? '' }}" placeholder="E.g., Nov 12th">
                </div>
                <div class="w-full md:w-2/3 flex gap-3">
                    <div class="flex-grow">
                        <label class="text-xs font-bold mb-1 block">Description</label>
                        <textarea class="m-desc form-input w-full rounded border-gray-300" rows="3" placeholder="What to submit...">{{ $m['desc'] ?? '' }}</textarea>
                    </div>
                    <div class="pt-6 border-l pl-3 ml-1 flex items-center">
                        <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition flex-shrink-0" onclick="this.closest('.milestone-item').remove()">X</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 px-4 py-2 text-sm rounded font-bold transition" onclick="addMilestone()">+ Add Milestone</button>
        </div>
        <input type="hidden" name="project_milestones" id="project_milestones_input">

        <!-- Informing the admin about templates -->
        <div class="mt-10 bg-blue-50 text-blue-800 p-4 rounded border border-blue-200 text-sm">
            <h4 class="font-bold flex items-center gap-2 mb-1"><i class="fa-solid fa-circle-info"></i> Project Templates & Downloads</h4>
            <p>To add downloadable templates (like standard cover pages or approval forms), please upload them in the <a href="{{ route('admin.resources.index') }}" class="font-bold underline hover:text-blue-900">Resources Catalog</a> under a "Project Guides" or "Templates" category.</p>
        </div>

        <div class="mt-8 pt-6 border-t flex justify-end">
            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-8 py-3 rounded shadow font-bold text-lg transition">Save Timetable & Rules</button>
        </div>
    </form>
</div>

<script>
    function addRule() {
        const c = document.getElementById('rules-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col md:flex-row gap-3 rule-item bg-gray-50 p-4 rounded border border-gray-200 items-start';
        div.innerHTML = `
            <div class="w-full md:w-1/4">
                <label class="text-xs font-bold mb-1 block">Rule Subheading</label>
                <input type="text" class="rule-title form-input w-full rounded border-gray-300 font-semibold" placeholder="E.g., Formatting">
            </div>
            <div class="w-full md:w-3/4 flex gap-3">
                <div class="flex-grow">
                    <label class="text-xs font-bold mb-1 block">Details (Can use basic HTML)</label>
                    <textarea class="rule-desc form-input w-full rounded border-gray-300" rows="3" placeholder="Description"></textarea>
                </div>
                <div class="pt-6">
                    <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition" onclick="this.closest('.rule-item').remove()">X</button>
                </div>
            </div>`;
        c.appendChild(div);
    }
    
    function addMilestone() {
        const c = document.getElementById('milestones-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col md:flex-row gap-3 milestone-item bg-gray-50 p-4 rounded border border-gray-200 items-start';
        div.innerHTML = `
            <div class="w-full md:w-1/4 border-b md:border-b-0 md:border-r border-gray-200 md:pr-3 mb-2 md:mb-0">
                <label class="text-xs font-bold mb-1 block">Title / Phase</label>
                <input type="text" class="m-title form-input w-full rounded border-gray-300 font-semibold" placeholder="Chapter 1 Defense">
                
                <label class="text-xs font-bold mb-1 block mt-2">Deadline Date</label>
                <input type="text" class="m-date form-input w-full rounded border-gray-300 text-sm" placeholder="E.g., Nov 12th">
            </div>
            <div class="w-full md:w-2/3 flex gap-3">
                <div class="flex-grow">
                    <label class="text-xs font-bold mb-1 block">Description</label>
                    <textarea class="m-desc form-input w-full rounded border-gray-300" rows="3" placeholder="What to submit..."></textarea>
                </div>
                <div class="pt-6 border-l pl-3 ml-1 flex items-center">
                    <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition flex-shrink-0" onclick="this.closest('.milestone-item').remove()">X</button>
                </div>
            </div>`;
        c.appendChild(div);
    }
    
    function prepSubmit() {
        const rules = [];
        document.querySelectorAll('.rule-item').forEach(el => {
            const title = el.querySelector('.rule-title').value;
            const desc = el.querySelector('.rule-desc').value;
            if(title) rules.push({title, desc});
        });
        document.getElementById('project_rules_input').value = JSON.stringify(rules);
        
        const miles = [];
        document.querySelectorAll('.milestone-item').forEach(el => {
            const title = el.querySelector('.m-title').value;
            const date = el.querySelector('.m-date').value;
            const desc = el.querySelector('.m-desc').value;
            if(title) miles.push({title, date, desc});
        });
        document.getElementById('project_milestones_input').value = JSON.stringify(miles);
    }
</script>

@endsection
