<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_meta', function (Blueprint $table) {
            $table->id();
            $table->morphs('seoble');
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_ar')->nullable();
            $table->string('h1_en')->nullable();
            $table->string('h1_ar')->nullable();
            $table->string('meta_keywords_en')->nullable();
            $table->string('meta_keywords_ar')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title_en')->nullable();
            $table->string('og_title_ar')->nullable();
            $table->text('og_description_en')->nullable();
            $table->text('og_description_ar')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_image_alt_en')->nullable();
            $table->string('og_image_alt_ar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_meta');
    }
};

