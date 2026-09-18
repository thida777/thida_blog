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
        Schema::table('about_pages', function (Blueprint $table) {
            $table->string('web_development_icon')->nullable()->after('web_development_content');
            $table->string('learning_study_icon')->nullable()->after('learning_study_content');
            $table->string('personal_growth_icon')->nullable()->after('personal_growth_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'web_development_icon',
                'learning_study_icon',
                'personal_growth_icon',
            ]);
        });
    }
};
