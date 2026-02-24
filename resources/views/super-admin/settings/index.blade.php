@extends('layouts.super-admin')
@section('title', 'System Settings')
@section('header', 'Department Settings')

@section('content')
@php
    $gs = fn(string $key, $default = '') => \App\Models\DepartmentSetting::where('key', $key)->value('value') ?? $default;
@endphp
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <h2 style="margin: 0; font-size: 1.1rem;">Global Configuration</h2>
    <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage contact details, social links, and site-wide metadata.</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem;">
        
        <!-- Contact Information -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-address-book" style="color: #b91c1c; margin-right: 8px;"></i> Contact Information</h3>
            
            <div class="form-group">
                <label class="form-label">Official Email</label>
                <input type="email" name="contact_email" value="{{ $gs('contact_email', 'contact@dcms.edu') }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label class="form-label">Main Phone Number</label>
                <input type="text" name="contact_phone" value="{{ $gs('contact_phone', '+1 234 567 8900') }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label class="form-label">Physical Address</label>
                <textarea name="contact_address" class="form-control" rows="3">{{ $gs('contact_address', 'Department of Computer Science, Faculty of Science Building, Main Campus.') }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Google Maps Embed URL</label>
                <input type="text" name="map_embed_url" value="{{ $gs('map_embed_url') }}" class="form-control" placeholder="https://www.google.com/maps/embed?pb=...">
            </div>
        </div>
        
        <!-- Social Media Links -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-hashtag" style="color: #991b1b; margin-right: 8px;"></i> Social Media Presence</h3>
            
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #3b5998; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-facebook"></i></span>
                    <input type="url" name="social_facebook" value="{{ $gs('social_facebook') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Twitter / X URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #000000; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-x-twitter"></i></span>
                    <input type="url" name="social_twitter" value="{{ $gs('social_twitter') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #0077b5; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-linkedin"></i></span>
                    <input type="url" name="social_linkedin" value="{{ $gs('social_linkedin') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">YouTube URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #ff0000; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-youtube"></i></span>
                    <input type="url" name="social_youtube" value="{{ $gs('social_youtube') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
        </div>

        <!-- Academic Configuration -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-graduation-cap" style="color: #b91c1c; margin-right: 8px;"></i> Academic Calendar</h3>
            
            <div class="form-group">
                <label class="form-label">Current Academic Year</label>
                <input type="text" name="academic_year" value="{{ $gs('academic_year', '2023/2024') }}" class="form-control" placeholder="e.g. 2023/2024">
            </div>
            
            <div class="form-group">
                <label class="form-label">Current Semester</label>
                <select name="academic_semester" class="form-control">
                    <option value="1" {{ $gs('academic_semester') == '1' ? 'selected' : '' }}>First Semester</option>
                    <option value="2" {{ $gs('academic_semester') == '2' ? 'selected' : '' }}>Second Semester</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Admission Status</label>
                <select name="admission_status" class="form-control">
                    <option value="open" {{ $gs('admission_status') == 'open' ? 'selected' : '' }}>Open for Applications</option>
                    <option value="closed" {{ $gs('admission_status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>

        <!-- Branding & Colors -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-palette" style="color: #b91c1c; margin-right: 8px;"></i> Branding Colors</h3>
            <p style="font-size: 0.85rem; color: #6b7280; margin-bottom: 1.5rem;">These colors are applied across the entire public website and admin panel. Changes take effect immediately.</p>
            
            <div class="form-group">
                <label class="form-label">Primary Color</label>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <input type="color" name="color_primary" value="{{ $brandColors['primary'] }}" style="width: 50px; height: 40px; border: 1px solid #d1d5db; border-radius: 4px; cursor: pointer; padding: 2px;">
                    <input type="text" value="{{ $brandColors['primary'] }}" class="form-control" style="flex: 1;" readonly onclick="this.previousElementSibling.click()" id="color_primary_text">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Secondary Color</label>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <input type="color" name="color_secondary" value="{{ $brandColors['secondary'] }}" style="width: 50px; height: 40px; border: 1px solid #d1d5db; border-radius: 4px; cursor: pointer; padding: 2px;">
                    <input type="text" value="{{ $brandColors['secondary'] }}" class="form-control" style="flex: 1;" readonly onclick="this.previousElementSibling.click()" id="color_secondary_text">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Accent Color</label>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <input type="color" name="color_accent" value="{{ $brandColors['accent'] }}" style="width: 50px; height: 40px; border: 1px solid #d1d5db; border-radius: 4px; cursor: pointer; padding: 2px;">
                    <input type="text" value="{{ $brandColors['accent'] }}" class="form-control" style="flex: 1;" readonly onclick="this.previousElementSibling.click()" id="color_accent_text">
                </div>
            </div>

            <div style="margin-top: 1.5rem; padding: 1rem; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px;">
                <p style="margin: 0 0 0.8rem 0; font-size: 0.85rem; font-weight: 600; color: #374151;">Live Preview</p>
                <div id="color-preview" style="display: flex; gap: 10px; align-items: center;">
                    <div id="preview-primary" style="width: 60px; height: 40px; border-radius: 6px; background: {{ $brandColors['primary'] }}; border: 1px solid #d1d5db;"></div>
                    <div id="preview-secondary" style="width: 60px; height: 40px; border-radius: 6px; background: {{ $brandColors['secondary'] }}; border: 1px solid #d1d5db;"></div>
                    <div id="preview-accent" style="width: 60px; height: 40px; border-radius: 6px; background: {{ $brandColors['accent'] }}; border: 1px solid #d1d5db;"></div>
                    <span style="font-size: 0.8rem; color: #6b7280; margin-left: 8px;">Primary / Secondary / Accent</span>
                </div>
            </div>
        </div>
        
    </div>
    
    <div style="margin-top: 2rem; padding: 1.5rem; background: white; border: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <button type="submit" class="btn btn-primary" style="background: #b91c1c; color: white; border: none; padding: 0.8rem 2rem; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 1.05rem;"><i class="fa-solid fa-save"></i> Save All Settings</button>
    </div>
</form>

<script>
    document.querySelectorAll('input[type="color"]').forEach(picker => {
        picker.addEventListener('input', function() {
            const name = this.name;
            const textInput = this.nextElementSibling;
            textInput.value = this.value;
            if (name === 'color_primary') document.getElementById('preview-primary').style.background = this.value;
            if (name === 'color_secondary') document.getElementById('preview-secondary').style.background = this.value;
            if (name === 'color_accent') document.getElementById('preview-accent').style.background = this.value;
        });
    });
</script>
@endsection
