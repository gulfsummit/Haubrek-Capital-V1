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
        Schema::create('governance_services', function (Blueprint $table) {
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
            $table->string('services_title_en')->nullable();
            $table->string('services_title_ar')->nullable();
            $table->text('services_description_en')->nullable();
            $table->text('services_description_ar')->nullable();
            $table->json('services_cards')->nullable(); // Array of service cards
            
            // Approach Section
            $table->string('approach_background_image')->nullable();
            $table->string('approach_title_en')->nullable();
            $table->string('approach_title_ar')->nullable();
            $table->text('approach_description_en')->nullable();
            $table->text('approach_description_ar')->nullable();
            $table->text('approach_description_2_en')->nullable();
            $table->text('approach_description_2_ar')->nullable();
            $table->json('approach_items')->nullable(); // Array of approach items with titles and content
            
            // Steps Section
            $table->string('steps_title_en')->nullable();
            $table->string('steps_title_ar')->nullable();
            $table->string('steps_subtitle_en')->nullable();
            $table->string('steps_subtitle_ar')->nullable();
            $table->json('steps_items')->nullable(); // Array of steps
            
            // Why Choose Us Section
            $table->string('why_choose_title_en')->nullable();
            $table->string('why_choose_title_ar')->nullable();
            $table->json('why_choose_items')->nullable(); // Array of reasons with images, titles, descriptions
            
            // CTA Section
            $table->string('cta_background_image')->nullable();
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
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governance_services');
    }
};
