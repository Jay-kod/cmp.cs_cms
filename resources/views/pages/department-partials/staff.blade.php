<section data-aos="fade-up" style="padding: 6rem 0; background: #FFFFFF; position: relative;">
    <div class="container" data-aos="fade-up">
        <div class="section-heading" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <div class="section-heading-icon" style="width: 48px; height: 48px; background: linear-gradient(135deg, rgba(22, 163, 74, 0.15), rgba(16, 185, 129, 0.1)); color: var(--color-primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h2 style="margin: 0; font-size: 2.2rem; color: #0f172a; font-family: var(--font-heading); font-weight: 800;">Department Staff</h2>
                </div>
                <div style="width: 60px; height: 4px; background: linear-gradient(90deg, var(--color-primary), var(--color-accent)); border-radius: 2px;"></div>
            </div>
            
            <a href="{{ route('people.index') }}?department={{ $deptPrefix }}" class="btn btn-outline-primary" style="border: 2px solid var(--color-primary); color: var(--color-primary); padding: 0.6rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease;">
                View All Staff <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        @php
            $staffMembers = \App\Models\Staff::where('is_hod', false)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        @endphp

        @if($staffMembers->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem;">
                @foreach($staffMembers as $staff)
                    <div class="staff-card" style="background: #f8fafc; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; text-align: center; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="width: 100%; height: 260px; overflow: hidden; position: relative;">
                            <img src="{{ $staff->photo ? app(\App\Services\MediaOptimizationService::class)->webpOrOriginalUrl($staff->photo, 400) : asset('images/default-avatar.jpg') }}" alt="{{ $staff->name }}" style="width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.5s ease;">
                        </div>
                        <div style="padding: 1.5rem;">
                            <h4 style="margin: 0 0 0.2rem; font-size: 1.15rem; color: #0f172a; font-weight: 700;">{{ $staff->name }}</h4>
                            <div style="margin: 0; color: var(--color-primary); font-size: 0.9rem; font-weight: 500; text-align: center;">
                                {{ $staff->rank ?? 'Academic Staff' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 12px; color: #64748b;">
                <i class="fa-solid fa-users" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"></i>
                <p>Staff directory is currently being updated.</p>
            </div>
        @endif
    </div>
</section>