<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$newContent = <<<HTML
<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6">
    
    <div class="text-center mb-16" data-aos="fade-up">
        <span class="bg-emerald-100 text-emerald-800 text-sm font-bold px-4 py-1.5 rounded-full uppercase tracking-wide">2025/2026 Session</span>
        <h2 class="mt-4 text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Academic Timeline</h2>
        <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">Your complete roadmap to the academic year's milestones, examinations, and departmental activities.</p>
    </div>

    <!-- First Semester Timeline -->
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-10" data-aos="fade-right">
            <div class="h-px bg-emerald-300 flex-1"></div>
            <h3 class="text-3xl font-bold text-emerald-700 flex items-center gap-3 m-0"><i class="fa-solid fa-leaf"></i> First Semester</h3>
            <div class="h-px bg-emerald-300 flex-1"></div>
        </div>

        <div class="relative border-l-4 border-emerald-200 ml-4 md:ml-8 space-y-12">
            <!-- Item 1 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="50">
                <div class="absolute w-10 h-10 bg-emerald-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-door-open text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-50 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md inline-block w-fit">MON, OCT 2 - OCT 9</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> WEEKS 1-2</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Resumption & Registration</h4>
                    <p class="text-gray-600 m-0">Freshmen (100L) resume and commence registration on October 2nd. Returning students arrive the following week, marking the official commencement of lectures for all levels.</p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute w-10 h-10 bg-emerald-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-users text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-50 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md inline-block w-fit">WED, NOV 15</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> WEEK 7</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Matriculation & Orientation</h4>
                    <p class="text-gray-600 m-0">The Departmental Freshers Orientation program takes place to welcome new intakes, followed by the official University Matriculation ceremony.</p>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="150">
                <div class="absolute w-10 h-10 bg-emerald-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-snowflake text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-50 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md inline-block w-fit">DEC 15 - JAN 2</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> HOLIDAY</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">End of Year Break</h4>
                    <p class="text-gray-600 m-0">Academic activities are paused for the end-of-year festive break. Students vacate the hostels and are expected to resume promptly in January.</p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute w-10 h-10 bg-red-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-pen-to-square text-white text-sm"></i>
                </div>
                <div class="bg-red-50 rounded-2xl p-6 shadow-[0_4px_15px_-4px_rgba(239,68,68,0.2)] border border-red-100 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-red-600 bg-red-100 px-3 py-1 rounded-md inline-block w-fit">FEB 12 - MAR 1</span>
                        <span class="text-red-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> EXAMS</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">First Semester Examinations</h4>
                    <p class="text-gray-700 m-0">Commencement and conclusion of the First Semester examinations for all academic levels.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Semester Timeline -->
    <div class="mb-10">
        <div class="flex items-center gap-4 mb-10" data-aos="fade-right">
            <div class="h-px bg-indigo-300 flex-1"></div>
            <h3 class="text-3xl font-bold text-indigo-700 flex items-center gap-3 m-0"><i class="fa-solid fa-sun"></i> Second Semester</h3>
            <div class="h-px bg-indigo-300 flex-1"></div>
        </div>

        <div class="relative border-l-4 border-indigo-200 ml-4 md:ml-8 space-y-12">
            <!-- Item 1 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="50">
                <div class="absolute w-10 h-10 bg-indigo-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-book-open text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-50 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-md inline-block w-fit">MON, MAR 18</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> WEEK 1</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Second Semester Begins</h4>
                    <p class="text-gray-600 m-0">Immediate resumption and commencement of Second Semester lectures following the short break after First Semester examinations.</p>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute w-10 h-10 bg-indigo-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-laptop-code text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-50 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-md inline-block w-fit">MON, MAY 20</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> EVENTS</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Departmental Week (NACOS)</h4>
                    <p class="text-gray-600 m-0">A week dedicated to symposiums, tech exhibitions, hackathons, and social events organized by the Nigerian Association of Computer Science Students (NACOS) chapter.</p>
                </div>
            </div>

             <!-- Item 3 -->
             <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="150">
                <div class="absolute w-10 h-10 bg-indigo-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-graduation-cap text-white text-sm"></i>
                </div>
                <div class="bg-indigo-50 rounded-2xl p-6 shadow-[0_4px_15px_-4px_rgba(99,102,241,0.2)] border border-indigo-100 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-indigo-700 bg-indigo-100 px-3 py-1 rounded-md inline-block w-fit">WED, JUN 12</span>
                        <span class="text-indigo-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> ACADEMICS</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Final Year Project Defense</h4>
                    <p class="text-gray-700 m-0">Graduating students (400L) present and defend their final year software or research projects before the academic board.</p>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="relative pl-8 md:pl-12" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute w-10 h-10 bg-red-500 rounded-full -left-[22px] top-0 flex items-center justify-center border-4 border-white shadow-md">
                    <i class="fa-solid fa-pen-to-square text-white text-sm"></i>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-50 hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
                        <span class="text-sm font-bold text-red-600 bg-red-50 px-3 py-1 rounded-md inline-block w-fit">JUN 24 - JUL 12</span>
                        <span class="text-gray-400 text-xs font-semibold tracking-wider"><i class="fa-regular fa-calendar"></i> EXAMS & CLOSURE</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Second Semester Exams & End of Session</h4>
                    <p class="text-gray-600 m-0">Final examinations for the session conclude on July 12th, officially marking the end of the academic year.</p>
                </div>
            </div>
        </div>
    </div>

</div>
HTML;

$page = \App\Models\Page::where('slug', 'academic-calendar')->first();
if ($page) {
    $page->content = $newContent;
    $page->save();
    echo "academic-calendar entirely rebuilt as a timeline!";
}
