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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
             $table->text('description_ar')->nullable();
             $table->string('title_en');
             $table->text('description_en')->nullable();
             $table->json('sliders_card')->nullable();
             $table->json('approaches_tool')->nullable();
             $table->json('steps_start_card')->nullable();
             //WHY CHOOSE US
            $table->json('why_choose_us')->nullable();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
