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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en');
            $table->string('hero_title_ar');
            $table->longText('hero_subtitle_en');
            $table->longText('hero_subtitle_ar');
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            
            // Form Section
            $table->string('form_title_en');
            $table->string('form_title_ar');
            $table->string('form_button_text_en');
            $table->string('form_button_text_ar');
            
            // Contact Info Titles
            $table->string('phone_title_en');
            $table->string('phone_title_ar');
            $table->longText('phone_subtitle_en');
            $table->longText('phone_subtitle_ar');
            
            $table->string('email_title_en');
            $table->string('email_title_ar');
            $table->longText('email_subtitle_en');
            $table->longText('email_subtitle_ar');
            
            $table->string('address_title_en');
            $table->string('address_title_ar');
            
            // Map
            $table->text('map_iframe_url')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
