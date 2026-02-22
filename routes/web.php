<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ResearchNewsController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ContactNacosController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\ProgrammeCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\NacosPresidentController;
use App\Http\Controllers\Admin\PastHodController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ExternalSystemController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\PageContentController;
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
Route::get('/past-hods', [AboutController::class, 'pastHods'])->name('past-hods');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academics');
Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/{slug}', [PeopleController::class, 'show'])->name('people.show');
Route::get('/research-news', [ResearchNewsController::class, 'index'])->name('research-news');
Route::get('/research-news/{slug}', [ResearchNewsController::class, 'show'])->name('research-news.show');
Route::get('/news/{news}/reactions', [ReactionController::class, 'show'])->name('reactions.show');
Route::post('/news/{news}/reactions', [ReactionController::class, 'store'])->name('reactions.store');
Route::get('/contact-nacos', [ContactNacosController::class, 'index'])->name('contact-nacos');
Route::post('/contact-nacos', [ContactNacosController::class, 'send'])->name('contact-nacos.send');
Route::get('/nacos-presidents', [ContactNacosController::class, 'presidents'])->name('nacos-presidents');
Route::get('/page/{page}', [PageController::class, 'show'])->name('page.show');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resource controllers
    Route::resource('staff', StaffController::class);
    Route::resource('programmes', ProgrammeController::class);
    Route::resource('programme-categories', ProgrammeCategoryController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('nacos-presidents', NacosPresidentController::class);
    Route::resource('past-hods', PastHodController::class);
    Route::resource('gallery', GalleryController::class);
    Route::delete('gallery/image/{image}', [GalleryController::class, 'destroyImage'])->name('gallery.image.destroy');
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // Pages
    Route::resource('pages', AdminPageController::class);

    // System Backup
    Route::get('/backup', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('backup.download');

    // External Systems
    Route::resource('external-systems', ExternalSystemController::class)->except(['show']);

    // Social Links
    Route::resource('social-links', SocialLinkController::class)->except(['show']);

    // Carousel & Media
    Route::resource('carousel', CarouselController::class)->except(['show']);
    Route::get('/carousel-footer-bg', [CarouselController::class, 'footerBg'])->name('carousel.footer-bg');
    Route::post('/carousel-footer-bg', [CarouselController::class, 'updateFooterBg'])->name('carousel.footer-bg.update');
    Route::get('/carousel-page-heroes', [CarouselController::class, 'pageHeroes'])->name('carousel.page-heroes');
    Route::post('/carousel-page-heroes', [CarouselController::class, 'updatePageHeroes'])->name('carousel.page-heroes.update');

    // Page Content Editors
    Route::get('/page-content/{page}', [PageContentController::class, 'showPage'])->name('page-content.show');
    Route::post('/page-content/{page}', [PageContentController::class, 'updatePage'])->name('page-content.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
