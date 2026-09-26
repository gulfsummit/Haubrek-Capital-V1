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
        Schema::table('teams', function (Blueprint $table) {
            // Directors Popup Content (for fallback)
            $table->string('directors_popup_experience_title_en')->nullable()->after('directors_section_description_ar');
            $table->string('directors_popup_experience_title_ar')->nullable()->after('directors_popup_experience_title_en');
            $table->string('directors_popup_current_title_en')->nullable()->after('directors_popup_experience_title_ar');
            $table->string('directors_popup_current_title_ar')->nullable()->after('directors_popup_current_title_en');
            $table->string('directors_popup_previous_title_en')->nullable()->after('directors_popup_current_title_ar');
            $table->string('directors_popup_previous_title_ar')->nullable()->after('directors_popup_previous_title_en');
            $table->string('directors_popup_education_title_en')->nullable()->after('directors_popup_previous_title_ar');
            $table->string('directors_popup_education_title_ar')->nullable()->after('directors_popup_education_title_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn([
                'directors_popup_experience_title_en',
                'directors_popup_experience_title_ar',
                'directors_popup_current_title_en',
                'directors_popup_current_title_ar',
                'directors_popup_previous_title_en',
                'directors_popup_previous_title_ar',
                'directors_popup_education_title_en',
                'directors_popup_education_title_ar'
            ]);
        });
    }
};
