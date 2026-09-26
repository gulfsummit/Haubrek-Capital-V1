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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_ar')->nullable();
            $table->text('hero_subtitle_en')->nullable();
            $table->text('hero_subtitle_ar')->nullable();
            $table->string('hero_background_image')->nullable();
            $table->string('hero_mobile_background_image')->nullable();
            
            // Main Description Section
            $table->string('description_title_en')->nullable();
            $table->string('description_title_ar')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_ar')->nullable();
            
            // Services List Section
            $table->json('services_list')->nullable(); // Array of services with title, description, link
            
            // CTA Section
            $table->string('cta_title_en')->nullable();
            $table->string('cta_title_ar')->nullable();
            $table->text('cta_subtitle_en')->nullable();
            $table->text('cta_subtitle_ar')->nullable();
            $table->string('cta_background_image')->nullable();
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
        Schema::dropIfExists('services');
    }
};
