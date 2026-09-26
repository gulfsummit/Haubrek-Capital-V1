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
            // Add missing fields
            $table->string('wealth_mobile_background_image')->nullable()->after('wealth_background');
            $table->string('cio_mobile_background_image')->nullable()->after('cio_background');
            $table->json('roadmap_steps')->nullable()->after('roadmap_mobile_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Drop added fields
            $table->dropColumn([
                'wealth_mobile_background_image',
                'cio_mobile_background_image',
                'roadmap_steps',
            ]);
        });
    }
};
