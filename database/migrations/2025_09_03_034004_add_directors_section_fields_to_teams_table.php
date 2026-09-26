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
            // Directors Section
            $table->string('directors_section_title_en')->nullable()->after('leadership_mobile_background_image');
            $table->string('directors_section_title_ar')->nullable()->after('directors_section_title_en');
            $table->longText('directors_section_description_en')->nullable()->after('directors_section_title_ar');
            $table->longText('directors_section_description_ar')->nullable()->after('directors_section_description_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn([
                'directors_section_title_en',
                'directors_section_title_ar',
                'directors_section_description_en',
                'directors_section_description_ar'
            ]);
        });
    }
};
