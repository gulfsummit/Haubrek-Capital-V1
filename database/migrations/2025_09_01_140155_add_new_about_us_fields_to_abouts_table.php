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
        Schema::table('abouts', function (Blueprint $table) {
            // Hero Section
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_ar')->nullable();
            $table->text('hero_subtitle_en')->nullable();
            $table->text('hero_subtitle_ar')->nullable();
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            
            // Who We Are Section
            $table->string('who_we_are_title_en')->nullable();
            $table->string('who_we_are_title_ar')->nullable();
            $table->text('who_we_are_description_1_en')->nullable();
            $table->text('who_we_are_description_1_ar')->nullable();
            $table->text('who_we_are_description_2_en')->nullable();
            $table->text('who_we_are_description_2_ar')->nullable();
            $table->text('who_we_are_description_3_en')->nullable();
            $table->text('who_we_are_description_3_ar')->nullable();
            $table->string('who_we_are_desktop_bg')->nullable();
            $table->string('who_we_are_mobile_bg')->nullable();
            
            // Concept Section
            $table->string('concept_title_en')->nullable();
            $table->string('concept_title_ar')->nullable();
            $table->text('concept_intro_en')->nullable();
            $table->text('concept_intro_ar')->nullable();
            $table->text('yield_description_en')->nullable();
            $table->text('yield_description_ar')->nullable();
            $table->text('defence_description_en')->nullable();
            $table->text('defence_description_ar')->nullable();
            $table->text('appreciation_description_en')->nullable();
            $table->text('appreciation_description_ar')->nullable();
            $table->text('liquidity_description_en')->nullable();
            $table->text('liquidity_description_ar')->nullable();
            $table->string('concept_diagram_image')->nullable();
            $table->string('concept_bg_image')->nullable();
            
            // Mission & Vision
            $table->text('mission_text_en')->nullable();
            $table->text('mission_text_ar')->nullable();
            $table->text('vision_text_en')->nullable();
            $table->text('vision_text_ar')->nullable();
            $table->string('mission_icon')->nullable();
            $table->string('vision_icon')->nullable();
            
            // Values Section
            $table->string('values_title_en')->nullable();
            $table->string('values_title_ar')->nullable();
            $table->json('values')->nullable(); // Array of value objects
            
            // Approach Section
            $table->string('approach_title_en')->nullable();
            $table->string('approach_title_ar')->nullable();
            $table->text('approach_description_1_en')->nullable();
            $table->text('approach_description_1_ar')->nullable();
            $table->text('approach_description_2_en')->nullable();
            $table->text('approach_description_2_ar')->nullable();
            $table->json('approach_items')->nullable(); // Array of approach items
            $table->string('approach_bg_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Hero Section
            $table->dropColumn([
                'hero_title_en', 'hero_title_ar', 'hero_subtitle_en', 'hero_subtitle_ar',
                'hero_desktop_image', 'hero_mobile_image'
            ]);
            
            // Who We Are Section
            $table->dropColumn([
                'who_we_are_title_en', 'who_we_are_title_ar', 
                'who_we_are_description_1_en', 'who_we_are_description_1_ar',
                'who_we_are_description_2_en', 'who_we_are_description_2_ar',
                'who_we_are_description_3_en', 'who_we_are_description_3_ar',
                'who_we_are_desktop_bg', 'who_we_are_mobile_bg'
            ]);
            
            // Concept Section
            $table->dropColumn([
                'concept_title_en', 'concept_title_ar', 'concept_intro_en', 'concept_intro_ar',
                'yield_description_en', 'yield_description_ar',
                'defence_description_en', 'defence_description_ar',
                'appreciation_description_en', 'appreciation_description_ar',
                'liquidity_description_en', 'liquidity_description_ar',
                'concept_diagram_image', 'concept_bg_image'
            ]);
            
            // Mission & Vision
            $table->dropColumn([
                'mission_text_en', 'mission_text_ar', 'vision_text_en', 'vision_text_ar',
                'mission_icon', 'vision_icon'
            ]);
            
            // Values & Approach
            $table->dropColumn([
                'values_title_en', 'values_title_ar', 'values',
                'approach_title_en', 'approach_title_ar',
                'approach_description_1_en', 'approach_description_1_ar',
                'approach_description_2_en', 'approach_description_2_ar',
                'approach_items', 'approach_bg_image'
            ]);
        });
    }
};
