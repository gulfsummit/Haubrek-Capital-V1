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
        Schema::table('services', function (Blueprint $table) {
            // Governance Advisory mobile fields
            $table->string('governance_mobile_background')->nullable();
            $table->string('governance_mobile_image')->nullable();
            
            // Wealth Planning mobile fields
            $table->string('wealth_mobile_image')->nullable();
            
            // Strategic Investment Advisory mobile fields
            $table->string('investment_mobile_background')->nullable();
            $table->string('investment_mobile_image')->nullable();
            
            // CIO Office Services mobile fields
            $table->string('cio_mobile_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'governance_mobile_background',
                'governance_mobile_image',
                'wealth_mobile_image',
                'investment_mobile_background',
                'investment_mobile_image',
                'cio_mobile_image'
            ]);
        });
    }
};