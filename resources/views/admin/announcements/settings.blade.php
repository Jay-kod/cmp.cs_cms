@extends($adminLayout ?? 'layouts.admin')
@section('title', 'Manage Announcement Ticker')
@section('header', 'Ticker Settings')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h2 style="margin: 0; font-size: 1.25rem; font-weight: 600; color: #1f2937;">Notice Ticker Settings</h2>
        <p style="margin: 0.2rem 0 0; color: #64748b; font-size: 0.88rem;">Manage the animation speed of the glassmorphism announcements ticker on the homepage.</p>
    </div>
    <div style="display: flex; gap: 0.6rem;">
        @php
            $prefix = request()->route()->getPrefix();
            $routePrefix = $prefix === '/super-admin' ? 'super-admin.' : 'admin.';
        @endphp
        <a href="{{ route($routePrefix . 'announcements.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #f8fafc; color: #475569; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; font-size: 0.85rem; border: 1px solid #cbd5e1; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05); transition: background 0.2s;">
            <i class="fa-solid fa-arrow-left"></i> Back to Announcements
        </a>
    </div>
</div>

@if($errors->any())
<div style="background: #fef2f2; color: #b91c1c; padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #fecaca; font-size: 0.9rem;">
    <ul style="margin: 0; padding-left: 1.5rem;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('announcements.settings.update') }}" method="POST" class="admin-card" style="display: flex; flex-direction: column; gap: 1.5rem; max-width: 900px; margin: 0 auto; padding: 2rem;">
    @csrf

    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div>
            <label for="speed" style="display: block; font-weight: 600; font-size: 0.9rem; color: #334155; margin-bottom: 0.5rem; letter-spacing: 0.2px;">
                Scroll Duration (Seconds)
            </label>
            <p style="color: #64748b; font-size: 0.85rem; margin: 0 0 1rem;">
                Set the time it takes for the ticker to complete one full scroll. A lower number means a faster scroll. 
                Default is ~10-20 seconds depending on the number of announcements.
            </p>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <input type="range" name="speed" id="speedRange" value="{{ old('speed', $speed) }}" min="2" max="120" step="1" 
                    style="flex: 1; accent-color: var(--color-primary); cursor: pointer;"
                    oninput="document.getElementById('speedNumber').value = this.value; updatePreview();">
                <input type="number" id="speedNumber" value="{{ old('speed', $speed) }}" min="2" max="120" 
                    style="width: 80px; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; text-align: center; font-weight: 600;"
                    oninput="document.getElementById('speedRange').value = this.value; updatePreview();">
                <span style="color: #64748b; font-size: 0.9rem;">seconds</span>
            </div>
        </div>
        
        <div style="background: #f1f5f9; border-radius: 12px; padding: 1.5rem; border: 1px dashed #cbd5e1; margin-top: 1rem;">
            <h3 style="margin: 0 0 1rem; font-size: 1rem; color: #1e293b; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-eye" style="color: var(--color-primary);"></i> Live Preview
            </h3>
            
            <!-- Glassmorphism Preview Box acting like the Hero -->
            <div style="position: relative; overflow: hidden; height: 150px; background: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=600&auto=format&fit=crop') center/cover no-repeat; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.8));"></div>
                
                <!-- The Actual Ticker Preview -->
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; z-index: 20; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(12px); border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 2px solid var(--color-primary);">
                    <div style="display: flex; align-items: center; gap: 1rem; padding: 0.6rem 1rem;">
                        <div style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary)); color: #fff; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.65rem; font-weight: 800; text-transform: uppercase; white-space: nowrap; letter-spacing: 1px; box-shadow: 0 0 8px rgba(22, 163, 74, 0.8), inset 0 0 3px rgba(255, 255, 255, 0.2); display: flex; align-items: center; gap: 0.4rem; border: 1px solid rgba(255,255,255,0.2); position: relative; z-index: 2;">
                            <i class="fa-solid fa-bolt" style="font-size: 0.6rem;"></i> Notice
                        </div>
                        <div style="overflow: hidden; flex: 1;">
                            <style>
                                @keyframes scrollAnnouncementsPreview {
                                    0% { transform: translateX(0); }
                                    100% { transform: translateX(-100%); }
                                }
                            </style>
                            <div id="previewScrollBox" style="display: flex; gap: 4rem; animation: scrollAnnouncementsPreview {{ old('speed', $speed) }}s linear infinite; white-space: nowrap; padding-left: 100%;">
                                @foreach($activeAnnouncements as $announcement)
                                <span style="color: #cbd5e1; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 0.6rem;">
                                    <strong style="color: white; font-weight: 600;">{{ $announcement->title }} <span style="color: #64748b; font-weight: 400; margin: 0 0.3rem;">&mdash;</span></strong> {{ Str::limit($announcement->body ?? 'This is a sample announcement body for the preview to test how the scroll speed looks on a real monitor.', 120) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
        <button type="submit" style="background: var(--color-primary); color: white; border: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; gap: 0.6rem; box-shadow: 0 4px 6px -1px rgba(22, 163, 74, 0.2), 0 2px 4px -2px rgba(22, 163, 74, 0.1); transition: all 0.2s; letter-spacing: 0.3px;">
            <i class="fa-solid fa-save"></i> Save Settings
        </button>
    </div>
</form>

<script>
    function updatePreview() {
        const speed = document.getElementById('speedRange').value;
        const box = document.getElementById('previewScrollBox');
        
        // Reset animation to apply changes instantly
        box.style.animation = 'none';
        box.offsetHeight; /* trigger reflow */
        box.style.animation = `scrollAnnouncementsPreview ${speed}s linear infinite`;
    }
</script>
@endsection