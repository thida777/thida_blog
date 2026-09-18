<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();

        if (! $about) {
            $about = new AboutPage([
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
        }

        return view('admin.about.index', ['about' => $about]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string'],
            'web_development_title' => ['required', 'string', 'max:255'],
            'web_development_content' => ['required', 'string'],
            'web_development_icon' => ['nullable', 'string', 'max:255'],
            'learning_study_title' => ['required', 'string', 'max:255'],
            'learning_study_content' => ['required', 'string'],
            'learning_study_icon' => ['nullable', 'string', 'max:255'],
            'personal_growth_title' => ['required', 'string', 'max:255'],
            'personal_growth_content' => ['required', 'string'],
            'personal_growth_icon' => ['nullable', 'string', 'max:255'],
            'goal' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);

        $about = AboutPage::first();

        if ($request->hasFile('profile_image')) {
            if ($about && $about->profile_image && Storage::disk('public')->exists($about->profile_image)) {
                Storage::disk('public')->delete($about->profile_image);
            }

            $validated['profile_image'] = $request->file('profile_image')->store('about', 'public');
        } elseif ($about) {
            $validated['profile_image'] = $about->profile_image;
        }

        $validated['web_development'] = $validated['web_development_content'];
        $validated['learning_study'] = $validated['learning_study_content'];
        $validated['personal_growth'] = $validated['personal_growth_content'];

        $validated['web_development_icon'] = $validated['web_development_icon'] ?? 'bi-code-slash';
        $validated['learning_study_icon'] = $validated['learning_study_icon'] ?? 'bi-book';
        $validated['personal_growth_icon'] = $validated['personal_growth_icon'] ?? 'bi-sunrise';

        if ($about) {
            $about->update($validated);
        } else {
            AboutPage::create($validated);
        }

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'About page updated successfully.');
    }
}
