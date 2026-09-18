<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->unique();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('slug', 120)->unique();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('about_pages')) {
            Schema::create('about_pages', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('role')->nullable();
                $table->string('profile_image')->nullable();
                $table->string('title');
                $table->text('intro');
                $table->string('web_development_title')->nullable();
                $table->text('web_development_content')->nullable();
                $table->string('web_development_icon')->nullable();
                $table->string('learning_study_title')->nullable();
                $table->text('learning_study_content')->nullable();
                $table->string('learning_study_icon')->nullable();
                $table->string('personal_growth_title')->nullable();
                $table->text('personal_growth_content')->nullable();
                $table->string('personal_growth_icon')->nullable();
                $table->text('web_development')->nullable();
                $table->text('learning_study')->nullable();
                $table->text('personal_growth')->nullable();
                $table->text('goal')->nullable();
                $table->longText('content');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id');
                $table->foreignId('category_id');
                $table->string('title');
                $table->longText('content');
                $table->string('image')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('post_tag')) {
            Schema::create('post_tag', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('post_id');
                $table->unsignedBigInteger('tag_id');
                $table->timestamps();
                $table->unique(['post_id', 'tag_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (['post_tag', 'posts', 'about_pages', 'tags', 'categories'] as $table) {
            if (Schema::hasTable($table)) {
                Schema::dropIfExists($table);
            }
        }
    }
};
