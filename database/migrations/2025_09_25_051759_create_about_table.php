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
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->json('questions')->nullable();
            
            // Hero Section
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_ar')->nullable();
            $table->text('hero_subtitle_en')->nullable();
            $table->text('hero_subtitle_ar')->nullable();
            $table->string('hero_button_text_en')->nullable();
            $table->string('hero_button_text_ar')->nullable();
            $table->string('hero_button_link')->nullable();
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
            
            // Values & Approach
            $table->string('values_title_en')->nullable();
            $table->string('values_title_ar')->nullable();
            $table->json('values')->nullable();
            $table->string('approach_title_en')->nullable();
            $table->string('approach_title_ar')->nullable();
            $table->text('approach_description_1_en')->nullable();
            $table->text('approach_description_1_ar')->nullable();
            $table->text('approach_description_2_en')->nullable();
            $table->text('approach_description_2_ar')->nullable();
            $table->json('approach_items')->nullable();
            $table->string('approach_bg_image')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};