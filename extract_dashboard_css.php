<?php

$bladeFile = 'c:/xampp/htdocs/p/dcms/resources/views/admin/dashboard.blade.php';
$cssFile = 'c:/xampp/htdocs/p/dcms/resources/css/admin.css';

$blade = file_get_contents($bladeFile);

// Define replacements
$replacements = [
    // Dashboard Header
    '<div style="margin-bottom: 2.5rem; display: flex; align-items: center; justify-content: space-between;">' => '<div class="dashboard-header">',
    '<h2 style="margin: 0 0 0.5rem 0; font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: #111827;">' => '<h2 class="dashboard-title">',
    '<p style="margin: 0; color: #6b7280; font-size: 1.05rem;">' => '<p class="dashboard-subtitle">',
    '<div style="text-align: right;">' => '<div class="dashboard-date-widget">',
    '<div style="font-size: 0.85rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">' => '<div class="date-label">',
    '<div style="font-size: 1.25rem; font-weight: 600; color: var(--color-primary);">' => '<div class="date-value">',

    // Main Stats Grid
    '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">' => '<div class="dashboard-stats-grid">',
    '<div class="admin-card" style="padding: 1.5rem; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform=\'translateY(-4px)\'; this.style.boxShadow=\'0 12px 20px -5px rgba(0,0,0,0.08)\';" onmouseout="this.style.transform=\'translateY(0)\'; this.style.boxShadow=\'0 4px 6px -1px rgba(0,0,0,0.05)\';">' => '<div class="admin-card stat-card">',
    '<div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(59, 130, 246, 0.05); border-radius: 50%;"></div>' => '<div class="stat-card-bg-circle color-blue"></div>',
    '<div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(16, 185, 129, 0.05); border-radius: 50%;"></div>' => '<div class="stat-card-bg-circle color-green"></div>',
    '<div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(139, 92, 246, 0.05); border-radius: 50%;"></div>' => '<div class="stat-card-bg-circle color-purple"></div>',
    '<div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: rgba(245, 158, 11, 0.05); border-radius: 50%;"></div>' => '<div class="stat-card-bg-circle color-orange"></div>',
    '<div style="z-index: 10;">' => '<div class="stat-content">',
    '<h3 style="margin: 0 0 0.5rem 0; font-size: 0.95rem; color: #6b7280; font-weight: 500;">' => '<h3 class="stat-label">',
    '<p style="margin: 0; font-size: 2.25rem; font-weight: 700; color: #111827; line-height: 1;">' => '<p class="stat-value">',

    '<div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">' => '<div class="stat-icon-box color-blue">',
    '<div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">' => '<div class="stat-icon-box color-green">',
    '<div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(139, 92, 246, 0.1); color: #8b5cf6; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">' => '<div class="stat-icon-box color-purple">',
    '<div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10;">' => '<div class="stat-icon-box color-orange">',

    // Secondary Stats Row
    '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">' => '<div class="secondary-stats-grid">',
    '<div class="admin-card" style="padding: 1.2rem; display: flex; align-items: center; gap: 1rem;">' => '<div class="admin-card secondary-stat-card">',
    '<div style="width: 42px; height: 42px; border-radius: 10px; background: {{ $ss[\'bg\'] }}; color: {{ $ss[\'color\'] }}; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">' => '<div class="secondary-stat-icon" style="background: {{ $ss[\'bg\'] }}; color: {{ $ss[\'color\'] }};">',
    '<div style="font-size: 1.4rem; font-weight: 700; color: #111827; line-height: 1;">' => '<div class="secondary-stat-value">',
    '<div style="font-size: 0.8rem; color: #6b7280; margin-top: 2px;">' => '<div class="secondary-stat-label">',

    // Panels
    '<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 1.5rem;">' => '<div class="dashboard-panels-grid">',
    '<div class="admin-card" style="display: flex; flex-direction: column;">' => '<div class="admin-card dashboard-panel">',
    '<div style="padding: 1.5rem 1.5rem 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between;">' => '<div class="panel-header">',
    '<h3 style="margin: 0; font-size: 1.15rem; color: #1f2937; font-weight: 600; display: flex; align-items: center; gap: 0.5rem;">' => '<h3 class="panel-title">',
    '<a href="{{ route(\'admin.news.create\') }}" class="btn btn-sm" style="background: var(--color-primary); color: white; padding: 0.4rem 0.8rem; font-size: 0.8rem; border-radius: 6px; text-decoration: none;">' => '<a href="{{ route(\'admin.news.create\') }}" class="btn btn-sm panel-new-btn">',
    '<br>' => '<br>',
    '<div style="padding: 0 1.5rem; flex: 1;">' => '<div class="panel-body">',
    '<div style="padding: 1.25rem 0; border-bottom: 1px solid #f3f4f6; display: flex; gap: 1rem; align-items: start; transition: background 0.2s; margin: 0 -1.5rem; padding-left: 1.5rem; padding-right: 1.5rem;" onmouseover="this.style.background=\'#f9fafb\'" onmouseout="this.style.background=\'transparent\'">' => '<div class="panel-list-item">',
    '<div style="flex: 1; min-width: 0;">' => '<div class="item-content">',
    '<h4 style="margin: 0 0 0.3rem 0; font-size: 1rem; color: #1f2937; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' => '<h4 class="item-title">',
    '<a href="{{ route(\'admin.news.edit\', $news) }}" style="color: inherit; text-decoration: none;">' => '<a href="{{ route(\'admin.news.edit\', $news) }}" class="item-link">',
    '<div style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; color: #6b7280;">' => '<div class="item-meta">',
    '<span style="width: 4px; height: 4px; background: #d1d5db; border-radius: 50%;"></span>' => '<span class="meta-dot"></span>',
    '<span style="background: #e5e7eb; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; color: #4b5563;">' => '<span class="meta-badge">',
    '<div style="padding: 2.5rem 0; text-align: center; color: #9ca3af;">' => '<div class="panel-empty-state">',
    '<div style="padding: 1rem 1.5rem; background: #f8fafc; text-align: center; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">' => '<div class="panel-footer">',
    '<a href="{{ route(\'admin.news.index\') }}" style="color: var(--color-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; transition: gap 0.2s;" onmouseover="this.style.gap=\'0.6rem\'" onmouseout="this.style.gap=\'0.4rem\'">' => '<a href="{{ route(\'admin.news.index\') }}" class="panel-view-all">',

    '<a href="{{ route(\'admin.events.create\') }}" class="btn btn-sm" style="background: var(--color-primary); color: white; padding: 0.4rem 0.8rem; font-size: 0.8rem; border-radius: 6px; text-decoration: none;">' => '<a href="{{ route(\'admin.events.create\') }}" class="btn btn-sm panel-new-btn">',
    '<a href="{{ route(\'admin.events.edit\', $event) }}" style="color: inherit; text-decoration: none;">' => '<a href="{{ route(\'admin.events.edit\', $event) }}" class="item-link">',
    '<span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;">' => '<span class="meta-location">',
    '<a href="{{ route(\'admin.events.index\') }}" style="color: var(--color-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; transition: gap 0.2s;" onmouseover="this.style.gap=\'0.6rem\'" onmouseout="this.style.gap=\'0.4rem\'">' => '<a href="{{ route(\'admin.events.index\') }}" class="panel-view-all">',
    '<i class="fa-solid fa-folder-open" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5;"></i>' => '<i class="fa-solid fa-folder-open panel-empty-icon"></i>',
    '<p style="margin: 0; font-size: 0.95rem;">' => '<p class="panel-empty-text">',
    '<i class="fa-regular fa-calendar-xmark" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5;"></i>' => '<i class="fa-regular fa-calendar-xmark panel-empty-icon"></i>',

    '<div style="width: 40px; height: 40px; border-radius: 8px; background: {{ $news->is_published ? \'rgba(16, 185, 129, 0.1)\' : \'rgba(245, 158, 11, 0.1)\' }}; color: {{ $news->is_published ? \'#10b981\' : \'#f59e0b\' }}; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">' => '<div class="news-list-icon" style="background: {{ $news->is_published ? \'rgba(16, 185, 129, 0.1)\' : \'rgba(245, 158, 11, 0.1)\' }}; color: {{ $news->is_published ? \'#10b981\' : \'#f59e0b\' }};">',
    '<div style="width: 48px; height: 52px; border-radius: 8px; border: 1px solid #e5e7eb; background: white; display: flex; flex-direction: column; overflow: hidden; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">' => '<div class="event-date-badge">',
    '<div style="background: var(--color-primary); color: white; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; text-align: center; padding: 2px 0;">' => '<div class="event-month">',
    '<div style="flex: 1; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; color: #1f2937;">' => '<div class="event-day">',

];

foreach ($replacements as $old => $new) {
    if (strpos($blade, $old) === false) {
        // echo "Warning: String not found during replacement!\n$old\n";
    }
    $blade = str_replace($old, $new, $blade);
}

file_put_contents($bladeFile, $blade);

$css = <<<CSS

/* Dashboard Dashboard */

.dashboard-header { margin-bottom: 2.5rem; display: flex; align-items: center; justify-content: space-between; }
.dashboard-title { margin: 0 0 0.5rem 0; font-family: var(--font-heading); font-size: 1.8rem; font-weight: 700; color: #111827; }
.dashboard-subtitle { margin: 0; color: #6b7280; font-size: 1.05rem; }
.dashboard-date-widget { text-align: right; }
.date-label { font-size: 0.85rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
.date-value { font-size: 1.25rem; font-weight: 600; color: var(--color-primary); }

.dashboard-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem; }
.stat-card { padding: 1.5rem; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s; }
.stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 20px -5px rgba(0,0,0,0.08); }
.stat-card-bg-circle { position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; border-radius: 50%; opacity: 0.05; }
.color-blue { background-color: #3b82f6; color: #3b82f6; }
.stat-card-bg-circle.color-blue { background-color: #3b82f6; opacity: 0.05; }
.color-green { background-color: #10b981; color: #10b981; }
.stat-card-bg-circle.color-green { background-color: #10b981; opacity: 0.05; }
.color-purple { background-color: #8b5cf6; color: #8b5cf6; }
.stat-card-bg-circle.color-purple { background-color: #8b5cf6; opacity: 0.05; }
.color-orange { background-color: #f59e0b; color: #f59e0b; }
.stat-card-bg-circle.color-orange { background-color: #f59e0b; opacity: 0.05; }

.stat-content { z-index: 10; }
.stat-label { margin: 0 0 0.5rem 0; font-size: 0.95rem; color: #6b7280; font-weight: 500; }
.stat-value { margin: 0; font-size: 2.25rem; font-weight: 700; color: #111827; line-height: 1; }
.stat-icon-box { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; z-index: 10; }
.stat-icon-box.color-blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.stat-icon-box.color-green { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.stat-icon-box.color-purple { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; }
.stat-icon-box.color-orange { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

.secondary-stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
.secondary-stat-card { padding: 1.2rem; display: flex; align-items: center; gap: 1rem; }
.secondary-stat-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
.secondary-stat-value { font-size: 1.4rem; font-weight: 700; color: #111827; line-height: 1; }
.secondary-stat-label { font-size: 0.8rem; color: #6b7280; margin-top: 2px; }

.dashboard-panels-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 1.5rem; }
.dashboard-panel { display: flex; flex-direction: column; }
.panel-header { padding: 1.5rem 1.5rem 1rem 1.5rem; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between; }
.panel-title { margin: 0; font-size: 1.15rem; color: #1f2937; font-weight: 600; display: flex; align-items: center; gap: 0.5rem; }
.panel-new-btn { background: var(--color-primary); color: white; padding: 0.4rem 0.8rem; font-size: 0.8rem; border-radius: 6px; text-decoration: none; }
.panel-body { padding: 0 1.5rem; flex: 1; }
.panel-list-item { padding: 1.25rem 0; border-bottom: 1px solid #f3f4f6; display: flex; gap: 1rem; align-items: start; transition: background 0.2s; margin: 0 -1.5rem; padding-left: 1.5rem; padding-right: 1.5rem; }
.panel-list-item:hover { background: #f9fafb; }
.item-content { flex: 1; min-width: 0; }
.item-title { margin: 0 0 0.3rem 0; font-size: 1rem; color: #1f2937; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.item-link { color: inherit; text-decoration: none; }
.item-meta { display: flex; align-items: center; gap: 0.75rem; font-size: 0.85rem; color: #6b7280; }
.meta-dot { width: 4px; height: 4px; background: #d1d5db; border-radius: 50%; }
.meta-badge { background: #e5e7eb; padding: 2px 8px; border-radius: 12px; font-size: 0.75rem; color: #4b5563; }
.meta-location { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px; }
.panel-empty-state { padding: 2.5rem 0; text-align: center; color: #9ca3af; }
.panel-empty-icon { font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.5; }
.panel-empty-text { margin: 0; font-size: 0.95rem; }
.panel-footer { padding: 1rem 1.5rem; background: #f8fafc; text-align: center; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px; }
.panel-view-all { color: var(--color-primary); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: inline-flex; align-items: center; gap: 0.4rem; transition: gap 0.2s; }
.panel-view-all:hover { gap: 0.6rem; }
.news-list-icon { width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
.event-date-badge { width: 48px; height: 52px; border-radius: 8px; border: 1px solid #e5e7eb; background: white; display: flex; flex-direction: column; overflow: hidden; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
.event-month { background: var(--color-primary); color: white; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; text-align: center; padding: 2px 0; }
.event-day { flex: 1; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; font-weight: 700; color: #1f2937; }

CSS;

if (strpos(file_get_contents($cssFile), '.dashboard-header') === false) {
    file_put_contents($cssFile, "\n\n" . $css, FILE_APPEND);
    echo "CSS appended to admin.css\n";
} else {
    echo "CSS classes already exist in admin.css\n";
}

echo "Done running replacements!";

