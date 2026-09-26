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
        Schema::table('abouts', function (Blueprint $table) {
            // Mission title fields
            $table->string('mission_title_en')->nullable();
            $table->string('mission_title_ar')->nullable();
            
            // Vision title fields
            $table->string('vision_title_en')->nullable();
            $table->string('vision_title_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'mission_title_en',
                'mission_title_ar',
                'vision_title_en',
                'vision_title_ar'
            ]);
        });
    }
};