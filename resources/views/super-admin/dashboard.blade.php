@extends('layouts.admin')
@section('title', 'Super Admin Dashboard')
@section('header', 'System Overview')

@section('content')
<div class="dashboard-header">
    <div>
        <h2 class="dashboard-title">System Control Panel ⚙️</h2>
        <p class="dashboard-subtitle">Manage users, global settings, and system vitals.</p>
    </div>
    <div class="dashboard-date-widget">
        <div class="date-label">System Date</div>
        <div class="date-value">{{ now()->format('l, jS F Y') }}</div>
    </div>
</div>

<div class="dashboard-stats-grid">
    <!-- Admin Staff Card -->
    <div class="admin-card stat-card" style="border-left: 4px solid #3b82f6;">
        <div class="stat-card-bg-circle color-blue"></div>
        <div class="stat-content">
            <h3 class="stat-label">Total Admins</h3>
            <p class="stat-value">{{ $stats['totalAdmins'] }}</p>
        </div>
        <div class="stat-icon-box color-blue">
            <i class="fa-solid fa-users-gear"></i>
        </div>
    </div>
    
    <!-- Super Admins Card -->
    <div class="admin-card stat-card" style="border-left: 4px solid #f59e0b;">
        <div class="stat-card-bg-circle color-orange"></div>
        <div class="stat-content">
            <h3 class="stat-label">Super Admins</h3>
            <p class="stat-value">{{ $stats['totalSuperAdmins'] }}</p>
        </div>
        <div class="stat-icon-box color-orange">
            <i class="fa-solid fa-id-badge"></i>
        </div>
    </div>
    
    <!-- External Systems Card -->
    <div class="admin-card stat-card" style="border-left: 4px solid #10b981;">
        <div class="stat-card-bg-circle color-green"></div>
        <div class="stat-content">
            <h3 class="stat-label">External Systems</h3>
            <p class="stat-value">{{ $stats['totalExternalSystems'] }}</p>
        </div>
        <div class="stat-icon-box color-green">
            <i class="fa-solid fa-server"></i>
        </div>
    </div>
    
    <!-- Settings Configured Card -->
    <div class="admin-card stat-card" style="border-left: 4px solid #8b5cf6;">
        <div class="stat-card-bg-circle color-purple"></div>
        <div class="stat-content">
            <h3 class="stat-label">System Settings</h3>
            <p class="stat-value" style="font-size: 1.5rem; display: flex; align-items: center; gap: 8px;">
                @if($stats['settingsConfigured'])
                    <i class="fa-solid fa-check-circle" style="color: #10b981;"></i> Configured
                @else
                    <i class="fa-solid fa-triangle-exclamation" style="color: #ef4444;"></i> Pending
                @endif
            </p>
        </div>
        <div class="stat-icon-box color-purple">
            <i class="fa-solid fa-sliders"></i>
        </div>
    </div>
</div>

<div class="dashboard-panels-grid">
    <!-- Recent Users Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-user-shield" style="color: var(--color-primary);"></i> Recent Admin Activity
            </h3>
            <a href="{{ route('admin.users.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New User</a>
        </div>
        
        <div class="panel-body">
            @forelse($recentUsers as $user)
            <div class="panel-list-item">
                <div class="news-list-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="item-content">
                    <h4 class="item-title">
                        <a href="{{ route('admin.users.edit', $user) }}" class="item-link">{{ $user->name }}</a>
                    </h4>
                    <div class="item-meta">
                        <span><i class="fa-regular fa-envelope"></i> {{ $user->email }}</span>
                        <span class="meta-dot"></span>
                        <span class="meta-badge" style="background: {{ $user->isSuperAdmin() ? '#fef3c7' : '#e0e7ff' }}; color: {{ $user->isSuperAdmin() ? '#d97706' : '#4338ca' }};">
                            {{ $user->role_label }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="panel-empty-state">
                <i class="fa-solid fa-users-slash panel-empty-icon"></i>
                <p class="panel-empty-text">No active admin users found.</p>
            </div>
            @endforelse
        </div>
        
        <div class="panel-footer">
            <a href="{{ route('admin.users.index') }}" class="panel-view-all">
                Manage All Users <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
    
    <!-- System Status Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-database" style="color: var(--color-primary);"></i> System Health
            </h3>
        </div>
        
        <div class="panel-body" style="padding-top: 1.5rem; padding-bottom: 1.5rem;">
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #334155; font-size: 1rem; display: block;">Latest Database Backup</strong>
                    <span style="color: #64748b; font-size: 0.85rem;">
                        {{ $stats['lastBackupDate'] ? $stats['lastBackupDate'] : 'No backups discovered' }}
                    </span>
                </div>
                <a href="{{ route('admin.backup.index') }}" class="btn btn-secondary" style="padding: 0.4rem 1rem; border-radius: 6px; background: white; border: 1px solid #cbd5e1; color: #475569; text-decoration: none; font-size: 0.85rem;">
                    Go to Backups
                </a>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #334155; font-size: 1rem; display: block;">Global Settings</strong>
                    <span style="color: #64748b; font-size: 0.85rem;">Control UI colors and department attributes</span>
                </div>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary" style="padding: 0.4rem 1rem; border-radius: 6px; background: white; border: 1px solid #cbd5e1; color: #475569; text-decoration: none; font-size: 0.85rem;">
                    Edit Settings
                </a>
            </div>
            
        </div>
    </div>
</div>
@endsection
