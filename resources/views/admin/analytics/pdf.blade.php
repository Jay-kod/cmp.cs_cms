<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Department Report</title>
    <style>
        @page { margin: 40px 50px; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 13px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #16a34a; padding-bottom: 20px; }
        .logo { width: 80px; height: auto; margin-bottom: 10px; }
        .university-name { font-size: 18px; font-weight: bold; margin: 0; color: #16a34a; text-transform: uppercase; }
        .department-name { font-size: 14px; margin: 5px 0 0; color: #4b5563; }
        .report-title { font-size: 20px; font-weight: bold; margin: 20px 0 5px; color: #111827; }
        .report-date { font-size: 12px; color: #6b7280; margin-top: 5px; }
        
        .section { margin-bottom: 30px; }
        .section-title { font-size: 16px; font-weight: bold; color: #16a34a; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px; margin-bottom: 10px; text-transform: uppercase; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }
        th, td { padding: 8px 10px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f3f4f6; color: #374151; font-weight: bold; font-size: 12px; border-bottom: 2px solid #d1d5db; }
        td { color: #4b5563; font-size: 12px; }
        
        .metric-grid { width: 100%; margin-bottom: 15px; text-align: center; }
        .metric-box { display: inline-block; width: 30%; margin: 0 1% 10px 1%; padding: 15px 5px; border: 1px solid #e5e7eb; background: #f9fafb; text-align: center; box-sizing: border-box; }
        .metric-value { font-size: 22px; font-weight: bold; color: #111827; margin-bottom: 5px; }
        .metric-label { font-size: 11px; color: #6b7280; text-transform: uppercase; }
        
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; text-align: center; border-top: 1px solid #e5e7eb; padding-top: 10px; font-size: 10px; color: #9ca3af; }
        .page-number:after { content: counter(page); }
    </style>
</head>
<body>
    <div class="footer">
        {{ config('university.department', 'Department of Computer Science') }} - Page <span class="page-number"></span>
    </div>

    <!-- HEADER -->
    <div class="header">
        @php
            $logoPath = public_path('images/logo.png');
            $logoData = '';
            if (file_exists($logoPath)) {
                $logoData = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
            }
        @endphp
        @if($logoData)
            <img src="{{ $logoData }}" class="logo" alt="Logo">
        @endif
        <h1 class="university-name">{{ config('university.name', 'Nasarawa State University, Keffi') }}</h1>
        <h2 class="department-name">{{ config('university.department', 'Department of Computer Science') }}</h2>
    </div>

    <!-- REPORT METADATA -->
    <div style="text-align: center; margin-bottom: 40px;">
        <h2 class="report-title">
            @if($section === 'all')
                COMPREHENSIVE DEPARTMENT REPORT
            @else
                {{ strtoupper(str_replace('-', ' ', $section)) }} REPORT
            @endif
        </h2>
        <p class="report-date">Generated: {{ now()->format('F j, Y \a\t g:i A') }}</p>
    </div>

    @if($section === 'all')
        <!-- SUMMARY OVERVIEW -->
        <div class="section">
            <h3 class="section-title">Quick Summary</h3>
            <div class="metric-grid">
                <div class="metric-box"><div class="metric-value">{{ $stats['staffCount'] }}</div><div class="metric-label">Staff Members</div></div>
                <div class="metric-box"><div class="metric-value">{{ $stats['programmeCount'] }}</div><div class="metric-label">Programmes</div></div>
                <div class="metric-box"><div class="metric-value">{{ $stats['courseCount'] }}</div><div class="metric-label">Courses</div></div>
                <div class="metric-box"><div class="metric-value">{{ $stats['newsCount'] }}</div><div class="metric-label">News Articles</div></div>
                <div class="metric-box"><div class="metric-value">{{ $stats['eventCount'] }}</div><div class="metric-label">Events</div></div>
                <div class="metric-box"><div class="metric-value">{{ $stats['albumCount'] }}</div><div class="metric-label">Gallery Albums</div></div>
                <div class="metric-box"><div class="metric-value">{{ $stats['publicationCount'] }}</div><div class="metric-label">Publications</div></div>
            </div>
        </div>
    @endif

    <!-- CONTENT SECTIONS -->
    @if($section === 'all' || $section === 'staff')
        <div class="section">
            <h3 class="section-title">Staff Directory</h3>
            <div style="margin-bottom: 15px;">
                <strong>Total Staff:</strong> {{ $stats['staffCount'] }} &nbsp;|&nbsp; 
                <strong>Active:</strong> {{ $stats['activeStaff'] }} &nbsp;|&nbsp;
                <strong>Current HOD:</strong> {{ $stats['hodStaff'] ? $stats['hodStaff']->name : 'Not assigned' }}
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 35%">Name</th>
                        <th style="width: 25%">Rank</th>
                        <th style="width: 30%">Email</th>
                        <th style="width: 10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['staff'] as $st)
                    <tr>
                        <td>{{ $st->name }}</td>
                        <td>{{ $st->rank ?? '-' }}</td>
                        <td style="word-break: break-all;">{{ $st->email }}</td>
                        <td>{{ $st->status ?? 'Tenure' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($section === 'all' || $section === 'programmes')
        <div class="section" @if($section === 'all') style="page-break-before: always;" @endif>
            <h3 class="section-title">Programmes</h3>
            <div style="margin-bottom: 15px;">
                <strong>Total Programmes:</strong> {{ $stats['programmeCount'] }} &nbsp;|&nbsp; 
                <strong>Active:</strong> {{ $stats['activeProgrammes'] }}
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%">Name</th>
                        <th style="width: 20%">Level</th>
                        <th style="width: 20%">Duration</th>
                        <th style="width: 10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['programmes'] as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->level ?? '-' }}</td>
                        <td>{{ $p->duration ?? '-' }}</td>
                        <td>{{ $p->is_active ? 'Active' : 'Inactive' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($section === 'all' || $section === 'courses')
        <div class="section" @if($section === 'all') style="page-break-before: always;" @endif>
            <h3 class="section-title">Courses</h3>
            <div style="margin-bottom: 15px;">
                <strong>Total Courses:</strong> {{ $stats['courseCount'] }} &nbsp;|&nbsp; 
                <strong>Elective:</strong> {{ $stats['electiveCount'] }} &nbsp;|&nbsp;
                <strong>Total Credit Units:</strong> {{ $stats['totalCredits'] }}
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width:15%">Code</th>
                        <th style="width:45%">Title</th>
                        <th style="width:10%">Level</th>
                        <th style="width:10%">CU</th>
                        <th style="width:10%">Sem</th>
                        <th style="width:10%">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['courses'] as $c)
                    <tr>
                        <td>{{ $c->code }}</td>
                        <td>{{ $c->title }}</td>
                        <td>{{ $c->level }}</td>
                        <td>{{ $c->credit_units }}</td>
                        <td>{{ $c->semester }}</td>
                        <td>{{ $c->is_elective ? 'Elective' : 'Core' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($section === 'all' || $section === 'news')
        <div class="section" @if($section === 'all') style="page-break-before: always;" @endif>
            <h3 class="section-title">News & Blog</h3>
            <div style="margin-bottom: 15px;">
                <strong>Total Articles:</strong> {{ $stats['newsCount'] }} &nbsp;|&nbsp; 
                <strong>Featured:</strong> {{ $stats['featuredNews'] }} &nbsp;|&nbsp; 
                <strong>Reactions:</strong> {{ $stats['reactionCount'] }}
            </div>
            
            <h4>Articles by Category</h4>
            <table style="width: 50%;">
                <thead><tr><th>Category</th><th>Count</th></tr></thead>
                <tbody>
                    @foreach($stats['newsByCategory'] as $cat => $count)
                    <tr><td>{{ $cat }}</td><td>{{ $count }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if($section === 'all' || $section === 'events')
        <div class="section">
            <h3 class="section-title">Events</h3>
            <div style="margin-bottom: 15px;">
                <strong>Total Events:</strong> {{ $stats['eventCount'] }} &nbsp;|&nbsp; 
                <strong>Upcoming:</strong> {{ $stats['upcomingEvents']->count() }} &nbsp;|&nbsp; 
                <strong>Past:</strong> {{ $stats['pastEvents'] }}
            </div>
            
            @if($stats['upcomingEvents']->count())
            <h4>Upcoming Events</h4>
            <table>
                <thead><tr><th style="width: 25%">Date</th><th style="width: 45%">Event</th><th style="width: 30%">Venue</th></tr></thead>
                <tbody>
                    @foreach($stats['upcomingEvents'] as $e)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($e->date)->format('M j, Y') }}</td>
                        <td>{{ $e->title }}</td>
                        <td>{{ $e->venue ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    @endif

    @if($section === 'all' || $section === 'leadership')
        <div class="section">
            <h3 class="section-title">Leadership History</h3>
            
            @if($stats['pastHods']->count())
            <h4>Past HODs</h4>
            <table>
                <thead><tr><th style="width: 50%">Name</th><th style="width: 25%">Tenure Start</th><th style="width: 25%">Tenure End</th></tr></thead>
                <tbody>
                    @foreach($stats['pastHods'] as $h)
                    <tr>
                        <td>{{ $h->name }}</td>
                        <td>{{ $h->tenure_start ?? 'Unknown' }}</td>
                        <td>{{ $h->tenure_end ?? 'Present' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            @if($stats['nacosPresidents']->count())
            <h4>NACOS Presidents</h4>
            <table>
                <thead><tr><th style="width: 50%">Name</th><th style="width: 25%">Tenure Start</th><th style="width: 25%">Tenure End</th></tr></thead>
                <tbody>
                    @foreach($stats['nacosPresidents'] as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->tenure_start ?? 'Unknown' }}</td>
                        <td>{{ $p->tenure_end ?? 'Present' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    @endif

</body>
</html>
