<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->string('slug')->unique();
            $table->string('cover_image')->nullable();
            $table->string('cover_image_alt_en')->nullable();
            $table->string('cover_image_alt_ar')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_ar')->nullable();
            $table->string('research_type_en')->nullable(); // e.g. "Market Research", "Investment Report"
            $table->string('research_type_ar')->nullable();
            $table->date('publication_date')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('author_en')->nullable();
            $table->string('author_ar')->nullable();
            $table->json('topics')->nullable();
            $table->boolean('form_required')->default(true); // if true, user must fill form before download
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
