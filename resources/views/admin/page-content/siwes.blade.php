@extends($adminLayout ?? 'layouts.admin')
@section('title', 'SIWES Page Content')
@section('header', 'SIWES Information Editor')

@section('content')
@php
    $s = fn(string $key, string $default = '') => $settings[$key] ?? $default;
    
    $faqs = json_decode($s('siwes_faqs', '[]'), true) ?? [];
    if (empty($faqs)) {
        $faqs = [
            ['q' => 'When do I go for SIWES?', 'a' => 'Students typically proceed for SIWES during the second semester of their 300 Level.'],
            ['q' => 'How long does SIWES last?', 'a' => 'The program lasts for exactly 6 months depending on the university calendar.']
        ];
    }
    
    $steps = json_decode($s('siwes_steps', '[]'), true) ?? [];
    if(empty($steps)) {
        $steps = [
            ['title' => 'Secure Placement', 'desc' => 'Find an IT firm and submit your placement letter.'],
            ['title' => 'Department Clearance', 'desc' => 'Get clearance from the SIWES coordinator.']
        ];
    }
@endphp

<div class="card p-4">
    <form action="{{ route('admin.page-content.update', 'siwes') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3 class="font-bold text-lg mb-3">General Information</h3>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">SIWES Overview / Introduction</label>
            <textarea name="siwes_overview" rows="4" class="form-input w-full rounded border-gray-300">{{ $s('siwes_overview', 'The Student Industrial Work Experience Scheme (SIWES) is designed to give students practical experience...') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label class="block text-sm font-bold mb-1">Coordinator Name</label>
                <input type="text" name="siwes_coordinator_name" value="{{ $s('siwes_coordinator_name') }}" class="form-input w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Coordinator Email</label>
                <input type="email" name="siwes_coordinator_email" value="{{ $s('siwes_coordinator_email') }}" class="form-input w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Consultation Hours</label>
                <input type="text" name="siwes_coordinator_hours" value="{{ $s('siwes_coordinator_hours', 'Mon-Wed 10am-12pm') }}" class="form-input w-full rounded border-gray-300">
            </div>
        </div>

        <!-- Add JSON handling in JS so we can use simple hidden inputs -->
        
        <h3 class="font-bold text-lg mb-3 mt-6 border-t pt-4">Process Workflow (Steps)</h3>
        <p class="text-xs text-gray-500 mb-2">Define the step-by-step process for the students.</p>
        <div id="steps-container" class="space-y-4">
            @foreach($steps as $i => $step)
            <div class="flex gap-2 step-item bg-gray-50 p-3 rounded">
                <input type="text" class="step-title form-input w-1/3 rounded" value="{{ $step['title'] }}" placeholder="Step Title">
                <input type="text" class="step-desc form-input w-2/3 rounded" value="{{ $step['desc'] }}" placeholder="Description">
                <button type="button" class="btn btn-sm bg-red-100 text-red-600 px-3 rounded" onclick="this.parentElement.remove()">X</button>
            </div>
            @endforeach
        </div>
        <button type="button" class="mt-2 btn btn-sm bg-blue-100 text-blue-700 px-3 py-1 rounded" onclick="addStep()">+ Add Step</button>
        <input type="hidden" name="siwes_steps" id="siwes_steps_input">
        
        <h3 class="font-bold text-lg mb-3 mt-6 border-t pt-4">FAQs</h3>
        <div id="faqs-container" class="space-y-4">
            @foreach($faqs as $i => $faq)
            <div class="flex gap-2 faq-item bg-gray-50 p-3 rounded">
                <input type="text" class="faq-q form-input w-1/3 rounded" value="{{ $faq['q'] }}" placeholder="Question">
                <input type="text" class="faq-a form-input w-2/3 rounded" value="{{ $faq['a'] }}" placeholder="Answer">
                <button type="button" class="btn btn-sm bg-red-100 text-red-600 px-3 rounded" onclick="this.parentElement.remove()">X</button>
            </div>
            @endforeach
        </div>
        <button type="button" class="mt-2 btn btn-sm bg-blue-100 text-blue-700 px-3 py-1 rounded" onclick="addFaq()">+ Add FAQ</button>
        <input type="hidden" name="siwes_faqs" id="siwes_faqs_input">


        <div class="mt-8">
            <button type="submit" onclick="prepSubmit()" class="bg-blue-600 text-white px-5 py-2 rounded shadow font-bold hover:bg-blue-700 transition">Save SIWES Setup</button>
        </div>
    </form>
</div>

<script>
    function addStep() {
        const c = document.getElementById('steps-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2 step-item bg-gray-50 p-3 rounded';
        div.innerHTML = `<input type="text" class="step-title form-input w-1/3 rounded" placeholder="Step Title">
                         <input type="text" class="step-desc form-input w-2/3 rounded" placeholder="Description">
                         <button type="button" class="btn btn-sm bg-red-100 text-red-600 px-3 rounded" onclick="this.parentElement.remove()">X</button>`;
        c.appendChild(div);
    }
    function addFaq() {
        const c = document.getElementById('faqs-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2 faq-item bg-gray-50 p-3 rounded';
        div.innerHTML = `<input type="text" class="faq-q form-input w-1/3 rounded" placeholder="Question">
                         <input type="text" class="faq-a form-input w-2/3 rounded" placeholder="Answer">
                         <button type="button" class="btn btn-sm bg-red-100 text-red-600 px-3 rounded" onclick="this.parentElement.remove()">X</button>`;
        c.appendChild(div);
    }
    
    function prepSubmit() {
        const steps = [];
        document.querySelectorAll('.step-item').forEach(el => {
            const title = el.querySelector('.step-title').value;
            const desc = el.querySelector('.step-desc').value;
            if(title) steps.push({title, desc});
        });
        document.getElementById('siwes_steps_input').value = JSON.stringify(steps);
        
        const faqs = [];
        document.querySelectorAll('.faq-item').forEach(el => {
            const q = el.querySelector('.faq-q').value;
            const a = el.querySelector('.faq-a').value;
            if(q) faqs.push({q, a});
        });
        document.getElementById('siwes_faqs_input').value = JSON.stringify(faqs);
    }
</script>

@endsection

