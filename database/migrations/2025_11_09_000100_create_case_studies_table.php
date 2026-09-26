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
        Schema::create('case_studies', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->longText('content_en');
            $table->longText('content_ar')->nullable();
            $table->string('category')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_studies');
    }
};

