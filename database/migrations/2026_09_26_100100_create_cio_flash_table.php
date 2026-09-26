<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cio_flash', function (Blueprint $table) {
            $table->id();
            $table->string('episode_title_en');
            $table->string('episode_title_ar')->nullable();
            $table->string('slug')->unique();
            $table->integer('episode_number')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('audio_file')->nullable();
            $table->string('duration')->nullable(); // e.g. "12:34" or "12 min"
            $table->string('speaker_en')->nullable();
            $table->string('speaker_ar')->nullable();
            $table->string('speaker_position_en')->nullable();
            $table->string('speaker_position_ar')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_image_alt_en')->nullable();
            $table->string('featured_image_alt_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->json('key_topics')->nullable();
            $table->longText('transcript_en')->nullable();
            $table->longText('transcript_ar')->nullable();
            $table->json('related_articles')->nullable(); // array of URLs or IDs
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cio_flash');
    }
};
