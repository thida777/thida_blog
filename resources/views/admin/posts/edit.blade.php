@extends('layouts.app')

@section('title', 'Edit Post | Thida Blog')

@section('content')
    <h1 class="mb-4">Edit Post</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $post->title) }}"
                class="form-control @error('title') is-invalid @enderror"
            >
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Select a category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if ($post->image)
            <div class="mb-3">
                <label class="form-label">Current Image</label>
                <div>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded" style="max-height: 180px;">
                </div>
            </div>
        @endif

        <div class="mb-3">
            <label for="image" class="form-label">Upload New Image</label>
            <input
                type="file"
                name="image"
                id="image"
                accept="image/*"
                class="form-control @error('image') is-invalid @enderror"
            >
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea
                name="content"
                id="content"
                rows="8"
                class="form-control @error('content') is-invalid @enderror"
            >{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
