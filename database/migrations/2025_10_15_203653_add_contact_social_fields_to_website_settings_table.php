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
        Schema::table('website_settings', function (Blueprint $table) {
            // Contact Page Social Media Settings
            $table->string('contact_social_section_title_en')->nullable()->after('footer_settings');
            $table->string('contact_social_section_title_ar')->nullable()->after('contact_social_section_title_en');
            $table->json('contact_social_items')->nullable()->after('contact_social_section_title_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'contact_social_section_title_en',
                'contact_social_section_title_ar',
                'contact_social_items',
            ]);
        });
    }
};