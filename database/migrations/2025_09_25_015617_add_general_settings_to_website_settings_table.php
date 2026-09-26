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
            // Website Identity
            $table->string('website_title_en')->default('Hauberk Capital')->after('id');
            $table->string('website_title_ar')->default('هاوبيرك كابيتال')->after('website_title_en');
            $table->string('website_tagline_en')->default('Your Trusted Investment Partner')->after('website_title_ar');
            $table->string('website_tagline_ar')->default('شريكك الاستثماري الموثوق')->after('website_tagline_en');
            
            // Favicon Settings
            $table->string('favicon')->nullable()->after('website_tagline_ar');
            $table->string('apple_touch_icon')->nullable()->after('favicon');
            $table->string('android_chrome_icon')->nullable()->after('apple_touch_icon');
            $table->string('microsoft_tile_icon')->nullable()->after('android_chrome_icon');
            
            // SEO Settings
            $table->text('meta_description_en')->nullable()->after('microsoft_tile_icon');
            $table->text('meta_description_ar')->nullable()->after('meta_description_en');
            $table->string('meta_keywords_en')->nullable()->after('meta_description_ar');
            $table->string('meta_keywords_ar')->nullable()->after('meta_keywords_en');
            $table->string('google_analytics_id')->nullable()->after('meta_keywords_ar');
            $table->string('google_tag_manager_id')->nullable()->after('google_analytics_id');
            
            // Contact Information
            $table->string('contact_email')->default('info@hauberkcapital.com')->after('google_tag_manager_id');
            $table->string('contact_phone')->default('+971 4 5182591')->after('contact_email');
            $table->text('contact_address')->nullable()->after('contact_phone');
            $table->string('company_registration')->default('ADGM Financial Regulated Company, FSP no. 220131')->after('contact_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'website_title_en',
                'website_title_ar',
                'website_tagline_en',
                'website_tagline_ar',
                'favicon',
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
};
