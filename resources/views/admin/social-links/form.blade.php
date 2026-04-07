@extends($adminLayout ?? 'layouts.admin')
@section('title', $link ? 'Edit Social Link' : 'Add Social Link')
@section('header', $link ? 'Edit Social Link' : 'Add Social Link')

@section('content')
<form method="POST" action="{{ $link ? route('admin.social-links.update', $link) : route('admin.social-links.store') }}">
    @csrf
    @if($link) @method('PUT') @endif

    <div style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start;">
        
        {{-- Main Content --}}
        <div data-aos="fade-up" class="admin-card" style="padding: 1.5rem;">
            <h3 style="margin: 0 0 1.2rem 0; font-size: 1rem; font-weight: 600;">Social Link Details</h3>

            <div style="margin-bottom: 1.2rem;">
                <label for="name" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">Platform Name <span style="color: #dc2626;">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $link->name ?? '') }}" required
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid {{ $errors->has('name') ? '#f87171' : '#d1d5db' }}; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                    placeholder="e.g. Facebook, Twitter, LinkedIn">
                @error('name') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
            </div>

            <div style="margin-bottom: 1.2rem;">
                <label for="url" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.88rem;">URL <span style="color: #dc2626;">*</span></label>
                <input type="text" name="url" id="url" value="{{ old('url', $link->url ?? '') }}" required
                    style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid {{ $errors->has('url') ? '#f87171' : '#d1d5db' }}; border-radius: 6px; font-size: 0.92rem; font-family: inherit; box-sizing: border-box;"
                    placeholder="https://facebook.com/your-page">
                @error('url') <p style="color: #dc2626; font-size: 0.8rem; margin: 0.3rem 0 0;">{{ $message }}</p> @enderror
                <p style="margin: 0.3rem 0 0; font-size: 0.78rem; color: #9ca3af;">Full URL to your social media page or profile.</p>
            </div>

            {{-- Common social icons for quick selection --}}
            <div style="margin-bottom: 1.2rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.88rem;">Quick Pick Icon</label>
                <div style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
                    @php
                    $presets = [
                        ['fa-brands fa-facebook-f', 'Facebook'],
                        ['fa-brands fa-x-twitter', 'X / Twitter'],
                        ['fa-brands fa-instagram', 'Instagram'],
                        ['fa-brands fa-linkedin-in', 'LinkedIn'],
                        ['fa-brands fa-youtube', 'YouTube'],
                        ['fa-brands fa-tiktok', 'TikTok'],
                        ['fa-brands fa-whatsapp', 'WhatsApp'],
                        ['fa-brands fa-telegram', 'Telegram'],
                        ['fa-solid fa-envelope', 'Email / Gmail'],
                        ['fa-brands fa-github', 'GitHub'],
                        ['fa-brands fa-pinterest', 'Pinterest'],
                        ['fa-brands fa-snapchat', 'Snapchat'],
                        ['fa-brands fa-threads', 'Threads'],
                    ];
                    @endphp
                    @foreach($presets as [$iconClass, $label])
                    <button type="button" onclick="document.getElementById('icon').value = '{{ $iconClass }}'; document.getElementById('icon-preview').className = '{{ $iconClass }}';"
                        style="width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #e5e7eb; border-radius: 6px; background: #f9fafb; cursor: pointer; font-size: 1rem; color: #374151; transition: all 0.15s;"
                        title="{{ $label }}"
                        onmouseover="this.style.borderColor='var(--color-primary)'; this.style.color='var(--color-primary)'; this.style.background='#f0fdf4'"
                        onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#374151'; this.style.background='#f9fafb'">
                        <i class="{{ $iconClass }}"></i>
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div data-aos="fade-up" class="admin-card" style="padding: 1.2rem;">
                <h4 style="margin: 0 0 1rem; font-size: 0.92rem; font-weight: 600; padding-bottom: 0.6rem; border-bottom: 1px solid #e5e7eb;">Settings</h4>

                <div style="margin-bottom: 1rem;">
                    <label for="icon" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.85rem;">Icon Class <span style="color: #dc2626;">*</span></label>
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <input type="text" name="icon" id="icon" value="{{ old('icon', $link->icon ?? 'fa-brands fa-globe') }}" required
                            style="flex: 1; padding: 0.5rem 0.7rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.85rem; font-family: inherit; box-sizing: border-box;"
                            placeholder="fa-brands fa-facebook-f" oninput="document.getElementById('icon-preview').className = this.value;">
                        <div style="width: 40px; height: 40px; background: #111827; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i id="icon-preview" class="{{ old('icon', $link->icon ?? 'fa-brands fa-globe') }}" style="color: #9ca3af; font-size: 1.1rem;"></i>
                        </div>
                    </div>
                    <p style="margin: 0.3rem 0 0; font-size: 0.75rem; color: #9ca3af;">Font Awesome 6 class. Use the quick pick above or type manually.</p>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label for="sort_order" style="display: block; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.85rem;">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $link->sort_order ?? 0) }}" min="0"
                        style="width: 100%; padding: 0.5rem 0.7rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.85rem; font-family: inherit; box-sizing: border-box;">
                    <p style="margin: 0.3rem 0 0; font-size: 0.75rem; color: #9ca3af;">Lower numbers appear first</p>
                </div>

                <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $link->is_active ?? true) ? 'checked' : '' }}
                        style="width: 16px; height: 16px; accent-color: var(--color-primary);">
                    <label for="is_active" style="font-size: 0.88rem; font-weight: 500; cursor: pointer;">Active (visible in footer)</label>
                </div>

                @if($link)
                <div style="padding-top: 0.8rem; border-top: 1px solid #e5e7eb; font-size: 0.78rem; color: #9ca3af;">
                    <p style="margin: 0;">Created: {{ $link->created_at->format('M j, Y g:i A') }}</p>
                    <p style="margin: 0.2rem 0 0;">Updated: {{ $link->updated_at->format('M j, Y g:i A') }}</p>
                </div>
                @endif
            </div>

            <div style="display: flex; gap: 0.6rem; margin-top: 1rem;">
                <button type="submit" style="flex: 1; background: var(--color-primary); color: white; padding: 0.7rem 1.2rem; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 0.9rem; font-family: inherit;">
                    <i class="fa-solid fa-save"></i> {{ $link ? 'Update Link' : 'Add Link' }}
                </button>
                <a href="{{ route('admin.social-links.index') }}" style="padding: 0.7rem 1rem; border: 1px solid #d1d5db; border-radius: 6px; color: #374151; text-decoration: none; font-size: 0.9rem; text-align: center;">Cancel</a>
            </div>
        </div>

    </div>
</form>
@endsection
