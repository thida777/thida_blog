@extends('layouts.app')

@section('title', 'Manage Tags | Thida Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Manage Tags</h1>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">Create Tag</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @php
        $categoryIcons = [
            'Web Development' => 'bi-code-slash',
            'Learning' => 'bi-book',
            'Projects' => 'bi-kanban',
            'Personal Growth' => 'bi-sunrise',
        ];
    @endphp

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card tag-sidebar-card p-3">
                <h6 class="tag-sidebar-heading mb-3">Categories</h6>
                <nav class="tag-sidebar">
                    @foreach ($categories as $category)
                        <a href="{{ route('admin.tags.index', ['category' => $category->id]) }}"
                           class="tag-sidebar-link {{ $active === (string) $category->id ? 'active' : '' }}">
                            <span class="tag-sidebar-link-label">
                                <i class="bi {{ $categoryIcons[$category->name] ?? 'bi-folder2' }}"></i>
                                {{ $category->name }}
                            </span>
                            <span class="tag-sidebar-count">{{ $category->tags_count }}</span>
                        </a>
                    @endforeach

                    <a href="{{ route('admin.tags.index', ['category' => 'uncategorized']) }}"
                       class="tag-sidebar-link {{ $active === 'uncategorized' ? 'active' : '' }}">
                        <span class="tag-sidebar-link-label">
                            <i class="bi bi-inboxes"></i> Uncategorized
                        </span>
                        <span class="tag-sidebar-count">{{ $uncategorizedCount }}</span>
                    </a>
                </nav>
            </div>
        </div>

        <div class="col-md-9">
            <h4 class="mb-3">{{ $activeCategoryName }}</h4>

            <div class="table-responsive card p-3 mb-2">
                <table class="table table-striped align-middle mb-0">
                    <tbody>
                        @forelse ($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td class="text-muted">{{ $tag->posts_count }} post(s)</td>
                                <td class="text-end" style="width: 200px;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}"
                                              onsubmit="return confirm('Delete this tag? It will be removed from any posts using it.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted">No tags in this category yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $tags->links() }}
        </div>
    </div>
@endsection
