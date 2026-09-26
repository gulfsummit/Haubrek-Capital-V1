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
        Schema::table('services', function (Blueprint $table) {
            // Service Details Section
            $table->json('sliders_card')->nullable()->after('services_list');
            $table->json('approaches_tool')->nullable()->after('sliders_card');
            $table->json('steps_start_card')->nullable()->after('approaches_tool');
            $table->string('roadmap_title_en')->nullable()->after('steps_start_card');
            $table->string('roadmap_title_ar')->nullable()->after('roadmap_title_en');
            $table->string('roadmap_mobile_image')->nullable()->after('roadmap_title_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'sliders_card',
                'approaches_tool',
                'steps_start_card',
                'roadmap_title_en',
                'roadmap_title_ar',
                'roadmap_mobile_image',
            ]);
        });
    }
};
