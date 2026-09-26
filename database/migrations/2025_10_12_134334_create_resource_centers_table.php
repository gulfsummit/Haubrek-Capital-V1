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
        Schema::create('resource_centers', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en');
            $table->string('hero_title_ar');
            $table->text('hero_subtitle_en');
            $table->text('hero_subtitle_ar');
            $table->string('hero_button_text_en');
            $table->string('hero_button_text_ar');
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            
            // Main Section
            $table->string('section_title_en');
            $table->string('section_title_ar');
            $table->text('section_subtitle_en');
            $table->text('section_subtitle_ar');
            
            // Card 1: Blog/News
            $table->string('blog_card_title_en');
            $table->string('blog_card_title_ar');
            $table->string('blog_card_image')->nullable();
            
            // Card 2: Case Studies
            $table->string('case_studies_card_title_en');
            $table->string('case_studies_card_title_ar');
            $table->string('case_studies_card_image')->nullable();
            
            // Card 3: Tools
            $table->string('tools_card_title_en');
            $table->string('tools_card_title_ar');
            $table->string('tools_card_image')->nullable();
            
            // CTA Section
            $table->string('cta_title_en');
            $table->string('cta_title_ar');
            $table->text('cta_subtitle_en');
            $table->text('cta_subtitle_ar');
            $table->string('cta_button_1_text_en');
            $table->string('cta_button_1_text_ar');
            $table->string('cta_button_2_text_en');
            $table->string('cta_button_2_text_ar');
            $table->string('cta_background_image')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_centers');
    }
};
