@extends('layouts.app')

@section('title', 'Create Post | Thida Blog')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Create Post</h1>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to Posts
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following:</div>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-file-text"></i> Post Details</h6>

            <div class="row g-3">
                <div class="col-md-8">
                    <label for="title" class="form-label fw-semibold">Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror"
                    >
                    @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="category_id" class="form-label fw-semibold">Category</label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Select a category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-tags"></i> Tags</h6>

            @php
                $groupedTags = $tags->groupBy(fn ($tag) => $tag->category?->name ?? 'Uncategorized')->sortKeys();
                $selectedTags = collect(old('tags', []));
            @endphp

            @if ($groupedTags->isNotEmpty())
                <div class="admin-tag-picker">
                    @foreach ($groupedTags as $groupName => $groupTags)
                        <div class="admin-tag-group">
                            <div class="admin-tag-group-label">{{ $groupName }}</div>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($groupTags as $tag)
                                    <input
                                        type="checkbox"
                                        class="btn-check"
                                        name="tags[]"
                                        id="tag-{{ $tag->id }}"
                                        value="{{ $tag->id }}"
                                        autocomplete="off"
                                        @checked($selectedTags->contains($tag->id))
                                    >
                                    <label class="admin-tag-pill" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">
                    No tags yet. <a href="{{ route('admin.tags.create') }}">Create one</a> first.
                </p>
            @endif
        </div>

        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-image"></i> Featured Image</h6>

            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                class="form-control @error('image') is-invalid @enderror"
            >
            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="card p-4 p-md-5 mb-4">
            <h6 class="admin-section-heading"><i class="bi bi-body-text"></i> Content</h6>

            <textarea
                name="content"
                id="content"
                rows="10"
                class="form-control @error('content') is-invalid @enderror"
            >{{ old('content') }}</textarea>
            @error('content')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-lg me-1"></i> Save Post
            </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary btn-lg">Cancel</a>
        </div>
    </form>
@endsection
