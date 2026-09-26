<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            if (! Schema::hasColumn('homes', 'hero_slides')) {
                $table->json('hero_slides')->nullable()->after('hero_slide_3_button_link');
            }
        });

        $homes = DB::table('homes')->get();

        foreach ($homes as $home) {
            $slides = [];

            foreach ([1, 2, 3] as $index) {
                $titleEn = $home->{"hero_slide_{$index}_title_en"} ?? null;
                $titleAr = $home->{"hero_slide_{$index}_title_ar"} ?? null;
                $subtitleEn = $home->{"hero_slide_{$index}_subtitle_en"} ?? null;
                $subtitleAr = $home->{"hero_slide_{$index}_subtitle_ar"} ?? null;
                $image = $home->{"hero_slide_{$index}_image"} ?? null;
                $buttonTextEn = $home->{"hero_slide_{$index}_button_text_en"} ?? null;
                $buttonTextAr = $home->{"hero_slide_{$index}_button_text_ar"} ?? null;
                $buttonLink = $home->{"hero_slide_{$index}_button_link"} ?? null;
                $imageAltEn = Schema::hasColumn('homes', "hero_slide_{$index}_image_alt_en")
                    ? ($home->{"hero_slide_{$index}_image_alt_en"} ?? null)
                    : null;
                $imageAltAr = Schema::hasColumn('homes', "hero_slide_{$index}_image_alt_ar")
                    ? ($home->{"hero_slide_{$index}_image_alt_ar"} ?? null)
                    : null;

                if (
                    filled($titleEn) || filled($titleAr) || filled($subtitleEn) || filled($subtitleAr) ||
                    filled($image) || filled($buttonTextEn) || filled($buttonTextAr) || filled($buttonLink)
                ) {
                    $slides[] = [
                        'title_en' => $titleEn,
                        'title_ar' => $titleAr,
                        'subtitle_en' => $subtitleEn,
                        'subtitle_ar' => $subtitleAr,
                        'image' => $image,
                        'image_alt_en' => $imageAltEn,
                        'image_alt_ar' => $imageAltAr,
                        'button_text_en' => $buttonTextEn,
                        'button_text_ar' => $buttonTextAr,
                        'button_link' => $buttonLink,
                    ];
                }
            }

            if ($slides !== []) {
                DB::table('homes')
                    ->where('id', $home->id)
                    ->update(['hero_slides' => json_encode($slides)]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            if (Schema::hasColumn('homes', 'hero_slides')) {
                $table->dropColumn('hero_slides');
            }
        });
    }
};
