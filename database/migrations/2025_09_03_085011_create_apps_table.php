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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en')->default('HAUBERK CAPITAL APP');
            $table->string('hero_title_ar')->nullable();
            $table->text('hero_subtitle_en');
            $table->text('hero_subtitle_ar')->nullable();
            $table->string('hero_background_image')->nullable();
            $table->string('hero_mobile_background_image')->nullable();
            
            // Investment App Promo Section
            $table->string('promo_title_en')->default('INVESTMENT MADE SIMPLE ONE APP, TOTAL CONTROL');
            $table->string('promo_title_ar')->nullable();
            $table->text('promo_description_en');
            $table->text('promo_description_ar')->nullable();
            $table->string('promo_background_image')->nullable();
            $table->string('promo_mobile_1_image')->nullable();
            $table->string('promo_mobile_2_image')->nullable();
            $table->string('promo_mobile_3_image')->nullable();
            
            // Bottom Half Section
            $table->string('bottom_title_en')->default('EFFORTLESSLY MONITOR YOUR INVESTMENTS');
            $table->string('bottom_title_ar')->nullable();
            $table->string('bottom_subtitle_en')->default('Managing Portfolio, Always Accessible');
            $table->string('bottom_subtitle_ar')->nullable();
            $table->text('bottom_background_image')->nullable();
            $table->json('bottom_bullet_points_en')->nullable();
            $table->json('bottom_bullet_points_ar')->nullable();
            
            // Connect Section
            $table->string('connect_subtitle_en')->default('ENGAGE DIRECTLY WITH OUR TEAM');
            $table->string('connect_subtitle_ar')->nullable();
            $table->string('connect_title_en')->default('Connect with Your Investment Experts');
            $table->string('connect_title_ar')->nullable();
            $table->json('connect_bullet_points_en')->nullable();
            $table->json('connect_bullet_points_ar')->nullable();
            $table->string('connect_background_image')->nullable();
            $table->string('connect_mobile_image')->nullable();
            
            // Documentation Section
            $table->string('docs_subtitle_en')->default('Manage all your financial documents');
            $table->string('docs_subtitle_ar')->nullable();
            $table->string('docs_title_en')->default('Secure & Smart Documentation');
            $table->string('docs_title_ar')->nullable();
            $table->json('docs_bullet_points_en')->nullable();
            $table->json('docs_bullet_points_ar')->nullable();
            $table->string('docs_background_image')->nullable();
            $table->string('docs_mobile_image')->nullable();
            
            // Knowledge Section
            $table->string('knowledge_subtitle_en')->default('access to premium financial education and industry expertise.');
            $table->string('knowledge_subtitle_ar')->nullable();
            $table->string('knowledge_title_en')->default('Exclusive Knowledge & Investment Insights');
            $table->string('knowledge_title_ar')->nullable();
            $table->json('knowledge_bullet_points_en')->nullable();
            $table->json('knowledge_bullet_points_ar')->nullable();
            $table->string('knowledge_background_image')->nullable();
            $table->string('knowledge_mobile_image')->nullable();
            
            // Security Section
            $table->string('security_subtitle_en')->default('with advanced encryption and multi-layered security protocols.');
            $table->string('security_subtitle_ar')->nullable();
            $table->string('security_title_en')->default('Security You Can Trust');
            $table->string('security_title_ar')->nullable();
            $table->json('security_bullet_points_en')->nullable();
            $table->json('security_bullet_points_ar')->nullable();
            $table->string('security_background_image')->nullable();
            $table->string('security_mobile_image')->nullable();
            
            // CTA Section
            $table->string('cta_title_en')->default('READY TO START GROWING?!');
            $table->string('cta_title_ar')->nullable();
            $table->text('cta_subtitle_en');
            $table->text('cta_subtitle_ar')->nullable();
            $table->string('cta_background_image')->nullable();
            $table->string('cta_button_1_text_en')->default('JOIN OUR MAILING LIST');
            $table->string('cta_button_1_text_ar')->nullable();
            $table->string('cta_button_1_url')->default('/contact-us');
            $table->string('cta_button_2_text_en')->default('REQUEST A MEETING');
            $table->string('cta_button_2_text_ar')->nullable();
            $table->string('cta_button_2_url')->default('/request-meeting');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
