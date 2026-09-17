@extends('layouts.app')

@section('title', $post->title . ' | Thida Blog')

@section('content')
    <h1 class="mb-2">{{ $post->title }}</h1>

    <div class="text-muted mb-4">
        <span class="badge bg-secondary">{{ $post->category->name ?? 'N/A' }}</span>
        <span class="ms-2">By {{ $post->user->name ?? 'N/A' }}</span>
        <span class="ms-2">{{ $post->created_at->format('F j, Y') }}</span>
    </div>

    @if ($post->image)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
        </div>
    @endif

    <div class="mb-4">
        {!! nl2br(e($post->content)) !!}
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
