<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->string('web_development_title')->nullable()->after('intro');
            $table->text('web_development_content')->nullable()->after('web_development_title');
            $table->string('learning_study_title')->nullable()->after('web_development_content');
            $table->text('learning_study_content')->nullable()->after('learning_study_title');
            $table->string('personal_growth_title')->nullable()->after('learning_study_content');
            $table->text('personal_growth_content')->nullable()->after('personal_growth_title');
        });

        DB::table('about_pages')->update([
            'web_development_title' => DB::raw('CASE WHEN web_development IS NOT NULL AND web_development != "" THEN "Web Development" ELSE NULL END'),
            'web_development_content' => DB::raw('web_development'),
            'learning_study_title' => DB::raw('CASE WHEN learning_study IS NOT NULL AND learning_study != "" THEN "Learning & Study" ELSE NULL END'),
            'learning_study_content' => DB::raw('learning_study'),
            'personal_growth_title' => DB::raw('CASE WHEN personal_growth IS NOT NULL AND personal_growth != "" THEN "Personal Growth" ELSE NULL END'),
            'personal_growth_content' => DB::raw('personal_growth'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'web_development_title',
                'web_development_content',
                'learning_study_title',
                'learning_study_content',
                'personal_growth_title',
                'personal_growth_content',
            ]);
        });
    }
};
