<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->string('gtm_id')->nullable()->after('favicon');
            $table->string('google_analytics_id')->nullable()->after('gtm_id');
            $table->string('search_console_verification')->nullable()->after('google_analytics_id');
            $table->string('facebook_pixel_id')->nullable()->after('search_console_verification');
            $table->string('twitter_pixel_id')->nullable()->after('facebook_pixel_id');
            $table->string('linkedin_pixel_id')->nullable()->after('twitter_pixel_id');
            $table->string('tiktok_pixel_id')->nullable()->after('linkedin_pixel_id');
            $table->text('additional_head_scripts')->nullable()->after('tiktok_pixel_id');
            $table->text('additional_body_scripts')->nullable()->after('additional_head_scripts');
        });
    }

    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'gtm_id',
                'google_analytics_id',
                'search_console_verification',
                'facebook_pixel_id',
                'twitter_pixel_id',
                'linkedin_pixel_id',
                'tiktok_pixel_id',
                'additional_head_scripts',
                'additional_body_scripts',
            ]);
        });
    }
};

