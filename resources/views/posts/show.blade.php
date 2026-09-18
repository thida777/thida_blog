@extends('layouts.app')

@section('title', $post->title . ' | Thida Blog')

@section('content')
    <a href="{{ route('blog.index') }}" class="post-back-link mb-3">
        <i class="bi bi-arrow-left"></i> Back to Blog
    </a>

    <article class="article-content mx-auto">
        <header class="post-header mb-4 text-center">
            @if (!empty($post->category))
                <span class="badge bg-secondary mb-3">{{ $post->category->name }}</span>
            @endif

            <h1 class="mb-3">{{ $post->title }}</h1>

            <div class="post-meta">
                @if (!empty($post->user))
                    <span class="post-meta-item">
                        <i class="bi bi-person-circle"></i> {{ $post->user->name }}
                    </span>
                @endif

                @if (!empty($post->created_at))
                    <span class="post-meta-item">
                        <i class="bi bi-calendar3"></i> {{ $post->created_at->format('F j, Y') }}
                    </span>
                @endif

                <span class="post-meta-item">
                    <i class="bi bi-clock"></i> {{ max(1, (int) ceil(str_word_count(strip_tags($post->content)) / 200)) }} min read
                </span>
            </div>

            @if ($post->tags->isNotEmpty())
                <div class="post-card-tags justify-content-center mt-3">
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('blog.tag', $tag) }}" class="tag-badge">#{{ $tag->name }}</a>
                    @endforeach
                </div>
            @endif
        </header>

        @if (!empty($post->image))
            <div class="post-hero-image mb-4">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
            </div>
        @endif

        <div class="post-content">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <div class="card post-end-cta p-4 p-md-5 text-center mt-5">
        <i class="bi bi-journal-text post-end-cta-icon mb-3"></i>
        <h3 class="mb-3">Thanks for reading!</h3>
        <p class="text-muted mb-4">Explore more posts on learning, projects, and everyday growth.</p>
        <a href="{{ route('blog.index') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-arrow-left me-1"></i> Back to Blog
        </a>
    </div>
@endsection
