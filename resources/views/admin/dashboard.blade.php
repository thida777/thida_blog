@extends('layouts.app')

@section('title', 'Admin Dashboard | Thida Blog')

@section('content')
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Posts</h5>
                    <p class="display-6">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Categories</h5>
                    <p class="display-6">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Users</h5>
                    <p class="display-6">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Manage Posts</a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-primary">Manage Categories</a>
    </div>
@endsection
