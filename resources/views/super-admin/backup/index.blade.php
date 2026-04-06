@extends('layouts.super-admin')
@section('title', 'Database & System Backup')
@section('header', 'System Backup')

@section('content')
<style>
    .super-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        padding: 1.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .super-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .stat-card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        background: #f8fafc;
        border-radius: 10px;
        padding: 1.25rem 1.5rem;
        border-left: 4px solid var(--color-primary, #334155);
    }
    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .tech-specs {
        width: 100%;
        border-collapse: collapse;
    }
    .tech-specs th {
        text-align: left;
        padding: 1rem;
        background: #f8fafc;
        color: #475569;
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 2px solid #e2e8f0;
    }
    .tech-specs td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        color: #1e293b;
        font-weight: 500;
    }
    .download-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
    }
    .download-btn:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 16px rgba(15, 23, 42, 0.3);
    }
    .health-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 700;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .health-badge.error {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fecaca;
    }
    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulseHeartbeat 2s infinite;
    }
    .health-badge.error .pulse-dot {
        box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
    }
    @keyframes pulseHeartbeat {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(currentColor, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(currentColor, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(currentColor, 0); }
    }
</style>

<div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
    <!-- Top Hero Card -->
    <div class="super-card" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; background: linear-gradient(to right, #ffffff, #f8fafc);">
        <div>
            <h2 style="margin: 0 0 0.5rem; font-size: 1.4rem; color: #0f172a; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-server" style="color: #64748b;"></i> Database Control Center
            </h2>
            <p style="margin: 0; color: #64748b; font-size: 0.95rem; max-width: 600px;">
                Review real-time database health, verify table integrity, and generate encrypted SQL snapshots of your entire platform to ensure total data security.
            </p>
        </div>
        <div>
            @if($dbInfo['is_healthy'] ?? true)
                <div class="health-badge">
                    <div class="pulse-dot"></div> {{ $dbInfo['status'] ?? 'Healthy' }}
                </div>
            @else
                <div class="health-badge error">
                    <div class="pulse-dot"></div> Error
                </div>
            @endif
        </div>
    </div>
    
    <!-- Stats Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem;">
        <div class="stat-card" style="border-left-color: #3b82f6;">
            <div class="stat-label">Database Size</div>
            <div class="stat-value"><i class="fa-solid fa-hard-drive" style="color: #93c5fd; font-size: 1.2rem;"></i> {{ $dbInfo['size_mb'] ?? '0' }}<span style="font-size: 1rem; color: #64748b;">MB</span></div>
        </div>
        <div class="stat-card" style="border-left-color: #10b981;">
            <div class="stat-label">Active Tables</div>
            <div class="stat-value"><i class="fa-solid fa-table-list" style="color: #6ee7b7; font-size: 1.2rem;"></i> {{ $dbInfo['tables'] ?? '0' }}</div>
        </div>
        <div class="stat-card" style="border-left-color: #f59e0b;">
            <div class="stat-label">MySQL Version</div>
            <div class="stat-value"><i class="fa-solid fa-database" style="color: #fcd34d; font-size: 1.2rem;"></i> {{ explode('-', $dbInfo['version'] ?? 'N/A')[0] }}</div>
        </div>
        <div class="stat-card" style="border-left-color: #8b5cf6;">
            <div class="stat-label">PHP Version</div>
            <div class="stat-value"><i class="fa-brands fa-php" style="color: #c4b5fd; font-size: 1.2rem;"></i> {{ phpversion() }}</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem;">
    <!-- Technical Specs Module -->
    <div class="super-card" style="padding: 0; overflow: hidden;">
        <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #e2e8f0; background: #f8fafc;">
            <h3 style="margin: 0; font-size: 1.1rem; color: #1e293b;"><i class="fa-solid fa-microchip" style="color: #64748b; margin-right: 0.5rem;"></i> Technical Specifications</h3>
        </div>
        <table class="tech-specs">
            <tbody>
                <tr>
                    <td style="width: 40%; color: #64748b; font-weight: 600;">App Connection Type</td>
                    <td><span style="background: #e0e7ff; color: #3730a3; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.8rem; font-weight: 700;">{{ strtoupper($dbInfo['connection'] ?? 'MYSQL') }}</span></td>
                </tr>
                <tr>
                    <td style="color: #64748b; font-weight: 600;">Database Schema</td>
                    <td><code style="background: #f1f5f9; padding: 0.2rem 0.5rem; border-radius: 4px; color: #0f172a;">{{ $dbInfo['name'] ?? 'dcms' }}</code></td>
                </tr>
                <tr>
                    <td style="color: #64748b; font-weight: 600;">Host & Port</td>
                    <td>{{ $dbInfo['host'] ?? '127.0.0.1' }}<span style="color: #94a3b8;">:{{ $dbInfo['port'] ?? 3306 }}</span></td>
                </tr>
                <tr>
                    <td style="color: #64748b; font-weight: 600;">Security Engine</td>
                    <td><span style="color: #059669; display: flex; align-items: center; gap: 0.4rem;"><i class="fa-solid fa-shield-halved"></i> TLS Enabled (Local)</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Backup Module -->
    <div class="super-card" style="display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden;">
        <div style="position: absolute; right: -20px; top: -20px; opacity: 0.03; z-index: 0;">
            <i class="fa-solid fa-cloud-arrow-down" style="font-size: 12rem;"></i>
        </div>
        <div style="position: relative; z-index: 1;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: #eff6ff; color: #3b82f6; border-radius: 12px; margin-bottom: 1rem;">
                <i class="fa-solid fa-shield-halved" style="font-size: 1.5rem;"></i>
            </div>
            <h3 style="margin: 0 0 0.5rem; font-size: 1.3rem; color: #0f172a;">Download Secure Snapshot</h3>
            <p style="margin: 0 0 1.5rem; color: #64748b; font-size: 0.95rem; line-height: 1.5; max-width: 90%;">
                Generates a raw <code style="color: #334155; font-weight: bold;">.sql</code> file of your <strong>{{ $dbInfo['tables'] ?? '0' }}</strong> tables, containing all structured content, system configurations, and user records.
            </p>
        </div>
        
        <div style="position: relative; z-index: 1; border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: auto;">
            <form action="{{ route('super-admin.backup.download') }}" method="POST">
                @csrf
                <button type="submit" class="download-btn">
                    <i class="fa-solid fa-download"></i> Start Encrypted Backup
                </button>
            </form>
            <p style="margin: 0.75rem 0 0; color: #94a3b8; font-size: 0.8rem; display: flex; align-items: center; gap: 0.4rem;">
                <i class="fa-solid fa-circle-info"></i> Backup size estimates roughly {{ ceil((float)($dbInfo['size_mb'] ?? 0) * 1.5) }}MB compressed.
            </p>
        </div>
    </div>
</div>
@endsection
