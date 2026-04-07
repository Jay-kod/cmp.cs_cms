<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$newContent = <<<HTML
<div class="calendar-timeline max-w-5xl mx-auto py-12 px-4 relative">
    <!-- Header -->
    <div class="text-center mb-16" data-aos="zoom-in">
        <span class="inline-block py-1 px-3 rounded-full bg-emerald-100 text-emerald-800 text-sm font-bold tracking-wider mb-4">2025 / 2026 ACADEMIC YEAR</span>
        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">Academic Timeline</h2>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto">Explore all required dates, periods, and examinations below. Keep this bookmarked to stay ahead.</p>
    </div>

    <!-- Timeline Wrapper -->
    <div class="relative">
        <!-- Central Line -->
        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-1 bg-gray-200 transform md:-translate-x-1/2 rounded"></div>

        <!-- Semester 1 Marker -->
        <div class="relative z-10 flex items-center justify-center mb-12" data-aos="fade-up">
            <div class="bg-emerald-600 text-white font-bold py-2 px-6 rounded-full shadow-lg border-4 border-white flex items-center gap-2">
                <i class="fa-solid fa-leaf"></i> FIRST SEMESTER
            </div>
        </div>

        <div class="space-y-12 mb-16">
            <!-- Event 1 (Left) -->
            <div class="relative flex flex-col md:flex-row items-center w-full" data-aos="fade-right">
                <div class="md:w-1/2 w-full md:pr-12 md:text-right pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Freshers Resumption</h3>
                    <p class="text-gray-600 mt-2">All 100L students formally resume and commence departmental registration and clearance.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-emerald-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pl-12 pl-12">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 inline-block w-full md:w-auto text-left">
                        <span class="block text-emerald-600 font-black text-xl"><i class="fa-regular fa-calendar mr-2"></i> October 2, 2025</span>
                    </div>
                </div>
            </div>

            <!-- Event 2 (Right) -->
            <div class="relative flex flex-col md:flex-row-reverse items-center w-full" data-aos="fade-left">
                <div class="md:w-1/2 w-full md:pl-12 md:text-left pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Returning Students & Lectures</h3>
                    <p class="text-gray-600 mt-2">Returning students resume and official first-semester lectures commence across all levels.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-blue-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pr-12 pl-12 text-left md:text-right">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 inline-block w-full md:w-auto">
                        <span class="block text-blue-600 font-black text-xl"><i class="fa-regular fa-calendar mr-2"></i> October 9, 2025</span>
                    </div>
                </div>
            </div>

            <!-- Event 3 (Left) -->
            <div class="relative flex flex-col md:flex-row items-center w-full" data-aos="fade-right">
                <div class="md:w-1/2 w-full md:pr-12 md:text-right pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Matriculation & Orientation</h3>
                    <p class="text-gray-600 mt-2">Departmental orientation for freshers and University-wide matriculation ceremony.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-purple-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pl-12 pl-12">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 inline-block w-full md:w-auto text-left">
                        <span class="block text-purple-600 font-black text-xl"><i class="fa-regular fa-calendar mr-2"></i> November 15, 2025</span>
                    </div>
                </div>
            </div>

            <!-- Event 4 (Right) -->
            <div class="relative flex flex-col md:flex-row-reverse items-center w-full" data-aos="fade-left">
                <div class="md:w-1/2 w-full md:pl-12 md:text-left pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-red-600">First Semester Examinations</h3>
                    <p class="text-gray-600 mt-2">Official start of the first-semester examination period.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-red-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pr-12 pl-12 text-left md:text-right">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-red-100 bg-red-50 inline-block w-full md:w-auto">
                        <span class="block text-red-600 font-black text-xl"><i class="fa-solid fa-pen-nib mr-2"></i> February 12, 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Semester 2 Marker -->
        <div class="relative z-10 flex items-center justify-center mb-12 mt-20" data-aos="fade-up">
            <div class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-full shadow-lg border-4 border-white flex items-center gap-2">
                <i class="fa-solid fa-graduation-cap"></i> SECOND SEMESTER
            </div>
        </div>

        <div class="space-y-12 mb-16">
            <!-- Event 1 (Left) -->
            <div class="relative flex flex-col md:flex-row items-center w-full" data-aos="fade-right">
                <div class="md:w-1/2 w-full md:pr-12 md:text-right pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Second Semester Resumption</h3>
                    <p class="text-gray-600 mt-2">Resumption and immediate commencement of second-semester lectures.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-indigo-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pl-12 pl-12">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 inline-block w-full md:w-auto text-left">
                        <span class="block text-indigo-600 font-black text-xl"><i class="fa-regular fa-calendar mr-2"></i> March 18, 2026</span>
                    </div>
                </div>
            </div>

            <!-- Event 2 (Right) -->
            <div class="relative flex flex-col md:flex-row-reverse items-center w-full" data-aos="fade-left">
                <div class="md:w-1/2 w-full md:pl-12 md:text-left pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Departmental NACOS Week</h3>
                    <p class="text-gray-600 mt-2">Week-long student activities, seminars, sports, and cultural presentations.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-yellow-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pr-12 pl-12 text-left md:text-right">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 inline-block w-full md:w-auto">
                        <span class="block text-yellow-600 font-black text-xl"><i class="fa-regular fa-calendar mr-2"></i> May 20, 2026</span>
                    </div>
                </div>
            </div>

            <!-- Event 3 (Left) -->
            <div class="relative flex flex-col md:flex-row items-center w-full" data-aos="fade-right">
                <div class="md:w-1/2 w-full md:pr-12 md:text-right pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-teal-600">Final Year Project Defense</h3>
                    <p class="text-gray-600 mt-2">Defenses for all outgoing 400L students to present their computing solutions.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-teal-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pl-12 pl-12">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-teal-100 bg-teal-50 inline-block w-full md:w-auto text-left">
                        <span class="block text-teal-600 font-black text-xl"><i class="fa-solid fa-code mr-2"></i> June 12, 2026</span>
                    </div>
                </div>
            </div>

            <!-- Event 4 (Right) -->
            <div class="relative flex flex-col md:flex-row-reverse items-center w-full" data-aos="fade-left">
                <div class="md:w-1/2 w-full md:pl-12 md:text-left pl-12 md:pl-0 mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-red-600">Second Semester Examinations</h3>
                    <p class="text-gray-600 mt-2">End of session examinations for all levels.</p>
                </div>
                <div class="absolute left-0 md:left-1/2 w-8 h-8 rounded-full bg-red-500 border-4 border-white shadow-md transform md:-translate-x-1/2 mt-1 md:mt-0 z-20 flex items-center justify-center"></div>
                <div class="md:w-1/2 w-full md:pr-12 pl-12 text-left md:text-right">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-red-100 bg-red-50 inline-block w-full md:w-auto">
                        <span class="block text-red-600 font-black text-xl"><i class="fa-solid fa-pen-nib mr-2"></i> June 24, 2026</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Small summary note -->
    <div class="bg-gray-900 text-white rounded-2xl p-6 shadow-xl mt-12 flex flex-col md:flex-row items-center gap-6" data-aos="fade-up">
        <div class="text-4xl text-emerald-400">
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div>
            <h4 class="text-xl font-bold mb-1">Subject to Variations</h4>
            <p class="text-gray-300 text-sm">Please note that all dates on this timeline are subject to internal modifications or University Senate ratifications. Stay in touch with departmental notices online.</p>
        </div>
    </div>
</div>

<style>
.calendar-timeline { font-family: 'Inter', system-ui, sans-serif; overflow-x: hidden; }
</style>
HTML;

$page = \App\Models\Page::where('slug', 'academic-calendar')->first();
if ($page) {
    $page->content = $newContent;
    $page->save();
    echo "academic-calendar updated highly structured.\n";
} else {
    echo "academic-calendar not found.";
}
