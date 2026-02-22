<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Publication;
use App\Models\Event;
use App\Models\GalleryAlbum;

class ResearchNewsController extends Controller
{
    public function index()
    {
        $news = News::latest('published_at')->get();
        $publications = Publication::with('staff')->orderBy('year', 'desc')->get();
        $events = Event::orderBy('date', 'desc')->get();
        $albums = GalleryAlbum::latest('date')->get();
        
        return view('pages.research-news', compact('news', 'publications', 'events', 'albums'));
    }

    public function show(string $slug)
    {
        $article = News::where('slug', $slug)->firstOrFail();
        $related  = News::where('id', '!=', $article->id)->latest('published_at')->take(3)->get();
        return view('pages.news-show', compact('article', 'related'));
    }
}
