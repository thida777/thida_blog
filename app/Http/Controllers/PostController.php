<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $categoryId = $request->query('category');
        $tagId = $request->query('tag');

        $posts = Post::with(['category', 'tags'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($tagId, function ($query, $tagId) {
                $query->whereHas('tags', function ($query) use ($tagId) {
                    $query->where('tags.id', $tagId);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();
        $tags = Tag::with('category')
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Tag $tag) => $tag->category?->name ?? 'Uncategorized')
            ->sortKeys();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function byTag(Tag $tag)
    {
        $posts = $tag->posts()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(10);

        return view('posts.index', ['posts' => $posts, 'activeTag' => $tag]);
    }

    public function show(Post $post)
    {
        $post->load(['category', 'user', 'tags']);

        return view('posts.show', ['post' => $post]);
    }
}
