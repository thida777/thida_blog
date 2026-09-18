<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->latest()->take(3)->get();
        $categories = Category::withCount('posts')->orderBy('name')->get();

        return view('pages.home', ['posts' => $posts, 'categories' => $categories]);
    }

    public function about()
    {
        $about = AboutPage::first() ?? new AboutPage([
            'name' => 'Thida',
            'role' => 'Student & Blog Author',
            'title' => 'About Thida Blog',
            'intro' => 'A personal space about learning, technology, everyday experiences, and personal growth.',
            'web_development_title' => 'Web Development',
            'web_development_content' => 'Notes and posts on building websites and applications, including what I learn working with Laravel.',
            'web_development_icon' => 'bi-code-slash',
            'learning_study_title' => 'Learning & Study',
            'learning_study_content' => 'Thoughts on studying, new topics I\'m exploring, and lessons learned along the way.',
            'learning_study_icon' => 'bi-book',
            'personal_growth_title' => 'Personal Growth',
            'personal_growth_content' => 'Reflections on everyday experiences and growing a little more with each one.',
            'personal_growth_icon' => 'bi-sunrise',
            'goal' => 'Learn • Build • Share • Grow',
            'content' => "Thida Blog is a personal blog built with Laravel, sharing posts across a variety of categories.\n\nI'm a student who is learning programming, web development, and technology, and this blog is where I share what I pick up along the way.",
        ]);

        return view('pages.about', ['about' => $about]);
    }
}
