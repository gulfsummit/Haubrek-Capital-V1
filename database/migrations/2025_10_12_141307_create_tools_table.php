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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_ar')->nullable();
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            
            // Investment Profile Section
            $table->string('profile_title_en')->nullable();
            $table->string('profile_title_ar')->nullable();
            $table->text('profile_description_en')->nullable();
            $table->text('profile_description_ar')->nullable();
            $table->string('profile_image')->nullable();
            
            // Key Features Section
            $table->string('features_title_en')->nullable();
            $table->string('features_title_ar')->nullable();
            $table->text('features_list_en')->nullable(); // JSON array of features
            $table->text('features_list_ar')->nullable();
            $table->string('features_background_image')->nullable();
            
            // How It Works Section
            $table->string('how_it_works_title_en')->nullable();
            $table->string('how_it_works_title_ar')->nullable();
            $table->text('how_it_works_steps_en')->nullable(); // JSON array of steps
            $table->text('how_it_works_steps_ar')->nullable();
            
            // Form Section
            $table->string('form_title_en')->nullable();
            $table->string('form_title_ar')->nullable();
            $table->string('form_background_image')->nullable();
            $table->string('form_button_text_en')->nullable();
            $table->string('form_button_text_ar')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
