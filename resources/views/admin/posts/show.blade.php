@extends('layouts.app')

@section('title', $post->title . ' | Thida Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.posts.index') }}" class="post-back-link">
            <i class="bi bi-arrow-left"></i> Back to Posts
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>
            <a href="{{ route('blog.show', $post) }}" target="_blank" class="btn btn-outline-secondary">
                <i class="bi bi-box-arrow-up-right me-1"></i> View Live
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4 p-md-5">
            @if ($post->category)
                <span class="badge bg-secondary mb-3">{{ $post->category->name }}</span>
            @endif

            <h1 class="mb-3">{{ $post->title }}</h1>

            <div class="post-meta justify-content-start mb-4">
                <span class="post-meta-item">
                    <i class="bi bi-person-circle"></i> {{ $post->user->name ?? 'N/A' }}
                </span>
                <span class="post-meta-item">
                    <i class="bi bi-calendar3"></i> {{ $post->created_at->format('F j, Y') }}
                </span>
            </div>

            @if ($post->tags->isNotEmpty())
                <div class="post-card-tags mb-4">
                    @foreach ($post->tags as $tag)
                        <span class="tag-badge">#{{ $tag->name }}</span>
                    @endforeach
                </div>
            @endif

            @if ($post->image)
                <div class="post-hero-image mb-4">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="post-content">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>
    </div>
@endsection
