
@extends('layouts.app')

@section('title', 'Manage Posts | Thida Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create Post</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive card p-3">
    <table class="table table-bordered table-striped align-middle mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Category</th>
                <th>Author</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>

<td>
    @if ($post->image)
        <img
            src="{{ url('storage/' . $post->image) }}"
            alt="{{ $post->title }}"
            width="80"
            height="80"
            style="object-fit: cover;"
        >
    @else
        <span class="text-muted">N/A</span>
    @endif
</td>


                    <td>{{ $post->category->name ?? 'N/A' }}</td>
                    <td>{{ $post->user->name ?? 'N/A' }}</td>
                    <td>{{ $post->created_at->format('F j, Y') }}</td>

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm btn-secondary">View</a>

                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form
                                method="POST"
                                action="{{ route('admin.posts.destroy', $post) }}"
                                onsubmit="return confirm('Are you sure you want to delete this post?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        No posts found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>

    {{ $posts->links() }}
@endsection

