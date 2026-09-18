@extends('layouts.app')

@section('title', 'Home | Thida Blog')

@section('content')
    <div class="hero-section p-4 p-md-5 mb-4 text-center">
        <span class="home-eyebrow mb-3">
            <i class="bi bi-stars"></i> Personal Blog
        </span>
        <h1 class="display-5 fw-bold mb-3">Welcome to Thida Blog</h1>
        <p class="lead mx-auto home-hero-lead mb-4">
            Thoughts, stories, and ideas. Explore the blog to read the latest posts, or learn more about this site.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">
                Read the Blog <i class="bi bi-arrow-right ms-1"></i>
            </a>
            <a href="{{ route('about') }}" class="btn btn-outline-secondary btn-lg">About</a>
        </div>
    </div>

    @if ($categories->isNotEmpty())
        <div class="home-categories mb-5">
            @foreach ($categories as $category)
                <a href="{{ route('blog.index', ['category' => $category->id]) }}" class="home-category-pill">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    @endif

    <h2 class="mb-1 text-center">Latest Posts</h2>
    <p class="text-muted text-center mb-4">Fresh from the blog</p>

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

                        @if ($post->tags->isNotEmpty())
                            <div class="post-card-tags">
                                @foreach ($post->tags->take(3) as $tag)
                                    <a href="{{ route('blog.tag', $tag) }}" class="tag-badge">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted small">{{ $post->created_at->format('M j, Y') }}</span>
                        <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="blog-empty card text-center p-5">
                    <div class="blog-empty-icon mb-3">📭</div>
                    <h5 class="mb-2">No posts yet</h5>
                    <p class="text-muted mb-0">Check back soon for new content.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="card home-cta p-4 p-md-5 text-center">
        <i class="bi bi-journal-richtext home-cta-icon mb-3"></i>
        <h3 class="mb-3">Want to see more?</h3>
        <p class="text-muted mb-4">Browse every post, filter by category or tag, and find something worth reading.</p>
        <div>
            <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">
                View All Posts <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
@endsection
