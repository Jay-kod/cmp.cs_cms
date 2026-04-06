@extends($adminLayout ?? 'layouts.admin')
@section('title', isset($album) && $album->exists ? 'Edit Album' : 'Create Album')
@section('header', isset($album) && $album->exists ? 'Edit Photo Album' : 'Create Photo Album')

@section('content')
<div class="admin-card" style="margin-bottom: 2rem;">
    <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem;">Album Details</h3>
    
    @if ($errors->any())
        <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem; border: 1px solid #f87171;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($album) && $album->exists ? route('admin.gallery.update', $album) : route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($album) && $album->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <div>
                <div class="form-group">
                    <label class="form-label">Album Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $album->title ?? '') }}" class="form-control" required placeholder="e.g. 2024 Matriculation Ceremony">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date of Event <span style="color: red;">*</span></label>
                    <input type="date" name="date" value="{{ old('date', isset($album) && $album->date ? \Carbon\Carbon::parse($album->date)->format('Y-m-d') : date('Y-m-d')) }}" class="form-control" required>
                </div>
                
                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label">Sub-Department</label>
                    <select name="department_code" class="form-control">
                        <option value="">— Generic / All —</option>
                        <option value="cs" {{ old('department_code', $album->department_code ?? '') == 'cs' ? 'selected' : '' }}>Computer Science</option>
                        <option value="cyb" {{ old('department_code', $album->department_code ?? '') == 'cyb' ? 'selected' : '' }}>Cyber Security</option>
                        <option value="ds" {{ old('department_code', $album->department_code ?? '') == 'ds' ? 'selected' : '' }}>Data Science</option>
                    </select>
                </div>
            </div>
            
            <div>
                <div class="form-group">
                    <label class="form-label">Cover Image</label>
                    @if(isset($album) && $album->cover_image)
                        <div style="margin-bottom: 0.8rem;">
                            <img src="{{ asset('storage/'.$album->cover_image) }}" style="height: 120px; width: auto; object-fit: cover; border-radius: 4px; border: 1px solid #e5e7eb;">
                        </div>
                    @endif
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                    <p style="margin: 5px 0 0 0; font-size: 0.75rem; color: #6b7280;">This image represents the album in grids. Max 2MB.</p>
                </div>
            </div>
        </div>
        
        <h3 style="margin-top: 1.5rem; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem;">Upload Photos to Album</h3>
        <div class="form-group" style="background: #f9fafb; padding: 2rem; text-align: center; border: 2px dashed #d1d5db; border-radius: 8px;">
            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2.5rem; color: #9ca3af; margin-bottom: 1rem;"></i>
            <br>
            <input type="file" name="images[]" multiple class="form-control" accept="image/*" style="max-width: 400px; margin: 0 auto;">
            <p style="margin: 10px 0 0 0; font-size: 0.85rem; color: #6b7280;">You can select multiple photos at once. Max 2MB per photo.</p>
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ isset($album) && $album->exists ? 'Save Edits' : 'Create Album' }}</button>
            <button type="submit" class="btn btn-primary" style="background: var(--color-secondary, #15803d); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">Upload Selected Photos</button>
        </div>
        </div>
    </form>
</div>

@if(isset($album) && $album->exists && $album->images->count() > 0)
<div class="admin-card">
    <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;">
        Photos in this Album ({{ $album->images->count() }})
    </h3>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1rem;">
        @foreach($album->images as $img)
        <div style="position: relative; border-radius: 4px; overflow: hidden; border: 1px solid #e5e7eb; aspect-ratio: 1/1; background: #f3f4f6;">
            <img src="{{ asset('storage/'.$img->image_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
            
            <form action="{{ route('admin.gallery.image.destroy', $img->id) }}" method="POST" data-confirm="Remove this photo?" style="position: absolute; top: 5px; right: 5px; margin: 0;">
                @csrf @method('DELETE')
                <button type="submit" style="background: rgba(2ef, 68, 68, 0.9); color: white; border: none; width: 28px; height: 28px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;"><i class="fa-solid fa-xmark"></i></button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
