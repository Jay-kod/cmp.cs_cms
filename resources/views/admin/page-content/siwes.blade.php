@extends($adminLayout ?? 'layouts.admin')
@section('title', 'SIWES Page Content')
@section('header', 'SIWES Information Editor')

@section('content')
<div class="card bg-white p-6 shadow-sm rounded-lg border border-gray-200" style="max-width: 900px;">
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

    <form action="{{ route('admin.page-content.update', 'siwes') }}" method="POST" enctype="multipart/form-data" onsubmit="prepSubmit()">
        @csrf

        <h3 class="font-bold text-xl mb-4 border-b pb-2">General Information</h3>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-1">SIWES Overview / Introduction</label>
            <textarea name="siwes_overview" rows="4" class="form-input w-full rounded border-gray-300">{{ $s('siwes_overview', 'The Student Industrial Work Experience Scheme (SIWES) is designed to give students practical experience...') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div>
                <label class="block text-sm font-bold mb-1">Coordinator Name</label>
                <input type="text" name="siwes_coordinator_name" value="{{ $s('siwes_coordinator_name', 'Dr. John Doe') }}" class="form-input w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Coordinator Email</label>
                <input type="email" name="siwes_coordinator_email" value="{{ $s('siwes_coordinator_email', 'siwes@dept.edu.ng') }}" class="form-input w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-bold mb-1">Consultation Hours</label>
                <input type="text" name="siwes_coordinator_hours" value="{{ $s('siwes_coordinator_hours', 'Mon-Wed 10am-12pm') }}" class="form-input w-full rounded border-gray-300">
            </div>
        </div>

        
        <h3 class="font-bold text-xl mb-3 mt-8 border-b pb-2">Workflow & Process Setup</h3>
        <p class="text-sm text-gray-500 mb-4 pt-1">Define the step-by-step process for students preparing for SIWES.</p>
        
        <div id="steps-container" class="space-y-4 pt-2">
            @foreach($steps as $i => $step)
            <div class="flex flex-col md:flex-row gap-3 step-item bg-gray-50 p-4 rounded border border-gray-200 items-start">
                <div class="w-full md:w-1/4">
                    <label class="text-xs font-bold mb-1 block">Title</label>
                    <input type="text" class="step-title form-input w-full rounded border-gray-300" value="{{ $step['title'] ?? '' }}" placeholder="Step Title">
                </div>
                <div class="w-full md:w-3/4 flex gap-3">
                    <div class="flex-grow">
                        <label class="text-xs font-bold mb-1 block">Description</label>
                        <input type="text" class="step-desc form-input w-full rounded border-gray-300" value="{{ $step['desc'] ?? '' }}" placeholder="Description">
                    </div>
                    <div class="pt-6">
                        <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition" onclick="this.closest('.step-item').remove()">X</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 px-4 py-2 text-sm rounded font-bold transition" onclick="addStep()">+ Add Process Step</button>
        </div>
        <input type="hidden" name="siwes_steps" id="siwes_steps_input">
        
        <h3 class="font-bold text-xl mb-3 mt-10 border-b pb-2">Frequently Asked Questions (FAQs)</h3>
        
        <div id="faqs-container" class="space-y-4 pt-2">
            @foreach($faqs as $i => $faq)
            <div class="flex flex-col md:flex-row gap-3 faq-item bg-gray-50 p-4 rounded border border-gray-200 items-start">
                <div class="w-full md:w-1/3 border-b md:border-b-0 md:border-r border-gray-200 md:pr-3 mb-2 md:mb-0">
                    <label class="text-xs font-bold mb-1 block">Question</label>
                    <input type="text" class="faq-q form-input w-full rounded border-gray-300" value="{{ $faq['q'] ?? '' }}" placeholder="Question">
                </div>
                <div class="w-full md:w-2/3 flex gap-3">
                    <div class="flex-grow">
                        <label class="text-xs font-bold mb-1 block">Answer</label>
                        <textarea class="faq-a form-input w-full rounded border-gray-300" rows="1" placeholder="Answer">{{ $faq['a'] ?? '' }}</textarea>
                    </div>
                    <div class="pt-6">
                        <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition flex-shrink-0" onclick="this.closest('.faq-item').remove()">X</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300 px-4 py-2 text-sm rounded font-bold transition" onclick="addFaq()">+ Add FAQ</button>
        </div>
        <input type="hidden" name="siwes_faqs" id="siwes_faqs_input">


        <div class="mt-10 pt-6 border-t flex justify-end">
            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-8 py-3 rounded shadow font-bold text-lg transition">Save SIWES Guide</button>
        </div>
    </form>
</div>

<script>
    function addStep() {
        const c = document.getElementById('steps-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col md:flex-row gap-3 step-item bg-gray-50 p-4 rounded border border-gray-200 items-start';
        div.innerHTML = `
            <div class="w-full md:w-1/4">
                <label class="text-xs font-bold mb-1 block">Title</label>
                <input type="text" class="step-title form-input w-full rounded border-gray-300" placeholder="Step Title">
            </div>
            <div class="w-full md:w-3/4 flex gap-3">
                <div class="flex-grow">
                    <label class="text-xs font-bold mb-1 block">Description</label>
                    <input type="text" class="step-desc form-input w-full rounded border-gray-300" placeholder="Description">
                </div>
                <div class="pt-6">
                    <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition" onclick="this.closest('.step-item').remove()">X</button>
                </div>
            </div>`;
        c.appendChild(div);
    }
    
    function addFaq() {
        const c = document.getElementById('faqs-container');
        const div = document.createElement('div');
        div.className = 'flex flex-col md:flex-row gap-3 faq-item bg-gray-50 p-4 rounded border border-gray-200 items-start';
        div.innerHTML = `
            <div class="w-full md:w-1/3 border-b md:border-b-0 md:border-r border-gray-200 md:pr-3 mb-2 md:mb-0">
                <label class="text-xs font-bold mb-1 block">Question</label>
                <input type="text" class="faq-q form-input w-full rounded border-gray-300" placeholder="Question">
            </div>
            <div class="w-full md:w-2/3 flex gap-3">
                <div class="flex-grow">
                    <label class="text-xs font-bold mb-1 block">Answer</label>
                    <textarea class="faq-a form-input w-full rounded border-gray-300" rows="1" placeholder="Answer"></textarea>
                </div>
                <div class="pt-6">
                    <button type="button" class="bg-red-100 hover:bg-red-200 text-red-600 px-3 py-2 rounded font-bold transition flex-shrink-0" onclick="this.closest('.faq-item').remove()">X</button>
                </div>
            </div>`;
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

