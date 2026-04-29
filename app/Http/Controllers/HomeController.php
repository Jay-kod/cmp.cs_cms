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
use App\Models\NacosPresident;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = Cache::remember('home_page_data_optimized', 360, function() {
            $staffLimit   = (int) (DepartmentSetting::getCached('home_staff_count') ?? 4);
            $galleryLimit = (int) (DepartmentSetting::getCached('home_gallery_count') ?? 8);

            return [
                'programmes' => Programme::where('is_active', true)->orderBy('sort_order')->get(),
                'news' => News::latest('published_at')->take(2)->get(),
                'events' => Event::where('date', '>=', now())->orderBy('date')->take(3)->get(),
                'announcements' => Announcement::where('expires_at', '>=', now())->orWhereNull('expires_at')->take(3)->get(),
                'hod' => Staff::where('is_hod', true)->first(),
                'staffCount' => Staff::count(),
                'courseCount' => Course::count(),
                'carouselSlides' => CarouselSlide::active()->ordered()->get(),
                'featuredStaff' => Staff::orderByDesc('is_hod')->orderBy('sort_order')->take($staffLimit)->get(),
                'galleryImages' => GalleryImage::latest()->take($galleryLimit)->get(),
                'galleryAlbumCount' => GalleryAlbum::count(),
                'externalSystems' => ExternalSystem::active()->ordered()->get(),
                'cmsPages' => Page::where('is_active', true)->get(),
                'partners' => \App\Models\Partner::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get(),
                'nacosPresidents' => NacosPresident::orderByDesc('tenure_end')->take(4)->get(),
                'nacosTotalCount' => NacosPresident::count(),
                'timetables' => \App\Models\ResourceItem::whereHas('category', function($q) {
                    $q->where('slug', 'timetable');
                })->where('is_active', true)->latest()->take(3)->get(),
            ];
        });

        return view('pages.home', $data);
    }
}