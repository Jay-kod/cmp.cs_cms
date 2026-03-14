@extends('layouts.public')
@section('title', $staff->name . ' - Staff Profile')

@section('content')
{{-- Profile Hero --}}
<div style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); color: white; padding: 3.5rem 0 6rem; position: relative; overflow: hidden;">
    {{-- Decorative elements --}}
    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; border-radius: 50%; background: rgba(255,255,255,0.03);"></div>
    <div style="position: absolute; bottom: -80px; left: -40px; width: 250px; height: 250px; border-radius: 50%; background: rgba(255,255,255,0.02);"></div>

    <div class="container">
        <a href="{{ route('people.index') }}" style="color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 1.5rem; transition: color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.6)'">
            <i class="fa-solid fa-arrow-left"></i> Back to People
        </a>

        <div style="display: flex; gap: 2.5rem; align-items: center; flex-wrap: wrap;">
            {{-- Photo --}}
            <div style="flex-shrink: 0;">
                <div style="width: 180px; height: 180px; border-radius: 20px; border: 5px solid rgba(255,255,255,0.2); padding: 4px; background: rgba(255,255,255,0.1);">
                    <img src="{{ $staff->photo ? asset('storage/'.$staff->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($staff->name) . '&size=180&background=1e3a8a&color=fff&bold=true&format=svg' }}" alt="{{ $staff->name }}" style="width: 100%; height: 100%; border-radius: 16px; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($staff->name) }}&size=180&background=1e3a8a&color=fff&bold=true&format=svg'">
                </div>
            </div>

            {{-- Name & Title --}}
            <div style="flex: 1; min-width: 280px;">
                <div style="display: flex; gap: 0.6rem; flex-wrap: wrap; margin-bottom: 0.8rem;">
                    @if($staff->is_hod)
                    <span style="background: var(--color-accent); color: var(--color-primary); padding: 4px 14px; border-radius: 20px; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                        <i class="fa-solid fa-star" style="font-size: 0.65rem;"></i> Head of Department
                    </span>
                    @endif
                    @if($staff->status)
                        @if($staff->status === 'Tenure')
                        <span style="background: rgba(34,197,94,0.2); color: #86efac; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                            <i class="fa-solid fa-circle" style="font-size: 0.35rem; vertical-align: middle;"></i> Tenure
                        </span>
                        @elseif($staff->status === 'Visiting')
                        <span style="background: rgba(59,130,246,0.2); color: #93c5fd; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                            <i class="fa-solid fa-circle" style="font-size: 0.35rem; vertical-align: middle;"></i> Visiting
                        </span>
                        @elseif($staff->status === 'Sabbatical')
                        <span style="background: rgba(245,158,11,0.2); color: #fcd34d; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                            <i class="fa-solid fa-circle" style="font-size: 0.35rem; vertical-align: middle;"></i> Sabbatical
                        </span>
                        @endif
                    @endif
                </div>

                <h1 style="color: white; margin: 0 0 0.4rem; font-size: 2.4rem; font-weight: 800; letter-spacing: -0.5px;">{{ $staff->title }} {{ $staff->name }}</h1>
                <p style="color: #93c5fd; font-size: 1.15rem; font-weight: 600; margin: 0 0 0.5rem;">{{ $staff->rank }}</p>

                @if($staff->role)
                <p style="margin: 0 0 1rem;">
                    <span style="background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.9); padding: 4px 12px; border-radius: 6px; font-size: 0.82rem; font-weight: 600;">
                        <i class="fa-solid fa-id-badge" style="margin-right: 3px;"></i> {{ $staff->role }}
                    </span>
                </p>
                @endif

                {{-- Quick contact --}}
                <div style="display: flex; gap: 1.5rem; flex-wrap: wrap; font-size: 0.88rem;">
                    @if($staff->email)
                    <a href="mailto:{{ $staff->email }}" style="color: rgba(255,255,255,0.7); text-decoration: none; display: flex; align-items: center; gap: 6px;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                        <i class="fa-solid fa-envelope"></i> {{ $staff->email }}
                    </a>
                    @endif
                    @if($staff->phone)
                    <span style="color: rgba(255,255,255,0.7); display: flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-phone"></i> {{ $staff->phone }}
                    </span>
                    @endif
                    @if($staff->office_location)
                    <span style="color: rgba(255,255,255,0.7); display: flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-building"></i> {{ $staff->office_location }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: -2rem; position: relative; z-index: 10; margin-bottom: 3rem;">

    {{-- Quick Stats Bar --}}
    <div style="background: white; border-radius: 14px; padding: 1.2rem 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2.5rem; display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap;">
        @if($staff->publications->count() > 0)
        <div style="text-align: center; padding: 0.4rem 0;">
            <p style="margin: 0; font-size: 1.6rem; font-weight: 800; color: var(--color-primary);">{{ $staff->publications->count() }}</p>
            <p style="margin: 0; font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Publications</p>
        </div>
        @endif
        @if($staff->courses->count() > 0)
        <div style="text-align: center; padding: 0.4rem 0;">
            <p style="margin: 0; font-size: 1.6rem; font-weight: 800; color: var(--color-primary);">{{ $staff->courses->count() }}</p>
            <p style="margin: 0; font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Courses</p>
        </div>
        @endif
        @if($staff->specialisation)
        <div style="text-align: center; padding: 0.4rem 0;">
            <p style="margin: 0; font-size: 1.6rem; font-weight: 800; color: var(--color-primary);"><i class="fa-solid fa-microchip" style="font-size: 1.2rem;"></i></p>
            <p style="margin: 0; font-size: 0.75rem; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Specialist</p>
        </div>
        @endif
        @if($staff->accepting_pg)
        <div style="text-align: center; padding: 0.4rem 0;">
            <p style="margin: 0; font-size: 1.6rem; font-weight: 800; color: #16a34a;"><i class="fa-solid fa-check-circle" style="font-size: 1.2rem;"></i></p>
            <p style="margin: 0; font-size: 0.75rem; color: #16a34a; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Accepting PG</p>
        </div>
        @endif
    </div>

    <div style="display: grid; grid-template-columns: 1fr 320px; gap: 2.5rem; align-items: start;">
        {{-- Main Content --}}
        <div>
            {{-- Biography --}}
            <section id="biography" style="margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-user" style="color: var(--color-primary); font-size: 1rem;"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 1.4rem; color: #0f172a;">Biography</h2>
                </div>
                <div style="background: white; padding: 2rem; border-radius: 12px; border: 1px solid #e2e8f0; border-left: 4px solid var(--color-primary); font-size: 1rem; line-height: 1.9; color: #334155;">
                    {!! nl2br(e($staff->bio ?? 'Biography information is currently unavailable.')) !!}
                </div>
            </section>

            {{-- Qualifications --}}
            @if($staff->qualifications)
            <section id="qualifications" style="margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #fef3c7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-graduation-cap" style="color: #b45309; font-size: 1rem;"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 1.4rem; color: #0f172a;">Qualifications</h2>
                </div>
                <div style="background: white; padding: 1.8rem; border-radius: 12px; border: 1px solid #e2e8f0; border-left: 4px solid #f59e0b;">
                    <p style="color: #334155; font-size: 1rem; line-height: 1.8; margin: 0;">{{ $staff->qualifications }}</p>
                </div>
            </section>
            @endif

            {{-- Specialisation --}}
            @if($staff->specialisation)
            <section id="specialisation" style="margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #ede9fe; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-microchip" style="color: #7c3aed; font-size: 1rem;"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 1.4rem; color: #0f172a;">Specialisation</h2>
                </div>
                <div style="background: white; padding: 1.8rem; border-radius: 12px; border: 1px solid #e2e8f0; border-left: 4px solid #7c3aed;">
                    <p style="color: #334155; font-size: 1rem; line-height: 1.8; margin: 0;">{{ $staff->specialisation }}</p>
                </div>
            </section>
            @endif

            {{-- Courses --}}
            @if($staff->courses->count() > 0)
            <section id="courses" style="margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #dcfce7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-book" style="color: #16a34a; font-size: 1rem;"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 1.4rem; color: #0f172a;">Courses</h2>
                    <span style="background: #dcfce7; color: #166534; padding: 2px 10px; border-radius: 20px; font-size: 0.78rem; font-weight: 700;">{{ $staff->courses->count() }}</span>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem;">
                    @foreach($staff->courses as $course)
                    <div style="background: white; padding: 1.3rem; border-radius: 10px; border: 1px solid #e2e8f0; transition: border-color 0.2s;" onmouseover="this.style.borderColor='var(--color-primary)'" onmouseout="this.style.borderColor='#e2e8f0'">
                        <p style="color: var(--color-primary); font-weight: 700; font-size: 0.85rem; margin: 0 0 0.3rem;">{{ $course->code }}</p>
                        <p style="color: #334155; font-weight: 600; margin: 0 0 0.3rem; font-size: 0.95rem;">{{ $course->title }}</p>
                        @if($course->level)
                        <span style="background: #eef2ff; color: #4338ca; padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">Level {{ $course->level }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Publications --}}
            @if($staff->publications->count() > 0)
            <section id="publications" style="margin-bottom: 2.5rem;">
                <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 1.2rem;">
                    <div style="width: 36px; height: 36px; border-radius: 10px; background: #fee2e2; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fa-solid fa-book-open" style="color: #dc2626; font-size: 1rem;"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 1.4rem; color: #0f172a;">Publications</h2>
                    <span style="background: #fee2e2; color: #dc2626; padding: 2px 10px; border-radius: 20px; font-size: 0.78rem; font-weight: 700;">{{ $staff->publications->count() }}</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($staff->publications as $pub)
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; border: 1px solid #e2e8f0; border-left: 4px solid var(--color-primary); transition: box-shadow 0.2s;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.06)'" onmouseout="this.style.boxShadow='none'">
                        <h4 style="margin: 0 0 0.5rem; font-size: 1.02rem; line-height: 1.5; color: #1e293b;">{{ $pub->title }}</h4>
                        <p style="font-size: 0.88rem; color: #64748b; margin: 0 0 0.6rem;">
                            @if($pub->journal)<em>{{ $pub->journal }}</em>@endif
                            @if($pub->year) ({{ $pub->year }})@endif
                            @if($pub->type)
                            <span style="display: inline-block; background: #f1f5f9; color: #475569; padding: 2px 8px; border-radius: 10px; font-size: 0.72rem; margin-left: 5px; text-transform: uppercase; font-weight: 600;">{{ $pub->type }}</span>
                            @endif
                        </p>
                        @if($pub->url)
                        <a href="{{ $pub->url }}" target="_blank" style="font-size: 0.82rem; font-weight: 600; color: var(--color-primary); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                            <i class="fa-solid fa-external-link-alt"></i> View Publication
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </section>
            @endif
        </div>

        {{-- Sidebar --}}
        <div>
            {{-- Quick Navigation --}}
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem; position: sticky; top: 2rem;">
                <div style="background: #f8fafc; padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0;">
                    <h3 style="margin: 0; color: #334155; font-size: 0.9rem; font-weight: 700;">
                        <i class="fa-solid fa-compass" style="margin-right: 6px; color: var(--color-primary);"></i> Quick Navigation
                    </h3>
                </div>
                <div style="padding: 0.6rem;">
                    <a href="#biography" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.9rem; border-radius: 8px; text-decoration: none; color: #475569; font-size: 0.85rem; font-weight: 500; transition: background 0.2s;" onmouseover="this.style.background='#eef2ff'; this.style.color='var(--color-primary)'" onmouseout="this.style.background='transparent'; this.style.color='#475569'">
                        <i class="fa-solid fa-user" style="width: 16px; text-align: center; font-size: 0.8rem;"></i> Biography
                    </a>
                    @if($staff->qualifications)
                    <a href="#qualifications" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.9rem; border-radius: 8px; text-decoration: none; color: #475569; font-size: 0.85rem; font-weight: 500; transition: background 0.2s;" onmouseover="this.style.background='#eef2ff'; this.style.color='var(--color-primary)'" onmouseout="this.style.background='transparent'; this.style.color='#475569'">
                        <i class="fa-solid fa-graduation-cap" style="width: 16px; text-align: center; font-size: 0.8rem;"></i> Qualifications
                    </a>
                    @endif
                    @if($staff->specialisation)
                    <a href="#specialisation" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.9rem; border-radius: 8px; text-decoration: none; color: #475569; font-size: 0.85rem; font-weight: 500; transition: background 0.2s;" onmouseover="this.style.background='#eef2ff'; this.style.color='var(--color-primary)'" onmouseout="this.style.background='transparent'; this.style.color='#475569'">
                        <i class="fa-solid fa-microchip" style="width: 16px; text-align: center; font-size: 0.8rem;"></i> Specialisation
                    </a>
                    @endif
                    @if($staff->courses->count() > 0)
                    <a href="#courses" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.9rem; border-radius: 8px; text-decoration: none; color: #475569; font-size: 0.85rem; font-weight: 500; transition: background 0.2s;" onmouseover="this.style.background='#eef2ff'; this.style.color='var(--color-primary)'" onmouseout="this.style.background='transparent'; this.style.color='#475569'">
                        <i class="fa-solid fa-book" style="width: 16px; text-align: center; font-size: 0.8rem;"></i> Courses
                    </a>
                    @endif
                    @if($staff->publications->count() > 0)
                    <a href="#publications" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.9rem; border-radius: 8px; text-decoration: none; color: #475569; font-size: 0.85rem; font-weight: 500; transition: background 0.2s;" onmouseover="this.style.background='#eef2ff'; this.style.color='var(--color-primary)'" onmouseout="this.style.background='transparent'; this.style.color='#475569'">
                        <i class="fa-solid fa-book-open" style="width: 16px; text-align: center; font-size: 0.8rem;"></i> Publications
                    </a>
                    @endif
                </div>
            </div>

            {{-- Contact Card --}}
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem; position: sticky; top: 2rem;">
                <div style="background: linear-gradient(135deg, var(--color-primary), #1e40af); padding: 1.2rem 1.5rem;">
                    <h3 style="margin: 0; color: white; font-size: 1rem; font-weight: 700;">
                        <i class="fa-solid fa-address-card" style="margin-right: 6px;"></i> Contact Information
                    </h3>
                </div>
                <div style="padding: 1.5rem;">
                    @if($staff->email)
                    <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fa-solid fa-envelope" style="color: var(--color-primary); font-size: 0.85rem;"></i>
                        </div>
                        <div>
                            <p style="margin: 0; color: #94a3b8; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Email</p>
                            <a href="mailto:{{ $staff->email }}" style="color: #334155; font-size: 0.88rem; text-decoration: none; word-break: break-all;">{{ $staff->email }}</a>
                        </div>
                    </div>
                    @endif

                    @if($staff->phone)
                    <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fa-solid fa-phone" style="color: var(--color-primary); font-size: 0.85rem;"></i>
                        </div>
                        <div>
                            <p style="margin: 0; color: #94a3b8; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Phone</p>
                            <p style="margin: 0; color: #334155; font-size: 0.88rem;">{{ $staff->phone }}</p>
                        </div>
                    </div>
                    @endif

                    @if($staff->office_location)
                    <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fa-solid fa-building" style="color: var(--color-primary); font-size: 0.85rem;"></i>
                        </div>
                        <div>
                            <p style="margin: 0; color: #94a3b8; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Office</p>
                            <p style="margin: 0; color: #334155; font-size: 0.88rem;">{{ $staff->office_location }}</p>
                        </div>
                    </div>
                    @endif

                    @if($staff->address)
                    <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #eef2ff; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fa-solid fa-location-dot" style="color: var(--color-primary); font-size: 0.85rem;"></i>
                        </div>
                        <div>
                            <p style="margin: 0; color: #94a3b8; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Address</p>
                            <p style="margin: 0; color: #334155; font-size: 0.88rem;">{{ $staff->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if($staff->accepting_pg)
                    <div style="display: flex; gap: 12px; align-items: flex-start; margin-bottom: 1.2rem;">
                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #dcfce7; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fa-solid fa-user-graduate" style="color: #166534; font-size: 0.85rem;"></i>
                        </div>
                        <div>
                            <p style="margin: 0; color: #166534; font-size: 0.85rem; font-weight: 600;">Accepting PG Students</p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Academic Profile Links --}}
                @if($staff->google_scholar_url || $staff->researchgate_url)
                <div style="padding: 1.2rem 1.5rem; border-top: 1px solid #e2e8f0; background: #f8fafc;">
                    <p style="margin: 0 0 0.8rem; color: #64748b; font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Academic Profiles</p>
                    <div style="display: flex; flex-direction: column; gap: 0.6rem;">
                        @if($staff->google_scholar_url)
                        <a href="{{ $staff->google_scholar_url }}" target="_blank" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.8rem; background: white; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #334155; font-size: 0.85rem; font-weight: 600; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#4285F4'" onmouseout="this.style.borderColor='#e2e8f0'">
                            <div style="width: 28px; height: 28px; border-radius: 6px; background: #4285F4; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa-brands fa-google" style="color: white; font-size: 0.75rem;"></i>
                            </div>
                            Google Scholar
                            <i class="fa-solid fa-external-link-alt" style="margin-left: auto; color: #94a3b8; font-size: 0.7rem;"></i>
                        </a>
                        @endif
                        @if($staff->researchgate_url)
                        <a href="{{ $staff->researchgate_url }}" target="_blank" style="display: flex; align-items: center; gap: 10px; padding: 0.6rem 0.8rem; background: white; border: 1px solid #e2e8f0; border-radius: 8px; text-decoration: none; color: #334155; font-size: 0.85rem; font-weight: 600; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#00CCBB'" onmouseout="this.style.borderColor='#e2e8f0'">
                            <div style="width: 28px; height: 28px; border-radius: 6px; background: #00CCBB; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa-brands fa-researchgate" style="color: white; font-size: 0.75rem;"></i>
                            </div>
                            ResearchGate
                            <i class="fa-solid fa-external-link-alt" style="margin-left: auto; color: #94a3b8; font-size: 0.7rem;"></i>
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Staff Profile Page Responsive */
@media (max-width: 991px) {
    div[style*="padding: 3.5rem 0 6rem"] { padding: 2.5rem 0 4rem !important; }
    div[style*="padding: 3.5rem 0 6rem"] h1[style*="font-size: 2.4rem"] { font-size: 2rem !important; }
}
@media (max-width: 768px) {
    .container > div[style*="grid-template-columns: 1fr 320px"] {
        grid-template-columns: 1fr !important;
    }
    div[style*="padding: 3.5rem 0 6rem"] { padding: 2rem 0 3rem !important; }
    div[style*="padding: 3.5rem 0 6rem"] h1[style*="font-size: 2.4rem"] { font-size: 1.7rem !important; }
    /* Hero flex: stack photo and text */
    div[style*="padding: 3.5rem 0 6rem"] div[style*="display: flex"][style*="gap: 2.5rem"] {
        flex-direction: column !important;
        align-items: center !important;
        text-align: center !important;
        gap: 1.5rem !important;
    }
    div[style*="padding: 3.5rem 0 6rem"] div[style*="min-width: 280px"] { min-width: 0 !important; width: 100% !important; }
    /* Shrink photo */
    div[style*="width: 180px"][style*="height: 180px"] { width: 140px !important; height: 140px !important; }
    /* Stats bar */
    div[style*="gap: 2.5rem"][style*="flex-wrap: wrap"][style*="padding: 1.2rem 2rem"] { gap: 1.5rem !important; padding: 1rem 1.2rem !important; }
}
@media (max-width: 575px) {
    div[style*="padding: 3.5rem 0 6rem"] h1[style*="font-size: 2.4rem"] { font-size: 1.4rem !important; }
    div[style*="width: 180px"][style*="height: 180px"] { width: 120px !important; height: 120px !important; }
    div[style*="gap: 2.5rem"][style*="flex-wrap: wrap"][style*="padding: 1.2rem 2rem"] { gap: 1rem !important; padding: 0.8rem 1rem !important; }
}
</style>
@endsection
