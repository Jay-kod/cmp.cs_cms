@extends('layouts.super-admin')
@section('title', 'System Backup')
@section('header', 'System Backup')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    
    <div style="background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%); border-radius: 16px; padding: 2.5rem; color: white; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 10px 25px -5px rgba(185, 28, 28, 0.4); margin-bottom: 2rem; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; filter: blur(20px);"></div>
        <div style="position: relative; z-index: 10;">
            <h2 style="margin: 0 0 0.5rem 0; font-size: 2rem; font-family: var(--font-heading); font-weight: 700;">Database Backup</h2>
            <p style="margin: 0; color: #fecaca; font-size: 1.05rem; max-width: 500px; line-height: 1.5;">Protect your university's data. Generate a complete SQL snapshot of all records, configurations, and content safely and securely.</p>
        </div>
        <div style="position: relative; z-index: 10; font-size: 4rem; color: rgba(255,255,255,0.2);">
            <i class="fa-solid fa-server"></i>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div class="admin-card" style="display: flex; gap: 1rem; align-items: flex-start; padding: 1.5rem;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                <i class="fa-solid fa-table"></i>
            </div>
            <div>
                <h3 style="margin: 0 0 0.4rem 0; font-size: 1.05rem; color: #1f2937;">Complete Schema</h3>
                <p style="margin: 0; font-size: 0.85rem; color: #6b7280; line-height: 1.5;">Includes all database tables, relationships, and structural definitions.</p>
            </div>
        </div>
        
        <div class="admin-card" style="display: flex; gap: 1rem; align-items: flex-start; padding: 1.5rem;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: rgba(245, 158, 11, 0.1); color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                <i class="fa-solid fa-database"></i>
            </div>
            <div>
                <h3 style="margin: 0 0 0.4rem 0; font-size: 1.05rem; color: #1f2937;">Full Dataset</h3>
                <p style="margin: 0; font-size: 0.85rem; color: #6b7280; line-height: 1.5;">Backs up all current content, including news, events, users, and settings.</p>
            </div>
        </div>
        
        <div class="admin-card" style="display: flex; gap: 1rem; align-items: flex-start; padding: 1.5rem;">
            <div style="width: 45px; height: 45px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <h3 style="margin: 0 0 0.4rem 0; font-size: 1.05rem; color: #1f2937;">Instant Download</h3>
                <p style="margin: 0; font-size: 0.85rem; color: #6b7280; line-height: 1.5;">Compiles a standard .sql file ready for direct download to your local machine.</p>
            </div>
        </div>
    </div>

    <div class="admin-card" style="text-align: center; padding: 3rem 2rem; border: 2px dashed #fecaca;">
        <div style="margin-bottom: 2rem;">
            <h3 style="font-size: 1.35rem; color: #1f2937; margin: 0 0 0.5rem 0;">Ready to generate backup?</h3>
            <p style="color: #6b7280; font-size: 0.95rem; margin: 0;">This process takes a snapshot of your local database. It may take a few seconds depending on database size.</p>
        </div>
        
        <form method="POST" action="{{ route('super-admin.backup.download') }}">
            @csrf
            <button type="submit" style="background: #7f1d1d; color: white; padding: 1.1rem 2.5rem; font-size: 1.05rem; border-radius: 10px; font-weight: 600; font-family: var(--font-heading); display: inline-flex; align-items: center; gap: 12px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(127, 29, 29, 0.3);" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 20px -5px rgba(127, 29, 29, 0.4)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(127, 29, 29, 0.3)';">
                <i class="fa-solid fa-cloud-arrow-down" style="font-size: 1.2rem; color: #fca5a5;"></i> 
                Generate & Download SQL
            </button>
        </form>
    </div>

</div>
@endsection
