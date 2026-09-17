<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Post::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        return view('admin.dashboard', [
            'totalPosts' => $totalPosts,
            'totalCategories' => $totalCategories,
            'totalUsers' => $totalUsers,
        ]);
    }
}
