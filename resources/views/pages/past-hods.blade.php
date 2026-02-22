@extends('layouts.public')
@section('title', 'Past Heads of Department')

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 0;">Past Heads of Department</h1>
        <p style="margin-top: 1rem; color: rgba(255,255,255,0.8); font-size: 1.1rem;">Honoring the leaders who have driven our department forward</p>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: var(--spacing-lg); margin-bottom: var(--spacing-xl);">
    <div class="main-content" style="width: 100%;">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-lg);">
            @forelse($hods as $h)
            <div style="background: var(--color-bg-main); border: 1px solid var(--color-border); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: transform 0.3s; padding-bottom: 1.5rem;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="height: 120px; background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-primary) 100%); position: relative; margin-bottom: 60px;">
                    <img src="{{ $h->photo ? asset('storage/'.$h->photo) : asset('images/avatar-placeholder.png') }}" alt="{{ $h->name }}" style="width: 110px; height: 110px; border-radius: 50%; border: 4px solid white; position: absolute; bottom: -55px; left: 50%; transform: translateX(-50%); object-fit: cover; background: white;" onerror="this.src='https://via.placeholder.com/150?text=HOD'">
                </div>
                
                <div style="padding: 0 1.5rem; text-align: center;">
                    <h3 style="margin: 0; font-size: 1.3rem; color: var(--color-primary);">{{ $h->name }}</h3>
                    <div style="display: inline-block; background: var(--color-bg-alt); padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; color: var(--color-secondary); margin: 0.8rem 0;">
                        {{ $h->tenure_start ?? 'Unknown' }} – {{ $h->tenure_end ?? 'Present' }}
                    </div>
                    
                    @if($h->bio)
                        <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; border-top: 1px solid var(--color-border); padding-top: 1rem; margin-top: 0.5rem; text-align: left;">
                            {{ $h->bio }}
                        </p>
                    @endif
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; background: var(--color-bg-alt); border-radius: 12px; border: 1px dashed var(--color-border);">
                <i class="fa-solid fa-users-slash" style="font-size: 3rem; color: var(--color-text-muted); margin-bottom: 1rem;"></i>
                <h3 style="margin: 0 0 0.5rem 0;">No Records Found</h3>
                <p style="color: var(--color-text-muted); margin: 0;">Past HOD profiles will appear here once added by the administration.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
