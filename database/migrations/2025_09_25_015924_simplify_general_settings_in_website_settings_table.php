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
            // Remove unnecessary fields, keep only website_title_en, website_title_ar, and favicon
            $table->dropColumn([
                'website_tagline_en',
                'website_tagline_ar',
                'apple_touch_icon',
                'android_chrome_icon',
                'microsoft_tile_icon',
                'meta_description_en',
                'meta_description_ar',
                'meta_keywords_en',
                'meta_keywords_ar',
                'google_analytics_id',
                'google_tag_manager_id',
                'contact_email',
                'contact_phone',
                'contact_address',
                'company_registration',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            // Add back the removed fields if needed to rollback
            $table->string('website_tagline_en')->nullable();
            $table->string('website_tagline_ar')->nullable();
            $table->string('apple_touch_icon')->nullable();
            $table->string('android_chrome_icon')->nullable();
            $table->string('microsoft_tile_icon')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->string('meta_keywords_en')->nullable();
            $table->string('meta_keywords_ar')->nullable();
            $table->string('google_analytics_id')->nullable();
            $table->string('google_tag_manager_id')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();
            $table->string('company_registration')->nullable();
        });
    }
};
