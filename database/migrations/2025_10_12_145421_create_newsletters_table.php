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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('tag_en')->nullable();
            $table->string('tag_ar')->nullable();
            $table->string('title_en');
            $table->string('title_ar')->nullable();
            $table->text('description_en');
            $table->text('description_ar')->nullable();
            $table->string('button_text_en')->default('SUBSCRIBE');
            $table->string('button_text_ar')->nullable();
            $table->string('placeholder_en')->default('Subscribe to Our Newsletter');
            $table->string('placeholder_ar')->nullable();
            $table->string('popup_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
