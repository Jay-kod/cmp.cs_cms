<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$newContent = <<<HTML
<div class="calendar-wrapper max-w-4xl mx-auto py-8">
    <div class="text-center mb-10" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Official Academic Calendar 2025/2026</h2>
        <p class="text-lg text-gray-600">Important dates, registration periods, lectures, and examination schedules for the academic session.</p>
    </div>

    <!-- First Semester Section -->
    <div class="mb-12 shadow-lg rounded-xl overflow-hidden bg-white border border-gray-100" data-aos="fade-up" data-aos-delay="100">
        <div class="bg-emerald-600 text-white px-6 py-4 flex items-center justify-between">
            <h3 class="text-xl font-bold m-0"><i class="fa-solid fa-calendar-day mr-2"></i> First Semester</h3>
            <span class="bg-emerald-800 text-sm py-1 px-3 rounded-full font-semibold">15 Weeks</span>
        </div>
        
        <div class="p-0 overflow-x-auto">
            <table class="min-w-full w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">Date</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-3/4">Event / Activity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-emerald-600 whitespace-nowrap">Mon, Oct 2nd</td>
                        <td class="py-4 px-6 text-sm text-gray-700">Resumption of 100L Students & Commencement of Registration</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-emerald-600 whitespace-nowrap">Mon, Oct 9th</td>
                        <td class="py-4 px-6 text-sm text-gray-700">Resumption of Returning Students / Lectures Begin for 100L</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150 bg-green-50">
                        <td class="py-4 px-6 text-sm font-medium text-emerald-600 whitespace-nowrap">Wed, Nov 15th</td>
                        <td class="py-4 px-6 text-sm text-gray-800 font-medium"><i class="fa-solid fa-users mr-1 text-emerald-500"></i> Departmental Freshers Orientation & Matriculation</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-emerald-600 whitespace-nowrap">Fri, Dec 15th</td>
                        <td class="py-4 px-6 text-sm text-gray-700">End of Year Break Begins</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-emerald-600 whitespace-nowrap">Tue, Jan 2nd</td>
                        <td class="py-4 px-6 text-sm text-gray-700">Resumption from Break & Continuation of Lectures</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150 bg-red-50">
                        <td class="py-4 px-6 text-sm font-medium text-red-600 whitespace-nowrap">Mon, Feb 12th</td>
                        <td class="py-4 px-6 text-sm text-gray-800 font-medium"><i class="fa-solid fa-pen-to-square mr-1 text-red-500"></i> First Semester Examinations Begin</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-emerald-600 whitespace-nowrap">Fri, Mar 1st</td>
                        <td class="py-4 px-6 text-sm text-gray-700">End of First Semester Examinations</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Second Semester Section -->
    <div class="shadow-lg rounded-xl overflow-hidden bg-white border border-gray-100" data-aos="fade-up" data-aos-delay="200">
        <div class="bg-indigo-600 text-white px-6 py-4 flex items-center justify-between">
            <h3 class="text-xl font-bold m-0"><i class="fa-solid fa-calendar-week mr-2"></i> Second Semester</h3>
            <span class="bg-indigo-800 text-sm py-1 px-3 rounded-full font-semibold">14 Weeks</span>
        </div>
        
        <div class="p-0 overflow-x-auto">
            <table class="min-w-full w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-1/4">Date</th>
                        <th class="py-3 px-6 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-3/4">Event / Activity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-indigo-600 whitespace-nowrap">Mon, Mar 18th</td>
                        <td class="py-4 px-6 text-sm text-gray-700">Resumption & Commencement of Second Semester Lectures</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-indigo-600 whitespace-nowrap">Mon, May 20th</td>
                        <td class="py-4 px-6 text-sm text-gray-700">Departmental Week (NACOS Week)</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150 bg-blue-50">
                        <td class="py-4 px-6 text-sm font-medium text-indigo-600 whitespace-nowrap">Wed, Jun 12th</td>
                        <td class="py-4 px-6 text-sm text-gray-800 font-medium"><i class="fa-solid fa-code mr-1 text-indigo-500"></i> Final Year Project Defense</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150 bg-red-50">
                        <td class="py-4 px-6 text-sm font-medium text-red-600 whitespace-nowrap">Mon, Jun 24th</td>
                        <td class="py-4 px-6 text-sm text-gray-800 font-medium"><i class="fa-solid fa-pen-to-square mr-1 text-red-500"></i> Second Semester Examinations Begin</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-4 px-6 text-sm font-medium text-indigo-600 whitespace-nowrap">Fri, Jul 12th</td>
                        <td class="py-4 px-6 text-sm text-gray-700">End of Academic Session</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Additional Info Note -->
    <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-md" data-aos="fade-up" data-aos-delay="300">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Notice to all Students & Staff</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>
                        These dates are subject to change as approved by the University Senate. The Department will issue internal memos if there are any departmental specific extensions or variations to the central calendar. Keep checking the News section for real-time announcements.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Scoped css overrides if needed */
.calendar-wrapper { font-family: 'Inter', system-ui, sans-serif; }
</style>
HTML;

$page = \App\Models\Page::where('slug', 'academic-calendar')->first();
if ($page) {
    // If you need to keep previous logic, usually you update page.
    $page->content = $newContent;
    $page->save();
    echo "academic-calendar saved.";
} else {
    echo "academic-calendar not found.";
}
