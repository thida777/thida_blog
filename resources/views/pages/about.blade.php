@extends('layouts.app')

@section('title', 'About | Thida Blog')

@section('content')

    {{-- ABOUT HERO --}}
    <div class="about-hero p-4 p-md-5 mb-4 text-center">
        <h1 class="mb-3">About Thida Blog</h1>
        <p class="lead mb-0">
            A personal space about learning, technology, everyday experiences, and personal growth.
        </p>
    </div>

    {{-- ABOUT ME --}}
    <div class="row align-items-center g-4 mb-5">
        <div class="col-md-4">
            <div class="card about-profile p-4 text-center h-100">
                <div class="about-avatar mx-auto mb-3">T</div>
                <h5 class="mb-0">Thida</h5>
                <p class="text-muted mb-0">Student &amp; Blog Author</p>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-4 p-md-5 h-100">
                <h2 class="mb-3">Hello, I'm Thida</h2>
                <p class="lead">
                    Thida Blog is a personal blog built with Laravel, sharing posts across a variety of categories.
                </p>
                <p>
                    I'm a student who is learning programming, web development, and technology, and this blog is
                    where I share what I pick up along the way. This site was created as part of a Laravel
                    internship test project, demonstrating a simple public blog frontend paired with an admin
                    backend for managing posts.
                </p>
            </div>
        </div>
    </div>

    {{-- WHAT I WRITE ABOUT --}}
    <h2 class="mb-4 text-center">What I Write About</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        <div class="col">
            <div class="card about-topic-card p-4 h-100 text-center">
                <div class="about-topic-icon mb-3">💻</div>
                <h5>Web Development</h5>
                <p class="text-muted mb-0">
                    Notes and posts on building websites and applications, including what I learn working with Laravel.
                </p>
            </div>
        </div>
        <div class="col">
            <div class="card about-topic-card p-4 h-100 text-center">
                <div class="about-topic-icon mb-3">📚</div>
                <h5>Learning &amp; Study</h5>
                <p class="text-muted mb-0">
                    Thoughts on studying, new topics I'm exploring, and lessons learned along the way.
                </p>
            </div>
        </div>
        <div class="col">
            <div class="card about-topic-card p-4 h-100 text-center">
                <div class="about-topic-icon mb-3">🌱</div>
                <h5>Personal Growth</h5>
                <p class="text-muted mb-0">
                    Reflections on everyday experiences and growing a little more with each one.
                </p>
            </div>
        </div>
    </div>

    {{-- MY GOAL --}}
    <div class="about-goal p-4 p-md-5 mb-5 text-center">
        <h2 class="about-goal-title mb-3">Learn &bull; Build &bull; Share &bull; Grow</h2>
        <p class="mb-0">
            My goal with this blog is simple: keep improving my skills, build real projects along the way,
            share what I learn with anyone who finds it useful, and keep growing one post at a time.
        </p>
    </div>

    {{-- FINAL CTA --}}
    <div class="card about-cta p-4 p-md-5 text-center">
        <h3 class="mb-3">Thanks for visiting Thida Blog!</h3>
        <div>
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">Read the Blog</a>
        </div>
    </div>
@endsection
