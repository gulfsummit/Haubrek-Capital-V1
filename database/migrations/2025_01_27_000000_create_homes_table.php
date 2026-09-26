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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_slide_1_title_en')->nullable();
            $table->string('hero_slide_1_title_ar')->nullable();
            $table->text('hero_slide_1_subtitle_en')->nullable();
            $table->text('hero_slide_1_subtitle_ar')->nullable();
            $table->string('hero_slide_1_image')->nullable();
            $table->string('hero_slide_1_button_text_en')->nullable();
            $table->string('hero_slide_1_button_text_ar')->nullable();
            $table->string('hero_slide_1_button_link')->nullable();
            
            $table->string('hero_slide_2_title_en')->nullable();
            $table->string('hero_slide_2_title_ar')->nullable();
            $table->text('hero_slide_2_subtitle_en')->nullable();
            $table->text('hero_slide_2_subtitle_ar')->nullable();
            $table->string('hero_slide_2_image')->nullable();
            $table->string('hero_slide_2_button_text_en')->nullable();
            $table->string('hero_slide_2_button_text_ar')->nullable();
            $table->string('hero_slide_2_button_link')->nullable();
            
            $table->string('hero_slide_3_title_en')->nullable();
            $table->string('hero_slide_3_title_ar')->nullable();
            $table->text('hero_slide_3_subtitle_en')->nullable();
            $table->text('hero_slide_3_subtitle_ar')->nullable();
            $table->string('hero_slide_3_image')->nullable();
            $table->string('hero_slide_3_button_text_en')->nullable();
            $table->string('hero_slide_3_button_text_ar')->nullable();
            $table->string('hero_slide_3_button_link')->nullable();
            
            // How We Can Assist Section
            $table->string('assist_title_en')->nullable();
            $table->string('assist_title_ar')->nullable();
            $table->text('assist_description_en')->nullable();
            $table->text('assist_description_ar')->nullable();
            $table->string('assist_image')->nullable();
            
            // Services (JSON)
            $table->json('services')->nullable();
            
            // Diversified Programs Section
            $table->string('diversified_title_en')->nullable();
            $table->string('diversified_title_ar')->nullable();
            $table->text('diversified_description_en')->nullable();
            $table->text('diversified_description_ar')->nullable();
            $table->string('diversified_desktop_image')->nullable();
            $table->string('diversified_mobile_image')->nullable();
            $table->string('diversified_button_text_en')->nullable();
            $table->string('diversified_button_text_ar')->nullable();
            $table->string('diversified_button_link')->nullable();
            
            // Board of Directors Section
            $table->string('directors_title_en')->nullable();
            $table->string('directors_title_ar')->nullable();
            $table->text('directors_description_en')->nullable();
            $table->text('directors_description_ar')->nullable();
            $table->string('directors_background_image')->nullable();
            $table->json('directors')->nullable();
            
            // Proven Track Record Section
            $table->string('track_record_title_en')->nullable();
            $table->string('track_record_title_ar')->nullable();
            $table->text('track_record_description_en')->nullable();
            $table->text('track_record_description_ar')->nullable();
            $table->string('track_record_background_image')->nullable();
            $table->json('track_record_metrics')->nullable();
            
            // Road Map Section
            $table->string('roadmap_title_en')->nullable();
            $table->string('roadmap_title_ar')->nullable();
            $table->json('roadmap_steps')->nullable();
            $table->string('roadmap_mobile_image')->nullable();
            $table->string('roadmap_button_text_en')->nullable();
            $table->string('roadmap_button_text_ar')->nullable();
            $table->string('roadmap_button_link')->nullable();
            
            // Insights Section
            $table->string('insights_title_en')->nullable();
            $table->string('insights_title_ar')->nullable();
            $table->json('insights_sections')->nullable();
            
            // Ready To Start Growing Section
            $table->string('cta_title_en')->nullable();
            $table->string('cta_title_ar')->nullable();
            $table->text('cta_description_en')->nullable();
            $table->text('cta_description_ar')->nullable();
            $table->string('cta_background_image')->nullable();
            $table->string('cta_button_1_text_en')->nullable();
            $table->string('cta_button_1_text_ar')->nullable();
            $table->string('cta_button_1_link')->nullable();
            $table->string('cta_button_2_text_en')->nullable();
            $table->string('cta_button_2_text_ar')->nullable();
            $table->string('cta_button_2_link')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
