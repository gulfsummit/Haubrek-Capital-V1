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
        Schema::create('investment_services', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_ar')->nullable();
            $table->text('hero_subtitle_en')->nullable();
            $table->text('hero_subtitle_ar')->nullable();
            $table->string('hero_button_text_en')->nullable();
            $table->string('hero_button_text_ar')->nullable();
            $table->string('hero_button_url')->nullable();

            // Services Overview Section
            $table->string('overview_title_en')->nullable();
            $table->string('overview_title_ar')->nullable();
            $table->text('overview_description_en')->nullable();
            $table->text('overview_description_ar')->nullable();
            $table->json('overview_items')->nullable();

            // Approach Section
            $table->string('approach_background_image')->nullable();
            $table->string('approach_title_en')->nullable();
            $table->string('approach_title_ar')->nullable();
            $table->text('approach_description_en')->nullable();
            $table->text('approach_description_ar')->nullable();
            $table->json('approach_items')->nullable();

            // Steps Section
            $table->string('steps_title_en')->nullable();
            $table->string('steps_title_ar')->nullable();
            $table->string('steps_subtitle_en')->nullable();
            $table->string('steps_subtitle_ar')->nullable();
            $table->json('steps_items')->nullable();

            // Why Choose Us Section
            $table->string('why_choose_title_en')->nullable();
            $table->string('why_choose_title_ar')->nullable();
            $table->json('why_choose_items')->nullable();

            // CTA Section
            $table->string('cta_title_en')->nullable();
            $table->string('cta_title_ar')->nullable();
            $table->text('cta_description_en')->nullable();
            $table->text('cta_description_ar')->nullable();
            $table->string('cta_button_1_text_en')->nullable();
            $table->string('cta_button_1_text_ar')->nullable();
            $table->string('cta_button_1_url')->nullable();
            $table->string('cta_button_2_text_en')->nullable();
            $table->string('cta_button_2_text_ar')->nullable();
            $table->string('cta_button_2_url')->nullable();
            $table->string('cta_background_image')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_services');
    }
};
