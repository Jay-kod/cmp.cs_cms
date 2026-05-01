<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Publication;
use App\Models\Event;
use App\Models\GalleryAlbum;

class ResearchNewsController extends Controller
{
    public function index()
    {
        $news = News::latest('published_at')->paginate(12);
        
        return view('pages.research-news', compact('news'));
    }

    public function announcements()
    {
        $announcements = Announcement::where('expires_at', '>=', now())
            ->orWhereNull('expires_at')
            ->orderBy('priority', 'desc')
            ->latest()
            ->paginate(12);
            
        return view('pages.announcements-index', compact('announcements'));
    }

    public function research()
    {
        $publications = Publication::with('staff')->orderBy('year', 'desc')->take(20)->get();
        $events = Event::orderBy('date', 'desc')->take(10)->get();
        $albums = GalleryAlbum::with('images')->latest('date')->take(12)->get();        
        return view('pages.research', compact('publications', 'events', 'albums'));
    }

    public function show(string $slug)
    {
        $article = News::where('slug', $slug)->firstOrFail();
        $related  = News::where('id', '!=', $article->id)->latest('published_at')->take(3)->get();
        return view('pages.news-show', compact('article', 'related'));
    }

    public function showAnnouncement(int $id)
    {
        $announcement = Announcement::findOrFail($id);
        $related = Announcement::where('id', '!=', $announcement->id)
            ->where(function ($q) {
                $q->where('expires_at', '>=', now())->orWhereNull('expires_at');
            })
            ->latest()
            ->take(4)
            ->get();
        return view('pages.announcement-show', compact('announcement', 'related'));
    }
}
