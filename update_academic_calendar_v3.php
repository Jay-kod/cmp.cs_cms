<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$newContent = <<<'HTML'
<div id="acal" class="acal-root">

<!-- Stats Dashboard -->
<div class="acal-stats" data-aos="fade-up">
    <div class="acal-stat-card">
        <div class="acal-stat-icon" style="background:linear-gradient(135deg,#059669,#34d399)"><i class="fa-solid fa-calendar-days"></i></div>
        <div class="acal-stat-info"><span class="acal-stat-num">12</span><span class="acal-stat-label">Key Dates</span></div>
    </div>
    <div class="acal-stat-card">
        <div class="acal-stat-icon" style="background:linear-gradient(135deg,#6366f1,#a78bfa)"><i class="fa-solid fa-book-open"></i></div>
        <div class="acal-stat-info"><span class="acal-stat-num">2</span><span class="acal-stat-label">Semesters</span></div>
    </div>
    <div class="acal-stat-card">
        <div class="acal-stat-icon" style="background:linear-gradient(135deg,#f59e0b,#fbbf24)"><i class="fa-solid fa-clock"></i></div>
        <div class="acal-stat-info"><span class="acal-stat-num">29</span><span class="acal-stat-label">Weeks Total</span></div>
    </div>
    <div class="acal-stat-card">
        <div class="acal-stat-icon" style="background:linear-gradient(135deg,#ef4444,#f87171)"><i class="fa-solid fa-pen-nib"></i></div>
        <div class="acal-stat-info"><span class="acal-stat-num">2</span><span class="acal-stat-label">Exam Periods</span></div>
    </div>
</div>

<!-- Semester Tabs -->
<div class="acal-tabs" data-aos="fade-up" data-aos-delay="100">
    <button class="acal-tab active" onclick="acalSwitch('sem1',this)">
        <i class="fa-solid fa-leaf"></i> First Semester
    </button>
    <button class="acal-tab" onclick="acalSwitch('sem2',this)">
        <i class="fa-solid fa-graduation-cap"></i> Second Semester
    </button>
</div>

<!-- FIRST SEMESTER -->
<div class="acal-panel active" id="acal-sem1" data-aos="fade-up" data-aos-delay="150">
    <div class="acal-semester-header" style="background:linear-gradient(135deg,#059669 0%,#10b981 50%,#34d399 100%)">
        <div class="acal-sem-badge">FIRST SEMESTER</div>
        <h3 class="acal-sem-title">October 2025 — March 2026</h3>
        <p class="acal-sem-sub">15 weeks of lectures, practicals & examinations</p>
    </div>

    <div class="acal-timeline">
        <div class="acal-tl-line"></div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#059669"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-regular fa-calendar"></i> Mon, October 2nd, 2025</div>
                <h4 class="acal-event-title">Freshers Resumption & Registration</h4>
                <p class="acal-event-desc">All 100-Level students formally resume. Departmental registration and course advisory begins.</p>
                <span class="acal-event-tag" style="background:#ecfdf5;color:#059669">Registration</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-left">
            <div class="acal-event-dot" style="background:#3b82f6"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-regular fa-calendar"></i> Mon, October 9th, 2025</div>
                <h4 class="acal-event-title">Returning Students & Lectures Begin</h4>
                <p class="acal-event-desc">All returning students resume. First semester lectures officially commence for all levels.</p>
                <span class="acal-event-tag" style="background:#eff6ff;color:#3b82f6">Lectures</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#8b5cf6"></div>
            <div class="acal-event-card acal-event-highlight" style="border-left:4px solid #8b5cf6">
                <div class="acal-event-date"><i class="fa-solid fa-star"></i> Wed, November 15th, 2025</div>
                <h4 class="acal-event-title">Matriculation & Freshers Orientation</h4>
                <p class="acal-event-desc">University-wide matriculation ceremony. Departmental orientation for all freshers with talks from senior staff.</p>
                <span class="acal-event-tag" style="background:#f5f3ff;color:#8b5cf6">Ceremony</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-left">
            <div class="acal-event-dot" style="background:#6b7280"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-regular fa-calendar"></i> Fri, December 15th, 2025</div>
                <h4 class="acal-event-title">End of Year Break</h4>
                <p class="acal-event-desc">Lectures pause for the holiday period. Students proceed on break.</p>
                <span class="acal-event-tag" style="background:#f3f4f6;color:#6b7280">Break</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#059669"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-regular fa-calendar"></i> Tue, January 2nd, 2026</div>
                <h4 class="acal-event-title">Resumption from Break</h4>
                <p class="acal-event-desc">All students resume from break. Lectures continue for all levels and programmes.</p>
                <span class="acal-event-tag" style="background:#ecfdf5;color:#059669">Resumption</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-left">
            <div class="acal-event-dot acal-dot-pulse" style="background:#ef4444"></div>
            <div class="acal-event-card acal-event-exam">
                <div class="acal-event-date" style="color:#ef4444"><i class="fa-solid fa-triangle-exclamation"></i> Mon, February 12th, 2026</div>
                <h4 class="acal-event-title" style="color:#ef4444">First Semester Examinations Begin</h4>
                <p class="acal-event-desc">Formal examination period commences. Ensure all course registrations and clearances are complete.</p>
                <span class="acal-event-tag" style="background:#fef2f2;color:#ef4444"><i class="fa-solid fa-pen-nib"></i> Exams</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#6b7280"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-regular fa-calendar"></i> Fri, March 1st, 2026</div>
                <h4 class="acal-event-title">End of First Semester Examinations</h4>
                <p class="acal-event-desc">All first semester examinations conclude. Short semester break before second semester.</p>
                <span class="acal-event-tag" style="background:#f3f4f6;color:#6b7280">Closing</span>
            </div>
        </div>
    </div>
</div>

<!-- SECOND SEMESTER -->
<div class="acal-panel" id="acal-sem2">
    <div class="acal-semester-header" style="background:linear-gradient(135deg,#4f46e5 0%,#6366f1 50%,#818cf8 100%)">
        <div class="acal-sem-badge">SECOND SEMESTER</div>
        <h3 class="acal-sem-title">March — July 2026</h3>
        <p class="acal-sem-sub">14 weeks of lectures, projects & examinations</p>
    </div>

    <div class="acal-timeline">
        <div class="acal-tl-line" style="background:linear-gradient(to bottom,#6366f1,#818cf8,#c7d2fe)"></div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#6366f1"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-regular fa-calendar"></i> Mon, March 18th, 2026</div>
                <h4 class="acal-event-title">Second Semester Resumption</h4>
                <p class="acal-event-desc">All students resume. Second semester lectures commence immediately across all levels.</p>
                <span class="acal-event-tag" style="background:#eef2ff;color:#6366f1">Resumption</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-left">
            <div class="acal-event-dot" style="background:#f59e0b"></div>
            <div class="acal-event-card acal-event-highlight" style="border-left:4px solid #f59e0b">
                <div class="acal-event-date"><i class="fa-solid fa-star"></i> Mon, May 20th, 2026</div>
                <h4 class="acal-event-title">NACOS Week (Departmental Week)</h4>
                <p class="acal-event-desc">Week-long student activities: seminars, hackathons, sports tournaments, tech exhibitions, and cultural night.</p>
                <span class="acal-event-tag" style="background:#fffbeb;color:#f59e0b">Special Event</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#14b8a6"></div>
            <div class="acal-event-card acal-event-highlight" style="border-left:4px solid #14b8a6">
                <div class="acal-event-date"><i class="fa-solid fa-code"></i> Wed, June 12th, 2026</div>
                <h4 class="acal-event-title">Final Year Project Defense</h4>
                <p class="acal-event-desc">400-Level students present and defend their final year computing projects before a panel of examiners.</p>
                <span class="acal-event-tag" style="background:#f0fdfa;color:#14b8a6">Defense</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-left">
            <div class="acal-event-dot acal-dot-pulse" style="background:#ef4444"></div>
            <div class="acal-event-card acal-event-exam">
                <div class="acal-event-date" style="color:#ef4444"><i class="fa-solid fa-triangle-exclamation"></i> Mon, June 24th, 2026</div>
                <h4 class="acal-event-title" style="color:#ef4444">Second Semester Examinations Begin</h4>
                <p class="acal-event-desc">End-of-session examinations for all levels. Ensure all outstanding requirements are settled.</p>
                <span class="acal-event-tag" style="background:#fef2f2;color:#ef4444"><i class="fa-solid fa-pen-nib"></i> Exams</span>
            </div>
        </div>

        <div class="acal-event" data-aos="fade-right">
            <div class="acal-event-dot" style="background:#6b7280"></div>
            <div class="acal-event-card">
                <div class="acal-event-date"><i class="fa-solid fa-flag-checkered"></i> Fri, July 12th, 2026</div>
                <h4 class="acal-event-title">End of Academic Session</h4>
                <p class="acal-event-desc">The 2025/2026 academic session officially ends. Long vacation begins.</p>
                <span class="acal-event-tag" style="background:#f3f4f6;color:#6b7280">Session End</span>
            </div>
        </div>
    </div>
</div>

<!-- Notice Banner -->
<div class="acal-notice" data-aos="fade-up">
    <div class="acal-notice-icon"><i class="fa-solid fa-bullhorn"></i></div>
    <div class="acal-notice-body">
        <h4 class="acal-notice-title">Important Notice</h4>
        <p class="acal-notice-text">All dates are subject to change as approved by the University Senate. The Department will issue memos for any extensions or variations. Check the <a href="/research-news" style="color:#fbbf24;text-decoration:underline;font-weight:600">News section</a> for updates.</p>
    </div>
</div>

</div>

<style>
/* ===== ACADEMIC CALENDAR v3 ===== */
.acal-root{font-family:'Inter',system-ui,-apple-system,sans-serif;max-width:900px;margin:0 auto;padding:0 1rem}

/* Stats */
.acal-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2.5rem}
.acal-stat-card{background:#fff;border-radius:16px;padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:0 1px 3px rgba(0,0,0,.06),0 4px 12px rgba(0,0,0,.04);border:1px solid #f3f4f6;transition:transform .25s,box-shadow .25s}
.acal-stat-card:hover{transform:translateY(-4px);box-shadow:0 8px 25px rgba(0,0,0,.1)}
.acal-stat-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.2rem;flex-shrink:0}
.acal-stat-num{font-size:1.75rem;font-weight:800;color:#111827;line-height:1}
.acal-stat-label{font-size:.8rem;color:#6b7280;font-weight:500;margin-top:2px}
.acal-stat-info{display:flex;flex-direction:column}

/* Tabs */
.acal-tabs{display:flex;gap:.5rem;margin-bottom:2rem;background:#f3f4f6;padding:5px;border-radius:14px}
.acal-tab{flex:1;padding:.85rem 1.5rem;border:none;background:transparent;border-radius:11px;font-size:.95rem;font-weight:600;color:#6b7280;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:.5rem}
.acal-tab.active{background:#fff;color:#111827;box-shadow:0 2px 8px rgba(0,0,0,.08)}
.acal-tab:hover:not(.active){color:#374151;background:rgba(255,255,255,.5)}

/* Panels */
.acal-panel{display:none}
.acal-panel.active{display:block}

/* Semester Header */
.acal-semester-header{border-radius:20px;padding:2.5rem 2rem;text-align:center;color:#fff;margin-bottom:2.5rem;position:relative;overflow:hidden}
.acal-semester-header::before{content:'';position:absolute;top:-50%;right:-20%;width:300px;height:300px;background:rgba(255,255,255,.08);border-radius:50%}
.acal-semester-header::after{content:'';position:absolute;bottom:-30%;left:-10%;width:200px;height:200px;background:rgba(255,255,255,.06);border-radius:50%}
.acal-sem-badge{display:inline-block;background:rgba(255,255,255,.2);backdrop-filter:blur(10px);padding:.4rem 1.2rem;border-radius:999px;font-size:.75rem;font-weight:700;letter-spacing:2px;margin-bottom:1rem}
.acal-sem-title{font-size:1.8rem;font-weight:800;margin:0 0 .5rem;position:relative;z-index:1}
.acal-sem-sub{font-size:1rem;opacity:.85;margin:0;position:relative;z-index:1}

/* Timeline */
.acal-timeline{position:relative;padding-left:2rem;margin-bottom:2rem}
.acal-tl-line{position:absolute;left:11px;top:0;bottom:0;width:3px;background:linear-gradient(to bottom,#059669,#34d399,#d1fae5);border-radius:3px}
.acal-event{position:relative;margin-bottom:1.75rem;padding-left:2rem}
.acal-event-dot{position:absolute;left:-2rem;top:1.5rem;width:14px;height:14px;border-radius:50%;border:3px solid #fff;box-shadow:0 0 0 3px currentColor,0 2px 6px rgba(0,0,0,.15);z-index:2}
.acal-dot-pulse{animation:dotPulse 2s infinite}
@keyframes dotPulse{0%,100%{box-shadow:0 0 0 3px currentColor,0 0 0 6px rgba(239,68,68,.2)}50%{box-shadow:0 0 0 3px currentColor,0 0 0 12px rgba(239,68,68,0)}}

/* Event Cards */
.acal-event-card{background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 1px 3px rgba(0,0,0,.05),0 4px 12px rgba(0,0,0,.03);border:1px solid #f3f4f6;transition:transform .25s,box-shadow .25s}
.acal-event-card:hover{transform:translateX(6px);box-shadow:0 6px 20px rgba(0,0,0,.08)}
.acal-event-exam{background:linear-gradient(135deg,#fff5f5,#fff);border:1px solid #fecaca}
.acal-event-date{font-size:.82rem;font-weight:600;color:#059669;margin-bottom:.5rem;display:flex;align-items:center;gap:.4rem}
.acal-event-title{font-size:1.15rem;font-weight:700;color:#111827;margin:0 0 .5rem}
.acal-event-desc{font-size:.9rem;color:#6b7280;margin:0 0 .75rem;line-height:1.6}
.acal-event-tag{display:inline-block;font-size:.72rem;font-weight:700;padding:.3rem .75rem;border-radius:999px;letter-spacing:.5px;text-transform:uppercase}

/* Notice */
.acal-notice{background:linear-gradient(135deg,#1e293b,#334155);border-radius:20px;padding:2rem;display:flex;align-items:flex-start;gap:1.25rem;margin-top:2.5rem;color:#fff}
.acal-notice-icon{width:48px;height:48px;border-radius:14px;background:rgba(251,191,36,.15);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#fbbf24;flex-shrink:0}
.acal-notice-title{font-size:1.1rem;font-weight:700;margin:0 0 .4rem}
.acal-notice-text{font-size:.9rem;color:#94a3b8;margin:0;line-height:1.7}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
    .acal-stats{grid-template-columns:repeat(2,1fr);gap:.75rem}
    .acal-stat-card{padding:1rem}
    .acal-stat-num{font-size:1.4rem}
    .acal-semester-header{padding:2rem 1.25rem;border-radius:16px}
    .acal-sem-title{font-size:1.4rem}
    .acal-event-card{padding:1.25rem}
    .acal-notice{flex-direction:column;align-items:center;text-align:center;padding:1.5rem}
}
@media(max-width:480px){
    .acal-stats{grid-template-columns:repeat(2,1fr);gap:.5rem}
    .acal-stat-card{padding:.75rem;gap:.6rem}
    .acal-stat-icon{width:38px;height:38px;font-size:1rem;border-radius:10px}
    .acal-stat-num{font-size:1.2rem}
    .acal-stat-label{font-size:.7rem}
    .acal-tabs{flex-direction:column;gap:4px}
    .acal-tab{padding:.7rem 1rem;font-size:.85rem}
    .acal-timeline{padding-left:1.5rem}
    .acal-event{padding-left:1.5rem;margin-bottom:1.25rem}
    .acal-event-dot{left:-1.5rem;width:12px;height:12px}
    .acal-event-title{font-size:1.05rem}
    .acal-event-desc{font-size:.83rem}
    .acal-semester-header{padding:1.5rem 1rem}
    .acal-sem-title{font-size:1.2rem}
    .acal-sem-sub{font-size:.85rem}
}
</style>

<script>
function acalSwitch(id,btn){
    document.querySelectorAll('.acal-panel').forEach(p=>p.classList.remove('active'));
    document.querySelectorAll('.acal-tab').forEach(t=>t.classList.remove('active'));
    document.getElementById('acal-'+id).classList.add('active');
    btn.classList.add('active');
}
</script>
HTML;

$page = \App\Models\Page::where('slug', 'academic-calendar')->first();
if ($page) {
    $page->content = $newContent;
    $page->save();
    echo "✅ academic-calendar page updated with new v3 design.\n";
} else {
    echo "❌ academic-calendar page not found in database.\n";
}
