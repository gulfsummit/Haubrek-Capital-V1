<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('white_papers', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt_en')->nullable();
            $table->string('featured_image_alt_ar')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('cover_image_alt_en')->nullable();
            $table->string('cover_image_alt_ar')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->longText('executive_summary_en')->nullable();
            $table->longText('executive_summary_ar')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('author_en')->nullable();
            $table->string('author_ar')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('related_article_url')->nullable();
            $table->json('topics')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('white_papers');
    }
};
