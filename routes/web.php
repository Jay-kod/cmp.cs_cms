<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AcademicsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ResearchNewsController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactNacosController;
use App\Http\Controllers\GalleryController as PublicGalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiwesController;
use App\Http\Controllers\ProjectGuideController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\UserController as SuperAdminUserController;
use App\Http\Controllers\SuperAdmin\SettingsController as SuperAdminSettingsController;
use App\Http\Controllers\SuperAdmin\BackupController as SuperAdminBackupController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\ProgrammeCategoryController;
use App\Http\Controllers\Admin\SubDepartmentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\NacosPresidentController;
use App\Http\Controllers\Admin\PastHodController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ExternalSystemController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\StaffRoleController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\BulkImportController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\Admin\MediaOptimizationController;
use App\Http\Controllers\SuperAdmin\MediaOptimizationController as SuperAdminMediaOptimizationController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\Admin\ResourceCategoryController;
use App\Http\Controllers\Admin\ResourceItemController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/labs', [AboutController::class, 'labs'])->name('labs');
Route::get('/department/{slug}', [DepartmentController::class, 'show'])->name('department.show');
Route::get('/sub-department/{slug}', [App\Http\Controllers\SubDepartmentPublicController::class, 'show'])->name('sub-department.show');
Route::get('/past-hods', [AboutController::class, 'pastHods'])->name('past-hods');
Route::get('/academics', [AcademicsController::class, 'index'])->name('academics');
Route::get('/admissions', [\App\Http\Controllers\AdmissionsController::class, 'index'])->name('admissions');
Route::get('/programmes/{slug}', [\App\Http\Controllers\ProgrammePublicController::class, 'show'])->name('programmes.show');
Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/search', [PeopleController::class, 'search'])->name('people.search');
Route::get('/people/{slug}', [PeopleController::class, 'show'])->name('people.show');
Route::get('/research-news', [ResearchNewsController::class, 'index'])->name('research-news');
Route::get('/research-innovations', [ResearchNewsController::class, 'research'])->name('research');
Route::get('/research-news/{slug}', [ResearchNewsController::class, 'show'])->name('research-news.show');
Route::get('/news/{news}/reactions', [ReactionController::class, 'show'])->name('reactions.show');
Route::post('/news/{news}/reactions', [ReactionController::class, 'store'])->name('reactions.store');
Route::get('/news/{news}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/news/{news}/comments', [CommentController::class, 'store'])->middleware('throttle:10,1')->name('comments.store');
Route::get('/contact', [ContactNacosController::class, 'index'])->name('contact');
Route::post('/contact', [ContactNacosController::class, 'send'])->middleware('throttle:5,1')->name('contact.send');
Route::get('/nacos-presidents', [ContactNacosController::class, 'presidents'])->name('nacos-presidents');
Route::get('/gallery', [PublicGalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{album}', [PublicGalleryController::class, 'show'])->name('gallery.show');
Route::get('/page/{page}', [PageController::class, 'show'])->name('page.show');
Route::get('/siwes', [SiwesController::class, 'index'])->name('siwes');
Route::get('/final-year-projects', [ProjectGuideController::class, 'index'])->name('projects');
Route::get('/events', [\App\Http\Controllers\EventPublicController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [\App\Http\Controllers\EventPublicController::class, 'show'])->name('events.show');

// Event Reactions & Comments & RSVP
Route::get('/events/{event}/reactions', [\App\Http\Controllers\EventReactionController::class, 'show'])->name('event.reactions.show');
Route::post('/events/{event}/reactions', [\App\Http\Controllers\EventReactionController::class, 'store'])->name('event.reactions.store');
Route::get('/events/{event}/comments', [\App\Http\Controllers\EventCommentController::class, 'index'])->name('event.comments.index');
Route::post('/events/{event}/comments', [\App\Http\Controllers\EventCommentController::class, 'store'])->name('event.comments.store');
Route::post('/events/{event}/rsvp', [\App\Http\Controllers\EventRsvpController::class, 'store'])->name('event.rsvp.store');

Route::get('/resources', [ResourcesController::class, 'index'])->name('resources.index');

Route::middleware(['auth:web,super_admin', 'verified', 'admin', \App\Http\Middleware\SetAdminLayoutForSuperAdmins::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/system-logs', [\App\Http\Controllers\Admin\SystemLogController::class, 'index'])->name('system-logs.index');
    
    // Encryption Audit Logs
    Route::get('/encryption-logs', [\App\Http\Controllers\Admin\EncryptionAuditController::class, 'index'])->name('encryption-logs.index');
    
    // Brand Settings
    Route::get('/settings/brand-logo', [\App\Http\Controllers\Admin\SettingsController::class, 'brandLogo'])->name('settings.brand-logo');
    Route::post('/settings/brand-logo', [\App\Http\Controllers\Admin\SettingsController::class, 'updateBrandLogo'])->name('settings.update-brand-logo');

    // Academic Session Settings
    Route::post('/settings/academic-session', [\App\Http\Controllers\Admin\SettingsController::class, 'updateAcademicSession'])->name('settings.academic-session');

    // ── Content Management (all admins: admin + super_admin) ──
    Route::get('announcements/settings', [AnnouncementController::class, 'settings'])->name('announcements.settings');
    Route::post('announcements/settings', [AnnouncementController::class, 'updateSettings'])->name('announcements.settings.update');
    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('staff-roles', StaffRoleController::class);
    Route::resource('programmes', ProgrammeController::class);
    Route::resource('programme-categories', ProgrammeCategoryController::class);
    Route::resource('sub-departments', SubDepartmentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('nacos-presidents', NacosPresidentController::class);
    Route::resource('past-hods', PastHodController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('gallery', GalleryController::class);
    Route::delete('gallery/image/{image}', [GalleryController::class, 'destroyImage'])->name('gallery.image.destroy');
    Route::resource('publications', PublicationController::class);

    // Comments Management
    Route::post('comments/{comment}/toggle-approval', [\App\Http\Controllers\Admin\CommentController::class, 'toggleApproval'])->name('comments.toggle-approval');
    Route::delete('comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');

    // Resources Catalog (DB-driven files)
    Route::resource('resource-categories', ResourceCategoryController::class)->except(['show']);
    Route::resource('resources', ResourceItemController::class)->except(['show']);

    // Carousel & Media
    Route::resource('carousel', CarouselController::class)->except(['show']);
    Route::get('/carousel-footer-bg', [CarouselController::class, 'footerBg'])->name('carousel.footer-bg');
    Route::post('/carousel-footer-bg', [CarouselController::class, 'updateFooterBg'])->name('carousel.footer-bg.update');
    Route::get('/carousel-page-heroes', [CarouselController::class, 'pageHeroes'])->name('carousel.page-heroes');
    Route::post('/carousel-page-heroes', [CarouselController::class, 'updatePageHeroes'])->name('carousel.page-heroes.update');

    // External Systems & Social Links
    Route::resource('external-systems', ExternalSystemController::class)->except(['show']);
    Route::resource('social-links', SocialLinkController::class)->except(['show']);

    // Page Content Editors
    Route::get('/page-content/{page}', [PageContentController::class, 'showPage'])->name('page-content.show');
    Route::post('/page-content/{page}', [PageContentController::class, 'updatePage'])->name('page-content.update');

    // Pages
    Route::resource('pages', AdminPageController::class);

    // Departmental Timetable
    Route::get('/timetable-upload', [\App\Http\Controllers\Admin\TimetableController::class, 'showUpload'])->name('timetable.upload');
    Route::post('/timetable-upload', [\App\Http\Controllers\Admin\TimetableController::class, 'upload']);

    // Analytics & Reports
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/analytics/download', [AnalyticsController::class, 'download'])->name('analytics.download');

    // Media Optimization (WebP)
    Route::get('/media-optimization', [MediaOptimizationController::class, 'index'])->name('media-optimization.index');
    Route::post('/media-optimization/{mediaFile}/requeue', [MediaOptimizationController::class, 'requeue'])->name('media-optimization.requeue');

    // Bulk Import
    Route::get('/bulk-import/{type}', [BulkImportController::class, 'show'])->name('bulk-import.show');
    Route::get('/bulk-import/{type}/template', [BulkImportController::class, 'template'])->name('bulk-import.template');
    Route::post('/bulk-import/{type}', [BulkImportController::class, 'import'])->name('bulk-import.import');
    Route::post('/bulk-import/{type}/preview', [BulkImportController::class, 'preview'])->name('bulk-import.preview');
    Route::get('/bulk-import/{type}/preview', fn ($type) => redirect()->route('admin.bulk-import.show', $type));
    Route::post('/bulk-import/{type}/confirm', [BulkImportController::class, 'confirmImport'])->name('bulk-import.confirm');
    Route::get('/bulk-import/{type}/confirm', fn ($type) => redirect()->route('admin.bulk-import.show', $type));
});

// ══════════════════════════════════════════════════════════
// ── Super Admin Panel (completely separate URL prefix)
// ══════════════════════════════════════════════════════════
Route::middleware(['auth:super_admin', 'super_admin', \App\Http\Middleware\SetAdminLayoutForSuperAdmins::class])->prefix('super-admin')->name('super-admin.')->group(function () {
    Route::get('/', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', SuperAdminUserController::class)->except(['show']);

    // Settings
    Route::get('/settings', [SuperAdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SuperAdminSettingsController::class, 'update'])->name('settings.update');

    // Backup
    Route::get('/backup', [SuperAdminBackupController::class, 'index'])->name('backup.index');
    Route::post('/backup', [SuperAdminBackupController::class, 'download'])->name('backup.download');

    // Media Optimization (WebP)
    Route::get('/media-optimization', [SuperAdminMediaOptimizationController::class, 'index'])->name('media-optimization.index');
    Route::post('/media-optimization/{mediaFile}/requeue', [SuperAdminMediaOptimizationController::class, 'requeue'])->name('media-optimization.requeue');
    Route::post('/media-optimization/requeue-all', [SuperAdminMediaOptimizationController::class, 'requeueAllNonReady'])->name('media-optimization.requeue-all');

    // ── Admin CRUD modules (super-admin can do everything admin can, plus more) ──
    Route::get('announcements/settings', [AnnouncementController::class, 'settings'])->name('announcements.settings');
    Route::post('announcements/settings', [AnnouncementController::class, 'updateSettings'])->name('announcements.settings.update');
    Route::resource('news', NewsController::class);
    Route::resource('events', EventController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('staff-roles', StaffRoleController::class);
    Route::resource('programmes', ProgrammeController::class);
    Route::resource('programme-categories', ProgrammeCategoryController::class);
    Route::resource('sub-departments', SubDepartmentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('nacos-presidents', NacosPresidentController::class);
    Route::resource('past-hods', PastHodController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('publications', PublicationController::class);

    // Comments Management
    Route::post('comments/{comment}/toggle-approval', [\App\Http\Controllers\Admin\CommentController::class, 'toggleApproval'])->name('comments.toggle-approval');
    Route::delete('comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');

    // Resources Catalog (DB-driven files)
    Route::resource('resource-categories', ResourceCategoryController::class)->except(['show']);
    Route::resource('resources', ResourceItemController::class)->except(['show']);

    Route::resource('carousel', CarouselController::class)->except(['show']);
    Route::get('/carousel-footer-bg', [CarouselController::class, 'footerBg'])->name('carousel.footer-bg');
    Route::post('/carousel-footer-bg', [CarouselController::class, 'updateFooterBg'])->name('carousel.footer-bg.update');
    Route::get('/carousel-page-heroes', [CarouselController::class, 'pageHeroes'])->name('carousel.page-heroes');
    Route::post('/carousel-page-heroes', [CarouselController::class, 'updatePageHeroes'])->name('carousel.page-heroes.update');

    Route::resource('external-systems', ExternalSystemController::class)->except(['show']);
    Route::resource('social-links', SocialLinkController::class)->except(['show']);

    Route::get('/page-content/{page}', [\App\Http\Controllers\Admin\PageContentController::class, 'showPage'])->name('page-content.show');
    Route::post('/page-content/{page}', [\App\Http\Controllers\Admin\PageContentController::class, 'updatePage'])->name('page-content.update');

    Route::resource('pages', AdminPageController::class);

    Route::get('/timetable-upload', [\App\Http\Controllers\Admin\TimetableController::class, 'showUpload'])->name('timetable.upload');
    Route::post('/timetable-upload', [\App\Http\Controllers\Admin\TimetableController::class, 'upload']);

    Route::get('/analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');
    Route::get('/analytics/download', [\App\Http\Controllers\Admin\AnalyticsController::class, 'download'])->name('analytics.download');

    Route::get('/bulk-import/{type}', [BulkImportController::class, 'show'])->name('bulk-import.show');
    Route::get('/bulk-import/{type}/template', [BulkImportController::class, 'template'])->name('bulk-import.template');
    Route::post('/bulk-import/{type}', [BulkImportController::class, 'import'])->name('bulk-import.import');
    Route::post('/bulk-import/{type}/preview', [BulkImportController::class, 'preview'])->name('bulk-import.preview');
    Route::post('/bulk-import/{type}/confirm', [BulkImportController::class, 'confirmImport'])->name('bulk-import.confirm');
});

Route::middleware('auth:web,super_admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
