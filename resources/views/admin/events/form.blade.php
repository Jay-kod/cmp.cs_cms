@extends($adminLayout ?? 'layouts.admin')
@section('title', $event->exists ? 'Edit Event' : 'Create Event')
@section('header', $event->exists ? 'Edit Event Details' : 'Create New Event')

@section('content')
<div data-aos="fade-up" class="admin-card">
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid #f87171;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $event->exists ? route('admin.events.update', $event) : route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($event->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <!-- Column 1 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Event Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-control" required placeholder="e.g. 5th International Conference on Computing">
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Start Date & Time <span style="color: red;">*</span></label>
                        <input type="datetime-local" name="date" value="{{ old('date', $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') : '') }}" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">End Date & Time</label>
                        <input type="datetime-local" name="end_date" value="{{ old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Venue / Location</label>
                    <input type="text" name="venue" value="{{ old('venue', $event->venue) }}" class="form-control" placeholder="e.g. Faculty Auditorium, Main Campus">
                    <p style="margin: 5px 0 0 0; font-size: 0.75rem; color: #6b7280;">Leave blank for virtual events, or paste Zoom link in description.</p>
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Event Flyer / Promo Image</label>
                    @if($event->flyer_image)
                        <div style="margin-bottom: 1rem;">
                            <img src="{{ asset('storage/'.$event->flyer_image) }}" style="max-width: 200px; height: auto; border-radius: 4px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                    <input type="file" name="flyer_image" class="form-control" accept="image/*">
                    <p style="margin: 5px 0 0 0; font-size: 0.75rem; color: #6b7280;">Square or portrait images work best. Max 2MB.</p>
                </div>
            </div>

            <!-- Column 2 -->
            <div>
                <div class="form-group">
                    <label class="form-label">Event Details / Description <span style="color: red;">*</span></label>
                    <textarea name="description" class="form-control richtext" rows="14" placeholder="Provide full details about the event, agenda, speakers, registration links, etc." style="font-family: inherit;">{{ old('description', $event->description) }}</textarea>
                    <p style="margin: 5px 0 0 0; font-size: 0.8rem; color: #6b7280;">Basic HTML is supported.</p>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $event->exists ? 'Update Event Details' : 'Publish Event' }}</button>
        </div>
    </form>
</div>
@endsection
