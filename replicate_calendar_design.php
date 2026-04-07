<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$newContent = <<<HTML
<div class="max-w-4xl mx-auto my-4 font-sans">
    <h2 class="text-2xl md:text-3xl font-bold text-center text-emerald-600 mb-2">Official Academic Calendar 2025/2026</h2>
    <p class="text-center text-gray-600 mb-10">Important dates, registration periods, lectures, and examination schedules for the academic session.</p>

    <!-- First Semester -->
    <div class="mb-10 p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
        <h3 class="text-[1.1rem] font-bold text-gray-800 mb-4 flex items-center gap-2 font-sans m-0">
            <i class="fa-solid fa-calendar-day"></i> First Semester
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse m-0">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50 rounded-tl-lg">Date</th>
                        <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50 rounded-tr-lg">Event / Activity</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Mon, Oct 2nd</td>
                        <td class="py-4 px-4 text-gray-600">Resumption of 100L Students & Commencement of Registration</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Mon, Oct 9th</td>
                        <td class="py-4 px-4 text-gray-600">Resumption of Returning Students / Lectures Begin for 100L</td>
                    </tr>
                    <tr class="border-b border-gray-100 bg-emerald-50 bg-opacity-40">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Wed, Nov 15th</td>
                        <td class="py-4 px-4 text-gray-800"><i class="fa-solid fa-users text-emerald-600 w-5"></i> Departmental Freshers Orientation & Matriculation</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Fri, Dec 15th</td>
                        <td class="py-4 px-4 text-gray-600">End of Year Break Begins</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Tue, Jan 2nd</td>
                        <td class="py-4 px-4 text-gray-600">Resumption from Break & Continuation of Lectures</td>
                    </tr>
                    <tr class="border-b border-red-100 bg-red-50 bg-opacity-40">
                        <td class="py-4 px-4 font-medium text-red-600 whitespace-nowrap">Mon, Feb 12th</td>
                        <td class="py-4 px-4 text-gray-900 font-medium"><i class="fa-regular fa-pen-to-square text-red-500 w-5"></i> First Semester Examinations Begin</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Fri, Mar 1st</td>
                        <td class="py-4 px-4 text-gray-600">End of First Semester Examinations</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Second Semester -->
    <div class="mb-10 p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
        <h3 class="text-[1.1rem] font-bold text-gray-800 mb-4 flex items-center gap-2 font-sans m-0">
            <i class="fa-solid fa-calendar-day"></i> Second Semester
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse m-0">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50 rounded-tl-lg">Date</th>
                        <th class="py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wide bg-gray-50 rounded-tr-lg">Event / Activity</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Mon, Mar 18th</td>
                        <td class="py-4 px-4 text-gray-600">Resumption & Commencement of Second Semester Lectures</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Mon, May 20th</td>
                        <td class="py-4 px-4 text-gray-600">Departmental Week (NACOS Week)</td>
                    </tr>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Wed, Jun 12th</td>
                        <td class="py-4 px-4 text-gray-800"><i class="fa-solid fa-code text-gray-500 w-5"></i> Final Year Project Defense</td>
                    </tr>
                    <tr class="border-b border-red-100 bg-red-50 bg-opacity-40">
                        <td class="py-4 px-4 font-medium text-red-600 whitespace-nowrap">Mon, Jun 24th</td>
                        <td class="py-4 px-4 text-gray-900 font-medium"><i class="fa-regular fa-pen-to-square text-red-500 w-5"></i> Second Semester Examinations Begin</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-4 font-medium text-gray-800 whitespace-nowrap">Fri, Jul 12th</td>
                        <td class="py-4 px-4 text-gray-600">End of Academic Session</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info box -->
    <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 flex gap-4 mt-8">
        <div class="text-gray-700 mt-1"><i class="fa-solid fa-circle-info text-[1.2rem]"></i></div>
        <div>
            <h4 class="font-bold text-gray-800 text-[0.95rem] mb-1 font-sans mt-0">Notice to all Students & Staff</h4>
            <p class="text-[0.85rem] text-gray-600 m-0 leading-relaxed font-sans">These dates are subject to change as approved by the University Senate. The Department will issue internal memos if there are any departmental specific extensions or variations to the central calendar. Keep checking the News section for real-time announcements.</p>
        </div>
    </div>
</div>
HTML;

$page = \App\Models\Page::where('slug', 'academic-calendar')->first();
if ($page) {
    $page->content = $newContent;
    $page->save();
    echo "Calendar design reverted to exact match.";
}
