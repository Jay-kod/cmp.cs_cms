<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\MediaOptimizationService;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount(['rsvps', 'comments', 'reactions'])
            ->orderBy('date', 'desc')
            ->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.form', ['event' => new Event()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'venue' => 'nullable|string|max:255',
            'time' => 'nullable|string|max:255',
            'flyer_image' => 'nullable|image|max:2048'
        ]);



        if ($request->hasFile('flyer_image')) {
            $flyerFile = $request->file('flyer_image');
            $data['flyer_image'] = $flyerFile->store('public/event_flyers');
            $data['flyer_image'] = str_replace('public/', '', $data['flyer_image']);

            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['flyer_image'],
                $flyerFile->getClientMimeType()
            );
        }

        Event::create($data);
        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $event->load(['rsvps' => fn($q) => $q->orderBy('created_at', 'desc'), 'comments' => fn($q) => $q->orderBy('created_at', 'desc')]);
        $reactionsCount = $event->reactions()->select('type', \DB::raw('count(*) as count'))->groupBy('type')->pluck('count', 'type')->toArray();
        return view('admin.events.show', compact('event', 'reactionsCount'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.form', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'venue' => 'nullable|string|max:255',
            'time' => 'nullable|string|max:255',
            'flyer_image' => 'nullable|image|max:2048'
        ]);

        if ($data['title'] !== $event->title) {

        }

        if ($request->hasFile('flyer_image')) {
            if($event->flyer_image) Storage::delete('public/'.$event->flyer_image);
            $flyerFile = $request->file('flyer_image');
            $data['flyer_image'] = $flyerFile->store('public/event_flyers');
            $data['flyer_image'] = str_replace('public/', '', $data['flyer_image']);

            app(MediaOptimizationService::class)->enqueueImageToWebp(
                $data['flyer_image'],
                $flyerFile->getClientMimeType()
            );
        }

        $event->update($data);
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if($event->flyer_image) Storage::delete('public/'.$event->flyer_image);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
