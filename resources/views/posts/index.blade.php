@extends('layouts.app')

@section('title', 'Blog | Thida Blog')

@section('content')
    <h1 class="mb-4">Blog</h1>

    <form method="GET" action="{{ route('blog.index') }}" class="row g-2 mb-4">
        <div class="col-auto flex-grow-1">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                class="form-control"
                placeholder="Search posts..."
            >
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card h-100">
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
                <p class="text-muted">No posts found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection
