@extends('layouts.app')

@section('title', ($about->title ?? 'About') . ' | Thida Blog')

@section('content')
    <div class="about-hero p-4 p-md-5 mb-4 text-center">
        <span class="about-eyebrow mb-3">
            <i class="bi bi-stars"></i> Welcome
        </span>
        <h1 class="mb-3">{{ $about->title ?? 'About Thida Blog' }}</h1>
        <p class="lead mb-0 mx-auto about-hero-lead">
            {{ $about->intro ?? 'A personal space about learning, technology, everyday experiences, and personal growth.' }}
        </p>
    </div>

    <div class="row align-items-stretch g-3 mb-4">
        <div class="col-md-4">
            <div class="card about-profile about-profile-card p-4 text-center h-100">
                <div class="about-avatar-ring mx-auto mb-3">
                    @if ($about->profile_image)
                        <img src="{{ asset('storage/' . $about->profile_image) }}" alt="{{ $about->name ?? 'Profile image' }}" class="about-avatar rounded-circle">
                    @else
                        <div class="about-avatar">{{ strtoupper(substr(($about->name ?? 'T'), 0, 1)) }}</div>
                    @endif
                </div>
                <h5 class="mb-1">{{ $about->name ?? 'Thida' }}</h5>
                <span class="about-role-badge">{{ $about->role ?? 'Student & Blog Author' }}</span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card about-main-card p-4 p-md-5 h-100">
                <i class="bi bi-quote about-quote-icon"></i>
                <h2 class="mb-3">Hello, I'm {{ $about->name ?? 'Thida' }}</h2>
                <div class="lead mb-0" style="white-space: pre-line;">
                    {!! nl2br(e($about->content ?? 'Thida Blog is a personal blog built with Laravel, sharing posts across a variety of categories.')) !!}
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4 text-center">What I Write About</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        <div class="col">
            <div class="card about-topic-card p-4 h-100 text-center">
                <div class="about-topic-icon mb-3 mx-auto"><i class="bi {{ $about->web_development_icon ?? 'bi-code-slash' }}"></i></div>
                <h5>{{ $about->web_development_title ?? 'Web Development' }}</h5>
                <p class="text-muted mb-0">
                    {{ $about->web_development_content ?? $about->web_development ?? 'Notes and posts on building websites and applications, including what I learn working with Laravel.' }}
                </p>
            </div>
        </div>
        <div class="col">
            <div class="card about-topic-card p-4 h-100 text-center">
                <div class="about-topic-icon mb-3 mx-auto"><i class="bi {{ $about->learning_study_icon ?? 'bi-book' }}"></i></div>
                <h5>{{ $about->learning_study_title ?? 'Learning &amp; Study' }}</h5>
                <p class="text-muted mb-0">
                    {{ $about->learning_study_content ?? $about->learning_study ?? 'Thoughts on studying, new topics I\'m exploring, and lessons learned along the way.' }}
                </p>
            </div>
        </div>
        <div class="col">
            <div class="card about-topic-card p-4 h-100 text-center">
                <div class="about-topic-icon mb-3 mx-auto"><i class="bi {{ $about->personal_growth_icon ?? 'bi-sunrise' }}"></i></div>
                <h5>{{ $about->personal_growth_title ?? 'Personal Growth' }}</h5>
                <p class="text-muted mb-0">
                    {{ $about->personal_growth_content ?? $about->personal_growth ?? 'Reflections on everyday experiences and growing a little more with each one.' }}
                </p>
            </div>
        </div>
    </div>

    <div class="about-goal p-4 p-md-5 mb-4 text-center">
        <h2 class="about-goal-title mb-3">Learn • Build • Share • Grow</h2>
        <p class="mb-0 mx-auto about-goal-text">
            {{ $about->goal ?? 'My goal with this blog is simple: keep improving my skills, build real projects along the way, share what I learn with anyone who finds it useful, and keep growing one post at a time.' }}
        </p>
    </div>

    <div class="card about-cta p-4 p-md-5 text-center">
        <i class="bi bi-heart-fill about-cta-icon mb-3"></i>
        <h3 class="mb-3">Thanks for visiting Thida Blog!</h3>
        <div>
            <a href="{{ route('blog.index') }}" class="btn btn-light btn-lg about-cta-btn">Read the Blog <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
@endsection
