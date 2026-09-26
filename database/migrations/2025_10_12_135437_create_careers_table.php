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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en');
            $table->string('hero_title_ar');
            $table->longText('hero_subtitle_en');
            $table->longText('hero_subtitle_ar');
            $table->string('hero_button_text_en');
            $table->string('hero_button_text_ar');
            $table->string('hero_button_link')->nullable();
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            
            // Why Work Section
            $table->string('why_work_title_en');
            $table->string('why_work_title_ar');
            $table->longText('why_work_subtitle_en');
            $table->longText('why_work_subtitle_ar');
            $table->string('why_work_bg_image')->nullable();
            
            // Card 1
            $table->string('card1_title_en');
            $table->string('card1_title_ar');
            $table->longText('card1_content_en');
            $table->longText('card1_content_ar');
            
            // Card 2
            $table->string('card2_title_en');
            $table->string('card2_title_ar');
            $table->longText('card2_content_en');
            $table->longText('card2_content_ar');
            
            // Card 3
            $table->string('card3_title_en');
            $table->string('card3_title_ar');
            $table->longText('card3_content_en');
            $table->longText('card3_content_ar');
            
            // How to Apply Section
            $table->string('how_to_apply_title_en');
            $table->string('how_to_apply_title_ar');
            $table->longText('how_to_apply_text1_en');
            $table->longText('how_to_apply_text1_ar');
            $table->longText('how_to_apply_text2_en');
            $table->longText('how_to_apply_text2_ar');
            $table->string('apply_email')->default('careers@hauberkcapital.com');
            
            // CTA Section
            $table->string('cta_title_en');
            $table->string('cta_title_ar');
            $table->longText('cta_subtitle_en');
            $table->longText('cta_subtitle_ar');
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
        Schema::dropIfExists('careers');
    }
};
