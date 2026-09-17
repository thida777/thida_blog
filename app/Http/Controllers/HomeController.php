<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->take(3)->get();

        return view('pages.home', ['posts' => $posts]);
    }

    public function about()
    {
        return view('pages.about');
    }
}
