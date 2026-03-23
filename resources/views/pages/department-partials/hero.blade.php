<div class="department-hero" style="background: linear-gradient(135deg, rgba(13, 79, 38, 0.95) 0%, rgba(13, 79, 38, 0.85) 100%), url('{{ $heroImage }}') center/cover; padding: 6rem 0; position: relative;">
    <div class="container reveal reveal-up" style="position: relative; z-index: 10;">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" style="margin-bottom: 2rem;">
            <ol class="breadcrumb" style="background: rgba(255, 255, 255, 0.1); display: inline-flex; padding: 0.5rem 1rem; border-radius: 8px; backdrop-filter: blur(4px);">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #cbd5e1; text-decoration: none;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: white; font-weight: 600; padding-left: 0.5rem;">
                    &bull; {{ $departmentName ?? 'Department' }}
                </li>
            </ol>
        </nav>

        <h1 style="color: white; font-size: 3.5rem; font-family: var(--font-heading); font-weight: 800; margin-bottom: 1rem; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
            {{ $departmentName ?? 'Department of Computer Science' }}
        </h1>
        <p style="color: #e2e8f0; font-size: 1.2rem; max-width: 700px; line-height: 1.7;">
            {{ $gs("{$deptPrefix}_hero_subtitle", "Empowering the next generation of computing professionals through innovative education and practical research.") }}
        </p>
    </div>
</div>