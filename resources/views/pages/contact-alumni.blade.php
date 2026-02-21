@extends('layouts.public')
@section('title', 'Contact & Alumni')

@section('content')
<div class="page-header" style="background: var(--color-primary); color: white; padding: 4rem 0; text-align: center;">
    <div class="container">
        <h1 style="color: white; font-size: 2.5rem; margin-bottom: 0;">Contact & Alumni Network</h1>
    </div>
</div>

<div class="container page-layout reveal" style="margin-top: var(--spacing-lg);">
    <div class="main-content">
        @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; border: 1px solid #c3e6cb; margin-bottom: 2rem;">
            <i class="fa-solid fa-check-circle" style="margin-right: 10px;"></i> {{ session('success') }}
        </div>
        @endif

        <section id="contact-us" style="margin-bottom: var(--spacing-xl);">
            <h2>Get in Touch</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            
            <div style="display: flex; gap: var(--spacing-lg); flex-wrap: wrap;">
                <div style="flex: 1; min-width: 300px;">
                    <form action="{{ route('contact-alumni.send') }}" method="POST" style="background: var(--color-bg-alt); padding: 2rem; border-radius: 8px; border: 1px solid var(--color-border);">
                        @csrf
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Name</label>
                            <input type="text" name="name" required style="width: 100%; padding: 0.8rem; border: 1px solid var(--color-border); border-radius: 4px; font-family: var(--font-body);">
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Email</label>
                            <input type="email" name="email" required style="width: 100%; padding: 0.8rem; border: 1px solid var(--color-border); border-radius: 4px; font-family: var(--font-body);">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Message</label>
                            <textarea name="message" rows="5" required style="width: 100%; padding: 0.8rem; border: 1px solid var(--color-border); border-radius: 4px; font-family: var(--font-body); resize: vertical;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background: var(--color-primary); color: white; width: 100%;">Send Message</button>
                    </form>
                </div>
                
                <div style="flex: 1; min-width: 300px;">
                    <div style="background: var(--color-primary); color: white; padding: 2rem; border-radius: 8px; height: 100%;">
                        <h3 style="color: white; margin-top: 0; margin-bottom: 1.5rem;">Contact Information</h3>
                        
                        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: flex-start;">
                            <i class="fa-solid fa-building" style="color: var(--color-accent); font-size: 1.5rem; margin-top: 4px;"></i>
                            <div>
                                <h4 style="color: var(--color-accent); margin: 0 0 0.25rem 0;">Address</h4>
                                <p style="margin: 0; color: #dae3f2;">{{ config('university.name') }}<br>{{ config('university.university') }}<br>P.M.B 1022, Keffi, Nasarawa State, Nigeria.</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: flex-start;">
                            <i class="fa-solid fa-envelope" style="color: var(--color-accent); font-size: 1.5rem; margin-top: 4px;"></i>
                            <div>
                                <h4 style="color: var(--color-accent); margin: 0 0 0.25rem 0;">Email</h4>
                                <p style="margin: 0; color: #dae3f2;"><a href="mailto:info@dcms.nsuk.edu.ng" style="color: #dae3f2;">info@dcms.nsuk.edu.ng</a></p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: flex-start;">
                            <i class="fa-solid fa-phone" style="color: var(--color-accent); font-size: 1.5rem; margin-top: 4px;"></i>
                            <div>
                                <h4 style="color: var(--color-accent); margin: 0 0 0.25rem 0;">Phone</h4>
                                <p style="margin: 0; color: #dae3f2;">+234 (0) 123 456 7890</p>
                            </div>
                        </div>
                        
                        <div style="margin-top: 3rem; text-align: center;">
                            <p style="margin-bottom: 1rem; font-weight: 600; color: var(--color-accent);">Connect with us</p>
                            <div style="display: flex; justify-content: center; gap: 1.5rem; font-size: 1.5rem;">
                                <a href="#" style="color: white;"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#" style="color: white;"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#" style="color: white;"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#" style="color: white;"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="alumni-network" style="margin-bottom: var(--spacing-xl);">
            <h2>Alumni Network</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <p style="font-size: 1.05rem; line-height: 1.8; margin-bottom: 2rem;">Our alumni are solving complex problems globally. Reconnect with peers, mentor current students, and stay updated with the department's progress.</p>
            
            <div style="text-align: center; margin-bottom: 3rem; background: var(--color-bg-alt); padding: 3rem 1rem; border-radius: 8px; border: 1px dashed var(--color-primary);">
                <h3 style="margin-top: 0;">Are you a graduate of DCMS?</h3>
                <p style="color: var(--color-text-muted);">Join our official alumni database to request transcripts, receive newsletters, and network.</p>
                <button class="btn btn-accent" style="margin-top: 1rem; font-size: 1.1rem; padding: 0.8rem 2rem;">Register as Alumni</button>
            </div>
            
            <h3 style="margin-bottom: 1.5rem;">Featured Alumni</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-lg);">
                @forelse($alumni as $person)
                <div style="background: var(--color-bg-main); border: 1px solid var(--color-border); border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
                    <div style="height: 150px; background: var(--color-primary); position: relative;">
                        <img src="{{ $person->photo ? asset('storage/'.$person->photo) : asset('build/assets/placeholder.jpg') }}" alt="{{ $person->name }}" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid var(--color-bg-main); position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%); object-fit: cover;" onerror="this.src='https://via.placeholder.com/150?text=Alumni'">
                    </div>
                    <div style="padding: 4rem 1.5rem 2rem 1.5rem; text-align: center;">
                        <h4 style="margin: 0; font-size: 1.2rem; color: var(--color-primary);">{{ $person->name }}</h4>
                        <p style="color: var(--color-secondary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem;">Class of {{ $person->graduation_year }} · {{ $person->programme }}</p>
                        <hr style="border: 0; border-top: 1px solid var(--color-border); margin: 1rem 0;">
                        @if($person->current_role && $person->employer)
                        <p style="margin: 0; font-size: 0.95rem;"><strong>{{ $person->current_role }}</strong><br><span style="color: var(--color-text-muted);">at {{ $person->employer }}</span></p>
                        @endif
                        @if($person->bio)
                        <p style="margin-top: 1rem; font-size: 0.85rem; color: var(--color-text-muted); font-style: italic;">"{{ Str::limit($person->bio, 80) }}"</p>
                        @endif
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1;"><p>No alumni profiles available yet.</p></div>
                @endforelse
            </div>
        </section>
        
        <section id="partnerships" style="margin-bottom: var(--spacing-xl);">
            <h2>Industry Partnerships</h2>
            <div style="width: 60px; height: 4px; background: var(--color-accent); margin-bottom: 1.5rem;"></div>
            <div style="background: var(--color-primary-light); color: white; padding: 3rem; border-radius: 8px; text-align: center;">
                <h3 style="color: white; margin-top: 0;">Partner with DCMS</h3>
                <p style="max-width: 600px; margin: 0 auto 2rem auto; color: #dae3f2;">We collaborate with top tech companies and organizations for student internships, joint research, and curriculum development. Partner with us to shape the next generation of IT leaders.</p>
                <a href="#contact-us" class="btn btn-accent">Propose a Partnership</a>
            </div>
        </section>
    </div>

    <x-sticky-toc :sections="['contact-us' => 'Contact Us', 'alumni-network' => 'Alumni Network', 'partnerships' => 'Industry Partnerships']" />
</div>
@endsection
