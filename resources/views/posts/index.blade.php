@extends('layouts.app')

@section('title', 'Blog | Thida Blog')

@section('content')

    {{-- BLOG HERO --}}
    <div class="blog-hero p-4 p-md-5 mb-4 text-center">
        <h1 class="mb-2">Explore the Blog</h1>
        <p class="lead mb-0">Thoughts, lessons, projects, and experiences from my learning journey.</p>
    </div>

    {{-- SEARCH --}}
    <div class="blog-search card p-3 p-md-4 mb-5">
        <form method="GET" action="{{ route('blog.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-sm">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    class="form-control"
                    placeholder="Search posts..."
                >
            </div>
            <div class="col-12 col-sm-auto">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mb-4">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card post-card blog-card h-100">
                    @if (!empty($post->image))
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        @if (!empty($post->category))
                            <span class="badge bg-secondary mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 120) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="blog-empty card text-center p-5">
                    <div class="blog-empty-icon mb-3">📭</div>
                    <h5 class="mb-2">No posts found</h5>
                    <p class="text-muted mb-0">Try another search term or browse all posts.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="blog-pagination mt-4">
        {{ $posts->links() }}
    </div>
@endsection
