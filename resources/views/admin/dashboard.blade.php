@extends('layouts.app')

@section('title', 'Admin Dashboard | Thida Blog')

@section('content')
    <div class="dashboard-hero p-4 p-md-5 mb-4">
        <span class="dashboard-eyebrow mb-2"><i class="bi bi-speedometer2"></i> Admin</span>
        <h1 class="mb-2">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</h1>
        <p class="lead mb-0">Here's a snapshot of your blog today, {{ now()->format('l, F j, Y') }}.</p>
    </div>

    <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
        <div class="col">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-stat-icon dashboard-stat-icon-posts"><i class="bi bi-journal-text"></i></div>
                    <div>
                        <p class="dashboard-stat-value mb-0">{{ $totalPosts }}</p>
                        <p class="dashboard-stat-label mb-0">Posts</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-stat-icon dashboard-stat-icon-categories"><i class="bi bi-folder2-open"></i></div>
                    <div>
                        <p class="dashboard-stat-value mb-0">{{ $totalCategories }}</p>
                        <p class="dashboard-stat-label mb-0">Categories</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-stat-icon dashboard-stat-icon-tags"><i class="bi bi-tags"></i></div>
                    <div>
                        <p class="dashboard-stat-value mb-0">{{ $totalTags }}</p>
                        <p class="dashboard-stat-label mb-0">Tags</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="dashboard-stat-icon dashboard-stat-icon-users"><i class="bi bi-people"></i></div>
                    <div>
                        <p class="dashboard-stat-value mb-0">{{ $totalUsers }}</p>
                        <p class="dashboard-stat-label mb-0">Users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Recent Posts</h5>

                    @forelse ($recentPosts as $post)
                        <div class="dashboard-recent-post d-flex justify-content-between align-items-center py-2">
                            <div>
                                <a href="{{ route('admin.posts.show', $post) }}" class="dashboard-recent-post-title">{{ $post->title }}</a>
                                <div class="text-muted small">
                                    {{ $post->category->name ?? 'Uncategorized' }}
                                    &middot; {{ $post->created_at->format('M j, Y') }}
                                </div>
                            </div>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No posts yet. Create your first post to get started.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                    <div class="dashboard-quick-links">
                        <a href="{{ route('admin.posts.create') }}" class="dashboard-quick-link">
                            <i class="bi bi-plus-circle"></i> New Post
                        </a>
                        <a href="{{ route('admin.posts.index') }}" class="dashboard-quick-link">
                            <i class="bi bi-journal-text"></i> Manage Posts
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="dashboard-quick-link">
                            <i class="bi bi-folder2-open"></i> Manage Categories
                        </a>
                        <a href="{{ route('admin.tags.index') }}" class="dashboard-quick-link">
                            <i class="bi bi-tags"></i> Manage Tags
                        </a>
                        <a href="{{ route('admin.about.index') }}" class="dashboard-quick-link">
                            <i class="bi bi-person-badge"></i> Edit About Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
