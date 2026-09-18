@extends('layouts.app')

@section('title', 'Manage Posts | Thida Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Create Post
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive card p-3">
    <table class="table table-striped align-middle mb-0">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Author</th>
                <th>Created</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>
                        @if ($post->image)
                            <img src="{{ url('storage/' . $post->image) }}" alt="{{ $post->title }}" class="admin-post-thumb">
                        @else
                            <div class="admin-post-thumb-placeholder">
                                <i class="bi bi-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $post->title }}</div>
                        <div class="text-muted small">#{{ $post->id }}</div>
                    </td>
                    <td>
                        @if ($post->category)
                            <span class="badge bg-secondary">{{ $post->category->name }}</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        @forelse ($post->tags->take(3) as $tag)
                            <span class="tag-badge">#{{ $tag->name }}</span>
                        @empty
                            <span class="text-muted">&mdash;</span>
                        @endforelse
                        @if ($post->tags->count() > 3)
                            <span class="text-muted small">+{{ $post->tags->count() - 3 }} more</span>
                        @endif
                    </td>
                    <td>{{ $post->user->name ?? 'N/A' }}</td>
                    <td class="text-muted">{{ $post->created_at->format('M j, Y') }}</td>
                    <td class="text-end" style="width: 220px;">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-secondary">View</a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form
                                method="POST"
                                action="{{ route('admin.posts.destroy', $post) }}"
                                onsubmit="return confirm('Are you sure you want to delete this post?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No posts found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="mt-3">
        {{ $posts->links() }}
    </div>
@endsection
