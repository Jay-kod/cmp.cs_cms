@extends('layouts.admin')
@section('title', 'System Settings')
@section('header', 'Department Settings')

@section('content')
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <h2 style="margin: 0; font-size: 1.1rem;">Global Configuration</h2>
    <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">Manage contact details, social links, and site-wide metadata.</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem;">
        
        <!-- Contact Information -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-address-book" style="color: var(--color-primary); margin-right: 8px;"></i> Contact Information</h3>
            
            <div class="form-group">
                <label class="form-label">Official Email</label>
                <input type="email" name="contact_email" value="{{ config('department.settings.contact_email', 'contact@dcms.edu') }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label class="form-label">Main Phone Number</label>
                <input type="text" name="contact_phone" value="{{ config('department.settings.contact_phone', '+1 234 567 8900') }}" class="form-control">
            </div>
            
            <div class="form-group">
                <label class="form-label">Physical Address</label>
                <textarea name="contact_address" class="form-control" rows="3">{{ config('department.settings.contact_address', 'Department of Computer Science, Faculty of Science Building, Main Campus.') }}</textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Google Maps Embed URL</label>
                <input type="text" name="map_embed_url" value="{{ config('department.settings.map_embed_url') }}" class="form-control" placeholder="https://www.google.com/maps/embed?pb=...">
            </div>
        </div>
        
        <!-- Social Media Links -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-hashtag" style="color: var(--color-secondary); margin-right: 8px;"></i> Social Media Presence</h3>
            
            <div class="form-group">
                <label class="form-label">Facebook URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #3b5998; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-facebook"></i></span>
                    <input type="url" name="social_facebook" value="{{ config('department.settings.social_facebook') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Twitter / X URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #000000; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-x-twitter"></i></span>
                    <input type="url" name="social_twitter" value="{{ config('department.settings.social_twitter') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #0077b5; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-linkedin"></i></span>
                    <input type="url" name="social_linkedin" value="{{ config('department.settings.social_linkedin') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">YouTube URL</label>
                <div style="display: flex; align-items: center; border: 1px solid #d1d5db; border-radius: 4px; overflow: hidden;">
                    <span style="background: #f3f4f6; padding: 0.6rem 0.8rem; color: #ff0000; border-right: 1px solid #d1d5db;"><i class="fa-brands fa-youtube"></i></span>
                    <input type="url" name="social_youtube" value="{{ config('department.settings.social_youtube') }}" class="form-control" style="border: none; border-radius: 0;">
                </div>
            </div>
        </div>

        <!-- Academic Configuration -->
        <div class="admin-card">
            <h3 style="margin-top: 0; font-size: 1.05rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.8rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-graduation-cap" style="color: var(--color-accent); margin-right: 8px;"></i> Academic Calendar</h3>
            
            <div class="form-group">
                <label class="form-label">Current Academic Year</label>
                <input type="text" name="academic_year" value="{{ config('department.settings.academic_year', '2023/2024') }}" class="form-control" placeholder="e.g. 2023/2024">
            </div>
            
            <div class="form-group">
                <label class="form-label">Current Semester</label>
                <select name="academic_semester" class="form-control">
                    <option value="1" {{ config('department.settings.academic_semester') == '1' ? 'selected' : '' }}>First Semester</option>
                    <option value="2" {{ config('department.settings.academic_semester') == '2' ? 'selected' : '' }}>Second Semester</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Admission Status</label>
                <select name="admission_status" class="form-control">
                    <option value="open" {{ config('department.settings.admission_status') == 'open' ? 'selected' : '' }}>Open for Applications</option>
                    <option value="closed" {{ config('department.settings.admission_status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
        </div>
        
    </div>
    
    <div style="margin-top: 2rem; padding: 1.5rem; background: white; border: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.8rem 2rem; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 1.05rem;"><i class="fa-solid fa-save"></i> Save All Settings</button>
    </div>
</form>
@endsection
