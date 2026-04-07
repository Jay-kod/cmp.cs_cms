@extends('layouts.super-admin')
@section('title', 'Media Optimization (WebP)')
@section('header', 'Media Optimization (WebP)')

@section('content')
    @if(session('success'))
        <div style="background: #ecfdf5; color: #047857; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #a7f3d0; font-size: 0.9rem;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    <div data-aos="fade-up" class="admin-card" style="margin-bottom: 1.5rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
            <div>
                <h2 style="margin: 0 0 0.25rem; font-size: 1.05rem;">Conversion Queue Status</h2>
                <p style="margin: 0; color: #6b7280; font-size: 0.85rem;">
                    WebP derivatives (320/640/1024) are generated asynchronously. Originals remain as fallback.
                </p>
            </div>

            <form action="{{ route('super-admin.media-optimization.requeue-all') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="background: #111827; color: white; border: none; padding: 0.65rem 0.9rem; border-radius: 8px; cursor: pointer; font-weight: 800;">
                    Requeue All Non-Ready
                </button>
            </form>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; margin-top: 1.25rem;">
            @php
                $countPending = $statusCounts['pending'] ?? 0;
                $countProcessing = $statusCounts['processing'] ?? 0;
                $countReady = $statusCounts['ready'] ?? 0;
                $countFailed = $statusCounts['failed'] ?? 0;
            @endphp

            <div data-aos="fade-up" class="admin-card" style="background: #f8fafc; border: 1px solid #e5e7eb;">
                <div style="font-weight: 800; color: #f59e0b; margin-bottom: 0.25rem;">Pending</div>
                <div style="font-size: 1.6rem; font-weight: 900;">{{ $countPending }}</div>
            </div>
            <div data-aos="fade-up" class="admin-card" style="background: #f0f9ff; border: 1px solid #bae6fd;">
                <div style="font-weight: 800; color: #0ea5e9; margin-bottom: 0.25rem;">Processing</div>
                <div style="font-size: 1.6rem; font-weight: 900;">{{ $countProcessing }}</div>
            </div>
            <div data-aos="fade-up" class="admin-card" style="background: #ecfdf5; border: 1px solid #bbf7d0;">
                <div style="font-weight: 800; color: #10b981; margin-bottom: 0.25rem;">Ready</div>
                <div style="font-size: 1.6rem; font-weight: 900;">{{ $countReady }}</div>
            </div>
            <div data-aos="fade-up" class="admin-card" style="background: #fef2f2; border: 1px solid #fecaca;">
                <div style="font-weight: 800; color: #ef4444; margin-bottom: 0.25rem;">Failed</div>
                <div style="font-size: 1.6rem; font-weight: 900;">{{ $countFailed }}</div>
            </div>
        </div>
    </div>

    <div class="admin-table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Original Path</th>
                    <th style="width: 130px;">Status</th>
                    <th style="width: 160px;">WebP Ready Derivatives</th>
                    <th style="width: 110px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mediaFiles as $media)
                    @php
                        $ready = $media->derivatives->where('status', 'ready')->count();
                        $failed = $media->derivatives->where('status', 'failed')->count();
                    @endphp
                    <tr>
                        <td style="color: #94a3b8; font-weight: 700;">{{ $media->id }}</td>
                        <td style="max-width: 420px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $media->original_path }}
                        </td>
                        <td>
                            @if($media->status === 'ready')
                                <span style="color: #10B981; font-weight: bold;"><i class="fa-solid fa-check-circle"></i> Ready</span>
                            @elseif($media->status === 'failed')
                                <span style="color: #ef4444; font-weight: bold;"><i class="fa-solid fa-xmark-circle"></i> Failed</span>
                            @elseif($media->status === 'processing')
                                <span style="color: #0ea5e9; font-weight: bold;"><i class="fa-solid fa-spinner fa-spin"></i> Processing</span>
                            @else
                                <span style="color: #f59e0b; font-weight: bold;"><i class="fa-solid fa-hourglass-half"></i> Pending</span>
                            @endif
                        </td>
                        <td style="font-size: 0.9rem;">
                            {{ $ready }}/3 Ready
                            @if($failed > 0)
                                <span style="color: #ef4444; font-weight: 700;"> ({{ $failed }} failed)</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('super-admin.media-optimization.requeue', $media) }}" method="POST">
                                @csrf
                                <button type="submit" style="background: #111827; color: white; border: none; padding: 0.55rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: 700;">
                                    Requeue
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 3rem 1rem;">
                            <div class="empty-state" style="display: flex; flex-direction: column; align-items: center;">
                                <i class="fa-solid fa-file-image" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                                <h3 style="margin: 0 0 0.5rem; color: #334155; font-size: 1.2rem;">No Media Optimizations Found</h3>
                                <p style="margin: 0; color: #64748b;">Upload images from the admin panel to start conversions.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

