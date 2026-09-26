<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monday_windows', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('slug')->unique();
            $table->date('week_date')->nullable();
            $table->text('short_summary_en')->nullable();
            $table->text('short_summary_ar')->nullable();
            $table->longText('content_en')->nullable();
            $table->longText('content_ar')->nullable();
            $table->json('market_topics')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt_en')->nullable();
            $table->string('featured_image_alt_ar')->nullable();
            $table->json('external_sources')->nullable(); // array of {label, url}
            $table->json('related_articles')->nullable(); // array of URLs or IDs
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monday_windows');
    }
};
