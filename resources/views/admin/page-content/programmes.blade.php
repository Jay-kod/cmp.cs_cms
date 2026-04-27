@extends('layouts.admin')

@section('title', 'Edit Programmes Page Content')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Programmes Page Content</h1>
        <a href="{{ route('admin.page-content.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Pages
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Programmes Hero & Headings</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.page-content.update', 'programmes') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Hero Section -->
                <h5 class="text-secondary border-bottom pb-2 mb-3">Hero Section</h5>
                
                <div class="mb-3">
                    <label for="page_programmes_title" class="form-label">Hero Title</label>
                    <input type="text" class="form-control" id="page_programmes_title" name="settings[page_programmes_title]" value="{{ old('settings.page_programmes_title', $settings['page_programmes_title'] ?? 'Our Academic Programmes') }}">
                    <div class="form-text">The main heading displayed on the Programmes page hero.</div>
                </div>

                <div class="mb-3">
                    <label for="page_programmes_subtitle" class="form-label">Hero Subtitle</label>
                    <textarea class="form-control" id="page_programmes_subtitle" name="settings[page_programmes_subtitle]" rows="2">{{ old('settings.page_programmes_subtitle', $settings['page_programmes_subtitle'] ?? 'Discover our undergraduate and postgraduate degree programmes designed to prepare you for a successful career in computing.') }}</textarea>
                </div>

                <!-- Intro Section -->
                <h5 class="text-secondary border-bottom pb-2 mb-3 mt-4">Programmes List Intro</h5>

                <div class="mb-3">
                    <label for="page_programmes_heading" class="form-label">List Heading</label>
                    <input type="text" class="form-control" id="page_programmes_heading" name="settings[page_programmes_heading]" value="{{ old('settings.page_programmes_heading', $settings['page_programmes_heading'] ?? 'Explore Our Programmes') }}">
                </div>

                <div class="mb-3">
                    <label for="page_programmes_intro" class="form-label">List Intro Text</label>
                    <textarea class="form-control" id="page_programmes_intro" name="settings[page_programmes_intro]" rows="2">{{ old('settings.page_programmes_intro', $settings['page_programmes_intro'] ?? 'We offer a range of specialized degree programmes in computer science, software engineering, and information technology.') }}</textarea>
                </div>

                <!-- Call to Action -->
                <h5 class="text-secondary border-bottom pb-2 mb-3 mt-4">Call to Action (CTA) Section</h5>

                <div class="mb-3">
                    <label for="page_programmes_cta_title" class="form-label">CTA Title</label>
                    <input type="text" class="form-control" id="page_programmes_cta_title" name="settings[page_programmes_cta_title]" value="{{ old('settings.page_programmes_cta_title', $settings['page_programmes_cta_title'] ?? 'Ready to Begin Your Journey?') }}">
                </div>

                <div class="mb-3">
                    <label for="page_programmes_cta_text" class="form-label">CTA Text</label>
                    <textarea class="form-control" id="page_programmes_cta_text" name="settings[page_programmes_cta_text]" rows="2">{{ old('settings.page_programmes_cta_text', $settings['page_programmes_cta_text'] ?? 'Explore the admission requirements and take the first step towards your career in computing.') }}</textarea>
                </div>

                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-1"></i> The individual programmes displayed on this page are managed via the <a href="{{ route('admin.programmes.index') }}" class="alert-link">Programmes module</a>.
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
