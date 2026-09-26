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
        Schema::table('contact_us', function (Blueprint $table) {
            // Social Media Settings
            $table->string('social_section_title_en')->nullable()->after('map_iframe_url');
            $table->string('social_section_title_ar')->nullable()->after('social_section_title_en');
            $table->json('social_items')->nullable()->after('social_section_title_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_us', function (Blueprint $table) {
            $table->dropColumn([
                'social_section_title_en',
                'social_section_title_ar',
                'social_items',
            ]);
        });
    }
};