<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('tags')->orderBy('id')->get();
        $uncategorizedCount = Tag::whereNull('category_id')->count();

        $active = $request->query('category', (string) ($categories->first()->id ?? 'uncategorized'));

        if ($active === 'uncategorized') {
            $activeCategory = null;
            $activeCategoryName = 'Uncategorized';
            $tagsQuery = Tag::whereNull('category_id');
        } else {
            $activeCategory = $categories->firstWhere('id', (int) $active);

            if (! $activeCategory) {
                $activeCategory = $categories->first();
            }

            $active = $activeCategory ? (string) $activeCategory->id : 'uncategorized';
            $activeCategoryName = $activeCategory->name ?? 'Uncategorized';
            $tagsQuery = $activeCategory
                ? Tag::where('category_id', $activeCategory->id)
                : Tag::whereNull('category_id');
        }

        $tags = $tagsQuery->withCount('posts')->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.tags.index', [
            'categories' => $categories,
            'uncategorizedCount' => $uncategorizedCount,
            'active' => $active,
            'activeCategoryName' => $activeCategoryName,
            'tags' => $tags,
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.tags.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:tags,name'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Tag::create($validated);

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.tags.edit', ['tag' => $tag, 'categories' => $categories]);
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('tags', 'name')->ignore($tag->id)],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $tag->update($validated);

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->posts()->detach();
        $tag->delete();

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }
}
