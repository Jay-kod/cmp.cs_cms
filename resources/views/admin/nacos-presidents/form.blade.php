@extends($adminLayout ?? 'layouts.admin')
@section('title', $president->exists ? 'Edit President' : 'Add President')
@section('header', $president->exists ? 'Edit NACOS President' : 'Add New NACOS President')

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

    <form action="{{ $president->exists ? route('admin.nacos-presidents.update', $president) : route('admin.nacos-presidents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($president->exists) @method('PUT') @endif
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <!-- Column 1 -->
            <div>
                <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Personal Details</h3>
                
                <div class="form-group">
                    <label class="form-label">Full Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $president->name) }}" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Profile Photo</label>
                    @if($president->photo)
                        <div style="margin-bottom: 0.8rem; display: flex; align-items: center; gap: 10px;">
                            <img src="{{ asset('storage/'.$president->photo) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 50%; border: 1px solid #e5e7eb;">
                            <span style="font-size: 0.8rem; color: #6b7280;">Current photo</span>
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control" accept="image/*">
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Biography / Achievements</label>
                    <textarea name="bio" class="form-control" rows="4" placeholder="Brief outline of their achievements in office...">{{ old('bio', $president->bio) }}</textarea>
                </div>
            </div>

            <!-- Column 2 -->
            <div>
                <h3 style="margin-top: 0; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Tenure & Status</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label">Tenure Start</label>
                        <input type="text" name="tenure_start" value="{{ old('tenure_start', $president->tenure_start) }}" class="form-control" placeholder="e.g. 2018">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Tenure End</span>
                            <span id="computed-status-pill" style="display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 12px; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px;">-</span>
                        </label>
                        <input type="text" name="tenure_end" id="tenure_end_input" value="{{ old('tenure_end', $president->tenure_end) }}" class="form-control" placeholder="e.g. 2019 or Present">
                        <small style="display: block; margin-top: 0.4rem; color: #6b7280; font-size: 0.75rem;">
                            The homepage will automatically tag this leader as <strong style="color: #0ea5e9;">CURRENT</strong>, <strong style="color: #f59e0b;">JUST GRADUATED</strong>, or <strong style="color: #64748b;">PAST</strong> based on this year.
                        </small>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label">Current Status</label>
                    <select name="current_status" class="form-control">
                        <option value="" {{ old('current_status', $president->current_status) ? '' : 'selected' }}>Automatic (Calculated from Tenure)</option>
                        <option value="CURRENT PRESIDENT" {{ old('current_status', $president->current_status) == 'CURRENT PRESIDENT' ? 'selected' : '' }}>CURRENT PRESIDENT</option>
                        <option value="JUST GRADUATED" {{ old('current_status', $president->current_status) == 'JUST GRADUATED' ? 'selected' : '' }}>JUST GRADUATED</option>
                        <option value="PAST" {{ old('current_status', $president->current_status) == 'PAST' ? 'selected' : '' }}>PAST</option>
                    </select>
                </div>
                
                <h3 style="margin-top: 2rem; font-size: 0.95rem; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.5rem; margin-bottom: 1rem;">Contact Info (Optional)</h3>
                
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-envelope" style="color: #6b7280; margin-right: 5px;"></i> Gmail Address</label>
                    <input type="email" name="email" value="{{ old('email', $president->email) }}" class="form-control" placeholder="e.g. president@example.com">
                </div>
                
                <div class="form-group">
                    <label class="form-label"><i class="fa-brands fa-whatsapp" style="color: #25D366; margin-right: 5px;"></i> WhatsApp Number</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $president->whatsapp) }}" class="form-control" placeholder="e.g. +2348012345678">
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label"><i class="fa-brands fa-facebook-f" style="color: #3b82f6; margin-right: 5px;"></i> Facebook URL</label>
                    <input type="text" name="facebook" value="{{ old('facebook', $president->facebook) }}" class="form-control" placeholder="e.g. https://facebook.com/yourpage">
                </div>

                <div class="form-group" style="margin-top: 1rem;">
                    <label class="form-label"><i class="fa-brands fa-x-twitter" style="color: #111827; margin-right: 5px;"></i> X (Twitter) URL</label>
                    <input type="text" name="x" value="{{ old('x', $president->x) }}" class="form-control" placeholder="e.g. https://x.com/yourhandle">
                </div>
            </div>
            
        </div>
        
        <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end; gap: 1rem;">
            <a href="{{ route('admin.nacos-presidents.index') }}" class="btn btn-secondary" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 0.6rem 1.2rem; text-decoration: none; border-radius: 4px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; font-weight: bold; cursor: pointer;">{{ $president->exists ? 'Update President' : 'Save President' }}</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('tenure_end_input');
    const pill = document.getElementById('computed-status-pill');
    
    if(!input || !pill) return;

    function updatePill() {
        const val = input.value.trim().toLowerCase();
        const currentYear = new Date().getFullYear();
        
        if (!val || val === 'present' || val === 'current') {
            pill.textContent = 'CURRENT PRESIDENT';
            pill.style.backgroundColor = 'rgba(14, 165, 233, 0.1)';
            pill.style.color = '#0ea5e9';
            pill.style.border = '1px solid rgba(14, 165, 233, 0.2)';
        } else {
            const endYear = parseInt(val, 10);
            if (!isNaN(endYear) && endYear >= currentYear - 1) {
                pill.textContent = 'JUST GRADUATED';
                pill.style.backgroundColor = 'rgba(245, 158, 11, 0.1)';
                pill.style.color = '#f59e0b';
                pill.style.border = '1px solid rgba(245, 158, 11, 0.2)';
            } else {
                pill.textContent = 'PAST';
                pill.style.backgroundColor = 'rgba(100, 116, 139, 0.1)';
                pill.style.color = '#64748b';
                pill.style.border = '1px solid rgba(100, 116, 139, 0.2)';
            }
        }
    }
    
    input.addEventListener('input', updatePill);
    updatePill(); // initialize on load
});
</script>

@endsection
