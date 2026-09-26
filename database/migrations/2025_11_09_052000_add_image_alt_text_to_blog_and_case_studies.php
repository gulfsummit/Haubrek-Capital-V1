<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('featured_image_alt_en')->nullable()->after('featured_image');
            $table->string('featured_image_alt_ar')->nullable()->after('featured_image_alt_en');
            $table->string('thumbnail_image_alt_en')->nullable()->after('thumbnail_image');
            $table->string('thumbnail_image_alt_ar')->nullable()->after('thumbnail_image_alt_en');
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->string('featured_image_alt_en')->nullable()->after('featured_image');
            $table->string('featured_image_alt_ar')->nullable()->after('featured_image_alt_en');
            $table->string('thumbnail_image_alt_en')->nullable()->after('thumbnail_image');
            $table->string('thumbnail_image_alt_ar')->nullable()->after('thumbnail_image_alt_en');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'featured_image_alt_en',
                'featured_image_alt_ar',
                'thumbnail_image_alt_en',
                'thumbnail_image_alt_ar',
            ]);
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropColumn([
                'featured_image_alt_en',
                'featured_image_alt_ar',
                'thumbnail_image_alt_en',
                'thumbnail_image_alt_ar',
            ]);
        });
    }
};

