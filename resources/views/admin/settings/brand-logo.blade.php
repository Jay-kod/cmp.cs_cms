@extends('layouts.admin')

@section('title', 'Brand Identity')
@section('header', 'Brand Identity & Design')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding-top: 1rem;">

    <div style="margin-bottom: 2rem;">
        <h2 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 40px; height: 40px; background: rgba(22, 163, 74, 0.1); color: var(--color-primary); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-gem text-lg"></i>
            </div>
            Brand Identity Settings
        </h2>
        <p style="margin: 0; color: #64748b; font-size: 0.95rem; padding-left: 3.25rem;">
            Upload your university logo and favicon. These instantly propagate across the portal, frontend, and all academic documents.
        </p>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #10b981; color: #047857; padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 500;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update-brand-logo') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="admin-card" style="padding: 2.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05); margin-bottom: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                
                <div style="display: flex; flex-direction: column;">
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="margin: 0 0 0.25rem 0; font-size: 1.1rem; color: #0f172a; font-weight: 600;">Main Institution Logo</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: #64748b;">Typically a .png format with a transparent background. Max 2MB.</p>
                    </div>

                    <div style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 2rem; text-align: center; flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.backgroundColor='#f0fdf4';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                        <div style="width: 140px; height: 140px; background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 1rem;">
                            <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="Current Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                        <div style="width: 100%;">
                            <label for="logoInput" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.5rem 1.25rem; border-radius: 6px; font-size: 0.9rem; font-weight: 500; cursor: pointer; border: 1px solid var(--color-primary); box-shadow: 0 2px 4px rgba(22, 163, 74, 0.1); margin-bottom: 0.5rem; transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='var(--color-primary)';">
                                <i class="fa-solid fa-cloud-arrow-up" style="margin-right: 0.4rem;"></i> Browse Image
                            </label>
                            <input type="file" id="logoInput" name="logo" style="display: none;" accept="image/png,image/jpeg,image/svg+xml,image/webp" onchange="document.getElementById('logoFileName').textContent = this.files[0] ? this.files[0].name : 'No file chosen'; document.getElementById('logoFileName').style.color='var(--color-primary)'">
                            <div id="logoFileName" style="font-size: 0.8rem; color: #64748b; font-weight: 600; word-break: break-all; margin-top: 0.2rem;">No file chosen</div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column;">
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="margin: 0 0 0.25rem 0; font-size: 1.1rem; color: #0f172a; font-weight: 600;">Tab Icon (Favicon)</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: #64748b;">The tiny icon in the browser tab. Recommended size: 64x64px.</p>
                    </div>

                    <div style="background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 12px; padding: 2rem; text-align: center; flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--color-primary)'; this.style.backgroundColor='#f0fdf4';" onmouseout="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';">
                        <div style="width: 80px; height: 80px; background: white; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; padding: 0.5rem;">
                            <img src="{{ asset('images/logo-favicon.png') }}?v={{ time() }}" alt="Current Favicon" style="max-width: 40px; max-height: 40px;">
                        </div>
                        <div style="width: 100%;">
                            <label for="faviconInput" style="display: inline-block; background: white; color: var(--color-primary); padding: 0.5rem 1.25rem; border-radius: 6px; font-size: 0.9rem; font-weight: 500; cursor: pointer; border: 1px solid var(--color-primary); box-shadow: 0 2px 4px rgba(22, 163, 74, 0.1); margin-bottom: 0.5rem; transition: all 0.2s;" onmouseover="this.style.background='var(--color-primary)'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='var(--color-primary)';">
                                <i class="fa-solid fa-cloud-arrow-up" style="margin-right: 0.4rem;"></i> Browse Image
                            </label>
                            <input type="file" id="faviconInput" name="favicon" style="display: none;" accept=".ico,image/png" onchange="document.getElementById('faviconFileName').textContent = this.files[0] ? this.files[0].name : 'No file chosen'; document.getElementById('faviconFileName').style.color='var(--color-primary)'">
                            <div id="faviconFileName" style="font-size: 0.8rem; color: #64748b; font-weight: 600; word-break: break-all; margin-top: 0.2rem;">No file chosen</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; align-items: center; gap: 1.5rem;">
            <a href="{{ route('admin.dashboard') }}" style="color: #64748b; text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#0f172a';" onmouseout="this.style.color='#64748b';">Cancel</a>
            <button type="submit" style="background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light)); color: white; border: none; padding: 0.85rem 2.5rem; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; box-shadow: 0 4px 10px rgba(22, 163, 74, 0.25); transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 15px rgba(22, 163, 74, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(22, 163, 74, 0.25)';">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                Save Identity Changes
            </button>
        </div>
    </form>

</div>
@endsection
