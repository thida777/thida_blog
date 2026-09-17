@extends('layouts.app')

@section('title', 'Home | Thida Blog')

@section('content')
    <div class="hero-section p-5 mb-4">
        <div class="container-fluid py-4">
            <h1 class="display-5 fw-bold">Welcome to Thida Blog</h1>
            <p class="col-md-8 fs-4">
                Thoughts, stories, and ideas. Explore the blog to read the latest posts, or learn more about this site.
            </p>
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg me-2">Read the Blog</a>
            <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-lg">About</a>
        </div>
    </div>

    <h2 class="mb-4">Latest Posts</h2>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card post-card h-100">
                    @if (!empty($post->image))
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        @if (!empty($post->category))
                            <span class="badge bg-secondary mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No posts yet.</p>
            </div>
        @endforelse
    </div>

    <a href="{{ route('blog.index') }}" class="btn btn-primary">View All Posts</a>
@endsection
