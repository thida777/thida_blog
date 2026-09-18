<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $totalCategories = Category::count();
        $totalTags = Tag::count();
        $totalUsers = User::count();
        $recentPosts = Post::with(['category', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalPosts' => $totalPosts,
            'totalCategories' => $totalCategories,
            'totalTags' => $totalTags,
            'totalUsers' => $totalUsers,
            'recentPosts' => $recentPosts,
        ]);
    }
}
