<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'about_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role',
        'profile_image',
        'title',
        'intro',
        'web_development_title',
        'web_development_content',
        'web_development_icon',
        'learning_study_title',
        'learning_study_content',
        'learning_study_icon',
        'personal_growth_title',
        'personal_growth_content',
        'personal_growth_icon',
        'web_development',
        'learning_study',
        'personal_growth',
        'goal',
        'content',
    ];
}
