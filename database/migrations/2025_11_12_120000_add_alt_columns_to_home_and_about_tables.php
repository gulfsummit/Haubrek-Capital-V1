<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected array $homeColumns = [
        'hero_slide_1_image_alt_en',
        'hero_slide_1_image_alt_ar',
        'hero_slide_2_image_alt_en',
        'hero_slide_2_image_alt_ar',
        'hero_slide_3_image_alt_en',
        'hero_slide_3_image_alt_ar',
        'assist_image_alt_en',
        'assist_image_alt_ar',
        'diversified_desktop_image_alt_en',
        'diversified_desktop_image_alt_ar',
        'diversified_mobile_image_alt_en',
        'diversified_mobile_image_alt_ar',
        'directors_background_image_alt_en',
        'directors_background_image_alt_ar',
        'track_record_background_image_alt_en',
        'track_record_background_image_alt_ar',
        'track_record_icon_alt_en',
        'track_record_icon_alt_ar',
        'roadmap_mobile_image_alt_en',
        'roadmap_mobile_image_alt_ar',
        'cta_background_image_alt_en',
        'cta_background_image_alt_ar',
    ];

    protected array $aboutColumns = [
        'hero_desktop_image_alt_en',
        'hero_desktop_image_alt_ar',
        'hero_mobile_image_alt_en',
        'hero_mobile_image_alt_ar',
        'who_we_are_desktop_bg_alt_en',
        'who_we_are_desktop_bg_alt_ar',
        'who_we_are_mobile_bg_alt_en',
        'who_we_are_mobile_bg_alt_ar',
        'concept_background_image_alt_en',
        'concept_background_image_alt_ar',
        'concept_mobile_background_image_alt_en',
        'concept_mobile_background_image_alt_ar',
        'concept_diagram_image_alt_en',
        'concept_diagram_image_alt_ar',
        'concept_mobile_diagram_image_alt_en',
        'concept_mobile_diagram_image_alt_ar',
        'concept_arabic_diagram_image_alt_en',
        'concept_arabic_diagram_image_alt_ar',
        'concept_mobile_arabic_diagram_image_alt_en',
        'concept_mobile_arabic_diagram_image_alt_ar',
        'mission_icon_alt_en',
        'mission_icon_alt_ar',
        'vision_icon_alt_en',
        'vision_icon_alt_ar',
        'approach_bg_image_alt_en',
        'approach_bg_image_alt_ar',
    ];

    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            foreach ($this->homeColumns as $column) {
                if (! Schema::hasColumn('homes', $column)) {
                    $table->string($column)->nullable()->after('cta_button_2_link');
                }
            }
        });

        Schema::table('abouts', function (Blueprint $table) {
            foreach ($this->aboutColumns as $column) {
                if (! Schema::hasColumn('abouts', $column)) {
                    $table->string($column)->nullable()->after('approach_bg_image');
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            foreach ($this->homeColumns as $column) {
                if (Schema::hasColumn('homes', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('abouts', function (Blueprint $table) {
            foreach ($this->aboutColumns as $column) {
                if (Schema::hasColumn('abouts', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

