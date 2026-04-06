@extends('layouts.super-admin')
@section('title', 'Super Admin Dashboard')
@section('header', 'System Overview')

@section('content')
<div class="dashboard-header" style="flex-wrap: wrap; gap: 1.5rem;">
    <div style="flex: 1; min-width: 280px;">
        <h2 class="dashboard-title">System Control Panel <i class="fa-solid fa-shield-halved" style="color: #b91c1c;"></i></h2>
        <p class="dashboard-subtitle">Full system oversight — manage content, users, and settings from one place.</p>
    </div>
    <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
        <div class="dashboard-date-widget" style="margin: 0; padding: 1rem; background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; flex-direction: column; justify-content: center;">
            <div class="date-label" style="font-size: 0.8rem; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; text-align: left;">System Date</div>
            <div class="date-value" style="font-size: 1.1rem; color: #111827; font-weight: 700; text-align: left;">{{ now()->format('l, jS F Y') }}</div>
        </div>

        <div style="padding: 0.75rem 1rem; background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); flex: 1; min-width: 320px;">
            <div style="font-size: 0.8rem; color: var(--color-primary, #b91c1c); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; margin-bottom: 0.4rem;">Academic Session & Semester</div>
            <form action="{{ route('admin.settings.academic-session') }}" method="POST" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                @csrf
                <input type="text" name="academic_session" value="{{ \App\Models\DepartmentSetting::getCached('academic_session', '2024/2025') }}" placeholder="e.g. 2025/2026" required style="padding: 0.45rem 0.6rem; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.95rem; width: 110px; outline: none; flex-grow: 1;">
                <select name="academic_semester" required style="padding: 0.45rem 0.6rem; border: 1px solid #d1d5db; border-radius: 4px; font-size: 0.95rem; outline: none; flex-grow: 2; min-width: 140px;">
                    @php $curSem = \App\Models\DepartmentSetting::getCached('academic_semester', 'First'); @endphp
                    <option value="First" {{ $curSem == 'First' ? 'selected' : '' }}>First Semester</option>
                    <option value="Second" {{ $curSem == 'Second' ? 'selected' : '' }}>Second Semester</option>
                    <option value="Third" {{ $curSem == 'Third' ? 'selected' : '' }}>Third Semester</option>
                </select>
                <button type="submit" style="background: var(--color-primary, #b91c1c); color: white; border: none; padding: 0.45rem 1rem; border-radius: 4px; font-weight: 600; cursor: pointer; transition: background 0.2s; flex-grow: 1;">Set</button>
            </form>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     SYSTEM STATS (Super Admin Exclusive)
     ═══════════════════════════════════════════════ --}}
<div style="margin-bottom: 2rem;">
    <h3 style="font-size: 1rem; font-weight: 700; color: #b91c1c; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        <i class="fa-solid fa-users-gear"></i> User & System Overview
    </h3>
    <div class="dashboard-stats-grid">
        <div class="admin-card stat-card" style="border-left: 4px solid #b91c1c;">
            <div class="stat-card-bg-circle" style="background: rgba(185,28,28,0.08);"></div>
            <div class="stat-content">
                <h3 class="stat-label">Total Users</h3>
                <p class="stat-value">{{ $systemStats['totalUsers'] }}</p>
            </div>
            <div class="stat-icon-box" style="background: rgba(185,28,28,0.1); color: #b91c1c;">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>

        <div class="admin-card stat-card" style="border-left: 4px solid #f59e0b;">
            <div class="stat-card-bg-circle color-orange"></div>
            <div class="stat-content">
                <h3 class="stat-label">Super Admins</h3>
                <p class="stat-value">{{ $systemStats['totalSuperAdmins'] }}</p>
            </div>
            <div class="stat-icon-box color-orange">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </div>

        <div class="admin-card stat-card" style="border-left: 4px solid #3b82f6;">
            <div class="stat-card-bg-circle color-blue"></div>
            <div class="stat-content">
                <h3 class="stat-label">Admins</h3>
                <p class="stat-value">{{ $systemStats['totalAdmins'] }}</p>
            </div>
            <div class="stat-icon-box color-blue">
                <i class="fa-solid fa-user-gear"></i>
            </div>
        </div>

        <div class="admin-card stat-card" style="border-left: 4px solid #10b981;">
            <div class="stat-card-bg-circle color-green"></div>
            <div class="stat-content">
                <h3 class="stat-label">External Systems</h3>
                <p class="stat-value">{{ $systemStats['totalExternalSystems'] }}</p>
            </div>
            <div class="stat-icon-box color-green">
                <i class="fa-solid fa-server"></i>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     CONTENT STATS (Everything the admin sees + more)
     ═══════════════════════════════════════════════ --}}
<div style="margin-bottom: 2rem;">
    <h3 style="font-size: 1rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        <i class="fa-solid fa-layer-group"></i> Content Overview
    </h3>
    <div class="dashboard-stats-grid">
        <div class="admin-card stat-card">
            <div class="stat-card-bg-circle color-blue"></div>
            <div class="stat-content">
                <h3 class="stat-label">Total Staff</h3>
                <p class="stat-value">{{ $contentStats['staffCount'] }}</p>
            </div>
            <div class="stat-icon-box color-blue">
                <i class="fa-solid fa-user-tie"></i>
            </div>
        </div>

        <div class="admin-card stat-card">
            <div class="stat-card-bg-circle color-green"></div>
            <div class="stat-content">
                <h3 class="stat-label">Programmes</h3>
                <p class="stat-value">{{ $contentStats['programmesCount'] }}</p>
            </div>
            <div class="stat-icon-box color-green">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <div class="admin-card stat-card">
            <div class="stat-card-bg-circle color-purple"></div>
            <div class="stat-content">
                <h3 class="stat-label">Courses</h3>
                <p class="stat-value">{{ $contentStats['coursesCount'] }}</p>
            </div>
            <div class="stat-icon-box color-purple">
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>

        <div class="admin-card stat-card">
            <div class="stat-card-bg-circle color-orange"></div>
            <div class="stat-content">
                <h3 class="stat-label">News Articles</h3>
                <p class="stat-value">{{ $contentStats['newsCount'] }}</p>
            </div>
            <div class="stat-icon-box color-orange">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
    </div>
</div>

{{-- Secondary Content Stats --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
    @php
    $secondaryStats = [
        ['label' => 'Upcoming Events', 'value' => $contentStats['eventsCount'], 'icon' => 'fa-calendar-check', 'color' => '#ec4899', 'bg' => 'rgba(236,72,153,0.1)'],
        ['label' => 'Announcements', 'value' => $contentStats['announcementsCount'], 'icon' => 'fa-bullhorn', 'color' => '#ea580c', 'bg' => 'rgba(234,88,12,0.1)'],
        ['label' => 'Gallery Albums', 'value' => $contentStats['albumsCount'], 'icon' => 'fa-images', 'color' => '#0891b2', 'bg' => 'rgba(8,145,178,0.1)'],
        ['label' => 'Publications', 'value' => $contentStats['publicationsCount'], 'icon' => 'fa-book', 'color' => '#7c3aed', 'bg' => 'rgba(124,58,237,0.1)'],
        ['label' => 'NACOS Presidents', 'value' => $contentStats['presidentsCount'], 'icon' => 'fa-crown', 'color' => '#d97706', 'bg' => 'rgba(217,119,6,0.1)'],
        ['label' => 'Past HODs', 'value' => $contentStats['hodsCount'], 'icon' => 'fa-user-graduate', 'color' => '#059669', 'bg' => 'rgba(5,150,105,0.1)'],
        ['label' => 'Partners', 'value' => $contentStats['partnersCount'], 'icon' => 'fa-handshake', 'color' => '#2563eb', 'bg' => 'rgba(37,99,235,0.1)'],
        ['label' => 'CMS Pages', 'value' => $contentStats['pagesCount'], 'icon' => 'fa-file-lines', 'color' => '#475569', 'bg' => 'rgba(71,85,105,0.1)'],
    ];
    @endphp
    @foreach($secondaryStats as $ss)
    <div class="admin-card" style="padding: 1rem; display: flex; align-items: center; gap: 0.75rem;">
        <div style="width: 40px; height: 40px; border-radius: 10px; background: {{ $ss['bg'] }}; color: {{ $ss['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0;">
            <i class="fa-solid {{ $ss['icon'] }}"></i>
        </div>
        <div>
            <div style="font-size: 1.25rem; font-weight: 700; color: #1e293b;">{{ $ss['value'] }}</div>
            <div style="font-size: 0.75rem; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">{{ $ss['label'] }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- ═══════════════════════════════════════════════
     SYSTEM HEALTH & QUICK ACTIONS
     ═══════════════════════════════════════════════ --}}
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- System Health -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-heart-pulse" style="color: #b91c1c;"></i> System Health
            </h3>
        </div>
        <div class="panel-body" style="padding: 1.5rem;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #334155; font-size: 0.95rem; display: block;">Database Backup</strong>
                    <span style="color: #64748b; font-size: 0.85rem;">
                        {{ $systemStats['lastBackupDate'] ? $systemStats['lastBackupDate'] : 'No backups found' }}
                    </span>
                </div>
                <a href="{{ route('super-admin.backup.index') }}" class="btn btn-sm" style="padding: 0.4rem 1rem; border-radius: 6px; background: #b91c1c; color: white; text-decoration: none; font-size: 0.85rem;">
                    <i class="fa-solid fa-database"></i> Backup
                </a>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #334155; font-size: 0.95rem; display: block;">Settings Configured</strong>
                    <span style="color: #64748b; font-size: 0.85rem;">{{ $systemStats['settingsCount'] }} settings stored</span>
                </div>
                <a href="{{ route('super-admin.settings.index') }}" class="btn btn-sm" style="padding: 0.4rem 1rem; border-radius: 6px; background: white; border: 1px solid #cbd5e1; color: #475569; text-decoration: none; font-size: 0.85rem;">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
            </div>

            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 1.2rem; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <strong style="color: #334155; font-size: 0.95rem; display: block;">External Systems</strong>
                    <span style="color: #64748b; font-size: 0.85rem;">{{ $systemStats['totalExternalSystems'] }} systems linked</span>
                </div>
                <a href="{{ route('super-admin.external-systems.index') }}" class="btn btn-sm" style="padding: 0.4rem 1rem; border-radius: 6px; background: white; border: 1px solid #cbd5e1; color: #475569; text-decoration: none; font-size: 0.85rem;">
                    <i class="fa-solid fa-link"></i> Manage
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-bolt" style="color: #f59e0b;"></i> Quick Actions
            </h3>
        </div>
        <div class="panel-body" style="padding: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                <a href="{{ route('super-admin.users.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(185,28,28,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    <div style="width: 36px; height: 36px; background: #b91c1c; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600; color: #991b1b;">Add User</span>
                </a>

                <a href="{{ route('super-admin.news.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(22,163,74,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    <div style="width: 36px; height: 36px; background: #16a34a; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600; color: #15803d;">Add News</span>
                </a>

                <a href="{{ route('super-admin.events.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(59,130,246,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    <div style="width: 36px; height: 36px; background: #3b82f6; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600; color: #2563eb;">Add Event</span>
                </a>

                <a href="{{ route('super-admin.staff.create') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #faf5ff; border: 1px solid #e9d5ff; border-radius: 10px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(124,58,237,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    <div style="width: 36px; height: 36px; background: #7c3aed; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600; color: #6d28d9;">Add Staff</span>
                </a>

                <a href="{{ route('super-admin.settings.index') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #fefce8; border: 1px solid #fef08a; border-radius: 10px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(217,119,6,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    <div style="width: 36px; height: 36px; background: #d97706; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600; color: #b45309;">Settings</span>
                </a>

                <a href="{{ route('super-admin.backup.index') }}" style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 12px rgba(5,150,105,0.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                    <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.9rem;">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 600; color: #047857;">Backup DB</span>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     PANELS: Users, News, Events
     ═══════════════════════════════════════════════ --}}
<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
    <!-- Users Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-user-shield" style="color: #b91c1c;"></i> All Users
            </h3>
            <a href="{{ route('super-admin.users.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        <div class="panel-body">
            @forelse($recentUsers as $user)
            <div class="panel-list-item">
                <div class="news-list-icon" style="background: {{ $user->isSuperAdmin() ? 'rgba(185,28,28,0.1)' : ($user->isAdmin() ? 'rgba(59,130,246,0.1)' : 'rgba(16,185,129,0.1)') }}; color: {{ $user->isSuperAdmin() ? '#b91c1c' : ($user->isAdmin() ? '#3b82f6' : '#10b981') }};">
                    <i class="fa-solid {{ $user->isSuperAdmin() ? 'fa-shield-halved' : ($user->isAdmin() ? 'fa-user-gear' : 'fa-user') }}"></i>
                </div>
                <div class="item-content">
                    <h4 class="item-title">
                        <a href="{{ route('super-admin.users.edit', $user) }}" class="item-link">{{ $user->name }}</a>
                    </h4>
                    <div class="item-meta">
                        <span class="meta-badge" style="background: {{ $user->isSuperAdmin() ? '#fef2f2' : ($user->isAdmin() ? '#eff6ff' : '#f0fdf4') }}; color: {{ $user->isSuperAdmin() ? '#b91c1c' : ($user->isAdmin() ? '#2563eb' : '#059669') }};">
                            {{ $user->role_label }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="panel-empty-state">
                <i class="fa-solid fa-users-slash panel-empty-icon"></i>
                <p class="panel-empty-text">No users found.</p>
            </div>
            @endforelse
        </div>
        <div class="panel-footer">
            <a href="{{ route('super-admin.users.index') }}" class="panel-view-all">
                Manage All Users <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Recent News Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-newspaper" style="color: #16a34a;"></i> Recent News
            </h3>
            <a href="{{ route('super-admin.news.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        <div class="panel-body">
            @forelse($recentNews as $news)
            <div class="panel-list-item">
                <div class="news-list-icon" style="background: {{ $news->is_published ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' }}; color: {{ $news->is_published ? '#10b981' : '#f59e0b' }};">
                    <i class="fa-solid {{ $news->is_published ? 'fa-check' : 'fa-pen-ruler' }}"></i>
                </div>
                <div class="item-content">
                    <h4 class="item-title">
                        <a href="{{ route('super-admin.news.edit', $news) }}" class="item-link">{{ $news->title }}</a>
                    </h4>
                    <div class="item-meta">
                        <span><i class="fa-regular fa-clock"></i> {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->diffForHumans() : 'Draft' }}</span>
                        <span class="meta-dot" style="margin: 0 0.4rem; color: #cbd5e1;">&bull;</span>
                        <span title="Reactions" style="margin-right: 0.3rem;"><i class="fa-regular fa-thumbs-up" style="color: #16a34a;"></i> {{ $news->reactions_count ?? 0 }}</span>
                        <span title="Comments"><i class="fa-regular fa-comment" style="color: #64748b;"></i> {{ $news->comments_count ?? 0 }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="panel-empty-state">
                <i class="fa-solid fa-folder-open panel-empty-icon"></i>
                <p class="panel-empty-text">No news articles yet.</p>
            </div>
            @endforelse
        </div>
        <div class="panel-footer">
            <a href="{{ route('super-admin.news.index') }}" class="panel-view-all">
                View All News <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Upcoming Events Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-regular fa-calendar-check" style="color: #3b82f6;"></i> Upcoming Events
            </h3>
            <a href="{{ route('super-admin.events.create') }}" class="btn btn-sm panel-new-btn"><i class="fa-solid fa-plus"></i> New</a>
        </div>
        <div class="panel-body">
            @forelse($upcomingEvents as $event)
            <div class="panel-list-item">
                <div class="event-date-badge">
                    <div class="event-month">{{ \Carbon\Carbon::parse($event->date)->format('M') }}</div>
                    <div class="event-day">{{ \Carbon\Carbon::parse($event->date)->format('d') }}</div>
                </div>
                <div class="item-content">
                    <h4 class="item-title">
                        <a href="{{ route('super-admin.events.edit', $event) }}" class="item-link">{{ $event->title }}</a>
                    </h4>
                    <div class="item-meta">
                        <span><i class="fa-regular fa-clock"></i> {{ \Carbon\Carbon::parse($event->time ?? $event->date)->format('h:i A') }}</span>
                        @if($event->location)
                        <span class="meta-dot"></span>
                        <span><i class="fa-solid fa-location-dot"></i> {{ $event->location }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="panel-empty-state">
                <i class="fa-regular fa-calendar-xmark panel-empty-icon"></i>
                <p class="panel-empty-text">No upcoming events.</p>
            </div>
            @endforelse
        </div>
        <div class="panel-footer">
            <a href="{{ route('super-admin.events.index') }}" class="panel-view-all">
                View All Events <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Media Optimization Panel -->
    <div class="admin-card dashboard-panel">
        <div class="panel-header">
            <h3 class="panel-title">
                <i class="fa-solid fa-image" style="color: #10b981;"></i> Media Optimization (WebP)
            </h3>
            <a href="{{ route('super-admin.media-optimization.index') }}" class="btn btn-sm panel-new-btn">
                <i class="fa-solid fa-magnifying-glass"></i> Analyze
            </a>
        </div>

        <div class="panel-body">
            @php
                $pending = $mediaStatusCounts['pending'] ?? 0;
                $processing = $mediaStatusCounts['processing'] ?? 0;
                $ready = $mediaStatusCounts['ready'] ?? 0;
                $failed = $mediaStatusCounts['failed'] ?? 0;
            @endphp

            <div style="margin-bottom: 0.75rem; padding: 0.75rem 0.85rem; border-radius: 10px; background: #f8fafc; border: 1px solid #e2e8f0;">
                <div style="font-weight: 800; color: #334155; font-size: 0.9rem; margin-bottom: 0.25rem;">
                    <i class="fa-solid fa-clock-rotate-left" style="margin-right: 0.35rem; color: var(--color-primary);"></i>
                    Last WebP Conversion
                </div>
                <div style="color: #64748b; font-size: 0.88rem;">
                    {{ isset($mediaLastConvertedAt) && $mediaLastConvertedAt ? \Carbon\Carbon::parse($mediaLastConvertedAt)->diffForHumans() : '—' }}
                </div>
            </div>

            <div style="margin-bottom: 1rem; padding: 0.75rem 0.85rem; border-radius: 10px; background: #fef2f2; border: 1px solid #fecaca;">
                <div style="font-weight: 800; color: #7f1d1d; font-size: 0.9rem; margin-bottom: 0.25rem;">
                    <i class="fa-solid fa-triangle-exclamation" style="margin-right: 0.35rem; color: #dc2626;"></i>
                    Last WebP Failure
                </div>
                <div style="color: #7f1d1d; font-size: 0.88rem;">
                    {{ isset($mediaLastFailedAt) && $mediaLastFailedAt ? \Carbon\Carbon::parse($mediaLastFailedAt)->diffForHumans() : '—' }}
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem; margin-bottom: 1rem;">
                <div class="admin-card" style="padding: 0.85rem; background: #fffbeb; border: 1px solid #fde68a;">
                    <div style="font-weight: 800; color: #d97706;">Pending</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #b45309;">{{ $pending }}</div>
                </div>
                <div class="admin-card" style="padding: 0.85rem; background: #f0f9ff; border: 1px solid #bae6fd;">
                    <div style="font-weight: 800; color: #0ea5e9;">Processing</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #0369a1;">{{ $processing }}</div>
                </div>
                <div class="admin-card" style="padding: 0.85rem; background: #ecfdf5; border: 1px solid #bbf7d0;">
                    <div style="font-weight: 800; color: #10b981;">Ready</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #059669;">{{ $ready }}</div>
                </div>
                <div class="admin-card" style="padding: 0.85rem; background: #fef2f2; border: 1px solid #fecaca;">
                    <div style="font-weight: 800; color: #ef4444;">Failed</div>
                    <div style="font-size: 1.5rem; font-weight: 900; color: #dc2626;">{{ $failed }}</div>
                </div>
            </div>

            <div style="margin-top: 0.75rem;">
                <h4 style="margin: 0 0 0.75rem; font-size: 0.95rem; color: #334155;">
                    <i class="fa-solid fa-clock-rotate-left" style="margin-right: 0.35rem;"></i>
                    Recent WebP Conversions
                </h4>

                @forelse($recentMedia as $media)
                    @php
                        $readyCount = $media->derivatives->where('status', 'ready')->count();
                        $failedCount = $media->derivatives->where('status', 'failed')->count();
                    @endphp
                    <div class="panel-list-item" style="margin-bottom: 0.75rem;">
                        <div class="news-list-icon" style="background: rgba(16,185,129,0.08); color: #0f172a;">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <div class="item-content">
                            <h4 class="item-title" style="margin: 0 0 0.25rem;">
                                Media #{{ $media->id }}
                            </h4>
                            <div class="item-meta">
                                <span>
                                    <i class="fa-solid fa-check-circle" style="color: #10b981;"></i>
                                    {{ $readyCount }}/3 ready
                                </span>
                                @if($failedCount > 0)
                                    <span class="meta-dot"></span>
                                    <span style="color: #ef4444; font-weight: 700;">{{ $failedCount }} failed</span>
                                @endif
                            </div>
                            <div style="color: #6b7280; font-size: 0.82rem; margin-top: 0.35rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $media->original_path }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="panel-empty-state">
                        <i class="fa-solid fa-file-image panel-empty-icon"></i>
                        <p class="panel-empty-text">No media conversion data yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
