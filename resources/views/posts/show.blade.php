@extends('layouts.app')

@section('title', $post->title . ' | Thida Blog')

@section('content')
    <a href="{{ route('blog.index') }}" class="btn btn-link ps-0 mb-3">&larr; Back to Blog</a>

    <article>
        <h1 class="mb-2">{{ $post->title }}</h1>

        <div class="text-muted mb-3">
            @if (!empty($post->category))
                <span class="badge bg-secondary">{{ $post->category->name }}</span>
            @endif

            @if (!empty($post->user))
                <span class="ms-2">By {{ $post->user->name }}</span>
            @endif

            @if (!empty($post->created_at))
                <span class="ms-2">{{ $post->created_at->format('F j, Y') }}</span>
            @endif
        </div>

        @if (!empty($post->image))
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4" alt="{{ $post->title }}">
        @endif

        <div class="post-content">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <a href="{{ route('blog.index') }}" class="btn btn-link ps-0 mt-4">&larr; Back to Blog</a>
@endsection
