@extends('layouts.app')

@section('title', 'Manage About | Thida Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage About Page</h1>
        <a href="{{ route('about') }}" target="_blank" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-box-arrow-up-right me-1"></i> View Live Page
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- PROFILE --}}
        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-person-badge"></i> Profile</h6>

            <div class="row g-4 align-items-start">
                <div class="col-md-3 text-center">
                    @if ($about->profile_image)
                        <img src="{{ asset('storage/' . $about->profile_image) }}" alt="Current profile image" class="admin-profile-preview mb-2">
                    @else
                        <div class="admin-profile-preview admin-profile-preview-placeholder mb-2">
                            <i class="bi bi-person"></i>
                        </div>
                    @endif
                    <input id="profile_image" type="file" name="profile_image" class="form-control form-control-sm @error('profile_image') is-invalid @enderror" accept="image/*">
                    @error('profile_image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-9">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $about->name ?? 'Thida') }}">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="role" class="form-label fw-semibold">Role</label>
                            <input id="role" type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $about->role ?? 'Student & Blog Author') }}">
                            @error('role')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="title" class="form-label fw-semibold">Page Title</label>
                            <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $about->title ?? 'About Thida Blog') }}" placeholder="About Thida Blog">
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="intro" class="form-label fw-semibold">Intro</label>
                            <textarea id="intro" name="intro" rows="2" class="form-control @error('intro') is-invalid @enderror" placeholder="A personal space about learning, technology, and personal growth.">{{ old('intro', $about->intro ?? '') }}</textarea>
                            @error('intro')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-file-text"></i> Main Content</h6>

            <label for="content" class="form-label fw-semibold">Bio / Story</label>
            <textarea id="content" name="content" rows="8" class="form-control @error('content') is-invalid @enderror" placeholder="Write the main content for the About page here...">{{ old('content', $about->content ?? '') }}</textarea>
            @error('content')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- TOPIC CARDS --}}
        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-grid-3x3-gap"></i> "What I Write About" Cards</h6>
            <p class="text-muted small mb-4">
                Icon names come from <a href="https://icons.getbootstrap.com" target="_blank" rel="noopener">Bootstrap Icons</a> (e.g. <code>bi-code-slash</code>).
            </p>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="admin-topic-card">
                        <div class="fw-semibold mb-2 text-uppercase small text-muted">Card 1</div>

                        <label for="web_development_title" class="form-label fw-semibold">Title</label>
                        <input id="web_development_title" type="text" name="web_development_title" class="form-control @error('web_development_title') is-invalid @enderror" value="{{ old('web_development_title', $about->web_development_title ?? 'Web Development') }}">
                        @error('web_development_title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <label for="web_development_icon" class="form-label fw-semibold mt-3">Icon</label>
                        <div class="input-group icon-input-group">
                            <span class="input-group-text"><i class="bi {{ old('web_development_icon', $about->web_development_icon ?? 'bi-code-slash') }}"></i></span>
                            <input id="web_development_icon" type="text" name="web_development_icon" class="form-control @error('web_development_icon') is-invalid @enderror" value="{{ old('web_development_icon', $about->web_development_icon ?? 'bi-code-slash') }}" placeholder="bi-code-slash">
                        </div>
                        @error('web_development_icon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <label for="web_development_content" class="form-label fw-semibold mt-3">Content</label>
                        <textarea id="web_development_content" name="web_development_content" rows="4" class="form-control @error('web_development_content') is-invalid @enderror">{{ old('web_development_content', $about->web_development_content ?? $about->web_development ?? '') }}</textarea>
                        @error('web_development_content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="admin-topic-card">
                        <div class="fw-semibold mb-2 text-uppercase small text-muted">Card 2</div>

                        <label for="learning_study_title" class="form-label fw-semibold">Title</label>
                        <input id="learning_study_title" type="text" name="learning_study_title" class="form-control @error('learning_study_title') is-invalid @enderror" value="{{ old('learning_study_title', $about->learning_study_title ?? 'Learning & Study') }}">
                        @error('learning_study_title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <label for="learning_study_icon" class="form-label fw-semibold mt-3">Icon</label>
                        <div class="input-group icon-input-group">
                            <span class="input-group-text"><i class="bi {{ old('learning_study_icon', $about->learning_study_icon ?? 'bi-book') }}"></i></span>
                            <input id="learning_study_icon" type="text" name="learning_study_icon" class="form-control @error('learning_study_icon') is-invalid @enderror" value="{{ old('learning_study_icon', $about->learning_study_icon ?? 'bi-book') }}" placeholder="bi-book">
                        </div>
                        @error('learning_study_icon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <label for="learning_study_content" class="form-label fw-semibold mt-3">Content</label>
                        <textarea id="learning_study_content" name="learning_study_content" rows="4" class="form-control @error('learning_study_content') is-invalid @enderror">{{ old('learning_study_content', $about->learning_study_content ?? $about->learning_study ?? '') }}</textarea>
                        @error('learning_study_content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="admin-topic-card">
                        <div class="fw-semibold mb-2 text-uppercase small text-muted">Card 3</div>

                        <label for="personal_growth_title" class="form-label fw-semibold">Title</label>
                        <input id="personal_growth_title" type="text" name="personal_growth_title" class="form-control @error('personal_growth_title') is-invalid @enderror" value="{{ old('personal_growth_title', $about->personal_growth_title ?? 'Personal Growth') }}">
                        @error('personal_growth_title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <label for="personal_growth_icon" class="form-label fw-semibold mt-3">Icon</label>
                        <div class="input-group icon-input-group">
                            <span class="input-group-text"><i class="bi {{ old('personal_growth_icon', $about->personal_growth_icon ?? 'bi-sunrise') }}"></i></span>
                            <input id="personal_growth_icon" type="text" name="personal_growth_icon" class="form-control @error('personal_growth_icon') is-invalid @enderror" value="{{ old('personal_growth_icon', $about->personal_growth_icon ?? 'bi-sunrise') }}" placeholder="bi-sunrise">
                        </div>
                        @error('personal_growth_icon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <label for="personal_growth_content" class="form-label fw-semibold mt-3">Content</label>
                        <textarea id="personal_growth_content" name="personal_growth_content" rows="4" class="form-control @error('personal_growth_content') is-invalid @enderror">{{ old('personal_growth_content', $about->personal_growth_content ?? $about->personal_growth ?? '') }}</textarea>
                        @error('personal_growth_content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- GOAL --}}
        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-flag"></i> Goal Section</h6>

            <label for="goal" class="form-label fw-semibold">Goal Text</label>
            <input id="goal" type="text" name="goal" class="form-control @error('goal') is-invalid @enderror" value="{{ old('goal', $about->goal ?? 'Learn • Build • Share • Grow') }}">
            @error('goal')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-lg me-1"></i> Save About Page
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-lg">Back to Dashboard</a>
        </div>
    </form>
@endsection
