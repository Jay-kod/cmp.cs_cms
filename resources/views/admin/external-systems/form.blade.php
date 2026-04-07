@extends($adminLayout ?? 'layouts.admin')
@section('title', $system ? 'Edit System' : 'Add System')
@section('header', $system ? 'Edit External System' : 'Add External System')

@section('content')
<form method="POST" action="{{ $system ? route('admin.external-systems.update', $system) : route('admin.external-systems.store') }}">
    @csrf
    @if($system) @method('PUT') @endif

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start;">
        
        {{-- Main Content --}}
        <div data-aos="fade-up" class="admin-card" style="padding: 1.5rem;">
            <h3 style="margin: 0 0 1.2rem 0; font-size: 1rem; font-weight: 600;">System Details</h3>

            <div style="margin-bottom: 1.2rem;">
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">System Name <span style="color: #dc2626;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $system->name ?? '') }}" required
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid {{ $errors->has('name') ? '#f87171' : '#d1d5db' }}; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                    placeholder="e.g. Departmental Due Payment">
                @error('name') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 1.2rem;">
                <label for="url" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">URL <span style="color: #dc2626;">*</span></label>
                <input type="text" name="url" id="url" value="{{ old('url', $system->url ?? '') }}" required
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid {{ $errors->has('url') ? '#f87171' : '#d1d5db' }}; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                    placeholder="https://example.com/system">
                @error('url') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
                <p style="margin: 0.3rem 0 0; font-size: 0.78rem; color: #9ca3af;">Full URL including https://. Use # as placeholder if URL is not ready yet.</p>
            </div>

            <div style="margin-bottom: 1.2rem;">
                <label for="description" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description', $system->description ?? '') }}"
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                    placeholder="Brief description of the system">
                @error('description') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div data-aos="fade-up" class="admin-card" style="padding: 1.2rem;">
                <h4 style="margin: 0 0 1rem; font-size: 0.92rem; font-weight: 600; padding-bottom: 0.6rem; border-bottom: 1px solid #e5e7eb;">Settings</h4>

                <div style="margin-bottom: 1rem;">
                    <label for="icon" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.85rem;">Icon Class</label>
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $system->icon ?? 'fa-solid fa-arrow-up-right-from-square') }}"
                            style="flex: 1; padding: 0.5rem 0.7rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.85rem; font-family: inherit; box-sizing: border-box;"
                            placeholder="fa-solid fa-link" oninput="document.getElementById('icon-preview').className = this.value;">
                        <div style="width: 36px; height: 36px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                            <i id="icon-preview" class="{{ old('icon', $system->icon ?? 'fa-solid fa-arrow-up-right-from-square') }}" style="color: var(--color-primary); font-size: 1rem;"></i>
                        </div>
                    </div>
                    <p style="margin: 0.3rem 0 0.8rem; font-size: 0.75rem; color: #9ca3af;">Font Awesome 6 class name</p>

                    <div style="margin-top: 0.6rem;">
                        <p style="margin: 0 0 0.4rem; font-size: 0.75rem; font-weight: 600; color: #4b5563;">Suggestions:</p>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
                            @php
                                $sampleIcons = [
                                    // IT & Technology
                                    'fa-solid fa-laptop-code', 'fa-solid fa-server', 'fa-solid fa-database',
                                    'fa-solid fa-cloud', 'fa-solid fa-network-wired', 'fa-solid fa-globe',
                                    'fa-solid fa-terminal', 'fa-solid fa-code', 'fa-solid fa-desktop',
                                    'fa-solid fa-gears', 'fa-solid fa-microchip', 'fa-solid fa-plug',
                                    
                                    // Academic & Education
                                    'fa-solid fa-graduation-cap', 'fa-solid fa-book', 'fa-solid fa-book-open',
                                    'fa-solid fa-chalkboard-user', 'fa-solid fa-school', 'fa-solid fa-microscope',
                                    
                                    // Admin, Access & Portals
                                    'fa-solid fa-users', 'fa-solid fa-user-graduate', 'fa-solid fa-id-card', 
                                    'fa-solid fa-right-to-bracket', 'fa-solid fa-key', 'fa-solid fa-building-columns',
                                    
                                    // Office & Business
                                    'fa-solid fa-briefcase', 'fa-solid fa-folder', 'fa-solid fa-file-invoice',
                                    'fa-solid fa-chart-line', 'fa-solid fa-layer-group', 'fa-solid fa-list',
                                    
                                    // Communication & Links
                                    'fa-solid fa-envelope', 'fa-solid fa-comments', 'fa-solid fa-video',
                                    'fa-solid fa-link', 'fa-solid fa-arrow-up-right-from-square', 'fa-solid fa-circle-info'
                                ];
                            @endphp
                            @foreach($sampleIcons as $sample)
                                <button type="button" 
                                    onclick="document.getElementById('icon').value='{{ $sample }}'; document.getElementById('icon-preview').className='{{ $sample }}';"
                                    style="width: 32px; height: 32px; border: 1px solid #e5e7eb; border-radius: 4px; background: white; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; color: #4b5563;"
                                    title="{{ $sample }}"
                                    onmouseover="this.style.borderColor='var(--color-primary)'; this.style.color='var(--color-primary)';"
                                    onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#4b5563';">
                                    <i class="{{ $sample }}"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="sort_order" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.85rem;">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $system->sort_order ?? 0) }}" min="0"
                        style="width: 100%; padding: 0.5rem 0.7rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.85rem; font-family: inherit; box-sizing: border-box;">
                    <p style="margin: 0.3rem 0 0; font-size: 0.75rem; color: #9ca3af;">Lower numbers appear first</p>
                </div>

                <div style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $system->is_active ?? true) ? 'checked' : '' }}
                        style="width: 16px; height: 16px; accent-color: var(--color-primary);">
                    <label for="is_active" style="font-size: 0.88rem; font-weight: 500; cursor: pointer;">Active (visible on site)</label>
                </div>

                <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="open_in_new_tab" id="open_in_new_tab" value="1" {{ old('open_in_new_tab', $system->open_in_new_tab ?? true) ? 'checked' : '' }}
                        style="width: 16px; height: 16px; accent-color: var(--color-primary);">
                    <label for="open_in_new_tab" style="font-size: 0.88rem; font-weight: 500; cursor: pointer;">Open in new tab</label>
                </div>

                @if($system)
                <div style="padding-top: 0.8rem; border-top: 1px solid #e5e7eb; font-size: 0.78rem; color: #9ca3af;">
                    <p style="margin: 0;">Created: {{ $system->created_at?->format('M j, Y g:i A') }}</p>
                    <p style="margin: 0.2rem 0 0;">Updated: {{ $system->updated_at?->format('M j, Y g:i A') }}</p>
                </div>
                @endif
            </div>

            <div style="display: flex; gap: 0.6rem; margin-top: 1rem;">
                <button type="submit" style="flex: 1; background: var(--color-primary); color: white; padding: 0.7rem 1.2rem; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; font-family: inherit;">
                    <i class="fa-solid fa-save"></i> {{ $system ? 'Update System' : 'Add System' }}
                </button>
                <a href="{{ route('admin.external-systems.index') }}" style="padding: 0.7rem 1rem; border: 1px solid #d1d5db; border-radius: 6px; color: #374151; text-decoration: none; font-size: 0.9rem; text-align: center;">Cancel</a>
            </div>
        </div>

    </div>
</form>
@endsection
