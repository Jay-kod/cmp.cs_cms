<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['news' => new News()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'body' => 'required|string',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date'
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . time();
        if(!$request->has('is_featured')) $data['is_featured'] = false;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('public/news_images');
            $data['featured_image'] = str_replace('public/', '', $data['featured_image']);
        }

        News::create($data);
        return redirect()->route('admin.news.index')->with('success', 'News article created successfully.');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'body' => 'required|string',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date'
        ]);

        if ($data['title'] !== $news->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . time();
        }
        
        if(!$request->has('is_featured')) $data['is_featured'] = false;

        if ($request->hasFile('featured_image')) {
            if($news->featured_image) Storage::delete('public/'.$news->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('public/news_images');
            $data['featured_image'] = str_replace('public/', '', $data['featured_image']);
        }

        $news->update($data);
        return redirect()->route('admin.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy(News $news)
    {
        if($news->featured_image) Storage::delete('public/'.$news->featured_image);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News article deleted successfully.');
    }
}
