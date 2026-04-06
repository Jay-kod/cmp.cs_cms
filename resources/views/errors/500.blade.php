@extends('layouts.error')

@section('title', 'Server Error')

@section('content')
<section style="padding: 4rem 0; background: #f8fafc;">
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 16px; border: 1px solid #e5e7eb; padding: 2rem; box-shadow: 0 10px 25px rgba(0,0,0,0.04);">
            <div style="display:flex; align-items:flex-start; gap: 1.25rem; flex-wrap: wrap;">
                <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(239, 68, 68, 0.12); display:flex; align-items:center; justify-content:center; color:#dc2626; font-weight: 800; font-size: 1.3rem;">
                    500
                </div>
                <div style="flex: 1; min-width: 260px;">
                    <h1 style="margin: 0 0 0.5rem; color:#0f172a; font-size: 1.5rem; font-weight: 800;">Something went wrong</h1>
                    <p style="margin: 0; color:#475569; line-height: 1.7;">
                        The server encountered an unexpected condition and was unable to complete your request.
                    </p>
                </div>
            </div>

            <div style="margin-top: 1.5rem; display:flex; gap: 0.75rem; flex-wrap: wrap;">
                <a href="{{ url('/') }}" style="display:inline-flex; align-items:center; gap:0.5rem; background: var(--color-primary, #16a34a); color: white; padding: 0.7rem 1rem; border-radius: 10px; text-decoration:none; font-weight: 700;">
                    <i class="fa-solid fa-house"></i> Back to Home
                </a>
                <a href="{{ url('/contact') }}" style="display:inline-flex; align-items:center; gap:0.5rem; background: white; color: #334155; padding: 0.7rem 1rem; border-radius: 10px; text-decoration:none; font-weight: 700; border:1px solid #e5e7eb;">
                    <i class="fa-solid fa-envelope"></i> Contact Support
                </a>
            </div>

            @if(config('app.debug'))
                <div style="margin-top: 1.25rem; padding-top: 1.25rem; border-top: 1px solid #e5e7eb; color:#334155; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">
                    Debug mode is enabled; additional details may be available in logs.
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

