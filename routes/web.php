<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ResearchNewsController;
use App\Http\Controllers\ContactAlumniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academics');
Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/{slug}', [PeopleController::class, 'show'])->name('people.show');
Route::get('/research-news', [ResearchNewsController::class, 'index'])->name('research-news');
Route::get('/contact-alumni', [ContactAlumniController::class, 'index'])->name('contact-alumni');
Route::post('/contact-alumni', [ContactAlumniController::class, 'send'])->name('contact-alumni.send');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource controllers
    Route::resource('staff', StaffController::class);
    Route::resource('programmes', ProgrammeController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('alumni', AlumniController::class);
    Route::resource('gallery', GalleryController::class);
    Route::delete('gallery/image/{image}', [GalleryController::class, 'destroyImage'])->name('gallery.image.destroy');
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
