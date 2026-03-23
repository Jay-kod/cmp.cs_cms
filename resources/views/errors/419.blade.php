@extends('layouts.public')

@section('title', 'Session Expired')

@section('content')
<section style="padding: 4rem 0; background: #f8fafc;">
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 16px; border: 1px solid #e5e7eb; padding: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.04);">
            <div style="display:flex; align-items:flex-start; gap: 1.25rem; flex-wrap: wrap;">
                <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(239, 68, 68, 0.10); display:flex; align-items:center; justify-content:center; color:#dc2626; font-weight: 800; font-size: 1.3rem;">
                    419
                </div>
                <div style="flex: 1; min-width: 260px;">
                    <h1 style="margin: 0 0 0.5rem; color:#0f172a; font-size: 1.5rem; font-weight: 800;">Session expired</h1>
                    <p style="margin: 0; color:#475569; line-height: 1.7;">
                        Your form submission could not be completed because the session expired. Please try again.
                    </p>
                </div>
            </div>

            <div style="margin-top: 1.5rem; display:flex; gap: 0.75rem; flex-wrap: wrap;">
                <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; gap:0.5rem; background: var(--color-primary, #16a34a); color: white; padding: 0.7rem 1rem; border-radius: 10px; text-decoration:none; font-weight: 700;">
                    <i class="fa-solid fa-house"></i> Back to Home
                </a>
                @if(auth()->check())
                    <a href="{{ route('admin.dashboard') }}" style="display:inline-flex; align-items:center; gap:0.5rem; background: white; color: #334155; padding: 0.7rem 1rem; border-radius: 10px; text-decoration:none; font-weight: 700; border:1px solid #e5e7eb;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Admin Dashboard
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

