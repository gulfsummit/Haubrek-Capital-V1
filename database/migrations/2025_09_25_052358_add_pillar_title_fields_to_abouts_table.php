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
            // Yield title fields
            $table->string('yield_title_en')->nullable();
            $table->string('yield_title_ar')->nullable();
            
            // Defence title fields
            $table->string('defence_title_en')->nullable();
            $table->string('defence_title_ar')->nullable();
            
            // Appreciation title fields
            $table->string('appreciation_title_en')->nullable();
            $table->string('appreciation_title_ar')->nullable();
            
            // Liquidity title fields
            $table->string('liquidity_title_en')->nullable();
            $table->string('liquidity_title_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'yield_title_en',
                'yield_title_ar',
                'defence_title_en',
                'defence_title_ar',
                'appreciation_title_en',
                'appreciation_title_ar',
                'liquidity_title_en',
                'liquidity_title_ar'
            ]);
        });
    }
};