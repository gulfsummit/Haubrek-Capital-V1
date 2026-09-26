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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            
            // Header Settings
            $table->string('header_logo')->nullable(); // Logo image path
            $table->string('header_background_type')->default('transparent'); // transparent, solid, gradient
            $table->string('header_background_color')->nullable(); // Hex color for solid background
            $table->string('header_background_gradient_start')->nullable(); // Start color for gradient
            $table->string('header_background_gradient_end')->nullable(); // End color for gradient
            $table->boolean('header_backdrop_blur')->default(true); // Enable/disable backdrop blur
            
            // Navigation Links
            $table->json('navigation_links')->nullable(); // Array of navigation items
            $table->json('footer_links')->nullable(); // Array of footer menu items
            
            // Header Buttons
            $table->string('header_cta_text')->nullable();
            $table->string('header_cta_url')->nullable();
            $table->string('header_cta_background_color')->nullable();
            $table->string('header_cta_text_color')->nullable();
            
            // Language Settings
            $table->string('default_language')->nullable();
            $table->boolean('show_language_switcher')->default(true);
            
            // Mobile Menu Settings
            $table->boolean('show_mobile_menu')->default(true);
            $table->string('mobile_menu_background_color')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
