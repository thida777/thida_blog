@extends('layouts.app')

@section('title', 'Blog | Thida Blog')

@section('content')

    {{-- BLOG HERO --}}
    <div class="blog-hero p-4 p-md-5 mb-4 text-center">
        <h1 class="mb-2">Explore the Blog</h1>
        <p class="lead mb-0">Thoughts, lessons, projects, and experiences from my learning journey.</p>
    </div>

    @isset($activeTag)
        <div class="blog-tag-banner d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4">
            <span>
                <i class="bi bi-tag-fill me-1"></i>
                Showing posts tagged <strong>#{{ $activeTag->name }}</strong>
            </span>
            <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-x-lg me-1"></i> Clear filter
            </a>
        </div>
    @endisset

    {{-- SEARCH --}}
    <div class="blog-search card p-3 p-md-4 mb-5">
        <form method="GET" action="{{ route('blog.index') }}" class="row g-2 align-items-center">
            <div class="col-12 col-md">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    class="form-control"
                    placeholder="Search posts..."
                >
            </div>

            <div class="col-6 col-md-3">
                <select name="category" id="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach (($categories ?? collect()) as $category)
                        <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-3">
                <select name="tag" id="tag" class="form-select">
                    <option value="">All Tags</option>
                    @foreach (($tags ?? collect()) as $groupName => $groupTags)
                        <optgroup label="{{ $groupName }}" data-category-id="{{ $groupTags->first()->category_id ?? 'uncategorized' }}">
                            @foreach ($groupTags as $tag)
                                <option value="{{ $tag->id }}" @selected(request('tag') == $tag->id)>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="col-6 col-md-auto">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>

            <div class="col-6 col-md-auto">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 mb-4">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card post-card blog-card h-100 js-post-card" data-href="{{ route('blog.show', $post) }}" role="button" tabindex="0" aria-label="Open {{ $post->title }}">
                    @if (!empty($post->image))
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        @if (!empty($post->category))
                            <span class="badge bg-secondary mb-2">{{ $post->category->name }}</span>
                        @endif
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 120) }}</p>

                        @if ($post->tags->isNotEmpty())
                            <div class="post-card-tags">
                                @foreach ($post->tags as $tag)
                                    <a href="{{ route('blog.tag', $tag) }}" class="tag-badge">#{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('blog.show', $post) }}" class="btn btn-outline-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="blog-empty card text-center p-5">
                    <div class="blog-empty-icon mb-3">📭</div>
                    <h5 class="mb-2">No posts found</h5>
                    <p class="text-muted mb-0">Try another search term or browse all posts.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="blog-pagination mt-4">
        {{ $posts->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.js-post-card').forEach(function (card) {
                const url = card.dataset.href;

                card.addEventListener('click', function (event) {
                    if (event.target.closest('a, button, input, select, textarea, label')) {
                        return;
                    }

                    window.location.href = url;
                });

                card.addEventListener('keydown', function (event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        window.location.href = url;
                    }
                });
            });
        });
    </script>

    <script>
        // Show only the tags that belong to the selected category.
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category');
            const tagSelect = document.getElementById('tag');

            if (!categorySelect || !tagSelect) {
                return;
            }

            const tagGroups = tagSelect.querySelectorAll('optgroup');

            function filterTagsByCategory() {
                const selectedCategoryId = categorySelect.value;

                tagGroups.forEach(function (group) {
                    const groupCategoryId = group.dataset.categoryId;
                    const matchesCategory = !selectedCategoryId || groupCategoryId === selectedCategoryId;
                    group.style.display = matchesCategory ? '' : 'none';
                });

                // If the currently selected tag is no longer visible, clear it.
                const selectedOption = tagSelect.options[tagSelect.selectedIndex];
                const selectedGroup = selectedOption ? selectedOption.closest('optgroup') : null;

                if (selectedGroup && selectedGroup.style.display === 'none') {
                    tagSelect.value = '';
                }
            }

            categorySelect.addEventListener('change', filterTagsByCategory);

            // Apply the filter on page load too, in case a category is
            // already selected (e.g. after submitting the search form).
            filterTagsByCategory();
        });
    </script>
@endsection
