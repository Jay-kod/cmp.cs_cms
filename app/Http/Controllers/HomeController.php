<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Event;
use App\Models\Announcement;
use App\Models\Programme;
use App\Models\Staff;
use App\Models\Course;
use App\Models\CarouselSlide;
use App\Models\ExternalSystem;
use App\Models\GalleryImage;
use App\Models\GalleryAlbum;
use App\Models\Page;
use App\Models\DepartmentSetting;

class HomeController extends Controller
{
    public function index()
    {
        $programmes = Programme::where('is_active', true)->orderBy('sort_order')->get();
        $news = News::latest('published_at')->take(3)->get();
        $events = Event::where('date', '>=', now())->orderBy('date')->take(3)->get();
        $announcements = Announcement::where('expires_at', '>=', now())->orWhereNull('expires_at')->take(3)->get();
        
        $hod = Staff::where('is_hod', true)->first();
        $staffCount = Staff::where('is_active', true)->count();
        $courseCount = Course::count();
        $carouselSlides = CarouselSlide::active()->ordered()->get();

        // New sections data (counts configurable from admin)
        $staffLimit   = (int) (DepartmentSetting::where('key', 'home_staff_count')->value('value') ?? 4);
        $galleryLimit = (int) (DepartmentSetting::where('key', 'home_gallery_count')->value('value') ?? 8);

        $featuredStaff = Staff::where('is_active', true)->take($staffLimit)->get();
        $galleryImages = GalleryImage::latest()->take($galleryLimit)->get();
        $galleryAlbumCount = GalleryAlbum::count();
        $externalSystems = ExternalSystem::active()->ordered()->get();
        $cmsPages = Page::where('is_active', true)->get();

        return view('pages.home', compact(
            'programmes', 'news', 'events', 'announcements', 'hod',
            'staffCount', 'courseCount', 'carouselSlides',
            'featuredStaff', 'galleryImages', 'galleryAlbumCount',
            'externalSystems', 'cmsPages'
        ));
    }
}
